@extends('admin.tag.tag_master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách tag</h4>

                <div class="page-title-right">
                    <div >
                        {{-- <a href="{{route('admin.coupons.create')}}" class="btn btn-outline-info waves-effect waves-light" ><span ><i class="fas fa-plus"></i> Thêm coupon</span></a> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title">Danh sách coupon</h4> --}}
                    <button id="new-row-button" class="btn btn-dark pull-end">Thêm tag</button>

                    <div class="table-responsive">

                        <table class="table mb-0" id="bstable">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên tag</th>
                                    <th>Loại</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)

                                <tr>
                                    <td class="tag-id">{{$tag->id}}</td>
                                    <td class="tag-name">{{$tag->name}}</td>
                                    <td>
                                        {{-- {{$tag->type}} --}}
                                        <span class="badge {{$tag->type=='product'?'bg-info':'bg-success'}} ">{{$tag->type}}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


