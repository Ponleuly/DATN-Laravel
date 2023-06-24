@extends('frontend.userProfile.profile')
@section('profile_content')
    <h5 class="text-black py-2">General Profile</h5>
    <div class="row py-2">
        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0 @error('name') is-invalid @enderror"
                    id="floatingInputValue"
                    name="name"
                    placeholder="name@example.com"
                    value="{{old('name')? old('name') : Auth::user()->name}}">
                <label for="floatingInputValue">Full Name</label>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0  @error('phone') is-invalid @enderror"
                    id="floatingInputValue"
                    name="phone"
                    placeholder="xxx xx xx xxx"
                    value="{{old('phone')? old('phone') :Auth::user()->phone}}">
                <label for="floatingInputValue">Phone Number</label>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row py-2">
        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="email"
                    class="form-control rounded-0 @error('email') is-invalid @enderror"
                    id="floatingInputValue"
                    name="email"
                    placeholder="example@gmail.com"
                    value="{{old('email')? old('email') : Auth::user()->email}}">
                <label for="floatingInputValue">Email</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0 @error('address') is-invalid @enderror"
                    id="floatingInputValue"
                    name="address"
                    placeholder="23 Ta Quang Buu"
                    value="{{old('address')? old('address') : Auth::user()->address}}"
                    >
                <label for="floatingInputValue">Address</label>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row py-2">
        <div class="col-md-4">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0 @error('ward') is-invalid @enderror"
                    id="ward"
                    name="ward"
                    placeholder="Back Khoa"
                    value="{{old('ward')? old('ward') : Auth::user()->ward}}"
                >
                <label for="ward">Ward</label>
                @error('ward')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0  @error('district') is-invalid @enderror"
                    id="district"
                    name="district"
                    placeholder="Hai Ba Trung"
                    value="{{old('district')? old('district') :Auth::user()->district}}"
                >
                <label for="district">District</label>
                @error('district')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0 @error('city') is-invalid @enderror"
                    id="city"
                    name="city"
                    placeholder="Ha Noi"
                    value="{{old('city')? old('city'):Auth::user()->city}}"
                >
                <label for="city">City</label>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="text-end my-2 text-sm">
        <button
            class="btn btn-danger btn-sm rounded-1"
            type="submit"
            name="form_type"
            value="update_profile"
            >Update Profile
        </button>
    </div>
@endsection