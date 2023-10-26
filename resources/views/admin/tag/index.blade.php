@extends('admin.tag.tag_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách tag</h4>

                <div class="page-title-right">
                    <div >
                        <a id="add-new-tag" href="#" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm tag</span></a>
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
                                    <th>Tên tag</th>
                                    <th>Loại</th>
                                    <th>Sl liên kết</th>
                                    <th>Chỉnh Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)

                                <tr data-id="{{ $tag->id }}" data-name="{{ $tag->name }}">
                                    <td class="tag-id">{{$tag->id}}</td>
                                    <td class="tag-name">{{ $tag->name }}</td>
                                    <td>
                                        {{-- {{$tag->type}} --}}
                                        <span class="badge {{$tag->type=='product'?'bg-info':'bg-success'}} ">{{$tag->type}}</span>
                                    </td>
                                    <td>{{ $tag->products?$tag->products->count():$tag->posts->count() }}</td>
                                    <td>
                                        <input class="tag-id" type="hidden" id="{{ $tag->id }}" value="{{ $tag->id }}">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-link js-edit-tag"  ><i class="far fa-edit"></i> Sửa</button>

                                        <button  class="btn btn-sm btn_product_delete js-remove-tag"><i class="far fa-trash-alt"></i> Xóa</button>
                                        <!-- end Button trigger modal -->
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- modal edit  --}}
                        <div id="edittagmodal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{-- <h5 class="modal-title" id="tagid">tag id: </h5> --}}
                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" class="tag-id-in-modal">
                                        <div class="mb-3">
                                            <label>Tên tag</label>
                                            <input class="tagname" type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light btn-save-edit-tag">Save</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        {{-- modal add new  --}}
                        <div id="addnewtagmodal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{-- <h5 class="modal-title" id="tagid">tag id: </h5> --}}
                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                    </div>
                                    <div class="modal-body">
                                        {{-- <input type="hidden" class="tag-id-in-modal"> --}}
                                        <div class="mb-3">
                                            <label>Tên tag</label>
                                            <input id="tagname" type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Hủy</button>
                                        <button id="btn-save-addnew-tag" type="button" class="btn btn-primary waves-effect waves-light ">Lưu</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        {{-- end add new  --}}
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection


