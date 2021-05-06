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
        <?php if (!empty($allHeadlines)){ ?>
        <div class="row dashboard-headlines">
          <marquee direction="left" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3">
            <ul class="headlines">
              <?php foreach ($allHeadlines as $headline) {
                  echo "<li>".$headline['text']."</li>";
                }
              ?>   
            </ul>
          </marquee>
        </div>
      <?php } ?>
        <div class="row">
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="<?php echo base_url('instructor/courses'); ?>"><div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="info"><?php if (!empty($total_modules)){ echo $total_modules;}else{echo 0;} ?></h3>
                      <h6>Total Assigned Courses</h6>
                    </div>
                    <div>
                      <i class="icon-login info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div></a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="<?php echo base_url('instructor/discussionforums'); ?>"><div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="warning"><?php if (!empty($total_discussion_forum)){ echo $total_discussion_forum;}else{echo 0;} ?></h3>
                      <h6>Total Discussion Forums</h6>
                    </div>
                    <div>
                      <i class="icon-logout warning font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div></a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="<?php echo base_url('instructor/appointments'); ?>"><div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="success"><?php if (!empty($total_schedules_interview)){ echo $total_schedules_interview;}else{echo 0;} ?></h3>
                      <h6>Total Scheduled Skype Interviews</h6>
                    </div>
                    <div>
                      <i class="icon-call-in success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div></a>
          </div>
          <div class="col-xl-3 col-lg-6 col-12">
            <a href="<?php echo base_url('instructor/appointments'); ?>"><div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="danger"><?php if (!empty($total_completed_interview)){ echo $total_completed_interview;}else{echo 0;} ?></h3>
                      <h6>Total Completed Skype Interviews</h6>
                    </div>
                    <div>
                      <i class="icon-call-out danger font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div></a>
          </div>
        </div>
        <div class="row">
          <?php if (!empty($allBanners)){ ?>
          <div class="col-xl-6 col-md-12 col-sm-12">
            <div class="card">
              <div class="card-content">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <?php $i=1; foreach ($allBanners as $key=>$banner) {  ?>
                      <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo ($key == 0) ? "active" : ""; ?>"></li>
                      <?php $i++;
                      }
                    ?>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                    <?php foreach ($allBanners as $key=>$banner) { ?>
                      <div class="carousel-item <?php echo ($key == 0) ? "active" : ""; ?>">
                        <img src="<?php echo $banner['banner_image']; ?>" class="d-block w-100" alt="First slide">
                      </div>
                    <?php } ?>
                  </div>
                  <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="la la-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php } 
          if (!empty($allNews)){ ?>
          <div class="col-xl-6 col-md-12 col-sm-12">
            <div class="card">
              <div class="card-content">
                <marquee direction="up" scrollamount="4" onmouseover="this.stop()" onmouseout="this.start()">
                  <ul class="right-side news">
                    <?php foreach ($allNews as $news) 
                    {
                      echo "<li><i class='ft-chevrons-right'></i>".$news['text']."</li>";
                    }
                    ?>
                  </ul>
                </marquee>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Instructor Activity forum</h4>
              </div>
              <div class="card-content">
                <div class="table-responsive activity">
                  <table id="recent-orders" class="table table-hover table-xl mb-0">
                    <tbody>
                      <?php if (!empty($activities)) { foreach ($activities as $single_activity) { ?>
                        <tr>
                        <td class="text-truncate" colspan="6">
                          <a href="#">
                            <!-- <span class="avatar avatar-xs">
                              <img class="box-shadow-2" src="http://ipb.thefresconews.com/app-assets/images/fav.png" alt="avatar">
                            </span> -->
                            <span><?php echo $single_activity['title'] ?></span>
                          </a>
                        </td>
                        <td>
                          <small>
                          <?php 
                              echo $single_activity['time'];
                          ?> ago</small>
                        </td>
                      </tr>   
                      <?php } }else{ ?>
                        <tr>
                        <td class="text-truncate" colspan="6">
                          <a href="#">
                            <span class="avatar avatar-xs">
                              <img class="box-shadow-2" src="http://ipb.thefresconews.com/app-assets/images/fav.png" alt="avatar">
                            </span>
                            <span>No acitivity for today....!</span>
                          </a>
                        </td>
                        <td>
                          <small></small>
                        </td>
                      </tr>
                    <?php } ?>
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
 <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
</body>
</html>