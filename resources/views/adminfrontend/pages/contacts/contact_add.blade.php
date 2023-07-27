@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('admin/contact-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    <!--------------- Alert ------------------------>
                    @include('adminfrontend.pages.alert')
                    <!---------------End Alert ------------------------>

                    <div class="card-style">
                        <h4 class="text-medium text-center mb-20 text-primary">Add Contact</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="contact_info">
                                            <p class="text-label">Contact Info</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2 text-capitalize"
                                            id="contact_info"
                                            name="contact_info"
                                            placeholder="contact info..."
                                        >
                                        <div class="d-flex mt-4 justify-content-end">
                                            <a
                                                class="btn btn-outline-danger shadow rounded-1 py-1 me-2 text-sm"
                                                href="{{url('/admin/contact-list')}}"
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
            </div>
        </form>
    </div>
@endsection()