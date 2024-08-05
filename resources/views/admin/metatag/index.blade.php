@extends('admin.admin_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách metatag</h4>

                <div class="page-title-right">
                    <div >
                        <a id="add-new-metatag" href="{{ route('admin.metatags.attatch') }}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm metatag</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="card-title"><a href="" class="btn btn-dark float-end mb-2">them metatag</a></div> --}}
                    {{-- <button id="new-row-button" class="btn btn-dark pull-end mb-2">Thêm metatag</button> --}}

                    <div class="table-responsive">

                        <table class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline table-metatag"  id="datatable">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Model</th>
                                    <th>Name</th>
                                    {{-- <th>Description</th>
                                    <th>Author</th>
                                    <th>Keyword</th>
                                    <th>Robots</th> --}}
                                    <th>Chỉnh Sửa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($metatags as $metatag)

                                <tr data-id="{{ $metatag->id }}">
                                    <td class="metatag-id">{{$metatag->id}}</td>
                                    <td class="metatag-title">{{ $metatag->title }}</td>
                                    <td>
                                        @php
                                        $type=strtolower(explode("\\",$metatag->model_type)[2]);

                                        @endphp

                                        {{ $type }}
                                    </td>
                                    <td>

                                        @if ($metatag->model && $type=="product"||$type=="post")
                                        <a href="{{route($type ."s.show",$metatag->model ) }}">{{ $metatag->model->name??$metatag->model->title }}</a>
                                        @elseif ($metatag->model && $type=="category")
                                        <a href="{{route("categories.products.show",$metatag->model ) }}">{{ $metatag->model->name??$metatag->model->title }}</a>
                                        @endif
                                    </td>
                                    {{-- <td class="metatag-description">{{ $metatag->description }}</td>
                                    <td class="metatag-author">{{ $metatag->author }}</td>
                                    <td class="metatag-keyword">{{ $metatag->keyword }}</td>
                                    <td class="metatag-robots">{{ $metatag->robots }}</td> --}}
                                    <td>
                                        <input class="metatag-id" type="hidden" id="{{ $metatag->id }}" value="{{ $metatag->id }}">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-link js-edit-metatag"  ><i class="far fa-edit"></i> Sửa</button>

                                        <button  class="btn btn-sm btn_product_delete js-remove-metatag"><i class="far fa-trash-alt"></i> Xóa</button>
                                        <!-- end Button trigger modal -->
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('admin.metatag.modal')
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/assets/js/custom/metatag_page.js') }}"></script>
@endpush


