<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load Helper
		$this->load->helper("ipbtools");

		// Load model
		$this->load->model('Frontend_model', 'frontend');

		// $this->load->library('mailchimp');
	}


	/*
	* Function call - To show landing page of website.
	*/
	public function index()
	{
		$data['title'] = 'IPB India';

		$data['allModules'] = $this->frontend->getAllModules();

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
			
			echo $Result;
    	}
	}

	/*
	* Function call - To show landing page of website.
	*/
	public function StudentSignup()
	{
		$data['title'] = 'Sign Up | IPB India';

		$emailid = $this->input->post('email');

		if($this->input->post('create_new_student'))
		{
			$profileImage = base_url().'app-assets/images/dummy.png';

			$dataArr = array(
			    'first_name' 	=> $this->input->post('first_name'),
			    'last_name' 	=> $this->input->post('last_name'),
			    'email' 		=> $this->input->post('email'),
			    'password' 		=> hash_password($this->input->post('password')),
			    'skype_id' 		=> $this->input->post('skype_id'),
			    'phone' 		=> $this->input->post('phone'),
			    'qualification' => $this->input->post('qualification'),
			    'dob' 			=> dateFormat($this->input->post('dob')),
			    'address' 		=> $this->input->post('address'),
			    'city' 			=> $this->input->post('city'),
			    'state' 		=> $this->input->post('state'),
			    'district' 		=> $this->input->post('district'),
			    'pincode' 		=> $this->input->post('pincode'),
			    'latitude' 		=> $this->input->post('lat'),
			    'longitude'		=> $this->input->post('lng'),
			    'user_type'		=> '2',
			    'profile_image' => $profileImage
			);

			$checkEmail = $this->frontend->check_if_email_exists($emailid);

			if (empty($checkEmail)) 
			{
				$result = $this->frontend->create_new_student($dataArr);

				if(!empty($result))
				{
					$studentPhone = '91'.$this->input->post('phone');
					$studentName = $this->input->post('first_name')." ".$this->input->post('last_name');
					$SMSmessage = 'Hello '.ucwords($studentName).', Welcome to IPB eLearning Portal. Your Journey for a successful Banking carrier starts from here. Please click below to explore more. '.base_url('login').' Thanks for registering with us.';

					$sendmsg = sendSMS($studentPhone,$SMSmessage);

					$this->session->set_flashdata('alertmessage', array(
						'message'	=> 'Registration done successfully..!!',
						'class'		=> 'success',
						'name'		=> $this->input->post('first_name')
					));

				}else
				{
					$this->session->set_flashdata('alertmessage', array(
						'message' => 'Unable to Register',
						'class'	  => 'danger'
					));
				}
			}else
				{
					$this->session->set_flashdata('alertmessage', array(
						'message' => 'This Email ID is already exists. Please provide another Email.',
						'class'	  => 'danger'
					));
				}
		}
		$this->load->view('frontend/signup.view.php',$data);
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
				'sender_state' 		=> $this->input->post('senderState'),
				'sender_district' 	=> $this->input->post('senderDistrict'),
				'sender_address' 	=> $this->input->post('address'),
				'sender_city' 		=> $this->input->post('senderCity'),
				'sender_pincode' 	=> $this->input->post('senderpincode'),
				'enquiry_subject' 	=> $this->input->post('EnquirySubject'),
				'enquiry_message' 	=> $this->input->post('EnquiryMessage'),
				'latitude' 			=> $this->input->post('latitude'),
			    'longitude'			=> $this->input->post('longitude'),
				'is_replied'		=> '0'
			);

			$result = $this->frontend->send_enquiry($data);

			if(!empty($result))
			{
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
		$data['title'] = 'About Us | IPB India';

		$this->load->view('frontend/about.view.php',$data);
	}


	/*
	* Function call - To show all Modules.
	*/
	public function allModules()
	{
		$data['title'] = 'All Courses | IPB India';

		$data['allModules'] = $this->frontend->getAllModules();

		$this->load->view('frontend/courses.view.php',$data);
	}


	/*
	* Function call - To show pricing details.
	*/
	public function pricing()
	{
		$data['title'] = 'Pricing | IPB India';

		$this->load->view('frontend/pricing.view.php',$data);
	}


	/*
	* Function call - To show placement acheivements.
	*/
	public function placements()
	{
		$data['title'] = 'Placements | IPB India';

		$this->load->view('frontend/placements.view.php',$data);
	}


	/*
	* Function call - To show contact Us page.
	*/
	public function contact()
	{
		$data['title'] = 'Contact Us | IPB India';

		// Save Contact form data to database.
		if($this->input->post('send_contact_request'))
		{
			$data = array(
				'username' 		=> $this->input->post('senderName'),
				'email'			=> $this->input->post('email'),
				'phone' 		=> $this->input->post('phone'),
				'address' 		=> $this->input->post('address'),
				'pincode' 		=> $this->input->post('pincode'),
				'state' 		=> $this->input->post('state'),
				'district' 		=> $this->input->post('district'),
				'city' 			=> $this->input->post('city'),
				'subject' 		=> $this->input->post('subject'),
				'message' 		=> $this->input->post('name'),
				'latitude' 		=> $this->input->post('lat'),
			    'longitude'		=> $this->input->post('lng'),
				'is_replied'	=> '0'
			);
			
			$result = $this->frontend->save_contact_requests($data);

			if(!empty($result))
			{
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
		$data['title'] = 'Module Details | IPB India';
		
		if ($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			$moduleID = $URLData['0'];

        	if(!$this->session->userdata('id')){
				$subQuery = '';
			}else{
        		$studentID = $this->session->userdata('id');
				$subQuery = " AND transaction_details.user_id = '$studentID'";
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
	* Function call - To delete Instructor from listing by ID
	*/
	public function createNewStudentAjaxCall()
	{
		if ($this->input->is_ajax_request())
		{
			$studentDetails = array(
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'email'         => $this->input->post('email_address'),
                'user_type'		=> '2',
                'designation'	=> 'Student',
                'phone'         => $this->input->post('phone_number'),
                'password'      => hash_password($this->input->post('phone_number')),
                'address'       => $this->input->post('address'),
                'city'          => $this->input->post('city'),
                'state'         => $this->input->post('state'),
                'district'      => $this->input->post('district'),
                'pincode'       => $this->input->post('zip_code'),
                'latitude' 		=> $this->input->post('latitude'),
			    'longitude'		=> $this->input->post('longitude'),
                'profile_image' => base_url('app-assets/images/dummy.png')
            );
			
			$NewStudentID = $this->frontend->create_new_student($studentDetails);
            $condition = array('id' => $NewStudentID);
            $NewStudentDetails = $this->frontend->student_login($condition);

            $session_data = array(
				'id'			=> $NewStudentDetails['id'],
				'email'			=> $NewStudentDetails['email'],
				'password'		=> $NewStudentDetails['password'],
				'first_name'	=> $NewStudentDetails['first_name'],
				'last_name'		=> $NewStudentDetails['last_name'],
				'user_type'		=> $NewStudentDetails['user_type'],
				'profile_image'	=> $NewStudentDetails['profile_image'],
				'frontendLogin'	=> '1'
			);

			// Add user data in session
			$this->session->set_userdata($session_data);

            echo json_encode($NewStudentDetails);

    	}else
		{
			redirect('instructor/list');
		}
	}


	/*
	* Function Call - To destroy the Session and logout Student
	*/
	public function StudentLogout()
	{
		// Removing session data
		session_destroy();

		$this->session->set_flashdata('item', 
			array(
				'message' => 'Logout Successfully...!',
				'class' => 'success'
			)
		);
		redirect();
	}

	public function Test_function()
	{
		if($this->input->post('create_new_student'))
		{
			/*$emailData = array(
							"to_email"		=>	'ashishchauhan.fresco@gmail.com',
							"subject"		=>	"Welcome in GetWork",
							"template_name"	=>	"applicant_register",
							"template_content"	=>	array(
								array("name"=>"first_name","content"=>$this->input->post("first_name")),
								array("name"=>"verification_link","content"=>$link),
								array("name"=>"verification_url","content"=>$vCode)
							)
						);
			$this->sendToMandrill($emailData);*/
		}
	}
}