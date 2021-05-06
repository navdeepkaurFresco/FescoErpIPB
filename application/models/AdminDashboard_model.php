<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard_model extends CI_Model {

	/*
	* Function Call - Read data using userID
	*/
	public function get_login_user_details($userID)
	{
		$query = $this->db->get_where('users_details',array('users_details.id'=>$userID));

		$result = $query->row_array();

		if ($query->num_rows() == 1)
		{
			return $result;
		}else
		{
			return false;
		}
	}
	
	/*
	* Function Call - To Update Admin Details by ID
	*/
	public function update_admin_details($adminID, $update_admin_data)
	{
		$this->db->where('id', $adminID)->update('users_details',$update_admin_data);
		
		if ($this->db->affected_rows()> 0)
		{
			$result = $this->admin->get_login_user_details($adminID);

			return $result;
		}else
		{
			return false;
		}
}


	/*
	* Function Call - To Update Admin Password by ID
	*/
	public function update_admin_password($adminID, $update_admin_pasword_data)
	{
		$this->db->where('id', $adminID)->update('users_details',$update_admin_pasword_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To Update Admin Image by ID
	*/
	public function update_admin_Image($adminID, $update_image_data)
	{
		$this->db->where('id', $adminID)->update('users_details',$update_image_data);
		
		if ($this->db->affected_rows()> 0)
		{
			$result = $this->admin->get_login_user_details($adminID);

			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To get all enquiries
	*/
	public function get_all_enquiries()
	{
		$query = $this->db->order_by('id','DESC')->get_where('enquiry_data');

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To save enquiry response to database
	*/
	public function send_enquery_response($enquiryID,$enquiryResponse)
	{
		$this->db->where('id', $enquiryID)->update('enquiry_data',$enquiryResponse);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To get all contact requests
	*/
	public function get_all_contact_requests()
	{
		$query = $this->db->order_by('id','DESC')->get_where('contact_requests');

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To save enquiry response to database
	*/
	public function send_request_response($requestID,$requestResponse)
	{
		$this->db->where('id', $requestID)->update('contact_requests',$requestResponse);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - to return count of total instructors existing in DB
	*/
	public function getUserTypeCount($userType)
	{
		$query = $this->db->get_where('users_details',array('user_type'=>$userType));

		$result_array = $query->result_array();

		if (!empty($result_array))
		{
			return count($result_array);
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - To get current month's total sellings
	*/
	public function getnetProfit()
	{
		$query = $this->db->select('sum(order_total) as total_purchase')
		->get('transaction_details');

		$result = $query->row_array();

		$TotalExpenses = $this->admin->getTotalExpenses();

		$net_profit = $result['total_purchase']-$TotalExpenses;

		if (!empty($net_profit))
		{
			return $net_profit;
		}else
		{
			return false;
		}
	}

	
	/*
	* Function Call - To get Recent Sales
	*/
	public function getRecentSales()
	{
		$query = $this->db->select('COUNT(`transaction_details`.`module_id`) as `total_module_sales`, 
			module_details.course_title,
			module_details.fee ')
		->join('module_details','module_details.id=transaction_details.module_id','LEFT')
		->group_by('transaction_details.module_id')
		->order_by('transaction_details.id','DESC')
		->limit('5')
		->get('transaction_details');
		$result = $query->result_array();

		if (!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - To get Total Sales
	*/
	public function getTotalSales()
	{
		$query = $this->db->select('COUNT(*) as total_sales')->get('transaction_details');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['total_sales'];
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - To get total Enquiry Requests
	*/
	public function getTotalEnquiryRequests()
	{
		$query = $this->db->select('count(*) as enquiry_data')->get('enquiry_data');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['enquiry_data'];
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To get total Enquiry Requests
	*/
	public function getSkypeInterviewsCount($startdate,$enddate)
	{
		if(!empty($startdate) && !empty($enddate))
		{
			$where = array("DATE(`appointments`.`start_datetime`) >=" => $startdate,
				"DATE(`appointments`.`end_datetime`) <=" => $enddate );
		}else
		{
			$where = array('1'=>'1');
		}
		$query = $this->db->select('count(completed) as totalcalls')->get_where('appointments',$where);

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['totalcalls'];
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To get total expenses
	*/
	public function getTotalExpenses()
	{
		$query = $this->db->select('sum(expenses) as total_expenses')->get('monthly_expenses');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['total_expenses'];
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - to get 5 Top selling Modules
	*/
	public function getTopsellingModules($limit)
	{
		$query = $this->db->select('COUNT(`transaction_details`.`module_id`) as `total_module_sales`, 
			module_details.course_title,
			module_details.fee,
			(SELECT COUNT(*) FROM `transaction_details` WHERE `module_id` = module_details.id ) as total')
		->join('module_details','module_details.id=transaction_details.module_id','INNER')
		->group_by('transaction_details.module_id')
		->order_by('transaction_details.id','DESC')
		->limit($limit)
		->get('transaction_details');

		$result = $query->result_array();

		if (!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - to get Monthly Sales of Modules
	*/
	public function getMonthlySalesofModules()
	{
		$query = $this->db
			->select('COUNT(module_id) as total_sales, created_at, MONTH(created_at) as month')
			->order_by('created_at','ASC')
			->group_by('MONTH(created_at)')
			->get_where('transaction_details',array('YEAR(created_at)' => (int)date('Y')));

		$result = $query->result_array();

		if (!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - to get Existing Locations
	*/
	public function getExistingLocations()
	{
		$query1 = $this->db->select('ud.latitude as lat, ud.longitude as long, ud.city as city')->get('users_details as ud');
		$result1 = $query1->result_array();

		//$query2 = $this->db->select('ed.latitude as lat, ed.longitude as long, ed.sender_city as city')->get('enquiry_data as ed');
		//$result2 = $query2->result_array();

		$query3 = $this->db->select('cr.latitude as lat, cr.longitude as long, cr.city as city')->get('contact_requests as cr');
		$result3 = $query3->result_array();

		$result = array_merge($result1, $result3); //echo "<pre/>"; print_r($result);

		if (!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - to get Completed Modules Stats
	*/
	public function getCompletedModulesStats()
	{
		$query = $this->db->select('COUNT(completed) as total_completed_modules, (SELECT COUNT(module_id) FROM transaction_details) as total_bought_modules')->get_where('moduletest_result', array('completed'=>'1') );
		$result = $query->row_array();

		if (!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function call to get updated profile of last one week
	*/
	public function get_profile_activity($adminID)
	{
		$query = $this->db->query("SELECT * FROM `users_details` WHERE `id` = '".$adminID."' AND DATE(updated_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
				return false;
			}
	}
	/*
	* Function call to get bought module activity
	*/
	public function get_updated_module()
	{

		$query = $query = $this->db->query("SELECT * FROM `module_details` WHERE  DATE(updated_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		$result = $query->result_array();
		if($result){
			return $result;
		}else{
				return false;
			}
	}
	/*
	* Function call to get newly added_user activity
	*/
	public function get_newUser_activity()
	{
		$query = $this->db->query("SELECT * FROM `users_details` WHERE DATE(created_by) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}
	/*
	* Function call to get newly added_module activity
	*/
	public function get_added_module_activity()
	{
		$query = $this->db->query("SELECT * FROM `module_details` WHERE  DATE(created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}
	/*
	* Function call to get newly added_chapter activity
	*/
	public function get_added_chapter_activity()
	{
		$query = $this->db->query("SELECT chapter_details.id, chapter_details.module_id, chapter_details.created_at, module_details.course_title FROM `chapter_details` LEFT JOIN `module_details` ON `chapter_details`.`module_id` = `module_details`.`id` WHERE DATE(chapter_details.created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		$result = $query->result_array();
		if($result){
			return $result;
		}else{
				return false;
			}
	}
	/*
	* Function call to get announcements activity
	*/
	public function get_announcement_activity()
	{
		$query = $this->db->query("SELECT * FROM `announcement` WHERE  DATE(created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get faqs activity
	*/
	public function get_faqs_activity()
	{
		$query = $this->db->query("SELECT * FROM `faq_content` WHERE  DATE(created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}
	/*
	* Function call to get download activity
	*/
	public function get_download_Activity()
	{
		$query = $this->db->query("SELECT * FROM `downloadable_content` WHERE  DATE(created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get contact request activity
	*/
	public function get_contactRequest_Activity()
	{
		$query = $this->db->query("SELECT * FROM `contact_requests` WHERE `is_replied` = '1' AND DATE(created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get enquiry activity
	*/
	public function get_enquiry_Activity()
	{
		$query = $this->db->query("SELECT * FROM `enquiry_data` WHERE `is_replied` = '1' AND DATE(created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get last updated chapter activity
	*/
	public function get_updated_chapter_activity()
	{
		$query = $this->db->query("SELECT chapter_details.id, chapter_details.module_id, chapter_details.updated_at, module_details.course_title FROM `chapter_details` LEFT JOIN `module_details` ON `chapter_details`.`module_id` = `module_details`.`id` WHERE DATE(chapter_details.updated_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		$result = $query->result_array();
		if($result){
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get chapter test activity
	*/
	public function get_chapterTest_Activity()
	{
		$query = $this->db->query("SELECT chapter_test_settings.id, chapter_test_settings.chapter_id, chapter_test_settings.created_at, chapter_details.chapter_title FROM `chapter_test_settings` LEFT JOIN `chapter_details` ON `chapter_test_settings`.`chapter_id` = `chapter_details`.`id` WHERE DATE(chapter_test_settings.created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		$result = $query->result_array();
		if($result){
			return $result;
		}else{
				return false;
			}
	}
	
}