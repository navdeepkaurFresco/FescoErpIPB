<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
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
					<h3 class="content-header-title mb-0">Monthly Expenses</h3>
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
									Monthly Expenses
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
										<div class="card-body">
											<?php if($this->session->flashdata('me_alertmessage')) {
											$message = $this->session->flashdata('me_alertmessage'); ?>
											<div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												<?php echo $message['message']; ?>
											</div>
											<?php } ?>
											<?php echo form_open('settings/monthly/expenses','novalidate');?>
											<div class="form-body">
												<h4 class="form-section"><i class="la la-credit-card"></i> Monthly Expenses</h4>
												<div class="row col-md-12">
													<div class="col-md-5">
														<div class="form-group">
															<h5>Select Month<span class="required">*</span></h5>
															<div class="controls">
																<select class="form-control" id="month" name="month" required data-validation-required-message="This field is required">
																	<option>Choose Month</option>
																	<option value="01" <?php echo (date("m")=='01') ? 'selected' : '' ;?> >January</option>
																	<option value="02" <?php echo (date("m")=='02') ? 'selected' : '' ;?> >Feburary</option>
																	<option value="03" <?php echo (date("m")=='03') ? 'selected' : '' ;?> >March</option>
																	<option value="04" <?php echo (date("m")=='04') ? 'selected' : '' ;?> >April</option>
																	<option value="05" <?php echo (date("m")=='05') ? 'selected' : '' ;?> >May</option>
																	<option value="06" <?php echo (date("m")=='06') ? 'selected' : '' ;?> >June</option>
																	<option value="07" <?php echo (date("m")=='07') ? 'selected' : '' ;?> >July</option>
																	<option value="08" <?php echo (date("m")=='08') ? 'selected' : '' ;?> >August</option>
																	<option value="09" <?php echo (date("m")=='09') ? 'selected' : '' ;?> >September</option>
																	<option value="10" <?php echo (date("m")=='10') ? 'selected' : '' ;?> >October</option>
																	<option value="11" <?php echo (date("m")=='11') ? 'selected' : '' ;?> >November</option>
																	<option value="12" <?php echo (date("m")=='12') ? 'selected' : '' ;?> >December</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-5">
														<div class="form-group">
															<h5>Select Year<span class="required">*</span></h5>
															<div class="controls">
																<select class="form-control" id="year" name="year" required data-validation-required-message="This field is required">
																	<option>Choose Year</option>
																	<?php for($i='1991';$i<=date("Y");$i++){ ?>
																		<option value="<?php echo $i; ?>" <?php echo (date("Y")==(string)$i) ? 'selected' : '' ;?>><?php echo $i; ?></option>
																	<?php }?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-10">
													<div class="form-group">
														<h5>Monthly Expenses<span class="required">*</span></h5>
														<div class="controls">
															<input type="number" min="1" class="form-control" id="monthly_expenses" name="monthly_expenses" required data-validation-required-message="This field is required. Please provide selected month's Expenses.">
														</div>
													</div>
												</div>
												<div class="form-actions right">
													<button type="reset" name="reset_form" value="reset" class="btn btn-warning">
													<i class="ft-refresh-ccw"></i> Reset
													</button>
													<button type="submit" name="submit_expenses" value="submit" class="btn btn-primary">
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
											<h4 class="form-section"><i class="la la-list"></i> List of Monthly Expenses</h4>
											<table class="table table-striped file-export">
												<thead>
													<tr>
														<th>S.No.</th>
														<th>Month</th>
														<th>Expenses</th>
													</tr>
												</thead>
												<tbody>
												<?php if(!empty($AllMonthlyExpenses))
												{
													$i = '1';
													foreach ($AllMonthlyExpenses as $value) {
													echo '<tr>
															<td>'.$i.'</td>
															<td>'. date("F, Y", strtotime($value['month_name'])) .'</td>
															<td><i class="la la-rupee"></i>'.$value['expenses'].'</td>
														</tr>';
													$i++;
													}
												}else
												{
													echo '<tr><td colspan="4" style="text-align: center;">No Data Found...!</td></tr>';
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
				</section>
			</div>
		</div>
	</div>
	<?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
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
    <script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
</script>
</body>
</html>