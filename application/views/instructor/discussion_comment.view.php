<?php include(dirname(__FILE__)."/includes/instructor_head.php"); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/plugins/forms/validation/form-validation.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/discussion_box.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/instructor_header.php"); ?>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/instructor_sidebar.php"); ?>
      <div class="content-body">
        <section class="singlecourse">
          <div class="row match-height">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-content">
                  <div class="card-header " style="margin-top:10px;">
                    <h4><b><?php echo ucwords($discussion_titles['discussion_title']); ?></b></h4>
                    <h5> -  <?php echo ucwords($discussion_titles['description']); ?></h5>
                    <div class="heading-elements" style="margin-top:10px;">
                      <button onclick="goBack()" class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">
                        <i class="ft-arrow-left"></i> Go Back
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="card-text">
                    <div class="tab-content px-1">
                      <div role="tabpanel" class="tab-pane active" id="chapterContent_1" aria-expanded="true" aria-labelledby="chapterContent-tab1">
                        <div class="row"> 
                          <ul class="comment-section">
                            <div class="comment_b">
                              <?php if (!empty($discussion_title_comments)){ foreach ($discussion_title_comments as $single_comment) { if($single_comment['user_id'] != $this->session->userdata('id')){ ?>
                              <li class="comment user-comment">
                                <div class="info">
                                    <a href="#"><?php echo $single_comment['fullname'];  ?></a>
                                    <span><?php echo timeDifference($single_comment['created']); ?> ago</span>
                                </div>

                                <a class="avatar" href="#">
                                    <img src="<?php echo base_url("uploads/".$single_comment['profile_image']) ?>" width="35" alt="Profile Avatar" title="Anie Silverston" />
                                </a>

                                <p><?php echo $single_comment['comment']; ?></p>
                              </li>
                              <?php }else{ ?>
                                <li class="comment author-comment">
                                  <div class="info">
                                      <a href="#"><?php echo $single_comment['fullname'];  ?></a>
                                      <span><?php echo timeDifference($single_comment['created']); ?> ago</span>
                                  </div>
                                  <a class="avatar" href="#">
                                      <img src="<?php echo base_url("uploads/".$single_comment['profile_image'] )?>" width="35" alt="Profile Avatar" title="Jack Smith" />
                                  </a>
                                  <p><?php echo $single_comment['comment']; ?></p>
                              </li><?php } } }else{?>

                                <li class="comment user-comment no_comment">
                                  <div class="info">
                                      <a href="#"></a>
                                      <span></span>
                                  </div>
                                  <a class="avatar" href="#">
                                      <img src="" width="35" alt="" title="" />
                                  </a>
                                  <p>Still no comments...!</p>
                              </li>
                             <?php } ?>
                            </div>
                            <li class="write-new">
                              <?php $singlediscussionID = encryptID($this->session->userdata('id'),$discussion_titles['id']);
                                echo form_open('instructor/discussions/comment/'.$singlediscussionID,'novalidate id = "discussion_comment_form"');?>
                                  <input type="hidden" name="discussion_forum_id" id="discussion_forum_id" value="<?php echo $discussion_titles['id']; ?>">
                                  <div class="form-group">
                                    <div class="controls">
                                      <textarea class="form-control" type="textarea" id="comment_box"class="comment_box" name="comment_box" placeholder="Write your comment here" required data-validation-required-message="This field is required"></textarea>
                                    </div>
                                  </div>

                                  <div>
                                    <button type="button" name="submit_discussion_comment" id="submit_discussion_comment" value="submit" class="btn btn-primary">
                                      <i class="la la-check-square-o"></i> Submit
                                    </button>
                                  </div>
                              <?php echo form_close(); ?>
                            </li>
                          </ul>
                        </div>
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
  <?php include(dirname(__FILE__)."/includes/instructor_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() 
    {
      // Submit discussion forum 
      $("#submit_discussion_comment").on('click', function()
      {
        if (validate()) 
        {
          var discussion_formID     = $("#discussion_forum_id").val();
          var comment               = $("#comment_box").val();

          $.ajax({
            url: '<?php echo base_url(); ?>instructor/chapterDiscussion_comments',
            type: 'POST',
            data: {
                    comment : comment,
                    discussion_formID   : discussion_formID
                  },
            success: function (data) {
              $(".comment_b").append(data);
              $('.no_comment').remove();
              $('#discussion_comment_form').trigger("reset");
            }
          });
        }
      });

      function validate() 
      {
        var comment = $("#comment_box").val();
        var flag = true;

        if (comment == '') 
        {
          $('#comment_box').closest('.form-group').addClass('error').removeClass('validate');
            $("#comment_box").attr("aria-invalid", "true").next(".help-block").html('<ul><li>This field is required.</li></ul>').css('color','red');
          flag = false;
        }
        return flag;
      }
    });
  </script>
</body>
</html>