<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load Helper
		$this->load->helper("ipbtools");

		// Load model
		$this->load->model('Instructor_model');

		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}


	/*
	* Function call - To List all the existing Instructors in database
	*/
	public function listAllInstructors()
	{
		$data['title'] = 'All Instructors';

		$data['AllInstructors'] = $this->Instructor_model->getAllInstructors();

		$this->load->view('admin/instructor/all_instructors.view.php',$data);
	}


	/*
	* Function call - To get Single Instructor Details from database
	*/
	public function SingleInstructorDetails()
	{
		$data['title'] = 'Instructor Profile';
		
		if ($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id')){

				$instructorID = $URLData['0'];

				$data['SingleInstructorDetails'] = $this->Instructor_model->get_instructor_details_ByID($instructorID);
			}else
			{
				redirect('instructor/list');
			}
		}else
		{
			redirect('instructor/list');
		}

		$this->load->view('admin/instructor/profile.view.php',$data);
	}


	/*
	* Function call - To delete Instructor from listing by ID
	*/
	public function deleteInstructor_byID()
	{
		if ($this->input->is_ajax_request())
		{
			$instructorID = $this->input->post('delete_instructor');

			$Result = $this->Instructor_model->delete_instructor($instructorID);
    	}else
		{
			redirect('instructor/list');
		}
	}


	/*
	* Function call - To check if email ID already exists in database
	*/
	public function uniqueEmailID()
	{
		if ($this->input->is_ajax_request())
		{
			$emailid = $this->input->post('emailid');

			$Result = $this->Instructor_model->check_if_email_exists($emailid);	
			
			echo $Result;
			// echo json_encode($Result, true);
    	}
	}


	/*
	* Function Call - To create New Instructor
	*/
	public function createNewInstructor()
	{
		$data['title'] = 'Create New Instructor';

		// To create New Instructor
		if($this->input->post('create_instructor'))
		{
			 $passwordResetString = randomString();
			if($_FILES['profile_image'])
			{
				$filename = $_FILES['profile_image']['name'];
				$allowed_types = 'jpg|jpeg|png|gif';
				$columnName 	= "profile_image";
				$profileImage = uploadFile($filename, $allowed_types, $columnName);
			}else
			{
				$profileImage = base_url().'app-assets/images/dummy.png';
			}
			
			$email_id = $this->input->post('email');
			$create_instructor_data = array(
				'fullname'	  => $this->input->post('fullname'),
				'password'		=> hash_password($passwordResetString),
				'email' 		    => $email_id,
				'skype_id' 		  => $this->input->post('skype_id'),
				'phone' 		    => $this->input->post('phone'),
				'user_type' 	  => '1',
				'designation'	  => $this->input->post('designation'),
				'address' 		  => $this->input->post('address'), 
				'city' 			    => $this->input->post('city'),
				'pincode' 		  => $this->input->post('pincode'),
				'state' 		    => $this->input->post('state'), 
				'district' 		  => $this->input->post('district'),
				'latitude' 		  => $this->input->post('lat'),
				'longitude' 	  => $this->input->post('lng'), 
				'qualification' => $this->input->post('qualification'),
				'dob' 			    => dateFormat($this->input->post('dob')),
				'user_bio'		  => $this->input->post('user_bio'), 
				'website' 		  => $this->input->post('website'),
				'profile_image' => $profileImage,
				'gender' 		    => $this->input->post('gender')
			);
			// check if email exist
			$email_id = $this->input->post('email');
			$subject = 'Instructor Notification';
			$check_email_exists = $this->Instructor_model->checkMail_exist($email_id);

			if (empty($check_email_exists)) 
			{
				$instructorName = ucwords($this->input->post('fullname'));
				// To send SMS on provided Phone Number
				$instructorPhone = '91'.$this->input->post('phone');
				$instructorName = $this->input->post('fullname');
				$message = 'Hello '.$instructorName.', Welcome to IPB eLearning Portal. You are enrolled as Instructor for the position '.$this->input->post('designation').'. <br/><br/> Here are your Login details. <br/> Email: '.$create_instructor_data['email'].' <br/> Password: '.$passwordResetString.'<br/> Please click below to explore more. '.base_url('login').' Thanks for registering with us.';
				if(test_email($email_id,$subject,$message,$attach = ''))
				{
					$Result = $this->Instructor_model->create_new_instructor($create_instructor_data);
					$this->session->set_flashdata('item_createInstructor', array(
					'message' => 'New Instructor has been Created Successfully...! <br/> Login Credentials has been sent to provided Email.',
					'class' => 'success'
					));
				}else
				{
					$this->session->set_flashdata('item_createInstructor', array(
						'message' => 'Unable to Create Instructor...!',
						'class' => 'danger'
					));
				}
				redirect('instructor/list');
			}else
			{
				$this->session->set_flashdata('item_createInstructor', array(
				'message' => 'This Email ID is already exists. Please provide another Email.',
				'class' => 'danger'
				));
			}
		}
		$this->load->view('admin/instructor/create_instructor.view.php',$data);
	}
 

	/*
	* Function Call - To Update Instructor Details by ID
	*/
	public function UpdateInstructorDetails()
	{
		$data['title'] = 'Update Instructor Details';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$instructorID = $URLData['0'];

				$data['InstructorDetails'] = $this->Instructor_model->get_instructor_details_ByID($instructorID);

				$stateId = array('state_id' => $data['InstructorDetails']['state']);

				// To Update Instructor from listing by ID
				if($this->input->post('update_instructor')) 
				{
					$update_instructor_data = array(
						'fullname'	=> $this->input->post('fullname'),
						'email' 		=> $this->input->post('email'),
						'skype_id' 		=> $this->input->post('skype_id'),
						'phone' 		=> $this->input->post('phone'),
						'user_type' 	=> '1',
						'designation'	=> $this->input->post('designation'),
						'address' 		=> $this->input->post('address'), 
						'city' 			=> $this->input->post('city'),
						'pincode' 		=> $this->input->post('pincode'),
						'state' 		=> $this->input->post('state'),
						'district' 		=> $this->input->post('district'),
						'latitude' 		=> $this->input->post('lat'),
						'longitude' 	=> $this->input->post('lng'),  
						'qualification' => $this->input->post('qualification'),
						'dob' 			=> dateFormat($this->input->post('dob')),
						'user_bio'		=> $this->input->post('user_bio'), 
						'website' 		=> $this->input->post('website'),
						'gender' 		=> $this->input->post('gender')
					);

					$update_instructor_data = array_filter($update_instructor_data);
					
					$Result = $this->Instructor_model->update_instructor_details($instructorID, $update_instructor_data);

					if(!empty($Result)) {
						
						$this->session->set_flashdata('item_updateInstructor', array(
							'message' => 'Instructor Details Updated Successfully...!',
							'class' => 'success'
						));
					}else{
						
						$this->session->set_flashdata('item_updateInstructor', array(
							'message' => 'Unable to Update Instructor Details...!',
							'class' => 'danger'
						));
					}
					redirect('/instructor/update/'.$this->uri->segment(3));
				}

				// To Update Instructor from listing by ID
				// if($this->input->post('update_password')) 
				// {
				// 	$update_instructor_password = array(
				// 		'password' 	=> hash_password($this->input->post('password'))
				// 	);

				// 	$update_instructor_password = array_filter($update_instructor_password);

				// 	$Result = $this->Instructor_model->update_instructor_password($instructorID, $update_instructor_password);

				// 	if(!empty($Result)) {
						
				// 		$this->session->set_flashdata('item_updateInstructor', array(
				// 			'message' => 'Instructor Details Updated Successfully...!',
				// 			'class' => 'success'
				// 		));
				// 	}else
				// 	{
				// 		$this->session->set_flashdata('item_updateInstructor', array(
				// 			'message' => 'Unable to Update Instructor Details...!',
				// 			'class' => 'danger'
				// 		));
				// 	}
				// 	redirect('/instructor/update/'.$this->uri->segment(3));
				// }

				// To Update Instructor from listing by ID
				if($this->input->post('update_profile_image')) 
				{
					$filename = $_FILES['profile_image']['name'];

					$columnName = "profile_image";

					$allowed_types = 'jpg|jpeg|png|gif';

					$profileImage = uploadFile($filename, $allowed_types, $columnName);

					$instructor_image_data = array(
						'profile_image' => $profileImage
					);
					
					$instructor_image_data = array_filter($instructor_image_data);

					$Result = $this->Instructor_model->update_instructor_Image($instructorID, $instructor_image_data);

					if(!empty($Result)) {
						
						$this->session->set_flashdata('item_updateInstructor', array(
							'message' => 'Instructor Details Updated Successfully...!',
							'class' => 'success'
						));
					}else{
						
						$this->session->set_flashdata('item_updateInstructor', array(
							'message' => 'Unable to Update Instructor Details...!',
							'class' => 'danger'
						));
					}
					redirect('/instructor/update/'.$this->uri->segment(3));
				}

			}else
			{
				redirect('/instructor/list');
			}

		}else
		{
			redirect('/instructor/list');
		}
		
		$this->load->view('admin/instructor/update_instructor.view.php',$data);
	}

}