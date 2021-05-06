<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel-body menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
<?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
    <div class="content-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Result</h4>
            </div>
            <div class="card-content">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="instructor_table" class="table table-striped table-bordered base-style file-export table-responsive">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Test Name</th>
                        <th>Attempted Questions</th>
                        <th>Correct Answers</th>
                        <th>Wrong Answers</th>
                        <th>Percentage</th>
                        <th>Result</th>
                        <th>Performance</th>
                        <th>Attempt</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if (!empty($student_result)) { foreach ($student_result as $result) { 
                        $attempt_data = array(1 => 'First', 2 => 'Second', 3 => 'Third', 4 => 'Fourth', 5 => 'Fifth');
                        $percentage = $result['correct_ans']/$result['no_of_questions']*100; ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['chapter_title']; ?></td>
                        <td><?php echo $result['count(chapter_test.test_id)']; ?></td>
                        <td><?php echo $result['correct_ans']; ?></td>
                        <td><?php echo $result['wrong_ans']; ?></td>
                        <td><?php echo $percentage ; ?>%</td>
                        <td><?php if($percentage >= 50) {echo "Pass";}else{echo "Fail";} ?></td>
                        <td><?php if($percentage >=80) {echo "Good";}elseif($percentage >=50){echo "Average";}else{echo "Poor";} ?></td>
                        <td><?php echo $attempt_data[$result['attempt']]; ?></td>
                        <td><?php echo date("jS F, Y h:i:s A", strtotime($result['created_at'])) ?></td>
                        <td><i class="la la-print"></i><i class="la la-file-text"></i></td>
                      </tr>
                      <?php $i++; }}?>
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
</div>
<?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"
  type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
</body>
</html>