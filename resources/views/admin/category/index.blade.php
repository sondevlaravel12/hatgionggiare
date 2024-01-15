@extends('admin.admin_master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh mục sản phẩm</h4>

                <div class="page-title-right">
                    <div >
                        <a href="{{route('admin.categories.create')}}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm danh mục sản phẩm</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Danh sách danh mục sản phẩm</h4> --}}

                    <div class="table-responsive">

                        <table  id="datatable-default" class="table mb-0">

                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Tên danh mục</th>
                                    <th>Slug</th>
                                    <th>Hình ảnh</th>
                                    <th>Mô tả</th>
                                    <th>Danh mục cha</th>
                                    <th>Sửa / Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    {{-- <th scope="row">1</th> --}}
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td><img src="{{$category->getFirstImageUrl('medium')}}" class="img-thumbnail" alt="300x300" width="300" data-holder-rendered="true"></td>

                                    <td>{!! $category->description !!}</td>
                                    <td>{{ $category->parent?$category->parent->name:'' }}</td>

                                    <td>
                                        {{-- <form action="{{ route('admin.categories.destroy', $category) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">Sửa</a>
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect waves-light">Xóa</button>
                                        </form> --}}
                                        <a href="{{route('admin.categories.edit',  $category)}}" class="btn btn-sm btn-link"><i class="far fa-edit"></i> Sửa</a>
                                        {{-- <a href="/admin/categories/invoiceId/edit" class="btn btn-sm btn-link"><i class="far fa-edit"></i>&nbsp;&nbsp;Sửa</a> --}}
                                        <button type="submit" class="btn btn-sm btn_category_delete" data-categoryid="{{$category->id}}"><i class="far fa-trash-alt"></i> Xóa</button>

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


 <!-- Magnific Popup-->
 <script src="{{asset('backend/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>



 <script>
    // var $defaultTable = $("#datatable-default");
    // var $defaultDatatable = $defaultTable.DataTable({
    //     order: [[0, 'desc']],
    // });
    // sweetalert before deleting
    $table.on('click','.btn_category_delete', function(){
        Swal.fire({
            title: 'Bạn có chắc muốn?',
            text: "Xóa xóa danh mục sản phẩm này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, xóa danh mục sản phẩm!'
            }).then((result) => {
            if (result.isConfirmed) {
                var $row = $defaultDatatable.row($(this).parents('tr'));
                var $categoryId = $(this).attr('data-categoryid');
                // console.log($productId);
                deleteCategory($categoryId, $row)
            }

        })

    });

    function deleteCategory($categoryId, $row){
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        $.ajax({
            type: "DELETE",
            url: "/admin/categories/ajax-delete",
            data: {categoryID:$categoryId},
            dataType: "json",
            success: function (response) {
                if(response.message){
                $row.remove().draw(false);
                toastr.success(response.message);
                return true;
                };
            }
        });
    };

 </script>
@endpush
