@extends('layouts/main')

@section('content')
    <h1>{{ $user->name }}</h1>

    <p class='label'>Email address: {{ $user->email }}</p>

    <form method='POST' action='/profile/{{ $user->id }} class='form'}}'>
        {{ method_field('put') }}

        {{ csrf_field() }}

        <label for='name'>Name</label>
        <input id='name' name='name' test='name-input' type='text' value='{{ old('name', $user->name) }}' autofocus>
        @include('includes.error-field', ['fieldName' => 'name'])


        <label for='name'>About me</label>
        <input id='about' name='about' test='about-input' type='text' value='{{ old('about', $user->about) }}'
            autofocus>
        @include('includes.error-field', ['fieldName' => 'about'])

        <button class='btn btn-primary' test='register-button' type='submit'>Update
            Profile</button>
    </form>
@endsection
