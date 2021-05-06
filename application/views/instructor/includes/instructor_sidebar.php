<div class="main-menu menu-static menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >
      <li class="nav-item">
        <a href="<?php echo base_url('/instructor/home'); ?>">
          <div class="card border-warning border-lighten-2">
            <div class="text-center">
              <div class="card-body">
                <img src="<?php echo base_url('uploads/').$this->session->userdata('profile_image'); ?>" class="" alt="Card image">
              </div>
              <div class="card-body">
                <h4 class="card-title"><?php echo $this->session->userdata('fullname'); ?></h4>
                <h6 class="card-subtitle text-muted"><?php echo $this->session->userdata['designation']; ?></h6>
              </div>
            </div>
          </div>
        </a>
      </li>
      <li class=" nav-item <?php echo $this->uri->segment(2) == 'home' ? 'active' : '' ; ?>">
        <a href="<?php echo site_url('instructor/home'); ?>">
          <i class="la la-support"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class=" nav-item <?php echo $this->uri->segment(2) == 'account' ? 'active' : '' ; ?>">
        <a href="<?php echo site_url('instructor/account'); ?>">
          <i class="la la-user"></i>
          <span class="menu-title">Profile</span>
        </a>
      </li>
      <li class=" nav-item <?php echo $this->uri->segment(2) == 'courses' ? 'active' : '' ; ?>">
        <a href="<?php echo site_url('instructor/courses'); ?>">
          <i class="la la-bars"></i>
          <span class="menu-title">Courses Assigned</span>
        </a>
      </li>
      <li class=" nav-item <?php echo $this->uri->segment(2) == 'discussionforums' ? 'active' : '' ; ?>">
        <a href="<?php echo site_url('instructor/discussionforums'); ?>">
          <i class="la la-comments"></i>
          <span class="menu-title">Discussion Forums</span>
        </a>
      </li>
      <li class="nav-item <?php echo ($this->uri->segment(2)=='complete-package') ? 'active open' : '' ?>">
          <a href="#">
              <i class="la la-briefcase"></i>
              <span class="menu-title" >Complete Package</span>
          </a>
          <ul class="menu-content">
              <li class="menu-item <?php echo ($this->uri->segment(1) == 'instructor' && $this->uri->segment(2) == 'complete-package' && $this->uri->segment(3) == 'list') ? 'active' : '' ?>">
                  <a href="<?php echo base_url('instructor/complete-package/list'); ?>" >Students Who Bought</a>
              </li>
              <li class="menu-item <?php echo ($this->uri->segment(1) == 'instructor' && $this->uri->segment(2) == 'complete-package' && $this->uri->segment(3) == 'result') ? 'active' : '' ?>">
                  <a href="<?php echo base_url('instructor/complete-package/result'); ?>" >Students who Completed</a>
              </li>
          </ul>
      </li>
      <li class=" nav-item <?php echo $this->uri->segment(2) == 'skypeInterview' ? 'open active' : '' ; ?>">
        <a href="#">
          <i class="la la-skype"></i>
          <span class="menu-title">Skype Interview</span>
        </a>
        <ul class="menu-content <?php echo $this->uri->segment(2) == 'home' ? 'active' : '' ; ?>">
            <li class="<?php echo $this->uri->segment(2) == '' ? 'active' : '' ; ?>">
                <a class="menu-item" href="<?php echo site_url('/instructor/appointments'); ?>">Appointment List</a>
            </li>
            <li>
                <a class="menu-item" href="<?php echo site_url('/instructor/workingPlan'); ?>">Working Plan</a>
            </li>
        </ul>
      </li>
    </ul>
  </div>
</div>