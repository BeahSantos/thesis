<div class="modal fade" id="create-thesis-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php
        $serialNumber = mt_rand(1000000000, 9999999999);
    ?>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="m-3 text-end">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-2">
                <div class="text-center mb-3">
                    <h5 style="font-family: Montserrat, sans serif;">Thesis Archives</h5>
                </div>
                <form action="{{route('admin.thesis_archives.store')}}" method="POST" class="ms-5" enctype="multipart/form-data" id="create-thesis-form-validation">
                    @csrf
                    <input type="text" name="thesis_title" style="width: 308px !important;" class="form-control shadow-none" placeholder="Thesis Title">
                    <input type="text" name="authors" style="width: 308px !important;" class="form-control shadow-none mt-3" placeholder="Author/s">
                    <select class="form-select shadow-none mt-3" name="course" style="width: 308px !important;" aria-label="Default select example">
                        <option disabled selected>Courses</option>
                        @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->course_title}}</option>
                        @endforeach
                    </select>
                    <input type="date" name="publish_date" max="{{$formatted}}" style="width: 308px !important;" class="form-control shadow-none mt-3" placeholder="Publish Date">
                    <select class="form-select shadow-none mt-3" name="category" style="width: 308px !important;" aria-label="Default select example">
                        <option disabled selected>Categories</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    <div class="form-floating mt-3">
                        <input class="form-control shadow-none" name="serial_number" style="width: 308px !important;" id="floatingTextarea" value="{{$serialNumber}}" readonly>
                        <label for="floatingTextarea">Serial Number</label>
                    </div>
                    <input type="file" name="thesis_file" class="form-control shadow-none mt-3" style="width: 308px !important;">

                    <div class="text-center mt-4 mb-3 me-5">
                        <button type="submit" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>