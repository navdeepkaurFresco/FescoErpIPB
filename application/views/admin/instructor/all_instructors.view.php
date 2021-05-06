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
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">All Instructors Details</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('instructor/list'); ?>">Instructors</a>
              </li>
              <li class="breadcrumb-item active">
                All Instructors Details
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <a href="<?php echo base_url('instructor/create'); ?>">
            <button class="btn btn-round btn-info" type="button">
              <i class="ft-plus-circle"></i> Add New Instructor
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
                  <?php if($this->session->flashdata('item')) {
                    $message = $this->session->flashdata('item'); ?>
                    <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <?php echo $message['message']; ?>
                    </div>
                  <?php } ?>
                  <table id="instructor_table" class="table table-striped table-responsive table-bordered base-style file-export">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>
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
                    <?php $i=1; if(!empty($AllInstructors)){
                      foreach($AllInstructors as $SingleInstructorDetails){ 
					            $hashedID = encryptID($this->session->userdata('id'),$SingleInstructorDetails['id']);
                      $dob = $SingleInstructorDetails['dob'];
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <div class="media">
                            <div class="media-left pr-1">
                              <span class="avatar avatar-sm rounded-circle">
                                <img src="<?php echo base_url('uploads/').$SingleInstructorDetails['profile_image']; ?>" alt="avatar"><i></i></span>
                            </div>
                            <div class="media-body media-middle">
                              <a href="<?php echo base_url('instructor/profile/'.$hashedID);?>" class="media-heading"><?php echo $SingleInstructorDetails['fullname']; ?></a>
                            </div>
                          </div>
                        </td>
                        <td class="text-center">
                          <a href="mailto:<?php echo $SingleInstructorDetails['email']; ?>"><?php echo $SingleInstructorDetails['email']; ?></a>
                        </td>
                        <td><?php echo $SingleInstructorDetails['phone']; ?></td>
                        <td><?php echo ($dob=='0000-00-00') ? '' : date('jS F, Y', strtotime($dob)); ?></td>
                        <td><?php echo $SingleInstructorDetails['qualification']; ?></td>
                        <td><?php echo $SingleInstructorDetails['skype_id']; ?></td>
                        <td><?php echo date('jS F, Y', strtotime($SingleInstructorDetails['created_by'])) ; ?></td>
                         <td>
                          <span class="dropdown">
                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                            <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                              <a href="<?php echo base_url('instructor/update/'.$hashedID);?>" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                              <a href="#" class="dropdown-item delete-btn" data-instructor_id="<?php echo $SingleInstructorDetails['id']; ?>" id="confirm-color"><i class="ft-trash-2"></i> Delete</a>
                            </span>
                          </span>
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
  $('.dropdown-item.delete-btn').on('click',function(){
    var instructorID = $(this).data('instructor_id'); //alert(instructorID);
    var currentRow = $(this).parents('tr');
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this Instructor's Details again...!",
      icon: "warning",
      showCancelButton: true,
      buttons: {
          cancel: {
              text: "No, Cancel.!",
              value: null,
              visible: true,
              className: "btn-warning",
              closeModal: false,
          },
          confirm: {
              text: "Yes, Delete it!",
              value: instructorID,
              name: "delete_instructor",
              visible: true,
              className: "",
              closeModal: false
          }
      }
    }).then(isConfirm => {
      if (isConfirm) {
        $.ajax({
          url: '<?php echo base_url(); ?>instructor/delete',
          data: { delete_instructor:instructorID },
          type: 'POST',
          success: function(data){
            //alert(data);
            swal("Deleted!", "Instructor has been deleted successfully...!", "success");
            $('#instructor_table').DataTable().row(currentRow).remove().draw();
          }
        });
      } else {
        swal("Cancelled", "Instructor's Details are still safe :)", "error");
      }
    });
  });
});
</script>
</body>
</html>