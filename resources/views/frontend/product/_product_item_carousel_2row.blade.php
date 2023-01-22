<div class="item">
    <div class="products best-product">
      @foreach ($group as $product)
      <div class="product">
        <div class="product-micro">
          <div class="row product-micro-row">
            <div class="col col-xs-5">
              <div class="product-image">
                <div class="image"> <a href="{{ route('products.show', [$product, $product->slug]) }}"> <img src="{{ $product->getFirstImageUrl('medium') }}" alt="{{ $product->name}}"> </a>
                </div>
                <!-- /.image -->

              </div>
              <!-- /.product-image -->
            </div>
            <!-- /.col -->
            <div class="col2 col-xs-7">
              <div class="product-info">
                <h3 class="name"><a href="{{ route('products.show', [$product, $product->slug]) }}">{{ $product->name }}</a></h3>
                <div class="rating rateit-small"></div>
                <div class="product-price"> <span class="price"> {{ $product->discount_price }} </span> </div>
                <!-- /.product-price -->

              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.product-micro-row -->
        </div>
        <!-- /.product-micro -->

      </div>
      @endforeach
    </div>
  </div>
