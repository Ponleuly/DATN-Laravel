@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/product-size-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    <!--------------- Alert ------------------------>
                    @include('adminfrontend.pages.alert')
                    <!---------------End Alert ------------------------>

                    <div class="card-style">
                        <h4 class="text-medium text-center text-primary">Add Size</h4>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <div class="col-md-12">
                                    
                                    {{-- <label for=""><p class="text-label">Size type:</p></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="size_type" id="size_us" value="us">
                                        <label class="form-check-label" for="size_us">
                                          US size
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="size_type" id="size_uk" value="uk">
                                        <label class="form-check-label" for="size_uk">
                                          UK size
                                        </label>
                                    </div> --}}

                                    <label for="group_name"><p class="text-label">Enter Size Number</p></label>
                                    <input
                                        type="text&number"
                                        class="form-control rounded-0 fw-500 mb-2"
                                        min="1"
                                        maxlength="5"
                                        id="size"
                                        name="size_number"
                                        placeholder="size number..."
                                        required
                                    >
                                    <div class="d-flex mt-4 justify-content-end">
                                        <a
                                            class="btn btn-outline-danger shadow rounded-1 py-1 me-2 text-sm"
                                            href="{{url('/admin/product-size-list')}}"
                                            role="button">Back
                                        </a>
                                        <button
                                            class="btn btn-primary shadow rounded-1 py-1 text-sm"
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