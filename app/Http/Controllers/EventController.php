<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Meeting::where('meta->has_event', true)->where('start_date_time', '>', now())->orderBy('start_date_time', 'asc')->get();

        $recentEvents = Meeting::where('meta->has_event', true)->where('start_date_time', '<', now())->orderBy('start_date_time', 'asc')->take(5)->get();

        return view('site.events', compact('upcomingEvents', 'recentEvents'));
    }

    public function show($slug, $uuid)
    {
        $event = Meeting::where('meta->has_event', true)->where('meta->event_uuid', $uuid)->first();

        if (! $event) {
            abort(404);
        }

        return view()->first(['site.custom-event.' . $event->getMeta('identifier'), 'site.event-detail'], compact('event'));
    }
}
