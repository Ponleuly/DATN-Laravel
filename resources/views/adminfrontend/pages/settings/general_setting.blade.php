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
                            <div class="left">
                                <h6 class="text-medium mb-20">General Settings</h6>
                            </div>
                            <div class="right">
                                <a
                                    class="btn btn-outline-danger rounded-0 py-1"
                                    href="{{url('admin/general-setting-edit')}}"
                                    role="button">
                                    <p class="text-sm">Edit Settings</p>
                                </a>
                            </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr>
                                    <th><h6 class="text-medium">#</h6></th>
                                    <th class="min-width col-2"><h6 class="text-sm text-medium">Title</h6></th>
                                    <th class="min-width"><h6 class="text-sm text-medium">Content</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Website Name</td>
                                        <td>{{$setting->website_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Home Page Slogan</td>
                                        <td>{{$setting->home_pageSlogan}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Home Page Text</td>
                                        <td>{{$setting->home_pageText}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Facebook Link</td>
                                        <td>{{($setting->facebook_link)? $setting->facebook_link:'None'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Instagram Link</td>
                                        <td>{{($setting->instagram_link)? $setting->instagram_link:'None'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Youtube Link</td>
                                        <td>{{($setting->youtube_link)? $setting->youtube_link:'None'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Tik Tok Link</td>
                                        <td>{{($setting->tiktok_link)? $setting->tiktok_link:'None'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Home Page Image</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="col-md-8">
                                                <img
                                                    src="/product_img/imghomepage/{{$setting->home_pageImage}}"
                                                    class="img-fluid product-thumbnail">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                         <td class="text-medium">{{$count++}}</td>
                                        <td class="text-medium">Section Page Image</td>
                                        <td class="d-flex justify-content-center">
                                            <div class="col-md-8">
                                                <img
                                                    src="/product_img/imghomepage/{{$setting->section_pageImage}}"
                                                    class="img-fluid product-thumbnail">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()