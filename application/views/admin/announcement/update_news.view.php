    <?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/extensions/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/forms/validation/form-validation.css">
  </head>
  <body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    <?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php $hashedID = encryptID($this->session->userdata('id'), $SingleNewsDetail['text_id']); ?>
    <?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">News</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('admin/home'); ?>">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('announcement/news'); ?>">News</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Create/View News
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right text-md-right col-md-6 col-12">
            <!-- <div class="btn-group">
              <a href="<?php echo base_url('module/create'); ?>">
                <button class="btn btn-round btn-info" type="button">
                  <i class="ft-plus-circle"></i> Create New Module
                </button>
              </a>
            </div> -->
          </div>
        </div>
        <div class="content-body">
          <section id="file-export">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <?php if($this->session->flashdata('item_news_update')) {
                        $message = $this->session->flashdata('item_news_update'); ?>
                        <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <?php echo $message['message']; ?>
                        </div>
                      <?php } ?>
                      <?php echo form_open_multipart('news/update/'.$hashedID,'novalidate');?>
                        <div class="form-body">
                          <h4 class="form-section"><i class="ft-edit-2"></i> Update News</h4>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Banner For: <span class="required">*</span></h5>
                                <div class="controls">
                                  <select class="form-control" name="select_userType" required data-validation-required-message="This field is required">
                                    <option value="">Select</option>
                                    <option <?php if ($SingleNewsDetail['user_type'] == 1) echo 'Selected'; ?> value="1">Instructor</option>
                                    <option <?php if ($SingleNewsDetail['user_type'] == 2) echo 'Selected'; ?> value="2">Student</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>News Text<span class="required">*</span></h5>
                                <div class="controls">
                                  <textarea rows="6" class="form-control" type="textarea" id="newsText" name="newsText" placeholder="Enter News Text" required data-validation-required-message="This field is required"><?php echo $SingleNewsDetail['text']; ?></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Start Date<span class="required">*</span></h5>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <span class="la la-calendar-o"></span>
                                    </span>
                                  </div>
                                  <input type="text" id="StartDate" name="StartDate" placeholder="Select Start Date " class="form-control singledate" value="<?php echo date('m/d/Y', strtotime($SingleNewsDetail['start_date'])); ?>" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                              <div class="form-group">
                                <h5>End Date<span class="required">*</span></h5>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <span class="la la-calendar-o"></span>
                                    </span>
                                  </div>
                                  <input type="text" id="endDate" name="endDate" placeholder="Select End Date " class="form-control singledate" value="<?php echo date('m/d/Y', strtotime($SingleNewsDetail['end_date'])); ?>" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Display<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="checkbox" id="switcheryColor12" class="switchery" name="switchStatus" data-color="info" <?php if($SingleNewsDetail['display'] == 1) {echo "checked";} ?>>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions right">
                            <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                            <i class="ft-refresh-ccw"></i> Reset
                            </button>
                            <button type="submit" name="update_news" id="update_news" value="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Update
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
          </section>
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
    <!-- Switch scripts -->
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/switch.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
    <!-- <script src="/app-assets/vendors/js/pickers/daterange/daterangepicker.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js" type="text/javascript"></script>  
    <script type="text/javascript">
      $(document).ready(function()
      {
         $("#endDate").bind('change', function(){
          var StartDate = $('#StartDate').val();
          var endDate = $('#endDate').val();

          if (StartDate == endDate) 
          {
            console.log(StartDate);
            console.log(endDate);
            $('#endDate').closest('.form-group').addClass('error');
            $('#endDate').closest('.form-group').removeClass('validate');
            $("#endDate").attr("aria-invalid", "true");
            $("#endDate").next(".help-block").append('<ul><li>End Date must be different from Start Date.</li></ul>').css('color','red');
            $("#create_news").attr("disabled", true);
          }else
            {
              $('#endDate').closest('.form-group').removeClass('error');
              $('#endDate').closest('.form-group').addClass('validate');
              $("#create_news").attr("disabled", false);
            }
        });

      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.dropdown-item.delete-btn').on('click',function(){
          var newsID = $(this).data('news_id'); //alert(instructorID);
          var currentRow = $(this).parents('tr');
          swal({
            title: "Are you sure?",
            text: "You will not be able to recover this News Details again...!",
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
                    value: newsID,
                    name: "delete_instructor",
                    visible: true,
                    className: "",
                    closeModal: false
                }
            }
          }).then(isConfirm => {
            if (isConfirm) {
              $.ajax({
                url: '<?php echo base_url(); ?>news/delete',
                data: { newsID:newsID },
                type: 'POST',
                success: function(data){
                  //alert(data);
                  swal("Deleted!", "News has been deleted successfully...!", "success");
                  $('#instructor_table').DataTable().row(currentRow).remove().draw();
                }
              });
            } else {
              swal("Cancelled", "News Details are still safe :)", "error");
            }
          });
        });
      });

    </script>
    <script type="text/javascript">
      $(document).ready(function()
      {
          $('.singledate').daterangepicker(
          {
              singleDatePicker: true,

              showDropdowns: true
          });
      });
  </script>
  </body>
</html>