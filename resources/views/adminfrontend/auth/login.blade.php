
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center p-5">
        <div class="col-md-6 ">
            @if(Session::has('alert'))
            <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                {{Session::get('alert')}}
                <button group="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
		    @endif
            <div class="card rounded-4">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-white fw-semibold py-4">
                            <span class="bg-danger py-1 px-4"
                                style="margin-left: -0.5px; border-radius: 0 20px 20px 0;
                                ">Login
                            </span>
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-center text-dark py-4 mb-0 fw-semibold"
                            >Admin {{$setting->website_name}} Store
                        </h3>
                    </div>
                </div>

                <div class="card-body">
                        <form method="POST" action="{{ url('admin/login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-8">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control border-dark rounded-0 bg-transparent
                                    @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
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
                                    class="form-control border-dark rounded-0 bg-transparent
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
                        <div class="row mb-3">
                            <div class="col-md-7 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 offset-md-8">
                                @if (Route::has('password.request'))
                                    <a class="mx-2" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                    <!--
                                    <button type="submit" class="btn btn-dark btn-sm">
                                        {{ __('Login') }}
                                    </button>
                                    -->
                                <div class="d-grid border p-1 border-dark">
                                    <button
                                        type="submit"
                                        class="btn btn-dark shadow  rounded-0
                                        box-shadow-outline text-center d-flex justify-content-between">

                                        <span class="fw-bolder">{{ __('Login') }}</span>
                                        <span class="material-icons-outlined"
                                            style="vertical-align: middle; font-size: 20px">east
                                        </span>
                                    </button>
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
