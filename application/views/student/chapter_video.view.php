<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/extensions/sweetalert.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/forms/validation/form-validation.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/charts/c3-chart.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-hide-on-scroll navbar-border navbar-shadow navbar-brand-center">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row" style="margin-top: -30px;">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="#">
              <img class="brand-logo" alt="modern admin logo" src="<?php echo base_url()?>/app-assets/images/IPBLogo.png">
              <h3 class="brand-text">IPB Student Panel</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="card">
        <div class="test_instruction">
          <div class="card-header">
            <h4 class="form-section"><b><?php echo $chapter['chapter_title']; ?></b></h4>
          </div>
          <hr>
          <section>
            <div class="row">
              <!-- <div class="card-content collapse show"> -->
                <div class="card-body" style="text-align: center;">
                  <iframe src="<?php echo $chapter['video_url']; ?>" width="950" height="400" frameborder="0" id="video_url"></iframe>
                </div>
              <!-- </div> -->
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/charts/d3.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/charts/c3.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/charts/c3/bar-pie/pie.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/result_piechart.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).keydown(function (event) {
      if (event.keyCode == 123) { // Prevent F12
          swal("This method not allowed....!"); 
          return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) 
        { // Prevent Ctrl+Shift+I        
            swal("This method not allowed....!"); return false;
        } else if (event.ctrlKey && event.keyCode == 65) { 
          swal("This method not allowed....!"); 
          return false;
          }else if (event.ctrlKey && event.keyCode == 67) {
            swal("This method not allowed....!"); 
            return false;
           }else if (event.metaKey && event.keyCode == 65) {
            swal("This method not allowed....!"); 
            return false;
            }else if (event.metaKey && event.keyCode == 67) {
              swal("This method not allowed....!"); 
              return false;
            }else if (event.ctrlKey && event.keyCode == 85) {
              swal("This method not allowed....!"); 
              return false;
            }
            else if (event.metaKey && event.keyCode == 85) {
              swal("This method not allowed....!"); 
              return false;
            }
    });
    // prevent right click
    $(document).bind("contextmenu",function(e){
      swal("This method not allowed....!");
      return false;
    });
    
  </script>
</body>
</html>