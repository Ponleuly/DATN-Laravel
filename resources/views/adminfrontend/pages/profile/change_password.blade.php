@extends('adminfrontend.pages.profile.profile_setting')
@section('profile_content')
    <form
        action="{{url('/admin/change-password/'.$user->id)}}"
        method="POST" enctype="multipart/form-data">
        @csrf <!-- to make form active -->
        @method('PUT')
        <div class="col-md-8 ">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="current_password" class="form-label text-sm">Current password</label>
                        <input
                            id="current_password"
                            type="password"
                            class="form-control form-control-sm rounded-1 @error('current_password') is-invalid @enderror"
                            name="current_password"
                            autocomplete="new-password"
                        >
                        @error('current_password')
                            <span class="invalid-feedback text-sm" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="newpass" class="form-label text-sm">New password</label>
                        <input
                            id="new_password"
                            type="password"
                            class="form-control form-control-sm rounded-1 @error('password') is-invalid @enderror"
                            name="password"
                            autocomplete="new-password"
                        >
                        @error('password')
                            <span class="invalid-feedback text-sm" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label text-sm">Comfirme new password</label>
                        <input
                            id="password-confirm"
                            type="password"
                            class="form-control form-control-sm rounded-1 @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation"
                            autocomplete="new-password"
                        >
                        @error('password_confirmation')
                            <span class="invalid-feedback text-sm" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-2 mt-1 text-end">
                <button
                    type="submit"
                    class="btn btn-primary rounded-1 py-1 text-sm"
                    >Save
                </button>
            </div>
        </div>
            <!--
            <div class="col-sm-6">
                <div class="card" style="background: #e9ecef">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="card-title text-black">Remove account</h5>
                                <p class="card-text text-sm text-mu">There is no going back, please make sure.</p>
                            </div>
                            <div class="col-4 text-end">
                                <a
                                    href="#"
                                    class="bg-white rounded-1 py-1 px-2 fw-600 text-sm text-danger"
                                    >Deativate
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        -->
    </form>
@endsection()