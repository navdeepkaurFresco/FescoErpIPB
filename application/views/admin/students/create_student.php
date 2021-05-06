    <?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/pickers/daterange/daterange.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">

    <!-- new daterange picker css -->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
  </head>
  <body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
    <?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title mb-0">Create New Student</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('admin/home'); ?>">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('student/list'); ?>">All Students</a>
                  </li>
                  <li class="breadcrumb-item active">
                    Create New
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
              <a href="<?php echo base_url('student/list'); ?>">
                <button class="btn btn-round btn-info" type="button">
                  <i class="ft-list"></i> All Students
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
                      <?php if($this->session->flashdata('item_createStudent')) {
                        $message = $this->session->flashdata('item_createStudent'); ?>
                        <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <?php echo $message['message']; ?>
                        </div>
                      <?php } ?>
                      <?php echo form_open_multipart('student/create','novalidate',array('id'=>'create_new_student_form'));?>
                        <div class="form-body">
                          <input type="hidden" name="lat" id="lat" />
                          <input type="hidden" name="lng" id="lng" />
                          <h4 class="form-section"><i class="la la-eye"></i> About Student</h4>
                          <!--1 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Name<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter Full Name" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)" data-validation-regex-message="valid inputs are a-z, A-Z">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Email<span class="required">*</span>
                                </h5>
                                <div class="controls">
                                  <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--2 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>DOB<span class="required">*</span></h5>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <span class="la la-calendar-o"></span>
                                    </span>
                                  </div>
                                  <input type="text" id="dob" name="dob" placeholder="Select Birth Date " class="form-control singledate" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Qualifications<span class="required">*</span></h5>
                                <div class="controls">
                                  <select class="form-control" name="qualification" id="qualification" required data-validation-required-message="This field is required">
                                    <option value="">Select Qualification*</option>
                                    <?php 
                                      $educationList = educationList();
                                      foreach ($educationList as $value) {?>
                                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php }?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--3 row--> 

                          <h4 class="form-section"><i class="ft-mail"></i> Contact Info & Bio</h4>
                          <!--5 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Skype ID
                                </h5>
                                <div class="controls">
                                  <input type="text" name="skype_id" placeholder="Please Add Skype ID" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Phone Number<span class="required">*</span>
                                </h5>
                                <div class="controls">
                                  <input type="number" id="phone" name="phone" placeholder="Enter Phone" class="form-control" required data-validation-required-message="This field is required" minlength="10" maxlength="10">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--6 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Address<span class="required">*</span></h5>
                                <div class="controls">
                                  <textarea rows="5" class="form-control" type="textarea" name="address" placeholder="House No./flat, Colony" required data-validation-required-message="This field is required"></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>State<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" class="form-control" name="state" id="administrative_area_level_1" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="State*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z">
                                </div>
                              </div>
                              <div class="form-group">
                                <h5>District<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" class="form-control" name="district" id="administrative_area_level_2" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="District*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z">
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
                          <!--7 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>City/Village/Town<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="locality" name="city" placeholder="Enter City/Village/Town" class="form-control" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)" data-validation-regex-message="valid inputs are a-z, A-Z">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Pin Code<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="postal_code" name="pincode" placeholder="Postal Code" class="form-control" required data-validation-required-message="This field is required" required data-validation-regex-regex="([\da-z]+)" data-validation-regex-message="valid inputs are a-z, 0-9" maxlength="10">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions right">
                            <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                            <i class="ft-refresh-ccw"></i> Reset
                            </button>
                            <button type="submit" name="create_student" id="create_student" value="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Create
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
    <?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>

    <script src="/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js" type="text/javascript"></script>
    <script src="/app-assets/js/autocomplete.js" type="text/javascript"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtUZEucyyJ-ceAAzcu63KRbem-Zi-W7ZA&libraries=places&callback=initAutocomplete" async defer></script>
    <script type="text/javascript">
      $(document).ready(function () {
        $("#email").bind('change', function(){
          var emailid = $('#email').val(); 
          $.ajax(
          {
            url: '<?php echo base_url(); ?>student/checkemail',
            data: { emailid:emailid },
            type: 'POST',
            success: function(response)
            {
                //console.log(response);
                if (response.length > 0) 
                {
                    if($.trim(response))
                    {
                        $('#email').closest('.form-group').addClass('error');
                        $('#email').closest('.form-group').removeClass('validate');
                        $("#email").attr("aria-invalid", "true");
                        $("#email").next(".help-block").append('<ul><li>This Email ID is already exists. Please provide another Email.</li></ul>').css('color','red');
                        $("#create_student").attr("disabled", true);
                    }
                }else
                    {
                        $("#create_student").attr("disabled", false);
                    }
            },
            error: function(err)
            {
              console.log(err);
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

                showDropdowns: true,

                maxDate: new Date()
            });

             $('.singledate').val('');
        });
    </script>
  </body>
</html>