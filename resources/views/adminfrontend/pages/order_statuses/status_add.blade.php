@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/order-status-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    <!--------------- Alert ------------------------>
                    @include('adminfrontend.pages.alert')
                    <!---------------End Alert ------------------------>
                    <h4 class="mb-2 text-black">Add Status Option</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="status"><p class="text-label">Status Title</p></label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2 text-capitalize"
                                            id="status"
                                            name="status"
                                            placeholder="Status..."
                                        >
                                        <label for=""><p class="text-label">Status Color</p></label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="primary" value="#0d6efd" checked>
                                            <label class="form-check-label bg-primary" for="primary" style="color:#0d6efd">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="secondary" value="#6c757d">
                                            <label class="form-check-label bg-secondary" for="secondary" style="color:#6c757d">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="success" value="#198754">
                                            <label class="form-check-label bg-success" for="success" style="color:#198754">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="danger" value="#dc3545">
                                            <label class="form-check-label bg-danger" for="danger" style="color:#dc3545">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="warning" value="#ffc107">
                                            <label class="form-check-label bg-warning" for="warning" style="color:#ffc107">AAAA</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="info" value="#0dcaf0">
                                            <label class="form-check-label bg-info" for="info" style="color:#0dcaf0">AAAA</label>
                                        </div>
                                         <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="dark" value="#212529">
                                            <label class="form-check-label bg-dark" for="dark" style="color:#212529">AAAA</label>
                                        </div>

                                        <div class="d-flex mt-4">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-3"
                                                href="{{url('admin/order-status-list')}}"
                                                role="button"
                                                >
                                                Back to List
                                            </a>
                                            <button
                                                class="btn btn-primary rounded-0 ms-auto mt-3"
                                                type="submit"
                                                >
                                                Add Status
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