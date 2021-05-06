<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Recover Password | IPB</title>
  <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/switchery.min.css">
  <link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="loader"></div>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                      <img src="/app-assets/images/logo.png" alt="IPB logo" style="width: 300px;">
                  </div>
                  <!-- <div id="messageArea" style="text-align: center; color: white; margin-top: 10px;"></div> -->
                  <div id="emailmessageSuccessArea" style="text-align: center; color: white; margin-top: 10px;"></div>
                  <!-- <div id="CodemessageArea" style="text-align: center; color: white; margin-top: 10px;"></div> -->
                  <!-- <div id="emptyfieldmessageArea" style="text-align: center; color: white; margin-top: 10px;"></div> -->
                  <!-- <div id="emptyEmailmessageArea" style="text-align: center; color: white; margin-top: 10px;"></div> -->
                  <!-- <div id="WrngmessageArea" style="text-align: center; color: white; margin-top: 10px;"></div> -->
                  <!-- <div id="emptyCodemessageArea" style="text-align: center; color: white; margin-top: 10px;"></div> -->
                  <div id="PwdmessageArea" style="text-align: center; color: white; margin-top: 10px;"></div>
                </div>
                
                <div class="card-content">
                    <div class="card-body">
                    <div id="emailFieldset">
                        <?php echo form_open('recover/password','novalidate'); ?>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2" style="padding-top: 0px !important;">
                                <span>We will send you a code to reset password.</span>
                            </h6>
                            <fieldset class="form-group position-relative has-icon-left">
                                <div class="controls">
                                    <input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                                <div class="form-control-position">
                                    <i class="ft-mail"></i>
                                </div>
                            </fieldset>
                            <button type="button" name="send_mail" value="send_mail" class="btn btn-outline-warning btn-lg btn-block" onclick="sendEmail()"><i class="ft-mail"></i> Send Email</button>
                        <?php echo form_close(); ?>
                    </div>
                    <div id="codeFieldset" hidden>
                        <?php echo form_open('recover/password', 'novalidate'); ?>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2" style="padding-top: 0px !important;">
                                <span>Enter Code Here</span>
                            </h6>
                            <fieldset class="form-group position-relative has-icon-left">
                              <div class="controls">
                                  <input type="text" id="code" name="code" placeholder="Enter Code" class="form-control" required data-validation-required-message="This field is required">
                              </div>
                              <div class="form-control-position">
                                  <i class="icon-note"></i>
                              </div>
                              <div class="resend-recover-password-code mt-1 pull-right">
                                <a href="#" id="resend_recover_code">Resend Code</a>
                              </div>
                            </fieldset>

                            <button type="button" name="enter_code" value="EnterCode" class="btn btn-outline-warning btn-lg btn-block" onclick="submitCode()"><i class="icon-note"></i> Submit Code</button>
                        <?php echo form_close(); ?>
                    </div>
                    <div id="passwordFieldset" hidden>
                        <?php echo form_open('recover/password', 'novalidate'); ?>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2" style="padding-top: 0px !important;">
                                <span>Enter your new password</span>
                            </h6>
                            <fieldset class="form-group position-relative has-icon-left">
                                <div class="controls">
                                    <input type="password" id="newPassword" name="newPassword" placeholder="Enter New Password" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <div class="controls">
                                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Enter Confirm Password" class="form-control" required data-validation-required-message="This field is required">
                                </div>
                            </fieldset>

                            <button type="button" name="recover_password" id="recover_password" value="recover_password" class="btn btn-outline-warning btn-lg btn-block" onclick="recoverPassword()"><i class="ft-unlock"></i> Recover Password</button>
                        <?php echo form_close(); ?>
                    </div>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span>Login Here</span>
                    </h6>
                    <a href="<?php echo site_url('admin'); ?>" class="card-link">
                        <button type="button" class="btn btn-outline-info btn-lg btn-block box-shadow-3">Login</button>
                    </a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <script src="/app-assets/js/newjquery.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script src="/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>

  <script type="text/javascript">

    function sendEmail() 
    {
      var email       = $("#email").val();
      var emailregex  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if (email == '') {
        $('#email').closest('.form-group').addClass('error').removeClass('validate');
        $("#email").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required</li></ul>').css('color','red');
        return true;
      } 

      if(!emailregex.test(email)) {
        $('#email').closest('.form-group').addClass('error').removeClass('validate');
        $("#email").attr("aria-invalid", "true").next(".help-block").html('<ul><li>Not a valid email address</li></ul>').css('color','red');
        return true;
      }

      $.ajax({
        type: "post",
        url: "<?php echo site_url('login/sentMail');?>",
        data: {email: email, send_mail: 'send_mail'},
        beforeSend: function () 
        {
          $("button[name='send_mail']").attr("disabled",true);
          $('.loader').show();
        },
        success: function (data) 
        {
            if (data.length > 0) {
                localStorage.setItem("code", data);
                $("#emailmessageSuccessArea").html("OTP has been sent to your Email successfully").css('background-color', 'green').fadeOut(8000);
                $("#codeFieldset").prop('hidden', false);
                $("#emailFieldset").prop('hidden', true); 
            }
            if (data == false) {
              $('#email').closest('.form-group').addClass('error').removeClass('validate');
              $("#email").attr("aria-invalid", "true").next(".help-block").html('<ul><li>Oops! Your Email is not registered with us..!</li></ul>').css('color','red');
            }
        },
        complete: function () {
          $('.loader').hide();
          $("button[name='send_mail']").attr("disabled",false);
        }
      });        
    }

    function submitCode() 
    {
        var code = $("#code").val();
        var storedCode = localStorage.getItem("code");

        if (code == '') 
        {
          $('#code').closest('.form-group').addClass('error').removeClass('validate');
          $("#code").attr("aria-invalid", "true").next(".help-block").html('<ul><li>Please fill your password reset code..!</li></ul>').css('color','red');
        }else 
            {
                if (code == storedCode) 
                {
                    $("#codeFieldset").prop('hidden', true);
                    $("#emailFieldset").prop('hidden', true);
                    $("#passwordFieldset").prop('hidden', false);
                }else
                    {
                        $('#code').closest('.form-group').addClass('error').removeClass('validate');
                        $("#code").attr("aria-invalid", "true").next(".help-block").html('<ul><li>Oops! Your entered OTP doesn\'t match..!</li></ul>').css('color','red');
                    }
            }
    }
  </script>

  <script type="text/javascript">
    $(document).ready(function () {
    $("#confirmPassword").bind('blur', function(){
        var newPassword = $("#newPassword").val();
        var confirmPassword = $("#confirmPassword").val();

        if (newPassword !== confirmPassword) 
        {
          $('#confirmPassword').closest('.form-group').addClass('error').removeClass('validate');
          $("#confirmPassword").attr("aria-invalid", "true").next(".help-block").html('<ul><li>Password and Confirm Password must be match..</li></ul>').css('color','red');
          $('#recover_password').attr('disabled', true);
        }else
          {
            $('#recover_password').attr('disabled', false);
          }

    });
  });
    function recoverPassword() 
    {
      if (validate())
      {        
        var newPassword = $("#newPassword").val();
        var confirmPassword = $("#confirmPassword").val();
        $("#PwdmessageArea").stop(true);

        var resetcode = localStorage.getItem("code"); 

        $.ajax(                                     
         {
              type: "post",
              url: "<?php echo site_url('login/changePassword');?>",
              beforeSend: function () 
              {
                $('.loader').show();
              },
              data: {newPassword: newPassword, resetcode:resetcode, recoverPwd: 'recoverPwd'},
              success: function (res) 
              {
                //console.log(res);
                $("#newPassword").val("");
                $("#confirmPassword").val("");
                var data = JSON.parse(res);
                if (data.response) {
                    $("#PwdmessageArea").html("Your Password has been changed Successfully...! </br> Click on Login below").css('background-color', 'green').fadeIn().fadeOut(8000);
                } else {
                  $("#PwdmessageArea").html("Oops! Your Password has not been changed. <br/> Try Again.").css('background-color', 'red').fadeIn().fadeOut(8000);
                }
              },
              complete: function () {
                $('.loader').hide();
              }
          });
    
          /*if (newPassword !== confirmPassword) 
          {
            $('#confirmPassword').closest('.form-group').addClass('error').removeClass('validate');
            $("#confirmPassword").attr("aria-invalid", "true").next(".help-block").html('<ul><li>Password and Confirm Password must be match..</li></ul>').css('color','red');
          }else*/
              
      }
        
    }
     function validate()
     {
      var newPassword = $("#newPassword").val();
      var confirmPassword = $("#confirmPassword").val();
      var flag      = true;
        if (newPassword =='') 
        {
            $('#newPassword').closest('.form-group').addClass('error').removeClass('validate');
            $("#newPassword").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
            flag = false;
        }
        if(confirmPassword == '')
        {
            $('#confirmPassword').closest('.form-group').addClass('error').removeClass('validate');
            $("#confirmPassword").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
            flag = false;

        }
      return flag;
     }

    jQuery('#resend_recover_code').on('click', function()
    {
      var email = $("#email").val();
      
      $.ajax({
        type: "post",
        url: "<?php echo site_url('login/sentMail');?>",
        data: {email: email, send_mail: 'send_mail'},
        success: function (data) 
        {
          if (data.length > 0) {
            localStorage.setItem("code", data);
            $("#emailmessageSuccessArea").html("OTP has been re-sent to your Email successfully").css('background-color', 'green').fadeOut(8000);
            $("#codeFieldset").prop('hidden', false);
            $("#emailFieldset").prop('hidden', true); 
          }
        }
      });
    });
  </script>
</body>
</html>