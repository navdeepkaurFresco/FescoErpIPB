<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/calendars/clndr.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/css/plugins/forms/validation/form-validation.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/app-assets/vendors/css/extensions/sweetalert.css">
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
                  <?php if($this->session->flashdata('item_appointment')) {
                    $message = $this->session->flashdata('item_appointment'); ?>
                    <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <?php echo $message['message']; ?>
                    </div>
                  <?php } ?>
                  <div class="nav-vertical">
                    <ul class="nav nav-tabs nav-underline nav-justified">
                      <li class="nav-item">
                        <a class="nav-link active" id="StudentCoursesTabs-tab1" data-toggle="tab" aria-controls="StudentCoursesTab_1" href="#StudentCoursesTab_1" aria-expanded="true">
                          Schedule an Appointment
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="StudentCoursesTabs-tab2" data-toggle="tab" aria-controls="StudentCoursesTab_2" href="#StudentCoursesTab_2" aria-expanded="false">Scheduled Appointments</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1">
                      <div role="tabpanel" class="tab-pane active" id="StudentCoursesTab_1" aria-expanded="true" aria-labelledby="StudentCoursesTabs-tab1">
                        <section>
                          <?php echo form_open('student/skypeInterview','novalidate');?>
                          <input type="hidden" name="selected_schedule" id="selected_schedule" value="">
                          <div class="row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                              <div class="card">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="projectinput5">Choose your module to schedule Skype Interview</label>
                                        <div class="controls">
                                          <select id="modules" name="modules" class="form-control" required data-validation-required-message="This field is required">
                                            <option value="">select</option>
                                            <?php foreach ($myModules as $value) {
                                              echo '<option value="'.$value->id.'">'.$value->course_title.'</option>';
                                            } ?>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <!-- Skype Calendar -->
                            <div class="col-xl-6 col-lg-12 col-sm-12">
                              <div class="card">
                                <!-- <div class="card-header">
                                  <h4 class="card-title">Select Date for the Skype Interview</h4>
                                </div> -->
                                <div class="card-body">
                                  <div id="clndr-skype" class="overflow-hidden bg-grey bg-lighten-3"></div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-sm-12">
                              <div class="card">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="projectinput5">Choose Time</label>
                                        <div class="controls">
                                          <select id="time_slot" name="time_slot" class="form-control" required data-validation-required-message="This field is required">
                                            <option value="">select</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-xl-6 col-lg-12 col-sm-12">
                                <button type="submit" class="btn btn-info btn-min-width box-shadow-3 mr-1 mb-1" id="save_appointment" name="save_appointment" value="submit">Save</button>
                              </div>
                            </div>
                          </div>
                          <?php echo form_close();?>
                        </section>
                      </div>
                      <div class="tab-pane" id="StudentCoursesTab_2" aria-labelledby="StudentCoursesTabs-tab2">
                        <section>
                          <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                              <thead>
                                <tr>
                                  <th>S.No.</th>
                                  <th>Course</th>
                                  <th>Appointment Detail</th>
                                  <th>Instructor Detail</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; if (!empty($scheduled_appointments)) { foreach ($scheduled_appointments as $single_appointment) { ?>
                                <tr>
                                  <th scope="row"><?php echo $i; ?></th>
                                  <td><?php echo $single_appointment['course_title']; ?></td>
                                  <td>
                                    Date<p><?php echo date("jS F, Y", strtotime($single_appointment['start_datetime'])) ; ?></p>
                                    Time<p><?php echo date("h:i:s A", strtotime($single_appointment['start_datetime'])) ; ?></p>
                                  </td>
                                  <td>
                                    Instructor: <p><?php echo $single_appointment['fullname']; ?></p>
                                    Skype ID: <p><?php echo $single_appointment['skype_id']; ?></p>
                                    Contact No.:<p><?php echo $single_appointment['phone']; ?></p>
                                  </td>
                                </tr>
                                <?php $i++; }} ?>
                              </tbody>
                            </table>
                          </div>
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
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  
  <!-- BEGIN PAGE VENDOR JS-->
  <script type="text/template" id="clndr-template">
    <div class="clndr-controls">
    <div class="clndr-previous-button">&lt;</div>
    <div class="clndr-next-button">&gt;</div>
    <div class="current-month">
      <%= month %>
        <%= year %>
    </div>
  </div>
  <div class="clndr-grid">
    <div class="days-of-the-week clearfix">
      <% _.each(daysOfTheWeek, function(day) { %>
        <div class="header-day">
          <%= day %>
        </div>
        <% }); %>
    </div>
    <div class="days">
      <% _.each(days, function(day) { %>
        <div class="<%= day.classes %>" id="<%= day.id %>">
          <span class="day-number">
            <%= day.day %>
          </span>
        </div>
        <% }); %>
    </div>
  </div>
</script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/extensions/moment.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/extensions/underscore-min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/extensions/clndr.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <script type="text/javascript">
    jQuery(document).ready(function(){
      
      $('#clndr-skype').clndr({
        template: $('#clndr-template').html(),
        trackSelectedDate: true,
        clickEvents: {
          click: function(target) {            
            getAvailableSlots(target.date._i);
            $("#selected_schedule").val(target.date._i);
          }
        },
      });

      function getAvailableSlots(date){

        var module_id = $("#modules").val();
        if(module_id == '' || module_id === undefined){
          swal('Please select module to book Appointment');
          return true;
        }
        console.log(module_id);
        console.log(date);
        jQuery.ajax({
          url : "<?php echo base_url(); ?>/student/availableSlots",
          type : "POST",
          data : {"module_id":module_id,"date":date},
          async : true,
          success : function(res){
            console.log(res);
            var html = '<option value="">select</option>';
            for(var i=0;i<res.length;i++){
              html+='<option value="'+res[i]+'">'+res[i]+'</option>';
            }
            jQuery("#time_slot").html(html);
          }
        });
      }

      $("#modules").bind('change', function(){
        var mid = $(this).val();
        $.ajax(
        {
          url: '<?php echo base_url(); ?>student/check_appointment',
          data: { module_id:mid },
          type: 'POST',
          success: function(response)
          {
              if (response) 
              {
                  $('#modules').closest('.form-group').addClass('error').removeClass('validate');
                  $("#modules").attr("aria-invalid", "true").next(".help-block").append('<ul><li>Skype Interview already Scheduled for this Course .</li></ul>').css('color','red');
                  jQuery('#save_appointment').attr("disabled", true);
              }else
                  {
                      jQuery('#save_appointment').attr("disabled", false);
                  }
          },
          error: function(err)
          {
            console.log(err);
          }
        });
      });

    });
  </script>
</body>
</html>