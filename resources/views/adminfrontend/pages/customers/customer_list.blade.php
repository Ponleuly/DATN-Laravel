<?php
	use App\Models\Products_Attributes;
?>
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
                                <h6 class="text-medium mb-20">Customers List</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row">
                                    <div class="col-md-3 mb-2 ">

                                    </div>
                                    <div class="col-md-9 ">
                                        <form  action="{{url('admin/customer-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_customer"
                                                    class="form-control rounded-0 text-sm"
                                                    placeholder="Enter customer name here..."
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default"
                                                    value="{{$search_text}}"
                                                >
                                                <button
                                                    class="btn btn-outline-primary rounded-0 text-sm"
                                                    type="submit"
                                                    id="search"
                                                    >
                                                    Search
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
                                <tr>
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Name</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Phone</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Email</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Address</h6></th>
                                    <th class="min-width text-center"><h6 class="text-sm text-medium">Date</h6></th>
                                    <th class="min-width text-center" style="width: 100px"><h6 class="text-sm text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>
                                            <p class="text-sm">
                                                @if($search_text == '')
                                                    {{($customers->currentPage()-1) * $customers->perPage() + $loop->index + 1}}
                                                    @else
                                                        {{$count++}}
                                                @endif
                                            </p>
                                        </td>
                                        <td><p class="text-sm">{{$customer->c_name}}</p></td>
                                        <td><p class="text-sm">{{$customer->c_phone}}</p></td>
                                        <td><p class="text-sm">{{$customer->c_email}}</p></td>
                                        <td><p class="text-sm">{{$customer->c_address}}</p></td>
                                        <td><p class="text-sm text-center">{{$customer->created_at->diffForHumans()}}</p></td>
                                        <td class="text-center">
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 edit-btn"
                                                href="{{url('admin/customer-edit/'.$customer->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Customer"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">edit</span>
                                            </a></div>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                href="{{url('admin/customer-delete/'.$customer->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Customer"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            @if($search_text == '')
                            <p class="text-sm">
                                Showing {{($customers->currentPage()-1)* $customers->perPage()+($customers->total() ? 1:0)}}
                                to {{($customers->currentPage()-1)*$customers->perPage()+count($customers)}}
                                of {{$customers->total()}}  results
                            </p>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end">
                                @if($search_text == '')
                                    <!--- To show data by pagination --->
                                    {{$customers->links()}}

                                    @else
                                        <div class="d-flex">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-2"
                                                href="{{url('admin/customer-list')}}"
                                                role="button"
                                                >
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
    </div>
@endsection()