<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
      <div class="container">
        <div class="header-top-inner">
          <div class="cnt-account">
            <ul class="list-unstyled">

              {{-- <li><a href="#"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng</a></li> --}}
              {{-- <li><a href="#"><i class="icon fa fa-check"></i>Thanh toán</a></li>  --}}
              <li class="dropdown hidden-xs"><a href="{{ route('returnPolicy') }}"><i class="icon fa fa-check"></i>Chính sách đổi trả </a></li>
              <li class="dropdown hidden-xs"><a href="{{ route('purchasingPolicy') }}"><i class="icon fa fa-check"></i>Điều khoản mua hàng & thanh toán</a></li>
              <li class="dropdown hidden-xs"><a href="{{ route('cart.index') }}"><i class="icon fa fa-shopping-cart"></i>Giỏ hàng</a></li>
              <li class="dropdown "><a href="{{ route('wishlist.index') }}"><i class="icon fa fa-heart"></i>Sản phẩm yêu thích</a></li>
              @auth
                <li class="dropdown"><a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>Thông tin tài khoản</a></li>
              @else
                <li class="dropdown"><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Đăng nhập</a></li>
              @endauth

            </ul>
          </div>
          <!-- /.cnt-account -->

          <div class="cnt-block">
            <ul class="list-unstyled list-inline">

            </ul>
            <!-- /.list-unstyled -->
          </div>
          <!-- /.cnt-cart -->
          <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
            <!-- ============================================================= LOGO ============================================================= -->
            <div class="logo"> <a href="{{ route('home') }}"> <img style="width:70px;" src="{{ asset('logo_hatgionggiare.png')}}" alt="logo"> <span style="color:white; font-size:14px;"></span></a> </div>
            <!-- /.logo -->
            <!-- ============================================================= LOGO : END ============================================================= --> </div>
          <!-- /.logo-holder -->

          <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
            <!-- /.contact-row -->
            <!-- ============================================================= SEARCH AREA ============================================================= -->
            <div class="search-area">
                {{-- <form class="form-inline" method="GET" action="http://ccls3.test/san-pham/tim-kiem">


                    <div class="form-group input-serach">

                        <input type="text" name="q"  placeholder="Tìm kiếm..." id="autosearch">

                    </div>

                    <button type="submit" class="pull-right btn-search">

                        <!--                        <i class="fa fa-search"></i>-->

                    </button>

                </form> --}}
              <form method="GET" action="{{route('product.search')}}">
                <div class="control-group">
                  <input name="q" class="search-field" placeholder="tìm sản phẩm..." id="autosearch"/>
                  <button class="search-button" ></button> </div>
              </form>
            </div>
            <!-- /.search-area -->
            <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
          <!-- /.top-search-holder -->

          <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

            <div class="dropdown dropdown-cart" id="miniCartHolder"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count" id="quantity"></span></div>
                <div class="total-price-basket">
                    <span class="lbl">GH -</span>
                    <span class="total-price">
                        <span  class="value subtotal"></span>
                        <span class="sign">đ</span>
                    </span>
                </div>
              </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                    <div id="miniCart">
                        {{-- cart item here  --}}
                    </div>

                    <div class="clearfix cart-total">
                        <div class="pull-right"> <span class="text">Tổng cộng :</span><span class='price subtotal' id="price"></span>&nbsp;<span class="price">đ</span> </div>
                        <div class="clearfix"></div>
                        <a href="{{ route('cart.index') }}" class="btn btn-upper btn-primary btn-block m-t-20">Thanh toán</a> </div>
                    <!-- /.cart-total-->

                </li>
              </ul>
              <!-- /.dropdown-menu-->
            </div>
            <!-- /.dropdown-cart -->

            <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= --> </div>
          <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
      <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
          <div class="navbar-header">
         <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
         <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="nav-bg-class">
            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
              <div class="nav-outer">
                <ul class="nav navbar-nav">
                  <li class="dropdown yamm-fw {{ Route::currentRouteName()=='home'?'active':'' }}"> <a href="{{ route('home') }}">Trang chủ</a> </li>
                  <li class="dropdown yamm-fw {{ Route::currentRouteName()=='products.index'?'active':'' }}"> <a href="{{ route('products.index') }}">Sản phẩm</a> </li>
                  <li class="dropdown hidden-sm {{ Route::currentRouteName()=='about'?'active':'' }}"> <a href="{{ route('about') }}">Giới thiệu</a> </li>
                  <li class="dropdown hidden-sm {{ Route::currentRouteName()=='posts.index'?'active':'' }}"> <a href="{{ route('posts.index') }}">Bài viết</a> </li>
                  <li class="dropdown hidden-sm {{ Route::currentRouteName()=='contact'?'active':'' }}"> <a href="{{ route('contact') }}">Liên hệ</a> </li>
                  <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="clearfix"></div>
              </div>
              <!-- /.nav-outer -->
            </div>
            <!-- /.navbar-collapse -->

          </div>
          <!-- /.nav-bg-class -->
        </div>
        <!-- /.navbar-default -->
      </div>
      <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

  </header>
