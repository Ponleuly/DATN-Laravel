@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('admin/customer-edit/'.$customer->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    @if(Session::has('alert'))
                        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                            {{Session::get('alert')}}
                        <button group="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
		            @endif

                    <h4 class="mb-2 text-black">Edit Customer</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="c_name"><p class="text-label">Customer Name</p></label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2 text-capitalize"
                                            id="c_name"
                                            name="c_name"
                                            value="{{$customer->c_name}}"
                                            placeholder="customer name..."
                                        >

                                        <label for="c_phone"><p class="text-label">Customer Phone</p></label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2 text-capitalize"
                                            id="c_phone"
                                            name="c_phone"
                                            value="{{$customer->c_phone}}"
                                            placeholder="customer phone..."
                                        >

                                        <label for="c_email"><p class="text-label">Customer Email</p></label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2 text-capitalize"
                                            id="c_email"
                                            name="c_email"
                                            value="{{$customer->c_email}}"
                                            placeholder="customer email..."
                                        >

                                        <label for="c_address"><p class="text-label">Customer Address</p></label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2 text-capitalize"
                                            id="c_address"
                                            name="c_address"
                                            value="{{$customer->c_address}}"
                                            placeholder="customer address..."
                                        >
                                        <div class="d-flex mt-4">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-3"
                                                href="{{url('admin/customer-list')}}"
                                                role="button">
                                                Back to List
                                            </a>
                                            <button
                                                class="btn btn-primary rounded-0 ms-auto mt-3"
                                                group="submit">Update Customer
                                            </button>
                                        </div>
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