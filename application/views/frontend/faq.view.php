<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<body id="course-single" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>FAQs</h2>
		</div>
	</div>
	<div class="container">
		<div class="faq">
			<h4 style="margin-top: 0;">Frequently Asked Questions</h4>
			<p>It's a human tendency to raise doubts as you grow in age. However, for a youngster who is trying to get out of his shell and step into the world of corporate or professionalism, he/she is more concerned about his upcoming endeavors in professional life. </p>
			<p>This age is one such age where taking an impulsive decision or taking a decision that is not properly planned or thought of, may end up in drastic failures or a disturbed life. </p>
			<p>If you are a youngster who is seeking answers related to professional career, this is a must-read. Following are some basic doubts that every youngster has in their mind and supports the need of training and certification. </p>
		</div>
		<div class="panel-group acc" id="accordion">
			<?php if(!empty($faqContent)){
				$i=1;
				foreach ($faqContent as $singleFAQ) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>"><b>Q<?php echo $i; ?>)</b> <?php echo $singleFAQ['title']; ?></a>
							</h1>
						</div>
						<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php echo ($i==1) ? 'in' : ''; ?>">
							<div class="panel-body">
								<h2><b>Answer:</b></h2><?php echo $singleFAQ['description']; ?>
							</div>
						</div>
					</div><?php $i++;
				} 
			} ?>
		</div>
		<h6 style="font-size: 20px;font-weight: normal;padding: 20px 0;line-height: 30px;">For any further queries and doubts, we have toll-free number (…………) and Live chat option. You can raise your  concerns there. Also you can write on our e-mail Id -<b style="color: #72142C;"> info@ipbindia.com</b><br/>
			<b style="color: #72142C;">Happy to Serve You.</b>
		</h6>
	</div>
</main>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>