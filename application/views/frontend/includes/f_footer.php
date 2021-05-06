<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<h1 class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>/assets/images/logo.png" alt="Logo"></a></h1>
				<ul class="contactinfo">
					<li class="address"><strong>Address:</strong> SCO-11, Level II, Sector-11, Panchkula.</li>
					<li class="phone"><strong>Phone:</strong>  +91 98881-09150</li>
					<li class="email"><strong>E-mail:</strong>  info@ipbindia.com</li>
				</ul>
			</div>

			<div class="col-md-2 col-sm-6 col-xs-12">
				<h6>GET HELP</h6>
				<ul class="information">
					<li><a href="#">Help and FAQ</a></li>
					<li><a href="#">Video Courses</a></li>
					<li><a href="#">Online Booking</a></li>
					<li><a href="#">Online Support</a></li>
				</ul>
			</div>

			<div class="col-md-2 col-sm-6 col-xs-12">
				<h6>INFORMATION</h6>
				<ul class="information">
					<li><a href="#">About us</a></li>
					<li><a href="#">Our services</a></li>
					<li><a href="#">Order history</a></li>
					<li><a href="#">Information</a></li>
				</ul>
			</div>

			<div class="col-md-2 col-sm-6 col-xs-12">
				<h6>MY ACCOUNT</h6>
				<ul class="information">
					<li><a href="#">Plans &amp; Pricings</a></li>
					<li><a href="#">Favorites</a></li>
					<li><a href="#">Personal info</a></li>
					<li><a href="#">Login</a></li>
				</ul>
			</div>

			<div class="col-md-2 col-sm-12 col-xs-12">
				<h6>QUICKLINKS</h6>
				<ul class="information">
					<li><a href="#">Video Training</a></li>
					<li><a href="#">Online Courses</a></li>
					<li><a href="#">Become a teacher</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
		</div>

		<div class="row botbar">
			<div class="col-sm-7">
				<p class="copyright">&copy; SSPL India. All rights reserved. Powered by Fresco Web Services</p>
			</div>
			<!-- <div class="col-sm-5">
				<ul class="pull-right payments">
					<li><a href="#"><img src="http://placehold.it/38x12" alt="Payment"></a></li>
					<li><a href="#"><img src="http://placehold.it/27x17" alt="Payment"></a></li>
					<li><a href="#"><img src="http://placehold.it/20x18" alt="Payment"></a></li>
					<li><a href="#"><img src="http://placehold.it/16x16" alt="Payment"></a></li>
					<li><a href="#"><img src="http://placehold.it/25x12" alt="Payment"></a></li>
				</ul>
			</div> -->	
			<div class="col-sm-5">
				<ul class="pull-right payments">
					<li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
					<li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
					<li><a href="#"><i class="zmdi zmdi-linkedin"></i></a></li>
				</ul>
			</div>			
		</div>
	</div>
</footer>

<script src="<?php echo base_url(); ?>/assets/libs/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>/assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/libs/rslides/responsiveslides.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/libs/slick/slick.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/main.js"></script>
<script type="text/javascript">
	if(window.location.protocol == "http:"){
		var url = window.location.href;
		window.location.href = url.replace(/^http:\/\//i, 'https://');
	}

	function changedistrict(id) 
	{
		$.ajax({

			type: "post",
			url: "<?php echo base_url(); ?>getdistrict",
			data: {id: id},
			success: function(data)
			{
				$("#district").html(data);
			}
		});
	}
</script>

</body>

</html>