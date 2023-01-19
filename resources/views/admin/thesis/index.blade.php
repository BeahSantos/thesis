@extends('admin.layouts.template')
@section('title', 'Admin | Thesis Archives')
@section('content')
<style>
    .logout:hover {
        background-color: white;

    }

    .lg:hover {
        font-weight: bold;
    }

    .text-truncate {
        max-width: 300px !important; 
    }
</style>
<nav class="navbar navbar-expand-lg navbar-white bg-white sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('admin.thesis_archives.index')}}">
            <img src="/web-logo-earist.png" width="65" height="50" alt="Earist Thesis Archive Library">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-1" aria-hidden="true"></i>
                        <h6 class="d-inline-block fw-bold" style="font-family: Montserrat, sans serif;">{{Auth::guard('admin')->user()->first_name}}</h6>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li class="">
                            <a class="dropdown-item logout" href="{{route('admin.thesis_archives.logout')}}">
                                <i class="fa fa-sign-out me-2" aria-hidden="true"></i>
                                <h6 class="d-inline-block lg" style="font-family: Montserrat, sans serif;">Logout</h6>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5" id="flash-message">
    @include('admin.layouts.flash-message')
</div>

<?php
    $date = \Carbon\Carbon::now();
    $formatted = date('Y-m-d', strtotime($date));
?>
<div class="container mt-3 mb-3 rounded">
    <div class="d-flex justify-content-center align-middle">
        <div class="col-md-8 mt-2 rounded bg-white shadow-sm py-3 px-3">
            <form action="" id="filter-form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">From Date</label>
                        <input type="date" name="from_date" value="{{$request->from_date ?? ''}}" id="from_date" class="form-control align-middle shadow-none">
                    </div>
                    <div class="col-md-6">
                        <label for="">To Date</label>
                        <input type="date" name="to_date" value="{{$request->to_date ?? ''}}" id="to_date"class="form-control align-middle shadow-none">
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

<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6 col-md-12 col-sm-12 mt-1">
                    <form action="{{route('admin.thesis_archives.index')}}" method="GET" class="">
                        @csrf
                        <input type="text" name="search" style="width: 300px !important;" placeholder="Search by Thesis Title" class="form-control align-middle d-inline-block shadow-none" value="{{isset($request->search) ? $request->search : ''}}">
                        <button type="submit" class="btn btn-danger shadow-none">Search</button>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 text-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#create-thesis-form" class="btn shadow-none btn-success px-5">Add</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-nowrap">
                    <thead>
                        <tr class="text-center">
                            <th>Thesis</th>
                            <th>Author/s</th>
                            <th>Course</th>
                            <th>Publish Date</th>
                            <th>Category</th>
                            <th>Serial Number</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                        <tr class="text-center">
                            <td class="text-truncate">{{$row->title}}</td>
                            <td>{{$row->author}}</td>
                            <td>{{$row->course->course_title}}</td>
                            <td>{{date('d F, Y', strtotime($row->publish_date))}}</td>
                            <td>{{$row->category->category_name}}</td>
                            <td>{{$row->serial_number}}</td>
                            <td>{{isset($row->views) ? $row->views : 0}}</td>
                            <td>
                                <div class="">
                                    <a href="#" onclick="showItem(this)" data-row="{{$row}}" data-views="{{isset($row->views) ? $row->views : 0}}" data-bs-toggle="modal" data-bs-target="#show-thesis-form" class="btn shadow-none btn-info">View</a>
                                    <a href="#" onclick="editItem(this)" data-row="{{$row}}" data-link="{{route('admin.thesis_archives.update', ['thesis' => $row->id])}}" data-bs-toggle="modal" data-bs-target="#edit-thesis-form" class="btn shadow-none btn-primary">Edit</a>
                                    <a href="#" onclick="deleteItem(this)" data-link="{{route('admin.thesis_archives.destroy', ['thesis' => $row->id])}}" data-bs-toggle="modal" data-bs-target="#delete-thesis-form" class="btn shadow-none btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="8">No Data Available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{$data->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
</div>
@include('admin.thesis.modals.create')
@include('admin.thesis.modals.edit')
@include('admin.thesis.modals.show')
@include('admin.thesis.modals.delete')
@include('admin.thesis.modals.confirm-deletion-form')
@endsection
@section('customize-scripts')
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

        $('#create-thesis-form-validation').validate({
            rules: {
                thesis_title: "required",
                authors: "required",
                course: "required",
                publish_date: "required",
                abstract: "required",
                category: "required",
                thesis_file: "required",
            },

            messages: {
                thesis_title: "This field is required",
                authors: "This field is required",
                course: "This field is required",
                publish_date: "This field is required",
                abstract: "This field is required",
                category: "This field is required",
                thesis_file: "This field is required",
            },

            errorElement: "span",
            errorClass: "text-danger",
            errorPlacement: function (label, element) {
                label.insertAfter(element);
            }
        });

        $('#edit-thesis-form-validation').validate({
            rules: {
                thesis_title: "required",
                authors: "required",
                publish_date: "required",
                abstract: "required",
            },

            messages: {
                thesis_title: "This field is required",
                authors: "This field is required",
                publish_date: "This field is required",
                abstract: "This field is required",
            },

            errorElement: "span",
            errorClass: "text-danger",
            errorPlacement: function (label, element) {
                label.insertAfter(element);
            }
        });
    });

    $(function() {
        setTimeout(function() {
            $('#flash-message').hide();
        }, 3000);
    });

    function deleteItem(btn) {
        var route = $(btn).data().link;
        $('#delete-item-form').attr('action', route);
    }

    function showItem(btn) {
        var data = $(btn).data().row;
        var views = $(btn).data().views;
        $('#show-title').val(data.title);
        $('#show-authors').val(data.author);
        $('#show-course').val(data.course.course_title);
        $('#show-publish-date').val(data.publish_date);
        $('#show-category').val(data.category.category_name);
        $('#show-views').val(views);
        $('#show-serial-number').val(data.serial_number);
    }

    function editItem(btn) {
        var data = $(btn).data().row;
        var views = $(btn).data().views;
        var route = $(btn).data().link;
        $('#edit-title').val(data.title);
        $('#edit-authors').val(data.author);
        $('#edit-publish-date').val(data.publish_date);
        $('#edit-views').val(views);
        $('#edit-serial-number').val(data.serial_number);
        $('#edit-thesis-form-validation').attr('action', route);
    }
</script>
@endsection