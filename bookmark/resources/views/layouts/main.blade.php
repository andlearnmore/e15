<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'Bookmark')</title>
    <meta charset='utf-8'>

    <link href='/css/bookmark.css' rel='stylesheet'>

    @yield('head')
</head>

<body>

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='bookmark Logo'></a>
    </header>

    <section>
        @yield('content')
    </section>

    <section>
        It's day {{ date('z') }} of {{ date('Y') }}. How many books have you read this year?
    </section>

    <br>

    <footer>
        &copy; Bookmark, Inc.
    </footer>

</body>

</html>
