<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/forms/icheck/custom.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/forms/checkboxes-radios.min.css">
</head>
<body class="vertical-layout student-panel vertical-content-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
      <div class="content-body">
        <section id="justified-bottom-border">
          <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
              <div class="student-details card">
                <div class="row card-header">
                  <h4 class="card-title col-md-6">Student Test</h4>
                  <p id="count" class="col-md-6"></p>
                </div>                
                <div class="card-content">
                  <div class="card-body">                   
                    <div class="form-body"> 
                      <div class="qa">                     
                        <div class="row ques">
                          <div class="col-md-12">
                            <h4>HTML stands for consectetur adipisicing elit, sed do eiusmod?</h4>
                          </div>
                        </div>                      
                        <div class="choices table-responsive">
                          <table>
                            <tbody>
                              <tr>
                                <td class="optionClass">                                  
                                  <label class="cstm">Hyper Text Makeup Language
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="checkmark"></span>
                                  </label>
                                </td>
                              </tr>
                              <tr>
                                <td class="optionClass">
                                  <label class="cstm">Hyper Text Makeup Language
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="checkmark"></span>
                                  </label>
                                </td>
                              </tr>
                              <tr>
                                <td class="optionClass">
                                  <label class="cstm">Hyper Text Makeup Language
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="checkmark"></span>
                                  </label>
                                </td>
                              </tr>
                              <tr>
                                <td class="optionClass">
                                  <label class="cstm">Hyper Text Makeup Language
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="checkmark"></span>
                                  </label>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="form-actions right butns pull-right">
                        <button type="submit" name="update_student_profile" value="submit" class="btn btn-primary">
                          Next <i class="la la-arrow-right"></i>
                        </button>
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
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>/app-assets/js/scripts/navs/navs.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(document).ready(function()
  {
    $('.singledate').daterangepicker(
    {
        singleDatePicker: true,
        showDropdowns: true,
        maxDate: new Date()
    });

    // To check image extension type.
    $("#update_profile_image").bind('change', function()
    {
      var file = $("#update_profile_image").val();    //alert(file);
      var ext = file.split(".");
      ext = ext[ext.length-1].toLowerCase();      
      var arrayExtensions = ["jpg" , "jpeg", "png", "gif"];

      if (arrayExtensions.lastIndexOf(ext) == -1) {
        $("#update_profile_image").val("");
        $('#update_profile_image').closest('.form-group').addClass('error');
        $('#update_profile_image').closest('.form-group').removeClass('validate');
        $("#update_profile_image").attr("aria-invalid", "true");
        $("#update_profile_image").next(".help-block").append('<ul><li>This Extension type is not Allowed here.Please Choose "jpg" , "jpeg", "png", "gif".</li></ul>').css('color','red');
      }
    });
  });
  </script>
  <script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2019 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("count").innerHTML = + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("count").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
</body>
</html>