@extends('layouts.app')

@section('title', 'All Venues')
<style>
    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }

    #card-block {
        text-align: center;
    }
</style>
@section('page-name', 'All Venues')
@section('content')
    <div class="container-fluid mb-4">
        <div class="card-group">
            @foreach ($venues->sortBy('name') as $venue)
                <div class="col mt-4">
                    <div class="shadow-lg p-1 card bg-light mx-auto" style="width: 18rem;">
                        <img src="{{ asset("storage/images/venue_pictures/$venue->image_name") }}" class="card-img-top"
                            alt="event description">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{ $venue->name }}</b></h5>
                            <h6>City: <b>{{ $venue->city }}</b></h6>
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
@endsection
