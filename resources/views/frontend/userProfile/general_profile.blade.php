@extends('frontend.userProfile.profile')
@section('profile_content')
<h5 class="text-black py-2">General Profile</h5>
<form
    action="{{url('profile-update/'. Auth::user()->id)}}"
    method="POST"
    enctype="multipart/form-data"
    class="form-floating"
    >
    @csrf <!-- to make form active -->
    @method('PUT')
    <div class="row py-2">
        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0"
                    id="floatingInputValue"
                    name="name"
                    placeholder="name@example.com"
                    value="{{Auth::user()->name}}">
                <label for="floatingInputValue">Full Name</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0"
                    id="floatingInputValue"
                    name="phone"
                    placeholder="xxx xx xx xxx"
                    value="{{Auth::user()->phone}}">
                <label for="floatingInputValue">Phone Number</label>
            </div>
        </div>
    </div>

    <div class="row py-2">
        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="email"
                    class="form-control rounded-0"
                    id="floatingInputValue"
                    name="email"
                    placeholder="name@example.com"
                    value="{{Auth::user()->email}}">
                <label for="floatingInputValue">Email</label>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0"
                    id="floatingInputValue"
                    name="address"
                    placeholder="name@example.com"
                    value="{{Auth::user()->address}}"
                    >
                <label for="floatingInputValue">Address</label>
            </div>
        </div>
    </div>

    <div class="row py-2">
        <div class="col-md-4">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0"
                    id="ward"
                    name="ward"
                    placeholder="name@example.com"
                    value="{{Auth::user()->ward}}"
                >
                <label for="ward">Ward</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0"
                    id="district"
                    name="district"
                    placeholder="name@example.com"
                    value="{{Auth::user()->district}}"
                >
                <label for="district">District</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input
                    type="text"
                    class="form-control rounded-0"
                    id="city"
                    name="city"
                    placeholder="name@example.com"
                    value="{{Auth::user()->city}}"
                >
                <label for="city">City</label>
            </div>
        </div>
    </div>
    <div class="text-end my-2 text-sm">
        <button class="btn btn-primary btn-sm rounded-1" type="submit">Update Profile</button>
    </div>
</form>
@endsection