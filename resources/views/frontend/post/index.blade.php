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
                    <p>{{  $post->excerpt?$post->excerpt : Str::words(strip_tags($post->description),20,'...') }}</p>
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
                @include('frontend.post._right_side_bar')
            </div>
        </div>

        </div>
    </div>


    @include('frontend.body.brands')
</div>
@endsection
