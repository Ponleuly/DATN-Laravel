@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/order-status-edit/'.$order_status->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
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
                    <h4 class="mb-2 text-black">Edit Status Option</h4>
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
                                            value="{{$order_status->status}}"
                                            placeholder="Status..."
                                        >
                                        <label for=""><p class="text-label">Status Color</p></label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="primary"
                                                value="#0d6efd" {{($order_status->status_color == '#0d6efd')? 'checked':''}}>
                                            <label class="form-check-label bg-primary" for="primary" style="color:#0d6efd">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="secondary"
                                                value="#6c757d" {{($order_status->status_color == '#6c757d')? 'checked':''}}>
                                            <label class="form-check-label bg-secondary" for="secondary" style="color:#6c757d">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="success"
                                                value="#198754" {{($order_status->status_color == '#198754')? 'checked':''}}>
                                            <label class="form-check-label bg-success" for="success" style="color:#198754">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="danger"
                                                value="#dc3545" {{($order_status->status_color == '#dc3545')? 'checked':''}}>
                                            <label class="form-check-label bg-danger" for="danger" style="color:#dc3545">AAAA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="warning"
                                                value="#ffc107" {{($order_status->status_color == '#ffc107')? 'checked':''}}>
                                            <label class="form-check-label bg-warning" for="warning" style="color:#ffc107">AAAA</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="info"
                                                value="#0dcaf0" {{($order_status->status_color == '#0dcaf0')? 'checked':''}}>
                                            <label class="form-check-label bg-info" for="info" style="color:#0dcaf0">AAAA</label>
                                        </div>
                                         <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_color" id="dark"
                                                value="#212529" {{($order_status->status_color == '#212529')? 'checked':''}}>
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
                                                Update Status
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