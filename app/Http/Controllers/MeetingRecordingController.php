<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Repositories\MeetingRecordingRepository;

class MeetingRecordingController extends Controller
{
    protected $repo;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        MeetingRecordingRepository $repo
    ) {
        $this->repo = $repo;
    }

    /**
     * Take recording of meeting
     * @post ("/api/meetings/{uuid}/recordings")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function storeRecording(Meeting $meeting)
    {
        $this->authorize('list', Meeting::class);

        $media = $this->repo->storeRecording($meeting);

        return $this->ok($media);
    }

    /**
     * Get recordings of meeting
     * @post ("/api/meetings/{uuid}/recordings")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function getRecordings(Meeting $meeting)
    {
        $this->authorize('list', Meeting::class);

        $meeting->isAccessible();

        return $this->ok($this->repo->getRecordings($meeting));
    }

    /**
     * Delete recording from meeting
     * @post ("/api/meetings/{uuid}/recordings/{uuid}")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function deleteRecording(Meeting $meeting, $uuid)
    {
        $this->authorize('list', Meeting::class);

        $meeting->isAccessible(true);

        $this->repo->deleteRecording($meeting, $uuid);

        return $this->success(['message' => __('global.updated', ['attribute' => __('meeting.meeting')])]);
    }
}
