<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/forms/icheck/icheck.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/forms/validation/form-validation.css">
</head>
<body id="courses-list-sidebar" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php");
$uricode = decryptID($this->uri->segment(2));
if($uricode['0'] != 'CP'){
	$merchant_order_id = time().$itemInfo['id'];
	$course_title      = $itemInfo['course_title'];
	$amount            = $itemInfo['fee'];
	$course_image      = $itemInfo['course_image'];
	$module_id				 = $itemInfo['id'];
}else{
	$merchant_order_id = time();
	$course_title      = "Complete Package";
	$amount            = $itemInfo['fee'];
	$module_id				 = 1100;
	$course_image      = base_url('app-assets/images/dummy.png');
}
$txnid 				     = time();
$surl 				     = $surl;
$furl 				     = $furl;        
$key_id 			     = RAZOR_KEY_ID;
$name 				     = APPLICATION_NAME;
$currency_code 		 = $currency_code;
$total 				     = ($amount * 100);
?>
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>CHECKOUT</h2>
		</div>
	</div>
	<div class="container view-cart checkout">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-info checkout-user-details">
					<div class="panel-heading">User Details</div>
					<div class="panel-body">
						<?php if($this->session->flashdata('alertmessage')) {
              $message = $this->session->flashdata('alertmessage'); ?>
              <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <?php echo $message['message']; ?>
              </div>
            <?php } ?>
						<div class="otp_return_msgs"></div>
						<?php if(!empty($this->session->userdata('id'))){ ?>
							<div class="form-group col-md-8">
	              <input type="text" class="form-control" name="fullname" readonly="true" value="<?php echo $this->session->userdata('fullname'); ?>">
	            </div>
	            <div class="form-group col-md-8">
	              <input type="email" class="form-control" name="email" readonly="true" value="<?php echo $this->session->userdata('email'); ?>">
	            </div>
	            <div class="form-group col-md-8">
	              <input type="text" class="form-control" name="phone" readonly="true" value="<?php echo $this->session->userdata('phone'); ?>">
	            </div>
						<?php }else{ ?>
							<div class="form-group col-md-8">
	              <input type="text" class="form-control" name="email_mobile" id="email_mobile" maxlength="auto" autocomplete="off" placeholder="Enter Email / Mobile Number" value="">
	              <div class="email_mobile-msg-block"></div>
	            </div>
	            <div class="form-group col-md-8">
	            	<button type="button" class="btn btn-primary" id="cart_countinue_btn">CONTINUE</button>
	            </div>
          	<?php } ?>
						<form action="<?php echo base_url('check-out/'.$this->uri->segment(2)); ?>" method="post" accept-charset="utf-8">
							<div class="login-area" style="display: none;">
								<input type="hidden" name="login_with_email" class="login_with_email" value="">
								<input type="hidden" name="redirect_id" value="<?php echo $this->uri->segment(2);?>">
								<div class="form-group col-md-8" id="loginPasswordDiv">
									<input type="password" class="form-control" name="login_with_password" id="login_with_password" maxlength="auto" autocomplete="off" value="" placeholder="Enter Password" required="" autofocus="">
									<!-- <a href="#" class="forgot-psd" tabindex="-1"><span>Forgot?</span></a> -->
									<div class="login_pwd_req_msg"></div>
								</div>
								<div class="form-group col-md-8" id="loginOTPdiv" style="display: none;">
									<input type="text" class="form-control" name="login_with_otp" id="login_with_otp" maxlength="auto" autocomplete="off" placeholder="Enter OTP">
									<div class="login_otp_response" style="display: none;">
										<img src="<?php echo base_url(); ?>/assets/images/red.png" alt="right OTP" style="width: 20px;float: right;margin: -28px;">
									</div>
									<div class="login_otp_req_msg"></div>
								</div>
								<div class="form-group col-md-8">
									<input type="checkbox" name="otp_checkbox" id="otp_checkbox"><label for="otp_checkbox">&nbsp;&nbsp;Login with OTP</label>
								</div>
								<div class="form-group col-md-8">
									<input type="submit" class="btn btn-primary" id="loginBtn" name="login_btn_checkout" value="login">
								</div>
							</div>
						</form>
						<form action="<?php echo base_url('checkout/'.$this->uri->segment(2)); ?>" method="request" novalidate accept-charset="utf-8">
							<div class="signup-area" style="display: none;">
								<input type="hidden" name="new_user_email" id="new_user_email">
								<input type="hidden" name="new_user_phone" id="new_user_phone">
								<input type="hidden" name="redirect_id" value="<?php echo $this->uri->segment(2);?>">
								<div class="form-group col-md-8 tick-active">
									<input type="text" class="form-control" name="otp" id="otp" maxlength="auto" autocomplete="off" value="" placeholder="Enter OTP" required="" autofocus="">
									<div class="otp_response" style="display: none;">
										<img src="<?php echo base_url(); ?>/assets/images/red.png" alt="wrong OTP" style="width: 20px;float: right;margin: -28px;">
									</div>
									<div class="reg_otp_msg"></div>
								</div>
								<div class="form-group col-md-8" id="reg_fullname_div" style="display: none;">
									<input type="text" class="form-control" name="reg_fullname" id="reg_fullname"autocomplete="off" placeholder="Enter Full Name" value="" required="" autofocus="">
									<div class="reg_fullname_msg"></div>
								</div>
								<div class="form-group col-md-8" id="reg_phone_div" style="display: none;">
									<input type="number" class="form-control" name="reg_phone" id="reg_phone" maxlength="auto" autocomplete="off" placeholder="Enter Contact Number" value="" required="" autofocus="">
									<div class="reg_phone_msg"></div>
								</div>
								<div class="form-group col-md-8" id="reg_email_div" style="display: none;">
									<input type="email" class="form-control" name="reg_email" id="reg_email" autocomplete="off" placeholder="Enter Email Address" value="" required="">
									<div class="email-help-block"></div>
									<div class="reg_email_msg"></div>
								</div>
								<span class="text-danger align-middle"></span>
								<div class="form-group col-md-8">
									<input type="password" class="form-control" name="reg_password" id="reg_password" maxlength="auto" autocomplete="off" value="" placeholder="Set Password" required="" autofocus="" disabled="">
									<div class="reg_pwd_req_msg"></div>
									<div class="reg_password_msg"></div>
								</div>
								<span class="text-danger align-middle"></span>
								<div class="form-group col-md-8">
									<input type="submit" class="btn btn-primary" id="signupBtn" name="signup" value="Signup">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 review">
				<div class="panel panel-info">
					<div class="panel-heading"> Review Order </div>
					<div class="panel-body checkout-review-order">
						<div class="col-sm-12">
							<div class="col-sm-3 col-xs-3">
								<img class="img-responsive" src="<?php echo $course_image; ?>" />
							</div>
							<div class="col-sm-7 col-xs-7">
								<div class="col-xs-12">
									<h4><?php echo $course_title; ?></h4>
								</div>
							</div>
							<div class="col-sm-2 col-xs-2 text-right">
								<h6><span><i class="fa">&#xf156;</i></span><?php echo $amount; ?></h6>
							</div>
						</div>
						<div class="col-sm-12">
							<hr class="hr1"/>
						</div>
						<div class="col-sm-12">
							<div class="col-xs-12">
								<strong>Subtotal</strong>
								<div class="pull-right">
									<span><i class="fa">&#xf156;</i></span>
									<span><?php echo $amount; ?></span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<hr class="hr2" />
						</div>
						<div class="col-xs-12">
							<strong>Order Total</strong>
							<div class="pull-right">
								<span><i class="fa">&#xf156;</i></span>
								<span><?php echo $amount; ?></span>
							</div>
						</div>
						<?php if(!empty($this->session->userdata('id'))){ ?>
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button type="button" value="Pay Now" id="createUsernOrder" name="createUsernOrder" class="btn btn-theme col-md-12 col-sm-12 col-xs-12">
								Place Order
								</button>
								<input id="submit-pay" type="hidden" onclick="razorpaySubmit(this);" value="Pay Now"/>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
	<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="<?php echo $merchant_order_id; ?>"/>
	<input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
	<input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
	<input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $course_title; ?>"/>
	<input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
	<input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
	<input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="User"/>
	<input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
	<input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('id'); ?>"/>
	<input type="hidden" name="module_id" id="module_id" value="<?php echo $module_id; ?>"/>
	<input type="hidden" name="complete_package" id="complete_package" value="0"/>
	<!-- razorpay options -->
	<input type="hidden" name="key_id" id="key_id" value="<?php echo $key_id; ?>"/>
	<input type="hidden" name="name" id="name" value="<?php echo $name; ?>"/>
	<input type="hidden" name="orderdescription" id="orderdescription" value="Order # <?php echo $merchant_order_id; ?>"/>
	<input type="hidden" name="currency_code" id="currency_code" value="<?php echo $currency_code; ?>"/>
	<input type="hidden" name="ifemailphoneexists" id="ifemailphoneexists" value="0"/>
</form>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/autocomplete.js" type="text/javascript"></script> 
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#cart_countinue_btn').on('click', function () {                
	    var email_mobile = $("#email_mobile").val();
	    var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    var phoneregex      = /^\d{10}$/;
	    $(".email_mobile-msg-block ul").remove();
	    if(email_mobile == '')
	    {
	    	$('#email_mobile').closest('.form-group').addClass('error').removeClass('validate');
	      $("#email_mobile").attr("aria-invalid", "true").next(".email_mobile-msg-block").html("<ul><li>Please enter valid Email address or Mobile number.</li></ul>").css('color', 'red');
	    }else{
	      if (emailReg.test(email_mobile)) 
	      {
	        $("#new_user_email").val(email_mobile);
	        $.ajax(
	        {
	          type: 'post',
	          url:  '<?php echo base_url("check/ifuserexists"); ?>',
	          data:  {email: email_mobile},
	          success: function(data)
	          {
	            $("#reg_phone_div").css('display', 'block');
	            $("#reg_fullname_div").css('display', 'block');
	            $('#email_mobile').attr('disabled', 'disabled');
	            if (data.length != 6) 
	            {
	              $('.login_with_email').val(email_mobile); 
	              $('.login-area').css('display', 'block');
	              $('#cart_countinue_btn').css('display', 'none');
	            }else{
	              $(".otp_return_msgs").html('<div class="alert alert-success">OTP has been successfully sent to your Email id.</div>').fadeIn().fadeOut(10000);
	              $("#reg_phone").val('');
	              localStorage.setItem("otp", data);
	              $('.signup-area').css('display', 'block');
	              $('#cart_countinue_btn').css('display', 'none');
	            }
	          }
	      	});
	      }else if(phoneregex.test(email_mobile))
	      {
	        $("#new_user_phone").val(email_mobile);
	        $.ajax(
	        {
	          type: 'post', 
	          url:  '<?php echo base_url("check/ifuserexists"); ?>',
	          data:  {mobile: email_mobile},
	          success: function(data)
	          {
	          	$("#reg_email_div").css('display', 'block'); 
	          	$("#reg_fullname_div").css('display', 'block'); 
	            $('#email_mobile').attr('disabled', 'disabled');

	            if (data.length != 6) 
	            {
	              $('.login_with_email').val(email_mobile); 
	              $('.login-area').css('display', 'block');
	              $('#cart_countinue_btn').css('display', 'none');
	            }else{
	              $(".otp_return_msgs").html('<div class="alert alert-success">OTP has been successfully sent to your Phone.</div>').fadeIn().fadeOut(10000);
	              $('.signup-area').css('display', 'block');
	              $('#cart_countinue_btn').css('display', 'none');
	              localStorage.setItem("otp", data);
	            }
	          }
	        });
	      }
	      $('.login_with_email').val(email_mobile);
	    }
		});
		
		$("#login_with_otp").bind("change", function() {
	    var storedOTP = localStorage.otpval;
	    var userOTP = $("#login_with_otp").val();
	    $(".login_otp_req_msg ul").remove();

	    if (storedOTP == userOTP) 
	    {
	      $('.login_otp_response').css('display', 'block');
	      $('.login_otp_response img').attr('src','<?php echo base_url(); ?>/assets/images/green.png');
	      $('#loginBtn').attr('disabled', false);
	    	localStorage.removeItem('otpval');
	    }else{
	    	$('#login_with_otp').closest('.form-group').addClass('error').removeClass('validate');
	      $("#login_with_otp").attr("aria-invalid", "true").next(".login_otp_req_msg").html("<ul><li>OTP is incorrect.</li></ul>").css('color', 'red');
	      $('.login_otp_response').css('display', 'block');
	      $('.login_otp_response img').attr('src','<?php echo base_url(); ?>/assets/images/red.png');
	      $('#login_with_password').closest('.form-group').addClass('validate').removeClass('error');
	      $('#login_with_password').attr("aria-invalid", "false");
	      $('#loginBtn').attr('disabled', true);
	    }
		})

		$('#loginBtn').on('click', function(){
			var email = $('.login_with_email').val();
			var login_with_password = $('#login_with_password').val();
			var login_with_otp = $('#login_with_otp').val();
			var loginBtn = $('#loginBtn').val();
			var redirect_id = $('input[name="redirect_id"]').val();

			$.ajax(
			{
				type: 'post', 
				url:  '<?php echo base_url("check-out/'+redirect_id+'"); ?>',
				data:  {
					email: email,
					login_with_password: login_with_password,
					login_with_otp: login_with_otp,
					redirect_id: redirect_id,
					loginBtn: loginBtn
				},
				success: function(res)
				{   
				  //location.reload();
				  window.location = "<?php echo base_url('check-out/'.$this->uri->segment(2)); ?>";
				}
			});
		})

	  $('#otp').bind('change', function(){
	    var storedOTP = localStorage.getItem('otp');
	    var userOTP = $("#otp").val();
	    $(".reg_otp_msg ul").remove();
	    if (storedOTP == userOTP) 
	    {
	      $('.login_otp_response').css('display', 'block');
	      $('.login_otp_response img').attr('src','<?php echo base_url(); ?>/assets/images/green.png');
	      $('#reg_password').attr('disabled', false);
	    }else{

	      $(".reg_otp_msg").append("<ul><li>OTP is incorrect.</li></ul>").css('color', 'red');
	      $('.login_otp_response img').attr('src','<?php echo base_url(); ?>/assets/images/red.png');
	      $('.login_otp_response').css('display', 'none').fadeIn().fadeOut(10000);
	      $('#reg_password').attr('disabled', true);
	    }
	  });

	  $('#otp_checkbox').on('click', function(){
	    if ($(this).is(":checked")) 
	    {
	      var email_mobile = $("#email_mobile").val();
	      var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	      var phoneregex = /^\d{10}$/;
	      if (emailReg.test(email_mobile)) 
	      {
	        $.ajax(
	        {
	          type: 'post', 
	          url:  '<?php echo base_url("sendotp"); ?>',
	          data:  {email: email_mobile},
	          success: function(res)
	          {   
	            if (res.length == 6) 
	            {
	            	console.log(res);
								$(".otp_return_msgs").html('<div class="alert alert-success">OTP has been successfully sent to your Email Id</div>').fadeIn().fadeOut(10000);
								$('#login_with_password').removeAttr('required');
								$('#login_with_password').removeAttr('autofocus');
								$('#login_with_otp').attr('required');
								$('#login_with_otp').attr('autofocus');

								$("#loginOTPdiv").show();
								$("#loginPasswordDiv").hide();
	            	localStorage.otpval = res;
	            }
	          }
	        });
	      }else if(phoneregex.test(email_mobile))
	      {
	        $.ajax(
	        {
	          type: 'post', 
	          url:  '<?php echo base_url("sendotp"); ?>',
	          data:  {mobile: email_mobile},
	          success: function(res)
	          {
	            if (res.length == 6) 
	            {
	            	console.log(res);
	              $(".otp_return_msgs").html('<div class="alert alert-success">OTP has been successfully sent to your mobile</div>').fadeIn().fadeOut(10000);

	              $('#login_with_password').removeAttr('required');
	              $('#login_with_password').removeAttr('autofocus');
	              $('#login_with_otp').attr('required', true);
	              $('#login_with_otp').attr('autofocus', true);

	              $("#loginOTPdiv").show();
	              $("#loginPasswordDiv").hide();
	            	localStorage.otpval = res;
	            }
	          }
	        });
	      }
	    }else{
	      $("#loginOTPdiv").hide();
	      $("#loginPasswordDiv").show();
	      $('#login_with_otp').removeAttr('required');
	      $('#login_with_otp').removeAttr('autofocus');
	      $('#login_with_password').attr('required', true);
	      $('#login_with_password').attr('autofocus', true);
	    }
	  });
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
	  $("#reg_email").bind('blur', function(){
	    var emailid = $('#reg_email').val();
	    $('.email-help-block ul').remove(); 
	    $.ajax({
	      url: '<?php echo base_url(); ?>checkemail',
	      data: { emailid:emailid },
	      type: 'POST',
	      success: function(response)
	      {
	      	console.log(response.length);
	      	console.log(response);

	        if (response.length > 0) 
	        {
	          if($.trim(response))
	          {
	            $('#reg_email').closest('.form-group').addClass('error');
	            $('#reg_email').closest('.form-group').removeClass('validate');
	            $("#reg_email").attr("aria-invalid", "true");
	            $("#reg_email").next(".email-help-block").append('<ul><li>This Email ID is already exists. Please login to buy course.</li></ul>').css('color','red');
	            $("#createUsernOrder").attr("disabled", true);
	          }
	        }else
	        {
	          $("#createUsernOrder").attr("disabled", false);
	        }
	      },
	      error: function(err)
	      {
	        console.log(err);
	      }
	    });
	  });
	     

		$('#createUsernOrder').on('click', function()
		{
			$('#submit-pay').click();
		});
	});
	  
	var razorpay_options = {
	  key: $('#key_id').val(),
	  amount: $('#merchant_total').val(),
	  name: $('#name').val(),
	  description: $('#orderdescription').val(),
	  netbanking: true,
	  currency: $('#currency_code').val(),
	  prefill: <?php if(!empty($this->session->userdata('id'))){ ?>{ name: '<?php echo $this->session->userdata('fullname'); ?>', email: '<?php echo $this->session->userdata('email'); ?>', contact: '<?php echo $this->session->userdata('phone'); ?>' }<?php }else{ ?>{ name:$('#reg_fullname').val(), email: $('#reg_email').val(), contact: $('#phone_number').val() }<?php } ?>,
	  notes: {
	    soolegal_order_id: "<?php echo $merchant_order_id; ?>",
	  },
	  handler: function (transaction) {
	      document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
	      document.getElementById('razorpay-form').submit();
	  },
	  "modal": {
	      "ondismiss": function(){ }
	  }
	};
	var razorpay_submit_btn, razorpay_instance;

	function razorpaySubmit(el){
	  if(typeof Razorpay == 'undefined'){
	    setTimeout(razorpaySubmit, 200);
	    if(!razorpay_submit_btn && el){
	      razorpay_submit_btn = el;
	      el.disabled = true;
	      el.value = 'Please wait...';  
	    }
	  } else {
	    if(!razorpay_instance){
	      razorpay_instance = new Razorpay(razorpay_options);
	      if(razorpay_submit_btn){
	        razorpay_submit_btn.disabled = false;
	        razorpay_submit_btn.value = "Pay Now";
	      }
	    }
	    razorpay_instance.open();
	  }
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#signupBtn').on('click', function(){
			var redirect_id = $('input[name="redirect_id"]').val();
			var otp = $('#otp').val();
			var new_user_email = $('#new_user_email').val();
			var new_user_phone = $('#new_user_phone').val();
			var reg_fullname = $('#reg_fullname').val();
			var reg_phone = $('#reg_phone').val();
			var reg_email = $('#reg_email').val();
			var reg_password = $('#reg_password').val();
			var signupBtn = $('#signupBtn').val();

			if(validate(reg_fullname,reg_email,reg_password,reg_phone)){

				$.ajax(
				{
					type: 'post', 
					url:  '<?php echo base_url("check-out/'+redirect_id+'"); ?>',
					data:  {
						redirect_id: redirect_id,
						otp: otp,
						new_user_email: new_user_email,
						new_user_phone: new_user_phone,
						reg_fullname: reg_fullname,
						reg_phone: reg_phone,
						reg_email: reg_email,
						reg_password: reg_password,
						signupBtn: signupBtn
					},
					success: function(res)
					{   
					  //location.reload();
					  window.location = "<?php echo base_url('check-out/'.$this->uri->segment(2)); ?>";
					}
				});
			}
		})
	})
</script>
<script type="text/javascript">
	function validate(reg_fullname,reg_email,reg_password,reg_phone)
  {
  	var alpharegex 		= /^[\a-zA-Z ]*$/;
		var emailregex 		= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var phoneregex		= /^\d{10}$/;
  	var fullname 	  = reg_fullname.trim();
		var email_address = reg_email.trim();
		var phone_number  = reg_phone.trim();
		var password 	  = reg_password.trim();
		var flag 		  = true;

		if (fullname == '') 
		{
			$('#reg_fullname').closest('.form-group').addClass('error').removeClass('validate');
      $("#reg_fullname").attr("aria-invalid", "true").next(".reg_fullname_msg").html('<ul><li>This field is required.</li></ul>').css('color','red');
      flag = false;
    }
    if (!alpharegex.test(fullname)) 
		{
			$('#reg_fullname').closest('.form-group').addClass('error').removeClass('validate');
      $("#reg_fullname").attr("aria-invalid", "true").next(".reg_fullname_msg").html('<ul><li>valid inputs are a-z, A-Z.</li></ul>').css('color','red');
      flag = false;
    }
		if (email_address == '') 
		{
			$('#reg_email').closest('.form-group').addClass('error').removeClass('validate');
			$("#reg_email").attr("aria-invalid", "true").next(".reg_email_msg").html('<ul><li>This field is required.</li></ul>').css('color','red');
			flag = false;
		}
		if (!emailregex.test(email_address)) 
		{
			$('#reg_email').closest('.form-group').addClass('error').removeClass('validate');
			$("#reg_email").attr("aria-invalid", "true").next(".reg_email_msg").html('<ul><li>please enter a valid email</li></ul>').css('color','red');
			flag = false;
		}
		if (password == '') 
		{
			$('#reg_password').closest('.form-group').addClass('error').removeClass('validate');
			$("#reg_password").attr("aria-invalid", "true").next(".reg_pwd_req_msg").html('<ul><li>This field is required.</li></ul>').css('color','red');
			flag = false;
		}      
		if (phone_number == '') 
		{
			$('#reg_phone').closest('.form-group').addClass('error').removeClass('validate');
			$("#reg_phone").attr("aria-invalid", "true").next(".reg_phone_msg").html('<ul><li>This field is required.</li></ul>').css('color','red');
			flag = false;
		}    
		if (!phoneregex.test(phone_number)) 
		{
			$('#reg_phone').closest('.form-group').addClass('error').removeClass('validate');
			$("#reg_phone").attr("aria-invalid", "true").next(".reg_phone_msg").html('<ul><li>10 digit number only.</li></ul>').css('color','red');
			flag = false;
		}
		return flag;
	}
</script>