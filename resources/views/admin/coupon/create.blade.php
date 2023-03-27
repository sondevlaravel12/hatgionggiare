@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Coupon</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.coupons.index')}}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-arrow-left"></i> Quay lại danh sách coupon</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{route('admin.coupons.store')}}" method="POST" >
                    @csrf
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tên Coupon</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{old('name')}}"  >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Mã Coupon</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="code" value="{{old('code')}}"  >
                            @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Phần trăm giảm giá</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="discount" value="{{old('discount')}}"  >
                            @error('discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Hạn sử dụng</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="datetime-local" name="expiry" value="{{old('expiry')}}" min="{{ Carbon\Carbon::now()->format('Y-m-d H:i') }}" >
                            @error('expiry')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
