<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load model
		$this->load->model('AdminDashboard_model','admin');		
		
		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}

	/*
	* Default function call
	*/
	public function index()
	{
		$data['title'] = 'Dashboard';
		
		$data['TotalStudents'] = $this->admin->getUserTypeCount($studentType='2');
		$data['TotalInstructors'] = $this->admin->getUserTypeCount($instructorType='1');
		$data['netProfit'] 			= $this->admin->getnetProfit();
		$data['totalSales'] 		= $this->admin->getTotalSales();
		$data['RecentSales'] 		= $this->admin->getRecentSales();
		$data['topModules'] 		= $this->admin->getTopsellingModules($limit='3');
		$data['TotalEnquiries'] = $this->admin->getTotalEnquiryRequests();
		$data['CompletedSkypeInterviews'] = $this->admin->getSkypeInterviewsCount($startdate='',$enddate='');
		$data['CSILast28days']  = $this->admin->getSkypeInterviewsCount(date("Y-m-d", strtotime('-28 days')),date("Y-m-d"));
		$data['CSILast7days']   = $this->admin->getSkypeInterviewsCount(date("Y-m-d", strtotime('-7 days')),date("Y-m-d"));
		$data['upcomingSInextweek'] = $this->admin->getSkypeInterviewsCount(date("Y-m-d", strtotime('+6 days')),date("Y-m-d"));
		$data['upcomingSIthismonth'] = $this->admin->getSkypeInterviewsCount(date("Y-m-d", strtotime('Y-m-01')),date("Y-m-d", strtotime('Y-m-31')));
		$data['CompletedModulesStats'] = $this->admin->getCompletedModulesStats();

		// 5 Top selling Modules donut chart Content
		$donutchartContent = $this->admin->getTopsellingModules($limit='5');
		$donutresult = array();
		if (!empty($donutchartContent)) {
			foreach($donutchartContent as $key => $value)
			{
				$donutresult[] = '{value: '.$value['total'].', name: "'.$value['course_title'].'" }';
			}
			$donutresultString = implode(',', $donutresult);
			$data['TopsellingModules'] = $donutresultString;
		}else{
			$data['TopsellingModules'] = '';
		}


		// Monthly sales Modules pie chart Content
		$ModulespiechartContent = $this->admin->getMonthlySalesofModules();
		$pieresult = array();
		if (!empty($ModulespiechartContent)) {
			foreach ($ModulespiechartContent as $key => $value)
			{
				$pieresult[] = '{value: '.$value['total_sales'].', name: \''.date('F', strtotime($value['created_at'])).'\'} ';
			}

			for($month='0'; $month<'12'; $month++)
			{
				if(!in_array($month, array_column($ModulespiechartContent, 'month')))
				{
					if($month<='9')
					{	
						$Month = date('Y')."-0".$month."-01";
						$monthname = date('F', strtotime($Month));
					}else
					{
						$Month = date('Y')."-".$month."-01";
						$monthname = date('F', strtotime($Month));
					}
			    $pieresult[] = '{value: 0, name: \''.$monthname.'\'} ';
				}
			}
			$pieresultString = implode(',', $pieresult);
			$data['MonthlysalesModules'] = $pieresultString;
		}else{
			$data['MonthlysalesModules'] = '';
		}


		// To get locations to show on world map
		$existingLocations = $this->admin->getExistingLocations();
		$LocationsArr = array();
		if(!empty($existingLocations)){
			foreach ($existingLocations as $key => $value)
			{
				if(!empty($value['lat']) && !empty($value['long'])){
					$LocationsArr[] = 'map.addMarker({lat: '.$value['lat'].',lng:'.$value['long'].',title: "'.$value['city'].'",infoWindow: {content: "'.$value['city'].'" } });';
				}
			}
			$locationString = implode('',$LocationsArr);
			$data['existingLocations'] = $locationString;
		}else{
			$data['existingLocations'] = '';
		}
		$data['activities'] = $this->admin_activities();

		$this->load->view('admin/dashboard.view.php',$data);
	}


    /*
    * Function Call - To fetch info to show on account detail page
    */
    public function LoginUserDetails()
    {
      $data['title'] = 'Account Details';
			$userID = $this->session->userdata('id');
			$data['LoginUserDetails'] = $this->admin->get_login_user_details($userID);
      
      $this->load->view('admin/account_details.view.php',$data);
    }
 

	/*
	* Function Call - To Update Admin Details by ID
	*/
	public function UpdateAdminDetails()
	{
		$data['title'] = 'Update Admin Details';

		if ($this->input->get('id')) 
		{
			$adminID = $this->input->get('id');

			// To Update admin from listing by ID
			if($this->input->post('update_admin')) 
			{
				$update_admin_data = array(
					'fullname'	=> $this->input->post('fullname'),
					'skype_id' 		=> $this->input->post('skype_id'),
					'phone' 		=> $this->input->post('phone'),
					'designation'	=> $this->input->post('designation'),
					'address' 		=> $this->input->post('address'), 
					'city' 			=> $this->input->post('city'),
					'pincode' 		=> $this->input->post('pincode'),
					'state' 		=> $this->input->post('state'), 
					'district' 		=> $this->input->post('district'), 
					'qualification' => $this->input->post('qualification'),
					'dob' 			=> dateFormat($this->input->post('dob')),
					'user_bio'		=> $this->input->post('user_bio'), 
					'website' 		=> $this->input->post('website'),
					'gender' 		=> $this->input->post('gender'),
					'updated_at'    => date('Y-m-d H:i:s')
				);
				$Result = $this->admin->update_admin_details($adminID, $update_admin_data);


				if(!empty($Result)) 
				{
					$session_data = array(
						'id'			=> $Result['id'],
						'email'			=> $Result['email'],
						'fullname'	=> $Result['fullname'],
						'user_type'		=> $Result['user_type'],
						'designation'	=> $Result['designation'],
						'profile_image'	=> $Result['profile_image'],
						'adminLogin'	=> '1'
					);

					// Add user data in session
					$this->session->set_userdata($session_data);
					
					$this->session->set_flashdata('item_update_adminDetail', array(
						'message' => 'Admin Details Updated Successfully...!',
						'class' => 'success'
					));
				}else
				{
					$this->session->set_flashdata('item_update_adminDetail', array(
						'message' => 'Unable to Update Admin Details...!',
						'class' => 'danger'
					));
				}
				redirect('admin/account');
			}
		}else
		{
			redirect('admin/account');
		}
		
		$this->load->view('admin/account_details.view.php',$data);
	}



	/*
	* Function Call - To Update Admin Password by ID
	*/
	public function UpdateAdminPassword()
	{
		$data['title'] = 'Update Admin Password';
		$userID = $this->session->userdata('id');
		$data['LoginUserDetails'] = $this->admin->get_login_user_details($userID);

		if ($this->input->get('id')) 
		{
			$adminID = $this->input->get('id');

			$data['adminDetails'] = $this->admin->get_login_user_details($adminID);
			
			if($this->input->post('update_password'))
			{
				$update_admin_pasword_data = array(
					'password' 	=> hash_password($this->input->post('password')),
					'updated_at'=> date('Y-m-d H:i:s')
				);

				$update_admin_pasword_data = array_filter($update_admin_pasword_data);

				$Result = $this->admin->update_admin_password($adminID, $update_admin_pasword_data);

				if(!empty($Result)) {
					
					$this->session->set_flashdata('item_update_adminDetail', array(
						'message' => 'Admin Password Updated Successfully...!',
						'class' => 'success'
					));
				}else{
					
					$this->session->set_flashdata('item_update_adminDetail', array(
						'message' => 'Unable to Update Admin Password Details...!',
						'class' => 'danger'
					));
				}
			}
		}else
		{
			redirect('admin/account');
		}
		
		$this->load->view('admin/account_details.view.php',$data);
	}


	/*
	* Function Call - To Update Admin Image by ID
	*/
	public function UpdateAdminImage()
	{
		$data['title'] = 'Update Admin Profile Image';
		
		if ($this->input->get('id')) 
		{
			$adminID = $this->input->get('id');

			$data['adminDetails'] = $this->admin->get_login_user_details($adminID);

			if($this->input->post('update_profile_image')) 
			{		
				$filename = $_FILES['profile_image']['name'];
				$allowed_types = 'jpg|jpeg|png|gif';
				$columnName = "profile_image";
				$profileImage = uploadFile($filename, $allowed_types, $columnName);
				$update_image_data = array(
					'profile_image' => $profileImage,
					'updated_at'    => date('Y-m-d H:i:s')
				);
				$update_image_data = array_filter($update_image_data);
				$Result = $this->admin->update_admin_Image($adminID, $update_image_data);

				if(!empty($Result)) 
				{
					$session_data = array(
						'profile_image'	=> $Result['profile_image'],
						'adminLogin'	=> '1'
					);
					// Add user data in session
					$this->session->set_userdata($session_data);
					$this->session->set_flashdata('item_update_adminDetail', array(
						'message' => 'Admin Profile Image Updated Successfully...!',
						'class' => 'success'
					));
				}else{
					
					$this->session->set_flashdata('item_update_adminDetail', array(
						'message' => 'Unable to Update Admin Profile Image Details...!',
						'class' => 'danger'
					));
				}

				redirect('admin/account');
			}
		}else
		{
			redirect('admin/account');
		}
		
		$this->load->view('admin/account_details.view.php',$data);
	}


	/*
	* Function Call - To fetch all enquiries from database and show them in superadmin
	*/
	public function GetAllEnquiries()
	{
		$data['title'] = "All Enquiries";
		$data['AllEnquiries'] = $this->admin->get_all_enquiries();

		$this->load->view('admin/enquiryData/all_enquiries.view.php',$data);
	}


	/*
	* Function Call - To send response to enquiries
	*/
	public function SendEnqueryResponse()
	{
		if($this->input->post('send_enquiry_response'))
		{
			$reply_to = $this->input->post('reply_to');
			$enquiryID = $this->input->post('enquiry_id');

			$enquiryResponse = array(
				'reply_message' => $this->input->post('enquiry_reply_message'),
				'is_replied' 	=> '1'
			);
			$response = $this->admin->send_enquery_response($enquiryID,$enquiryResponse);

			if(!empty($response))
			{
				$emailData = array(
						"to_email"		=>	$reply_to,
						"subject"		=>	"Enquiry - IPB E-Learning",
						"template_name"	=>	"ipb_enquiry",
						"template_content"	=>	array(
							array("name"=>"enquiry_content","content"=>$this->input->post('enquiry_reply_message')))
					);
				mandrill_mail($emailData);

				if(mandrill_mail($emailData))
				{
					$this->session->set_flashdata('alertmessage_enquiry', array(
						'message' => 'Response has been sent Successfully..!!',
						'class'   => 'success'
					));
				}else
				{
					$this->session->set_flashdata('alertmessage_enquiry', array(
						'message' => 'Unable to send response..!!',
						'class'	  => 'danger'
					));
				}
				// send mail from here to $reply_to
			}else
			{
				$this->session->set_flashdata('alertmessage_enquiry', array(
					'message' => 'Unable to send response..!!',
					'class'	  => 'danger'
				));
			}
			redirect('enquery/list');	
		}
	}


	/*
	* Function Call - To fetch all Contact Requests from database and show them in superadmin
	*/
	public function listAllContactRequests()
	{
		$data['title'] = "All Contact Requests";
		$data['ContactRequests'] = $this->admin->get_all_contact_requests();

		$this->load->view('admin/enquiryData/contact_mails.view.php',$data);
	}


	/*
	* Function Call - To send response to Contact Requests
	*/
	public function ReplyToContactRequest()
	{
		if($this->input->post('reply_contact_request'))
		{
			$reply_to = $this->input->post('reply_to');
			$requestID = $this->input->post('contact_request_id');

			$requestResponse = array(
				'replied_message' => $this->input->post('contact_reply_message'),
				'is_replied' 	=> '1'
			);
			$response = $this->admin->send_request_response($requestID,$requestResponse);

			if(!empty($response))
			{
				$emailData = array(
						"to_email"		=>	$reply_to,
						"subject"		=>	"Contact - IPB E-Learning",
						"template_name"	=>	"ipb_contact",
						"template_content"	=>array(
							array("name"=>"contact_request_data","content"=>$this->input->post('contact_reply_message')))
					);
				mandrill_mail($emailData);

				if(mandrill_mail($emailData))
				{
					$this->session->set_flashdata(
						'alertmessage_contact', 
						array(
							'message' => 'Response has been sent Successfully..!!',
							'class'   => 'success' 
						)
					);
				}else
				{
					$this->session->set_flashdata(
						'alertmessage_contact', 
						array(
							'message' => 'Unable to send response..!!',
							'class'	  => 'danger'
						)
					);
				}
				// send mail from here to $reply_to
			}else
			{
				$this->session->set_flashdata(
					'alertmessage_contact', 
					array(
						'message' => 'Unable to send response..!!',
						'class'	  => 'danger'
					)
				);
			}
			redirect('contact/list');	
		}
	}

		/*
	* Function call - To show activites on student panel.
	*/
	public function admin_activities()
	{
		$adminID = $this->session->userdata('id');

		$profile_activity   		= $this->admin->get_profile_activity($adminID);
		$last_updated_module 		= $this->admin->get_updated_module();
		$create_user	 			= $this->admin->get_newUser_activity();
		$last_added_module			= $this->admin->get_added_module_activity();
		$last_added_chapter 		= $this->admin->get_added_chapter_activity();
		$last_updated_chapter 		= $this->admin->get_updated_chapter_activity();
		$announcement_Activity 		= $this->admin->get_announcement_activity();
		$faqs_Activity 				= $this->admin->get_faqs_activity();
		$download_Activity 			= $this->admin->get_download_Activity();
		$contactRequest_Activity 	= $this->admin->get_contactRequest_Activity();
		$enquiry_Activity 			= $this->admin->get_enquiry_Activity();
		$chapter_test	 			= $this->admin->get_chapterTest_Activity();

		//echo '<pre/>';
		//print_r($create_user);
		//die();
		$data= array();
		if (!empty($profile_activity)){
			array_push($data, array('title' => 'Profile has been updated.', 'time' => timeDifference($profile_activity['updated_at'])));
		}
		if (!empty($last_updated_module)){
			foreach ($last_updated_module as $single_updated_module){
				array_push($data, array('title' => '"'.$single_updated_module['course_title'].'" Module has beed updated.', 'time' => timeDifference($single_updated_module['updated_at'])));
			}
		}
		if (!empty($create_user)){
			foreach ($create_user as $single_activity){
				
				if ($single_activity['user_type'] == '1'){
					array_push($data, array('title' => ''.$single_activity['fullname'].' added as a Instructor.', 'time' => timeDifference($single_activity['created_by'])));
				}elseif($single_activity['user_type'] == '2') {
				//die();
					array_push($data, array('title' => $single_activity['fullname'].' added as a Student.', 'time' => timeDifference($single_activity['created_by'])));
				}
			}	
		}
		if (!empty($last_added_module)){
			foreach ($last_added_module as $single_activity){
				array_push($data, array('title' => ''.$single_activity['course_title'].' Module has beed added.', 'time' => timeDifference($single_activity['created_at'])));
			}	
		}
		if (!empty($last_added_chapter)){
			foreach ($last_added_chapter as $single_activity){
				array_push($data, array('title' => 'New Chapter has been added into '.$single_activity['course_title'].'.', 'time' => timeDifference($single_activity['created_at'])));
			}
		}
		if (!empty($last_updated_chapter)){
			foreach ($last_updated_chapter as $single_activity){
				array_push($data, array('title' => 'Chapter has been updated.', 'time' => timeDifference($single_activity['updated_at'])));
			}
		}
		if (!empty($announcement_Activity)){
			foreach ($announcement_Activity as $single_activity){
				if ($single_activity['category'] == '1') {
					if ($single_activity['user_type'] == '1') {
						array_push($data, array('title' => 'Headline has been created for Instructor', 'time' => timeDifference($single_activity['created_at'])));
					}else{
						array_push($data, array('title' => 'Headline has been created for Student', 'time' => timeDifference($single_activity['created_at'])));
					}
				}
				if ($single_activity['category'] == '2') {
					if ($single_activity['user_type'] == '1') {
						array_push($data, array('title' => 'News has been created for Instructor', 'time' => timeDifference($single_activity['created_at'])));
					}else{
						array_push($data, array('title' => 'News has been created for Student', 'time' => timeDifference($single_activity['created_at'])));
					}
				}
				if ($single_activity['category'] == '3') {
					if ($single_activity['user_type'] == '1') {
						array_push($data, array('title' => 'Banner has been created for Instructor', 'time' => timeDifference($single_activity['created_at'])));
					}else{
						array_push($data, array('title' => 'Banner has been created for Student', 'time' => timeDifference($single_activity['created_at'])));
					}
				}
			}
		}

		if (!empty($faqs_Activity)){
			foreach ($faqs_Activity as $single_activity){
				array_push($data, array('title' => 'FAQ has been added.', 'time' => timeDifference($single_activity['created_at'])));
			}
		}
		if (!empty($download_Activity)){
			foreach ($download_Activity as $single_activity){
				array_push($data, array('title' => 'Downloadable Content has been added.', 'time' => timeDifference($single_activity['created_at'])));
			}
		}
		
		if (!empty($contactRequest_Activity)){
			//echo '<pre/>';
		//print_r($contactRequest_Activity);
		//die();
			foreach ($contactRequest_Activity as $single_activity){
				array_push($data, array('title' => 'Replied to Contact Request from '.$single_activity['username'].'.', 'time' => timeDifference($single_activity['created_at'])));
			}
		}
		if (!empty($enquiry_Activity)){
			foreach ($enquiry_Activity as $single_activity){
				array_push($data, array('title' => 'Replied to Enquiry from '.$single_activity['sender_name'].'.', 'time' => timeDifference($single_activity['created_at'])));
			}
		}
		if (!empty($chapter_test)){
			foreach ($chapter_test as $single_activity){
				array_push($data, array('title' => '"'.$single_activity['chapter_title'].'" Test has been updated.', 'time' => timeDifference($single_activity['created_at'])));
			}
		}

		return  $data;
		
	}

}