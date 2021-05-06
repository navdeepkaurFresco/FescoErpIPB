<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns menu-expanded fixed-navbar student-panel-body" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
      <div class="content-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-content">
                <div class="card-header">
                  <h4>Exam's History</h4>
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
                        <th>Chapter Name</th>
                        <th>Percentage</th>
                        <th>Result</th>
                        <th>Performance</th>
                        <th>View Test Sheet</th>
                        <th>Reg. Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $a=1; 
                      if(!empty($TestHistoryDetails)){
                        foreach($TestHistoryDetails as $singleTestDetails){ 
                        
                        $percentage = round($singleTestDetails['correct_ans']/$singleTestDetails['no_of_questions']*100);
                        ?>
                        <tr>
                          <td><?php echo $a; ?></td>
                          <td><?php echo $singleTestDetails['chapter_title']; ?>
                          <td><?php echo $percentage ; ?>%</td>
                          <td><?php if($percentage >= 50) {echo "Pass";}else{echo "Fail";} ?></td>
                          <td><?php if($percentage >=80) {echo "Good";}elseif($percentage >=50){echo "Average";}else{echo "Poor";} ?></td>
                          <td><?php $result = $singleTestDetails['result'];
                          $resultDetail = $singleTestDetails['resultDetail'];?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $singleTestDetails['id']; ?>">View Test Sheet</button>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="<?php echo $singleTestDetails['id']; ?>">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">
                                    <ul class="nav nav-tabs">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="base-tab1_<?php echo $singleTestDetails['id']; ?>" data-toggle="tab" aria-controls="tab1_<?php echo $singleTestDetails['id']; ?>" href="#tab1_<?php echo $singleTestDetails['id']; ?>" aria-expanded="true">Test Report</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="base-tab2_<?php echo $singleTestDetails['id']; ?>" data-toggle="tab" aria-controls="tab2_<?php echo $singleTestDetails['id']; ?>" href="#tab2_<?php echo $singleTestDetails['id']; ?>" aria-expanded="false">Attempted Questions</a>
                                      </li>
                                    </ul></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="tab-content px-1 pt-1">
                                      <div role="tabpanel" class="tab-pane active" id="tab1_<?php echo $singleTestDetails['id']; ?>" aria-expanded="true" aria-labelledby="base-tab1_<?php echo $singleTestDetails['id']; ?>">
                                        <div class="table-responsive">
                                          <table class="table table-borderless">
                                            <thead>
                                              <tr>
                                                <th>Description</th>
                                                <th>Status</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <th scope="row">Attempted Question</th>
                                                <td><?php if (!empty($resultDetail)) { echo count($resultDetail); }else{echo 0;} ?></td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Un-Attempted Question</th>
                                                <td><?php if (!empty($resultDetail)) { $difference = 25-count($resultDetail); echo 0;}else{echo 0;} ?></td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Total Correct Answer</th>
                                                <td class="correct_ans"><?php if(!empty($result)) echo $result['correct_ans']; ?></td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Total Wrong Answer</th>
                                                <td class="wrong_ans"><?php if(!empty($result)) echo $result['wrong_ans']; ?></td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Result</th>
                                                <td><?php if(!empty($result)){ if($result['correct_ans'] >=15) {echo "Pass";}else{echo "Fail";}} ?></td>
                                              </tr>
                                              <tr>
                                                <th scope="row">Performance</th>
                                                <td><?php if(!empty($result)){ if($result['correct_ans'] >=22) {echo "Good";}elseif($result['correct_ans'] >=15){echo "Average";}else{echo "Poor";}} ?></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                      <div class="tab-pane" id="tab2_<?php echo $singleTestDetails['id']; ?>" aria-labelledby="base-tab2_<?php echo $singleTestDetails['id']; ?>">
                                        <div class="row" style="margin-left: 15px;">
                                          <div class="col-8">
                                            <?php $i=1; if (!empty($resultDetail)) { foreach ($resultDetail as $singleQuestion) { ?>
                                            <div class="card-content collapse show">
                                              <div class="card-header" style="background-color: #f2efef">
                                                <h5 class="form-section"><b>Ques <?php echo $i; ?>:</b> <?php echo $singleQuestion['question_title']; ?></h5>
                                              </div>
                                              <div class="card-body">
                                                <div class="option">
                                                  <label>
                                                    a) <?php echo $singleQuestion['option1']; ?><?php if ($singleQuestion['selected_ans'] == 1) { if ($singleQuestion['selected_ans'] == $singleQuestion['correct_answer']) { ?> <i class="icon-check" style="color: #00cc99;"></i> 
                                                      <?php }else{?> <i class="icon-close" style="color: red;"></i><?php }} ?>
                                                  </label>
                                                </div>
                                                <div class="option">
                                                  <label>
                                                    b) <?php echo $singleQuestion['option2']; ?><?php if ($singleQuestion['selected_ans'] == 2) { if ($singleQuestion['selected_ans'] == $singleQuestion['correct_answer']) {?> <i class="icon-check" style="color: #00cc99;"></i> 
                                                      <?php }else{?> <i class="icon-close" style="color: red;"></i><?php }} ?>
                                                  </label>
                                                </div>
                                                <div class="option">
                                                  <label>
                                                    c) <?php echo $singleQuestion['option3']; ?><?php if ($singleQuestion['selected_ans'] == 3) { if ($singleQuestion['selected_ans'] == $singleQuestion['correct_answer']) {?> <i class="icon-check" style="color: #00cc99;"></i> 
                                                      <?php }else{?> <i class="icon-close" style="color: red;"></i><?php }} ?>
                                                  </label>
                                                </div>
                                                <div class="option">
                                                  <label>
                                                    d) <?php echo $singleQuestion['option4']; ?><?php if ($singleQuestion['selected_ans'] == 4) { if ($singleQuestion['selected_ans'] == $singleQuestion['correct_answer']) {?> <i class="icon-check" style="color: #00cc99;"></i> 
                                                      <?php }else{?> <i class="icon-close" style="color: red;"></i><?php }} ?>
                                                  </label>
                                                </div>

                                              </div>
                                            </div>
                                            <?php $i++;}}?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td><?php echo date('jS F, Y h:i:s A', strtotime($singleTestDetails['created_at'])) ; ?></td>
                        </tr>
                        <?php $a++; } 
                      }?>
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
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
<script src="<?php echo base_url(); ?>/app-assets/js/scripts/navs/navs.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
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