<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel-body menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
  <?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
      <div class="content-body">
        <section class="singlecourse">
          <div class="row match-height">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4><?php echo $singleCourseDetails['course_title']; ?></h4>
                  <div class="heading-elements mt-2">
                    <button onclick="goBack()" class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">
                    <i class="ft-arrow-left"></i> Go Back
                    </button>
                  </div>
                </div>
                <div class="row student">
                  <div class="col-md-7">
                    <div class="card-header instructor-course-details-page">
                      <img src="<?php echo base_url("uploads/".$singleCourseDetails['course_image']); ?>" alt="<?php echo $singleCourseDetails['course_title']; ?>">
                    </div>
                  </div>
                  <div class="col-xl-5 col-md-5 col-5 ">
                    <ul class="chapters-detail-tags">
                      <div class="needs-validation text-center" style="margin-bottom: 4%;">
                          <button id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary box-shadow-2 round btn-min-width"> Pay Now</button>
                      </div>
                      <li><h6><i class="la la-rupee"></i> <?php echo $singleCourseDetails['fee']; ?></h6></li>
                      <li><h6><i class="la la-tag"></i> PPTs</h6></li>
                      <li><h6><i class="la la-hourglass"></i> <?php echo $singleCourseDetails['time_duration']." months";?></h6></li>
                      <?php $totalChapters = count($singleCourseDetails['chapter_details']);
                        if(!empty($totalChapters)){
                          $ifval = ($totalChapters==1) ? $totalChapters.' Chapter' : $totalChapters." Chapters" ;
                          echo '<li><h6><i class="la la-list"></i> '.$ifval.'</h6></li>';
                        }
                        ?>                          
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div class="row student">
                      <div class="card-text brief_detail">
                        <?php echo $singleCourseDetails['brief_detail']; ?>
                      </div>              
                    </div>
                    <?php 
                      $merchant_order_id= time().$singleCourseDetails['id'];
                      $course_title     = $singleCourseDetails['course_title'];
                      $amount           = $singleCourseDetails['fee'];
                      $course_image     = $singleCourseDetails['course_image'];
                      $txnid            = time();
                      $surl             = $surl;
                      $furl             = $furl;        
                      $key_id           = RAZOR_KEY_ID;
                      $name             = APPLICATION_NAME;
                      $currency_code    = $currency_code;
                      $total            = ($amount * 100);
                      $email            = $StudentData['email'];
                      $phone            = $StudentData['phone'];
                      $card_holder_name = $StudentData['fullname']; ?>
                  <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="<?php echo $merchant_order_id; ?>"/>
                    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
                    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
                    <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $course_title; ?>"/>
                    <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
                    <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
                    <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
                    <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
                    <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('id'); ?>"/>
                    <input type="hidden" name="module_id" id="module_id" value="<?php echo $singleCourseDetails['id']; ?>"/>
                    <input type="hidden" name="complete_package" id="complete_package" value="0"/>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
  <script src="<?php echo base_url()?>/app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url()?>/app-assets/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
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
</body>
</html>