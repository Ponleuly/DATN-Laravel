@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('admin/delivery-edit/'.$delivery->id)}}" method="POST" enctype="multipart/form-data">
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

                    <h4 class="mb-2 text-black">Edit Delivery Option</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="delivery_option"><p class="text-label">Delivery Option</p></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-color rounded-0 mb-2 py-2 px-2 w-100"
                                            id="delivery_option"
                                            name="delivery_option"
                                            value="{{$delivery->delivery_option}}"
                                            required
                                        >

                                        <label for="delivery_fee"><p class="text-label">Delivery Fee</p></label>
                                        <input
                                            type="number"
                                            class="form-control form-control-color rounded-0 mb-2 py-2 px-2 w-100"
                                            id="delivery_fee"
                                            name="delivery_fee"
                                            value="{{$delivery->delivery_fee}}"
                                            required
                                        >
                                        <div class="d-flex mt-4">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-3"
                                                href="{{url('admin/delivery-list')}}"
                                                role="button">
                                                Back to List
                                            </a>
                                            <button
                                                class="btn btn-primary rounded-0 ms-auto mt-3"
                                                type="submit">
                                                Update Delivery Option
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