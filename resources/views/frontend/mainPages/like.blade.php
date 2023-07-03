<?php
	use App\Models\Products_Sizes;
	use App\Models\Products_Attributes;
	use App\Models\Products;
?>
@extends('index')
@section('content')
    <!-- Start breabcrumb Section -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
		  	<li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>

		  	<li class="breadcrumb-item text-light">Liked</li>
		</ol>
	</nav>
	<!-- End breabcrumb Section -->

	<div class="untree_co-section ">
        <div class="container">
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
            <hr class="line-color">
			@php
				$btn = 0;
			@endphp
            @if($likes_count > 0)
                @foreach ($likes as $like)
                    @php
						$btn++;
                        $sizeStock = 0;
                        $productGroups = Products_Attributes::where('product_id', $like->product_id)->get();
                        $productSizes = Products_Sizes::where('product_id', $like->product_id)->get();
                        foreach ($productSizes as $row) {
                            $sizeStock += $row->size_quantity;
                        }
                        $stockLeft = $sizeStock;
                    @endphp
                    <form action="{{url('add-to-cart/'. $like->product_id)}}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- to make form active -->
                        <div class="row my-3">
                            <div class="col-md-2">
                                <a  href="{{url('product-detail/'.$like->rela_product_like->product_code)}}">
								    <div class="img-container">
										<img
										    src="/product_img/imgcover/{{$like->rela_product_like->product_imgcover}}"
										    class="img-fluid product-thumbnail {{($stockLeft == 0)? 'opacity-50':''}}"
										>
										@if($like->rela_product_like->product_status == 1)
											<h6 class="text-new bg-danger">New Arrival</h6>
											@elseif($like->rela_product_like->product_price
										            > $like->rela_product_like->product_saleprice)
												<h6 class="text-new bg-black">Sale Off</h6>
										@endif
										@if($stockLeft == 0)
										    <h6 class="text-sold-out-sm bg-danger">Sold Out</h6>
										@endif
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-2 text-black fw-bold">
                                    <a
										href="{{url('product-detail/'.$like->rela_product_like->product_code)}}"
										class="text-decoration-none"
										>
										{{$like->rela_product_like->product_name}}
                                    </a>
                                </h4>
                                <label>
                                    @foreach ($productGroups as $group)
										{{$group->rela_product_group->group_name}}
										{{($loop->last)? '':'&'}}
                                    @endforeach
                                </label>
                                <h6 class="text-danger fw-bold py-3">
                                    <strong>${{$like->rela_product_like->product_saleprice}}</strong>
                                </h6>

                                <div class="row">
                                    <div class="col-md-3 pt-3">
										<h6 class="text-black fw-semibold">Size</h6>
										<select
										    class="form-select form-select-sm bg-transparent rounded-0 border-1 border-dark"
										    aria-label="Default select example"
										    id="size"
										    name="size_id"
										    required
										    >
										    @foreach ($productSizes as $productSize)
										        @php
										            $quantity = Products_Sizes::where('product_id',  $like->product_id)
										                ->where('size_id', $productSize->size_id)->first();
										        @endphp
										        <option
										            class="{{($quantity->size_quantity == 0)? 'text-danger' : ''}}"
										            value="{{$productSize->size_id}}"
										            {{($quantity->size_quantity == 0)? 'disabled':''}}
										            >
										            {{$productSize->rela_product_size->size_number}}
										            {{($quantity->size_quantity == 0)? '(Out of stock)':''}}
										        </option>
										    @endforeach
										</select>
                                    </div>
                                    <div class="col-md-3 pt-3">
										<h6 class="text-black fw-semibold">Quantity</h6>
										<div class="input-group quantity-container">
											<button
												class="btn btn-outline-dark btn-sm rounded-0 border-1 border-dark"
												type="button"
												id="minus-btn-{{$btn}}"
												onclick="updateQty(event)"
												><i class="bi bi-dash-lg"></i>
											</button>
											<input
												class="form-control form-control-sm bg-transparent border-1 border-dark mx-1 text-center "
												type="number"
												max="10" min="1"
												name="product_quantity"
												id="qty-input-{{$btn}}"
												value="1"
												required
												aria-label="Example text with button addon"
												aria-describedby="button-addon"
												onchange="(this.value == 0) ? this.value={{$quantity}}:this.form.submit()"
											>
											<button
												class="btn btn-dark btn-sm rounded-0 border-1 border-dark "
												type="button"
												id="plus-btn-{{$btn}}"
												onclick="updateQty(event)"

												><i class="bi bi-plus-lg"></i>
											</button>
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end flex-column justify-content-end">
                                <div class="col-sm-2 d-grid ">
                                    <button
										type="submit"
										name="action"
										value="addtocart"
										class="bg-transparent border-0 fw-semibold "
										title="Add to cart"
										>
										<span class="material-icons-outlined">add_shopping_cart</span>
                                    </button>
                                </div>
                                <div class="col-sm-2 d-grid">
                                    <a
										href="{{url('remove-like/'.$like->id)}}"
										class="btn fw-semibold text-danger"
										title="Delete from favourite">
										<span class="material-icons-outlined">delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                @endforeach
                @else
                    <h4>
                        <p>There are no items in your liked list. Find some products
                            <a href="{{url('shop')}}" class="text-danger">Click here !</a>
                        </p>
                    </h4>
			@endif
            <div class="row my-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <a
                        href="{{url('remove-all-like/0')}}"
                        class="btn btn-danger btn-sm rounded-1 px-3
                        {{($likes_count==0)? 'disabled': ''}}"
                        >
                        <span class="material-icons-outlined"
						    style="vertical-align: middle; font-size: 24px">delete
						</span>
						<span style="vertical-align: middle">Delete all</span>
                    </a>
                    <a
                        href="{{url('shop')}}"
                        class="btn btn-danger btn-sm rounded-1 px-3"
                        >
                        <span style="vertical-align: middle">Continue shopping</span>
                        <span class="material-icons-outlined ms-1"
							style="vertical-align: middle; font-size: 24px"
                            >
                            shopping_cart_checkout
                        </span>
					</a>
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
						$('#plus-btn-'+i).prop('disabled', true);
                    }
					if($('#qty-input-'+i).val() > 0){
						$('#minus-btn-'+i).prop('disabled', false);
					}
				}
			}
			for(var j=1 ; j<=btn; j++){
				if(btnType == 'minus-btn-'+j){
					$('#qty-input-'+j).val(parseInt($('#qty-input-'+j).val()) - 1 );
                    if ($('#qty-input-'+j).val() == 0) {
                        $('#qty-input-'+j).val(1);
						$('#minus-btn-'+j).prop('disabled', true);
                    }
					if($('#qty-input-'+j).val() < 10){
						$('#plus-btn-'+j).prop('disabled', false);
					}
				}
			}
        }
    </script>
@endsection()