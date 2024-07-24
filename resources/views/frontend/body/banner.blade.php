<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- ========================================== SECTION – HERO ========================================= -->

        <div id="hero">
            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                @foreach (App\Models\Slider::where('type','=','top_slider')->orderBy('order', 'ASC')->get() as $slider)
                    <div class="item" style="background-image: url({{ $slider->getFirstImageUrl() }});">
                        <div class="container-fluid">
                        <div class="caption bg-color vertical-center text-left">
                            <div class="slider-header fadeInDown-1" style="{{ $slider->header_css??'' }}">{{ $slider->header }}</div>
                            <div class="big-text fadeInDown-1" style="{{ $slider->big_text_css??'' }}"> {{ $slider->big_text }} </div>
                            <div class="excerpt fadeInDown-2 hidden-xs" style="{{ $slider->short_description_css??'' }}"> <span>{{ $slider->short_description }}</span> </div>
                            <div class="button-holder fadeInDown-3"> <a href="{{ $slider->link }}"
                                class="btn-lg btn btn-uppercase btn-primary shop-now-button" style="{{ $slider->call_to_action_css??'' }}">{{ $slider->call_to_action }}</a> </div>
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
                        <h4 class="info-box-heading green">Chất lượng cao</h4>
                    </div>
                    </div>
                    <h6 class="text">Hạt giống chất lượng cao nhất</h6>
                </div>
                </div>
                <!-- .col -->

                <div class="hidden-md col-sm-4 col-lg-4">
                <div class="info-box">
                    <div class="row">
                    <div class="col-xs-12">
                        <h4 class="info-box-heading green">Ship COD</h4>
                    </div>
                    </div>
                    <h6 class="text">Ship hàng thu tiền tại nhà toàn quốc</h6>
                </div>
                </div>
                <!-- .col -->

                <div class="col-md-6 col-sm-4 col-lg-4">
                <div class="info-box">
                    <div class="row">
                    <div class="col-xs-12">
                        <h4 class="info-box-heading green">Nhiều ưa đãi </h4>
                    </div>
                    </div>
                    <h6 class="text">Nhiều ưu đãi giảm giá đặt biệt </h6>
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
