@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('admin/news-edit/'.$new->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
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

                    <h4 class="mb-2 text-black">Edit News & Introducing</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="product_imgcover">
                                                <p class="text-label mt-3">News Image</p>
                                            </label>
                                            <div class="col-md-12">
                                                <img
                                                    src="/product_img/imgnews/{{$new->news_img}}"
                                                    class="img-fluid product-thumbnail"
                                                >
                                            </div>

                                            <label for="news_img">
                                                <p class="text-label mt-3">Update News Image</p>
                                            </label>
                                            <input
                                                class="form-control rounded-0 mb-2"
                                                type="file"
                                                id="news_img"
                                                name="news_img"
                                                accept="image/png, image/jpeg, image/jpg"
                                            >

                                        </div>
                                        <div class="col-md-6">
                                            <label for="news_title">
                                            <p class="text-label mt-2">News Title</p>
                                            </label>
                                            <input
                                                type="text"
                                                class="form-control rounded-0 fw-500 mb-2"
                                                id="news_title"
                                                name="news_title"
                                                value="{{$new->news_title}}"
                                                placeholder="new title..."
                                                required
                                            >
                                            <label for="news_status" ><p class="text-label" >News Status</p></label>
                                            <select
                                                class="form-select rounded-0 mb-2"
                                                aria-label="category select"
                                                name="news_status"
                                                id="news_status"
                                                required
                                                >
                                                <option selected disabled value="">Select Status</option>
                                                <option value="1" {{($new->news_status == 1)? 'selected': ''}}>Active</option>
                                                <option value="0" {{($new->news_status == 0)? 'selected': ''}}>Inactive</option>
                                            </select>

                                            <label for="news_content"><p class="text-label mt-2">News Content</p></label>
                                            <textarea
                                                class="form-control rounded-0 fw-500"
                                                placeholder="news content..."
                                                name="news_content"
                                                id="news_content" >{{$new->news_content}}</textarea>

                                            <div class="d-flex mt-3">
                                                <a
                                                    class="btn btn-outline-danger rounded-0 mt-3"
                                                    href="{{url('/admin/news-list')}}"
                                                    role="button"
                                                    >Back to List
                                                </a>
                                                <button
                                                    class="btn btn-primary rounded-0 ms-auto mt-3"
                                                    type="submit"
                                                    >
                                                    Update News
                                                </button>
                                            </div>
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