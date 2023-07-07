<?php
	use App\Models\Categories_Groups;
	use App\Models\Products_Attributes;
	use App\Models\Categories_Subcategories;
?>
@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
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
            </div>

            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                        <div class="col-md-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Categories List</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row justify-content-end">
                                    <div class="col-md-3 mb-2 ">
                                        <a
                                            class="btn btn-outline-primary shadow rounded-1 py-1"
                                            href="{{url('/admin/product-category-add')}}"
                                            role="button">
                                            <p class="text-sm">Add Category</p>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <form  action="{{url('admin/product-category-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_category"
                                                    class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                                    placeholder="Enter category name here..."
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default"
                                                    value="{{$search_text}}"
                                                >
                                                <button
                                                    class="btn btn-outline-primary btn-sm rounded-1 rounded-start-0 text-sm"
                                                    type="submit"
                                                    id="search"
                                                    >
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th><h6 class="text-medium">#</h6></th>
                                    <th class="min-width"><h6 class=" text-medium">Image</h6></th>
                                    <th class="min-width"><h6 class=" text-medium">Category</h6></th>
                                    <th class="min-width"><h6 class=" text-medium">Sub Category</h6></th>
                                    <th class="min-width"><h6 class=" text-medium">Group</h6></th>
                                    <th class="min-width"><h6 class=" text-medium">Products</h6></th>
                                    <th class="min-width"><h6 class=" text-medium">Date</h6></th>
                                    <th class="min-width"><h6 class=" text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach($categories as $category)
                                    @php
                                        $groups =  Categories_Groups::where('category_id', $category->id)->get();
                                        $productCount =  Products_Attributes::where('category_id', $category->id)->distinct('product_id')->count();
                                    @endphp
                                    <tr class="text-center admin-table">
                                        <th><p class="text-sm">{{$count++}}</p></th>
                                        <td>
                                            <img
                                                src="/product_img/imgcategory/{{$category->category_img}}"
                                                class="img-fluid product-thumbnail"
                                                style="width: 120px"
                                            >
                                        </td>
                                        <td><p class="text-sm">{{$category->category_name}}</p></td>
                                        <td>
                                            @php
                                                $sub_count = Categories_Subcategories::where('category_id', $category->id)->count();
                                            @endphp
                                            <p class="text-sm">{{$sub_count}}</p>
                                        </td>
                                        <td>
                                            @foreach($groups as $item)
                                                <p class="text-sm">
                                                    {{$item->rela_category_group->group_name}}
                                                    {{($loop->last)? '':'&'}}
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>{{$productCount}}</td>
                                        <td><p class="text-sm">{{$category->created_at->diffForHumans()}}</p></td>
                                        <td style="width:125px">
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 view-btn"
                                                href="{{url('/admin/product-category-view/'.$category->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">visibility</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 edit-btn"
                                                href="{{url('/admin/product-category-edit/'.$category->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Product"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">edit</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                 href="{{url('/admin/product-category-delete/'.$category->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Product"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            @if($search_text != '')
                                <div class="d-flex">
                                    <a
                                        class="btn btn-outline-danger rounded-0 mt-2"
                                        href="{{url('admin/product-category-list')}}"
                                        role="button"
                                        >
                                        <p class="text-sm">Back to List</p>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()