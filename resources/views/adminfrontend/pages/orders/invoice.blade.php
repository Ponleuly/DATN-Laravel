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
                    <p class="text-muted mb-0">
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
    <div class="col-md-12">
        <div class="text-center">
            <p class="h4 fw-bold">INVOICE</p>
            <span class="text-muted fw-bold">{{$order->invoice_code}}</span>
        </div>
    </div>
  
    <div class="row mt-3">
        <div class="col-md-12">
            <table class="table table-borderless text-start">
                <tr>
                    <td colspan="2" class="col-8"><span class="fs-6 fw-semibold text-muted">CUSTOMER</span></td>
                    <td class="col-4"><span class="fs-6 fw-semibold text-muted">ORDER</span></td>
                </tr>
                <tr>
                    <td colspan="2" class="pb-0">
                        <span class="text-muted fw-normal">Name :
                            <span class="fw-semibold text-dark text-sm">{{$customer->c_name}}</span>
                        </span>
                    </td>
                    <td class="pb-0">
                        <span class="fw-normal text-muted">Code :
                            <span class="fw-semibold text-dark text-sm">{{$order->invoice_code}}</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="pb-0">
                        <span class="text-muted fw-normal">Phone :
                            <span class="fw-semibold text-dark text-sm">{{$customer->c_phone}}</span>
                        </span>
                    </td>
                    <td class="pb-0">
                        <span class="fw-normal text-muted">Date :
                            <span class="fw-semibold text-sm text-dark" style="font-size: 12px">
                                {{$order->created_at->toDayDateTimeString();}}
                            </span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="pb-0">
                        <span class="text-muted fw-normal">Email :
                            <span class="fw-semibold text-dark text-sm">{{$customer->c_email}}</span>
                        </span>
                    </td>
                    <td class="pb-0">
                        <span class="fw-normal text-muted">Status :
                            <span class="fw-semibold text-sm
                                    {{($order->order_status == 'Pending')?  'text-warning' : ''}}
                                    {{($order->order_status == 'Processing')?  'text-primary' : ''}}
                                    {{($order->order_status == 'Delivered')?  'text-success' : ''}}
                                    {{($order->order_status == 'Canceled')?  'text-danger' : ''}}
                                ">
                                {{$order->order_status}}
                            </span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="pb-0">
                        <span class="text-muted fw-normal">Address :
                            <span class="fw-semibold text-dark text-sm">{{$customer->c_address}}</span>
                        </span>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" class="pb-0">
                        <span class="text-muted fw-normal">Note :
                            <span class="fw-semibold text-dark text-sm">{{$customer->c_note}}</span>
                        </span>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="my-2 justify-content-center card rounded-2 p-1">
        <table class="table mb-4">
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
            @php
                if($order->payment_method == 'Credit Card') $isCard = 1;
                else $isCard = 0;
            @endphp
            <table class="table table-borderless text-end">
                <tr>
                    <td colspan="7" class="text-start">
                        <span class=" fs-6 fw-semibold text-muted">Payment method :
                        <span class="text-danger fs-6">
                           {{$order->payment_method}}
                        </span>
                    </span></td>
                    <td class="text-muted">Sub total :</td>
                    <td class="text-dark text-end">
                        <span class="fw-semibold">$ {{number_format($totalAmount, 2)}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-start py-0">
                        @if($isCard==1)
                        <div class="card-content">
                            @if(strtolower($card->card_brand) == 'visa')
                                <div class="card-img">
                                    <img src="/frontend/images/visa1.png" class="img-fluid rounded-start-1" alt="...">
                                </div>
                                @elseif(strtolower($card->card_brand) == 'mastercard')
                                <div class="card-img">
                                    <img src="/frontend/images/mastercard.png" class="img-fluid rounded-start-1" alt="...">
                                </div>

                                @elseif(strtolower($card->card_brand) == 'american express')
                                <div class="card-img">
                                    <img src="/frontend/images/amex1.png" class="img-fluid rounded-start-1" alt="...">
                                </div>
                                @else
                                <div class="card-img">
                                    <img src="/frontend/images/creditcard.png" class="img-fluid rounded-start-1" alt="...">
                                </div>
                            @endif
                            <span style="vertical-align: middle;">
                                {{ucfirst($card->card_brand)}} **** **** {{$card->card_digit}}
                            </span>
                        </div>
                        @else
                        @endif
                    </td>
                    <td colspan="2"  class="text-muted ">Delivery fee :</td>
                    <td>
                        <span class="fw-semibold text-dark">$ {{$order->delivery_fee}}</span>
                    </td>
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
                    <td colspan="2" class="text-muted ">Discount :</td>
                    <td>
                        <span class="fw-semibold text-dark">$ {{number_format($order->discount, 2)}}</span>
                    </td>
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
                    <td colspan="2" class="text-dark fs-6 fw-semibold">Total paid :</td>
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
        <div class="col-md-10 text-danger">
            <p>Thanks for your purchase !</p>
        </div>
    </div>
</div>
<!------------------End  Invoice ------------------------>