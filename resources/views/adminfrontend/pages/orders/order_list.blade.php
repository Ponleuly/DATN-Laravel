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
                        <div class="col-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Orders List</h4>
                                <div class="row align-items-baseline">
                                    <div class="col-3 d-flex flex-row align-items-baseline" style="min-width:200px">
                                        <p class="text-sm pe-2">Show </p>
                                        <select
                                            class="form-select form-select-sm"
                                            style="width:65px"
                                            aria-label="Default select example"
                                            id="showPage"
                                            >
                                            <option
                                                value ="{{url('/admin/order-list/page=5')}}"
                                                {{($page==5)? 'selected':''}}
                                                >
                                                5
                                            </option>
                                            <option
                                                value ="{{url('/admin/order-list/page=10')}}"
                                                {{($page==10)? 'selected':''}}
                                                >
                                                10
                                            </option>
                                            <option
                                                value ="{{url('/admin/order-list/page=20')}}"
                                                {{($page==20)? 'selected':''}}
                                                >
                                                20
                                            </option>
                                            <option
                                                value ="{{url('admin/order-list/page=all')}}"
                                                {{Request::is('admin/order-list/page=all')? 'selected':''}}
                                                >
                                                All
                                            </option>
                                        </select>
                                        <p class="text-sm px-2">entries </p>
                                    </div>

                                </div>
                                @if($search_text!='')
                                    <p class="text-md mt-2">Found
                                        <strong class="text-danger">{{$page}}</strong> orders for your search:
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <div class="right">
                                <form  action="{{url('admin/order-search')}}">
                                    <div class="input-group input-group-sm w-100 ">
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
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover" id="sampleTable">
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
                                        //$status_cmp = Orders_Statuses::where('status', $order->order_status)->first();
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
                                                class="btn btn-sm py-1 px-2"
                                                style="width: 90px; color:#fff ;background:
                                                     @foreach ($statuses as $status_name)
                                                        {{($order->order_status == $status_name->status)?  $status_name->status_color : ''}}
                                                    @endforeach
                                                ">
                                                {{$order->order_status}}
                                            </button>
                                        </td>
                                        <td>
                                            <select
                                                class="form-select form-select-sm"
                                                aria-label="Default select example"
                                                id="orderStatus"
                                                name="orderStatus"
                                                >
                                                @foreach ($statuses as $status_name)
                                                    <option
                                                        value ="{{url('admin/order-status-action/'.$order->id .'/'.$status_name->status)}}"
                                                        {{($status_name->status == $order->order_status)? 'selected': ''}}
                                                        >
                                                        {{($status_name->status)}}
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
                                            href="{{url('admin/order-list/page=10')}}"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // Get "id" of select option, if there are only one select
        $('#showPage').on('change', function () { // bind change event to select
            var url_show_page = $(this).val(); // get selected value
            if (url_show_page != '') { // require a url_show_page
                window.location = url_show_page; // redirect
            }
            return false;
        });
        // Get "name" of select opption if there is many selects like each order have 1 select(with many option)
        $("[name='orderStatus']").on('change', function () { // bind change event to select
            var url_order_status = $(this).val(); // get selected value
            if (url_order_status != '') { // require a url_order_status
                window.location = url_order_status; // redirect
                //alert(url_order_status);
            }
            return false;
        });
    </script>
@endsection()