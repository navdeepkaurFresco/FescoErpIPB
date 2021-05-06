<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/extensions/raty/jquery.raty.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/fonts/meteocons/style.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel-body menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
      <div class="content-body">
        <section class="singlecourse">
          <div class="row match-height">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4><?php echo $singleCourseDetails['course_title']; ?></h4>
                  <input type="hidden" name="m_id" id="m_id" value="<?php echo $singleCourseDetails['id']; ?>">
                  <div class="heading-elements mt-2">
                    <button onclick="goBack()" class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">
                    <i class="ft-arrow-left"></i> Go Back
                    </button>
                  </div>
                </div>
                <div class="card-header instructor-course-details-page">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="<?php echo base_url("uploads/".$singleCourseDetails['course_image']); ?>" alt="<?php echo $singleCourseDetails['course_title']; ?>">
                    </div>
                    <div class="col-md-4">
                      <ul class="chapters-detail-tags">
                        <h4 class="course-title">Course Features</h4>
                        <li><i class="la la-rupee"></i> <?php echo $singleCourseDetails['fee']; ?></li>
                        <li><i class="la la-tag"></i> PPTs</li>
                        <li><i class="la la-hourglass"></i> <?php echo $singleCourseDetails['time_duration']." months";
                          ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body row">
                    <div class="col-md-8 chapter_details">
                      <?php echo $singleCourseDetails['brief_detail']; 
                        $moduleID = encryptID($this->session->userdata('id'),$singleCourseDetails['id']);
                        ?>
                      <?php if(!empty($singleCourseDetails['chapter_details'])) { ?>
                      <div class="row mt-1 ml-1">
                        <h4 class="card-title">Chapters:-</h4>
                      </div>
                      <ul class="list-group list-group-flush">
                        <?php $x = '1'; 
                          foreach ($singleCourseDetails['chapter_details'] as $CDkey => $singleChapterDetails) {
                            $singleChapterID = encryptID($this->session->userdata('id'),$singleChapterDetails['id']);
                            if($x=='1'){
                              $chapterURL = 'href="'.base_url('student/chapter/details/'.$singleChapterID).'"';
                            }else{
                              if(!empty($singleCourseDetails['chapter_details'][$CDkey-1]['StudentTest_attempt'])){
                                $chapterURL = 'href="'.base_url('student/chapter/details/'.$singleChapterID).'"';
                              }else{
                                $chapterURL = '';
                              }
                            } ?>
                          <li class="list-group-item">
                            <a <?php echo $chapterURL; ?> class="chapter_title"><?php echo ucwords($singleChapterDetails["chapter_title"]); ?></a>
                            <?php if ($singleChapterDetails["StudentTest_attempt"]["total_attempt"] >= 1) {echo "<div class='message' style='float: right;'><i class='ft-check-circle'></i></div>";}?> 
                          </li>
                        <?php $x++; }}?>
                        <li class="list-group-item">
                          <a <?php if(empty($exam_completed)){ if(!empty($complete_chapters)){if($complete_chapters === $total_chapter) {echo "href='#'" ;?> onclick="window.open('<?php echo base_url('student/CourseExam/'.$moduleID) ?>',width=600,height=300);" <?php }}}?> class="chapter_title" >Take Final Exam</a>
                          <?php if(!empty($exam_completed)){?>
                          <div class='message' style='float: right;'><i class='ft-check-circle'></i></div>
                          <?php }?>
                        </li>
                        <li class="list-group-item">
                          <a <?php if(empty($appointmentStatus) && !empty($exam_completed) && !empty($complete_chapters) && ($complete_chapters === $total_chapter)){ echo 'href="'.base_url('student/skypeInterview').'"';}?> class="chapter_title">Schedule Skype Interview</a>
                          <?php if(!empty($appointmentStatus)){?>
                          <div class='message' style='float: right;'><i class='ft-check-circle'></i></div>
                          <?php }?>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <ul class="review-module">
                        <h4>Review Module</h4>
                        <li>
                          <div id="default-star-rating"></div>

                        </li>
                        <span class="text-success mt-1" id="district"></div>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/extensions/jquery.raty.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $(".message i").css({"color": "#28D094", "font-size": "17px"});
    /*ajax for check if chapter is completed*/
    /*var chapterID = $('#c_ID').val();
    var moduleID = $('#m_id').val();
    $.ajax(
    {
    url: '<?php echo base_url(); ?>check/chapterStatus',
    data: { chapterID:chapterID, moduleID:moduleID },
    type: 'POST',
    success: function(response)
    {
    console.log(response);
    if($.trim(response))
    {
    $(".show-message").append('<i class="ft-check-circle"></i>');
    $(".show-message i").css({"color": "#28D094", "font-size": "17px"});
    $(".show-message").css({"float": "right"});
    }
    },
    error: function(err)
    {
    console.log(err);
    }
    });*/
    /*end*/
    
    $.fn.raty.defaults.path = '<?php echo base_url(); ?>/app-assets/images/raty/';
    // Default
    $('#default-star-rating').raty();
    $('input[name="score"]').val('<?php echo $courseReviews["reviews"]; ?>');
    
    $('#default-star-rating').on('click', function(){
      var rating = $('input[name="score"]').val();
      var module_id = <?php echo $singleCourseDetails['id']; ?>;
      
      $.ajax({
        type: "post",
        url: "<?php echo base_url('student/review_module'); ?>",
        data: {rating: rating, module_id: module_id},
        success: function(data)
        {
          console.log(data);
          $("#district").html("Thanks for your review.!");
        }
      });
    });     
  });
  </script>
</body>
</html>
