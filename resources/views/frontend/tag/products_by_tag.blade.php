@extends('frontend.main_master')
@section('title')
Tag
@endsection
@section('content')
<div class="row">
    <!-- ============================================== CONTENT ============================================== -->
    <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
        {{-- tabs --}}

        <div class="more-info-tab clearfix ">


            @include('frontend.category._head_menu')
            {{-- <form class="navbar-form navbar-right" action="/action_page.php">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form> --}}
        </div>
        {{-- end tabs --}}

        {{-- content of tabs --}}
        <div class="tab-content outer-top-xs">


                {{--fillter, sort and paginate tab header--}}
                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-12 col-md-4">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Xem theo luới</a> </li>
                                <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>Xem theo list</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-sm-6 col-md-4 text-right pull-right">
                            <div class="pagination-container">
                                {{ $posts->links('frontend.partial.custom_paginate')  }}
                            </div>
                            <!-- /.pagination-container -->
                          </div>
                    </div>
                </div>
                {{--end fillter, sort and paginate tab header--}}

                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">

                        {{-- filter as grid --}}
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    @foreach ($posts as $post)
                                    <div class="col-xs-6 col-md-4 wow fadeInUp">
                                        <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                            <div class="image"> <a href="{{ route('products.show', [$post, $post->slug]) }}"><img  src="{{ $post->getFirstImageUrl('medium') }}" alt=""></a> </div>
                                            <!-- /.image -->
                                            </div>
                                            <!-- /.product-image -->

                                            <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ route('products.show', $post) }}">{{ $post->name }}</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> {{ $post->discount_price }} </span> <span class="price-before-discount">{{ $post->base_price }}</span> </div>
                                            <!-- /.product-price -->

                                            </div>
                                            <!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                @include("frontend.category._action")
                                            <!-- /.action -->
                                            </div>
                                            <!-- /.cart -->
                                        </div>
                                        <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    @endforeach


                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.category-product -->

                        </div>
                        {{-- end filter as grid --}}

                        {{-- filter as list --}}
                        <div class="tab-pane "  id="list-container">
                            <div class="category-product">
                                @foreach ($posts as $post)
                               @include("frontend.category._product_multy_row_in_category")
                                @endforeach


                            </div>
                        </div>
                        {{-- end filter as list --}}

                    </div>
                    {{-- paginate in footer box --}}
                    <div class="clearfix filters-container">
                        <div class="text-right">
                        <div class="pagination-container">
                            {{ $posts->links('frontend.partial.custom_paginate')  }}
                        </div>
                        <!-- /.pagination-container --> </div>
                        <!-- /.text-right -->
                    </div>
                    {{-- end paginate in footer box --}}
                </div>

        </div>
    </div>

    </div>
        <!-- /.tab-content -->
</div>
@include('frontend.body.brands')
@endsection
