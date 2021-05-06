<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InstructorPanel_model extends CI_Model {

	/*
	* Function Call - Read data using userID
	* Required Params - @userID
	*/
	public function get_single_instructor_details($userID)
	{
		$query = $this->db->get_where('users_details', array('user_type'=>'1','users_details.id'=>$userID));

		$result = $query->row_array();

		if ($query->num_rows() == 1)
		{
			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To get Single Instructor Courses Details
	* Required Params - @instructorId
	*/
	public function get_courses_details($instructorId)
	{
		$query = $this->db->get_where('module_details', array('instructor_id'=>$instructorId));

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
	* Function Call - To get chapter list for discussion Forums
	*/
	public function get_Chapter_for_Discussion($where)
	{
		$query = $this->db->select('chapter_details.chapter_title, chapter_discussion.chapter_id')->from('chapter_discussion')->join('chapter_details', 'chapter_discussion.chapter_id=chapter_details.id', 'INNER')->where_in('chapter_discussion.chapter_id', $where)->group_by('chapter_discussion.chapter_id')->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To get all details of single course by ID
	*/
	public function get_single_course_details($courseId)
	{
		$query = $this->db->get_where('module_details',array('id'=>$courseId));

		$result = $query->row_array();

		if($query->num_rows() == 1)
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Function call to get chapter of single module
	*/
	public function getchaptersofSingleModule($courseId)
	{
		$querydata = $this->db->order_by('id','ASC')->get_where('chapter_details',array('module_id'=>$courseId));    
    	$resultdata = $querydata->result_array(); 
		if(!empty($resultdata)){
			return $resultdata;
		}
		else{
			return false;
		}
	}

	/*
	* Function Call - To Update Admin Details by ID
	*/
	public function update_instructor_details($instructorId, $updateInstructor_details_data)
	{
		
		$this->db->where('id', $instructorId);

		$this->db->update('users_details',$updateInstructor_details_data);
		
		if ($this->db->affected_rows()> 0)
		{
			$result = $this->instructor_model->get_single_instructor_details($instructorId);

			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To Update Admin Password by ID
	*/
	public function update_instructor_password($instructorId, $updateInstructor_pwd_data)
	{
		
		$this->db->where('id', $instructorId);

		$this->db->update('users_details',$updateInstructor_pwd_data);
		
		if ($this->db->affected_rows()> 0)
		{
			$result = $this->instructor_model->get_single_instructor_details($instructorId);

			return $result;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To Update Admin Image by ID
	*/
	public function update_instructor_Image($instructorId, $updateInstructor_image_data)
	{
		
		$this->db->where('id', $instructorId);
		
		$this->db->update('users_details',$updateInstructor_image_data);
		
		if ($this->db->affected_rows()> 0)
		{
			$result = $this->instructor_model->get_single_instructor_details($instructorId);
			return $result;
		}else{
			return false;
		}
	}

	/*
	   * get current password of instructor 
	*/
	public function getCurrent_pwd($instructorId)
	{
		$query= $this->db->select("id, password")->from("users_details")->where("id", $instructorId)->get();

		if ($query->num_rows() > 0)
		{
			return $query->row();
		}else
		{
			return false;
		}
	}

	public function check_if_password_correct($instructorId, $Curr_Password)
	{
		$query= $this->db->get_where('users_details',array('id'=>$instructorId,'password'=>$Curr_Password));

		$resultdata = $query->row_array();

		if(!empty($resultdata))
		{
			return $resultdata;
		}
		else
		{
			return false;
		}
	}

	/*
	* Function Call - to check if student username is already exist on database or not
	*/

	/*public function check_if_username_match($where)
	{
		$query = $this->db->get_where('users_details',$where);

		$resultdata = $query->row_array();

		if(!empty($resultdata))
		{
			return $resultdata;
		}
		else
		{
			return false;
		}
	}*/

	/*
	* Function Call - get states from database
	*/
	/*public function get_States()
	{
		$query = $this->db->get('states');

		$result = $query->result_array();

		if ($query->num_rows() > 0) 
		{
			return $result;
		}else
		{
			return false;
		}
	}*/

	/*
	* Function Call - get instructor district from database
	*/
	/*public function get_district($stateId)
	{
		$query = $this->db->get_where('districts', array('state_id' => $stateId));

		$result = $query->result_array();

		if ($query->num_rows() > 0) 
		{
			return $result;
		}else
		{
			return false;
		}
	}*/

	/*
	* Function Call - get headlines from database
	*/
	public function get_allHeadlines($where_headline)
	{
		$query = $this->db->get_where('announcement',$where_headline);

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}
		else
			{
				return false;
			}
	}

	/*
	* Function Call - get news from database
	*/
	public function get_allNews($where_news)	
	{
		$query = $this->db->get_where('announcement',$where_news);

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}
		else
			{
				return false;
			}
	}

	/*
	* Function Call - get banner from database
	*/
	public function get_allBanners($where_banner)	
	{
		$query = $this->db->get_where('announcement',$where_banner);

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}
		else
			{
				return false;
			}
	}

	public function scheduled_Detail($scheduled_Data)
	{
		$this->db->insert('instructor_scheduledDetail', $scheduled_Data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
			{
				return false;
			}
	}

	public function get_ScheduledDetails()
	{
		$query = $this->db->order_by('id','DESC')->get('instructor_scheduledDetail');
		
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
	* Function Call - To get Single Instructor Courses Details
	* Required Params - @instructorId
	*/
	public function get_course($instructorId)
	{
		$query = $this->db->get_where('module_details', array('instructor_id'=>$instructorId));

		$result = $query->row_array();

		if($query->num_rows() > 0)
		{
			return $result;
		}else
		{
			return false;
		}
	}

	/*
	* Check If User Setting exists
	*/
	public function userSettingExists($where){

		$res = $this->db->get_where("user_settings", $where);
		return $res->num_rows();
	}

	/*
	* Update User Settings
	*/
	public function updateUserSettings($data, $where){

		$this->db->where($where)->update("user_settings", $data);
		return $this->db->affected_rows();
	}

	/*
	* Insert User Settings
	*/
	public function insertUserSettings($data){

		$this->db->insert("user_settings", $data);
		return $this->db->insert_id();
	}

	/*
	* Get User Settings
	*/
	public function getUserSettings($where){

		$res = $this->db->get_where("user_settings", $where);
		if($res->num_rows()){
			$result = $res->result();
			return $result;
		} else {
			return false;
		}
	}

	public function getAppointments($where){

		$res = $this->db->get_where("appointments",$where);
		if($res->num_rows()){
			$result = $res->result();
			return $result;
		} else {
			return false;
		}
	}

	/*
	* Get schedule appointment details of student
	*/
	public function scheduled_appointmentDetails($studentID)
	{
		$this->db->select("appointments.id, appointments.user_id, appointments.start_datetime, appointments.module_id,
							users_details.fullname, users_details.phone, users_details.skype_id,
							module_details.course_title");
		$this->db->from("appointments")->join('users_details', 'appointments.user_id=users_details.id', 'LEFT')->join('module_details', 'appointments.module_id=module_details.id', 'LEFT');
		$this->db->where('user_id', $studentID);
		$res = $this->db->get();
		if($res->num_rows()){
			$result = $res->row_array();
			return $result;
		} else {
			return false;
		}
	}

	/* Start tmp methods Need to remove the code */

	public function getMyMoudles($where){

		$res = $this->db->get_where("transaction_details", $where);
		if($res->num_rows()){
			$result = $res->result();
			return $result;
		} else {
			return false;
		}
	}

	public function getInstructorByModule($where){

		$res = $this->db->get_where("module_details", $where);
		if($res->num_rows()){
			$result = $res->result();
			return $result;
		} else {
			return false;
		}
	}

	public function getAvailability($where) {

		$res = $this->db->get_where("user_settings", $where);
		if($res->num_rows()){
			$result = $res->result();
			return $result;
		} else {
			return false;
		}
	}

	/* End tmp methods Need to remove the code */

	/*
	* Function call to get updated profile on current date 
	*/
	public function get_profile_activity($instructorId)
	{
		/*$date = new DateTime("now");
 		$curr_date = $date->format('Y-m-d');
		$query = $this->db->get_where('users_details', array('id' => $instructorId , 'DATE(updated_at)' => $curr_date));*/
		$query = $this->db->query("SELECT * FROM `users_details` WHERE `id` = '".$instructorId."' AND DATE(updated_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
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
	* Function call to get last updated working plan 
	*/

	public function get_updated_workingPlan($instructorId)
	{

		$query = $this->db->query("SELECT * FROM `user_settings` WHERE `instructor_id` = '".$instructorId."' AND DATE(updated) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
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
	* Function call to get last updated or created course for instructor 
	*/
	public function get_last_assignedCours($instructorId)
	{

		$query = $this->db->query("SELECT * FROM `module_details` WHERE (DATE(created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) OR DATE(updated_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) ) AND `instructor_id` = '".$instructorId."'");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get appointment list by instructor id from database
	*/
	public function get_appointment_activity($instructorId)
	{

		$query = $this->db->query("SELECT * FROM `appointments` LEFT JOIN `users_details` ON `appointments`.`user_id` = `users_details`.`id` WHERE `instructor_id` = '".$instructorId."' AND DATE(book_datetime) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get total assigned modules to instructor
	*/
	public function get_total_modules($where)
	{
		$res = $this->db->get_where("module_details", $where);
		if($res->num_rows()){
			$result = $res->result_array();
			return count($result);
		} else {
			return false;
		}
	}

	/*
	* Function call to get total scheduled skype interview of instructor
	*/
	public function get_total_schedules_interview($where_cond)
	{
		$res = $this->db->get_where("appointments", $where_cond);
		if($res->num_rows()){
			$result = $res->result_array();
			return count($result);
		} else {
			return false;
		}
	}

	/*
	* Function call to get total completed scheduled skype interview for widget
	*/
	public function get_total_completed_interview($where_appointment)
	{
		$res = $this->db->get_where("appointments", $where_appointment);
		if($res->num_rows()){
			$result = $res->result_array();
			return count($result);
		} else {
			return false;
		}
	}

	/*
	* Function call to get total completed scheduled skype interview for activity
	*/
	public function get_complete_appointment_activity($instructorId)
	{
		$res = $this->db->query("SELECT * FROM `appointments` LEFT JOIN `users_details` ON `appointments`.`user_id` = `users_details`.`id` WHERE `instructor_id` = '".$instructorId."' AND DATE(end_datetime) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) AND `completed` = 1");
		if($res->num_rows()){
			$result = $res->result_array();
			return $result;
		} else {
			return false;
		}
	}

	/*
	* Function call to get id of total assigned chapter to instructor
	*/
	public function get_chapter_Ids($instructorId)
	{
		$query = $this->db->select('chapter_details.id')->from('chapter_details')->join('module_details', 'chapter_details.module_id=module_details.id', 'INNER')->where('module_details.instructor_id', $instructorId)->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		} else {
			return false;
		}
	}

	/*
	* Function call to get discussion titles of chapter
	*/
	public function get_chapter_discussionTitle($chapterID)
	{
		$query = $this->db->select('chapter_discussion.*, users_details.profile_image')->from('chapter_discussion')->join('users_details', 'chapter_discussion.user_id=users_details.id', 'LEFT')->where('chapter_id', $chapterID)->get();
		if ($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call for get comments on discussion 
	*/
	public function get_discussionTitle_comments($titleID)
	{
		$query = $this->db->select('discussion_comments.*, users_details.fullname, users_details.profile_image')->from('discussion_comments')->join('users_details', 'discussion_comments.user_id=users_details.id', 'LEFT')->where('discussion_forum_id', $titleID)->get();
		// echo $this->db->last_query();
		if ($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call for get single discussion title by title id
	*/
	public function get_discussionTitles($titleID)
	{
		$query = $this->db->get_where('chapter_discussion', array('id'=>$titleID));
		if ($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
		Function call for submit comments on discussions
	*/
	public function submit_discussionComments($commentData)
	{
		$this->db->insert('discussion_comments',$commentData);

		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function call for get last Discussion forum comments for append comment row
	*/
	public function get_lastComment($result)
	{
		$this->db->order_by('id','ASC')->select("discussion_comments.*, users_details.fullname, users_details.profile_image");
		$this->db->from("discussion_comments");
		$this->db->join('users_details', 'discussion_comments.user_id=users_details.id');
		$this->db->where('discussion_comments.id=', $result);
		$query=$this->db->get();
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call for discussion activites
	*/
	public function get_discussions_activity($instructorId)
	{
		$query = $this->db->query("SELECT `discussion_comments`.*, chapter_details.chapter_title,`chapter_discussion`.`chapter_id` FROM `discussion_comments` LEFT JOIN `chapter_discussion` ON `discussion_comments`.`discussion_forum_id`=`chapter_discussion`.`id` LEFT JOIN `chapter_details` ON `chapter_discussion`.`chapter_id`=`chapter_details`.`id` WHERE `discussion_comments`.`user_id` = '".$instructorId."' AND DATE(discussion_comments.created) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function Call - To get chapter list for discussion Forums
	*/
	public function get_DiscussionForum_count($where)
	{
		$query = $this->db->select('chapter_details.chapter_title, chapter_discussion.chapter_id')->from('chapter_discussion')->join('chapter_details', 'chapter_discussion.chapter_id=chapter_details.id', 'INNER')->where_in('chapter_discussion.chapter_id', $where)->get();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return count($result);
		}else{
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