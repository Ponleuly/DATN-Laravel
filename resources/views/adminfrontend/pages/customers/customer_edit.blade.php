@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid ">
        @if(Session::has('alert'))
            <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                {{Session::get('alert')}}
                <button group="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
		@endif
        <form  action="{{url('admin/customer-edit/'.$customer->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-lg-6 my-3">
                    <div class="card-style mb-20">
                        <div class="col-12 text-center">
                            <h4 class="text-medium mb-20 mt-10">Edit Customer</h4>
                        </div>
                        <div class="form-group mb-2">
                            <div class="col-md-12">
                                <label for="c_name"><p class="text-sm">Customer Name</p></label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm rounded-0 fw-500 text-sm"
                                    id="c_name"
                                    name="c_name"
                                    value="{{$customer->c_name}}"
                                    placeholder="customer name..."
                                >

                                <label for="c_phone"><p class="text-sm mt-2">Customer Phone</p></label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm rounded-0 fw-500 text-sm"
                                    id="c_phone"
                                    name="c_phone"
                                    value="{{$customer->c_phone}}"
                                    placeholder="customer phone..."
                                >

                                <label for="c_email"><p class="text-sm mt-2">Customer Email</p></label>
                                <input
                                    type="text"
                                    class="form-control form-control-sm rounded-0 fw-500 text-sm"
                                    id="c_email"
                                    name="c_email"
                                    value="{{$customer->c_email}}"
                                    placeholder="customer email..."
                                >
                                <div class="row">
                                    <div class="col-8">
                                        <label for="c_address"><p class="text-sm mt-2">Customer Address</p></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm rounded-0 fw-500 text-sm"
                                            id="c_address"
                                            name="c_address"
                                            value="{{$customer->c_address}}"
                                            placeholder="customer address..."
                                        >
                                    </div>
                                    <div class="col-4">
                                         <label for="c_city"><p class="text-sm mt-2">City/Province</p></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm rounded-0 text-capitalize mb-2"
                                            id="c_city"
                                            name="c_city"
                                            value="{{$customer->c_city}}"
                                            placeholder="City/province..."
                                        >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="c_district"><p class="text-sm">District</p></label>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm rounded-0 text-capitalize mb-2"
                                        id="c_district"
                                        name="c_district"
                                        value="{{$customer->c_district}}"
                                        placeholder="District..."
                                    >
                                    </div>
                                    <div class="col-6">
                                        <label for="c_ward"><p class="text-sm">Ward</p></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm rounded-0 text-capitalize mb-2"
                                            id="c_ward"
                                            name="c_ward"
                                            value="{{$customer->c_ward}}"
                                            placeholder="Ward..."
                                        >
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="mb-2 d-flex justify-content-end">
                                        <a
                                            class="btn btn-outline-danger shadow rounded-1 py-1 me-2"
                                            href="{{url('admin/customer-list')}}"
                                            role="button">
                                            <p class="text-sm">Back </p>
                                        </a>
                                        <button
                                            class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                            type="submit">Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection()