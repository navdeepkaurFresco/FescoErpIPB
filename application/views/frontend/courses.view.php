<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<body id="courses-list-sidebar" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>
<main>
	<div class="page-heading text-center">
		<div class="container">			
			<h2>OUR COURSES</h2>
		</div>
	</div>
	<div class="container index-3-categories text-center user-type-courses-details">
		<div class="row">
			<ul class="nav nav-tabs responsive " role="tablist">
				<li class="nav-item active">
					<a class="nav-link frontend-courses-tabs" data-toggle="tab" href="#freshers" role="tab">Courses for <strong>FRESHERS</strong></a>
				</li>
				<li class="nav-item">
					<a class="nav-link frontend-courses-tabs" data-toggle="tab" href="#bankers" role="tab">Courses for <strong>BANKERS</strong></a>
				</li>
			</ul>
			<div class="tab-content responsive">
				<div class="tab-pane active" id="freshers" role="tabpanel">
					<div class="container-fluid">
						<div class="row user-type-descriptions">
							<h4>Who will select the complete package as a Fresher?</h4> 
							<p>1.	If you are a  fresh graduate or Post graduate and age is less than 28 years</p>
							<p>2.	If you have prior experience  after your graduation or Post graduate and age is less than 28 years but still seeking for the opportunity in the banking sector</p>
							<a href="<?php echo base_url('complete-package'); ?>" class="btn btn-success" style="margin-top: 20px;">View Complete package</a>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="bankers" role="tabpanel">
					<div class="container-fluid">
						<div class="row user-type-descriptions">
							<h4>Who is a BANKER?</h4> 
							<p>Bankers can purchase modules to get promoted in their correspodence field.</p>
							<a href="<?php echo base_url('all/courses'); ?>" class="btn btn-success" style="margin-top: 20px;">View All Modules</a>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- <div class="row" style="margin-bottom: 2%;">
			<div class="col-sm-10 col-sm-offset-1">
				<h3>IPB Modules / Courses</h3>				
			</div>
		</div>
		<div class="row">
			<?php if(!empty($allModules))
			{
				$this->load->view('frontend/module.view.php',$allModules);
			}
			?>
		</div> -->
	</div>
</main>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>