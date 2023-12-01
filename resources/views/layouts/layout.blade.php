<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slimselect.css">
    <link rel="stylesheet" href="css/admin.css">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="icon/favicon-32x32.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">

    @yield('css')

    <title>@yield('tittle')</title>

</head>

<body>

    @yield('first-components')

    <!-- main content -->
    <main class="main">
        @yield('main')
    </main>
    <!-- end main content -->

    @yield('last-components')

    <!-- JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/smooth-scrollbar.js"></script>
    <script src="js/slimselect.min.js"></script>
    <script src="js/admin.js"></script>

    @yield('js')
</body>

</html>
