@extends('frontend.main_master')
@section('content')
<div class='container'>
	<div class="row">
        <div class="blog-page">
            <div class="col-md-9">
                <div class="blog-returnPolicy wow fadeInUp">
                        <h2 class="heading-title">{{$returnPolicy->title}}</h2>
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
