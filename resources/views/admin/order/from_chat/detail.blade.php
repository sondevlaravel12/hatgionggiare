@extends('backend.layouts.master')
@push('stylesheets')
    <!-- Lightbox css -->
    <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />
<style>
 .oder-info{
    color: #095e92;
 }
</style>
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
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Số Đơn Hàng:</strong>
                                </td>
                                <td>
                                    <b class="oder-info">
                                        {{$order->order_number}}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Tổng tiền:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{number_format($order->total)}}&nbspVND
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Tên người dùng:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{$order->client_name}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>SDT:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{$order->phone_number}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Địa chỉ:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{$order->address}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Email:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{$order->email}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Tình trạng đơn hàng:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{$arrayStatus[$order->status]}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Người dùng ghi chú:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{$order->email}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Admin ghi chú:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{$order->admin_notes}}
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>Ngày đặt hàng:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                    {{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Ngày cập nhật:</strong>
                                </td>
                                <td>
                                    <span class="oder-info">
                                        {{\Carbon\Carbon::parse($order->update_at)->diffForHumans()}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Thao tác</strong></td>
                                <td>

                                    <a href="{{route('admin.order.fromchats.edit',$order)}}" class="btn btn-sm btn-link"><i class="far fa-edit"></i>
                                            Chỉnh sửa</a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
