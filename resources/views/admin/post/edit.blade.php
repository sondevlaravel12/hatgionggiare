@extends('admin.post.post_master')
@push('stylesheets')
        {{-- <link rel="stylesheet" href="{{asset('backend/assets/image-uploader/image-uploader.min.css')}}"> --}}
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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Tên bài viết</label>
                                <input class="form-control"  type="text" name="title" value="{{old('title')??$post->title}}"  >
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Slug</label>
                                <input class="form-control" type="text" name="slug" value="{{old('slug')??$post->slug}}"  >
                                @error('slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 input-field">
                                <label for="example-text-input" class="active">Hình ảnh</label>

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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="form-label">Danh mục</label>
                                <select class="form-select select2-123" aria-label="Default select example" name="category_id">
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

                    </div>

                    <div class="row">
                        <div class="col-sm-10">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nội dung bài viết</label>
                                <textarea id="post-content" class="myeditorinstance" name="description">{!!old('description')??$post->description!!}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <span id="description-char-count"></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mb-3">
                                <label class="col-form-label" for="example-text-input" >Thu mục hình ảnh</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="post-type">
                                    <label class="form-check-label" for="formCheck1">
                                        Hình ảnh bv
                                    </label>
                                </div>
                                <select class="form-control select2-model-type" name="image_directory" id="">
                                    {{-- @if(isset($directories))
                                    <option selected="">Lựa chọn thu mục</option>
                                    @foreach ($directories as $directorie)
                                    <option value="{{ $directorie }}" {{ old('image_directory') == $post->image_directory || $directorie==$post->image_directory? 'selected' : '' }} >{{ $directorie }}</option>
                                    @endforeach
                                    @endif --}}

                                </select>
                                {{-- <select multiple data-role="tagsinput" name="keyword[]" class="typeahead">

                                </select> --}}
                                {{-- <div id="prefetch">
                                    <input class="typeahead form-control" type="text" placeholder="Countries">
                                </div> --}}

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

                    {{-- <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Thu mục hình ảnh</label>
                        <div class="col-sm-10">
                            <select name="directories" id="">
                                <option selected="">Lựa chọn thu mục</option>
                                @foreach ($directories as $directorie)
                                <option value="{{ $directorie }}">{{ $directorie }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div> --}}

                    <div class="row mb-3" >
                        <div class="col-sm-12" style="display: flex;justify-content: center;align-items: center;">
                            <table id="imgTable" >
                                {{-- <tr id="imagesHolder"> --}}

                                    {{-- @foreach ($images as $image)
                                        <td>
                                            <img src="{{ asset('photos/cuc-nut-ao/'.$image) }}" alt="" height="42" width="42">
                                        </td>
                                    @endforeach --}}
                                {{-- </tr> --}}
                            </table>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 ">
                            <div class="d-flex flex-wrap gap-2">
                                <div class="square-switch mt-2">
                                    <input type="checkbox" id="square-switch1" switch="none" checked="">
                                    <label for="square-switch1" data-on-label="SP" data-off-label="BV"></label>
                                </div>
                                <label class="col-sm-4 col-form-label ">link liên kết Sản Phẩm | Bài Viết</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <input class="form-control" id="autosearch" type="text">
                        </div>
                        <div class="col-lg-6">
                            <input class="form-control"  type="text" id="url">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Trích dẫn</label>
                                <textarea onkeyup="excerptCharCountLive(this.value)" name="excerpt" class="form-control">{!! old('excerpt')??$post->excerpt !!}</textarea>
                                @error('excerpt')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <span id="excerpt-count"></span>
                            </div>
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
{{-- <script type="text/javascript" src="{{asset('backend/assets/image-uploader/image-uploader.min.js')}}"></script> --}}

<Script>

// $('.input-images-1').imageUploader({
//     preloaded: JSON.parse($('#preloaded').attr('data-preloaded')),
//     preloadedInputName: 'preloadedImages[]', // set the name of the preloaded images input field
//     imagesInputName: 'photos',
//     label: 'Kéo thả hình vào đây, hoặc bấm vào để tải hình',
//     extensions: ['.jpg','.jpeg','.png','.gif','.svg'],
//     mimes: ['image/jpeg','image/png','image/gif','image/svg+xml'],
//     maxSize: 5 * 1024 * 1024,
//     maxFiles: 10,


// });
</Script>
<script>

    // $('#imgTable tr').on('click', 'td', function () {
    //     var sr = $('img', this).attr('src');
    //     //  tinyMCE.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + sr + '"/>');
    //     tinymce.activeEditor.insertContent('<img alt="" class="img-responsive" src="' + sr + '"/>');
    //     // if image just selected so hide it in the box holder
    //     // ajaxLoadImageByDirectory($( "select[name*='directories'] ").val());
    // });
    // $('#imagesHolder').on('click', 'a', function () {
    //     var sr = $('img', this).attr('src');
    //     //  tinyMCE.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + sr + '"/>');
    //     tinymce.activeEditor.insertContent('<img class="img-responsive" src="' + sr + '"/>');
    //     // if image just selected so hide it in the box holder
    //     // ajaxLoadImageByDirectory($( "select[name*='directories'] ").val());
    // });
</script>

<!--end Image-Uploader -->
<script type="text/javascript" src="{{ asset('backend/assets/js/custom/post_page.js?33333') }}"></script>

@endpush
