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
                    @if(Session::has('alert'))
                        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                            {{Session::get('alert')}}
                        <button group="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
		            @endif

                    <h4 class="mb-2 text-black">Category Details</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            @foreach ($groups as $row)
                                <div class="col-md-6">
                                    <div class="p-3 p-lg-4 border">
                                        <div class="row py-2">
                                            <div class="col-4">
                                                <h5 class="text-black fw-bold mt-1">Group:</h5>
                                            </div>
                                            <div class="col-8">
                                                <p>{{$row->rela_category_group->group_name}}</p>
                                            </div>
                                        </div>

                                        <div class="row py-2">
                                            <div class="col-4">
                                                <h5 class="text-black fw-bold mt-1">Category:</h5>
                                            </div>
                                            <div class="col-8">
                                                <p>{{$category->category_name}}</p>
                                            </div>
                                        </div>

                                        <div class="row py-2">
                                            <div class="col-4">
                                                <h5 class="text-black fw-bold mt-1">Sub category:</h5>
                                            </div>
                                            <div class="col-8">
                                                @foreach ($subCategories as $item)
                                                    <p>{{$item->sub_category}}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-12 mt-4">
                            <img
                                src="/product_img/imgcategory/{{$category->category_img}}"
                                class="img-fluid product-thumbnail"
                            >
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection()