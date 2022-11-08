<div class="modal fade" id="admin-login-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="m-3 text-end">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-2">
                <div class="text-center mb-3">
                    <h5 style="font-family: Montserrat, sans serif;"> Welcome to Thesis Archives!</h5>
                </div>
                <form action="{{route('admin.thesis_archives.authenticate')}}" method="POST" class="ms-5">
                    @csrf
                    <input type="email" name="email" style="width: 308px !important;" class="form-control shadow-none mb-3" placeholder="Email">
                    <input type="password" name="password" style="width: 308px !important;" class="form-control shadow-none" placeholder="Password">

                    <div class="text-center mt-4 mb-3 me-5">
                        <button type="submit" style="border-radius: 20px; padding-right: 70px; padding-left: 70px;" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>