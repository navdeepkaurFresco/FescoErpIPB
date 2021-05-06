<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"  rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <h3 class="content-header-title mb-0">All Enquiry Reports</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('reports/transaction'); ?>">Enquiry</a>
              </li>
              <li class="breadcrumb-item active">
                All Enquiry Reports
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="padding-bottom: 0px !important;">
                <h4 class="card-title">Graphical Representation of Enquiry Details</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <div class="card-body">
                  <div id="enquiry-line-chart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section id="file-export">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-content">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Select date</label>
                      <input class="form-control" type="text" name="daterange" value="<?php echo date('m/d/Y')." - ". date('m/d/Y'); ?>" />
                    </div>
                  </div>
                </div>
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
                  <table id="enquery_report_table" class="table table-striped table-bordered base-style table-responsive" style="width: 100% !important;">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Enquiry Subject</th>
                        <th>Enquiry Message</th>
                        <th>Sender Name</th>
                        <th>Sender Email</th>
                        <th>Sender Phone</th>
                        <th>Sender Address</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($AllEnqueries))
                    {
                      echo '<tr><td>No Data Found..!!</td></tr>';
                    }else
                    {
                      $x = '1';
                      foreach ($AllEnqueries as $singleEnquery) {
                    ?>
                    <tr>
                      <td><?php echo $x; ?></td>
                      <td><?php echo $singleEnquery['enquiry_subject']; ?></td>
                      <td><?php echo $singleEnquery['enquiry_message']; ?></td>
                      <td><?php echo $singleEnquery['sender_name']; ?></td>
                      <td><?php echo $singleEnquery['sender_email']; ?></td>
                      <td><?php echo $singleEnquery['sender_phone']; ?></td>
                      <td><?php echo $singleEnquery['sender_state']; ?></td>
                      <td><?php echo date('d/m/y', strtotime($singleEnquery['created_at']) );?></td>
                    </tr>
                    <?php
                     $x++; }
                    }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <td>Enquiry Subject</td>
                        <td>Enquiry Message</td>
                        <td>Sender Name</td>
                        <td>Sender Email</td>
                        <td>Sender Phone</td>
                        <td>Sender Address</td>
                        <td>Date</td>
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
<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"  type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.colVis.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>

<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'right'
  }, function(start, end, label) {
    $('.daterangepicker').on('click','.applyBtn', function()
    {
      var selectedRange = $('input[name="daterange"]').val(); //console.log(selectedRange);
      $.ajax({
        url: '<?php echo base_url("reports/getfilterenquiries"); ?>',
        type: 'post',
        data: {selectedDates: selectedRange},
        success: function(response){
          console.log(response);
          $('#updateContent').html(response);
        }
      })
    });
  });
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
/***************************************************************
*       js of Individual column searching (text inputs)        *
***************************************************************/
  // Setup - add a text input to each cell
  $('#enquery_report_table tfoot td').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
  });

  // DataTable
  var table = $('#enquery_report_table').DataTable({
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

//end of document.ready
});
</script>
<script src="https://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
// Line chart
// ------------------------------

// Load the Visualization API and the corechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawLine);

// Callback that creates and populates a data table, instantiates the line chart, passes in the data and draws it.
function drawLine()
{
  // Create the data table.
  var data = google.visualization.arrayToDataTable([
    ['Year','Total no. of Enquiries'],
    <?php echo $EnqueryLinechart; ?>
  ]);

  // Set chart options
  var options_line = {
    height: 300,
    fontSize: 12,
   // curveType: 'function',
    colors: ['#DA4453'],
    pointSize: 5,
    chartArea: {
      left: '5%',
      width: '90%',
      height: 250
    },
    vAxis: {
      gridlines:{
        color: '#e9e9e9',
        count: 10
      },
      minValue: 0
    },
    legend: {
      position: 'top',
      alignment: 'center',
      textStyle: {
        fontSize: 12
      }
    }
  };

  // Instantiate and draw our chart, passing in some options.
  var line = new google.visualization.LineChart(document.getElementById('enquiry-line-chart'));
  line.draw(data, options_line);

}
</script>
</body>
</html>