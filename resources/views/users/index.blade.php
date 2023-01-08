@extends('layouts.app')

@section('title', 'Admin Dashboard - Users')
<style>
    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }

    #card-block {
        text-align: center;
    }
</style>
@section('page-name', 'Manage Users')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="color: white" scope="col">Name</th>
                <th style="color: white" scope="col">Email</th>
                <th style="color: white" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a style="color: white" href="{{ route("profiles.show", $user->profile->id) }}">{{ $user->name }}</a></td>
                    <td style="color: white">{{ $user->email }}</td>
                    <td>
                        <form method="POST" action="/users/{{ $user->id }}">
                            @csrf
                            {{ method_field('DELETE') }}


                            <input type="submit" class="btn btn-danger text-white" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
