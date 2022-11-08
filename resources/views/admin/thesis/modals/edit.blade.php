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
                <form action="" method="POST" class="ms-5" id="edit-item-form">
                    @csrf
                    @method('PUT')
                    <input type="text" id="edit-title" name="thesis_title" style="width: 308px !important;" class="form-control shadow-none mb-3">
                    <input type="text" id="edit-authors" name="authors" style="width: 308px !important;" class="form-control shadow-none mb-3">
                    <input type="text" id="edit-course" name="course" style="width: 308px !important;" class="form-control shadow-none mb-3">
                    <input type="date" id="edit-publish-date" name="publish_date" style="width: 308px !important;" class="form-control shadow-none mb-3">
                    <select class="form-select shadow-none mb-3" name="category" style="width: 308px !important;" aria-label="Default select example">
                        <option disabled selected>Categories</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    <textarea class="form-control shadow-none" id="edit-abstract" name="abstract" style="width: 308px !important;"></textarea>

                    <div class="text-center mt-4 mb-3 me-5">
                        <button type="submit" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>