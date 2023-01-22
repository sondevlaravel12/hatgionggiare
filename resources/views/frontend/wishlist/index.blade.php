@extends('frontend.main_master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Wishlist</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="body-content">
        <div class="container">
            <div class="my-wishlist-page">
                <div class="row">
                    <div class="col-md-12 my-wishlist">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="heading-title">Danh sách yêu thích</th>
                                    </tr>
                                </thead>
                                <tbody id="wishlistTableBody">
                                    {{-- @foreach ($wishlistItems as $wishlistItem)
                                    @php
                                        $product = $wishlistItem->product;
                                    @endphp
                                    <tr>
                                        <td class="col-md-2"><img src="{{ $product->getFirstImageUrl() }}" alt="imga"></td>
                                        <td class="col-md-7">
                                            <div class="product-name"><a href="#">{{ $product->name }}</a></div>
                                            <div class="rating">
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star non-rate"></i>
                                                <span class="review">( 06 Reviews )</span>
                                            </div>
                                            <div class="price">
                                                @php
                                                    if($product->discount_price){
                                                        echo  $product->discount_price .'<span>'.$product->base_price .'</span>';
                                                    }else{
                                                        echo $product->base_price;
                                                    }
                                                @endphp

                                            </div>
                                        </td>
                                        <td class="col-md-2">
                                            <a href="#" class="btn-upper btn btn-primary">Chuyển vào giỏ hàng</a>
                                        </td>
                                        <td class="col-md-1 close-btn">
                                            <button id="{{ $wishlistItem->id }}" onclick="moveToCart(this.id)" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>

                                    @endforeach --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div>
@endsection
