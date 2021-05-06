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
<!-- new daterange picker css -->
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php");
$hashedID = encryptID($this->session->userdata('id'),$InstructorDetails['id']);
include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Instructor Profile : <?php echo $InstructorDetails['fullname']; ?></h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="<?php echo base_url('admin/home'); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="<?php echo base_url('instructor/list'); ?>">All Instructors</a>
                </li>
                <li class="breadcrumb-item active">
                  Instructor Profile
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
            <a href="<?php echo base_url('instructor/list'); ?>">
            <button class="btn btn-round btn-info" type="button">
            <i class="ft-list"></i> All Instructors
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
                    <div class="nav-vertical">
                      <ul class="nav nav-tabs nav-left nav-border-left update-ins-profile">
                        <li class="nav-item">
                          <a class="nav-link active" id="baseVerticalLeft1-tab1" data-toggle="tab" aria-controls="tabVerticalLeft11"
                            href="#tabVerticalLeft11" aria-expanded="true">
                            <div class="text-center">
                              <div class="card-body">
                                <img src="<?php echo base_url('uploads/').$InstructorDetails['profile_image'] ; ?>" class="rounded-circle  height-150"
                                  alt="Card image">
                              </div>
                              <div class="card-body">
                                <h4 class="card-title"><?php echo $InstructorDetails['fullname']; ?></h4>
                                <h6 class="card-subtitle text-muted"><?php $user_type = $InstructorDetails['user_type'];
                                  if($user_type=='0'){ echo "Super Admin"; }
                                  elseif($user_type=='1'){ echo "Instructor"; }
                                  elseif($user_type=='0'){ echo "Student"; } ?></h6>
                                <h4 class="card-title"><?php echo $InstructorDetails['designation']; ?></h4>
                              </div>
                            </div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="baseVerticalLeft1-tab2" data-toggle="tab" aria-controls="tabVerticalLeft12"
                            href="#tabVerticalLeft12" aria-expanded="false">Update Account Details</a>
                        </li>
                       <!--  <li class="nav-item">
                          <a class="nav-link" id="baseVerticalLeft1-tab3" data-toggle="tab" aria-controls="tabVerticalLeft13"
                            href="#tabVerticalLeft13" aria-expanded="false">Change Password</a>
                        </li> -->
                        <li class="nav-item">
                          <a class="nav-link" id="baseVerticalLeft1-tab4" data-toggle="tab" aria-controls="tabVerticalLeft14"
                            href="#tabVerticalLeft14" aria-expanded="false">Change Profile Image</a>
                        </li>
                      </ul>
                      <div class="tab-content px-1">
                        <div role="tabpanel" class="tab-pane active" id="tabVerticalLeft11" aria-expanded="true" aria-labelledby="baseVerticalLeft1-tab1">
                          <div class="card-body admin-account-details">
                            <div id="fuzzy-search-list" class="row info-div-content">
                              <ul class="list-group list col-md-6">
                                <li class="list-group-item">
                                  <span class="info-heading">First Name:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['fullname'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">Phone:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['phone'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">Gender:</span>
                                  <span class="info-value"><?php if ($InstructorDetails['gender']=='1') {
                                    echo '<span class="gender-icons">&#9794;</span> Male' ;
                                    } else {
                                    echo '<span class="gender-icons">&#9792;</span> Female' ;
                                    }
                                    ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">Address:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['address'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">State:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['state'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">Skype ID:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['skype_id'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">User Bio:</span>
                                  <span class="info-value user_bio"><?php echo $InstructorDetails['user_bio'] ; ?></span>
                                </li>
                              </ul>
                              <ul class="list-group list col-md-6">
                                <li class="list-group-item">
                                  <span class="info-heading">Email:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['email'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">DOB:</span>
                                  <span class="info-value"><?php echo date("jS F, Y", strtotime($InstructorDetails['dob'])) ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">Qualification:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['qualification'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">City:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['city'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">District:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['district'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">Designation:</span>
                                  <span class="info-value"><?php echo $InstructorDetails['designation'] ; ?></span>
                                </li>
                                <li class="list-group-item">
                                  <span class="info-heading">Reg. Date:</span>
                                  <span class="info-value"><?php echo date("jS F, Y h:i:s A", strtotime($InstructorDetails['created_by'])) ; ?></span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tabVerticalLeft12" aria-labelledby="baseVerticalLeft1-tab2">
                          <div class="card-body">
                            <?php echo form_open('instructor/update/'.$hashedID,'novalidate');?>
                            <input type="hidden" name="lat" id="lat" value="<?php echo $InstructorDetails['latitude']; ?>"/>
                            <input type="hidden" name="lng" id="lng" value="<?php echo $InstructorDetails['longitude']; ?>"/>
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-edit"></i> About User</h4>
                              <!--1 row--> 
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>Full Name<span class="required">*</span></h5>
                                    <div class="controls">
                                      <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter your First Name" required data-validation-required-message="This field is required" data-validation-regex-regex="([\a-zA-Z ]+)"data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $InstructorDetails['fullname']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>Email<span class="required">*</span>
                                    </h5>
                                    <div class="controls">
                                      <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $InstructorDetails['email']; ?>" readonly>
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
                                      <input type="text" id="designation" name="designation" placeholder="Director – Training & Placement" class="form-control" value="<?php echo $InstructorDetails['designation']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>Website
                                    </h5>
                                    <div class="controls">
                                      <input type="url" id="website" name="website" placeholder="http://" class="form-control" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Invalid URL" value="<?php echo $InstructorDetails['website']; ?>">
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
                                      <input type="text" name="skype_id" placeholder="Please Add Skype ID" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $InstructorDetails['skype_id']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>Phone Number<span class="required">*</span>
                                    </h5>
                                    <div class="controls">
                                      <input type="number" id="phone" name="phone" placeholder="Enter Phone" class="form-control" required data-validation-required-message="This field is required" minlength="10" maxlength="10" value="<?php echo $InstructorDetails['phone']; ?>">
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
                                      <textarea rows="5"  type="textarea" class="form-control" name="address" id="autocomplete" onFocus="geolocate()"placeholder="House No./flat, City" required data-validation-required-message="This field is required"><?php echo $InstructorDetails['address']; ?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>City<span class="required">*</span></h5>
                                    <div class="controls">
                                      <input type="text" class="form-control" name="city" id="locality" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="City/Town/Village" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $InstructorDetails['city']; ?>">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <h5>Pin Code<span class="required">*</span></h5>
                                    <div class="controls">
                                      <input type="text" id="postal_code" name="pincode" placeholder="Postal Code" class="form-control" required data-validation-regex-regex="([\da-z]+)" data-validation-regex-message="valid inputs are a-z, 0-9" data-validation-required-message="This field is required" maxlength="10" value="<?php echo $InstructorDetails['pincode']; ?>">
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
                                      <input type="text" class="form-control" name="state" id="administrative_area_level_1" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="State*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $InstructorDetails['state']; ?>">
                                      <!-- <Select class="form-control" id="state" name="state" required data-validation-required-message="This field is required">
                                        <option value="">Select State</option>
                                        <?php
                                          foreach ($states as $row) 
                                          {
                                            if ($row['state_id'] == $InstructorDetails['state']) 
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
                                      <input type="text" class="form-control" name="district" id="administrative_area_level_2" data-validation-regex-regex="([\a-zA-Z ]+)" placeholder="District*" required data-validation-required-message="This field is required" data-validation-regex-message="valid inputs are a-z, A-Z" value="<?php echo $InstructorDetails['district']; ?>">
                                      <!-- <Select class="form-control" id="district" name="district" required data-validation-required-message="This field is required">
                                        <option value="">Select District</option>
                                        <?php
                                          foreach ($district as $row) 
                                          {
                                            if ($row['district_id'] == $InstructorDetails['district']) 
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
                                    <h5>Qualifications<span class="required">*</span></h5>
                                    <div class="controls">
                                      <select class="form-control" name="qualification" id="qualification" required data-validation-required-message="This field is required">
                                        <option value="">Select Qualification*</option>
                                        <?php 
                                          $educationList = educationList();
                                          foreach ($educationList as $value) { 
                                            if ($InstructorDetails['qualification'] == $value) 
                                              {?>
                                            <option selected value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                          <?php }else{  ?>
                                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                        <?php } }?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <h5>Gender<span class="required">*</span></h5>
                                    <div class="controls">
                                      <div class="skin skin-square">
                                        <input type="radio" value="1" name="gender" <?php if($InstructorDetails['gender']=='1'){ echo "checked"; }?> required>
                                        <label for="male">Male</label>
                                      </div>
                                      <div class="skin skin-square">
                                        <input type="radio" value="2" name="gender" <?php if($InstructorDetails['gender']=='2'){ echo "checked"; }?>>
                                        <label for="female">Female</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>DOB<span class="required">*</span></h5>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <span class="la la-calendar-o"></span>
                                        </span>
                                      </div>
                                      <input type="text" id="dob" name="dob" placeholder="Select your Birth Date " class="form-control singledate" value="<?php echo date('m/d/Y', strtotime($InstructorDetails['dob'])); ?>" required data-validation-required-message="This field is required">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <h5>User Bio</h5>
                                    <div class="controls">
                                      <textarea rows="5" class="form-control" type="textarea" id="user_bio" name="user_bio" placeholder="Tell something about Instructor..."><?php echo $InstructorDetails['user_bio']; ?></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-actions right">
                                <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                                  <i class="ft-refresh-ccw"></i> Reset
                                </button>
                                <button type="submit" name="update_instructor" id="update_instructor" value="submit" class="btn btn-primary">
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
                        <!-- <div class="tab-pane" id="tabVerticalLeft13" aria-labelledby="baseVerticalLeft1-tab3">
                          <div class="card-body">
                            <?php //echo form_open('instructor/update/'.$hashedID,'novalidate');?>
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-lock"></i> Change Your Password</h4>
                              <div class="col-md-7">
                                <div class="form-group">
                                  <h5>Password
                                    <span class="required">*</span>
                                  </h5>
                                  <div class="controls">
                                    <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" required data-validation-required-message="This field is required">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-7">
                                <div class="form-group">
                                  <h5>Confirm Password
                                    <span class="required">*</span>
                                  </h5>
                                  <div class="controls">
                                    <input type="password" name="password2" placeholder="Re-enter your Password" data-validation-match-match="password" class="form-control"
                                      required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-actions right">
                                <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                                  <i class="ft-refresh-ccw"></i> Reset
                                </button>
                                <button type="submit" name="update_password" value="submit" class="btn btn-primary">
                                  <i class="la la-check-square-o"></i> Update Password
                                </button>
                                <button type="button" onclick="goBack()" name="reset_form" value="reset" class="btn btn-danger">
                                  <i class="ft-x"></i> Cancel
                                </button>
                              </div>
                            </div>
                            <?php echo form_close(); ?>
                          </div>
                        </div> -->
                        <div class="tab-pane" id="tabVerticalLeft14" aria-labelledby="baseVerticalLeft1-tab4">
                          <div class="card-body">
                            <?php echo form_open_multipart('instructor/update/'.$hashedID,'novalidate');?>
                            <img src="<?php echo base_url('uploads/').$InstructorDetails['profile_image']; ?>" style= 'display: none;' id='profileImage'>
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-image"></i> Change Profile Image</h4>
                              <div class="col-md-7">
                                <div class="form-group">
                                  <h5>Profile Image<span class="required">* (Only jpg, png, jpeg, gif images are allowed)</span></h5>
                                  <div class="controls">
                                    <input type="file" class="form-control update_profile_image" id="update_profile_image" name="profile_image" required="true">
                                  </div>
                                  <img id="newImage" src="<?php echo base_url('uploads/').$InstructorDetails['profile_image']; ?>" alt="<?php echo $InstructorDetails['fullname']; ?>" style="width: 115px;padding-top: 10px;">
                                  <span class="text-danger image-error"></span>
                                </div>
                              </div>
                              <div class="form-actions right">
                                <button type="reset" name="reset_form" id="reset_image" value="reset" class="btn btn-warning">
                                  <i class="ft-refresh-ccw"></i> Reset
                                </button>
                                <button type="submit" name="update_profile_image" value="submit" class="btn btn-primary">
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

    <!-- date rangepicker-->
    <script src="/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
    <script src="/app-assets/js/autocomplete.js" type="text/javascript"></script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtUZEucyyJ-ceAAzcu63KRbem-Zi-W7ZA&libraries=places&callback=initAutocomplete" async defer></script>
    <script src="/app-assets/js/profileimage.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){

      $("#state").on("change",function(){
          changedistrict(this.value);
        });

      $("#update_profile_image").bind('change', function()
      {
        var file = $("#update_profile_image").val();    //alert(file);
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["jpg" , "jpeg", "png", "gif"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
          console.log(ext);
          $("#update_profile_image").val("");
          // $('#update_profile_image').closest('.form-group').addClass('error');
          // $('#update_profile_image').closest('.form-group').removeClass('validate');
          // $("#update_profile_image").attr("aria-invalid", "true");
          $(".image-error").html('<ul><li>This Extension type is not Allowed here.Please Choose "jpg" , "jpeg", "png", "gif".</li></ul>');
        }else{
          $(".image-error").html('');
        }
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
        });
  </script>
</body>
</html>