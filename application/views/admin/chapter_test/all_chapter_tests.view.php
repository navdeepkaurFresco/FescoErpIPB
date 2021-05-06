<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title><?php echo @$title; ?></title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
      rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
      rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
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
            <h3 class="content-header-title mb-0">All Chapter Exams Details</h3>
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('home'); ?>">Home</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="<?php echo base_url('chapter/test/list'); ?>">Chapter Exams</a>
                  </li>
                  <li class="breadcrumb-item active">
                    All Chapter Exams Details
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right text-md-right col-md-6 col-12">
            <div class="btn-group">
              <a href="<?php echo base_url('chapter/test/create'); ?>">
                <button class="btn btn-round btn-info" type="button">
                  <i class="ft-plus-circle"></i> Add New Chapter Exam
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
                  <div class="card-header">
                    <h4 class="card-title">Chapter Exams Details</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <div class="alert <?php if(isset($alertmsgClass)){ echo $alertmsgClass; } ?> alert-dismissible mb-2" role="alert">
                        <?php if(isset($alert_msg)){ ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <?php echo $alert_msg; ?>
                        <?php }?>
                      </div>
                      <table class="table table-striped table-bordered base-style file-export table-responsive">
                        <thead>
                          <tr>
                            <th>S.No.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Qualification</th>
                            <th>Skype ID</th>
                            <th>Reg. Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; if(!empty($AllChapterTests)){
                            foreach($AllChapterTests as $singleChapterTest){ ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="<?php echo $singleChapterTest['profile_image']; ?>" style="width: 100px;" ></td>
                            <td><?php echo $singleChapterTest['fullname']; ?></td>
                            <td><?php echo $singleChapterTest['username']; ?></td>
                            <td><?php echo $singleChapterTest['email']; ?></td>
                            <td><?php echo $singleChapterTest['phone']; ?></td>
                            <td><?php echo date('jS F, Y', strtotime($singleChapterTest['dob'])); ?></td>
                            <td><?php echo $singleChapterTest['qualification']; ?></td>
                            <td><?php echo $singleChapterTest['skype_id']; ?></td>
                            <td><?php echo date('jS F, Y h:i:s A', strtotime($singleChapterTest['created_by'])) ; ?></td>
                            <td>
                              <a href="<?php echo base_url('chapter/test/update?id='.$singleChapterTest['id']);?>" style="margin-right: 10px;" >
                              <button type="submit" name="update_Chapter Exam" value="<?php echo $singleChapterTest['id']; ?>" class="btn btn-warning">
                              <i class="ft-edit-3"></i>
                              </button>
                              </a>
                              <?php echo form_open('');?>
                              <button type="submit" name="delete_Chapter Exam" class="btn btn-danger" value="<?php echo $singleChapterTest['id']; ?>">
                              <i class="ft-delete"></i>
                              </button>
                              <?php echo form_close(); ?>
                            </td>
                          </tr>
                          <?php  $i++; } }?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>S.No.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>Qualification</th>
                            <th>Skype ID</th>
                            <th>Reg. Date</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
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
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <?php include(dirname(dirname(dirname(__FILE__)))."/admin_includes/footer.php"); ?>
    <script src="/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"
      type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
    <script src="/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
    <script src="/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="/app-assets/js/core/app.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
    <script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js"
      type="text/javascript"></script>
  </body>
</html>