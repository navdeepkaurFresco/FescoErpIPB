<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InstructorPanel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load database
		$this->load->model('InstructorPanel_model', 'instructor_model');
		$this->load->model('Chapters_model','chapters');

		if(!isset($this->session->instructorLogin))
		{
			redirect('login');
		}
	}

	/*
	* Redirect to another page according to session data
	*/
	public function index()
	{
		$data['title'] = "Instructor Dashboard";
		$currentDate    = date("Y-m-d");
		$where_headline = array('display' =>1, 'category' =>1, 'user_type'=>1, "DATE(`end_date`) >" => $currentDate);
		$where_news 	= array('display' =>1, 'category' =>2, 'user_type'=>1, "DATE(`end_date`) >" => $currentDate);
		$where_banner 	= array('display' =>1, 'category' =>3, 'user_type'=>1, "DATE(`end_date`) >" => $currentDate);

		$data['allHeadlines'] = $this->instructor_model->get_allHeadlines($where_headline);
		$data['allNews'] 	= $this->instructor_model->get_allNews($where_news);
		$data['allBanners'] = $this->instructor_model->get_allBanners($where_banner);
		$data['activities'] = $this->instructor_activity_forum();

		// get total assigned modules & total schedules skype interview
		$where = array('instructor_id' => $this->session->userdata('id'));
		$data['total_modules'] = $this->instructor_model->get_total_modules($where);
		$where_cond = array('instructor_id' => $this->session->userdata('id'), 'completed' => 0);
		$data['total_schedules_interview'] = $this->instructor_model->get_total_schedules_interview($where_cond);

		//get completed skype interview count
		$where_appointment = array('instructor_id' => $this->session->userdata('id'), 'completed'=>1);
		$data['total_completed_interview'] = $this->instructor_model->get_total_completed_interview($where_appointment);
		
		//get count of total discussion forum
		$chapter_Id = $this->instructor_model->get_chapter_Ids($this->session->userdata('id'));
		if(!empty($chapter_Id)){
			$where = array_column($chapter_Id, 'id');
			$data['total_discussion_forum'] = $this->instructor_model->get_DiscussionForum_count($where);
		}else{
			$data['total_discussion_forum'] = 0;
		}

		$this->load->view('instructor/instructor_dashboard.view.php',$data);
	}

	/*
	* Function call - To check if email ID already exists in database
	*/
	public function check_currPassword()
	{
		if ($this->input->is_ajax_request())
		{
			$instructorId = $this->session->userdata('id');

			$Curr_Password = hash_password($this->input->post('password'));

			$Result = $this->instructor_model->check_if_password_correct($instructorId, $Curr_Password);

			echo $Result;
    }
	}


	/*
	* Instructor Profile page
	*/
	public function InstructorAccount()
	{
		/*$data[] = "Account Details";*/

		$instructorId = $this->session->userdata('id');

		$data = array('LoginUserDetails' => $this->instructor_model->get_single_instructor_details($instructorId),
					  'title' => "Account Details");

		$stateId = $data['LoginUserDetails']['state'];

		//$data['district'] = $this->instructor_model->get_district($stateId);

		// To Update instructor's Profile Details
		if($this->input->post('update_instructor_details'))
		{	

			$instructorId = $this->session->userdata('id');

			$updateInstructor_details_data = array(
				'fullname'	=> $this->input->post('fullname'),
				'skype_id' 		=> $this->input->post('skype_id'),
				'phone' 		=> $this->input->post('phone'),
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
				'gender' 		=> $this->input->post('gender'),
				'updated_at'    => date('Y-m-d H:i:s')
			);

			$updateInstructor_details_data = array_filter($updateInstructor_details_data);

			$Result = $this->instructor_model->update_instructor_details($instructorId, $updateInstructor_details_data);

			if(!empty($Result)) 
			{

				$session_data = array(
					'id'				=> $Result['id'],
					'email'				=> $Result['email'],
					'fullname'		=> $Result['fullname'],
					'user_type'       => $Result['user_type'],
					'designation'     => $Result['designation'],
					'profile_image'   => $Result['profile_image'],
					'instructorLogin' => '1'
				);

				// Add user data in session
				$this->session->set_userdata($session_data);
				
				$this->session->set_flashdata('item', array(
					'message' => 'Instructor Details Updated Successfully...!',
					'class' => 'success'
				));

			}else
				{
					
					$this->session->set_flashdata('item', array(
						'message' => 'Unable to Update Instructor Details...!',
						'class' => 'danger'
					));
				}
			redirect('/instructor/account');
		}


		// To Update Instructor's password
		if($this->input->post('update_instructor_password'))
		{
				
			$instructorId = $this->session->userdata('id');
			
			// current password from database
			$getCurrent_pwd = $this->instructor_model->getCurrent_pwd($instructorId);


			$current_password = hash_password($this->input->post('currentpassword'));

			// match current password with database password

			if ($getCurrent_pwd->password == $current_password) 
			{

				$new_password = $this->input->post('password');

				$confirm_password = $this->input->post('confirmPassword');

				// match new password with confirm password

				if ($new_password == $confirm_password) 
				{
					$updateInstructor_pwd_data = array('password' 		=> hash_password($new_password),
													   'updated_at'    	=> date('Y-m-d H:i:s'));

					$updateInstructor_pwd_data = array_filter($updateInstructor_pwd_data);

					$Result = $this->instructor_model->update_instructor_password($instructorId, $updateInstructor_pwd_data);

					if(!empty($Result)) 
					{
						
						$this->session->set_flashdata('item', array(
							'message' => 'Instructor\'s Password Updated Successfully...!',
							'class' => 'success'
						));

					}else
						{					
							$this->session->set_flashdata('item', array(
								'message' => 'Unable to Update Instructor\'s Password...!',
								'class' => 'danger'
							));
						}
				}else
					{
						$this->session->set_flashdata('item', array(
								'message' => 'New Password and confirm Password not matched\'s Try Again...!',
								'class' => 'danger'
							));
					}
			}else
				{
					$this->session->set_flashdata('item', array(
							'message' => 'Current Password does not matched with your Password\'s Try Again...!',
							'class' => 'danger'
						));
				}
			
			redirect('/instructor/account');
		}


		// To Update Instructor's Profile
		if($this->input->post('update_instructor_profile_image')) 
		{
				
			$instructorId = $this->session->userdata('id');

			$filename = $_FILES['profile_image']['name'];

			$allowed_types = 'jpg|jpeg|png|gif';

			$columnName 	= "profile_image";

			$profileImage = uploadFile($filename, $allowed_types, $columnName);

			$updateInstructor_image_data = array(
				'profile_image' => $profileImage,
				'updated_at'    => date('Y-m-d H:i:s')
			);

			$updateInstructor_image_data = array_filter($updateInstructor_image_data);
			$Result = $this->instructor_model->update_instructor_Image($instructorId, $updateInstructor_image_data);

			if(!empty($Result)) 
			{

				$session_data = array(
					'profile_image'	=> $Result['profile_image']
				);

				// Update user data in session
				$this->session->set_userdata($session_data);
				
				$this->session->set_flashdata('item', array(
					'message' => 'Instructor\'s Profile Image Updated Successfully...!',
					'class' => 'success'
				));
			}else
				{
					$this->session->set_flashdata('item', array(
						'message' => 'Unable to Update Instructor\'s Profile Image Details...!',
						'class' => 'danger'
					));
				}
			redirect('/instructor/account');
		}

		$this->load->view('instructor/accountdetails.view.php',$data);
		// print_r($data);

	}


	/*
	* Function call - To get all the courses of LoggedIn Instructor
	*/
	public function GetInstructorCourses()
	{
		$data['title'] = "Assigned Courses";

		$instructorId = $this->session->userdata('id');

		$data['CourseDetails'] = $this->instructor_model->get_courses_details($instructorId);
		
		$this->load->view('instructor/coursesDetails.view.php',$data);
	}


	/*
	* Function call - To get course detail page
	*/
	public function GetSingleCourseDetails()
	{
		$data['title'] = "Course Detail";

		if($this->uri->segment(4)) 
		{
			$URLData 	= decryptID($this->uri->segment(4));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$courseId = $URLData['0'];

				$data['singleCourseDetails'] = $this->instructor_model->get_single_course_details($courseId);
				// print_r($data['singleCourseDetails']);
				// die();
				$chapter_details = $this->instructor_model->getchaptersofSingleModule($courseId);

				$data['singleCourseDetails']['chapter_details'] = $chapter_details;
			}
		}
		
		$this->load->view('instructor/singlecourse.view.php',$data);
	}


	/*
	* Function call - To get course detail page
	*/
	public function GetSingleChapterDetails()
	{
		$data['title'] = 'Single Chapter Details';

		if($this->uri->segment(4)) 
		{
			$URLData = decryptID($this->uri->segment(4));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$ChapterID = $URLData['0'];

				$where = array('chapter_id' => $ChapterID);
				$data['chapterDetails'] = $this->chapters->get_chapter_details_ByID($ChapterID);
				$data['chapterQuestions'] = $this->chapters->get_chapter_questions($ChapterID);
				$data['chapterTestDetails'] = $this->chapters->get_chapter_test_details($where);
				$data['chapterDiscussionForum'] = $this->chapters->get_chapter_DiscussionForum($where);

			}else
			{
				redirect('chapter/list');
			}
		}
		$this->load->view('instructor/singlechapter.view.php',$data);
	}


	/*
	* Function Call - To get all the pending Requests of Discussion Forums 
	*/
	public function GetInstructorDiscussionForums()
	{
		$data['title'] = "Discussion Forums";

		$instructorId = $this->session->userdata('id');
		$chapter_Id = $this->instructor_model->get_chapter_Ids($instructorId);
		if(!empty($chapter_Id)){
			$where = array_column($chapter_Id, 'id');
			$data['chapter_for_Discussion'] = $this->instructor_model->get_Chapter_for_Discussion($where);
		}
		$this->load->view('instructor/discussionForums.view.php',$data);
	}


	/*
	* Function Call - To get all the pending Requests of Discussion Forums 
	*/
	public function DiscussionforumDetails()
	{
		$data['title'] = "Forums Details";

		if($this->uri->segment(4)){
			$URLData = decryptID($this->uri->segment(4));
			$LoggedUser = $URLData['1'];
			if($LoggedUser===$this->session->userdata('id')){
				$chapterID = $URLData['0'];
				$data['discussion_titles'] = $this->instructor_model->get_chapter_discussionTitle($chapterID);
			}else{
				redirect('instructor/courses');
			}
		}else{
			redirect('instructor/courses');
		}
		$this->load->view('instructor/forumdetails.view.php',$data);
	}

	/*
	* Function Call - To get all the pending Requests of Discussion Forums 
	*/
	public function discussionsForum_comments()
	{
		$data['title'] = "Discussion Forum";

		if($this->uri->segment(4)){
			$URLData = decryptID($this->uri->segment(4));
			$LoggedUser = $URLData['1'];
			if($LoggedUser===$this->session->userdata('id')){
				$titleID = $URLData['0'];
				$data['discussion_titles'] = $this->instructor_model->get_discussionTitles($titleID);
				$data['discussion_title_comments'] = $this->instructor_model->get_discussionTitle_comments($titleID);

			}else{
				redirect('instructor/courses');
			}
		}else{
			redirect('instructor/courses');
		}
		$this->load->view('instructor/discussion_comment.view.php',$data);
	}

	/*
 	* Function Call - To schedule skype interview from Instructor Panel
 	*/
	public function ScheduleSkypeInterview()
	{
		$data['title'] = "Skype Interview";

		$data['allScheduled_Details'] = $this->instructor_model->get_ScheduledDetails();

		$instructorId = $this->session->userdata('id');

		$CourseDetail = $this->instructor_model->get_course($instructorId);
		
		if ($this->input->post('Submit_scheduled_details')) 
		{
			$scheduled_Data = array('instructor_id' => $this->session->userdata('id'),
									'module_id' 	=> $CourseDetail['id'],
									'date' 			=> dateFormat($this->input->post('AppointmentDate')),
									'day'	 		=> $this->input->post('AppointmentDay'),
									'start_time'	=> $this->input->post('start_time'),
									'end_time'		=> $this->input->post('end_time'),
									'status'		=> $this->input->post('availableStatus'),
									);
			
			$Result = $this->instructor_model->scheduled_Detail($scheduled_Data); 

			if (!empty($Result)) 
			{
				$this->session->set_flashdata('item', array(
					'message' => 'Instructor\'s Skype Interview Scheduled Details Saved Successfully...!',
					'class' => 'success'
				));
			}else
				{
					$this->session->set_flashdata('item', array(
						'message' => 'Unable to Save Instructor\'s Skype Interview Scheduled Details...!',
						'class' => 'danger'
					));
				}
		}

		$this->load->view('instructor/instructor_skypeInterview.view.php',$data);
	}

	/*
	* Working Plan Setting for Skype Interview
	*/
	public function workingPlan(){

		$where = array(
			"instructor_id"		=>	$this->session->userdata("id"),
			"setting_name"	=>	"working_plan"
		);

		$result = $this->instructor_model->getUserSettings($where);
		if($result)
			$data = array("working_plan"=>$result[0]->setting_value);
		else
			$data = array("working_plan"=>"");

		$this->load->view('instructor/workingPlan.view.php',$data);
	}

	/*
	* Inserting Working Plan Setting for Skype Interview
	*/
	public function insertSchedule() {

		if($this->input->is_ajax_request()){
			
			$where = array(
				"instructor_id"		=>	$this->session->userdata("id"),
				"setting_name"	=>	"working_plan"
			);

			$exists =	$this->instructor_model->userSettingExists($where);
			$data	=	array("setting_value"=>$this->input->post("schedule"),
							  "updated"   	 => date('Y-m-d H:i:s'));

			if($exists){
				$result = $this->instructor_model->updateUserSettings($data,$where);
			} else {
				$data = array_merge($where,$data);
				$result = $this->instructor_model->insertUserSettings($data);
			}

			if(!empty($result)){
				
				$message = array(
					"message" => "Working Plan Updated Successfully!",
					"class"	  => "success"	
				);
			} else {

				$message = array(
					"message" => "There is nothing to update in working plan!",
					"class"	  => "warning"	
				);
			}
			$view = $this->load->view("snippets/alert_message.php",$message);
			echo json_encode(array("error"=>0,"response"=>$view));
		}

	}

	/*
	* Getting List of appointments for Skype Interview
	*/
	public function appointmentsList()
	{
		$where = array("instructor_id" => $this->session->userdata("id"));
		$result = $this->instructor_model->getAppointments($where);
		// print_r($result);
		$events = array();
		if($result){
			foreach ($result as $value) {
				$events[] = array(
					"studentid"	=> 	$value->user_id,
					"title"		=>	$value->title,
					"url"		=>	'javascript:appointment_detail('.$value->user_id.')',
					"start"		=>	$value->start_datetime,
					"end"		=>	$value->end_datetime
				);
			}
		}
		$data = array("events" => json_encode($events));
		$this->load->view('instructor/appointments.view.php',$data);
	}

	/*
	* Function call to get skype interview appointment details of student
	*/
	public function skypeAppointment_details()
	{
		if ($this->input->is_ajax_request()) {
			
			$studentID = $this->input->post('studentID');

			$data['appointmentDetails']= $this->instructor_model->scheduled_appointmentDetails($studentID);

			$data['date'] = date("jS F, Y h:i:s A", strtotime($data['appointmentDetails']['start_datetime']));
			echo json_encode($data);
		}
	}

	/*
	* Function for instructor activity forum
	*/
	public function instructor_activity_forum()
	{
		$instructorId = $this->session->userdata('id');

		$activity = $this->instructor_model->get_profile_activity($instructorId);
		$updated_workingPlan = $this->instructor_model->get_updated_workingPlan($instructorId);
		$assigned_courses = $this->instructor_model->get_last_assignedCours($instructorId);
		//scheduled skype interview
		$appointment_activity = $this->instructor_model->get_appointment_activity($instructorId);
		// completed skype interview
		$complete_appointment_activity = $this->instructor_model->get_complete_appointment_activity($instructorId);
		//discussion forum activity
		$discussions = $this->instructor_model->get_discussions_activity($instructorId);

		$data = array();
		// print_r($activity['updated_at']);
		if (!empty($activity)) {
			array_push($data, array('title' => 'Profile has been updated.', 'time' => timeDifference($activity['updated_at'])));
		}
		if (!empty($updated_workingPlan)) {
			array_push($data, array('title' => 'Working Plan is updated.', 'time' => timeDifference($updated_workingPlan['updated'])));
		}	
		if (!empty($assigned_courses)) {
			foreach ($assigned_courses as $course){
				array_push($data, array('title' => ''.$course["course_title"].' course has been assigned.', 'time' => timeDifference($course['updated_at'])));
			}
		}
		if (!empty($appointment_activity)) {
			foreach ($appointment_activity as $single_activity){
				array_push($data, array('title' => ''.$single_activity["fullname"].' Scheduled an appointment for Skype Interview for '.date("jS F, Y", strtotime($single_activity['start_datetime'])).'.', 'time' => timeDifference($single_activity['book_datetime'])));
			}
		}
		if (!empty($complete_appointment_activity)) {
			foreach ($complete_appointment_activity as $single_activity){
				array_push($data, array('title' => 'Completed Skype Interview with '.$single_activity["fullname"].'.', 'time' => timeDifference($single_activity['end_datetime'])));
			}
		}
		if (!empty($discussions)){
			foreach ($discussions as $single_discussion){
				array_push($data, array('title' => 'Posted a comment into '.$single_discussion['chapter_title'].'.', 'time' => timeDifference($single_discussion['created'])));
			}
		}
		return $data;
	}

	/*
	* Function call for submit discussion comments
	*/
	public function submit_discussionComment()
	{
		if ($this->input->is_ajax_request()) 
		{
			$commentData = array('user_id'   => $this->session->userdata('id'),
								 'discussion_forum_id' => $this->input->post('discussion_formID'),
								 'comment'             => $this->input->post('comment')
								);
			$result = $this->instructor_model->submit_discussionComments($commentData);

			if (!empty($result)){
				$data['get_last_comment'] = $this->instructor_model->get_lastComment($result);	
				$comment=$this->load->view('instructor/snippet/discussion_comment.php', $data, true);
			

				echo $comment;
			}
		}
	}


	/*
	* Function call - to get the listing of students who bought complete package.
	*/
	public function CompletePackageStudentList()
	{
		$data['title'] = "Complete Packages Students";

		$data['allStudents'] = $this->instructor_model->get_complete_packages_students_list();
		// print_r($data['allStudents']);
		// die();
		$this->load->view('instructor/cp_students_list.view.php',$data);
	}


	/*
	* Function call - To list students who completed complete package.
	*/
	public function CompletePackageStudentResult()
	{
		$data['title'] = "Complete Package Students";

		$data['allStudents'] = $this->instructor_model->get_complete_packages_students_result();

		$this->load->view('instructor/cp_students_result.view.php',$data);
	}

}