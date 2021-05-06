<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/ui/prism.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns menu-expanded fixed-navbar student-panel" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
      <div class="content-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <div class="nav-vertical">
                    <ul class="nav nav-tabs nav-underline nav-justified">
                      
                       <li class="nav-item">
                        <a class="nav-link" id="StudentCoursesTabs-tab2" data-toggle="tab" aria-controls="StudentCoursesTab_2" href="#StudentCoursesTab_2" aria-expanded="false">Purchased Courses</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link active" id="StudentCoursesTabs-tab1" data-toggle="tab" aria-controls="StudentCoursesTab_1" href="#StudentCoursesTab_1" aria-expanded="true">All Courses</a>
                      </li>
                     
                    </ul>
                    <div class="tab-content px-1">
                      <div role="tabpanel" class="tab-pane active" id="StudentCoursesTab_1" aria-expanded="true" aria-labelledby="StudentCoursesTabs-tab1">
                        
                        <?php if(empty($AllModules)){
                            echo '<div class="row">
                                    <div class="col-12 mt-3 mb-1">
                                      <h4 class="text-uppercase">OOPS</h4>
                                      <p>There is no Module to Buy.</p>
                                    </div>
                                  </div>';
                          }else{
                          echo '<div class="row">
                                  <div class="col-12 mt-3 mb-1">
                                    <h4 class="text-uppercase">All Modules</h4>
                                  </div>
                                </div>
                                <div class="row">';
                            foreach ($AllModules as $singleModule)
                            {
                              $singleModuleID = encryptID($this->session->userdata('id'),$singleModule['id']);
                              $total_chapters = ($singleModule['total_chapters']=='1') ? $singleModule['total_chapters']." Chapter" : $singleModule['total_chapters']." Chapters" ;
                              $timeduration = ($singleModule['time_duration']=='1') ? $singleModule['time_duration'].' Month' : $singleModule['time_duration'].' Months' ;
                              $reviews = ($singleModule['total_reviews']=='1' || $singleModule['total_reviews'] =='0') ? $singleModule['total_reviews']." Review" : $singleModule['total_reviews']." Reviews" ;

                              $ratingstars = '';
                              for ($ii=0; $ii < 5; $ii++)
                              { 
                                if($ii<=$singleModule['rating']){
                                  $ratingstars .='<i class="la la-star"></i>';
                                }else
                                {
                                  $ratingstars .='<i class="la la-star-o"></i>';
                                }
                              }
                              if($singleModule['bought_complete_module']=='0'){
                                if($singleModule['is_bought']=='0'){
                                  $redirectURL = site_url('student/course/details/'.$singleModuleID);
                                }else{
                                  $redirectURL = site_url('student/read/more/'.$singleModuleID);
                                }
                              }else{
                                $redirectURL = site_url('student/read/more/'.$singleModuleID);
                              }
                              echo '<div class="col-md-4" style="margin-bottom: 30px;">
                                <div class="flat-course">
                                  <div class="featured-post">           
                                    <a href="'.$redirectURL.'">
                                      <img src="'.base_url('uploads/'.$singleModule['course_image']).'" alt="'.$singleModule['course_title'].'">
                                    </a>
                                  </div>
                                  <div class="course-content">
                                    <h4><a href="'.$redirectURL.'">'.$singleModule['course_title'].'</a> </h4>
                                    <div class="price">₹ '.$singleModule['fee'].'</div>
                                    <ul class="course-meta review">
                                      <li class="review-stars">'.$ratingstars.'</li>
                                      <li>'.$reviews.'</li>
                                    </ul>
                                    <ul class="course-meta desc">
                                      <li><h6>'.$total_chapters.'</h6></li>
                                      <li><h6><span class="course-time">'.$timeduration.'</span></h6></li>
                                    </ul>';
                                    if($singleModule['bought_complete_module']==1){
                                      echo '<a href="'.site_url('student/read/more/'.$singleModuleID).'" class="btn btn-sm round"> Read More <i class="ft-arrow-right"></i></a>';
                                    }else{
                                      if($singleModule['is_bought']=='0'){
                                        echo '<a href="'.$redirectURL.'" class="btn btn-sm round"> Buy Now <i class="ft-arrow-right"></i></a>';
                                      }else{
                                        echo '<a href="'.$redirectURL.'" class="btn btn-sm round"> Read More <i class="ft-arrow-right"></i></a>';
                                      }
                                    }
                                    echo '
                                  </div>
                                </div>
                              </div>';
                            }
                            echo '</div>';
                          }
                          ?>
                      </div>
                      <div class="tab-pane" id="StudentCoursesTab_2" aria-labelledby="StudentCoursesTabs-tab2">
                        <section id="header-footer">
                          <?php if(empty($BoughtModules)){
                            echo '<div class="row">
                                    <div class="col-12 mt-3 mb-1">
                                      <h4 class="text-uppercase">OOPS...!!</h4>
                                      <p>You didn\'t Buy any Module yet.</p>
                                    </div>
                                  </div>';
                          }else{
                            echo '<div class="row">
                                    <div class="col-12 mt-3 mb-1">
                                      <h4 class="text-uppercase">Purchased Modules</h4>
                                      <p>Here are your purchased Modules...</p>
                                    </div>
                                  </div>
                                  <div class="row match-height">';

                            foreach ($BoughtModules as $single_bought_module)
                            {
                              $hashedID = encryptID($this->session->userdata('id'),$single_bought_module['id']);
                              $time_duration = ($single_bought_module['time_duration']=='1') ? $single_bought_module['time_duration'].' month' : $single_bought_module['time_duration'].' months' ;
                              echo '<div class="col-xl-4 col-md-6">
                                      <div class="card border-info">
                                        <div class="card-content">
                                          <a href="'.base_url('student/read/more/'.$hashedID).'"><img class="img-fluid" src="'.base_url('uploads/'.$single_bought_module['course_image']).'" alt="Card image cap"></a>
                                          <div class="card-body">
                                            <a href="'.base_url('student/read/more/'.$hashedID).'"><h4 class="card-title">'.$single_bought_module['course_title'].'</h4></a>
                                            <p class="card-text">'.substr($single_bought_module['brief_detail'],0 , 100).".....".'</p>
                                          </div>
                                        </div>
                                        <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                          <span class="float-left">'.$time_duration.'</span>
                                          <span class="float-right">
                                            <a href="'.base_url('student/read/more/'.$hashedID).'" class="card-link">Read More <i class="la la-angle-right"></i></a>
                                          </span>
                                        </div>
                                      </div>
                                    </div>';
                            }
                            echo '</div>'; 
                          } ?>
                        </section>
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
  </div>
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url()?>/app-assets/vendors/js/ui/prism.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
</body>
</html>