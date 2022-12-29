@extends('layouts.app')

<style>
    #event-detail-image {
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("{{ $event->image_path }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: 50%;

    }

    #event-details {
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
    <div id="event-detail-image" class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
        <div id="event-details">
            <h1>{{ $event->name }}</h1>
            <h3>City: {{ $event->venue->city }}</h2>
                <h3>Host: {{ $event->host }}</h2>
        </div>
    </div>
    <div id="details">
        <br>
        <h3 class="h3">Event Details</h3>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                    data-bs-target="#description-tab-pane" type="button" role="tab"
                    aria-controls="description-tab-pane" aria-selected="true">Description</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets-tab-pane"
                    type="button" role="tab" aria-controls="tickets-tab-pane" aria-selected="true">Tickets</button>

            </li>
            <li class="nav-item">
                <button class="nav-link" id="venue-tab" data-bs-toggle="tab" data-bs-target="#venue-tab-pane" type="button"
                    role="tab" aria-controls="venue-tab-pane" aria-selected="true">Venue</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments-tab-pane"
                    type="button" role="tab" aria-controls="comments-tab-pane" aria-selected="true">Comments</button>

            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                aria-labelledby="description-tab" tabindex="0">
                <p>
                    {{ $event->description }}
                </p>
            </div>
            <div class="p-2 tab-pane fade" id="tickets-tab-pane" role="tabpanel" aria-labelledby="tickets-tab"
                tabindex="0">
                <h5>Available Tickets: {{ $event->tickets }}</h5>
                <h5>Price: £{{ $event->cost }}</h5>
                <button type="button" class="btn bg-secondary">Buy Tickets</button>
            </div>
            <div class="tab-pane fade" id="venue-tab-pane" role="tabpanel" aria-labelledby="venue-tab" tabindex="0">
                <br>
                <h4>{{ $event->venue->name }}</h4>
                <p>{{ $event->venue->description }}</p>
                <h5> Accessible:
                    @if ($event->venue->accessible == 0)
                        Not Available
                    @else
                        Available
                    @endif

                </h5>
                <h4>Location</h4>
                <div class="iframe-rwd">
                    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?q={{ $event->venue->latitude }},{{ $event->venue->longitude }}&output=embed"></iframe>>
                </div>
            </div>

            <div class="tab-pane fade" id="comments-tab-pane" role="tabpanel" aria-labelledby="comments-tab" tabindex="0">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        @foreach ($event->comments as $comment)
                            <div class="card mb-4">
                                <div class="card-body">
                                    <p>{{ $comment->content }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-row align-items-center">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(4).webp"
                                                alt="avatar" width="25" height="25" />
                                            <p class="small mb-0 ms-2">{{ $comment->user->name }}</p>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <p class="small text-muted mb-0">Upvote?</p>
                                            <i class="far fa-thumbs-up mx-2 fa-xs text-black"
                                                style="margin-top: -0.16rem;"></i>
                                            <p class="small text-muted mb-0">{{ $comment->likes }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endsection
