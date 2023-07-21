@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
                <!--------------- Alert ------------------------>
                @include('adminfrontend.pages.alert')
                <!---------------End Alert ------------------------>
            </div>

            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                         <div class="col-md-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Payments List</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row justify-content-end">
                                    <div class="col-md-4 mb-2">
                                        <a
                                            class="btn btn-outline-primary shadow rounded-1 py-1"
                                            href="{{url('/admin/payment-add')}}"
                                            role="button">
                                            <p class="text-sm">Add Payment</p>
                                        </a>
                                    </div>
                                    <div class="col-md-6 ">
                                        <form action="{{url('admin/payment-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_payment"
                                                    class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                                    placeholder="Enter payment title here..."
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
                                    <th class="min-width"><h6 class="text-sm text-medium">Payment Title</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium text-start">Payment Detail</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td><p class="text-sm">{{$payment->payment_title}}</p></td>
                                        <td class="text-start">
                                            <p class="text-sm">{!! $payment->payment_detail !!}</p>
                                        </td>
                                        <td><p class="text-sm">{{$payment->created_at->diffForHumans()}}</p></td>
                                        <td>
                                            <a
                                                class="btn btn-outline-success btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/payment-edit/'. $payment->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Details"
                                                >
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a
                                                class="btn btn-outline-danger btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/payment-delete/'. $payment->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete from list"
                                                >
                                                <i class="bi bi-trash3-fill"></i>
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
                                        href="{{url('admin/payment-list')}}"
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