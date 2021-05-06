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
<link rel="stylesheet" type="text/css" href="/app-assets/css/discussion_box.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">
          Single Discussion forum Details
        </h3>
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
                Single Discussion forum Details
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
                <div class="card-body">
                  <div class="card-text">
                    <h4 class="card-title"><?php echo $discussionTitle['discussion_title']; ?></h4>
                    <p class="card-text"><?php echo $discussionTitle['description']; ?></p>
                  </div>
                  <div class="card-text">
                    <div class="row"> 
                      <ul class="comment-section" style="margin: 20px;border: 1px solid #ccc;padding: 20px;">
                        <div class="comment_b">
                          <?php if (!empty($discussion_Comments)){ 
                            foreach ($discussion_Comments as $single_comment) { 
                              if($single_comment['user_id'] != $discussion_Comments[0]['user_id']){ ?>
                          <li class="comment user-comment">
                            <div class="info">
                                <a><?php echo $single_comment['fullname'];  ?></a>
                                <span><?php echo timeDifference($single_comment['created']); ?> ago</span>
                            </div>
                            <a class="avatar" href="#">
                              <img src="<?php echo $single_comment['profile_image'] ?>" width="35" alt="Profile Avatar" title="Anie Silverston" />
                            </a>
                            <p><?php echo $single_comment['comment']; ?></p>
                          </li>
                          <?php }else{ ?>
                            <li class="comment author-comment">
                              <div class="info">
                                  <a><?php echo $single_comment['fullname'];  ?></a>
                                  <span><?php echo timeDifference($single_comment['created']); ?> ago</span>
                              </div>
                              <a class="avatar" href="#">
                                  <img src="<?php echo $single_comment['profile_image'] ?>" width="35" alt="Profile Avatar" title="Jack Smith" />
                              </a>
                              <p><?php echo $single_comment['comment']; ?></p>
                          </li><?php } 
                        } }else{?>

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
                      </ul>
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
</body>
</html>