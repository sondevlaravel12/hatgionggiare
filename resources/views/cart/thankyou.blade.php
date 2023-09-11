@extends('frontend.main_master')
@section('css')
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
<style>
    .mb-1 {
            margin-bottom: .65rem;
        }

        .mb-3 {
            margin-bottom: 2.65rem;
        }

        .grand-total {
            color: #84b943;
            font-family: 'Open Sans', sans-serif;
            font-size: 18px;
            font-weight: bold;
        }
        .goods-total{
            font-size: 18px;
            font-weight: bold;
        }
</style>
@endsection
@section('title')
@isset($title)
{{ $title }}
@endisset
@endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'thankyou', $order) }}
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            {{ Breadcrumbs::render('thankyou', $order) }}

        </div><!-- /.container -->
    </div>

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="section__header">
                        <h3 style="margin-bottom: 10px; color:red;">*Đơn hàng của quý khách đã đặt thành công</h3></br>
                        <h3 style="margin-bottom: 10px;">Cám ơn bạn đã mua hàng tại {{route('home')}}</h3>
                        <h3 style="margin-bottom: 10px;">*Phương thức thanh toán: Nhận hàng và thanh toán tại nhà(COD)</h3></br>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <h5 class="heading-title">Thông Tin Giao Hàng</h5>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Họ tên</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="username" value="{{$order->client_name}}" disabled >
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="phone" value="{{$order->phone_number}}" disabled >
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Địa chỉ nhận hàng</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" id="" cols="30" rows="3" disabled>{{$order->address}}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email" value="{{$order->email}}" disabled >
                                    </div>
                                </div>
                                <a href="/"> <input type="button" name="ok" value="Quay Về Trang Chủ" class="btn"></a>


                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 ">
                    <h5 class="heading-title">Sản phẩm đặt hàng</h5>
                        @if (!isset($orderItems))
                            <div class="alert alert-danger" style="display:block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                Không có sản phẩm trong giỏ hàng. Quý khách vui lòng đặt hàng lại
                            </div>

                        @else
                        @foreach ($orderItems as $orderItem)
                            @php
                                $product = $orderItem->product;
                            @endphp
                            @include('cart._product_multy_row')
                        @endforeach
                        @endif

                        <hr>
                        <div class="row goods-total">
                            <div class="col-xs-4">Tiền hàng</div>
                            <div class="col-xs-8">{{ number_format($order->total, 0, ',', '.') .' đ' }}</div>
                        </div>
                        <hr>
                        <div class="row goods-total">
                                <div class="col-xs-4">Phí vận chuyển</div>
                                <div class="col-xs-8">{{ $shipping_fee }}<span> đ</span></div>
                            </div>
                            <hr>
                            <div class="row grand-total">
                                <div class="col-xs-4">Tổng cộng (đã tính phí vận chuyển)</div>
                                <div class="col-xs-8">{{ $total }}<span> đ</span></div>
                            </div>

            </div>



                </div>

            </div>
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div>
@endsection
