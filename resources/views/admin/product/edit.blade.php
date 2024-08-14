@extends('admin.admin_master')
@push('stylesheets')
     <!-- twitter-bootstrap-wizard css -->
     <link rel="stylesheet" href="{{asset('backend/assets/libs/twitter-bootstrap-wizard/prettify.css')}}">
    <!-- Image-Uploader -->
        <!--Material Design Iconic Font-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        {{-- http://dragdropimage.test/ --}}
        {{-- <link rel="stylesheet" href="{{asset('backend/assets/image-uploader/image-uploader.min.css')}}"> --}}
        {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> --}}

@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Thêm mới sản phẩm</h4>


                <div id="progrss-wizard" class="twitter-bs-wizard">
                    <ul class="twitter-bs-wizard-nav nav-justified nav nav-pills">
                        <li class="nav-item">
                            <a href="#step1" class="nav-link" data-toggle="tab">
                                <span class="step-number">01</span>
                                <span class="step-title">Thông tin chung</span>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="#step2" class="nav-link active" data-toggle="tab">
                                <span class="step-number">02</span>
                                <span class="step-title">Hình Ảnh</span>
                            </a>
                        </li>

                        <li class="nav-item" >
                            <a href="#step3" class="nav-link" data-toggle="tab">
                                <span class="step-number">03</span>
                                <span class="step-title">Mô tả sản phẩm</span>
                            </a>
                        </li>
                    </ul>

                    <div id="bar" class="progress mt-3">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 50%;"></div>
                    </div>
                    <form action="{{route('admin.products.update',$product)}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="tab-content twitter-bs-wizard-tab-content">
                            <div class="tab-pane" id="step1">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Tên Sản Phẩm</label>
                                                <input class="form-control" type="text" name="name" value="{{old('name')??$product->name}}"  >
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Slug</label>
                                                <input class="form-control" type="text" name="slug" value="{{old('slug')??$product->slug}}"  >
                                                @error('slug')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Giá sản phẩm</label>
                                                <input class="form-control" type="number" name="base_price" value="{{old('base_price')??$product->getRawOriginal('base_price')}}"  >
                                                @error('base_price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Giá khuyến mãi</label>
                                                <input class="form-control" type="number" name="discount_price" value="{{old('discount_price')??$product->getRawOriginal('discount_price')}}"  >
                                                @error('discount_price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Danh mục sản phẩm</label>
                                                <select class="form-select" aria-label="Default select example" name="category_id">
                                                    @if ($product->category)
                                                        @php
                                                            $productCategory = $product->category
                                                        @endphp
                                                        <option value="{{$productCategory->id}}" selected >{{$productCategory->name}}</option>
                                                        @foreach ($categories as $category)
                                                            @if ($category->id != $productCategory->id)
                                                                <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{$category->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option selected="" value="">Chọn danh mục</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }} >{{$category->name}}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="form-label">Quy cách đóng gói</label>
                                                <input class="form-control" type="text" name="packing" value="{{old('packing')??$product->packing}}"  >
                                                @error('packing')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                            </div>
                            <div class="tab-pane active" id="step2">
                            <div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 input-field">
                                                <label class="active">Photos</label>
                                                <div class="input-images-1" style="padding-top: .5rem;"></div>
                                                <!-- Display the preloaded images using Image Uploader -->
                                                <div id="preloaded" data-preloaded="{{ json_encode($preloaded) }}"></div>
                                                 <!-- Include the hidden input field for deleted images -->
                                                <input type="hidden" name="deletedImages[]">
                                                {{-- <div id="preloaded" data-ids="{{ $mediaIds }}"></div> --}}
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            </div>
                            <div class="tab-pane" id="step3">
                                <div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Mô tả ngắn</label>
                                                <textarea   name="short_description" class="form-control shorttext">{!!old('short_description')??$product->short_description!!}</textarea>
                                                @error('short_description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Nội dung</label>
                                                <textarea class="myeditorinstance" name="description">{!!old('description')??$product->description!!}</textarea>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <span id="description-char-count"></span>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label class="col-form-label" for="example-text-input" >Thu mục hình ảnh</label>
                                                <select class="form-select select2" name="image_directory" id="">
                                                    <option selected="">Lựa chọn thu mục</option>
                                                    @if(isset($directories))
                                                        @foreach ($directories as $directorie)
                                                        <option value="{{ $directorie }}" {{ old('image_directory') == $product->image_directory || $directorie==$product->image_directory? 'selected' : '' }}>{{ $directorie }}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="popup-gallery" id="imagesHolder" style="height:450px;
                                                        overflow-y: scroll;">

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
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
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Thông số kỹ thuật</label>
                                                <textarea class="myeditorinstance" name="specification">{!!old('specification')??$product->specification!!}</textarea>
                                                @error('specification')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <ul class="pager wizard twitter-bs-wizard-pager-link">

                            <li class="previous"><a href="javascript:;">Previous</a></li>
                            <li class="next"><a id="nextA" href="javascript:;">Next</a></li>
                            <li class="finishbtn" style="float: right; display: none" >
                                <button style="background-color: #0f9cf3;
                                    color: #fff;" type="submit" class="btn">
                                    <i class="fas fa-save"></i> Submit
                                </button>
                            </li>
                        </ul>
                    </form>
                </div>
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

<!--end Image-Uploader -->
<script type="text/javascript" src="{{ asset('backend/assets/js/custom/product_page.js?3') }}"></script>

@endpush
