@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
                <!--------------- Alert ------------------------>
                @include('adminfrontend.pages.alert')
                <!---------------End Alert ------------------------>
            </div>
            <div class="row mb-10">
                <div class="col-6">
                    <h4 class="text-medium">Customer Profile</h4>
                </div>
            </div>
            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <form
                        action="{{url('/admin/profile/'.$customer->id)}}"
                        method="POST" enctype="multipart/form-data">
                        @csrf <!-- to make form active -->
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label text-sm">Full name</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm
                                                @error('name') is-invalid @enderror"
                                                id="name"
                                                name="name"
                                                value="{{$customer->c_name}}"
                                                placeholder="Enter name"
                                                readonly
                                            >
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="type" class="form-label text-sm">Role</label><br>
                                            <label class="text-sm text-primary align-baseline">
                                                Customer
                                            </label>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label text-sm">Email</label>
                                            <input
                                                type="email"
                                                class="form-control form-control-sm
                                                @error('email') is-invalid @enderror"
                                                id="email"
                                                name="email"
                                                value="{{old('email')? old('email') : $customer->c_email}}"
                                                placeholder="example@gmail.com"
                                                readonly
                                            >
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label text-sm">Phone</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm
                                                @error('phone') is-invalid @enderror"
                                                id="phone"
                                                name="phone"
                                                value="{{old('phone')? old('phone') : $customer->c_phone}}"
                                                placeholder="+84 454 456 56"
                                                readonly
                                            >
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label text-sm">Address</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm
                                                @error('address') is-invalid @enderror"
                                                id="address"
                                                name="address"
                                                value="{{old('address')? old('address') : $customer->c_address}}"
                                                placeholder="23 Ta Quang Buu,..."
                                                readonly
                                            >
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label text-sm">City/Province</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm
                                                @error('city') is-invalid @enderror"
                                                id="city"
                                                name="city"
                                                value="{{old('city')? old('city') : $customer->c_city}}"
                                                placeholder="Ha Noi"
                                                readonly
                                            >
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label text-sm">District</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm
                                                @error('district') is-invalid @enderror"
                                                id="district"
                                                name="district"
                                                value="{{old('district')? old('district') : $customer->c_district}}"
                                                placeholder="Hai Ba Trung..."
                                                readonly
                                            >
                                            @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="city" class="form-label text-sm">Ward</label>
                                            <input
                                                type="text"
                                                class="form-control form-control-sm
                                                @error('ward') is-invalid @enderror"
                                                id="ward"
                                                name="ward"
                                                value="{{old('ward')? old('ward') : $customer->c_ward}}"
                                                placeholder="Bach Khoa"
                                                readonly
                                            >
                                            @error('ward')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="col-md-4 d-flex justify-content-between">
                                <div class="row"></div>
                                <div class="row">
                                    <div class="col-md-12 my-auto">
                                        <span class="display-3 text-primary ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="3em" height="3em" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                            </svg>
                                        </span>
                                        
                                    </div>
                                    
                                </div>
                                <div class="row"></div>
                            </div>
                            <div class="col-md-8 text-end">
                                <div class="mt-2">
                                    <a
                                        class="btn btn-outline-danger shadow rounded-1 py-1 me-2"
                                        href="{{url('admin/customer-list')}}"
                                        role="button">
                                        <p class="text-sm">Back </p>
                                    </a>
                                    <a
                                        class="btn btn-primary shadow rounded-1 py-1"
                                        href="{{url('admin/customer-edit/'.$customer->id)}}"
                                        role="button">
                                        <p class="text-sm">Edit </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()


