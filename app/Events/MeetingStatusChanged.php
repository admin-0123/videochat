<?php

namespace App\Events;

use App\Helpers\CalHelper;
use App\Models\Meeting;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MeetingStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $meeting;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Meeting $meeting)
    {
        $this->meeting = $meeting;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('Meeting.'.$this->meeting->uuid);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    // public function broadcastAs()
    // {
    //     return 'server.created';
    // }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'uuid'                    => $this->meeting->uuid,
            'status'                  => $this->meeting->getMeta('status'),
            'delayed'                 => $this->meeting->getMeta('snoozed_logs') ? true : false,
            'updated'                 => true,
            'startDateTime'           => CalHelper::toDateTime($this->meeting->start_date_time),
            'plannedStartDateTime'    => $this->meeting->planned_start_date_time ? CalHelper::toDateTime($this->meeting->planned_start_date_time) : null,
            'startedAt'               => $this->meeting->getMeta('started_at') ? CalHelper::toDateTime($this->meeting->getMeta('started_at')) : null,
            'endedAt'                 => $this->meeting->getMeta('ended_at') ? CalHelper::toDateTime($this->meeting->getMeta('ended_at')) : null,
            'estimatedEndTime'        => $this->meeting->getMeta('estimated_end_time') ? CalHelper::toDateTime($this->meeting->getMeta('estimated_end_time')) : null,
            'roomId'                  => $this->meeting->getMeta('room_id')
        ];
    }
}
