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

        <h4 class="mt-3 text-black">General Settings Edit</h4>
        <form action="{{url('/admin/general-setting-edit')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
            <div class="row ">
                <div class="col-md-12 my-3 mb-md-0">
                    <div class="p-3 p-lg-4 border bg-white">
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

                                        <label for="pageimage">
                                            <p class="text-label mt-3">Home Page Image</p>
                                        </label>
                                        <div class="col-md-12">
                                            <img
                                                src="/product_img/imghomepage/{{$settings->home_pageImage}}"
                                                class="img-fluid product-thumbnail"
                                            >
                                        </div>

                                        <label for="home_pageimage">
                                            <p class="text-label mt-3">Update Home Page Image</p>
                                        </label>
                                        <input
                                            class="form-control rounded-0 mb-2"
                                            type="file"
                                            id="home_pageimage"
                                            name="home_pageImage"
                                            accept="image/png, image/jpeg, image/jpg"
                                        >
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
                                            class="form-control rounded-0 fw-500 mb-2"
                                            id="tiktok_link"
                                            name="tiktok_link"
                                            placeholder="tiktok link..."
                                            value="{{$settings->tiktok_link}}"
                                        >
                                        <label for="pageimage">
                                            <p class="text-label mt-2">Section Page Banner</p>
                                        </label>
                                        <div class="col-md-12 mb-2">
                                            <img
                                                src="/product_img/imghomepage/{{$settings->section_pageImage}}"
                                                class="img-fluid product-thumbnail"
                                            >
                                        </div>

                                        <label for="section_pageimage">
                                            <p class="text-label mt-2">Update Section Page Banner</p>
                                        </label>
                                        <input
                                            class="form-control rounded-0 mb-2"
                                            type="file"
                                            id="section_pageimage"
                                            name="section_pageImage"
                                            accept="image/png, image/jpeg, image/jpg"
                                            multiple
                                        >
                                        <div class="d-flex mt-4" style="padding-top: 8px">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-2"
                                                href="{{url('admin/general-setting')}}"
                                                role="button"
                                                >
                                                Back to Setting
                                            </a>
                                            <button
                                                class="btn btn-primary rounded-0 ms-auto mt-2"
                                                type="submit"
                                                >
                                                Update Setting
                                            </button>
                                        </div>
                                        <!--formnovalidate="formnovalidate" => for textarea input with CKeditor-->
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