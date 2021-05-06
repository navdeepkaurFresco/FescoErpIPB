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
<body class="vertical-layout vertical-compact-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
<?php include(dirname(dirname(__FILE__))."/includes/header.php"); ?>
<?php include(dirname(dirname(__FILE__))."/includes/sidebar.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <h3 class="content-header-title mb-0">All Sales Reports</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/home'); ?>">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="<?php echo base_url('reports/sales'); ?>">Sales</a>
              </li>
              <li class="breadcrumb-item active">
                All Sales Reports
              </li>
            </ol>
          </div>
        </div>
      </div>
      <div class="content-header-right col-md-3 col-12"></div>
    </div>
    <div class="content-body">
      <div class="row">
        <div class="sales-widgets col-lg-6 col-12">
          <div class="card bg-gradient-directional-danger">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-white text-left">
                    <h3 class="text-white"><?php echo $lastyear;?></h3>
                    <span>Previous Years Selling</span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-pointer text-white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="sales-widgets col-lg-6 col-12">
          <div class="card bg-gradient-directional-success">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-white text-left">
                    <h3 class="text-white"><?php echo $lastmonths; ?></h3>
                    <span>Previous Months Selling</span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-cup text-white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="sales-widgets col-lg-6 col-12">
          <div class="card bg-gradient-directional-warning">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-white text-left">
                    <h3 class="text-white"><?php echo $thismonth; ?></h3>
                    <span>Current Month Selling</span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-plane text-white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="sales-widgets col-lg-6 col-12">
          <div class="card bg-gradient-directional-info">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-white text-left">
                    <h3 class="text-white"><?php echo $todaycount; ?></h3>
                    <span>Today's Selling</span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-star text-white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="sales-widgets col-lg-6 col-12">
          <div class="card bg-gradient-directional-amber">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-white text-left">
                    <h3 class="text-white"><?php echo $totalselling; ?></h3>
                    <span>Total Selling</span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-plane text-white font-large-2 float-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <section class="line-chart">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Graphical Representation of Sales</h4>
                <div id="sales-stacked-bar-chart"></div>
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
                        <th>User Details</th>
                        <th>DOB</th>
                        <th>Location</th>
                        <th>Qualifications</th>
                        <th>Reg. Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if(!empty($SalesReport)){
                        foreach($SalesReport as $Singlesale)
                        {
                        $date_1 = new DateTime($Singlesale['dob']);
                        $date_2 = new DateTime( date( 'Y-m-d' ) );
                        $difference = $date_2->diff( $date_1 );
                        $age = (string)$difference->y;
                        $PaymentID = encryptID($this->session->userdata('id'),$Singlesale['id']);
                        $dob = $Singlesale['dob'];
                        ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $Singlesale['order_id']; ?>
                        <td>
                          <ul>
                            <li><?php echo $Singlesale['fullname']; ?></li>
                            <li><a href="mailto:<?php echo $Singlesale['user_email']; ?>"><?php echo $Singlesale['user_email']; ?></a></li>
                            <li><?php echo $Singlesale['user_contact']; ?></li>
                          </ul>
                        </td>
                        <td><?php echo ($dob=='0000-00-00') ? '' : date('jS F, Y', strtotime($dob)) ." ( ". $age ." years )"; ?></td>
                        <td><?php echo $Singlesale['city']; ?></td>
                        <td><?php echo $Singlesale['qualification']; ?></td>
                        <td><?php echo date('jS F, Y', strtotime($Singlesale['saledate'])) ; ?></td>
                      </tr>
                      <?php  $i++; } }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <td>Order ID</td>
                        <td>User Details</td>
                        <td>DOB</td>
                        <td>Location</td>
                        <td>Qualifications</td>
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
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js" type="text/javascript"></script>
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
  },
  function(start, end, label) {
    $('.daterangepicker').on('click','.applyBtn', function()
    {
      var selectedRange = $('input[name="daterange"]').val();

      $.ajax({
        url: '<?php echo base_url("reports/getfiltersales"); ?>',
        type: 'post',
        data: {selectedDates: selectedRange},
        success: function(response)
        {
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
google.load('visualization', '1.0', {'packages':['corechart']});
google.setOnLoadCallback(drawBarStacked);
function drawBarStacked()
{
    var data = google.visualization.arrayToDataTable([
        [ 'Genre', <?php echo $getModuleTitles; ?> ],
        <?php echo $getModuleSales; ?>
    ]);

    // Set chart options
    var options_bar_stacked = {
        height: 400,
        fontSize: 12,
        colors: ['#99B898','#FECEA8', '#FF847C', '#474747', '#E84A5F', '#b7b8c2', '#f1a9fc', '#0e635a', '#f99909', '#46f4e3', '#edbe74', '#83c8ef'],
        chartArea: {
          left: '5%',
          width: '90%',
          height: 350
        },
        bars: 'vertical',
        isStacked: true,
        hAxis: {
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
    var bar = new google.visualization.BarChart(document.getElementById('sales-stacked-bar-chart'));
    bar.draw(data, options_bar_stacked);
}
</script>
</body>
</html>