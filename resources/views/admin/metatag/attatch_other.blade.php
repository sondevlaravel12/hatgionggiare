@extends('admin.admin_master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Attatch other</h4>
                <form action="{{route('admin.metatags.storeOther')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">description</label>
                            {{-- <input type="text" class="form-control" name="description"> --}}
                            <textarea class="form-control" name="description" id="" cols="30" rows="2">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Author</label>
                            <input type="text" class="form-control" name="author" value="{{ old('author') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Keyword</label>
                            {{-- <input type="text" class="form-control" name="keyword"> --}}
                            <textarea class="form-control" name="keyword" id="" cols="30" rows="2">{{ old('keyword') }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Robots</label>
                            {{-- <input type="text" class="form-control" name="robots"> --}}
                            <textarea class="form-control" name="robots" id="" cols="30" rows="2">{{ old('robots') }}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <label class="col-sm-2 col-form-label">Loại</label>
                            <select class="form-select" aria-label="Default select example" id="model-type" name="model_type">
                                <option selected="">Chọn loại metatag</option>
                                <option value="App\Models\Category">Product Category</option>
                                <option value="App\Models\Pcategory">Post Category</option>
                                <option value="App\Models\About">About</option>
                                <option value="App\Models\Contact">Contact</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label class="form-label">Tên loại</label>
                        @error('model_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <select class="form-control select2-search-disable" name="model_id">
                            <option>Chọn Tên Loại</option>

                        </select>
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
<script>
    // $('.select2-search-disable').select2({

    // });
</script>
<script>
    $('#model-type').on('change',function(){
        $model_type = $(this).val();
        $.ajax({
            type: "get",
            url: "/admin/metatags/ajax-get-allitems-of-model",
            data: {model_type:$model_type},
            dataType: "json",
            success: function (response) {
                var $select = $('.select2-search-disable');
                $select.find('option').remove();
                $.each(response,function(key, value)
                {
                    $select.append('<option value=' + value.id + '>' + value.name + '</option>'); // return empty
                });
            }
        });
    });
    // $('.select2-search-disable123').on('change', function(){
    //     $text = $(this).children(':selected').text();
    // })


</script>

@endpush

