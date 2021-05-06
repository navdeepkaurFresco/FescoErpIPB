<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
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
			<div class="content-body">
				<section id="vertical-tabs">
					<div class="row match-height">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-content">
									<div class="card-body">
										<div class="nav-vertical">
											<ul class="nav nav-tabs otherSettings nav-left nav-border-left">
												<li class="nav-item">
													<a class="nav-link active" id="OtherSettings-tab1" data-toggle="tab" aria-controls="tabOtherSettings1" href="#tabOtherSettings1" aria-expanded="true">Monthly Expensives</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="OtherSettings-tab2" data-toggle="tab" aria-controls="tabOtherSettings2" href="#tabOtherSettings2" aria-expanded="false">Invoice Details</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="OtherSettings-tab3" data-toggle="tab" aria-controls="tabOtherSettings3" href="#tabOtherSettings3" aria-expanded="false">FAQs</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="OtherSettings-tab4" data-toggle="tab" aria-controls="tabOtherSettings4" href="#tabOtherSettings4" aria-expanded="false">Change Profile Image</a>
												</li>
											</ul>
											<div class="tab-content px-2">
												<div role="tabpanel" class="tab-pane active" id="tabOtherSettings1" aria-expanded="true" aria-labelledby="OtherSettings-tab1">
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
																				<?php for($i='2015';$i<='2025';$i++){ ?>
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
																		<input type="number" class="form-control" id="monthly_expenses" name="monthly_expenses" required data-validation-required-message="This field is required. Please provide selected month's Expenses.">
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
														<table class="table table-striped">
															<thead>
																<tr>
																	<th>Month</th>
																	<th>Expenses</th>
																</tr>
															</thead>
															<tbody>
																<?php if(!empty($AllMonthlyExpenses))
																	{
																		foreach ($AllMonthlyExpenses as $value) {
																			echo '<tr>
																					<td>'. date("F, Y", strtotime($value['month_name'])) .'</td>
																					<td><i class="la la-rupee"></i>'.$value['expenses'].'</td>
																				</tr>';
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
												<div class="tab-pane" id="tabOtherSettings2" aria-labelledby="OtherSettings-tab2">
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
																<div class="col-md-6">
																	<div class="form-group">
																		<h5>GST Number<span class="required">*</span></h5>
																		<div class="controls">
																			<input type="text" class="form-control" id="gst_number" name="gst_number" value="<?php echo $InvoiceDetails['gst_number']; ?>" required data-validation-required-message="This field is required" />
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<h5>GST %<span class="required">*</span></h5>
																		<div class="controls input-group">
																			<input type="number" class="form-control" id="GST" name="GST" value="<?php echo $InvoiceDetails['GST']; ?>" required data-validation-required-message="This field is required" />
																			<div class="input-group-append">
																				<span class="input-group-text">%</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row col-md-12">
																<div class="col-md-4">
																	<div class="form-group">
																		<h5>CGST<span class="required">*</span></h5>
																		<div class="controls input-group">
																			<input type="number" class="form-control" id="CGST" name="CGST" value="<?php echo $InvoiceDetails['CGST']; ?>" required data-validation-required-message="This field is required" />
																			<div class="input-group-append">
																				<span class="input-group-text">%</span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<h5>SGST<span class="required">*</span></h5>
																		<div class="controls input-group">
																			<input type="number" class="form-control" id="SGST" name="SGST" value="<?php echo $InvoiceDetails['SGST']; ?>" required data-validation-required-message="This field is required" />
																			<div class="input-group-append">
																				<span class="input-group-text">%</span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<h5>IGST<span class="required">*</span></h5>
																		<div class="controls input-group">
																			<input type="number" class="form-control" id="IGST" name="IGST" value="<?php echo $InvoiceDetails['IGST']; ?>" required data-validation-required-message="This field is required" />
																			<div class="input-group-append">
																				<span class="input-group-text">%</span>
																			</div>
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
												<div class="tab-pane" id="tabOtherSettings3" aria-labelledby="OtherSettings-tab3">
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
														<?php echo form_open('settings/faq/create','novalidate');?>
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
																	<textarea name="description" id="faqeditor" class="faqeditor" required data-validation-required-message="This field is required"></textarea>
																</div>
															</div>
															<div class="form-actions right">
																<button type="reset" name="reset_form" value="reset" class="btn btn-warning">
																<i class="ft-refresh-ccw"></i> Reset
																</button>
																<button type="submit" name="create_faq" value="submit" class="btn btn-primary">
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
														<div id="accordionWrap" role="tablist" aria-multiselectable="true">
															<div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
																<?php if(!empty($faq_content))
																{	
																	$accordionID = '1';
																	foreach ($faq_content as $value)
																		{ ?>
																<div class="card-header p-0 pb-2 border-0" id="heading<?php echo $accordionID; ?>" role="tab">
																	<a  data-toggle="collapse" data-parent="#accordionWrap" href="#accordion<?php echo $accordionID; ?>" aria-expanded="false" aria-controls="accordion<?php echo $accordionID; ?>">
																		<?php echo $value['title'];?>
																	</a>
																	<button class="btn btn-sm btn-warning pull-right mr-5 editFAQButton" data-ub="<?php echo $value['id'];?>" data-toggle="modal" data-target="#updateFAQ_<?php echo $value['id']; ?>"><i class="la la-edit"></i></button>
																</div>
																<div class="card-collapse collapse" id="accordion<?php echo $accordionID; ?>" role="tabpanel" aria-labelledby="heading<?php echo $accordionID; ?>" aria-expanded="false">
																	<div class="card-content">
																		<p class="accordion-text text-small-3"><?php echo $value['description'];?></p>
																	</div>
																</div>
																<div class="modal fade bd-example-modal-lg" id="updateFAQ_<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog modal-lg" role="document">
																		<div class="modal-content">
																			<?php echo form_open('settings/faq/update','novalidate');?>
																				<div class="form-body">
																					<div class="modal-header">
																						<h4><i class="la la-plus"></i> Add New FAQ</h4>
																						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																							<span aria-hidden="true">&times;</span>
																						</button>
																					</div>
																					<div class="modal-body">
																						<div class="form-group col-md-12">
																							<h5>Title<span class="required">*</span></h5>
																							<div class="controls">
																								<input type="hidden" name="faq_id" value="<?php echo $value['id'];?>">
																								<input type="text" class="form-control" id="title" name="title" value="<?php echo $value['title']; ?>" required data-validation-required-message="This field is required">
																							</div>
																						</div>
																						<div class="form-group col-md-12">
																							<h5>Description<span class="required">*</span></h5>
																							<div class="controls">
																								<textarea name="description" id="update_faq_editor_<?php echo $value['id']; ?>" class="update_faq_editor_<?php echo $value['id']; ?>" required data-validation-required-message="This field is required"><?php echo $value['description']; ?></textarea>
																							</div>
																						</div>
																					</div>
																					<div class="modal-footer">
																						<button type="reset" name="reset_form" value="reset" class="btn btn-warning">
																							<i class="ft-refresh-ccw"></i> Reset
																						</button>
																						<button type="submit" name="update_faq" value="submit" class="btn btn-primary">
																							<i class="la la-check-square-o"></i> Submit
																						</button>
																						<button type="button" data-dismiss="modal" name="reset_form" value="reset" class="btn btn-danger">
																							<i class="ft-x"></i> Cancel
																						</button>
																					</div>
																				</div>
																			<?php echo form_close(); ?>
																		</div>
																	</div>
																</div>
																<?php $accordionID++; }
																}
																?>
															</div>
														</div>
													</div>
												</div>
												<div class="tab-pane" id="tabOtherSettings4" aria-labelledby="OtherSettings-tab4">
													<div class="card-body">
													</div>
												</div>
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

	$('.editFAQButton').on('click', function()
	{
		var id = $(this).attr('data-ub');
		var editorID = 'update_faq_editor_'+id; //console.log(editorID);
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