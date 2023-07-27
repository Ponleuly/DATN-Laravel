@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
                <!--------------- Alert ------------------------>
                @include('adminfrontend.pages.alert')
                <!---------------End Alert ------------------------>
            </div>
            <div class="row mb-10">
                <div class="col-6">
                    <h4 class="text-medium text-primary">Profile</h4>
                </div>
            </div>
            <!------------------------------------------------------------------------------------>
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="row">
                        <div class="col-md-3 pe-4">
                            <div class="general-profile">
                            <ul>
                                <li>
                                    <a
                                        href="{{url('admin/profile/'.(Auth::user()->id))}}"
                                        class="list-group-item list-group-item-action
                                        {{Request::is('admin/profile/*')? 'active':''}}"
                                        aria-current="true"
                                    >General profile
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{url('admin/change-password/'.(Auth::user()->id))}}"
                                        class="list-group-item list-group-item-action
                                        {{Request::is('admin/change-password/*')? 'active':''}}"
                                        aria-current="true"
                                    >Change password
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{url('admin/logout')}}"
                                        class="list-group-item list-group-item-action"
                                        aria-current="true"
                                    >Log out
                                    </a>
                                </li>
                            </ul>
                            </div>
                        </div>

                        <div class="col-md-9 border-start px-4">
                            @yield('profile_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()