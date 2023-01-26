<div class="category-product-inner wow fadeInUp">
    <div class="products">
        <div class="product-list product">
        <div class="row product-list-row">
            <div class="col col-sm-4 col-lg-4">
            <div class="product-image">
                <div class="image"> <img src="{{ $product->getFirstImageUrl('medium') }}" alt=""> </div>
            </div>
            <!-- /.product-image -->
            </div>
            <!-- /.col -->
            <div class="col col-sm-8 col-lg-8">
            <div class="product-info">
                <h3 class="name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
                <div class="rating rateit-small"></div>
                <div class="product-price"> <span class="price"> {{ $product->discount_price }} </span> <span class="price-before-discount">{{ $product->base_price }}</span> </div>
                <!-- /.product-price -->
                <div class="description m-t-10">{{ $product->short_description }}</div>
                <div class="cart clearfix animate-effect">
                <div class="action">
                    <ul class="list-unstyled">
                    <li class="add-cart-button btn-group">
                        <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal"
                        id="{{ $product->id }}" onclick="productModalShow(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                        <button class="btn btn-primary cart-btn" type="button" title="Add Cart" data-toggle="modal" data-target="#cartModal"
                        id="{{ $product->id }}" onclick="productModalShow(this.id)">Thêm vào giỏ hàng</button>
                    </li>
                    <li class="lnk wishlist"> <a class="add-to-cart" href="javascript:;" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)"> <i class="icon fa fa-heart"></i> </a> </li>
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
