@extends('landing-page.layouts.template')
@section('title', 'Thesis File')
@section('content')
<div class="container mt-5" style="width: 30rem;">
    <div class="card shadow-sm" width: 15rem;>
        <div class="card-title text-center m-3">
            <h5 style="font-family: Montserrat;">To continue to download, please insert the necessary information first.</h5>
        </div>
        <div class="card-body text-center">
            <form action="{{route('store_student_info')}}" method="POST" class="ms-5" id="student-info-form">
                @csrf
                <input type="text" name="first_name" style="width: 308px !important;" class="form-control shadow-none mb-3" placeholder="First Name">
                <input type="text" name="middle_name" style="width: 308px !important;" class="form-control shadow-none mb-3" placeholder="Middle Name">
                <input type="text" name="last_name" style="width: 308px !important;" class="form-control shadow-none mb-3" placeholder="Last Name">
                <input type="text" name="course" style="width: 308px !important;" class="form-control shadow-none mb-3" placeholder="Course">
                <input type="text" name="year" style="width: 308px !important;" class="form-control shadow-none mb-3" placeholder="Year">
                <input type="text" name="student_number" style="width: 308px !important;" class="form-control shadow-none mb-3" placeholder="Student Number">

                <div class="text-center mt-4 mb-3 me-5">
                    <button type="submit" id="btn-info" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-success">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection