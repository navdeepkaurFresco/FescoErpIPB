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
                <div class="heading-elements" style="margin-top: 10px;">
                  <button onclick="goBack()" class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">
                    <i class="ft-arrow-left"></i> Go Back
                  </button>
                </div>
              </div>
              <div class="card-content">
                  <div class="px-1">
                    <div class="card-bod" id="instructorDiscussion_forum"> 
                      <?php if(!empty($discussion_titles)){ foreach ($discussion_titles as $singleTitle_detail) {
                        $singletitleID = encryptID($this->session->userdata('id'),$singleTitle_detail['id']);?>                 
                      <div class="row myform detail"> 
                        <div class="col-md-2 studentImage">
                          <img src="<?php echo base_url ("uploads/". $singleTitle_detail['profile_image']); ?>">
                        </div>                      
                        <div class="col-md-6"> 
                          <a href="<?php echo base_url('instructor/discussions/comment/'.$singletitleID.'');?>"><span class="info-name"><?php echo $singleTitle_detail['discussion_title']; ?></span></a>  <br/>
                          <span class="info-desc"><?php echo substr($singleTitle_detail['description'],0, 70); ?>.....</span><br/>
                        </div> 
                        <div class="col-md-4">                            
                          <span class="info-time"><?php echo date("jS F, Y", strtotime($singleTitle_detail['created_at'])) ; ?></span>
                        </div> 
                       <div class="col-md-12">
                         <a href="<?php echo base_url('instructor/discussions/comment/'.$singletitleID.'');?>"><button type="button" class="btn btn-primary float-right">Reply</button></a>
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
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
</body>
</html>