

<x-layouts.master>
    <x-slot name="title">
        {{$title ?? 'Events' }}
    </x-slot>

    <x-layouts.header activePage="event" />

    <x-layouts.subheader heading="Events" />

    <main id="main">

        <div class="container">

            @if ($upcomingEvents->count())
                <h2 class="my-5 text-center">Upcoming Events</h2>
            @endif

            @foreach($upcomingEvents as $upcomingEvent)
                {{-- {{ dd($upcomingEvent->meta) }} --}}
                <div class="event-container">
                    @if ($upcomingEvent->meta && isset($upcomingEvent->meta['cover_image']))
                        <a href="{{url('events/' . Str::slug($upcomingEvent->title) . '/' . $upcomingEvent->getMeta('event_uuid'))}}" class="event-cover-image" style="text-indent: -99999px; background-image: url({{$upcomingEvent->meta['cover_image']}})">EVENT</a>
                    @else
                        <a href="{{url('events/' . Str::slug($upcomingEvent->title) . '/' . $upcomingEvent->getMeta('event_uuid'))}}" class="event-cover-image">EVENT</a>
                    @endif

                    <div class="event-details">
                        <div class="event-header">
                            <a href="{{url('events/' . Str::slug($upcomingEvent->title) . '/' . $upcomingEvent->getMeta('event_uuid'))}}" class="event-title">{{$upcomingEvent->title}}</a>
                        </div>

                        <p class="event-agenda">{{Str::limit($upcomingEvent->agenda, 200)}}</p>

                        <div class="event-footer">

                            <div class="event-meta">
                                <div class="schedule">
                                    <i class="fas fa-calendar"></i>
                                    <span>Scheduled on: </span>
                                    <span>{{App\Helpers\CalHelper::showDateTime($upcomingEvent->start_date_time)}} ({{$upcomingEvent->diff_for_human}})</span>
                                </div>

                                <div class="schedule">
                                    <i class="fas fa-clock"></i>
                                    <span>Duration: </span>
                                    <span>{{$upcomingEvent->period}} Minute(s)</span>
                                </div>
                            </div>

                            <div class="event-cta">
                                <a href="{{url('events/' . Str::slug($upcomingEvent->title) . '/' . $upcomingEvent->getMeta('event_uuid'))}}">Show Event</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

            @if ($recentEvents->count())
                <h2 class="my-5 text-center">Recently Concluded Events</h2>
            @endif

            @foreach($recentEvents as $recentEvent)
                <div>
                    <a href="{{url('events/' . Str::slug($recentEvent->title) . '/' . $recentEvent->getMeta('event_uuid'))}}">{{$recentEvent->title}}</a>
                </div>
            @endforeach
        </div>

    </main><!-- End #main -->

    <x-layouts.footer />

</x-layouts.master>
