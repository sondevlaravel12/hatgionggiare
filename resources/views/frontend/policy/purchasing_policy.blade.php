@extends('frontend.main_master')
@section('title')
{{ isset($title)?$title:'Chính sách mua hàng' }}
@endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'purchasingPolicy') }}
@endsection
@section('content')
<div class="breadcrumb">
	<div class="container">
        {{ Breadcrumbs::render('purchasingPolicy') }}

	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class='container'>
	<div class="row">
        <div class="blog-page">
            <div class="col-md-9">
                <div class="blog-purchasingPolicy wow fadeInUp">
                        <h1>{!!$purchasingPolicy->title!!}</h1>
                        <span class="author">{{ $purchasingPolicy->user?$purchasingPolicy->user->name:'' }}</span>
                        <span class="date-time">{{ $purchasingPolicy->created_at }}</span>
                        {!!$purchasingPolicy->content !!}
                </div>

            </div>
            <div class="col-md-3 sidebar">
                @include('frontend.post._right_side_bar')
            </div>
        </div>
    </div>
    @include('frontend.body.brands')
</div>
@endsection
