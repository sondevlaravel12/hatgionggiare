@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Giới thiệu Cty</h4>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{route('admin.about.update', $about)}}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tên Cty</label>
                        <textarea  class="shorttext" name="company_name">{!!old('company_name')??$about->company_name!!}</textarea>
                        @error('company_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Giới Thiệu</label>
                        <textarea class="myeditorinstance" name="description">{!!old('description')??$about->description!!}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Thông tin liên lạc</label>
                        <textarea class="shorttext" name="contact">{!!old('contact')??$about->contact!!}</textarea>
                        @error('contact')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

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
