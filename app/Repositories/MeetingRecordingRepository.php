<?php

namespace App\Repositories;

use App\Enums\MeetingStatus;
use App\Helpers\ArrHelper;
use App\Helpers\SysHelper;
use App\Http\Resources\Media as MediaResource;
use App\Http\Resources\MediaCollection;
use App\Models\Meeting;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class MeetingRecordingRepository
{
    protected $meeting;

    /**
     * Instantiate a new instance
     * @return void
     */
    public function __construct(
        Meeting $meeting
    ) {
        $this->meeting = $meeting;
    }

    /**
     * Take recording of meeting
     *
     * @param Meeting $meeting
     */
    public function storeRecording(Meeting $meeting) : ?MediaResource
    {
        $config = $meeting->getMeta('config');

        if (! Arr::get($config, 'can_record', config('config.meeting.can_record'))) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }

        $meeting->isAccessible(true);

        if (request()->boolean('chunk')) {
            return $this->addChunkRecordingToMeeting($meeting);
        }

        $extension = request()->file('file')->getClientOriginalExtension();

        if (! in_array($extension, ['webm'])) {
            throw ValidationException::withMessages(['message' => trans('upload.invalid_extension', ['attribute' => $extension])]);
        }

        return $this->addRecordingToMeeting($meeting);
    }

    private function addRecordingToMeeting(Meeting $meeting) : MediaResource
    {
        $media = $meeting
            ->addMediaFromRequest('file')
            ->sanitizingFileName(function ($fileName) {
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
            })->toMediaCollection('recordings');

        return new MediaResource($media);
    }

    private function addChunkRecordingToMeeting(Meeting $meeting) : void
    {
        if (! request()->hasFile('file')) {
            return;
        }

        $tmp_name = $_FILES['file']['tmp_name'];
        $uuid = request('request_uuid');
        $order = request('order');
        $directory = 'uploads/chunks/' . $uuid;

        if (! \Storage::exists($directory)) {
            \Storage::makeDirectory($directory);
        }

        move_uploaded_file($tmp_name, storage_path('app/' . $directory . '/' . $order));

        $meta = $meeting->meta;
        $chunk_recordings = $meeting->getMeta('chunk_recordings') ?? [];
        if (! in_array($uuid, $chunk_recordings)) {
            array_push($chunk_recordings, $uuid);
            $meta['chunk_recordings'] = $chunk_recordings;
            $meeting->meta = $meta;
            $meeting->save();
        }
    }

    /**
     * Get recordings of meeting
     *
     * @param Meeting $meeting
     */
    public function getRecordings(Meeting $meeting) : MediaCollection
    {
        $meeting->shouldEnd();

        $this->generateRecordingFromChunks($meeting);

        $meeting->fresh();

        return new MediaCollection($meeting->getMedia('recordings'));
    }

    /**
     * Generate recording from chunk files
     *
     * @param Meeting $meeting
     */
    private function generateRecordingFromChunks(Meeting $meeting) : void
    {
        if ($meeting->getMeta('status') != MeetingStatus::ENDED) {
            return;
        }

        $chunk_recordings = $meeting->getMeta('chunk_recordings') ?? [];

        foreach ($chunk_recordings as $chunk_recording) {
            $directory = storage_path('app/uploads/chunks/' . $chunk_recording);
            $files = SysHelper::getFilesByName($directory) ?? [];
            $filename = $directory . '/recording-'.strtotime(now()).'.webm';
            foreach ($files as $file) {
                file_put_contents($filename, file_get_contents($directory . '/' . $file), FILE_APPEND);
            }

            $chunk_recordings = ArrHelper::removeByValue($chunk_recordings, $chunk_recording);
            $meta = $meeting->meta;
            $meta['chunk_recordings'] = $chunk_recordings;
            $meeting->meta = $meta;
            $meeting->save();

            $meeting->addMedia($filename)->preservingOriginal()->toMediaCollection('recordings');
            \Storage::deleteDirectory('uploads/chunks/' . $chunk_recording);
        }
    }

    /**
     * Delete recording from meeting
     *
     * @param Meeting $meeting
     * @param string $uuid
     */
    public function deleteRecording(Meeting $meeting, $uuid) : void
    {
        $media = $meeting->getMedia('recordings')->where('uuid', $uuid)->first();

        if ($media) {
            $media->delete();
        }
    }
}
