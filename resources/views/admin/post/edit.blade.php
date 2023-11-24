@extends('admin.admin_master')
@push('stylesheets')
        <link rel="stylesheet" href="{{asset('asset/admin/stylesheets/image-uploader.min.css')}}">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Sửa bài viết</h4>
                <form action="{{route('admin.posts.update',$post)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tên bài viết</label>
                        <div class="col-sm-10">
                            <input class="form-control" onkeyup="titleCharCountLive(this.value)" type="text" name="title" value="{{old('title')??$post->title}}"  >
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="title-char-count"></span>
                        </div>


                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Hình ảnh</label>
                        <div class="col-sm-10">
                            <div class="mb-3 input-field">
                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                                <!-- Display the preloaded images using Image Uploader -->
                                <div id="preloaded" data-preloaded="{{ json_encode($preloaded) }}"></div>
                                    <!-- Include the hidden input field for deleted images -->
                                <input type="hidden" name="deletedImages[]">
                                @error('photos')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Danh mục</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                <option selected="">Chose category</option>
                                @php
                                    $currentPostCategoryId = false;
                                    if($post->pcategory){
                                        $currentPostCategoryId = $post->pcategory->id;
                                    }
                                @endphp
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{ old('category_id') == $category->id || $currentPostCategoryId==$category->id? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Nội dung bài viết</label>
                        <div class="col-sm-10">
                            <textarea class="myeditorinstance" name="description">{!!old('description')??$post->description!!}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="description-char-count"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Trích dẫn</label>
                        <div class="col-sm-10">
                            <textarea onkeyup="excerptCharCountLive(this.value)" name="excerpt" class="form-control">{!! old('excerpt')??$post->excerpt !!}</textarea>
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
    preloaded: JSON.parse($('#preloaded').attr('data-preloaded')),
    preloadedInputName: 'preloadedImages[]', // set the name of the preloaded images input field
    imagesInputName: 'photos',
    label: 'Kéo thả hình vào đây, hoặc bấm vào để tải hình',
    extensions: ['.jpg','.jpeg','.png','.gif','.svg'],
    mimes: ['image/jpeg','image/png','image/gif','image/svg+xml'],
    maxSize: 5 * 1024 * 1024,
    maxFiles: 10,


});
</Script>
<script>
//     tinymce.init({
//     selector: 'textarea#short_description',
//     image_dimensions: false,
//          image_class_list: [
//             {title: 'Responsive', value: 'img-responsive'}
//         ]

//   });

</script>

<!--end Image-Uploader -->


@endpush
