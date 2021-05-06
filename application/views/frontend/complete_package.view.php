<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<body id="courses-list-sidebar" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>
<main>
	<div class="page-heading text-center">
		<div class="container">			
			<h2>Complete Module Package</h2>
		</div>
	</div>
	<div class="container index-3-categories text-center user-type-courses-details">
		<div class="row">
			<table class="table table-bordered all-modules-table">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Module Title</th>
						<th>Duration</th>
						<th>Fee</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($allModules)){
						$i=1;
						$totalfee = $discountval = 0;
						foreach ($allModules as $singleModule) {
							$classname = ($i%2==0) ? 'even' : 'odd';
							$totalfee += $singleModule["fee"];
							$discountval = $totalfee*20/100;
							$cartTotal = $totalfee-$discountval;
							echo '<tr class="'.$classname.'row">
											<td>'.$i++.'</td>
											<td>'.$singleModule["course_title"].'</td>
											<td>'.$singleModule["time_duration"].' Months</td>
											<td><i class="fa fa-rupee"></i> '.$singleModule["fee"].'</td>
										</tr>';
						}
						echo '<tr class="coursesumrow">
										<td rowspan="4" colspan="2"></td>
										<td>Cart Sum</td>
										<td><i class="fa fa-rupee"></i> '.$totalfee.'</td>
									</tr>
									<!-- <tr class="coursesumrow">
										<td> Discount (-20%) </td>
										<td><i class="fa fa-rupee"></i> '.$discountval.'</td>
									</tr> -->
									<tr class="coursesumrow">
										<td> Cart Total </td>
										<td><i class="fa fa-rupee"></i> '.$totalfee.'</td>
									</tr>
									<tr class="coursesumrow">
										<td colspan="2">';
										if( $this->session->userdata('frontendLogin')=='1' && $this->session->userdata('id')){
											echo '<button id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary col-md-6" style="margin: 0 25% !important;" > Pay Now</button>';
										}else{
											echo '<a style="margin: 0 25% !important;" class="btn btn-primary col-md-6" href="'.base_url('checkout/'.encryptID($this->session->userdata('id'),'CP')).'">View Cart</a>';
										}
										echo '</td></tr>';
					}else{
						echo '<tr><td colspan="4">No Modules found...!!!</td></tr>';
					}?>
				</tbody>
			</table>
		</div>
	</div>
</main>
<?php 
	$merchant_order_id= time();
	$txnid            = time();
	$surl             = $surl;
	$furl             = $furl;        
	$key_id           = RAZOR_KEY_ID;
	$name             = APPLICATION_NAME;
	$currency_code    = $currency_code;
	$total            = ($totalfee * 100);
	$email            = $StudentData['email'];
	$phone            = $StudentData['phone'];
	$card_holder_name = $StudentData['fullname'];
?>
<form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="Complete module Package"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $cartTotal; ?>"/>
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('id'); ?>"/>
  <input type="hidden" name="module_id" id="module_id" value="0"/>

  <input type="hidden" name="complete_package" id="complete_package" value="1"/>
</form>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };
  var razorpay_submit_btn, razorpay_instance;
 
  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';  
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }  
</script>