@extends('admin.admin_master')
@push('stylesheets')
        <link rel="stylesheet" href="{{asset('asset/admin/stylesheets/image-uploader.min.css')}}">
        {{-- select2  --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Thêm mới sample</h4>
                <form action="{{route('superadmin.sample.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tên</label>
                        <div class="col-sm-10">
                            <input class="form-control" onkeyup="titleCharCountLive(this.value)" type="text" name="name" value="{{old('name')}}"  >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="title-char-count"></span>
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Nội dung</label>
                        <div class="col-sm-10">
                            <textarea class="myeditorinstance" name="description">{!! old('description') !!}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="description-char-count"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Mô tả ngắn</label>
                        <div class="col-sm-10">
                            <textarea id="short_description" name="short_description">{!! old('short_description') !!}</textarea>
                            @error('short_description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="description-char-count"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Loại</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="type" id="">
                                <option value="product">Product</option>
                                <option value="post">Post</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Gốc</label>
                        <div class="col-10">
                            <select style="width: 100% !important"  name="oproduct_id" id="oproduct-dropdown" class="form-control select2">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Ghi chú</label>
                        <div class="col-sm-10">
                            <input class="form-control" onkeyup="titleCharCountLive(this.value)" type="text" name="note" value="{{old('note')}}"  >
                            @error('note')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="title-char-count"></span>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="button-items">
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-end">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
{{-- select2  --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- https://jeesite.gitee.io/front/jquery-select2/4.0/index.htm#placeholders --}}




<!-- Image-Uploader -->
{{-- https://christianbayer.github.io/image-uploader/ --}}
<script type="text/javascript" src="{{asset('asset/admin/javascripts/image-uploader.min.js')}}"></script>



<script>
    tinymce.init({
    selector: 'textarea#short_description',
  });
</script>

<!--end Image-Uploader -->

{{-- select2 --}}
<script>
    $(document).ready(function() {
    $('#oproduct-dropdown').select2({
        placeholder: "chọn sản phẩm gốc",
        allowClear: true,
        minimumInputLength: 3,
        ajax: {
            url: "/superadmin/oproduct/select2-search",
            dataType: 'json',
        },
    });
});

</script>
{{-- end select2 --}}



@endpush
