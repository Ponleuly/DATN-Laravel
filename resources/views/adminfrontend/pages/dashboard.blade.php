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
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Dashboard</h2>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>

        <!-- ========== title-wrapper end ========== -->
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <span class="material-icons-round">add_shopping_cart</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">New Orders</h6>
                        <h3 class="text-bold mb-10">{{$newOrder}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon orange">
                            <span class="material-icons-round">shopping_cart</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Orders</h6>
                        <h3 class="text-bold mb-10">{{$totalOrder}}</h3>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon primary">
                        <span class="material-icons-round">local_mall</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Products</h6>
                        <h3 class="text-bold mb-10">{{$totalProduct}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>

            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon success">
                        <span class="material-icons-round">paid</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Income</h6>
                        <h3 class="text-bold mb-10">$ {{$totalIncome}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-------------------------------------------------------------------->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple  bg-warning text-light">
                        <span class="material-icons-round">account_circle</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Members</h6>
                        <h3 class="text-bold mb-10">{{$totalMember}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon orange  bg-info text-light">
                        <span class="material-icons-round">groups</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Customers</h6>
                        <h3 class="text-bold mb-10">{{$totalCustomer}}</h3>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon primary bg-danger text-light">
                        <span class="material-icons-round">contact_mail</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Subscribers</h6>
                        <h3 class="text-bold mb-10">{{$totalSubscriber}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>

            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-30">Orders List</h6>
                        </div>
                    </div>
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
                                                    {{($order->order_status == 'Pending')?  'btn-warning' : ''}}
                                                    {{($order->order_status == 'Processing')?  'btn-primary' : ''}}
                                                    {{($order->order_status == 'Delivered')?  'btn-success' : ''}}
                                                    {{($order->order_status == 'Canceled')?  'btn-danger' : ''}}
                                                    "
                                                    style="width: 90px"
                                                >
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
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/pending')}}"
                                                    {{($order->order_status == 'Pending')? 'selected': ''}}
                                                    >
                                                    Pending
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/processing')}}"
                                                    {{($order->order_status == 'Processing')? 'selected': ''}}
                                                    >
                                                    Processing
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/delivered')}}"
                                                    {{($order->order_status == 'Deliverd')? 'selected': ''}}
                                                    >
                                                    Delivered
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/canceled')}}"
                                                    {{($order->order_status == 'Canceled')? 'selected': ''}}
                                                    >
                                                   Canceled
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <a
                                                class="btn btn-info py-1 px-2 btn-sm"
                                                href="{{url('admin/order-details/'. $order->id)}}"
                                                role="button"
                                                >
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <!--- To show data by pagination --->
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
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