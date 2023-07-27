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
                    @include('adminfrontend.pages.alert')

                    <div class="card-style">
                        <h4 class="text-medium text-center mb-20 text-primary">Category Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <img
                                        src="/product_img/imgcategory/{{$category->category_img}}"
                                        class="img-fluid product-thumbnail"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                @foreach ($groups as $row)
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$row->rela_category_group->group_name}}</h5>
                                            <p class="text-sm ">Category :
                                                <span class="text-black">
                                                    {{$category->category_name}}
                                                </span>
                                            </p>
                                            <p class="text-sm d-flex align-baseline">Sub Cate :
                                                <span class="text-black ms-1">
                                                    @foreach ($subCategories as $item)
                                                        {{$item->sub_category}} <br>
                                                    @endforeach
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex mt-4 justify-content-end">
                                    <a
                                        class="btn btn-outline-danger shadow rounded-1 py-1 me-2 text-sm"
                                        href="{{url('/admin/product-category-list')}}"
                                        role="button">
                                        <p class="text-sm">Back</p>
                                    </a>
                                    <a
                                        class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                        href="{{url('/admin/product-category-edit/'.$category->id)}}"
                                        role="button">
                                        <p class="text-sm">Edit</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection()