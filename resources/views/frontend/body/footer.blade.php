<footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
                @php
                    $info = App\Models\Webinfo::first();
                @endphp
              <h4 class="module-title">Thông Tin Liên Hệ</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
              <ul class="toggle-footer" style="">
                <li class="media">
                  <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                  <div class="media-body">
                    <p>{{ $info->address }}</p>
                  </div>
                </li>
                <li class="media">
                  <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                  <div class="media-body">
                    <p>{{ $info->phone }}
                        @if ($info->phone2)
                        <br>
                        {{ $info->phone2 }}
                        @endif
                    </p>
                  </div>
                </li>
                <li class="media">
                  <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                  <div class="media-body"> <span><a href="#">{{ $info->email }}</a></span> </div>
                </li>
              </ul>
            </div>
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Tin Tức</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
              <ul class='list-unstyled'>
                @php
                    $footerPosts = App\Models\Post::populer(3);
                @endphp
                @if (isset($footerPosts) && $footerPosts->count()>0)
                    @foreach ($footerPosts as $footerPost)
                    <li class="first"><a href="{{ route('posts.show',$footerPost) }}">{{ $footerPost->title }}</a></li>
                    @endforeach
                @endif
              </ul>
            </div>
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Sản Phẩm</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
              <ul class='list-unstyled'>
                @php
                $footerProducts = App\Models\Product::populer(3);
                @endphp
                @if (isset($footerProducts) && $footerProducts->count()>0)
                    @foreach ($footerProducts as $footerProduct)
                    <li class="first">
                        @if ($footerProduct->category)
                        <a href="{{ route('products.category.show',[$footerProduct->category,$footerProduct]) }}">{{ $footerProduct->name }}</a>
                        @else
                        <a href="{{ route('products.show',[$footerProduct]) }}">{{ $footerProduct->name }}</a>
                        @endif
                    </li>
                    @endforeach
                @endif
              </ul>
            </div>
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Dịch Vụ Khách Hàng</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
              <ul class='list-unstyled'>
                <li class="first"><a href="#" title="About us">Điều khoản mua hàng và thanh toán</a></li>
                <li><a href="#" title="Blog">Chính sách đổi trả</a></li>
                <li><a href="#" title="Investor Relations">Câu hỏi thường gặp</a></li>
                <li><a href="#" title="Company">Liên hệ</a></li>
              </ul>
            </div>
            <!-- /.module-body -->
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-bar">
        <div class="container">
          <div class="col-xs-12 col-sm-6 no-padding social">
            <ul class="link">
              <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
              {{-- <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
              <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
              <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
              <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>
              <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li> --}}
              <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
            </ul>
          </div>
          <div class="col-xs-12 col-sm-6 no-padding">
            <div class="clearfix payment-methods" style="height: 45px">
              <ul>
                <li><a href="{{ route('bankinfor.show') }}"><img  src="{{ asset('bankimages/vcb.png') }}" alt=""></a></li>
                <li><a href="{{ route('bankinfor.show') }}"><img  src="{{ asset('bankimages/msb.png') }}" alt=""></a></li>

              </ul>
            </div>
            <!-- /.payment-methods -->
          </div>
        </div>
      </div>
</footer>
