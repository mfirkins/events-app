@extends('layouts.app')

@section('page-name', 'Edit Category')

@section('content')

    <x-form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
        <div class="form-group">
            <br>
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="{{ $category->name }}" placeholder="" name="name">
        </div>
        <br>
        <button class="btn btn-contrast text-white" type="submit"><i class="bi bi-check-lg"></i> Update Profile </button>
    </x-form>

@endsection
