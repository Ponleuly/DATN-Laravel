<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="shortcut icon"
            href="{{url('frontend/assets/images/favicon.svg')}}"
            type="image/x-icon"
        />
        <?php
			use App\Models\Settings;
		?>
		@php
			$shopName = Settings::all()->first();    
		@endphp
		<title>Admin {{$shopName->website_name}}</title>

        <!-- ========== All CSS files linkup ========= -->
        <link rel="stylesheet" href="{{url('frontend/assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{url('frontend/assets/css/lineicons.css')}}" />
        <link rel="stylesheet" href="{{url('frontend/assets/css/materialdesignicons.min.css')}}" />
        <link rel="stylesheet" href="{{url('frontend/assets/css/fullcalendar.css')}}" />
        <link rel="stylesheet" href="{{url('frontend/assets/css/fullcalendar.css')}}" />
        <link rel="stylesheet" href="{{url('frontend/assets/css/main.css')}}" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
        <!-- Tag input in sub category--->
        <link rel="stylesheet" href="{{url('frontend/assets/css/bootstrap-tagsinput.css')}}" />


    </head>
    <body>
        <!--Sidebar nav --->
        @include('adminfrontend.layouts.sidebarnav')
        <div class="overlay"></div>
        <!-- ======== sidebar-nav end =========== -->

        <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper">
            <!-- ========== header start ========== -->
            @include('adminfrontend.layouts.mainheader')
            <!-- ========== header end ========== -->

            <!-- ========== section start ========== -->
            <section class="section">
                @yield('admincontent')
            </section>
            <!-- ========== section end ========== -->
        </main>
        <!-- ======== main-wrapper end =========== -->

        <!-- ========= All Javascript files linkup ======== -->
        <script src="{{url('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('frontend/assets/js/Chart.min.js')}}"></script>
        <script src="{{url('frontend/assets/js/dynamic-pie-chart.js')}}"></script>
        <script src="{{url('frontend/assets/js/moment.min.js')}}"></script>
        <script src="{{url('frontend/assets/js/fullcalendar.js')}}"></script>
        <script src="{{url('frontend/assets/js/jvectormap.min.js')}}"></script>
        <script src="{{url('frontend/assets/js/world-merc.js')}}"></script>
        <script src="{{url('frontend/assets/js/polyfill.js')}}"></script>
        <script src="{{url('frontend/assets/js/main.js')}}"></script>
    </body>
</html>
