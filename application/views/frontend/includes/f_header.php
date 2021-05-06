<!-- <div itemscope itemtype="http://schema.org/WebSite">
    <link itemprop="url" href="https://ipb.thefresconews.com/"/>
    <form itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
          <meta itemprop="target" content="https://ipb.thefresconews.com/search?q={query}"/>
      <input itemprop="query" type="text" name="query"/>
      <input type="submit"/>
    </form>
</div> -->
<header>
	<ul class="pull-right lang">
		<li class="selected"><a href="#">EN</a></li>
		<li><a href="#">DE</a></li>
		<li><a href="#">FR</a></li>
		<li><a href="#">PO</a></li>
	</ul>
	<div class="container">
		<div id="topbar">
			<div class="pull-right">
				<div class="navigation">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<i class="zmdi zmdi-menu zmdi-hc-lg"></i>
					</button>
					<nav class="collapse navbar-collapse" id="myNavbar">
						<ul>
							<li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
							<li><a href="<?php echo base_url('about'); ?>">About</a></li> 							
							<li><a href="<?php echo base_url('modules'); ?>">Courses</a></li>
							<li><a href="<?php echo base_url('whyipb'); ?>">Why IPB</a></li>
							<li><a href="<?php echo base_url('how_it_works'); ?>">How it works</a></li>
							<li><a href="<?php echo base_url('faq'); ?>">FAQ</a></li> 
							<li><a href="<?php echo base_url('placements'); ?>">Placements</a></li> 
							<li><a href="<?php echo base_url('contact'); ?>">Contact</a></li> 
						</ul>
					</nav>
				</div>
				<?php if(!$this->session->userdata('id')) { ?>
					<a href="<?php echo base_url('login'); ?>" class="blueplay login">LOGIN</a> 
					<a href="<?php echo base_url('signup'); ?>" class="register">REGISTER</a>
				<?php }else{ ?>
					<span class="un"> Hello, <?php echo $this->session->userdata('fullname'); ?></span>
						<?php if($this->session->userdata('user_type')=='0'){
							echo '  <a href="'.base_url('admin/home').'" class="register after-login">My Account</a>';
						} 
						if($this->session->userdata('user_type')=='1'){
							echo '  <a href="'.base_url('instructor/home').'" class="register after-login">My Account</a>';
						} 
						if($this->session->userdata('user_type')=='2'){
							echo '  <a href="'.base_url('student/home').'" class="register after-login">My Account</a>';
						} 
					?>			
					<a href="<?php echo base_url('logout'); ?>" class="register">LOGOUT</a>
				<?php } ?>
 			</div>
			<h1 class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>/assets/images/logo.png" alt="Logo"></a></h1>
		</div>
 	</div>
</header>