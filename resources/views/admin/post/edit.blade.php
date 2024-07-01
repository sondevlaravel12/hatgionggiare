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
                            <textarea id="post-content" class="myeditorinstance" name="description">{!!old('description')??$post->description!!}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="description-char-count"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Thu mục hình ảnh</label>
                        <div class="col-sm-10">
                            <select name="directories" id="">
                                <option selected="">Lựa chọn thu mục</option>
                                @foreach ($directories as $directorie)
                                <option value="{{ $directorie }}">{{ $directorie }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                    <div class="row mb-3" >
                        <div class="col-sm-12" style="display: flex;justify-content: center;align-items: center;">
                            <table id="imgTable" >
                                <tr id="imagesHolder">

                                    {{-- @foreach ($images as $image)
                                        <td>
                                            <img src="{{ asset('photos/cuc-nut-ao/'.$image) }}" alt="" height="42" width="42">
                                        </td>
                                    @endforeach --}}
                                </tr>
                            </table>
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

    $('#imgTable tr').on('click', 'td', function () {
        var sr = $('img', this).attr('src');
        //  tinyMCE.execCommand('mceInsertContent', false, '<img alt="Smiley face" height="42" width="42" src="' + sr + '"/>');
        tinymce.activeEditor.insertContent('<img alt="" class="img-responsive" src="' + sr + '"/>');
        // if image just selected so hide it in the box holder
        // ajaxLoadImageByDirectory($( "select[name*='directories'] ").val());
    });
</script>

<!--end Image-Uploader -->
<script>
    // get all image already used
    // $usedImages = $('textarea.myeditorinstance').find('img').attr('src');
    // var $imgNameArr=[];
    function getImagesLoaded(){
        $holder = $("<div></div>");
        // $usedImages = $('.myeditorinstance').val();
        $usedImages = tinymce.activeEditor.getContent();
        $holder.html($usedImages);

        $imgPathArr = [];
        $holder.find('p img').each(function(){
            $imgPathArr.push($(this).attr('src'));
        });
        $imgOnlyName = [];
        $imgPathArr.forEach(function(item, index){
            $pathParts = item.split("/");
            $imgOnlyName[index]= $pathParts[$pathParts.length - 1];
        });
        return $imgOnlyName;
    }
    // $imgNameArr = getImagesLoaded();

    // console.log($imgNameArr);
    // console.log($test.children('p img').attr('src'));
    // console.log($test.find('p').val());
    // select directories -> load images in this directory
    $( "select[name*='directories'] ")
        .on( "change", function() {
            var $directoryName = $(this).val();
            // call ajax inorder get all images in this directory
            ajaxLoadImageByDirectory($directoryName, getImagesLoaded());
        } );

    function ajaxLoadImageByDirectory(directoryName,imgNameArr ){
        return $.ajax({
                type: "get",
                url: "/admin/posts/edit/directory/ajaxgetimages",
                data: {directory:directoryName},
                dataType: "json",
                success: function (response) {
                    $imagesdisplay ='';
                    $.each( response, function(i,l ){
                        // $imagesdisplay += `<td>
                        //                         <img src="/storage/photos/`+ $directoryName +`/` + l + `" alt="" height="42" width="42">
                        //                     </td>`;
                        $pathParts =  l.split('/');
                        $imgName = $pathParts[$pathParts.length - 1];
                        if(imgNameArr.includes($imgName)){
                            // do not show this image
                            // console.log('already has it');
                        }else{
                            $imagesdisplay += `<td>
                                                <img src="/` + l + `" alt="" height="42" width="42">
                                            </td>`;
                        }
                    });


                    $('#imagesHolder').html($imagesdisplay);
                }
            });
    }

</script>

<script>


</script>

@endpush
