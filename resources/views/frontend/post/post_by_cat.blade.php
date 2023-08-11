@extends('frontend.main_master')
@section('title')
Bài viết
@endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'posts') }}
@endsection
@section('content')
<div class="breadcrumb">
	<div class="container">
        {{ Breadcrumbs::render('posts') }}

	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class='container'>
    <div class="row">
        <div class="blog-page">
            <div class="col-md-9">

                @foreach ($posts as $post )
                <div class="blog-post {{ $loop->iteration!=1?'outer-top-bd':'' }} wow fadeInUp">
                    <a href="{{ route('posts.show',[$post,$post->slug]) }}"><img class="img-responsive" src="{{ asset($post->getFirstImageUrl('large')) }}" alt="{{ $post->title }}"></a>
                    <h1><a href="{{ route('posts.show',[$post,$post->slug]) }}">{{ $post->title }}</a></h1>
                    <span class="author">{{ $post->user?$post->user->name:'' }}</span>
                    <span class="date-time">{{ $post->created_at }}</span>
                    <span class="review">6 Comments</span>
                    <p>{!! $post->description !!}</p>
                    <a href="{{ route('posts.show',[$post,$post->slug]) }}" class="btn btn-upper btn-primary read-more">xem thêm</a>
                </div>
                @endforeach
                <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                    <div class="text-right">
                        <div class="pagination-container">
                            {{ $posts->links('frontend.partial.custom_paginate')  }}
                        </div><!-- /.pagination-container -->
                    </div><!-- /.text-right -->

                </div><!-- /.filters-container -->
            </div>
            <div class="col-md-3 sidebar">



                <div class="sidebar-module-container">
                    <!-- ==============================================CATEGORY============================================== -->
                    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                        <h3 class="section-title">Category</h3>
                        <div class="sidebar-widget-body m-t-10">
                            <div class="accordion">
                                @foreach ($parentCategories as $parentCategory)
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a href="#{{ $parentCategory->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                                           {{ $parentCategory->name }}
                                        </a>
                                    </div><!-- /.accordion-heading -->
                                    <div class="accordion-body collapse" id="{{ $parentCategory->id }}" style="height: 0px;">
                                        <div class="accordion-inner">
                                            <ul>
                                                @foreach ($parentCategory->children as $child)
                                                @if ($child->posts->count()>0)
                                                <li><a href="{{ route('posts.category.group', $child->id) }}">{{ $child->name }}</a></li>
                                                @endif
                                                @endforeach

                                            </ul>
                                        </div><!-- /.accordion-inner -->
                                    </div><!-- /.accordion-body -->
                                </div><!-- /.accordion-group -->
                                @endforeach



                            </div><!-- /.accordion -->
                        </div>
                    </div>
                    <!-- ============================================== CATEGORY : END ============================================== -->
                    <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                        <h3 class="section-title">tab widget</h3>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#popular" data-toggle="tab">popular post</a></li>
                            <li><a href="#recent" data-toggle="tab">recent post</a></li>
                        </ul>
                        <div class="tab-content" style="padding-left:0">
                            <div class="tab-pane active m-t-20" id="popular">
                                <div class="blog-post inner-bottom-30 " >
                                    <img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg" alt="">
                                    <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                        <span class="review">6 Comments</span>
                                    <span class="date-time">12/06/16</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                </div>
                                <div class="blog-post" >
                                    <img class="img-responsive" src="assets/images/blog-post/blog_big_02.jpg" alt="">
                                    <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                    <span class="review">6 Comments</span>
                                    <span class="date-time">23/06/16</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                </div>
                            </div>

                            <div class="tab-pane m-t-20" id="recent">
                                <div class="blog-post inner-bottom-30" >
                                    <img class="img-responsive" src="assets/images/blog-post/blog_big_03.jpg" alt="">
                                    <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                    <span class="review">6 Comments</span>
                                    <span class="date-time">5/06/16</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                </div>
                                <div class="blog-post">
                                    <img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg" alt="">
                                    <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                    <span class="review">6 Comments</span>
                                    <span class="date-time">10/07/16</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================== PRODUCT TAGS ============================================== -->
                    <div class="sidebar-widget product-tag wow fadeInUp">
                        <h3 class="section-title">Product tags</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="tag-list">
                                <a class="item" title="Phone" href="category.html">Phone</a>
                                <a class="item active" title="Vest" href="category.html">Vest</a>
                                <a class="item" title="Smartphone" href="category.html">Smartphone</a>
                                <a class="item" title="Furniture" href="category.html">Furniture</a>
                                <a class="item" title="T-shirt" href="category.html">T-shirt</a>
                                <a class="item" title="Sweatpants" href="category.html">Sweatpants</a>
                                <a class="item" title="Sneaker" href="category.html">Sneaker</a>
                                <a class="item" title="Toys" href="category.html">Toys</a>
                                <a class="item" title="Rose" href="category.html">Rose</a>
                            </div><!-- /.tag-list -->
                        </div><!-- /.sidebar-widget-body -->
                    </div><!-- /.sidebar-widget -->
    <!-- ============================================== PRODUCT TAGS : END ============================================== -->				</div>
            </div>
        </div>

        </div>
    </div>


    @include('frontend.body.brands')
</div>
@endsection
