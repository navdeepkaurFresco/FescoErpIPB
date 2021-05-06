<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

	/*
	* Function Call - To get the expenses of all months
	*/
	public function getAllMonthlyExpenses()
	{
		$query = $this->db->order_by('month_name','DESC')->get('monthly_expenses');

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
	* Function Call - To get the expenses of current month
	*/
	public function getCurrentMonthExpenses($month)
	{
		$query = $this->db->get_where('monthly_expenses',$month);

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
	* Function Call - To save Monthly expenses in DB
	*/
	public function saveMonthyExpenses($dataArr)
	{
		$this->db->insert('monthly_expenses',$dataArr);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


	/*
	* Function Call - To update Monthly expenses in DB
	*/
	public function update_monthly_expenses($month,$dataArr)
	{
		$this->db->where('month_name', $month)->update('monthly_expenses',$dataArr);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	/*
	* Function call - To get the invoice setting details.
	*/
	public function getInvoiceSettings()
	{
		$query = $this->db->get_where('invoice_details');

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
	* Function call - To update invoice details
	*/
	public function update_invoice_details($dataArr)
	{
		$this->db->where('id','1')->update('invoice_details',$dataArr);
		
		if ($this->db->affected_rows() > 0)
		{
			return true;
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
	* Function Call - To get single FAQ's content
	*/
	public function getSingleFAQ($faqID)
	{
		$query = $this->db->get_where('faq_content',array('id'=>$faqID));

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
	* Function Call - Add New FAQ
	*/
	public function CreateNewFAQ($dataArr)
	{
		$this->db->insert('faq_content',$dataArr);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


	/*
	* Function Call - update existing FAQ
	*/
	public function update_FAQ($id,$dataArr)
	{
		$this->db->where('id',$id)->update('faq_content',$dataArr);

		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}

	/*
	* Function Call - Add New FAQ
	*/
	public function save_downloadable_content($dataArr)
	{
		$this->db->insert('downloadable_content',$dataArr);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


	/*
	* Function Call - To get all the downloadable content from db.
	*/
	public function get_downloadable_content()
	{
		$query = $this->db->order_by('id','DESC')->get('downloadable_content');

		$result = $query->result_array();

		if($result)
		{
			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To delete file via ajax call.
	*/
	public function delete_file_by_id($fileID)
	{
		$result = $this->db->where('id',$fileID)->delete('downloadable_content');

		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}

}