<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/editors/summernote.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/editors/codemirror.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/editors/theme/monokai.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">All Chapters Details</h3>
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
                All Chapters Details
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-6 col-12">
        <div class="btn-group">
          <a href="<?php echo base_url('chapter/create'); ?>">
            <button class="btn btn-round btn-info" type="button">
              <i class="ft-plus-circle"></i> Add New Chapter
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
                <div class="card-body">
                  <table id="chapters_table" class="table table-striped table-bordered" style="width: 100% !important;">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Chapter Name</th>
                        <th>Module Name</th>
                        <th>PPTs</th>
                        <th>Description</th>
                        <th>Duration</th>
                        <th>Content</th>
                        <th>Reg. Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1;
                        if(!empty($AllChapters)) {
                          foreach($AllChapters as $singleChapter){ 
                          $hashedID = encryptID($this->session->userdata('id'),$singleChapter['id']); ?>
                      <tr id="<?php echo $singleChapter['id']; ?>">
                        <td><?php echo $i; ?></td>
                        <td><a href="<?php echo base_url('/chapter/details/'.$hashedID); ?>"><?php echo ucwords($singleChapter['chapter_title']); ?></a></td>
                        <td><span class="badge badge-default badge-success badge-lg"><?php echo $singleChapter['module_title']; ?></span></td>
                        <td><?php echo $singleChapter['ppts']; ?></td>
                        <td><div class="scrollDiv"><?php echo $singleChapter['chapter_description']; ?></div></td>
                        <td><?php echo $singleChapter['time_duration']; ?> Minutes</td>
                        <td>
                          <button type="button" class="btn btn-outline-warning block btn-sm" data-toggle="modal" data-target="#video_<?php echo $singleChapter['id']; ?>">
                            <i class="ft ft-video"></i> Watch Video
                          </button><br/>
                          <a class="btn btn-outline-danger block btn-sm" href="<?php echo $singleChapter['ppt_file']; ?>"><i class="ft ft-download"></i> Download PPT</a><br/>
                          <button type="button" class="btn btn-outline-info block btn-sm" data-toggle="modal" data-target="#content_<?php echo $singleChapter['id']; ?>">
                            <i class="ft-file-text"></i> Watch Content
                          </button>
                        </td>
                        <td><?php echo date('jS F, Y', strtotime($singleChapter['created_at'])) ; ?></td>
                        <td>
                          <span class="dropdown">
                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right">
                              <i class="ft-settings"></i>
                            </button>
                            <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                              <a href="<?php echo base_url('chapter/update/'.$hashedID);?>" class="dropdown-item"><i class="ft-edit-2"></i> Edit</a>
                              <a href="#" class="dropdown-item delete-btn" onclick="delete_me(<?php echo $singleChapter['id']; ?>)" data-chapter_id="<?php echo $singleChapter['id']; ?>" id="confirm-color">
                                <i class="ft-trash-2"></i> Delete
                              </a>
                            </span>
                          </span>
                        </td>
                      </tr>
                      <div class="modal fade text-left videoModal" id="video_<?php echo $singleChapter['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                        <div class="modal-dialog modal-lg videoPlayer" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-warning white">
                              <h4 class="modal-title white" id="myModalLabel12"><i class="la la-video-camera"></i> Watch Video</h4>
                              <button type="button" class="close pause" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body video-body" id="chapterVideo">
                              <iframe src="<?php echo $singleChapter['video_url']; ?>" width="770" height="400" frameborder="0"></iframe>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn grey btn-outline-secondary pause" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal fade text-left" id="content_<?php echo $singleChapter['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-warning white">
                              <h4 class="modal-title white" id="myModalLabel12"><i class="la la-book"></i> Watch Content</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <section id="summernote-edit-save">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="card">
                                      <div class="card-content">
                                        <div class="card-body">
                                          <form class="form-horizontal">
                                            <div class="form-group">
                                              <button id="edit_<?php echo $singleChapter['id']; ?>" class="btn btn-primary" type="button" onclick="return edit();"><i class="la la-pencil"></i> Edit</button>
                                              <button id="<?php echo $singleChapter['id']; ?>" class="btn btn-success" type="button" onclick="return save(this);"><i class="la la-save"></i> Save</button>
                                            </div>
                                            <div class="form-group">
                                              <div class="summernote-edit" id="summernote_edit_<?php echo $singleChapter['id']; ?>"><?php echo $singleChapter['content']; ?></div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </section>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php  $i++; } }?>
                    </tbody>
                  </table>
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
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.colVis.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/editors/codemirror/lib/codemirror.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/editors/codemirror/mode/xml/xml.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/editors/summernote/summernote.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>

<script type="text/javascript">
  // EDIT & SAVE
  function edit() {
    $('.summernote-edit').summernote(
    {
      focus: true
    });
  }

 function delete_me(id){
	 var chapterID = id;
	 var row = document.getElementById(id);
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Chapter's Details again...!",
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
                value: chapterID,
                name: "delete_chapter",
                visible: true,
                className: "",
                closeModal: false
            }
        }
      }).then(isConfirm => {
        if (isConfirm) {
          $.ajax({
            url: '<?php echo base_url(); ?>chapter/delete',
            data: { chapterID:chapterID },
            type: 'POST',
            success: function(data){
              //alert(data);
              swal("Deleted!", "Chapter has been deleted successfully...!", "success");
			  row.parentNode.removeChild(row);

              //$('#chapters_table').DataTable().row(currentRow).remove().draw();
            }
          });
        } else {
          swal("Cancelled", "Chapter's Details are still safe :)", "error");
        }
      });
 }
  function save(e) {
    var content_chapter_id = e.id;    //alert(content_chapter_id);
    var markup = $('#summernote_edit_'+content_chapter_id).summernote('code');

    $.ajax({
      url: '<?php echo base_url(); ?>chapters/UpdateChapterContentDetails',
      data: {
        content_chapter_id:content_chapter_id,
        markup: markup
      },
      type: 'POST',
      success: function(data){
        //alert(data);
        $('#summernote_edit_'+content_chapter_id).summernote('destroy');
      },
      error: function(err){
        console.log(err);
      }
    });
  }

  $(document).ready(function()
  {
    $('.dropdown-item.delete-btn').on('click',function(){
      var chapterID = $(this).data('chapter_id'); alert(chapterID);
      var currentRow = $(this).parents('tr');
      swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Chapter's Details again...!",
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
                value: chapterID,
                name: "delete_chapter",
                visible: true,
                className: "",
                closeModal: false
            }
        }
      }).then(isConfirm => {
        if (isConfirm) {
          $.ajax({
            url: '<?php echo base_url(); ?>chapter/delete',
            data: { chapterID:chapterID },
            type: 'POST',
            success: function(data){
              //alert(data);
              swal("Deleted!", "Chapter has been deleted successfully...!", "success");
              $('#chapters_table').DataTable().row(currentRow).remove().draw();
            }
          });
        } else {
          swal("Cancelled", "Chapter's Details are still safe :)", "error");
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $('.pause').on('click', function() 
  {
    jQuery("iframe").each(function(){
      var src = jQuery(this).attr("src");
      jQuery(this).attr("src",src);
    });
  });

  $(document).mouseup(function()
  {
    // console.log('mouseup');
      jQuery("iframe").each(function(){
        var src = jQuery(this).attr("src");
        jQuery(this).attr("src",src);
      });
  });

  var groupingTable = $('#chapters_table').DataTable({
      dom: 'BC<"clear">lfrtip',
      buttons: [
          {
            extend : 'copyHtml5',
            exportOptions: {
               columns: [ 0, ':visible' ]
            }
          },
          {
              extend: 'excelHtml5',
              text: '<i class="fa fa-file-excel-o"></i> Excel',
              titleAttr: 'Export to Excel',
              exportOptions: {
                  columns: ':visible'
              }
          },
          {
              extend: 'csvHtml5',
              text: '<i class="fa fa-file-text-o"></i> CSV',
              titleAttr: 'CSV',
              exportOptions: {
                  columns: ':visible'
              }
          },
          {
              extend: 'pdfHtml5',
              orientation: 'landscape',//landscape give you more space
              pageSize: 'A4',//A0 is the largest A5 smallest(A0,A1,A2,A3,legal,A4,A5,letter))
              exportOptions: {
                  columns: ':visible'
              },
          },
          {
              extend: 'print',
              exportOptions: {
              columns: ':visible'
              }
          }
      ],
      "colVis": {
          "buttonText": "Select Columns"
      },
      responsive: true,
      rowReorder: true,
      "columnDefs": [
          { "visible": false, "targets": 2 },
      ],
      // "order": [[ 2, 'desc' ]],
      "displayLength": 25,
      "drawCallback": function ( settings ) {
          var api = this.api();
          var rows = api.rows( {page:'current'} ).nodes();
          var last=null;

          api.column(2, {page:'current'} ).data().each( function ( group, i ) {
            if ( last !== group ) {
              $(rows).eq( i ).before(
                '<tr class="group"><td colspan="9">'+group+'</td></tr>'
              );

              last = group;
            }
          } );
      }
  } );
  $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
  $('.row-grouping tbody').on( 'click', 'tr.group', function () {
      if (typeof table !== 'undefined' && table.order()[0]) {
          var currentOrder = table.order()[0];
          if ( currentOrder[0] === 5 && currentOrder[1] === 'asc' ) {
              table.order( [ 5, 'desc' ] ).draw();
          }
          else {
              table.order( [ 5, 'asc' ] ).draw();
          }
      }
  });
</script>

</body>
</html>