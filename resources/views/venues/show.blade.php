@extends('layouts.app')

<style>
    #venue-detail-image {
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("/storage/images/venue_pictures/{{ $venue->image_name }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: 50%;

    }

    #venue-details {
        text-align: center;
        top: 50%;
        left: 50%;
        color: white;
        min-height: 50vh;
    }

    .iframe-rwd {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
    }

    .iframe-rwd iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #details {
        background-color: white;
    }
</style>


@section('title', 'Event Details')

@section('content')
<div style="background-color: white">
    <div id="venue-detail-image" class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
        <div id="venue-details" class="d-flex flex-column align-items-center justify-content-center">
            <h1>{{ $venue->name }}</h1>
            <h5 class="w-75">{{ $venue->description }}</h5>
            @if (Auth::check() and (Auth::user() == $venue->profile->user or Auth::user()->hasRole('Admin')))
                <a class="btn btn-contrast text-white" href="/venues/{{ $venue->id }}/edit"> Edit Venue </a>
                <form action="{{ route('venues.destroy', $venue->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <br>
                    <button class="btn btn-danger text-white" type="submit">Delete Venue</button>
                </form>
            @endif
        </div>
    </div>
    <div id="details">
        <div class="container-fluid mb-4">
            <div class="card-group">
                <x-IndicatorCard colour="linear-gradient(45deg, #087bff, #479dff)" icon="bi bi-brush" header="Created by">
                    <a style="color: white"href='/profiles/{{ $venue->profile->id }}'>{{ $venue->profile->user->name }}</a>
                </x-IndicatorCard>
                @if ($venue->accessible == 0)
                    <x-IndicatorCard colour="linear-gradient(45deg, rgba(148,20,20,1) 24%, rgba(255,0,0,1) 100%);"
                        icon="bi bi-universal-access-circle" header="Accessibility">
                        Not Available
                    </x-IndicatorCard>
                @else
                    <x-IndicatorCard colour="linear-gradient(45deg, rgba(20,148,48,1) 24%, rgba(0,255,4,1) 100%);"
                        icon="bi bi-universal-access-circle" header="Accessibility">
                        Available
                    </x-IndicatorCard>
                @endif

                <x-IndicatorCard colour="linear-gradient(45deg, rgba(127,20,148,1) 24%, rgba(226,0,255,1) 100%);"
                    icon="bi bi-buildings" header="City">
                    {{ $venue->city }}
                </x-IndicatorCard>
            </div>
        </div>
    </div>
    <h3 class="h3">Upcoming Events</h3>
    <div class="container-fluid mb-4">
        <div class="card-group">
            @foreach ($venue->events->sortBy('time')->take(5) as $event)
                <div class="col mt-4">
                    <div class="shadow-lg p-1 card bg-light mx-auto" style="width: 18rem;">
                        <img src="/storage/images/event_pictures/{{ $event->image_name }}" class="card-img-top"
                            alt="event description">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $event->name }}</b></h5>
                            <h6>Date: <b>{{ Carbon\Carbon::parse($event->time)->toFormattedDateString() }}</b></h6>
                            <h6>Time: <b>{{ Carbon\Carbon::parse($event->time)->format('g:ia') }}</b></h6>
                            <h6>City: <b>{{ $event->venue->city }}</b></h6>
                            <h6>Cost: <b>£{{ $event->cost }}</b></h6>
                            <a href="/{{ $event->id }}" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <h3 class="h3">Location</h3>
    <div class="iframe-rwd">
        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
            src="https://maps.google.com/maps?q={{ $venue->latitude }},{{ $venue->longitude }}&output=embed"></iframe>>
    </div>
    </div>
</div>
@endsection
