<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/extensions/sweetalert.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/forms/validation/form-validation.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/charts/c3-chart.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel-body menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-hide-on-scroll navbar-border navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row" style="margin-top: -30px;">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="#">
              <img class="brand-logo" alt="modern admin logo" src="<?php echo base_url()?>/app-assets/images/IPBLogo.png">
              <h3 class="brand-text">IPB Student Panel</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="card test-ques">
        <div class="test_instruction">
          <div class="card-header">
            <h4 class="form-section"><b>Result</b></h4>
          </div>
          <hr>
          <section>
            <div class="row">
              <div class="col-7">
                <div class="card-content collapse show">
                  <div class="card-body">
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
                            <td><?php if (!empty($result_Detail)) { echo count($result_Detail); }else{echo 0;} ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Un-Attempted Question</th>
                            <td><?php   if (!empty($result_Detail)){if (!empty($exam_details)) {$difference = $exam_details['no_of_questions']-count($result_Detail); echo $difference; }} ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Total Correct Answer</th>
                            <td class="correct_ans"><?php if(!empty($result)) {echo $result['correct_ans'];} ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Total Wrong Answer</th>
                            <td class="wrong_ans"><?php if(!empty($result)) {echo $result['wrong_ans'];} ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Percentage</th>
                            <td><?php if(!empty($result)){ echo $result['percentage']; }?></td>
                          </tr>
                          <tr>
                            <th scope="row">Result</th>
                            <td><?php if(!empty($result)){ if($result['percentage'] >=75) {echo "Good";}elseif($result['percentage'] >=50){echo "Average";}else{echo "Poor";}} ?>
                              
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-5" style="text-align: center; margin-top: -52px;">
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div id="chart"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-left: 15px;">
              <div class="col-8">
                <?php $i=1; if (!empty($result_Detail)) { foreach ($result_Detail as $singleQuestion) { ?>
                <div class="card-content collapse show">
                  <div class="card-header" style="background-color: #f2efef">
                    <h5 class="form-section"><b>Ques <?php echo $i; ?>:</b> <?php echo $singleQuestion['question_title']; ?></h5>
                  </div>
                  <div class="card-body">
                    <div class="option">
                      <label>
                        a) <?php echo $singleQuestion['option1']; ?><?php if ($singleQuestion['selected_ans'] == 1) { if ($singleQuestion['selected_ans'] == $singleQuestion['correct_answer']) {?> <i class="icon-check" style="color: #00cc99;"></i> 
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
                <div class="col-md-offset-12">
                  <button type="button" class="btn btn-outline-primary round btn-min-width mr-1 mb-1 pull-right" id="" onclick="self.close()"><i class="ft-arrow-left"></i> Back to Course</button> 
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/chapter_test.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/charts/d3.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/charts/c3.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/charts/c3/bar-pie/pie.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/result_piechart.js" type="text/javascript"></script>
</body>
</html>