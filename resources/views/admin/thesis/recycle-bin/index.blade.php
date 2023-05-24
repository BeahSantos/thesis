@extends('admin.layouts.template')
@section('title', 'Admin | Recycle Bin')
@section('content')
    <style>
        .deleted {
            margin-bottom: 300px;
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
                                <a class="dropdown-item logout" href="{{route('admin.thesis_archives.recycle_bin.index')}}">
                                    <i class="fa fa-trash me-2" aria-hidden="true"></i>
                                    <h6 class="d-inline-block lg" style="font-family: Montserrat, sans serif;">Recycle Bin</h6>
                                </a>
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
    <div class="container mt-5 deleted">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-6 col-md-12 col-sm-12 mt-1">
                        <form action="{{route('admin.thesis_archives.recycle_bin.index')}}" method="GET" class="">
                            <input type="text" name="search" style="width: 300px !important;" placeholder="Search by Thesis Title" class="form-control align-middle d-inline-block shadow-none" value="{{isset($request->search) ? $request->search : ''}}">
                            <button type="submit" class="btn btn-danger shadow-none">Search</button>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 text-end">
                        <a href="{{route('admin.thesis_archives.index')}}" class="btn shadow-none btn-success px-5"><i class="fa fa-reply" aria-hidden="true"></i> Back to Home</a>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped text-nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>Serial Number</th>
                                <th>Title</th>
                                <th>Reason</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $row)
                            <tr class="text-center">
                                <td>{{$row->serial_number}}</td>
                                <td>
                                    <p class="d-inline-block text-truncate" style="max-width: 400px;">
                                        {{$row->title}}
                                    </p>
                                </td>
                                <td>
                                    <p class="d-inline-block text-truncate" style="max-width: 400px;">
                                        {{$row->reason->reason}}
                                    </p>
                                </td>
                                <td>{{date('Y-m-d', strtotime($row->deleted_at))}}</td>
                                <td>
                                    <a onclick="restoreItem(this)" data-link="{{route('admin.thesis_archives.recycle_bin.restore', ['thesis' => $row->id])}}" data-bs-toggle="modal" data-bs-target="#restore-thesis-form" class="btn btn-info">Restore</a>
                                    <a onclick="deleteItem(this)" data-link="{{route('admin.thesis_archives.recycle_bin.delete', ['thesis' => $row->id])}}" data-bs-toggle="modal" data-bs-target="#delete-thesis-form" class="btn btn-danger">Delete Permanently</a>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="5">No Data Available.</td>
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
@include('admin.thesis.recycle-bin.modals.confirm-restore')
@include('admin.thesis.recycle-bin.modals.confirm-delete')
@endsection
@section('customize-scripts')
<script>
    function restoreItem(btn)
    {
        var route = $(btn).data().link;

        $('#restore-action').attr('action', route);
    }

    function deleteItem(btn)
    {
        var route = $(btn).data().link;

        $('#delete-action').attr('action', route);
    }
</script>
@endsection