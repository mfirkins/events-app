@extends('layouts.app')

@section('page-name', 'Create an Event')
@section('content')

    <x-form method="POST" action="/" enctype="multipart/form-data">

        <div class="row form-group">
            <h2 class="text-white">General</h2>
            <div class="column">
                <br>
                <label for="eventName">Event Name</label>
                <input type="text" class="form-control" id="eventName" placeholder="My Amazing Event" name="name">
                <br>
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="6" name="description"></textarea>
                <label for="category">Categories</label>
                <br>
                <div id="error-div">
                </div>
                <label for="category">Selected Categories</label>
                <textarea style="resize: none"class="form-control" id="selected-categories" name="selected-categories" rows="3"
                    readonly></textarea>
                <br>
                <label for="category">Add a category</label>
                <div class="row">
                    <select class="form-control" id="category">
                        @foreach ($categories as $category)
                            <option>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <button type="button" class="btn btn-contrast text-white" onclick="addCategory()"> Add category to
                        event </button>

                </div>

            </div>
            <div class="column">
                <br>
                <label for="image">Image</label>
                <input id="image" type="file" class="form-control" name="image">
                <br>
                <label for="date">Date</label>
                <input id="date" class="form-control" type="date" name="date" />
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
                <select class="form-control" id="venue" name="venue">
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
                <label for="amount">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount">
            </div>
            <div class="column">
                <label for="cost">Cost</label>
                <input type="text" class="form-control" id="cost" placeholder="50.00" name="cost">
            </div>
        </div>
        <hr class="text-white">
        <div class="row form-group">
            <h2 class="text-white">Host/Organiser</h2>
            <br>
            <p> You can use your user as the host name or enter a custom host name </p>
            <div class="justify-content-center column">
                <input type="checkbox" value="1" name="use_user" id="use-user" onclick="useUserCheckBox()">
                <label class="form-check-label" for="flexCheckDefault">
                    Use user profile as host
                </label>
            </div>
            <div class="column">
                <label for="host_name">Host Name</label>
                <input type="text" class="form-control" id="host_name" name="host">
            </div>
        </div>
        <br>
        <button class="btn btn-contrast text-white" type="submit"> Create Event </button>

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

        function addCategory() {
            const selectedCategories = document.getElementById('selected-categories');
            const categoryDropdown = document.getElementById('category');
            const selectedCategory = categoryDropdown.value;
            if (selectedCategories.value.indexOf(selectedCategory) != -1) {
                document.getElementById('error-div').innerHTML =
                    "<div class='alert alert-danger fade show' role='alert'><i class='bi bi-exclamation-triangle-fill'></i><b> You can't add duplicate categories</b>";
            } else {
                selectedCategories.value += selectedCategory
                selectedCategories.value += ","
            }
        }
    </script>
@endsection
