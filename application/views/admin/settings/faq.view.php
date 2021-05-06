<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="/app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
<style type="text/css">
button.btn.btn-link.display-inline.font-medium-3 {
    background-color: #ededed;
    width: 100%;
    text-align: left;
    margin-bottom: 10px;
}
#accordionExample .faqs {
    padding: 5px 1.5em;
}
.card-text.faq-description {
    border: 1px solid #ccc;
    padding: 5px 15px 1px;
    color: #000;
}
</style>
</head>
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-6 col-12 mb-2">
				<h3 class="content-header-title mb-0">FAQ</h3>
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
								FAQ
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<section id="vertical-tabs">
				<div class="row match-height">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-content">
								<div class="card-body">
									<?php if($this->session->flashdata('alertmessage')) {
										$message = $this->session->flashdata('alertmessage'); ?>
										<div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
											<?php echo $message['message']; ?>
										</div>
									<?php }
									echo form_open('settings/faq/create','novalidate');?>
									<div class="form-body">
										<h4 class="form-section"><i class="la la-plus"></i> Add New FAQ</h4>
										<div class="form-group col-md-12">
											<h5>Title<span class="required">*</span></h5>
											<div class="controls">
												<input type="text" class="form-control" id="title" name="title" required data-validation-required-message="This field is required">
											</div>
										</div>
										<div class="form-group col-md-12">
											<h5>Description<span class="required">*</span></h5>
											<div class="controls">
												<textarea name="description" id="faqeditor" class="faqeditor"></textarea>
											</div>
										</div>
										<div class="form-actions right">
											<button type="reset" name="reset_form" value="reset" class="btn btn-warning">
											<i class="ft-refresh-ccw"></i> Reset
											</button>
											<button type="submit" name="create_faq" value="submit" class="btn btn-primary" id="create_faqID">
											<i class="la la-check-square-o"></i> Submit
											</button>
											<button type="button" onclick="goBack()" name="reset_form" value="reset" class="btn btn-danger">
											<i class="ft-x"></i> Cancel
											</button>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
								<div class="card-body">
									<h4 class="form-section"><i class="la la-list"></i> All FAQs</h4>
									<div class="accordion" id="accordionExample">
                    <div class="card">
                      <?php if (!empty($faq_content)) {
                        $xx = '1';
                        foreach ($faq_content as $single_faqs_details) {
                        	$hashedID = encryptID($this->session->userdata('id'),$single_faqs_details['id']); ?>
                      <div class="faqs" id="hd_<?php echo $single_faqs_details['id']; ?>">
                        <button aria-controls="collapse_<?php echo $single_faqs_details['id']; ?>"aria-expanded="<?php if($single_faqs_details['question_order'] == 1) echo 'true'; ?>" class="btn btn-link display-inline font-medium-3 <?php if($single_faqs_details['question_order'] != 1) echo 'collapsed'; ?>" data-target="#collapse_<?php echo $single_faqs_details['id']; ?>" data-toggle="collapse" type="button">
                        <?php echo $xx.".) ". $single_faqs_details['title']; ?>
                        <a href="<?php echo base_url('settings/faq/update/'.$hashedID); ?>" class="btn btn-sm btn-warning pull-right"><i class="la la-edit"></i></a>
                        </button>
                        <div aria-labelledby="hd_<?php echo $single_faqs_details['id']; ?>" class=" <?php if($single_faqs_details['question_order'] != 1) echo 'collapse'; ?> mb-1" data-parent="#accordionExample" id="collapse_<?php echo $single_faqs_details['id']; ?>" style="">
                          <div class="card-text faq-description">
                            <?php echo $single_faqs_details['description']; ?>
                          </div>
                        </div>
                      </div>
                      <?php $xx++;  } } ?>
                    </div>
                  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
<script src="/app-assets/vendors/js/editors/ckeditor/ckeditor.js" type="text/javascript"></script>
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

	$('#create_faqID').on('click',function()
	{
		var title = $('#title').val();
		var description = CKEDITOR.instances.faqeditor.getData();

		if(description==='')
		{
			$('.help-block').css('color','red');
			$('#cke_faqeditor').css('border','1px solid red');
			$('#cke_faqeditor').next().html('<ul role="alert"><li>This field is required</li></ul>');

			if (title==='')
			{
				$('.help-block').css('color','red');
				$('#title').css('border','1px solid red');
				$('#title').next().html('<ul role="alert"><li>This field is required</li></ul>');
				
				$('#title').focus(function()
				{
					$('#title').css('border','1px solid #28D094');
					$('#title').next().css('display','none').fadeOut(2000);
				});
			}
			
			CKEDITOR.instances.faqeditor.on('change', function()
			{
				$('#cke_faqeditor').css('border','1px solid #28D094');
				$('#cke_faqeditor').next().css('display','none');
			});

			return false;
		}
	});
})(window, document, jQuery);
</script>
</body>
</html>