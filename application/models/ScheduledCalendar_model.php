<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduledCalendar_model extends CI_Model {

	/*
	* Function Call - Read data using userID
	* Required Params - @userID
	*/
	public function instructor_detail($instructorId)
	{
		$query = $this->db->select('*')->from("users_details")->where(array('user_type'=>'1','users_details.id'=>$instructorId))->get();

		$result = $query->row_array();

		if ($query->num_rows() == 1)
		{
			return $result;
		}else
		{
			return false;
		}
	}
}