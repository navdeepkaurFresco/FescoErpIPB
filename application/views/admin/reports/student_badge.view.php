<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <h3 class="content-header-title mb-0">Badge Vice Student Report</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('reports/sales'); ?>">Student Report</a>
              </li>
              <li class="breadcrumb-item active">
                Badge Vice Student Report
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
                <div class="card-body">
                  <?php if($this->session->flashdata('item')) {
                    $message = $this->session->flashdata('item'); ?>
                    <div class="alert alert-<?php echo $message['class']; ?> alert-dismissible mb-2" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <?php echo $message['message']; ?>
                    </div>
                  <?php } ?>
                  <table id="student_badge_table" class="table table-striped table-responsive table-bordered base-style" style="width: 100% !important; ">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>User Details</th>
                        <th>DOB</th>
                        <th>Location</th>
                        <th>Qualifications</th>
                        <th>Badge</th>
                        <th>Reg. Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if(!empty($StudentBadgeReport)){
                        foreach($StudentBadgeReport as $SingleReport)
                        {
                          $date_1 = new DateTime($SingleReport['dob']);
                          $date_2 = new DateTime( date( 'Y-m-d' ) );
                          $difference = $date_2->diff( $date_1 );
                          $age = (string)$difference->y;
                          $PaymentID = encryptID($this->session->userdata('id'),$SingleReport['id']);
                          $overall_marks = ($SingleReport['overall_marks'] != NULL) ? round($SingleReport['overall_marks']) : 0 ;
                          $badge = '';
                          if($overall_marks > 80){ $badge = 'Gold'; }
                          if($overall_marks > 50 && $overall_marks < 80){ $badge = 'Silver'; }
                          if($overall_marks < 50){ $badge = 'Bronze'; }
                          $dob = $SingleReport['dob'];
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><ul>
                          <li><?php echo $SingleReport['fullname']; ?></li>
                          <li><a href="mailto:<?php echo $SingleReport['email']; ?>"><?php echo $SingleReport['email']; ?></a></li>
                          <li><?php echo $SingleReport['phone']; ?></li>
                        </ul></td>
                        <td><?php echo ($dob='0000-00-00') ? '' : date('jS F, Y', strtotime($dob)) ." ( ". $age ." years )"; ?></td>
                        <td><?php echo $SingleReport['city']; ?></td>
                        <td><?php echo $SingleReport['qualification']; ?></td>
                        <td><?php echo $badge; ?></td>
                        <td><?php echo date('jS F, Y', strtotime($SingleReport['created_by'])) ; ?></td>
                      </tr>
                      <?php  $i++; } }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <td>User Details</td>
                        <td>DOB</td>
                        <td>Location</td>
                        <td>Qualifications</td>
                        <td>Badge</td>
                        <td>Reg. Date</td>
                      </tr>
                    </tfoot>
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
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.colVis.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('#student_badge_table tfoot td').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
  });

  // DataTable
  var table = $('#student_badge_table').DataTable({
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
    }
  })
  $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');


  // Apply the search
  table.columns().every( function ()
  {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change', function ()
    {
      if ( that.search() !== this.value )
      {
        that
        .search( this.value )
        .draw();
      }
    });
  });
});
</script>
</body>
</html>