@extends('frontend.main_master')
@section('content')
<div class="container">
    <div class="row">
      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
              <li><a data-transition-type="backSlide" href="#smartphone" data-toggle="tab">Clothing</a></li>
              <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
              <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li>
            </ul>
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">

                {{--fillter, sort and paginate tab header--}}
                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                      <div class="col col-sm-6 col-md-2">
                        <div class="filter-tabs">
                          <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                            <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Xem theo luới</a> </li>
                            <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>Xem theo list</a></li>
                          </ul>
                        </div>
                        <!-- /.filter-tabs -->
                      </div>
                      {{-- sort --}}
                      <div class="col col-sm-12 col-md-6">
                        <div class="col col-sm-3 col-md-6 no-padding">
                          <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                            <div class="fld inline">
                              <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                                <ul role="menu" class="dropdown-menu">
                                  <li role="presentation"><a href="#">position</a></li>
                                  <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                  <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                  <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                </ul>
                              </div>
                            </div>
                            <!-- /.fld -->
                          </div>
                          <!-- /.lbl-cnt -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-3 col-md-6 no-padding">
                          <div class="lbl-cnt"> <span class="lbl">Show</span>
                            <div class="fld inline">
                              <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                                <ul role="menu" class="dropdown-menu">
                                  <li role="presentation"><a href="#">1</a></li>
                                  <li role="presentation"><a href="#">2</a></li>
                                  <li role="presentation"><a href="#">3</a></li>
                                  <li role="presentation"><a href="#">4</a></li>
                                  <li role="presentation"><a href="#">5</a></li>
                                  <li role="presentation"><a href="#">6</a></li>
                                  <li role="presentation"><a href="#">7</a></li>
                                  <li role="presentation"><a href="#">8</a></li>
                                  <li role="presentation"><a href="#">9</a></li>
                                  <li role="presentation"><a href="#">10</a></li>
                                </ul>
                              </div>
                            </div>
                            <!-- /.fld -->
                          </div>
                          <!-- /.lbl-cnt -->
                        </div>
                        <!-- /.col -->
                      </div>
                      {{-- end sort --}}
                      {{-- paginate --}}
                      <div class="col col-sm-6 col-md-4 text-right">
                        <div class="pagination-container">
                          <ul class="list-inline list-unstyled">
                            <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                          </ul>
                          <!-- /.list-inline -->
                        </div>
                      </div>
                      {{-- end paginate --}}
                    </div>
                </div>
                {{--end fillter, sort and paginate tab header--}}

                <div class="search-result-container ">

                    <div id="myTabContent" class="tab-content category-list">

                        {{-- filter as grid --}}
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    @for ($i=0; $i<18;$i++)
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                <div class="image"> <a href="detail.html"><img  src="{{ asset('frontend/assets/images/products/p5.jpg') }}" alt=""></a> </div>
                                                <!-- /.image -->
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                                <!-- /.product-price -->

                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>
                                    @endfor

                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        {{-- end filter as grid --}}

                        {{-- filter as list --}}
                        <div class="tab-pane "  id="list-container">
                            <div class="category-product">
                                @for ($i=0; $i<18;$i++)
                                <div class="category-product-inner wow fadeInUp">
                                    <div class="products">
                                        <div class="product-list product">
                                        <div class="row product-list-row">
                                            <div class="col col-sm-4 col-lg-4">
                                            <div class="product-image">
                                                <div class="image"> <img src="{{ asset('frontend/assets/images/products/p3.jpg') }}" alt=""> </div>
                                            </div>
                                            <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col col-sm-8 col-lg-8">
                                            <div class="product-info">
                                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                                <!-- /.product-price -->
                                                <div class="description m-t-10">Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget, lacinia id purus. Suspendisse posuere arcu diam, id accumsan eros pharetra ac. Nulla enim risus, facilisis bibendum gravida eget.</div>
                                                <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                    </ul>
                                                </div>
                                                <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->

                                            </div>
                                            <!-- /.product-info -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-list-row -->
                                        <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-list -->
                                    </div>
                                    <!-- /.products -->
                                </div>
                                @endfor

                            </div>
                        </div>
                        {{-- end filter as list --}}

                    </div>
                    {{-- paginate in footer box --}}
                    <div class="clearfix filters-container">
                        <div class="text-right">
                        <div class="pagination-container">
                            <ul class="list-inline list-unstyled">
                            <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                            <!-- /.list-inline -->
                        </div>
                        <!-- /.pagination-container --> </div>
                        <!-- /.text-right -->

                    </div>
                    {{-- end paginate in footer box --}}
                </div>

            </div>
                <!-- /.col -->
                <div class="tab-pane" id="smartphone">
                    <div class="product-slider">
                      <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> <a href="detail.html"><img  src="{{ asset('frontend/assets/images/products/p5.jpg')}}" alt=""></a> </div>
                                <!-- /.image -->

                                <div class="tag sale"><span>sale</span></div>
                              </div>
                              <!-- /.product-image -->

                              <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                <!-- /.product-price -->

                              </div>
                              <!-- /.product-info -->
                              <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                  </ul>
                                </div>
                                <!-- /.action -->
                              </div>
                              <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                          </div>
                          <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> <a href="detail.html"><img  src="{{ asset('frontend/assets/images/products/p6.jpg')}}" alt=""></a> </div>
                                <!-- /.image -->

                                <div class="tag new"><span>new</span></div>
                              </div>
                              <!-- /.product-image -->

                              <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                <!-- /.product-price -->

                              </div>
                              <!-- /.product-info -->
                              <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                  </ul>
                                </div>
                                <!-- /.action -->
                              </div>
                              <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                          </div>
                          <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> <a href="detail.html"><img  src="{{ asset('frontend/assets/images/products/p7.jpg')}}" alt=""></a> </div>
                                <!-- /.image -->

                                <div class="tag sale"><span>sale</span></div>
                              </div>
                              <!-- /.product-image -->

                              <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                <!-- /.product-price -->

                              </div>
                              <!-- /.product-info -->
                              <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                  </ul>
                                </div>
                                <!-- /.action -->
                              </div>
                              <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                          </div>
                          <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> <a href="detail.html"><img  src="{{ asset('frontend/assets/images/products/p8.jpg')}}" alt=""></a> </div>
                                <!-- /.image -->

                                <div class="tag new"><span>new</span></div>
                              </div>
                              <!-- /.product-image -->

                              <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                <!-- /.product-price -->

                              </div>
                              <!-- /.product-info -->
                              <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                  </ul>
                                </div>
                                <!-- /.action -->
                              </div>
                              <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                          </div>
                          <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> <a href="detail.html"><img  src="{{ asset('frontend/assets/images/products/p9.jpg')}}" alt=""></a> </div>
                                <!-- /.image -->

                                <div class="tag hot"><span>hot</span></div>
                              </div>
                              <!-- /.product-image -->

                              <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                <!-- /.product-price -->

                              </div>
                              <!-- /.product-info -->
                              <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                  </ul>
                                </div>
                                <!-- /.action -->
                              </div>
                              <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                          </div>
                          <!-- /.products -->
                        </div>
                        <!-- /.item -->

                        <div class="item item-carousel">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image"> <a href="detail.html"><img  src="{{ asset('frontend/assets/images/products/p10.jpg')}}" alt=""></a> </div>
                                <!-- /.image -->

                                <div class="tag hot"><span>hot</span></div>
                              </div>
                              <!-- /.product-image -->

                              <div class="product-info text-left">
                                <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                <!-- /.product-price -->

                              </div>
                              <!-- /.product-info -->
                              <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                  </ul>
                                </div>
                                <!-- /.action -->
                              </div>
                              <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                          </div>
                          <!-- /.products -->
                        </div>
                        <!-- /.item -->
                      </div>
                      <!-- /.home-owl-carousel -->
                    </div>
                    <!-- /.product-slider -->
                  </div>
          </div>
        </div>

      </div>
          <!-- /.tab-content -->
    </div>


      <!-- /.homebanner-holder -->
      <!-- ============================================== CONTENT : END ============================================== -->
</div>
    <!-- /.row -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('frontend.body.brands')
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
  </div>
  <!-- /.container -->
@endsection
