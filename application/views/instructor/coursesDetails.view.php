<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
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
        <section class="row courselist">
          <div class="statics-title-row pull-up mt-1 ml-1">
            <h4 class="text-uppercase">Courses provided By Instructor</h4>
          </div>        
          <?php 
          if(!empty($CourseDetails))
          {
            foreach($CourseDetails as $singlecourse){ 
              $hashedID = encryptID($this->session->userdata('id'), $singlecourse['id']);
              ?>
              <div class="col-lg-4 col-md-4">
                <div class="card">
                  <a href="#"><img src="<?php echo $singlecourse['course_image']; ?>" alt="" class=" card-img-top img-fluid"></a>
                  <div class="news-feed-overlay">
                    <span class="badge badge-sm badge-primary float-left news-feed-badge news-feed-badge-trip position-absolute"><i class="la la-rupee"></i> <?php echo $singlecourse['fee']; ?></span>
                  </div>
                  <div class="card-body">
                    <a href="<?php echo site_url('instructor/course/details/'.$hashedID); ?>">
                      <h6 class="card-title font-medium-1 mb-0">
                        <?php echo $singlecourse['course_title']; ?>
                      </h6>
                    </a>
                    <p class="float-left font-small text-muted"><?php echo substr($singlecourse['brief_detail'],0 , 100)."....." ; ?></p>
                  </div>
                </div>
              </div>
            <?php } 
          }else{
            echo '<div class="col-12 card-header">
                  <p>You didn\'t have any assigned Courses Yet.</p>
                </div>';
          }?>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
</body>
</html>