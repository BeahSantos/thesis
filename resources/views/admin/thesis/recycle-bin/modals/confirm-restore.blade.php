<div class="modal fade" id="restore-thesis-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="m-3 text-end">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-2">
                <form action="" method="POST" id="restore-action">
                    @csrf
                    <div class="text-center">
                        <h3>Are you sure you want to restore this?</h3>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-info">Restore</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>