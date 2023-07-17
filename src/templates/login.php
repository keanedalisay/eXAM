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
</head>

<body>
    <header class="hdr">
        <a class="hdr-logo" href="/"><img src="/assets/eXAM_logo.svg"
                alt="The word 'exam' as the web app logo with the 'x' represented with a pencil and ruler"
                loading="lazy"></a>
        <nav class="nav">
            <ul class="links">
                <li class="link link--isInPage"><a href="/login">Log-In</a></li>
                <li class="link"><a href="/signup/profile">Sign-Up</a></li>
            </ul>
        </nav>
    </header>
    <main class="mn">
        <?= $this->model->main_tags ?>
    </main>
    <footer class="ftr">
        <small class="ftr-notice">Copyright &copy;
            <?= date("Y") ?> Alphabet Inc. All rights reserved.
        </small>
    </footer>
</body>

</html>