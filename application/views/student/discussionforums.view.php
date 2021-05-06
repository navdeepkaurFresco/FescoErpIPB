<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/ui/prism.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
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
              <div class="card-content">
                <div class="card-body">
                  <div class="nav-vertical">
                    <ul class="nav nav-tabs nav-underline nav-justified">
                      <li class="nav-item">
                        <a class="nav-link active" id="StudentTabs-tab1" data-toggle="tab" aria-controls="StudentTab_1" href="#StudentTab_1" aria-expanded="true">
                          My Forums
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="StudentTabs-tab2" data-toggle="tab" aria-controls="StudentTab_2" href="#StudentTab_2" aria-expanded="false">All Forums</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1">
                      <div role="tabpanel" class="tab-pane active" id="StudentTab_1" aria-expanded="true" aria-labelledby="StudentTabs-tab1">
                        <div class="card-body admin-account-details" id="discussionForum">
                          <?php if(!empty($own_discussions)){ foreach ($own_discussions as $singleTitle) {
                            $singletitleID = encryptID($this->session->userdata('id'),$singleTitle['id']);?> 
                          <div class="row myform detail"> 
                            <div class="col-md-2 studentImage">
                              <img src="<?php echo base_url("uploads/".$singleTitle['profile_image']); ?>">
                            </div>                      
                            <div class="col-md-6"> 
                              <a href="<?php echo base_url('chapter/title/discussion/'.$singletitleID);?>"><span class="info-name"><?php echo $singleTitle['discussion_title']; ?></span></a>  <br/>
                              <span class="info-desc"><?php echo substr($singleTitle['description'], 0, 70); ?>....</span><br/>
                            </div> 
                            <div class="col-md-4">                            
                              <span class="info-time"><?php echo date("jS F, Y", strtotime($singleTitle['created_at'])) ; ?></span>
                            </div> 
                          </div>   
                         <?php }} ?>
                        </div>
                      </div>
                      <div class="tab-pane" id="StudentTab_2" aria-labelledby="StudentTabs-tab2">
                        <div class="card-body" id="discussionForum">
                          <?php if(!empty($commented_Discussions)){ foreach ($commented_Discussions as $singleTitle) {
                            $singletitleID = encryptID($this->session->userdata('id'),$singleTitle['id']);?> 
                          <div class="row myform detail"> 
                            <div class="col-md-2 studentImage">
                              <img src="<?php echo $singleTitle['profile_image']; ?>">
                            </div>                      
                            <div class="col-md-6"> 
                              <a href="<?php echo base_url('chapter/title/discussion/'.$singletitleID);?>"><span class="info-name"><?php echo $singleTitle['discussion_title']; ?></span></a>  <br/>
                              <span class="info-desc"><?php echo substr($singleTitle['description'], 0, 70); ?>....</span><br/>
                            </div> 
                            <div class="col-md-4">                            
                              <span class="info-time"><?php echo date("jS F, Y", strtotime($singleTitle['created_at'])) ; ?></span>
                            </div> 
                          </div>   
                         <?php }} ?>
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
  </div>
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url()?>/app-assets/vendors/js/ui/prism.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
</body>
</html>