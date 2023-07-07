<?php
	use App\Models\Products_Attributes;
	use App\Models\Orders_Details;
	use App\Models\Products;
	use App\Models\Invoices;
	use App\Models\Orders_Statuses;
	use App\Models\Customers;
?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
                <!--------------- Alert ------------------------>
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
                <!---------------End Alert ------------------------>
            </div>
            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-medium mb-20">Orders List</h4>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <form  action="{{url('admin/order-search/show='.(($res>20)? 'all':$res).'/by-'.$title.'='.$sort)}}">
                                    <div class="input-group input-group-sm w-100 ">
                                        <input
                                            type="text"
                                            name="search_order"
                                            class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                            placeholder="Enter order code here..."
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default"
                                            value="{{$search_text}}"
                                        >
                                        <button
                                            class="btn btn-outline-primary btn-sm rounded-1 rounded-start-0 text-sm"
                                            type="submit"
                                            id="search"
                                            >
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="d-flex flex-row align-items-baseline" style="min-width:200px">
                                    <p class="text-sm pe-2">Show </p>
                                    <select class="form-select form-select-sm"
                                            style="width:65px"
                                            aria-label="Default select example"
                                            id="showResult"
                                        >
                                        <option value ="{{url('admin/order-list/show=5/by-'. $title.'='.$sort)}}"
                                            {{($title == 5)? 'selected':''}}>5
                                        </option>
                                        <option value ="{{url('admin/order-list/show=10/by-'.$title.'='.$sort)}}"
                                            {{($res==10)? 'selected':''}}>10
                                        </option>
                                        <option value ="{{url('admin/order-list/show=20/by-'.$title.'='.$sort)}}"
                                            {{($res==20)? 'selected':''}}>20
                                        </option>
                                        <option value ="{{url('admin/order-list/show=all/by-'.$title.'='.$sort)}}"
                                            {{Request::is('admin/order-list/show=all/*')? 'selected':''}}
                                            >All
                                        </option>
                                    </select>
                                    <p class="text-sm px-2">entries </p>
                                </div>
                                @if($search_text!='')
                                    <p class="text-md mt-2">Found
                                        <strong class="text-danger">{{$orders->count()}}</strong> orders for your search:
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex flex-row align-items-baseline justify-content-end">
                                            <p class="text-sm pe-2">Sort by</p>
                                            <input
                                                type="date"
                                                name="sort_day"
                                                class="form-control form-control-sm rounded-1 text-sm"
                                                placeholder="Order date"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default"
                                                style="width: 140px"
                                                onchange="sortDay(event)"
                                                value ="{{($sort == '')? '':$sort}}"
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-row align-items-baseline justify-content-end">
                                            <p class="text-sm pe-2">Sort by</p>
                                            <select class="form-select form-select-sm"
                                                    aria-label="Default select example"
                                                    style="width: 140px"
                                                    id="sortStatus"
                                            >
                                                <option selected disabled>Order status</option>
                                                <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=pending')}}"
                                                    {{($sort == 'pending')? 'selected':''}}>Pending
                                                </option>
                                                <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=processing')}}"
                                                    {{($sort == 'processing')? 'selected':''}}>Processing
                                                </option>
                                                <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=delivered')}}"
                                                    {{($sort == 'delivered')? 'selected':''}}>Delivered
                                                </option>
                                                <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=canceled')}}"
                                                    {{($sort == 'canceled')? 'selected':''}}>Canceled
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--
                        <div class="col-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Orders List</h4>
                                <div class="row align-items-baseline">
                                    <div class="col-3 d-flex flex-row align-items-baseline" style="min-width:200px">
                                        <p class="text-sm pe-2">Show </p>
                                        <select class="form-select form-select-sm"
                                                style="width:65px"
                                                aria-label="Default select example"
                                                id="showResult"
                                            >
                                            <option value ="{{url('admin/order-list/show=5/by-'. $title.'='.$sort)}}"
                                                {{($title == 5)? 'selected':''}}>5
                                            </option>
                                            <option value ="{{url('admin/order-list/show=10/by-'.$title.'='.$sort)}}"
                                                {{($res==10)? 'selected':''}}>10
                                            </option>
                                            <option value ="{{url('admin/order-list/show=20/by-'.$title.'='.$sort)}}"
                                                {{($res==20)? 'selected':''}}>20
                                            </option>
                                            <option value ="{{url('admin/order-list/show=all/by-'.$title.'='.$sort)}}"
                                                {{Request::is('admin/order-list/show=all/*')? 'selected':''}}
                                                >All
                                            </option>
                                        </select>
                                        <p class="text-sm px-2">entries </p>
                                    </div>
                                    <div class="col-7 d-flex flex-row align-items-baseline justify-content-end">
                                        <p class="text-sm pe-2">Sort by</p>
                                        <select class="form-select form-select-sm"
                                                aria-label="Default select example"
                                                style="width: 140px"
                                                id="sortStatus"
                                            >
                                            <option selected disabled>Order status</option>
                                            <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=pending')}}"
                                                {{($sort == 'pending')? 'selected':''}}>Pending
                                            </option>
                                            <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=processing')}}"
                                                {{($sort == 'processing')? 'selected':''}}>Processing
                                            </option>
                                            <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=delivered')}}"
                                                {{($sort == 'delivered')? 'selected':''}}>Delivered
                                            </option>
                                            <option value ="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-status=canceled')}}"
                                                {{($sort == 'canceled')? 'selected':''}}>Canceled
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @if($search_text!='')
                                    <p class="text-md mt-2">Found
                                        <strong class="text-danger">{{$orders->count()}}</strong> orders for your search:
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <div class="right">
                                <form  action="{{url('admin/order-search/show='.(($res>20)? 'all':$res).'/by-'.$title.'='.$sort)}}">
                                    <div class="input-group input-group-sm w-100 ">
                                        <input
                                            type="text"
                                            name="search_order"
                                            class="form-control rounded-0 text-sm"
                                            placeholder="Enter order code here..."
                                            aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default"
                                            value="{{$search_text}}"
                                        >
                                        <button
                                            class="btn btn-outline-primary rounded-0 text-sm"
                                            type="submit"
                                            id="search"
                                            >
                                            Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    -->
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover" id="sampleTable">
                            <thead>
                                <tr>
                                    <th><h6 class="text-medium">#</h6></th>
                                    <th class="min-width text-start">
                                        <a
                                            href="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-code='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium">Code</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/order-list/show=*/by-code*')? 'text-danger':''}}"
                                                >
                                                @if($title=='code' && $sort=='asc')
                                                    <i class="bi bi-sort-numeric-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='code' && $sort=='desc')
                                                    <i class="bi bi-sort-numeric-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width"><h6 class="text-medium">
                                        <a
                                            href="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-date='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium">Order Date</h6>
                                            <span class="text-black-50 ms-5
                                                {{Request::is('admin/order-list/show=*/by-date*')? 'text-danger':''}}"
                                                >
                                                @if($title=='date' && $sort=='asc')
                                                    <i class="bi bi-sort-numeric-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='date' && $sort=='desc')
                                                    <i class="bi bi-sort-numeric-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width"><h6 class="text-medium">
                                        <a
                                            href="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-customer='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium me-5">Customer</h6>
                                            <span class="text-black-50 ms-5
                                                {{Request::is('admin/order-list/show=*/by-customer*')? 'text-danger':''}}">
                                                @if($title=='customer' && $sort=='asc')
                                                    <i class="bi bi-sort-alpha-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='customer' && $sort=='desc')
                                                    <i class="bi bi-sort-alpha-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <!--<th class="min-width"><h6 class="text-medium">Phone</h6></th>-->
                                    <th class="min-width"><h6 class="text-medium">
                                        <a
                                            href="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-payment='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium me-3">Payment</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/order-list/show=*/by-payment*')? 'text-danger':''}}">
                                                @if($title=='payment' && $sort=='asc')
                                                    <i class="bi bi-sort-alpha-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='payment' && $sort=='desc')
                                                    <i class="bi bi-sort-alpha-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width ">
                                        <a
                                            href="{{url('admin/order-list/show='.(($res>20)? 'all':$res).'/by-totalpaid='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium">Total</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/order-list/show=*/by-totalpaid*')? 'text-danger':''}}">
                                                @if($title=='totalpaid' && $sort=='asc')
                                                    <i class="bi bi-sort-numeric-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='totalpaid' && $sort=='desc')
                                                    <i class="bi bi-sort-numeric-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width text-center"><h6 class="text-medium">Status</h6></th>
                                    <th class="min-width text-center"><h6 class="text-medium">Action</h6></th>
                                    <th class="min-width"><h6 class="text-medium">Invoice</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        $deliveryFee = $order->delivery_fee;
                                        $discount = $order->discount;

                                        $totalAmount = 0;
                                        $total = 0;
                                        $orderDetails = Orders_Details::where('order_id', $order->id)->get();
                                        foreach ($orderDetails as  $orderDetail) {
                                            $price = $orderDetail->product_price;
                                            $qty = $orderDetail->product_quantity;
                                            $totalAmount += $price * $qty;
                                        }
                                        $total = $totalAmount + $deliveryFee - $discount;
                                         // Get delivery statuses
                                    @endphp
                                    <tr>
                                        <td>
                                            <p class="text-sm">
                                                <!--
                                                    $loop->index is index of items per page,
                                                    Ex.currentPage=1, perPage=5 => index=[0,1,2,3,4]
                                                    Ex.currentPage=2, perPage=5 => index=[0,1,2,3,4]
                                                    // number of index depend on perPage and not change although currentPage is changed
                                                    Ex.currentPage=1, perPage=10 => index=[0,1,2,3,4,....9]
                                                -->
                                                @if($search_text == '')
                                                    {{($orders->currentPage()-1) * $orders->perPage() + $loop->index + 1}}
                                                    @else
                                                        {{$count++}}
                                                @endif
                                            </p>
                                        </td>
                                        <td><p class="text-sm">{{$order->invoice_code}}</p></td>
                                        <td><p class="text-sm">{{date('Y-m-d  H:i', strtotime($order->created_at))}}</p></td>
                                        <td><p class="text-sm">{{$order->rela_customer_order->c_name}}</p></td>
                                        <!--<td><p class="text-sm">{{$order->rela_customer_order->c_phone}}</p></td>-->
                                        <td><p class="text-sm"> {{$order->payment_method}}</p></td>

                                        <td><p class="text-sm">$ {{number_format($total, 2)}}</p></td>
                                        <td class="text-center">
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-2
                                                    {{($order->order_status == 'Pending')?  'btn-warning' : ''}}
                                                    {{($order->order_status == 'Processing')?  'btn-primary' : ''}}
                                                    {{($order->order_status == 'Delivered')?  'btn-success' : ''}}
                                                    {{($order->order_status == 'Canceled')?  'btn-danger' : ''}}
                                                "
                                                style="width: 90px;"
                                                >
                                                {{$order->order_status}}
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <select
                                                class="form-select form-select-sm"
                                                aria-label="Default select example"
                                                id="orderStatus"
                                                name="orderStatus"
                                                {{($order->order_status == 'Canceled')? 'disabled': ''}}
                                                >
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/pending')}}"
                                                    {{($order->order_status == 'Pending')? 'selected': ''}}
                                                    >
                                                    Pending
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/processing')}}"
                                                    {{($order->order_status == 'Processing')? 'selected': ''}}
                                                    >
                                                    Processing
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/delivered')}}"
                                                    {{($order->order_status == 'Delivered')? 'selected': ''}}
                                                    >
                                                    Delivered
                                                </option>
                                                <option
                                                    value ="{{url('admin/order-status-action/'.$order->id .'/canceled')}}"
                                                    {{($order->order_status == 'Canceled')? 'selected': ''}}
                                                    >
                                                   Canceled
                                                </option>
                                            </select>
                                        </td>
                                        <td style="width:100px">
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 view-btn"
                                                href="{{url('admin/order-details/'. $order->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">visibility</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                 href="{{url('/admin/order-delete/'.$order->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Order"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            @if($search_text == '')
                            <p class="text-sm">
                                Showing {{($orders->currentPage()-1)* $orders->perPage()+($orders->total() ? 1:0)}}
                                to {{($orders->currentPage()-1)*$orders->perPage()+count($orders)}}
                                of {{$orders->total()}}  results
                            </p>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end">
                                @if($search_text == '')
                                    <!--- To show data by pagination --->
                                    {{$orders->links()}}</span>

                                    @else
                                        <div class="d-flex">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-2"
                                                href="{{url('admin/order-list/show=10/by-code=desc')}}"
                                                role="button"
                                                >
                                                <p class="text-sm">Back to List</p>
                                            </a>
                                        </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // Get "id" of select option, if there are only one select
        $('#showResult').on('change', function () { // bind change event to select
            var url_show_page = $(this).val(); // get selected value
            if (url_show_page != '') { // require a url_show_page
                window.location = url_show_page; // redirect
            }
            return false;
        });
        $('#sortStatus').on('change', function () { // bind change event to select
            var url_sort_status = $(this).val(); // get selected value
            if (url_sort_status != '') { // require a url_sort_status
                window.location = url_sort_status; // redirect
            }
            return false;
        });
        // Get "name" of select opption if there is many selects like each order have 1 select(with many option)
        $("[name='orderStatus']").on('change', function () { // bind change event to select
            var url_order_status = $(this).val(); // get selected value
            if (url_order_status != '') { // require a url_order_status
                window.location = url_order_status; // redirect
            }
            return false;
        });
    </script>
    <script>
        function sortDay(event){
            var day_value = $("[name='sort_day']").val();
            //alert(day_value);
            var res = "<?php echo $res; ?>";
            if(day_value != ''){
                window.location.assign('by-day='+ day_value) ;
            }
            return false;
        }
    </script>
@endsection()