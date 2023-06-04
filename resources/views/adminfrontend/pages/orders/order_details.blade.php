<?php
	use App\Models\Products_Colors;
	use App\Models\Products_Sizes;
	use App\Models\Products_Imgreviews;
?>
    <!-- For window.print() without title and web hhtp-->
    <style>
        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }
            body  {
                padding-top: 5rem;
                padding-bottom: 5rem;
            }
        }
    </style>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <!--------------- Alert ------------------------>
        <div class="col-md-12 my-3 mb-md-0">
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
        </div>
        <div class="col-12 text-center">
            <h4 class="text-medium mb-20">Order Details</h4>
        </div>
        <!---------------End Alert ------------------------>
        <div class="col-lg-12">
            <div class="card-style mb-30">
                <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class=" d-flex flex-row align-items-baseline">
                                    <i class="bi bi-calendar" style="font-size: 18px;"></i>
                                    <h5 class="text-sm fw-bold px-2">
                                        {{$order->created_at->toDayDateTimeString();}}
                                    </h5>
                                </div>
                                <p class="text-muted text-sm ms-4">{{$order->invoice_code}}</p>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="d-flex flex-row align-items-baseline justify-content-end">
                                        <select
                                            class="form-select form-select-sm "
                                            aria-label="Default select example"
                                            id="orderStatus"
                                            name="orderStatus"
                                            style="width: 150px;"
                                            {{($order->order_status == 'Canceled')? 'disabled': ''}}
                                            >
                                            <option disabled selected>Change status</option>
                                            <option
                                                value ="{{url('admin/order-status-action/'.$order->id .'/pending')}}"
                                                class="text-warning"
                                                >
                                                Pending
                                            </option>
                                            <option
                                                value ="{{url('admin/order-status-action/'.$order->id .'/processing')}}"
                                                class="text-primary"
                                                >
                                                Processing
                                            </option>
                                            <option
                                                value ="{{url('admin/order-status-action/'.$order->id .'/delivered')}}"
                                                class="text-success"
                                                >
                                                Delivered
                                            </option>
                                            <option
                                                value ="{{url('admin/order-status-action/'.$order->id .'/canceled')}}"
                                                class="text-danger"
                                                >
                                               Canceled
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="bg-secondary border-2 border-top border-secondary">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="order-icon">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-10 ps-0">
                                        <h6 class="text-sm fw-bold">Customer</h6>
                                        <p class="text-sm text-black">{{$customer->c_name}}</p>
                                        <p class="text-sm text-black">{{$customer->c_phone}}</p>
                                        <p class="text-sm text-black">{{$customer->c_email}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="order-icon">
                                            <span class="material-icons-round"  style="font-size: 18px">
                                                local_shipping
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-10 ps-0">
                                        <h6 class="text-sm fw-bold">Deliver to</h6>
                                        <p class="text-sm ">Address:
                                            <span class="text-black">
                                                {{$customer->c_address}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="order-icon">
                                            <i class="bi bi-cart-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-10 ps-0">
                                        <h6 class="text-sm fw-bold">Order</h6>
                                        <p class="text-sm ">Code:
                                            <span class="text-black">
                                                {{$order->invoice_code}}
                                            </span>
                                        </p>
                                        <p class="text-sm ">Payment method:
                                            <span class="text-black">
                                                {{$order->payment_method}}
                                            </span>
                                        </p>
                                        <p class="text-sm ">Status:
                                            <span class="fw-normal
                                                {{($order->order_status == 'Pending')?  'text-warning' : ''}}
                                                {{($order->order_status == 'Processing')?  'text-primary' : ''}}
                                                {{($order->order_status == 'Delivered')?  'text-success' : ''}}
                                                {{($order->order_status == 'Canceled')?  'text-danger' : ''}}
                                                ">
                                                {{$order->order_status}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8">
                                <div class="table-responsive" >
                                    <table class="table top-selling-table table-bordered-less">
                                        <thead class="border-top" style="border: 1px solid #d3dae0;">
                                            <tr class="text-start">
                                                <th><h6 class="text-medium">#</h6></th>
                                                <th class="min-width text-center"><h6 class="text-medium">Image</h6></th>
                                                <th class="min-width"><h6 class="text-medium">Product</h6></th>
                                                <th class="min-width "><h6 class="text-medium">Size</h6></th>
                                                <th class="min-width "><h6 class="text-medium">Quantity</h6></th>
                                                <th class="min-width "><h6 class="text-medium">Unit price</h6></th>
                                                <th class="min-width "><h6 class="text-medium">Amount</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody style="border: 1px solid #d3dae0;">
                                            @php
                                                $totalAmount = 0;
                                                $cnt= 1;
                                            @endphp
                                            @foreach ($orderDetails as $orderDetail)
                                                <tr class="text-start text-sm">
                                                    <th><p class="text-sm">{{$cnt++}}</p></th>
                                                    <td class="text-center">
                                                        <img
                                                            src="/product_img/imgcover/{{$orderDetail->rela_product_order->product_imgcover}}"
                                                            class="img-fluid product-thumbnail order-img"
                                                        >
                                                    </td>
                                                    <td class="text-primary fw-600">
                                                        {{$orderDetail->rela_product_order->product_name}}
                                                    </td>
                                                    <td>{{$orderDetail->rela_size_order->size_number}}</td>
                                                    <td>{{$orderDetail->product_quantity}}</td>
                                                    <td>$ {{$orderDetail->product_price}}</td>
                                                    <td>
                                                        @php
                                                            $price = $orderDetail->product_price;
                                                            $qty = $orderDetail->product_quantity;
                                                            $amount = $price * $qty;
                                                            $totalAmount += $amount;
                                                        @endphp
                                                        $ {{number_format($amount, 2)}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr >
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2">
                                                    <table class="table table-borderless text-sm table-inside">
                                                        <tr>
                                                            <td><p>Sub total :</p></td>
                                                            <td class="text-start">$ {{number_format($totalAmount, 2)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><p>Delivery fee :</p></td>
                                                            <td class="text-start">$ {{$order->delivery_fee}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><p>Discount :</p></td>
                                                            <td class="text-start">$ {{number_format($order->discount, 2)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Total paid :</td>
                                                            <td class="fs-6 fw-bold text-danger text-start">
                                                                @php
                                                                    $totalPaid = ($totalAmount + $order->delivery_fee) - ($order->discount);
                                                                @endphp
                                                                $ {{number_format($totalPaid, 2)}}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form  action="" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-12 my-3 mb-md-0">
                    <!------------------- Download or print invoice----------------------->
                    <div class="row d-flex align-items-baseline">
                        <div class="col-md-2">
                            <h4 class="mb-2 text-black">Order Details</h4>
                        </div>
                        <div class="col-md-10 d-flex justify-content-end align-items-baseline">
                            <div class="row align-items-baseline px-3">
                                    <div class="d-flex flex-row align-items-baseline">
                                        <p class="text-sm pe-2">Update status: </p>
                                        <select
                                                class="form-select"
                                                aria-label="Default select example"
                                                id="orderStatus"
                                                name="orderStatus"
                                                style="width: 140px;"
                                                {{($order->order_status == 'Canceled')? 'disabled': ''}}
                                                >
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/pending')}}"
                                                    {{($order->order_status == 'Pending')? 'selected': ''}}
                                                    class="text-warning"
                                                    >
                                                    Pending
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/processing')}}"
                                                    {{($order->order_status == 'Processing')? 'selected': ''}}
                                                    class="text-primary"
                                                    >
                                                    Processing
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/delivered')}}"
                                                    {{($order->order_status == 'Delivered')? 'selected': ''}}
                                                    class="text-success"
                                                    >
                                                    Delivered
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/canceled')}}"
                                                    {{($order->order_status == 'Canceled')? 'selected': ''}}
                                                    class="text-danger"
                                                    >
                                                   Canceled
                                                </option>
                                            </select>
                                    </div>
                            </div>
                            <div class="form-group mb-2">
                                <button

                                    onclick="printDiv('printableArea')"
                                    class="btn btn-danger rounded-0 me-2"
                                    >
                                    Print Invoice
                                </button>

                                <a
                                    class="btn btn-success rounded-0 ms-auto me-2"
                                    href="{{url('admin/download-invoice/'. $order->id)}}"
                                    role="button"
                                    >
                                    Download Invoice PDF
                                </a>

                                <a
                                    class="btn btn-outline-danger rounded-0"
                                    href="{{url('admin/order-list/show=10/by-code=desc')}}"
                                    role="button"
                                    >
                                    Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-------------------End Download or print invoice----------------------->

                    <!------------------Start Invoice ------------------------>
                    @include('adminfrontend.pages.orders.invoice')
                    <!------------------End  Invoice ------------------------>
                </div>
            </div>
        </form>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!----------- For Click to print page ----------->
    <script src="{{url('frontend/assets/js/print_invoice.js')}}"></script>
    <!----------- End For Click to print page ----------->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // Get "name" of select opption if there is many selects like each order have 1 select(with many option)
        $("[name='orderStatus']").on('change', function () { // bind change event to select
            var url_order_status = $(this).val(); // get selected value
            //if (url_order_status != '') { // require a url_order_status
                window.location = url_order_status; // redirect
                //alert(url_order_status);
           // }
            return false;
        });
    </script>
@endsection()