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

        <form action="{{url('/admin/general-setting-edit')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
            <div class="row ">
                <div class="col-md-12 my-3 mb-md-0">
                    <div class="card-style">
                        <h4 class="text-medium text-center mb-20">General Settings Edit</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row mb-2">
                                    <div class="col-md-12">
                                        <label for="website_name">
                                            <p class="text-label ">Website Name</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="website_name"
                                            name="website_name"
                                            value="{{$settings->website_name}}"
                                            placeholder="website name..."
                                            required
                                        >

                                        <label for="home_pageslogan"><p class="text-label mt-2">Home Page Slogan</p></label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="home_pageSlogan"
                                            name="home_pageSlogan"
                                            value="{{$settings->home_pageSlogan}}"
                                            placeholder="home page slogan..." required
                                        >

                                        <label for="home_pagetext">
                                            <p class="text-label mt-2">Home Page Text</p>
                                        </label>
                                        <textarea
                                            class="form-control rounded-0 fw-500"
                                            placeholder="home page text..."
                                            name="home_pageText"
                                            id="home_pagetext">{{$settings->home_pageText}}</textarea>

                                        <div class="col-md-12">
                                            <label for="product_imgcover"><p class="text-label mt-3">Home Page Image</p></label>
                                            <div class="image-upload-wrap" id="image-upload-wrap-home" style="display: none">
                                                <input
                                                    class="file-upload-input"
                                                    type='file'
                                                    id="home-page-image"
                                                    name="home_pageImage"
                                                    onchange="imgHome(this);" 
                                                    accept="image/png, image/jpeg, image/jpg"
                                                />
                                                <div class="drag-text">
                                                    <span class="display-3 thankyou-icon text-light mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                        </svg>
                                                    </span>
                                                    <h6>Home page image</h6>
                                                </div>
                                            </div>
                                            <div class="file-upload-content px-3"  style="display: block" id="homepageImg">
                                                <img
                                                    src="/product_img/imghomepage/{{$settings->home_pageImage}}"
                                                    class="img-fluid product-thumbnail"
                                                />
                                                <span
                                                    class="file-remove"
                                                    type="button"
                                                    onclick="removeImgHome()">X
                                                </span>
                                            </div>

                                            <div class="file-upload-content" id="file-upload-content-home">
                                                <img
                                                    class="file-upload-image-cover"
                                                    id="file-upload-image-cover-home"
                                                    src="" alt="image cover"
                                                />
                                                <span
                                                    class="file-remove"
                                                    type="button"
                                                    onclick="removeImgHome()">X
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group mb-2">
                                        <label for="facebook_link ">
                                            <p class="text-label ">Facebook Page Link</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="facebook_link"
                                            name="facebook_link"
                                            value="{{$settings->facebook_link}}"
                                            placeholder="facebook link..."
                                        >

                                        <label for="instagram_link">
                                            <p class="text-label mt-2">Instagram Page Link</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="instagram_link"
                                            name="instagram_link"
                                            value="{{$settings->instagram_link}}"
                                            placeholder="instagram link..."
                                        >

                                        <label for="youtube_link">
                                            <p class="text-label mt-2">Youtube Page Link</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="youtube_link"
                                            name="youtube_link"
                                            placeholder="youtube link..."
                                            value="{{$settings->youtube_link}}"
                                        >
                                        <label for="tiktok_link">
                                            <p class="text-label mt-2">Tiktok Page Link</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control rounded-0 fw-500"
                                            id="tiktok_link"
                                            name="tiktok_link"
                                            placeholder="tiktok link..."
                                            value="{{$settings->tiktok_link}}"
                                        >
                                      
                                       
                                        <label for="product_imgcover"><p class="text-label mt-3">Section Page Banner</p></label>
                                            <div class="image-upload-wrap" id="image-upload-wrap-section" style="display: none">
                                                <input
                                                    class="file-upload-input"
                                                    type='file'
                                                    id="section-image"
                                                    name="section_pageImage"
                                                    accept="image/png, image/jpeg, image/jpg"
                                                    onchange="imgSection(this);" 
                                                />
                                                <div class="drag-text">
                                                    <span class="display-3 thankyou-icon text-light mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                        </svg>
                                                    </span>
                                                    <h6>Section page image</h6>
                                                </div>
                                            </div>
                                            <div class="file-upload-content px-3" style="display: block" id="sectionImg">
                                                <img
                                                    src="/product_img/imghomepage/{{$settings->section_pageImage}}"
                                                    class="img-fluid product-thumbnail"
                                                />
                                                <span
                                                    class="file-remove"
                                                    type="button"
                                                    onclick="removeImgSection()">X
                                                </span>
                                            </div>

                                            <div class="file-upload-content" id="file-upload-content-section">
                                                <img
                                                    class="file-upload-image-cover"
                                                    id="file-upload-image-cover-section"
                                                    src="" alt="image cover"
                                                />
                                                <span
                                                    class="file-remove"
                                                    type="button"
                                                    onclick="removeImgSection()">X
                                                </span>
                                            </div>

                                        <div class="d-flex mt-4 justify-content-end">
                                            <a
                                                class="btn btn-outline-danger shadow rounded-1 py-1 me-2 text-sm"
                                                href="{{url('admin/general-setting')}}"
                                                role="button">Back
                                            </a>
                                            <button
                                                class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                                group="submit">Save
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

    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        function imgHome(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-upload-wrap-home').hide();
                    $('#file-upload-image-cover-home').attr('src', e.target.result);
                    $('#file-upload-content-home').show();
                    $('#homepageImg').hide();

                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeImgHome();
            }
        }
        function removeImgHome() {
            $('#file-upload-content-home').hide();
            $('#image-upload-wrap-home').show();
            $('#homepageImg').hide();
            document.querySelector('#home-page-image').setAttribute("required", "");
            document.querySelector('#home-page-image').value = '';
        }
    </script>
    <script>
        function imgSection(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image-upload-wrap-section').hide();
                    $('#file-upload-image-cover-section').attr('src', e.target.result);
                    $('#file-upload-content-section').show();
                    $('#sectionImg').hide();

                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeImgSection();
            }
        }
        function removeImgSection() {
            $('#file-upload-content-section').hide();
            $('#image-upload-wrap-section').show();
            $('#sectionImg').hide();
            document.querySelector('#section-image').setAttribute("required", "");
            document.querySelector('#section-image').value = '';
        }
    </script>
@endsection()