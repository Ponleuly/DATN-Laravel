<?php
	use App\Models\Products_Sizes;
	use App\Models\Products_Imgreviews;

?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
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

        <form action="{{url('/admin/product-detail-edit/'.$products->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
                <div class="col-md-12 mt-15">
                    <div class="card-style mb-30">
                        <div class="col-12 text-center">
                            <h4 class="text-medium mb-20">Edit Product</h4>
                        </div>
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
                                                    value="{{$products->product_name}}"
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
                                                    value="{{$products->product_code}}"
                                                    placeholder="product code..." required
                                                >
                                            </div>
                                        </div>

                                        <label for="product_des">
                                            <p class="text-label mt-2">Description</p>
                                        </label>
                                        <textarea
                                            class="form-control form-control-sm rounded-0 text-sm"
                                            placeholder="product description..."
                                            name="product_des"
                                            id="product_des"
                                        >{{$products->product_des}}</textarea>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="product_imgcover">
                                                    <p class="text-label mt-3">Image cover</p>
                                                </label>
                                                <div class="col-12 mt-1">
                                                    <img
                                                        src="/product_img/imgcover/{{$products->product_imgcover}}"
                                                        class="img-fluid product-thumbnail"
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label for="product_imgreview">
                                                    <p class="text-label mt-3">Images review (4 pictures)</p>
                                                </label>
                                                <div class="row mt-1">
                                                    @php
                                                        $imgreviews = Products_Imgreviews::where('product_id', $products->id)->get();
                                                    @endphp
                                                    @foreach ($imgreviews as $imgreview)
                                                        <div class="col-sm-6 mb-4">
                                                            <img
                                                            src="/product_img/imgreview/{{$imgreview->product_imgreview}}"
                                                            class="img-fluid product-thumbnail"
                                                            >
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-6">
                                                <label for="product_imgcover"><p class="text-label">Updata image cover (1 picture)</p></label>
                                                <input
                                                    class="form-control form-control-sm rounded-0 mb-2"
                                                    type="file"
                                                    id="product_imgcover"
                                                    name="product_imgcover"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                >
                                            </div>
                                            <div class="col-6">
                                                <label for="product_imgreview"><p class="text-label">Update images review (4 pictures)</p></label>
                                                <input
                                                    class="form-control form-control-sm rounded-0 mb-2"
                                                    type="file"
                                                    id="product_imgreview"
                                                    name="product_imgreview[]"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                    multiple
                                                >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <label for="product_price"><p class="text-label mt-2">Product Price ($)</p></label>
                                                <input
                                                    class="form-control form-control-sm rounded-0 fw-500 mb-2"
                                                    type="number"
                                                    min="0"
                                                    step="0.05"
                                                    name="product_price"
                                                    id="product_price"
                                                    placeholder="00.00"
                                                    value="{{$products->product_price}}"
                                                    required
                                                >
                                            </div>
                                            <div class="col-6">
                                                <label for="product_saleprice"><p class="text-label mt-2">Product Sale Price ($)</p></label>
                                                <input
                                                    class="form-control form-control-sm rounded-0 fw-500 mb-2"
                                                    type="number"
                                                    min="0"
                                                    step="0.05"
                                                    name="product_saleprice"
                                                    id="product_saleprice"
                                                    placeholder="00.00"
                                                    value="{{$products->product_saleprice}}"
                                                    required
                                                >
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group mb-2">
                                        <label for="group_id"><p class="text-label">Product group</p></label><br>
                                        @foreach ($groups as $row)
                                            <div class="form-check form-check-inline mt-1">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="{{$row->group_name}}"
                                                    value="{{$row->id}}"
                                                    name="group_id[]"
                                                    @foreach ($selected_group as $item)
                                                        {{($row->id == $item->group_id) ? 'checked' : ''}}
                                                    @endforeach
                                                >
                                                <label class="form-check-label" for="{{$row->group_name}}">{{$row->group_name}}</label>
                                            </div>
                                        @endforeach

                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <label for="category_id">
                                                    <p class="text-label">Product category</p>
                                                </label>
                                                <select
                                                    class="form-select form-select-sm rounded-0 mb-2"
                                                    aria-label="category select"
                                                    name="category_id"
                                                    id="category_id"
                                                    required
                                                    >
                                                    <option selected disabled>Select category</option>
                                                    @foreach ($categories as $item2)
                                                        <option
                                                            value="{{$item2->id}}"
                                                            {{($item2->id == $selected_category->category_id) ? 'selected' : ''}}
                                                            >
                                                            {{$item2->category_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="subcategory_id">
                                                    <p class="text-label">Product subcategory</p>
                                                </label>
                                                <select
                                                    class="form-select form-select-sm rounded-0 mb-2"
                                                    aria-label="category select"
                                                    name="subcategory_id"
                                                    id="subcategory_id"
                                                    required
                                                    >
                                                    <option selected disabled>Select subcategory</option>
                                                    @foreach ($subCategories as $item1)
                                                        <option
                                                            value="{{$item1->id}}"
                                                            {{($item1->id == $selected_category->subcategory_id) ? 'selected' : ''}}
                                                            >
                                                            {{$item1->sub_category}}
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
                                                    value="{{$products->product_color}}"
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
                                                    value="{{$products->product_colorname}}"
                                                    placeholder="color name..."
                                                    required
                                                >
                                                <!-- End Product color name-->
                                            </div>
                                        </div>

                                        <!-- Start Product size and quantity -->
                                        <label for="size"><p class="text-label mt-2">Product size and quantity</p></label><br>
                                        <div class="border border-1 p-3 mb-2">
                                            <div class="row">
                                                @foreach ($sizes as $size)
                                                    @php
                                                        $productSize = Products_Sizes::where('product_id', $products->id)
                                                                        ->where('size_id', $size->id)->get();
                                                    @endphp
                                                    <div class="col-md-4 mb-2">
                                                        <div class="border border-1 rounded-0 py-2 px-2">
                                                            <div class="row mb-1">
                                                                <div class="col-md-5">
                                                                    <label for="size"><p class="text-label">Size: </p></label>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <input
                                                                        type="checkbox"
                                                                        class="form-check-input sizeAll"
                                                                        id="size{{$size->size_number}}"
                                                                        value="{{$size->id}}"
                                                                        name="size_id[{{$size->id}}]"
                                                                        @foreach ($productSize as $item)
                                                                            {{($size->id == $item->size_id ) ? 'checked' : ''}}
                                                                        @endforeach
                                                                    >
                                                                    <label class="form-check-label fw-500" for="size{{$size->size_number}}">
                                                                        {{$size->size_number}}
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
                                                                        name="size_quantity[{{$size->id}}]"
                                                                        id="size_quantity"
                                                                        placeholder="00"
                                                                        @foreach ($productSize as $item)
                                                                            {{($size->id == $item->size_id ) ? 'value=' .$item->size_quantity : 'value=0'}}
                                                                        @endforeach
                                                                    >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="form-check mb-0">
                                                <input type="checkbox"  class="form-check-input" id="size" onclick="javascript:sizeAll(this)"/>
                                                <label class="form-check-label text-danger ms-1" for="size">Check All</label>
                                            </div>
                                        </div>
                                        <!-- End Product size and quantity -->
                                        <div class="col-md-12 mt-4">
                                            <div class="mb-2 d-flex">
                                                <a
                                                    class="btn btn-outline-danger rounded-0 py-1"
                                                    href="{{url('admin/product-detail-list/show=10/by-name=asc')}}"
                                                    role="button">
                                                    <p class="text-sm">Back to List</p>
                                                </a>
                                                <button
                                                    class="btn btn-primary rounded-0 py-1 ms-auto text-sm"
                                                    type="submit">Upddate Product
                                                </button>
                                            </div>
                                        </div>
                                        <!--formnovalidate="formnovalidate" => for textarea input with CKeditor-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#product_des' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>
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
@endsection()