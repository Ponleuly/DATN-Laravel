<!------------------Start Invoice ------------------------>
<div class="p-lg-5 border bg-white" id="printableArea">
    <!------------------ Invoice header ------------------------>
    <div class="row d-flex align-items-baseline">
        <h2 class="pt-0 fw-bold text-danger text-center mb-1">{{$shopName->website_name}}</h2>
        <div class="col-xl-6">
            <ul class="list-unstyled mb-0">
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
        <!--
        <div class="col-xl-8">
            <h2 class="pt-0 text-black fw-bold text-danger mb-1">{{$shopName->website_name}}</h2>
        </div>
        -->
    </div>
    <!------------------ End Invoice header ---------------------- -->
    <hr class="border-2">

    <!------------------Invoice customer information ---------------->
    <div class="col-md-12">
        <div class="text-center">
            <p class="h4 fw-bold">INVOICE</p>
            <span class="text-muted fw-bold">{{$order->invoice_code}}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mb-2">
            <ul class="list-unstyled">
                <li><p class="fs-5 fw-semibold mb-1">CUSTOMER</p></li>
                <li>
                    <p class="text-muted fw-normal mb-1">Name :
                        <span class="fw-semibold text-dark text-sm">{{$customer->c_name}}</span>
                    </p>
                </li>
                <li>
                    <p class="text-muted fw-normal mb-1">Phone :
                        <span class="fw-semibold text-dark text-sm">{{$customer->c_phone}}</span>
                    </p>
                </li>
                <li>
                    <p class="text-muted fw-normal mb-1">Email :
                        <span class="fw-semibold text-dark text-sm">{{$customer->c_email}}</span>
                    </p>
                </li>
                <li class="col-md-8">
                    <p class="text-muted fw-normal mb-1">Address :
                        <span class="fw-semibold text-dark text-sm">{{$customer->c_address}}</span>
                    </p>
                </li>
                <li class="text-muted col-md-8">
                    <p class="text-muted fw-normal mb-1">Note :
                        <span class="fw-semibold text-dark text-sm">{{$customer->c_note}}</span>
                    </p>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="list-unstyled">
                <li>
                    <p class="fs-5 fw-semibold mb-1">ORDER</p>
                </li>
                <li>
                    <p class="fw-normal mb-1 text-muted">Code :
                        <span class="fw-semibold text-dark text-sm">{{$order->invoice_code}}</span>
                    </p>
                </li>
                <li>
                    <p class="fw-normal mb-1 text-muted">Date :
                        <span class="fw-semibold text-sm text-dark">
                            {{$order->created_at->toDayDateTimeString();}}
                        </span>
                    </p>
                </li>
                <li>
                    <p class="fw-normal text-muted">Status :
                        <span class="fw-semibold text-sm
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

    <div class="my-2 justify-content-center border rounded-2">
        <table class="table mb-5">
            <thead>
                <tr class="text-center text-sm" >
                    <th scope="col" style="border-radius: 6px;">
                        <span class="fw-semibold">#</span>
                    </th>
                    <th scope="col" class="text-start">
                        <span class="fw-semibold">Product</span>
                    </th>
                    <th scope="col">
                        <span class="fw-semibold">Color</span>
                    </th>
                    <th scope="col">
                        <span class="fw-semibold">Size</span>
                    </th>
                    <th scope="col">
                        <span class="fw-semibold">Qty</span>
                    </th>
                    <th scope="col">
                        <span class="fw-semibold">UnitPrice</span>
                    </th>
                    <th scope="col" style="border-radius: 6px;">
                        <span class="fw-semibold">Amount</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                @endphp
                @foreach ($orderDetails as $orderDetail)
                    <tr class="text-center">
                        <th scope="row">
                            <span class="fw-semibold">{{$count++}}</span>
                        </th>
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
        <div class="col-md-12">
            <!--
            <table class="table table-borderless text-end">
                <tr>
                    <td colspan="4" class="text-start">  
                        <p class=" fs-6 fw-bold mb-1 text-muted">Payment method :
                            <span class="text-danger fs-6">
                            {{$order->payment_method}}
                            </span>
                        </p>
                    </td>
                </tr>
                @if($order->payment_method == 'Credit Card')
                    <tr>
                        <td colspan="4" class="text-start">
                            <div class="d-inline-flex">
                                @if(strtolower($card->card_brand) == 'visa')
                                    <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                        <img src="/frontend/images/visa1.png" class="img-fluid rounded-start-1" alt="...">
                                    </div>
                                    @elseif(strtolower($card->card_brand) == 'mastercard')
                                    <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                        <img src="/frontend/images/mastercard.png" class="img-fluid rounded-start-1" alt="...">
                                    </div>

                                    @elseif(strtolower($card->card_brand) == 'american express')
                                    <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                        <img src="/frontend/images/amex1.png" class="img-fluid rounded-start-1" alt="...">
                                    </div>
                                    @else
                                    <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                        <img src="/frontend/images/creditcard.png" class="img-fluid rounded-start-1" alt="...">
                                    </div>
                                @endif
                                <div class="py-0 ps-1">
                                    {{ucfirst($card->card_brand)}} **** **** {{$card->card_digit}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-start">
                            <p class="card-text text-sm">Holder's name:
                                <span class="text-black">
                                    {{$card->holder_name}}
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-start">
                            <p class="card-text text-sm">Email:
                                <span class="text-black">
                                    {{$card->holder_email}}
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-start">
                            <p class="card-text text-sm">Payment ID:
                                <span class="text-black">
                                    {{$card->payment_id}}
                                </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-start">
                            <p class="card-text text-sm">Payment status:
                                <span class="text-{{($card->payment_status == 'charge.refunded')? 'danger':'success' }}">
                                    {{$card->payment_status}}
                                </span>
                            </p>
                        </td>
                    </tr>
                @endif
            </table>
            <table class="table table-borderless text-end">
                <tr>
                    <td colspan="2">Sub total :</td>
                    <td class="text-muted text-end">$ {{number_format($totalAmount, 2)}}</td>
                </tr>
                <tr>
                    <td colspan="2">Delivery fee :</td>
                    <td class="text-muted ">$ {{$order->delivery_fee}}</td>
                </tr>
                <tr>
                    <td colspan="2">Discount :</td>
                    <td class="text-muted ">$ {{number_format($order->discount, 2)}}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-muted fs-6 fw-bold">Total paid :</td>
                    <td class="fs-5 fw-bold text-danger ">
                        @php
                            $totalPaid = ($totalAmount + $order->delivery_fee) - ($order->discount);
                        @endphp
                        $ {{number_format($totalPaid, 2)}}
                    </td>
                </tr>
            </table>
            -->
            @php
                if($order->payment_method == 'Credit Card') $isCard = 1;
                else $isCard = 0;
            @endphp
            <table class="table table-borderless text-end">
                <tr>
                    <td colspan="7" class="text-start">  
                        <p class=" fs-6 fw-bold mb-1 text-muted">Payment method :
                        <span class="text-danger fs-6">
                           {{$order->payment_method}}
                        </span>
                    </p></td>
                    <td>Sub total :</td>
                    <td class="text-muted text-end">$ {{number_format($totalAmount, 2)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-start">
                        @if($isCard==1)
                        <div class="d-inline-flex">
                            @if(strtolower($card->card_brand) == 'visa')
                                <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                    <img src="/frontend/images/visa1.png" class="img-fluid rounded-start-1" alt="...">
                                </div>
                                @elseif(strtolower($card->card_brand) == 'mastercard')
                                <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                    <img src="/frontend/images/mastercard.png" class="img-fluid rounded-start-1" alt="...">
                                </div>

                                @elseif(strtolower($card->card_brand) == 'american express')
                                <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                    <img src="/frontend/images/amex1.png" class="img-fluid rounded-start-1" alt="...">
                                </div>
                                @else
                                <div style="vertical-align: middle; padding: 0px 0px 0px 0; width: 30px; height:20px">
                                    <img src="/frontend/images/creditcard.png" class="img-fluid rounded-start-1" alt="...">
                                </div>
                            @endif
                            <div class="py-0 ps-1">
                                {{ucfirst($card->card_brand)}} **** **** {{$card->card_digit}}
                            </div>
                        </div>
                        @else 
                        @endif
                    </td>
                    <td colspan="2">Delivery fee :</td>
                    <td class="text-muted ">$ {{$order->delivery_fee}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-start">
                        @if($isCard==1)
                        <p class="card-text text-sm text-muted">Holder's name:
                            <span class="text-black fw-normal text-sm" >
                                {{$card->holder_name}}
                            </span>
                        </p>
                        @else 
                        @endif
                    </td>
                    <td colspan="2">Discount :</td>
                    <td class="text-muted ">$ {{number_format($order->discount, 2)}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-start">
                        @if($isCard==1)
                        <p class="card-text text-sm text-muted">Email:
                            <span class="text-black">
                                {{$card->holder_email}}
                            </span>
                        </p>
                        @else 
                        @endif
                    </td>
                    <td colspan="2" class="text-muted fs-6 fw-bold">Total paid :</td>
                    <td class="fs-5 fw-bold text-danger ">
                        @php
                            $totalPaid = ($totalAmount + $order->delivery_fee) - ($order->discount);
                        @endphp
                        $ {{number_format($totalPaid, 2)}}
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class="text-start">
                        @if($isCard==1)
                        <p class="card-text text-sm text-muted">Payment ID:
                            <span class="text-black">
                                {{$card->payment_id}}
                            </span>
                        </p>
                        @else 
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="7" class="text-start">
                        @if($isCard==1)
                        <p class="card-text text-sm text-muted">Payment status:
                            <span class="text-{{($card->payment_status == 'charge.refunded')? 'danger':'success' }}">
                                {{$card->payment_status}}
                            </span>
                        </p>
                        @else 
                        @endif
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