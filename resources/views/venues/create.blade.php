@extends('layouts.app')

@section('page-name', 'Create a Venue')
@section('content')

    <x-form method="POST" action="/venues/store">
        <div class="row form-group">
            <div class="column">
                <br>
                <label for="eventName">Venue Name</label>
                <input type="text" class="form-control" id="eventName" placeholder="My Amazing Event">
                <br>
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="6"></textarea>

            </div>
            <div class="column">
                <br>
                <label for="category">Accessible</label>
                <select class="form-control" id="category">
                    <option>
                        Available
                    </option>
                    <option>
                        Unavailable
                    </option>
                </select>
                <br>
                <label for="image">Image</label>
                <input id="image" type="file" class="form-control" name="image">
                <br>
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="Some Cool City">
                <br>
                <div class="column">
                    <label for="eventName">Longitude</label>
                    <input type="text" class="form-control" id="city" placeholder="53.7654">
                </div>
                <div class="column">
                    <label for="eventName">Latitude</label>
                    <input type="text" class="form-control" id="city" placeholder="-1.67839">
                </div>
            </div>
        </div>
        <br>
        <button class="btn btn-contrast text-white" type="button"> Create Venue </button>
    </x-form>
@endsection
