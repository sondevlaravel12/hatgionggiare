<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>
@yield('breadcrumb')

<!-- Bootstrap Core CSS -->

<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/custome.css')}}">
<link href="{{ asset('frontend/assets/css/lightbox.css') }}" rel="stylesheet">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
@yield('css')
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')
<!-- ============================================== HEADER : END ============================================== -->
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        @yield('content')
    </div>
</div>
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/echo.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/jquery.rateit.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/wow.min.js')}}"></script>
<script src="{{ asset('frontend/assets/js/scripts.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Add to Cart Product Modal -->
@include('cart.modal_option_1')


{{-- setup --}}
<script>
    var $productHolder = $('#product_detail_info');
    // var $productSidebarHolder = $('#product_detail_info');
    var $modalHolder = $('#productModal');
    const FORMATTER = new Intl.NumberFormat('de-DE',
    {
        style: 'currency',
        currency: 'vnd',
    });

    //var $productHolder = $('#product_detail_info') || $('#productModal');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
{{-- End setup --}}


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
                        <div class="image"> <a href="detail.html"><img src="${cartItem.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                        <h3 class="name"><a href="index.php?page-detail">${cartItem.name}</a></h3>
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
                $.each(response.contents, function(key, cartItem){
                    $rows += `<tr>
                                        <td class="col-md-2"><img class="img-fluid img-responsive" src="${cartItem.options.image}" alt="imga" ></td>
                                        <td class="col-md-2">
                                            <div class="product-name"><a href="#">${cartItem.name }</a></div>
                                            <div class="rating">
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star rate"></i>
                                                <i class="fa fa-star non-rate"></i>
                                                <span class="review">( 06 Reviews )</span>
                                            </div>
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
                })
                $('#cartTableBody').html($rows);
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
                $.each(response.wishlistItems, function(key, wishlistItem){
                    var $product = wishlistItem.product;
                    var $price ='';
                    if($product.discount_price){
                        $price = $product.discount_price + '<span>' + $product.base_price + '</span>';
                    }else{
                        $price = $product.base_price;
                    }
                    $rows += `<tr>
                                        <td class="col-md-2"><img src="${response.images[key]}" alt="imga" ></td>
                                        <td class="col-md-7">
                                            <div class="product-name"><a href="#">${$product.name }</a></div>
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
                                            <button id="${wishlistItem.id }" onclick="moveToCart(this.id)" class="btn-upper btn btn-primary">Chuyển vào giỏ hàng</button>
                                        </td>
                                        <td class="col-md-1 close-btn">
                                            <button id="${wishlistItem.id }" onclick="removeWishlistItem(this.id)" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>`
                })
                $('#wishlistTableBody').html($rows);
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


@yield('javascript')
</body>
</html>
