<?php
	use App\Models\Products_Colors;
	use App\Models\Products_Sizes;
	use App\Models\Products_Imgreviews;

?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/product-group-add')}}" method="POST" enctype="multipart/form-data">
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

                    <h4 class="mb-2 text-black">Product Details</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">

                            <div class="col-md-4 mb-5">
                                <img src="/product_img/imgcover/{{$product_view ->product_imgcover}}" class="img-fluid product-thumbnail">
                                <div class="container px-0">
                                    <div class="row">
                                        @php
                                            $imgreviews = Products_Imgreviews::where('product_id', $product_view->id)->get();
                                        @endphp
                                        @foreach ($imgreviews as $imgreview)
                                            <div class="col-sm py-3">
                                                <img src="/product_img/imgreview/{{$imgreview->product_imgreview}}" class="img-fluid product-thumbnail">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8 px-4">
                                <div class="col-md-12 ">
                                    <h3 class="mb-2 text-black fw-bold">{{$product_view->product_name}}</h3>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Code:</h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>{{$product_view->product_code}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Price:</h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>${{$product_view->product_price}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Sale Price:</h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>${{$product_view->product_saleprice}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Description:</h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>{!! $product_view->product_des !!}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Group: </h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>
                                                @foreach ($productGroups as $item)
                                                    {{$item->rela_product_group->group_name}}
                                                    {{($loop->last)? '':'&'}}
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Category: </h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>
                                                {{($productCategory)? $productCategory->rela_product_category->category_name: 'None'}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Sub Category: </h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>
                                                {{($productCategory)? $productCategory->rela_product_subcategory->sub_category : 'None'}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Total Stock: </h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>{{$product_view->product_stock}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Stock Left: </h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>{{$stockLeft}}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Product Status: </h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-0
                                                    {{($product_view->product_status == 1)?  'btn-primary' : ''}}
                                                    {{($product_view->product_status == 2)?  'btn-success' : ''}}
                                                    {{($product_view->product_status == 3)?  'btn-danger' : ''}}
                                                    "
                                                    style="width: 65px;"
                                                >
                                                {{($product_view->product_status == 1)?  'New' : ''}}
                                                {{($product_view->product_status == 2)?  'Selling' : ''}}
                                                {{($product_view->product_status == 3)?  'Sold Out' : ''}}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <h5 class="text-black fw-bold mt-1">Date: </h5>
                                        </div>
                                        <div class="col-9 ms-0 ps-0">
                                            <p>{{$product_view->created_at->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="border border-1 p-3">
                                                <div class="row">
                                                    <div class="col-md-2 mx-0">
                                                        <div
                                                            class="py-2 text-center"
                                                            style="background: {{$product_view->product_color}};"
                                                            >
                                                            <a
                                                                href="{{url('/admin/product-detail-view/'.$product_view->product_code)}}"
                                                                style="color: {{$product_view->product_color}}"
                                                                >
                                                                {{$product_view->product_color}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @foreach ($productCode as $row)
                                                        @if($row->product_code == $product_view->product_code)
                                                            @continue
                                                            @else
                                                                <div class="col-md-2 mx-0">
                                                                    <div
                                                                        class="py-2 text-center"
                                                                        style="background: {{$row->product_color}};"
                                                                        >
                                                                        <a
                                                                            href="{{url('/admin/product-detail-view/'.$row->product_code)}}"
                                                                            style="color: {{$row->product_color}}"
                                                                            >
                                                                            {{$row->product_color}}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            @php
                                                $sizes = Products_Sizes::where('product_id', $product_view->id)->get();
                                            @endphp

                                            <div class="border border-1 p-3">
                                                <div class="row">
                                                    @foreach ($sizes as $item1)
                                                        <div class="col-md-3 ">
                                                            <div class="border border-1 py-1 px-2 my-1">
                                                                <div class="row mb-1">
                                                                    <div class="col-md-6">
                                                                        <label for="size"><p class="text-label">Size: </p></label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-check-label fw-500" for="size{{$item1->size_number}}">
                                                                            {{$item1->rela_product_size->size_number}}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="size_quantity"><p class="text-label">Quantity: </p></label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <p>{{$item1->size_quantity}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <div class="col-md-12">
                                                <div class="d-flex ">
                                                    <a class="btn btn-outline-danger rounded-0 mt-2" href="{{url('/admin/product-detail-list')}}" role="button">Back to list</a>
                                                    <a class="btn btn-primary rounded-0 ms-auto mt-2" href="{{url('/admin/product-detail-edit/'.$product_view->id)}}" role="button">Edit Product</a>
                                                </div>
                                            </div>
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
@endsection()