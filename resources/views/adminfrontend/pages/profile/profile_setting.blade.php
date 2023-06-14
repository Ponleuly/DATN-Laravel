@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 my-3 mb-md-0">
                <!--------------- Alert ------------------------>
                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                            {{Session::get('error')}}
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
            <div class="row mb-10">
                <div class="col-6">
                    <h4 class="text-medium">Profile</h4>
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
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image-upload-wrap').hide();
                    $('.admin-profile').hide();
                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();
                    $('.image-title').html(input.files[0].name);

                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            $('.admin-profile').show();
            document.querySelector('.file-upload-input').value = '';
        }
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
</script>
@endsection()