@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Product</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.coupons.index')}}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-arrow-left"></i> Quay lại danh sách product</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{route('admin.coupons.update', $product)}}" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tên Product</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{old('name')??$product->name}}"  >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Mã Product</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="code" value="{{old('code')??$product->code}}"  >
                            @error('code')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Phần trăm giảm giá</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="discount" value="{{old('discount')??$product->discount}}"  >
                            @error('discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Hạn sử dụng</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="datetime-local" name="expiry" value="{{$product->getRawOriginal('expiry')}}"  >
                            @error('expiry')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-check form-switch mb-3" dir="ltr">
                        <input type="checkbox" class="form-check-input" id="customSwitch1" {{ $product->status==1 ? 'checked' :'' }}>
                        <label class="form-check-label" for="customSwitch1">Kích hoạt</label>
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
