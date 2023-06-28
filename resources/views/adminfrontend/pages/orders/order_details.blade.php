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
                padding-top: 2rem;
                padding-bottom: 2rem;
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
        <!---------------End Alert ------------------------>
        <div class="row mb-10">
            <div class="col-6">
                <h4 class="text-medium">Order Details</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a
                    class="btn btn-outline-danger rounded-1 py-1 me-2 text-sm"
                    href="{{url('admin/order-list/show=10/by-code=desc')}}"
                    role="button">Back
                </a>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card-style mb-20">
                <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                    <div class="col-md-12">
                        <!--------------------\\ Start Date and Status //------------------------>
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

                                        <button
                                            onclick="printDiv('printableArea')"
                                            class="btn btn-primary rounded mx-2 order-icon"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Print Invoice"
                                            style="height: 31px"
                                            >
                                            <i class="bi bi-printer-fill"></i>
                                        </button>

                                        <a
                                            class="btn btn-danger rounded"
                                            href="{{url('admin/download-invoice/'. $order->id)}}"
                                            role="button"
                                            style="height: 31px;"
                                            >
                                            <i class="bi bi-filetype-pdf"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--------------------\\ End Date and Status //------------------------>

                        <hr class="bg-secondary border-2 border-top border-secondary">

                        <div class="row">
                            <!--------------------\\ Start Customer Info //------------------------>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="order-icon">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-10 ps-0">
                                        <h6 class="text-sm fw-bold">Customer</h6>
                                        <p class="text-sm ">Name:
                                            <span class="text-black">
                                                {{$customer->c_name}}
                                            </span>
                                        </p>
                                        <p class="text-sm ">Phone:
                                            <span class="text-black">
                                                {{$customer->c_phone}}
                                            </span>
                                        </p> <p class="text-sm ">Email:
                                            <span class="text-black">
                                                {{$customer->c_email}}
                                            </span>
                                        </p>
                                        <p class="text-sm text-primary fw-400"
                                            type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editCustomer"
                                            data-bs-whatever="@mdo">
                                            Edit info
                                        </p>
                                        <form action="{{url('admin/order-customer-edit/'.$customer->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf <!-- to make form active -->
                                            @method('PUT')
                                            <div class="modal fade" id="editCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Update customer info</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                            <div class="modal-body">
                                                                <label for="c_name"><p class="text-sm">Customer Name</p></label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control form-control-sm text-capitalize mb-2"
                                                                    id="c_name"
                                                                    name="c_name"
                                                                    value="{{$customer->c_name}}"
                                                                    placeholder="customer name..."
                                                                >

                                                                <label for="c_phone"><p class="text-sm">Customer Phone</p></label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control form-control-sm text-capitalize mb-2"
                                                                    id="c_phone"
                                                                    name="c_phone"
                                                                    value="{{$customer->c_phone}}"
                                                                    placeholder="customer phone..."
                                                                >

                                                                <label for="c_email"><p class="text-sm">Customer Email</p></label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control form-control-sm text-capitalize mb-2"
                                                                    id="c_email"
                                                                    name="c_email"
                                                                    value="{{$customer->c_email}}"
                                                                    placeholder="customer email..."
                                                                >

                                                                <label for="c_note"><p class="text-sm">Customer Notes</p></label>
                                                                <input
                                                                    type="text"
                                                                    class="form-control form-control-sm text-capitalize mb-2"
                                                                    id="c_note"
                                                                    name="c_note"
                                                                    value="{{$customer->c_note}}"
                                                                    placeholder="customer notes..."
                                                                    disabled
                                                                >
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm py-1" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary btn-sm py-1" value="submit">Save</button>
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="editAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel">Update address info</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="c_address"><p class="text-sm">Address</p></label>
                                                            <input
                                                                type="text"
                                                                class="form-control form-control-sm text-capitalize mb-2"
                                                                id="c_address"
                                                                name="c_address"
                                                                value="{{$customer->c_address}}"
                                                                placeholder="Street number, floor..."
                                                            >

                                                            <label for="c_city"><p class="text-sm">City/Province</p></label>
                                                            <input
                                                                type="text"
                                                                class="form-control form-control-sm text-capitalize mb-2"
                                                                id="c_city"
                                                                name="c_city"
                                                                value="{{$customer->c_city}}"
                                                                placeholder="City/province..."
                                                            >

                                                            <label for="c_district"><p class="text-sm">District</p></label>
                                                            <input
                                                                type="text"
                                                                class="form-control form-control-sm text-capitalize mb-2"
                                                                id="c_district"
                                                                name="c_district"
                                                                value="{{$customer->c_district}}"
                                                                placeholder="District..."
                                                            >

                                                            <label for="c_ward"><p class="text-sm">Ward</p></label>
                                                            <input
                                                                type="text"
                                                                class="form-control form-control-sm text-capitalize mb-2"
                                                                id="c_ward"
                                                                name="c_ward"
                                                                value="{{$customer->c_ward}}"
                                                                placeholder="Ward..."
                                                            >
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm py-1" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary btn-sm py-1" value="submit">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--------------------\\ End Customer Info //------------------------>

                            <!--------------------\\ Start Deliver to //------------------------>
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
                                        <p class="text-sm ">City:
                                            <span class="text-black">
                                                {{$customer->c_city}}
                                            </span>
                                        </p>
                                        <p class="text-sm ">District/Ward:
                                            <span class="text-black">
                                                {{$customer->c_district}}, {{$customer->c_ward}}
                                            </span>
                                        </p>
                                        <p class="text-sm ">Address:
                                            <span class="text-black text-sm">
                                                {{$customer->c_address}}
                                            </span>
                                        </p>
                                        <p class="text-sm text-primary fw-400"
                                            type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editAddress"
                                            data-bs-whatever="@mdo">
                                            Edit address
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--------------------\\ End Deliver to //------------------------>

                            <!--------------------\\ Start Order to //------------------------>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="order-icon">
                                            <i class="bi bi-bag-fill"></i>
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
                            <!--------------------\\ End Order to //------------------------>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8" >
                                <div class="card">
                                    <div class="card-body p-0">
                                        <!----------------------\\ Start product order table //-------------------->
                                        <div class="table-responsive" >
                                            <table class="table top-selling-table table-bordered-less">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th><h6 class="text-medium">#</h6></th>
                                                        <th class="min-width text-center"><h6 class="text-medium">Image</h6></th>
                                                        <th class="min-width text-start"><h6 class="text-medium">Product</h6></th>
                                                        <th class="min-width "><h6 class="text-medium">Size</h6></th>
                                                        <th class="min-width "><h6 class="text-medium">Qty</h6></th>
                                                        <th class="min-width "><h6 class="text-medium">Unit price</h6></th>
                                                        <th class="min-width "><h6 class="text-medium">Amount</h6></th>
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                    @php
                                                        $totalAmount = 0;
                                                        $cnt= 1;
                                                    @endphp
                                                    @foreach ($orderDetails as $orderDetail)
                                                        <tr class="text-center text-sm">
                                                            <th><p class="text-sm px-2">{{$cnt++}}</p></th>
                                                            <td class="text-center">
                                                                <img
                                                                    src="/product_img/imgcover/{{$orderDetail->rela_product_order->product_imgcover}}"
                                                                    class="img-fluid product-thumbnail order-img"
                                                                >
                                                            </td>
                                                            <td class="text-primary text-start fw-600">
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
                                                    <tr>
                                                        <td class=" border-bottom-0"></td>
                                                        <td class=" border-bottom-0"></td>
                                                        <td class=" border-bottom-0"></td>
                                                        <td class=" border-bottom-0"></td>
                                                        <!----------------------\\ Start Total Price table //-------------------->
                                                        <td colspan="3"  class=" border-bottom-0">
                                                            <table class="table table-borderless text-sm table-inside mb-0">
                                                                <tr>
                                                                    <td><p>Sub total :</p></td>
                                                                    <td class="text-end pe-2">$ {{number_format($totalAmount, 2)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Delivery fee :</p></td>
                                                                    <td class="text-end pe-2">$ {{$order->delivery_fee}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><p>Discount :</p></td>
                                                                    <td class="text-end pe-2">$ {{number_format($order->discount, 2)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-muted">Total paid :</td>
                                                                    <td class="fs-6 fw-bold text-danger text-end pe-2">
                                                                        @php
                                                                            $totalPaid = ($totalAmount + $order->delivery_fee) - ($order->discount);
                                                                        @endphp
                                                                        $ {{number_format($totalPaid, 2)}}
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <!----------------------\\ End Total Price table //-------------------->
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!----------------------\\ End product order table //-------------------->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if($order->payment_method == 'Credit Card')
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6 class="text-sm fw-bold">Payment info</h6>
                                        <div class="row g-0 d-flex align-baseline">
                                            @if(strtolower($card->card_brand) == 'visa')
                                                <div class="col-md-2"
                                                    style="vertical-align: middle; padding:10px 5px 10px 0 ;width: 50px; height:40px"
                                                    >
                                                    <img src="/frontend/images/visa1.png" class="img-fluid rounded-start-1" alt="...">
                                                </div>
                                                @elseif(strtolower($card->card_brand) == 'mastercard')
                                                <div class="col-md-2" style="vertical-align: middle; padding: 10px 5px 10px 0; width: 50px; height:40px">
                                                    <img src="/frontend/images/mastercard.png" class="img-fluid rounded-start-1" alt="...">
                                                </div>
                                                 @elseif(strtolower($card->card_brand) == 'american express')
                                                <div class="col-md-2" style="vertical-align: middle; padding: 10px 5px 10px 0; width: 50px; height:40px">
                                                    <img src="/frontend/images/amex1.png" class="img-fluid rounded-start-1" alt="...">
                                                </div>
                                                @else
                                                <div class="col-md-2" style="vertical-align: middle; padding: 10px 5px 10px 0; width: 50px; height:40px">
                                                    <img src="/frontend/images/creditcard.png" class="img-fluid rounded-start-1" alt="...">
                                                </div>
                                            @endif

                                            <div class="col-md-10" style="padding: 12px 5px">
                                                <p class="text-black text-sm">{{ucfirst($card->card_brand)}} **** **** {{$card->card_digit}}</p>
                                            </div>
                                        </div>
                                        <p class="card-text text-sm">Holder's name:
                                            <span class="text-black">
                                                {{$card->holder_name}}
                                            </span>
                                        </p>
                                        <p class="card-text text-sm">Email:
                                            <span class="text-black">
                                                {{$card->holder_email}}
                                            </span>
                                        </p>
                                        <p class="card-text text-sm">Payment ID:
                                            <span class="text-black">
                                                {{$card->payment_id}}
                                            </span>
                                        </p>
                                        <p class="card-text text-sm">Payment status:
                                            <span class="text-{{($card->payment_status == 'charge.refunded')? 'danger':'success' }}">
                                                {{$card->payment_status}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                @endif
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-sm fw-bold">Customer notes</h6>
                                        <p class="card-text text-sm text-wrap">
                                            <span class="text-black">
                                                {{$customer->c_note}}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!------------------Start Invoice ------------------------>
        @include('adminfrontend.pages.orders.invoice')
        <!------------------End  Invoice ------------------------>
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