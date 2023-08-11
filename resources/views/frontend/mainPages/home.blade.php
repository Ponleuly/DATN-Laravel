<?php
	use App\Models\Categories_Subcategories;
	use App\Models\Settings;
	use App\Models\News;
	use App\Models\Coupons;
?>
@extends('index')
@section('content')
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

		<!----- Check if there is any active coupon to show ----->
		@if(count($coupons) != 0)
			<!-- Start Coupon Slider -->
			<div class="coupon-section bg-light">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-12">
							<div class="coupon-slider-wrap text-center">
								<div id="coupon-nav">
									<span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
									<span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
								</div>
								<div class="coupon-slider">
									@foreach ($coupons as $coupon)
										<div class="item">
											<div class="row justify-content-center">
												<div class="col-lg-8 mx-auto">
													<div class="coupon-block text-center">
														<div class="author-info">
															<h6 class="fw-normal text-dark text-uppercase fst-italic mb-0">
																{{($coupon->campaign_name)}}
																<p class="text-capitalize text-danger mb-0" style="font-size:12px">
																	from {{date('M d, Y', strtotime($coupon->start_date))}}
																	- {{date('M d, Y', strtotime($coupon->end_date));}}
																</p>
															</h6>
														</div>
													</div>
												</div>
											</div>
										</div>
									@endforeach
									<!-- END item -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Coupon Slider -->
		@endif
		<!-- Start Hero Section -->

		{{-- ======== Home image ========--}}
		<div class="hero">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5">
						<div class="intro-excerpt text-capitalize">
							<h1>{{$setting->home_pageSlogan}}</span></h1>
							<p class="mb-4">{{$setting->home_pageText}}</p>
							<p>
								<a
									href="{{url('shop')}}"
									class="btn btn-warning me-2 rounded-pill px-4 py-2 fw-semibold"
									>
									Shop Now
								</a>
							</p>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="hero-img-wrap">
							<img
                                src="/product_img/imghomepage/{{$setting->home_pageImage}}"
                                class="img-fluid"
                            >
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- ======== End Home image ========--}}


		<!-- Start Categpries Section -->
		<div class="blog-section">
			<div class="container">
				<div class="row mb-2">
					<div class="col-md-6 mx-auto text-center">
						<h2 class="section-title">PRODUCT CATEGORIES</h2>
					</div>
				</div>

				<div class="row">
						<div class="col-12 col-sm-6 col-md-4 mb-2 mb-md-0">
							<div class="post-entry">
								<a href="{{url('product-category/new-featured')}}"
									class="post-thumbnail">
									<img
										src="/product_img/imgcategory/new_feature.jpg"
										alt="Image" class="img-fluid category-img "
									>
								</a>
								<div class="post-content-entry">
									<h3>
										<a href="{{url('product-category/new-featured')}}">
											New & Featured
										</a>
									</h3>
									<div class="meta">
										<span>
											<a href="{{url("product-subcategory/new-arrival")}}">
												New Arrival
											</a>
										</span>
										<label class="text-black-50 h6">|</label>
										<span>
											<a href="{{url("product-subcategory/sale-off")}}">
												Sale Off
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					@foreach ($categories as $category)
						<div class="col-12 col-sm-6 col-md-4 mb-2 mb-md-0">
							<div class="post-entry">
								<a href="{{url('product-category/'.strtolower($category->category_name))}}"
									class="post-thumbnail">
									<img
										src="/product_img/imgcategory/{{$category->category_img}}"
										alt="Image" class="img-fluid category-img "
									>
								</a>
								<div class="post-content-entry">
									<h3>
										<a href="{{url('product-category/'.strtolower($category->category_name))}}">
											{{$category->category_name}}
										</a>
									</h3>
									<div class="meta">
										@php
											$subcategories = Categories_Subcategories::where('category_id', $category->id)->get();
										@endphp
										@foreach ($subcategories  as $subcategory)
											<span>
												<a href="{{url("product-subcategory/". strtolower($subcategory->sub_category))}}">
													{{$subcategory->sub_category}}
												</a>
											</span>
											<label class="text-black-50 h6">
												{{($loop->last)? '':'|'}}
											</label>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<!-- End Categpries Section -->

		<!-- Start New Arrival Product Section -->
		@if($newProduct_count > 0)
			<div class="product-section">
				<div class="container">
					<div class="row">
						<!-- Start Column 1 -->
						<div class="col-md-6 mb-4 mx-auto text-center">
							<h2 class="section-title">NEW ARRIVAL</h2>
						</div>
						<!-- End Column 1 -->
					</div>
					<div class="row">
						@foreach ($newProducts as $product)
							<!-- Start Column 2 -->
							<div class="col-12 col-md-4 col-lg-4 mb-5">
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
							<!-- End Column 2 -->
						@endforeach
					</div>
					<div class="row">
						<div class="d-flex justify-content-center">
							<!--- To show data by pagination --->
							{{$newProducts->links()}}
						</div>
					</div>
				</div>
			</div>
		@endif
		<!-- End New Arrival Product Section -->

		{{-- Start News Section --}}
		<div class="testimonial-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 mx-auto text-center">
						<h2 class="section-title">NEWS & INTRODUCING </h2>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-lg-12">
						<div class="testimonial-slider-wrap text-center">
							<div id="testimonial-nav">
								<span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
								<span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
							</div>

							<div class="testimonial-slider">
								@foreach ($news as $new)
									<div class="item">
										<div class="row justify-content-center">
											<div class="col-lg-5 mx-auto">
												<div class="testimonial-block text-center">
													<div class="author-info">
														<div class="author-pic">
															<img
																src="/product_img/imgnews/{{$new->news_img}}"
																alt="Maria Jones"
																class="img-fluid"
															>
														</div>
														<h3>
															<strong class="fw-bold fs-4">{{$new->news_title}}</strong>
														</h3>
													</div>
													<div class="text-truncate text-wrap text-start">
														<p>
															{!! $new->news_content !!}
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
								<!-- END item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End News Section -->
@endsection()