@extends('index')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 p-5">
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
            <div class="card border-danger">
                <div class="card-header">{{ $title ?? "" }} {{ __('Register') }}</div>
                <div class="card-body">
                        <form method="POST" action="{{ url('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phonenumber" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input
                                id="phonenumber"
                                type="text"
                                class="form-control form-control-sm
                                @error('phonenumber') is-invalid
                                @enderror"
                                name="phone" value="{{ old('phone') }}" required autocomplete="phonenumber" autofocus>

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-8">
                                        <input
                                            id="address"
                                            type="text"
                                            class="form-control form-control-sm
                                            @error('address') is-invalid @enderror"
                                            name="address" value="{{ old('address') }}"
                                            placeholder="street address"
                                            required autocomplete="address" autofocus
                                        >
                                    </div>
                                    <div class="col-4">
                                        <input
                                            id="city"
                                            type="text"
                                            class="form-control form-control-sm
                                            @error('city') is-invalid @enderror"
                                            name="city" value="{{ old('city') }}"
                                            placeholder="city"
                                            required autocomplete="city" autofocus
                                        >
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <input
                                            id="district"
                                            type="text"
                                            class="form-control form-control-sm
                                            @error('district') is-invalid @enderror"
                                            name="district" value="{{ old('district') }}"
                                            placeholder="district"
                                            required autocomplete="district" autofocus
                                        >
                                    </div>
                                    <div class="col-6">
                                        <input
                                            id="ward"
                                            type="text"
                                            class="form-control form-control-sm
                                            @error('ward') is-invalid @enderror"
                                            name="ward" value="{{ old('ward') }}"
                                            placeholder="ward"
                                            required autocomplete="ward" autofocus
                                        >
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
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            {{ __('Register') }}
                                        </button>
                                    </div>

                                    <div class="col-md-8 d-flex align-items-center">
                                        <label class="form-check-label ms-auto">
                                            Have an account ? <a href="{{url('login')}}"> Click here.</a>
                                        </label>
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
