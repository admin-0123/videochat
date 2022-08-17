<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Repositories\MeetingSnapshotRepository;

class MeetingSnapshotController extends Controller
{
    protected $repo;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        MeetingSnapshotRepository $repo
    ) {
        $this->repo = $repo;
    }

    /**
     * Take snapshot of meeting
     * @post ("/api/meetings/{uuid}/snapshots")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function addSnapshot(Meeting $meeting)
    {
        $this->authorize('list', Meeting::class);

        $media = $this->repo->addSnapshot($meeting);

        return $this->ok($media);
    }

    /**
     * Get snapshots of meeting
     * @post ("/api/meetings/{uuid}/snapshots")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function getSnapshots(Meeting $meeting)
    {
        $this->authorize('list', Meeting::class);

        $meeting->isAccessible();

        return $this->ok($this->repo->getSnapshots($meeting));
    }

    /**
     * Delete snapshot from meeting
     * @post ("/api/meetings/{uuid}/snapshots/{uuid}")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function deleteSnapshot(Meeting $meeting, $uuid)
    {
        $this->authorize('list', Meeting::class);

        $meeting->isAccessible(true);

        $this->repo->deleteSnapshot($meeting, $uuid);

        return $this->success(['message' => __('global.updated', ['attribute' => __('meeting.meeting')])]);
    }
}
