@extends('layouts.app')

@section('page-name', 'Create an Event')
@section('content')



    <x-form method="POST" action="/store">

        <div class="row form-group">
            <h2 class="text-white">General</h2>
            <div class="column">
                <br>
                <label for="eventName">Event Name</label>
                <input type="text" class="form-control" id="eventName" placeholder="My Amazing Event" name="name">
                <br>
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="6" name="description"></textarea>

            </div>
            <div class="column">
                <br>
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category">
                    @foreach ($categories as $category)
                        <option>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <br>
                <label for="image">Image</label>
                <input id="image" type="file" class="form-control" name="image" name="image">
                <br>
                <label for="date">Date</label>
                <input id="date" class="form-control" type="date" />
                <br>
                <label for="time">Time</label>
                <input type="time" id="time" name="time">
            </div>
        </div>
        <hr class="text-white">
        <div class="row form-group">
            <h2 class="text-white">Venue</h2>
            <p> Select a venue or create your own! </p>
            <div class="column">
                <select class="form-control" id="category">
                    @foreach ($venues as $venue)
                        <option>
                            {{ $venue->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="column">
                <a class="btn btn-contrast text-white" href="/venues/create"> Create your own venue </a>
            </div>
        </div>
        <hr class="text-white">
        <div class="row form-group">
            <h2 class="text-white">Tickets</h2>
            <div class="column">
                <label for="eventName">Amount</label>
                <input type="text" class="form-control" id="city" placeholder="Some Cool City">
            </div>
            <div class="column">
                <label for="eventName">Cost</label>
                <input type="text" class="form-control" id="city" placeholder="50.00">
            </div>
        </div>
        <hr class="text-white">
        <div class="row form-group">
            <h2 class="text-white">Host/Organiser</h2>
            <br>
            <p> You can attach your user to an event or you can enter a custom host name </p>
            <div class="justify-content-center column">
                <input class="form-check-input" type="checkbox" value="" id="use-user" onclick="useUserCheckBox()">
                <label class="form-check-label" for="flexCheckDefault">
                    Use user profile as host
                </label>
            </div>
            <div class="column">
                <label for="eventName">Host Name</label>
                <input type="text" class="form-control" id="host_name" placeholder="Some Cool City">
            </div>
        </div>
        <br>
        <button class="btn btn-contrast text-white" type="button"> Create Event </button>

    </x-form>
    <script>
        function useUserCheckBox() {
            const user_checkbox = document.getElementById('use-user');
            if (document.getElementById('use-user').checked) {
                document.getElementById('host_name').disabled = true;
            } else {
                document.getElementById('host_name').disabled = false;
            }
        }
    </script>
@endsection
