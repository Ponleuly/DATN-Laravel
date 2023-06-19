@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/product-category-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
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
                    <div class="card-style">
                        <h4 class="text-medium text-center">Add Category</h4>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <div class="col-md-12">
                                    <label for="category_img">
                                        <p class="text-label mt-3">Category Image</p>
                                    </label>
                                    <div class="image-upload-wrap">
                                        <input
                                            class="file-upload-input"
                                            type='file'
                                            name="category_img"
                                            onchange="readURL(this);" accept="image/*"
                                            required
                                        />
                                        <div class="drag-text">
                                            <span class="display-3 thankyou-icon text-light mt-3 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                </svg>
                                            </span>
                                            <h6>Drag and drop an image</h6>
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image-category" src="#" alt="your image" name="category_img"/>
                                        <span
                                            class="file-remove"
                                            type="button"
                                            onclick="removeUpload()">X
                                        </span>
                                    </div>

                                    <label for="category_name"><p class="text-label mt-3">Category Name</p></label>
                                    <input type="text"
                                        class="form-control rounded-0 fw-500 mb-2"
                                        id="category_name"
                                        name="category_name"
                                        placeholder="category name..."
                                        required
                                    >

                                    <label for="sub_category">
                                        <p class="text-label mt-2">
                                            Sub Category :  (Write then press enter to add new sub category)
                                        </p>
                                    </label>
                                    <input
                                        class="form-control rounded-0 fw-500 mb-2"
                                        type="text"
                                        data-role="tagsinput"
                                        name="sub_category"
                                        placeholder="sub category"
                                    >

                                    <label>
                                        <p class="text-label mt-2">
                                            Product Group
                                            @if($groups_count == 0)
                                                <span class="text-label text-danger">(Please create product group before adding category!)</span>
                                                @else
                                                <span class="text-label">(Choose product group)</span>
                                            @endif
                                        </p>
                                    </label><br>
                                    @foreach ($groups as $row)
                                        <div class="form-check form-check-inline">
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
                                    <div class="d-flex mt-4 justify-content-end">
                                        <a
                                            class="btn btn-outline-danger rounded-1 py-1 me-2 text-sm"
                                            href="{{url('/admin/product-category-list')}}"
                                            role="button">Back
                                        </a>
                                        <button
                                            class="btn btn-primary rounded-1 py-1 text-sm"
                                            group="submit">Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    -->
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-upload-wrap').hide();
                    $('.admin-profile').hide();
                    $('.file-upload-image-category').attr('src', e.target.result);
                    $('.file-upload-content').show();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            $('.admin-profile').show();
            document.querySelector('.file-upload-input').value = '';
        }

    </script>
@endsection()