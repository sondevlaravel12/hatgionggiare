<div class="sidebar-module-container">
    <!-- ==============================================CATEGORY============================================== -->
    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
        <h3 class="section-title">Danh Mục</h3>
        <div class="sidebar-widget-body m-t-10">
            <div class="accordion">
                @php
                    $categoriesInSidebar = App\Models\Category::whereNotNull('in_sidebar_widget')->get();
                @endphp
                @include('frontend.product.__sidebar_categorymenu_op1')


            </div><!-- /.accordion -->
        </div>
    </div>
    <!-- ============================================== CATEGORY : END ============================================== -->
    <!-- ============================================== HOT DEALS ============================================== -->
    <div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
        <h3 class="section-title">hot deals</h3>
        <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
            @foreach ($hotDeals as $hotDeal)
            <div class="item product_item_holder">
                <div class="products">
                    <div class="hot-deal-wrapper">
                        <div class="image">
                            <a href="{{ route('products.show', $hotDeal) }}"><img src="{{ $hotDeal->getFirstImageUrl('medium') }}" alt=""></a>
                        </div>
                        <div class="sale-offer-tag"><span>{{ $hotDeal->getDiscountPercentageAttribute() }}%<br>off</span></div>
                        <div class="timing-wrapper">
                            <div class="box-wrapper">
                                <div class="date box">
                                    <span class="key">120</span>
                                    <span class="value">Ngày</span>
                                </div>
                            </div>

                            <div class="box-wrapper">
                                <div class="hour box">
                                    <span class="key">20</span>
                                    <span class="value">Giờ</span>
                                </div>
                            </div>

                            <div class="box-wrapper">
                                <div class="minutes box">
                                    <span class="key">36</span>
                                    <span class="value">Phút</span>
                                </div>
                            </div>

                            <div class="box-wrapper hidden-md">
                                <div class="seconds box">
                                    <span class="key">60</span>
                                    <span class="value">Giây</span>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.hot-deal-wrapper -->

                    <div class="product-info text-left m-t-20">
                        <h3 class="name"><a href="{{ route('products.show', $hotDeal) }}" >{{ $hotDeal->name  }}</a></h3>
                        <div class="rating rateit-small"></div>

                        <div class="product-price">
                            <span class="price">
                                {{ $hotDeal->discount_price }}
                            </span>

                            <span class="price-before-discount">{{ $hotDeal->base_price }}</span>

                        </div><!-- /.product-price -->

                    </div><!-- /.product-info -->

                    <div class="cart clearfix animate-effect">
                        <div class="action">

                            <div class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal"
                                    id="{{ $hotDeal->id }}" onclick="productModalShow(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal"
                                    id="{{ $hotDeal->id }}" onclick="productModalShow(this.id)">Thêm vào giỏ hàng</button>

                            </div>

                        </div><!-- /.action -->
                    </div><!-- /.cart -->
                </div>
            </div>
            @endforeach



        </div><!-- /.sidebar-widget -->
    </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->
    <!-- ============================================== PRODUCT TAGS ============================================== -->
    <div class="sidebar-widget product-tag wow fadeInUp">
        <h3 class="section-title">Tags Sản Phẩm</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list">
                @foreach ($productTags as $productTag)
                <a class="item
                @if (!isset($tag))
                    active
                @elseif (isset($tag)&&$productTag->id==$tag->id)
                    active
                @endif
                " title="Vest" href="{{ route('tags.products.show', $productTag) }}">{{ $productTag->name }}</a>
                @endforeach

            </div><!-- /.tag-list -->
        </div><!-- /.sidebar-widget-body -->
    </div><!-- /.sidebar-widget -->
    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
</div>
