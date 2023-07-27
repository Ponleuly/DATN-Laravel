@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('admin/delivery-edit/'.$delivery->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    @include('adminfrontend.pages.alert')

                    <div class="card-style">
                        <h4 class="text-medium text-center text-primary">Edit Delivery Option</h4>
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
                                    <div class="d-flex mt-4 justify-content-end">
                                        <a
                                            class="btn btn-outline-danger shadow rounded-1 py-1 me-2 text-sm"
                                            href="{{url('admin/delivery-list')}}"
                                            role="button">Back
                                        </a>
                                        <button
                                            class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                            group="submit">Save
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