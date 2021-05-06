<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	/*
	* Read data using username and password
	*/
	public function login($condition)
	{
		$query = $this->db->get_where('users_details',$condition);

		$result = $query->row_array();

		if ($query->num_rows() == 1)
		{
			return $result;
		}else
		{
			return false;
		}
	}

	public function checkEmail($emailCondition)
	{
		$query = $this->db->get_where('users_details',$emailCondition);

		$result = $query->row_array();

		if ($query->num_rows() == 1) 
		{
			return $result;
		}else
		{
			return false;
		}
	}

	public function storeReset_code($email, $pwd_reset_code)
	{
		$this->db->where('email', $email);

		$this->db->update('users_details', $pwd_reset_code);

		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
		{
			return false;
		}

	}

	public function changePassword($resetcode, $newPassword)
	{
		$this->db->where('pwd_reset_code', $resetcode);

		$this->db->update('users_details', $newPassword);
		return $this->db->affected_rows();
		
	}
	public function update_data($tablename, $data, $where)
	{
		$this->db->where($where);
		$this->db->update($tablename, $data);

		if ($this->db->affected_rows()> 0) 
		{
			return true;
		}else 
		{
			return false;
		}
	}
	public function updateDetails($tablename, $dataToUpdate, $whereCondition)
  	{
	    $this->db->where($whereCondition);
	    $this->db->update($tablename,$dataToUpdate);
	    return $this->db->affected_rows();
  	}
}