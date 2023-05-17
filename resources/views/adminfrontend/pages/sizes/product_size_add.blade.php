@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/product-size-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    <!--------------- Alert ------------------------>
                    @if(Session::has('alert'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                        {{Session::get('alert')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif(Session::has('message'))
                        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                            {{Session::get('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!---------------End Alert ------------------------>
                    <h4 class="mb-2 text-black">Add Sizes</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="size"><p class="text-label">Size Number</p></label>
                                        <input
                                            type="text&number"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            min="1"
                                            id="size"
                                            name="size_number"
                                            placeholder="size number..."
                                            required
                                        >
                                        <div class="d-flex mt-4">
                                            <a class="btn btn-outline-danger rounded-0 mt-3" href="{{url('/admin/product-size-list')}}" role="button">Back to List</a>
                                            <button class="btn btn-primary rounded-0 ms-auto mt-3" group="submit">Add Size</button>
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