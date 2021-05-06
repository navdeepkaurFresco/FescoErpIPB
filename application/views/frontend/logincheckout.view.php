<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
	<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
	<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
</head>
<body id="courses-list-sidebar" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php");
$merchant_order_id = time().$itemInfo['id'];
$course_title      = $itemInfo['course_title'];
$amount            = $itemInfo['fee'];
$course_image      = $itemInfo['course_image'];
$txnid 				     = time();
$surl 				     = $surl;
$furl 				     = $furl;
$key_id 			     = RAZOR_KEY_ID;
$name 				     = APPLICATION_NAME;
$currency_code 		 = $currency_code;
$total 				     = ($amount * 100);
?>
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>CHECKOUT</h2>
		</div>
	</div>
	<div class="container view-cart">
		<div class="table-responsive">
			<table id="cart" class="table table-hover table-condensed">
				<thead>
					<tr>
						<th style="width:56%">Product</th>
						<th style="width:16%">Price</th>
						<th style="width:30%" class="text-center">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td data-th="Product">
							<div class="row">
								<div class="col-sm-2 hidden-xs"><img src="<?php echo $course_image; ?>" alt="..." class="img-responsive"/></div>
								<div class="col-sm-10">
									<h4 class="nomargin"><?php echo $course_title; ?></h4>
									<p><?php echo substr($itemInfo['brief_detail'],0 , 100)."....."; ?></p>
								</div>
							</div>
						</td>
						<td data-th="Price"><i class="fa">&#xf156;</i></span><?php echo $amount; ?></td>
						<td data-th="Subtotal" class="text-center"><i class="fa">&#xf156;</i></span><?php echo $amount; ?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td class="hidden-xs text-center"><strong>Total</strong></td>
						<td class="hidden-xs text-center"><strong><i class="fa">&#xf156;</i></span><?php echo $amount; ?></strong></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><button id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-success btn-block"> Pay Now</button></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</main>
<form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
	<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="<?php echo $merchant_order_id; ?>"/>
	<input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
	<input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
	<input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $course_title; ?>"/>
	<input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
	<input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
	<input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $this->session->userdata['fullname']; ?>"/>
	<input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
	<input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('id'); ?>"/>
	<input type="hidden" name="module_id" id="module_id" value="<?php echo $itemInfo['id']; ?>"/>
	<input type="hidden" name="complete_package" id="complete_package" value="0"/>
	<!-- razorpay options -->
	<input type="hidden" name="key_id" id="key_id" value="<?php echo $key_id; ?>"/>
	<input type="hidden" name="name" id="name" value="<?php echo $name; ?>"/>
	<input type="hidden" name="orderdescription" id="orderdescription" value="Order # <?php echo $merchant_order_id; ?>"/>
	<input type="hidden" name="currency_code" id="currency_code" value="<?php echo $currency_code; ?>"/>
</form>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/autocomplete.js" type="text/javascript"></script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtUZEucyyJ-ceAAzcu63KRbem-Zi-W7ZA&libraries=places&callback=initAutocomplete" async defer></script>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
  var razorpay_options = {
    key: $('#key_id').val(),
    amount: $('#merchant_total').val(),
    name: $('#name').val(),
    description: $('#orderdescription').val(),
    netbanking: true,
    currency: $('#currency_code').val(),
    prefill: {
      name:"<?php echo $StudentData['fullname']; ?>",
      email: "<?php echo $StudentData['email']; ?>",
      contact: "<?php echo $StudentData['phone']; ?>"
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
        	// alert('done');
            // location.reload()
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
        alert('done');
  
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