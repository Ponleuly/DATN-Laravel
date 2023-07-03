
@extends('index')
@section('content')
    <!-- Start breabcrumb Section -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
           <li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>
		    <li class="breadcrumb-item text-light active" aria-current="page">
                Login
            </li>
		</ol>
	</nav>
    <!-- End breabcrumb Section -->
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
<div class="container">
    <div class="row justify-content-center p-5" >
        <div class="col-md-5 px-0 rounded-start-4 border border-end-0">
            <div class="img-container">
                <img
                    src="/frontend/images/shoes1.jpg"
                    class="img-fluid product-thumbnail rounded-start-4"
                >
                <h4 class="text-store py-2 ps-4 pe-3 rounded-end-5 fw-semibold
                    bg-danger text-white"
                    >{{$setting->website_name}} Store
                </h4>
                <!--
                <h6 class="text-sign-up py-2 px-4 rounded-start-5 fw-semibold
                    {{Request::is('login')? 'bg-danger':'text-dark'}}"
                    >Log in
                </h6>
            -->
			</div>

        </div>
        <div class="col-md-6 px-4 rounded-end-4 border ">
            <!--
            <div class="card border-dark">
                <div class="card-header bg-dark text-white fw-semibold" >{{ $title ?? "" }} {{ __('Login') }}</div>

                <div class="card-body">
                        <form method="POST" action="{{ url('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control form-control-sm
                                    @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus
                                >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    --><!--
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">

                                @if (Route::has('password.request'))
                                    <a class="mx-2" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-dark shadow btn-sm">
                                            {{ __('Login') }}
                                        </button>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center">
                                        <label class="form-check-label ms-auto">
                                            Register an account ? <a href="{{url('register')}}"> Click here.</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            -->
            <div class="card border-0 rounded-end-4 border border-start-0">
                <div class="row">
                    <div class="col-md-8 offset-md-3">
                        <h5 class="text-center text-dark py-4 mb-0 fw-semibold
                            text-decoration-underline"
                            >Log in
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                        <form method="POST" action="{{ url('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">
                                {{ __('Email ') }}
                            </label>

                            <div class="col-md-8">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control rounded-0 border-dark
                                    @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus
                                >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control rounded-0 border-dark
                                    @error('password') is-invalid @enderror"
                                    name="password"
                                    required autocomplete="current-password"
                                >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-3 mt-2">

                                @if (Route::has('password.request'))
                                    <a class="mx-2" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <div class="row">
                                    <div class="col-md-8 text-start ">
                                        <label class="form-check-label ms-auto">
                                            <a href="{{url('register')}}"> Register account ?</a>
                                        </label>
                                    </div>

                                    <div class="col-md-4 ">
                                        <div class="d-grid border p-1 border-dark">
                                            <button
                                                type="submit"
                                                class="btn btn-dark shadow btn-sm rounded-0
                                                box-shadow-outline text-center d-flex justify-content-between">

                                                <span class="fw-semibold">{{ __('Login') }}</span>
                                                <span class="material-icons-outlined"
                                                    style="vertical-align: middle; font-size: 20px">east
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
