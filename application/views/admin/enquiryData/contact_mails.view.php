<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
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
        <h3 class="content-header-title mb-0">All Contact Requests</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('contact/list'); ?>">Contact Requests</a>
              </li>
              <li class="breadcrumb-item active">
                All Contact Requests
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="file-export">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <?php if($this->session->flashdata('alertmessage_contact')) { $message = $this->session->flashdata('alertmessage_contact'); ?>
                    <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">×</span>
                      </button>
                      <?php echo $message['message']; ?>
                    </div>
                  <?php } ?>
                  <table id="contact_table" class="table table-striped table-bordered base-style file-export table-responsive" style="width: 100% !important;">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Enquiry Subject</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>State</th>
                        <th>District</th>
                        <th>City</th>
                        <th>Message</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if(!empty($ContactRequests)){
                        foreach($ContactRequests as $single_contact_request){ ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $single_contact_request['subject']; ?></td>
                        <td><?php echo $single_contact_request['username']; ?></td>
                        <td><?php echo $single_contact_request['email']; ?></td>
                        <td><?php echo $single_contact_request['phone']; ?></td>
                        <td><?php echo $single_contact_request['state']; ?></td>
                        <td><?php echo $single_contact_request['district']; ?></td>
                        <td><?php echo $single_contact_request['city']; ?></td>
                        <td>
                          <div class="scrollDiv"><?php echo $single_contact_request['message']; ?></div>
                        </td>
                        <td><?php if($single_contact_request['is_replied']=='0')
                          {
                            echo '<button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#reply_to_contact_request_'.$single_contact_request['id'].'">Reply</button>';
                          }else{
                            echo '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#contact_request_'.$single_contact_request['id'].'">View Response</button>';
                          }
                          ?>
                          <div class="modal fade text-left" id="reply_to_contact_request_<?php echo $single_contact_request['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="reply_to_enquery<?php echo $single_contact_request['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                              <div class="modal-content">
                                <?php echo form_open('contact/reply', 'novalidate'); ?>
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel16">Reply To Enquiry</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="send-enquiry-email-reply">
                                    <div class="form-group">
                                      <h5>To<span class="required">*</span></h5>
                                      <div class="controls">
                                        <input type="text" name="reply_to" value="<?php echo $single_contact_request['email']; ?>" class="form-control" required data-validation-required-message="This field is required">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <h5>Reply<span class="required">*</span></h5>
                                      <div class="controls">
                                        <textarea name="contact_reply_message" id="ckeditor" rows="15" class="ckeditor" required data-validation-required-message="This field is required">
                                          Dear <strong><?php echo $single_contact_request['username']; ?></strong> ,<br><br>


                                          Thanks for connecting with us.<br>



                                          <br><br>
                                          With regards,<br>
                                          Team IPB E-Learning
                                        </textarea>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <input type="hidden" name="contact_request_id" value="<?php echo $single_contact_request['id']; ?>">
                                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" name="reply_contact_request" value="send_response" class="btn btn-outline-primary">Send Reply</button>
                                </div>
                                <?php echo form_close();?>
                              </div>
                            </div>
                          </div>
                          <div class="modal fade text-left" id="contact_request_<?php echo $single_contact_request['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="enquery_response<?php echo $single_contact_request['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="enquery_response<?php echo $single_contact_request['id']; ?>">Enquiry Response</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <table class="enquiry_response_view">
                                    <tr>
                                      <td>Enquiry Subject : </td>
                                      <td colspan="3"><?php echo $single_contact_request['subject']; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Enquiry Message : </td>
                                      <td colspan="3"><?php echo $single_contact_request['message']; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Enquiry Response : </td>
                                      <td colspan="3"><?php echo $single_contact_request['replied_message']; ?></td>
                                    </tr>
                                  </table>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php  $i++; } }else{ echo '<tr><td colspan="8" style="text-align:center;">No data found</td></tr>'; }?>
                    </tbody>
                  </table>
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
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.colVis.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/editors/ckeditor/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
(function(window, document, $) {
// CKEditor Color Options
  var textarea = document.getElementById('ckeditor');
  editor = CKEDITOR.replace('.ckeditor', textarea, {
    height: '350px',
    uiColor: '#CCEAEE'
  });
})(window, document, jQuery);
</script>
</body>
</html>