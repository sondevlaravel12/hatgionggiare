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
