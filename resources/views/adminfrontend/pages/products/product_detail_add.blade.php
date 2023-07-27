<?php
	use App\Models\Categories_Groups;
	use App\Models\Products_Attributes;
	use App\Models\Categories_Subcategories;
?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="container-fluid">
        <!--------------- Alert ------------------------>
        @include('adminfrontend.pages.alert')
       <!---------------End Alert ------------------------>

        <form action="{{url('/admin/product-detail-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
                <div class="col-md-12 mt-15">
                    <div class="card-style mb-30">
                        <div class="col-12 text-center">
                            <h4 class="text-medium mb-20 text-primary">Add Product</h4>
                        </div>
                        <!---==== Old form -====-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-8">
                                                <label for="product_name"><p class="text-label">Product Name</p></label>
                                                <input
                                                    type="text"
                                                    class="form-control form-control-sm rounded-0 fw-500 mb-2 text-capitalize"
                                                    id="product_name"
                                                    name="product_name"
                                                    placeholder="product name..."
                                                    required
                                                >
                                            </div>
                                            <div class="col-4">
                                                <label for="product_code"><p class="text-label">Product Code</p></label>
                                                <input
                                                    type="text"
                                                    class="form-control form-control-sm rounded-0 fw-500 mb-2"
                                                    id="product_code"
                                                    name="product_code"
                                                    placeholder="product code..." required
                                                >
                                            </div>
                                        </div>

                                        <label for="product_des"><p class="text-label mt-2">Description</p></label>
                                        <textarea
                                            class="form-control form-control-sm rounded-0 fw-500 text-sm"
                                            placeholder="product description..."
                                            name="product_des"
                                            id="product_des"
                                            ></textarea>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label for="product_imgcover"><p class="text-label">Image Cover</p></label>
                                                <div class="image-upload-wrap">
                                                    <input
                                                        class="file-upload-input"
                                                        type='file'
                                                        id="product-imgcover"
                                                        name="product_imgcover"
                                                        onchange="readImgCover(this);" accept="image/*"
                                                        required
                                                    />
                                                    <div class="drag-text">
                                                        <span class="display-3 thankyou-icon text-light mt-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                            </svg>
                                                        </span>
                                                        <h6>Image cover</h6>
                                                    </div>
                                                </div>
                                                <div class="file-upload-content">
                                                    <img class="file-upload-image-cover" src="#" alt="image cover" name="category_img"/>
                                                    <span
                                                        class="file-remove"
                                                        type="button"
                                                        onclick="removeImgCover()">X
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="product_imgreview"><p class="text-label mt-3">Images Review</p></label>
                                                <div class="row" id="more-img">
                                                    <!--=========== Start Img review 1============---->
                                                    <div class="col-md-6 mb-4">
                                                        <div class="image-upload-wrap-review" id="imgreview-icon-1">
                                                            <input
                                                                class="file-upload-input-review"
                                                                type='file'
                                                                id="imgreview-1"
                                                                name="product_imgreview[]"
                                                                onchange="readImgReview(this);" accept="image/*"
                                                                required
                                                            />
                                                            <div class="drag-text-review">
                                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                    </svg>
                                                                </span>
                                                                <h6>Image review 1</h6>
                                                            </div>
                                                        </div>

                                                        <div class="file-upload-content-review" id="upload-imgreview-1">
                                                            <img
                                                                class="file-upload-image-review"
                                                                src="#" alt="your image"
                                                                name="category_img"
                                                                id="showImg-1"
                                                            />
                                                            <span
                                                                class="file-remove-review"
                                                                type="button"
                                                                id="remove-1"
                                                                onclick="removeImgReview()">X
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--=========== End Img review 1============---->

                                                    <!--=========== Start Img review 2============---->
                                                    <div class="col-md-6">
                                                        <div class="image-upload-wrap-review" id="imgreview-icon-2">
                                                            <input
                                                                class="file-upload-input-review"
                                                                type='file'
                                                                id="imgreview-2"
                                                                name="product_imgreview[]"
                                                                onchange="readImgReview(this);" accept="image/*"
                                                                required
                                                            />
                                                            <div class="drag-text-review">
                                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                    </svg>
                                                                </span>
                                                                <h6>Image review 2</h6>
                                                            </div>
                                                        </div>

                                                        <div class="file-upload-content-review" id="upload-imgreview-2">
                                                            <img
                                                                class="file-upload-image-review"
                                                                src="#" alt="your image" name="category_img"
                                                                id="showImg-2"
                                                            />
                                                            <span
                                                                class="file-remove-review"
                                                                type="button"
                                                                id="remove-2"
                                                                onclick="removeImgReview()">X
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--=========== End Img review 2============---->

                                                    <!--=========== Start Img review 3============---->
                                                    <div class="col-md-6">
                                                        <div class="image-upload-wrap-review" id="imgreview-icon-3">
                                                            <input
                                                                class="file-upload-input-review"
                                                                type='file'
                                                                id="imgreview-3"
                                                                name="product_imgreview[]"
                                                                onchange="readImgReview(this);" accept="image/*"
                                                                required
                                                            />
                                                            <div class="drag-text-review">
                                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                    </svg>
                                                                </span>
                                                                <h6>Image review 3</h6>
                                                            </div>
                                                        </div>

                                                        <div class="file-upload-content-review" id="upload-imgreview-3">
                                                            <img
                                                                class="file-upload-image-review"
                                                                src="#" alt="your image"
                                                                name="category_img"
                                                                id="showImg-3"
                                                            />
                                                            <span
                                                                class="file-remove-review"
                                                                type="button"
                                                                id="remove-3"
                                                                onclick="removeImgReview()">X
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!--=========== End Img review 3============---->

                                                    <!--=========== Start Img review 4============---->
                                                    <div class="col-md-6">
                                                        <div class="image-upload-wrap-review" id="imgreview-icon-4">
                                                            <input
                                                                class="file-upload-input-review"
                                                                type='file'
                                                                id="imgreview-4"
                                                                name="product_imgreview[]"
                                                                onchange="readImgReview(this);" accept="image/*"
                                                                required
                                                            />
                                                            <div class="drag-text-review">
                                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                    </svg>
                                                                </span>
                                                                <h6>Image review 4</h6>
                                                            </div>
                                                        </div>

                                                        <div class="file-upload-content-review" id="upload-imgreview-4">
                                                            <img
                                                                class="file-upload-image-review"
                                                                src="#" alt="your image"
                                                                name="category_img"
                                                                id="showImg-4"
                                                            />
                                                            <span
                                                                class="file-remove-review"
                                                                type="button"
                                                                id="remove-4"
                                                                onclick="removeImgReview()">X
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-4">
                                                        <div class="image-upload-wrap-review-more" onclick="addMoreImg()">
                                                            <div class="drag-text-review-more">
                                                                <span class="display-3 thankyou-icon text-light mt-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                    </svg>
                                                                </span>
                                                                <h6>Add more images</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--=========== End Img review 4============---->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group mb-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="product_price"><p class="text-label">Product Price ($)</p></label>
                                                <input
                                                    class="form-control form-control-sm rounded-0 fw-500 mb-2"
                                                    type="number"
                                                    min="0"
                                                    step="0.05"
                                                    name="product_price"
                                                    id="product_price"
                                                    placeholder="00.00"
                                                    required
                                                >
                                            </div>
                                            <div class="col-6">
                                                <label for="product_saleprice"><p class="text-label">Product Sale Price ($)</p></label>
                                                <input
                                                    class="form-control form-control-sm rounded-0 fw-500 mb-2"
                                                    type="number"
                                                    min="0"
                                                    step="0.05"
                                                    name="product_saleprice"
                                                    id="product_saleprice"
                                                    placeholder="00.00"
                                                    required
                                                >
                                            </div>
                                        </div>
                                        <label for="group_id"><p class="text-label mt-2">Product Group</p></label><br>
                                        @foreach ($groups as $row)
                                            <div class="form-check form-check-inline ">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="{{$row->group_name}}"
                                                    value="{{$row->id}}"
                                                    name="group_id[]"
                                                    @if ($loop->first)
                                                        checked
                                                    @endif
                                                >
                                                <label class="form-check-label" for="{{$row->group_name}}">{{$row->group_name}}</label>
                                            </div>
                                        @endforeach
                                        <br>
                                        <div class="row mt-1">
                                            <div class="col-6">
                                                <label for="category_id" ><p class="text-label mt-2" >Product Category</p></label>
                                                <select
                                                    class="form-select form-select-sm rounded-0 mb-2"
                                                    aria-label="category select"
                                                    name="category_id"
                                                    id="category_id"
                                                    required
                                                    >
                                                    <option selected disabled value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        @php
                                                            $groups =  Categories_Groups::where('category_id', $category->id)->get();
                                                        @endphp
                                                        <option value="{{$category->id}}">
                                                            {{$category->category_name}} -- ( 
                                                            @foreach($groups as $group)
                                                                <p class="text-sm">
                                                                    {{$group->rela_category_group->group_name}}
                                                                    {{($loop->last)? '':'&'}}
                                                                </p>
                                                            @endforeach
                                                            )
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="subcategory_id" ><p class="text-label mt-2" >Product Subcategory</p></label>
                                                <select
                                                    class="form-select form-select-sm rounded-0 mb-2"
                                                    aria-label="category select"
                                                    name="subcategory_id"
                                                    id="subcategory_id"
                                                    required
                                                    >
                                                    <option selected disabled value="">Select Subcategory</option>
                                                    @foreach ($subCategories as $sub)
                                                        @php
                                                            $category = Categories_Subcategories::where('id', $sub->id)->first();
                                                        @endphp
                                                        <option value="{{$sub->id}}">
                                                            {{$sub->sub_category}} -- ( 
                                                                    <p class="text-sm">
                                                                        {{$category->rela_category_subcategory->category_name}}
                                                                    </p>
                                                            )
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <!-- Start Product color hex-->
                                                <label for="product_color"><p class="text-label ">Product Color</p></label><br>
                                                <input
                                                    type="color"
                                                    class="form-control form-control-color d-flex w-100 form-control-sm rounded-0 mb-2"
                                                    id="product_color"
                                                    name="product_color"
                                                    value="#c5c5c5"
                                                    placeholder="product name..."
                                                    required
                                                >
                                                <!-- End Product color hex -->
                                            </div>
                                            <div class="col-6">
                                                <!-- Start Product color name-->
                                                <label for="product_colorname"><p class="text-label">Product Color Name</p></label><br>
                                                <input
                                                    type="text"
                                                    class="form-control form-control-sm rounded-0 fw-500 mb-2 text-capitalize"
                                                    id="product_colorname"
                                                    name="product_colorname"
                                                    placeholder="color name..."
                                                    required
                                                >
                                                <!-- End Product color name-->
                                            </div>
                                        </div>

                                        <!-- Start Product size and quantity -->
                                        <label for="size"><p class="text-label mt-2">Product Size and Quantity</p></label><br>
                                        <div class="border border-1 rounded-0 p-3 mb-2 ">
                                            <div class="row" id="size-col">
                                                @foreach ($sizes as $item1)
                                                    <div class="col-md-4 mb-2 size-col">
                                                        <div class="border border-1 rounded-0 py-2 px-2">
                                                            <div class="row mb-1">
                                                                <div class="col-md-5">
                                                                    <label for="size"><p class="text-label">Size: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-check-input sizeAll"
                                                                        id="size{{$item1->size_number}}"
                                                                        value="{{$item1->id}}"
                                                                        name="size_id[{{$item1->id}}]"
                                                                        @if ($loop->first)
                                                                            checked
                                                                        @endif
                                                                    >
                                                                    <label class="form-check-label fw-500" for="size{{$item1->size_number}}">
                                                                        {{$item1->size_number}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <label for="size_quantity"><p class="text-label">Qty: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input
                                                                        class="form-control form-control-sm rounded-0 w-100"
                                                                        type="number"
                                                                        min="0"
                                                                        name="size_quantity[{{$item1->id}}]"
                                                                        id="size_quantity"
                                                                        placeholder="00"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!---============ Add more size btn==============-->
                                                <div class="col-md-4 mb-2">
                                                    <div class="border border-1 rounded-0">
                                                        <div class="row mb-1" id="test">
                                                            <div class="col-md-12">
                                                                <div class="drag-text-add-size py-0 text-center"
                                                                    type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#addSize"
                                                                    data-bs-whatever="@mdo"
                                                                    >
                                                                    <span class="text-light pt-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width=".5em" height=".5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6 class="text-sm pt-0 pb-0"
                                                                    >Add more size</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check mb-0">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="size"
                                                    onclick="javascript:sizeAll(this)"
                                                >
                                                <label class="form-check-label text-danger ms-1" for="size">Check All</label>
                                            </div>
                                            <!--======== Success add new size message=======-->
                                            <div class="alert alert-success alert-dismissible fade show rounded-0 mt-2 " role="alert" id="sizeMessage">
                                                <span id="message"></span>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <!-- End Product size and quantity -->
                                        <div class="col-md-12 mt-4">
                                            <div class="mb-2 d-flex justify-content-end">
                                                <a
                                                    class="btn btn-outline-danger shadow rounded-1 py-1 me-2"
                                                    href="{{url('admin/product-detail-list/show=10/by-name=asc')}}"
                                                    role="button">
                                                    <p class="text-sm">Back</p>
                                                </a>
                                                <button
                                                    class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                                    type="submit">Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---==== Old form -====-->

                        <!---====== Test add multul product color ==== -->
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="row mt-2">
                                    <div class="form-group">
                                        <!-- Start Product size and quantity -->
                                        <label for="size"><p class="text-label mt-2">Product Colors</p></label><br>
                                        <div class="border border-1 rounded-0 p-3 mb-2 ">
                                            <div class="row" id="color-col">
                                                    <div class="col-md-6 mb-2 color-col">
                                                        <div class="border border-1 rounded-0 py-2 px-2">
                                                            <div class="row mb-1">
                                                                <div class="col-md-5 ">
                                                                    <label for="size"><p class="text-label">Color 1: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="row">
                                                                        <div class="col-sm-2 pe-0">
                                                                            <input
                                                                                type="checkbox"
                                                                                class="form-check-input sizeAll"
                                                                                id="color-check-1"
                                                                                value=""
                                                                                name="color_check[]"
                                                                                onclick="checkColor(event)"
                                                                                checked
                                                                            >
                                                                        </div>
                                                                        <div class="col-sm-10 d-grid">
                                                                            <label class="form-check-label" for="color-check-1">
                                                                            <input
                                                                                type="color"
                                                                                class="form-control form-control-color w-100 form-control-sm rounded-0"
                                                                                id="color-1"
                                                                                value="#c5c5c5"
                                                                                onchange="colorValue(event)"
                                                                            >
                                                                        </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="size_quantity"><p class="text-label">Name: </p></label>
                                                                </div>
                                                                <div class="col-md-8 d-flex justify-content-end">
                                                                    <input
                                                                        type="text"
                                                                        class="form-control form-control-sm w-100 rounded-0 text-sm text-capitalize"
                                                                        id="colorname"
                                                                        name="colorname[]"
                                                                        placeholder="color name"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-2 color-col">
                                                        <div class="border border-1 rounded-0 py-2 px-2">
                                                            <div class="row mb-1">
                                                                <div class="col-md-5">
                                                                    <label for="size"><p class="text-label">Color 2: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="row">
                                                                        <div class="col-sm-2 pe-0">
                                                                            <input
                                                                                type="checkbox"
                                                                                class="form-check-input sizeAll"
                                                                                id="color-check-2"
                                                                                value=""
                                                                                name="color_check[]"
                                                                                onclick="checkColor(event)"
                                                                            >
                                                                        </div>
                                                                        <div class="col-sm-10 d-grid">
                                                                            <label class="form-check-label" for="color-check-2">
                                                                            <input
                                                                                type="color"
                                                                                class="form-control form-control-color w-100 form-control-sm rounded-0"
                                                                                id="color-2"
                                                                                value="#c5c5c5"
                                                                                onchange="colorValue(event)"
                                                                            >
                                                                        </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="size_quantity"><p class="text-label">Name: </p></label>
                                                                </div>
                                                                <div class="col-md-8 d-flex justify-content-end">
                                                                    <input
                                                                        type="text"
                                                                        class="form-control form-control-sm w-100 rounded-0 text-sm text-capitalize"
                                                                        id="colorname"
                                                                        name="colorname[]"
                                                                        onchange="colorValue(event)"
                                                                        placeholder="color name"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-2 color-col">
                                                        <div class="border border-1 rounded-0 py-2 px-2">
                                                            <div class="row mb-1">
                                                                <div class="col-md-5">
                                                                    <label for="size"><p class="text-label">Color 3: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="row">
                                                                        <div class="col-sm-2 pe-0">
                                                                            <input
                                                                                type="checkbox"
                                                                                class="form-check-input sizeAll"
                                                                                id="color-check-3"
                                                                                value=""
                                                                                name="color_check[]"
                                                                                onclick="checkColor(event)"
                                                                            >
                                                                        </div>
                                                                        <div class="col-sm-10 d-grid">
                                                                            <label class="form-check-label" for="color-check-3">
                                                                            <input
                                                                                type="color"
                                                                                class="form-control form-control-color w-100 form-control-sm rounded-0"
                                                                                id="color-3"
                                                                                value="#c5c5c5"
                                                                                onchange="colorValue(event)"
                                                                            >
                                                                        </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="size_quantity"><p class="text-label">Name: </p></label>
                                                                </div>
                                                                <div class="col-md-8 d-flex justify-content-end">
                                                                    <input
                                                                        type="text"
                                                                        class="form-control form-control-sm w-100 rounded-0 text-sm text-capitalize"
                                                                        id="colorname"
                                                                        name="colorname[]"
                                                                        placeholder="color name"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <!---============ Add more color btn==============-->
                                                <div class="col-md-6 mb-2">
                                                    <div class="border border-1 rounded-0" onclick="addMoreColor()">
                                                        <div class="row mb-1">
                                                            <div class="col-md-12">
                                                                <div class="drag-text-add-size py-1 text-center"
                                                                    type="button"
                                                                    >
                                                                    <span class="text-light pt-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width=".5em" height=".5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6 class="text-sm pt-0 pb-0"
                                                                    >Add more color</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--======== Success add new size message=======-->
                                            <div class="alert alert-success alert-dismissible fade show rounded-0 mt-2 " role="alert" id="sizeMessage">
                                                <span id="message"></span>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--=========== Imgage upload ===============-->
                                <div class="form-group row mb-2" id="img-area">
                                    <div class="col-md-12" id="img-area-1">
                                        <label for="color-imgcover-1"><p class="text-primary fw-500 mt-3">Image for color 1</p></label>

                                        <div class="border border-1 rounded-0 p-3">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <div class="image-upload-wrap" id="image-upload-wrap-1">
                                                        <input
                                                            class="file-upload-input"
                                                            type='file'
                                                            id="color-imgcover-1"
                                                            name="product_imgcover[]"
                                                            onchange="readImgCover(this);" accept="image/*"
                                                            required
                                                        />
                                                        <div class="drag-text">
                                                            <span class="display-3 thankyou-icon text-light mt-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                </svg>
                                                            </span>
                                                            <h6>Image cover</h6>
                                                        </div>
                                                    </div>
                                                    <div class="file-upload-content" id="file-upload-content-1">
                                                        <img class="file-upload-image-cover" id="file-upload-image-cover-1" src="#" alt="image cover" name="category_img" />
                                                        <span
                                                            class="file-remove"
                                                            id="remove-img-cover-1"
                                                            type="button"
                                                            onclick="removeImgCover()">X
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row" id="more-img">
                                                        <!--=========== Start Img review 1============---->
                                                        <div class="col-md-6 mb-3">
                                                            <div class="image-upload-wrap-review" id="imgreview-icon-1">
                                                                <input
                                                                    class="file-upload-input-review"
                                                                    type='file'
                                                                    id="imgreview-1"
                                                                    name="product_imgreview[]"
                                                                    onchange="readImgReview(this);" accept="image/*"
                                                                    required
                                                                />
                                                                <div class="drag-text-review">
                                                                    <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6>Image review 1</h6>
                                                                </div>
                                                            </div>

                                                            <div class="file-upload-content-review" id="upload-imgreview-1">
                                                                <img
                                                                    class="file-upload-image-review"
                                                                    src="#" alt="your image"
                                                                    name="category_img"
                                                                    id="showImg-1"
                                                                />
                                                                <span
                                                                    class="file-remove-review"
                                                                    type="button"
                                                                    id="remove-1"
                                                                    onclick="removeImgReview()">X
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!--=========== End Img review 1============---->
                                                        <!--=========== Start Img review 2============---->
                                                        <div class="col-md-6">
                                                            <div class="image-upload-wrap-review" id="imgreview-icon-2">
                                                                <input
                                                                    class="file-upload-input-review"
                                                                    type='file'
                                                                    id="imgreview-2"
                                                                    name="product_imgreview[]"
                                                                    onchange="readImgReview(this);" accept="image/*"
                                                                    required
                                                                />
                                                                <div class="drag-text-review">
                                                                    <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6>Image review 2</h6>
                                                                </div>
                                                            </div>

                                                            <div class="file-upload-content-review" id="upload-imgreview-2">
                                                                <img
                                                                    class="file-upload-image-review"
                                                                    src="#" alt="your image" name="category_img"
                                                                    id="showImg-2"
                                                                />
                                                                <span
                                                                    class="file-remove-review"
                                                                    type="button"
                                                                    id="remove-2"
                                                                    onclick="removeImgReview()">X
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!--=========== End Img review 2============---->

                                                        <!--=========== Start Img review 3============---->
                                                        <div class="col-md-6">
                                                            <div class="image-upload-wrap-review" id="imgreview-icon-3">
                                                                <input
                                                                    class="file-upload-input-review"
                                                                    type='file'
                                                                    id="imgreview-3"
                                                                    name="product_imgreview[]"
                                                                    onchange="readImgReview(this);" accept="image/*"
                                                                    required
                                                                />
                                                                <div class="drag-text-review">
                                                                    <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6>Image review 3</h6>
                                                                </div>
                                                            </div>

                                                            <div class="file-upload-content-review" id="upload-imgreview-3">
                                                                <img
                                                                    class="file-upload-image-review"
                                                                    src="#" alt="your image"
                                                                    name="category_img"
                                                                    id="showImg-3"
                                                                />
                                                                <span
                                                                    class="file-remove-review"
                                                                    type="button"
                                                                    id="remove-3"
                                                                    onclick="removeImgReview()">X
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!--=========== End Img review 3============---->

                                                        <!--=========== Start Img review 4============---->
                                                        <div class="col-md-6">
                                                            <div class="image-upload-wrap-review" id="imgreview-icon-4">
                                                                <input
                                                                    class="file-upload-input-review"
                                                                    type='file'
                                                                    id="imgreview-4"
                                                                    name="product_imgreview[]"
                                                                    onchange="readImgReview(this);" accept="image/*"
                                                                    required
                                                                />
                                                                <div class="drag-text-review">
                                                                    <span class="display-3 thankyou-icon text-light mt-3 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6>Image review 4</h6>
                                                                </div>
                                                            </div>

                                                            <div class="file-upload-content-review" id="upload-imgreview-4">
                                                                <img
                                                                    class="file-upload-image-review"
                                                                    src="#" alt="your image"
                                                                    name="category_img"
                                                                    id="showImg-4"
                                                                />
                                                                <span
                                                                    class="file-remove-review"
                                                                    type="button"
                                                                    id="remove-4"
                                                                    onclick="removeImgReview()">X
                                                                </span>
                                                            </div>
                                                        </div> 

                                                        <div class="col-md-6 mt-3">
                                                            <div class="image-upload-wrap-review-more" onclick="addMoreImg()">
                                                                <div class="drag-text-review-more">
                                                                    <span class="display-3 thankyou-icon text-light mt-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6 class="text-sm">Add more images</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--=========== End Img review 4============---->
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--=========== End Imgage upload ===============-->
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group mb-2">
                                        <!-- Start Product size and quantity -->
                                        <label for="size"><p class="text-label mt-2">Product Size and Quantity</p></label><br>
                                        <div class="border border-1 rounded-0 p-3 mb-2 ">
                                            <div class="row" id="size-col">
                                                @foreach ($sizes as $item1)
                                                    <div class="col-md-4 mb-2 size-col">
                                                        <div class="border border-1 rounded-0 py-2 px-2">
                                                            <div class="row mb-1">
                                                                <div class="col-md-5">
                                                                    <label for="size"><p class="text-label">Size: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-check-input sizeAll"
                                                                        id="size{{$item1->size_number}}"
                                                                        value="{{$item1->id}}"
                                                                        name="size_id[{{$item1->id}}]"
                                                                        @if ($loop->first)
                                                                            checked
                                                                        @endif
                                                                    >
                                                                    <label class="form-check-label fw-500" for="size{{$item1->size_number}}">
                                                                        {{$item1->size_number}}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <label for="size_quantity"><p class="text-label">Qty: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input
                                                                        class="form-control form-control-sm rounded-0 w-100"
                                                                        type="number"
                                                                        min="0"
                                                                        name="size_quantity[{{$item1->id}}]"
                                                                        id="size_quantity"
                                                                        placeholder="00"
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!---============ Add more size btn==============-->
                                                <div class="col-md-4 mb-2">
                                                    <div class="border border-1 rounded-0">
                                                        <div class="row mb-1" id="test">
                                                            <div class="col-md-12">
                                                                <div class="drag-text-add-size py-0 text-center"
                                                                    type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#addSize"
                                                                    data-bs-whatever="@mdo"
                                                                    >
                                                                    <span class="text-light pt-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width=".5em" height=".5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                                        </svg>
                                                                    </span>
                                                                    <h6 class="text-sm pt-0 pb-0"
                                                                    >Add more size</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check mb-0">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="size"
                                                    onclick="javascript:sizeAll(this)"
                                                >
                                                <label class="form-check-label text-danger ms-1" for="size">Check All</label>
                                            </div>
                                            <!--======== Success add new size message=======-->
                                            <div class="alert alert-success alert-dismissible fade show rounded-0 mt-2 " role="alert" id="sizeMessage">
                                                <span id="message"></span>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <!-- End Product size and quantity -->
                                        <div class="col-md-12 mt-4">
                                            <div class="mb-2 d-flex justify-content-end">
                                                <a
                                                    class="btn btn-outline-danger shadow rounded-1 py-1 me-2"
                                                    href="{{url('admin/product-detail-list/show=10/by-name=asc')}}"
                                                    role="button">
                                                    <p class="text-sm">Back</p>
                                                </a>
                                                <button
                                                    class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                                    type="submit">Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!---====== Test add multul product color ==== -->

                    </div>
                </div>
        </form>
        <!----============ Form add more size====================-->
        <form action="{{url('admin/product-size-add')}}" enctype="multipart/form-data" method="post" id="form-add-size">
            <div class="modal fade" id="addSize" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Add Size</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <!-- Alert if size the same-->
                            <div class="alert alert-danger print-error-msg text-sm" style="display:none">
                            </div>
                            <label for="sizeNumber"><p class="text-sm">Size Number</p></label>
                            <input
                                type="text"
                                class="form-control form-control-sm text-capitalize mb-2
                                @error('size_number') is-invalid @enderror"
                                id="sizeNumber"
                                name="size_number"
                                value=""
                                placeholder="Ex. 35"
                            >

                            @error('size_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-size">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary btn-sm py-1 px-2"
                                data-bs-dismiss="modal"
                                id="close-form"
                                >Close
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary btn-sm py-1 px-2"
                                value="submit"
                                id="btn-add-size"
                                >Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!----======== Texty area with ckeditor ==========-->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#product_des' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <!----========End Texty area with ckeditor ==========-->

    <!----======== Check all box size ==========-->
    <script>
        function sizeAll(o) {
            var boxes = document.getElementsByClassName("sizeAll");
            for (var x = 0; x < boxes.length; x++) {
                var obj = boxes[x];
                if (obj.type == "checkbox") {
                if (obj.name != "check")
                    obj.checked = o.checked;
                }
            }
        }
        function colorAll(o) {
            var color = document.getElementsByClassName("colorAll");
            for (var x = 0; x < color.length; x++) {
                var obj = color[x];
                if (obj.type == "checkbox") {
                if (obj.name != "check")
                    obj.checked = o.checked;
                }
            }
        }
    </script>
    <!----========End Check all box size ==========-->

    <!----======== Preview img cover/img_review upload ==========-->
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        //================ Img Cover ======================//
        function readImgCover(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-upload-wrap').hide();
                    $('.file-upload-image-cover').attr('src', e.target.result);
                    $('.file-upload-content').show();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeImgCover();
            }
        }
        function removeImgCover() {
            $('.file-upload-content' ).hide();
            $('.image-upload-wrap').show();
            document.querySelector('#product-imgcover').value = '';
        }

        //================ Img Review 1 ======================//
        function readImgReview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imgId = input.getAttribute('id');
                    var imgReview_cnt = $('.image-upload-wrap-review').length;
                    for(var i=1; i<=imgReview_cnt; i++){
                        if(imgId == 'imgreview-'+i){
                            $('#imgreview-icon-'+i).hide();
                            $('#showImg-'+i).attr('src', e.target.result);
                            $('#upload-imgreview-'+i).show();
                        }
                    }
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeImgReview();
            }
        }
        function removeImgReview() {
            var imgReview_cnt = $('.image-upload-wrap-review').length;
            var removeID = event.target.id;
            for(var i=1; i<=imgReview_cnt; i++){
                if(removeID == 'remove-'+i){
                    $('#upload-imgreview-'+i).hide();
                    $('#imgreview-icon-'+i).show();
                    document.querySelector('#imgreview-'+i).value = '';
                }
            }
        }

        function addMoreImg(){
            var imgReview_cnt = $('.image-upload-wrap-review').length;
            //alert(cnt);
            var i = imgReview_cnt;
            ++i;
            $("#more-img .col-md-6:last").before(
                ` <div class="col-md-6 mt-4">
                    <div class="image-upload-wrap-review" id="imgreview-icon-${i}">
                        <input
                            class="file-upload-input-review"
                            type='file'
                            id="imgreview-${i}"
                            name="product_imgreview[]"
                            onchange="readImgReview(this);" accept="image/*"
                        />
                        <div class="drag-text-review">
                            <span class="display-3 thankyou-icon text-light mt-3 ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                </svg>
                            </span>
                            <h6>Image review ${i}</h6>
                        </div>
                    </div>

                    <div class="file-upload-content-review" id="upload-imgreview-${i}">
                        <img
                            class="file-upload-image-review"
                            src="#" alt="your image"
                            name="category_img"
                            id="showImg-${i}"
                        />
                        <span
                            class="file-remove-review"
                            type="button"
                            id="remove-${i}"
                            onclick="removeImgReview()">X
                        </span>
                    </div>
                </div>`);
        }

    </script>
    <!----========End Preview img cover/img_review upload ==========-->

    <!----======== Add more size to page and dbbase with ajax ==========-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#sizeMessage").hide();
        var size_col_cnt = $('.size-col').length;
        var i = size_col_cnt;
        ++i;
        $("#btn-add-size").click(function(e){
            e.preventDefault();
            var sizeNumber = $("#sizeNumber").val();

            $.ajax({
            type:'POST',
            url:"{{ url('/admin/product-size-add') }}",
            data: {size_number:sizeNumber},
            success:function(data){
                    if($.isEmptyObject(data.error)){
                        //alert(size_col_cnt);
                        // location.reload();
                        $('#addSize').modal('hide');
                        var sizeId = data.id;
                        var sizeNum = data.size_number;

                        $("#size-col .col-md-4:last").before(
                            `
                            <div class="col-md-4 mb-2 size-col">
                                <div class="border border-1 rounded-0 py-2 px-2">
                                    <div class="row mb-1">
                                        <div class="col-md-5">
                                            <label for="size"><p class="text-label">Size: </p></label>
                                        </div>
                                        <div class="col-md-7">
                                            <input
                                                type="checkbox"
                                                class="form-check-input sizeAll"
                                                id="size${sizeId}"
                                                value="${sizeId}"
                                                name="size_id[${sizeId}]"

                                            >
                                            <label class="form-check-label fw-500" for="size${sizeId}">
                                                ${sizeNum}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="size_quantity"><p class="text-label">Qty: </p></label>
                                        </div>
                                        <div class="col-md-7">
                                            <input
                                                class="form-control form-control-sm rounded-0 w-100"
                                                type="number"
                                                min="0"
                                                name="size_quantity[${sizeId}]"
                                                id="size_quantity"
                                                placeholder="00"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `
                        );
                        $("#sizeMessage").show();
                        $('#message').html(data.message);
                    }else{
                        printErrorMsg(data.error);
                    }
                }
            });
        });
        function printErrorMsg (msg) {
            $(".print-error-msg").css('display','block');
            $(".print-error-msg").html(msg);
        }
    </script>
    <!----========End  Add more size to page and dbbase with ajax ==========-->

    <!----======== Add more color ==========-->
    {{-- <script>
        function addMoreColor(){
            var color_col_cnt = $('.color-col').length;
            var i = color_col_cnt;
            ++i;
            $("#color-col .col-md-6:last").before(
                `
                    <div class="col-md-6 mb-2 color-col">
                        <div class="border border-1 rounded-0 py-2 px-2">
                            <div class="row mb-1">
                                <div class="col-md-5">
                                    <label for="size"><p class="text-label">Color ${i}: </p></label>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-sm-2 pe-0">
                                            <input
                                                type="checkbox"
                                                class="form-check-input sizeAll"
                                                id="color-check-${i}"
                                                value=""
                                                name="color_check[]"
                                                onclick="checkColor(event)"
                                            >
                                        </div>
                                        <div class="col-sm-10 d-grid">
                                            <label class="form-check-label" for="color-1">
                                            <input
                                                type="color"
                                                class="form-control form-control-color w-100 form-control-sm rounded-0"
                                                id="color-${i}"
                                                value="#c5c5c5"
                                                onchange="colorValue(event)"
                                            >
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="size_quantity"><p class="text-label">Name: </p></label>
                                </div>
                                <div class="col-md-8 d-flex justify-content-end">
                                    <input
                                        type="text"
                                        class="form-control form-control-sm w-100 rounded-0 text-sm text-capitalize"
                                        id="colorname"
                                        name="colorname[]"
                                        placeholder="color name"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                `
            );
            //alert(i);
        }
        function colorValue(e){
            var color_col_cnt = $('.color-col').length;
            var colorId = event.currentTarget.id.slice(-1);
            //alert(color_id)
            var colorValue = $('#color-' +colorId).val();
            $('#color-check-'+colorId).val(colorValue);

            // for(var i=1 ; i<=color_col_cnt; i++){
			// 	if(color_id == 'color-'+i){
            //         var colorValue = $('#color-' +i).val();
            //         $('#color-check-'+i).val(colorValue);
            //     }else{
            //         return false;
            //     }
            // }
        }

    </script> --}}
    {{-- <script>
        function checkColor(e){
            //var x = $("input[name='color_check']");
            var checkId = event.currentTarget.id;
            var i = checkId.slice(-1);
            var output = `
                <div class="row">
                    <div class="col-md-12 img-area-${i}" id="img-area-${i}">
                        <label for="color-imgcover-${i}"><p class="text-primary fw-500 mt-3">Image for color ${i}</p></label>
                        <div class="border border-1 rounded-0 p-3">
                            <div class="col-12 mb-3">
                                <div class="image-upload-wrap" id="image-upload-wrap-${i}">
                                    <input
                                        class="file-upload-input"
                                        type='file'
                                        id="color-imgcover-${i}"
                                        name="product_imgcover[]"
                                        onchange="readImgCover(this);" accept="image/*"
                                        required
                                    />
                                    <div class="drag-text">
                                        <span class="display-3 thankyou-icon text-light mt-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                            </svg>
                                        </span>
                                        <h6>Image cover</h6>
                                    </div>
                                </div>
                                <div class="file-upload-content" id="file-upload-content-${i}">
                                    <img class="file-upload-image-cover" id="file-upload-image-cover-${i}" src="#" alt="image cover" name="category_img"/>
                                    <span
                                        class="file-remove"
                                        id="remove-img-cover-${i}"
                                        type="button"
                                        onclick="removeImgCover()">X
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="row" id="more-img">
                                    <!--=========== Start Img review 1============---->
                                    <div class="col-md-6 mb-3">
                                        <div class="image-upload-wrap-review" id="imgreview-icon-1">
                                            <input
                                                class="file-upload-input-review"
                                                type='file'
                                                id="imgreview-1"
                                                name="product_imgreview[]"
                                                onchange="readImgReview(this);" accept="image/*"
                                                required
                                            />
                                            <div class="drag-text-review">
                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                    </svg>
                                                </span>
                                                <h6>Image review 1</h6>
                                            </div>
                                        </div>

                                        <div class="file-upload-content-review" id="upload-imgreview-1">
                                            <img
                                                class="file-upload-image-review"
                                                src="#" alt="your image"
                                                name="category_img"
                                                id="showImg-1"
                                            />
                                            <span
                                                class="file-remove-review"
                                                type="button"
                                                id="remove-1"
                                                onclick="removeImgReview()">X
                                            </span>
                                        </div>
                                    </div>
                                    <!--=========== End Img review 1============---->
                                    <!--=========== Start Img review 2============---->
                                    <div class="col-md-6">
                                        <div class="image-upload-wrap-review" id="imgreview-icon-2">
                                            <input
                                                class="file-upload-input-review"
                                                type='file'
                                                id="imgreview-2"
                                                name="product_imgreview[]"
                                                onchange="readImgReview(this);" accept="image/*"
                                                required
                                            />
                                            <div class="drag-text-review">
                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                    </svg>
                                                </span>
                                                <h6>Image review 2</h6>
                                            </div>
                                        </div>

                                        <div class="file-upload-content-review" id="upload-imgreview-2">
                                            <img
                                                class="file-upload-image-review"
                                                src="#" alt="your image" name="category_img"
                                                id="showImg-2"
                                            />
                                            <span
                                                class="file-remove-review"
                                                type="button"
                                                id="remove-2"
                                                onclick="removeImgReview()">X
                                            </span>
                                        </div>
                                    </div>
                                    <!--=========== End Img review 2============---->

                                    <!--=========== Start Img review 3============---->
                                    <div class="col-md-6">
                                        <div class="image-upload-wrap-review" id="imgreview-icon-3">
                                            <input
                                                class="file-upload-input-review"
                                                type='file'
                                                id="imgreview-3"
                                                name="product_imgreview[]"
                                                onchange="readImgReview(this);" accept="image/*"
                                                required
                                            />
                                            <div class="drag-text-review">
                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                    </svg>
                                                </span>
                                                <h6>Image review 3</h6>
                                            </div>
                                        </div>

                                        <div class="file-upload-content-review" id="upload-imgreview-3">
                                            <img
                                                class="file-upload-image-review"
                                                src="#" alt="your image"
                                                name="category_img"
                                                id="showImg-3"
                                            />
                                            <span
                                                class="file-remove-review"
                                                type="button"
                                                id="remove-3"
                                                onclick="removeImgReview()">X
                                            </span>
                                        </div>
                                    </div>
                                    <!--=========== End Img review 3============---->

                                    <!--=========== Start Img review 4============---->
                                    <div class="col-md-6">
                                        <div class="image-upload-wrap-review" id="imgreview-icon-4">
                                            <input
                                                class="file-upload-input-review"
                                                type='file'
                                                id="imgreview-4"
                                                name="product_imgreview[]"
                                                onchange="readImgReview(this);" accept="image/*"
                                                required
                                            />
                                            <div class="drag-text-review">
                                                <span class="display-3 thankyou-icon text-light mt-3 ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                    </svg>
                                                </span>
                                                <h6>Image review 4</h6>
                                            </div>
                                        </div>

                                        <div class="file-upload-content-review" id="upload-imgreview-4">
                                            <img
                                                class="file-upload-image-review"
                                                src="#" alt="your image"
                                                name="category_img"
                                                id="showImg-4"
                                            />
                                            <span
                                                class="file-remove-review"
                                                type="button"
                                                id="remove-4"
                                                onclick="removeImgReview()">X
                                            </span>
                                        </div>
                                    </div> 

                                    <div class="col-md-6 mt-3">
                                        <div class="image-upload-wrap-review-more" onclick="addMoreImg()">
                                            <div class="drag-text-review-more">
                                                <span class="display-3 thankyou-icon text-light mt-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                    </svg>
                                                </span>
                                                <h6 class="text-sm">Add more images</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--=========== End Img review 4============---->
                                </div>
                            </div>
                            
                        </div>
                    </div>  
                </div>
            `;
            if($('#'+ checkId).is(':checked')){
                var lastImgAreaId = $('#img-area .col-md-12:last').prop('id').slice(-1);
                //alert(lastImgAreaId);
                if(lastImgAreaId <= i){
                    if(i==1) return false;
                    else{
                        $('#img-area .col-md-12:last').append(
                            output
                        );
                    }
                }else{
                    $('#img-area .col-md-12:last').before(
                    output
                ); 
                }
            }else{
                if(i==1){
                    return false;
                }else{
                $('#img-area-'+i).remove();

                }
            }
           //alert(x);
        }
    </script> --}}
    <!----========End Add more color ==========-->

@endsection()