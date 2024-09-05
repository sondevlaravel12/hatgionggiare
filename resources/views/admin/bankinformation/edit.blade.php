@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thông tin tài khoản ngân hàng</h4>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{route('admin.bankInfor.update', $otherInformation)}}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tiêu đề</label>
                        <textarea  class="" name="title">{!!old('title')??$otherInformation->title!!}</textarea>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Nội dung</label>
                        <textarea class="myeditorinstance" name="content1">{!!old('content1')??$otherInformation->content1!!}</textarea>
                        @error('content1')
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
