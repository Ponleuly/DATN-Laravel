<?php
	use App\Models\Sizes;
	use App\Models\Products_Attributes;
	use App\Models\Products;
	use App\Models\Products_Sizes;
?>
<style>
	    #cartTable td {
	      padding:6px;
	    }
	    #cartTable td:nth-of-type(2){
	      text-align:right
	    }

	    #ticket:before {
	      content:"";
	      background:#fff;
	      width:32px;
	      height:32px;
	      position:absolute;
	      top:-16px;
	      left:-16px;
	      border-radius:100%;
	    }
	    #ticket:after {
	      content:"";
	      background:#fff;
	      width:32px;
	      height:32px;
	      position:absolute;
	      top:-16px;
	      right:-16px;
	      border-radius:100%;
	    }
	    #ticket {
	      background:#dde8f0;
	      border-top:1px dashed #bdbdbd;
	      position:relative;
	      border-bottom-left-radius:12px;
	      border-bottom-right-radius:12px;
	    }
	    #cardNumber {
	      padding-right:60px;
	    }
	    #cardType {
	      width:58px;
	      height:36px;
	      background:url('/static_files/images/cardLogos.png') no-repeat;
	      background-size:auto 100%;
	      background-position: -59px;
	      position:absolute;
	      right:10px;
	      top:5px;
	    }
</style>
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
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-5 mb-md-0" >
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
                                        <div class="col-5">
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
										Pay Now
									</button>
								</div>
							</div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-5 mb-md-0">
                        <div class="p-3 p-lg-4 border bg-white">
							<h2 class="h3 mb-3 text-black">Your Invoice</h2>
                            <div style="background:#eff4f8;border-radius:16px;">
                                <div class="p-4">
                                    <table class="w-100" id="cartTable">
                                        <tr>
                                            <td><span class="text-secondary">Order </span></td>
                                            <td><strong>#{{$invoiceCode}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-secondary">Amount</span></td>
                                            <td><strong>$ {{$amount}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-secondary">Delivery Fee</span></td>
                                            <td><strong>$ {{$deliveryFee}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-secondary">Discount</span></td>
                                            <td><strong>$ {{$discount}}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div id="ticket">
                                    <div class="d-flex p-4 align-items-center justify-content-between">
                                    <div>
                                        <small class="text-secondary">Total Paid</small>
                                        <div class="fs-2"><strong>$ {{$totalPaid}}</strong></div>
                                    </div>
                                    <div>
                                        <img src="/static_files/svgs/shop.svg" width="48" alt="">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://js.stripe.com/v2/"></script>
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

