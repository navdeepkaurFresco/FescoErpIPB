<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/forms/validation/form-validation.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
<style type="text/css">
.card-body i
{
  font-size: 62px !important;
  z-index: 0;
  position: relative;
  top: -210px !important;
}
.card-body i:hover
{
  color: #ff1a1a;
}
</style>
</head>
<?php //echo "<pre/>";print_r($chapter_questions); die();?>
<body class="vertical-layout student-panel-body vertical-content-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
      <div class="content-body">
        <section class="singlecourse">
          <div class="row match-height">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-content">
                  <div class="card-header">
                    <h4><?php echo ucwords($chapterContent['chapter_title']); ?></h4>
                    <div class="heading-elements mt-2">
                      <button onclick="goBack()" class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">
                        <i class="ft-arrow-left"></i> Go Back
                      </button>
                    </div>
                  </div>
                  <!-- http://ipb.thefresconews.com/uploads/2-11.png -->
                  <div class="card-body" style="text-align: center;">
                    <?php $ChapterID = encryptID($this->session->userdata('id'),$chapterContent['id']); ?>
                    <img src="<?php echo base_url('uploads/2-6.png'); ?>" alt="Customer Service &amp; Customer Service Skills and Sales &amp; Relationship Management" style="height: 400px; width: 100%;" >
                    <a onclick="window.open('<?php echo base_url('student/chapter_content/'.$ChapterID) ?>',width=600,height=300);"><i class="la la-youtube-play"></i></a>
                    <div class="card-text">
                      <ul class="nav nav-tabs nav-underline nav-justified">
                      <li class="nav-item">
                        <a class="nav-link active" id="chapterContent-tab1" data-toggle="tab" aria-controls="chapterContent_1" href="#chapterContent_1" aria-expanded="true">
                          Chapter Content
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="chapterContent-tab2" data-toggle="tab" aria-controls="chapterContent_2" href="#chapterContent_2" aria-expanded="false">Discussion Forum</a>
                      </li>
                    </ul>
                    <div class="tab-content px-1">
                      <div role="tabpanel" class="tab-pane active" id="chapterContent_1" aria-expanded="true" aria-labelledby="chapterContent-tab1">
                        <div class="card-body">
                          <div class="row"> 
                            <p><?php echo $chapterContent['content']; ?></p>
                          </div>
                          <div class="heading-elements">
                            <?php if(!empty($chapter_questions)){ ?>
                              <button type="button" onclick="window.open('<?php echo base_url('student/chapterTest/'.$ChapterID) ?>',width=600,height=300);" class="btn btn-sm btn-primary box-shadow-2 round btn-min-width pull-right">
                                <?php echo (!empty($StudentTest_attempt)) ? 'Retake Test' : 'Take Test'; ?>
                              </button>
                            <?php } ?>
                            <?php $firstArrayvalue = $chaptersofSingleModule[0]['id'];
                            $lastkey = end($chaptersofSingleModule);
                            $lastArrayvalue = $lastkey['id']; 

                            $idx = 0;

                            foreach ($chaptersofSingleModule as $key => $value) {

                              if ($value['id'] == $chapterContent['id']) {
                                $idx = $key; 
                                break;
                              }
                            }
                            $current = $chaptersofSingleModule[$idx]['id'];

                            if((!empty($StudentTest_attempt)) && $chapterContent['id'] == $firstArrayvalue && $chapterContent['id'] != $lastArrayvalue)
                            {
                              $nxtchptrID = $chaptersofSingleModule[$idx+1]['id'];
                              $nextchapterID = encryptID($this->session->userdata('id'),$nxtchptrID);
                              echo $btntitle = '<a href="'.base_url("student/chapter/details/".$nextchapterID).'" class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" style="margin-right: 5px;"> Next Chapter</a>';
                            }

                            if((!empty($StudentTest_attempt)) && $chapterContent['id'] != $firstArrayvalue && $chapterContent['id'] == $lastArrayvalue)
                            {
                              $prevchptrID = $chaptersofSingleModule[$idx-1]['id'];
                              $nextchapterID = encryptID($this->session->userdata('id'),$prevchptrID);
                              echo $btntitle = '<a href="'.base_url("student/chapter/details/".$nextchapterID).'" class="btn btn-sm btn-info box-shadow-2 round btn-min-width pull-right" style="margin-right: 5px;"> Previous Chapter</a>';
                            }

                            if((!empty($StudentTest_attempt)) && $chapterContent['id'] != $firstArrayvalue && $chapterContent['id'] != $lastArrayvalue)
                            {
                              $nxtchptrID = $chaptersofSingleModule[$idx+1]['id'];
                              $nxtchptrid = encryptID($this->session->userdata('id'),$nxtchptrID);

                              $prevchptrID = $chaptersofSingleModule[$idx-1]['id'];
                              $nextchapterID = encryptID($this->session->userdata('id'),$prevchptrID);
                              echo $btntitle = '<a href="'.base_url("student/chapter/details/".$nxtchptrid).'" class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" style="margin-right: 5px;"> Next Chapter</a> <a href="'.base_url("student/chapter/details/".$nextchapterID).'" class="btn btn-sm btn-info box-shadow-2 round btn-min-width pull-right" style="margin-right: 5px;"> Previous Chapter</a>';
                            }

                            //echo (!empty($StudentTest_attempt)) ? $btntitle : '' ; ?>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="chapterContent_2" aria-labelledby="chapterContent-tab2">
                        <div id="messageArea"></div>
                        <?php $singleChapterID = encryptID($this->session->userdata('id'),$chapterContent['id']);
                          echo form_open('student/chapter/details/'.$singleChapterID,'novalidate id = "discussion_form"');?>
                          <div class="form-body">
                            <input type="hidden" name="chapterID" id="chapterID" value="<?php echo $chapterContent['id']; ?>">
                            <div class="tab-pane" id="tabIcon2" aria-labelledby="baseIcon-tab2">
                              <div class="px-1">
                                <div class="card-bod chapterDiscussion"> 
                                   <?php if(!empty($chapter_discussions)){ foreach ($chapter_discussions as $singleTitle_detail) {
                                    $singletitleID = encryptID($this->session->userdata('id'),$singleTitle_detail['id']);?> 
                                  <div class="row myform detail"> 
                                    <div class="col-md-2 studentImage">
                                      <img src="<?php echo base_url("uploads/".$singleTitle_detail['profile_image']); ?>">
                                    </div>                      
                                    <div class="col-md-6"> 
                                      <a href="<?php echo base_url('chapter/title/discussion/'.$singletitleID);?>"><span class="info-name"><?php echo $singleTitle_detail['discussion_title']; ?></span></a>  <br/>
                                      <span class="info-desc"><?php echo substr($singleTitle_detail['description'], 0, 70); ?>....</span><br/>
                                    </div> 
                                    <div class="col-md-4">                            
                                      <span class="info-time"><?php echo date("jS F, Y", strtotime($singleTitle_detail['created_at'])) ; ?></span>
                                    </div> 
                                  </div>   
                                 <?php }} ?>         
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <h5>Title<span class="required">*</span></h5>
                                  <div class="controls">
                                    <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" required data-validation-required-message="This field is required" value="">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <h5>Description<span class="required">*</span></h5>
                                  <div class="controls">
                                    <textarea rows="5" class="form-control" type="textarea" id="discussion_box"class="discussion_box" name="discussion_box" placeholder="Enter Description" required data-validation-required-message="This field is required"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-actions right">
                              <button type="button" name="submit_discussion" id="submit_discussion" value="submit" class="btn btn-primary">Submit</button>
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
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() 
    {
      // Submit discussion forum 
      $("#submit_discussion").on('click', function()
      {
        if (validate()) 
        {
          var chapterID = $("#chapterID").val();
          var title = $("#title").val();
          var description = $("#discussion_box").val();

          $.ajax({
            url: '<?php echo base_url(); ?>student/chapterDiscussion',
            type: 'POST',
            data: {
                    title       : title,
                    description : description,
                    chapterID   : chapterID
                  },
            success: function (data) {
              // console.log(data);
              $(".chapterDiscussion").append(data);
              $("#messageArea").html('Discussion Submit Successfully..!!').css({"background-color": "#5FE0B2", "color": "white", "text-align":"center", "height": "35px", "padding": "8px"}).fadeIn().fadeOut(18000);
              $('#discussion_form').trigger("reset");
            }
          });
        }
      });

      function validate() 
      {
        var title = $("#title").val();
        var description = $("#discussion_box").val();
        var flag = true;

        if (title == '') 
        {
          $('#title').closest('.form-group').addClass('error').removeClass('validate');
            $("#title").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
          flag = false;
        }
        if (description == '') 
        {
          $('#discussion_box').closest('.form-group').addClass('error').removeClass('validate');
            $("#discussion_box").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
          flag = false;
        }
        return flag;
      }
    });
  </script>
</body>
</html>