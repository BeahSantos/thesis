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
</style>
    <div class="container mt-5 mb-3 rounded">
        <div class="d-flex justify-content-center align-middle">
            <div class="col-md-7 mt-2 rounded bg-white py-3 px-3">
                <form action="{{route('welcome.index')}}" id="filter-form">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Category</label>
                            <select class="form-select shadow-none align-middle" name="category" aria-label="Default select example">
                                <option disabled selected>Select</option>
                                @foreach($categories as $key => $category)
                                <option value="{{$category->id}}" {{$request->category == $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
                                @endforeach
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
                            <button type="submit" class="btn btn-primary align-middle px-5 py-2">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container bg-white rounded py-4 px-5 mb-5 content">
        <div class="col-md-5">
            <div class="align-middle">
                <form action="{{route('welcome.index')}}" method="GET">
                    @csrf
                    <div class="input-group mb-3 align-middle">
                        <input type="text" class="form-control shadow-none align-middle" name="search" placeholder="Search by Thesis Title" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{isset($request->search) ? $request->search : ''}}">
                        <span class="input-group-text align-middle" id="basic-addon2"><button type="submit" class="btn" style="outline:none !important; border: 0;">Search</button></span>
                    </div>
                </form>
            </div>
        </div>
        @if (isset($request->search) || isset($request->category) || ($request->from_date && $request->to_date))
        <div>
            <h1 style="font-family: Montserrat, san serif;">Search Results...</h1>
        </div>
        <div class="row">
            @forelse($results as $result)
            <div class="col-md-4 mb-4">
                <div class="card text-black shadow-sm" style="width: 16rem; height: 14rem;">
                    <div class="card-body d-inline-block">
                        <h6 class="card-title fw-bold lh-1" style="font-size: 18px;">
                            {{$result->title}}
                        </h6>
                    </div>
                    <div class="card-footer bg-white border-0 mt-auto" style="height: 4rem;">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-light me-auto"><a href="{{route('download', ['file' => $result->id])}}" class="text-dark"><i class="fa fa-download" aria-hidden="true"></i></a></button>
                            <button class="btn btn-light">{{isset($result->views) ? $result->views : 0}} <a href="{{route('show_thesis', ['thesis' => $result->id])}}" class="text-dark"><i class="fa fa-eye" aria-hidden="true"></i></a></button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 mt-3 shadow rounded p-2">
                <h4 class="text-center" style="font-family: Montserrat;">No Data Found.</h4>
            </div>
            @endforelse
        </div>
        @else
        <div>
            <h1 style="font-family: Montserrat, san serif;">Most Viewed Thesis</h1>
        </div>
        <div class="row">
            @foreach($mostViewedThesis as $item)
            <div class="col-md-4 mb-4">
                <div class="card text-black shadow-sm" style="width: 16rem; height: 14rem;">
                    <div class="card-body d-inline-block">
                        <h6 class="card-title fw-bold lh-1" style="font-size: 18px;">
                            {{$item->title}}
                        </h6>
                    </div>
                    <div class="card-footer bg-white border-0" style="height: 4rem;">
                        <div class="d-flex justify-content-between mb-5">
                            <button class="btn btn-light me-auto"><a href="{{route('download', ['file' => $item->id])}}" class="text-dark"><i class="fa fa-download" aria-hidden="true"></i></a></button>
                            <button class="btn btn-light">{{isset($item->views) ? $item->views : 0}} <a href="{{route('show_thesis', ['thesis' => $item->id])}}" class="text-dark"><i class="fa fa-eye" aria-hidden="true"></i></a></button>
                        </div>
                    </div>
                </div>
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
                <a class="text-decoration-none" href="{{route('show_thesis', ['thesis' => $column->id])}}">
                    <div class="card text-black shadow-sm" style="width: 16rem; height: 11.5rem;">
                        <div class="card-body d-inline-block">
                            <div class="text-end align-middle">
                                <span class="align-middle">New <i class="fa fa-circle text-success align-middle" style="font-size: 10px;" aria-hidden="true"></i></span>
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