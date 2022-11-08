<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('admin.layouts.header')
</head>

<body class="bg-light">
    @yield('content')
    @include('admin.layouts.scripts')
    @yield('customize-scripts')
</body>

</html>