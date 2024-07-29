{{-- modal edit  --}}
<div id="editmetatagmodal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" id="update-metatag-form" method="GET">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="tagid">metatag id: </h5> --}}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <input type="hidden" class="metatag-id-in-modal" name="id" >
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">description</label>
                        {{-- <input type="text" class="form-control" name="description"> --}}
                        <textarea class="form-control" name="description" id="" cols="30" rows="2"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Author</label>
                        <input type="text" class="form-control" name="author">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Keyword</label>
                        {{-- <input type="text" class="form-control" name="keyword"> --}}
                        <textarea class="form-control" name="keyword" id="" cols="30" rows="2"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Robots</label>
                        {{-- <input type="text" class="form-control" name="robots"> --}}
                        <textarea class="form-control" name="robots" id="" cols="30" rows="2"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Model</label>
                        <input disabled type="text" class="form-control" name="model_name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light btn-save-edit-metatag">Save</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- modal add new  --}}
<div id="addnewmetatagmodal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="tagid">metatag id: </h5> --}}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                {{-- <input type="hidden" class="metatag-id-in-modal"> --}}
                <div class="mb-3">
                    <label>Tên metatag</label>
                    <input id="tagname" type="text" class="form-control" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Hủy</button>
                <button id="btn-save-addnew-metatag" type="button" class="btn btn-primary waves-effect waves-light ">Lưu</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- end add new  --}}
