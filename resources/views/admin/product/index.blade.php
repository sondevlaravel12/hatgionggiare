@extends('admin.admin_master')
@push('stylesheets')
   <!-- Lightbox css -->
   <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />


@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Sản Phẩm</h4>
            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.products.create')}}" class="btn btn-primary waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm sản phẩm mới</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Danh sách sản phẩm</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>


                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Published</th>
                        <th>Action</th>
                        <th>Create at</th>
                        <th>Upadate at</th>


                    </tr>
                    </thead>


                    <tbody>
                        @foreach ($products as $product)

                        <tr>
                            <td>{{$product->id}}</td>

                            <td><img src="{{$product->getFirstImageUrl('medium')}}" class="img-thumbnail" alt="300x300" width="300" data-holder-rendered="true"></td>
                            <td>{{$product->name}}</td>
                            <td>
                                {{-- <div class="square-switch">
                                    <input type="checkbox" id="square-switch1" data-product-id="{{$product->id}}" switch="none" {{$product->status=='published'?'checked':''}}>
                                    <label for="square-switch1" data-on-label="On" data-off-label="Off"></label>
                                </div> --}}
                                <div class="square-switch">
                                    <input type="checkbox" id="{{$product->id}}" data-product-id="{{$product->id}}" switch="none" {{$product->status=='published'?'checked':''}}>
                                    <label for="{{$product->id}}" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </td>
                            <td>
                                <form action="{{route('admin.products.destroy', $product)}}" method="POST" id="confirm_delete">
                                    @method('DELETE')
                                    {{-- <a href="{{route('product.detail', $product)}}" class="popup-youtube btn btn-link mb-2"><i class="fas fa-eye"></i> Preview</a> --}}
                                    {{-- <a target="_blank" href="{{route('product.detail', $product)}}" class="btn btn-sm btn-link"><i class="fas fa-link"></i> link</a> --}}
                                    <a href="{{route('admin.products.edit',  $product)}}" class="btn btn-sm btn-link"><i class="far fa-edit"></i> Edit</a>
                                    <button type="submit" class="btn btn-sm btn-link" ><i class="far fa-trash-alt"></i> Delete</button>
                                    @csrf
                                </form>
                            </td>

                            <td>{{$product->created_at ? \Carbon\Carbon::parse($product->created_at)->diffForHumans() : ''}}</td>
                            <td>{{$product->updated_at ? \Carbon\Carbon::parse($product->updated_at)->diffForHumans() : ''}}</td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@push('scripts')

<script>

$(document).ready( function () {
    $('#datatable').DataTable({

        });
} );

</script>
 <!-- Magnific Popup-->
 <script src="{{asset('backend/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

 <!-- lightbox init js-->
 <script src="{{asset('backend/assets/js/pages/lightbox.init.js')}}"></script>
 <script>
    $("input[type=checkbox]").change(function (e) {
        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-bottom-full-width"
        };
        var $status;
        var $product_id = $(this).attr('id');
        if (e.target.checked) { //If the checkbox is checked
            $status = 'published';

        } else {
            $status = 'draft';
        }

        // csrf token
        var $headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };
        //passing data to laravel controller
        var $data = {
            'product_id': $product_id,
            "status": $status
        };
        $.ajax({
            headers:$headers,
            type:'POST',
            dataType: "json",
            url:'/admin/products/ajax-setpublished',
            data:$data,
            success:function(response) {
                toastr.success(response.success);
            }

        });

    });

 </script>
@endpush

