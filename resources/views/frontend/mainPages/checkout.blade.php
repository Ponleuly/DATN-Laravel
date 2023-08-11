<?php
	use App\Models\Sizes;
	use App\Models\Products_Attributes;
	use App\Models\Products;
	use App\Models\Products_Sizes;
?>
@extends('index')
@section('content')
	<!-- Start breabcrumb Section -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
		  	<li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>
			<li class="breadcrumb-item ">
				<a href="{{url("cart")}}" class="text-light">Cart</a>
			</li>
		  	<li class="breadcrumb-item text-light">Checkout</li>
		</ol>
	</nav>

	<!-- End breabcrumb Section -->
	<div class="untree_co-section">
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
				<!------------------End Alert ------------------------>

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
		      	<!----------------Start </form> -------------->
				<form
					action="{{url('place-order')}}"
					method="POST"
					enctype="multipart/form-data"
					id="checkout"
					>
                	@csrf <!-- to make form active -->
					<div class="row">
						<!------------------------Delivery Informations--------------------------------->
						<div class="col-md-6 mb-5 mb-md-0" >
							<div class="p-3 p-lg-4 border bg-white">
								<h2 class="h3 mb-3 text-black">Delivery Informations</h2>
								@php
									if (Auth::check() && Auth::user()->role == 1) {
										if(Request::old('c_name')){
											$c_name =  Request::old('c_name');
										}else{
											$c_name =  Auth::user()->name;
										}
										if(Request::old('c_phone')){
											$c_phone =  Request::old('c_phone');
										}else{
											$c_phone =  Auth::user()->phone;
										}
										if(Request::old('c_email')){
											$c_email =  Request::old('c_email');
										}else{
											$c_email =  Auth::user()->email;
										}
										if(Request::old('c_address')){
											$c_address =  Request::old('c_address');
										}else{
											$c_address =  Auth::user()->address;
										}
										if(Request::old('c_city')){
											$c_city =  Request::old('c_city');
										}else{
											$c_city =  Auth::user()->city;
										}
										if(Request::old('c_district')){
											$c_district =  Request::old('c_district');
										}else{
											$c_district =  Auth::user()->district;
										}
										if(Request::old('c_ward')){
											$c_ward =  Request::old('c_ward');
										}else{
											$c_ward =  Auth::user()->ward;
										}
										$c_note =  Request::old('c_note');
										$ship = Request::old('delivery_fee');
									}
									else{
										$c_name =  Request::old('c_name');
										$c_phone =  Request::old('c_phone');
										$c_email =  Request::old('c_email');
										$c_address =  Request::old('c_address');
										$c_city =  Request::old('c_city');
										$c_district =  Request::old('c_district');
										$c_ward =  Request::old('c_ward');
										$c_note =  Request::old('c_note');
										$ship = Request::old('delivery_fee');
									}
								@endphp
								<div class="form-group row mb-3">
									<div class="col-md-6">
										<label for="c_name" class="text-black mb-1">Customer Name <span class="text-danger">*</span></label>
										<input
											type="text"
											class="form-control form-control-sm rounded-0"
											id="c_name"
											name="c_name"
											value="{{$c_name}}"
											placeholder="Full Name"
											required
										>
									</div>
									<div class="col-md-6">
										<label for="c_phone" class="text-black mb-1">Phone Number <span class="text-danger">*</span></label>
										<input
											type="text"
											class="form-control form-control-sm rounded-0"
											id="c_phone"
											name="c_phone"
											value="{{$c_phone}}"
											placeholder="Phone Number"
											required
										>
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-6">
										<label for="c_email" class="text-black mb-1">Email <span class="text-danger">*</span></label>
										<input
											type="email"
											class="form-control form-control-sm rounded-0"
											id="c_email"
											name="c_email"
											value="{{$c_email}}"
											placeholder="Example@gmail.com"
											required
										>
									</div>
									<div class="col-md-6">
										<label for="c_address" class="text-black mb-1">Address <span class="text-danger">*</span></label>
										<input
											type="text"
											class="form-control form-control-sm rounded-0"
											id="c_address"
											name="c_address"
											value="{{$c_address}}"
											placeholder="Street name, floor...."
											required
										>
									</div>
								</div>

								<div class="form-group row mb-3">
									<div class="col-md-12">
										<div class="row">
											<div class="col-4">
												<label for="c_city" class="text-black mb-1">City/Province <span class="text-danger">*</span></label>
												<input
													type="text"
													class="form-control form-control-sm rounded-0"
													id="c_city"
													name="c_city"
													value="{{$c_city}}"
													placeholder="City/Province...."
													required
												>
											</div>
											<div class="col-4">
												<label for="c_district" class="text-black mb-1">District <span class="text-danger">*</span></label>
												<input
													type="text"
													class="form-control form-control-sm rounded-0"
													id="c_district"
													name="c_district"
													value="{{$c_district}}"
													placeholder="District...."
													required
												>
											</div>
											<div class="col-4">
												<label for="c_ward" class="text-black mb-1">Ward <span class="text-danger">*</span></label>
												<input
													type="text"
													class="form-control form-control-sm rounded-0"
													id="c_ward"
													name="c_ward"
													value="{{$c_ward}}"
													placeholder="Ward...."
													required
												>
											</div>
										</div>

									</div>
								</div>

								<div class="form-group mb-4">
									<label for="c_note" class="text-black mb-1">Notes</label>
									<textarea
										name="c_note"
										id="c_note"
										cols="30"
										rows="3"
										class="form-control form-control-sm rounded-0"
										placeholder="Write here..."
										>{{$c_note}}</textarea>
								</div>

								<h2 class="h3 mb-3 text-black">Delivery Methods</h2>
								@foreach ($deliveries as $delivery)
									<div class="row d-flex  align-items-baseline mb-3">
										<div class="col-md-6">
											<div class="form-check">
												<input
													class="form-check-input big-radio me-2 mb-2 my-2"
													type="radio"
													name="delivery_fee"
													id="delivery_option{{$delivery->id}}"
													value="{{$delivery->delivery_fee}}"
													@if ($delivery->delivery_fee == $ship)
														checked
													@endif
													required
													onclick = "delMethod()";
												>
												<label
													class="form-check-label text-dark fs-6"
													for="delivery_option{{$delivery->id}}"
													style="margin-top: 5px"
													>
													{{$delivery->delivery_option}}
												</label>
											</div>
										</div>
										<div class="col-md-4 d-flex justify-content-end">
											<label
												class="form-check-label text-danger fs-6"
												for="delivery_option"
												>
												$ {{$delivery->delivery_fee}}
											</label>
										</div>
									</div>

								@endforeach
							</div>
						</div>
						<!------------------------End Delivery Informations--------------------------------->

						<!----------------------------------------- Your Cart --------------------------------------------->
						<div class="col-md-6">
							<div class="row mb-5">
								<div class="col-md-12">
									<div class="p-3 p-lg-4 border bg-white">
										<h2 class="h3 mb-3 text-black">Your Cart</h2>
										<table class="table site-block-order-table mb-2">
											<thead>
												<th>Products</th>
												<th class="text-center">Size</th>
												<th class="text-center" style="width: 100px">Price</th>
												<th class="text-center">Quantity</th>
												<th class="text-end" style="width: 100px">Amount</th>
											</thead>
											<!--------------------- Cart product table --------------->
											<tbody>
												@php
													$subtotal = 0;
													$total = 0;
													$deliveryFee = $ship;
												@endphp
												@foreach ($carts as $cart)
													@php
														//$subtotal += $cart->price * $cart->qty;
														//$productSizes = Sizes::where('id', $cart->options->size)->first();
														//--- Check if user is guest or sign in to display img from db ---//
														if(Auth::check() && Auth::user()->role == 1){
															$cartId = $cart->id;
															$productId = $cart->product_id;
															//$product = Products::where('id', $productId)->first();
															$size = Products_Sizes::where('size_id', $cart->size_id)->first();

															// Image
															$productImg = $cart->rela_product_cart->product_imgcover;
															// Name
															$productName = $cart->rela_product_cart->product_name;
															// Code
															$productCode = $cart->rela_product_cart->product_code;
															// Size
															$productSize = $size->rela_product_size->size_number;
															// Quantity
															$quantity = $cart->product_quantity;
															//price
															$price =  $cart->rela_product_cart->product_saleprice;
															$subtotal += $price * $quantity;

														}else{
															$cartId = $cart->id;
															$productId = $cart->id; // becoz in Cart model, column id is product_id
															$product = Products::where('id', $cartId)->first();
															$sizeId = $cart->options->has('size') ? $cart->options->size : '';
															$size = Products_Sizes::where('size_id', $sizeId)->first();

															// Image
															$productImg = $cart->options->has('image') ? $cart->options->image : '';
															// Name
															$productName = $cart->name;
															// Code
															$productCode =  $product->product_code;
															// Size ==>Get size_id from Cart:: in colum options
															$productSize = $size->rela_product_size->size_number;
															//$productSize->rela_product_size->size_number
															// Quantity
															$quantity = $cart->qty;
															// Price
															$price = $cart->price;
															$subtotal += $price * $quantity;
														}
													@endphp
													<tr>
														<td class="border-bottom-0">
															{{$productName}}
														</td>
														<td class="text-center border-bottom-0">
															<strong class="text-danger">{{$productSize}}</strong>
														</td>
														<td class="text-center border-bottom-0">
															<strong class="text-danger">$ {{number_format($price ,2)}}</strong>
														</td>
														<td class="text-center border-bottom-0">
															<strong class="text-danger">x {{$quantity}}</strong>
														</td>
														<td class="text-end border-bottom-0">
															$ {{number_format($price * $quantity, 2)}}
														</td>
													</tr>
												@endforeach
											</tbody>
											<!---------------------End Cart product table --------------->

											<!---------------------Total table --------------------------->
											<tbody>
													<tr>
														<td class="text-black font-weight-bold border-bottom-0 ">
															<strong>Sub total</strong>
														</td>
														<td class="border-bottom-0"></td>
														<td class="border-bottom-0"></td>
														<td class="border-bottom-0"></td>
														<td class="text-black text-end border-bottom-0">
															<strong  id="subTotal">$ {{number_format($subtotal, 2)}}</strong>
														</td>
													</tr>

													<tr>
														<td class="text-black font-weight-bold border-bottom-0">
															<strong>Delivery fee</strong>
														</td>
														<td class="border-bottom-0"></td>
														<td class="border-bottom-0"></td>
														<td class="border-bottom-0"></td>
														<td class="text-black text-end font-weight-bold border-bottom-0 ">
															<strong  id="deliveryFee">$ {{number_format($deliveryFee, 2)}}</strong>
														</td>
													</tr>
													<tr>
														<td class="text-black font-weight-bold">
															<strong>Discount</strong>
														</td>
														<td ></td>
														<td ></td>
														<td ></td>
														<td class="text-black font-weight-bold d-flex justify-content-end" >
															<input
																class="form-control form-control-sm w-100 text-end pe-0 ps-0 border-0 bg-white text-danger fw-bold"
																name="discount"
																value="$ {{number_format($discount, 2)}}"
																aria-label=".form-control-sm example"
																readonly
																placeholder="$"
																id="discount"
															>
														</td>
													</tr>
													<tr>
														<td class="text-black h6  border-bottom-0">
															<strong>Total Paid</strong>
														</td>
														<td class="border-bottom-0"></td>
														<td class="border-bottom-0"></td>
														<td class="border-bottom-0"></td>
														<td class="text-danger text-end border-bottom-2 border-danger d-flex justify-content-end">
															<input
																class="form-control w-100 text-end pe-0 ps-0 border-0 bg-white text-danger fw-bold"
																name="total_paid"
																value="$ {{$total  = number_format((($subtotal + number_format($deliveryFee, 2)) - $discount) ,2)}}"
																aria-label=".form-control-sm example"
																readonly
																placeholder="$"
																id="totalPaid"
															>
														</td>
													</tr>
											</tbody>
										</table>
										<!--------------------- End Toal table --------------------------->

										<!------------------------------------ Payment Method ------------------------------------------>
										<h2 class="h3 mb-3 text-black">Payment Methods</h2>
										@foreach ($payments as $payment)
											<div class="form-check form-check-inline">
												<input
													class="form-check-input big-radio me-2"
													type="radio"
													name="payment"
													value="{{$payment->payment_title}}"
													id="{{$payment->payment_title}}"
													required
												>
												<label class="form-check-label text-dark" for="{{$payment->payment_title}}">
													<h3 class="h6 mb-2 mt-1">
														{{$payment->payment_title}}
													</h3>
												</label>
											</div>
										@endforeach
										<hr>
										<!--------------------------------------------End Payment Method ----------------------------------------------------------->
										<div class="row">
											<div class="col-md-6 mt-3">
												<a
													href="{{url('cart')}}"
													class="btn btn-dark btn-sm shadow py-1 fw-semibold rounded-1"
													>
													<span class="material-icons-outlined me-2"
														style="vertical-align: middle; font-size: 24px"
														>west
													</span>
													<span style="vertical-align: middle;">Back</span>
												</a>
											</div>
											<div class="col-md-6 d-flex justify-content-end mt-3">
												<button
													type="submit"
													class="btn btn-danger shadow px-3 py-1 fw-semibold  rounded-1"
													value="placeorder"
													id="btn-submit"
													>
													<span style="vertical-align: middle;">Place Order</span>
													<span class="material-icons-outlined ms-1"
														style="vertical-align: middle; font-size: 24px">shopping_bag
													</span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!------------------------ Your Cart --------------------------------->
					</div>
				</form>
		      	<!---------------------- End </form> ---------------->
				<!---/// onclick="location.href='{{ url('thankyou') }}'" ///-->
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	
	{{-- Display delivery fee after select --}}
	<script>
		function delMethod() {
			var delPrice = $("input[type='radio'][name='delivery_fee']:checked").val();
			var del = document.getElementById("deliveryFee");
			var sub = document.getElementById("subTotal").innerText;
			var dis = document.getElementById("discount").value;
			var total = document.getElementById("totalPaid").value;
			var Total = document.getElementById("totalPaid");

			del.innerHTML = "$ " + delPrice;
			// remove first 2 digit of string then use parseFloat to convert to number
			var subTotal = parseFloat(sub.substr(2));
			var discount = parseFloat(dis.substr(2));

			var paid = (subTotal + parseFloat(delPrice)) - discount;
			Total.value = "$ " + paid.toFixed(2); //toFixed(2) to get .00
		}
	</script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="sweetalert2.all.min.js"></script>
	<script src="sweetalert2.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js">
	
	{{-- Question check before finishing order --}}
	<script>
		$('#btn-submit').on('click',function(e) {
			let name = document.forms["checkout"]["c_name"].value;
			let phone = document.forms["checkout"]["c_phone"].value;
			let email = document.forms["checkout"]["c_email"].value;
			let address = document.forms["checkout"]["c_address"].value;
			let delivery = document.forms["checkout"]["delivery_fee"].value;
			let payment = document.forms["checkout"]["payment"].value;

			if (name == "" || phone == "" || email =="" || address == "" || delivery == "" ||payment =="") {
				name.setAttribute("required", "");
				phone.setAttribute("required", "");
				email.setAttribute("required", "");
				address.setAttribute("required", "");
				delivery.setAttribute("required", "");
				payment.setAttribute("required", "");
			}
			event.preventDefault();
			let form = $(this).parents('form');
			Swal.fire({
				position: 'top',
				title: 'Are you sure to place order?',
				text: "Plese make sure with all your informations !",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Place Order',
				cancelButtonText: 'Check Again',
				reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				form.submit();
			}else{
				swal("Cancelled", "You are not order yet :)", "error");
			}
			});
		});
	</script>
@endsection()