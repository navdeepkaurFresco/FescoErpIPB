<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<table id="filtered_sales" class="table table-striped table-responsive table-bordered base-style file-export" style="width: 100% !important;">
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
    <?php $i=1; if(!empty($filtersales)){
      foreach($filtersales as $Singlesale)
      {
        $date_1 = new DateTime($Singlesale['dob']);
        $date_2 = new DateTime( date( 'Y-m-d' ) );
        $difference = $date_2->diff( $date_1 );
        $age = (string)$difference->y;
        $dob = $Singlesale['dob'];
        $PaymentID = encryptID($this->session->userdata('id'),$Singlesale['id']);
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $Singlesale['order_id']; ?>
      <td><ul>
        <li><?php echo $Singlesale['fullname']; ?></li>
        <li><a href="mailto:<?php echo $Singlesale['user_email']; ?>"><?php echo $Singlesale['user_email']; ?></a></li>
        <li><?php echo $Singlesale['user_contact']; ?></li>
      </ul></td>
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
  // Setup - add a text input to each cell
  $('#filtered_sales tfoot td').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
  });

  // DataTable
  var table = $('#filtered_sales').DataTable();

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