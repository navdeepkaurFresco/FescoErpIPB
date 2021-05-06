<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item <?php echo $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'home' ? 'active' : '' ?>">
                <a href="<?php echo base_url('admin/home'); ?>">
                    <i class="la la-home"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'instructor' ? 'active' : '' ?>">
                <a href="#"><i class="la la-male"></i><span class="menu-title">Instructor</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'instructor' && $this->uri->segment(2) == 'list' ? 'active' : '' ?>" href="<?php echo base_url('instructor/list'); ?>" >List All Instructors</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'instructor' && $this->uri->segment(2) == 'create' ? 'active' : '' ?>" href="<?php echo base_url('instructor/create'); ?>">Add New Instructor</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'module' || $this->uri->segment(1) == 'finalexam' ? 'active' : '' ?>">
                <a href="#"><i class="la la-indent"></i><span class="menu-title">Modules</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'module' && $this->uri->segment(2) == 'list' ? 'active' : '' ?>" href="<?php echo base_url('module/list'); ?>">List All Modules</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'module' && $this->uri->segment(2) == 'create' ? 'active' : '' ?>" href="<?php echo base_url('module/create'); ?>">Add New Module</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'finalexam' && $this->uri->segment(2) == 'settings' ? 'active' : '' ?>" href="<?php echo base_url('finalexam/settings'); ?>">Final Exams</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'chapter' ? 'active' : '' ?>">
                <a href="#"><i class="la la-file-text"></i><span class="menu-title" data-i18n="nav.templates.main">Chapters</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'chapter' && $this->uri->segment(2) == 'list' ? 'active' : '' ?>" href="<?php echo base_url('chapter/list'); ?>" >List All Chapters</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'chapter' && $this->uri->segment(2) == 'create' ? 'active' : '' ?>" href="<?php echo base_url('chapter/create'); ?>" >Add New Chapter</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'chapter' && $this->uri->segment(2) == 'test' && $this->uri->segment(3) == 'details' ? 'active' : '' ?>" href="<?php echo base_url('chapter/test/details'); ?>" >Chapter Test</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'student' ? 'active' : '' ?>">
                <a href="<?php echo base_url('student/list'); ?>">
                    <i class="la la-users"></i>
                    <span class="menu-title">Students</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'list' ? 'active' : '' ?>" href="<?php echo base_url('student/list'); ?>" >List All Students</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'create' ? 'active' : '' ?>" href="<?php echo base_url('student/create'); ?>" >Add New Student</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'reports' ? 'active' : '' ?>">
                <a href="#">
                    <i class="la la-area-chart"></i>
                    <span class="menu-title">Reports</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'sales' ? 'active' : '' ?>" href="<?php echo base_url('reports/sales'); ?>" >Sales Reports</a>
                    </li>
                    <li class="has-sub <?php echo $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'students' ? 'open active' : '' ?>">
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'create' ? 'active' : '' ?>" href="#">Students Reports</a>
                         <ul class="menu-content">
                            <li>
                                <a class="menu-item <?php echo $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'student' && $this->uri->segment(3) == 'badge' ? 'active' : '' ?>" href="<?php echo base_url('reports/student/badge'); ?>" >Badge Vice Reports</a>
                            </li>
                            <li>
                                <a class="menu-item <?php echo $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'student' && $this->uri->segment(3) == 'module' ? 'active' : '' ?>" href="<?php echo base_url('reports/student/module'); ?>" >Module Progress Reports</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'transaction' ? 'active' : '' ?>" href="<?php echo base_url('reports/transaction'); ?>" >Transaction Reports</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'reports' && $this->uri->segment(2) == 'enquery' ? 'active' : '' ?>" href="<?php echo base_url('reports/enquery'); ?>" >Enquery Reports</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'announcement' ? 'active' : '' ?>">
                <a href="#">
                    <i class="la la-file-text"></i>
                    <span class="menu-title">Announcement</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'announcement' && $this->uri->segment(2) == 'headline' ? 'active' : '' ?>" href="<?php echo base_url('announcement/headline'); ?>" >Headlines</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'announcement' && $this->uri->segment(2) == 'news' ? 'active' : '' ?>" href="<?php echo base_url('announcement/news'); ?>" >News</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'announcement' && $this->uri->segment(2) == 'banner' ? 'active' : '' ?>" href="<?php echo base_url('announcement/banner'); ?>" >Banner's</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'settings' ? 'active' : '' ?>">
                <a href="#">
                    <i class="la la-cog"></i>
                    <span class="menu-title" >Settings</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'settings' && $this->uri->segment(2) == 'monthly' && $this->uri->segment(3) == 'expenses' ? 'active' : '' ?>" href="<?php echo base_url('settings/monthly/expenses'); ?>" >Monthly Expenses</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'settings' && $this->uri->segment(2) == 'invoice' && $this->uri->segment(3) == 'details' ? 'active' : '' ?>" href="<?php echo base_url('settings/invoice/details'); ?>" >Invoice Details</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'settings' && $this->uri->segment(2) == 'faq' ? 'active' : '' ?>" href="<?php echo base_url('settings/faq'); ?>" >FAQ</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo $this->uri->segment(1) == 'settings' && $this->uri->segment(2) == 'downloads' ? 'active' : '' ?>" href="<?php echo base_url('settings/downloads'); ?>" >Downloads</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo ($this->uri->segment(1)=='complete-package') ? 'active' : '' ?>">
                <a href="<?php echo base_url('complete-package/list'); ?>">
                    <i class="la la-briefcase"></i>
                    <span class="menu-title" >Complete Package Details</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item <?php echo ($this->uri->segment(1) == 'complete-package' && $this->uri->segment(2) == 'list') ? 'active' : '' ?>" href="<?php echo base_url('complete-package/list'); ?>" >Students Who Bought</a>
                    </li>
                    <li>
                        <a class="menu-item <?php echo ($this->uri->segment(1) == 'complete-package' && $this->uri->segment(2) == 'result') ? 'active' : '' ?>" href="<?php echo base_url('complete-package/result'); ?>" >Students who Completed</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'contact' ? 'active' : '' ?>">
                <a href="<?php echo base_url('contact/list'); ?>">
                    <i class="la la-envelope"></i>
                    <span class="menu-title" >Contact Forms</span>
                </a>
            </li>
            <li class="nav-item <?php echo $this->uri->segment(1) == 'enquery' ? 'active' : '' ?>">
                <a href="<?php echo base_url('enquery/list'); ?>">
                    <i class="la la-comments"></i>
                    <span class="menu-title" >Enquery Forms</span>
                </a>
            </li>
        </ul>
    </div>
</div>