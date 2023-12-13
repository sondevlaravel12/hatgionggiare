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
        .order-summary{
            background-color: #fafafa;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.08);
            padding: 24px 50px;
        }
        .order-summary .sub-total{
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            color: #555;
            margin-bottom: 7px;
        }

    </style>
@endsection
@section('title')
    @isset($title)
        {{ $title }}
    @endisset
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'checkout') }}
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            {{ Breadcrumbs::render('checkout') }}

        </div><!-- /.container -->
    </div>

    <div class="body-content">
        <div class="container order-summery">
            <div class="row">

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="heading-title">Thông tin khách hàng</h5>

                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Họ tên</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="username"
                                            value="{{ old('username') }}">
                                        @error('username')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="phone"
                                            value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Địa chỉ nhận
                                        hàng</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" id="" cols="30" rows="3">{{ old('address') }}</textarea>

                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Email (nếu có)</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Ghi chú đơn hàng</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="note"
                                            value="{{ old('note') }}">
                                        @error('note')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-10">
                                        <div style="margin-bottom: 15px;">
                                            Phương thức thanh toán: <span style="color:red; font-weight: bold;">giao hàng và
                                                thu tiền tại nhà (COD)</span>
                                        </div>
                                        <div>
                                            <input type="checkbox" id="dongychinhsach" name="dongychinhsach"
                                                class="chinhsach" value="dongychinhsach" checked="">
                                            <label for="dongychinhsach">Tôi đồng ý với các chính sách và quy định mua hàng
                                                tại website</label>
                                            @error('dongychinhsach')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div style="color:red; font-weight: bold; margin-top:10px;">
                                            <input type="checkbox" id="phuongthucthanhtoan" class="chinhsach" name="PTTT"
                                                disabled="disabled" value="PTTT" checked="">
                                            <label for="phuongthucthanhtoan">
                                                Phương thức thanh toán: NHẬN HÀNG VÀ THANH TOÁN TẠI NHÀ!
                                            </label>
                                        </div>

                                        <hr style="border:1px solid #f1f1f1; margin-top:17px;">

                                    </div>
                                </div>
                                <div class="cart-checkout-btn mb-3">
                                    <button type="submit" class="btn btn-primary checkout-btn">HOÀN TẤT ĐẶT HÀNG</button>
                                </div>


                                <!-- end row -->

                                {{-- <div class="button-items">
                                    <button type="submit" class="btn btn-success waves-effect waves-light pull-right">
                                        <i class="fas fa-save"></i> Tiếp tục
                                    </button>
                                </div> --}}
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 ">
                    <h5 class="heading-title">Thông tin đơn hàng</h5>
                    <div class="card" style="text-align:right">
                        <div class="card-body order-summary">

                            <div class="row sub-total" >
                                <div class="col-xs-6">Tiền hàng</div>
                                <div class="col-xs-6">{{ Cart::priceTotal() }}<span> đ</span></div>
                            </div>
                            @if (Cart::discount())
                            <div class="row sub-total">
                                <div class="col-xs-6">Giảm giá</div>
                                <div class="col-xs-6">-{{ Cart::discount() }}<span> đ</span></div>
                            </div>

                            <div class="row sub-total">
                                <div class="col-xs-6">Sau giảm giá</div>
                                <div class="col-xs-6">{{ Cart::total() }}<span> đ</span></div>
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
                    <div class="card">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Sản phẩm đặt
                            </button>
                          </h5>
                        </div>

                        <div id="collapseOne" class="collapse in" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                            @if (Cart::content()->count() < 1)
                                <div class="alert alert-danger" style="display:block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    Không có sản phẩm trong giỏ hàng. Quý khách vui lòng đặt hàng lại
                                </div>
                            @endif
                            @foreach (Cart::content() as $cart)
                                @php
                                    $product = $cart->model;
                                @endphp
                                @include('cart._product_multy_row')
                            @endforeach
                          </div>
                        </div>
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
