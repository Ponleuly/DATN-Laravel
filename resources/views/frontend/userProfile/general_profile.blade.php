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
                                <div class="row my-3">
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

                                <div class="row py-3">
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
                                                value="{{Auth::user()->address}}">
                                            <label for="floatingInputValue">Address</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-grid gap-2 my-2">
                                    <button class="btn btn-primary rounded-0" type="submit">Update Profile</button>
                                </div>
                            </form>
@endsection