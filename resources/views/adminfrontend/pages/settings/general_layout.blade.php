@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        @if(Session::has('alert'))
            <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                {{Session::get('alert')}}
                <button group="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
		@endif

        <h4 class="mt-3 mb-2 text-black">Layout View</h4>
        <div class="border bg-white">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 py-4">
                        <h4 class="px-5 text-danger">Website Name.</h4>
                    </div>
                    <div class="col-md-8 py-4">
                        <h4 class="px-5 text-danger">Nav Menu</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 bg-danger">
                <div class="row py-5">
                    <div class="col-md-6 py-5">
                        <h3 class="px-5 text-white">
                            <strong>Home Page Slogan</strong>
                        </h3>
                        <p class="px-5 py-4 text-white">Home Page Text</p>
                    </div>
                    <div class="col-md-6 p-5">
                        <div class="border bg-secondary h-100 py-5">
                            <p class="text-center text-white py-5">Home Page Image</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 px-5">
                <div class="border bg-secondary h-100 py-5 mb-3">
                    <p class="text-center text-white py-5">Section Page Image</p>
                </div>
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 1</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 2</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 3</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 4</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 5</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 6</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 7</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border bg-light h-100 py-5">
                            <p class="text-center py-5">Product 8</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                 <div class="row py-5">
                    <div class="col-md-4">
                        <h3 class="px-5 text-danger py-2"><strong>Website Name.</strong></h3>
                        <h5 class="px-5 text-danger py-2">Home Page Slogan</h5>
                        <p class="px-5 py-2 text-black-50">Home Page Text</p>
                        <p class="px-5 py-2 text-black-50">Social Media Link</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5 class="px-5 text-danger py-2 ">Menu</h5>
                        <p class="px-5 py-2 text-black-50">Sub menu 1</p>
                        <p class="px-5 py-2 text-black-50">Sub menu 2</p>
                        <p class="px-5 text-black-50">.</p>
                        <p class="px-5 text-black-50">.</p>
                        <p class="px-5 text-black-50">.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <h5 class="px-5 text-danger py-2 ">Contact Method</h5>
                        <p class="px-5 py-2 text-black-50">Contact 1</p>
                        <p class="px-5 py-2 text-black-50">Contact 2</p>
                        <p class="px-5 text-black-50">.</p>
                        <p class="px-5 text-black-50">.</p>
                        <p class="px-5 text-black-50">.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()