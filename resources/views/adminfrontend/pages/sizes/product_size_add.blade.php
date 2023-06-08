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

                    <div class="card-style">
                        <h4 class="text-medium text-center">Add Size</h4>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <div class="col-md-12">
                                    <label for="group_name"><p class="text-label">Size Number</p></label>
                                    <input
                                        type="text&number"
                                        class="form-control rounded-0 fw-500 mb-2"
                                        min="1"
                                        id="size"
                                        name="size_number"
                                        placeholder="size number..."
                                        required
                                    >

                                    <div class="d-flex mt-4 justify-content-end">
                                        <a
                                            class="btn btn-outline-danger rounded-1 py-1 me-2 text-sm"
                                            href="{{url('/admin/product-size-list')}}"
                                            role="button">Back
                                        </a>
                                        <button
                                            class="btn btn-primary rounded-1 py-1 text-sm"
                                            group="submit">Add
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