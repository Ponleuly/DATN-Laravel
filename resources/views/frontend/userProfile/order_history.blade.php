<?php
	use App\Models\Products_Attributes;
	use App\Models\Orders_Details;
	use App\Models\Products;
	use App\Models\Invoices;
	use App\Models\Orders_Statuses;
	use App\Models\Settings;
	use App\Models\Contacts;
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
@extends('frontend.userProfile.profile')
@section('profile_content')
        <!------------------Start Invoice ------------------------>
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-black py-2">Order Details</h5>
            </div>
            <div class="col-md-6 text-end">
                <button
                    type="submit"
                    onclick="printDiv('printableArea')"
                    class="btn btn-outline-primary rounded-2 me-2"
                    >
                    <span class="material-icons-outlined">
                        print
                    </span>
                </button>
                <a
                    class="btn btn-danger rounded-2 ms-auto"
                    href="{{url('download-invoice/'. $order->id)}}"
                    role="button"
                    >
                    <span class="material-icons-outlined">
                        picture_as_pdf
                    </span>
                </a>
            </div>
        </div>
        <!---------------- Start Order Invoice ------------------>
        @include('adminfrontend.pages.orders.invoice')
        <!------------------End  Invoice ------------------------>
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
@endsection