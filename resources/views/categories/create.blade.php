@extends('layouts.app')

@section('page-name', 'Create a Category')
@section('content')

    <x-form method="POST" action="/categories" enctype="multipart/form-data">
        <br>
        <label for="name">Category Name</label>
        <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name">
        <br>
        <button class="btn btn-contrast text-white" type="submit"> Create Category </button>
    </x-form>
@endsection
