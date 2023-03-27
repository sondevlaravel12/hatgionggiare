@extends('frontend.main_master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>gio hang</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="row">
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
                                            Tiền hàng<span class="inner-left-md" id="priceTotal">600.000</span>
                                        </div><hr>
                                        <div id="totalDiscountContainer">
                                            <div class="cart-sub-total">
                                                <a href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a>
                                                Mã (<span id="couponCode"></span>)<span class="inner-left-md" id="totalDiscount" ></span>
                                            </div><hr>
                                        </div>

                                        <div class="cart-grand-total">
                                            Thành tiền<span class="inner-left-md" id="total">500.000</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                    <tr>
                                        <td>
                                            <div class="cart-checkout-btn pull-right">
                                                <button type="submit" class="btn btn-primary checkout-btn">TIẾN HÀNH THANH TOÁN</button>
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
