<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="/app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
	<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
	<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-header row">
				<div class="content-header-left col-md-6 col-12 mb-2">
					<h3 class="content-header-title mb-0">Invoice Details</h3>
					<div class="row breadcrumbs-top">
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="<?php echo base_url('admin/home'); ?>">Home</a>
								</li>
								<li class="breadcrumb-item">
									<a href="">Settings</a>
								</li>
								<li class="breadcrumb-item active">
									Invoice Details
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content-body">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-content">
							<div class="card-body">
								<?php echo form_open('settings/invoice/details','novalidate');?>
								<div class="form-body">
									<h4 class="form-section"><i class="la la-credit-card"></i> Invoice Details</h4>
									<div class="col-md-12">
										<div class="form-group">
											<h5>Company Address<span class="required">*</span></h5>
											<div class="controls">
												<textarea class="form-control" id="company_address" name="company_address" required data-validation-required-message="This field is required"><?php echo $InvoiceDetails['company_address']; ?></textarea>
											</div>
										</div>
									</div>
									<div class="row col-md-12">
										<div class="form-group col-md-12">
											<h5>GST Number<span class="required">*</span></h5>
											<div class="controls">
												<input type="text" class="form-control" id="gst_number" name="gst_number" value="<?php echo $InvoiceDetails['gst_number']; ?>" required data-validation-required-message="This field is required" />
											</div>
										</div>
									</div>
									<div class="row col-md-12">
										<div class="form-group col-md-6">
											<h5>GST %<span class="required">*</span><small> ( For Punjab )</small></h5>
											<div class="controls input-group">
												<input type="number" class="form-control" id="GST" min="0" max="100" name="GST" value="<?php echo $InvoiceDetails['GST']; ?>" required data-validation-required-message="This field is required" />
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
										<div class="form-group col-md-6">
											<h5>IGST<span class="required">*</span><small> ( For Other States )</small></h5>
											<div class="controls input-group">
												<input type="number" min="0" max="100" class="form-control" id="IGST" name="IGST" value="<?php echo $InvoiceDetails['IGST']; ?>" required data-validation-required-message="This field is required" />
												<div class="input-group-append">
													<span class="input-group-text">%</span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions right">
										<button type="reset" name="reset_form" value="reset" class="btn btn-warning">
										<i class="ft-refresh-ccw"></i> Reset
										</button>
										<button type="submit" name="update_invoice_details" value="submit" class="btn btn-primary">
										<i class="la la-check-square-o"></i> Submit
										</button>
										<button type="button" onclick="goBack()" name="reset_form" value="reset" class="btn btn-danger">
										<i class="ft-x"></i> Cancel
										</button>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
    <script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<script type="text/javascript">
(function(window, document, $)
{
	// CKEditor Color Options
	editor = CKEDITOR.replace( 'faqeditor', {
		height: '150px',
		uiColor: '#CCEAEE'
	});

	$('.editFAQButton').on('click', function()
	{
		var id = $(this).attr('data-ub');
		var editorID = 'update_faq_editor_'+id;
		
		// CKEditor Color Options
		updateEditor = CKEDITOR.replace( editorID, {
			height: '150px',
			uiColor: '#CCEAEE'
		});
	});
})(window, document, jQuery);
</script>
</body>
</html>