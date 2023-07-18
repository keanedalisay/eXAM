<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Keane Dalisay">
    <meta name="application-name" content="eXAM">
    <title>
        eXAM | Sign-Up
    </title>
    <link href="/styles/global/global.css" rel="stylesheet">
    <link href="/styles/entry/entry.css" rel="stylesheet">
    </link>
    <link href="/styles/entry/signup.css" rel="stylesheet">
    </link>
</head>

<body>
    <header>
        <a class="header-logo" href="/"><img src="/assets/eXAM_logo.svg"
                alt="The word 'exam' as the web app logo with the 'x' represented with a pencil and ruler"
                loading="lazy"></a>
        <nav>
            <ul class="links">
                <li class="link"><a href="/login">Log-In</a></li>
                <li class="link link--isInPage"><a href="/signup/profile">Sign-Up</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?= $this->model->main_tags ?>
    </main>
    <footer>
        <small class="footer-notice">Copyright &copy;
            <?= date("Y") ?> Alphabet Inc. All rights reserved.
        </small>
    </footer>
</body>

</html>