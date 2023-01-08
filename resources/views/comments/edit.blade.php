@extends('layouts.app')

@section('page-name', 'Edit Comment')

@section('content')

    <x-form method="POST" action="{{ route('comments.update', $comment->id) }}" enctype="multipart/form-data">
        <div class="form-group">
            <br>
            <label for="content">Content</label>
            <textarea type="text" class="form-control" id="name" placeholder="" name="content">{{ $comment->content }}</textarea>
        </div>
        <br>
        <button class="btn btn-contrast text-white" type="submit"><i class="bi bi-check-lg"></i> Update Comment </button>
    </x-form>

@endsection
