<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<body id="course-single" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>Contact Us</h2>
		</div>
	</div>
	
	<div class="container success">
		<div class="row">
			<?php if($this->session->flashdata('contact_alertmessage')) {
		        $message = $this->session->flashdata('contact_alertmessage'); ?>
		        <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
		        	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		            	<span aria-hidden="true">×</span>
		        	</button>
		          <?php echo $message['message']; ?>
		        </div>
		    <?php } ?>
		</div>
		<div class="row">
			<?php echo form_open('contact', array('novalidate'=>'novalidate','class'=>'contact col-md-6')); ?>
				<input type="hidden" name="lat" id="lat" />
                <input type="hidden" name="lng" id="lng" />
				<div class="row">
					<div class="col-sm-6 form-group">
						<label class="req">NAME</label>
					  	<div class="controls">
					    	<input type="text" name="senderName" id="name" placeholder="Enter your Name" data-validation-regex-regex="([\a-zA-Z ]+)" data-validation-regex-message="valid inputs are a-z, A-Z" required data-validation-required-message="This field is required">
						</div>
					</div>
					<div class="col-sm-6 form-group">
						<label class="req">CONTACT</label>
					  	<div class="controls">
					    	<input type="number" name="phone" id="phone" placeholder="Enter your Contact Number" required data-validation-required-message="This field is required" minlength="10" maxlength="10">
						</div>						
					</div>					
				</div>
				<div class="row">					
					<div class="col-sm-12 form-group">
						<label class="req">E-MAIL ADDRESS</label>
					  	<div class="controls">
					    	<input type="email" name="email" id="email" placeholder="Enter your e-mail" required data-validation-required-message="This field is required">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<label class="req">Address</label>
					  	<div class="controls">
					    	<input type="text" name="address" id="autocomplete" onFocus="geolocate()" placeholder="Enter your Address" required data-validation-required-message="This field is required">
						</div>
					</div>
					<div class="col-sm-6 form-group">
						<label class="req">City/Village/Town</label>
					  	<div class="controls">
					    	<input type="text" name="city" id="locality" placeholder="Enter your City/Village/Town" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)" data-validation-regex-message="valid inputs are a-z, A-Z">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="controls">
						<div class="col-sm-4 form-group">
							<label class="req">STATE</label>
							<div class="controls">
								<!-- <input type="text" name="state" id="administrative_area_level_1" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="State*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z"> -->
								<select name="state" class="form-control" id="administrative_area_level_1" data-validation-regex-regex="([\a-zA-Z ]+)" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z">
									<option value="">Choose State</option>
									<?php if(!empty($allStates)){
										foreach ($allStates as $singleState) {
											echo '<option value="'.$singleState['state_name'].'">'.$singleState['state_name'].'</option>';
										}
									}?>
								</select>
							</div>
						</div>
						<div class="col-sm-4 form-group">
							<label class="req">DISTRICT</label>
							<div class="controls">
								<input type="text" name="district" id="administrative_area_level_2" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="District*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z">
							</div>
						</div>
						<div class="col-sm-4 form-group">
						<label class="req">PIN CODE</label>
						<div class="controls">
							<input type="text" id="postal_code" name="pincode" placeholder="Postal Code" required data-validation-regex-regex="([\da-z]+)" data-validation-regex-message="valid inputs are a-z, 0-9" data-validation-required-message="This field is required" maxlength="10">
						</div>
					</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-sm-12 form-group">
						<label class="req">SUBJECT</label>
					  	<div class="controls">
					    	<input type="text" name="subject" id="subject" placeholder="Enter your subject" required data-validation-required-message="This field is required">
						</div>
					</div>
				</div>
				<div class="row">					
					<div class="col-sm-12 form-group">
						<label class="req">MESSAGE</label>
					  	<div class="controls">
							<textarea name="name" placeholder="type in a message" required></textarea>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-sm-12">
						<div class="pull-right">
							<button type="submit" class="greybutton" name="send_contact_request" value="send">SUBMIT</button>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
			<div class="col-md-6">
				<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m19!1m8!1m3!1d219587.71920318026!2d76.782122!3d30.688641!3m2!1i1024!2i768!4f13.1!4m8!3e0!4m0!4m5!1s0x390f93613f04ce39%3A0x2abff097a0772af1!2sInstitute+of+Professional+Banking%2C+SCO-11%2C+Level+II%2C+Sector-11%2C+Panchkula%2C+Haryana+134115!3m2!1d30.68866!2d76.85216199999999!5e0!3m2!1sen!2sin!4v1540985917986" width="600" height="550" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			</div>
		</div>	
	</div>
</main>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/autocomplete.js" type="text/javascript"></script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtUZEucyyJ-ceAAzcu63KRbem-Zi-W7ZA&libraries=places&callback=initAutocomplete" async defer></script>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>
<!-- <script type="text/javascript">
	$(document).ready(function()
	{
		$("#state").on("change",function(){
	      		changedistrict(this.value);
	      	});
	});
</script> -->