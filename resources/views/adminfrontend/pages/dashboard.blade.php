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
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-20">
            <div class="row align-items-center">
                <div class="col-md-6 mb-20">
                    <div class="title">
                        <h4 class="text-primary">Dashboard</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!--================ Box ===================-->
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30 shadow">
                    <div class="icon purple">
                        <span class="material-icons-round">add_shopping_cart</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">New Orders</h6>
                        <h3 class="text-bold mb-10">{{$newOrder}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30 shadow">
                    <div class="icon orange">
                            <span class="material-icons-round">shopping_cart</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Orders</h6>
                        <h3 class="text-bold mb-10">{{$totalOrder}}</h3>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30 shadow">
                    <div class="icon primary">
                        <span class="material-icons-round">local_mall</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Products</h6>
                        <h3 class="text-bold mb-10">{{$totalProduct}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>

            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30 shadow">
                    <div class="icon success">
                        <span class="material-icons-round">paid</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Income</h6>
                        <h3 class="text-bold mb-10">$ {{$totalIncome}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-------------------------------------------------------------------->
            {{-- <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple  bg-warning text-light">
                        <span class="material-icons-round">account_circle</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Members</h6>
                        <h3 class="text-bold mb-10">{{$totalMember}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div> --}}
            <!-- End Col -->
            {{-- <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon orange  bg-info text-light">
                        <span class="material-icons-round">groups</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Customers</h6>
                        <h3 class="text-bold mb-10">{{$totalCustomer}}</h3>
                    </div>
                </div>
            </div> --}}
            <!-- End Col -->
            {{-- <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon primary bg-danger text-light">
                        <span class="material-icons-round">contact_mail</span>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Subscribers</h6>
                        <h3 class="text-bold mb-10">{{$totalSubscriber}}</h3>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div> --}}
            {{-- <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-30">Orders List</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Order Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Code</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Customer</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Phone</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Payment</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Total</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Status</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Action</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Invoice</h6></th>
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
                                        //  // Get delivery statuses
                                        // $statuses = Orders_Statuses::orderBy('id')->get();
                                        // $status_name = Orders_Statuses::where('id', $order->order_status)->first();
                                    @endphp
                                    <tr class="text-center">
                                        <td>
                                            <p class="text-sm" >
                                                {{($orders->currentPage()-1) * $orders->perPage() + $loop->index + 1}}
                                            </p>
                                        </td>
                                        <td><p class="text-sm">{{date('Y-m-d  H:i', strtotime($order->created_at))}}</p></td>
                                        <td><p class="text-sm">{{$order->invoice_code}}</p></td>
                                        <td><p class="text-sm">{{$order->rela_customer_order->c_name}}</p></td>
                                        <td><p class="text-sm">{{$order->rela_customer_order->c_phone}}</p></td>
                                        <td><p class="text-sm"> {{$order->payment_method}}</p></td>

                                        <td><p class="text-sm">$ {{number_format($total, 2)}}</p></td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-1
                                                    {{($order->order_status == 'Pending')?  'btn-warning' : ''}}
                                                    {{($order->order_status == 'Processing')?  'btn-primary' : ''}}
                                                    {{($order->order_status == 'Delivered')?  'btn-success' : ''}}
                                                    {{($order->order_status == 'Canceled')?  'btn-danger' : ''}}
                                                "
                                                style="width: 115px;"
                                                >
                                                @if($order->order_status == 'Pending')
                                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                                @elseif($order->order_status == 'Processing')
                                                    <i class="bi bi-truck"></i>
                                                @elseif($order->order_status == 'Delivered')
                                                    <i class="bi bi-bag-check me-1"></i>
                                                @elseif($order->order_status == 'Canceled')
                                                    <i class="bi bi-x-circle me-1"></i>
                                                @endif
                                                <span class="ms-1">{{$order->order_status}}</span>
                                            </button>
                                        </td>
                                        <td>
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
                                        <td>
                                            <a
                                                class="btn btn-info py-1 px-2 btn-sm"
                                                href="{{url('admin/order-details/'. $order->id)}}"
                                                role="button"
                                                >
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <p class="text-sm">
                                Showing {{($orders->currentPage()-1)* $orders->perPage()+($orders->total() ? 1:0)}}
                                to {{($orders->currentPage()-1)*$orders->perPage()+count($orders)}}
                                of {{$orders->total()}}  results
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end">
                                 {{$orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!--================ End Box ===================-->

        <!--============== CHart ===================-->
        {{-- <div class="row pb-4 col-xl-12">
            <div class="col-md-8 ">
                <div 
                    id="dual_x_div" 
                    class="p-3 border  rounded-3 shadow" 
                    style="width: 100%; height: 500px;">
                </div>
            </div>
            <div class="col-md-4">
                <div 
                    id="piechart" 
                    class="p-2 border  rounded-3 shadow" 
                    style="width: 100%; height: 500px;">
                </div>
            </div>
        </div> --}}
        <!--==============End chart ===================-->
        <div class="row">
            <div class="col-md-8">
                <div class="p-3 border bg-white rounded-3 shadow">
                    <h5 class="text-primary pb-3 fw-semibold">Order amount and income</h5>
                    <div 
                        id="dual_x_div" 
                        class="" 
                        style="width: 100%; height: 430px;">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div 
                    id="piechart" 
                    class="p-2 border bg-white rounded-3 shadow" 
                    style="width: 100%; height: 500px;">
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php echo $order_chart?>
            ]);
            var options = {
                title: 'Order status',
                titleTextStyle:{ 
                    color: '#4A6CF7',
                    fontSize: '16',
                    bold: true,
                    },
                //is3D: true,
                chartArea:{left:30,top:40,width:'100%',height:'100%'},
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    

    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
            var data = new google.visualization.arrayToDataTable([
            ['Month', 'Amount', 'Income ($)'],
                <?php 
                    for ($i=1 ; $i<=12; $i++){
                        echo "['".$order_monthly[$i]['month']."',".$order_monthly[$i]['order'].",".$order_monthly[$i]['income']."],";
                    }
                ?>
            ]);

            var options = {
                //width: 800,
                chart: {
                    //title: 'Monthly order and income',
                    //subtitle: 'Total order = <?php echo $totalOrder?>, Total income = <?php echo $totalIncome.' $' ?>',
                },
                
                bars: 'vertical', // Required for Material Bar Charts.
                series: {
                    0: { axis: 'Amount' }, // Bind series 0 to an axis named 'distance'.
                    1: { axis: 'Income' } // Bind series 1 to an axis named 'brightness'.
                },
                axes: {
                    x: {
                    distance: {label: 'parsecs'}, // Bottom x-axis.
                    brightness: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
                    }
                }
            };
            var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
            chart.draw(data, options);
        };
    </script>
@endsection()
