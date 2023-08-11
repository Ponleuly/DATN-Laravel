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
        </div>
        <!--================ End Box ===================-->
    
        <!--============== Start chart ===================-->
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    {{-- First chart order amount and income --}}
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
                // chart: {
                //     title: 'Monthly order and income',
                //     subtitle: 'Total order = <?php echo $totalOrder?>, Total income = <?php echo $totalIncome.' $' ?>',
                // },
                
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

    // Second chart order status
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
@endsection()
