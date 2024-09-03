<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/chat/style.css') }}">
<script src="{{ asset('frontend/assets/chat/script.js?334') }}"></script>
<div id="popup_chat" class="popup_close">
    <div class="offline_heading">
        <label class="button_chat_offline_text" style="font-weight: bold;">ĐĂNG KÝ MUA HÀNG</label><i class="fa shrink_icon toggle_popup fa-angle-down"></i>
    </div>

    <div class="popup_body">
        <form id="contactForm">

            <p class="bg-success info" id="box_info">
                Chào bạn! Bạn ghi rõ cụ thể thông tin mua hàng, chung tôi sẽ lên đơn hàng và gửi tới bạn trong 3-5 ngày làm việc!
            </p>

            <p class="bg-success info" id="box_success" style="display: none; color: red">
                            </p>


                <!--mã sản phẩm-->
                {{-- <input type="hidden" value="0" name="masanpham"> --}}

                <!--nguoi nhap-->
                {{-- <input type="hidden" value="" name="nguoinhap"> --}}

                <!--Giá sản phẩm-->
                {{-- <input type="hidden" value="{{ $product?$product->price:'' }}" name="giasanpham"> --}}

                <!--current url-->
                <input type="hidden" value="{{ url()->current() }}" name="urltrangweb">

                <!--current url-->
                {{-- <input type="hidden" value="https://hatgiongdalat.com/" name="chat_url" id="chat_url"> --}}

                <!--Current time stamp-->
                {{-- <input type="hidden" value="1724996785" name="random_key"> --}}

                <!--******************************-->
                <!--Họ tên-->
                <div class="form-group">
                    <input type="text" class="form-control" name="client_name" placeholder="Họ Tên*" required="" id="client_name" maxlength="100">
                </div>

                <!--Phone-->
                <div class="form-group">
                    <input type="text" class="form-control" name="phone_number" placeholder="Số Điện Thoại*" required="" id="phone_number" maxlength="100">
                </div>

                <!--Địa chỉ-->
                <div class="form-group">
                    <input type="text" class="form-control" name="address" placeholder="Đia chỉ nhận hàng tại nhà*" required="" id="address" maxlength="200">
                </div>

                <!--Sản phẩm đặt-->
                <div class="form-group">
                    <textarea class="form-control" rows="3" placeholder="Số Lượng + Sản Phẩm Muốn Mua*" name="product" required="" id="product" maxlength="200"></textarea>
                </div>

                <button id="submitInfo" type="submit" class="btn btn-info">Gởi Thông Tin</button>
                <input type="hidden" value="ok" name="submitInfo">
        </form>
    </div>
</div>
