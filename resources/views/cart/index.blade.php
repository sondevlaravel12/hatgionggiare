@extends('frontend.main_master')
@section('title')
@isset($title)
{{ $title }}
@endisset
{{-- @endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'cart') }}
@endsection --}}
@section('content')
    {{-- <div class="breadcrumb">
        <div class="container">
            {{ Breadcrumbs::render('cart') }}
        </div>
    </div> --}}

    <div class="body-content">
        <div class="container">
            <div class="row">
                @if (Cart::content()->count()<1)
                <div class="alert alert-danger" style="display:block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Không có sản phẩm trong giỏ hàng
                </div>
                @endif
                @if (session('message'))
                <div class="alert alert-danger" style="display:block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <b>{{ session('message') }}</b>
                </div>
                @endif
                <div class="shopping-cart">
                    <div class="shopping-cart-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-romove item">Hình ảnh</th>
                                        <th class="cart-description item">Tên SP</th>
                                        <th class="cart-product-name item">Số lượng</th>
                                        <th class="cart-edit item">Thành tiền</th>
                                        <th class="cart-qty item">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody id="cartTableBody">


                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 col-sm-12 estimate-ship-tax">

                    </div><!-- /.estimate-ship-tax --> --}}
                    <hr>
                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                        <table class="table" id="couponContainer">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Mã giảm giá</span>
                                        <p>Nhập mã giảm giá</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input id="couponName" type="text" class="form-control unicase-form-control text-input" placeholder="abcxyz...">
                                            </div>
                                            <div class="clearfix pull-right">
                                                <button type="submit" onclick="applyCoupon()" class="btn-upper btn btn-primary">XÁC NHẬN</button>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div><!-- /.estimate-ship-tax -->

                    <div class="col-md-6 col-sm-12 cart-shopping-total pull-right">
                        <table class="table" id="totalContainer">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            Tiền hàng<span class="inner-left-md" id="priceTotal">600.000</span>&nbsp;<span>đ</span>
                                        </div><hr>
                                        <div id="totalDiscountContainer">
                                            <div class="cart-sub-total">
                                                <button href="#" title="cancel" class="btn btn-danger btn-xs" onclick="removeCoupon()"><i class="fa fa-trash-o"></i></button>
                                                <span id="couponCode" style="font-size: 8px"></span><span class="inner-left-md" id="totalDiscount" ></span>&nbsp;<span>đ</span>
                                            </div><hr>
                                        </div>

                                        <div class="cart-grand-total">
                                            Thành tiền<span class="inner-left-md" id="total">500.000</span>&nbsp;<span>đ</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                    <tr>
                                        <td>
                                            <div class="cart-checkout-btn pull-right">
                                                <a href="{{ route('cart.checkout') }}" class="btn btn-primary checkout-btn">TIẾN HÀNH ĐẶT HÀNG</a>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div><!-- /.cart-shopping-total -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div>
@endsection
