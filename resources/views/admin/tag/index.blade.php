@extends('admin.admin_master')
@push('stylesheets')

@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách tag</h4>

                <div class="page-title-right">
                    <div >
                        {{-- <a href="{{route('admin.coupons.create')}}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm coupon</span></a> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Danh sách coupon</h4> --}}
                    <button id="new-row-button" class="btn btn-dark pull-end">Thêm tag</button>

                    <div class="table-responsive">

                        <table class="table mb-0" id="bstable">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên tag</th>
                                    <th>Loại</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)

                                <tr>
                                    <td class="tag-id">{{$tag->id}}</td>
                                    <td class="tag-name">{{$tag->name}}</td>
                                    <td>
                                        {{-- {{$tag->type}} --}}
                                        <span class="badge {{$tag->type=='product'?'bg-info':'bg-success'}} ">{{$tag->type}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- https://www.jqueryscript.net/table/crud-bstable.html  --}}
    <script src="{{ asset('backend/assets/libs/crud-bstable/bstable.js') }}"></script>
    <script>
        var editableTable = new BSTable("bstable",{
            editableColumns:"1",
            $addButton: $('#new-row-button'),
            advanced: {
                columnLabel:'Sửa'
            },
            onEdit: function(row) {
                // convert DOM object to jQuery object
                var $row = $(row).closest('tr');
                $tagId = $row.find('.tag-id').html();
                if($tagId){
                    $isCreate = 'no';
                }else{
                    $isCreate = 'yes';
                }
                $tagName = $row.find('.tag-name').html();
                // console.log($tagId +' has name: ' +$tagName);
                updateTag($tagId, $tagName, $isCreate);
            },
            onBeforeDelete: function(row) {
                Swal.fire({
                    title: 'Bạn có chắc muốn?',
                    text: "Xóa xóa tag này không?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Vâng, xóa tag!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        // convert DOM object to jQuery object
                        var $row = $(row).closest('tr');
                        $tagId = $row.find('.tag-id').html();
                        deleteTag($tagId);
                        // need check if delete tag complete or not before removing this row
                        $row.remove();

                        // console.log($row);
                    }

                })
            },
            onDelete: function(event) {
            },
            onAdd: function(row) {
                // // convert DOM object to jQuery object
                // var $row = $(row).closest('tr');
                // $tagName = $row.find('.tag-name').html();
                // console.log($tagName);
                // // updateTag($tagId, $tagName);
            },


        });
        editableTable.init();

        function updateTag(tagId, tagName, isCreate){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                    type: "post",
                    url: "/admin/tags/ajax-update",
                    data: {id:tagId, name:tagName, isCreate:isCreate},
                    dataType: "json",
                    success: function (response) {
                        if(response.message){
                        toastr.success(response.message);
                        };
                    }
                });
        }
        function deleteTag(tagId){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                    type: "DELETE",
                    url: "/admin/tags/ajax-destroy",
                    data: {id:tagId},
                    dataType: "json",
                    success: function (response) {
                        if(response.message){
                        toastr.success(response.message);
                        };
                    }
                });
        }
    </script>
    <script>

    </script>
@endpush

