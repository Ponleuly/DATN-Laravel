<?php
	use App\Models\Categories_Subcategories;
	use App\Models\Categories;
	use App\Models\Settings;
	use App\Models\Contacts;
?>
<footer class="footer-section bg-light">
	<div class="container relative">
		<div class="row">
			<div class="col-lg-8">
				@if(!(Auth::check() && (Auth::user()->role == 1)))
					<div class="subscription-form">
						<h3 class="d-flex align-items-center text-dark">
							<span>SUBSCRIBE TO GET MAIL</span>
						</h3>
						<form action="{{url('/subscriber')}}" method="POST" enctype="multipart/form-data" class="row g-3">
							@csrf

							<div class="col-auto">
								<input
									type="text"
									name="s_name"
									class="form-control form-control-sm  rounded-0"
									placeholder="Enter your name"
									required
								>
							</div>
							<div class="col-auto">
								<input
									type="email"
									name="s_email"
									class="form-control form-control-sm rounded-0"
									placeholder="Enter your email"
									required
								>
							</div>
							<div class="col-auto">
								<button
									type="submit"
									class="btn btn-dark btn-sm shadow rounded-1 border-1"
									>
									<span class="text-light">Send</span>
								</button>
							</div>
						</form>
					</div>
				@endif
			</div>
		</div>
		<div class="row g-5 mb-5">
			@php
				$setting = Settings::all()->first();
			@endphp
			<div class="col-lg-4">
				<div class="mb-2 footer-logo-wrap">
					<a href="{{url("home")}}" class="footer-logo fw-bold">
						{{$setting->website_name}}<span class=" opacity-50">.</span>
					</a>
				</div>
				<p class="text-danger fw-bold text-capitalize">
					{{$setting->home_pageSlogan}}
				</p>
				<p class="mb-4">
					{{$setting->home_pageText}}
				</p>

				<ul class="list-unstyled custom-social">
					<li>
						<a href="{{$setting->facebook_link}}">
							<span class="fa fa-brands fa-facebook-f"></span>
						</a>
					</li>
					<li>
						<a href="{{$setting->instagram_link}}">
							<span class="fa fa-brands fa-instagram"></span>
						</a>
					</li>
					<li>
						<a href="{{$setting->youtube_link}}">
							<span class="fa fa-brands fa-youtube"></span>
						</a>
					</li>
					<li>
						<a href="{{$setting->tiktok_link}}">
							<span class="fa fa-brands fa-tiktok"></span>
						</a>
					</li>
				</ul>
			</div>

			<div class="col-lg-8">
				<div class="row links-wrap">
					<div class="col-6 col-sm-6 col-md-3">
						<ul class="list-unstyled">
							<li>
								<a
									href="{{url('product-category/new-featured')}}"
									class="text-danger fw-bold"
									>
									New & Featured
								</a>
							</li>
							<li>
								<a href="{{url("product-subcategory/new-arrival")}}">
									New Arrival
								</a>
							</li>
							<li>
								<a href="{{url("product-subcategory/sale-off")}}">
									Sale Off
								</a>
							</li>
						</ul>
					</div>
						@php
							$categories = Categories::orderBy('id')->get();
						@endphp
					@foreach ($categories as $category)
						<div class="col-6 col-sm-6 col-md-3">
							<ul class="list-unstyled">
								<li>
									<a href="{{url('product-category/'.strtolower($category->category_name))}}"
										class="text-danger fw-bold"
										>
										{{$category->category_name}}
									</a>
								</li>
									@php
										$subs = Categories_Subcategories::where('category_id', $category->id)->get();
									@endphp
								@foreach ($subs as $sub)
									<li>
										<a href="{{url("product-subcategory/". strtolower($sub->sub_category))}}">
											{{$sub->sub_category}}
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					@endforeach
					<div class="col-6 col-sm-6 col-md-3">
						@php
							$contacts = Contacts::orderBy('id')->get();
						@endphp
						<ul class="list-unstyled">
							<li class="text-danger fw-bold">Contact</li>
							@foreach ($contacts as $contact)
								<li>{{$contact->contact_info}}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="border-top copyright">
			<div class="row pt-4">
				<div class="col-lg-6">
					<p class="mb-2 text-center text-lg-start">
						Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    </p>
				</div>
			</div>
		</div>
	</div>
</footer>