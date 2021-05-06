<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules_model extends CI_Model {

	/*
	* Function call - To fetch All Modules from db
	*/
	public function getAllModules() 
	{
		$this->db->select('
			module_details.*,
			module_details.instructor_id,
			users_details.fullname as fullname
		');
		$this->db->from('module_details');
		$this->db->join('users_details','users_details.id=module_details.instructor_id','LEFT');
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
	* Function call - To fetch single Module from db
	*/
	public function get_Module_details_ByID($ModuleID) 
	{
		$query = $this->db->get_where('module_details',array('id'=>$ModuleID));

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
	* Function call - To fetch All Instructors from db
	*/
	public function getAllInstructors() 
	{
		$query = $this->db->order_by('id','DESC')->get_where('users_details',array('user_type'=>'1'));

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
	* Function call to get discussion title
	*/
	public function get_Question_details_ByID($QuestionID)
	{
		$query = $this->db->get_where('module_questions', array('id' => $QuestionID));
		
		if($query->num_rows())
		{
			$result = $query->row_array();
			
			return $result;
		}else
		{
			return false;
		}
	}

	
	/*
	* Function call - To update Question details to database
	*/
	public function update_Question_details($QuestionID, $update_data)
	{
		$this->db->where(array('id'=>$QuestionID))->update('module_questions',$update_data);

		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
		{
			return false;
		}
	}

	
	/*
	* Function call - To insert New Module's data to database
	*/
	public function create_new_Module($new_module_data)
	{
		$this->db->insert('module_details',$new_module_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}

	/*
	* Function Call - To Update Module Details by ID
	*/
	public function update_Module_details($ModuleID, $update_module_data)
	{
		$this->db->where('id', $ModuleID);

		$this->db->update('module_details',$update_module_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	/*
	* Function call - To Delete existing Module's data from database
	*/
	public function delete_module($id)
	{
		$this->db->where('id', $id);

		$result = $this->db->delete('module_details');
		
		if ($result)
		{
			return true;
		}else 
			{
				return false;
			}
	}

	/*
	* Function call - To get Single Module Detail by ID from database
	*/
 	public function single_module_detail($moduleId)
	{
		$query = $this->db->select('
			module_details.*,
			module_details.instructor_id,
			(SELECT SUM(time_duration) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as total_time_duration,
			(SELECT count(*) FROM transaction_details WHERE transaction_details.module_id = module_details.id) as is_bought
		')->from('module_details')->join('users_details','users_details.id=module_details.instructor_id','LEFT')->where('module_details.id',$moduleId)->get();
		$result = $query->row_array();

		if (!empty($result)) 
		{
			// To get chapters related to this module
			$querydata = $this->db->order_by('id','ASC')->get_where('chapter_details',array('module_id'=>$moduleId));
			$resultdata = $querydata->result_array();
			$result['chapter_details'] = $resultdata;
			return $result;
		}else
		{
			return false;
		}
	}
	/*-------------------------------------------------------------------
						FINAL EXAM DATA HERE
	-------------------------------------------------------------------*/
	/*
	* Function call - To fetch single Chapter Test's setting Details from db
	*/
	public function get_final_exam_settings($where)
	{
		$query = $this->db->get_where('final_exam_settings',$where);

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
	* Function call - To insert New Chapter's data to database
	*/
	public function Update_finalExamSettings($updatewhere,$test_data)
	{
		$this->db->where($updatewhere)->update('final_exam_settings',$test_data);

		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	/*
	* Function call - To insert New Chapter's data to database
	*/
	public function create_finalExamSettings($test_data)
	{
		$this->db->insert('final_exam_settings',$test_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}

	/*-------------------------------------------------------------------
					CHAPTER question DATA
	-------------------------------------------------------------------*/
	/*
	* Function call - To insert New question's data to database
	*/
	public function create_new_question($question_data)
	{
		$this->db->insert('module_questions',$question_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}

	/*
	* Function call - To fetch All questions from db
	*/
	public function get_module_questions($moduleId)
	{
		$query = $this->db->order_by('id','ASC')->get_where('module_questions',array('module_id'=>$moduleId));

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
	* Function call - To Delete Question from database
	*/
	public function delete_Question($questionID)
	{
		$this->db->where('id', $questionID);

		$result = $this->db->delete('module_questions');
		
		if ($result) 
		{
			return true;
		}else 
			{
				return false;
			}
	}
}