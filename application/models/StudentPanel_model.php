<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentPanel_model extends CI_Model {

	/*
	* Function Call - To get login student's details
	*/
	public function get_login_student_details($studentID)
	{
		$query = $this->db->get_where('users_details', array('users_details.id'=>$studentID, 'user_type'=>'2'));

		$result = $query->row_array();

		if($result)
		{
			return $result;
		}
		else
		{
			return false;
		}
	}


	/*
	* Function Call - Payment Invoice Details
	*/
	public function get_invoice_details($invoiceID)
	{
		$query = $this->db->select('
			transaction_details.*,
			invoice_details.*,
			users_details.*,
			module_details.*')
		->join('invoice_details','invoice_details.id=1','LEFT')
		->join('users_details','users_details.id=transaction_details.user_id','LEFT')
		->join('module_details','module_details.id=transaction_details.module_id','LEFT')
		->where('transaction_details.id',$invoiceID)
		->get('transaction_details');

		$result = $query->row_array();

		if ($query->num_rows() > 0)
		{
			return $result;
		} else 
		{
			return false;
		}
	}



	/*
	* Function call - To fetch All Modules from db
	*/
	public function getAllModules($studentID)
	{
		if(!empty($studentID)){
			$where = ",(SELECT COUNT(*) FROM transaction_details WHERE transaction_details.module_id = module_details.id AND transaction_details.user_id = '".$studentID."') as is_bought,
			,(SELECT COUNT(*) FROM transaction_details WHERE transaction_details.complete_package = '1' AND transaction_details.user_id = '".$studentID."') as bought_complete_module";
		}else{
			$where = '';
		}
		$query = $this->db->select('
			module_details.*,
			(SELECT COUNT(*) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as total_chapters,
			(SELECT AVG(reviews) FROM module_reviews WHERE module_id = module_details.id) as rating,
			(SELECT COUNT(*) FROM module_reviews WHERE module_id = module_details.id) as total_reviews
			'.$where)->from('module_details')->order_by('id','ASC')->get();
		$result = $query->result_array();

		if ($query->num_rows() > 0)
		{
			if(empty($studentID)){
				foreach ($result as $key => $value) {
					$result[$key]['is_bought'] = '0';
					$result[$key]['bought_complete_module'] = '0';
				}
			}
			
			return $result;
		}else 
		{
			return false;
		}
	}


	/*
	* Function call - To fetch single Module Details to show at frontend
	*/
	public function get_single_module_details($moduleID)
	{
		$query = $this->db
		->select('module_details.*,users_details.fullname,users_details.designation,users_details.profile_image,
			(SELECT SUM(time_duration) FROM chapter_details WHERE chapter_details.module_id = module_details.id) as total_time_duration')
		->join('users_details','users_details.id=module_details.instructor_id','LEFT')
		->get_where('module_details',array('module_details.id'=>$moduleID));
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
	* Function Call - To get Student's data from database
	*/
	public function student_login($condition)
	{
		$query = $this->db->get_where('users_details',$condition);
		
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
	* Function call - check if student bought complete module
	*/
	public function checkCompleteModule($user_id)
	{
		$query = $this->db->get_where('transaction_details',array('user_id'=> $user_id, 'complete_package' => '1'));

		$result = $query->row_array();

		if (!empty($result)) {
			return $result;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To fetch all the modules bought by student ID
	*/
	public function get_bought_modules($studentID)
	{
		$checkcompletemodulebuy = $this->student_model->checkCompleteModule($studentID);

		if (!empty($checkcompletemodulebuy)) {
			$query = $this->db->get('module_details');
		}else{
			$query = $this->db->select('module_details.*')->from('module_details')->join('transaction_details','module_details.id = transaction_details.module_id','INNER')->where('transaction_details.user_id',$studentID)->get();
		}

		$result = $query->result_array();

		if($query->num_rows()>0){
			return $result;
		}else{
			return false;
		}
	}


	/*
	* Function Call - To get chapter of single module.
	*/
	public function getchaptersofSingleModule($moduleID)
	{
		$querydata = $this->db->order_by('id','ASC')->get_where('chapter_details',array('module_id'=>$moduleID));
    
    $resultdata = $querydata->result_array(); //echo $this->db->last_query();
    
		if(!empty($resultdata)){
			return $resultdata;
		}
		else{
			return false;
		}
	}



	/*
	* Function Call - To show content of single chapter.
	*/
	public function get_chapter_details($chapterID)
	{
		$query = $this->db->get_where('chapter_details',array('id'=>$chapterID));

		$result = $query->row_array();
		if(!empty($result)){
			return $result;
		}
		else{
			return false;
		}
	}


	/*
	* Function Call - To get total Enquiry Requests
	*/
	public function getCompletedModules($where_studentID)
	{
		$query = $this->db->select('count(completed) as totalcalls')->get_where('appointments',$where_studentID);

		$result = $query->row_array();

		if (!empty($result))
		{
			return $result['totalcalls'];
		}else
		{
			return false;
		}
	}



	/*
	* Function Call - To save enquiry form data in database.
	*/
	public function send_enquiry($data)
	{
		$this->db->insert('enquiry_data',$data);

		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


	/*
	* Function Call - To insert New Student's data into database
	*/
	public function create_new_student($dataArr)
	{
		$this->db->insert('users_details',$dataArr);

		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}


	/*
	* Function Call - To Update Student Details by ID
	*/
	public function update_student_profile_details($studentID, $dataArr)
	{
		$this->db->where('id', $studentID)->update('users_details',$dataArr);
		
		if($this->db->affected_rows() > 0)
		{
			$LoginStudentDetails = $this->student_model->get_login_student_details($studentID);

			return $LoginStudentDetails;

		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To Update Student Password by ID
	*/
	public function update_student_password($studentID, $update_pasword_data)
	{
		
		$this->db->where('id', $studentID);

		$this->db->update('users_details',$update_pasword_data);
		
		if ($this->db->affected_rows()> 0)
		{
			return true;
		}
		else{
			return false;
		}
	}


	/*
	* Function Call - To Update Student Image by ID
	*/
	public function update_student_Image($studentID, $update_image_data)
	{
		$this->db->where('id', $studentID);

		$this->db->update('users_details',$update_image_data);
		
		if ($this->db->affected_rows()> 0)
		{
			$LoginStudentDetails = $this->student_model->get_login_student_details($studentID);

			return $LoginStudentDetails;
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To match the password
	*/
	public function check_if_password_match($studentID,$password)
	{
		$query = $this->db->get_where('users_details',array('id'=>$studentID,'password'=>$password));

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
	* Function Call - get student's payment history
	*/
	public function get_all_transactions($studentID)
	{
		$query = $this->db->select('transaction_details.*,users_details.fullname,module_details.course_title')->join('users_details','transaction_details.user_id = users_details.id','LEFT')->join('module_details','module_details.id=transaction_details.module_id','LEFT')->order_by('transaction_details.id','DESC')->get_where('transaction_details',array('transaction_details.user_id'=>$studentID));

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

	/*
	* Function Call - get appointment details of instructor from database
	*/
	public function get_allAppointmentDetails($moduleID)
	{
		$query = $this->db->get_where('instructor_scheduledDetail',array('module_id'=>$moduleID));

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
	* Function Call - get bought module id from database
	*/
	public function get_boughtModule_ID($studentID)
	{
		$query = $this->db->get_where('transaction_details',array('user_id'=>$studentID));

		$result = $query->row_array();

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
	* Function Call - get Instructor id from database
	*/
	public function get_Instructor_Id($moduleID)
	{
		$query = $this->db->get_where('module_details',array('id'=>$moduleID));

		$result = $query->row_array();

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
	* Function Call - get Instructor details by id from database
	*/
	public function get_Instructor_detail($instructorID)
	{
		$query = $this->db->get_where('users_details',array('id'=>$instructorID));

		$result = $query->row_array();

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
	* Function Call - Submit scheduled details of student on database
	*/

	public function submit_scheduled_data($scheduled_data)
	{
		$this->db->insert('student_scheduledDetail',$scheduled_data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function Call - get all scheduled details of student from database
	*/

	/*public function get_all_scheduledAppointments($studentID)
	{
		$query = $this->db->get_where('student_scheduledDetail',array('student_id'=>$studentID));

		$result = $query->result_array();

		if(!empty($result))
		{
			return $result;
		}
		else
			{
				return false;
			}
	}*/

	/*
	* Function Call - get appointment details of instructor by appointment id from database
	*/
	/*public function get_singleAppointmentDetail($appointment_id)
	{
		$query = $this->db->get_where('instructor_scheduledDetail',array('id'=>$appointment_id));

		$result = $query->row_array();

		if(!empty($result))
		{
			return $result;
		}
		else
			{
				return false;
			}
	}*/

	/*
	* Function Call - update instructor scheduled status from available to booked
	*/

	/*public function update_InstructorSchedule_status($appointment_id, $update_status)
	{
		$this->db->where('id', $appointment_id);

		$this->db->update('instructor_scheduledDetail',$update_status);

		$result = $this->db->affected_rows();
		
		if(!empty($result))
		{
			return $result;

		}else
			{
				return false;
			}
	}*/

	/*
	* Function Call - get all faqs from database	
	*/
	public function get_all_faqs()
	{
		$query = $this->db->order_by('question_order','ASC')->get('faq_content');

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
	* Function call to get downloadable contents from database
	*/
	public function get_downloadableContents()
	{
		$query = $this->db->order_by('id', 'DESC')->get('downloadable_content');

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
	* Function call to update billing details of student
	*/

	public function update_billing_details($studentID, $billing_data)
	{
		$this->db->where('id', $studentID);

		$this->db->update('users_details', $billing_data);

		$result = $this->db->affected_rows();

		if (!empty($result)) 
		{
			return $result;
		}else
			{
				return false;
			}
	}

	/*
	* Function call to get count of total bought modules by student
	*/
	public function get_TotalBought_module($where_studentID)
	{
		$query = $this->db->get_where('transaction_details', $where_studentID);

		$result_array = $query->result_array();

		if (!empty($result_array))
		{
			return count($result_array);
		}else
			{
				return false;
			}
	}

	/*
	* Function call to get updated profile of last one week
	*/
	public function get_profile_activity($studentID)
	{
		$query = $this->db->query("SELECT * FROM `users_details` WHERE `id` = '".$studentID."' AND DATE(updated_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
				return false;
			}
	}

	public function myModules($where) {

		$res = $this->db->select("m.id,m.course_title")->from("moduletest_result")->join("module_details as m","moduletest_result.module_id=m.id")->where($where)->get();

		if($res->num_rows()){
			$result = $res->result();
			return $result;
		} else {
			return false;
		}
	}

	public function get_user_settings($where) {

		$res = $this->db->get_where("user_settings",$where);
		if($res->num_rows()) {
			$result = $res->result();
			return $result;
		} else {
			return false;
		}
	}

	public function get_working_plan($where) {

		$res = $this->db->get_where("user_settings",$where);
		if($res->num_rows()) {
			$result = $res->result();
			return $result;
		} else {
			$res = $this->db->get_where("user_settings",array("instructor_id"=>1));
			$result = $res->result();
			return $result;
		}
	}

	/*
	* Function call to get current date bought module
	*/
	public function get_currentDate_boughtModule($studentID)
	{
		/*$date = new DateTime("now");
 		$curr_date = $date->format('Y-m-d');
		$query = $this->db->join('module_details','transaction_details.module_id = module_details.id', 'LEFT')->get_where('transaction_details', array('user_id' => $studentID , 'DATE(updated_at)' => $curr_date));*/
		$query = $this->db->query("SELECT transaction_details.id, transaction_details.module_id, transaction_details.created_at, module_details.course_title FROM `transaction_details` LEFT JOIN `users_details` ON `transaction_details`.`user_id` = `users_details`.`id` LEFT JOIN `module_details` ON `transaction_details`.`module_id` = `module_details`.`id` WHERE `user_id` = '".$studentID."' AND DATE(transaction_details.created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		$result = $query->result_array();
		if($result){
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get last booked skype interview appointment
	*/
	public function get_last_booked_appointment($studentID)
	{
		$query = $this->db->query("SELECT * FROM `appointments` LEFT JOIN `users_details` ON `appointments`.`instructor_id` = `users_details`.`id` WHERE `user_id` = '".$studentID."' AND DATE(book_datetime) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get row of completed skype interview
	*/
	public function get_completed_appointment($studentID)
	{
		$query = $this->db->query("SELECT * FROM `appointments` LEFT JOIN `users_details` ON `appointments`.`instructor_id` = `users_details`.`id` WHERE `user_id` = '".$studentID."' AND DATE(end_datetime) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK) AND `completed` = '1'");
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	*Function call to submit chapter discussion 
	*/
	public function submit_discussionDetails($discussion_data)
	{
		$this->db->insert('chapter_discussion',$discussion_data);

		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function call to get chapter discussions
	*/
	public function get_chapterDiscussion($where)
	{
		$query = $this->db->select('chapter_discussion.*, users_details.profile_image', 'LEFT')->from('chapter_discussion')->join('users_details', 'chapter_discussion.user_id=users_details.id')->where($where)->get();
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
	public function get_discussionTitle($discussionForum_id)
	{
		$query = $this->db->get_where('chapter_discussion', array('id' => $discussionForum_id));
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
	public function get_discussions_activity($studentID)
	{
		$query = $this->db->query("SELECT chapter_discussion.*, chapter_details.chapter_title FROM `chapter_discussion` LEFT JOIN `chapter_details` ON `chapter_discussion`.`chapter_id` = `chapter_details`.`id`  WHERE `user_id` = '".$studentID."' AND DATE(chapter_discussion.created_at) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		if($query->num_rows()){
			$result = $query->result_array();
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
	* Function call for get last Discussion forum comments
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

	public function getInstructorByModuleId($where) {

		$res = $this->db->get_where("module_details",$where);
		if($res->num_rows()) {
			$result = $res->result();
			return $result[0]->instructor_id;
		} else {
			return false;
		}
	}
	/*
	* Function call for get user posted discussions
	*/
	public function get_own_discussions($where)
	{
		$res = $this->db->select('chapter_discussion.*, users_details.profile_image')->from('chapter_discussion')->join('users_details', 'chapter_discussion.user_id=users_details.id', 'LEFT')->where($where)->get();
		if($res->num_rows()) {
			$result = $res->result_array();
			return $result;
		} else {
			return false;
		}
	}

	/*
	* Function call for get discussions whichever comment by user 
	*/
	public function get_commented_Discussions($studentID)
	{
		$res = $this->db->select('discussion_comments.user_id,chapter_discussion.id, chapter_discussion.discussion_title, chapter_discussion.description, chapter_discussion.created_at,  users_details.profile_image')->from('discussion_comments')->join('chapter_discussion', 'discussion_comments.discussion_forum_id=chapter_discussion.id')->join('users_details', 'chapter_discussion.user_id=users_details.id', 'LEFT')->where('discussion_comments.user_id',$studentID)->group_by('chapter_discussion.id')->get();
		if($res->num_rows()) {
			$result = $res->result_array();
			return $result;
		} else {
			return false;
		}
	}
	/*
	* Function call for get last discussion 
	*/
	public function get_last_discussion($result)
	{
		$res = $this->db->select('chapter_discussion.*,  users_details.profile_image')->from('chapter_discussion')->join('users_details', 'chapter_discussion.user_id=users_details.id', 'LEFT')->where('chapter_discussion.id',$result)->get();
		if($res->num_rows()) {
			$result = $res->row_array();
			return $result;
		} else {
			return false;
		}
	}

	/*
	* Function call for get discussions comments activity by user 
	*/

	public function get_discussionsComment_activity($studentID)
	{
		$query = $this->db->query("SELECT `discussion_comments`.*, chapter_details.chapter_title,`chapter_discussion`.`chapter_id`, chapter_discussion.user_id, chapter_discussion.discussion_title FROM `discussion_comments` LEFT JOIN `chapter_discussion` ON `discussion_comments`.`discussion_forum_id`=`chapter_discussion`.`id` LEFT JOIN `chapter_details` ON `chapter_discussion`.`chapter_id`=`chapter_details`.`id` WHERE `discussion_comments`.`user_id` = '".$studentID."' AND DATE(discussion_comments.created) >= DATE_SUB(CURRENT_DATE, INTERVAL 1 WEEK)");
		// echo $this->db->last_query();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function cal for get chapter questions by chapter id
	*/

	public function chapterQuestions_forTest($where)
	{
		$query = $this->db->select('chapter_questions.*,  chapter_details.chapter_title')->from('chapter_questions')->join('chapter_details', 'chapter_questions.chapter_id=chapter_details.id', 'LEFT')->where($where)->order_by('rand()')->limit(1)->get();
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call for submit chapter exam questions in database
	*/
	public function submit_chapterQuestion($questionsData)
	{
		$this->db->insert('chapter_test', $questionsData);
		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function call for check attempts of student chapter exam
	*/

	public function check_StudentTest_attempt($where_condition)
	{
		$query= $this->db->get_where('chaptertest_attempt', $where_condition);

		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call for submit chapter exam attempts in database
	*/
	public function submit_chapterExam_attempt($examData)
	{
		$this->db->insert('chaptertest_attempt',$examData);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}

	/*
	* Function call for update chapter exam attempts in database
	*/
	public function update_chapterExam_attempt($where_condition, $data)
	{
		$this->db->where($where_condition);
		$this->db->update('chaptertest_attempt', $data);
		$result = $this->db->affected_rows();
		if (!empty($result)){
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Fucntion call for submit chapter exam result details
	*/
	public function submit_examResult_detail($examResult_data)
	{
		$this->db->insert('chaptertest_result',$examResult_data);

		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function call for check chapter exam question selected answer is correct or wrong
	*/
	public function check_ques_details($where_qu_condition)
	{
		$query= $this->db->get_where('chapter_questions', $where_qu_condition);
		// echo $this->db->last_query();
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}
	/*
	Function call for get chapter exam result from database
	*/
	public function get_resultDetails($where_testID)
	{
		$query= $this->db->get_where('chaptertest_result', $where_testID);
		// echo $this->db->last_query();
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call for update chapter exam result
	*/
	public function update_examResult_Detail($where_testID, $examResult_detail)
	{
		$this->db->where($where_testID);
		$this->db->update('chaptertest_result', $examResult_detail);
		$result = $this->db->affected_rows();
		if (!empty($result)){
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call for get result of correct and wrong ans of chapter
	*/
	public function get_exam_result($where)
	{
		$query= $this->db->get_where('chaptertest_result', $where);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call for get final chapter result from database for show result after exam
	*/
	public function get_exam_resultDetails($where_testID)
	{
		$this->db->select('chapter_test.*, 
						  chapter_questions.question_title, 
						  chapter_questions.option1, 
						  chapter_questions.option2, 
						  chapter_questions.option3, 
						  chapter_questions.option4, 
						  chapter_questions.correct_answer');
		$this->db->from('chapter_test');
		$this->db->join('chapter_questions', 'chapter_test.question_id=chapter_questions.id');
		$this->db->where($where_testID);
		$query = $this->db->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call for get all results on student panel
	*/
	public function get_studentResult_details($studentID)
	{
		$query= $this->db
		->select('chaptertest_result.*, chapter_details.chapter_title, count(chapter_test.test_id)')
		->join('chapter_test', 'chaptertest_result.id=chapter_test.test_id', 'LEFT')
		->join('chapter_details', 'chaptertest_result.chapter_id=chapter_details.id', 'LEFT')
		->order_by('id','DESC')
		->group_by('chaptertest_result.id')
		->get_where('chaptertest_result',array('user_id' => $studentID));

		if($query->num_rows()){
			$result = $query->result_array();
			return $result; 
		}else{
			return false;
		}
	}

	/*
	* Function call to get attempts of student for chapter exam
	*/
	public function get_studentExam_attempts($where_condition)
	{
		$query = $this->db->get_where('chaptertest_attempt', $where_condition);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result; 
		}else{
			return false;
		}
	}

	/*
	* Function call to get chapter test details for test
	*/
/*	public function get_chapterTest_details($where)
	{
		$query = $this->db->get_where('chapter_test_settings', $where);

		if($query->num_rows()){
			$result = $query->row_array();	
			return $result;
		}else{
			return false;
		}
	}*/


	/*
	* Function call - To get student's test History 
	*/
	public function get_students_testHistory($studentID)
	{
		$query = $this->db
			->select('chaptertest_result.*,chapter_details.chapter_title')
			->join('chapter_details','chapter_details.id=chaptertest_result.chapter_id','LEFT')
			->order_by('chaptertest_result.id', 'DESC')
			->get_where('chaptertest_result',array('user_id'=>$studentID));
		
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
	* Function Call - Insert module review content in database.
	*/
	public function save_module_reviews($data)
	{
		$this->db->insert('module_reviews',$data);

		if ($this->db->affected_rows()> 0)
		{
			return $this->db->insert_id();
		}else
		{
			return false;
		}
	}


	/*
	* Function Call - To Update Student Details by ID
	*/
	public function update_module_reviews($where, $dataArr)
	{
		$this->db->where($where)->update('module_reviews',$dataArr);
		return $this->db->affected_rows();
		
	}


	/*
	* Function call - To check if Review Exists for given condition.
	*/
	public function checkifReviewExists($where)
	{
		$query = $this->db->get_where('module_reviews',$where);
		
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
	* Function call - To get student's test History
	*/
	public function getModuleReviews($where)
	{
		$query = $this->db->select('AVG(reviews) as total_rating')->get_where('module_reviews',$where);
		
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
	* Function call to get chapter test details for chapter result
	*/
	public function get_test_detail($where)
	{
		$query = $this->db->get_where('chapter_test_settings',$where);
		if($query->num_rows()){
			$result = $query->row_array();	
			return $result;
		}else{
			$query = $this->db->get_where('chapter_test_settings', array('default_settings' == '1'));
			if($query->num_rows()){
				$result = $query->row_array();
				return $result;
			}else{
				return false;
			}
		}
	}

	/*
	* Function call to get completed chapter from database
	*/
	public function get_completedChapter($where)
	{
		$query = $this->db->select('chaptertest_attempt.*')->from('chaptertest_attempt')->where('student_id', $this->session->userdata('id'))->where_in('chaptertest_attempt.chapter_id', $where)->get();
		// echo $this->db->last_query();
		if($query->num_rows() > 0){
			$result = $query->result_array();
			return count($result);
		}else{
			return false;
		}
	}
	/*
	* Function call to get Final test details from database
	*/
	public function get_finalExam_details($where_detail)
	{
		$query = $this->db->get_where('final_exam_settings', $where_detail);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			$query = $this->db->get_where('final_exam_settings', array('default_settings' == '1'));
			if($query->num_rows()){
				$result = $query->row_array();
				return $result;
			}else{
				return false;
			}
		}
	}

	/*
	* Function call to get exam questions for module final exam
	*/
	public function moduleQuestions_forTest($where)
	{
		$query = $this->db->select('module_questions.*,  module_details.course_title')->from('module_questions')->join('module_details', 'module_questions.module_id=module_details.id', 'LEFT')->where($where)->order_by('rand()')->limit(1)->get();
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to submit final exam details in database
	*/
	public function submit_finalExam_Result($result_data)
	{
		$this->db->insert('moduletest_result',$result_data);
		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function call to get current ques detail from database
	*/
	public function question_details($where)
	{
		$query = $this->db->get_where('module_questions', $where);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call to submit final exam result in database
	*/
	public function submit_finalExam($exam_data)
	{
		$this->db->insert('module_test',$exam_data);
		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function call to get final exam result from database
	*/
	public function get_final_exam_result($where_examID)
	{
		$query = $this->db->get_where('moduletest_result', $where_examID);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call to update final exam result in database
	*/
	public function update_finalExam_Result($where_examID, $result_data)
	{
		$this->db->where($where_examID);
		$this->db->update('moduletest_result', $result_data);
		$result = $this->db->affected_rows();
		if (!empty($result)){
			return $result;
		}else{
				return false;
			}
	}

	/*
	* Function call to get final exam result
	*/
	public function get_fExam_result($where_cond)
	{
		$query = $this->db->get_where('moduletest_result', $where_cond);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}
	/*
	* Function call to get final exam attempted question sheet
	*/
	public function get_result_quesSheet($where_ID)
	{
		$this->db->select('module_test.*, 
						  module_questions.question_title, 
						  module_questions.option1, 
						  module_questions.option2, 
						  module_questions.option3, 
						  module_questions.option4, 
						  module_questions.correct_answer');
		$this->db->from('module_test');
		$this->db->join('module_questions', 'module_test.question_id=module_questions.id');
		$this->db->where($where_ID);
		$query = $this->db->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	public function get_appointments($where) {

		$res = $this->db->get_where("appointments",$where);
		
		if($res->num_rows()) {
			$result = $res->result();
			return $result;
		} else {
			return array();
		}

	}

	/*
	* Function call to get module instructor from database by module id
	*/
	public function get_instructor($where)
	{
		$res = $this->db->get_where("module_details",$where);
		if($res->num_rows()) {
			$result = $res->row_array();
			return $result;
		} else {
			return false;
		}
	}

	/*
	* Function call o submit student scheduled appointment in database
	*/
	public function submit_appointmentDetail($appointmentData)
	{
		$this->db->insert('appointments',$appointmentData);
		if ($this->db->affected_rows()> 0){
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	/*
	* Function call for check if skype interview scheduled by student
	*/
	public function skype_scheduledStatus($where)
	{
		$query= $this->db->get_where('appointments', $where);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}
	}

	/*
	* Function call to get scheduled skype interview details
	*/
	public function get_appointmentDetail($where)
	{
		$this->db->select("appointments.*, module_details.course_title, users_details.fullname, users_details.phone, users_details.skype_id");
		$this->db->from("appointments");
		$this->db->join("users_details", "appointments.instructor_id=users_details.id", 'LEFT')->join('module_details', 'appointments.module_id=module_details.id', 'LEFT')->where($where);
		$query = $this->db->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call to get chater content by chapte id from database
	*/
	public function get_ChapterContent($where)
	{
		$query= $this->db->get_where('chapter_details', $where);
		if($query->num_rows()){
			$result = $query->row_array();
			return $result;
		}else{
			return false;
		}
	}

	/*
	* Function call to check if chapter ques available in database by chapter id
	*/
	public function check_chapterQues($where)
	{
		$query= $this->db->get_where('chapter_questions', $where);
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
	/*
	* Function call to check if module ques available in database by module id
	*/
	/*public function check_moduleQues($where)
	{
		$query= $this->db->get_where('module_questions', $where);
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}*/
	/*
	* Function Call for get final exam result from database
	*/
	/*public function get_finalTest_detail($where)
	{
		$this->db->select("moduletest_result.*, module_details.course_title");
		$this->db->from("moduletest_result");
		$this->db->join('module_details', 'moduletest_result.module_id=module_details.id', 'LEFT')->where($where);
		$query = $this->db->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}*/
}