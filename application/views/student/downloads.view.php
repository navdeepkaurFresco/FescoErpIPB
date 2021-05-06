<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
      <div class="content-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Downloads</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <div class="table-responsive">
                    <?php if (empty($download_Data)){
                      echo '<div class="row">
                                <div class="col-12 mt-3 mb-1">
                                  <h4 class="text-uppercase">OOPS...!!</h4>
                                  <p>There is nothing for download.....!</p>
                                </div>
                              </div>';
                      }else
                        {?>  
                          <table class="table table-striped base-style file-export table-borderless mb-0">
                          <thead >
                            <tr>
                              <th>S.No.</th>
                              <th>Title</th>
                              <th>Download</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($download_Data as $row){?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><a class="btn  btn-outline-info block btn-sm round" href="<?php echo $row['file_url']; ?>" style='width: 70% !important;' download><i class="ft ft-download"></i>Download</a></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>
                        </table>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"
  type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
</body>
</html>