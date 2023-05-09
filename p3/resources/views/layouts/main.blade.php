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
                    <li><a href='/places/create'>Add a Place</a></li>
                    <li><a href='/mytrip'>My Trip</a></li>
                    <li><a href='/itineraries'>Itineraries</a></li>
                    <li><a href='/image-create'>Add an Image</a></li>
                @endif
                <li><a href='/contact'>Contact</a></li>
                @if (Auth::user())
                    <li class="nav-item dropdown">
                        <button class="button-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile">My Profile</a></li>
                            <li>
                                <form method='POST' id='logout' action='/logout'>
                                    {{ csrf_field() }}
                                    <button class='dropdown-item' test='logout-button' type='submit'>
                                        Logout
                                    </button>
                                    {{-- <a class="dropdown-item" href="/logout">Logout</a> --}}
                            </li>
                        </ul>
                    </li>
                @else
                    <li>
                        <a test='login-link' href='/login'>Login</a>
                    </li>
                @endif
            </ul>
        </nav>
    </header>


    <section id='main'>
        @yield('content')
    </section>

    <footer>
        &copy; EuroPlan, Inc.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>
