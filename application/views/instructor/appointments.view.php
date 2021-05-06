<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/pickers/daterange/daterange.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/calendars/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/calendars/fullcalendar.css">
  <!-- END Page Level CSS-->
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
          <h3 class="content-header-title mb-0">Skype Interview Schedule</h3>
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
          <!-- <div class="btn-group">
            <button class="btn btn-round btn-info" type="button"> Save</button>
          </div> -->
        </div>
      </div>
      <div class="content-body">
        <!-- Full calendar events example section start -->
        <section id="events-examples">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">List of Skype Interviews</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div id='fc-event-colors'></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Full calendar events example section end -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="appointmentDetail">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Appointment Detail</a>
                  </li>
                </ul></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="tab-content px-1 pt-1">
                  <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                    <div class="table-responsive">
                      <table class="table table-borderless">
                          <tbody>
                            <tr>
                              <th scope="row">Course</th>
                              <td></td>
                            </tr>
                            <tr>
                              <th scope="row">Student Name</th>
                              <td></td>
                            </tr>
                            <tr>
                              <th scope="row">Student Skype ID</th>
                              <td></td>
                            </tr>
                            <tr>
                              <th scope="row">Student Contact</th>
                              <td></td>
                            </tr>
                            <tr>
                              <th scope="row">Appointment Date & Time</th>
                              <td></td>
                            </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
   
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="<?php echo base_url()?>/app-assets/vendors/js/extensions/moment.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/extensions/fullcalendar.min.js" type="text/javascript"></script>

  <script type="text/javascript">
    jQuery(document).ready(function(){
      /********************************************
      *       Events Colors       *
      ********************************************/
      $('#fc-event-colors').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: new Date(),
        businessHours: true, // display business hours
        editable: false,
        events: <?php echo $events; ?>
      });

    });

    function appointment_detail(id) {
      $.ajax({
        type: "post",
        url: "<?php echo base_url('instructor/skypeAppointment_details'); ?>",
        data: {studentID: id},
        success: function(data)
        {
          var details = JSON.parse(data);
          // console.log(details);
          var date = new Date(details.start_datetime);
          $(".table-responsive").html('<table class="table table-borderless"><tbody><tr><th scope="row">Course</th><td>'+details.appointmentDetails.course_title+'</td></tr><tr><th scope="row">Student Name</th><td>'+details.appointmentDetails.fullname+ '</td></tr><tr><th scope="row">Student Skype ID</th><td>'+details.appointmentDetails.skype_id+'</td></tr><tr><th scope="row">Student Contact</th><td>'+details.appointmentDetails.phone+'</td></tr><tr><th scope="row">Appointment Date & Time</th><td>'+details.date+'</td></tr></tbody></table>');
          $("#appointmentDetail").modal('show');
        }
      });
      
    }
  </script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>