@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Danh mục sản phẩm</h4>

            <div class="page-title-right">
                <div >
                    <a href="{{route('admin.categories.index')}}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-arrow-left"></i> Quay lại danh sách danh mục sản phẩm</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{route('admin.categories.update', $category)}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="name" value="{{old('name')??$category->name}}"  >
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Hình ảnh</label>
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
                            <img id="imagePreview" src="{{ $category->getFirstImageUrl() }}" class="img-thumbnail" alt="no image is selected" width="300" src="" data-holder-rendered="true">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Danh mục cha</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="category_id">
                                <option  value="not_selected">Lựa chọn danh mục cha</option>
                                @php
                                    $categories = App\Models\Category::where('parent_id',0)->get();
                                    $categoryParentId = $category->parent?$category->parent->id:0;
                                @endphp
                                @foreach ($categories as $cat)
                                <option value="{{$cat->id}}" {{$cat->id==$categoryParentId? 'selected':''}} >{{$cat->name}}</option>
                                @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="myeditorinstance" name="description">{{old('description')??$category->description}}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>


                    <!-- end row -->
                    <div class="button-items">
                        <button type="submit" class="btn btn-success waves-effect waves-light float-end">
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
<script>
    function preview() {
        imagePreview.src=URL.createObjectURL(event.target.files[0]);
}
</script>

@endpush
