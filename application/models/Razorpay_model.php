<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razorpay_model extends CI_Model {

	public function getProduct()
	{
		$query = $this->db->get('module_details');

		$result = $query->result_array();

		if ($result)
		{
			return $result;
		}else
		{
			return false;
		}
	}


	public function getProductDetails()
	{
		$query = $this->db->get_where('module_details',array('id','2'));

		$result = $query->row_array();

		if ($result)
		{
			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To fetch all the modules bought by student ID
	*/
	public function get_bought_modules($studentID)
	{
		$query = $this->db->select('module_details.*')->from('module_details')->join('transaction_details','module_details.id = transaction_details.module_id','INNER')->where('transaction_details.user_id',$studentID)->get();

		$result = $query->result_array();

		if($query->num_rows()>0){
			return $result;
		}else{
			return false;
		}
	}


	/*
	* Function call - To fetch All Modules from db
	*/
	public function getAllModules($studentID)
	{
		$query = $this->db->select('
			module_details.*,
			(SELECT COUNT(*) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as total_chapters,
			(SELECT count(*) FROM transaction_details WHERE transaction_details.module_id = module_details.id AND transaction_details.user_id = '.$studentID.') as is_bought
		')->from('module_details')->order_by('id','ASC')->get();
		$result = $query->result_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		}else 
		{
			return false;
		}
	}
}