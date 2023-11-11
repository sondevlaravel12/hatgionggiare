@extends('frontend.main_master')
{{-- @section('title')
{{ !empty($title)? $title : 'no title'}}
@endsection --}}
@section('content')

{{-- <div class="container"> --}}

    @include('frontend.body.banner')

    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

        <!-- ============================================== NEW PRODUCTS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">Sản phẩm mới</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">Tất cả</a></li>
              @foreach ($categories as $categorie)
              <li><a data-transition-type="backSlide" href="#category{{ $categorie->id }}" data-toggle="tab">{{ $categorie->name }}</a></li>
              @endforeach
            </ul>
            <!-- /.nav-tabs -->
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="6">
                    @foreach ($products as $product)
                        @include('frontend.product._product_item_carousel',['tag'=>'new'])
                    @endforeach
                </div>
                <!-- /.home-owl-carousel -->
              </div>
              <!-- /.product-slider -->
            </div>
            <!-- /.tab-pane -->
            @foreach ($categories as $category)
            <div class="tab-pane" id="category{{ $category->id }}">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                    @php
                    $products = $category->products->take(12);
                    @endphp
                    @foreach ($products as $product)
                    @include('frontend.product._product_item_carousel',['tag'=>'new'])
                    @endforeach

                </div>
                <!-- /.home-owl-carousel -->
              </div>
              <!-- /.product-slider -->
            </div>
            <!-- /.tab-pane -->
            @endforeach



          </div>
          <!-- /.tab-content -->
        </div>
        <!-- ============================================== NEW PRODUCTS : END ============================================== -->


        <!-- ============================================== MIDDLE BANNER ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
          @include('frontend.body.middel_banner')
        </div>
        <!-- ============================================== MIDDLE BANNER : END ============================================== -->


        <!-- ============================================== BEST SELLING PRODUCTS ============================================== -->
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Sản phẩm bán chạy</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
            @foreach ($bestSellings as $product)
            @include('frontend.product._product_item_carousel',['tag'=>'hot'])
            @endforeach


          </div>
          <!-- /.home-owl-carousel -->
        </section>
        <!-- ============================================== BEST SELLING PRODUCTS : END ============================================== -->

        <!-- ============================================== BANNER ============================================== -->
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
          <div class="row">
            <div class="col-md-12">
              <div class="wide-banner cnt-strip">
                <div class="image"> <img class="img-responsive" src="assets/images/banners/home-banner.jpg" alt="">
                </div>
                <div class="strip strip-text">
                  <div class="strip-inner">
                    <h2 class="text-right">New Mens Fashion<br>
                      <span class="shopping-needs">Save up to 40% off</span>
                    </h2>
                  </div>
                </div>
                <div class="new-label">
                  <div class="text">NEW</div>
                </div>
                <!-- /.new-label -->
              </div>
              <!-- /.wide-banner -->
            </div>
            <!-- /.col -->

          </div>
          <!-- /.row -->
        </div>
        <!-- /.wide-banners -->
        <!-- ============================================== BANNER : END ============================================== -->
        <!-- ============================================== BEST SELLER ============================================== -->

        <div class="best-deal wow fadeInUp outer-bottom-xs">
          <h3 class="section-title">Sản phẩm giảm giá nhiều nhất</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                @foreach ($mostDiscountedProducts->chunk(2) as $group)
                @include('frontend.product._product_item_carousel_2row')
                @endforeach

            </div>
          </div>
          <!-- /.sidebar-widget-body -->
        </div>
        <!-- /.sidebar-widget -->
        <!-- ============================================== BEST SELLER : END ============================================== -->

        <!-- ============================================== NEW POSTs ============================================== -->
        <section class="section latest-blog outer-bottom-vs wow fadeInUp">
          <h3 class="section-title">Bài viết mới</h3>
          <div class="blog-slider-container outer-top-xs">
            <div class="owl-carousel blog-slider custom-carousel">
                @foreach ($posts as $post)
                @include('frontend.post._post_item_carousel')
                @endforeach


            </div>
            <!-- /.owl-carousel -->
          </div>
          <!-- /.blog-slider-container -->
        </section>
        <!-- /.section -->
        <!-- ============================================== NEW POSTs : END ============================================== -->

        <!-- ============================================== HOT POST ============================================== -->
        @include('frontend.post._post_item_4post_custom')

        <!-- ============================================== HOT POST : END ============================================== -->

      </div>

    </div>

    @include('frontend.body.brands')
{{-- </div> --}}

@endsection
