<div class="item item-carousel">
    <div class="products">
    <div class="product">
        <div class="product-image">
        <div class="image"> <a href="{{ route('products.show', $product) }}"><img src="{{ $product->getFirstImageUrl('medium') }}"
                alt=""></a> </div>
        <!-- /.image -->

        <div class="tag {{ $tag }}"><span>{{ $tag }}</span></div>
        </div>
        <!-- /.product-image -->

        <div class="product-info text-left">
        <h3 class="name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
        <div class="rating rateit-small"></div>
        <div class="description"></div>
        <div class="product-price"> <span class="price"> {{ $product->discount_price }} </span> <span
            class="price-before-discount">{{ $product->base_price }}</span> </div>
        <!-- /.product-price -->

        </div>
        <!-- /.product-info -->
        <div class="cart clearfix animate-effect">
        <div class="action">
            <ul class="list-unstyled">
                <li class="add-cart-button btn-group">
                    <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal"
                    id="{{ $product->id }}" onclick="productModalShow(this.id)">
                    <i class="fa fa-shopping-cart"></i>
                    </button>
                    <button class="btn btn-primary cart-btn" type="button" id="{{ $product->id }}" onclick="productModalShow(this.id)">
                        Thêm vào giỏ hàng
                    </button>
                </li>

                <button class="btn btn-primary icon" type="button" title="Wishlist"
                        id="{{ $product->id }}" onclick="addToWishlist(this.id)">
                        <i class="icon fa fa-heart"></i>
                </button>
                {{-- <li class="lnk">
                    <a class="add-to-cart" href="detail.html" title="Compare"> <i
                        class="fa fa-signal" aria-hidden="true"></i> </a>
                </li> --}}
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
