<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
  data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
  <?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Instructor Profile : <?php echo $SingleInstructorDetails['fullname'] ; ?></h3>
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
      <div class="sidebar-detached sidebar-left" ,=",">
        <div class="sidebar">
          <div class="bug-list-sidebar-content">
            <div class="card card border-teal border-lighten-2">
              <div class="text-center">
                <div class="card-body">
                  <img src="<?php echo $SingleInstructorDetails['profile_image'] ; ?>" class=""
                    alt="Card image">
                </div>
                <div class="card-body">
                  <h4 class="card-title"><?php echo $SingleInstructorDetails['fullname'] ; ?></h4>
                  <h6 class="card-subtitle text-muted"><?php $user_type = $SingleInstructorDetails['user_type'];
                    if($user_type=='0'){ echo "Super Admin"; }
                    elseif($user_type=='1'){ echo "Instructor"; }
                    elseif($user_type=='0'){ echo "Student"; } ?></h6>
                  <h4 class="card-title"><?php echo $SingleInstructorDetails['designation']; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="content-detached content-right">
        <div class="content-body">
          <section class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-content">
                  <div class="card-body admin-account-details">
                    <div id="fuzzy-search-list" class="row info-div-content">
                      <ul class="list-group list col-md-6">
                        <li class="list-group-item">
                          <span class="info-heading">First Name:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['fullname'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">Phone:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['phone'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">Gender:</span>
                          <span class="info-value"><?php if ($SingleInstructorDetails['gender']=='1') {
                            echo '<span class="gender-icons">&#9794;</span> Male' ;
                            } elseif ($SingleInstructorDetails['gender']=='2') {
                            echo '<span class="gender-icons">&#9792;</span> Female' ;
                            }else{
                              echo '';
                            }
                            ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">Designation:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['designation'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">Address:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['address'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">State:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['state'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">User Bio:</span>
                          <span class="info-value user_bio"><?php echo $SingleInstructorDetails['user_bio'] ; ?></span>
                        </li>
                      </ul>
                      <ul class="list-group list col-md-6">
                        <li class="list-group-item">
                          <span class="info-heading">Email:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['email'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">DOB:</span>
                          <span class="info-value"><?php $dob = $SingleInstructorDetails['dob'];  echo ($dob=='0000-00-00') ? '' : date("jS F, Y", strtotime($dob)) ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">Qualification:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['qualification'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">Skype ID:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['skype_id'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">City:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['city'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">District:</span>
                          <span class="info-value"><?php echo $SingleInstructorDetails['district'] ; ?></span>
                        </li>
                        <li class="list-group-item">
                          <span class="info-heading">Reg. Date:</span>
                          <span class="info-value"><?php echo date("jS F, Y h:i:s A", strtotime($SingleInstructorDetails['created_by'])) ; ?></span>
                        </li>
                      </ul>
                      <ul class="list-group list col-md-12">
                        
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
</body>
</html>