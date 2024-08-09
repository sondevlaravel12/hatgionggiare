@extends('frontend.main_master')
@section('content')
	<div class="container">
        <div class="contact-page">
            <div class="row">

                <div class="col-md-12 contact-map outer-bottom-vs">
                    {!! $contact->map !!}
                </div>
                <div class="col-md-9 contact-form">
                    <div class="col-md-12 contact-title">
                        <h4>Liên hệ với chúng tôi</h4>
                    </div>
                    <div class="clearfix"></div>
                    @if (session('message'))
                    <div class="alert {{ session('alert_class') }}" style="display:block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('message') }}
                    </div>
                    @endif


                    <form class="register-form" role="form" method="POST" action="{{ route('contact.sentmessage') }}">
                        @csrf
                        <div class="col-md-4 ">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputName">Tên của bạn <span>*</span></label>
                                <input name="name" value="{{ old('name') }}" class="form-control unicase-form-control text-input" >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control unicase-form-control text-input" id="exampleInputEmail" placeholder="">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputTitle">Tiêu đề <span>*</span></label>
                                <input name="title" value="{{ old('title') }}" class="form-control unicase-form-control text-input" >
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputComments">Nội dung <span>*</span></label>
                                <textarea name="comment" class="form-control unicase-form-control" id="exampleInputComments"></textarea>
                                @error('comment')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 outer-bottom-small m-t-20">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Gửi</button>
                        </div>

                    </form>
                </div>
                <div class="col-md-3 contact-info">
                    {!! $contact->information !!}
                </div>
            </div>
        </div>
        @include('frontend.body.brands')
    </div>

@endsection
