<?php if(!empty($last_discussion)){
  $singletitleID = encryptID($this->session->userdata('id'),$last_discussion['id']);?> 
<div class="row myform detail"> 
  <div class="col-md-2 studentImage">
    <img src="<?php echo base_url("uploads/".$last_discussion['profile_image']); ?>">
  </div>                      
  <div class="col-md-6"> 
    <a href="<?php echo base_url('chapter/title/discussion/'.$singletitleID);?>"><span class="info-name"><?php echo $last_discussion['discussion_title']; ?></span></a>  <br/>
    <span class="info-desc"><?php echo substr($last_discussion['description'], 0, 70); ?>....</span><br/>
  </div> 
  <div class="col-md-4">                            
    <span class="info-time"><?php echo date("jS F, Y", strtotime($last_discussion['created_at'])) ; ?></span>
  </div> 
</div>   
<?php } ?>