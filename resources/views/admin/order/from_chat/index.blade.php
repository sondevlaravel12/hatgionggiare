@extends('admin.order.order_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Đơn Hàng</h4>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Danh sách đơn hàng</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr class="table-info">


                        <th>ID</th>
                        <th>Khách Hàng</th>
                        <th>SDT</th>

                        <th>Tình Trạng</th>
                        <th>Chi Tiết</th>
                        <th>Thời Gian Đặt Hàng</th>
                        <th>Thời Gian Cập Nhật</th>
                        <th>Admin Ghi Chú</th>



                    </tr>
                    </thead>


                    <tbody>
                        @php
                            $statusStype =[
                                'pending' =>'danger',
                                'processing' =>'info',
                                'decline' =>'dark',
                                'completed' =>'success',
                                    null=>'light',
                            ]
                        @endphp
                        @foreach ($orders as $order)

                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->client_name}}</td>
                            <td>{{$order->phone_number}}</td>

                            <td>
                                <span class="badge bg-{{$statusStype[$order->status]}}">{{$arrayStatus[$order->status]}}</span>
                                <input type="hidden" id="{{ $order->id }}" class="order-id" value="{{ $order->id }}">
                                <input type="hidden"  class="order-type" value="chat_order" id="">
                                <button type="button" class="btn btn-sm btn-link js-edit-order"><i class="fas fa-edit"></i></button>
                            </td>
                            <td>
                                <input type="hidden" class="order-id" value="{{ $order->id }}">
                                <input type="hidden"  class="order-type" value="chat_order" id="">
                                <button type="button" class="btn btn-sm btn-link js-show-order"><i class="fas fa-eye"></i> Xem</button>
                            </td>
                            <td>{{$order->created_at ? \Carbon\Carbon::parse($order->created_at)->diffForHumans() : ''}}</td>
                            <td>{{$order->updated_at ? \Carbon\Carbon::parse($order->updated_at)->diffForHumans() : ''}}</td>
                            <td>{{$order->admin_notes}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@include('admin.order._modal')
@endsection

@push('scripts')


@endpush

