@extends('layouts.app')

@section('title', 'All Events')
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
@section('page-name', 'All Events')
@section('content')
    <div class="container-fluid mb-4">
        <div class="card-group">
            @foreach ($events->sortBy('time') as $event)
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
@endsection
