    <?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
  </head>
  <body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    <?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
    <?php $hashedID = encryptID($this->session->userdata('id'),$QuestionDetails['id']); ?>
    <?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Update Chapter</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('admin/home'); ?>">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('chapter/list'); ?>">All Chapters</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Update Chapter
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
              <a href="<?php echo base_url('chapter/list'); ?>">
                <button class="btn btn-round btn-info" type="button">
                  <i class="ft-list"></i> All Chapters
                </button>
              </a>
            </div>
          </div>
        </div>
        <div class="content-body">
          <section id="ui-color">
            <div class="row match-height">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <?php echo form_open('module_question/update/'.$hashedID,'novalidate');?>
                        <div class="form-body">
                          <h4 class="form-section"><i class="la la-eye"></i> Question Title</h4>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <h5>Question Title<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="question_title" name="question_title" class="form-control" placeholder="Enter Chapter Title" value="<?php echo $QuestionDetails['question_title']; ?>" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <h4 class="form-section"><i class="la la-list"></i> Question Options</h4>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Option One<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="option1" name="option1" value="<?php echo $QuestionDetails['option1']; ?>" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Option Two<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="option2" name="option2" value="<?php echo $QuestionDetails['option2']; ?>" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Option Three<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="option3" name="option3" value="<?php echo $QuestionDetails['option3']; ?>" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Option four<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="option4" name="option4" value="<?php echo $QuestionDetails['option4']; ?>" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <h4 class="form-section"><i class="ft-check"></i> Correct Answer</h4>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Correct Answer<span class="required">*</span></h5>
                                <div class="controls">
                                  <select id="correct_answer" name="correct_answer" class="form-control" required data-validation-required-message="This field is required">
                                    <option value="">Select</option>
                                    <option value="1" <?php echo ($QuestionDetails['correct_answer']==1) ? 'selected' : '' ; ?> >One</option>
                                    <option value="2" <?php echo ($QuestionDetails['correct_answer']==2) ? 'selected' : '' ; ?> >Two</option>
                                    <option value="3" <?php echo ($QuestionDetails['correct_answer']==3) ? 'selected' : '' ; ?> >Three</option>
                                    <option value="4" <?php echo ($QuestionDetails['correct_answer']==4) ? 'selected' : '' ; ?> >Four</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions right">
                            <input type="hidden" name="chapter_id" value="<?php echo $QuestionDetails['id'];?>">
                            <input type="hidden" name="module_id" value="<?php echo $QuestionDetails['module_id'];?>">
                            <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                            <i class="ft-refresh-ccw"></i> Reset
                            </button>
                            <button type="submit" name="update_question" value="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Update
                            </button>
                            <button type="button" data-dismiss="modal" name="reset_form" value="reset" class="btn btn-danger">
                            <i class="ft-x"></i> Cancel
                            </button>
                          </div>
                        </div>
                      <?php echo form_close();?>
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
    <script src="/app-assets/vendors/js/editors/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"
      type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
      type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"
      type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/forms/validation/form-validation.js"
      type="text/javascript"></script>
</body>
</html>