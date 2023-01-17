<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$data->title}}</title>
    @include('landing-page.layouts.header')
</head>

<body class="d-flex flex-column min-vh-100">
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 100%;
        }
    </style>
    <iframe src="/assets/{{$data->thesis_file}}#toolbar=0" style="margin-top: 0 !important;" frameborder="0"></iframe>
    @include('landing-page.layouts.scripts')
</body>
</html>
