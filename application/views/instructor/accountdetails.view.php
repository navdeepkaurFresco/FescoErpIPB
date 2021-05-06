<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/ui/prism.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/forms/validation/form-validation.css">
  <!--  daterange picker css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/pickers/pickadate/pickadate.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/pickers/daterange/daterange.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css"> 
  <style type="text/css">
    .show-message {
      float: right;
      position: absolute;
      top: 50%;
      left: 100%;
    }
  </style>
</head>
<body class="vertical-layout vertical-content-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/instructor_header.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/instructor_sidebar.php"); ?>
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
                      <?php } ?>
                      <div class="nav-vertical">
                        <ul class="nav nav-tabs nav-linetriangle no-hover-bg nav-justified">
                          <li class="nav-item">
                            <a class="nav-link active" id="baseVerticalLeft1-tab1" data-toggle="tab" aria-controls="tabVerticalLeft11" href="#tabVerticalLeft11" aria-expanded="true">
                              Profile Details
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="baseVerticalLeft1-tab2" data-toggle="tab" aria-controls="tabVerticalLeft12" href="#tabVerticalLeft12" aria-expanded="false">Update Account Details</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="baseVerticalLeft1-tab3" data-toggle="tab" aria-controls="tabVerticalLeft13" href="#tabVerticalLeft13" aria-expanded="false">Change Password</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="baseVerticalLeft1-tab4" data-toggle="tab" aria-controls="tabVerticalLeft14" href="#tabVerticalLeft14" aria-expanded="false">Change Profile Image</a>
                          </li>
                        </ul>
                        <div class="tab-content px-1">
                          <div role="tabpanel" class="tab-pane active" id="tabVerticalLeft11" aria-expanded="true" aria-labelledby="baseVerticalLeft1-tab1">
                            <div class="card-body admin-account-details">
                              <div id="fuzzy-search-list" class="row info-div-content">
                                <ul class="list-group list col-md-6">
                                  <li class="list-group-item">
                                    <span class="info-heading">Full Name:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['fullname'] ; ?></span>
                                  </li>
                                  <!-- <li class="list-group-item">
                                    <span class="info-heading">Username:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['username'] ; ?></span>
                                  </li> -->
                                  <li class="list-group-item">
                                    <span class="info-heading">Phone:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['phone'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">Gender:</span>
                                    <span class="info-value"><?php if ($LoginUserDetails['gender']=='1') {
                                      echo '<span class="gender-icons">&#9794;</span> Male' ;
                                      } elseif ($LoginUserDetails['gender']=='2') {
                                      echo '<span class="gender-icons">&#9792;</span> Female' ;
                                      }else{
                                        echo '';
                                      }
                                      ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">Address:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['address'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">State:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['state'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">Pincode:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['pincode'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">Designation:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['designation'] ; ?></span>
                                  </li>
                                </ul>
                                <ul class="list-group list col-md-6">
                                  <li class="list-group-item">
                                    <span class="info-heading">Email:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['email'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">DOB:</span>
                                    <span class="info-value"><?php echo date("jS F, Y", strtotime($LoginUserDetails['dob'])) ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">Qualification:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['qualification'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">City/Village/Town:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['city'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">District:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['district'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">Skype ID:</span>
                                    <span class="info-value"><?php echo $LoginUserDetails['skype_id'] ; ?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span class="info-heading">User Bio:</span>
                                    <span class="info-value user_bio"><?php echo $LoginUserDetails['user_bio'] ; ?></span>
                                  </li>
                                </ul>
                                <ul class="list-group list col-md-12">
                                  <li class="list-group-item">
                                    <span class="info-heading">Reg. Date:</span>
                                    <span class="info-value"><?php echo date("jS F, Y h:i:s A", strtotime($LoginUserDetails['created_by'])) ; ?></span>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="tab-pane" id="tabVerticalLeft12" aria-labelledby="baseVerticalLeft1-tab2">
                            <div class="card-body">
                              <?php echo form_open('instructor/account','novalidate');?>
                              <input type="hidden" name="lat" id="lat" value="<?php echo $LoginUserDetails['latitude']; ?>"/>
                              <input type="hidden" name="lng" id="lng" value="<?php echo $LoginUserDetails['longitude']; ?>"/>
                                <div class="form-body">
                                  <h4 class="form-section"><i class="la la-edit"></i> About User</h4>
                                  <!--1 row--> 
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Full Name<span class="required">*</span></h5>
                                        <div class="controls">
                                          <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your Full Name" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)"data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $LoginUserDetails['fullname']; ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Email<span class="required">*</span>
                                        </h5>
                                        <div class="controls">
                                          <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $LoginUserDetails['email']; ?>" readonly>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--3 row-->
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Designation
                                        </h5>
                                        <div class="controls">
                                          <input type="text" id="designation" name="designation" placeholder="Director – Training & Placement" class="form-control" value="<?php echo $LoginUserDetails['designation']; ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Website
                                        </h5>
                                        <div class="controls">
                                          <input type="url" id="website" name="website" placeholder="http://" class="form-control" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Invalid URL" value="<?php echo $LoginUserDetails['website']; ?>">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <h4 class="form-section"><i class="ft-mail"></i> Contact Info & Bio</h4>
                                  <!--4 row--> 
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Skype ID<span class="required">*</span>
                                        </h5>
                                        <div class="controls">
                                          <input type="text" name="skype_id" placeholder="Please Add Skype ID" class="form-control" value="<?php echo $LoginUserDetails['skype_id']; ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Phone Number<span class="required">*</span>
                                        </h5>
                                        <div class="controls">
                                          <input type="number" id="phone" name="phone" placeholder="Enter Phone" class="form-control" required data-validation-required-message="This field is required" minlength="10" maxlength="10" value="<?php echo $LoginUserDetails['phone']; ?>">
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
                                          <textarea rows="5" class="form-control" type="textarea" name="address" placeholder="House No./flat, city, state"><?php echo $LoginUserDetails['address']; ?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>State<span class="required">*</span></h5>
                                        <div class="controls">
                                          <input type="text" class="form-control" name="state" id="administrative_area_level_1" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="State*" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $LoginUserDetails['state']; ?>">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <h5>District<span class="required">*</span></h5>
                                        <div class="controls">
                                          <input type="text" class="form-control" name="district" id="administrative_area_level_2" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="District*" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $LoginUserDetails['district']; ?>">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--6 row--> 
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>City/Village/Town<span class="required">*</span></h5>
                                        <div class="controls">
                                          <input type="text" id="locality" name="city" placeholder="Enter your City/Village/Town" class="form-control" data-validation-regex-regex="([\a-zA-Z ]+)" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $LoginUserDetails['city']; ?>">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <h5>Qualifications<span class="required">*</span></h5>
                                        <div class="controls">
                                          <select class="form-control" name="qualification" id="qualification" required data-validation-required-message="This field is required">
                                            <option value="">Select Qualification*</option>
                                            <?php 
                                              $educationList = educationList();
                                              foreach ($educationList as $value) { ?>
                                                <option value="<?php echo $value; ?>" <?php echo $LoginUserDetails['qualification'] == $value ? "selected":""; ?>><?php echo $value; ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Pin Code<span class="required">*</span></h5>
                                        <div class="controls">
                                          <input type="text" id="postal_code" name="pincode" placeholder="Postal Code" class="form-control" data-validation-regex-regex="([\da-z]+)" data-validation-regex-message="valid inputs are a-z, 0-9" maxlength="10" value="<?php echo $LoginUserDetails['pincode']; ?>">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <h5>DOB<span class="required">*</span></h5>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <span class="la la-calendar-o"></span>
                                            </span>
                                          </div>
                                          <input type="text" id="dob" name="dob" value="<?php echo date('m/d/Y', strtotime($LoginUserDetails['dob'])); ?>" placeholder="Select your Birth Date " class="form-control singledate">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--7 row--> 
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Gender<span class="required">*</span></h5>
                                        <div class="controls">
                                          <div class="skin skin-square">
                                            <input type="radio" value="1" name="gender" <?php if($LoginUserDetails['gender']=='1'){ echo "checked"; }?> required>
                                            <label for="male">Male</label>
                                          </div>
                                          <div class="skin skin-square">
                                            <input type="radio" value="2" name="gender" <?php if($LoginUserDetails['gender']=='2'){ echo "checked"; }?>>
                                            <label for="female">Female</label>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>User Bio<span class="required">*</span></h5>
                                        <div class="controls">
                                          <textarea rows="5" class="form-control" type="textarea" id="user_bio" name="user_bio" placeholder="Tell something about Instructor..."><?php echo $LoginUserDetails['user_bio']; ?></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--8 row--> 
                                  <div class="row">
                                    <div class="col-md-6">
                                      
                                    </div>
                                  </div>
                                  <div class="form-actions right">
                                    <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                                      <i class="ft-refresh-ccw"></i> Reset
                                    </button>
                                    <button type="submit" name="update_instructor_details" value="submit" class="btn btn-primary">
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
                          <div class="tab-pane" id="tabVerticalLeft13" aria-labelledby="baseVerticalLeft1-tab3">
                            <div class="card-body">
                              <?php echo form_open('instructor/account','novalidate');?>
                                <div class="form-body">
                                  <h4 class="form-section"><i class="la la-lock"></i> Change Your Password</h4>
                                  <div class="col-md-7">
                                    <div class="form-group">
                                      <h5>Current Password
                                        <span class="required">*</span>
                                      </h5>
                                      <div class="controls">
                                        <input type="password" id="currentpassword" name="currentpassword" placeholder="Enter Current Password" class="form-control" required data-validation-required-message="This field is required">
                                      </div>
                                      <div class="show-message"></div>
                                    </div>
                                  </div>
                                  <h4 class="form-section"><i class="la la-edit"></i>Set New Password</h4>
                                  <div class="col-md-7">
                                    <div class="form-group">
                                      <h5>Password
                                        <span class="required">*</span>
                                      </h5>
                                      <div class="controls">
                                        <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" required data-validation-required-message="This field is required">
                                        <span style="color:red" class="val-error password_error" align="left"><?php echo form_error('');?></span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-7">
                                    <div class="form-group">
                                      <h5>Confirm Password
                                        <span class="required">*</span>
                                      </h5>
                                      <div class="controls">
                                        <input type="password" name="confirmPassword" placeholder="Re-enter your Password" data-validation-match-match="password" class="form-control" required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-actions right">
                                    <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                                      <i class="ft-refresh-ccw"></i> Reset
                                    </button>
                                    <button type="submit" name="update_instructor_password" id="update_instructor_password" value="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Update Password
                                    </button>
                                    <button type="button" onclick="goBack()" name="reset_form" value="reset" class="btn btn-danger">
                                      <i class="ft-x"></i> Cancel
                                    </button>
                                  </div>
                                </div>
                              <?php echo form_close(); ?>
                            </div>
                          </div>
                          <div class="tab-pane" id="tabVerticalLeft14" aria-labelledby="baseVerticalLeft1-tab4">
                            <div class="card-body">
                              <?php echo form_open_multipart('instructor/account','novalidate');?>
                              <img src="<?php echo $LoginUserDetails['profile_image']; ?>" style= 'display: none;' id='profileImage'>
                                <div class="form-body">
                                  <h4 class="form-section"><i class="la la-image"></i> Change Profile Image</h4>
                                  <div class="col-md-7">
                                    <div class="form-group">
                                      <h5>Profile Image<span class="required">*</span></h5>
                                      <div class="controls">
                                        <input type="file" class="form-control" id="update_profile_image" name="profile_image" required data-validation-required-message="This field is required">
                                      </div>
                                      <img id="newImage" src="<?php echo $LoginUserDetails['profile_image']; ?>" alt="" style="width: 115px;padding-top: 10px;">
                                    </div>
                                  </div>
                                  <div class="form-actions right">
                                    <button type="reset" name="reset_form" id="reset_image" value="reset" class="btn btn-warning">
                                      <i class="ft-refresh-ccw"></i> Reset
                                    </button>
                                    <button type="submit" name="update_instructor_profile_image" value="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Update Profile Image
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
                </div>
              </div>
            </div>
          </section>
      </div>
    </div>
  </div>
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="/app-assets/vendors/js/ui/prism.min.js"></script>

  <!-- daterange picker -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/js/profileimage.js" type="text/javascript"></script> 
  <script src="<?php echo base_url(); ?>/app-assets/js/autocomplete.js" type="text/javascript"></script> 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtUZEucyyJ-ceAAzcu63KRbem-Zi-W7ZA&libraries=places&callback=initAutocomplete" async defer></script>

  <script type="text/javascript">
  $(document).ready(function(){

    $("#state").on("change",function(){
      changedistrict(this.value);
    });

    $('.singledate').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      maxDate: new Date()
    });

    // To check image extension type.
    $("#update_profile_image").bind('change', function()
    {
      var file = $("#update_profile_image").val();    //alert(file);
      var ext = file.split(".");
      ext = ext[ext.length-1].toLowerCase();      
      var arrayExtensions = ["jpg" , "jpeg", "png", "gif"];

      if (arrayExtensions.lastIndexOf(ext) == -1) {
        $("#update_profile_image").val("");
        $('#update_profile_image').closest('.form-group').addClass('error');
        $('#update_profile_image').closest('.form-group').removeClass('validate');
        $("#update_profile_image").attr("aria-invalid", "true");
        $("#update_profile_image").next(".help-block").append('<ul><li>This Extension type is not Allowed here.Please Choose "jpg" , "jpeg", "png", "gif".</li></ul>').css('color','red');
      }
    });

    // To Check if current password is matching
    $("#currentpassword").bind('change', function()
    {
      var currentpassword = $("#currentpassword").val();
      
      $(".show-message i").remove();
      $.ajax(
      {
        url: '<?php echo base_url(); ?>instructor/checkPassword',
        data: { password:currentpassword },
        type: 'POST',
        success: function(response)
        {
          console.log(response);
          if($.trim(response))
          {
            $(".show-message").append('<i class="ft-check-circle"></i>');
            $(".show-message i").css({"color": "#28D094", "font-size": "17px"});
            $("#update_instructor_password").attr("disabled", false);
          }else
            {
              $('#currentpassword').closest('.form-group').addClass('error');
              $('#currentpassword').closest('.form-group').removeClass('validate');
              $("#currentpassword").attr("aria-invalid", "true");
              $(".show-message").append('<i class="ft-x-circle"></i>');
              $(".show-message i").css({"color": "#FF394F", "font-size": "17px"});
              $("#update_instructor_password").attr("disabled", true);
            }
        },
        error: function(err)
        {
          console.log(err);
        }
      });
    });

    $("#username").bind('blur', function(){
      var username = $('#username').val(); 
      $.ajax(
      {
        url: '<?php echo base_url(); ?>common/checkusername',
        data: { username:username },
        type: 'POST',
        success: function(response)
        {
            //console.log(response);
            if (response > 0) 
            {
                if($.trim(response))
                {
                    $('#username').closest('.form-group').addClass('error').removeClass('validate');
                    $("#username").attr("aria-invalid", "true").next(".help-block").append('<ul><li>Username is already exists.</li></ul>').css('color','red');
                    $("#update_student_profile").attr("disabled", true);
                }
            }else
                {
                    $("#update_student_profile").attr("disabled", false);
                }
        },
        error: function(err)
        {
          console.log(err);
        }
      });
    });
    $('#password').keyup(function(){
    $('span.error-keyup-3').remove();
      var newpassword=$(this).val();
      //console.log(newpassword);
      var characterReg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{6,})/;
     if(!characterReg.test(newpassword)) {
        var res="Please provide a stronger password that have atleast one capital letter, one small letter, one special character, a number and minimum lenght should be six and should not contain username";
       // console.log(res)
        $(".password_error").html(res);
      }
      else{
        $(".password_error").html("");

      }

    });
  });
  </script>
</body>
</html>