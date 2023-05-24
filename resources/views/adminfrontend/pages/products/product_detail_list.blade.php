<?php
	use App\Models\Products_Attributes;
	use App\Models\Products_Sizes;
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
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                        <div class="col-md-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Products List</h4>
                                <div class="row">
                                    <div class="col-2">
                                        <p>Show:</p>
                                    </div>
                                    <div class="col-2">
                                        <select
                                            class="form-select form-select-sm"
                                            aria-label="Default select example"
                                            >
                                            <option
                                                value ="5"
                                                onClick="window.location=
                                                '{{url('admin/product-detail-list/page=5')}}'"
                                                {{($page==5)? 'selected':''}}
                                                >
                                                5
                                            </option>
                                            <option
                                                value ="10"
                                                onClick="window.location =
                                                '{{url('admin/product-detail-list/page=10')}}'"
                                                {{($page==10)? 'selected':''}}

                                                >
                                                10
                                            </option>
                                            <option
                                                value ="20"
                                                onClick="window.location =
                                                '{{url('admin/product-detail-list/page=20')}}'"
                                                {{($page==20)? 'selected':''}}

                                                >
                                                20
                                            </option>
                                            <option
                                                value ="all"
                                                onClick="window.location =
                                                '{{url('admin/product-detail-list/page=all')}}'"
                                                {{Request::is('admin/product-detail-list/page=all')? 'selected':''}}
                                                >
                                                All
                                            </option>
                                        </select>
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row">
                                    <div class="col-md-3 mb-2 ">
                                        <a
                                            class="btn btn-outline-primary rounded-0 py-1"
                                            href="{{url('/admin/product-detail-add')}}"
                                            role="button">
                                            <p class="text-sm">Add Product</p>
                                        </a>
                                    </div>
                                    <div class="col-md-9 ">
                                        <form  action="{{url('admin/product-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_product"
                                                    class="form-control rounded-0 text-sm"
                                                    placeholder="Enter product name here..."
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
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Image</h6></th>
                                    <th class="min-width text-start"><h6 class="text-sm text-medium">Product Name</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Category</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Price</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Stock</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Stock Left</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Status</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Status Action</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Date</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Action</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    @php
                                        $stockLeft = 0;
                                        $groupAttribute = Products_Attributes::where('product_id', $product->id)->get();
                                        $categoryAttribute = Products_Attributes::where('product_id', $product->id)->first();
                                        $productSize = Products_Sizes::where('product_id', $product->id)->get();
                                        foreach ($productSize as $row) {
                                            $stockLeft  += $row->size_quantity;
                                        }
                                    @endphp
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td>
                                            <img
                                                src="/product_img/imgcover/{{$product->product_imgcover}}"
                                                class="img-fluid product-thumbnail product-img"
                                            >
                                        </td>
                                        <td><p class="text-sm text-start">{{$product->product_name}}</p></td>
                                        <td>
                                            <p class="text-sm">
                                                {{($categoryAttribute)? $categoryAttribute->rela_product_category->category_name: 'Deleted'}}
                                            </p>
                                        </td>
                                        <td><p class="text-sm">$ {{$product->product_saleprice}}</p></td>
                                        <td><p class="text-sm">{{$product->product_stock}}</p></td>
                                        <td><p class="text-sm">{{$stockLeft}}</p></td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-0
                                                    {{($product->product_status == 1)?  'btn-primary' : ''}}
                                                    {{($product->product_status == 2)?  'btn-success' : ''}}
                                                    {{($product->product_status == 3)?  'btn-danger' : ''}}
                                                    "
                                                    style="width: 65px;"
                                                >
                                                {{($product->product_status == 1)?  'New' : ''}}
                                                {{($product->product_status == 2)?  'Selling' : ''}}
                                                {{($product->product_status == 3)?  'Sold Out' : ''}}
                                            </button>
                                        </td>
                                        <td>
                                            <select
                                                class="form-select form-select-sm"
                                                aria-label="Default select example"
                                                >
                                                <option
                                                    value ="{{$product->product_status}}"
                                                    {{($product->product_status == 1)? 'selected': ''}}
                                                    onClick="window.location =
                                                    '{{url('admin/product-detail-status/'.$product->id .'/1')}}'"
                                                    >
                                                    New
                                                </option>
                                                <option
                                                    value ="{{$product->product_status}}"
                                                    {{($product->product_status == 2)? 'selected': ''}}
                                                    onClick="window.location =
                                                    '{{url('admin/product-detail-status/'.$product->id .'/2')}}'"
                                                    >
                                                    Selling
                                                </option>
                                                <option
                                                    value ="{{$product->product_status}}"
                                                    {{($product->product_status == 3)? 'selected': ''}}
                                                    onClick="window.location =
                                                    '{{url('admin/product-detail-status/'.$product->id .'/3')}}'"
                                                    >
                                                    Sold Out
                                                </option>
                                            </select>
                                        </td>
                                        <td><p class="text-sm">{{$product->created_at->diffForHumans()}}</p></td>
                                        <td style="width:125px">
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 view-btn"
                                                href="{{url('/admin/product-detail-view/'.$product->product_code)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">visibility</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 edit-btn"
                                                href="{{url('/admin/product-detail-edit/'.$product->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Product"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">edit</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                href="{{url('/admin/product-detail-delete/'.$product->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Product"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            @if($search_text == '')
                                <!--- To show data by pagination --->
                                {{$products->links()}}
                                @else
                                    <div class="d-flex">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-2"
                                                href="{{url('admin/product-detail-list')}}"
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