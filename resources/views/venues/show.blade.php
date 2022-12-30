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
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
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
    <div id="venue-detail-image" class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
        <div id="venue-details">
            <h1>{{ $venue->name }}</h1>
            <h5>{{ $venue->description }}</h5>
        </div>
    </div>
    <div id="details">
        <div class="container-fluid mb-4">
            <div class="card-group">
                @if ($venue->accessible == 0)
                    <div class="col mt-4">
                        <div class="shadow-lg p-1 card bg-danger mx-auto" style="width: 18rem;">
                            <div class="card-header text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-universal-access" viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM6 5.5l-4.535-.442A.531.531 0 0 1 1.531 4H14.47a.531.531 0 0 1 .066 1.058L10 5.5V9l.452 6.42a.535.535 0 0 1-1.053.174L8.243 9.97c-.064-.252-.422-.252-.486 0l-1.156 5.624a.535.535 0 0 1-1.053-.174L6 9V5.5Z" />
                                </svg>
                                Not Accessible
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col mt-4">
                        <div class="shadow-lg p-1 card bg-contrast mx-auto" style="width: 18rem;">
                            <div class="card-header text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-universal-access" viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0ZM6 5.5l-4.535-.442A.531.531 0 0 1 1.531 4H14.47a.531.531 0 0 1 .066 1.058L10 5.5V9l.452 6.42a.535.535 0 0 1-1.053.174L8.243 9.97c-.064-.252-.422-.252-.486 0l-1.156 5.624a.535.535 0 0 1-1.053-.174L6 9V5.5Z" />
                                </svg>
                                Accessible
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col mt-4">
                    <div class="p-1 card bg-contrast-2 mx-auto" style="width: 18rem;">
                        <div class="card-header text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                class="bi bi-buildings" viewBox="0 0 16 16">
                                <path
                                    d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z" />
                                <path
                                    d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z" />
                            </svg>
                            {{ $venue->city }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <h3 class="h3">Upcoming Events</h3>
        <div class="container-fluid mb-4">
            <div class="card-group">
                @foreach ($venue->events->sortBy('time')->take(5) as $event)
                    <div class="col mt-4">
                        <div class="shadow-lg p-1 card bg-light mx-auto" style="width: 18rem;">
                            <img src="/storage/images/event_pictures/{{ $event->image_name }}" class="card-img-top" alt="event description">
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
@endsection
