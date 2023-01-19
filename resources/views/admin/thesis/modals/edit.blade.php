<div class="modal fade" id="edit-thesis-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="m-3 text-end">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-2">
                <div class="text-center mb-3">
                    <h5 style="font-family: Montserrat, sans serif;">Thesis Archives</h5>
                </div>
                <form action="" method="POST" class="ms-5" enctype="multipart/form-data" id="edit-thesis-form-validation">
                    @csrf
                    @method('PUT')
                    <input type="text" id="edit-title" name="thesis_title" style="width: 308px !important;" class="form-control shadow-none">
                    <input type="text" id="edit-authors" name="authors" style="width: 308px !important;" class="form-control shadow-none mt-3">
                    <select class="form-select shadow-none mt-3" name="course" style="width: 308px !important;" aria-label="Default select example">
                        <option disabled selected>Courses</option>
                        @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->course_title}}</option>
                        @endforeach
                    </select>
                    <input type="date" id="edit-publish-date" max="{{$formatted}}" name="publish_date" style="width: 308px !important;" class="form-control shadow-none mt-3">
                    <select class="form-select shadow-none mt-3" name="category" style="width: 308px !important;" aria-label="Default select example">
                        <option disabled selected>Categories</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    <div class="form-floating mt-3">
                        <input class="form-control shadow-none" id="edit-serial-number" name="serial_number" style="width: 308px !important;" id="floatingTextarea" value="" readonly>
                        <label for="floatingTextarea">Serial Number</label>
                    </div>
                    <input type="file" name="thesis_file" class="form-control shadow-none mt-3" style="width: 308px !important;">

                    <div class="text-center mt-4 mb-3 me-5">
                        <button type="submit" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>