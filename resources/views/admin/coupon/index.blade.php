@extends('admin.admin_master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách coupon</h4>

                <div class="page-title-right">
                    <div >
                        <a href="{{route('admin.coupons.create')}}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm coupon</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Danh sách coupon</h4> --}}

                    <div class="table-responsive">

                        <table class="table mb-0">

                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Tên coupon</th>
                                    <th>Mã</th>
                                    <th>Giảm giá</th>
                                    <th>Hạn sử dụng</th>
                                    <th>Tình trạng</th>
                                    <th>Sửa / Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                <tr>
                                    {{-- <th scope="row">1</th> --}}
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->discount }}&nbsp%</td>
                                    <td>{{ $coupon->expiry }}</td>
                                    <td>
                                        @if($coupon->status == 1)
                                        {{-- <span class="badge badge-pill badge-success"> Active </span> --}}
                                        <span class="badge rounded-pill bg-success">Kích hoạt</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">Chưa kích hoạt</span>
                                        {{-- <span class="badge badge-pill badge-danger"> InActive </span> --}}
                                        @endif

                                    </td>
                                    <td>


                                        <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">Sửa</a>
                                            <button type="submit" class="btn btn-sm btn-outline-danger waves-effect waves-light">Xóa</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
