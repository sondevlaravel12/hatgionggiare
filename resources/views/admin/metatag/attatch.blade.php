@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Attatch </h4>
                <form action="{{route('admin.metatags.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">description</label>
                            {{-- <input type="text" class="form-control" name="description"> --}}
                            <textarea class="form-control" name="description" id="" cols="30" rows="2">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Author</label>
                            <input type="text" class="form-control" name="author" value="{{ old('author') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Keyword</label>
                            {{-- <input type="text" class="form-control" name="keyword"> --}}
                            <textarea class="form-control" name="keyword" id="" cols="30" rows="2">{{ old('keyword') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Robots</label>
                            {{-- <input type="text" class="form-control" name="robots"> --}}
                            <textarea class="form-control" name="robots" id="" cols="30" rows="2">{{ old('robots') }}</textarea>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 ">
                            <div class="d-flex flex-wrap gap-2">
                                <div class="square-switch mt-2">
                                    <input type="checkbox" id="square-switch1"  switch="none" value="on" name="model_type_switch"
                                    @if(!old() || old('model_type_switch') == 'on') checked="checked" @endif >
                                    <label for="square-switch1" data-on-label="SP" data-off-label="BV"></label>
                                </div>
                                <label class="col-sm-4 col-form-label ">Sản Phẩm | Bài Viết</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <input class="form-control" id="autosearch_without_relationship" type="text" name="model_title" value="{{ old('model_title') }}">
                            <input type="hidden" name="model_id" value="{{ old('model_id') }}">
                            @error('model_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="hidden" name="model_type" value="{{ old('model_type') }}">
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
