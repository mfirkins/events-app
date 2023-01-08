@extends('layouts.app')

@section('title', 'Edit Event')
@section('page-name', 'Edit an Event')

@section('content')

    <x-form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
        <div class="row form-group">
            <h2 class="text-white">General</h2>

            <br>
            <label for="eventName">Event Name</label>
            <input type="text" class="form-control" value="{{ $event->name }}" id="eventName" placeholder="My Amazing Event"
                name="name">
            <br>
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="6" name="description">{{ $event->description }}</textarea>
        </div>
        <hr class="text-white">
        <div class="row form-group">
            <h2 class="text-white">Tickets</h2>
            <div class="column">
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" value="{{ $event->tickets }}" name="amount">
            </div>
            <div class="column">
                <label for="cost">Cost</label>
                <input type="text" class="form-control" value="{{ $event->cost }}" id="cost" placeholder="50.00"
                    name="cost">
            </div>
        </div>
        <button style="margin-top: 10px;"class="btn btn-contrast text-white" type="submit"><i class="bi bi-check-lg"></i>
            Update Event </button>

    </x-form>


@endsection
