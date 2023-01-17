<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @include('admin.layouts.header')
</head>

<body class="bg-light">
    <style>
        .small-box {
            max-width: 640px;
            min-height: 640px;
        }
    </style>
    <div class="container small-box d-flex justify-content-center align-items-center">
        <div class="card" style="width: 22rem;">
            <img src="/web-logo-earist.png" class="card-img-top" alt="...">
            <div class="card-body">
                <form action="{{route('admin.thesis_archives.authenticate')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control shadow-none mb-2" name="email" placeholder="Email" value="janedoe@test.com">
                    <input type="password" class="form-control shadow-none" name="password" placeholder="Password">
                    <div class="text-center mt-3">
                        <button type="submit" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.layouts.scripts')
</body>

</html>
