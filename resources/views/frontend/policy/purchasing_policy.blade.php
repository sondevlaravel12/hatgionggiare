@extends('frontend.main_master')
@section('content')
<div class='container'>
	<div class="row">
        <div class="blog-page">
            <div class="col-md-9">
                <div class="blog-purchasingPolicy wow fadeInUp">
                        <h2 class="heading-title">{{$purchasingPolicy->title}}</h2>
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
