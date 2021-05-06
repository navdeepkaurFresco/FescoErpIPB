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
		<div class="row" style="margin-bottom: 2%;">
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
		</div>
	</div>
</main>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>