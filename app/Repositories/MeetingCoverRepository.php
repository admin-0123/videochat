<?php

namespace App\Repositories;

use App\Http\Resources\Meeting as MeetingResource;
use App\Models\Meeting;

class MeetingCoverRepository
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
     * Upload cover
     */
    public function upload(Meeting $meeting) : MeetingResource
    {
        request()->validate([
            'file' => 'required|image'
        ]);

        $cover_image = str_replace('/storage/', '', $meeting->getMeta('cover_image'));

        if ($cover_image && \Storage::disk('public')->exists($cover_image)) {
            \Storage::disk('public')->delete($cover_image);
        }

        $file = \Storage::disk('public')->putFile('meeting-cover-image', request()->file('file'));
        $meta = $meeting->meta;
        $meta['cover_image'] = '/storage/'.$file;
        $meeting->meta = $meta;
        $meeting->save();

        return new MeetingResource($meeting);
    }

    /**
     * Remove cover
     */
    public function remove(Meeting $meeting)
    {
        if (! $meeting->getMeta('cover_image')) {
            return;
        }

        $cover_image = str_replace('/storage/', '', $meeting->getMeta('cover_image'));

        if (\Storage::disk('public')->exists($cover_image)) {
            \Storage::disk('public')->delete($cover_image);
        }

        $meta = $meeting->meta;
        $meta['cover_image'] = null;
        $meeting->meta = $meta;
        $meeting->save();

        return new MeetingResource($meeting);
    }
}
