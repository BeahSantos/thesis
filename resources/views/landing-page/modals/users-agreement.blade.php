<style>
    #user-agreement-text {
        text-indent: 30px;
    }
</style>
<div class="modal fade" id="users-agreement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body px-5 py-3">
                <div class="text-center mt-3">
                    <h3>Users Agreement</h3>
                </div>
                <p id="user-agreement-text">
                    I understand and accept the terms and conditions of this Agreement and the Author's Privacy Policy, and I authorize the website management to collect, process and use my personal data in accordance with those terms. I confirm that  all data indicated by me belong to me personally. I am aware of my rights in relation to the processing of my personal data as well as the functions and applications for which it may be used."
                    This terms of use agreement the "Agreement" governs your use of the collection of Web pages and other digital content the "Collections" available through the Internet Archive the "Archive". When accessing an archived page, you will be presented with the terms of use agreement. If you do not agree to these terms, please do not use the Archive’s Collections or this Web-based Application. Access to the Web-based Application Thesis Archive is provided at no cost to you and is granted for scholarship and research purposes only.
                </p>
                <hr>
                <div class="text-end mt-3">
                    <a href="{{route('welcome.index', ['is_accepted' => 1])}}" class="btn btn-success" style="border-radius: 20px; padding-right: 30px; padding-left: 30px;">I Agree</a>
                    <a href="{{route('welcome.index')}}" class="btn btn-danger" style="border-radius: 20px; padding-right: 30px; padding-left: 30px;">No, I don't agree</a>
                </div>
            </div>
        </div>
    </div>
</div>