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

        <form action="{{url('/admin/product-detail-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
                <div class="col-md-12 mt-15">
                    <div class="card-style mb-30">
                        <div class="col-12 text-center">
                            <h4 class="text-medium mb-20">Add Product</h4>
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
                                                <!--
                                                <input
                                                    class="form-control form-control-sm rounded-0 mb-2"
                                                    type="file"
                                                    id="product_imgcover"
                                                    name="product_imgcover"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                    required
                                                >
                                                -->
                                                <div class="image-upload-wrap">
                                                    <input
                                                        class="file-upload-input"
                                                        type='file'
                                                        id="product_imgcover"
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
                                                <!--
                                                <input
                                                    class="form-control form-control-sm rounded-0 mb-2"
                                                    type="file"
                                                    id="product_imgreview"
                                                    name="product_imgreview[]"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                    multiple
                                                    required
                                                >
                                                -->
                                                <div class="row" id="img-element">
                                                    <!--=========== Start Img review 1============---->
                                                    <div class="col-md-6">
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
                                                </div>
                                                <!--=========== End Img review 2============---->


                                                <div class="row mt-4 more-img">
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
                                                    <!--=========== End Img review 4============---->
                                                </div>
                                            </div>
                                        </div>
                                        <a
                                            class="btn btn-primary rounded-1 py-1 text-sm mt-4"
                                            onclick="addMoreImg()">
                                            Add more images
                                        </a>
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
                                                    class="form-select form-select-sm rounded-0 mb-2 "
                                                    aria-label="category select"
                                                    name="category_id"
                                                    id="category_id"
                                                    required
                                                    >
                                                    <option selected disabled value="">Select Category</option>
                                                    @foreach ($categories as $item2)
                                                        <option value="{{$item2->id}}">{{$item2->category_name}}</option>
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
                                                    @foreach ($subCategories as $item1)
                                                        <option value="{{$item1->id}}">{{$item1->sub_category}}</option>
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
                                            <div class="row">
                                                 @foreach ($sizes as $item1)
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
                                        </div>
                                        <!-- End Product size and quantity -->
                                        <div class="col-md-12 mt-4">
                                            <div class="mb-2 d-flex justify-content-end">
                                                <a
                                                    class="btn btn-outline-danger rounded-1 py-1 me-2"
                                                    href="{{url('admin/product-detail-list/show=10/by-name=asc')}}"
                                                    role="button">
                                                    <p class="text-sm">Back</p>
                                                </a>
                                                <button
                                                    class="btn btn-primary rounded-1 py-1 text-sm"
                                                    type="submit">Add
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
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            document.querySelector('.file-upload-input').value = '';
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
            $(".more-img").append(
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
@endsection()