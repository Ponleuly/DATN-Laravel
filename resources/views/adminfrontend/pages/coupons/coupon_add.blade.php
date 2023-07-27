@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/coupon-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-12 my-3 mb-md-0">
                    <!--------------- Alert ------------------------>
                    @include('adminfrontend.pages.alert')
                    <!---------------End Alert ------------------------>
                    <div class="card-style">
                        <h4 class="text-medium text-center mb-20 text-primary">Add Coupon</h4>
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
                                            placeholder="Ex. Chrismas discount"
                                            required
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
                                                    value="0"
                                                    min="0"
                                                    max="100"
                                                    placeholder="Ex. 15 (%)"
                                                    required
                                                >
                                            </div>
                                            <div class="col-md-2 px-0 mx-0 d-flex flex-column justify-content-center text-center">
                                                <p class="text-sm">Fill one</p>
                                                <p class="text-sm">(% or $)</p>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="discount_value">
                                                    <p class="text-label">Discount Value ($)</p>
                                                </label>
                                                <input type="number"
                                                    class="form-control rounded-0 fw-500 mb-2"
                                                    id="discount_value"
                                                    name="discount_value"
                                                    value="0"
                                                    min="0"
                                                    max="100"
                                                    placeholder="Ex. 7 ($)"
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
                                            placeholder="Discount Start Date"
                                            required
                                        >

                                        <label for="end_date">
                                            <p class="text-label">End Date</p>
                                        </label>
                                        <input type="datetime-local"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="end_date"
                                            name="end_date"
                                            placeholder="Discount End Date"
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
                                            placeholder="Ex. CS23"
                                            required
                                        >

                                        <label for="category_id" >
                                            <p class="text-label" >Product Category</p>
                                        </label>
                                        <select
                                            class="form-select rounded-0 mb-2"
                                            aria-label="category_id"
                                            name="category_id"
                                            id="category_id"
                                            required
                                            >
                                            <option selected disabled value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
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
                                            >
                                            <option selected disabled value="">None</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{$subcategory->id}}">
                                                    {{$subcategory->sub_category}}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="d-flex mt-4 justify-content-end">
                                            <a
                                                class="btn btn-outline-danger shadow rounded-1 py-1 me-2 text-sm"
                                                href="{{url('/admin/coupon-list')}}"
                                                role="button">Back
                                            </a>
                                            <button
                                                class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                                group="submit">Add
                                            </button>
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