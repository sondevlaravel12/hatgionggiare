@extends('admin.post.post_master')
@push('stylesheets')
        {{-- <link rel="stylesheet" href="{{asset('backend/assets/image-uploader/image-uploader.min.css')}}"> --}}
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Cấu hình hệ thống</h4>
                <form action="{{route('superadmin.webconfig.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Header code</label>
                                <textarea class="form-control" name="header_code" id="" cols="30" rows="10">{{ $webconfig->header_code }}</textarea>
                                {{-- <input class="form-control" type="text" name="slug" value="{{old('slug')??$post->slug}}"  > --}}
                                @error('header_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Body code</label>
                                <textarea class="form-control" name="body_code" id="" cols="30" rows="10">{{ $webconfig->body_code }}</textarea>
                                {{-- <input class="form-control" type="text" name="slug" value="{{old('slug')??$post->slug}}"  > --}}
                                @error('body_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Footer code</label>
                                <textarea class="form-control" name="footer_code" id="" cols="30" rows="10">{{ $webconfig->footer_code }}</textarea>
                                {{-- <input class="form-control" type="text" name="slug" value="{{old('slug')??$post->slug}}"  > --}}
                                @error('footer_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
<script type="text/javascript" src="{{ asset('backend/assets/js/custom/post_page.js?3443') }}"></script>

@endpush
