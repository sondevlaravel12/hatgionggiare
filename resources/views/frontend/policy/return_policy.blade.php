@extends('frontend.main_master')
@section('title')
{{ isset($title)?$title:'Chính sách trả hàng' }}
@endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'returnPolicy') }}
@endsection
@section('content')
<div class="breadcrumb">
	<div class="container">
        {{ Breadcrumbs::render('returnPolicy') }}

	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class='container'>
	<div class="row">
        <div class="blog-page">
            <div class="col-md-9">
                <div class="blog-returnPolicy wow fadeInUp">
                        <h1>{!!$returnPolicy->title!!}</h1>
                        <span class="author">{{ $returnPolicy->user?$returnPolicy->user->name:'' }}</span>
                        <span class="date-time">{{ $returnPolicy->created_at }}</span>
                        {!!$returnPolicy->content !!}
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
