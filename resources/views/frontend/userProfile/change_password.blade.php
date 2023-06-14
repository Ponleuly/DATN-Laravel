@extends('frontend.userProfile.profile')
@section('profile_content')
                            <h5 class="text-black py-2">Change Password</h5>
                            <form
                                action="{{url('change-password/'. Auth::user()->id)}}"
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
                                                id="current_password"
                                                type="password"
                                                class="form-control rounded-0 @error('current_password') is-invalid @enderror"
                                                name="current_password"
                                                required
                                                autocomplete="new-password"
                                            >
                                            @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="floatingInputValue">Current Password</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row py-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input
                                                id="password"
                                                type="password"
                                                class="form-control rounded-0 @error('password') is-invalid @enderror"
                                                name="password"
                                                required
                                                autocomplete="new-password"
                                            >
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="floatingInputValue">New Password</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input
                                                id="password-confirm"
                                                type="password"
                                                class="form-control rounded-0 @error('password') is-invalid @enderror"
                                                name="password_confirmation"
                                                required autocomplete="new-password"
                                            >
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="floatingInputValue">Comfirme New Password</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-grid gap-2 my-2">
                                    <button class="btn btn-primary rounded-0" type="submit">Update Profile</button>
                                </div>
                            </form>
@endsection