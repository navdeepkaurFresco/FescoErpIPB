<?php
 include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
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
                  <h4><?php echo ucwords($chapterDetails['chapter_title']); ?></h4>
                  <div class="heading-elements mt-2">
                    <button onclick="goBack()" class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">
                      <i class="ft-arrow-left"></i> Go Back
                    </button>
                  </div>
                </div>
                <!-- <div class="card-header instructor-course-details-page">
                  <img src="<?php echo $singleCourseDetails['course_image']; ?>" alt="<?php echo $singleCourseDetails['course_title']; ?>">
                </div> -->
                <div class="card-content">
                <?php if($this->session->flashdata('item')) {
                  $message = $this->session->flashdata('item'); ?>
                  <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    <?php echo $message['message']; ?>
                  </div>
                <?php } ?>
                <div class="card-header instructor-course-details-page">
                  <iframe src="<?php echo $chapterDetails['video_url']; ?>" width="100%" height="450" frameborder="0"></iframe>
                </div>
                <div class="card-body">
                  <div class="row">
                    <ul class="chapters-detail-tags mb-0">
                      <li><i class="la la-tag"></i> PPTs</li>
                      <li><i class="la la-hourglass"></i> <?php echo $chapterDetails['time_duration']." Minutes";
                        ?></li>
                    </ul>
                  </div>
                  <div class="row m-1">
                    <p><?php echo $chapterDetails['chapter_description']; ?></p>
                  </div>
                  <ul class="nav nav-tabs nav-underline">
                    <li class="nav-item">
                      <a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1"
                        href="#tabIcon1" aria-expanded="true"><i class="la la-list"></i> Chapter Content</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2"
                        href="#tabIcon2" aria-expanded="false"><i class="la la-flag"></i> Discussion Forums</a>
                    </li>
                  </ul>
                  <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
                      <div class="row">
                        <?php echo $chapterDetails['content']; ?>
                      </div>
                    </div>
                    <div class="tab-pane" id="tabIcon2" aria-labelledby="baseIcon-tab2">
                      <div class="card-bod chapterDiscussion">
                        <?php if(!empty($chapterDiscussionForum)){ 
                          foreach ($chapterDiscussionForum as $singleTitle_detail) {
                            $singletitleID = encryptID($this->session->userdata('id'),$singleTitle_detail['id']); ?>
                                <div class="row myform detail"> 
                                  <div class="col-md-2 studentImage">
                                    <img src="<?php echo base_url("uploads/".$singleTitle_detail['profile_image']); ?>">
                                  </div>
                                  <div class="col-md-6"> 
                                    <a href="<?php echo base_url('instructor/discussions/comment/'.$singletitleID);?>"><span class="info-name"><?php echo $singleTitle_detail['discussion_title']; ?></span></a>  <br/>
                                    <span class="info-desc"><?php echo substr($singleTitle_detail['description'], 0, 70); ?>....</span><br/>
                                  </div> 
                                  <div class="col-md-4">                            
                                    <span class="info-time"><?php echo date("jS F, Y", strtotime($singleTitle_detail['created_at'])) ; ?></span>
                                  </div> 
                                </div>
                        <?php } }?>
                      </div>
                    </div>
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
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
</body>
</html>