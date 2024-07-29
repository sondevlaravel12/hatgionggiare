@extends('admin.admin_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách metatag</h4>

                <div class="page-title-right">
                    <div >
                        <a id="add-new-metatag" href="{{ route('admin.metatags.attatch') }}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm metatag</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="card-title"><a href="" class="btn btn-dark float-end mb-2">them metatag</a></div> --}}
                    {{-- <button id="new-row-button" class="btn btn-dark pull-end mb-2">Thêm metatag</button> --}}

                    <div class="table-responsive">

                        <table class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline "  id="datatable">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Model</th>
                                    <th>Description</th>
                                    <th>Author</th>
                                    <th>Keyword</th>
                                    <th>Robots</th>
                                    <th>Chỉnh Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($metatags as $metatag)

                                <tr data-id="{{ $metatag->id }}">
                                    <td class="metatag-id">{{$metatag->id}}</td>
                                    <td class="metatag-title">{{ $metatag->title }}</td>
                                    <td>
                                        @if ($metatag->model_type=='App\Models\Product')
                                        Product | <a href="{{ route('products.show',$metatag->model) }}">{{ $metatag->model->name }}</a>
                                        @elseif ($metatag->model_type=='App\Models\Post')
                                        Post | <a href="{{ route('posts.show',$metatag->model ) }}">{{ $metatag->model->title }}</a>
                                        @endif
                                    </td>
                                    <td class="metatag-description">{{ $metatag->description }}</td>
                                    <td class="metatag-author">{{ $metatag->author }}</td>
                                    <td class="metatag-keyword">{{ $metatag->keyword }}</td>
                                    <td class="metatag-robots">{{ $metatag->robots }}</td>
                                    <td>
                                        <input class="metatag-id" type="hidden" id="{{ $metatag->id }}" value="{{ $metatag->id }}">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-link js-edit-metatag"  ><i class="far fa-edit"></i> Sửa</button>

                                        <button  class="btn btn-sm btn_product_delete js-remove-metatag"><i class="far fa-trash-alt"></i> Xóa</button>
                                        <!-- end Button trigger modal -->
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('admin.metatag.modal')
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>
    $('table').on('click','.js-edit-metatag', function () {
        // -----fill in modal -----//
        // get metatag id
        $metatagId = $(this).siblings('input.metatag-id').val();
        // call ajax to get all tag info and fill in modal with infos just get
        getMetatagInfo($metatagId).done(function(data){
            fillModalMetatagEdit(data);
            $('#editmetatagmodal').modal('show');
        })
    });
    $('#editmetatagmodal').on('click','.btn-save-edit-metatag', function () {
        $('#editmetatagmodal').modal('hide');
        updateMetatag().done(function(response){
            // console.log(response);
            refetchTable(response);
            displayNotification(response['message']);
        });
    })
</script>
<script>
    function getMetatagInfo(metatagId){
        // return the ajax promise
        return $.ajax({
            type: "get",
            url: "/admin/metatags/ajax-get-metatag-info",
            data: {id:metatagId},
            dataType: "json",
        });
    }
    function fillModalMetatagEdit(data){
        $modalMetatagEdit = $('#editmetatagmodal');
        $modalMetatagEdit.find('input[name=id]').val(data.id);
        $modalMetatagEdit.find('input[name=title]').val(data.title);
        $modalMetatagEdit.find('textarea[name=description]').html(data.description);
        $modalMetatagEdit.find('input[name=author]').val(data.author);
        $modalMetatagEdit.find('textarea[name=keyword]').val(data.keyword);
        $modalMetatagEdit.find('textarea[name=robots]').val(data.robots);
        $modalMetatagEdit.find('input[name=model_name]').val(data.model.name??data.model.title);
    }
    function refetchTable(response){
        // $row = $('table').find('#'. response.id .'');
        $row = $('table').find("tr[data-id="+ response.metatag.id  +"]");
        $row.find('.metatag-title').html(response.metatag.title);
        $row.find('.metatag-description').html(response.metatag.description);
        $row.find('.metatag-author').html(response.metatag.author);
        $row.find('.metatag-keyword').html(response.metatag.keyword);
        $row.find('.metatag-robots').html(response.metatag.robots);
    }
    function updateMetatag(){
        return $.ajax({
            type: "get",
            url: "/admin/metatags/update-metatag",
            data: $('#update-metatag-form').serialize(),
            dataType: "json",
        });
    }
</script>

@endpush


