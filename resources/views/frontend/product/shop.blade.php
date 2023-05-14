<?php
	use App\Models\Products_Sizes;
?>
@extends('index')
@section('content')
    <!-- Start Hero Section -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
		  <li class="breadcrumb-item "><a href="{{url("home")}}" class="text-light">Home</a></li>
		  <li class="breadcrumb-item text-light" aria-current="page">Shop</li>
		</ol>
	</nav>
		<div class="untree_co-section product-section">
		    <div class="container">
		      	<div class="row">
					@foreach ($allProducts as $product)
						<!-- Start Column 1 -->
						<div class="col-12 col-md-4 col-lg-3 mb-4">
							<a
								class="product-item"
								href="{{url('product-detail/'.$product->product_code)}}"
								>
								<div class="img-container">
									<img
										src="/product_img/imgcover/{{$product->product_imgcover}}"
										class="img-fluid product-thumbnail"
									>
									@if($product->product_status == 1)
										<h6 class="text-new bg-danger">New Arrival</h6>
										@elseif($product->product_price > $product->product_saleprice)
											<h6 class="text-new bg-black">Sale Off</h6>
									@endif
								</div>
								<h3 class="product-title">{{$product->product_name}}</h3>
								<strong class="product-price">
									$ {{number_format($product->product_saleprice, 2)}}
								</strong>
								<span class="icon-cross">
									<img src="frontend/images/cross.svg" class="img-fluid">
								</span>
							</a>
						</div>
						<!-- End Column 1 -->
					@endforeach
		      	</div>
				<div class="row">
					<div class="d-flex justify-content-end">
						<!--- To show data by pagination --->
						{{$allProducts->links()}}
                	</div>
				</div>
		    </div>
		</div>
@endsection()