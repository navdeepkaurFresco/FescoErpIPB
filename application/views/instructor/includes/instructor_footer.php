<footer class="footer footer-static footer-light navbar-border">
	<p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="http://www.ipbindia.com/" target="_blank">IPB </a>, All rights reserved. </span>
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Developed by <a href="http://frescowebservices.com/" target="_blank">Fresco Web Services</a></span>
    </p>
</footer>
<script src="<?php echo base_url();?>/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/app-assets/js/core/app.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
<script>
function goBack() {
    window.history.back();
}
</script>
<!-- <script type="text/javascript">
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
</script> -->