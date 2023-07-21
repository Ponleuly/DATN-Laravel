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
                @include('adminfrontend.pages.alert')
                <!---------------End Alert ------------------------>
            </div>

            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between align-items-baseline">
                         <div class="col-md-6">
                            <div class="left">
                                <h4 class="text-medium mb-20">Sub Categories List</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row justify-content-end">
                                    <div class="col-md-3 mb-2 ">
                                    </div>
                                    <div class="col-md-6 ">
                                        <form action="{{url('admin/product-category-sub-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_subcategory"
                                                    class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                                    placeholder="Enter subcategory name here..."
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
                                    <th><h6 class="text-sm text-medium">#</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Sub Category</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Category</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Group</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Products</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Date</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcategories as $subcategory)
                                    @php
                                        $groups = Categories_Groups::where('category_id', $subcategory->category_id)->get();
                                        $product_count = Products_Attributes::where('subcategory_id', $subcategory->id)->distinct()->count('product_id');
                                    @endphp
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td><p class="text-sm">{{$subcategory->sub_category}}</p></td>
                                        <td>
                                            <p class="text-sm">{{$subcategory->rela_category_subcategory->category_name}}</p>
                                        </td>
                                        <td>
                                            @foreach($groups as $group)
                                               <p class="text-sm">
                                                    {{$group->rela_category_group->group_name}}
                                                    {{($loop->last)? '':'&'}}
                                                </p>
                                            @endforeach
                                        </td>
                                        <td><p class="text-sm">{{$product_count}}</p></td>
                                        <td><p class="text-sm">{{$subcategory->created_at->diffForHumans()}}</p></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            @if($search_text == '')
                            <!--- To show data by pagination --->
                            {{$subcategories->links()}}
                             @else
                                <div class="d-flex mt-4" style="padding-top: 2px">
                                    <a
                                        class="btn btn-outline-danger rounded-0 mt-2"
                                        href="{{url('admin/product-category-sub-list')}}"
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