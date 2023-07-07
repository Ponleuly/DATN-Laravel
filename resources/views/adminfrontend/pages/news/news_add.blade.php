@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('/admin/news-add')}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
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

                    <div class="card-style">
                        <h4 class="text-medium text-center">Add News & Introducing</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="news_img">
                                            <p class="text-label mt-3">News Image</p>
                                        </label>
                                        <input
                                            class="form-control form-control-sm rounded-0 mb-2"
                                            type="file"
                                            id="news_img"
                                            name="news_img"
                                            accept="image/png, image/jpeg, image/jpg"
                                            required
                                        >
                                        <label for="news_title">
                                            <p class="text-label mt-2">News Title</p>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control form-control-sm rounded-0 fw-500 mb-2"
                                            id="news_title"
                                            name="news_title"
                                            placeholder="new title..."
                                            required
                                        >
                                        <label for="news_status" ><p class="text-label" >News Status</p></label>
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
                                            id="news_content" required></textarea>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#news_content' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>
@endsection()