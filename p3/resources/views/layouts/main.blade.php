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
                {{-- <li><a href='/countries'>All Countries</a></li> --}}
                <li><a href='/cities'>All Cities</a></li>
                <li><a href='/cities/create'>Add a City</a></li>
                <li><a href='/contact'>Contact</a></li>

            </ul>
        </nav>
    </header>


    <section id='main'>
        @yield('content')
    </section>

    <footer>
        &copy; EuroPlan, Inc.
        {{ config('mail.contact_email') }}
    </footer>

</body>

</html>
