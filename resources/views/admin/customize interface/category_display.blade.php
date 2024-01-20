@extends('admin.admin_master')
@push('stylesheets')
   <!-- Lightbox css -->
   <link href="{{asset('backend/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />


@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Tùy Chỉnh Hiển Thị Danh Mục</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Danh sách danh mục</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>


                        <th>Id</th>
                        <th>Hình</th>
                        <th>Tên</th>
                        <th>Tab Infor</th>
                        <th>Widget Sidebar</th>

                    </tr>
                    </thead>


                    <tbody>
                        @foreach ($categories as $category)

                        <tr>
                            <td>{{$category->id}}</td>

                            <td><img src="{{$category->getFirstImageUrl('medium')}}" class="img-thumbnail" alt="300x300" width="300" data-holder-rendered="true"></td>
                            <td>{{$category->name}}</td>
                            <td>
                                <div class="square-switch infor_tab">
                                    <input type="checkbox" id="infor_tab_{{$category->id}}" data-category-id="{{$category->id}}" switch="none" {{$category->in_infor_tab!=null?'checked':''}}>
                                    <label for="infor_tab_{{$category->id}}" data-on-label="On" data-off-label="Off"></label>
                                </div>
                            </td>
                            <td>
                                <div class="square-switch sidebar_widget">
                                    <input type="checkbox" id="sidebar_widget_{{$category->id}}" data-category-id="{{$category->id}}" switch="none" {{$category->in_sidebar_widget!=null?'checked':''}}>
                                    <label for="sidebar_widget_{{$category->id}}" data-on-label="On" data-off-label="Off"></label>
                                </div>
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
@push('scripts')

@include('admin.customize interface.__js')
@endpush

