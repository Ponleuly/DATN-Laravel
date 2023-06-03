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
                <tr class="text-center text-sm">
                    <th scope="col">#</th>
                    <th scope="col" class="text-start">PRODUCTS</th>
                    <th scope="col">COLOR</th>
                    <th scope="col">SIZE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">UNIT PRICE</th>
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
                        <td>{{$orderDetail->rela_product_order->product_colorname}}</td>
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
        <div class="col-md-9">
            <p class=" fs-6 fw-bold mb-1 text-muted">Payment method :
                <span class="text-danger fs-6">
                   {{$order->payment_method}}
                </span>
            </p>
        </div>
        <div class="col-md-3 ">
            <!--
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
                    <p class="text-muted fs-6 fw-bold mb-1">Total paid :
                        <span class="text-danger fs-5">
                            @php
                                $totalPaid = $totalAmount + ($order->delivery_fee) - ($order->discount);
                            @endphp
                            $ {{number_format($totalPaid, 2)}}
                        </span>
                    </p>
                </li>

            </ul>
            -->
            <table class="table table-borderless ">
                <tr>
                    <td>Sub total :</td>
                    <td class="text-muted text-start">$ {{number_format($totalAmount, 2)}}</td>
                </tr>
                <tr>
                    <td>Delivery fee :</td>
                    <td class="text-muted text-start">$ {{$order->delivery_fee}}</td>
                </tr>
                <tr>
                    <td>Discount :</td>
                    <td class="text-muted text-start">$ {{number_format($order->discount, 2)}}</td>
                </tr>
                <tr>
                    <td class="text-muted fs-6 fw-bold">Total paid :</td>
                    <td class="fs-5 fw-bold text-danger text-start">
                        @php
                            $totalPaid = ($totalAmount + $order->delivery_fee) - ($order->discount);
                        @endphp
                        $ {{number_format($totalPaid, 2)}}
                    </td>
                </tr>
            </table>
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