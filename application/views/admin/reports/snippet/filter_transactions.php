<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<table id="filtered_transactions" class="table table-striped table-responsive table-bordered base-style file-export" style="width: 100% !important;">
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
    <?php $i=1; if(!empty($filterTransactions)){
      foreach($filterTransactions as $SingleTransactionDetails)
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
  $('#filtered_transactions tfoot td').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
  });

  var table = $('#filtered_transactions').DataTable();

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