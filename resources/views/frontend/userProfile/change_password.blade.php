@extends('frontend.userProfile.profile')
@section('profile_content')
        <h5 class="text-black py-2">Change Password</h5>
        <div class="row my-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input
                        type="password"
                        id="current_password"
                        name="current_password"
                        class="form-control rounded-0
                        @error('current_password') is-invalid @enderror"
                        required
                        autocomplete="new-password"
                    >
                    <label for="floatingInputValue">Current Password</label>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

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
                    <label for="floatingInputValue">New Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input
                        id="password_confirmation"
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
        <div class="row">
            <div class="text-end text-sm">
                <button
                    class="btn btn-danger shadow btn-sm rounded-1"
                    type="submit"
                    name="form_type"
                    value="update_password">Update Password
                </button>
            </div>
        </div>
@endsection