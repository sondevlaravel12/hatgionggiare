{{-- modal edit  --}}
<div id="editoproductmodal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="tagid">oproduct id: </h5> --}}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <input type="hidden" class="oproduct-id-in-modal">
                <div class="mb-3">
                    <label>Tên oproduct</label>
                    <input class="oproductname form-control" type="text" class="form-control" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light btn-save-edit-oproduct">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- modal add new  --}}
<div id="addnewoproductmodal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="tagid">oproduct id: </h5> --}}
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                {{-- <input type="hidden" class="oproduct-id-in-modal"> --}}
                <div class="mb-3">
                    <label>Tên sản phẩm gốc</label>
                    <input id="oproductname" type="text" class="form-control" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Hủy</button>
                <button id="btn-save-addnew-oproduct" type="button" class="btn btn-primary waves-effect waves-light ">Lưu</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
