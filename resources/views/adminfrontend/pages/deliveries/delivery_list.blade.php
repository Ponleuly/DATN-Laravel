@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
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
            </div>

            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                         <div class="col-md-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Delivery Options List</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row justify-content-end">
                                    <div class="col-md-3 mb-2">
                                        <a
                                            class="btn btn-outline-primary shadow rounded-1 py-1"
                                            href="{{url('/admin/delivery-add')}}"
                                            role="button">
                                            <p class="text-sm">Add Delivery</p>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{url('admin/delivery-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_delivery"
                                                    class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                                    placeholder="Enter delivery option here..."
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default"
                                                    value="{{$search_text}}"
                                                >
                                                <button
                                                    class="btn btn-outline-primary btn-sm rounded-1 rounded-start-0 text-sm"
                                                    type="submit"
                                                    id="search"
                                                    >
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Delivery Option</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Delivery Fee</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deliveries as $delivery)
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td><p class="text-sm">{{$delivery->delivery_option}}</p></td>
                                        <td><p class="text-sm">$ {{$delivery->delivery_fee}}</p></td>
                                        <td><p class="text-sm">{{$delivery->created_at->diffForHumans()}}</p></td>
                                        <td>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 edit-btn"
                                                href="{{url('/admin/delivery-edit/'. $delivery->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Product"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">edit</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                href="{{url('/admin/delivery-delete/'. $delivery->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Product"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            @if($search_text != '')
                                <div class="d-flex">
                                    <a
                                        class="btn btn-outline-danger rounded-0 mt-2"
                                        href="{{url('admin/delivery-list')}}"
                                        role="button">
                                        <p class="text-sm">Back to List</p>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()