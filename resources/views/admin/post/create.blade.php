@extends('admin.admin_master')
@push('stylesheets')
        <link rel="stylesheet" href="{{asset('asset/admin/stylesheets/image-uploader.min.css')}}">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Thêm mới bài viết</h4>
                <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($sample))
                        <input type="hidden" name="sample_id" value="{{ $sample->id }}">
                    @endif
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Tên bài viết</label>

                            @if (isset($sample))
                                <input class="form-control" onkeyup="titleCharCountLive(this.value)" type="text" name="title" value="{{old('title')??$sample->name}}"  >
                            @else
                                <input class="form-control" onkeyup="titleCharCountLive(this.value)" type="text" name="title" value="{{old('title')}}"  >
                            @endif
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="title-char-count"></span>
                        </div>


                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Hình ảnh</label>
                            <div class="mb-3 input-field">
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                                @error('photos')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row ">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Danh mục</label>
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                <option selected="">Chose category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nội dung bài viết</label>
                                @if (isset($sample))
                                <textarea class="myeditorinstance" name="description">{!!old('description')??$sample->description!!}</textarea>
                                @else
                                    <textarea class="myeditorinstance" name="description">{!!old('description')!!}</textarea>
                                @endif
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <span id="description-char-count"></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="col-form-label" for="example-text-input" >Thu mục hình ảnh</label>
                                <select name="directories" id="">
                                    <option selected="">Lựa chọn thu mục</option>
                                    @foreach ($directories as $directorie)
                                    <option value="{{ $directorie }}">{{ $directorie }}</option>
                                    @endforeach

                                </select>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="popup-gallery" id="imagesHolder" style="height:450px;
                                        overflow-y: scroll;">
                                            {{-- <a class="float-start" href="assets/images/small/img-1.jpg" title="Project 1">
                                                <div class="img-fluid">
                                                    <img src="assets/images/small/img-1.jpg" alt="img-1" width="120">
                                                </div>
                                            </a> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Trích dẫn</label>

                            <textarea onkeyup="excerptCharCountLive(this.value)" name="excerpt" class="form-control">{!! old('excerpt') !!}</textarea>
                            @error('excerpt')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="excerpt-count"></span>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="button-items">
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-end">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

<!-- twitter-bootstrap-wizard js -->
<script src="{{asset('backend/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

<script src="{{asset('backend/assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

<!-- form wizard init -->
{{-- <script src="{{asset('backend/assets/js/pages/form-wizard.init.js')}}"></script> --}}
<script>
    $(document).ready(function () {
        $("#basic-pills-wizard").bootstrapWizard(
            { tabClass: "nav nav-pills nav-justified" }),
            $("#progrss-wizard").bootstrapWizard({
                onInit : function(tab, navigation, index){
                },

                onTabShow: function (tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index+1;
                    var $percent = ($current/$total) * 100;
                    // show procress bar
                    $("#progrss-wizard")
                        .find(".progress-bar")
                        .css({ width: $percent + "%" });

                    var $next = $(".next");
                    var $finish = $(".finishbtn");
                    if($current>=$total){
                        $next.hide();
                        $finish.show();
                    }else{
                        $next.show();
                        $finish.hide();
                    }
                },

            });
        $('#progrss-wizard .finish').click(function() {
            // $('#rootwizard').find("a[href*='tab1']").trigger('click');
	    });
    });

// active tab when click in the tab, if not have this code it work properly when click next, previous but not when click on tab
var triggerTabList = [].slice.call(document.querySelectorAll(".twitter-bs-wizard-nav .nav-link"))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})

</script>

<!-- Image-Uploader -->
{{-- https://christianbayer.github.io/image-uploader/ --}}
<script type="text/javascript" src="{{asset('asset/admin/javascripts/image-uploader.min.js')}}"></script>

<Script>

$('.input-images-1').imageUploader({
    imagesInputName: 'photos',
    label: 'Kéo thả hình vào đây, hoặc bấm vào để tải hình',
    extensions: ['.jpg','.jpeg','.png','.gif','.svg'],
    mimes: ['image/jpeg','image/png','image/gif','image/svg+xml'],
    maxSize: 5 * 1024 * 1024,
    maxFiles: 10,


});
</Script>

<!--end Image-Uploader -->
<script type="text/javascript" src="{{ asset('backend/assets/js/custom/post_page.js') }}"></script>


@endpush
