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
	      $('.login_otp_response img').attr('src','/assets/images/green.png');
	      $('#loginBtn').attr('disabled', false);
	    	localStorage.removeItem('otpval');
	    }else{
	    	$('#login_with_otp').closest('.form-group').addClass('error').removeClass('validate');
	      $("#login_with_otp").attr("aria-invalid", "true").next(".login_otp_req_msg").html("<ul><li>OTP is incorrect.</li></ul>").css('color', 'red');
	      $('.login_otp_response').css('display', 'block');
	      $('.login_otp_response img').attr('src','/assets/images/red.png');
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
	      $('.login_otp_response img').attr('src','/assets/images/green.png');
	      $('#reg_password').attr('disabled', false);
	    }else{

	      $(".reg_otp_msg").append("<ul><li>OTP is incorrect.</li></ul>").css('color', 'red');
	      $('.login_otp_response img').attr('src','/assets/images/red.png');
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
		})
	})
</script>
<!-- <script type="text/javascript">
	function validate()
  {
  	var alpharegex 		= /^[\a-zA-Z ]*$/;
		var emailregex 		= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var phoneregex		= /^\d{10}$/;
  	var fullname 	  = $('#fullname').val().trim();
		var email_address = $('#email_address').val().trim();
		var phone_number  = $('#phone_number').val().trim();
		var password 	  = $('#login_with_password').val().trim();
		var flag 		  = true;

		if (fullname == '') 
		{
			$('#fullname').closest('.form-group').addClass('error').removeClass('validate');
      $("#fullname").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
      flag = false;
    }
    if (!alpharegex.test(fullname)) 
		{
			$('#fullname').closest('.form-group').addClass('error').removeClass('validate');
      $("#fullname").attr("aria-invalid", "true").next(".help-block").html('<ul><li>valid inputs are a-z, A-Z.</li></ul>').css('color','red');
      flag = false;
    }
		if (email_address == '') 
		{
			$('#email_address').closest('.form-group').addClass('error').removeClass('validate');
			$("#email_address").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
			flag = false;
		}
		if (!emailregex.test(email_address)) 
		{
			$('#email_address').closest('.form-group').addClass('error').removeClass('validate');
			$("#email_address").attr("aria-invalid", "true").next(".help-block").html('<ul><li>please enter a valid email</li></ul>').css('color','red');
			flag = false;
		}
		if (password == '') 
		{
			$('#login_with_password').closest('.form-group').addClass('error').removeClass('validate');
			$("#login_with_password").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
			flag = false;
		}      
		if (phone_number == '') 
		{
			$('#phone_number').closest('.form-group').addClass('error').removeClass('validate');
			$("#phone_number").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
			flag = false;
		}    
		if (!phoneregex.test(phone_number)) 
		{
			$('#phone_number').closest('.form-group').addClass('error').removeClass('validate');
			$("#phone_number").attr("aria-invalid", "true").next(".help-block").html('<ul><li>10 digit number only.</li></ul>').css('color','red');
			flag = false;
		}
		return flag;
	}
</script> -->