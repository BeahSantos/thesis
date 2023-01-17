<style>
    p {
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
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident sequi cupiditate veritatis nesciunt amet dolorem accusantium repellendus repellat error! Quos ex fuga aspernatur rerum deserunt minus quas explicabo laboriosam reiciendis! </p>
                <hr>
                <div class="text-end mt-3">
                    <a href="{{route('welcome.index', ['is_accepted' => 1])}}" class="btn btn-success" style="border-radius: 20px; padding-right: 30px; padding-left: 30px;">I Agree</a>
                    <a href="{{route('welcome.index')}}" class="btn btn-danger" style="border-radius: 20px; padding-right: 30px; padding-left: 30px;">No, I don't agree</a>
                </div>
            </div>
        </div>
    </div>
</div>