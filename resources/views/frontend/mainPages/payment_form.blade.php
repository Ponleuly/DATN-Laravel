<?php
	use App\Models\Sizes;
	use App\Models\Products_Attributes;
	use App\Models\Products;
	use App\Models\Products_Sizes;
?>
@extends('index')
@section('content')
    <!-- Start breabcrumb Section -->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb px-3 py-2 mb-0" style="background: #cc2936">
		  	<li class="breadcrumb-item ">
				<a href="{{url("home")}}" class="text-light">Home</a>
			</li>
			<li class="breadcrumb-item ">
				<a href="{{url("cart")}}" class="text-light">Cart</a>
			</li>
            <li class="breadcrumb-item text-light">
               Checkout
            </li>
		  	<li class="breadcrumb-item text-light">
                Payment
            </li>
		</ol>
	</nav>
	<!-- End breabcrumb Section -->

	<div class="untree_co-section">
        <div class="container">
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

			<hr>
            <form
                role="form"
                action="{{url('payment/invoicecode='. $invoiceCode.'/totalpaid='. $totalPaid)}}"
                method="post"
                class="require-validation"
                data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                enctype="multipart/form-data"
                id="payment-form"
                >
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <div class="p-3 p-lg-4 border bg-white">
							<h2 class="h3 mb-3 text-black">Payment Details</h2>
                            <div class="form-group row mb-3">
								<div class="col-md-12">
									<label for="payment_email" class="text-black mb-1">Payment Confirmation Email <span class="text-danger">*</span></label>
                            	    <input
                            			type="email"
                            			class="form-control rounded-0"
                            			id="payment_email"
                            			name="payment_email"
                            			value=""
                            			placeholder="example@gmail.com"
                            			required
                            		>
								</div>
						    </div>

                    		<div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <label for="holder_name" class="text-black mb-1">Card Holder's Name <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control rounded-0 text-uppercase"
                                        id="holder_name"
                                        name="holder_name"
                                        placeholder="Card Owner Name"
                                        required
                                    >
                                </div>
                    		</div>

                            <div class="form-group row mb-3">
						    	<div class="col-md-12">
									<label for="card_number" class="text-black mb-1">Card Number<span class="text-danger">*</span></label>
										<input
	                						type="text"
                							class="form-control rounded-0 card-number"
                							id="card_numbere"
                							name="card_numbere"
                							placeholder="0000 0000 0000 0000"
                							required
                							maxlength="16"
                                            autocomplete='off'
										>
								</div>
							</div>

                            <div class="form-group row mb-3">
                            	<div class="col-md-6">
                                    <label for="month" class="text-black mb-1">Expiration Date<span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input
                                            type="text"
                                            class="form-control rounded-0 card-expiry-month"
                                            id="month"
                                            name="month"
                                            placeholder="MM"
                                            required
                                            >
                                        </div>
                                        <div class="col-5 ms-0 ps-0">
                                            <input
                                                type="text"
                                                class="form-control rounded-0 card-expiry-year"
                                                id="year"
                                                name="year"
                                                placeholder="YYYY"
                                                required
                                                >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cvc" class="text-black mb-1">CVC/CVV<span class="text-danger">*</span></label>
                                    <div class="col-6">
                                        <input
                                            type="password"
                                            class="form-control rounded-0 card-cvc"
                                            id="month"
                                            name="month"
                                            maxlength="4"
                                            placeholder="Ex. 789"
                                            required
                                            autocomplete='off'
                                        >
                            	    </div>
                            	</div>
                            </div>

                            <div class="form-group row mb-3">
						    	<div class="col-md-12">
									<strong>Total Paid : $ {{$totalPaid}}</strong>
								</div>
							</div>

                            <div class="row ">
								<div class="col-md-6">
									<a
										href="{{url('cart')}}"
										class="btn btn-block px-4 py-2 fw-semibold  rounded-0"
										>
										Cancel
									</a>
								</div>
								<div class="col-md-6 d-flex justify-content-end">
									<button
										type="submit"
										class="btn btn-block px-4 py-2 fw-semibold  rounded-0"
										>
										Payment
									</button>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form =
                    $(".require-validation"),
                    inputSelector = [
                        'input[type=email]',
                        'input[type=password]',
                        'input[type=text]',
                        'input[type=file]',
                        'textarea'
                        ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                    $errorMessage.addClass('hide');
                    $('.has-error').removeClass('has-error');
                    $inputs.each(function(i, el) {
                        var $input = $(el);
                        if ($input.val() === '') {
                            $input.parent().addClass('has-error');
                            $errorMessage.removeClass('hide');
                            e.preventDefault();
                        }
                    });
                    if (!$form.data('cc-on-file')) {
                        e.preventDefault();
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                        }, stripeResponseHandler);
                    }
            });
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
@endsection()

