@extends('frontend.main_master')

@section('content')

{{-- <div class="container"> --}}
    <div class="terms-conditions-page">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">
              <h2 class="heading-title">{!!$about->company_name!!}</h2>

              {!! $about->description !!}
              {!! $about->contact !!}

            </div>

          </div>
    </div>
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

    @include('frontend.body.brands')
{{-- </div> --}}

@endsection

