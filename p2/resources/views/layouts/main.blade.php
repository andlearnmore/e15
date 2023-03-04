<!doctype html>
<html lang='en'>

<head>
    <title>@yield('title', 'Itinerary Planner')</title>
    <meta charset='utf-8'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='/css/itineraries.css' rel='stylesheet'>


    @yield('head')
</head>

<body>


    <main>
        <div class="container">
            <section>
                <div class="row">
                    <div class="mb-3">
                        <div class="col-12">
                            <div class="text-center">
                                <header>
                                    <a href='/'><img src='/images/levin-i8IPxSMJWtA-unsplash.jpg' id='logo'
                                            alt='Berlin at night'></a>
                                </header>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>
        </div>
    </main>

    <footer>
        &copy; Itinerary Planner, Inc.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
