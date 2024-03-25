{{-- modal show sample  --}}
<div id="show-sample-modal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> </h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                {{-- <input type="hidden" class="tag-id-in-modal"> --}}
                <div class="card">
                    <div class="card-body sample-description">

                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Đóng</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- modal edit sample  --}}
<div id="edit-sample-modal" class="modal bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <input class="form-control modal-title" type="text">
                    {{-- <h5 class="modal-title">ten o day</h5> --}}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body"> --}}
                            <textarea class="form-control myeditorinstance sample-description" name="" id="" cols="30" rows="60"></textarea>

                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="sampleId" id="">
                    <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Đóng</button>
                    <button id="btn-save-edit-sample" type="button" class="btn btn-primary waves-effect waves-light ">Lưu</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    // $('#edit-sample-modal').on('click','#btn-save-edit-sample', function () {
    //     // get sample id
    //     // $sampleId = $(this).siblings('input.sample_id').val();
    //     // call ajax to get all tag info and fill in modal with infos just get
    //     alert('hi');

    // });

</script>
