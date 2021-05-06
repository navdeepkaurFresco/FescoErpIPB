<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
  <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/ui/prism.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/forms/validation/form-validation.css">

  <!--  daterange picker css -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/pickadate/pickadate.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/pickers/daterange/daterange.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css"> 


</head>
<body class="vertical-layout vertical-content-menu 2-columns default  menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/instructor_header.php"); ?>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/instructor_sidebar.php"); ?>
      <div class="content-body">
         <section class="row">
            <div class="statics-title-row pull-up mt-1 ml-1">
               <h4 class="text-uppercase">Add Schedule</h4>
            </div>

            <div class="col-lg-12 col-md-12">
               <div class="card">
                  <div class="card-body">
                     <?php if($this->session->flashdata('item')) {
                        $message = $this->session->flashdata('item'); ?>
                        <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <?php echo $message['message']; ?>
                        </div>
                     <?php } ?>
                     <?php echo form_open('instructor/skypeInterview','novalidate');?>
                     <div class="form-body">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <h5>Date<span class="required">*</span></h5>
                                 <div class="controls">
                                 <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                      <span class="la la-calendar-o"></span>
                                      </span>
                                    </div>
                                    <input type="text" id="Date" name="AppointmentDate" placeholder="Select Scheduled Date " class="form-control singledate" required data-validation-required-message="This field is required">
                                 </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <h5>Day<span class="required">*</span></h5>
                                 <div class="controls">
                                    <Select class="form-control" id="AppointmentDay" name="AppointmentDay" required data-validation-required-message="This field is required">
                                    <option value="">Select Schedule Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>  
                                    </Select>
                                  </div>
                              </div>
                           </div>
                         </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <h5>Start Time<span class="required">*</span></h5>
                                 <div class="controls">
                                 <div class="input-group"  data-align="top" data-autoclose="true">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><span class="ft-clock"></span></span>
                                    </div>
                                    <input type='text' class="form-control pickatime" name="start_time" id="picker_from" placeholder="Select Start Time" required data-validation-required-message="This field is required"/>
                                 </div>
                                 </div>
                             </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <h5>End Time<span class="required">*</span></h5>
                                 <div class="controls">
                                 <div class="input-group"  data-align="top" data-autoclose="true">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><span class="ft-clock"></span></span>
                                    </div>
                                    <input type='text' class="form-control pickatime" name="end_time" id="picker_to" placeholder="Select End Time" required data-validation-required-message="This field is required"/>
                                 </div>
                                 </div>
                              </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <h5>Availabilty<span class="required">*</span></h5>
                                 <div class="controls">
                                    <Select class="form-control" id="availableStatus" name="availableStatus" required data-validation-required-message="This field is required">
                                    <option value="">Select Available Status</option>
                                    <option value="Available">Available</option>
                                    <option value="Busy">Busy</option>
                                    </Select>
                                  </div>
                             </div>
                           </div>
                         </div>
                         <div class="form-actions right">
                           <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                             <i class="ft-refresh-ccw"></i> Reset
                           </button>
                           <button type="submit" name="Submit_scheduled_details" value="submit" class="btn btn-primary">
                             <i class="la la-check-square-o"></i>Submit Details
                           </button>
                           <button type="button" onclick="goBack()" name="reset_form" value="reset" class="btn btn-danger">
                             <i class="ft-x"></i> Cancel
                           </button>
                         </div>
                         <hr>
                         <div class="statics-title-row pull-up mt-1 ml-1">
                               <h4 class="text-uppercase">List of Appointments</h4>
                        </div>
                           <!-- panel heading end -->
                              <!-- Table -->
                        <table id="appointment_table" class="table table-striped table-bordered base-style file-export table-responsive">
                            <thead>
                                <tr class="filters">
                                    <th>Sr. No.</th>
                                    <th>Schedule Date</th>
                                    <th>Schedule Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Availablity Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i=1; if(!empty($allScheduled_Details)){
                                foreach($allScheduled_Details as $ScheduleDetail){ 
                                    $hashedID = encryptID($this->session->userdata('id'),$ScheduleDetail['id']);
                                 ?>
                                <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo date('jS F, Y', strtotime($ScheduleDetail['date'])); ?></td>
                                 <td><?php echo $ScheduleDetail['day']; ?></td>
                                 <td><?php echo date('h:i:s A', strtotime($ScheduleDetail['start_time'])) ; ?></td>
                                 <td><?php echo date('h:i:s A', strtotime($ScheduleDetail['end_time'])) ; ?></td>
                                 <td><?php echo $ScheduleDetail['status']; ?></td>
                                 <td>
                                    <span class="dropdown">
                                      <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                      aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                      <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                                        <a href="#" class="dropdown-item delete-btn" data-instructor_id="<?php echo $ScheduleDetail['id']; ?>" id="confirm-color"><i class="ft-trash-2"></i> Delete</a>
                                      </span>
                                    </span>
                                 </td>
                                </tr>
                                <?php  $i++; } }?>
                              </tbody>
                        </table>
                     </div>
                     <?php echo form_close(); ?>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
   </div>
 <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

   <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>

   <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
   <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
   <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
   <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>

   <script src="<?php echo base_url()?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
   <script src="<?php echo base_url()?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
   
   <script src="<?php echo base_url()?>/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js" type="text/javascript"></script>
   <script type="text/javascript">
      $(document).ready(function()
      {
        $('.singledate').daterangepicker(
        {
            singleDatePicker: true,

            showDropdowns: true,

            minDate: new Date()
        });
      });
   </script>
</body>
</html>