<?php
	use App\Models\Products_Attributes;
	use App\Models\Orders_Details;
	use App\Models\Products;
	use App\Models\Invoices;
	use App\Models\Orders_Statuses;
?>
@extends('frontend.userProfile.profile')
@section('profile_content')
<h5 class="text-black py-2">Purchase History</h5>
                            <div class=" p-3 p-lg-4 border bg-white">
                                <div class="row text-center">
                                    <div class="col-md-6">
                                        <p class="text-danger fs-5 fw-bold">
                                            {{$orderCount}} Items
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-danger fs-5 fw-bold">
                                            Total Purchase : $ {{number_format($totalPurchase, 2)}}
                                        </p>
                                     </div>
                                </div>
                                <hr>
                                <table class="table">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" class="text-start">ORDER DATE</th>
                                            <th scope="col">CODE</th>
                                            <th scope="col">TOTAL PAID</th>
                                            <th scope="col">PAYMENT</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @php
                                                $deliveryFee = $order->delivery_fee;
                                                $discount = $order->discount;
                                                $totalAmount = 0;
                                                $totalPaid = 0;
                                                $orderDetails = Orders_Details::where('order_id', $order->id)->get();
                                                foreach ($orderDetails as  $orderDetail) {
                                                    $price = $orderDetail->product_price;
                                                    $qty = $orderDetail->product_quantity;
                                                    $totalAmount += $price * $qty;
                                                }
                                                $totalPaid = $totalAmount + $deliveryFee - $discount;
                                                // Get delivery statuses
                                                $status_name = Orders_Statuses::where('id', $order->order_status)->first();
                                            @endphp
                                            <tr class="admin-table text-center">
                                                <td class="text-start">
                                                    {{$order->created_at->toDayDateTimeString()}}
                                                </td>
                                                <td>{{$order->invoice_code}}</td>
                                                <td>$ {{number_format($totalPaid, 2)}}</td>
                                                <td class="text-capitalize">
                                                    {{$order->payment_method}}
                                                </td>
                                                <td
                                                    class="text-center
                                                        {{($order->order_status == 'Pending')?  'text-warning' : ''}}
                                                        {{($order->order_status == 'Processing')?  'text-primary' : ''}}
                                                        {{($order->order_status == 'Delivered')?  'text-success' : ''}}
                                                        {{($order->order_status == 'Canceled')?  'text-danger' : ''}}
                                                    ">
                                                    {{$order->order_status}}
                                                </td>
                                                <td class="text-center">
                                                    <a
                                                        class="btn btn-info  py-1 px-2 btn-sm"
                                                        href="{{url('purchase-order-detail/'. $order->id)}}"
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
                                </div>
                            </div>
@endsection