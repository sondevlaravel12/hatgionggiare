@extends('admin.admin_simplify_master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Thông tin tài khoản quản trị</h4>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Tên</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="{{ $admin->name }}"   readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="{{ $admin->email }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Quyền quản trị</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="admin" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Trạng thái</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="{{ $admin->status==1?'đã kích hoạt':'chưa kích hoạt' }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Ngày tạo</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($admin->created_at)->diffForHumans() }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
