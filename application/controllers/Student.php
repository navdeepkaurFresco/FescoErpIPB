<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load Helper
		$this->load->helper("ipbtools");
		$this->load->library('Phpmailer');

		// Load model
		$this->load->model('Student_model','student');

		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}

	
	/*
	* Function call - To List all the existing Students in database
	*/
	public function listAllStudents()
	{
		$data['title'] = 'All Students';

		$data['AllStudents'] = $this->student->getAllStudents();

		$this->load->view('admin/students/allstudents.view.php',$data);
	}


	/*
	* Function Call - To update Student Account Status using ajax request
	*/
	public function updateStudentAccountStatus()
	{
		if ($this->input->is_ajax_request())
		{
			// To update student's account status
			if($this->input->post('buttonName'))
			{
				$URLData = decryptID($this->input->post('buttonval'));

				$LoggedUser = $URLData['1'];

				if($LoggedUser===$this->session->userdata('id'))
				{
					$StudentID = $URLData['0'];

					$hashedID = encryptID($this->session->userdata('id'),$StudentID);

					if($this->input->post('buttonName')=='deactivate_student')
					{
						$studentArr = array('is_deactive' => '0');
						$return_msg = "Student Activate successfully";
						$buttontemp = '<button type="button" value="'.$hashedID.'" name="activate_student" class="btn btn-info updateAccountStatus"><i class="ft-unlock"></i> Active</button>';
					}
					
					if($this->input->post('buttonName')=='activate_student')
					{
						$studentArr = array('is_deactive' => '1');
						$return_msg = "Student De-Activate successfully";
						$buttontemp = '<button type="button" value="'.$hashedID.'" name="deactivate_student" class="btn btn-danger updateAccountStatus"><i class="ft-lock"></i> De-Active</button>';
					}

					$Result = $this->student->updateStudentAccountStatus($StudentID,$studentArr);

					$returnMessage = array(
						'msg' 			=> $return_msg,
						'class' 		=> 'alert-success',
						'button_temp' 	=> $buttontemp
					);
				}else
				{
					$returnMessage	= array(
						'msg' 			=> 'You are not allowed to De-Activate this student...!',
						'class' 		=> 'alert-danger',
						'button_temp' 	=> ''
					);
				}
			}
			echo json_encode($returnMessage);
		}
	}



	/*
	* Function call - To get all information related to single Student
	*/
	public function SingleStudentProfile()
	{
		$data['title'] = 'All Students';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id')){

				$StudentID = $URLData['0'];

				$data['StudentDetails'] = $this->student->get_Student_details_ByID($StudentID);
			}else
			{
				redirect('student/list');
			}

		}else
		{
			redirect('student/list');
		}
		
		$this->load->view('admin/students/student_profile.view.php',$data);
	}

	/*
	* Function call - To check if email ID already exists in database
	*/
	public function uniqueEmailID()
	{
		if ($this->input->is_ajax_request())
		{
			$emailid = $this->input->post('emailid');

			$Result = $this->student->check_if_email_exists($emailid);	
			
			echo $Result;
    }
	}

	/*
	* Function call - To Create Student Profile
	*/
	public function CreateStudentProfile()
	{
		
		$data['title'] = 'Create Student';

		$emailid = $this->input->post('email');

		$profileImage = 'dummy.png';

		if ($this->input->post('create_student')) 
		{
			//echo '<pre/>';
			//print_r('here');
			//die();
			$passwordString = randomString();
			$email = $this->input->post('email');
			$student_data = array(
				'fullname'	    => $this->input->post('fullname'),
				'email' 		    => $email,
				'password' 		  => hash_password($passwordString), 
				'skype_id' 		  => $this->input->post('skype_id'),
				'phone' 		    => $this->input->post('phone'),
				'user_type'		  => '2',
				'address' 		  => $this->input->post('address'), 
				'city' 			    => $this->input->post('city'),
				'pincode' 		  => $this->input->post('pincode'),
				'state' 		    => $this->input->post('state'), 
				'district' 		  => $this->input->post('district'), 
				'latitude'		  => $this->input->post('lat'), 
				'longitude'		  => $this->input->post('lng'), 
				'qualification' => $this->input->post('qualification'),
				'dob' 			    => dateFormat($this->input->post('dob')),
				'profile_image' => $profileImage
			);
			$subject = 'Student Notification';
			$checkEmail = $this->student->check_if_email_exists($emailid);

			if (empty($checkEmail)) 	
			{	
				$studentName = ucwords($this->input->post('fullname'));
				$message = 'Hello '.$studentName.', Welcome to IPB eLearning Portal. You are enrolled as Student.<br><br/> Here are your Login details. <br/> Email: '.$email.' <br/> Password: '.$passwordString.'<br/> Please click below to explore more. '.base_url('login').' Thanks for registering with us.';
				
				if(test_email($email,$subject,$message,$attach = ''))
				{
					$result = $this->student->create_student_profile($student_data);
					$this->session->set_flashdata('item_createStudent', array(
						'message' => 'Student Registration done successfully..!!',
						'class'   => 'success'
					));
				}else
				{
					$this->session->set_flashdata('item_createStudent', array(
						'message' => 'Unable to Register Student',
						'class'	  => 'danger'
					));
				}
			}else
				{
					$this->session->set_flashdata('item_createStudent', array(
						'message' => 'This Email ID is already exists. Try again with another Email',
						'class'	  => 'danger'
					));
				}
		}
		
		$this->load->view('admin/students/create_student.php',$data);
	}

	/*
	* Function call - To Create Student Profile
	*/
	public function UpdateStudentProfile()
	{
		$data['title'] = 'Update Student';

		//$data['states'] = $this->student->get_States();

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$StudentID = $URLData['0'];

				$data['StudentDetails'] = $this->student->get_Student_details_ByID($StudentID);

				$stateId = array('state_id' => $data['StudentDetails']['state']);

				if ($this->input->post('update_student')) 
				{
					$studentUpdate_data = array(
						'fullname'	    => $this->input->post('fullname'),
						'skype_id' 	    => $this->input->post('skype_id'),
						'phone' 		    => $this->input->post('phone'),
						'user_type'	    => '2',
						'address' 	    => $this->input->post('address'), 
						'city' 			    => $this->input->post('city'),
						'pincode' 	    => $this->input->post('pincode'),
						'district' 	    => $this->input->post('district'), 
						'state' 		    => $this->input->post('state'), 
						'latitude' 		  => $this->input->post('lat'), 
						'longitude'		  => $this->input->post('lng'), 
						'qualification' => $this->input->post('qualification'),
						'gender' 		    => $this->input->post('gender'),
						'dob' 			    => dateFormat($this->input->post('dob'))
					);

					$result = $this->student->update_student_profile($StudentID, $studentUpdate_data);

					if(!empty($result))
					{
						$this->session->set_flashdata('item_updateStudent', array(
							'message' => 'Student Details Update successfully..!!',
							'class'   => 'success'
						));
					}else
					{
						$this->session->set_flashdata('item_updateStudent', array(
							'message' => 'Unable to Update Student Details',
							'class'	  => 'danger'
						));
					}
					redirect('/student/list');
				}

			}else
			{
				redirect('student/list');
			}

		}else
		{
			redirect('student/list');
		}
		$this->load->view('admin/students/update_student.php',$data);
	}



	/*
	* Function Call - To list all students who bought complete packages.
	*/
	public function CompletePackageStudentList()
	{
		$data['title'] = "Complete Packages Students";

		$data['allStudents'] = $this->student->get_complete_packages_students_list();
	
		$this->load->view('admin/students/complete_package_students_list.view.php',$data);
	}


	/*
	* Function call - To list students who completed complete package.
	*/
	public function CompletePackageStudentResult()
	{
		$data['title'] = "Complete Package Students";

		$data['allStudents'] = $this->student->get_complete_packages_students_result();

		$this->load->view('admin/students/complete_package_students_result.view.php',$data);
	}

}