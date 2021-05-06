<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement_model extends CI_Model {

	/*
	* Function call - To create headlines to database.
	*/
	public function createHeadline($headlineData)
	{
		$this->db->insert('announcement', $headlineData);

		if ($this->db->affected_rows()> 0)
		{
			return $result = $this->Announcement_model->get_Headlines();
			 // $this->db->insert_id();
		}else
			{
				return false;
			}
	}

	/*
	* Function call - To create news to database.
	*/
	public function createNews($newsData)
	{
		$this->db->insert('announcement', $newsData);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
			{
				return false;
			}
	}

	/*
	* Function call - To create banners to database.
	*/
	public function createBanner($bannerData)
	{
		$this->db->insert('announcement', $bannerData);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
			{
				return false;
			}
	}

	/*
	* Function call - To get all headlines.
	*/
	public function get_Headlines()
	{
		$query = $this->db->order_by('text_id','DESC')->get_where('announcement', array('category'=>'1'));
		
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
	* Function call - To get all headlines.
	*/
	public function get_News()
	{
		$query = $this->db->order_by('text_id','DESC')->get_where('announcement', array('category'=>'2'));
		
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
	* Function call - To get all banners.
	*/
	public function get_Banners()
	{
		$query = $this->db->order_by('text_id','DESC')->get_where('announcement', array('category'=>'3'));
		
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
	* Function call - To Delete Headline from database by ID.
	*/


	public function delete_Headline($headlineID)
	{
		$this->db->where('text_id', $headlineID);

		$result = $this->db->delete('announcement');
		
		if ($result) 
		{
			return true;
		}else 
			{
				return false;
			}
	}

	/*
	* Function call - To Delete news from database by ID.
	*/


	public function delete_News($newsID)
	{
		$this->db->where('text_id', $newsID);

		$result = $this->db->delete('announcement');
		
		if ($result) 
		{
			return true;
		}else 
			{
				return false;
			}
	}

	/*
	* Function call - To Delete Banner from database by ID.
	*/

	public function delete_Banner($bannerID)
	{
		$this->db->where('text_id', $bannerID);

		$result = $this->db->delete('announcement');
		
		if ($result) 
		{
			return true;
		}else 
			{
				return false;
			}
	}

	/*
	* Function call - To get headline detail from database by ID.
	*/
	public function get_headline_details_ByID($headline_ID)
	{
		$query = $this->db->get_where('announcement', array('text_id' => $headline_ID));

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
	* Function call - To get news detail from database by ID.
	*/
	public function get_news_details_ByID($newsID)
	{
		$query = $this->db->get_where('announcement', array('text_id' => $newsID));

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
	* Function call - To get banner detail from database by ID.
	*/

	public function get_banner_details_ByID($bannerID)
	{
		$query = $this->db->get_where('announcement', array('text_id' => $bannerID));

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
	* Function Call - To Update headline Details by ID
	*/
	public function update_Headline($headline_ID, $headlineData)
	{
		$this->db->where('text_id', $headline_ID);

		$this->db->update('announcement',$headlineData);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}

	/*
	* Function Call - To Update news Details by ID
	*/
	public function update_News($newsID, $update_newsData)
	{
		$this->db->where('text_id', $newsID);

		$this->db->update('announcement',$update_newsData);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}

	/*
	* Function Call - To Update banner Details by ID
	*/
	public function updateBanner($bannerID, $update_bannerData)
	{
		$this->db->where('text_id', $bannerID);

		$this->db->update('announcement',$update_bannerData);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}

	/*
	* Function call - To change the display value of announcement from database.
	*/

	public function Update_display_value($announcementID, $display_value)
	{
		$this->db->where('text_id', $announcementID);

		$this->db->update('announcement', $display_value);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}

	/*
	* Function call - To get announcement Details for display value from database.
	*/

	public function get_announcementDetails($announcementID)
	{
		$query = $this->db->get_where('announcement', array('text_id' => $announcementID));

		$result = $query->row_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		}else 
			{
				return false;
			}
	}

}