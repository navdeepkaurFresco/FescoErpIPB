<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model
{

/******************************************************************
Sales Report
******************************************************************/
	/*
	* Function call - To fetch sales data
	*/
	public function SalesReport($startdate,$enddate)
	{
		if(!empty($startdate) && !empty($enddate))
		{
			$where = array("DATE(`transaction_details`.`created_at`) >=" => $startdate,
				"DATE(`transaction_details`.`created_at`) <=" => $enddate );
		}else
		{
			$where = array('1'=>'1');
		}

		$query = $this->db->select('transaction_details.* , users_details.*,
					transaction_details.created_at as saledate')
			->join('users_details','transaction_details.user_id = users_details.id','LEFT')
			->order_by('transaction_details.created_at','DESC')
			->get_where('transaction_details',$where);

		$result = $query->result_array();

		if (!empty($result))
		{
			return $result;
		} else
		{
			return false;
		}
	}


	/*
	* Function call - To fetch sales data
	*/
	public function SalesReportLastYearCount()
	{
		$query = $this->db->query('SELECT COUNT(*) as total FROM `transaction_details` WHERE YEAR(created_at) != YEAR(CURRENT_DATE()) ');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['total'];
		} else
		{
			return false;
		}
	}

	/*
	* Function call - To fetch sales data
	*/
	public function SalesReportLastMonthsCount()
	{
		$query = $this->db->query('SELECT COUNT(*) as total FROM `transaction_details` WHERE YEAR(created_at) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(created_at) != MONTH(CURRENT_DATE()) ');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['total'];
		} else
		{
			return false;
		}
	}

	/*
	* Function call - To fetch sales data
	*/
	public function SalesReportThisMonthCount()
	{
// SELECT * FROM Member WHERE DATEPART(m, date_created) = DATEPART(m, DATEADD(m, -1, getdate())) AND DATEPART(yyyy, date_created) = DATEPART(yyyy, DATEADD(m, -1, getdate()))

// SELECT * FROM table WHERE MONTH(columnName) = MONTH(CURRENT_DATE()) AND YEAR(columnName) = YEAR(CURRENT_DATE())

		$query = $this->db->query('SELECT COUNT(*) as total FROM `transaction_details` WHERE YEAR(created_at) = YEAR(CURRENT_DATE()) AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND DATE(created_at) != CURDATE() ');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['total'];
		} else
		{
			return false;
		}
	}

	/*
	* Function call - To fetch sales data
	*/
	public function SalesReportTodayCount()
	{
		$query = $this->db->query('SELECT COUNT(*) as total FROM `transaction_details` WHERE DATE(created_at)= CURDATE()');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['total'];
		} else
		{
			return false;
		}
	}

	/*
	* Function call - To fetch sales data
	*/
	public function SalesReportTotalsellingCount()
	{
		$query = $this->db->query('SELECT COUNT(*) as total FROM `transaction_details`');

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['total'];
		} else
		{
			return false;
		}
	}

	/*
	* Function call - To get Module Titles to show on bar chart
	*/
	public function getModuleTitles()
	{
		$query = $this->db->select(' GROUP_CONCAT(`course_title` SEPARATOR "\',\'") as course_title')->order_by('id','ASC')->get('module_details');

		$result = $query->row_array();

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function call - To get Each Module Sales month vice to show on bar content
	*/
	public function getEachModuleSalesDateVice()
	{
		$query = $this->db->select(' DISTINCT DATE(`created_at`) as created_at')->order_by('created_at','DESC')->get('transaction_details');
		$DatesArr = $query->result_array();

		$mainArr = array();
		foreach ($DatesArr as $key => $value)
		{
			$getdate = $value['created_at'];
			$query2 = $this->db->select("id, (SELECT COUNT(transaction_details.module_id) FROM
        transaction_details WHERE transaction_details.module_id = module_details.id AND DATE(transaction_details.created_at) = '".$getdate."') AS module_count ")->get("module_details");
			$module_count = $query2->result_array();

			$countArr = array();
			foreach ($module_count as $key1 => $value1) {
				$countArr[] = $value1['module_count'];
			}
			$countString = implode(',', $countArr);
			$formattedDate = date("M d, Y", strtotime($getdate));
			$mainArr[] = "['".$formattedDate."', ".$countString." ]";
		}

		$result = implode(",", $mainArr);

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function call - To get Sales Bar Chart Content
	*/
	public function getSalesBarChartContent()
	{
		$query = $this->db->select(' GROUP_CONCAT(`course_title` SEPARATOR "\',\'") as course_title')->order_by('id','ASC')->get('module_details');

		$result = $query->row_array();

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

/******************************************************************
Transaction Report
******************************************************************/
	/*
	* Function call - To fetch All Transactions
	*/
	public function getAllTransactions($startdate,$enddate)
	{
		if(!empty($startdate) && !empty($enddate))
		{
			$where = array("DATE(`transaction_details`.`created_at`) >=" => $startdate,
				"DATE(`transaction_details`.`created_at`) <=" => $enddate );
		}else
		{
			$where = array('1'=>'1');
		}

		$query = $this->db->select('transaction_details.*,users_details.fullname,module_details.course_title')
		->join('users_details','users_details.id=transaction_details.user_id','LEFT')
		->join('module_details','module_details.id=transaction_details.module_id','LEFT')
		->order_by('transaction_details.id','ASC')
		->get_where('transaction_details',$where);
		
		$result = $query->result_array();
				
		if($query->num_rows() > 0)
		{
			return $result;
		}else 
		{
			return false;
		}
	}


	/*
	* Function Call - Payment Invoice Details
	*/
	public function get_invoice_details($invoiceID)
	{
		$query = $this->db->select('
			transaction_details.*,
			invoice_details.*,
			users_details.*,
			module_details.*')
		->join('invoice_details','invoice_details.id=1','LEFT')
		->join('users_details','users_details.id=transaction_details.user_id','LEFT')
		->join('module_details','module_details.id=transaction_details.module_id','LEFT')
		->get_where('transaction_details',array('transaction_details.id'=>$invoiceID));

		$result = $query->row_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		} else 
		{
			return false;
		}
	}

	/*
	* Function Call - get line chart content for enquiries
	*/
	public function getTransaction_linechartcontent()
	{
		$query = $this->db->select('COUNT(*) as total,created_at')->order_by('DATE(created_at)','ASC')->group_by('MONTH(created_at)')->limit('20')->get('transaction_details');

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
	* Function Call - get donut chart content for Transaction
	*/
	public function getTransaction_donutchartcontent()
	{
		$query = $this->db->select('module_details.course_title, (SELECT COUNT(*) FROM `transaction_details` WHERE `module_id` = module_details.id ) as total')->order_by('id','ASC')->get('module_details');

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

/******************************************************************
Student Report
******************************************************************/
	/*
	* Function call - To get Student Module progress Report
	*/
	public function getStudentModuleprogressReport()
	{
		$moduleQuery = $this->db
		->select('module_details.id as module_id, module_details.course_title, users_details.id as student_id, users_details.fullname, (SELECT COUNT(*) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as total_chapters,
			(SELECT GROUP_CONCAT(id) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as module_chapter_ids,
			(SELECT COUNT(*) FROM chaptertest_attempt WHERE chaptertest_attempt.student_id = users_details.id AND chaptertest_attempt.chapter_id IN (module_chapter_ids)) as module_progress ')
		->join('transaction_details','transaction_details.module_id = module_details.id','INNER')
		->join('users_details','users_details.id = transaction_details.user_id','INNER')
		->order_by('module_details.id','ASC')->get('module_details');
		$moduleResult = $moduleQuery->result_array();

		if (!empty($moduleResult))
		{
			return $moduleResult;
		}else
		{
			return false;
		}
	}


	/*
	* Function call - To get Student Module progress Report
	*/
	public function getStudentBadgeReport()
	{
		$query = $this->db
		->select('users_details.*, moduletest_result.*, 
			(SELECT AVG(percentage) FROM moduletest_result WHERE moduletest_result.completed = "1" AND moduletest_result.student_id = users_details.id) as overall_marks')
		->join('users_details','users_details.id = moduletest_result.student_id','INNER')
		->order_by('moduletest_result.id','DESC')->get('moduletest_result');
		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

/******************************************************************
Enquery Report
******************************************************************/
	/*
	* Function call - To get all enqueries from db
	*/
	public function getAllEnqueries($startdate,$enddate)
	{
		if(!empty($startdate) && !empty($enddate))
		{
			$where = array("DATE(`created_at`) >=" => $startdate,
				"DATE(`created_at`) <=" => $enddate );
		}else
		{
			$where = array('1'=>'1');
		}
		
		$query = $this->db->order_by('id','DESC')->get_where('enquiry_data',$where);

		$result = $query->result_array(); //echo $this->db->last_query();

		if(!empty($result))
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - get line chart content for enquiries
	* SELECT COUNT(*) as `total_enquiries`,`created_at`  FROM `enquiry_data` GROUP BY MONTH(`created_at`)
	*/
	public function getEnquiry_linechartcontent()
	{
		$query = $this->db->select('COUNT(*) as total_enquiries,created_at')->order_by('DATE(created_at)','ASC')->group_by('MONTH(created_at)')->limit('20')->get('enquiry_data');

		$resultARR = $query->result_array();

		if(!empty($resultARR))
		{
			return $resultARR;
		}else
		{
			return false;
		}
	}
}