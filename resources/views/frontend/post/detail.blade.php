@extends('frontend.main_master')
@section('title')
bài viết: {{ $post->name }}
@endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'posts.show', $post) }}
@endsection
@section('content')
<div class="breadcrumb">
	<div class="container">
        {{ Breadcrumbs::render('posts.show', $post) }}

	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class='container'>
	<div class="row">
        <div class="blog-page">
            <div class="col-md-9">
                <div class="blog-post wow fadeInUp">
                        <img class="img-responsive" src="{{ $post->getFirstImageUrl('large') }}" alt="">
                        <h1>{{ $post->title }}</h1>
                        <span class="author">{{ $post->user?$post->user->name:'' }}</span>
                        {{-- <span class="review">7 Comments</span> --}}
                        <span class="date-time">{{ $post->created_at }}</span>
                        {!!$post->description !!}
                        {{-- <div class="social-media">
                            <span>share post:</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href=""><i class="fa fa-rss"></i></a>
                            <a href="" class="hidden-xs"><i class="fa fa-pinterest"></i></a>
                        </div> --}}
                </div>
                {{-- <div class="blog-write-comment outer-bottom-xs outer-top-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Leave A Comment</h4>
                        </div>
                        <div class="col-md-4">
                            <form class="register-form" role="form">
                                <div class="form-group">
                                <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
                              </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form class="register-form" role="form">
                                <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
                              </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form class="register-form" role="form">
                                <div class="form-group">
                                <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="">
                              </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <form class="register-form" role="form">
                                <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
                                <textarea class="form-control unicase-form-control" id="exampleInputComments" ></textarea>
                              </div>
                            </form>
                        </div>
                        <div class="col-md-12 outer-bottom-small m-t-20">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit Comment</button>
                        </div>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
    @include('frontend.body.brands')
</div>
@endsection
