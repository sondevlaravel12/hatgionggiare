@extends('admin.admin_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Slider</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.sliders.index')}}" class="btn btn-info waves-effect waves-light" ><span ><i class="fas fa-arrow-left"></i> Back to all sliders</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{route('admin.sliders.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Loại</label>
                        <div class="col-sm-10">
                            <select class="form-select image-type" aria-label="Default select example" name="type">
                                <option selected="">chọn loại</option>
                                {{-- @foreach ($categories as $category) --}}
                                <option value="top_slider" {{ old('type') == 'top_slider' ? 'selected' : '' }}>Top Slider</option>
                                <option value="middle_banner" {{ old('type') == 'middle_banner' ? 'selected' : '' }}>Middle Banner</option>
                                <option value="big_middle_banner" {{ old('type') == 'big_middle_banner' ? 'selected' : '' }}>Big Middle Banner</option>
                                {{-- @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="image" type="file" onchange="preview()" id="containImage">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="imagePreview" class="img-thumbnail" alt="no image is selected" width="300" src="" data-holder-rendered="true">
                        </div>
                    </div>
                    <div id="slider-only">
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Header</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="header" value="{{old('header')}}"  >
                                @error('header')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Big text</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="big_text" value="{{old('big_text')}}"  >
                                @error('big_text')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Call to action</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="call_to_action" value="{{old('call_to_action')}}"  >
                                @error('call_to_action')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Short description</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="short_description" value="{{old('short_description')}}"  >
                                @error('short_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Order</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" name="order" value="{{old('order')}}"  >
                                @error('order')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">LinkTo when clicking</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="link" value="{{old('link')}}"  >
                                @error('link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="button-items">
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="fas fa-save"></i> Save and back
                        </button>
                        <a href="/admin/sliders" class="btn btn-light waves-effect waves-light"><span class="fas fa-ban"></span> &nbsp;Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    function preview() {
            imagePreview.src=URL.createObjectURL(event.target.files[0]);
    }
    function toogleSliderInfor(){
        if($('select.image-type').val()=='middle_banner'){
            $('#slider-only').hide();
        }else{
            $('#slider-only').show();
        }
    };
    toogleSliderInfor();
    $('select.image-type').on('change', function() {
        // console.log($('select.image-type').val());
        toogleSliderInfor();
    });
</script>
@endpush
