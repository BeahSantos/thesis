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

    label {
        font-size: 16px;
    }
</style>

<div class="container my-5" style="margin-bottom: 100px !important;">
    @if (!$request->search || !$request->category || !$request->from_date)
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link px-5" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-welcome-page" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true"
            ><a href="{{route('welcome.index', ['is_accepted' => 1])}}"> Most Viewed</a></button>
            <button class="nav-link ms-1 px-5" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-welcome-page" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true"
            ><a href="{{route('latest_upload.index', ['is_accepted' => 1])}}">Latest Uploads</a></button>
            <button class="nav-link active bg-light ms-1 px-5" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-welcome-page" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true"
            ><a href="{{route('alphabetical_thesis.index', ['is_accepted' => 1])}}" class="text-black">A-Z</a></button>
        </div>
    </nav>
    @else
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active bg-light px-5" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-welcome-page" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true"
            ><a href="{{route('alphabetical_thesis.index', ['is_accepted' => 1])}}" class="text-black">A-Z</a></button>
        </div>
    </nav>
    @endif

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active p-3 bg-light" id="nav-welcome-page" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="container mt-5 mb-3 rounded">
                <div class="d-flex justify-content-center align-middle">
                    <div class="col-md-12 mt-2 rounded bg-white py-3 px-3">
                        <form action="{{route('alphabetical_thesis.index')}}" method="GET" id="filter-form">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="is_accepted" value="{{$request->is_accepted ?? 0}}">
                                <div class="col-md-4">
                                    <label for="">Course</label>
                                    <select class="form-select shadow-none align-middle" name="category" aria-label="Default select example">
                                        <option disabled selected>Select</option>
                                        {{-- @foreach($categories as $key => $category)
                                        <option value="{{$category->id}}" {{$request->category == $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="">From Date</label>
                                    <input type="date" value="{{$request->from_date ?? ''}}" name="from_date" id="from_date" class="form-control align-middle shadow-none">
                                </div>
                                <div class="col-md-4">
                                    <label for="">To Date</label>
                                    <input type="date" name="to_date" value="{{$request->to_date ?? ''}}" id="to_date" class="form-control align-middle shadow-none">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" style="font-size: 16px !important; padding-right: 80px; padding-left: 80px;" class="btn btn-primary align-middle py-2">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container px-5">
                <div class="d-flex justify-content-end">
                    <div class="col-md-4">
                        <form action="{{route('alphabetical_thesis.index')}}" method="GET">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="hidden" name="is_accepted" value="{{$request->is_accepted ?? 0}}">
                                <input type="text" class="form-control shadow-none" name="search" placeholder="Search by Thesis Title" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{$request->search ?? ''}}">
                                <span class="input-group-text" id="basic-addon2"><button type="submit" class="btn" style="outline:none !important; border: 0;">Search</button></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    @foreach($data as $item)
                    <div class="col-xs-12 col-sm-12 col-md-4 mb-4 mt-5">
                        <div class="card text-black shadow-sm" style="width: 16rem; height: 14rem;">
                            <div class="card-body d-inline-block">
                                <h6 class="card-title fw-bold lh-1" style="font-size: 18px;">
                                    {{$item->title}}
                                </h6>
                            </div>
                            <div class="card-footer bg-white border-0" style="height: 4rem;">
                                <div class="d-flex justify-content-between mb-5">
                                    <button class="btn btn-light me-auto"><a href="{{route('download', ['file' => $item->id])}}" class="text-dark"><i class="fa fa-download" aria-hidden="true"></i></a></button>
                                    <button class="btn btn-light"><a href="{{route('show_thesis', ['thesis' => $item->id])}}" class="text-dark">{{isset($item->views) ? $item->views : 0}} <i class="fa fa-eye" aria-hidden="true"></i></a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    {{$data->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customized-script')
<script>
    $.validator.addMethod('dateTimeNotGreaterThan', function (value, element, param) {
        var startDate = Date.parse(value);
        var endDate = Date.parse($(param).val());

        if (startDate < endDate) {
            return false
        } else {
            return true
        }
    }, 'To Date should be greater than From Date');

    $(document).ready(function() {
        $('#filter-form').validate({
            rules: {
                from_date: {
                    required: {
                        depends: function (element) {
                            if ($('#to_date').val() != '') {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                },
                to_date: {
                    dateTimeNotGreaterThan: '#from_date',
                    required: {
                        depends: function (element) {
                            if ($('#from_date').val() != '') {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
            errorElement: "span",
            errorClass: "text-danger",
            errorPlacement: function (label, element) {
                label.insertAfter(element);
            }
        });
    });
</script>
@endsection