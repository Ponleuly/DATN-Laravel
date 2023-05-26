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
        <!---------------End Alert ------------------------>

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
                    @include('adminfrontend.pages.orders.invoice')
                    <!------------------End  Invoice ------------------------>
                </div>
            </div>
        </form>
    </div>
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