<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'EuroPlan')</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, intial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href='/css/europlan.css' rel='stylesheet'>

    @yield('head')
</head>

<body>
    @if (session('flash-alert'))
        <div class='flash-alert'>
            {{ session('flash-alert') }}
        </div>
    @endif

    <header>
        {{-- <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='bookmark Logo'></a> --}}

        <nav>
            <ul>
                <li><a href='/'>Home</a></li>
                <li><a href='/cities'>All Cities</a></li>

                @if (Auth::user())
                    <li><a href='/places/create'>New Place</a></li>
                    <li><a href='/mytrip'>My Trip</a></li>
                @endif
                <li><a href='/contact'>Contact</a></li>
                <li>
                    @if (!Auth::user())
                        <a test='login-link' href='/login'>Login</a>
                    @else
                        <form method='POST' id='logout' action='/logout'>
                            {{ csrf_field() }}
                            <button class='button-link' test='logout-button' type='submit'>
                                Logout
                            </button>
                        </form>
                    @endif
                </li>
            </ul>
        </nav>
    </header>


    <section id='main'>
        @yield('content')
    </section>

    <footer>
        &copy; EuroPlan, Inc.
    </footer>

</body>

</html>
