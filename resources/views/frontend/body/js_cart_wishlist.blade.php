{{-- cart --}}
<script>
    function productModalShow(id){

        $.ajax({
            type: "GET",
            url: "/san-pham/modal/show/" + id,
            dataType: "json",
            success: function (response) {

                $modalHolder.find('#name').text(response.product.name);
                $modalHolder.find('#description').text(response.product.description);
                $modalHolder.find('#image').attr('src',response.imageUrl)

                if(response.product.discount_price==''){
                    $modalHolder.find('#discount_price').text('');
                    $modalHolder.find('#base_price').text(response.product.base_price);
                }else{
                    $modalHolder.find('#discount_price').text(response.product.discount_price);
                    $modalHolder.find('#base_price').text(response.product.base_price);
                }
                $modalHolder.find('#quantity').val(1);
                $modalHolder.find('#product_id').val(response.product.id);

            }
        });
    }

    function addToCart() {
        // modal is open
        if($("#cartModal").hasClass("in")){
            var $product_id = $modalHolder.find('#product_id').val();
            var $quantity = $modalHolder.find('#quantity').val();

        }else{
            var $product_id = $productHolder.find('#product_id').val();
            var $quantity = $productHolder.find('#quantity').val();
        }
        // var $productItemHolder = $(this).closest('.product_item_holder');
        // var $product_id = $productHolder.find('#product_id').val();
        // var $quantity = $productHolder.find('#quantity').val();
        // console.log($productItemHolder);

        ajaxAddToCart($product_id, $quantity);

    }

    function fillinMiniCart(){
        $.ajax({
        type: 'GET',
        url: '/mini-gio-hang/fill-in',
        dataType:'json',
        success:function(response){
                var $miniCart ="";
            $.each(response.contents, function (key, cartItem) {
                $miniCart += `<div class="cart-item product-summary">
                    <div class="row">
                    <div class="col-xs-4">
                        <div class="image"> <a href="/san-pham/`+ cartItem.options.slug +`"><img src="${cartItem.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                        <h3 class="name"><a href="/san-pham/`+ cartItem.options.slug +`">${cartItem.name}</a></h3>
                        <div class="price">${FORMATTER.format(cartItem.price)} x ${cartItem.qty}</div>
                    </div>
                    <div class="col-xs-1 action">
                        <button type="submit" id="${cartItem.rowId}" onclick="miniCartRemoveItem(this.id)"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>`

            });
            var $miniCartHolder = $('#miniCartHolder');
            $miniCartHolder.find('#quantity').html(response.quantity);
            $miniCartHolder.find('.subtotal').html(response.priceTotal);

            $('#miniCart').html($miniCart);
            }
        });
    }
    fillinMiniCart();

    function miniCartRemoveItem(rowId){
        $.ajax({
            type: "get",
            url: "/mini-gio-hang/item/remove/" +rowId,
            dataType: "json",
            success: function (response) {
                fillinMiniCart();
                $('#miniCartHolder').addClass('open');
                cart()

                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                    })
                if ($.isEmptyObject(response.error)) {
                    console.log("success removing");
                    Toast.fire({
                        type: 'success',
                        title: response.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: response.error
                    })
                }
                // End Message

            }
        });
    }

    function cart() {
        $.ajax({
            type: "get",
            url: "/user/gio-hang/hien-thi-san-pham",
            dataType: "json",
            success: function (response) {
                var $rows = "";
                var $newrows ="";
                var $newrows2 ="";
                var $newrows3 ="";

                $.each(response.contents, function(key, cartItem){
                    $rows += `<tr>
                                        <td class="col-md-2"><a  href="/san-pham/`+ cartItem.options.slug +`"><img class="img-fluid img-responsive" src="${cartItem.options.image}" alt="imga" ></a></td>
                                        <td class="col-md-2">
                                            <div class="product-name "><a href="/san-pham/`+ cartItem.options.slug +`">${cartItem.name }</a></div>

                                            <div class="price">
                                                ${FORMATTER.format(cartItem.price)}
                                            </div>
                                        </td>
                                        <td class="col-md-2">
                                            ${cartItem.qty >1
                                            ?
                                            `<button type="submit" id="${cartItem.rowId}" class="btn btn-danger btn-sm" onclick="decreaseQuantity(this.id)">-</button>`
                                            :
                                            `<button type="submit" id="${cartItem.rowId}" class="btn btn-danger btn-sm" disabled>-</button>`
                                            }

                                            <input type="text" value="${cartItem.qty}" min="1" max="100" disabled="" style="width:25px;" >
                                            <button type="submit" id="${cartItem.rowId}" class="btn btn-success btn-sm" onclick="increaseQuantity(this.id)">+</button>
                                        </td>
                                        <td class="col-md-2">
                                            <strong>${FORMATTER.format(cartItem.qty*cartItem.price)} </strong>
                                        </td>
                                        <td class="col-md-1 close-btn">
                                            <button id="${ cartItem.rowId }" onclick="removeCartItem(this.id)" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>`

                    $newrows3 +=`<div class="row" style="padding-bottom:10px ">
                        <div class="col-md-2 col-xs-12 "><a  href="/san-pham/`+ cartItem.options.slug +`"><img class="img-fluid img-responsive" src="${cartItem.options.image}" alt="imga" ></a></div>
                        <div class="col-md-6 col-xs-12 text-center" style="padding-top:25px " >
                            <div class="product-name "><a href="/san-pham/`+ cartItem.options.slug +`">${cartItem.name }</a></div>
                            <div class=" price">
                                ${FORMATTER.format(cartItem.price)}
                            </div>
                            <div class="">
                                ${cartItem.qty >1
                                ?
                                `<button type="submit" id="${cartItem.rowId}" class="btn btn-danger btn-sm" onclick="decreaseQuantity(this.id)">-</button>`
                                :
                                `<button type="submit" id="${cartItem.rowId}" class="btn btn-danger btn-sm" disabled>-</button>`
                                }

                                <input type="text" value="${cartItem.qty}" min="1" max="100" disabled="" style="width:25px;" >
                                <button type="submit" id="${cartItem.rowId}" class="btn btn-success btn-sm" onclick="increaseQuantity(this.id)">+</button>
                            </div>
                            <div class="" >
                                <strong>${FORMATTER.format(cartItem.qty*cartItem.price)} </strong>
                            </div>
                        </div>


                        <div class="col-md-4 col-xs-12 text-center" style="padding-top:30px">
                            <button id="${ cartItem.rowId }" onclick="removeCartItem(this.id)" class="btn "><i class="fa fa-trash"></i></button>
                        </div>
                    </div>`

                })
                // $('#cartTableBody').html($rows);
                $('#shopping-cart-bs').html($newrows3);
            }
        });
    }
    cart();
    function removeCartItem(cartItemId){
        $.ajax({
            type: "get",
            url: "/user/gio-hang/san-pham/xoa/" +cartItemId ,
            dataType: "json",
            success: function (response) {
                cart();
                fillinMiniCart();
                calculateTotal();
                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                    //   icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.success
                    })
                }else{
                    Toast.fire({
                        icon: 'error',
                        type: 'error',
                        title: response.error
                    })
                }
                // End Message
            }
        });
    }

    function increaseQuantity(rowId){
        $.ajax({
            type: "get",
            url: "/user/gio-hang/san-pham/tang/" + rowId,
            dataType: "json",
            success: function (response) {
                cart();
                fillinMiniCart();
                calculateTotal();
            }
        });
    }
    function decreaseQuantity(rowId){
        $.ajax({
            type: "get",
            url: "/user/gio-hang/san-pham/giam/" + rowId,
            dataType: "json",
            success: function (response) {
                cart();
                fillinMiniCart();
                calculateTotal();
            }
        });
    }
    function calculateTotal(){
        var $totalContainer = $('#totalContainer');
        var $totalDiscountContainer = $totalContainer.find('#totalDiscountContainer');
        $.ajax({
            type: "get",
            url: "/user/gio-hang/san-pham/tinh-tong/",
            dataType: "json",
            success: function (response) {
                if(response.coupon){
                    $totalDiscountContainer.show();
                    $totalContainer.find('#couponCode').text(response.coupon);
                    $totalContainer.find('#totalDiscount').text('-'+response.totalDiscount);
                }else{
                    $totalDiscountContainer.hide();
                }
                $totalContainer.find('#priceTotal').text(response.priceTotal);
                $totalContainer.find('#total').text(response.total);
            }
        });
    }
    calculateTotal();
    function applyCoupon(){
        var $couponName = $('#couponName').val();
         $.ajax({
                type: "post",
                url: "/user/gio-hang/them-coupon",
                data: {couponName:$couponName},
                dataType: "json",
                success: function (response) {
                    calculateTotal();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        // position: 'bottom-left',
                        showConfirmButton: false,
                        timer: 3000
                        })
                    if ($.isEmptyObject(response.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: response.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: response.error
                        })
                    }
                    // End Message
                }
        });
    }
    function removeCoupon(){
        $.ajax({
            type: "get",
            url: "/user/coupon/xoa/",
            dataType: "json",
            success: function (response) {
                    calculateTotal();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        // position: 'bottom-left',
                        showConfirmButton: false,
                        timer: 3000
                        })
                    if ($.isEmptyObject(response.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: response.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: response.error
                        })
                    }
                    // End Message
                }
        });
    }
</script>
{{-- End cart --}}

{{-- wishlist --}}
<script>
     function addToWishlist(productId){
        $.ajax({
            type: "get",
            url: "/user/yeu-thich/san-pham/them/" +productId,
            dataType: "json",
            success: function (response) {

                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                    //   icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.success
                    })
                }else{
                    Toast.fire({
                        icon: 'error',
                        type: 'error',
                        title: response.error
                    })
                }
                // End Message

            }
        });
    }
    function wishlist() {
        $.ajax({
            type: "get",
            url: "/user/ds-yeu-thich/hien-thi-san-pham",
            dataType: "json",
            success: function (response) {
                var $rows = "";
                var $rows2 = "";
                $.each(response.wishlistItems, function(key, wishlistItem){
                    var $product = response.products[key];
                    var $price ='';
                    if($product.discount_price){
                        $price = $product.discount_price + '<span>' + $product.base_price + '</span>';
                    }else{
                        $price = $product.base_price;
                    }
                    $rows += `<tr>
                                        <td class="col-md-2"><img src="${response.images[key]}" alt="imga" ></td>
                                        <td class="col-md-7">
                                            <div class="product-name"><a href="/san-pham/`+ $product.slug +`">${$product.name }</a></div>
                                            <div class="rating">
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star non-rate"></i>
                                                <span class="review">( 06 Reviews )</span>
                                            </div>
                                            <div class="price">
                                                ${$price}
                                            </div>
                                        </td>
                                        <td class="col-md-2">
                                            <button id="${wishlistItem.rowId }" onclick="moveToCart(this.id)" class="btn-upper btn btn-primary">Chuyển vào giỏ hàng</button>
                                        </td>
                                        <td class="col-md-1 close-btn">
                                            <button id="${wishlistItem.rowId }" onclick="removeWishlistItem(this.id)" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>`
                    $rows2 +=`<div class="row" style="padding-bottom:10px ">
                                <div class="col-md-2 col-xs-12 "><img src="${response.images[key]}" alt="imga" ></div>
                                <div class="col-md-6 col-xs-12 text-center" style="padding-top:25px ">
                                    <div class="product-name"><a href="/san-pham/`+ $product.slug +`">${$product.name }</a></div>
                                    <div class="rating">
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star rate"></i>
                                        <i class="fa fa-star non-rate"></i>
                                        <span class="review">( 06 Reviews )</span>
                                    </div>
                                    <div class="price">
                                        ${$price}
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12 text-center" style="padding-top:30px ">
                                    <button id="${wishlistItem.rowId }" onclick="moveToCart(this.id)" class="btn-upper btn btn-primary">Chuyển vào giỏ hàng</button>
                                    <button id="${wishlistItem.rowId }" onclick="removeWishlistItem(this.id)" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </div>`
                })
                $('#wishlistTableBody').html($rows2);
            }
        });
    }
    wishlist();

    function removeWishlistItem(wishlistId){
        $.ajax({
            type: "get",
            url: "/user/ds-yeu-thich/san-pham/xoa/" +wishlistId ,
            dataType: "json",
            success: function (response) {
                wishlist();
                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                    //   icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.success
                    })
                }else{
                    Toast.fire({
                        icon: 'error',
                        type: 'error',
                        title: response.error
                    })
                }
                // End Message
            }
        });
    }
    function moveToCart(wishlistId){
        $.ajax({
            type: "get",
            url: "/user/ds-yeu-thich/chuyen-vao-gio-hang/" +wishlistId ,
            dataType: "json",
            success: function (response) {
                wishlist();
                fillinMiniCart();
                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                    //   icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(response.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.success
                    })
                }else{
                    Toast.fire({
                        icon: 'error',
                        type: 'error',
                        title: response.error
                    })
                }
                // End Message
            }
        });

    }
    // child function
    function ajaxAddToCart($product_id, $quantity){
        $.ajax({
                type: "POST",
                url: "/gio-hang/them-vao-gio-hang",
                data: {product_id:$product_id, quantity:$quantity},
                dataType: "json",
                success: function (response) {
                    fillinMiniCart();
                    calculateTotal();
                    $('#closeModel').click();
                    pushToDataLayer(response.dataForDataLayer);

                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                        })
                    if ($.isEmptyObject(response.error)) {
                        Toast.fire({
                            type: 'success',
                            title: response.success
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            title: response.error
                        })
                    }
                }
        });
    }
    // push data to GA4 dataLayer
    function pushToDataLayer(data){
        // Đẩy dữ liệu vào Data Layer
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
          'event': 'add_to_cart',
          'item_name': data.item_name,
          'item_category': data.item_category,
          'item_price': data.item_price,
          'quantity': data.quantity
        });
    }
    // function removeWishlistItem($wishlistId){
    //     $.ajax({
    //             type: "POST",
    //             url: "/ds-yeu-thich/xoa-san-pham",
    //             data: {wishlistId:$wishlistId},
    //             dataType: "json",
    //             success: function (response) {

    //                 console.log('xoa wishlist');
    //             }
    //     });

    // }
    // --- end child function
</script>
{{-- End wishlist --}}

{{-- detail product page  --}}
<script>
    function arrowUp(){
        var $productDetailQty = $productHolder.find('#quantity');
        $currentQuantity =  parseInt($productDetailQty.val());
        $productDetailQty.val($currentQuantity+1);
    }
    function arrowDown(){
        var $productDetailQty = $productHolder.find('#quantity');
        $currentQuantity =  parseInt($productDetailQty.val());
        if($currentQuantity>1){
            $productDetailQty.val($currentQuantity-1);
        }
    }
</script>
{{-- end detail product page  --}}
