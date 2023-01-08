@extends('layouts.app')

@section('page-name', 'Edit Profile')

@section('content')

    <x-form method="POST" action="{{ route('profiles.update', $profile->id) }}" enctype="multipart/form-data">
        <div class="form-group">
            <br>
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="{{ $profile->user->name }}" placeholder=""
                name="name">
            <br>
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $profile->user->email }}" placeholder=""
                name="email">
            @if (Auth::check() and Auth::user()->hasRole('Admin'))
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" value="{{ $profile->user->getRoleNames()->first() }}">
                    @foreach ($roles as $role)
                        <option>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>
        <br>
        <button class="btn btn-contrast text-white" type="submit"><i class="bi bi-check-lg"></i> Update Profile </button>
    </x-form>

@endsection
