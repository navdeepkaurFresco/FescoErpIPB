<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/pickers/daterange/daterange.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">

<body id="courses-list-sidebar" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>REGISTRATION</h2>
		</div>
	</div>
	<section class="container-fluid">
		<div class="container" style="margin: 3% 0">
			<div class="row">
				<?php $message = $this->session->flashdata('alertmessage_StudentSignup');
				if($message && $message['class'] == "success") { ?>
          <div class="col-md-offset-2 col-md-9 register-success-msg">
						<h2>Welcome <span class="username"><?php echo $message['name']; ?></span>,</h2>
						<h3 class="h3-first">We are <b><i>Happy</i></b> :) to have you on IPB E-Learning Portal. </h3>
						<h3>Please click  <a href="<?php echo base_url('student/home'); ?>">here</a> to explore more about this platform. </h3>
					</div>
        <?php } else { if($this->session->flashdata('alertmessage_StudentSignup')){
      	$message = $this->session->flashdata('alertmessage_StudentSignup'); ?>
          <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
          	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
              	<span aria-hidden="true">×</span>
          	</button>
            <?php echo $message['message']; ?>
          </div>
      	<?php } ?>
      	<div class="col-md-offset-2 col-md-9 rgtfrm">
					<?php echo form_open('signup','novalidate', array('id'=>'register-form')); ?>
						<div class="form-body">
							<div class="form-group col-md-12">
								<div class="controls">
									<div class="input-field">
										<i class="fa fa-user icon"></i>
										<input type="text" class="form-control" name="fullname" data-validation-regex-regex="([\a-zA-Z ]+)" id="fullname" placeholder="Full Name*" data-validation-regex-message="valid inputs are a-z, A-Z" required data-validation-required-message="This field is required">
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="controls">
									<div class="input-field">
										<i class="fa fa-phone icon"></i>
										<input type="number" class="form-control" name="phone" id="phone" placeholder="Contact Number*" required data-validation-required-message="This field is required" minlength="10" maxlength="10">
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="controls">
									<div class="input-field">
										<i class="fa fa-envelope icon"></i>
										<input type="email" class="form-control" name="email" id="email" placeholder="Email*" required data-validation-required-message="This field is required">
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="controls">
									<div class="input-field">
										<i class="fa fa-key icon"></i>
										<input type="password" class="form-control" name="password" id="password" placeholder="Password*" required data-validation-required-message="This field is required">
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<div class="controls">
									<div class="input-field">
										<i class="fa fa-book icon"></i>
										<select class="form-control" name="qualification" id="qualification" required data-validation-required-message="This field is required">
											<option value="">Select Qualification*</option>
											<?php 
												$educationList = educationList();
												foreach ($educationList as $value) { ?>
													<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group col-md-12">								  
								<button type="submit" name="create_new_student" id="create_new_student" class="btn btn-register" value="submit">Submit</button>	
								<a href="https://ipb.thefresconews.com/login" class="already">Already have an account? Sign in</a>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			<?php } ?>
			</div>
		</div>
	</section>
</main>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
	$("#fullname").on('change', function(){
		var fullname = $('#fullname').val().trim();
		if(fullname.length==0){
			$('#fullname').closest('.form-group').addClass('error');
	    $('#fullname').closest('.form-group').removeClass('validate');
	    $("#fullname").attr("aria-invalid", "true");
	    $("#fullname").next(".help-block").append('<ul><li>Blank spaces are not valid input for fullname.</li></ul>').css('color','red');
			$("#create_new_student").attr("disabled", false);
		}
	});
	$("#email").on('change',function(){
		var emailid = $('#email').val(); 
		$.ajax({
			url: '<?php echo base_url(); ?>checkemail',
			data: { emailid:emailid },
			type: 'POST',
			success: function(response){
				console.log(response);
				if (response.length > 0){
					if($.trim(response)){
				    $('#email').closest('.form-group').addClass('error');
				    $('#email').closest('.form-group').removeClass('validate');
				    $("#email").attr("aria-invalid", "true");
				    $("#email").next(".help-block").append('<ul><li>This Email ID is already exists. Please provide another Email.</li></ul>').css('color','red');
				    $("#create_new_student").attr("disabled", true);
					}
				}else{
				  $("#create_new_student").attr("disabled", false);
				}
			},
			error: function(err){
				console.log(err);
			}
		});
	});
});
</script>
</body>
</html>