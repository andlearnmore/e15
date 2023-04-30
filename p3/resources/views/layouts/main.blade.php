<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'EuroPlan')</title>
    <meta charset='utf-8'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

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
                <li><a href='/countries'>All Countries</a></li>
                <li><a href='/my-trip/'>My Trip</a></li>
                <li><a href='/places/create'>Add a Place</a></li>
                <li><a href='/contact'>Contact</a></li>
                <li>
                    @if (!Auth::user())
                        <a href='/login'>Login</a>
                    @else
                        <form method='POST' id='logout' action='/logout'>
                            {{ csrf_field() }}
                            <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
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
