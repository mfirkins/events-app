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
        <br>
        <h3 class="h3">Upcoming Events</h3>
        <div class="container-fluid mb-4">
            <div class="card-group">
                @foreach ($venue->events->sortBy('time')->take(10) as $event)
                <div class="col mt-4">
                    <div class="shadow-lg p-1 card bg-light mx-auto" style="width: 18rem;">
                        <img src="{{ $event->image_path }}" class="card-img-top" alt="event description">
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
    </div>
@endsection
