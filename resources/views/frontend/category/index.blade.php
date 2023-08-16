@extends('frontend.main_master')
@section('title')
category
@endsection
@section('css')

@endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'products') }}
@endsection
@section('content')
<div class="breadcrumb">
	<div class="container">
        {{ Breadcrumbs::render('products') }}

	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class='container'>
    <div class="row">
        <!-- ============================================== CONTENT ============================================== -->
        {{-- <div class="col-md-3 sidebar">
            <!-- ================================== TOP NAVIGATION ================================== -->
            <div class="side-menu animate-dropdown outer-bottom-xs">
            <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
            <nav class="yamm megamenu-horizontal">
                <ul class="nav">
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Clothing</a>
                    <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Dresses</a></li>
                            <li><a href="#">Shoes </a></li>
                            <li><a href="#">Jackets</a></li>
                            <li><a href="#">Sunglasses</a></li>
                            <li><a href="#">Sport Wear</a></li>
                            <li><a href="#">Blazers</a></li>
                            <li><a href="#">Shirts</a></li>
                            <li><a href="#">Shorts</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Handbags</a></li>
                            <li><a href="#">Jwellery</a></li>
                            <li><a href="#">Swimwear </a></li>
                            <li><a href="#">Tops</a></li>
                            <li><a href="#">Flats</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Winter Wear</a></li>
                            <li><a href="#">Night Suits</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Toys &amp; Games</a></li>
                            <li><a href="#">Jeans</a></li>
                            <li><a href="#">Shirts</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">School Bags</a></li>
                            <li><a href="#">Lunch Box</a></li>
                            <li><a href="#">Footwear</a></li>
                            <li><a href="#">Wipes</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Sandals </a></li>
                            <li><a href="#">Shorts</a></li>
                            <li><a href="#">Dresses</a></li>
                            <li><a href="#">Jwellery</a></li>
                            <li><a href="#">Bags</a></li>
                            <li><a href="#">Night Dress</a></li>
                            <li><a href="#">Swim Wear</a></li>
                            <li><a href="#">Toys</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-laptop" aria-hidden="true"></i>Electronics</a>
                    <!-- ================================== MEGAMENU VERTICAL ================================== -->
                    <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-4">
                            <ul>
                            <li><a href="#">Gaming</a></li>
                            <li><a href="#">Laptop Skins</a></li>
                            <li><a href="#">Apple</a></li>
                            <li><a href="#">Dell</a></li>
                            <li><a href="#">Lenovo</a></li>
                            <li><a href="#">Microsoft</a></li>
                            <li><a href="#">Asus</a></li>
                            <li><a href="#">Adapters</a></li>
                            <li><a href="#">Batteries</a></li>
                            <li><a href="#">Cooling Pads</a></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-4">
                            <ul>
                            <li><a href="#">Routers &amp; Modems</a></li>
                            <li><a href="#">CPUs, Processors</a></li>
                            <li><a href="#">PC Gaming Store</a></li>
                            <li><a href="#">Graphics Cards</a></li>
                            <li><a href="#">Components</a></li>
                            <li><a href="#">Webcam</a></li>
                            <li><a href="#">Memory (RAM)</a></li>
                            <li><a href="#">Motherboards</a></li>
                            <li><a href="#">Keyboards</a></li>
                            <li><a href="#">Headphones</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-banner-holder"> <a href="#"><img alt="" src="assets/images/banners/banner-side.png"></a> </div>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu -->
                    <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paw" aria-hidden="true"></i>Shoes</a>
                    <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Dresses</a></li>
                            <li><a href="#">Shoes </a></li>
                            <li><a href="#">Jackets</a></li>
                            <li><a href="#">Sunglasses</a></li>
                            <li><a href="#">Sport Wear</a></li>
                            <li><a href="#">Blazers</a></li>
                            <li><a href="#">Shirts</a></li>
                            <li><a href="#">Shorts</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Handbags</a></li>
                            <li><a href="#">Jwellery</a></li>
                            <li><a href="#">Swimwear </a></li>
                            <li><a href="#">Tops</a></li>
                            <li><a href="#">Flats</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Winter Wear</a></li>
                            <li><a href="#">Night Suits</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Toys &amp; Games</a></li>
                            <li><a href="#">Jeans</a></li>
                            <li><a href="#">Shirts</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">School Bags</a></li>
                            <li><a href="#">Lunch Box</a></li>
                            <li><a href="#">Footwear</a></li>
                            <li><a href="#">Wipes</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Sandals </a></li>
                            <li><a href="#">Shorts</a></li>
                            <li><a href="#">Dresses</a></li>
                            <li><a href="#">Jwellery</a></li>
                            <li><a href="#">Bags</a></li>
                            <li><a href="#">Night Dress</a></li>
                            <li><a href="#">Swim Wear</a></li>
                            <li><a href="#">Toys</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-clock-o"></i>Watches</a>
                    <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-4">
                            <ul>
                            <li><a href="#">Gaming</a></li>
                            <li><a href="#">Laptop Skins</a></li>
                            <li><a href="#">Apple</a></li>
                            <li><a href="#">Dell</a></li>
                            <li><a href="#">Lenovo</a></li>
                            <li><a href="#">Microsoft</a></li>
                            <li><a href="#">Asus</a></li>
                            <li><a href="#">Adapters</a></li>
                            <li><a href="#">Batteries</a></li>
                            <li><a href="#">Cooling Pads</a></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-4">
                            <ul>
                            <li><a href="#">Routers &amp; Modems</a></li>
                            <li><a href="#">CPUs, Processors</a></li>
                            <li><a href="#">PC Gaming Store</a></li>
                            <li><a href="#">Graphics Cards</a></li>
                            <li><a href="#">Components</a></li>
                            <li><a href="#">Webcam</a></li>
                            <li><a href="#">Memory (RAM)</a></li>
                            <li><a href="#">Motherboards</a></li>
                            <li><a href="#">Keyboards</a></li>
                            <li><a href="#">Headphones</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-banner-holder"> <a href="#"><img alt="" src="assets/images/banners/banner-side.png"></a> </div>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-diamond"></i>Jewellery</a>
                    <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Dresses</a></li>
                            <li><a href="#">Shoes </a></li>
                            <li><a href="#">Jackets</a></li>
                            <li><a href="#">Sunglasses</a></li>
                            <li><a href="#">Sport Wear</a></li>
                            <li><a href="#">Blazers</a></li>
                            <li><a href="#">Shirts</a></li>
                            <li><a href="#">Shorts</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Handbags</a></li>
                            <li><a href="#">Jwellery</a></li>
                            <li><a href="#">Swimwear </a></li>
                            <li><a href="#">Tops</a></li>
                            <li><a href="#">Flats</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">Winter Wear</a></li>
                            <li><a href="#">Night Suits</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Toys &amp; Games</a></li>
                            <li><a href="#">Jeans</a></li>
                            <li><a href="#">Shirts</a></li>
                            <li><a href="#">Shoes</a></li>
                            <li><a href="#">School Bags</a></li>
                            <li><a href="#">Lunch Box</a></li>
                            <li><a href="#">Footwear</a></li>
                            <li><a href="#">Wipes</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-12 col-md-3">
                            <ul class="links list-unstyled">
                            <li><a href="#">Sandals </a></li>
                            <li><a href="#">Shorts</a></li>
                            <li><a href="#">Dresses</a></li>
                            <li><a href="#">Jwellery</a></li>
                            <li><a href="#">Bags</a></li>
                            <li><a href="#">Night Dress</a></li>
                            <li><a href="#">Swim Wear</a></li>
                            <li><a href="#">Toys</a></li>
                            </ul>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-heartbeat"></i>Health and Beauty</a>
                    <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-lg-4">
                            <ul>
                            <li><a href="#">Gaming</a></li>
                            <li><a href="#">Laptop Skins</a></li>
                            <li><a href="#">Apple</a></li>
                            <li><a href="#">Dell</a></li>
                            <li><a href="#">Lenovo</a></li>
                            <li><a href="#">Microsoft</a></li>
                            <li><a href="#">Asus</a></li>
                            <li><a href="#">Adapters</a></li>
                            <li><a href="#">Batteries</a></li>
                            <li><a href="#">Cooling Pads</a></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-4">
                            <ul>
                            <li><a href="#">Routers &amp; Modems</a></li>
                            <li><a href="#">CPUs, Processors</a></li>
                            <li><a href="#">PC Gaming Store</a></li>
                            <li><a href="#">Graphics Cards</a></li>
                            <li><a href="#">Components</a></li>
                            <li><a href="#">Webcam</a></li>
                            <li><a href="#">Memory (RAM)</a></li>
                            <li><a href="#">Motherboards</a></li>
                            <li><a href="#">Keyboards</a></li>
                            <li><a href="#">Headphones</a></li>
                            </ul>
                        </div>
                        <div class="dropdown-banner-holder"> <a href="#"><img alt="" src="assets/images/banners/banner-side.png"></a> </div>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a>
                    <!-- ================================== MEGAMENU VERTICAL ================================== -->
                    <!-- /.dropdown-menu -->
                    <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
                <!-- /.menu-item -->

                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a>
                    <!-- /.dropdown-menu --> </li>
                <!-- /.menu-item -->

                </ul>
                <!-- /.nav -->
            </nav>
            <!-- /.megamenu-horizontal -->
            </div>
            <!-- /.side-menu -->
            <!-- ================================== TOP NAVIGATION : END ================================== -->
            <div class="sidebar-module-container">
            <div class="sidebar-filter">
                <!-- ============================================== PRODUCT TAGS ============================================== -->
                <div class="sidebar-widget product-tag wow fadeInUp outer-top-vs animated" style="visibility: visible; animation-name: fadeInUp;">
                <h3 class="section-title">Product tags</h3>
                <div class="sidebar-widget-body outer-top-xs">
                    <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a class="item active" title="Vest" href="category.html">Vest</a> <a class="item" title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture" href="category.html">Furniture</a> <a class="item" title="T-shirt" href="category.html">T-shirt</a> <a class="item" title="Sweatpants" href="category.html">Sweatpants</a> <a class="item" title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Toys" href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a> </div>
                    <!-- /.tag-list -->
                </div>
                <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
            <!----------- Testimonials------------->
                <div class="sidebar-widget  wow fadeInUp outer-top-vs  animated" style="visibility: visible; animation-name: fadeInUp;">
                <div id="advertisement" class="advertisement owl-carousel owl-theme" style="opacity: 1; display: block;">
                    <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 1038px; left: 0px; display: block;"><div class="owl-item" style="width: 173px;"><div class="item">
                    <div class="avatar"><img src="assets/images/testimonials/member1.png" alt="Image"></div>
                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                    <div class="clients_author">John Doe <span>Abc Company</span> </div>
                    <!-- /.container-fluid -->
                    </div></div><div class="owl-item" style="width: 173px;"><div class="item">
                    <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image"></div>
                    <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                    <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                    </div></div><div class="owl-item" style="width: 173px;"><div class="item">
                    <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image"></div>
                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                    <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                    <!-- /.container-fluid -->
                    </div></div></div></div>
                    <!-- /.item -->


                    <!-- /.item -->


                    <!-- /.item -->

                <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div><div class="owl-buttons"><div class="owl-prev"></div><div class="owl-next"></div></div></div></div>
                <!-- /.owl-carousel -->
                </div>

                <!-- ============================================== Testimonials: END ============================================== -->

                <div class="home-banner"> <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
            </div>
            <!-- /.sidebar-filter -->
            </div>
            <!-- /.sidebar-module-container -->
        </div> --}}
        <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
            <div id="product-tabs-slider" class="scroll-tabs wow fadeInUp">
                {{-- tabs --}}

                <div class="more-info-tab clearfix ">

                    @include('frontend.category._head_menu')
                    {{-- <form class="navbar-form navbar-right" action="/action_page.php">
                        <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form> --}}
                </div>
                {{-- end tabs --}}

                {{-- content of tabs --}}
                <div class="tab-content outer-top-xs">


                        {{--fillter, sort and paginate tab header--}}
                        <div class="clearfix filters-container m-t-10">
                            <div class="row">
                                <div class="col col-sm-12 col-md-4">
                                    <div class="filter-tabs">
                                        <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Xem theo luới</a> </li>
                                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>Xem theo list</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col col-sm-6 col-md-4 text-right pull-right">
                                    <div class="pagination-container">
                                        {{ $products->links('frontend.partial.custom_paginate')  }}
                                    </div>
                                    <!-- /.pagination-container -->
                                </div>
                            </div>
                        </div>
                        {{--end fillter, sort and paginate tab header--}}

                        <div class="search-result-container ">
                            <div id="myTabContent" class="tab-content category-list">

                                {{-- filter as grid --}}
                                <div class="tab-pane active " id="grid-container">
                                    <div class="category-product">
                                        <div class="row">
                                            @foreach ($products as $product)
                                            <div class="col-xs-6 col-md-4 wow fadeInUp">
                                                <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                    <div class="image"> <a href="{{ route('products.show', [$product, $product->slug]) }}"><img  src="{{ $product->getFirstImageUrl('medium') }}" alt=""></a> </div>
                                                    <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>
                                                    <div class="product-price"> <span class="price"> {{ $product->discount_price }} </span> <span class="price-before-discount">{{ $product->base_price }}</span> </div>
                                                    <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        @include("frontend.category._action")
                                                    <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            @endforeach


                                        </div>
                                        <!-- /.row -->

                                    </div>
                                    <!-- /.category-product -->

                                </div>
                                {{-- end filter as grid --}}

                                {{-- filter as list --}}
                                <div class="tab-pane "  id="list-container">
                                    <div class="category-product">
                                        @foreach ($products as $product)
                                    @include('frontend.category._product_multy_row_in_category')
                                        @endforeach


                                    </div>
                                </div>
                                {{-- end filter as list --}}

                            </div>
                            {{-- paginate in footer box --}}
                            <div class="clearfix filters-container">
                                <div class="text-right">
                                <div class="pagination-container">
                                    {{ $products->links('frontend.partial.custom_paginate')  }}
                                </div>
                                <!-- /.pagination-container --> </div>
                                <!-- /.text-right -->
                            </div>
                            {{-- end paginate in footer box --}}
                        </div>

                </div>
            </div>
        </div>
        <div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
            @include('frontend.product._sidebar')
        </div><!-- /.sidebar -->
    </div>
</div>
@include('frontend.body.brands')
@endsection
