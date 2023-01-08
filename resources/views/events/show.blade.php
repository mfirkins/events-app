@extends('layouts.app')

<style>
    #event-detail-image {
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("storage/images/event_pictures/{{ $event->image_name }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: 50%;

    }

    #event-details {
        text-align: center;
        top: 50%;
        left: 50%;
        color: white;
        min-height: 50vh;
        width: 100vw;
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

    .card-deck {
        display: inline-block;
    }

    p {
        font-size: 14pt;
    }
</style>


@section('title', 'Event Details')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="event-detail-image-box" class="d-flex flex-column min-vh-50 justify-content-center align-items-center">
        <div id="event-detail-image">
            <div id="event-details" class="d-flex flex-column align-items-center justify-content-center">
                <h1>{{ $event->name }}</h1>
                <h2>City: {{ $event->venue->city }}</h2>
                <h3>Host: {{ $event->host }}</h3>
                @if (Auth::check() and
                    (Auth::user() == $event->profile->user or Auth::user()->hasRole(['Admin', 'Verified Venue'])))
                    <a class="btn btn-contrast text-white" href="/{{ $event->id }}/edit"> Edit Event </a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <br>
                        <button class="btn btn-danger text-white" type="submit">Delete Event</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div id="details">
        <div class="container-fluid mb-4">
            <div class="card-group">
                <x-indicator-card colour="linear-gradient(45deg, #087bff, #479dff)" icon="bi bi-brush" header="Created by">
                    <a style="color: white"href='/profiles/{{ $event->profile->id }}'>{{ $event->profile->user->name }}</a>
                </x-indicator-card>
                @if ($event->venue->accessible == 0)
                    <x-indicator-card colour="linear-gradient(45deg, rgba(148,20,20,1) 24%, rgba(255,0,0,1) 100%);"
                        icon="bi bi-universal-access-circle" header="Accessibility">
                        Not Available
                    </x-indicator-card>
                @else
                    <x-indicator-card colour="linear-gradient(45deg, rgba(20,148,48,1) 24%, rgba(0,255,4,1) 100%);"
                        icon="bi bi-universal-access-circle" header="Accessibility">
                        Available
                    </x-indicator-card>
                @endif

                <x-indicator-card colour="linear-gradient(45deg, rgba(127,20,148,1) 24%, rgba(226,0,255,1) 100%);"
                    icon="bi bi-buildings" header="City">
                    {{ $event->venue->city }}
                </x-indicator-card>
            </div>
        </div>
        <br>
        <div>
            <h3 class="h3">Event Details</h3>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <button class="nav-link active" id="comments-tab" data-bs-toggle="tab"
                        data-bs-target="#comments-tab-pane" type="button" role="tab" aria-controls="comments-tab-pane"
                        aria-selected="true">Comments</button>

                </li>
                <li class="nav-item">
                    <button class="nav-link" id="description-tab" data-bs-toggle="tab"
                        data-bs-target="#description-tab-pane" type="button" role="tab"
                        aria-controls="description-tab-pane" aria-selected="true">Description</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets-tab-pane"
                        type="button" role="tab" aria-controls="tickets-tab-pane" aria-selected="true">Tickets</button>

                </li>
                <li class="nav-item">
                    <button class="nav-link" id="venue-tab" data-bs-toggle="tab" data-bs-target="#venue-tab-pane"
                        type="button" role="tab" aria-controls="venue-tab-pane" aria-selected="true">Venue</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="description-tab-pane" role="tabpanel" aria-labelledby="description-tab"
                    tabindex="0">

                    <p>
                        {{ $event->description }}
                    </p>
                </div>
                <div class="p-2 tab-pane fade" id="tickets-tab-pane" role="tabpanel" aria-labelledby="tickets-tab"
                    tabindex="0">
                    <h5><b>Available Tickets:</b> {{ $event->tickets }} </h5>
                    <h5><b>Price:</b> £{{ $event->cost }}</h5>
                    <button type="button" class="btn bg-secondary">Buy Tickets</button>
                </div>
                <div class="tab-pane fade" id="venue-tab-pane" role="tabpanel" aria-labelledby="venue-tab" tabindex="0">
                    <br>
                    <a href="/venues/{{ $event->venue->id }}">
                        <h4>{{ $event->venue->name }}</h4>
                    </a>
                    <p>{{ $event->venue->description }}</p>
                    <br>
                    <h4>Location</h4>
                    <div class="iframe-rwd">
                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0"
                            marginwidth="0"
                            src="https://maps.google.com/maps?q={{ $event->venue->latitude }},{{ $event->venue->longitude }}&output=embed"></iframe>>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="comments-tab-pane" role="tabpanel" aria-labelledby="comments-tab"
                    tabindex="0">
                    <div class="row d-flex justify-content-center">
                        <div id="error-msg-container">

                        </div>

                        @if (Auth::check())
                            <br>
                            <form id="comment-form" method="post" data-url="{{ route('comments.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input id="comment-content" type="text" name="content"
                                    placeholder="+ Add a new comment" class="form-control">
                                <input type="hidden" id='event_id' value={{ $event->id }}>
                                <br>
                                <button id="comment-submit" class="btn btn-contrast text-white" type="submit">Post
                                    Comment</button>
                            </form>
                        @else
                            <br>
                            <form id="comment-form" data-url="{{ route('comments.store') }}" method="post"
                                enctype="multipart/form-data">
                                <p> You need to log in to be able to comment </p>
                                <input id="comment-content" type="text" name="content"
                                    placeholder="+ Add a new comment" class="form-control" disabled>
                                <input type="hidden" id='event_id' value={{ $event->id }}>
                                <br>
                                <button id="comment-submit" class="btn btn-contrast text-white" type="submit"
                                    disabled>Post
                                    Comment</button>
                            </form>
                        @endif
                        <div class="container-fluid mb-4">
                            <div class="card-group">
                                @foreach ($comments as $comment)
                                    <div class="col mt-4">
                                        <div class="card shadow-lg p-1 mx-auto">
                                            <div class="card-body">
                                                <p>{{ $comment->content }}</p>
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <img src="/storage/images/profile_pictures/{{ $comment->profile->image_name }}"
                                                            alt="avatar" width="25" height="25" />
                                                        <a href="/profiles/{{ $comment->profile->id }}"
                                                            class="small mb-0 ms-2">{{ $comment->profile->user->name }}
                                                        </a>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        @if (Auth::check() and (Auth::user()->id == $comment->profile->user->id or Auth::user()->hasRole('Admin')))
                                                            <form id="comment-delete" method="POST"
                                                                data-url="{{ route('comments.destroy', $comment->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button style="margin-right: 5px;" type="submit"
                                                                    class="btn btn-danger text-card-bg"><i
                                                                        class="bi bi-trash"></i></button>
                                                                <a href="{{ route('comments.edit', $comment->id) }}"
                                                                    style="margin-right: 5px;" type="button"
                                                                    class="btn btn-contrast-2 text-card-bg"><i
                                                                        class="bi bi-pencil"></i></a>

                                                            </form>
                                                        @endif
                                                        <form method="POST" action="{{ route('comments.liked') }}">
                                                            @csrf
                                                            <input type="hidden" name="comment_id"
                                                                value="{{ $comment->id }}">
                                                            <button type="submit" class="btn btn-contrast"><i
                                                                    class="bi bi-hand-thumbs-up text-white"></i></button>
                                                        </form>
                                                        <p class="small text-muted mb-0">{{ $comment->likes }}
                                                            likes</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ $comments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#comment-form").on('submit', function(submitEvent) {
                submitEvent.preventDefault();

                var content = $("#comment-content").val();
                var event_id = $("#event_id").val();

                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $('#comment-form').attr('data-url'),
                    data: {
                        content: content,
                        event_id: event_id
                    },
                    success: function(data) {
                        if (!$.isEmptyObject(data.error)) {
                            printErrorMsg(data.error);
                        }
                        location.reload();
                    }
                });

            });

            $("#comment-delete").on('submit', function(submitEvent) {
                submitEvent.preventDefault();

                var comment_id = $("#comment_id").val();

                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $('#comment-delete').attr('data-url'),
                    data: {
                        comment_id: comment_id,
                    },
                    success: function(data) {
                        if (!$.isEmptyObject(data.error)) {
                            printErrorMsg(data.error);
                        }
                        location.reload();
                    }
                });

            });

            function printErrorMsg(msg) {
                $("#error-msg-container").html(
                    '<div id="error-msg" class="alert alert-danger fade show" role="alert"><i class="bi bi-exclamation-triangle-fill"></i><b> Houston. We have a problem</b><ui></ui></div>'
                );
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $("#error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        </script>
    @endsection
