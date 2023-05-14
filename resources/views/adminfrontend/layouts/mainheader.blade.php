<!-- ========== header start ========== -->
<header class="header sticky-top">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-6 py-1">
				<div class="header-left d-flex align-items-center">
					<div class="menu-toggle-btn mr-20">
						<button
							id="menu-toggle"
							class="main-btn primary-btn btn-hover rounded-1"
							>
							<i class="lni lni-chevron-left me-2"></i><p class="text-sm">Menu</p>
						</button>
					</div>
					<!--
					<div class="header-search d-none d-md-flex">
						<form action="#">
							<input class="rounded-0" type="text" placeholder="Search..." />
							<button><i class="lni lni-search-alt"></i></button>
						</form>
					</div>
					-->
				</div>
			</div>

			<div class="col-lg-7 col-md-7 col-6 ">
				<div class="header-right">
					<!-- profile start -->
					<div class="profile-box ml-15">
						<button
							class="dropdown-toggle bg-transparent border-0"
							type="button"
							id="profile"
							data-bs-toggle="dropdown"
							aria-expanded="false"
							>
							<div class="profile-info">
								<div class="info">
									<h6>{{Auth::user()->name}}</h6>
								</div>
							</div>
							<i class="lni lni-chevron-down"></i>
						</button>

						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
							<li>
								<a href="{{url('admin/logout')}}"> <i class="lni lni-exit"></i> Log Out </a>
							</li>
						</ul>
					</div>
					<!-- profile end -->
				</div>
			</div>
		</div>
	</div>
</header>
<!-- ========== header end ========== -->