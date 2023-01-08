@extends('layouts.app')
<style>
    #image {
        margin-top: 10pt;
        margin-left: 10pt;
        height: 200px;
        width: auto;
        background-color: white;
    }

    #stats {

        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
        border: 2px solid #ffffff;
        border-radius: 1rem;
        padding-left: 50px;
        padding-right: 50px;
        padding-top: 20px;
        padding-bottom: 20px;
        margin: 10pt;
    }

    #column-left {
        float: left;
        width: 20%;
        justify-content: center;
        align-items: center;
    }

    #column-right {
        float: left;
        width: 80%;
        justify-content: center;
        align-items: center;
    }

    #remove-btn {
        margin-top: 10pt;
        margin-left: 10pt;
    }



    h2 {
        color: white;
    }
</style>

@section('title', "{{ $profile->name }}")


@section('content')
    <h1 class="text-center text-white">{{ $profile->user->name }}'s Profile</h1>
    <div id="container">
        <div id="stats" class="row align-items-center">
            <div id="column-left" class="col-lg-6 align-items-center">
                <img id="image" class="rounded"
                    src="{{ asset('storage/images/profile_pictures/' . $profile->image_name) }}" />
                @if (Auth::check())
                @endif
                @if (Auth::user()->hasRole('Admin'))
                    {
                    <a id="remove-btn" class="btn btn-contrast-3 text-card-bg" style="margin-right: 5px"
                        href="{{ route('users.index') }}">Manage Users</a>
                    }
                @endif
                @if (Auth::user()->hasRole('Admin') or Auth::user()->profile->id == $profile->id)
                    <a id="remove-btn" class="btn btn-contrast-2 text-card-bg" style="margin-right: 5px"
                        href="{{ route('profiles.edit', $profile->id) }}">Edit Profile</a>
                    <form method="POST" action="/users/{{ $profile->user->id }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button style="margin-left: 13px; margin-top: 10px;"type="submit"
                            class="btn btn-danger text-card-bg">Delete
                            Profile</button>
                    </form>
                @endif
                <span style="margin-left: 13px;" class='bg-contrast text-white'> Roles:

                    @foreach ($profile->user->getRoleNames() as $role)
                        {{ $role }},
                    @endforeach
                </span>
            </div>
            <div id="column-right" class="col-lg-6 align-items-center">
                <div class="card-group">
                    <x-IndicatorCard icon="bi bi-calendar2-event" header="Events"
                        colour="linear-gradient(45deg, rgba(148,97,20,1) 24%, rgba(255,154,0,1) 100%);">
                        @if ($profile->events->count() == null)
                            0
                        @else
                            {{ $profile->events->count() }}
                        @endif
                    </x-IndicatorCard>
                    <x-IndicatorCard icon="bi bi-building" header="Venues"
                        colour="linear-gradient(45deg, rgba(148,20,111,1) 24%, rgba(255,0,202,1) 100%);">
                        @if ($profile->venues->count() == null)
                            0
                        @else
                            {{ $profile->venues->count() }}
                        @endif
                    </x-IndicatorCard>
                    <x-IndicatorCard icon="bi bi-chat-dots" header="Comments"
                        colour="linear-gradient(45deg, rgba(20,117,148,1) 24%, rgba(0,202,255,1) 100%);">
                        @if ($profile->comments->count() == null)
                            0
                        @else
                            {{ $profile->comments->count() }}
                        @endif
                    </x-IndicatorCard>
                    <x-IndicatorCard icon="bi bi-tags" header="Categories"
                        colour="linear-gradient(45deg, rgba(20,148,20,1) 24%, rgba(0,255,59,1) 100%);">
                        @if ($profile->categories->count() == null)
                            0
                        @else
                            {{ $profile->categories->count() }}
                        @endif
                    </x-IndicatorCard>
                </div>
            </div>
        </div>
        <div id="stats" class="row align-items-center">
            <h2> {{ $profile->user->name }}'s Events </h2>
            <div class="container-fluid mb-4">
                <div class="card-group">
                    @foreach ($events as $event)
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
                    {{ $events->links() }}
                </div>
            </div>
        </div>
        <div id="stats" class="row align-items-center">
            @if (Auth::check())
                <h2> {{ $profile->user->name }}'s Venues </h2>
                <div class="container-fluid mb-4">
                    <div class="card-group">
                        @foreach ($venues->sortBy('name') as $venue)
                            <div class="col mt-4">
                                <div class="shadow-lg p-1 card bg-light mx-auto" style="width: 18rem;">
                                    <img src="{{ asset("storage/images/venue_pictures/$venue->image_name") }}"
                                        class="card-img-top" alt="event description">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>{{ $venue->name }}</b></h5>
                                        <h6>City: <b>{{ $venue->name }}</b></h6>
                                        <h6>Accessibility: <b>
                                                @if ($venue->accessible == 0)
                                                    Not Available
                                                @else
                                                    Available
                                                @endif
                                            </b></h6>
                                        <a href="/venues/{{ $venue->id }}" class="btn btn-primary">Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $venues->links() }}
            @endif
        </div>
        <div id="stats" class="row align-items-center">
            <h2> {{ $profile->user->name }}'s Comments </h2>
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
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
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
    {{ $comments->links() }}
    </div>
    </div>
    <script>
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
