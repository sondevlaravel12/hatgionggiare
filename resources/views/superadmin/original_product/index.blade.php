@extends('admin.admin_master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách sản phẩm gốc</h4>

                <div class="page-title-right">
                    <div >
                        <a id="add-new-oproduct" href="#" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm sản phẩm gốc</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="card-title"><a href="" class="btn btn-dark float-end mb-2">them tag</a></div> --}}
                    {{-- <button id="new-row-button" class="btn btn-dark pull-end mb-2">Thêm tag</button> --}}

                    <div class="table-responsive">

                        <table class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline "  id="datatable">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên sản phẩm gốc</th>
                                    <th>Sl sample product</th>
                                    <th>Sl sample post</th>
                                    <th>Chỉnh Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($oproducts as $oproduct)

                                <tr data-id="{{ $oproduct->id }}" data-name="{{ $oproduct->name }}">
                                    <td class="oproduct-id">{{$oproduct->id}}</td>
                                    <td class="oproduct-name">{{ $oproduct->name }}</td>
                                    <td>
                                        @if ($oproduct->samples)
                                        {{ $oproduct->samples->where('type','=','product')->count() }}
                                        @endif

                                    </td>
                                    <td>
                                        @if ($oproduct->samples)
                                        {{ $oproduct->samples->where('type','=','post')->count() }}
                                        @endif
                                    </td>
                                    <td>
                                        <input class="oproduct-id" type="hidden" id="{{ $oproduct->id }}" value="{{ $oproduct->id }}">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-link js-edit-oproduct"  ><i class="far fa-edit"></i> Sửa</button>

                                        <button  class="btn btn-sm btn_oproduct_delete js-remove-oproduct"><i class="far fa-trash-alt"></i> Xóa</button>
                                        <!-- end Button trigger modal -->
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('superadmin.original_product._modal')

                        {{-- end add new  --}}
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
{{-- some global variable  --}}
<script>
    var $modal = $('#editoproductmodal');
    var $modalcontent = $modal.find('.modal-content');
    var $modalOproductName = $modalcontent.find('input.oproductname');
    var $modalOproductId = $modalcontent.find('input.oproduct-id-in-modal');
    var $pageTitle = document.getElementsByTagName("title")[0].innerHTML;

</script>
{{-- end some global variable  --}}
{{-- event   --}}
<script>
    // even in table: need to use delegated events.
    $table.on('click','.js-edit-oproduct', function () {
        // -----fill in modal -----//
        // get oproduct id
        $oproductId = $(this).siblings('input.oproduct-id').val();
        // call ajax to get all oproduct info and fill in modal with infos just get
        getOproductinfo($oproductId).done(function(data){
            $modalOproductName.val(data['name']);
            $modalOproductId.val($oproductId);
            $modal.modal('show');

        })
    });
    $table.on('click','.js-remove-oproduct', function(){
        if(confirm('bạn có chắc muốn xóa sản phẩm gốc này không?')){
            // get oproduct id
            $oproductId = $(this).siblings('input.oproduct-id').val();
            // get row
            $row = $(this).closest('tr');
            // call ajax to remove oproduct in database
            removeOproduct($oproductId).done(function(data){
                // if remove successfully in db then remove this oproduct in view and show notification
                $row.remove();
                displayNotification(data['message']);
            }).fail(function(data){
                displayNotification("xóa san pham goc thất bại","error");
            });
        }else{

        }

    });
</script>
<script>
    // event add new oproduct when clicking on top-right page
    $('div.page-title-right a#add-new-oproduct').click(function(){
        // show blank modal
        $addnewoproductModal = $('#addnewoproductmodal');
        $addnewoproductModal.find('input#oproductname').val('');
        $addnewoproductModal.modal('show');

    });
</script>
<script>
    // events in modal
    $('.btn-save-edit-oproduct').on('click', function(){
        // get all informations in modal that user typed in
        $modalcontent = $(this).closest('.modal-content');
        $oproductId = $modalcontent.find('input.oproduct-id-in-modal').val();
        $oproductName = $modalcontent.find('input.oproductname').val();
        // call ajax in order to update oproduct info
        updateOproductInfo($oproductId,$oproductName).done(function(data){
            // fill in row with new data
            // attribute selector, can not find row after call ajax create new row
            // $row = $table.find('tr[data-id='+ $oproductId +']');
            $row = $table.find('input#' +$oproductId).closest('tr');
            // $row = $table.find("tr[data-id='" + $tagId + "']");
            $row.find('td.oproduct-name').html($oproductName);
            // hide modal
            $('#editoproductmodal').modal('hide');
            // show notification
            displayNotification(data['message'],'success');
        }).fail(function(data){
            displayNotification("cập nhật sản phẩm gốc thất bại",'error');
            $('#editoproductmodal').modal('hide');
        });
    })
    $('.modal button#btn-save-addnew-oproduct').click(function(){
        // get oproduct information after user type in
        $oproductName = $addnewoproductModal.find('input#oproductname').val();
        // call ajax in order create new oproduct in database
        addNewOproduct($oproductName).done(function(data){
            // add new oproduct in datatble view
            $newRow = $dataTable.row
                    .add([
                        data['newOproduct']['id'],
                        data['newOproduct']['name'],
                        '0',
                        '0',
                        `
                        <input class="oproduct-id" type="hidden" id="`+ data['newOproduct']['id'] +`" value="`+ data['newOproduct']['id'] +`">
                        <button type="button" class="btn btn-sm btn-link js-edit-oproduct"><i class="far fa-edit"></i> Sửa</button>
                        <button  class="btn btn-sm btn_product_delete js-remove-oproduct"><i class="far fa-trash-alt"></i> Xóa</button>
                        `

                    ]).node();
                $($newRow).find("td:eq(0)").addClass('oproduct-id');
                $($newRow).find("td:eq(1)").addClass('oproduct-name');
                // $($newRow).find('td')[1].addClass('tag-name');
                $dataTable.draw(false);
            // $($newRow).attr('')
            // show notification and close modal
            $addnewoproductModal.modal('hide');
            displayNotification("thêm sản phẩm gốc mới thành công","success");

        })
    })

</script>
{{--end event   --}}

{{-- function  --}}
<script>
    function addNewOproduct(oproductName){
        return $.ajax({
            type: "get",
            url: "/asuperdmin/oproduct/ajax-addnew-oproduct",
            data: {name:oproductName},
            dataType: "json",
        });
    }
    function getOproductinfo(oproductId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/superadmin/oproduct/ajax-get-oproduct-info",
            data: {id:oproductId},
            dataType: "json",
        });
    }
    function updateOproductInfo(oproductId, oproductName){
        return $.ajax({
            type: "get",
            url: "/supperadmin/oproduct/ajax-update-oproduct-info",
            data: {id:oproductId, name:oproductName},
            dataType: "json",
        });
    }
    function removeOproduct(oproductId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/supperadmin/oproduct/ajax-remove-oproduct",
            data: {id:oproductId},
            dataType: "json",
        });
    }
</script>
{{--end function  --}}

@endpush
