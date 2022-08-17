<?php

namespace App\Repositories;

use App\Http\Resources\Media as MediaResource;
use App\Http\Resources\MediaCollection;
use App\Models\Meeting;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class MeetingSnapshotRepository
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
     * Take snapshot of meeting
     *
     * @param Meeting $meeting
     */
    public function addSnapshot(Meeting $meeting) : MediaResource
    {
        $config = $meeting->getMeta('config');

        if (! Arr::get($config, 'can_take_snapshot', config('config.meeting.can_take_snapshot'))) {
            throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        }

        $anyone_can_take_snapshot = Arr::get($config, 'anyone_can_take_snapshot', config('config.meeting.anyone_can_take_snapshot'));

        if ($anyone_can_take_snapshot) {
            return $this->addSnapshotToMeeting($meeting);
        }

        // if ($meeting->getMeta('is_pam')) {
        //     throw ValidationException::withMessages(['message' => trans('general.invalid_action')]);
        // }

        $meeting->isAccessible(true);

        return $this->addSnapshotToMeeting($meeting);
    }

    private function addSnapshotToMeeting(Meeting $meeting) : MediaResource
    {
        $media_name = request('name', '') . ' ' . date("YmdHis", time());
        $media = $meeting
            ->addMediaFromBase64(request('image'), ['image/png'])
            ->sanitizingFileName(function ($fileName) use ($media_name) {
                $new_file_name = $media_name . '-' . $fileName;
                return strtolower(str_replace(['#', '/', '\\', ' '], '-', $new_file_name.'.png'));
            })->usingName($media_name)->toMediaCollection('snapshots');

        return new MediaResource($media);
    }

    /**
     * Get snapshots of meeting
     *
     * @param Meeting $meeting
     */
    public function getSnapshots(Meeting $meeting) : MediaCollection
    {
        return new MediaCollection($meeting->getMedia('snapshots'));
    }

    /**
     * Delete snapshot from meeting
     *
     * @param Meeting $meeting
     * @param string $uuid
     */
    public function deleteSnapshot(Meeting $meeting, $uuid) : void
    {
        $media = $meeting->getMedia('snapshots')->where('uuid', $uuid)->first();

        if ($media) {
            $media->delete();
        }
    }
}
