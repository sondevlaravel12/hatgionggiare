{{-- modal show order  --}}
<div id="show-order-modal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đơn hàng: {{ $order->id }} </h5>
                <input type="hidden"  class="order-type">

                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                {{-- <input type="hidden" class="tag-id-in-modal"> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <tbody id="customer_info">
                                    {{-- fill in by js  --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card items-ordered">
                    <div class="card-body">

                        <h4 class="card-title">Sản phẩm đặt</h4><br/>

                        <div id="accordion" class="custom-accordion">
                            <div class="card mb-1 shadow-none">
                                <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="card-header" id="headingOne">
                                        <h6 class="m-0">
                                            Xem chi tiết
                                            <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                        </h6>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                    <div class="card-body">
                                        <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá tiền</th>
                                                <th>Tổng Tiền</th>
                                            </tr>
                                            </thead>


                                            <tbody id="order_items">
                                                {{-- fill in by js  --}}

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Đóng</button>
                <button id="btn-update-order-infors" type="button" class="btn btn-primary waves-effect waves-light ">Lưu</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- modal edit order  --}}
<div id="edit-order-modal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đơn hàng: {{ $order->id }} </h5>
                <input type="hidden"  class="order-type">
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                {{-- <input type="hidden" class="tag-id-in-modal"> --}}
                <select class="form-select" aria-label="Default select example" name="status">
                    {{-- @foreach ($arrayStatus as $status=>$vnstatus)
                    <option value="{{$status}}" {{old('status',$order->status)==$status? 'selected':''}}>{{$vnstatus}}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect " data-bs-dismiss="modal">Đóng</button>
                <button id="btn-update-order-status" type="button" class="btn btn-primary waves-effect waves-light ">Lưu</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
