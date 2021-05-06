<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapters_model extends CI_Model {

	/*
	* Function call - To fetch All Chapters from db
	*/
	public function getAllChapters() 
	{
		$this->db->select('chapter_details.*,chapter_details.module_id,module_details.course_title as module_title');
		$this->db->from('chapter_details');
		$this->db->join('module_details','module_details.id=chapter_details.module_id','Left');
		$this->db->order_by('chapter_details.id','ASC');
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
	* Function call - To fetch single Chapter from db
	*/
	public function get_chapter_details_ByID($ChapterID) 
	{
		$query = $this->db->get_where('chapter_details',array('id'=>$ChapterID));

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
	* Function call - To fetch single Chapter from db
	*/
	public function get_chapter_DiscussionForum($where)
	{
		$query = $this->db->select('chapter_discussion.*, users_details.profile_image', 'LEFT')->from('chapter_discussion')->join('users_details', 'chapter_discussion.user_id=users_details.id')->where($where)->get();

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
	* Function call to get discussion title
	*/
	public function get_single_discussionforum($discussionForum_id)
	{
		$query = $this->db
		->select('chapter_discussion.*, users_details.fullname, users_details.profile_image, ', 'LEFT')
		->join('users_details', 'chapter_discussion.user_id=users_details.id')
		->where(array('chapter_discussion.id' => $discussionForum_id))
		->get('chapter_discussion');

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
	* Function call for get Discussion forum comments
	*/
	public function get_discussion_comments($discussionForum_id)
	{
		$this->db->order_by('id','ASC')->select("discussion_comments.*, users_details.fullname, users_details.profile_image, chapter_discussion.discussion_title");
		$this->db->from("discussion_comments");
		$this->db->join('users_details', 'discussion_comments.user_id=users_details.id');
		$this->db->join('chapter_discussion', 'discussion_comments.discussion_forum_id=chapter_discussion.id');
		$this->db->where('discussion_forum_id=', $discussionForum_id);
		$query=$this->db->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
	
	/*
	* Function call to get discussion title
	*/
	public function get_Question_details_ByID($QuestionID)
	{
		$query = $this->db->get_where('chapter_questions', array('id' => $QuestionID));
		
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
	* Function call - To fetch single Chapter Test's setting Details from db
	*/
	public function get_chapter_test_details($where)
	{
		$query = $this->db->get_where('chapter_test_settings',$where);

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
	* Function call - To fetch All Modules from db
	*/
	public function getAllModules() 
	{
		$query = $this->db->order_by('id','ASC')->get_where('module_details');

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
	* Function call - To insert New Chapter's data to database
	*/
	public function create_new_Chapter($new_chapter_data)
	{
		$this->db->insert('chapter_details',$new_chapter_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}

	
	/*
	* Function call - To insert New Chapter's data to database
	*/
	public function create_chapterTestDetails($test_data)
	{
		$this->db->insert('chapter_test_settings',$test_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}

	
	/*
	* Function call - To insert New Chapter's data to database
	*/
	public function Update_chapterTestDetails($updatewhere,$test_data)
	{
		$this->db->where($updatewhere)->update('chapter_test_settings',$test_data);

		if ($this->db->affected_rows()> 0)
		{
			return true;
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
		$this->db->where(array('id'=>$QuestionID))->update('chapter_questions',$update_data);

		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To Update Chapter Details by ID
	*/
	public function update_chapter_details($ChapterID, $update_chapter_data)
	{
		$this->db->where('id', $ChapterID)->update('chapter_details',$update_chapter_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
			{
				return false;
			}
	}

	/*
	* Function Call - To Update Chapter Details by ID
	*/
	public function update_chapter_content_details($chapterID,$chapter_content_data)
	{
		$this->db->where('id', $chapterID);

		$this->db->update('chapter_details',$chapter_content_data);

		//die($this->db->last_query());
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	/*
	* Function call - To Delete existing Chapter's data from database
	*/
	public function delete_Chapter($chapterID)
	{
		$this->db->where('id', $chapterID);

		$result = $this->db->delete('chapter_details');
		
		if ($result) 
		{
			return true;
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
		$this->db->insert('chapter_questions',$question_data);

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
	public function get_chapter_questions($ChapterID)
	{
		$query = $this->db->order_by('id','ASC')->get_where('chapter_questions',array('chapter_id'=>$ChapterID));

		$result = $query->result_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		}else 
		{
			return false;
		}
	}
	/*-------------------------------------------------------------------
					CHAPTER TEST DATA
	-------------------------------------------------------------------*/
	/*
	* Function call - To fetch All ChapterTests from db
	*/
	public function getAllChapterTests() 
	{
		$query = $this->db->order_by('id','DESC')->get_where('chapter_test_data');

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
	* Function call - To fetch single ChapterTest from db
	*/
	public function get_chapter_test_data_ByID($ChapterTestID) 
	{
		$query = $this->db->get_where('chapter_test_data',array('id'=>$ChapterTestID));
		
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
	* Function call - To insert New ChapterTest's data to database
	*/
	public function create_new_ChapterTest($newChapter_test_data)
	{
		
		$this->db->insert('chapter_test_data',$newChapter_test_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
			{
				return false;
			}
	}

	/*
	* Function Call - To Update ChapterTest Details by ID
	*/
	public function update_chapter_test_data($ChapterTestID, $updateChapter_test_data)
	{
		
		$this->db->where('id', $ChapterTestID);

		$this->db->update('chapter_test_data',$updateChapter_test_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}else
			{
				return false;
			}
	}
	
	/*
	* Function call - To Delete existing ChapterTest's data from database
	*/
	public function delete_ChapterTest($id)
	{
		$this->db->where('id', $id);

		$result = $this->db->delete('chapter_test_data');
		
		if ($result) 
		{
			return true;
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

		$result = $this->db->delete('chapter_questions');
		
		if ($result) 
		{
			return true;
		}else 
			{
				return false;
			}
	}
}