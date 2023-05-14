@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('admin/coupon-edit/'. $coupon->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
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

                    <h4 class="mb-2 text-black">Coupon Details</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="campaign_name">
                                            <p class="text-label">Campaign Name</p>
                                        </label>
                                        <input type="text"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="campaign_name"
                                            name="campaign_name"
                                            value="{{$coupon->campaign_name}}"
                                            placeholder="Campaign name"
                                            required
                                            disabled
                                        >
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="percentage">
                                                    <p class="text-label">Discount Percentage (%)</p>
                                                </label>
                                                <input type="number"
                                                    class="form-control rounded-0 fw-500 mb-2"
                                                    id="percentage"
                                                    name="discount_percentage"
                                                    min="0"
                                                    max="100"
                                                    value="{{$coupon->discount_percentage}}"
                                                    placeholder="Discount percentage"
                                                    required
                                                    disabled
                                                >
                                            </div>
                                            <div class="col-md-2 d-flex flex-column justify-content-center text-center">
                                                    <p class="text-label">OR</p>
                                                    <p class="text-label">(Input one)</p>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="discount_value">
                                                    <p class="text-label">Discount Value ($)</p>
                                                </label>
                                                <input type="number"
                                                    class="form-control rounded-0 fw-500 mb-2"
                                                    id="discount_value"
                                                    name="discount_value"
                                                    min="0"
                                                    max="100"
                                                    value="{{$coupon->discount_value}}"
                                                    placeholder="Discount Value"
                                                    disabled
                                                    required
                                                >
                                            </div>
                                        </div>

                                        <label for="start_date">
                                            <p class="text-label">Start Date</p>
                                        </label>
                                        <input type="datetime-local"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="start_date"
                                            name="start_date"
                                            value="{{$coupon->start_date}}"
                                            placeholder="Discount Start Date"
                                            disabled
                                            required
                                        >

                                        <label for="end_date">
                                            <p class="text-label">End Date</p>
                                        </label>
                                        <input type="datetime-local"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="end_date"
                                            name="end_date"
                                            value="{{$coupon->end_date}}"
                                            placeholder="Discount End Date"
                                            disabled
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="campaign_code">
                                            <p class="text-label">Campaign Code</p>
                                        </label>
                                        <input type="text"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="campaign_code"
                                            name="code"
                                            value="{{$coupon->code}}"
                                            placeholder="Campaign code"
                                            disabled
                                        >

                                        <label for="category_id" >
                                            <p class="text-label" >Product Category</p>
                                        </label>
                                        <select
                                            class="form-select rounded-0 mb-2 text-dark fw-500"
                                            aria-label="category_id"
                                            name="category_id"
                                            id="category_id"
                                            disabled
                                            required
                                            >
                                                <option selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}"
                                                    {{($category->id == $coupon->category_id)? 'selected':''}}
                                                    >
                                                    {{$category->category_name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        <label for="subcategory_id" >
                                            <p class="text-label" >Product Subcategory</p>
                                        </label>
                                        <select
                                            class="form-select rounded-0 mb-2"
                                            aria-label="subcategory_id"
                                            name="subcategory_id"
                                            id="subcategory_id"
                                            disabled
                                            required
                                            >
                                            <option selected disabled>None</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{$subcategory->id}}"
                                                    {{($subcategory->id == $coupon->subcategory_id)? 'selected':''}}
                                                    >
                                                    {{$subcategory->sub_category}}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="d-flex mt-3">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-3"
                                                href="{{url('/admin/coupon-list')}}"
                                                role="button"
                                                >
                                                Back to List
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
@endsection()