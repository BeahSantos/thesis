@extends('landing-page.layouts.template')
@section('title', 'Welcome to Thesis Archives!')
@section('content')
<style>
    html,
    body {
        height: 100%;
        width: 100%;
        overflow: hidden;
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
        height: 100%;
        box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
        -webkit-box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
        -moz-box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
        padding-bottom: 50px !important;
    }

    .content {
        height: 500px;
        overflow: scroll;
        margin-bottom: 20px !important;
        overflow-x: hidden;
    }

    #category-submit {
        visibility: hidden;
    }
</style>
<div class="background-image pb-5">
    <nav class="navbar navbar-expand-lg  navbar-light bg-light top-nav-bar">
        <div class="container-fluid">
            <div class="ms-auto p-1">
                <a href="" data-bs-toggle="modal" data-bs-target="#admin-login-form" class="btn btn-outline-secondary">Log In as Admin</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <div class="col-md-5">
                <div>
                    <form action="{{route('welcome.index')}}" method="GET">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control shadow-none" name="search" placeholder="Search by Thesis Title" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{isset($request->search) ? $request->search : ''}}">
                            <span class="input-group-text" id="basic-addon2"><button type="submit" class="btn">Search</button></span>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-md-4 mt-2">
                <form action="">
                    <select class="form-select shadow-none d-inline-block align-middle" style="max-width: 300px !important;" name="category" aria-label="Default select example">
                        <option disabled selected>Categories</option>
                        @foreach($categories as $key => $category)
                        <option value="{{$category->id}}" {{$request->id == $key ? 'selected' : ''}}>{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary d-inline-block">Filter</button>
                </form>
            </div>
        </div>

        <div class="container bg-white rounded py-4 px-5 mb-5 content">
            @if (isset($request->search) || isset($request->category))
            <div>
                <h1 style="font-family: Montserrat, san serif;">Search Results...</h1>
            </div>
            <div class="row">
                @foreach($results as $result)
                <div class="col-md-4 mb-4">
                    <a class="text-decoration-none" href="">
                        <div class="card text-black shadow-sm" style="width: 16rem; height: 13rem;">
                            <div class="card-body d-inline-block">
                                <h6 class="card-title fw-bold lh-1">
                                    {{$result->title}}
                                </h6>
                            </div>
                            <div class="card-footer bg-white border-0" style="height: 4rem;">
                                <div class="d-flex justify-content-between mb-5">
                                    <button class="btn btn-light"><i class="fa fa-folder-o" aria-hidden="true"></i></button>
                                    <button class="btn btn-light">{{isset($result->views) ? $result->views : 0}} <i class="fa fa-eye" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <div>
                <h1 style="font-family: Montserrat, san serif;">Most Viewed Thesis</h1>
            </div>
            <div class="row">
                @foreach($mostViewedThesis as $item)
                <div class="col-md-4 mb-4">
                    <a class="text-decoration-none" href="">
                        <div class="card text-black shadow-sm" style="width: 16rem; height: 13rem;">
                            <div class="card-body d-inline-block">
                                <h6 class="card-title fw-bold lh-1">
                                    {{$item->title}}
                                </h6>
                            </div>
                            <div class="card-footer bg-white border-0" style="height: 4rem;">
                                <div class="d-flex justify-content-between mb-5">
                                    <button class="btn btn-light"><i class="fa fa-folder-o" aria-hidden="true"></i></button>
                                    <button class="btn btn-light">{{isset($item->views) ? $item->views : 0}} <i class="fa fa-eye" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <hr>
            <div style="font-family: Montserrat, san serif;" class="mb-3">
                <h1>Latest Uploads</h1>
            </div>
            <div class="row">
                @foreach($latestUpload as $column)
                <div class="col-md-4 mb-4">
                    <a class="text-decoration-none" href="">
                        <div class="card text-black shadow-sm" style="width: 16rem; height: 10.5rem;">
                            <div class="card-body d-inline-block">
                                <div class="text-end align-middle">
                                    <span class="align-baseline">New <i class="fa fa-circle text-success" style="font-size: 10px;" aria-hidden="true"></i></span>
                                </div>
                                <h6 class="card-title fw-bold lh-1">
                                    {{$column->title}}
                                </h6>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach 
            </div>
            @endif
        </div>
    </div>
</div>
@include('admin.auth.index')
@endsection