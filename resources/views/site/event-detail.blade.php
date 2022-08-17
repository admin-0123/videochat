<x-layouts.master>
    <x-slot name="title">
        {{$title ?? 'Event' }}
    </x-slot>

    <x-layouts.header activePage="event" />

    <x-layouts.subheader heading="{!! $event->title !!}" />

    <main id="main">

        <div class="container event">
            <div class="my-4">

                @if ($event->getMeta('cover_image'))
                    <div class="event-cover-image">
                        <img class="img-fluid" src="{{url($event->getMeta('cover_image'))}}" />
                    </div>
                @endif

                <div class="event-meta">
                    <div class="schedule">
                        <i class="fas fa-calendar"></i>
                        <span>Scheduled on: </span>
                        <span>{{App\Helpers\CalHelper::showDateTime($event->start_date_time)}} ({{$event->diff_for_human}})</span>
                    </div>

                    <div class="schedule">
                        <i class="fas fa-clock"></i>
                        <span>Duration: </span>
                        <span>{{$event->period}} Minute(s)</span>
                    </div>
                </div>

                <p class="event-agenda">{{$event->agenda}}</p>

                <div class="event-descripiton">{!!$event->description!!}</div>

            </div>
        </div>

        @livewire('event-registration')

    </main><!-- End #main -->

    <x-layouts.footer />

</x-layouts.master>
