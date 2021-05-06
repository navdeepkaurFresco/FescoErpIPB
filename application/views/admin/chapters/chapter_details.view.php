<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/editors/summernote.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/editors/codemirror.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/editors/theme/monokai.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<?php error_reporting(0); ?>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0"><?php echo ucwords($chapterDetails['chapter_title']); ?></h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('chapter/list'); ?>">Chapters</a>
              </li>
              <li class="breadcrumb-item active">
                Single Chapters Details
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
      <section id="file-export">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-content">
                <?php if($this->session->flashdata('item')) {
                  $message = $this->session->flashdata('item'); ?>
                  <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    <?php echo $message['message']; ?>
                  </div>
                <?php } ?>
                <div class="card-header instructor-course-details-page">
                  <iframe src="<?php echo $chapterDetails['video_url']; ?>" width="100%" height="450" frameborder="0"></iframe>
                </div>
                <div class="card-body">
                  <div class="row">
                    <ul class="chapters-detail-tags mb-0">
                      <li><i class="la la-tag"></i> PPTs</li>
                      <li><i class="la la-hourglass"></i> <?php echo $chapterDetails['time_duration']." Minutes";
                        ?></li>
                    </ul>
                  </div>
                  <div class="row m-1">
                    <p><?php echo $chapterDetails['chapter_description']; ?></p>
                  </div>
                  <ul class="nav nav-tabs nav-underline">
                    <li class="nav-item">
                      <a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1"
                        href="#tabIcon1" aria-expanded="true"><i class="la la-list"></i> Chapter Content</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2"
                        href="#tabIcon2" aria-expanded="false"><i class="la la-flag"></i> Discussion Forums</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="baseIcon-tab3" data-toggle="tab" aria-controls="tabIcon3"
                        href="#tabIcon3" aria-expanded="true"><i class="la la-question"></i> Questions related to Chapter</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="baseIcon-tab4" data-toggle="tab" aria-controls="tabIcon4"
                        href="#tabIcon4" aria-expanded="false"><i class="la la-cog"></i> Chapter Test Setup</a>
                    </li>
                  </ul>
                  <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
                      <div class="row">
                        <?php echo $chapterDetails['content']; ?>
                      </div>
                    </div>
                    <div class="tab-pane" id="tabIcon2" aria-labelledby="baseIcon-tab2">
                      <div class="card-bod chapterDiscussion">
                        <?php if(!empty($chapterDiscussionForum)){ 
                          foreach ($chapterDiscussionForum as $singleTitle_detail) {
                            $singletitleID = encryptID($this->session->userdata('id'),$singleTitle_detail['id']); ?>
                                <div class="row myform detail"> 
                                  <div class="col-md-2 studentImage">
                                    <img src="<?php echo $singleTitle_detail['profile_image']; ?>">
                                  </div>                      
                                  <div class="col-md-6"> 
                                    <a href="<?php echo base_url('chapter/discussionform/'.$singletitleID);?>"><span class="info-name"><?php echo $singleTitle_detail['discussion_title']; ?></span></a>  <br/>
                                    <span class="info-desc"><?php echo substr($singleTitle_detail['description'], 0, 70); ?>....</span><br/>
                                  </div> 
                                  <div class="col-md-4">                            
                                    <span class="info-time"><?php echo date("jS F, Y", strtotime($singleTitle_detail['created_at'])) ; ?></span>
                                  </div> 
                                </div>
                        <?php } }?>
                      </div>
                    </div>
                    <div class="tab-pane" id="tabIcon3" aria-labelledby="baseIcon-tab3">
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#createChapterQuestions" style="margin-bottom: 15px;"><i class="la la-question-circle"></i> Add New Question</button>
                      <div class="modal fade text-left videoModal" id="createChapterQuestions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                        <div class="modal-dialog modal-lg videoPlayer" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-warning white">
                              <h4 class="modal-title white" id="myModalLabel12">
                                <ul class="nav nav-tabs">
                                  <li class="nav-item">
                                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1"
                                      href="#tab1" aria-expanded="true">Add Questions Manually</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2"
                                      aria-expanded="false">Import Questions</a>
                                  </li>
                                </ul>
                              </h4>
                              <button type="button" class="close pause" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body video-body" id="chapterVideo">
                              <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                                  <?php echo form_open('question/create');?>
                                  <div class="form-body">
                                    <h4 class="form-section"><i class="la la-eye"></i> Question Title</h4>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <h5>Question Title<span class="required">*</span></h5>
                                          <div class="controls">
                                            <input type="text" id="question_title" name="question_title" class="form-control" placeholder="Enter Chapter Title" required data-validation-required-message="This field is required">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <h4 class="form-section"><i class="la la-list"></i> Question Options</h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <h5>Option One<span class="required">*</span></h5>
                                          <div class="controls">
                                            <input type="text" id="option1" name="option1" class="form-control" required data-validation-required-message="This field is required">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <h5>Option Two<span class="required">*</span></h5>
                                          <div class="controls">
                                            <input type="text" id="option2" name="option2" class="form-control" required data-validation-required-message="This field is required">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <h5>Option Three<span class="required">*</span></h5>
                                          <div class="controls">
                                            <input type="text" id="option3" name="option3" class="form-control" required data-validation-required-message="This field is required">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <h5>Option four<span class="required">*</span></h5>
                                          <div class="controls">
                                            <input type="text" id="option4" name="option4" class="form-control" required data-validation-required-message="This field is required">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <h4 class="form-section"><i class="ft-check"></i> Correct Answer</h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <h5>Correct Answer<span class="required">*</span></h5>
                                          <div class="controls">
                                            <select id="Correct_option" name="Correct_option" class="form-control" required data-validation-required-message="This field is required">
                                              <option value="">Select</option>
                                              <option value="1">One</option>
                                              <option value="2">Two</option>
                                              <option value="3">Three</option>
                                              <option value="4">Four</option>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-actions right">
                                      <input type="hidden" name="chapter_id" value="<?php echo $chapterDetails['id'];?>">
                                      <input type="hidden" name="module_id" value="<?php echo $chapterDetails['module_id'];?>">
                                      <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                                      <i class="ft-refresh-ccw"></i> Reset
                                      </button>
                                      <button type="submit" name="create_question" value="submit" class="btn btn-primary">
                                      <i class="la la-check-square-o"></i> Create
                                      </button>
                                      <button type="button" data-dismiss="modal" name="reset_form" value="reset" class="btn btn-danger">
                                      <i class="ft-x"></i> Cancel
                                      </button>
                                    </div>
                                  </div>
                                  <?php echo form_close();?>
                                </div>
                                <div class="tab-pane" id="tab2" aria-labelledby="base-tab2">
                                  <?php echo form_open_multipart('question/create' ,'novalidate',array('id'=>'import_new_question'));?>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <h5>Add File</h5>
                                        <div class="controls">
                                          <input type="file" class="form-control" id="Question_file" name="Question_file" required data-validation-required-message="This field is required"/>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-actions right">
                                    <input type="hidden" name="chapter_id" value="<?php echo $chapterDetails['id'];?>">
                                    <input type="hidden" name="module_id" value="<?php echo $chapterDetails['module_id'];?>">
                                    <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                                    <i class="ft-refresh-ccw"></i> Reset
                                    </button>
                                    <button type="submit" name="import_question" value="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Import
                                    </button>
                                    <button type="button" data-dismiss="modal" name="reset_form" value="reset" class="btn btn-danger">
                                    <i class="ft-x"></i> Cancel
                                    </button>
                                  </div>
                                  <?php echo form_close();?>
                                </div>
                              </div>
                            </div>
                            <!-- 
                              <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-danger">
                                  <i class="ft-x"></i> Close
                                </button>
                              </div> -->
                          </div>
                        </div>
                      </div>
                      <table id="chapters_table" class="table table-striped table-responsive table-bordered base-style file-export">
                        <thead>
                          <tr>
                            <th>S.No.</th>
                            <th style="width: 300px;">Question Title</th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1;
                            if(!empty($chapterQuestions)) {
                              foreach($chapterQuestions as $singleQuestions){ 
                              $hashedID = encryptID($this->session->userdata('id'),$singleQuestions['id']); ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $singleQuestions['question_title']; ?></td>
                            <td><?php echo $singleQuestions['option1']; ?></td>
                            <td><?php echo $singleQuestions['option2']; ?></td>
                            <td><?php echo $singleQuestions['option3']; ?></td>
                            <td><?php echo $singleQuestions['option4']; ?></td>
                            <td>
                              <span class="dropdown">
                              <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right">
                              <i class="ft-settings"></i>
                              </button>
                              <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                              <a href="<?php echo base_url('question/update/'.$hashedID);?>" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                              <a href="#" class="dropdown-item delete-btn" data-question_id="<?php echo $singleQuestions['id']; ?>" id="confirm-color">
                              <i class="ft-trash-2"></i> Delete
                              </a>
                              </span>
                              </span>
                            </td>
                          </tr>
                          <?php  $i++; } }?>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tabIcon4" aria-labelledby="baseIcon-tab4">
                      <?php echo form_open('chapter/details/'.$this->uri->segment(3),'novalidate');?>
                      <div class="form-body">
                        <h4 class="form-section"><i class="la la-eye"></i> Chapter Test Details</h4>
                        <!--1 row--> 
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <h5>No. Of Questions<span class="required">*</span></h5>
                              <div class="controls">
                                <input type="number" id="no_of_questions" min="1" name="no_of_questions" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $chapterTestDetails['no_of_questions']; ?>">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <h5>Test Time<span class="required">*</span></h5>
                              <div class="input-group">
                                <input type="number" id="test_time" min="1" name="test_time" class="form-control" value="<?php echo $chapterTestDetails['test_time']; ?>" required data-validation-required-message="This field is required">
                                <div class="input-group-append">
                                  <span class="input-group-text">
                                  Minutes
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--2 row-->
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <h5>Marks per Question<span class="required">*</span></h5>
                              <div class="controls">
                                <input type="number" id="per_question_marks" min="1" name="per_question_marks"value="<?php echo $chapterTestDetails['per_question_marks']; ?>" class="form-control" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <h5>No. Of attempts<span class="required">*</span></h5>
                              <div class="controls">
                                <input type="number" id="test_attempts" min="1" name="test_attempts" class="form-control" value="<?php echo $chapterTestDetails['test_attempts']; ?>" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-actions right">
                          <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                          <i class="ft-refresh-ccw"></i> Reset
                          </button>
                          <button type="submit" name="submit_test_Details" value="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> Create
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
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script><script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#Question_file").bind('change', function()
      {
        var file = $("#Question_file").val();    //alert(file);
        var ext = file.split(".");
        ext = ext[ext.length-1].toLowerCase();      
        var arrayExtensions = ["csv"];
  
        if (arrayExtensions.lastIndexOf(ext) == -1) {
          $("#Question_file").val("");
          $('#Question_file').closest('.form-group').addClass('error');
          $('#Question_file').closest('.form-group').removeClass('validate');
          $("#Question_file").attr("aria-invalid", "true");
          $("#Question_file").next(".help-block").append('<ul><li>This Extension type is not Allowed here.Please Choose "jpg" , "jpeg", "png", "gif".</li></ul>').css('color','red');
        }
      });
  
    $('.dropdown-item.delete-btn').on('click',function(){
      var questionID = $(this).data('question_id'); 
      var currentRow = $(this).parents('tr');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Question's Details again...!",
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
                value: questionID,
                name: "delete_instructor",
                visible: true,
                className: "",
                closeModal: false
            }
        }
      }).then(isConfirm => {
        if (isConfirm) {
          $.ajax({
            url: '<?php echo base_url(); ?>question/delete',
            data: { questionID:questionID },
            type: 'POST',
            success: function(data){
              //alert(data);
              swal("Deleted!", "Question has been deleted successfully...!", "success");
              $('#chapters_table').DataTable().row(currentRow).remove().draw();
            }
          });
        } else {
          swal("Cancelled", "Question's Details are still safe :)", "error");
        }
      });
    });
  
    $('#chapters_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {
          extend : 'copyHtml5',
          exportOptions: {
            columns: [1, 2, 3, 4, 6]
          }
        },
        {
          extend: 'excelHtml5',
          text: '<i class="fa fa-file-excel-o"></i> Excel',
          titleAttr: 'Export to Excel',
          exportOptions: {
            columns: [1, 2, 3, 4, 6]
          }
        },
        {
          extend: 'csvHtml5',
          text: '<i class="fa fa-file-text-o"></i> CSV',
          titleAttr: 'CSV',
          exportOptions: {
            columns: [1, 2, 3, 4, 6]
          }
        },
        {
          extend: 'pdfHtml5',
          orientation: 'landscape',//landscape give you more space
          pageSize: 'A4',//A0 is the largest A5 smallest(A0,A1,A2,A3,legal,A4,A5,letter))
          exportOptions: {
            columns: [1, 2, 3, 4, 6]
          },
        },
        {
          extend: 'print',
          exportOptions: {
            columns: [1, 2, 3, 4, 6]
          }
        }]
    });
    $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
  });
</script>
<script type="text/javascript">
$(document).ready(function(){
  $("#Question_file").bind('change', function()
  {
    var file = $("#Question_file").val();    //alert(file);
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["csv"];

    if (arrayExtensions.lastIndexOf(ext) == -1) {
      $("#Question_file").val("");
      $('#Question_file').closest('.form-group').addClass('error').removeClass('validate');
      $("#Question_file").attr("aria-invalid", "true").next(".help-block").append('<ul><li>This Extension type is not Allowed here.Please Choose "jpg" , "jpeg", "png", "gif".</li></ul>').css('color','red');
    }
  });
});
</script>
</body>
</html>