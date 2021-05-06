<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/ui/prism.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
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
                <section id="faq-search">
                  <div class="row">
                      <div class="col-12">
                          <div class="card bg-success white">
                              <div class="card-content text-center">
                                  <div class="card-header">
                                      <h1 class="white mt-4 ">
                                          We're here to help !!
                                      </h1>
                                  </div>
                                  <div class="card-body">
                                      <p class="card-text my-0">
                                          If you have any question, enter what you are looking for!
                                      </p>
                                      <form class="form-group mx-5 my-3">
                                          <input class="form-control" placeholder="Search in faqs...." type="email">
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                </section>
                <section class="faq">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="hdone">
                                            <button aria-controls="collapseOne" aria-expanded="true" class="btn btn-link display-inline font-medium-3" data-target="#collapseOne" data-toggle="collapse" type="button">
                                                <i class="font-medium-3 text-bold-300 fa ft-info text-danger">
                                                </i>Lorem ipsum dolor sit amet, consectetur adipiscing elit?
                                            </button>
                                            <div aria-labelledby="hdone" class="collapse show" data-parent="#accordionExample" id="collapseOne" style="">
                                                <div class="card-text">
                                                    Aenean eget leo vel lorem tincidunt tempor sit amet non ex. Aenean porta, velit ut efficitur fringilla, enim est suscipit augue, in porta ex nisi quis est. Phasellus ut odio in dolor eleifend tincidunt eget id tellus.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="hdtwo">
                                            <button aria-controls="collapseTwo" aria-expanded="false" class="btn btn-link display-inline font-medium-3 collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">                                
                                                <i class="font-medium-3 text-bold-300 fa ft-info text-danger">
                                                </i>Vestibulum hendrerit eros id finibus fermentum?
                                            </button>
                                            <div aria-labelledby="hdtwo" class="collapse" data-parent="#accordionExample" id="collapseTwo" style="">
                                                <div class="card-text">
                                                    Nam tincidunt rhoncus dolor nec imperdiet. Ut ut mauris tortor. Nulla cursus mattis elit, sed egestas augue laoreet id. Etiam eu velit felis. Duis at vehicula ligula, et suscipit nunc.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="hdthree">
                                            <button aria-controls="collapseThree" aria-expanded="false" class="btn btn-link font-medium-3 collapsed" data-target="#collapseThree" data-toggle="collapse" type="button">
                                                <i class="font-medium-3 text-bold-300 fa ft-info text-danger">
                                                </i>Nunc maximus turpis et vulputate euismod?
                                            </button>
                                            <div aria-labelledby="hdthree" class="collapse" data-parent="#accordionExample" id="collapseThree" style="">
                                                <div class="card-text">
                                                    Aenean eget leo vel lorem tincidunt tempor sit amet non ex. Aenean porta, velit ut efficitur fringilla, enim est suscipit augue, in porta ex nisi quis est. Phasellus ut odio in dolor eleifend tincidunt eget id tellus.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="hdfour">
                                            <button aria-controls="collapseFour" aria-expanded="false" class="btn btn-link font-medium-3 collapsed" data-target="#collapseFour" data-toggle="collapse" type="button">
                                                <i class="font-medium-3 text-bold-300 fa ft-info text-danger">
                                                </i>Vivamus pulvinar diam at viverra sagittis?
                                            </button>
                                            <div aria-labelledby="hdfour" class="collapse" data-parent="#accordionExample" id="collapseFour" style="">
                                                <div class="card-text">
                                                    Nam tincidunt rhoncus dolor nec imperdiet. Ut ut mauris tortor. Nulla cursus mattis elit, sed egestas augue laoreet id. Etiam eu velit felis. Duis at vehicula ligula, et suscipit nunc.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="hdfive">
                                            <button aria-controls="collapseFive" aria-expanded="false" class="btn btn-link font-medium-3 collapsed" data-target="#collapseFive" data-toggle="collapse" type="button">
                                                <i class="font-medium-3 text-bold-300 fa ft-info text-danger">
                                                </i>Sed elementum nisl ac lectus luctus viverra?
                                            </button>
                                            <div aria-labelledby="hdfive" class="collapse" data-parent="#accordionExample" id="collapseFive" style="">
                                                <div class="card-text">
                                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mb-0">
                                        <div class="card-header" id="hdsix">
                                            <button aria-controls="collapseSix" aria-expanded="false" class="btn btn-link font-medium-3 collapsed" data-target="#collapseSix" data-toggle="collapse" type="button">
                                                <i class="fa ft-info font-medium-3 text-bold-300 text-danger ">
                                                </i>Nulla ut tortor et arcu porttitor sollicitudin a a odio?
                                            </button>
                                            <div aria-labelledby="hdsix" class="collapse" data-parent="#accordionExample" id="collapseSix" style="">
                                                <div class="card-text">
                                                    Sed sit amet feugiat mi. Morbi dui dui, ultrices id commodo in, commodo ut erat. Ut vitae condimentum lorem. Cras eu viverra metus, fringilla tincidunt est. Aenean cursus, lacus ut posuere convallis, est dolor tincidunt nunc, nec viverra justo lorem a enim.
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
        </div>
      </div>
    </div>
  </div>
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>/app-assets/vendors/js/ui/prism.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
</body>
</html>