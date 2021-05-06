<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/toggle/switchery.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php $hashedID = encryptID($this->session->userdata('id'),$ChapterDetails['id']); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Update Chapter</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('chapter/list'); ?>">All Chapters</a>
              </li>
              <li class="breadcrumb-item active">
                Update Chapter
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <a href="<?php echo base_url('chapter/list'); ?>">
            <button class="btn btn-round btn-info" type="button">
              <i class="ft-list"></i> All Chapters
            </button>
          </a>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="ui-color">
        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <?php echo form_open('chapter/update/'.$hashedID,'novalidate');?>
                    <div class="form-body">
                      <h4 class="form-section"><i class="la la-eye"></i> Update Chapter Details</h4>
                      <!--1 row--> 
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>Select Module<span class="required">*</span></h5>
                            <div class="controls">
                              <select name="module_id" class="form-control" required data-validation-required-message="This field is required">
                                <option selected="true">Choose Module..</option>
                                <?php foreach($AllModules as $singlecourse){ ?>
                                <option value="<?php echo $singlecourse['id'];?>" <?php if($ChapterDetails['module_id']==$singlecourse['id']){ echo "Selected"; }?>>
                                  <?php echo $singlecourse['course_title'];?>
                                </option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>Chapter Title<span class="required">*</span></h5>
                            <div class="controls">
                              <input type="text" value="<?php echo $ChapterDetails['chapter_title']; ?>" id="chapter_title" name="chapter_title" class="form-control" placeholder="Enter Chapter Title" required data-validation-required-message="This field is required">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--2 row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>Video URL<span class="required">*</span></h5>
                            <div class="controls">
                              <input type="url" value="<?php echo $ChapterDetails['video_url']; ?>" id="video_url" name="video_url" class="form-control" placeholder="http://" required data-validation-required-message="This field is required" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Invalid URL">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>Advertisement Video URL<span class="required">*</span></h5>
                            <div class="controls">
                              <input type="url" value="<?php echo $ChapterDetails['advertisement_url']; ?>" id="advertisement_url" name="advertisement_url" class="form-control" placeholder="http://" required data-validation-required-message="This field is required" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Invalid URL">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--3 row-->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>Chapter Description<span class="required">*</span></h5>
                            <div class="controls">
                              <textarea rows="6" class="form-control" type="textarea" id="chapter_description" name="chapter_description" placeholder="Tell something about Chapter" required data-validation-required-message="This field is required"><?php echo $ChapterDetails['chapter_description']; ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <h5>Chapter Duration<span class="required">*</span></h5>
                            <div class='input-group'>
                              <input type='number' value="<?php echo $ChapterDetails['time_duration']; ?>" id="time_duration" name="time_duration" class="form-control" required data-validation-required-message="This field is required"/>
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  Minutes
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <h5>PPT's<span class="required">*</span></h5>
                            <div class='input-group'>
                              <input type="checkbox" name="ppts" <?php echo $retVal = ($ChapterDetails['ppts']=="Yes") ? "checked" : "" ;?> value="Yes" required> 
                              <input type="file" class="form-control" id="ppt_file" name="ppt_file">
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--4 row-->
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <h5>Chapter Content<span class="required">*</span></h5>
                            <div class="controls">
                              <textarea name="content" id="ckeditor-color" rows="15" class="ckeditor-color"><?php echo $ChapterDetails['content']; ?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions right">
                        <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                          <i class="ft-refresh-ccw"></i> Reset
                        </button>
                        <button type="submit" name="update_Chapter" value="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> Update Chapter
                        </button>
                        <button type="button" onclick="goBack()" name="reset_form" value="reset" class="btn btn-danger">
                          <i class="ft-x"></i> Cancel
                        </button>
                      </div>
                    </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
<script src="/app-assets/vendors/js/editors/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"
  type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"
  type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/validation/form-validation.js"
  type="text/javascript"></script>
<script type="text/javascript">
(function(window, document, $) {
  // CKEditor Color Options
  editor = CKEDITOR.replace( 'ckeditor-color', {
    height: '350px',
    uiColor: '#CCEAEE'
  });
})(window, document, jQuery);

$(document).ready(function(){
  $('.dropdown-item.delete-btn').on('click',function(){
    var moduleID = $(this).data('module_id'); alert(moduleID);
    var currentRow = $(this).parents('tr');
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this Module's data again...!",
      icon: "warning",
      showCancelButton: true,
      buttons: {
          cancel: {
              text: "No, Cancel.!",
              value: null,
              visible: true,
              className: "btn-warning",
              closeModal: false,
          },
          confirm: {
              text: "Yes, Delete it!",
              value: moduleID,
              name: "delete_module",
              visible: true,
              className: "",
              closeModal: false
          }
      }
    }).then(isConfirm => {
      if (isConfirm) {
        $.ajax({
          url: '<?php echo base_url(); ?>module/delete',
          data: { module_id:moduleID },
          type: 'POST',
          success: function(data){
            //alert(data);
            swal("Deleted!", "Module has been deleted successfully...!", "success");
            $('#instructor_table').DataTable().row(currentRow).remove().draw();
          }
        });
      } else {
        swal("Cancelled", "Module's Data is still safe :)", "error");
      }
    });
  });
});
</script>
</body>
</html>