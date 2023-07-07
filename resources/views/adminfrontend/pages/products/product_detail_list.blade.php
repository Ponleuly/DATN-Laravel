<?php
	use App\Models\Products_Attributes;
	use App\Models\Products_Sizes;
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
                    <div class="title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-medium mb-20">Products List</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="row justify-content-end">
                                    <div class="col-md-3 mb-2">
                                        <a
                                            class="btn btn-outline-primary shadow rounded-1 py-1"
                                            href="{{url('/admin/product-detail-add')}}"
                                            role="button">
                                            <p class="text-sm">Add Product</p>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <form  action="{{url('admin/product-search/show='.(($res>20)? 'all':$res).'/by-'.$title.'='.$sort)}}">
                                            <div class="input-group input-group-sm w-100">
                                                <input
                                                    type="text"
                                                    name="search_product"
                                                    class="form-control rounded-1 rounded-end-0 text-sm text-capitalize"
                                                    placeholder="Enter product name here..."
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

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="col-3 d-flex flex-row align-items-baseline" style="min-width:200px">
                                    <p class="text-sm pe-2">Show </p>
                                    <select class="form-select form-select-sm"
                                            style="width:65px"
                                            aria-label="Default select example"
                                            id="showResult"
                                        >
                                        <option value ="{{url('admin/product-detail-list/show=5/by-'. $title.'='.$sort)}}"
                                            {{($title == 5)? 'selected':''}}>5
                                        </option>
                                        <option value ="{{url('admin/product-detail-list/show=10/by-'.$title.'='.$sort)}}"
                                            {{($res==10)? 'selected':''}}>10
                                        </option>
                                        <option value ="{{url('admin/product-detail-list/show=20/by-'.$title.'='.$sort)}}"
                                            {{($res==20)? 'selected':''}}>20
                                        </option>
                                        <option value ="{{url('admin/product-detail-list/show=all/by-'.$title.'='.$sort)}}"
                                            {{Request::is('admin/product-detail-list/show=all/*')? 'selected':''}}
                                            >All
                                        </option>
                                    </select>
                                    <p class="text-sm px-2">entries </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-row align-items-baseline justify-content-end">
                                    <p class="text-sm pe-2">Sort by</p>
                                    <select class="form-select form-select-sm"
                                            aria-label="Default select example"
                                            style="width: 150px"
                                            id="sortStatus"
                                    >
                                        <option selected disabled>Product status</option>
                                        <option value ="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-status=new')}}"
                                            {{($sort == 'new')? 'selected':''}}>New
                                        </option>
                                        <option value ="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-status=selling')}}"
                                            {{($sort == 'selling')? 'selected':''}}>Selling
                                        </option>
                                        <option value ="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-status=soldout')}}"
                                            {{($sort == 'soldout')? 'selected':''}}>Sold out
                                        </option>
                                    </select>
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
                                    <th class="min-width"><h6 class="text-sm text-medium">Image</h6></th>
                                    <th class="min-width text-start" >
                                        <a
                                            href="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-name='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-baseline"
                                            style="width:250px"
                                            >
                                            <h6 class="text-medium">Product Name</h6>
                                            <span class="text-black-50 ms-auto
                                                {{Request::is('admin/product-detail-list/show=*/by-name*')? 'text-danger':''}}"
                                                >
                                                @if($title=='name' && $sort=='asc')
                                                    <i class="bi bi-sort-alpha-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='name' && $sort=='desc')
                                                    <i class="bi bi-sort-alpha-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <!--<th class="min-width"><h6 class="text-medium">Category</h6></th>-->
                                    <th class="min-width">
                                        <a
                                            href="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-price='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium">Price</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/product-detail-list/show=*/by-price*')? 'text-danger':''}}">
                                                @if($title=='price' && $sort=='asc')
                                                    <i class="bi bi-sort-numeric-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='price' && $sort=='desc')
                                                    <i class="bi bi-sort-numeric-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width">
                                        <a
                                            href="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-stock='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium">Stock</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/product-detail-list/show=*/by-stock=*')? 'text-danger':''}}">
                                                @if($title=='stock' && $sort=='asc')
                                                    <i class="bi bi-sort-numeric-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='stock' && $sort=='desc')
                                                    <i class="bi bi-sort-numeric-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width">
                                        <a
                                            href="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-stockleft='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium">Stock Left</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/product-detail-list/show=*/by-stockleft*')? 'text-danger':''}}">
                                                @if($title=='stockleft' && $sort=='asc')
                                                    <i class="bi bi-sort-numeric-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='stockleft' && $sort=='desc')
                                                    <i class="bi bi-sort-numeric-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    <th class="min-width">
                                        <a
                                            href="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-status='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-baseline"
                                            >
                                            <h6 class="text-medium">Status</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/product-detail-list/show=*/by-status*')? 'text-danger':''}}"
                                                >
                                                @if($title=='status' && $sort=='asc')
                                                    <i class="bi bi-sort-alpha-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='status' && $sort=='desc')
                                                    <i class="bi bi-sort-alpha-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width"><h6 class="text-medium">Status Action</h6></th>
                                    <th class="min-width">
                                        <a
                                            href="{{url('admin/product-detail-list/show='.(($res>20)? 'all':$res).'/by-date='.(($sort=='asc')? 'desc':'asc'))}}"
                                            class="d-inline-flex align-items-center"
                                            >
                                            <h6 class="text-medium">Date</h6>
                                            <span class="text-black-50 ms-3
                                                {{Request::is('admin/product-detail-list/show=*/by-date*')? 'text-danger':''}}">
                                                @if($title=='date' && $sort=='asc')
                                                    <i class="bi bi-sort-numeric-up" style="font-size: 20px;"></i>
                                                    @elseif($title=='date' && $sort=='desc')
                                                    <i class="bi bi-sort-numeric-down-alt" style="font-size: 20px;"></i>
                                                    @else
                                                    <i class="bi bi-funnel-fill" style="font-size: 16px;"></i>
                                                @endif
                                            </span>
                                        </a>
                                    </th>
                                    <th class="min-width"><h6 class="text-medium">Action</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    @php
                                        $stockLeft = 0;
                                        $groupAttribute = Products_Attributes::where('product_id', $product->id)->get();
                                        $categoryAttribute = Products_Attributes::where('product_id', $product->id)->first();
                                        $productSize = Products_Sizes::where('product_id', $product->id)->get();
                                        foreach ($productSize as $row) {
                                            $stockLeft  += $row->size_quantity;
                                        }
                                    @endphp
                                    <tr class="text-center">
                                        <td>
                                            <p class="text-sm">
                                                <!--$loop->index is index of items per page,
                                                    Ex.currentPage=1, perPage=5 => index=[0,1,2,3,4]
                                                    Ex.currentPage=2, perPage=5 => index=[0,1,2,3,4]
                                                    // number of index depend on perPage and not change although currentPage is changed
                                                    Ex.currentPage=1, perPage=10 => index=[0,1,2,3,4,....9]
                                                -->
                                                @if($search_text == '')
                                                    {{($products->currentPage()-1) * $products->perPage() + $loop->index + 1}}
                                                    @else
                                                        {{$count++}}
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <img
                                                src="/product_img/imgcover/{{$product->product_imgcover}}"
                                                class="img-fluid product-thumbnail product-img"
                                            >
                                        </td>
                                        <td><p class="text-sm text-start">{{$product->product_name}}</p></td>
                                        <!--
                                        <td>
                                            <p class="text-sm">
                                                {{($categoryAttribute)? $categoryAttribute->rela_product_category->category_name: 'Deleted'}}
                                            </p>
                                        </td>
                                        -->
                                        <td><p class="text-sm">$ {{$product->product_saleprice}}</p></td>
                                        <td><p class="text-sm">{{$product->product_stock}}</p></td>
                                        <td><p class="text-sm">{{$product->product_stockleft}}</p></td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-sm py-1 px-0
                                                    {{($product->product_status == 1)?  'btn-primary' : ''}}
                                                    {{($product->product_status == 2)?  'btn-success' : ''}}
                                                    {{($product->product_status == 3)?  'btn-danger' : ''}}
                                                    "
                                                    style="width: 65px;"
                                                >
                                                {{($product->product_status == 1)?  'New' : ''}}
                                                {{($product->product_status == 2)?  'Selling' : ''}}
                                                {{($product->product_status == 3)?  'Sold Out' : ''}}
                                            </button>
                                        </td>
                                        <td>
                                            <select
                                                class="form-select form-select-sm"
                                                aria-label="Default select example"
                                                id="productStatus"
                                                name="productStatus"
                                                style="width: 100px"
                                                >
                                                <option
                                                    value ="{{url('admin/product-detail-status/'.$product->id .'/1')}}"
                                                    {{($product->product_status == 1)? 'selected': ''}}
                                                    >
                                                    New
                                                </option>
                                                <option
                                                    value ="{{url('admin/product-detail-status/'.$product->id .'/2')}}"
                                                    {{($product->product_status == 2)? 'selected': ''}}
                                                    >
                                                    Selling
                                                </option>
                                                <option
                                                    value ="{{url('admin/product-detail-status/'.$product->id .'/3')}}"
                                                    {{($product->product_status == 3)? 'selected': ''}}
                                                    >
                                                    Sold out
                                                </option>
                                            </select>
                                        </td>
                                        <td><p class="text-sm">{{$product->created_at->diffForHumans()}}</p></td>
                                        <td style="width:125px">
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 view-btn"
                                                href="{{url('/admin/product-detail-view/'.$product->product_code)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="View Details"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">visibility</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 edit-btn"
                                                href="{{url('/admin/product-detail-edit/'.$product->id)}}"
                                                role="button"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Edit Product"
                                                >
                                                <span class="material-icons-round" style="font-size: 16px">edit</span>
                                            </a>
                                            <a
                                                class="text-light py-1 pb-0 px-2 rounded-0 delete-btn"
                                                href="{{url('/admin/product-detail-delete/'.$product->id)}}"
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
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            @if($search_text == '')
                            <p class="text-sm">
                                Showing {{($products->currentPage()-1)* $products->perPage()+($products->total() ? 1:0)}}
                                to {{($products->currentPage()-1)*$products->perPage()+count($products)}}
                                of {{$products->total()}}  results
                            </p>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-end">
                                @if($search_text == '')
                                    <!--- To show data by pagination --->
                                    {{$products->links()}}</span>

                                    @else
                                        <div class="d-flex">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-2"
                                                href="{{url('admin/product-detail-list/show=10/by-name=asc')}}"
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
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        // Get "id" of select option, if there are only one select
        $('#showResult').on('change', function () { // bind change event to select
            var url_show_page = $(this).val(); // get selected value
            if (url_show_page != '') { // require a url_show_page
                window.location = url_show_page; // redirect
            }
            return false;
        });
        $('#sortStatus').on('change', function () { // bind change event to select
            var url_sort_status = $(this).val(); // get selected value
            if (url_sort_status != '') { // require a url_sort_status
                window.location = url_sort_status; // redirect
            }
            return false;
        });
        // Get "name" of select opption if there is many selects like each order have 1 select(with many option)
        $("[name='productStatus']").on('change', function () { // bind change event to select
            var url_product_status = $(this).val(); // get selected value
            if (url_product_status != '') { // require a url_product_status
                window.location = url_product_status; // redirect
                //alert(url_product_status);
            }
            return false;
        });
    </script>
@endsection()