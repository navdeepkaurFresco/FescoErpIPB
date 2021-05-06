<div class="main-menu menu-static menu-light menu-shadow menu-accordion" data-scroll-to-active="true">
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" >
      <li class="nav-item">
        <a href="<?php echo base_url('student/account'); ?>">
          <div class="card border-info border-lighten-2">
            <div class="text-center">
              <div class="card-body">
                <img src="<?php echo base_url('uploads/').$this->session->userdata('profile_image'); ?>" class="" alt="Card image">
              </div>
              <div class="card-body">
                <h4 class="card-title"><?php echo $this->session->userdata('fullname'); ?></h4>
              </div>
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'home' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/home'); ?>">
          <i class="la la-dashboard"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'account' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/account'); ?>">
          <i class="la la-user"></i>
          <span class="menu-title">Profile</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'courses' || $this->uri->segment(2) == 'read' || $this->uri->segment(2) == 'course' || $this->uri->segment(2) == 'read' || $this->uri->segment(2) == 'chapter' || $this->uri->segment(1) == 'razorpay' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/courses'); ?>">
          <i class="la la-list"></i>
          <span class="menu-title">Courses</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'forums' || $this->uri->segment(3) == 'discussion' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/forums'); ?>">
          <i class="la la-comments"></i>
          <span class="menu-title">Discussion Forums</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'payments' || $this->uri->segment(2) == 'invoice' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/payments'); ?>">
          <i class="la la-money"></i>
          <span class="menu-title">Payment History</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'exams' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/exams'); ?>">
          <i class="la la-graduation-cap"></i>
          <span class="menu-title">Test History</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'results' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/results'); ?>">
          <i class="la la-hourglass"></i>
          <span class="menu-title">Results</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'skypeInterview' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/skypeInterview'); ?>">
          <i class="la la-skype"></i>
          <span class="menu-title">Skype Interview</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'downloads' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/downloads'); ?>">
          <i class="la la-cloud-download"></i>
          <span class="menu-title">Downloads</span>
        </a>
      </li>
      <li class="nav-item <?php echo $this->uri->segment(2) == 'faqs' ? 'active' : '' ?>">
        <a href="<?php echo site_url('student/faqs'); ?>">
          <i class="la la-question"></i>
          <span class="menu-title">FAQs</span>
        </a>
      </li>
    </ul>
  </div>
</div>