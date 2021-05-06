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
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Student Profile : <?php echo $StudentDetails['fullname']; ?></h3>
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
                  Student Profile
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
        <section id="vertical-tabs">
          <div class="row match-height">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-content">
                  <div class="card-body">
                    <?php if($this->session->flashdata('item')) {
                      $message = $this->session->flashdata('item'); ?>
                      <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <?php echo $message['message']; ?>
                      </div>
                    <?php } 
                    $hashedID = encryptID($this->session->userdata('id'),$StudentDetails['id']);?>
                    <div class="card-body">
                      <?php echo form_open('student/update/'.$hashedID,'novalidate');?>
                        <div class="form-body">
                          <input type="hidden" name="lat" id="lat" value="<?php echo $StudentDetails['latitude']; ?>"/>
                          <input type="hidden" name="lng" id="lng" value="<?php echo $StudentDetails['longitude']; ?>"/>
                          <h4 class="form-section"><i class="la la-edit"></i> About Student</h4>
                          <!--1 row--> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <h5>Full Name<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter Full Name" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)"data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $StudentDetails['fullname']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--2 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Email<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $StudentDetails['email']; ?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <h5>Skype ID<span class="required">*</span></h5>
                                  <div class="controls">
                                    <input type="text" name="skype_id" placeholder="Please Add Skype ID" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $StudentDetails['skype_id']; ?>">
                                  </div>
                                </div>
                            </div>
                          </div>
                          <h4 class="form-section"><i class="ft-mail"></i> Contact Info & Bio</h4>
                          <!--4 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Qualifications<span class="required">*</span></h5>
                                <div class="controls">
                                  <select class="form-control" name="qualification" id="qualification" required data-validation-required-message="This field is required">
                                    <option value="">Select Qualification*</option>
                                    <?php $educationList = educationList();
                                      foreach ($educationList as $value) { 
                                        if ($StudentDetails['qualification'] == $value) 
                                          {?>
                                        <option selected value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                      <?php }else{  ?>
                                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                    <?php } }?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Phone Number<span class="required">*</span>
                                </h5>
                                <div class="controls">
                                  <input type="number" id="phone" name="phone" placeholder="Enter Phone" class="form-control" required data-validation-required-message="This field is required" minlength="10" maxlength="15" value="<?php echo $StudentDetails['phone']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--5 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Address<span class="required">*</span></h5>
                                <div class="controls">
                                  <textarea rows="5" class="form-control" type="textarea" name="address" placeholder="House No./flat, Colony" required data-validation-required-message="This field is required"><?php echo $StudentDetails['address']; ?></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>City/Village/Town<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="locality" name="city" placeholder="Enter City/Village/Town" class="form-control" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $StudentDetails['city']; ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <h5>Pin Code<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" id="postal_code" name="pincode" placeholder="Postal Code" class="form-control" required data-validation-regex-regex="([\da-z]+)" data-validation-regex-message="valid inputs are a-z, 0-9" data-validation-required-message="This field is required" maxlength="10" value="<?php echo $StudentDetails['pincode']; ?>">
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--6 row--> 
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>State<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" class="form-control" name="state" id="administrative_area_level_1" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="State*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $StudentDetails['state']; ?>">
                                  <!-- <Select class="form-control" id="state" name="state" required data-validation-required-message="This field is required" value="<?php echo $StudentDetails['state']; ?>">
                                    <option value="Select State">Select State</option>
                                    <?php
                                      foreach ($states as $row) 
                                      {
                                        if ($row['state_id'] == $StudentDetails['state']) 
                                        {
                                          echo "<option selected value= '".$row['state_id']."'>".$row['statename']."</option>";
                                        }else
                                          {
                                            echo "<option value= '".$row['state_id']."'>".$row['statename']."</option>";
                                          }
                                      }
                                    ?>
                                  </Select> -->
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>District<span class="required">*</span></h5>
                                <div class="controls">
                                  <input type="text" class="form-control" name="district" id="administrative_area_level_2" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="District*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $StudentDetails['district']; ?>">
                                  <!-- <Select class="form-control" id="district" name="district" required data-validation-required-message="This field is required">
                                    <option value="">Select District</option>
                                    <?php
                                      foreach ($district as $row) 
                                      {
                                        if ($row['district_id'] == $StudentDetails['district']) 
                                        {
                                          echo "<option selected value= '".$row['district_id']."'>".$row['district_name']."</option>";
                                        }else
                                          {
                                            echo "<option value= '".$row['district_id']."'>".$row['district_name']."</option>";
                                          }                                        
                                      }
                                    ?>
                                  </Select> -->
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--7 row--> 
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
                                  <input type="text" id="dob" name="dob" placeholder="Select Birth Date " class="form-control singledate" value="<?php echo date('m/d/Y', strtotime($StudentDetails['dob'])); ?>" required data-validation-required-message="This field is required">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <h5>Gender<span class="required">*</span></h5>
                                <div class="controls">
                                  <div class="skin skin-square">
                                    <input type="radio" value="1" name="gender" <?php if($StudentDetails['gender']=='1'){ echo "checked"; }?> required>
                                    <label for="male">Male</label>
                                  </div>
                                  <div class="skin skin-square">
                                    <input type="radio" value="2" name="gender" <?php if($StudentDetails['gender']=='2'){ echo "checked"; }?>>
                                    <label for="female">Female</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-actions right">
                            <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                              <i class="ft-refresh-ccw"></i> Reset
                            </button>
                            <button type="submit" name="update_student" value="submit" class="btn btn-primary">
                              <i class="la la-check-square-o"></i>Update Details
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
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
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
    <script src="/app-assets/vendors/js/pickers/daterange/daterangepicker.js"type="text/javascript"></script>
    <script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js" type="text/javascript"></script>

    <!-- date rangepicker-->
    <script src="/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
    <script src="/app-assets/js/autocomplete.js" type="text/javascript"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtUZEucyyJ-ceAAzcu63KRbem-Zi-W7ZA&libraries=places&callback=initAutocomplete" async defer></script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.singledate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        maxDate: new Date()
      });
    });
  </script>
</body>
</html>