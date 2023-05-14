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
            <!--------------- Alert ------------------------>
            @if(Session::has('alert'))
                <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                    {{Session::get('alert')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                        {{Session::get('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            @endif
            <!---------------End Alert ------------------------>
            <hr class="line-color">
            @if($likes_count > 0)
                @foreach ($likes as $like)
                    @php
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
                        <div class="row my-5">
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
                                            <h6 class="text-sold-out-sm bg-secondary">Sold Out</h6>
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
                                        <h6 class="text-black fw-bold">Size</h6>

                                        <select
                                            class="form-select form-control rounded-0"
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
                                        <h6 class="text-black fw-bold">Quantity</h6>
                                        <div class="form-outline">
                                            <input
                                                type="number"
                                                name="product_quantity"
                                                class="form-control rounded-0"
                                                value="1" max="5" min="1"
                                                placeholder=""
                                                aria-label="Example text with button addon"
                                                aria-describedby="button-addon1"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end flex-column justify-content-end">
                                <div class="col-sm-2 d-grid py-3">
                                    <button
                                        type="submit"
                                        name="action"
                                        value="addtocart"
                                        class="btn btn-block py-1 fw-semibold rounded-0 cart-add">
                                        <span class="material-icons-outlined py-1">shopping_cart</span>
                                    </button>
                                </div>
                                <div class="col-sm-2 d-grid">
                                    <a
                                        href="{{url('remove-like/'.$like->id)}}"
                                        class="btn btn-block py-1 fw-semibold rounded-0">
                                        <span class="material-icons-outlined py-1">delete</span>
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
            <div class="row my-5">
                <div class="col-md-12 d-flex justify-content-between">
                    <a href="{{url('remove-all-like')}}" class="btn btn-block py-1 px-5 fw-semibold rounded-0 me-1">
                        <span>Remove All</span>
                    </a>
                    <a href="{{url('shop')}}" class="btn btn-block py-1 px-5 fw-semibold rounded-0 ms-1">
                        <span>Continue Shopping</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection()