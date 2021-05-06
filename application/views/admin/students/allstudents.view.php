<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">All Students Details</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('student/list'); ?>">Students</a>
              </li>
              <li class="breadcrumb-item active">
                All Students Details
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <a href="<?php echo base_url('student/create'); ?>">
            <button class="btn btn-round btn-info" type="button">
              <i class="ft-plus-circle"></i> Add New Student
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
                <div class="card-body">
                  <?php if($this->session->flashdata('alertmessage')) {
                    $message = $this->session->flashdata('alertmessage'); ?>
                    <div class="alert <?php echo $message['alertmsgClass']; ?> alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <?php echo $message['alert_msg']; ?>
                    </div>
                  <?php }else{ echo '<div class="alertmsgdiv"></div>'; } ?>
                  <table id="student_table" class="table table-striped table-bordered base-style file-export table-responsive">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Qualification</th>
                        <th>Skype ID</th>
                        <th>Location</th>
                        <th>Account Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; if(!empty($AllStudents)){
                      foreach($AllStudents as $single_student_details){ 
                      $hashedID = encryptID($this->session->userdata('id'),$single_student_details['id']);
                      $dob = $single_student_details['dob']; ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="<?php echo base_url('student/profile/'.$hashedID);?>" class="media-heading"><?php echo $single_student_details['fullname']; ?></a>
                        </td>
                        <td class="text-center">
                          <a href="mailto:<?php echo $single_student_details['email']; ?>"><?php echo $single_student_details['email']; ?></a>
                        </td>
                        <td><?php echo $single_student_details['phone']; ?></td>
                        <td><?php echo ($dob=='0000-00-00') ? '' : date('jS F, Y', strtotime($dob)); ?></td>
                        <td><?php echo $single_student_details['qualification']; ?></td>
                        <td><?php echo $single_student_details['skype_id']; ?></td>
                        <td><?php echo $single_student_details['address']; ?></td>
                        <td class="btn_temp"><?php $is_deactive = $single_student_details['is_deactive'];
                        
                        if($is_deactive=='0')
                        {
                          echo '<button type="button" value="'.$hashedID.'" name="activate_student" class="btn btn-info updateAccountStatus"><i class="ft-unlock"></i> Active</button>';
                        }else
                        {
                          echo '<button type="button" value="'.$hashedID.'" name="deactivate_student" class="btn btn-danger updateAccountStatus"><i class="ft-lock"></i> De-Active</button>';
                        }
                        
                        ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?php echo base_url('student/update/'.$hashedID);?>"><i class="ft-edit-2"></i> Edit</a>
                        </td>
                      </tr>
                      <?php  $i++; } }?>
                    </tbody>
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
<?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.colVis.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.btn_temp').on('click', '.updateAccountStatus', function(){
      var buttonval = $(this).val();          //alert(buttonval);
      var buttonName = $(this).attr('name');  //alert(buttonName);
      var _this = this;
      $.ajax({
        url: '<?php echo base_url(); ?>student/updateStudentAccountStatus',
        data: { 
          buttonName:buttonName,
          buttonval:buttonval
        },
        type: 'POST',
        success: function(data){
          var data = JSON.parse(data);
          //console.log(data.msg, data);

          $(_this).parent().html(data.button_temp);

          $('.alertmsgdiv').html('<div class="alert '+data.class+' alert-dismissible mb-2" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'+data.msg+'</div>');
        }
      });
    });
  });
</script>
</body>
</html>