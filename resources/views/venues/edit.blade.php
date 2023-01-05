@extends('layouts.app')

@section('page-title', 'Edit Venue')

@section('content')

    <x-form method="POST" action="/venues" enctype="multipart/form-data">
        <div class="row form-group">
            <div class="column">
                <br>
                <label for="venueName">Venue Name</label>
                <input type="text" class="form-control" id="venueName" value="{{ $venue->name }}" placeholder="My Cool Venue"
                    name="name">
                <br>
                <label for="description">Description</label>
                <textarea class="form-control" id="description" value="{{ $venue->description }}" rows="6" name="description"></textarea>

            </div>
            <div class="column">
                <br>
                <label for="accessible">Accessible</label>
                <select class="form-control" id="accessible" value="{{ $venue->accessible }}" name="accessible">
                    <option>Available</option>
                    <option>Unavailable</option>
                </select>
                <br>
                <label for="image">Image</label>
                <input id="image" type="file" class="form-control" value="{{ $venue->image_name }}" name="image">
                <br>
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="Birmingham"
                    value="{{ $venue->city }}" name="city">
                <br>
                <div class="column">
                    <label for="long">Longitude</label>
                    <input type="text" class="form-control" id="long" placeholder="53.7654"
                        value="{{ $venue->longitude }}" name="longitude">
                </div>
                <div class="column">
                    <label for="lat">Latitude</label>
                    <input type="text" class="form-control" id="lat" placeholder="-1.67839"
                        value="{{ $venue->latitude }}" name="latitude">
                </div>
            </div>
        </div>
        <br>
        <button class="btn btn-contrast text-white" type="submit"> Update Venue </button>
    </x-form>

@endsection
