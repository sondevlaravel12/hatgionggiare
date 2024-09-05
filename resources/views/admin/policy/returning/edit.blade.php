@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Chính sách đổi trả</h4>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{route('admin.returnPolicy.update', $returnPolicy)}}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tiêu đề</label>
                        <textarea  class="shorttext" name="title">{!!old('title')??$returnPolicy->title!!}</textarea>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Nội dung</label>
                            <textarea class="myeditorinstance" name="content">{!!old('content')??$returnPolicy->content!!}</textarea>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="col-form-label" for="example-text-input" >Thu mục hình ảnh</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="post-type">
                                    <label class="form-check-label" for="formCheck1">
                                        Hình ảnh bv
                                    </label>
                                </div>
                                <select class="form-control select2-model-type" name="image_directory" id="">
                                    {{-- @if(isset($directories))
                                    <option selected="">Lựa chọn thu mục</option>
                                    @foreach ($directories as $directorie)
                                    <option value="{{ $directorie }}" {{ old('image_directory') == $post->image_directory || $directorie==$post->image_directory? 'selected' : '' }} >{{ $directorie }}</option>
                                    @endforeach
                                    @endif --}}

                                </select>
                                {{-- <select multiple data-role="tagsinput" name="keyword[]" class="typeahead">

                                </select> --}}
                                {{-- <div id="prefetch">
                                    <input class="typeahead form-control" type="text" placeholder="Countries">
                                </div> --}}

                                <div class="card">
                                    <div class="card-body">
                                        <div class="popup-gallery" id="imagesHolder" style="height:450px;
                                        overflow-y: scroll;">
                                            {{-- <a class="float-start" href="assets/images/small/img-1.jpg" title="Project 1">
                                                <div class="img-fluid">
                                                    <img src="assets/images/small/img-1.jpg" alt="img-1" width="120">
                                                </div>
                                            </a> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- end row -->
                    <div class="button-items">
                        <button type="submit" class="btn btn-success waves-effect waves-light float-end">
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
<script type="text/javascript" src="{{ asset('backend/assets/js/custom/features/load_images_from_directory.js') }}"></script>
@endpush
