@extends('adminfrontend.layouts.index')
@section('admincontent')
    <div class="container-fluid">
        <form  action="{{url('admin/payment-edit/'.$payment->id)}}" method="POST" enctype="multipart/form-data">
            @csrf <!-- to make form active -->
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-md-6 my-3 mb-md-0">
                    @if(Session::has('alert'))
                        <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                            {{Session::get('alert')}}
                        <button group="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
		            @endif

                    <h4 class="mb-2 text-black">Edit Payment</h4>
                    <div class="p-3 p-lg-4 border bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <div class="col-md-12">
                                        <label for="payment_title"><p class="text-label">Payment Title</p></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-color rounded-0 mb-2 py-2 px-2 w-100"
                                            id="payment_title"
                                            name="payment_title"
                                            value="{{$payment->payment_title}}"
                                            required
                                        >

                                        <label for="payment_detail"><p class="text-label mt-2">Payment Detail</p></label>
                                        <textarea
                                            class="form-control rounded-0 fw-500"
                                            placeholder="payment detail..."
                                            name="payment_detail"
                                            id="payment_detail" required>{{$payment->payment_detail}}</textarea>

                                        <div class="d-flex mt-4">
                                            <a
                                                class="btn btn-outline-danger rounded-0 mt-3"
                                                href="{{url('admin/payment-list')}}"
                                                role="button">
                                                Back to List
                                            </a>
                                            <button
                                                class="btn btn-primary rounded-0 ms-auto mt-3"
                                                type="submit">
                                                Update Payment
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
            .create( document.querySelector( '#payment_detail' ) )
            .catch( error => {
                console.error( error );
            } );

    </script>
@endsection()