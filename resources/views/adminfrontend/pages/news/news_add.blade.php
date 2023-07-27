@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/news-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    <!--------------- Alert ------------------------>
                    @include('adminfrontend.pages.alert')
                    <!---------------End Alert ------------------------>

                    <div class="card-style">
                        <h4 class="text-medium text-center text-primary">Add News & Introducing</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="product_imgcover"><p class="text-label mt-3">News Image</p></label>
                                        <div class="image-upload-wrap">
                                            <input
                                                class="file-upload-input"
                                                type='file'
                                                id="news-img"
                                                name="news_img"
                                                onchange="readImgCover(this);" 
                                                accept="image/png, image/jpeg, image/jpg"
                                                required
                                            />
                                            <div class="drag-text">
                                                <span class="display-3 thankyou-icon text-light mt-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                    </svg>
                                                </span>
                                                <h6>News image</h6>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image-cover" src="#" alt="image cover" name="category_img"/>
                                            <span
                                                class="file-remove"
                                                type="button"
                                                onclick="removeImgCover()">X
                                            </span>
                                        </div>

                                        <label for="news_title">
                                            <p class="text-label mt-3">News Title</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm rounded-0 fw-500"
                                            id="news_title"
                                            name="news_title"
                                            placeholder="new title..."
                                            required
                                        >
                                        <label for="news_status" ><p class="text-label mt-3" >News Status</p></label>
                                        <select
                                            class="form-select form-select-sm rounded-0 mb-2"
                                            aria-label="category select"
                                            name="news_status"
                                            id="news_status"
                                            required
                                            >
                                            <option selected disabled value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>

                                        <label for="news_content"><p class="text-label mt-2">News Content</p></label>
                                        <textarea
                                            class="form-control rounded-0 fw-500"
                                            placeholder="news content..."
                                            name="news_content"
                                            id="news_content"></textarea>

                                        <div class="d-flex mt-4 justify-content-end">
                                            <a
                                                class="btn btn-outline-danger shadow rounded-1 py-1 me-2 text-sm"
                                                href="{{url('/admin/news-list')}}"
                                                role="button">Back
                                            </a>
                                            <button
                                                class="btn btn-primary shadow rounded-1 py-1 text-sm"
                                                group="submit">Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#news_content' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>
    <script>
         //================ Img Cover ======================//
        function readImgCover(input) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $('.image-upload-wrap').hide();
                     $('.file-upload-image-cover').attr('src', e.target.result);
                     $('.file-upload-content').show();
                 };
                 reader.readAsDataURL(input.files[0]);
             } else {
                 removeImgCover();
             }
         }
         function removeImgCover() {
             $('.file-upload-content' ).hide();
             $('.image-upload-wrap').show();
             document.querySelector('#news-img').value = '';
         }
    </script>
@endsection()