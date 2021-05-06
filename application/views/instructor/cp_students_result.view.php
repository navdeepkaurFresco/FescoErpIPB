<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/ui/prism.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
</head>
<body class="vertical-layout student-panel-body vertical-content-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
<?php include(dirname(__FILE__)."/includes/instructor_header.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <?php include(dirname(__FILE__)."/includes/instructor_sidebar.php"); ?>
    <div class="content-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-content">
              <div class="card-header">
                <h4>Students Details who Completed All Modules</h4>
              </div>
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
                <table id="instructor_table" class="table table-striped table-bordered base-style file-export table-responsive">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Order ID</th>
                      <th>Payment ID</th>
                      <th>Payment Method</th>
                      <!-- <th>User Details</th> -->
                      <th>Module Details</th>
                      <th>Amount</th>
                      <th>Order Description</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; if(!empty($allTransactions)){
                      foreach($allTransactions as $SingleTransactionDetails){ 
                      $PaymentID = encryptID($this->session->userdata('id'),$SingleTransactionDetails['id']);
                      ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $SingleTransactionDetails['order_id']; ?>
                      <td><a href="<?php echo base_url('student/invoice/'.$PaymentID); ?>"><?php echo $SingleTransactionDetails['payment_id']; ?></a></td>
                      <td><?php echo $SingleTransactionDetails['payment_method']; ?>
                      </td>
                      <!-- <td><ul>
                        <li><?php echo $SingleTransactionDetails['fullname']; ?></li>
                        <li><a href="mailto:<?php echo $SingleTransactionDetails['user_email']; ?>"><?php echo $SingleTransactionDetails['user_email']; ?></a></li>
                        <li><?php echo $SingleTransactionDetails['user_contact']; ?></li>
                      </ul></td> -->
                      <td><?php echo ($SingleTransactionDetails['complete_package'] !=1 ) ? $SingleTransactionDetails['course_title'] : "Complete Package"; ?></td>
                      <td><?php echo $SingleTransactionDetails['currency']." ".$SingleTransactionDetails['order_total']; ?></td>
                      <td><?php echo $SingleTransactionDetails['order_description']; ?></td>
                      <td><?php echo date('jS F, Y', strtotime($SingleTransactionDetails['created_at'])) ; ?></td>
                    </tr>
                    <?php  $i++; } }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
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