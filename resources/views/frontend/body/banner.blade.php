<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- ========================================== SECTION – HERO ========================================= -->

        <div id="hero">
            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                @foreach (App\Models\Slider::all() as $slider)
                    <div class="item" style="background-image: url({{ $slider->getFirstImageUrl() }});">
                        <div class="container-fluid">
                        <div class="caption bg-color vertical-center text-left">
                            <div class="slider-header fadeInDown-1">{{ $slider->header }}</div>
                            <div class="big-text fadeInDown-1"> {{ $slider->big_text }} </div>
                            <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->short_description }}</span> </div>
                            <div class="button-holder fadeInDown-3"> <a href="index.php?page=single-product"
                                class="btn-lg btn btn-uppercase btn-primary shop-now-button">{{ $slider->call_to_action }}</a> </div>
                        </div>
                        <!-- /.caption -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                @endforeach

            </div>
            <!-- /.owl-carousel -->
        </div>

        <!-- ========================================= SECTION – HERO : END ========================================= -->

        <!-- ============================================== INFO BOXES ============================================== -->
        <div class="info-boxes wow fadeInUp hidden-xs">
            <div class="info-boxes-inner">
            <div class="row">
                <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                    <div class="row">
                    <div class="col-xs-12">
                        <h4 class="info-box-heading green">money back</h4>
                    </div>
                    </div>
                    <h6 class="text">30 Days Money Back Guarantee</h6>
                </div>
                </div>
                <!-- .col -->

                <div class="hidden-md col-sm-4 col-lg-4">
                <div class="info-box">
                    <div class="row">
                    <div class="col-xs-12">
                        <h4 class="info-box-heading green">free shipping</h4>
                    </div>
                    </div>
                    <h6 class="text">Shipping on orders over $99</h6>
                </div>
                </div>
                <!-- .col -->

                <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                    <div class="row">
                    <div class="col-xs-12">
                        <h4 class="info-box-heading green">Special Sale</h4>
                    </div>
                    </div>
                    <h6 class="text">Extra $5 off on all items </h6>
                </div>
                </div>
                <!-- .col -->
            </div>
            <!-- /.row -->
            </div>
            <!-- /.info-boxes-inner -->

        </div>
        <!-- /.info-boxes -->
        <!-- ============================================== INFO BOXES : END ============================================== -->
    </div>
</div>
