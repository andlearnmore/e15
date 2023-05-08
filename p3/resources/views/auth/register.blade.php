@extends('layouts/main')

@section('content')
    <h1>Register</h1>

    Already have an account? <a href='/login'>Login here...</a>

    <form method='POST' action='/register'>
        {{ csrf_field() }}

        <label for='name'>Name</label>
        <input id='name' name='name' test='name-input' type='text' value='{{ old('name') }}' autofocus>
        @include('includes.error-field', ['fieldName' => 'name'])

        <label for='email'>Email Address</label>
        <input id='email' name='email' test='email-input' type='email' value='{{ old('email') }}'>
        @include('includes.error-field', ['fieldName' => 'email'])

        <label for='password'>Password (min: 8)</label>
        <input id='password' name='password' test='password-input' type='password'>
        @include('includes.error-field', ['fieldName' => 'password'])

        <label for='password-confirm'>Confirm Password</label>
        <input id='password-confirm' name='password_confirmation' test='password-confirmation-input' type='password'>

        <button class='btn btn-primary' test='register-button' type='submit'>Register</button>
    </form>
@endsection
