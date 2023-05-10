@extends('layouts/main')

@section('content')
    <h1>Login</h1>

    <form method='POST' action='/login'>

        {{ csrf_field() }}

        <div>
            <label for='email'>Email Address</label>
            <input id='email' name='email' test='email-input' type='email' value='{{ old('email') }}' autofocus>
            @include('includes.error-field', ['fieldName' => 'email'])
        </div>

        <div>

            <label for='password'>Password</label>
            <input id='password' name='password' test='password-input' type='password'>
            @include('includes.error-field', ['fieldName' => 'password'])

        </div>

        <div>
            <button class='btn btn-primary' test='login-button' type='submit'>Login</button>
        </div>

    </form>
    <div>
        Don’t have an account? <a href='/register'>Register here...</a>
    </div>
@endsection
