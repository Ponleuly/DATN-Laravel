<?php
	use App\Models\Products_Colors;
	use App\Models\Products_Sizes;
	use App\Models\Products_Imgreviews;

?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 my-2 mb-md-0">
                <div class="card-style">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="text-medium">News Details</h4>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <a
                                class="btn btn-outline-danger rounded-1 py-1 me-2 text-sm"
                                href="{{url('/admin/news-list')}}"
                                role="button">Back
                            </a>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8 text-center mb-3">
                            <h3>{{$news->news_title}}</h3>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">
                            <p class="text-medium">{!! $news->news_content !!}</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8 mt-4">
                            <img
                                src="/product_img/imgnews/{{$news->news_img}}"
                                class="img-fluid product-thumbnail"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()