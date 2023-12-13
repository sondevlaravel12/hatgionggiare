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

        .panel {
            -webkit-border-radius: 0px !important;
            -moz-border-radius: 0px !important;
            border-radius: 0px !important;
                background-color: #fff;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
            padding: 20px;
            border:none
        }
        .panel .panel-heading {
            font-family: 'Open Sans', sans-serif;
            font-size: 20px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            border-radius: 0px;
            text-transform: uppercase;
            padding:0px;
            border:none;
        }
        .panel .panel-heading .unicase-checkout-title > a:not(.collapsed) span {
            background-color: #0f6cb2;
        }
        .panel .panel-heading .unicase-checkout-title {
            margin: 0px !important;
            font-size: 13px;
            font-weight: bold;
        }
        .panel .panel-heading .unicase-checkout-title a {
            color: #555;
            text-transform: uppercase;
            display: block;
        }
        .panel .panel-heading .unicase-checkout-title a span {
            background-color: #aaaaaa;
            color: #fff !important;
            display: inline-block;
            margin-right: 10px;
            padding: 15px 20px;
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
                    <h5 class="heading-title">Thông tin đơn hàng</h5>
                    <div class="panel panel-default" style="text-align:right">
                        <div class="panel-body">

                            <div class="row sub-total" >
                                <div class="col-xs-6">Tiền hàng</div>
                                <div class="col-xs-6">{{ $totalPrice }}<span> đ</span></div>
                            </div>
                            @if ($order->discount)
                            <div class="row sub-total">
                                <div class="col-xs-6">Giảm giá</div>
                                <div class="col-xs-6">-{{ $order->discount }}<span> đ</span></div>
                            </div>

                            <div class="row sub-total">
                                <div class="col-xs-6">Sau giảm giá</div>
                                <div class="col-xs-6">{{ $order->total }}<span> đ</span></div>
                            </div>
                            @endif

                            <hr>
                            <div class="row sub-total">
                                <div class="col-xs-6">Phí vận chuyển</div>
                                <div class="col-xs-6">{{ $shipping_fee }}<span> đ</span></div>
                            </div>
                            <div class="row grand-total">
                                <div class="col-xs-6">Tổng cộng</div>
                                <div class="col-xs-6">{{ $total }}<span> đ</span></div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Sản phẩm đặt
                            </button>
                          </h5>
                        </div>

                        <div id="collapseOne" class="collapse in" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                            @if (!isset($orderItems))
                                <div class="alert alert-danger" style="display:block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    Không có sản phẩm trong giỏ hàng. Quý khách vui lòng đặt hàng lại
                                </div>
                            @endif
                            @foreach ($orderItems as $orderItem)
                                @php
                                    $product = $orderItem->product;
                                @endphp
                                @include('cart._product_multy_row')
                            @endforeach
                          </div>
                        </div>
                    </div> --}}
                    <div class="panel panel-default checkout-step-03">
                        <div class="panel-heading" style="padding: 0px">
                          <h4 class="unicase-checkout-title" style="font-weight: bold">
                            <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseThree" style="color: #555">
                                   <span class="glyphicon glyphicon-chevron-down"></span>Sản phẩm đặt
                            </a>
                          </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse in">
                          <div class="panel-body">
                            @if (!isset($orderItems))
                                <div class="alert alert-danger" style="display:block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    Không có sản phẩm trong giỏ hàng. Quý khách vui lòng đặt hàng lại
                                </div>
                            @endif
                            @foreach ($orderItems as $orderItem)
                                @php
                                    $product = $orderItem->product;
                                @endphp
                                @include('cart._product_multy_row')
                            @endforeach
                          </div>
                        </div>
                      </div>


                    {{-- <div class="row">
                        <h4 class="heading-title">Sản phẩm đặt hàng</h4>
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
                    </div>
                    <hr>
                    <div class="row">
                        <div class=" col-sm-12 cart-shopping-total">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="cart-sub-total">
                                                Trước giảm giá<span class="inner-left-md">{{$totalPrice }} đ</span>
                                            </div>
                                            <div class="cart-sub-total">
                                                Giảm giá<span class="inner-left-md">-{{$order->discount }} đ</span>
                                            </div>
                                            <div class="cart-sub-total">
                                                Sau giảm giá<span class="inner-left-md">-{{$order->total }} đ</span>
                                            </div>
                                            <div class="cart-sub-total">
                                                Grand Total<span class="inner-left-md">$600.00</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <tbody>
                                    <tr>
                                        <th>
                                            <div class="cart-sub-total">
                                                Subtotal<span class="inner-left-md">$600.00</span>
                                            </div>
                                            <div class="cart-grand-total">
                                                Grand Total<span class="inner-left-md">$600.00</span>
                                            </div>
                                        </th>
                                    </tr>
                                </tbody><!-- /tbody -->
                            </table><!-- /table -->
                        </div>
                    </div> --}}

                </div>



                </div>

            </div>
            <hr>
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div>
@endsection
