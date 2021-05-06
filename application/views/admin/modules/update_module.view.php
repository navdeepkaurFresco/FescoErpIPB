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
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php $hashedID = encryptID($this->session->userdata('id'),$ModuleDetails['id']); ?>
    <?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Update Module</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('admin/home'); ?>">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('module/list'); ?>">All Modules</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Update Module
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
              <a href="<?php echo base_url('module/list'); ?>">
                <button class="btn btn-round btn-info" type="button">
                  <i class="ft-list"></i> All Module
                </button>
              </a>
            </div>
          </div>
        </div>
        <div class="content-body">
          <section id="basic-form-layouts">
            <div class="row match-height">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">
                      <?php echo form_open_multipart('module/update/'.$hashedID,'novalidate');?>
                        <div class="form-body">
                          <h4 class="form-section"><i class="la la-eye"></i> Update Module Details</h4>
                          <!--1nd row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Select Instructor<span class="required">*</span></h5>
                                <div class="controls">
                                  <select name="instructor_id" class="form-control" required data-validation-required-message="This field is required">
                                    <option value="">Choose Instructor..</option>
                                    <?php foreach($instructors as $singleinstructor){ ?>
                                    <option value="<?php echo $singleinstructor['id'];?>"
                                      <?php if($ModuleDetails['instructor_id']==$singleinstructor['id']){ echo "Selected"; } ?>>
                                      <?php echo $singleinstructor['fullname'];?>
                                    </option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Module Title<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" value="<?php echo $ModuleDetails['course_title']; ?>" id="course_title" name="course_title" class="form-control" placeholder="Enter Module Title" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--2nd row-->
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Module Duration<span class="required">*</span></h5>
                                <div class='input-group'>
                                  <input type='number' value="<?php echo $ModuleDetails['time_duration']; ?>" id="time_duration" name="time_duration" class="form-control" required data-validation-required-message="This field is required"/>
                                  <div class="input-group-append">
                                    <span class="input-group-text">
                                      Months
                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <h5>Module Fee<span class="required">*</span></h5>
                                <div class="controls">
                                  <input value="<?php echo $ModuleDetails['fee']; ?>" type="text" id="fee" name="fee" class="form-control" placeholder="Enter Module Fee" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                              <div class="form-group">
                                <h5>Module Image<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="file" class="form-control" id="course_image" name="course_image">
                                </div>
                                <img src="<?php echo base_url('uploads/').$ModuleDetails['course_image']; ?>" style="width: 60px;margin-top: 10px;">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Module Description<span class="required">*</span></h5>
                                <div class="controls">
                                  <textarea rows="12" class="form-control" type="textarea" id="brief_detail" name="brief_detail" placeholder="Tell something about Module" required data-validation-required-message="This field is required"><?php echo $ModuleDetails['brief_detail']; ?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions right">
                            <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                              <i class="ft-refresh-ccw"></i> Reset
                            </button>
                            <button type="submit" name="update_Module" value="submit" class="btn btn-primary">
                              <i class="la la-check-square-o"></i> Update Module
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
    <script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#course_image").bind('change', function()
      {
        var file = $("#course_image").val();    //alert(file);
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["jpg" , "jpeg", "png", "gif"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
          $("#course_image").val("");
          $('#course_image').closest('.form-group').addClass('error');
          $('#course_image').closest('.form-group').removeClass('validate');
          $("#course_image").attr("aria-invalid", "true");
          $("#course_image").next(".help-block").append('<ul><li>This Extension type is not Allowed here.Please Choose "jpg" , "jpeg", "png", "gif".</li></ul>').css('color','red');
        }
      });
    });
    </script>
  </body>
</html>