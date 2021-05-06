<?php include(dirname(dirname(__FILE__))."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/sweetalert.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/colors/palette-gradient.css">
<link href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"  rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <h3 class="content-header-title mb-0">All Transactions Reports</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('reports/transaction'); ?>">Transactions</a>
              </li>
              <li class="breadcrumb-item active">
                All Transactions Reports
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section class="line-chart">
        <div class="row">
          <div class="col-7">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Graphical Representation of Transactions</h4>
                <div id="transaction-line-chart"></div>
              </div>
            </div>
          </div>
          <div class="col-5">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Module vice Transactions Details</h4>
                <div id="transaction-donut-chart" class="height-300"></div>
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
                <div class="row col-md-12">
                  <div class="col-md-3 mt-1">
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
                  <table id="transactions_table" class="table table-striped table-responsive table-bordered base-style file-export" style="width: 100% !important;">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>Order ID</th>
                        <th>Payment ID</th>
                        <th>Payment Method</th>
                        <th>User Details</th>
                        <th>Module Details</th>
                        <th>Amount</th>
                        <th>Order Description</th>
                        <th>Reg. Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if(!empty($allTransactions)){
                        foreach($allTransactions as $SingleTransactionDetails)
                        {
                          $PaymentID = encryptID($this->session->userdata('id'),$SingleTransactionDetails['id']); ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $SingleTransactionDetails['order_id']; ?>
                        <td><a href="<?php echo base_url('invoice/details/'.$PaymentID); ?>"><?php echo $SingleTransactionDetails['payment_id']; ?></a></td>
                        <td><?php echo $SingleTransactionDetails['payment_method']; ?>
                        </td>
                        <td><ul>
                          <li><?php echo $SingleTransactionDetails['fullname']; ?></li>
                          <li><a href="mailto:<?php echo $SingleTransactionDetails['user_email']; ?>"><?php echo $SingleTransactionDetails['user_email']; ?></a></li>
                          <li><?php echo $SingleTransactionDetails['user_contact']; ?></li>
                        </ul></td>
                        <td><?php echo $SingleTransactionDetails['course_title']; ?></td>
                        <td><?php echo $SingleTransactionDetails['currency']." ".$SingleTransactionDetails['order_total']; ?></td>
                        <td><?php echo $SingleTransactionDetails['order_description']; ?></td>
                        <td><?php echo date('jS F, Y h:i:s A', strtotime($SingleTransactionDetails['created_at'])) ; ?></td>
                      </tr>
                      <?php  $i++; } }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <td>Order ID</td>
                        <td>Payment ID</td>
                        <td>Payment Method</td>
                        <td>User Details</td>
                        <td>Module Details</td>
                        <td>Amount</td>
                        <td>Order Description</td>
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
<script src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"  type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.select.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/tables/datatable/dataTables.colVis.js" type="text/javascript"></script>
<script src="/app-assets/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>
<!-- JS for Donut chart -->
<script src="/app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
<script src="/app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'right'
  },
  function(start, end, label) {
    $('.daterangepicker').on('click','.applyBtn', function()
    {
      var selectedRange = $('input[name="daterange"]').val(); console.log(selectedRange);

      $.ajax({
        url: '<?php echo base_url("reports/getfiltertransactions"); ?>',
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
  $('#transactions_table tfoot td').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
  });

  // DataTable
  var table = $('#transactions_table').DataTable();

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
    ['Year','Total no. of Transactions'],
    <?php echo $LinechartContent; ?>
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
  var line = new google.visualization.LineChart(document.getElementById('transaction-line-chart'));
  line.draw(data, options_line);
}

$(window).on("load", function() {
    Morris.Donut({
        element: "transaction-donut-chart",
        data: [
        <?php echo $donutchartContent; ?>
        ],
        resize: !0,
        colors: ["#02A5A8", "#F67D4D", "#F44558", "#653E82","#EEA5A8", "#AF7D4D", "#FF4328", "#626E82","#00A5A8", "#FF7D4D", "#FF4558", "#6E6E82"]
    })
});
</script>
</body>
</html>