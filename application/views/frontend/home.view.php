<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/forms/icheck/icheck.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/style.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/forms/validation/form-validation.css">
<body id="index1" class="homepage">
	<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>
	<div class="container-fluid top-banner" >
		<div class="row">
			<div class="col-md-6">
				<div class="header-text hidden-xs">
					<div class="col-md-12 text-center">
						<h2>Be a Smart <br/>Banker</h2>
						<p>Get Employed with Top Private <br/>Sector Bank / Foreign Bank / NBFC</p>
						<a href="<?php echo site_url('modules'); ?>" class="btn btn-theme">BUY A COURSE</a> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<main>
		<div><script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "url": "https://ipb.thefresconews.com/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://ipb.thefresconews.com/search/{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script></div>
		<div class="container">
			<div class="row">
				<div class="col-sm-8 bank">
					<h3 class="text-center">Being an IPB student you can</h3>
					<div class="col-md-3" style="padding: 0 30px;">
						<img src="<?php echo base_url(); ?>/assets/images/Career-Humpstart-and-earn.png">
					</div>
					<div class="col-md-3" style="padding: 0 30px;">
						<img src="<?php echo base_url(); ?>/assets/images/enhance-your-career.png">
					</div>
					<div class="col-md-3" style="padding: 0 30px;">
						<img src="<?php echo base_url(); ?>/assets/images/Trained-&-Certified.png">
					</div>
					<div class="col-md-3" style="padding: 0 30px;">
						<img src="<?php echo base_url(); ?>/assets/images/004-hour.png">
					</div>
					<div class="col-md-12">
						<ul>
							<li>Career Jumpstart - Earn up to Rs. 25,000/month</li>
							<li>Enhance your professional career to next progression</li>
							<li>Get professionally trained and certified</li>
							<li>Just spend 6hours/Day</li>
							<li>Get recognized as a Banker</li>
						</ul>
					</div>
					<div class="col-md-12 sec-ban">
						<img src="<?php echo base_url(); ?>/assets/images/benefits.png">	
						<a href="<?php echo base_url('banking-as-career'); ?>" class="click">CLICK HERE</a>				
					</div>
				</div>
				<div class="col-sm-4 quick">
					<h2>Quick Enquiry Form</h2>
					<div id="messageArea" style="margin-top: -20px; color: white; text-align: center;"></div>
					<br>
					<div id="WrongMessageArea" style="margin-top: -20px; color:  white; text-align: center;"></div>
					<br>
					<div id="EmptyMessageArea" style="margin-top: -20px; color:  white; text-align: center;"></div>
					<br>
					<?php echo form_open('send/enquiry','novalidate id = "enquiry_form"'); ?>
					<div class="form-group">
						<div class="controls">
							<input type="text" class="form-control" name="senderName" id="name" placeholder="Name*" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)" data-validation-regex-message="valid inputs are a-z, A-Z">
						</div>
					</div>
					<div class="form-group">
						<div class="controls">
							<input type="email" class="form-control" name="senderEmail" id="email" placeholder="Email Address*" required data-validation-required-message="This field is required">
						</div>
					</div>
					<div class="form-group">
						<div class="controls">
							<input type="number" class="form-control" id="phone" name="senderPhone" placeholder="Contact Number*" required data-validation-required-message="This field is required" minlength="10" maxlength="10">
						</div>
					</div>
					<div class="form-group">
						<div class="controls">
							<input type="text" class="form-control dob" id="datepicker" onFocus="" name="dob" placeholder="Date of Birth*" required data-validation-required-message="This field is required" >
						</div>
					</div>
					<div class="form-group">
						<div class="controls col-md-12 enquiryAdress">
							<select class="form-control" name="senderState" id="administrative_area_level_1" data-validation-regex-regex="([\a-zA-Z& ]+)" required data-validation-required-message="This field is required">
								<option value="">Choose State*</option>
								<?php if(!empty($allStates)){
									foreach ($allStates as $singleState) {
										echo '<option  value="'.$singleState['state_name'].'">'.$singleState['state_name'].'</option>';
									}
								} ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="controls">
							<select class="form-control" id="enquirySubject" name="EnquirySubject" required data-validation-required-message="This field is required">
								<option value="">Choose Courses</option>
								<option value="Online Courses">Online Courses</option>
								<option value="Offline Courses">Offline Courses</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="controls">
							<textarea class="form-control" name="EnquiryMessage" id="enquirymessage" placeholder="Type your enquiry here"></textarea>
						</div>
					</div>
					<button type="button" name="submit_enquiry" class="btn btn-theme" id="submit_enquiry" value="SUBMIT">SUBMIT</button> 
					<?php echo form_close(); ?>
				</div>
				<div class="col-sm-6" style="float:right;">
					<?php if($this->session->flashdata('enquiryalertmessage')) {
						$message = $this->session->flashdata('enquiryalertmessage'); ?>
					<div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
						<?php echo $message['message']; ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<section class="career-path">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-6">
						<h3>Eligibility</h3>
						<div class="pt-1">			
							<div class="col-md-2">
								<img src="<?php echo base_url(); ?>/assets/images/eligible1.png">
							</div>
							<div class="col-md-10">
								<p>Below 28 years of age at the time of admission</p>
							</div>
						</div>
						<div class="pt-1">	
							<div class="col-md-2">
								<img src="<?php echo base_url(); ?>/assets/images/eligible2.png">
							</div>
							<div class="col-md-10">
								<p>50% or above in class X, XII and Graduation / Post-Graduation</p>
							</div>	
						</div>				
					</div>
					<div class="col-md-6">
						<img src="<?php echo base_url(); ?>/assets/images/career-path.png" style="width: 100%; height: auto;">
					</div>
				</div>
			</div>
		</section>
		<section class="signup">
			<div class="container text-center">
				<div class="row">
					<div class="col-sm-12">
						<h3>How to enroll for IPB's banking course?</h3>
					</div>
					<div class="col-md-3">
						<img src="<?php echo base_url(); ?>/assets/images/icon1.png">
						<h4><a href="<?php echo site_url('signup')?>">Sign Up</a></h4>						
					</div>
					<div class="col-md-3">
						<img src="<?php echo base_url(); ?>/assets/images/icon2.png">
						<h4><a href="<?php echo site_url('modules')?>">Buy a Course</a></h4>
					</div>
					<div class="col-md-3">
						<img src="<?php echo base_url(); ?>/assets/images/icon3.png">
						<h4><a href="#">Assesment Test</a></h4>
					</div>
					<div class="col-md-3">
						<img src="<?php echo base_url(); ?>/assets/images/icon4.png">
						<h4><a href="#">Get Certified</a></h4>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-md-12">
						<a href="#" class="btn btn-theme">Click here to know how it works</a>
					</div>
				</div>
			</div>
		</section>
		<div class="container index-3-categories text-center homcourse">
			<div class="row" style="margin-bottom: 2%;">
				<div class="col-sm-10 col-sm-offset-1">
					<h3>IPB Modules / Courses</h3>
				</div>
			</div>
			<div class="row">
				<?php if(!empty($allModules)) {
					$this->load->view('frontend/module.view.php',$allModules);
				} ?>
			</div>
		</div>
		<section class="testimonials py-5 text-white px-1 px-md-5 margin-top-xl">		  
		  <div class="container">
		    <div class="row">
		      <div class="col-sm-12">
		        <h3 class="text-center">Reviews</h3>
		        <div class="carousel-controls testimonial-carousel-controls">
		          <div class="control d-flex align-items-center justify-content-center prev mt-3"><i class="fa fa-chevron-left"></i></div>
		          <div class="control d-flex align-items-center justify-content-center next mt-3"><i class="fa fa-chevron-right"></i></div>
		          <div class="testimonial-carousel">
		            <div class="h5 font-weight-normal one-slide mx-auto">
		              <div class="testimonial w-100 px-3 text-center d-flex flex-direction-column justify-content-center flex-wrap align-items-center shadow">
		                <div class="message text-center blockquote w-100">"It is the best plateform to improve personality and skills.It is a very good place where you can gain much more knowledge about banking.if you want to be a banker then it is a best place . Thanku IPB (institute of professional banking)."</div>
		                <div class="blockquote-footer w-100 text-white">Muskan Rukhaya</div>
		                <img src="<?php echo base_url(); ?>/assets/images/reviews/fb1.jpg">
		              </div>
		            </div>
		            <div class="h5 font-weight-normal one-slide mx-auto">
		              <div class="testimonial w-100 px-3 text-center  d-flex flex-direction-column justify-content-center flex-wrap align-items-center shadow">
		                <div class="message text-center blockquote w-100">"The best place for the ones who want to pursue their career in banking sector.. highly recommended for all the students who want to achieve their professional goals in retail banking."</div>
		                <div class="blockquote-footer w-100 text-white">Shruti Mankhand</div>
		                <img src="<?php echo base_url(); ?>/assets/images/reviews/fb2.jpg">
		              </div>
		            </div>
		            <div class="h5 font-weight-normal one-slide mx-auto">
		              <div class="testimonial w-100 px-3 text-center  d-flex flex-direction-column justify-content-center flex-wrap align-items-center shadow">
		                <div class="message text-center blockquote w-100">This is the best institute that provides knowledge about retail banking. I have studied here and got selected in ICICI Bank in less than 15 days. The staff here is very cooperative and professional. I would like to recommend everyone who wants to make their career in retail banking. Please do visit here!</div>
		                <div class="blockquote-footer w-100 text-white">Shivam Sharma</div>
		                <img src="<?php echo base_url(); ?>/assets/images/reviews/fb3.jpg">
		              </div>
		            </div>
		            <div class="h5 font-weight-normal one-slide mx-auto">
		              <div class="testimonial w-100 px-3 text-center  d-flex flex-direction-column justify-content-center flex-wrap align-items-center shadow">
		                <div class="message text-center blockquote w-100">IPB gives us knowledge about retail banking which is very good .IPB faculty motivate us and give us very practical knowledge . We all students hope that IPB give us our career path as in a excellent manner.</div>
		                <div class="blockquote-footer w-100 text-white">Simran Kukreja</div>
		                <img src="<?php echo base_url(); ?>/assets/images/reviews/fb4.jpg">
		              </div>
		            </div>
		            <div class="h5 font-weight-normal one-slide mx-auto">
		              <div class="testimonial w-100 px-3 text-center  d-flex flex-direction-column justify-content-center flex-wrap align-items-center shadow">
		                <div class="message text-center blockquote w-100">My overall experience has been excellent. I highly recommend IPB to anyone looking to pursue a career in the banking sector. IPB's retail banking and personality development program is very valuable source of skills and knowledge for professional development. Thank you very much 'IPB' team, for helping me start my career in banking.</div>
		                <div class="blockquote-footer w-100 text-white">Komal Ahuja</div>
		                <img src="<?php echo base_url(); ?>/assets/images/reviews/fb5.jpg">
		              </div>
		            </div>
		            <div class="h5 font-weight-normal one-slide mx-auto">
		              <div class="testimonial w-100 px-3 text-center  d-flex flex-direction-column justify-content-center flex-wrap align-items-center shadow">
		                <div class="message text-center blockquote w-100">I find Institute of Professional Banking is the best platform which provide opportunity to the students those who wants to be a banker. To be a part of this institution I feel very happy and lucky. The faculty members are very co-operative and they pour their best effort to groom a student to be a banker.</div>
		                <div class="blockquote-footer w-100 text-white">Jatin Gulati</div>
		                <img src="<?php echo base_url(); ?>/assets/images/reviews/fb6.jpg">
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</section>
		<div class="pros" style="background:#023B75;">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1 text-center">
						<h3>Team behind IPB portal</h3>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-md-2 col-sm-4 col-xs-6">
						<div class="teacher">
							<div class="imgcontainer">
								<img src="<?php echo base_url(); ?>/assets/images/harpal-singh.png" alt="Avatar">
							</div>
							<a href="#">Harpal Singh</a>
							<p>Chairman</p>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<div class="teacher">
							<div class="imgcontainer">
								<img src="<?php echo base_url(); ?>/assets/images/manoj-sehgal.png" alt="Avatar">
							</div>
							<a href="#">Manoj Sehgal</a>
							<p>Director & Chief Executive Officer</p>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<div class="teacher">
							<div class="imgcontainer">
								<img src="/assets/images/gurpreet-singh.png" alt="Avatar">
							</div>
							<a href="#">Gurpreet Singh</a>
							<p>Director – Training & Placement</p>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<div class="teacher">
							<div class="imgcontainer">
								<img src="<?php echo base_url(); ?>/assets/images/Jasbir-Singh.jpg" alt="Avatar">
							</div>
							<a href="#">Jasbir Singh</a>
							<p>Retired GM, Oriental Bank of Commerce</p>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<div class="teacher">
							<div class="imgcontainer">
								<img src="<?php echo base_url(); ?>/assets/images/gursimran-singh.png" alt="Avatar">
							</div>
							<a href="#">Gursimran Singh</a>
							<p>Director & Chief Financial Officer</p>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-6">
						<div class="teacher">
							<div class="imgcontainer">
								<img src="<?php echo base_url(); ?>/assets/images/CA.png" alt="Avatar">
							</div>
							<a href="#">Parminder Pal Singh</a>
							<p>Chartered Accountant</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container clients text-center">
			<div class="row" style="margin-bottom: 2%;">
				<div class="col-sm-10 col-sm-offset-1">
					<h3>Our Prospective Recruiters</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">				
					<img src="<?php echo base_url(); ?>/assets/images/AXIS.jpg">				
				</div>
				<div class="col-md-3">				
					<img src="<?php echo base_url(); ?>/assets/images/yes-Bank.png">
				</div>
				<div class="col-md-3">				
					<img src="<?php echo base_url(); ?>/assets/images//Kotak.png">
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/hdfc.png">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/Indusind.png">			
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/Jana.png">
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/Ujjivan.png">
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/ICICI.png">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/Pnb.png">
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/DCB.png">
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/HDB.png">				
				</div>
				<div class="col-md-3">
					<img src="<?php echo base_url(); ?>/assets/images/AU.png">				
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#submit_enquiry').click(function(){
		
				if(validate()){
		
					var senderName 		= $("#name").val();
					var senderEmail 	= $("#email").val();
					var senderPhone 	= $("#phone").val();
					var senderdob   	= $("#datepicker").val();
					var senderState 	= $("#administrative_area_level_1").val();
					var EnquirySubject 	= $("#enquirySubject").val();
					var EnquiryMessage 	= $("#enquirymessage").val();
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url(); ?>send/enquiry",
						data:  {
							senderName: 	senderName, 
							senderEmail: 	senderEmail,
							senderPhone: 	senderPhone, 
							senderdob: 	  senderdob, 
							senderState: 	senderState, 
							EnquirySubject: EnquirySubject, 
							EnquiryMessage: EnquiryMessage,
							submit_enquiry: 'submit_enquiry'
						},
						success: function (data) 
						{
							console.log(data);
							if (data == true) 
							{
								$("#messageArea").html('Your message has been sent Successfully..!! </br> We\'ll contact you soon.').css('background-color', 'green').fadeIn().fadeOut(9000);
								$('#enquiry_form').trigger("reset");
							}else
							{
								$("#WrongMessageArea").html('Your message has not been sent..!! </br> Try Again.').css('background-color', 'red').fadeIn().fadeOut(9000);
							}
						}
					});
				}
			});
		});
		
		function validate(){
		
			var alpharegex 		= /^[\a-zA-Z ]*$/;
			var emailregex 		= /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			var phoneregex		= /^\d{10}$/;
			var senderName 		= $("#name").val();
			var senderEmail 	= $("#email").val();
			var senderPhone 	= $("#phone").val();
			var senderdob   	= $("#datepicker").val();
			var senderState 	= $("#administrative_area_level_1").val();
			var EnquirySubject 	= $("#enquirySubject").val();
			var flag = true;
		
			if (senderName == '')
			{
				$('#name').closest('.form-group').addClass('error').removeClass('validate');
				$("#name").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
				flag = false;
			}
			if(!alpharegex.test(senderName))
			{
				$('#name').closest('.form-group').addClass('error').removeClass('validate');
				$("#name").attr("aria-invalid", "true").next(".help-block").html('<ul><li>valid inputs are a-z, A-Z</li></ul>').css('color','red')
				flag = false;
			}
			if (senderEmail == '') 
			{
				$('#email').closest('.form-group').addClass('error').removeClass('validate');
				$("#email").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
				flag = false;
			}
			if(!emailregex.test(senderEmail))
			{
				$('#email').closest('.form-group').addClass('error').removeClass('validate');
				$("#email").attr("aria-invalid", "true").next(".help-block").html('<ul><li>please enter a valid email</li></ul>').css('color','red')
				flag = false;
			}
			if (senderPhone == '') 
			{
				$('#phone').closest('.form-group').addClass('error').removeClass('validate');
				$("#phone").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
				flag = false;
			}
			if (!phoneregex.test(senderPhone)) 
			{
				$('#phone').closest('.form-group').addClass('error').removeClass('validate');
				$("#phone").attr("aria-invalid", "true").next(".help-block").html('<ul><li>10 digit number only</li></ul>').css('color','red');
				flag = false;
			}
			if (senderState == '') 
			{
				$('#administrative_area_level_1').closest('.form-group').addClass('error').removeClass('validate');
				$("#administrative_area_level_1").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
				flag = false;
			}
			if (senderdob == '') 
			{
				$('.dob').closest('.form-group').addClass('error').removeClass('validate');
				$(".dob").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
				flag = false;
			}
			if (EnquirySubject == '') 
			{
				$('#enquirySubject').closest('.form-group').addClass('error').removeClass('validate');
				$("#enquirySubject").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
				flag = false;
			}	
			return flag;
		}
	</script>
	<script type="text/javascript">
	$( function() {
		var today = new Date();
    $( "#datepicker" ).datepicker({
      changeMonth: true, 
      changeYear: true,
      endDate: "today",
      maxDate: today,
      dateFormat: "dd/mm/yy",
      yearRange: "-90:+00"
    });
  });
	</script>
	<script>
		$(document).ready(function() {
  $(".testimonial-carousel").slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: false,
    arrows: true,
    prevArrow: $(".testimonial-carousel-controls .prev"),
    nextArrow: $(".testimonial-carousel-controls .next")
  });
});</script>
	<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>