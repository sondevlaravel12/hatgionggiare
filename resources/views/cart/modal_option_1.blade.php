<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModel">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="productModal">
                <div class="row text-center">
                    <div class="col-md-6">
                        <img src="" id="image" class="card-img-top" alt="..." style="width: 150px;">
                    </div>
                    <div class="col-md-6 pull-right">
                        <h5 ><strong id="name"></strong></h5>
                        <p >Giá bán: <strong class="text-danger">
                            <span id="discount_price"></span></strong>
                            <del id="base_price">$</del>
                        </p>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Số lượng:</label>
                            <input id="quantity" type="number" style="width:100px; height:30px"  id="exampleFormControlInput1" value="1" min="1" >
                        </div>
                        <input type="hidden" id="product_id">
                        <button type="submit" class="btn btn-primary mb-2 add-to-cart-trigger" onclick="addToCart()" >Thêm vào giỏ hàng</button>
                    </div>
                </div>
                <div class="row">

                    {{-- <div class="col-md-6">

                        <div class="card" style="width: 18rem;">
                            <div class="card-body">

                                <p class="card-text"><span id="description"></span></p>
                            </div>
                        </div>

                    </div><!-- // end col md --> --}}

                    <div class="col-md-12">

                    </div><!-- // end col md -->


                </div> <!-- // end row -->










            </div> <!-- // end modal Body -->

        </div>
    </div>
</div>
<!-- End Add to Cart Product Modal -->
