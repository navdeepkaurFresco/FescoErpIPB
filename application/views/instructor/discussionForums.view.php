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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Discussion forums</h4>
              </div>
              <div class="card-content">
                <div class="px-1">
                  <div class="card-bod" id="instructorDiscussion_forum">
                    <?php if(!empty($chapter_for_Discussion)){ foreach ($chapter_for_Discussion as $SingleCourse) { 
                      $singlechapterID = encryptID($this->session->userdata('id'),$SingleCourse['chapter_id']);?>     
                    <div class="row myform detail">                      
                      <div class="col-md-6"> 
                        <a href="<?php echo base_url('instructor/forum/details/'.$singlechapterID.'');?>"><span class="info-name"><?php echo $SingleCourse['chapter_title']; ?></span></a>
                      </div>
                    </div>
                    <?php  }} ?> 
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
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
</body>
</html>