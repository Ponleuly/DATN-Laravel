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
                                <h4 class="text-medium mb-20 text-primary">News & Introducing List</h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right">
                                <div class="row justify-content-end">
                                    <div class="col-md-3 mb-2 ">
                                        <a
                                            class="btn btn-outline-primary shadow rounded-1 py-1"
                                            href="{{url('/admin/news-add')}}"
                                            role="button">
                                            <p class="text-sm">Add News</p>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{url('admin/news-search')}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_news"
                                                    class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                                    placeholder="Enter news title here..."
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
                                    <th class="min-width"><h6 class="text-sm text-medium">Title</h6></th>
                                    <th class="min-width text-center"><h6 class="text-sm text-medium">Status</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Status Actions</h6></th>
                                    <th class="min-width text-center"><h6 class="text-sm text-medium">Date</h6></th>
                                    <th class="min-width text-center"><h6 class="text-sm text-medium">Actions</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($news as $new)
                                    <tr class="text-center">
                                        <td><p class="text-sm">{{$count++}}</p></td>
                                        <td><p class="text-sm">{{$new->news_title}}</p></td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-2
                                                    {{($new->news_status == 1)?  'btn-success' : ''}}
                                                    {{($new->news_status == 0)?  'btn-danger' : ''}}
                                                    "
                                                    style="width: 100px"
                                                >
                                                @if($new->news_status == 1)
                                                <i class="bi bi-check-circle-fill pe-2"></i>Active
                                                @elseif($new->news_status == 0)
                                                <i class="bi bi-exclamation-circle-fill pe-2"></i>Inactive
                                                @endif
                                            </button>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <select
                                                class="form-select form-select-sm"
                                                aria-label="Default select example"
                                                id="newsStatus"
                                                name="newsStatus"
                                                style="width: 100px"
                                                >
                                                <option
                                                    value ="{{url('admin/news-update-status/'.$new->id.'/1')}}"
                                                    {{ ($new->news_status == 1)? 'selected':''}}
                                                    >
                                                    Active
                                                </option>
                                                <option
                                                    value ="{{url('admin/news-update-status/'.$new->id.'/0')}}"
                                                    {{($new->news_status == 0)? 'selected':''}}
                                                    >
                                                    Inactive
                                                </option>
                                                
                                            </select>
                                        </td>
                                        <td><p class="text-sm text-center">{{$new->created_at->diffForHumans()}}</p></td>
                                        <td class="text-center" style="width: 125px">
                                            <a
                                                class="btn btn-outline-primary btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/news-view/'.$new->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details"
                                                >
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            <a
                                                class="btn btn-outline-success btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/news-edit/'.$new->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Product"
                                                >
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a
                                                class="btn btn-outline-danger btn-sm py-1 px-2 rounded-0"
                                                href="{{url('/admin/news-delete/'.$new->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete Product"
                                                >
                                                <i class="bi bi-trash3-fill"></i>
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
                                        href="{{url('admin/news-list')}}"
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // Get "id" of select option, if there are only one select
        $('#newsStatus').on('change', function () { // bind change event to select
            var url_show_page = $(this).val(); // get selected value
            if (url_show_page != '') { // require a url_show_page
                window.location = url_show_page; // redirect
            }
            return false;
        });
    </script>
@endsection()