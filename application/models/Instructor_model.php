<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_model extends CI_Model {

	/*
	* Function call - To fetch All Instructors from db
	*/
	public function getAllInstructors()
	{
		$query = $this->db->order_by('id','DESC')->get_where('users_details', array('user_type'=>'1'));
		
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
	* Function call - To fetch single Instructor from db
	*/
	public function get_instructor_details_ByID($instructorID) 
	{
		$query = $this->db->get_where('users_details', array('id'=>$instructorID));

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
	* Function call - To insert New Instructor's data to database
	*/
	public function create_new_instructor($create_instructor_data)
	{
		$this->db->insert('users_details',$create_instructor_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function Call - To Update Instructor Details by ID
	*/
	public function update_instructor_details($instructorID, $update_instructor_data)
	{
		$this->db->where('id', $instructorID);

		$this->db->update('users_details',$update_instructor_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To Update Instructor Password by ID
	*/
	public function update_instructor_password($instructorID, $update_instructor_password)
	{
		
		$this->db->where('id', $instructorID);

		$this->db->update('users_details',$update_instructor_password);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To Update Instructor Image by ID
	*/
	public function update_instructor_Image($instructorID, $instructor_image_data)
	{
		
		$this->db->where('id', $instructorID);

		$this->db->update('users_details',$instructor_image_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	/*
	* Function call - To Delete existing Instructor's data from database
	*/
	public function delete_instructor($id)
	{
		$this->db->where('id', $id);

		$result = $this->db->delete('users_details');
		
		if ($result) {
			return true;
		} else {
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

	public function checkMail_exist($email_id)
	{
		$query = $this->db->get_where('users_details', array('email' => $email_id));

		$result = $query->row();

		if (!empty($result)) 
		{
			return $result;
		}else
		{
			return false;
		}
	}
}