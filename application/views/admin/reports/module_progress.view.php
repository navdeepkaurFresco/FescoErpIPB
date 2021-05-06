<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"  rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
<style>
span.persent
{
  display: none;
}
.progress:hover span.persent {
  display: block;
  position: absolute;
  font-size: 20px;
}
</style>
</head>
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <h3 class="content-header-title mb-0">Student's Module Progress Reports</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('reports/student/module'); ?>">Student Report</a>
              </li>
              <li class="breadcrumb-item active">
                Student's Module Progress Reports
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="file-export">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-content">
                <div class="card-body" id="updateContent">
                  <?php if($this->session->flashdata('item')) {
                    $message = $this->session->flashdata('item'); ?>
                    <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <?php echo $message['message']; ?>
                    </div>
                  <?php } ?>
                  <table id="invoices-list" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle" style="width: 100% !important; ">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Module Name</th>
                        <th>Student Name</th>
                        <th>Progress</th>
                        <th style="display: none;">extra</th>
                      </tr>
                      <tr>
                        <th style="visibility: hidden;">#</th>
                        <th>Module Name</th>
                        <th>Student Name</th>
                        <th>Progress</th>
                        <th style="display: none;">extra</th>
                      </tr>
                    </thead>
                    <tbody><?php if(!empty($ModuleProgressReport)){
                      $a = '1';
                      foreach ($ModuleProgressReport as $key => $value) {

                        $total_chapters = $value['total_chapters'];
                        $module_progress = $value['module_progress'];
                        $progressbar = ($total_chapters != 0) ? round($module_progress/$total_chapters*100) : 0;

                        if ($progressbar<='33') { $progressbarClass = 'danger'; } 
                        if ($progressbar>='33' && $progressbar<='66') { $progressbarClass = 'primary'; } 
                        if ($progressbar>='66') { $progressbarClass = 'success'; }

                        echo '<tr><td>'.$a.'</td>
                        <td>
                          <span class="badge badge-default badge-success badge-lg">'.$value["course_title"].'</span>
                        </td>
                        <td>'.$value["fullname"].'</td>
                        <td style="display: none;">'.$progressbar.'</td>
                        <td><div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-'.$progressbarClass.'" role="progressbar" style="width: '.$progressbar.'%" aria-valuenow="'.$progressbar.'" aria-valuemin="0" aria-valuemax="100"></div>
                            
                          </div>
                        </td>
                        </tr>';//<span class="persent">'.$progressbar.'%</span>
                      $a++; }
                    }?>
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
<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"  type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.flash.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/jszip.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/pdfmake.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/vfs_fonts.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.html5.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/buttons.print.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

  var groupingTable = $('.row-grouping').DataTable({
      responsive: true,
      rowReorder: true,
      "columnDefs": [
          { "visible": false, "targets": 1 },
      ],
      // "order": [[ 2, 'desc' ]],
      "displayLength": 25,
      "drawCallback": function ( settings ) {
        var api = this.api();
        var rows = api.rows( {page:'current'} ).nodes();
        var last=null;

        api.column(1, {page:'current'} ).data().each( function ( group, i ) {
            if ( last !== group ) {
              $(rows).eq( i ).before(
                '<tr class="group"><td colspan="4">'+group+'</td></tr>'
              );
              last = group;
            }
        } );
      },
      initComplete: function () {
        this.api().columns().every( function () {
            var column = this;
            var select = $('<select><option value="">Select option</option></select>')
                .appendTo( $(column.header()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' );
            } );
        } );
    }
  });

  $('.row-grouping tbody').on( 'click', 'tr.group', function () {
    if (typeof table !== 'undefined' && table.order()[0]) {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === 5 && currentOrder[1] === 'asc' ) {
        table.order( [ 5, 'desc' ] ).draw();
      }
      else
      {
        table.order( [ 5, 'asc' ] ).draw();
      }
    }
  });
});
</script>
</body>
</html>