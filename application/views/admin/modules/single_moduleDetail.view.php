<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<style type="text/css">
div.dt-buttons {
  margin-top: -90px !important;
}
</style>
</head>
<?php 
										error_reporting(0);
										?>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
  data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
  <?php include(dirname(dirname(__FILE__))."/includes/header.php"); 
    $chapter_details = $singleModuleDetail['chapter_details'];
    $totalChapters = count($chapter_details);
    $total_time_duration = $singleModuleDetail['total_time_duration'];
    ?>
  <?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Single Modules Detail</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="<?php echo base_url('admin/home'); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="<?php echo base_url('Module/list'); ?>">Modules</a>
                </li>
                <li class="breadcrumb-item active">
                  Single Modules Detail
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
            <button class="btn btn-round btn-info" type="button" onclick="backtolist();">
            <i class="ft-arrow-left"></i> Back
            </button>
          </div>
        </div>
      </div>
      <div class="content-body">
        <section id="file-export">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header instructor-course-details-page">
                  <img src="<?php echo base_url('uploads/').$singleModuleDetail['course_image']; ?>" alt="<?php echo $singleModuleDetail['course_title']; ?>">
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div class="row course-main-details">
                      <div class="col-xl-6 col-md-8 col-12" style="padding-left: 0">
                        <h3><?php echo $singleModuleDetail['course_title']; ?> <small>(<?php echo $singleModuleDetail['time_duration']." months"; ?>)</small></h3>
                      </div>
                      <div class="col-xl-6 col-md-8 col-12">
                        <h5 style="float: right;">
                          <i class="la la-rupee"></i> <?php echo $singleModuleDetail['fee']; ?>
                        </h5>
                      </div>
                    </div>
                    <br>
                    <h4 style="font-family: 'Nunito Sans' sans-serif; font-size: 14px; color: #202020; font-weight: 600;">COURSE DETAIL</h4>
                    <hr>
                    <p class="abs" style="font-family: 'Nunito Sans' sans-serif; font-size: 14px; color: #535353;"><?php echo $singleModuleDetail['brief_detail']; ?></p>
                    <br>
                    <ul class="nav nav-tabs nav-underline">
                      <li class="nav-item">
                        <a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1" href="#tabIcon1" aria-expanded="true"><i class="la la-list"></i> Course Content</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2" href="#tabIcon2" aria-expanded="true"><i class="la la-question"></i> Questions related to Course</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="baseIcon-tab3" data-toggle="tab" aria-controls="tabIcon3" href="#tabIcon3" aria-expanded="true"><i class="la la-cog"></i> Final Exam Settings</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1 pt-1">
                      <div role="tabpanel" class="tab-pane active" id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
                        <?php if(!empty($chapter_details)) { ?>
                          <section id="clpsAnimation" class="clpsAnimation">
                            <div class="row">
                              <div class="col-sm-12">
                                <?php $i = '1'; foreach($chapter_details as $singleChapter){ ?>
                                  <div id="accordionWrap_<?php echo $singleChapter['id']; ?>" role="tablist" aria-multiselectable="true" data-animation="animation">
                                    <div class="card">
                                      <div id="heading1" role="tab" class="card-header">
                                        <a data-toggle="collapse" data-parent="#accordionWrap_<?php echo $singleChapter['id']; ?>" href="#accordion_<?php echo $singleChapter['id']; ?>" aria-expanded="true" aria-controls="accordion_<?php echo $singleChapter['id']; ?>" class="card-title collapseAnimation lead" data-animation="pulse">
                                          Chapter <?php echo $i .": ".$singleChapter['chapter_title']; ?> 
                                          <span><?php if(!empty($singleChapter['video_url'])){ echo "(1 video)"; } ?></span>
                                          <div class="pull-right">
                                            <span class="duration"><?php echo $singleChapter['time_duration']." mins"; ?></span>
                                          </div>
                                        </a>
                                      </div>
                                      <div id="accordion_<?php echo $singleChapter['id']; ?>" role="tabpanel" aria-labelledby="heading1" class="card-collapse collapse <?php if($i=='1'){ echo 'show'; } ?>" aria-expanded="true">
                                        <div class="card-body">
                                          <p class="accordion-text text-small-3"><?php echo $singleChapter['chapter_description']; ?></p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php $i++; } ?>
                              </div>
                            </div>
                          </section>
                        <?php } ?>
                      </div>
                      <div class="tab-pane" id="tabIcon2" aria-labelledby="baseIcon-tab2">
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
                                <button type="button" class="close pause" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body video-body" id="chapterVideo">
                                <div class="tab-content px-1 pt-1">
                                  <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="base-tab1">
                                    <?php echo form_open('module_question/create');?>
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
                                        <input type="hidden" name="module_id" value="<?php echo $singleModuleDetail['id'];?>">
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
                                    <?php echo form_open_multipart('module_question/create' ,'novalidate',array('id'=>'import_new_question'));?>
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
                                        <input type="hidden" name="module_id" value="<?php echo $singleModuleDetail['id'];?>">
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
                              if(!empty($moduleQuestions)) {
                                foreach($moduleQuestions as $singleQuestions){ 
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
                                <a href="<?php echo base_url('module_question/update/'.$hashedID);?>" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
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
                      <div class="tab-pane" id="tabIcon3" aria-labelledby="baseIcon-tab3">
                        <?php echo form_open('module/detail/'.$this->uri->segment(3),'novalidate');?>
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-eye"></i> Final Exam Settings</h4>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>No. Of Questions<span class="required">*</span></h5>
                                    <div class="controls">
                                      <input type="number" id="no_of_questions" name="no_of_questions" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $finalExamSettings['no_of_questions']; ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>Test Time<span class="required">*</span></h5>
                                    <div class="input-group">
                                      <input type="number" id="test_time" name="test_time" class="form-control" value="<?php echo $finalExamSettings['test_time']; ?>" required data-validation-required-message="This field is required">
                                      <div class="input-group-append">
                                        <span class="input-group-text">
                                          Minutes
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>Marks per Question<span class="required">*</span></h5>
                                    <div class="controls">
										
                                      <input type="number" id="per_question_marks" name="per_question_marks"value="<?php echo $finalExamSettings['question_marks']; ?>" class="form-control" required data-validation-required-message="This field is required">
                                    </div>
                                  </div>
                                </div>
								  
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h5>No. Of attempts<span class="required">*</span></h5>
                                    <div class="controls">
                                      <input type="number" id="test_attempts" name="test_attempts" class="form-control" value="<?php echo $finalExamSettings['no_of_attempts']; ?>" required data-validation-required-message="This field is required">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-actions right">
                                <button type="reset" name="reset_form" value="reset" class="btn btn-warning">
                                  <i class="ft-refresh-ccw"></i> Reset
                                </button>
                                <button type="submit" name="submit_test_Details" value="submit" class="btn btn-primary">
                                  <i class="la la-check-square-o"></i> Submit
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
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(dirname(__FILE__))."/includes/footer.php"); ?>
  <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function(){
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
              url: '<?php echo base_url(); ?>module_question/delete',
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
    });
    
    function backtolist() 
    {
      window.history.back();
    }
  </script>
</body>
</html>