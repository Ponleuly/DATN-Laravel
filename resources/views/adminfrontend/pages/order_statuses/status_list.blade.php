<?php
	use App\Models\Categories_Groups;
?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 my-3 mb-md-0">
                    <!--------------- Alert ------------------------>
                    @include('adminfrontend.pages.alert')
                    <!---------------End Alert ------------------------>
                </div>
            </div>
                    <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                         <div class="col-md-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Order Statuses</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row">
                                    <div class="col-md-3 mb-2 ">
                                        <a
                                            class="btn btn-outline-primary rounded-0 py-1"
                                            href="{{url('/admin/order-status-add')}}"
                                            role="button">
                                            <p class="text-sm">Add Status</p>
                                        </a>
                                    </div>
                                    <div class="col-md-9 ">
                                        <form  action="{{url('admin/order-status-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_order_status"
                                                    class="form-control rounded-0 text-sm"
                                                    placeholder="Enter status title here..."
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
                                <tr class="text-center">
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Status</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statuses as $status)
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td>
                                            <p class="text-sm" style="color:{{$status->status_color}}">
                                                {{$status->status}}
                                            </p>
                                        </td>
                                        <td><p class="text-sm">{{$status->created_at->diffForHumans()}}</p></td>
                                        <td>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 edit-btn"
                                                href="{{url('admin/order-status-edit/'.$status->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Status"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">edit</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                href="{{url('admin/order-status-delete/'.$status->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Status"
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
                                        href="{{url('admin/order-status-list')}}"
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
@endsection()