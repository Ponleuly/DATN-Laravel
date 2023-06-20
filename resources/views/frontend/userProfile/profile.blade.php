@extends('index')
@section('content')
    <nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
		  	<li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>
		  	<li class="breadcrumb-item text-light">Profile</li>
		</ol>
	</nav>

	<div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row">
                <!--------------- Alert ------------------------>
				@if(Session::has('error'))
                    <script>
                        var type = 'error';
                        var text = "<?php echo Session::get('error'); ?>";
                    </script>
                    <script src="{{url('frontend/js/sweetAlert.js')}}"></script>
                    @elseif(Session::has('info'))
                        <script>
                            var type = 'info';
                            var text = "<?php echo Session::get('info'); ?>";
                        </script>
                        <script src="{{url('frontend/js/sweetAlert.js')}}"></script>

                        @elseif(Session::has('success'))
                            <script>
                                var type = 'success';
                                var text = "<?php echo Session::get('success'); ?>";
                            </script>
                            <script src="{{url('frontend/js/sweetAlert.js')}}"></script>
                        @elseif(Session::has('question'))
                            <script>
                                var type = 'question';
                                var text = "<?php echo Session::get('question'); ?>";
                            </script>
                            <script src="{{url('frontend/js/sweetAlert.js')}}"></script>
                @endif
                <!------------------End Alert ------------------------>
                <form
                    action="{{url('profile-update/'. Auth::user()->id)}}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="form-floating"
                    >
                    @csrf <!-- to make form active -->
                    @method('PUT')
                    <div class="col-md-12 border p-5 p-lg-5 bg-white">
                        <div class="row">
                            <div class="col-md-4">

                                    @if(Auth::user()->profile_img != '')
                                        <div class="row justify-content-center ">
                                            <div class="col-md-6 text-center pf-container">
                                                <input
                                                    class="file-upload-input"
                                                    type='file'
                                                    name="profile_img"
                                                    onchange="readURL(this);" accept="image/*"
                                                    {{(Request::is('purchase*')|| Request::is('change-password'))? 'disabled':''}}
                                                />
                                                <div class="file-upload-content">
                                                    <img class="file-upload-image" src="#" alt="your image" />
                                                    <span
                                                        class="file-remove"
                                                        type="button"
                                                        onclick="removeUpload()">X
                                                    </span>
                                                </div>
                                                <!--=======Image from database======-->
                                                <img
                                                    src="/profile_img/{{Auth::user()->profile_img}}"
                                                    alt="{{Auth::user()->profile_img}}"
                                                    class="img-fluid product-thumbnail admin-profile"
                                                    id="profile_img"

                                                />
                                                <div class="middle-icon
                                                    {{(Request::is('purchase*') || Request::is('change-password'))? 'd-none':''}}"
                                                    onclick="$('.file-upload-input').trigger( 'click' )" id="middle-icon">
                                                    <div class="icon-color">
                                                        <span class="material-icons-round">edit</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row justify-content-center">
                                            <div class="col-md-6">
                                                <div class="image-upload-wrap">
                                                    <input
                                                        class="file-upload-input"
                                                        type='file'
                                                        name="profile_img"
                                                        onchange="readURL(this);" accept="image/*"
                                                        {{(Request::is('purchase*')|| Request::is('change-password'))? 'disabled':''}}
                                                    />
                                                    <div class="drag-text mt-3" onclick="$('.file-upload-input').trigger( 'click' )">
                                                        <span class="display-3 thankyou-icon text-light ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                                            </svg>
                                                        </span>
                                                        <h6>Upload image</h6>
                                                    </div>
                                                </div>
                                                <div class="file-upload-content" >
                                                    <img class="file-upload-image" src="#" alt="your image" />
                                                    <span
                                                        class="file-remove"
                                                        type="button"
                                                        onclick="removeUpload()">X
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                <h5 class="username text-center py-2 mb-2 text-black">{{Auth::user()->name}}</h5>
                                <div class="list-group list-group-flush">
                                    <a
                                        href="{{url('profile')}}"
                                        class="list-group-item list-group-item-action list
                                                {{Request::is('profile')? 'active':''}}
                                            "
                                        aria-current="true"
                                        >
                                        General Profile
                                    </a>
                                    <a href="{{url('purchase-history')}}"
                                        class="list-group-item list-group-item-action
                                                {{Request::is('purchase*')? 'active':''}}
                                            "
                                        >
                                        Purchase History
                                    </a>
                                    <a
                                        href="{{url('change-password')}}"
                                        class="list-group-item list-group-item-action
                                                {{Request::is('change-password')? 'active':''}}
                                            "
                                        >
                                        Change Password
                                    </a>
                                    <a href="{{url('logout')}}" class="list-group-item list-group-item-action">
                                        Log Out
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-8 ps-4">
                                @yield('profile_content')
                            </div>
                        </div>
                    </div>
                </form>
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
                    $('#middle-icon').hide();
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            //$('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            $('.admin-profile').show();
            document.querySelector('.file-upload-input').value = '';
        }
    </script>
@endsection()