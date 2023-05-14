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
                        <div class="col-md-6">
                            <h4 class="mb-2 text-black">Order Details</h4>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
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
                                    href="{{url('admin/order-list')}}"
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
                                    <li class="text-muted">{{$customer->c_name}}</li>
                                    <li class="text-muted">{{$customer->c_phone}}</li>
                                    <li class="text-muted">{{$customer->c_email}}</li>
                                    <li class="text-muted col-md-6">{{$customer->c_address}}</li>
                                </ul>
                            </div>
                            <div class="col-xl-3 ">
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
                                            <span class="fw-normal">
                                                {{$order->created_at->toDayDateTimeString();}}
                                            </span>
                                        </p>
                                    </li>
                                    <li class="text-muted">
                                        <p class="text-muted fw-bold">Status :
                                            <span class="fw-normal
                                                    {{($order->order_status == 1)?  'text-warning' : ''}}
                                                    {{($order->order_status == 2)?  'text-primary' : ''}}
                                                    {{($order->order_status == 3)?  'text-success' : ''}}
                                                    {{($order->order_status == 4)?  'text-danger' : ''}}
                                                ">
                                                {{$order->rela_order_status->status}}
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
@endsection()