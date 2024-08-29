@extends('frontend.main_master')
@section('content')
	<div class="container">
        <div class="contact-page">
            <div class="row">

                <div class="col-md-12 contact-map outer-bottom-vs">
                    {{-- {!! $contact->map !!} --}}
                    <a href="https://www.google.com/maps/place/11%C2%B032'20.2%22N+107%C2%B046'34.2%22E/@11.5384457,107.7742642,16.75z/data=!4m13!1m8!3m7!1s0x3173f66e05f5cf77:0xb5b73f9bbe8af84e!2zMTA3IMSQxrDhu51uZyBQaGFuIENodSBUcmluaCwgTOG7mWMgVGnhur9uLCBC4bqjbyBM4buZYywgTMOibSDEkOG7k25nLCBWaeG7h3QgTmFt!3b1!8m2!3d11.5389404!4d107.7761842!16s%2Fg%2F11thsmcjsr!3m3!8m2!3d11.5389444!4d107.7761667?entry=ttu&g_ep=EgoyMDI0MDgyNy4wIKXMDSoASAFQAw%3D%3D">
                        <img style="max-width: 1000px; margin:auto" class="img-responsive" src="{{ asset('hggr_map.png') }}" alt="">
                    </a>
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
