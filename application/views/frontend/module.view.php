<?php					
foreach($allModules as $single_module)
{
	$hashedID = encryptID($this->session->userdata('id'),$single_module['id']);

	$reviews = '535 Reviews';//($single_module['total_reviews']=='1' || $single_module['total_reviews'] =='0') ? $single_module['total_reviews']." Review" : $single_module['total_reviews']." Reviews" ;

	$rating = (empty($single_module['rating'])) ? '0' : $single_module['rating'] ;

	$ratingstars = '<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>
	<i class="fa fa-star"></i>';
	/*for ($ii=0; $ii < 5; $ii++)
	{ 
		if($ii<=$rating){
			$ratingstars .='<i class="fa fa-star"></i>';
		}else
		{
			$ratingstars .='<i class="fa fa-star-o"></i>';
		}
	}*/

	 ?>
	<div class="col-md-3" style="margin-bottom: 30px;">
		<div class="flat-course">
			<div class="featured-post">           
				<a href="<?php echo base_url('course/details/'.$hashedID); ?>">
				<img src="<?php echo base_url('uploads/').$single_module['course_image']; ?>" alt="<?php echo $single_module['course_title']; ?>">
				</a>
			</div>
			<div class="course-content">
				<h4><a href="<?php echo base_url('course/details/'.$hashedID); ?>"><?php echo $single_module['course_title']; ?></a> </h4>
				<div class="price"><i class="fa fa-rupee"></i> <?php echo $single_module['fee']; ?></div>
				<ul class="course-meta review">
					<li class="review-stars">
						<?php echo $ratingstars; ?>
					</li>
					<li><?php echo $reviews; ?></li>
				</ul>
				<ul class="course-meta desc">
					<li>
						<h6><?php $total_chapters = $single_module['total_chapters']; 
							echo $total_chapters;
							echo ($total_chapters=='1') ? ' Chapter' : ' Chapters' ; 
							?></h6>
					</li>
					<li>
						<h6><span class="course-time"><?php echo $single_module['time_duration'] ; ?> mins</span></h6>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php
} ?>