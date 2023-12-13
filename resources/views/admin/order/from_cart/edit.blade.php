@extends('backend.layouts.master')
@push('stylesheets')
    <!-- Lightbox css -->
    <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Đơn Hàng</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.order.fromcarts.index')}}" class="btn btn-info waves-effect waves-light" ><span ><i class="fas fa-arrow-left"></i> Quay lại đơn hàng</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Số Đơn Hàng: <span style="color:rgb(55, 0, 255)">{{$order->order_number}}</span></h4>
                <p class="card-title-desc">
                    <span>
                        Ngày đặt hàng <span style="color:red">{{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('H:i:s  d/m/Y') : '' }}</span>
                    </span> |
                    <span>
                        Tổng tiền đơn hàng <span style="color:red">{{number_format($order->total)}}</span>&nbspVND
                    </span> |
                    <span>
                        Tình trạng: <span style="color:red">{{$arrayStatus[$order->status]}}</span>
                    </span>
                </p>

                <form action="{{route('admin.order.fromcarts.update', $order)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tên khách hàng:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="client_name" value="{{old('client_name')??$order->client_name}}"  >
                            @error('client_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">SDT:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="phone_number" value="{{old('phone_number')??$order->phone_number}}"  >
                            @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Địa chỉ:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="address" value="{{old('address')??$order->address}}"  >
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="email" value="{{old('email')??$order->email}}"  >
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tình trạng đơn hàng:</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="status">
                                @foreach ($arrayStatus as $status=>$vnstatus)
                                <option  value="{{$status}}" {{old('status',$order->status)==$status? 'selected':''}}>{{$vnstatus}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Người dùng ghi chú:</label>
                        <div class="col-sm-10">
                            <input readonly="readonly" class="form-control" type="text" name="notes" value="{{old('notes')??$order->notes}}"  >
                            @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Admin ghi chú:</label>
                        <div class="col-sm-10">
                            <textarea name="admin_notes" class="form-control">{{old('admin_notes')??$order->admin_notes}}</textarea>
                            @error('admin_notes')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="button-items">
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="fas fa-save"></i> Cập nhật đơn hàng
                        </button>
                        <a href="{{route('admin.order.fromcarts.index')}}" class="btn btn-light waves-effect waves-light"><span class="fas fa-ban"></span> &nbsp;Hủy thay đổi</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Sản phẩm đặt</h4><br/>

                <div id="accordion" class="custom-accordion">
                    <div class="card mb-1 shadow-none">
                        <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                            <div class="card-header" id="headingOne">
                                <h6 class="m-0">
                                    Xem chi tiết
                                    <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                </h6>
                            </div>
                        </a>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>


                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá tiền</th>
                                        <th>Tổng Tiền</th>
                                        <th>Xem sản phẩm</th>



                                    </tr>
                                    </thead>


                                    <tbody>

                                        @foreach ($order->items as $item)

                                        <tr class="table-info">
                                            <td>{{$item->product->name}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>
                                                <span>
                                                {{number_format($item->price)}}&nbspVND
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    {{number_format($item->price*$item->quantity)}}&nbspVND
                                                </span>
                                            </td>

                                            <td>

                                                <a href="#test-form-{{$item->id}}"  class="popup-form btn-sm btn-link"><i class="fas fa-eye"></i> Xem</a>

                                                <div class="card mfp-popup-form mx-auto mfp-hide" id="test-form-{{$item->id}}">
                                                    <div class="card-body">
                                                        <h2 class="mb-4">{{$item->product->name}}</h2>
                                                        <div>
                                                            {!!$item->product->short_description!!}
                                                        </div>
                                                        <div>
                                                            {!!$item->product->description!!}
                                                        </div>
                                                    </div>

                                                </div>
                                                <a target="_blank" href="{{route('product.detail', $item->product)}}" class="btn btn-sm btn-link"><i class="fas fa-link"></i> Link</a>
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
        </div>
    </div>
</div>

@endsection
@push('scripts')

    <!-- Magnific Popup-->
    <script src="{{asset('backend/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- lightbox init js-->
    <script src="{{asset('backend/assets/js/pages/lightbox.init.js')}}"></script>

@endpush
