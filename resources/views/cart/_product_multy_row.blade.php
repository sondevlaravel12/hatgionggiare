<div class="category-product-inner wow fadeInUp">
    <div class="products">
        <div class="product-list product">
        <div class="row product-list-row">
            <div class="col col-xs-4 col-lg-4">
            <div class="product-image">
                <a class="image" href="{{ route('products.show', $product) }}"> <img src="{{ $product->getFirstImageUrl('medium') }}" alt=""> </a>
            </div>
            <!-- /.product-image -->
            </div>
            <!-- /.col -->
            <div class="col col-xs-8 col-lg-8">
            <div class="product-info">
                <h3 class="name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
                <div class="product-price"> <span class="price"> {{ $product->discount_price }} </span> </div>
                <!-- /.product-price -->
                @if (isset($cart))
                    <div class="description m-t-10">Số lượng:&nbsp;{{$cart->qty}}&nbsp;|&nbsp;Thành tiền:&nbsp;{{$cart->subTotal()}}</div>
                @else
                    <div class="description m-t-10">Số lượng:&nbsp;{{$orderItem->quantity}}&nbsp;|&nbsp;Thành tiền:&nbsp;{{ number_format($orderItem->quantity*$orderItem->price, 0, ',', '.') .' đ'}}</div>
                @endif


            </div>
            <!-- /.product-info -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.product-list-row -->
        </div>
        <!-- /.product-list -->
    </div>
    <!-- /.products -->
</div>
