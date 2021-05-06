<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

	/*
	* Function call - To fetch All Students from db
	*/
	public function getAllStudents() 
	{
		$query = $this->db->order_by('id','DESC')->get_where('users_details',array('user_type'=>'2'));
		
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
	* Function call - To fetch single Student from db
	*/
	public function get_Student_details_ByID($StudentID) 
	{
		$query = $this->db->get_where('users_details',array('id'=>$StudentID));

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
	* Function call - To Delete existing Student's data from database
	*/
	public function delete_Student($id)
	{
		$this->db->where('id', $id);
		
		$result = $this->db->delete('users_details');
		
		if ($result) 
		{
			return true;
		}else 
		{
			return false;
		}
	}


	/*
	* Function Call - To update student account status
	*/
	public function updateStudentAccountStatus($StudentID,$studentArr)
	{
		$this->db->where('id', $StudentID);

		$this->db->update('users_details',$studentArr);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	/*
	* Function call - To Create Student Profile
	*/
	Public function create_student_profile($student_data)
	{
		$this->db->insert('users_details',$student_data);

		if ($this->db->affected_rows()> 0)
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


	public function update_student_profile($StudentID, $studentUpdate_data)
	{
		$this->db->where('id', $StudentID)->update('users_details',$studentUpdate_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To get data of students complete package 
	*/
	public function get_complete_packages_students_list()
	{
		$query = $this->db->select('td.*,ud.fullname, ud.email, ud.phone, ud.address')
		->join('users_details as ud','ud.id=td.user_id','LEFT')
		->get_where('transaction_details as td',array('td.complete_package'=>'1'));

		$result = $query->result_array();

		if(!empty($result)){
			return $result;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To get data of students complete package 
	*/
	public function get_complete_packages_students_result()
	{
		$query = $this->db->select('td.*,ud.fullname, ud.email, ud.phone, ud.address')
		->join('users_details as ud','ud.id=td.user_id','LEFT')
		->get_where('transaction_details as td',array('td.complete_package'=>'1'));

		$result = $query->result_array();

		if(!empty($result)){
			return $result;
		}else{
			return false;
		}
	}

}