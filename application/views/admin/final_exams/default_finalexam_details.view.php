<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
  <body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    <?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
    <?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Final Exam Default Settings</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('admin/home'); ?>">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('module/list'); ?>">Modules</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Final Exam Default Settings
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
              <a href="<?php echo base_url('module/list'); ?>">
                <button class="btn btn-round btn-info" type="button">
                  <i class="ft-list"></i> All Modules
                </button>
              </a>
            </div>
          </div>
        </div>
        <div class="content-body">
          <section id="file-export">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-content">
                    <?php if($this->session->flashdata('defaultsettingmsg')) {
                      $message = $this->session->flashdata('defaultsettingmsg'); ?>
                      <div class="alert alert-<?php echo $message['alertmsgClass']; ?> alert-dismissible m-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <?php echo $message['alert_msg']; ?>
                      </div>
                    <?php } ?>
                    <div class="card-body">
                      <?php echo form_open('finalexam/settings','novalidate');?>
                        <div class="form-body">
                          <h4 class="form-section"><i class="la la-eye"></i> Final Exam Default Settings</h4>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>No. Of Questions<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="number" id="no_of_questions" name="no_of_questions" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $default_settings['no_of_questions']; ?>">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Test Time<span class="required">*</span></h5>
                                <div class="input-group">
                                  <input type="number" id="test_time" name="test_time" class="form-control" value="<?php echo $default_settings['test_time']; ?>" required data-validation-required-message="This field is required">
                                  <div class="input-group-append">
                                    <span class="input-group-text">
                                      Minutes
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--2 row-->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Marks per Question<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="number" id="per_question_marks" name="per_question_marks"value="<?php echo $default_settings['question_marks']; ?>" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>No. Of attempts<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="number" id="test_attempts" name="test_attempts" class="form-control" value="<?php echo $default_settings['no_of_attempts']; ?>" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions right">
                            <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                              <i class="ft-refresh-ccw"></i> Reset
                            </button>
                            <button type="submit" name="submit_test_Details" value="submit" class="btn btn-primary">
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
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script><script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
</body>
</html>