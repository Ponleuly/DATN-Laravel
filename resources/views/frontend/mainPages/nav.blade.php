<?php
	use App\Models\Groups;
	use App\Models\Carts;
	use App\Models\Categories_Groups;
	use App\Models\Categories_Subcategories;
	use App\Models\Settings;
?>
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
	<div class="container">
		@php
			$setting = Settings::all()->first();
		@endphp
		<!---========== Start Logo shop ==============-->
		<a class="navbar-brand" href="{{url('home')}}">
			{{$setting->website_name}}<span>.</span>
		</a>
		<button class="navbar-toggler"
			type="button"
			data-bs-toggle="collapse"
			data-bs-target="#navbarsFurni"
			aria-controls="navbarsFurni"
			aria-expanded="false"
			aria-label="Toggle navigation"
			>
			<span class="navbar-toggler-icon"></span>
		</button>
		<!---========== End Logo shop ==============-->

		<div class="collapse navbar-collapse" id="navbarsFurni">
			<!-----========= Start Menu ===============--->
			<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0 me-4">
				<!--==================Start Shop  Menu======================-->
					<li class="nav-item {{Request::is('shop')? 'active':''}}">
						<div class="dropdown position-static">
							<a
								class="nav-link hover-bar {{Request::is('shop')? 'active':''}}"
								href="{{url('/shop')}}"

								>
								<h5><strong>Shop</strong></h5>
							</a>
						</div>
                    </li>
						<!--==================End Shop  Menu======================-->
					<li class="nav-item ms-0 me-0">
                        <h6 class="nav-link text-black-50">|</h6>
					</li>
					@php
						$groups = Groups::orderBy('id')->get();
					@endphp
					@foreach ($groups as $group)
						<!--==================Start Product Group Menu======================-->
						<li class="nav-item {{Request::is('product-'.strtolower($group->group_name))? 'active':''}}">
							<div class="dropdown position-static">
								<a
									class="nav-link hover-bar {{Request::is('product-'.strtolower($group->group_name))? 'active':''}}"
									role="button"
									aria-expanded="false"
									href="{{url('product-' .strtolower($group->group_name))}}"
									>
									<h5><strong>{{$group->group_name}}</strong></h5>
								</a>
								<div class="dropdown-menu dropdown-nav w-100">
									<div class="container">
										<div class="row w-100">
											@php
												$categories = Categories_Groups::where('group_id', $group->id)->get();
												$category_count = $categories->count();
											@endphp
											<!--====================== New and Featured Menu ===============================-->
											<div class="col-md-{{($category_count >= 3)? 3:4}}">
												<a href="{{url('product-category/new-featured')}}">
													<h5 class="text-center text-black py-4">
														<strong>New & Featured</strong>
													</h5>
												</a>
												<div class="list-group list-group-light text-center">
													<a
														href="{{url('product-subcategory/new-arrival')}}"
														class="list-group-item px-0 py-1 border-0"
														>
														<h6>New Arrival</h6>
													</a>
													<a
														href="{{url('product-subcategory/sale-off')}}"
														class="list-group-item px-0 py-1 border-0"
														>
														<h6>Sale Off</h6>
													</a>
												</div>
											</div>
											<!--====================== New and Featured Menu ===============================-->
											<!--====================== Category Menu ===============================-->
											@foreach ($categories as $category)
												<div class="col-md-{{($category_count >= 3)? 3:4}}">
													<a href="{{url('product-group-category/'.strtolower($group->group_name).'/'.strtolower($category->rela_category->category_name))}}">
														<h5 class="text-center text-black py-4">
															<strong>{{$category->rela_category->category_name}}</strong>
														</h5>
													</a>
													@php
														$subCategories = Categories_Subcategories::where('category_id', $category->category_id)->get();
													@endphp
													<div class="list-group list-group-light text-center">
														<!--================ Sub Category Menu ==================-->
														@foreach ($subCategories as $subCategory)
															<a
																href="{{url('product-subcategory/'
																.strtolower($group->group_name).'/'
																.strtolower($category->rela_category->category_name).'/'
																.strtolower($subCategory->sub_category)
																)}}"
																class="list-group-item px-0 py-1 border-0"
																>
																<h6>{{$subCategory->sub_category}}</h6>
															</a>
														@endforeach
														<!--================ End Sub Category Menu ==================-->
													</div>
												</div>
											@endforeach
											<!--====================== End Category Menu ===============================-->
										</div>
									</div>
								</div>
							</div>
                        </li>
						<li class="nav-item ms-0 me-0">
                            <h6 class="nav-link text-black-50">{{($loop->last)? '':'|'}}</h6>
						</li>
					@endforeach
				<!--==================End Product Group Menu======================-->
			</ul>
			<!-----========= End Menu ===============--->

			<!-----========= Start Menu icon ===============--->
			<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-4 me-4">
				<li class="nav-item me-0">
					<a class="nav-link text-dark" href="{{url('like')}}">
						<span
							class="material-icons-outlined
							{{Request::is('like')? 'active':''}}"
							>
							favorite
						</span>
					</a>
				</li>
				<li class="nav-item">
                	<a class="nav-link text-dark pe-0" href="{{url('cart')}}">
						<span
							class="material-icons-outlined pe-0
							{{Request::is('cart')? 'active':''}}"
							>
							shopping_cart
						</span>
					</a>
                </li>
				<li class="nav-item">
					<span class="fs-6 nav-link text-dark mt-1 ps-0 {{Request::is('cart')? 'active':''}}">
						@php
							if (Auth::check() && Auth::user()->role == 1){
								$cart_count = Carts::where('user_id', Auth::user()->id)->count();
							}else{
								$cart_count = Cart::content()->count();
							}
						@endphp
						({{$cart_count}})
					</span>
				</li>
				@if(Auth::check() && (Auth::user()->role == 1))
				<li class="nav-item">
					<div class="dropdown position-static">
						<a
							class="nav-link"
							href="{{url('profile')}}"
							role="button"
							id="dropdownMenuLink"
							aria-expanded="false"
							>
							@if(Auth::user()->profile_img == '')
							<span class="material-icons-round text-secondary pt-0 {{Request::is('profile')? 'active':''}}"
								style="font-size: 30px;">
								account_circle
							</span>
							@else
							<div class="profile">
								<img src="/profile_img/{{Auth::user()->profile_img}}" class="img-fluid user-pf">
							</div>
							@endif
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<li><a class="dropdown-item " href="{{url('profile')}}">Profile</a></li>
							<li><a class="dropdown-item " href="{{url('logout')}}">Log out</a></li>
						</ul>
					</div>
				</li>
				@else
				<li class="nav-item">
					<div class="dropdown position-static">
						<a
							class="nav-link text-dark"
							href="{{url('profile')}}"
							role="button"
							id="dropdownMenuLink"
							aria-expanded="false"
							>
							<span
								class="material-icons-round
								{{Request::is('profile')? 'active':''}}"
								>
								person
							</span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<li><a class="dropdown-item " href="{{url('register')}}">Register</a></li>
							<li><a class="dropdown-item " href="{{url('login')}}">Log in</a></li>
						</ul>
					</div>
				</li>
				@endif
			</ul>
			<!-----========= Start Menu icon ===============--->
			<form class="d-flex col-lg-3 ms-5" action="{{url('search-product')}}">
				<div class="input-group">
					<input
						type="text"
						name="search_product"
						class="form-control form-control-sm rounded-1 rounded-end-0"
						placeholder="Search here..."
						aria-label="Recipient's username"
						aria-describedby="button-addon2"
					>
					<button
						class="btn btn-outline-danger btn-sm rounded-1 rounded-start-0"
						type="submit"
						id="button-addon2"
						><i class="bi bi-search"></i>
					</button>
				</div>
			</form>

		</div>
	</div>
</nav>
