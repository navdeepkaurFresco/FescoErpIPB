<?php if (!empty($get_last_comment)) {?>
	<li class="comment author-comment">
    <div class="info">
        <a href="#"><?php echo $get_last_comment['fullname'];  ?></a>
        <span><?php echo timeDifference($get_last_comment['created']); ?> ago</span>
    </div>
    <a class="avatar" href="#">
        <img src="<?php echo base_url("uploads/".$get_last_comment['profile_image'] )?>" width="35" alt="Profile Avatar" title="Jack Smith" />
    </a>
    <p><?php echo $get_last_comment['comment']; ?></p>
</li>
<?php } ?>
