<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load model
		$this->load->model('Frontend_model', 'frontend');

		// $this->load->library('mailchimp');

		/*$this->load->library('user_agent');
		if ($this->agent->is_referral())
		{
		  echo $this->agent->referrer();
		}*/
	}


	/*
	* Function call - To show landing page of website.
	*/
	public function index()
	{
		$data['title'] = 'IPB India';

		$data['allModules'] = $this->frontend->getAllModules();
		$data['allStates'] = $this->frontend->getAllStates();

		$this->load->view('frontend/home.view.php',$data);
	}


	/*
	* Function call - To Check if email exist.
	*/
	public function StudentCheckEmail()
	{
		if ($this->input->is_ajax_request())
		{
			$emailid = $this->input->post('emailid');

			$Result = $this->frontend->check_if_email_exists($emailid);	
			
			if(!empty($Result)){
				echo true;
			}
    }
	}

	/*
	* Function call - To save student data in db table
	* Check :- tu..
	*/
	public function StudentSignup()
	{
		if (!isset($this->session->id)) {

			$data['title'] = 'Sign Up';

			$emailid = $this->input->post('email');

			if($this->input->post('create_new_student'))
			{
				$profileImage = 'dummy.png';

				$dataArr = array(
			    'fullname' 	    => $this->input->post('fullname'),
			    'email' 		    => $this->input->post('email'),
			    'password' 		  => hash_password($this->input->post('password')),
			    'phone' 		    => $this->input->post('phone'),
			    'qualification' => $this->input->post('qualification'),
			    'user_type'		  => '2',
			    'profile_image' => $profileImage
				);

				$checkEmail = $this->frontend->check_if_email_exists($emailid);

				if (empty($checkEmail)) 
				{
					$NewstudentDetails = $this->frontend->create_new_student($dataArr);

					if(!empty($NewstudentDetails))
					{
						$studentName  = $NewstudentDetails['fullname'];
						$studentemail = $NewstudentDetails['email'];
						$studentphone = $NewstudentDetails['phone'];

						// Send mail after successfull registration
						$emailData = array(
							"to_email" 			   =>	$studentemail,
							"subject"		  	   =>	"Welcome in IPB E-Learning",
							"template_name" 	 =>	"ipb_student_registration",
							"template_content" =>	array(
								array("name"=>"student_name","content"=>$studentName),
								array("name"=>"username","content"=>$studentemail),
								array("name"=>"password","content"=>$this->input->post('password'))
							)
						);
						mandrill_mail($emailData);

						// Send SMS on Mobile
						$studentPhone = '91'.$studentphone;
						$SMSmessage = 'Dear '.ucwords($studentName).', Welcome to IPB. Jumpstart your professional career with our e-learning portal. Click here '.base_url('login').' and start your journey.';
						$sendmsg = sendSMS($studentPhone,$SMSmessage);

						// Redirect to Dashboard
						$session_data = array(
							'id'						=> $NewstudentDetails['id'],
							'email'					=> $studentemail,
							'phone'			    => $NewstudentDetails['phone'],
							'password'			=> $NewstudentDetails['password'],
							'fullname'		  => $NewstudentDetails['fullname'],
							'user_type'			=> $NewstudentDetails['user_type'],
							'profile_image'	=> $NewstudentDetails['profile_image'],
							'frontendLogin'	=> '1'
						);

						// Add user data in session
						$this->session->set_userdata($session_data);

						$this->session->set_flashdata('alertmessage_StudentSignup', array(
							'message'	=> 'Registration done successfully..!!',
							'class'		=> 'success',
							'name'		=> $this->input->post('fullname')
						));
						
					}else
					{
						$this->session->set_flashdata('alertmessage_StudentSignup', array(
							'message' => 'Unable to Register',
							'class'	  => 'danger'
						));
					}
				}else
				{
					$this->session->set_flashdata('alertmessage_StudentSignup', array(
						'message' => 'This Email ID is already exists. Please provide another Email.',
						'class'	  => 'danger'
					));
				}
			}
			$this->load->view('frontend/signup.view.php',$data);
		}else{
			echo '<script> window.history.back();</script>';
		}
	}


	/*
	* Function call - To submit enquiry form.
	*/
	public function sendEnquiry()
	{
		if($this->input->post('submit_enquiry'))
		{
			$data = array(
				'sender_name' 		=> $this->input->post('senderName'),
				'sender_email'		=> $this->input->post('senderEmail'),
				'sender_phone' 		=> $this->input->post('senderPhone'),
				'sender_dob' 		  => date("Y-m-d", strtotime($this->input->post('senderdob'))),
				'sender_state' 		=> $this->input->post('senderState'),
				'enquiry_subject' => $this->input->post('EnquirySubject'),
				'enquiry_message' => $this->input->post('EnquiryMessage'),
				'is_replied'		  => '0'
			);

			$result = $this->frontend->send_enquiry($data);

			if(!empty($result))
			{
				$senderPhone = '91'.$this->input->post('senderPhone');
				$senderName = $this->input->post('senderName');
				$SMSmessage = 'Hello '.ucwords($senderName).', Your enquiry related to "'.$this->input->post('EnquirySubject').'" has been submitted successfully. We\'ll contact you soon. Regards, IPB E-Learning';

				$sendmsg = sendSMS($senderPhone,$SMSmessage);

				echo true;
			}else
			{
				echo true;
			}
		}
	}


	/*
	* Function call - To show About Us Page.
	*/
	public function about()
	{
		$data['title'] = 'About Us';

		$this->load->view('frontend/about.view.php',$data);
	}


	/*
	* Function call - To fetch all the modules for bankers
	*/
	public function coursesforbankers()
	{
		$data['title'] = 'All Courses';

		$data['allModules'] = $this->frontend->getAllModules();

		$this->load->view('frontend/coursesforbankers.view.php',$data);
	}


	/*
	* Function Call - To show complete package for student.
	*/
	public function complete_package()
	{
		$data['title'] = 'Complete Package';

		$condition = array(
			'id' => $this->session->userdata('id')
		);

		$data['StudentData'] = $this->frontend->student_login($condition);
		$data['allModules'] = $this->frontend->getAllModules();
		$data['return_url'] = base_url().'razorpay/callback';
    $data['surl'] = base_url().'razorpay/success';
    $data['furl'] = base_url().'razorpay/failed';
    $data['currency_code'] = 'INR';

		$this->load->view('frontend/complete_package.view.php',$data);
	}

	/*
	* Function Call - To show frontend page content.
	*/
	public function whyipb()
	{
		$data['title'] = 'Why IPB';

		$this->load->view('frontend/whyipb.view.php',$data);
	}

	public function how_it_works()
	{
		$data['title'] = 'How it Works';

		$this->load->view('frontend/how_it_works.view.php',$data);
	}

	public function faq()
	{
		$data['title'] = 'FAQ';

		$data['faqContent'] = $this->frontend->getFAQContent();

		$this->load->view('frontend/faq.view.php',$data);
	}

	public function vision()
	{
		$data['title'] = 'Vision';

		$this->load->view('frontend/vision.view.php',$data);
	}

	public function mission()
	{
		$data['title'] = 'Mission';

		$this->load->view('frontend/mission.view.php',$data);
	}

	/*
	* Function call - To show Buy All Courses Page.
	*/
	public function allcourses()
	{
		$data['title'] = 'Buy All Modules';

		$this->load->view('frontend/allcourses.view.php',$data);
	}


	/*
	* Function call - To show all Modules.
	*/
	public function allModules()
	{
		$data['title'] = 'All Courses';

		$data['allModules'] = $this->frontend->getAllModules();

		$this->load->view('frontend/courses.view.php',$data);
	}


	/*
	* Function call - To show pricing details.
	*/
	public function pricing()
	{
		$data['title'] = 'Pricing';

		$this->load->view('frontend/pricing.view.php',$data);
	}


	/*
	* Function call - To show placement acheivements.
	*/
	public function placements()
	{
		$data['title'] = 'Placements';

		$this->load->view('frontend/placements.view.php',$data);
	}


	/*
	* Function call - To show banking As Career page at frontend.
	*/
	public function bankingAsCareer()
	{
		$data['title'] = 'Banking As Career';

		$this->load->view('frontend/banking_as_career.view.php',$data);
	}


	/*
	* Function call - To show contact Us page.
	*/
	public function contact()
	{
		$data['title'] = 'Contact Us';
		$data['allStates'] = $this->frontend->getAllStates();

		// Save Contact form data to database.
		if($this->input->post('send_contact_request'))
		{
			$data = array(
				'username'  => $this->input->post('senderName'),
				'email'			=> $this->input->post('email'),
				'phone' 		=> $this->input->post('phone'),
				'address'   => $this->input->post('address'),
				'pincode' 	=> $this->input->post('pincode'),
				'state' 		=> $this->input->post('state'),
				'district' 	=> $this->input->post('district'),
				'city' 			=> $this->input->post('city'),
				'subject' 	=> $this->input->post('subject'),
				'message' 	=> $this->input->post('name'),
				'latitude' 	=> $this->input->post('lat'),
			  'longitude'	=> $this->input->post('lng'),
				'is_replied'=> '0'
			);
			
			$result = $this->frontend->save_contact_requests($data);

			if(!empty($result))
			{
				$senderPhone = '91'.$this->input->post('phone');
				$senderName = $this->input->post('senderName');
				$SMSmessage = 'Hello '.ucwords($senderName).', Thanks for contact with us. We\'ll contact you soon. Regards, IPB E-Learning';

				$sendmsg = sendSMS($senderPhone,$SMSmessage);

				$this->session->set_flashdata('contact_alertmessage', array(
					'message' => 'Your message has been sent Successfully..!! We\'ll contact you soon.',
					'class'   => 'success'
				));
			}else
			{
				$this->session->set_flashdata('contact_alertmessage', array(
					'message' => 'Unable to Submit your Enquiry..!!',
					'class'	  => 'danger'
				));
			}
			redirect('contact');
		}

		$this->load->view('frontend/contact.view.php',$data);
	}


	/*
	* Function call - To show Details of single Modules.
	*/
	public function singleModuleDetails()
	{
		$data['title'] = 'Module Details';
		
		if ($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			$moduleID = $URLData['0'];

      if(!$this->session->userdata('id')){
				$subQuery = '';
				$data['bought_complete_module'] = array();
			}else{
        $studentID = $this->session->userdata('id');
				$subQuery = " AND transaction_details.user_id = '$studentID'";
				$data['bought_complete_module'] = $this->frontend->checkCompleteModule($studentID);
			}

			$data['singleModuleDetails'] = $this->frontend->get_single_module_details($moduleID,$subQuery);
			$data['popularCourses'] = $this->frontend->getTopModules($limit='3');
		}else
		{
			redirect();
		}
		$this->load->view('frontend/single_course.view.php',$data);
	}



	/*
	* Function Call - To register new user from checkout form and bought selected module
	*/
	public function createNewStudentAjaxCall()
	{
		if ($this->input->is_ajax_request())
		{
			$studentDetails = array(
				'fullname'    => $this->input->post('fullname'),
				'email'         => $this->input->post('email_address'),
				'user_type'		  => '2',
				'designation'	  => 'Student',
				'phone'         => $this->input->post('phone_number'),
				'password'      => hash_password($this->input->post('password')),
				'profile_image' => base_url('app-assets/images/dummy.png')
			);
			
			$NewstudentDetails = $this->frontend->create_new_student($studentDetails);

			if(!empty($NewstudentDetails))
			{
				$studentName  = $NewstudentDetails['fullname'];
				$studentemail = $NewstudentDetails['email'];
				$studentphone = $NewstudentDetails['phone'];

				// Send mail after successfull registration
				$emailData = array(
					"to_email" 			   =>	$studentemail,
					"subject"		  	   =>	"Welcome in IPB E-Learning",
					"template_name" 	 =>	"ipb_student_registration",
					"template_content" =>	array(
						array("name"=>"student_name","content"=>$studentName),
						array("name"=>"username","content"=>$studentemail),
						array("name"=>"password","content"=>$this->input->post('password'))
					)
				);
				mandrill_mail($emailData);

				// Send SMS on Mobile
				$studentPhone = '91'.$studentphone;
				$SMSmessage = 'Dear '.ucwords($studentName).', Welcome to IPB. Jumpstart your professional career with our e-learning portal. Click here '.base_url('login').' and start your journey.';
				$sendmsg = sendSMS($studentPhone,$SMSmessage);

				// Redirect to Dashboard
				$session_data = array(
					'id'						=> $NewstudentDetails['id'],
					'email'					=> $studentemail,
					'phone'			    => $NewstudentDetails['phone'],
					'password'			=> $NewstudentDetails['password'],
					'fullname'		  => $NewstudentDetails['fullname'],
					'user_type'			=> $NewstudentDetails['user_type'],
					'profile_image'	=> $NewstudentDetails['profile_image'],
					'frontendLogin'	=> '1'
				);

				// Add user data in session
				$this->session->set_userdata($session_data);
			}
      echo json_encode($NewstudentDetails);
		}
	}

	/*
	* Function Call - google search query call
	*/
	public function googleSearchCall()
	{
		$search_string = $this->uri->segment(2);

		//die($search_string);

		$searchResult = $this->frontend->google_search_engine($search_string);
	}

	/*
	* Function Call - To check if user already exists
	*/
	public function ifuserexists()
	{
		if ($this->input->is_ajax_request())
	  {
	  	if ($this->input->post('email')) 
	  	{
  			$email = $this->input->post('email');

  			$where = "(email= '".$email."' OR  phone= '".$email."' )";

	  		$result = $this->frontend->check_if_userRegistered($where);

	  		if (!empty($result)) 
	  		{
	  			echo  json_encode($result);
	  		}else
  			{
  				$otp = generateOTP(6);
					$emailData = array(
						"to_email" 			   =>	$email,
						"subject"		  	   =>	"IPB E-Learning One Time Password",
						"template_name" 	 =>	"ipb_otp_email",
						"template_content" =>	array(
							array("name"=>"otp","content"=>$otp)
						)
					);
					$mailsent = mandrill_mail($emailData);

					if ($mailsent) {
						set_cookie('otp_value', $otp, time()+60*60*30);
						echo $otp;
					}else {
						show_error($this->email->print_debugger());
					}
  			} 
  		}elseif ($this->input->post('mobile')) 
  		{
  			$mobile = $this->input->post('mobile');

  			$where = "(email= '".$mobile."' OR  phone= '".$mobile."' )";

	  		$result = $this->frontend->check_if_userRegistered($where);

	  		if (!empty($result)) 
	  		{
	  			echo json_encode($result);
	  		}else
  			{
  				$otp = generateOTP(6);
					// Send SMS on Mobile
					$studentPhone = '91'.$mobile;
					$SMSmessage = 'Your verification code for IPB ePortal is '.$otp.'. Do not share this One Time Password with anyone for security reasons. Regards IPB team ';
					$sendmsg = sendSMS($studentPhone,$SMSmessage);

					if ($sendmsg) 
					{
						set_cookie('otp_value', $otp, time()+60*60*30);
						echo $otp;
					}
  			} 
	  	}
	  }
	}

	/*
	* FunctionCall - To login on checkout page to sent otp on mobile/email
	*/
	public function loginVerification()
	{
		if ($this->input->is_ajax_request())
  	{
			delete_cookie('otp_value');
			
  		if ($this->input->post('email')) 
  		{
  			$email = $this->input->post('email');
  			$where = array('email' => $email);
	  		$result = $this->frontend->check_if_userRegistered($where);

	  		if (!empty($result)) 
	  		{
					$otp = generateOTP(6);

					$emailData = array(
						"to_email" 			   =>	$email,
						"subject"		  	   =>	"IPB E-Learning One Time Password",
						"template_name" 	 =>	"ipb_otp_email",
						"template_content" =>	array(
							array("name"=>"otp","content"=>$otp)
						)
					);
					$emailsend = mandrill_mail($emailData);

					if ($emailsend) {
						set_cookie('otp_value', $otp, time()+60*60*30);
						echo $otp;
					}else {
						show_error($this->email->print_debugger());
					}
  			}
  		}elseif ($this->input->post('mobile')) 
  		{
  			$mobile = $this->input->post('mobile');
  			$where = array('phone' => $mobile);
	  		$result = $this->frontend->check_if_userRegistered($where);

	  		if (!empty($result)) 
	  		{
	  			$otp = generateOTP(6);
					// Send SMS on Mobile
					$studentPhone = '91'.$mobile;
					$SMSmessage = 'Your verification code for IPB ePortal is '.$otp.'. Do not share this One Time Password with anyone for security reasons. Regards IPB team ';
					$sendmsg = sendSMS($studentPhone,$SMSmessage);

					if ($sendmsg) 
					{
						set_cookie('otp_value', $otp, time()+60*60*30);
						echo $otp;
					}
  			} 
  		}
  	}
	}

}