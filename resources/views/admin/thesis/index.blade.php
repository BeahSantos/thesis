@extends('admin.layouts.template')
@section('title', 'Admin | Thesis')
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
                                <i class="fa fa-power-off me-2" aria-hidden="true"></i>
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
<div class="container mt-5">
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
                    <a href="#" data-bs-toggle="modal" data-bs-target="#create-thesis-form" class="btn shadow-none btn-success">Add New Thesis</a>
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
                            <th>Abstract</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $row)
                        <tr class="text-center">
                            <td class="text-truncate">{{$row->title}}</td>
                            <td>{{$row->author}}</td>
                            <td>{{$row->course}}</td>
                            <td>{{date('d F, Y', strtotime($row->publish_date))}}</td>
                            <td>{{$row->category->category_name}}</td>
                            <td>{{$row->abstract}}</td>
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
        </div>
    </div>
</div>
@include('admin.thesis.modals.create')
@include('admin.thesis.modals.edit')
@include('admin.thesis.modals.show')
@include('admin.thesis.modals.delete')
@endsection
@section('customize-scripts')
<script>
    var $j = jQuery.noConflict();
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
        $('#show-course').val(data.course);
        $('#show-publish-date').val(data.publish_date);
        $('#show-category').val(data.category.category_name);
        $('#show-views').val(views);
        $('#show-abstract').val(data.abstract);
    }

    function editItem(btn) {
        var data = $(btn).data().row;
        var views = $(btn).data().views;
        var route = $(btn).data().link;
        $('#edit-title').val(data.title);
        $('#edit-authors').val(data.author);
        $('#edit-course').val(data.course);
        $('#edit-publish-date').val(data.publish_date);
        $('#edit-category').val(data.category.category_name);
        $('#edit-views').val(views);
        $('#edit-abstract').val(data.abstract);
        $('#edit-item-form').attr('action', route);
    }
</script>
@endsection