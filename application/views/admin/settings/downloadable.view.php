<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/fonts/simple-line-icons/style.css">
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
				<h3 class="content-header-title mb-0">Downloadable Content</h3>
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
								Downloadable Content
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
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
						<?php } ?>
						<ul class="nav nav-tabs nav-underline">
							<li class="nav-item">
								<a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1" href="#tabIcon1" aria-expanded="true">
									<i class="la la-plus"></i> Add Downloadable Content
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2" href="#tabIcon2" aria-expanded="false">
									<i class="la la-list"></i> All Downloadable Content
								</a>
							</li>
						</ul>
						<div class="tab-content px-1 pt-1">
							<div role="tabpanel" class="tab-pane active" id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
								<?php echo form_open_multipart('settings/downloads/create','novalidate');?>
								<div class="form-body">
									<div class="form-group col-md-12">
										<h5>Title<span class="required">*</span></h5>
										<div class="controls">
											<input type="text" class="form-control" id="title" name="title" required data-validation-required-message="This field is required">
										</div>
									</div>
									<div class="form-group col-md-12">
										<h5>Description<span class="required">*</span></h5>
										<div class="controls">
											<input type="file" class="form-control" id="file_url" name="file_url" required data-validation-required-message="This field is required">
										</div>
									</div>
									<div class="form-actions right">
										<button type="reset" name="reset_form" value="reset" class="btn btn-warning">
											<i class="ft-refresh-ccw"></i> Reset
										</button>
										<button type="submit" name="create_file" value="submit" class="btn btn-primary">
											<i class="la la-check-square-o"></i> Submit
										</button>
										<button type="button" onclick="goBack()" name="reset_form" value="reset" class="btn btn-danger">
											<i class="ft-x"></i> Cancel
										</button>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
							<div class="tab-pane" id="tabIcon2" aria-labelledby="baseIcon-tab2">
								<table id="downloadContent" class="table table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Title</th>
											<th>URL</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($DownloadableContent))
										{
											$x = '1';
											foreach ($DownloadableContent as $singleval) {
										?>
											<tr>
												<td><?php echo $x; ?></td>
												<td><?php echo $singleval['title']; ?></td>
												<td><a class="btn btn-primary btn-sm" href="<?php echo base_url('uploads/').$singleval['file_url']; ?>" alt="<?php echo $singleval['title']; ?>" download>Download</a></td>
												<td><a href="#" class="btn btn-danger btn-sm confirm-delete" data-fileURL_id="<?php echo $singleval['id']; ?>" id="confirm-color"><i class="ft-trash-2"></i> Delete</a></td>
											</tr>
										<?php
											$x++; }
										}else
										{
											echo '<tr><td colspan="4" style="text-align: center;">No Data Found..!</td></tr>';
										}
										?>
									</tbody>
								</table>
							</div>
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
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
	// To check image extension type.
    $("#file_url").bind('change', function()
    {
      var file = $("#file_url").val();
      var ext = file.split(".");
      ext = ext[ext.length-1].toLowerCase();    
      var arrayExtensions = ["jpg" , "jpeg", "png", "gif", "pdf", "csv", "doc"];

      if (arrayExtensions.lastIndexOf(ext) == -1) {
        $("#file_url").val("");
        $('#file_url').closest('.form-group').addClass('error');
        $('#file_url').closest('.form-group').removeClass('validate');
        $("#file_url").attr("aria-invalid", "true");
        $("#file_url").next(".help-block").append('<ul><li>This Extension type is not Allowed here. Please Choose "jpg" , "jpeg", "png", "gif".</li></ul>').css('color','red');
      }
    });


    // To delete file content
    $('.confirm-delete').on('click',function()
    {
		var fileUrlID = $(this).attr('data-fileURL_id');
		var currentRow = $(this).parents('tr');
		swal({
	        title: "Are you sure?",
	        text: "You will not be able to recover this content again...!",
	        icon: "warning",
	        showCancelButton: true,
	        buttons: {
	            cancel: {
	                text: "No, Cancel.!",
	                value: null,
	                visible: true,
	                className: "btn-warning",
	                closeModal: false,
	            },
	            confirm: {
	                text: "Yes, Delete it!",
	                value: fileUrlID,
	                name: "delete_file",
	                visible: true,
	                className: "",
	                closeModal: false
	            }
	        }
		}).then(isConfirm => {
			if (isConfirm) {
				$.ajax({
					url: '<?php echo base_url('settings/downloads/delete'); ?>',
					data: { delete_file:fileUrlID },
					type: 'POST',
					success: function(data){
						//alert(data);
						swal("Deleted!", "File has been deleted successfully...!", "success");
						$('#downloadContent').DataTable().row(currentRow).remove().draw();
					}
				});
	        } else {
	        	swal("Cancelled", "File's Details are still safe :)", "error");
	        }
      	});
    });
});
</script>
</body>
</html>