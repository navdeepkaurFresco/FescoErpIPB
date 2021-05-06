<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <!-- BEGIN VENDOR CSS--> 
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/pickadate/pickadate.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/pickadate/default.css">
  <!-- END VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
 <style>
  .heading-elements {
      margin-top: 15px;
  }
  button.btn.btn-round.btn-info.save-wp {
    width: 159px;
  }
 </style>
</head>
<body class="vertical-layout vertical-content-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/instructor_header.php"); ?>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/instructor_sidebar.php"); ?>
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Working Plan</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <!-- <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Tables</a>
                </li>
                <li class="breadcrumb-item active">Basic Tables
                </li>
              </ol> -->
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
            <button class="btn btn-round btn-info save-wp" type="button"> Save</button>
          </div>
        </div>
      </div>
      <div class="content-body">
        <section class="row">
          <!-- Basic Tables start -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Working Days</h4>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="alert-message"></div>
                    <p class="card-text">Mark below the days and hours that you will accept appointments. After that you can add break periods.</p>
                    <div class="table-responsive">
                      <table class="working-plan table">
                        <thead>
                          <tr>
                            <th>Day</th>
                            <th>Start</th>
                            <th>End</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="icheck1">
                                <fieldset>
                                  <input type="checkbox" id="sunday">
                                  <label for="sunday">Sunday</label>
                                </fieldset>
                              </div>
                            </td>
                            <td><input id="sunday-start" class="input-xs pickatime-minmax cstm_input" type="text" /></td>
                            <td><input id="sunday-end" class="input-xs pickatime-minmax cstm_input" type="text" /></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="icheck1">
                                <fieldset>
                                  <input type="checkbox" id="monday" />
                                  <label for="monday">Monday</label>
                                </fieldset>
                              </div>
                            </td>
                            <td><input id="monday-start" class="input-xs cstm_input" type="text" /></td>
                            <td><input id="monday-end" class="input-xs cstm_input" type="text" /></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="icheck1">
                                <fieldset>
                                  <input type="checkbox" id="tuesday" />
                                  <label for="tuesday">Tuesday</label>
                                </fieldset>
                              </div>
                            </td>
                            <td><input id="tuesday-start" class="input-xs cstm_input" type="text" /></td>
                            <td><input id="tuesday-end" class="input-xs cstm_input" type="text" /></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="icheck1">
                                <fieldset>
                                  <input type="checkbox" id="wednesday" />
                                  <label for="wednesday">Wednesday</label>
                                </fieldset>
                              </div>
                            </td>
                            <td><input id="wednesday-start" class="input-xs cstm_input" type="text" /></td>
                            <td><input id="wednesday-end" class="input-xs cstm_input" type="text" /></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="icheck1">
                                <fieldset>
                                  <input type="checkbox" id="thursday" />
                                  <label for="thursday">Thursday</label>
                                </fieldset>
                              </div>
                            </td>
                            <td><input id="thursday-start" class="input-xs cstm_input" type="text" /></td>
                            <td><input id="thursday-end" class="input-xs cstm_input" type="text" /></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="icheck1">
                                <fieldset>
                                  <input type="checkbox" id="friday" />
                                  <label for="friday">Friday</label>
                                </fieldset>
                              </div>
                            </td>
                            <td><input id="friday-start" class="input-xs cstm_input" type="text" /></td>
                            <td><input id="friday-end" class="input-xs cstm_input" type="text" /></td>
                          </tr>
                          <tr>
                            <td>
                              <div class="icheck1">
                                <fieldset>
                                  <input type="checkbox" id="saturday" />
                                  <label for="saturday">Saturday</label>
                                </fieldset>
                              </div>
                            </td>
                            <td><input id="saturday-start" class="input-xs cstm_input" type="text" /></td>
                            <td><input id="saturday-end" class="input-xs cstm_input" type="text" /></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Days Off</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <button class="btn btn-round btn-info add-dayoff" type="button"> Add a Day Off</button>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <p class="card-text">Add your days off</p>
                    <div class="table-responsive">
                      <table class="daysoff table mb-0">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Breaks</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <button class="btn btn-round btn-info add-break" type="button"> Add Breaks</button>
                    <!-- <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul> -->
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <p class="card-text">Add the working breaks during each day.</p>
                    <div class="table-responsive">
                      <table class="breaks table mb-0">
                        <thead>
                          <tr>
                            <th>Day</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Basic Tables end -->
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>  
  <script src="<?php echo base_url()?><?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>  
  <script src="<?php echo base_url()?>/app-assets/js/jquery.jeditable.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/workingPlan.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <script type="text/javascript">    
    jQuery(document).ready(function(){
      var wp = new WorkingPlan();
      wp.setup(<?php echo $working_plan; ?>);
      wp.bindEventHandlers();
      wp.timepickers();

      jQuery(".save-wp").on("click",function(){

        var schedule = JSON.stringify(wp.get());
        jQuery.ajax({
        url:"<?php echo base_url(); ?>instructor/saveSchedule",
        type:"POST",
        async:true,
        data:{"add":true,"schedule":schedule},
        success:function(res){
          jQuery(".alert-message").html(res);
        }
      });

      })
    });
  </script>
</body>
</html>