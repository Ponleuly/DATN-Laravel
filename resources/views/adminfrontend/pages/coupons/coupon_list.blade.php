<?php
	use App\Models\Categories_Groups;
	use App\Models\Products_Attributes;
	use App\Models\Categories_Subcategories;
    use Illuminate\Support\Carbon;

?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
                <!--------------- Alert ------------------------>
                @include('adminfrontend.pages.alert')
                <!---------------End Alert ------------------------>
            </div>

            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                        <div class="col-md-6">
                            <div class="left">
                                <h4 class="text-medium mb-20 text-primary">Coupons List</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row justify-content-end">
                                    <div class="col-md-3 mb-2 ">
                                        <a
                                            class="btn btn-outline-primary shadow rounded-1 py-1"
                                            href="{{url('admin/coupon-add')}}"
                                            role="button">
                                            <p class="text-sm">Add Coupon</p>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <form  action="{{url('admin/coupon-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_coupon"
                                                    class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                                    placeholder="Enter campaign name here..."
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
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Start Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">End Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Campaign Name</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Code</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Percentage</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Value</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Status</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td style="width: 125px">
                                            <p class="text-sm">{{date('M d, Y', strtotime($coupon->start_date));}}</p>
                                        </td>
                                        <td style="width: 125px">
                                            <p class="text-sm">{{date('M d, Y', strtotime($coupon->end_date));}}</p>
                                        </td>
                                        <td><p class="text-sm text-start">{{$coupon->campaign_name}}</p></td>
                                        <td><p class="text-sm">{{$coupon->code}}</p></td>
                                        <td><p class="text-sm">{{$coupon->discount_percentage}} %</p></td>
                                        <td><p class="text-sm">{{$coupon->discount_value}} $</p></td>
                                        <td>
                                            @php
                                            /*
                                                $start = date('M d, Y', strtotime($coupon->start_date));
                                                $end = date('M d, Y', strtotime($coupon->end_date));
                                                $current = Carbon::now();
                                                if($current->gt($start) && $current->gt($end)){
                                                    $status = 0; //expired
                                                }elseif($current->gte($start) && $current->lt($end)){
                                                     $status = 1; //active
                                                 }elseif($current->lt($start) && $current->lt($end)){
                                                    $status = 2; //future
                                                }
                                            */
                                            @endphp
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-2
                                                    {{($coupon->coupon_status == 0)?  'btn-danger' : ''}}
                                                    {{($coupon->coupon_status == 1)?  'btn-success' : ''}}
                                                    {{($coupon->coupon_status == 2)?  'btn-warning' : ''}}
                                                    "
                                                    style="width: 90px"
                                                >
                                                @if($coupon->coupon_status == 0)
                                                <i class="bi bi-exclamation-circle-fill pe-2"></i>Expired
                                                @elseif($coupon->coupon_status == 1)
                                                <i class="bi bi-check-circle-fill pe-2"></i>Active
                                                @elseif($coupon->coupon_status == 2)
                                                <i class="bi bi-clock-fill pe-2"></i>Future
                                                @endif
                                            </button>
                                        </td>
                                        <td style="width:125px">
                                            <a
                                                class="btn btn-outline-primary btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/coupon-view/'.$coupon->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details"
                                                >
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a
                                                class="btn btn-outline-success btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/coupon-edit/'.$coupon->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Product"
                                                >
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a
                                                class="btn btn-outline-danger btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/coupon-delete/'.$coupon->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Product"
                                                >
                                                <i class="bi bi-trash3-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            @if($search_text == '')
                                <!--- To show data by pagination --->
                                {{$coupons->links()}}
                                @else
                                    <div class="d-flex">
                                        <a
                                            class="btn btn-outline-danger rounded-0 mt-2"
                                             href="{{url('admin/coupon-list')}}"
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
@endsection()