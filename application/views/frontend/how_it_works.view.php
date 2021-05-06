<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<body id="course-single" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>
<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>How It Works</h2>
		</div>
	</div>	
	<div class="container how-it-works">
		<div class="row">
			<div class="col-md-12">
				<h4>Please read carefully all the points below to know how it works for both freshers and experienced bankers.</h4>
				<ul>
					<li>The register and login method is same for both type of students/users</li>
					<li>Both type of students can buy and learn the course from IPB portal</li>
				</ul>				
			</div>
			<div class="col-md-12 table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
						<th>How it works for freshers?</th>
						<th>How it works for experienced bankers?</th>
					</tr>
					<tr>						
						<td>If you are a fresh graduate or Post graduate and age is less than 28 years then you can purchase any single module to get the opportunity in the banking sector.</td>	
						<td>An experienced banker can purchase the module one by one to get promoted in their correspodence field.</td>					
					</tr>
					<tr>
						<td><a href="<?php echo base_url('all/courses'); ?>">Click here</a> to check and purchase the complete package for all courses with discount</td>
						<td><a href="<?php echo base_url('complete-package'); ?>">Click here</a> to purchase any module according to your professional requirements</td>												
					</tr>
					<tr>
						<td>Login and registration process is same for both the users/students</td>
						<td>Login and registration process is same for both the users/students</td>						
					</tr>
				</table>
			</div>
			<div class="col-md-12">
				<h1>How to register on IPB e-Learning portal?</h1>
				<ul>
					<li>Click on the register button at the top right of the portal.</li>
					<li>A new page with registration from will open.</li>
					<li>Enter your correct details here. All the fields are mandatory. After filling the form you will receive a welcome email from IPB and now you are registered with IPB portal.</li>
				</ul>
			</div>
			<div class="col-md-7">
				<h1>How to login on IPB e-Learning portal?</h1>
				<ul>
					<li>Click on the login button at the top right of the portal.</li>
					<li>Enter your registered username/email and password details into the form then click on the login button.</li>
					<li>After logged in you will redirect into <a href="<?php echo base_url('student/home') ?>"> IPB student panel</a> (Back-end).</li>
					<li>Now you can edither click on the home icon at the top left in header to go to the homepage (front-end) as represents in <b>screenshot</b> or you can click on this <a href="<?php echo base_url('/') ?>">link</a> to check the homepage after logged in.</li>
				</ul>
			</div>
			<div class="col-md-5">
				<img src="<?php echo base_url(); ?>/assets/images/studentbackend.png"/ style="width: 100%;height: a">
			</div>
			<div class="col-md-12">
				<h1>What to do with IPB student panel/dashboard?</h1>
				<ul style="margin-bottom: 20px;">
					<li>Here you can edit your personal details like profile, courses, discussion forums, payment history, test history, results, skype interviews, downloads and FAQs.</li>					
				</ul>

				<div class="tab">
				  <button class="tablinks" onclick="openCity(event, 'db')" id="defaultOpen">Dashboard</button>
				  <button class="tablinks" onclick="openCity(event, 'pr')">Profile</button>
				  <button class="tablinks" onclick="openCity(event, 'co')">Courses</button>
				  <button class="tablinks" onclick="openCity(event, 'di')">Discussion Forums</button>
				  <button class="tablinks" onclick="openCity(event, 'pa')">Payment History</button>
				  <button class="tablinks" onclick="openCity(event, 'te')">Test History</button>
				  <button class="tablinks" onclick="openCity(event, 're')">Results</button>
				  <button class="tablinks" onclick="openCity(event, 'sk')">Skype Interview</button>
				  <button class="tablinks" onclick="openCity(event, 'do')">Downloads</button>
				  <button class="tablinks" onclick="openCity(event, 'fa')">FAQ</button>
				</div>

				<div id="db" class="tabcontent">
				  <h3>Students dashboard / panel</h3>
				  <p>After logged in you will redirect on student panel. Here you can check all the latest updates from IPB.</p>
				  <img src="<?php echo base_url(); ?>assets/images/da.png">
				</div>

				<div id="pr" class="tabcontent">
				  <h3>Profile</h3>
				  <p>You can edit your profile details like you can update your password, profile picture etc. You can also check and update your billing details here.</p> 
				  <img src="<?php echo base_url(); ?>assets/images/pr.png">				  
				</div>

				<div id="co" class="tabcontent">
				  <h3>Courses / Modules</h3>
				  <p>You can check or read your purchased courses here and you can also buy more modules/courses from 'All courses' tab</p>
				  <img src="<?php echo base_url(); ?>assets/images/co.png">			  
				</div>

				<div id="di" class="tabcontent">
				  <h3>Discussion Forums</h3>
				  <p>This option is very useful for students. If you have any dount in your course chapter then you can add your query here and you will receive an immediate response from our expert instructor.</p>
				  <img src="<?php echo base_url(); ?>assets/images/di.png">			  
				</div>

				<div id="pa" class="tabcontent">
				  <h3>Payment History</h3>
				  <p>You can check your payment history from this tab. You can also download and print it.</p>
				  <img src="<?php echo base_url(); ?>assets/images/pa.png">			  
				</div>

				<div id="te" class="tabcontent">
				  <h3>Test History</h3>
				  <p>After learn the course student can give the test online on portal and can check the test history in this tab. Student can also repeat the test for same module. He/She can check his/her question and answers details here.</p>			
				</div>

				<div id="re" class="tabcontent">
				  <h3>Results</h3>
				  <p>You can check your results here and you can also download it.</p>			
				</div>

				<div id="sk" class="tabcontent">
				  <h3>Skype Interview</h3>
				  <p>Skype interview is the important step to get the certification. After completing all the modules you need to schedule an appointment for skype interview. Our experts will take your test through skype, this is the final round, if you clear this round then you will get the certification from IPB e-Learning.</p>	
				</div>

				<div id="do" class="tabcontent">
				  <h3>Downloads</h3>
				  <p>You can download all documents like PDFs/PPTs etc from here.</p>			
				</div>

				<div id="fa" class="tabcontent">
				  <h3>FAQ</h3>
				  <p>This section is useful if you have any doubt or query regarding anything. You can read and implement this.</p>			
				</div>

				<script>
				function openCity(evt, cityName) {
				  var i, tabcontent, tablinks;
				  tabcontent = document.getElementsByClassName("tabcontent");
				  for (i = 0; i < tabcontent.length; i++) {
				    tabcontent[i].style.display = "none";
				  }
				  tablinks = document.getElementsByClassName("tablinks");
				  for (i = 0; i < tablinks.length; i++) {
				    tablinks[i].className = tablinks[i].className.replace(" active", "");
				  }
				  document.getElementById(cityName).style.display = "block";
				  evt.currentTarget.className += " active";
				}

				// Get the element with id="defaultOpen" and click on it
				document.getElementById("defaultOpen").click();
				</script>
			</div>
			<div class="col-md-12" style="margin-top: 30px;">
				<h1>How to buy a course for experienced bankers?</h1>
				<b>There are 2 methods to buy the course:</b>
				<ol>
					<li> Follow the below steps to buy a course from <a href="<?php echo base_url('/') ?>">front-end </a>		<ul>
							<li>Go to the courses page</li>
							<li>Select courses for bankers tab</li>
							<li>Click on the view all modules button</li>
							<li>Open your relevant course from all the modules</li>
							<li>Click on the enroll this course button</li>
							<li>A checkout page will open</li>
							<li>Enter your details here and click on the place order button</li>
							<li>A payment gateway page will open. Select your payment method, enter the details, just wait until the payment process done</li>
							<li>You can check your purchased course on IPB student panel (backend)</li>
						</ul>
					</li>
					<li>Follow the below steps to buy a course from <a href="<?php echo base_url('student/courses') ?>">Back-end</a>
						<ul>
							<li>Go to IPB student panel (Click here to know how to log in into IPB student panel)</li>
							<li>Open the dashboard then go to courses tab > Here you check your purchased courses or buy a new course</li>
							<li>Click on the buy now button > a course detail page will open > Here you can check the details and complete description of the course</li>
							<li>Click on pay now button > a popup will appear > select your payment method > Done</li>
						</ul>
					</li>
				</ol>					
			</div>
			<div class="col-md-12">
				<h1>How to buy a course for freshers?</h1>
				<b>Freshers must need to purchase the complete package from front-end</b>
				<ul>
					<li>Follow the below steps to buy a course from <a href="<?php echo base_url('/') ?>"> front-end</a>			
						<ul>
							<li>Go to the courses page</li>
							<li>Select courses for freshers tab</li>
							<li>Click on the view complete package button</li>
							<li>Click on the pay now button to purchase</li>							
							<li>A checkout page will open</li>
							<li>Enter your details here and click on the place order button</li>
							<li>A payment gateway page will open. Select your payment method, enter the details, just wait until the payment process done</li>
							<li>You can check your purchased course on IPB student panel (backend)</li>
						</ul>
					</li>
				</ul>					
			</div>
		</div>
	</div>	
</main>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>