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
        <h3 class="content-header-title mb-0">All Modules Details</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('module/list'); ?>">Modules</a>
              </li>
              <li class="breadcrumb-item active">
                All Modules Details
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <a href="<?php echo base_url('module/create'); ?>">
            <button class="btn btn-round btn-info" type="button">
              <i class="ft-plus-circle"></i> Add New Module
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
                  <table id="modules_table" class="table table-striped table-responsive table-bordered base-style file-export">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Module Name</th>
                        <th>Instructor Name</th>
                        <th>Fee</th>
                        <th>Duration</th>
                        <th>Description</th>
                        <th>Reg. Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1;
                        if (!empty($AllModules)) {
                        foreach($AllModules as $singleModule){

                        $hashedID = encryptID($this->session->userdata('id'),$singleModule['id']); ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <a href="<?php echo base_url('module/detail/'.$hashedID);?>"><?php echo $singleModule['course_title']; ?></a>
                        </td>
                        <td><?php echo $singleModule['fullname']; ?></td>
                        <td><i class="la la-rupee"></i> <?php echo $singleModule['fee']; ?></td>
                        <td><?php echo $singleModule['time_duration']." Months";?></td>
                        <td><div class="scrollDiv"><?php echo $singleModule['brief_detail']; ?></div></td>
                        <td><?php echo date('jS F, Y', strtotime($singleModule['created_at'])) ; ?></td>
                        <td>
                          <span class="dropdown">
                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                            <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                              <a href="<?php echo base_url('module/update/'.$hashedID);?>" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                              <a href="#" class="dropdown-item delete-btn" data-module_id="<?php echo $singleModule['id']; ?>" id="confirm-color"><i class="ft-trash-2"></i> Delete</a>
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
    $('#modules_table').on('click',".dropdown-item.delete-btn",function(){
      var moduleID = $(this).data('module_id');
      var currentRow = $(this).parents('tr');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Module's data again...!",
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
                value: moduleID,
                name: "delete_module",
                visible: true,
                className: "",
                closeModal: false
            }
        }
      }).then(isConfirm => {
        if (isConfirm) {
          $.ajax({
            url: '<?php echo base_url(); ?>module/delete',
            data: { module_id:moduleID },
            type: 'POST',
            success: function(data){
              //alert(data);
              swal("Deleted!", "Module has been deleted successfully...!", "success");
              $('#modules_table').DataTable().row(currentRow).remove().draw();
            }
          });
        } else {
          swal("Cancelled", "Module's Data is still safe :)", "error");
        }
      });
    });
  });
</script>
</body>
</html>