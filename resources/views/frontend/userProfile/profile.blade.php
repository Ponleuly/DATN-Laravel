@extends('index')
@section('content')
    <nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
		  	<li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>
		  	<li class="breadcrumb-item text-light">Profile</li>
		</ol>
	</nav>

	<div class="untree_co-section before-footer-section">

        <div class="container">
            <div class="row">
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

                <div class="col-md-12 border p-5 p-lg-5 bg-white">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-detail d-flex align-items-center justify-content-center">
                                <img src="/frontend/images/delivery.jpg" class="img-fluid mb-3">
                            </div>
                            <h5 class="username text-center py-2 mb-4 ">{{Auth::user()->name}}</h5>
                            <div class="list-group list-group-flush">
                                <a
                                    href="{{url('profile')}}"
                                    class="list-group-item list-group-item-action
                                            {{Request::is('profile')? 'active':''}}
                                        "
                                    aria-current="true"
                                    >
                                    General Profile
                                </a>
                                <a href="{{url('purchase-history')}}"
                                    class="list-group-item list-group-item-action
                                            {{Request::is('purchase*')? 'active':''}}
                                        "
                                    >
                                    Purchase History
                                </a>
                                <a
                                    href="{{url('change-password')}}"
                                    class="list-group-item list-group-item-action
                                            {{Request::is('change-password')? 'active':''}}
                                        "
                                    >
                                    Change Password
                                </a>
                                <a href="{{url('logout')}}" class="list-group-item list-group-item-action">
                                    Log Out
                                </a>
                            </div>
                        </div>

                        <div class="col-md-8 ps-4">
                            @yield('profile_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()