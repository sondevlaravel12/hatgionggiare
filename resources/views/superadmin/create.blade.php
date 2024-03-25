@extends('admin.admin_master')
@push('stylesheets')
        <link rel="stylesheet" href="{{asset('asset/admin/stylesheets/image-uploader.min.css')}}">
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
                            <input class="form-control" onkeyup="titleCharCountLive(this.value)" type="text" name="type" value="{{old('type')}}"  >
                            @error('type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="title-char-count"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Gốc</label>
                        <div class="col-sm-10">
                            <input class="form-control" onkeyup="titleCharCountLive(this.value)" type="text" name="relativemodel" value="{{old('relativemodel')}}"  >
                            @error('relativemodel')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="title-char-count"></span>
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




<!-- Image-Uploader -->
{{-- https://christianbayer.github.io/image-uploader/ --}}
<script type="text/javascript" src="{{asset('asset/admin/javascripts/image-uploader.min.js')}}"></script>



<script>
    tinymce.init({
    selector: 'textarea#short_description',
  });
</script>

<!--end Image-Uploader -->


@endpush
