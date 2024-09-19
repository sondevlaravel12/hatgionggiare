<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
{{-- <meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all"> --}}
{{-- {!! SEO::generate() !!} --}}
{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!}
{{-- json --}}
{{-- {!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!} --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- @yield('breadcrumb') --}}
{{-- render breadcrumbs as JSON-LD structured data (usually for SEO reasons)  --}}
{{Breadcrumbs::view('breadcrumbs::json-ld')}}

<!-- Bootstrap Core CSS -->

<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->
{{-- <link rel="stylesheet" href="{{ asset('backend/assets/jquery-ui-1.13.3.custom/jquery-ui.min.css') }}"></link> --}}
<link rel="stylesheet" href="{{ asset('backend/assets/jquery-ui-1.11.4/jquery-ui.css?1') }}" media="print" onload="this.media='all'">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?1')}}" >
<link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css')}}" media="print" onload="this.media='all'">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css')}}" media="print" onload="this.media='all'">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/custome.css?1')}}">
<link href="{{ asset('frontend/assets/css/lightbox.css') }}" rel="stylesheet" media="print" onload="this.media='all'">

{{-- website favicon  --}}
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="/favicon/site.webmanifest">
<!-- Icons/Glyphs -->

<link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css' media="print" onload="this.media='all'">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" media="print" onload="this.media='all'" >

<style>
    .breadcrumb{
        margin: 5px !important;
    }
    /* for image align that generated from tinyMce */
    p>img.img-responsive{
        display: inline !important;
    }
    /* img {
    max-width: 100% !important;
    height: auto !important;
    } */
    /* custome imagae that inserted by tinymce */
    .img-responsive-custome{
        max-width: 100%;
        height: auto;
        /* align image center no need to change in editor */
        display: block; margin-left: auto; margin-right: auto;
    }

</style>
@yield('css')
<!-- Chèn các đoạn script từ database -->
@php
$webconfig = \App\Models\Webconfig::first();
@endphp
@if(!empty($webconfig))
{!! $webconfig->header_code !!}
@endif
</head>
<body class="cnt-home">
@if(!empty($webconfig))
{!! $webconfig->body_code!!}
@endif
<!-- ============================================== HEADER ============================================== -->
@include('frontend.body.header')
<!-- ============================================== HEADER : END ============================================== -->
<!-- ============================================== BreadCrumb ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			@if (!isset($hideBreadcrumb))
            <div class="breadcrumb">
                {{ Breadcrumbs::render() }}
            </div>
            @endif
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<!-- ============================================== BreadCrumb: END ============================================== -->

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        @yield('content')
    </div>
</div>
@include('frontend.contact.contact_button')
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script>
{{-- <script src="{{ asset('backend/assets/jquery-ui-1.13.3.custom/jquery-ui.min.js') }}" ></script> --}}
<script src="{{ asset('backend/assets/jquery-ui-1.11.4/jquery-ui.js') }}" ></script>
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
<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
         }

    @endif
</script>

<style>
    .filters-container .nav-tabs.nav-tab-box{
        font-size: 13px !important;
    }
</style>


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
<script>
    /* ---------------------------------------------
     Autocomplete search
     --------------------------------------------- */
    //  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(function(){
    $("#autosearch").length > 0 && ($("#autosearch").autocomplete({
        // autoFocus: true,
        source: function (request, response) {
            $.ajax({
                url: "/san-pham/ajax-tim-kiem/sp",
                data: {term: request.term, maxResults: 10},
                dataType: "json",
                success: function (request) {
                    response($.map(request, function (request) {
                        return request
                    }))
                }
            })
        }, select: function (event, ul) {
            // window.location.href = ul.item.url;
            // console.log(ul.item.id);
        }
    }).data("ui-autocomplete")._renderItem = function (request, response) {
        var n = '<a href="' + response.url + '"><div class="list_item_container"><div class="image"><img src="' + response.avatar + '"></div><div class="description">' + response.label + '</div></div></a><hr class="search-hr"/>';
        return $("<li></li>").data("ui-autocomplete-item", response).append(n).appendTo(request)
    })
})
</script>
{{-- End setup --}}

{{-- cart & wishlist --}}
@include('frontend.body.js_cart_wishlist')
{{-- cart & wishlist end --}}

{{-- khung chat mua hang  --}}
@include('frontend.order.chat_order')


@yield('javascript')
@if(!empty($webconfig))
{!! $webconfig->footer_code !!}
@endif
</body>
</html>
