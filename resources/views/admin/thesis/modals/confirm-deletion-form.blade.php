<div class="modal fade" id="confirm-deletion-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="m-3 text-end">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-2">
                <form action="" method="POST" id="delete-item-form">
                    @csrf
                    @method('DELETE')
                    <div class="col-md-12">
                        <h5>Reason for deletion</h5>
                        <select name="reason" class="form-select shadow-none" id="floatingSelectGrid">
                            <option disabled selected>Select</option>
                            @foreach ($reasons as $item) 
                            <option value="{{$item->id}}">{{$item->reason}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-danger">Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>