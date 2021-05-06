<?php include(dirname(__FILE__)."/includes/student_head.php");

$no_of_questions = (!empty($test_details)) ? $test_details['no_of_questions'] : $defaultChapterSettings['no_of_questions'];
$test_time = (!empty($test_details)) ? $test_details['test_time'] : $defaultChapterSettings['test_time'];
$per_question_marks = (!empty($test_details)) ? $test_details['per_question_marks'] : $defaultChapterSettings['per_question_marks'];
$test_attempts = (!empty($test_details)) ? $test_details['test_attempts'] : $defaultChapterSettings['test_attempts'];

?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/extensions/sweetalert.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/forms/validation/form-validation.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/loaders/loaders.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
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
            <h4 class="form-section"><b>Instructions</b> :</h4>
          </div>
          <hr>
          <div class="card-body" style="margin-top: -20px;">
            <div class="row">
              <div class="table-responsive col-sm-6">
                <table class="table table-column">
                  <tbody>
                    <tr>
                      <td>Total number of questions</td>
                      <td class="totalQues"><?php echo $no_of_questions ; ?></td>
                    </tr>
                    <tr>
                      <td>Time alloted</td>
                      <td class="testTime"><?php echo $test_time ; ?> Minutes</td>
                    </tr>
                    <tr>
                      <td>Mark per Question</td>
                      <td><?php echo $per_question_marks ; ?></td>
                    </tr>
                    <tr>
                      <td>Maximum Attempts</td>
                      <td><?php echo $test_attempts ; ?></td>
                    </tr>
                    <tr>
                      <td>Attempt</td>
                      <td><?php if (!empty($attempts)) {echo ++$attempts['total_attempt'];}else{echo 1;} ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="controls">
                   <input type="checkbox" name="conditions">  I Have Read and Understood the Instructions. All Computer Hardwares Alloted To Me Are in Proper Working Conditiond. I Agreee That in Case of not Adhering to the Instructions, I Will Be Disqualified from Giving Exam.
                </div>
              </div>
            </div>
            <div class="col-md-offset-12" style="text-align: center;">
              <button type="submit" name="instruction_btn" id="instruction_btn" value="submit" class="btn btn-primary">
                Start Test <i class="ft-arrow-right"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="test_questions">
          <div class="card-header test-info" style="display: none;">
              <div class="row">
            <div class="col-sm-4">
              <div class="ques-no">
            <h5 class="ques-count">Ques 1 of <?php echo $no_of_questions ; ?></h5>
          </div>
          </div>
          <div class="col-sm-4">
            <div class="heading chapter-name" style="text-align: center; display: none;">
              <h4><strong><?php if(!empty($chapter_questions)) { echo $chapter_questions['chapter_title'];} ?></strong></h4>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="heading-elements">
              <h5>Time Remaining: <span id="countdown_timer"></span> </h5>
            </div>
          </div>
        </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-3 test-status" style="display: none">
                <div class="card" id="attempt-details">
                  <div class="card-heading row myform detail">
                      <div class="col-md-2"><i class="ft-bar-chart"></i> </div>
                      <div class="col-md-8"><h5>Test Status</h5></div>
                  </div>
                  <div class="card-body" id="attempt">    
                      <div class="card-group">
                          <div class="card card-default">
                              <div class="card-heading online-test-status" role="tab" id="atmt-header"><h4 id="attempt_ques"></h4></div>
                              <div class="card-collapse">
                                  <div class="card-body">
                                      <!-- <ul id="atmpt"><li><a style="text-decoration: none !important;" href="#ques0">Ques 1</a></li>
                                      </ul> -->
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="tab-content px-1 pt-1 col-md-9">
                <div class="w3-padding w3-light-grey" id="question_one" style="margin-left: 40px; display: none;">
                  <?php if(!empty($chapter_questions)) { ?>
                    <?php echo form_open('student/examQuestions');?>
                    <div class="questions_row">
                    <p class="w3-large" style="margin-bottom:25px;"><h4 style="margin-bottom:2.0rem;"><b id="ques_no">Ques 1</b>: <?php  echo $chapter_questions['question_title']; ?></h4></p>
                    <!-- <input type="hidden" name="chapterID" id="chapterID" value="<?php  echo $chapter_questions['chapter_id']; ?>"> -->
                    <input type="hidden" name="questionID" id="questionID" value="<?php  echo $chapter_questions['id']; ?>">
                    <div class="radio">
                      <label>
                        <input type="radio" name="answer" id="first_ans" value="1"> <?php  echo $chapter_questions['option1']; ?>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="answer" id="second_ans" value="2"> <?php  echo $chapter_questions['option2']; ?>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="answer" id="third_ans" value="3"> <?php  echo $chapter_questions['option3']; ?>
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="answer" id="fourth_ans" value="4"> <?php  echo $chapter_questions['option4']; ?>
                      </label>
                    </div>
                  </div>
                  <br>
                  <div class="col-md-offset-12">
                    <button type="button" class="btn btn-outline-primary round btn-min-width mr-1 mb-1 pull-right" id="ques_btn">Next <i class="ft-arrow-right"></i></button> 
                    <button type="button" class="btn btn-outline-primary round btn-min-width mr-1 mb-1 pull-right" id="submit_ques_btn" style="display: none;">Submit Test </button>
                    <button type="button" class="btn btn-outline-primary round btn-min-width mr-1 mb-1 pull-right" id="pre_ques_btn" style="display: none;"><i class="ft-arrow-left"></i> Previous </button>
                  </div>
                  <?php echo form_close(); } ?>
                </div>
                <div class="loader-wrapper">
                  <div class="loader-container">
                    <div class="fading-circle loader-blue-grey">
                      <div class="circle1 circle"></div>
                      <div class="circle2 circle"></div>
                      <div class="circle3 circle"></div>
                      <div class="circle4 circle"></div>
                      <div class="circle5 circle"></div>
                      <div class="circle6 circle"></div>
                      <div class="circle7 circle"></div>
                      <div class="circle8 circle"></div>
                      <div class="circle9 circle"></div>
                      <div class="circle10 circle"></div>
                      <div class="circle11 circle"></div>
                      <div class="circle12 circle"></div>
                    </div>
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
  <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"type="text/javascript"></script>
  <script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/chapter_test.js" type="text/javascript"></script>
</body>
</html>