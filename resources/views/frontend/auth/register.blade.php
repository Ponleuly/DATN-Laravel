@extends('index')
@section('content')
    <!-- Start breabcrumb Section -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
           <li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>
		    <li class="breadcrumb-item text-light active" aria-current="page">
                Register
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
    <!---------------End Alert ------------------------>
<div class="container">
    <div class="row justify-content-center p-5">
        <div class="col-md-5 px-0 rounded-start-4 border border-end-0">
            <div class="img-container">
                <img
                    src="/frontend/images/shoes1.jpg"
                    class="img-fluid product-thumbnail rounded-start-4"
                >
                <h4 class="text-store py-2 ps-4 pe-3 rounded-end-5 fw-semibold
                    bg-danger text-white"
                    >15Steps Store
                </h4>
            </div>
        </div>
        <div class="col-md-6 px-4  rounded-end-4 border border-start-0">
            <div class="card border-0 bg-transparent rounded-end-4">
                <div class="row ">
                    <div class="col-md-8 offset-md-3">
                        <h5 class="text-center text-dark py-4 mb-0 fw-semibold text-decoration-underline">Register</h5>
                    </div>
                </div>
                <!--<div class="card-header bg-dark text-white fw-semibold">{{ $title ?? "" }} {{ __('Register') }}</div>-->
                <div class="card-body">
                        <form method="POST" action="{{ url('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-8">
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control form-control-sm rounded-0 border-dark
                                    @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}"
                                    required autocomplete="name" autofocus
                                >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-3 col-form-label text-md-end">{{ __('Phone Number') }}</label>
                            <div class="col-md-8">
                                <input
                                    id="phone"
                                    type="text"
                                    class="form-control form-control-sm rounded-0 border-dark
                                    @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}"
                                    required autocomplete="phone"
                                >
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="col-md-8">
                                <input
                                    id="email" type="email"
                                    class="form-control form-control-sm rounded-0 border-dark
                                    @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}"
                                    required autocomplete="email"
                                >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="address" class="col-md-3 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-8">
                                        <input
                                            id="address"
                                            type="text"
                                            class="form-control form-control-sm rounded-0 border-dark
                                            @error('address') is-invalid @enderror"
                                            name="address" value="{{ old('address') }}"
                                            placeholder="street address"
                                            required autocomplete="address" autofocus
                                        >
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <input
                                            id="city"
                                            type="text"
                                            class="form-control form-control-sm rounded-0 border-dark
                                            @error('city') is-invalid @enderror"
                                            name="city" value="{{ old('city') }}"
                                            placeholder="city"
                                            required autocomplete="city" autofocus
                                        >
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <input
                                            id="district"
                                            type="text"
                                            class="form-control form-control-sm rounded-0 border-dark
                                            @error('district') is-invalid @enderror"
                                            name="district" value="{{ old('district') }}"
                                            placeholder="district"
                                            required autocomplete="district" autofocus
                                        >
                                        @error('district')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <input
                                            id="ward"
                                            type="text"
                                            class="form-control form-control-sm rounded-0 border-dark
                                            @error('ward') is-invalid @enderror"
                                            name="ward" value="{{ old('ward') }}"
                                            placeholder="ward"
                                            required autocomplete="ward" autofocus
                                        >
                                        @error('ward')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                @error('address')
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
                                    class="form-control form-control-sm rounded-0 border-dark @error('password') is-invalid @enderror"
                                    name="password"
                                    required autocomplete="new-password"
                                >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-end">{{ __('Confirm') }}</label>

                            <div class="col-md-8">
                                <input
                                    id="password-confirm"
                                    name="password_confirmation"
                                    type="password"
                                    class="form-control form-control-sm rounded-0 border-dark
                                    @error('password') is-invalid @enderror"
                                    required autocomplete="new-password"
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
                                <div class="row ">
                                    <div class="col-md-7 text-start">
                                        <label class="form-check-label ms-auto">
                                            <a href="{{url('login')}}">Have account ?</a>
                                        </label>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="d-grid border p-1 border-dark">
                                            <button
                                                type="submit"
                                                class="btn btn-dark shadow btn-sm rounded-0
                                                box-shadow-outline text-center d-flex justify-content-between">

                                                <span class="fw-semibold">{{ __('Register') }}</span>
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
