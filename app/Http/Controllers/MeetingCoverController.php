<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Repositories\MeetingCoverRepository;

class MeetingCoverController extends Controller
{
    protected $repo;

    /**
     * Instantiate a new controller instance
     * @return void
     */
    public function __construct(
        MeetingCoverRepository $repo
    ) {
        $this->repo = $repo;
    }

    /**
     * Upload cover image of meeting
     * @post ("/api/meetings/{uuid}/cover")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function upload(Meeting $meeting)
    {
        $this->authorize('list', Meeting::class);

        $meeting->isAccessible(true);

        return $this->ok($this->repo->upload($meeting));
    }

    /**
     * Remove cover image of meeting
     * @delete ("/api/meetings/{uuid}/cover")
     * @param ({
     *      @Parameter("uuid", type="uuid", required="true", description="Meeting unique id"),
     * })
     * @return array
     */
    public function remove(Meeting $meeting)
    {
        $this->authorize('list', Meeting::class);

        $meeting->isAccessible(true);

        return $this->ok($this->repo->remove($meeting));
    }
}
