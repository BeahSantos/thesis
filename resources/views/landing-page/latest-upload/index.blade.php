@extends('landing-page.layouts.template')
@section('title', 'Welcome to Thesis Archives!')
@section('content')
<style>
    html,
    body {
        height: 100%;
        width: 100%;
        background-image: url('bg-image.png');
        background-size: cover !important;
        background-attachment: fixed;
        background-repeat: no-repeat !important;
    }

    * {
        margin: 0;
        padding: 0;
    }

    /* .background-image {
        background-image: url('bg-image.png');
        background-size: cover;
        background-repeat: no-repeat;
        width: 100%;
        height: 100%;
        box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
        -webkit-box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
        -moz-box-shadow: 0px 58px 0px 0px rgba(0, 0, 0, 0.07) inset;
        padding-bottom: 50px !important;
    } */

    .content {
        height: 450px;
        overflow: scroll;
        margin-bottom: 20px !important;
        overflow-x: hidden;
    }

    #category-submit {
        visibility: hidden;
    }

    .nav-link {
        color: yellow !important;
        font-size: 20px;
    }

    .nav-link:focus {
        color: black !important;
    }

    a {
        color: yellow;
        text-decoration: none !important;
    }

    a:hover {
        color: yellow;
        text-decoration: none !important;
    }

    #nav-most-viewed {
        border-top-right-radius: 5px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    /*Tab pane bg color*/
    
    /* #nav-welcome-page {
        background-color: !important;
    } */
</style>

<div class="container my-5" style="margin-bottom: 100px !important;">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link px-5" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-welcome-page" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true"
            ><a href="{{route('welcome.index', ['is_accepted' => 1])}}"> Most Viewed</a></button>
            <button class="nav-link active bg-light ms-1 px-5" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-welcome-page" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true"
            ><a href="{{route('latest_upload.index', ['is_accepted' => 1])}}" class="text-black">Latest Uploads</a></button>
            <button class="nav-link ms-1 px-5" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-welcome-page" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true"
            ><a href="{{route('alphabetical_thesis.index', ['is_accepted' => 1])}}">A-Z</a></button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active p-3 bg-light" id="nav-welcome-page" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container px-5">
                <div class="row">
                    @foreach($data as $item)
                    <div class="col-xs-12 col-sm-12 col-md-4 mb-4 mt-5">
                        <div class="card text-black shadow-sm" style="width: 16rem; height: 19rem;">
                            <div class="row m-2 text-end">
                                <div class="col-md-12">
                                    {{"Serial Number: " . $item->serial_number}}
                                </div>
                            </div>
                            <div class="card-body d-inline-block">
                                <h6 class="card-title fw-bold lh-1" style="font-size: 18px;">
                                    {{$item->title}}
                                </h6>
                                <div class="row text-start">
                                    <p style="font-weight: 500; margin-top: 5px; margin-bottom: 0px;">{{$item->author}}</p>
                                    <p style="font-weight: 500; margin-bottom: 0px; margin-top: 0px;">{{$item->publish_date}}</p>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0" style="height: 4rem;">
                                <div class="d-flex justify-content-end mb-5">
                                    <button class="btn btn-light me-auto"><a href="" data-bs-toggle="modal" data-bs-target="#download-reminder-form" class="text-dark"><i class="fa fa-download" aria-hidden="true"></i></a></button>
                                    <button class="btn btn-light"><a href="{{route('show_thesis', ['thesis' => $item->id])}}" class="text-dark">{{isset($item->views) ? $item->views : 0}} <i class="fa fa-eye" aria-hidden="true"></i></a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@include('common.modals.download')
@endsection