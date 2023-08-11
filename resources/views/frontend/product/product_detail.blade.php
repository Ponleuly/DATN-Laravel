<?php
	use App\Models\Products_Sizes;
	use App\Models\Products_Imgreviews;
	use App\Models\Likes;
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
                @foreach ( $productGroups as $group)
                    <a
                        href="{{url('product-'.strtolower($group->rela_product_group->group_name))}}"
                        class="text-light"
                        >
                        {{$group->rela_product_group->group_name}}
                    </a>
                    {{($loop->last)? '': '-'}}
                @endforeach
            </li>
		    <li class="breadcrumb-item ">
                <a
                    href="{{url('product-category/'.strtolower($productAttribute->rela_product_category->category_name))}}"
                    class="text-light"
                    >
                    {{$productAttribute->rela_product_category->category_name}}
                </a>
            </li>
		    <li class="breadcrumb-item">
                <a
                    href="{{url("product-subcategory/". strtolower($productAttribute->rela_product_subcategory->sub_category))}}"
                    class="text-light"
                    >
                    {{$productAttribute->rela_product_subcategory->sub_category}}
                </a>
            </li>
		    <li class="breadcrumb-item text-light active" aria-current="page">
                {{$productDetails->product_name}}
            </li>
		</ol>
	</nav>
	<!-- End breabcrumb Section -->

    <div class="untree_co-section">
		<div class="container">
            <!---======== Start Alert =======-->
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
            <!---======== End Alert =======-->

		    <!--------------Start </form> ---------------------->
            <form action="{{url('add-to-cart/'.$productDetails->id)}}" method="POST" enctype="multipart/form-data">
                @csrf <!-- to make form active -->
                <div class="row">
                    <!-- Start image section -->
                    <div class="col-md-7 mb-5 mb-md-0">
						<div class="img-container">
                            <!-- Start image cover section -->
                            <div id="carouselExampleControlsNoTouching" class="carousel slide px-1" data-bs-touch="false" data-bs-interval="false">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img
                                            src="/product_img/imgcover/{{$productDetails->product_imgcover}}"
                                            class="img-fluid product-thumbnail mb-3 {{($stockLeft == 0)? 'opacity-50':''}}"
                                        >
                                    </div>
                                    @foreach ($imgReviews as $imgreview)
                                        <div class="carousel-item">
                                            <img
                                                src="/product_img/imgreview/{{$imgreview->product_imgreview}}"
                                                class="img-fluid product-thumbnail mb-3 {{($stockLeft == 0)? 'opacity-50':''}}"
                                            >
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- End image cover section -->

                            @if($productDetails->product_status == 1)
								<h6 class="text-new bg-danger">New Arrival</h6>
								@elseif($productDetails->product_price > $productDetails->product_saleprice)
									<h6 class="text-new bg-black">Sale Off</h6>
                                @elseif($stockLeft == 0)
									<h6 class="text-new bg-danger">Sold Out</h6>
							@endif
                            
                            <!-- Start image review section -->
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($imgReviews as $imgreview)
                                        <div class="carousel-item {{($loop->first)? 'active':''}} " id="carousel-item-1" data-bs-interval="2000">
                                            <div class="col-md-3 ">
                                                <img
                                                    src="/product_img/imgreview/{{$imgreview->product_imgreview}}"
                                                    class="img-fluid product-thumbnail px-1"
                                                >
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($allImgReviews as $allimgreview)
                                        @if($allimgreview->product_id == $productDetails->id)
                                            @continue
                                        @else
                                            <div class="carousel-item " id="carousel-item-1" data-bs-interval="2000">
                                                <div class="col-md-3 ">
                                                    <img
                                                        src="/product_img/imgreview/{{$allimgreview->product_imgreview}}"
                                                        class="img-fluid product-thumbnail px-1"
                                                    >
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- End image review section -->
						</div>
                    </div>
                    <!-- End image section -->

                    <!-- Start product detail section -->
                    <div class="col-md-5">
                        <div class="row mb-2 ms-4">
                            <div class="col-md-12">
                                <h4 class="mb-2 text-black fw-bold">{{$productDetails->product_name}}</h4>
                                <p class="text-black py-1 my-0">
                                    @foreach ($productGroups as $group)
                                        {{$group->rela_product_group->group_name}}
                                        {{($loop->last)? '':'&'}}
                                    @endforeach
                                </p>
                                <!--------------------- Price ------------------------>
                                <div class="row d-flex align-items-baseline">
                                    @if($productDetails->product_price > $productDetails->product_saleprice)
                                        <div class="col-4 ">
                                            <h5 class="text-danger fw-bold py-2">
                                                $ {{number_format($productDetails->product_saleprice, 2)}}
                                            </h5>
                                        </div>
                                        <div class="col-4">
                                            <p class="fw-bold">
                                                <del>$ {{number_format($productDetails->product_price, 2)}}</del>
                                            </p>
                                        </div>
                                        @else
                                            <div class="col-4">
                                                <h5 class="text-danger fw-bold py-2">
                                                    $ {{number_format($productDetails->product_saleprice, 2)}}
                                                </h5>
                                            </div>
                                    @endif
                                </div>
                                <!---------------------End Price ------------------------>

                                <!---------------------Start Color ------------------------>
                                <hr class="border-dark">
                                <div class="row py-2 pe-2">
                                    <div class="col-md-1">
                                        <a href="{{url('product-detail/'.$productDetails->product_code)}}">
                                            <span
                                                class="product-color "
                                                style="background-color:{{$productDetails->product_color}};
                                                    border: 1px solid #000;
                                                    box-shadow: 3px 3px 5px gray"
                                                >
                                            </span>
                                        </a>
                                    </div>

                                    @foreach ($productCode as $row)
                                        @if($row->product_code == $productDetails->product_code)
                                            @continue
                                            @else
                                                <div class="col-md-1">
                                                    <a
                                                        href="{{url('product-detail/'.$row->product_code)}}"
                                                        style="color:{{$row->product_color}}"
                                                        >
                                                        <span
                                                            class="product-color"
                                                            style="background-color:{{$row->product_color}};">
                                                        </span>
                                                    </a>
                                                </div>
                                        @endif
                                    @endforeach
                                </div>
                                <!--------------------End Color ------------------------>

                                <!-------------------- Size and Quantity------------------------>
                                <hr class="border-dark">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="mb-2 text-black fw-semibold py-2">Size</h6>
                                        <!--
                                        <select
                                            class="form-select form-control  bg-transparent rounded-0"
                                            aria-label="Default select example"
                                            name="size_id"
                                            required
                                            >
                                            <option selected disabled value="">choose size</option>
                                            @foreach ($productSizes as $size)
                                                @php
                                                    $quantity = Products_Sizes::where('product_id',  $productDetails->id)
                                                        ->where('size_id', $size->size_id)->first();
                                                @endphp
                                                <option class="{{($quantity->size_quantity == 0)? 'text-danger' : ''}}"
                                                    value="{{$size->size_id}}"
                                                    {{($quantity->size_quantity == 0)? 'disabled':''}}
                                                    >
                                                    {{$size->rela_product_size->size_number}}
                                                    {{($quantity->size_quantity == 0)? '(Out of stock)': ''}}
                                                </option>
                                            @endforeach
                                        </select>
                                         -->
                                        @foreach ($productSizes as $size)
                                            <div class="btn-group rounded-0 " role="group" aria-label="Basic radio toggle button group">

                                                @php
                                                    $quantity = Products_Sizes::where('product_id',  $productDetails->id)
                                                        ->where('size_id', $size->size_id)->first();
                                                @endphp
                                                <input
                                                    type="radio"
                                                    class="btn-check"
                                                    name="size_id"
                                                    id="{{$size->size_id}}"
                                                    value="{{$size->size_id}}"
                                                    autocomplete="off"
                                                    required
                                                >
                                                <label
                                                    class="btn btn-outline-dark rounded-0 mb-1 fw-semibold btn-sm"
                                                    style="width: 60px; {{($quantity->size_quantity == 0)? 'font-size:8px':''}}"
                                                    for="{{$size->size_id}}"
                                                    >
                                                    {{$size->rela_product_size->size_number}}
                                                    <br>
                                                    <p style="font-size: 6px" class="text-danger mb-0 fw-bolder">
                                                    {{($quantity->size_quantity == 0)? 'Out-of-Stock':''}}
                                                    </p>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-4">
                                        <h6 class="mb-2 text-black fw-semibold py-2">Quantity</h6>
                                        <div class="input-group mb-2">
                                            <button
                                                class="btn btn-outline-dark btn-sm border-1 rounded-0"
                                                type="button" id="minus-btn"
                                                ><i class="bi bi-dash-lg"></i>
                                            </button>
                                            <input
                                                class="form-control form-control-sm bg-transparent
                                                    rounded-0 text-center border-1 border-dark mx-1 fw-semibold"
                                                type="number"
                                                name="product_quantity"
                                                id="qty_input"
                                                value="1"
                                                max="10" min="1"
                                                required
                                                aria-label="Example text with button addon"
                                                aria-describedby="button-addon"
                                                onchange="(this.value == 0) ? this.value=1:''"
                                            >
                                            <button
                                                class="btn btn-dark border-1 btn-sm rounded-0"
                                                type="button" id="plus-btn"
                                                ><i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--------------------End  Size and Quantity------------------------>

                                <!-------------------- Start add to cart / like / buy now --------------->
                                <div class="row my-4" style="margin-left: 2px">
                                        <div class="col-md-8 border p-1 border-dark">
                                            <div class="d-grid ">
                                                <button
                                                    type="submit"
                                                    name="action"
                                                    value="buynow"
                                                    class="btn btn-dark py-2 fw-semibold rounded-0 btn-buy-now text-center d-flex justify-content-between"

                                                    >
                                                    <span class="material-icons-outlined opacity-0"
                                                        style="vertical-align: middle">east
                                                    </span>
                                                    BUY NOW
                                                    <span class="material-icons-outlined "
                                                        style="vertical-align: middle;">east
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-2 pe-1">
                                            <div class="text-end d-grid">
                                                <button
                                                    type="submit"
                                                    name="action"
                                                    value="addtocart"
                                                    class="btn btn-outline-dark px-2 py-2 rounded-0"
                                                    >
                                                    <span class="material-icons-outlined"
                                                        style="vertical-align: middle">
                                                        add_shopping_cart
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-md-2 ps-1">
                                            <div class="text-start d-grid">
                                                @php
                                                    if(Auth::check() && Auth::user()->role == 1){
                                                        $userId = Auth::user()->id;
                                                        $isLiked = Likes::where('product_id', $productDetails->id)->where('user_id',  $userId)->first();

                                                    }else{
                                                        $userId = 0;
                                                        $isLiked = 0;
                                                    }
                                                @endphp
                                                @if($isLiked)
                                                    <a
                                                        href="{{url('add-like/'.$productDetails->id.'/'.$userId)}}"
                                                        class="btn btn-outline-dark px-2 py-2 rounded-0"
                                                        title="Remove from favouirte"
                                                        >
                                                        <span
                                                            class="material-icons-outlined"
                                                            style="vertical-align: middle"
                                                            >favorite
                                                        </span>
                                                    </a>
                                                @elseif($isLiked == 0)
                                                    <a
                                                        href="{{url('add-like/'.$productDetails->id.'/'.$userId)}}"
                                                        class="btn btn-outline-dark px-2 py-2 ms-0 rounded-0"
                                                        title="Add to favouirte"
                                                        >
                                                        <span class="material-icons-outlined"
                                                            style="vertical-align: middle">
                                                            favorite_border
                                                        </span>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-------------------- End add to cart / like / buy now --------------->

                        <!----------------- Product Information ------------->
                        <div class="row ms-4">
                            <div class="col-md-12">
                                {{-- Product Detail --}}
                                <div class="border p-3 mb-3">
                                    <div class="form-check px-5">
                                            <h6 class="mb-0">
                                                <a
                                                    class="d-block"
                                                    data-bs-toggle="collapse"
                                                    href="#collapsebank1"
                                                    role="button"
                                                    aria-expanded="false"
                                                    aria-controls="collapsebank"
                                                    >
                                                    View Product Details
                                                </a>
                                            </h6>
                                    </div>
                                    <div class="collapse" id="collapsebank1">
                                        <div class="px-5">
                                            <p>{!! $productDetails->product_des !!}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Product Detail --}}

                                {{-- Size chart --}}
                                <div class="border p-3 mb-3">
                                    <div class="form-check px-5">
                                            <h6 class="mb-0">
                                                <a
                                                    class="d-block"
                                                    data-bs-toggle="collapse"
                                                    href="#collapsebank2"
                                                    role="button"
                                                    aria-expanded="false"
                                                    aria-controls="collapsebank"
                                                    >
                                                    Size Chart Introduction
                                                </a>
                                            </h6>
                                    </div>
                                    <div class="collapse" id="collapsebank2">
                                        <div class="px-5 py-2">
                                            <img src="/frontend/images/Size-chart.jpg" class="img-fluid product-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                {{-- End Size chart --}}
                                
                                {{-- Free Delivery and Returns --}}
                                <div class="border p-3 mb-3">
                                    <div class="form-check px-5">
                                            <h6 class="mb-0">
                                                <a class="d-block" data-bs-toggle="collapse" href="#collapsebank3" role="button" aria-expanded="false" aria-controls="collapsebank">
                                                    Free Delivery and Returns
                                                </a>
                                            </h6>
                                    </div>
                                    <div class="collapse" id="collapsebank3">
                                        <div class="px-5">
                                            <ul>
                                                <li>Exchange only 1 time, please consider carefully before deciding.</li>
                                                <li>The time limit for exchanging products when buying directly at the store is 07 days from the date of purchase. Product exchange when purchased online is 14 days from the date of receipt.</li>
                                                <li>Exchange products must be accompanied by an invoice. Must have original stamps, boxes and labels.</li>
                                                <li>The exchanged product has no signs of being used, not washed, stained, or deformed.</li>
                                                <li>Shop only prioritizes support for size change. In case the product is out of size and needs to be exchanged, you can exchange it for another product:
                                                    <br>- If the product you want to exchange is equal in value or has a higher value, you will need to compensate the difference at the time of exchange (if any).
                                                    <br>- If you wish to exchange for a product of a lower value, we will not issue a refund.</li>
                                                <li>In case the product - size you want to exchange is out of stock in the system. Please choose another product.</li>
                                                <li>No cash refund under any circumstances. Wish you sympathize.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Free Delivery and Returns --}}

                                {{--  Product Warranty --}}
                                <div class="border p-3 mb-3">
                                    <div class="form-check px-5">
                                            <h6 class="mb-0">
                                                <a class="d-block" data-bs-toggle="collapse" href="#collapsebank4" role="button" aria-expanded="false" aria-controls="collapsebank">
                                                    Product Warranty
                                                </a>
                                            </h6>
                                    </div>
                                    <div class="collapse" id="collapsebank4">
                                        <div class="px-5">
                                            <p class="mb-0">
                                                Each pair of 15Steps shoes before being shipped goes through many stages of testing. 
                                                However, during use, if you notice errors: 
                                                broken sole, open sole, broken sewing thread, ... within 6 months from the date of purchase, 
                                                hope you soon send the product to 15Steps to help us have the opportunity to serve you better. 
                                                Please send the product to any 15Steps store, or send it to 15Steps warranty center right in the center of Ho Chi Minh City during office hours: 
                                                Address: 170-172, Dinh Bo Linh, Ward 26, Dist. Binh Thanh, HCMC Hotline: 028 2211 0067.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Product Warranty --}}
                            </div>
                        </div>
                        <!----------------- End Product Information ------------->
                    </div>
                    <!-- End second colume section -->
                </div>
            </form>
		    <!--------------End </form> ---------------------->
		</div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" ></script>
    <script>
            // Image slider for image review
            let items = document.querySelectorAll('#carousel-item-1')
            items.forEach((el) => {
                const minPerSlide = 4
                let next = el.nextElementSibling
                for (var i = 1; i < minPerSlide; i++) {
                    if (!next) {
                        // wrap carousel by using first child
                        next = items[0]
                    }
                    let cloneChild = next.cloneNode(true)
                    el.appendChild(cloneChild.children[0])
                    next = next.nextElementSibling
                }
            })

            // Product Quantity click increase and decrease
        	$(document).ready(function(){
                //$('#qty_input').prop('disabled', true);
                $('#minus-btn').prop('disabled', true);
                $('#plus-btn').click(function(){
                    $('#qty_input').val(parseInt($('#qty_input').val()) + 1 );
                    if ($('#qty_input').val() > 9) {
                        $('#qty_input').val(10);
                    }
                    if ($('#qty_input').val() > 1) {
                        $('#minus-btn').prop('disabled', false);
                    }
                    if($('#qty_input').val() == 10){
                        $('#plus-btn').prop('disabled', true);
                    }
                });
                $('#minus-btn').click(function(){
                    $('#qty_input').val(parseInt($('#qty_input').val()) - 1 );
                    if ($('#qty_input').val() == 0) {
                        $('#qty_input').val(1);
                    }
                    if ($('#qty_input').val() == 1) {
                        $('#minus-btn').prop('disabled', true);
                    }
                    if($('#qty_input').val() < 10){
                        $('#plus-btn').prop('disabled', false);
                    }
                });
            });
    </script>
@endsection()