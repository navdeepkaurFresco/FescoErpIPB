<?php include(dirname(__FILE__)."/includes/student_head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/ui/prism.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/menu/menu-types/vertical-content-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/app-assets/vendors/css/pickers/daterange/newDaterangepicker.css">
<style type="text/css">
button.btn.btn-link.display-inline.font-medium-3 {
    background-color: #ededed;
    width: 100%;
    text-align: left;
    margin-bottom: 10px;
}
#accordionExample .card-header {
    padding: 5px 1.5em;
}
.card-text.faq-description {
    border: 1px solid #ccc;
    padding: 5px 15px 1px;
    color: #000;
}
</style>
</head>
<body class="vertical-layout vertical-content-menu 2-columns student-panel menu-expanded fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
<?php include(dirname(__FILE__)."/includes/student_header.php"); ?>
<div class="app-content content">
  <div class="content-wrapper">
    <?php include(dirname(__FILE__)."/includes/student_sidebar.php"); ?>
    <div class="content-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-content">
              <section id="faq-search">
                <div class="row">
                  <div class="col-12">
                    <div class="card bg-success white">
                      <div class="card-content text-center">
                        <div class="card-header">
                          <h1 class="white mt-4 ">
                            We're here to help !!
                          </h1>
                        </div>
                        <br><br>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="faq">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="accordion" id="accordionExample">
                        <div class="card">
                          <?php if (!empty($faqs_details)) {
                            $xx = '1';
                            foreach ($faqs_details as $single_faqs_details) { ?>
                          <div class="card-header" id="hd_<?php echo $single_faqs_details['id']; ?>">
                            <button aria-controls="collapse_<?php echo $single_faqs_details['id']; ?>"aria-expanded="<?php if($single_faqs_details['question_order'] == 1) echo 'true'; ?>" class="btn btn-link display-inline font-medium-3 <?php if($single_faqs_details['question_order'] != 1) echo 'collapsed'; ?>" data-target="#collapse_<?php echo $single_faqs_details['id']; ?>" data-toggle="collapse" type="button">
                            <?php echo $xx.".) ". $single_faqs_details['title']; ?>
                            </button>
                            <div aria-labelledby="hd_<?php echo $single_faqs_details['id']; ?>" class=" <?php if($single_faqs_details['question_order'] != 1) echo 'collapse'; ?>" data-parent="#accordionExample" id="collapse_<?php echo $single_faqs_details['id']; ?>" style="">
                              <div class="card-text faq-description">
                                <?php echo $single_faqs_details['description']; ?>
                              </div>
                            </div>
                          </div>
                          <?php $xx++;  } } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include(dirname(__FILE__)."/includes/student_footer.php"); ?>
<script src="<?php echo base_url()?>/app-assets/vendors/js/ui/headroom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url()?>/app-assets/vendors/js/ui/prism.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>/app-assets/vendors/js/pickers/daterange/cdn_daterangepicker.js" type="text/javascript"></script>
</body>
</html>