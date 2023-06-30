<?php
	use App\Models\Products_Sizes;
	use App\Models\Products_Attributes;
	use App\Models\Products;
	use App\Models\likes;

?>
@extends('index')
@section('content')
	<!-- Start breabcrumb Section -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
		  	<li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>
		  	<li class="breadcrumb-item text-light">Cart</li>
		</ol>
	</nav>
	<!-- End breabcrumb Section -->

	<div class="untree_co-section	">
		<div class="container">
			<!--------------- Alert ------------------------>
			@if(Session::has('error'))
				<script>
					var type = 'error';
					var text = "<?php echo Session::get('error'); ?>";
				</script>
				<script src="{{url('frontend/js/sweetAlert.js')}}"></script>
				@elseif(Session::has('info'))
					<script>
						var type = 'info';
						var text = "<?php echo Session::get('info'); ?>";
					</script>
					<script src="{{url('frontend/js/sweetAlert.js')}}"></script>

					@elseif(Session::has('success'))
						<script>
							var type = 'success';
							var text = "<?php echo Session::get('success'); ?>";
						</script>
						<script src="{{url('frontend/js/sweetAlert.js')}}"></script>
					@elseif(Session::has('question'))
						<script>
							var type = 'question';
							var text = "<?php echo Session::get('question'); ?>";
						</script>
						<script src="{{url('frontend/js/sweetAlert.js')}}"></script>
            @endif
            <!---------------End Alert ------------------------>

            <!---------------Sign in link ------------------------>
			@if(!(Auth::check() && Auth::user()->role == 1))
				<div class="row mb-3">
					<div class="col-md-12">
						<div class="border p-3 rounded-0" role="alert">
							Have an account ? <a href="{{url('login')}}">Click here</a> to sign in.
						</div>
					</div>
				</div>
			@endif
            <!--------------- End Sign in link ------------------------>

			<hr>

			<div class="row">
				<!--------------------Start Cart list------------------------->
		        <div class="col-md-8 mb-5 mb-md-0 mt-3">
					<!----- Price calculate --->
					@php
						$subtotal = 0;
						$total = 0;
						$discount = 0;
						$discount  =  Session::get('discount');
						$btn = 0;
					@endphp
					<!---------------------->

					@if($carts_count > 0 )
						<!--*session('cart') as $id => $details-->
						@foreach ($carts as $cart)
							@php
								$btn++;
								//--- Check if user is guest or sign in to display img from db ---//
								if(Auth::check() && Auth::user()->role == 1){
									$cartId = $cart->id;
									$productId = $cart->product_id;
									//$product = Products::where('id', $productId)->first();
									$productSizes = Products_Sizes::where('product_id', $productId)->get();

									// Image
									$productImg = $cart->rela_product_cart->product_imgcover;
									// Name
									$productName =  $cart->rela_product_cart->product_name;
									// Code
									$productCode =  $cart->rela_product_cart->product_code;
									// Size
									$size = $cart->size_id;
									// Quantity
									$quantity = $cart->product_quantity;
									//price
									$price =  $cart->product_price;
									$subtotal += $price * $quantity;
								}else{
									$cartId = $cart->rowId;
									$productId = $cart->id; // becoz in Cart model, column id is product_id
									$product = Products::where('id', $productId)->first();
									$productSizes = Products_Sizes::where('product_id', $productId)->get();

									// Image
									$productImg = $cart->options->has('image') ? $cart->options->image : '';
									// Name
									$productName = $cart->name;
									// Code
									$productCode =  $product->product_code;
									// Size ==>Get size_id from Cart:: in colum options
									$size = $cart->options->has('size') ? $cart->options->size : '';
									// Quantity
									$quantity = $cart->qty;
									// Price
									$price = $cart->price;
									$subtotal += $price * $quantity;
								}
							@endphp
							<div class="row form-group">
								<div class="col-md-2">
									<a href="{{url('product-detail/'. $productCode)}}">
										<img
											src="/product_img/imgcover/{{$productImg}}"
											class="img-fluid product-thumbnail"
										>
									</a>
								</div>
								<div class="col-md-7 d-grid">
									<div class="row">
										<a
											href="{{url('product-detail/'.  $productCode)}}"
											class="text-decoration-none"
											>
											<h5 class="text-dark">{{$productName}}</h5>
										</a>
									</div>

									<div class="row d-grid">
										@php
        									$productGroups = Products_Attributes::where('product_id', $productId)->get();
										@endphp
										<label>
											@foreach ($productGroups as $group)
												{{$group->rela_product_group->group_name}}
												{{($loop->last)? '':'&'}}
											@endforeach
										</label>
									</div>
									<!----------------------- Start Size and Quantity ---------------->
									<!------Form update Size and Quantity -------->
									<form
										action="{{url('update-cart/'.$cartId)}}"
										method="POST"
										enctype="multipart/form-data"
										id="update-cart-{{$btn}}"
										>
                						@csrf <!-- to make form active -->
										@method('PUT')

										<div class="row mt-3">
											<div class="col-md-3  mt-auto d-grid">
												<label class="text-black" for="size">Size</label>
												<select
													class="form-select form-control form-select-sm bg-transparent rounded-0 border-1 border-dark"
													aria-label="Default select example"
													id="size"
													name="size_id"
													onchange="this.form.submit()"
													>
													@foreach ($productSizes as $productSize)
														@php
															$sizeLeft = Products_Sizes::where('product_id',  $productId)
																->where('size_id', $productSize->size_id)->first();
														@endphp

														<option
															class="{{($sizeLeft->size_quantity == 0)? 'text-danger' : ''}}"
															value="{{$productSize->size_id}}"
															{{($productSize->size_id == $size) ? 'selected' : ''}}
															{{($sizeLeft->size_quantity == 0)? 'disabled':''}}
															>
															{{$productSize->rela_product_size->size_number}}
															{{($sizeLeft->size_quantity == 0)? '(Out of stock)':''}}
														</option>

													@endforeach
												</select>
											</div>
											<div class="col-md-4">
												<label class="text-black">Quantity</label>
												<div class="input-group quantity-container">
													<button
														class="btn btn-outline-dark btn-sm rounded-0 border-1"
														type="button"
														id="minus-btn-{{$btn}}"
														onclick="updateQty(event)"
														{{($quantity == 1)? 'disabled':''}}
														><i class="bi bi-dash-lg"></i>
													</button>
													<input
														class="form-control form-control-sm bg-transparent text-center border-dark mx-1"
														type="number"
														max="10" min="1"
														name="product_quantity"
														id="qty-input-{{$btn}}"
														value="{{$quantity}}"
														required
														aria-label="Example text with button addon"
														aria-describedby="button-addon"
														onchange="(this.value == 0) ? this.value={{$quantity}}:this.form.submit()"
													>
													<button
														class="btn btn-dark btn-sm rounded-0 border-1 "
														type="button"
														id="plus-btn-{{$btn}}"
														onclick="updateQty(event)"
														{{($quantity == 10)? 'disabled':''}}
														><i class="bi bi-plus-lg"></i>
													</button>
												</div>
											</div>
										</div>
									</form>
									<!------ End Form update Size and Quantity -------->
									<!---------------------- End Size and Quantity -------------------->
								</div>

								<div class="col-md-3 d-grid">
									<div class="row text-end">
										<h5 class="text-dark">${{$price}} x {{$quantity}}</h5>
									</div>
									<div class="row mt-auto justify-content-end">
										<div class="col-md-6 d-grid text-end">
											@php
										    	if(Auth::check() && Auth::user()->role == 1){
										            $userId = Auth::user()->id;
										            $isLiked = Likes::where('product_id', $productId)->where('user_id',  $userId)->first();
													//$isLiked = 1;
													$logIn = 1;
										        }else{
										            $userId = 0;
										            $isLiked = 1;
													$logIn = 0;
										        }
										    @endphp
											<a
												href="{{url('add-like/'.$productId.'/'.$userId)}}"
												class="mb-2 pb-0 {{($isLiked != '' && $logIn==1)? 'text-danger':'text-secondary'}}"
												role="button"
												>
												<span class="material-icons-outlined">favorite</span>
											</a>
											<a
												href="{{url('remove-from-cart/'.$cartId)}}"
												class=" pb-0"
												role="button"
												>
                            					<span class="material-icons-outlined">delete</span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<hr>
						@endforeach
						@else
							<h4 class="py-2">
								<p>There are no items in your cart. Find some products
                            		<a href="{{url('shop')}}" class="text-danger">Click here !</a>
								</p>
							</h4>
					@endif
					<!----------------------End cart list  Continue Shopping--------------------------->

					<!-------------- Start Remove all  and ----------------------->
					<div class="row">
						<div class="col-md-">
							<div class="row mb-5">
								<div class="col-md-6 mb-3 mb-md-0"> <!--remove-all-cart/0 ==> 0 is condiction to show question--->
									<a
										href="{{url('remove-all-cart/0')}}"
										class="btn btn-danger btn-sm shadow rounded-1 px-3 {{($carts_count == 0)? 'disabled':''}}"
										>
										<span class="material-icons-outlined"
											style="vertical-align: middle; font-size: 24px">delete
										</span>
										<span style="vertical-align: middle">Delete all</span>
									</a>
								</div>
								<div class="col-md-6 d-flex justify-content-end">
									<a
										href="{{url('shop')}}"
										class="btn btn-danger btn-sm shadow rounded-1 px-3"
										>
										<span style="vertical-align: middle">Continue shopping</span>
											<span class="material-icons-outlined ms-1"
										style="vertical-align: middle; font-size: 24px">add_shopping_cart</span>
									</a>
								</div>
							</div>
						</div>
					</div>
		        </div>
				<!--------------------End Cart section------------------------->

				<!--------------------Start ORDER SUMMARY section------------------------->
		        <div class="col-md-4">
		          	<div class="row mb-5">
		            	<div class="col-md-12">
		              		<div class="p-3 p-lg-4 border rounded-0">
								<h4 class="mb-3 text-black fw-bold">ORDER SUMMARY</h4>
								<hr>

								<h5 class="mb-2 text-black">Coupon</h5>
								<div class="d-grid col-md-12">
									@php
										if(Auth::check() && Auth::user()->role == 1){
										    $userId = Auth::user()->id;
										}else{
										    $userId = 0;
										}
                                    @endphp
									<!---------------- Form to appy coupon ------------------->
									<form
										action="{{url('coupon-apply/'. $userId)}}"
										method="POST"
										enctype="multipart/form-data"
										>
										@csrf <!-- to make form active -->
										<div class="input-group mb-2">
											<input
												type="text"
												class="form-control bg-transparent rounded-1 text-uppercase rounded-end-0"
												id="coupon"
												name="code"
												placeholder="Enter your promo code"
												aria-label="coupon"
												aria-describedby="button-addon2"
												{{($carts_count == 0)? 'disabled':'' }}
												required
											>
											<button
												class="btn btn-outline-danger px-3 rounded-1 rounded-start-0"
												type="submit"
												id="button-addon2"
												>Apply
											</button>
										</div>
									</form>
								</div>
								<hr>
								<table class="table site-block-order-table mb-3">
									<tbody>
										<tr>
											<td class="text-black font-weight-bold border-bottom-0">
												<strong>Sub total</strong>
											</td>
											<td class="text-black text-end border-bottom-0">
												<strong>$ {{number_format($subtotal, 2)}}</strong>
											</td>
										</tr>
										<tr>
											<td class="text-black font-weight-bold border-bottom-1">
												<strong>Discount</strong>
											</td>
											<td class="text-black font-weight-bold d-flex justify-content-end">
												<strong>$ {{number_format($discount, 2)}}</strong>
											</td>
										</tr>
										<tr>
											<td class="text-black h6 fw-bold border-bottom-0">
												<strong>Total</strong>
											</td>
											<td class="text-danger text-end h6 fw-bold border-bottom-0">
												<strong>$ {{$total = number_format(($subtotal - $discount) ,2)}}</strong>
											</td>
										</tr>
									</tbody>
								</table>

								<div class="d-grid">
									<a
										class="btn btn-danger btn-sm shadow py-2 rounded-1
											{{($carts_count == 0)? 'disabled':'' }}"
										href="{{url('checkout/dis='.number_format($discount, 2))}}"

										>
										<span class="fw-bold" style="vertical-align: middle;">CHECKOUT</span>
										<span class="material-icons-outlined ms-1"
											style="vertical-align: middle; font-size: 24px">shopping_cart_checkout</span>
									</a>
								</div>
		                	</div>
		            	</div>
		        	</div>
		    	</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" ></script>
    <script>
        var btn = $('.quantity-container').length;
		function updateQty(event) {
            let btnType = event.currentTarget.id;
			//alert(btnType);
			for(var i=1 ; i<=btn; i++){
				if(btnType == 'plus-btn-'+i){
					$('#qty-input-'+i).val(parseInt($('#qty-input-'+i).val()) + 1 );
                    if ($('#qty-input-'+i).val() > 9) {
                        $('#qty-input-'+i).val(10);
                    }
					$('#update-cart-'+i).submit();
				}
			}
			for(var j=1 ; j<=btn; j++){
				if(btnType == 'minus-btn-'+j){
					$('#qty-input-'+j).val(parseInt($('#qty-input-'+j).val()) - 1 );
                    if ($('#qty-input-'+j).val() == 0) {
                        $('#qty-input-'+j).val(1);
                    }
					$('#update-cart-'+j).submit();
				}
			}
        }
    </script>
@endsection()