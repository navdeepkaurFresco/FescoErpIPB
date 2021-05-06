<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/extensions/dataTables.colVis.css">
<table id="filtered_enquery_table" class="table table-striped table-responsive table-bordered base-style" style="width: 100% !important;">
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
  <?php if(empty($filterEnqueries))
  {
    echo '<tr><td>No Data Found..!!</td></tr>';
  }else
  {
    $x = '1';
    foreach ($filterEnqueries as $singleEnquery) {
  ?>
  <tr>
    <td><?php echo $x; ?></td>
    <td><?php echo $singleEnquery['enquiry_subject']; ?></td>
    <td><?php echo $singleEnquery['enquiry_message']; ?></td>
    <td><?php echo $singleEnquery['sender_name']; ?></td>
    <td><?php echo $singleEnquery['sender_email']; ?></td>
    <td><?php echo $singleEnquery['sender_phone']; ?></td>
    <td><?php echo $singleEnquery['sender_address']; ?></td>
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
/***************************************************************
*       js of Individual column searching (text inputs)        *
***************************************************************/
  // Setup - add a text input to each cell
  $('#filtered_enquery_table tfoot td').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
  });

  // DataTable
  var table = $('#filtered_enquery_table').DataTable({
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