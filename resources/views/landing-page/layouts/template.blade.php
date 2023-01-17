<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('landing-page.layouts.header')
</head>

<body class="d-flex flex-column min-vh-100">
    <style>
        body {
            font-size: 14px;
        }
    </style>
    @yield('content')
    @include('landing-page.layouts.scripts')
    @yield('customized-script')
    @include('common.layouts.footer')
</body>

</html>