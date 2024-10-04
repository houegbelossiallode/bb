<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ config('app.name') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
</head>

<body class="page-index">

    <header
        style="background-color: #563d7c ; width: 90%; margin-left:auto; margin-right:auto; padding-top: 10px; padding-bottom: 10px;"
        align=center>
        <strong style="color: #ffffff ;">Application de courtage</strong>
    </header>

    <main style="width: 60%; margin-left:auto; margin-right:auto">
        <div style="margin-top:50px">

            @yield('section')
        </div>
        @yield('bouton')

        <p style="margin-top: 50px;">
            Merci de nous choisir <br><br> <strong>Cordiallement!</strong>
        </p>
    </main>
</body>

</html>
