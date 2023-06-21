@extends('adminfrontend.pages.profile.profile_setting')
@section('profile_content')
    <form
        action="{{url('/admin/profile/'.$user->id)}}"
        method="POST" enctype="multipart/form-data">
        @csrf <!-- to make form active -->
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label text-sm">Full name</label>
                            <input
                                type="text"
                                class="form-control form-control-sm
                                @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{old('name')? old('name') : $user->name}}"
                                placeholder="Enter name"
                            >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label text-sm">Role</label><br>
                            <label class="text-sm text-primary align-baseline">
                                {{($user->role == 0)? 'Administrator':'User'}}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label text-sm">Email</label>
                            <input
                                type="email"
                                class="form-control form-control-sm
                                @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{old('email')? old('email') : $user->email}}"
                                placeholder="example@gmail.com"
                            >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label text-sm">Phone</label>
                            <input
                                type="text"
                                class="form-control form-control-sm
                                @error('phone') is-invalid @enderror"
                                id="phone"
                                name="phone"
                                value="{{old('phone')? old('phone') : $user->phone}}"
                                placeholder="+84 454 456 56"
                            >
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label text-sm">Address</label>
                            <input
                                type="text"
                                class="form-control form-control-sm
                                @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                value="{{old('address')? old('address') : $user->address}}"
                                placeholder="23 Ta Quang Buu,..."
                            >
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="city" class="form-label text-sm">City/Province</label>
                            <input
                                type="text"
                                class="form-control form-control-sm
                                @error('city') is-invalid @enderror"
                                id="city"
                                name="city"
                                value="{{old('city')? old('city') : $user->city}}"
                                placeholder="Ha Noi"
                            >
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="district" class="form-label text-sm">District</label>
                            <input
                                type="text"
                                class="form-control form-control-sm
                                @error('district') is-invalid @enderror"
                                id="district"
                                name="district"
                                value="{{old('district')? old('district') : $user->district}}"
                                placeholder="Hai Ba Trung..."
                            >
                            @error('district')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="city" class="form-label text-sm">Ward</label>
                            <input
                                type="text"
                                class="form-control form-control-sm
                                @error('ward') is-invalid @enderror"
                                id="ward"
                                name="ward"
                                value="{{old('ward')? old('ward') : $user->ward}}"
                                placeholder="Bach Khoa"
                            >
                            @error('ward')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary rounded-1 py-1 text-sm">
                    Save changes
                </button>
            </div>

            <div class="col-md-4 ">
                @if($user->profile_img != '')
                    <div class="row">
                        <div class="col-12 mb-3 text-center">
                            <input
                                class="file-upload-input"
                                type='file'
                                name="profile_img"
                                onchange="readURL(this);" accept="image/*"
                            />
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="your image"/>
                                <span
                                    class="file-remove"
                                    type="button"
                                    onclick="removeUpload()">X
                                </span>
                            </div>
                            <!--=======Image from database======-->
                            <img
                                src="/profile_img/{{$user->profile_img}}"
                                alt="{{$user->profile_img}}"
                                class="img-fluid product-thumbnail admin-profile"
                                id="profile_img"
                            />
                        </div>
                        <div class="col-12 text-center">
                            <label
                                class="text-sm text-primary align-baseline fw-600"
                                for="profile_img"
                                type="button"
                                onclick="$('.file-upload-input').trigger( 'click' )"
                                >Update Image<i class="bi bi-pencil-square ms-1"></i>
                            </label>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="image-upload-wrap ">
                                <input
                                    class="file-upload-input"
                                    type='file'
                                    name="profile_img"
                                    onchange="readURL(this);" accept="image/*"
                                />
                                <div class="drag-text">
                                    <span class="display-3 thankyou-icon text-light mt-3 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                        </svg>
                                    </span>
                                    <h6>Drag and drop an image</h6>
                                </div>
                            </div>
                            <div class="file-upload-content" >
                                <img class="file-upload-image" src="#" alt="your image" name="profile_img"/>
                                <span
                                    class="file-remove"
                                    type="button"
                                    onclick="removeUpload()">X
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <label
                                class="text-sm text-primary align-baseline fw-600 text-center" for="profile_img"
                                type="button"
                                onclick="$('.file-upload-input').trigger( 'click' )"
                                >Upload Image
                            </label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
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
        /*
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
        */
    </script>
@endsection()