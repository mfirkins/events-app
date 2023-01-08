@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
@section('page-name', $category->name)
@section('content')
    <div class="container-fluid mb-4">
        @if (Auth::check())
            @if (Auth::user()->hasRole('Admin'))
                <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button style="margin-bottom: 5px;"type="submit"
                        class="btn btn-danger text-card-bg">Delete
                        Category</button>
                </form>
                <a class="btn btn-contrast-2 text-card-bg" style="margin-right: 5px" href="{{ route('categories.edit', $category->id) }}">Edit
                    Category</a>
            @endif
        @endif
        <div class="card-group">
            @foreach ($events->sortBy('time') as $event)
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
    {{ $events->links() }}
@endsection

</html>
