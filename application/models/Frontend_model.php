<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_model extends CI_Model {

	/*
	* Function call - To fetch All Modules from db
	*/
	public function getAllModules()
	{
		$this->db->select('module_details.*,
			(SELECT COUNT(*) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as total_chapters,
			(SELECT AVG(reviews) FROM module_reviews WHERE module_id = module_details.id) as rating,
			(SELECT COUNT(*) FROM module_reviews WHERE module_id = module_details.id) as total_reviews,
			(SELECT SUM(time_duration) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as time_duration');
		$this->db->from('module_details');
		$this->db->order_by('id','ASC');
		$query = $this->db->get();
		$result = $query->result_array();
				
		if ($query->num_rows() > 0)
		{
			return $result;
		}else 
		{
			return false;
		}
	}


	/*
	* Function call - To fetch single Module Details to show at frontend
	*/
	public function get_single_module_details($moduleID,$subQuery)
	{
		$query = $this->db
			->select('module_details.*,
				module_details.instructor_id,
				users_details.fullname,
				users_details.designation,
				users_details.profile_image,
				(SELECT SUM(time_duration) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as total_time_duration,
			(SELECT AVG(reviews) FROM module_reviews WHERE module_id = module_details.id) as rating,
			(SELECT COUNT(*) FROM module_reviews WHERE module_id = module_details.id) as total_reviews,
				(SELECT count(*) FROM transaction_details WHERE transaction_details.module_id = module_details.id '.$subQuery.') as is_bought')
			->join('users_details','users_details.id=module_details.instructor_id','LEFT')
			->where('module_details.id',$moduleID)
			->get('module_details');
		$result = $query->row_array();

		if ($query->num_rows() > 0)
		{
			// To get chapters related to this module
			$querydata = $this->db->order_by('id','ASC')->get_where('chapter_details',array('module_id'=>$moduleID));
			$resultdata = $querydata->result_array();
			$result['chapter_details'] = $resultdata;

			return $result;
		}else 
		{
			return false;
		}
	}


	/*
	* Function call - To get all states
	*/
	public function getAllStates()
	{
		$query = $this->db->order_by('state_name','ASC')->get('states_table');

		$result = $query->result_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		}else 
		{
			return false;
		}
	}


	/*
	* Function call - To fetch single Module Details to show at frontend
	*/
	public function getProductDetails($moduleID)
	{
		$query = $this->db->get_where('module_details', array('id'=>$moduleID));

		$result = $query->row_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		}else 
		{
			return false;
		}
	}


	/*
	* Function Call - To get complete package details on checkout page
	*/
	public function getPackageDetails()
	{
		$query = $this->db->select('SUM(fee) as fee')->get('module_details');

		$result = $query->row_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To get Student's data from database
	*/
	public function student_login($condition)
	{
		$query = $this->db->get_where('users_details',$condition); //echo $this->db->last_query();
		
		$result = $query->row_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function call - check if student bought complete module
	*/
	public function checkCompleteModule($user_id)
	{
		$query = $this->db->get_where('transaction_details',array('user_id'=> $user_id, 'complete_package' => '1'));

		$result = $query->row_array();

		if (!empty($result)) {
			return $result;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To save enquiry form data in database.
	*/
	public function send_enquiry($data)
	{
		$this->db->insert('enquiry_data',$data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To save contact form data in database.
	*/
	public function save_contact_requests($data)
	{
		$this->db->insert('contact_requests',$data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To insert New Student's data into database
	*/
	public function create_new_student($dataArr)
	{
		$this->db->insert('users_details',$dataArr);

		if($this->db->affected_rows()> 0)
		{
			$studentID = $this->db->insert_id();

			$studentDetails = $this->frontend->student_login(array('id'=>$studentID));

			return $studentDetails;

		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To save transaction details into database
	*/
	public function saveTransactionDetails($transactionDetails)
	{
		$this->db->insert('transaction_details',$transactionDetails);

		if ($this->db->affected_rows() > 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}


	/*
	* Function call - To check if provided email is already exists in database.
	*/
	public function check_if_email_exists($emailid)
	{
		$query = $this->db->order_by('id','DESC')->get_where('users_details', array('email'=>$emailid));

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function Call - To get Total Sales
	*/
	public function getTopModules($limit)
	{
		$query = $this->db->select('COUNT(`transaction_details`.`module_id`) as `total_module_sales`, 
			module_details.course_title,
			module_details.course_image,
			module_details.fee
			')
		->from('transaction_details')
		->join('module_details','transaction_details.module_id=module_details.id','INNER')
		->group_by('transaction_details.module_id')
		->order_by('total_module_sales','DESC')
		->limit($limit)
		->get();
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
	* Function Call - To get student details and latest purchased module details.
	*/
	public function student_last_purchase($studentID)
	{
		$query = $this->db->select('
			transaction_details.module_id,
			users_details.fullname,
			users_details.phone,
			module_details.course_title,
			module_details.fee')->from('transaction_details')
		->join('users_details','transaction_details.user_id=users_details.id','LEFT')
		->join('module_details','transaction_details.module_id=module_details.id','LEFT')
		->where('transaction_details.user_id',$studentID)
		->order_by('transaction_details.id','DESC')->limit('1')->get();

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
	* Function Call - To get FAQ Content
	*/
	public function getFAQContent()
	{
		$query = $this->db->order_by('id','ASC')->get('faq_content');

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
	* Function Call - google search engine call
	**/
	public function google_search_engine($string)
	{
		$resultArr = array();
		// annountment result
		$q1 = $this->db->query("SELECT * FROM `announcement` WHERE `text` LIKE '%$string%' OR `banner_image` LIKE '%$string%' OR `alt_text` LIKE '%$string%' OR `start_date` LIKE '%$string%' OR `end_date` LIKE '%$string%' OR `user_type` LIKE '%$string%' OR `display` LIKE '%$string%'");
		$resultArr['announcements'] = $q1->result_array();

		// Chapter details
		$q2 = $this->db->query("SELECT * FROM `chapter_details` WHERE `chapter_title` LIKE '%$string%' OR `chapter_description` LIKE '%$string%' OR `content` LIKE '%$string%' OR `time_duration` LIKE '%$string%'");
		$resultArr['chapter_details'] = $q2->result_array();

		// FAQs
		$q3 = $this->db->query("SELECT * FROM `faq_content` WHERE `title` LIKE '%$string%' OR `description` LIKE '%$string%'");
		$resultArr['faq_content'] = $q3->result_array();
		
		// Module Details
		$q4 = $this->db->query("SELECT * FROM `module_details` WHERE `course_title` LIKE '%$string%' OR `fee` LIKE '%$string%' OR `brief_detail` LIKE '%$string%' OR `time_duration` LIKE '%$string%'");
		$resultArr['module_details'] = $q4->result_array();
		
		//echo "<pre/>"; print_r($resultArr);
		return $resultArr;
	}

	/*
	* Function call - To Check if user already exists or not
	*/
	public function check_if_userRegistered($where)
	{
		$query = $this->db->get_where('users_details', $where);
		if ($query->num_rows() > 0) 
		{
			$res = $query->row();
			return $res;
		}
	}
}