@extends('layouts/main')

@section('content')
    <h1>Login</h1>

    Don’t have an account? <a href='/register'>Register here...</a>

    <form method='POST' action='/login'>

        {{ csrf_field() }}

        <div>
            <label for='email'>Email Address</label>
            <input id='email' type='email' name='email' value='{{ old('email') }}' autofocus>
            @include('includes.error-field', ['fieldName' => 'email'])
        </div>

        <div>

            <label for='password'>Password</label>
            <input id='password' type='password' name='password'>
            @include('includes.error-field', ['fieldName' => 'password'])

        </div>

        {{-- <div>
            <label>
                <input type='checkbox' name='remember' {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
        </div> --}}

        <div>
            <button type='submit' class='btn btn-primary'>Login</button>
        </div>

    </form>
@endsection
