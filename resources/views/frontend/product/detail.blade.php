@extends('frontend.main_master')
@section('title')
sản phẩm: {{ $product->name }}
@endsection
@section('breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'products.show', $product) }}
@endsection
@section('content')
<div class="breadcrumb">
	<div class="container">
        {{ Breadcrumbs::render('products.show', $product) }}

	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class='container'>
	<div class='row single-product'>

		<div class='col-md-9'>
			<div class="detail-block">
				<div class="row  wow fadeInUp">

					<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
						<div class="product-item-holder size-big single-product-gallery small-gallery">

							<div id="owl-single-product">

                                @foreach ($product->getMedia('products') as $image)
                                <!-- /.single-product-gallery-item -->
                                <div class="single-product-gallery-item" id="slide{{ $image->id }}">
									<a data-lightbox="image-1" data-title="Gallery"
										href="{{ $image->getUrl('large') }}">
										<img class="img-responsive" alt="" src="{{ $image->getUrl('thumb') }}"
											data-echo="{{ $image->getUrl('large') }}" />
									</a>
								</div>
                                <!-- /.single-product-gallery-item -->
                                @endforeach

							</div>


							<div class="single-product-gallery-thumbs gallery-thumbs">

								<div id="owl-single-product-thumbnails">
                                    @foreach ($product->getMedia('products') as $image)
									<div class="item">
										<a class="horizontal-thumb active" data-target="#owl-single-product"
											data-slide="1" href="#slide{{ $image->id }}">
											<img class="img-responsive" width="85" alt=""
												src="{{ $image->getUrl('thumb') }}"
												data-echo="{{ $image->getUrl('thumb') }}" />
										</a>
									</div>
                                    @endforeach
								</div><!-- /#owl-single-product-thumbnails -->



							</div><!-- /.gallery-thumbs -->

						</div><!-- /.single-product-gallery -->
					</div><!-- /.gallery-holder -->
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info" id="product_detail_info">
							<h1 class="name">{{ $product->name }}</h1>

							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										<div class="rating rateit-small"></div>
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">(13 Reviews)</a>
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-2">
										<div class="stock-box">
											<span class="label">Availability :</span>
										</div>
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">In Stock</span>
										</div>
									</div>
								</div><!-- /.row -->
							</div><!-- /.stock-container -->

							<div class="description-container m-t-20">
								{!!$product->short_description!!}
                                <br>
                                @if ($product->packing)
                                <p>Quy cách đóng gói: {{ $product->packing }}</p>
                                @endif
							</div><!-- /.description-container -->

							<div class="price-container info-container m-t-20">
								<div class="row">


									<div class="col-sm-6">
										<div class="price-box">
											<span class="price">{{ $product->discount_price }}</span>
											<span class="price-strike">{{ $product->base_price }}</span>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="favorite-button m-t-10">
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
												title="thêm vào danh sách yêu thích" href="javascript:;" id="{{ $product->id }}" onclick="addToWishlist(this.id)">
												<i class="fa fa-heart"></i>
											</a>
											{{-- <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
												title="Add to Compare" href="#">
												<i class="fa fa-signal"></i>
											</a>
											<a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
												title="E-mail" href="#">
												<i class="fa fa-envelope"></i>
											</a> --}}
										</div>
									</div>

								</div><!-- /.row -->
							</div><!-- /.price-container -->

							<div class="quantity-container info-container">
								<div class="row">

									<div class="col-sm-2">
										<span class="label">Qty :</span>
									</div>

									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
												<div class="arrows">
													<div class="arrow plus gradient"><a id="" class="ir" href="javascript:;" onclick="arrowUp()"><i
																class="icon fa fa-sort-asc"></i></a></div>
													<div class="arrow minus gradient"><span class="ir"><i
																class="icon fa fa-sort-desc" onclick="arrowDown()"></i></span></div>
												</div>
												<input type="text" id="quantity" value="1" min="1">

											</div>
										</div>
									</div>
                                    <input type="hidden" id="product_id" value="{{ $product->id }}">
									<div class="col-sm-7">
										<button type="submit" onclick="addToCart()" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> Thêm vào giỏ hàng</button>
									</div>


								</div><!-- /.row -->
							</div><!-- /.quantity-container -->






						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->
			</div>

			<div class="product-tabs inner-bottom-xs  wow fadeInUp">
				<div class="row">
					{{-- <div class="col-sm-3">
						<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
							<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
							<li><a data-toggle="tab" href="#review">REVIEW</a></li>
							<li><a data-toggle="tab" href="#tags">TAGS</a></li>
						</ul><!-- /.nav-tabs #product-tabs -->
					</div> --}}
					<div class="col-sm-12">

						<div class="tab-content">

							<div id="description" class="tab-pane in active">
								<div class="product-tab">
									{!! $product->description !!}
									{!! $product->specification !!}
								</div>
							</div><!-- /.tab-pane -->

							<div id="review" class="tab-pane">
								<div class="product-tab">

									<div class="product-reviews">
										<h4 class="title">Customer Reviews</h4>

										<div class="reviews">
											<div class="review">
												<div class="review-title"><span class="summary">We love this
														product</span><span class="date"><i
															class="fa fa-calendar"></i><span>1 days
															ago</span></span></div>
												<div class="text">"Lorem ipsum dolor sit amet, consectetur
													adipiscing elit.Aliquam suscipit."</div>
											</div>

										</div><!-- /.reviews -->
									</div><!-- /.product-reviews -->



									<div class="product-add-review">
										<h4 class="title">Write your own review</h4>
										<div class="review-table">
											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th class="cell-label">&nbsp;</th>
															<th>1 star</th>
															<th>2 stars</th>
															<th>3 stars</th>
															<th>4 stars</th>
															<th>5 stars</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="cell-label">Quality</td>
															<td><input type="radio" name="quality" class="radio"
																	value="1"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="2"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="3"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="4"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="5"></td>
														</tr>
														<tr>
															<td class="cell-label">Price</td>
															<td><input type="radio" name="quality" class="radio"
																	value="1"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="2"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="3"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="4"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="5"></td>
														</tr>
														<tr>
															<td class="cell-label">Value</td>
															<td><input type="radio" name="quality" class="radio"
																	value="1"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="2"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="3"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="4"></td>
															<td><input type="radio" name="quality" class="radio"
																	value="5"></td>
														</tr>
													</tbody>
												</table><!-- /.table .table-bordered -->
											</div><!-- /.table-responsive -->
										</div><!-- /.review-table -->

										<div class="review-form">
											<div class="form-container">
												<form role="form" class="cnt-form">

													<div class="row">
														<div class="col-sm-6">
															<div class="form-group">
																<label for="exampleInputName">Your Name <span
																		class="astk">*</span></label>
																<input type="text" class="form-control txt"
																	id="exampleInputName" placeholder="">
															</div><!-- /.form-group -->
															<div class="form-group">
																<label for="exampleInputSummary">Summary <span
																		class="astk">*</span></label>
																<input type="text" class="form-control txt"
																	id="exampleInputSummary" placeholder="">
															</div><!-- /.form-group -->
														</div>

														<div class="col-md-6">
															<div class="form-group">
																<label for="exampleInputReview">Review <span
																		class="astk">*</span></label>
																<textarea class="form-control txt txt-review"
																	id="exampleInputReview" rows="4"
																	placeholder=""></textarea>
															</div><!-- /.form-group -->
														</div>
													</div><!-- /.row -->

													<div class="action text-right">
														<button class="btn btn-primary btn-upper">SUBMIT
															REVIEW</button>
													</div><!-- /.action -->

												</form><!-- /.cnt-form -->
											</div><!-- /.form-container -->
										</div><!-- /.review-form -->

									</div><!-- /.product-add-review -->

								</div><!-- /.product-tab -->
							</div><!-- /.tab-pane -->

							<div id="tags" class="tab-pane">
								<div class="product-tag">

									<h4 class="title">Product Tags</h4>
									<form role="form" class="form-inline form-cnt">
										<div class="form-container">

											<div class="form-group">
												<label for="exampleInputTag">Add Your Tags: </label>
												<input type="email" id="exampleInputTag" class="form-control txt">


											</div>

											<button class="btn btn-upper btn-primary" type="submit">ADD
												TAGS</button>
										</div><!-- /.form-container -->
									</form><!-- /.form-cnt -->

									<form role="form" class="form-inline form-cnt">
										<div class="form-group">
											<label>&nbsp;</label>
											<span class="text col-md-offset-3">Use spaces to separate tags. Use
												single quotes (') for phrases.</span>
										</div>
									</form><!-- /.form-cnt -->

								</div><!-- /.product-tab -->
							</div><!-- /.tab-pane -->

						</div><!-- /.tab-content -->
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.product-tabs -->

			<!-- ============================================== UPSELL PRODUCTS ============================================== -->
			<section class="section featured-product wow fadeInUp">
				<h3 class="section-title">sản phẩm bán chạy</h3>
				<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                    @foreach ($bestSellings as $product)
                    @include('frontend.product._product_item_carousel',['tag'=>'sale'])
                    {{-- <div class="item item-carousel">
						<div class="products">

							<div class="product">
								<div class="product-image">
									<div class="image">
										<a href="{{ route('products.show', $bestSelling->id) }}"><img src="{{ $bestSelling->getFirstImageUrl('medium') }}" alt=""></a>
									</div><!-- /.image -->

									<div class="tag sale"><span>sale</span></div>
								</div><!-- /.product-image -->


								<div class="product-info text-left">
									<h3 class="name"><a href="detail.html">{{ $bestSelling->name }}</a></h3>
									<div class="rating rateit-small"></div>
									<div class="description"></div>

									<div class="product-price">
										<span class="price">
											{{ $bestSelling->discount_price }} </span>
										<span class="price-before-discount">{{ $bestSelling->base_price }}</span>

									</div><!-- /.product-price -->

								</div><!-- /.product-info -->
								<div class="cart clearfix animate-effect">
									<div class="action">
										<ul class="list-unstyled">
											<li class="add-cart-button btn-group">
												<button class="btn btn-primary icon" data-toggle="dropdown"
													type="button">
													<i class="fa fa-shopping-cart"></i>
												</button>
												<button class="btn btn-primary cart-btn" type="button">Add to
													cart</button>

											</li>

											<li class="lnk wishlist">
												<a class="add-to-cart" href="detail.html" title="Wishlist">
													<i class="icon fa fa-heart"></i>
												</a>
											</li>

											<li class="lnk">
												<a class="add-to-cart" href="detail.html" title="Compare">
													<i class="fa fa-signal"></i>
												</a>
											</li>
										</ul>
									</div><!-- /.action -->
								</div><!-- /.cart -->
							</div><!-- /.product -->

						</div><!-- /.products -->
					</div><!-- /.item --> --}}
                    @endforeach


				</div><!-- /.home-owl-carousel -->
			</section><!-- /.section -->
			<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

		</div><!-- /.col -->
        <div class='col-md-3 sidebar'>
            @include('frontend.product._sidebar')
        </div><!-- /.sidebar -->
		<div class="clearfix"></div>
	</div>
    @include('frontend.body.brands')
</div>
@endsection
