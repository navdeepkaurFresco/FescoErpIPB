<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/ui/prism.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
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
                  <div class="px-1">
                    <div class="card-bod">                      
                      <div class="row myform detail"> 
                        <div class="col-md-2">
                          <img src="http://ipb.thefresconews.com/uploads/stock-vector-vector-beautiful-girl-in-a-t-shirt-with-a-cherry-cute-lady-cartoon-sketch-illustration-fashion-4770398172.jpg">
                        </div>                      
                        <div class="col-md-6"> 
                          <span class="info-name">Sim</span>  <br/>                         
                          <span class="info-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod consectetur adipisicing elit, sed do eiusmod dolor sit amet, consectetur adipisicing elit, sed do eiusmod consectetur adipisicing elit, sed do eiusmod</span><br/>
                          <a href="ipbindia.com">ipbindia.com</a>
                        </div> 
                        <div class="col-md-4">                            
                          <span class="info-time">November 2, 2018 10:25 am</span>
                        </div> 
                      </div>  
                      <div class="row myform detail"> 
                        <div class="col-md-2">
                          <img src="http://ipb.thefresconews.com/uploads/stock-vector-vector-beautiful-girl-in-a-t-shirt-with-a-cherry-cute-lady-cartoon-sketch-illustration-fashion-4770398172.jpg">
                        </div>                      
                        <div class="col-md-6">    
                          <span class="info-name">Kam</span>  <br/>                       
                          <span class="info-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod consectetur adipisicing elit, sed do eiusmod dolor sit amet, consectetur adipisicing elit, sed do eiusmod consectetur adipisicing elit, sed do eiusmod</span><br/>
                          <a href="ipbindia.com">ipbindia.com</a>
                        </div> 
                        <div class="col-md-4">                            
                          <span class="info-time">November 2, 2018 10:25 am</span>
                        </div> 
                      </div> 
                      <div class="row myform detail"> 
                        <div class="col-md-2">
                          <img src="http://ipb.thefresconews.com/uploads/stock-vector-vector-beautiful-girl-in-a-t-shirt-with-a-cherry-cute-lady-cartoon-sketch-illustration-fashion-4770398172.jpg">
                        </div>                      
                        <div class="col-md-6">   
                          <span class="info-name">Aman</span> <br/>                          
                          <span class="info-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod consectetur adipisicing elit, sed do eiusmod dolor sit amet, consectetur adipisicing elit, sed do eiusmod consectetur adipisicing elit, sed do eiusmod</span><br/>
                          <a href="ipbindia.com">ipbindia.com</a>
                        </div> 
                        <div class="col-md-4">                            
                          <span class="info-time">November 2, 2018 10:25 am</span>
                        </div> 
                      </div> 
                      <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <div class="controls">
                              <textarea rows="5" class="form-control" type="textarea" id="user_bio" name="user_bio" placeholder="Tell something about Instructor...">XYZ</textarea>
                            <div class="help-block"></div></div>
                          </div>
                            <a href="#" class="btn btn-warning" style="float: right;">Reply</a>
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