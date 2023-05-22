<?php
	use App\Models\Products_Attributes;
	use App\Models\Orders_Details;
	use App\Models\Products;
	use App\Models\Invoices;
	use App\Models\Orders_Statuses;
	use App\Models\Customers;

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
                        <div class="left">
                            <h6 class="text-medium mb-20">Orders List</h6>
                            <div class="row">
                                <div class="col-5">
                                    <p>Show:</p>
                                </div>
                                <div class="col-7">
                                    <select
                                        class="form-select form-select-sm"
                                        aria-label="Default select example"
                                        >
                                        <option
                                            value ="5"
                                            onClick="window.location=
                                            '{{url('/admin/order-list/page=5')}}'"
                                            {{($page==5)? 'selected':''}}
                                            >
                                            5
                                        </option>
                                        <option
                                            value ="10"
                                            onClick="window.location =
                                            '{{url('/admin/order-list/page=10')}}'"
                                            {{($page==10)? 'selected':''}}

                                            >
                                            10
                                        </option>
                                        <option
                                            value ="20"
                                            onClick="window.location =
                                            '{{url('/admin/order-list/page=20')}}'"
                                            {{($page==20)? 'selected':''}}

                                            >
                                            20
                                        </option>
                                        <option
                                            value ="all"
                                            onClick="window.location =
                                            '{{url('/admin/order-list/page=all')}}'"
                                            {{($page>20)? 'selected':''}}
                                            >
                                            All
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                             <form  action="{{url('admin/order-search')}}">
                                <div class="input-group input-group-sm w-100">
                                    <input
                                        type="text"
                                        name="search_order"
                                        class="form-control rounded-0 text-sm"
                                        placeholder="Enter order code here..."
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
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Order Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Code</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Customer</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Phone</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Payment</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Total</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Status</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Action</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Invoice</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        $deliveryFee = $order->delivery_fee;
                                        $discount = $order->discount;

                                        $totalAmount = 0;
                                        $total = 0;
                                        $orderDetails = Orders_Details::where('order_id', $order->id)->get();
                                        foreach ($orderDetails as  $orderDetail) {
                                            $price = $orderDetail->product_price;
                                            $qty = $orderDetail->product_quantity;
                                            $totalAmount += $price * $qty;
                                        }
                                        $total = $totalAmount + $deliveryFee - $discount;
                                         // Get delivery statuses
                                        $statuses = Orders_Statuses::orderBy('id')->get();
                                        $status_name = Orders_Statuses::where('id', $order->order_status)->first();
                                    @endphp
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td><p class="text-sm">{{date('Y-m-d  H:i', strtotime($order->created_at))}}</p></td>
                                        <td><p class="text-sm">{{$order->invoice_code}}</p></td>
                                        <td><p class="text-sm">{{$order->rela_customer_order->c_name}}</p></td>
                                        <td><p class="text-sm">{{$order->rela_customer_order->c_phone}}</p></td>
                                        <td><p class="text-sm"> {{$order->payment_method}}</p></td>

                                        <td><p class="text-sm">$ {{number_format($total, 2)}}</p></td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-2
                                                    {{($order->order_status == 1)?  'btn-warning' : ''}}
                                                    {{($order->order_status == 2)?  'btn-primary' : ''}}
                                                    {{($order->order_status == 3)?  'btn-success' : ''}}
                                                    {{($order->order_status == 4)?  'btn-danger' : ''}}
                                                    {{($order->order_status > 4)?  'btn-secondary' : ''}}
                                                    "
                                                    style="width: 90px"
                                                >
                                                {{$status_name->status}}
                                            </button>
                                        </td>
                                        <td>
                                            <select
                                                class="form-select form-select-sm"
                                                aria-label="Default select example"
                                                >
                                                @foreach ($statuses as $status)
                                                    <option
                                                        value ="{{$status->id}}"
                                                        {{($status->id == $order->order_status)? 'selected': ''}}
                                                        onClick="window.location = '{{url('admin/order-status-action/'.$order->id .'/'.$status->id)}}'"
                                                        >
                                                        {{$status->status}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="width:100px">
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 view-btn"
                                                href="{{url('admin/order-details/'. $order->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">visibility</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                 href="{{url('/admin/order-delete/'.$order->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Order"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            @if($search_text == '')
                                <!--- To show data by pagination --->
                                {{$orders->links()}}
                                @else
                                    <div class="d-flex">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-2"
                                                href="{{url('admin/order-list')}}"
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
@endsection()