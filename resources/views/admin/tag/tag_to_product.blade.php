@extends('admin.tag.tag_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Sản Phẩm</h4>


        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Danh sách sản phẩm</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>


                        <th>Id</th>
                        <th>Hình</th>
                        <th>Tên</th>
                        <th>Tag</th>
                        <th></th>


                    </tr>
                    </thead>


                    <tbody>
                        @foreach ($products as $product)

                        <tr>
                            <td>{{$product->id}}</td>

                            <td><img src="{{$product->getFirstImageUrl('medium')}}" class="img-thumbnail" alt="300x300" width="300" data-holder-rendered="true"></td>
                            <td>{{$product->name}}</td>
                            <td>
                                {{-- <div class="rowEdit"> --}}
                                    <select multiple data-role="tagsinput" name="keyword[]" class="typeahead">
                                        @foreach ($product->tags as $tag)
                                            <option value="{{$tag->name}}"></option>
                                            {{-- <option value="hat giong gia re"></option>
                                            <option value="hat hoa "></option> --}}
                                        @endforeach
                                    </select>
                                {{-- </div> --}}

                            </td>
                            <td>
                                <button id="bEdit" type="button" class="btn btn-sm btn-default" style="">
                                    <span class="fa fa-edit"> </span>
                                </button>
                        </td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

