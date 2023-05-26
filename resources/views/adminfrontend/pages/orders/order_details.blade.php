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
                                                style="width: 130px;"
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
                                    type="submit"
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
                                    href="{{url('admin/order-list/page=10')}}"
                                    role="button"
                                    >
                                    Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-------------------End Download or print invoice----------------------->

                    <!------------------Start Invoice ------------------------>
                    <div class="p-lg-5 border bg-white" id="printableArea">
                        <!------------------ Invoice header ------------------------>
                        <div class="row d-flex align-items-baseline">
                            <div class="col-xl-9">
                                <h2 class="pt-0 text-black fw-bold text-danger mb-1">{{$shopName->website_name}}</h2>
                            </div>
                            <div class="col-xl-3">
                                <ul class="list-unstyled">
                                    <li class="text-muted">
                                        <p class="fs-6 fw-bold mb-1">CONTACT</p>
                                    </li>
                                    @foreach ($contacts as $contact)
                                        <li class="text-muted">
                                            <p class="text-muted fw-bold mb-0">
                                                <span class="fw-normal">{{$contact->contact_info}}</span>
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!------------------ End Invoice header ---------------------- -->
                        <hr class="border-2">

                        <!------------------Invoice customer information ---------------->
                        <div class="col-xl-12">
                            <div class="text-center">
                                <p class="h4 fw-bold">INVOICE</p>
                                <p class="text-muted fw-bold">{{$order->invoice_code}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-9 mb-2">
                                <ul class="list-unstyled">
                                    <li class="text-muted"><p class="fs-5 fw-bold mb-1">CUSTOMER</p></li>
                                    <li class="text-muted">
                                        <p class="text-muted fw-bold mb-1">Name :
                                            <span class="fw-normal">{{$customer->c_name}}</span>
                                        </p>
                                    </li>
                                    <li class="text-muted">
                                        <p class="text-muted fw-bold mb-1">Phone :
                                            <span class="fw-normal">{{$customer->c_phone}}</span>
                                        </p>
                                    </li>
                                    <li class="text-muted">
                                        <p class="text-muted fw-bold mb-1">Email :
                                            <span class="fw-normal">{{$customer->c_email}}</span>
                                        </p>
                                    </li>
                                    <li class="text-muted col-md-8">
                                        <p class="text-muted fw-bold mb-1">Address :
                                            <span class="fw-normal text-sm">{{$customer->c_address}}</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-3">
                                <ul class="list-unstyled">
                                    <li class="text-muted">
                                        <p class="fs-5 fw-bold mb-1">ORDER</p>
                                    </li>
                                    <li class="text-muted">
                                        <p class="text-muted fw-bold mb-1">Code :
                                            <span class="fw-normal">{{$order->invoice_code}}</span>
                                        </p>
                                    </li>
                                    <li class="text-muted">
                                        <p class="text-muted fw-bold mb-1">Date :
                                            <span class="fw-normal text-sm">
                                                {{$order->created_at->toDayDateTimeString();}}
                                            </span>
                                        </p>
                                    </li>
                                    <li class="text-muted">
                                        <p class="text-muted fw-bold">Status :
                                            <span class="fw-normal
                                                    {{($order->order_status == 'Pending')?  'text-warning' : ''}}
                                                    {{($order->order_status == 'Processing')?  'text-primary' : ''}}
                                                    {{($order->order_status == 'Delivered')?  'text-success' : ''}}
                                                    {{($order->order_status == 'Canceled')?  'text-danger' : ''}}
                                                ">
                                                {{$order->order_status}}
                                            </span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table ">
                                <thead class="text-white bg-danger">
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col" class="text-start">PRODUCTS</th>
                                        <th scope="col">SIZE</th>
                                        <th scope="col">QUANTITY</th>
                                        <th scope="col">ITEM PRICE</th>
                                        <th scope="col">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalAmount = 0;
                                    @endphp
                                    @foreach ($orderDetails as $orderDetail)
                                        <tr class="text-center">
                                            <th scope="row">{{$count++}}</th>
                                            <td class="text-start">
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
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-9">
                                <p class=" fs-6 fw-bold mb-1 text-muted">PAYMENT METHOD</p>
                                <p class=" fs-5 mb-1 text-muted">{{$order->payment_method}}</p>
                            </div>
                            <div class="col-xl-3">
                                <ul class="list-unstyled">
                                    <li class="text-muted ">
                                        <p class="text-muted mb-1">SubTotal :
                                            <span class="fw-normal">$ {{number_format($totalAmount, 2)}}</span>
                                        </p>
                                    </li>
                                     <li class="text-muted ">
                                        <p class="text-muted  mb-1">Delivery Fee :
                                            <span class="fw-normal">$ {{$order->delivery_fee}}</span>
                                        </p>
                                    </li>
                                    <li class="text-muted ">
                                        <p class="text-muted  mb-1">Discount :
                                            <span class="fw-normal"> $ {{number_format($order->discount, 2)}}</span>
                                        </p>
                                    </li>

                                    <li class="text-muted ">
                                        <p class="text-muted fs-5 fw-bold mb-1">Total paid :
                                            <span class="text-danger ">
                                                @php
                                                    $totalPaid = $totalAmount + ($order->delivery_fee) - ($order->discount);
                                                @endphp
                                                $ {{number_format($totalPaid, 2)}}
                                            </span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-10 text-danger">
                                <p>Thanks for your purchase !</p>
                            </div>
                        </div>
                    </div>
                    <!------------------End  Invoice ------------------------>
                </div>
            </div>
        </form>
    </div>
    <!----------- For Click to print page ----------->
     <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
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