<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/instructor_header.php"); ?>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/instructor_sidebar.php"); ?>
      <div class="content-body">
        <section class="singlecourse">
          <div class="row match-height">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header instructor-course-details-page">
                  <h4><?php echo $singleCourseDetails['course_title']; ?></h4>
                  <div class="heading-elements mt-2">
                    <button onclick="goBack()" class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">
                      <i class="ft-arrow-left"></i> Go Back
                    </button>
                  </div>
                </div>
                <div class="card-header instructor-course-details-page">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="<?php echo base_url ("uploads/".$singleCourseDetails['course_image']); ?>" alt="<?php echo $singleCourseDetails['course_title']; ?>">
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
                    <div class="col-md-12">
                      <ul class="nav nav-tabs nav-underline">
                        <li class="nav-item">
                          <a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1"
                          href="#tabIcon1" aria-expanded="true"><i class="la la-play"></i> Description</a>
                        </li>
                      </ul>
                      <div class="tab-content px-1 pt-1">
                        <div role="tabpanel" class="tab-pane active" id="tabIcon1" aria-expanded="true"
                        aria-labelledby="baseIcon-tab1">
                          <div class="row">
                            <?php echo $singleCourseDetails['brief_detail']; ?>
                          </div>
                          <?php if(!empty($singleCourseDetails['chapter_details']))
                          {
                            echo '<div class="row mt-1 ml-1"><h4 class="card-title">Chapters:-</h4></div>
                                  <ul class="list-group list-group-flush">';
                            $x = '1';
                            foreach ($singleCourseDetails['chapter_details'] as $singleChapterDetails) {

                              $singleChapterID = encryptID($this->session->userdata('id'),$singleChapterDetails['id']);

                              /*if($x=='1'){
                                $chapterURL = base_url('student/chapter/details/'.$singleChapterID);
                              }else{
                                if(!empty($singleChapterDetails['StudentTest_attempt'])){
                                  $chapterURL = base_url('student/chapter/details/'.$singleChapterID);
                                }else{
                                  $chapterURL = '#';
                                }
                              }*/
                              
                              echo '<li class="list-group-item">
                                      <a href="'.base_url('instructor/chapter/details/'.$singleChapterID).'">'.ucwords($singleChapterDetails['chapter_title']).'</a>
                                    </li>';
                              
                            }
                            echo '</ul>';
                          } ?>
                        </div>
                      </div>
                    </div>
                    
                    <!-- <div class="row course-main-details">
                      <div class="col-xl-6 col-md-8 col-12" style="padding-left: 0">
                      <h4><?php echo $singleCourseDetails['course_title']; ?></h4>
                      </div>
                      <div class="col-xl-6 col-md-8 col-12">  
                      <h6>
                        <i class="la la-rupee"></i> <?php echo $singleCourseDetails['fee']; ?>
                      </h6>
                      </div>
                    </div> -->
                    <!-- <div class="row course-main-details">
                      <div class="col-xl-12 col-md-8 col-12">
                        <p><?php echo $singleCourseDetails['time_duration']." months"; ?></p>
                      </div>
                    </div> -->

                    <!-- <ul class="nav nav-tabs nav-underline">
                      <li class="nav-item">
                        <a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1"
                        href="#tabIcon1" aria-expanded="true"><i class="la la-play"></i> Description</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2"
                        href="#tabIcon2" aria-expanded="false"><i class="la la-flag"></i> Students</a>
                      </li>
                    </ul> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
</body>
</html>