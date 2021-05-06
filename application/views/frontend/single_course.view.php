<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/validation/form-validation.css">
<body id="course-single" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php");

$teacherName = $singleModuleDetails['fullname'];
$chapter_details = $singleModuleDetails['chapter_details'];
$totalChapters = count($chapter_details);
$total_time_duration = $singleModuleDetails['total_time_duration'];
$total_views = '2255';
?>
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2><?php echo $singleModuleDetails['course_title']; ?></h2>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="col-md-8">
					<img src="<?php echo base_url('uploads/').$singleModuleDetails['course_image']; ?>" alt="Course" class="resp-img course-preview">
				</div>
				<div class="col-md-4" style="padding-right: 0;margin-bottom: 10px;">
					<div class="course-widget-price">
            <h4 class="course-title">COURSE FEATURES</h4>
            <ul>
                <li>
                  <i class="fa fa-book" aria-hidden="true"></i>
                  <span>Lessons</span>
                  <span class="time"><?php echo $totalChapters; ?> Chapters</span>
                </li>
                <li>
                  <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                  <span>Duration</span>
                  <span class="time"><?php echo $total_time_duration; ?> Minutes</span>
                </li>
                <!-- <li>
                  <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                  <span>Institution</span>
                  <span class="time">IPB</span>
                </li>
                <li>
                  <i class="fa fa-users" aria-hidden="true"></i>
                  <span>Level</span>
                  <span class="time">All level</span>
                </li> -->
            </ul>
            <h4 class="bt-course">Course Price: <span>₹ <?php echo $singleModuleDetails['fee']; ?></span></h4>
            <?php $buyCourseBtn = '<a class="flat-button" href="'.base_url('checkout/'.encryptID($this->session->userdata('id'),$singleModuleDetails['id'])).'">ENROLL THIS COURSE</a>';
            $readcoursebtn = '<a class="flat-button" href="'.base_url('student/read/more/'.encryptID($this->session->userdata('id'),$singleModuleDetails['id'])).'">READ COURSE</a>';
            if($this->session->userdata('frontendLogin')=='1'){
	            if($this->session->userdata('id'))
							{
								if(!empty($bought_complete_module) && $bought_complete_module['complete_package']==1){
									echo $readcoursebtn;
								}else{
									if($singleModuleDetails['is_bought']=='0'){
										echo $buyCourseBtn;
									}else{
										echo $readcoursebtn;
									}
								}
							}else{
								echo $buyCourseBtn;
							} 
						}else{
							echo $buyCourseBtn;
						} ?>
          </div>
				</div>
				<div class="col-md-12">
					<h3><?php echo $singleModuleDetails['course_title']; ?></h3>
					<p class="class-details">
						<?php 
							if(!empty($totalChapters))
							{
								echo '<span class="lessons"><i class="zmdi zmdi-assignment"></i>'.$totalChapters.' CHAPTERS</span>';
							}

							if(!empty($total_time_duration))
							{
								echo '<span class="duration"><i class="zmdi zmdi-time"></i>'.$total_time_duration.' mins</span>';
							}

							if(!empty($total_views))
							{
								echo '<span class="views"><i class="zmdi zmdi-eye"></i>'.$total_views.' VIEWS</span>';
							}

							if(!empty($totalChapters))
							{
								echo '<span class="tag"><i class="zmdi zmdi-label"></i>PPTs</span>';
							}
						?>
					</p>
					<h4>COURSE DETAILS</h4>
					<p class="abs"><?php echo $singleModuleDetails['brief_detail']; ?></p>
					<h5>What you'll learn ?</h5>	
					<ul class="includes">
						<?php if(!empty($chapter_details))
						{
							foreach($chapter_details as $single_chapter){ ?>
								<li><?php echo $single_chapter['chapter_title']; ?></li>
						<?php }
						} ?>
					</ul>
					<h4>COURSE CONTENT</h4>
					<ul class="course-accordion">
						<?php if(!empty($chapter_details))
						{
							$i = '1';
							foreach($chapter_details as $singleChapter){ ?>
								<li class="accordion-option <?php if($i=='1'){ echo 'opened'; } ?>">	
									<div class="option-title">
										Section #<?php echo $i .": ".$singleChapter['chapter_title']; ?> 
										<span><?php if(!empty($singleChapter['video_url'])){ echo "(1 video)"; } ?></span>
										<div class="pull-right">
											<span class="duration"><?php echo $singleChapter['time_duration']." mins"; ?></span>
										</div>
									</div>
									<div class="option-wrapper">
										<ul class="option-items">
											<li class="option-item">
												<p><?php echo $singleChapter['chapter_description']; ?></p>
											</li>								
										</ul>
									</div>
								</li>
							<?php $i++;
							}
						} ?>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="pros" style="background: #fff;">
					<h4>ABOUT THE TEACHER</h4>
					<div class="teacher text-center">
						<div class="imgcontainer">
							<img src="<?php echo base_url('uploads/').$singleModuleDetails['profile_image']; ?>" alt="Avatar">
						</div>
						<a href="#"><?php echo $teacherName; ?></a>
						<p><?php echo $singleModuleDetails['designation']; ?></p>
					</div>
				</div>
				<div class="ratings">
					<h4>COURSE RATINGS</h4>
					<div class="rating">
						<?php $reviews = ($singleModuleDetails['total_reviews']=='1' || $singleModuleDetails['total_reviews'] =='0') ? $singleModuleDetails['total_reviews']." Review" : $singleModuleDetails['total_reviews']." Reviews" ;
					
					$rating = (empty($singleModuleDetails['rating'])) ? '0' : $singleModuleDetails['rating'] ;
          
          $ratingstars = '';
          for ($ii=0; $ii < 5; $ii++)
          { 
            if($ii<=$rating){
              $ratingstars .='<a href="#" class="on"><i class="zmdi zmdi-star zmdi-hc-2x"></i></a>';
            }else
            {
              $ratingstars .='<a href="#"><i class="zmdi zmdi-star zmdi-hc-2x"></i></a>';
            }
          }
          echo $ratingstars;
          ?>
					</div>
					<p>(<strong><?php echo $singleModuleDetails['rating']; ?></strong> out of <?php echo $reviews; ?>)</p>
				</div>
				<?php if(!empty($popularCourses)){
							foreach ($popularCourses as $single) {
								//echo '';
							}
						}?>
				<div class="popular-courses index-3-categories side">
					<h4>POPULAR COURSES</h4>
					<div class="courses-side-slick">
						<div class="category-with-bg text-center cat1">
							<h5>Introduction to Banking</h5>
							<p>IT-Service for CMS like WordPress</p>
							<a href="#" class="goto"><i class="zmdi zmdi-long-arrow-right"></i></a>
						</div>
						<div class="category-with-bg text-center cat2">
							<h5>Role of RBI & its Relationship with Banks</h5>
							<p>Workshop for UX Design</p>
							<a href="#" class="goto"><i class="zmdi zmdi-long-arrow-right"></i></a>
						</div>
						<div class="category-with-bg text-center cat3">
							<h5>AML & KYC, CFT</h5>
							<p>Work with InDesign</p>
							<a href="#" class="goto"><i class="zmdi zmdi-long-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/app-assets/js/scripts/forms/validation/form-validation.js" type="text/javascript"></script>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>