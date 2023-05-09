@extends('layouts/main')

@section('content')
    <h1>{{ $user->name }}</h1>

    <p class='label'>Email address: {{ $user->email }}</p>

    <p class='label'>Name: {{ $user->name }}</p>

    <p class='label'>About me:
        @if (!$user->about)
            Share something about yourself here.
        @else
            {{ $user->about }}
        @endif
    </p>
    <a href='/profile/{{ $user->name }}/edit' class='btn btn-primary'>
        Edit My Profile
    </a>
@endsection
