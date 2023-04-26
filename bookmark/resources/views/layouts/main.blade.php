<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'Bookmark')</title>
    <meta charset='utf-8'>
    <script src="https://kit.fontawesome.com/aa4414bb57.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href='/css/bookmark.css' rel='stylesheet'>

    @yield('head')
</head>

<body>
    @if (session('flash-alert'))
        <div class='flash-alert'>
            {{ session('flash-alert') }}
        </div>
    @endif


    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='bookmark Logo'></a>

        <nav>
            <ul>
                <li><a href='/'>Home</a></li>

                @if (Auth::user())
                    <li><a href='/books'>All Books</a></li>
                    <li><a href='/books/create' test='add-book'>Add a Book</a></li>
                    <li><a href='/list'>Your list</a></li>
                @endif

                <li><a href='/contact'>Contact</a></li>

                <li>
                    @if (!Auth::user())
                        <a href='/login'>Login</a>
                    @else
                        <form method='POST' id='logout' action='/logout'>
                            {{ csrf_field() }}
                            <a href='#' onClick='document.getElementById("logout").submit();'
                                test='logout'>Logout</a>
                        </form>
                    @endif
                </li>
            </ul>
        </nav>
    </header>


    <section id='main'>
        @yield('content')
    </section>

    <section id='days'>
        <p id='days'>It's Day {{ date('z') }} of {{ date('Y') }}. How many books have you read this year?
        </p>
    </section>

    <footer>
        &copy; Bookmark, Inc.
        {{ config('mail.contact_email') }}
    </footer>

</body>

</html>
