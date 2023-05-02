<!doctype html>
<html lang='en'>


<body>

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='bookmark Logo'></a>
    </header>

    <section id='main'>
        <p>This is my test email.</p>
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
