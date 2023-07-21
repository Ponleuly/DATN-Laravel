<?php
	use App\Models\Products_Colors;
	use App\Models\Products_Sizes;
	use App\Models\Products_Imgreviews;

?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <!--------------- Alert ------------------------>
        @include('adminfrontend.pages.alert')
        <!---------------End Alert ------------------------>
        <div class="col-md-12 mt-15">
            <div class="card-style mb-30">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4 class="text-medium mb-20">Product Details</h4>
                    </div>
                    <div class="col-md-6">
                        <div id="carouselExampleControlsNoTouching" class="carousel slide px-1" data-bs-touch="false" data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img
                                        src="/product_img/imgcover/{{$product_view ->product_imgcover}}"
                                        class="img-fluid product-thumbnail mb-3"
                                    >
                                </div>
                                @foreach ($imgReviews as $imgreview)
                                    <div class="carousel-item ">
                                        <img
                                            src="/product_img/imgreview/{{$imgreview->product_imgreview}}"
                                            class="img-fluid product-thumbnail mb-3 "
                                        >
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" id="carousel-1">
                            <div class="carousel-inner">
                                @foreach ($imgReviews as $imgreview)
                                    <div class="carousel-item {{($loop->first)? 'active':''}}" id="carousel-item-1" data-bs-interval="2000">
                                        <div class="col-md-3 ">
                                            <img
                                                src="/product_img/imgreview/{{$imgreview->product_imgreview}}"
                                                class="img-fluid product-thumbnail px-1"
                                            >
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($allImgReviews as $allimgreview)
                                    @if($allimgreview->product_id == $product_view->id)
                                        @continue
                                    @else
                                        <div class="carousel-item " id="carousel-item-1" data-bs-interval="2000">
                                            <div class="col-md-3 ">
                                                <img
                                                    src="/product_img/imgreview/{{$allimgreview->product_imgreview}}"
                                                    class="img-fluid product-thumbnail px-1"
                                                >
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="col-12 text-center">
                            <h3 class="mb-2 text-black fw-bold">{{$product_view->product_name}}</h3>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Code :</h5>
                                    </div>
                                    <div class="col-7">
                                        <p>{{$product_view->product_code}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Color :</h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>{{$product_view->product_colorname}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Price :</h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>${{$product_view->product_price}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                 <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Sale Price :</h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>${{$product_view->product_saleprice}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Group : </h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>
                                            @foreach ($productGroups as $item)
                                                {{$item->rela_product_group->group_name}}
                                                {{($loop->last)? '':'&'}}
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Status : </h5>
                                    </div>
                                    <div class="col-7 ">
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Category : </h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>
                                            {{($productCategory)? $productCategory->rela_product_category->category_name: 'None'}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Sub Cate : </h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>
                                            {{($productCategory)? $productCategory->rela_product_subcategory->sub_category : 'None'}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                 <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Total Stock : </h5>
                                    </div>
                                    <div class="col-7">
                                        <p>{{$product_view->product_stock}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Stock Left : </h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>{{$product_view->product_stockleft}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Date : </h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>{{$product_view->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row mb-2">
                                    <div class="col-5 text-end">
                                        <h5 class="text-black text-sm mt-1">Description:</h5>
                                    </div>
                                    <div class="col-7 ">
                                        <p>{!! $product_view->product_des !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <div class="border border-1 p-3">
                                        <div class="row">
                                            <div class="col-md-2 mx-0 py-1">
                                                <div
                                                    class="py-1 text-center text-sm"
                                                    style="background: {{$product_view->product_color}}; width: 65px ;"
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
                                                <div class="col-md-2 mx-0 py-1">
                                                    <div
                                                        class="py-1 text-center text-sm"
                                                        style="background: {{$row->product_color}}; width: 65px"
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
                                                                <label class="form-check-label" for="size{{$item1->size_number}}">
                                                                    {{$item1->rela_product_size->size_number}}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="size_quantity"><p class="text-label">Qty: </p></label>
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
                            <div class="col-md-12 mt-4">
                                <div class="mb-2 d-flex justify-content-end">
                                    <a
                                        class="btn btn-outline-danger shadow rounded-1 py-1 me-2"
                                        href="{{url('admin/product-detail-list/show=10/by-name=asc')}}"
                                        role="button">
                                        <p class="text-sm">Back</p>
                                    </a>
                                    <a
                                        class="btn btn-primary shadow rounded-1 py-1"
                                        href="{{url('/admin/product-detail-edit/'.$product_view->id)}}"
                                        role="button">
                                        <p class="text-sm">Edit</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let items = document.querySelectorAll('#carousel-item-1')

            items.forEach((el) => {
                const minPerSlide = 4
                let next = el.nextElementSibling
                for (var i = 1; i < minPerSlide; i++) {
                    if (!next) {
                        // wrap carousel by using first child
                        next = items[0]
                    }
                    let cloneChild = next.cloneNode(true)
                    el.appendChild(cloneChild.children[0])
                    next = next.nextElementSibling
                }
            })
    </script>
@endsection()