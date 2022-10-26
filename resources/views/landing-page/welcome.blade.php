<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Welcome to Thesis Archive!</title>
</head>

<body>
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .search {
            width: 100%;
            position: relative;
            display: flex;
        }

        .searchTerm {
            width: 100%;
            border: 3px solid #827e7d;
            border-right: none;
            padding: 5px;
            padding-left: 10px;
            height: 50px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
        }

        .searchTerm:focus {
            color: black;
        }

        .searchButton {
            width: 55px;
            height: 50px;
            border: 1px solid #827e7d;
            background: #827e7d;
            text-align: center;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 20px;
        }

        /*Resize the wrap to see the search bar change!*/
        .wrap {
            width: 30%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        a:hover {
            color: #FF8000 !important;
        }

        .welcome-text {
            font-size: 25px;
            font-family: Libre Baskerville, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .background-image {
            background-image: url('bg-image.png');
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
            -webkit-box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
            -moz-box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
        }
    </style>
    <div class="background-image">
        <nav class="navbar navbar-expand-lg  navbar-light bg-light top-nav-bar">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('most_viewed_thesis.index')}}">MOST VIEWED THESIS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('latest_upload.index')}}">LATEST UPLOAD</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.index')}}">ADMIN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="wrap">
        <div class="welcome-text">
            <p class="text-center text-white">Welcome to Thesis Archives!</p>
        </div>
        <div class="search">
            <input type="text" class="searchTerm" placeholder="What are you looking for?">
            <button type="submit" class="searchButton">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>