<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentPanel extends CI_Controller {

  /*
  * constructor function
  */
  public function __construct()
  {
    parent::__construct();

    // Load model
    $this->load->model('StudentPanel_model', 'student_model');

    if(!isset($this->session->frontendLogin))
    {
      redirect('login');
    }  
  }

  /*
  * Default function call
  */
  public function index()
  {
    $data['title'] = 'Dashboard';
    $currentDate    = date("Y-m-d");

    $where_headline = array("display" =>1, "category" =>1, "user_type"=>2, "DATE(`end_date`) >" => $currentDate);
    $where_news     = array("display" =>1, "category" =>2, "user_type"=>2, "DATE(`end_date`) >" => $currentDate);
    $where_banner   = array("display" =>1, "category" =>3, "user_type"=>2, "DATE(`end_date`) >" => $currentDate);

    $where_studentID = array('user_id' => $this->session->userdata('id'));

    $data['allHeadlines'] = $this->student_model->get_allHeadlines($where_headline);

    $data['allNews'] = $this->student_model->get_allNews($where_news);

    $data['allBanners'] = $this->student_model->get_allBanners($where_banner);

    $data['TotalBought_module'] = $this->student_model->get_TotalBought_module($where_studentID);
    
    $data['completed_modules'] = $this->student_model->getCompletedModules(array('user_id' => $this->session->userdata('id'), 'completed' => '1'));

    $data['totalExams'] = $this->student_model->get_students_testHistory($this->session->userdata('id'));

    $data['activities'] = $this->student_activities();

    $this->load->view('student/dashboard.view.php',$data);
  }


  /*
  * Function Call - To fetch info to show on account detail page
  */
	public function StudentProfileDetails()
	{
		$data['title'] = 'Account Details';

		$studentID = $this->session->userdata('id');

		// To Update student profile details
		if($this->input->post('update_student_profile')) 
		{
			$dataArr = array(
				'fullname'      => $this->input->post('fullname'),
				'skype_id'      => $this->input->post('skype_id'),
				'phone'         => $this->input->post('phone'),
				'address'       => $this->input->post('address'), 
				'city'          => $this->input->post('city'),
				'pincode'       => $this->input->post('pincode'),
				'state'         => $this->input->post('state'), 
				'district'      => $this->input->post('district'),
				'latitude'      => $this->input->post('lat'),
				'longitude'     => $this->input->post('lng'),
				'qualification' => $this->input->post('qualification'),
				'dob'           => dateFormat($this->input->post('dob')),
				'user_bio'      => $this->input->post('user_bio'), 
				'gender'        => $this->input->post('gender'),
				'updated_at'    => date('Y-m-d H:i:s')
			);

			$dataArr = array_filter($dataArr);

			$result = $this->student_model->update_student_profile_details($studentID, $dataArr);

	    if(!empty($result)) 
      {
        $session_data = array(
          'id'            => $result['id'],
          'email'         => $result['email'],
          'fullname'      => $result['fullname'],
          'user_type'     => $result['user_type'],
          'profile_image' => $result['profile_image'],
          'frontendLogin' => '1'
        );

        // Add user data in session
        $this->session->set_userdata($session_data);
        
        $this->session->set_flashdata('item', array(
          'message' => 'Student Details Updated Successfully...!',
          'class' => 'success'
        ));
	    }else
	    {
        $this->session->set_flashdata('item', array(
          'message' => 'Unable to Update Student Details...!',
          'class' => 'danger'
        ));
	    }
    }

    // To update student's account password
    if($this->input->post('update_password'))
    {
      $update_pasword_data = array(
        'password'   => hash_password($this->input->post('password')),
        'updated_at'=> date('Y-m-d H:i:s')
      );

      $update_pasword_data = array_filter($update_pasword_data);

      $Result = $this->student_model->update_student_password($studentID, $update_pasword_data);

      if(!empty($Result)) {
        
        $this->session->set_flashdata('item', array(
          'message' => 'Student Password Updated Successfully...!',
          'class' => 'success'
        ));
      }else
      {
        $this->session->set_flashdata('item', array(
          'message' => 'Unable to Update Student Password Details...!',
          'class' => 'danger'
        ));
      }
    }

    // To update Student's Profile Image
    if($this->input->post('update_student_profile_image')) 
    {
      $filename = $_FILES['profile_image']['name'];

      $allowed_types = 'jpg|jpeg|png|gif';

      $columnName   = "profile_image";

      $profileImage = uploadFile($filename, $allowed_types, $columnName);

      $update_image_data = array(
      	'profile_image' => $profileImage,
        'updated_at' => date('Y-m-d H:i:s')
      );

      $update_image_data = array_filter($update_image_data);

      $Result = $this->student_model->update_student_Image($studentID, $update_image_data);

      if(!empty($Result))
      {
        $session_data = array(
          'profile_image'  => $Result['profile_image'],
          'frontendLogin'  => '1'
        );

        // Add user data in session
        $this->session->set_userdata($session_data);
        
        $this->session->set_flashdata('item', array(
          'message' => 'Student\'s Profile Image Updated Successfully...!',
          'class' => 'success'
        ));
      }else
      {
        $this->session->set_flashdata('item', array(
          'message' => 'Unable to Update Student Profile Image Details...!',
          'class' => 'danger'
        ));
      }
    }

    if ($this->input->post('update_billing_detail')) 
    {
      $billing_data = array(
      	'billing_name'    => $this->input->post('billing_name'),
        'gstin'           => $this->input->post('gst_no'),
        'billing_address' => $this->input->post('billing_address'),
        'pan'             => $this->input->post('pan_number'),
        'billing_phone'   => $this->input->post('billing_phone'),
        'updated_at'      => date('Y-m-d H:i:s')
      );

      $billing_data = array_filter($billing_data);

      $result = $this->student_model->update_billing_details($studentID, $billing_data);

      if (!empty($result)) 
      {
        $this->session->set_flashdata('item', array(
          'message' => 'Student Billing Details Updated Successfully...!',
          'class' => 'success'
        ));
      }else
      {
        $this->session->set_flashdata('item', array(
          'message' => 'Unable to Update Student Billing Details...!',
          'class' => 'danger'
        ));
      }
    }
    $data['LoginStudentDetails'] = $this->student_model->get_login_student_details($studentID);

    $this->load->view('student/profile.view.php',$data);
  }


  /*
  * Function Call - To fetch all coureses and students's bought courses
  */
  public function CourseDetails()
  {
    $data['title'] = 'Course Details';

    $studentID = $this->session->userdata('id');

    $data['AllModules'] = $this->student_model->getAllModules($studentID);

    $data['BoughtModules'] = $this->student_model->get_bought_modules($studentID);

    $this->load->view('student/courses.view.php',$data);
  }


  /*
  * Function Call - To fetch all support
  */
  public function GetSingleModuleDetails()
  {
    $data['title'] = 'Module Details';

    if($this->uri->segment(4)){

      $URLData = decryptID($this->uri->segment(4));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $moduleID = $URLData['0'];

        $data['singleCourseDetails'] = $this->student_model->get_single_module_details($moduleID);
 				
 				$chapter_details = $this->student_model->getchaptersofSingleModule($moduleID);

        $data['singleCourseDetails']['chapter_details'] = $chapter_details;

        $studentID = $this->session->userdata('id');
        $condition = array('id' => $studentID);
        $data['StudentData'] = $this->student_model->student_login($condition);
        $data['return_url'] = base_url().'razorpay/callback';
        $data['surl'] = base_url().'razorpay/success';
        $data['furl'] = base_url().'razorpay/failed';
        $data['currency_code'] = 'INR';

      }else
      {
        redirect('student/courses');
      }

    }else
    {
      redirect('student/courses');
    }
    $this->load->view('student/course_details.view.php',$data);
  }

  /*
  * Function Call - To fetch all support
  */
  public function GetSingleModuleAllContent()
  {
    $data['title'] = 'Module Content Details';

    if($this->uri->segment(4)){

      $URLData = decryptID($this->uri->segment(4));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $moduleID = $URLData['0'];

        $data['singleCourseDetails'] = $this->student_model->get_single_module_details($moduleID);
        $data['courseReviews'] = $this->student_model->checkifReviewExists(array('user_id'=>$LoggedUser, 'module_id'=>$moduleID));

        $chapter_details = $this->student_model->getchaptersofSingleModule($moduleID);

        foreach ($chapter_details as $key => $value) {
        	$chapter_id = $value['id'];
        	$chapter_details[$key]['StudentTest_attempt'] = $this->student_model->check_StudentTest_attempt(array('chapter_id'=>$chapter_id, 'student_id'=>$LoggedUser));
        }
        $data['singleCourseDetails']['chapter_details'] = $chapter_details;
        $where = array_column($chapter_details, 'id');
        $data['complete_chapters'] = $this->student_model->get_completedChapter($where);
        
        /*check if final exam is completed or not*/
        $data['exam_completed'] = $this->student_model->get_fExam_result(array('student_id' => $LoggedUser, 'module_id' =>$moduleID, 'completed' => '1'));
        $data['appointmentStatus'] = $this->student_model->skype_scheduledStatus(array('user_id' => $LoggedUser, 'module_id' =>$moduleID));
        $data['total_chapter'] = count($chapter_details);
      }else
      {
        redirect('student/courses');
      }
    }else
    {
      redirect('student/courses');
    }
    $this->load->view('student/single_course_details.view.php',$data);
  }

  /*
  * Function Call - Go to chapter's details
  */
  public function GetChapterDetails()
  {
    $data['title'] = 'Chapter Details';

    if($this->uri->segment(4)){

      $URLData = decryptID($this->uri->segment(4));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $chapterID = $URLData['0'];

        $chapterContent = $this->student_model->get_chapter_details($chapterID);

        $chaptersofSingleModule = $this->student_model->getchaptersofSingleModule($chapterContent['module_id']);

        $chapter_discussions = $this->student_model->get_chapterDiscussion(array('chapter_id' => $chapterID));

        $StudentTest_attempt = $this->student_model->check_StudentTest_attempt(array('chapter_id'=>$chapterID, 'student_id'=>$LoggedUser));
        // check if chapter questions available in database
        $ques = $this->student_model->check_chapterQues(array('chapter_id' => $chapterID));

        $data = array(
          'chapterContent'         => $chapterContent,
          'chaptersofSingleModule' => $chaptersofSingleModule,
          'chapter_discussions'    => $chapter_discussions,
          'StudentTest_attempt'    => $StudentTest_attempt,
          'chapter_questions'      => $ques
        );

      }else
      {
        redirect('student/courses');
      }
    }else
    {
      redirect('student/courses');
    }
    $this->load->view('student/chapter_content.view.php',$data);
  }

  /*
  * Function Call - To get details of single payment invoice
  */
  public function GetInvoiceDetails()
  {
    $data['title'] = 'Invoice Details';

    if($this->uri->segment(3)){

      $URLData = decryptID($this->uri->segment(3));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $invoiceID = $URLData['0'];

        $data['InvoiceDetails'] = $this->student_model->get_invoice_details($invoiceID);

      }else
      {
        redirect('student/payments');
      }
    }else
    {
      redirect('student/payments');
    }
    $this->load->view('student/payment_invoice.view.php',$data);
  }

  /*
  * Function Call - To fetch all coureses and students's bought courses
  */
  public function GetDiscussionForums()
  {
    $data['title'] = 'Discussion Forums';

    $studentID = $this->session->userdata('id');

    $where = array('user_id'=>$studentID);

    $data['own_discussions'] = $this->student_model->get_own_discussions($where);

    $data['commented_Discussions']= $this->student_model->get_commented_Discussions($studentID);

    $this->load->view('student/discussionforums.view.php',$data);
  }


  /*
  * Function Call - To fetch all payments
  */
  public function GetPaymentDetails()
  {
    $data['title'] = 'Payment Details';

    $studentID = $this->session->userdata('id');

    $data['allTransactions'] = $this->student_model->get_all_transactions($studentID);

    $this->load->view('student/payments.view.php',$data);
  }


  /*
  * Function Call - To get history of student's given exams.
  */
  public function GetExamsDetails()
  {
    $data['title'] = 'Exams Details';

    $studentID = $this->session->userdata('id');

    $TestHistoryDetails = $this->student_model->get_students_testHistory($studentID);
    
    if (!empty($TestHistoryDetails)) {
      foreach ($TestHistoryDetails as $key => $value) {
      	$testID = $value['id'];
  	    $TestHistoryDetails[$key]['result'] = $this->student_model->get_exam_result(array('id' => $testID));
  	    $TestHistoryDetails[$key]['resultDetail'] = $this->student_model->get_exam_resultDetails(array('test_id' => $testID));
        
        $chapter_id = $value['chapter_id'];
        $chapterTest_details = $this->student_model->get_test_detail(array('chapter_id' => $chapter_id));
        if(!empty($chapterTest_details)){
          $TestHistoryDetails[$key]['no_of_questions'] = $chapterTest_details['no_of_questions'];
        }else{
          $chapterTestdetails = $this->student_model->get_test_detail(array('default_settings' => '1'));
          $TestHistoryDetails[$key]['no_of_questions'] = $chapterTestdetails['no_of_questions'];
        }
      }
    }
    $data['TestHistoryDetails'] = $TestHistoryDetails;

    $this->load->view('student/test_history.view.php',$data);
  }


  /*
  * Function Call - To show chapter test of student in popup window.
  */
  public function chapter_test()
  {
    $data['title'] = 'Chapter Exam ! IPB India';

    if ($this->uri->segment(3)) {

      $URLData = decryptID($this->uri->segment(3));

      $LoggedUser = $URLData['1'];

      $chapter_id = $URLData['0'];

      $where = array('chapter_id' => $chapter_id);

      if($LoggedUser===$this->session->userdata('id')){

        // get student chapter attempt
        $where_condition = array('chapter_id' => $chapter_id, 'student_id'=>$this->session->userdata('id'));
        $data['attempts'] = $this->student_model->get_studentExam_attempts($where_condition);
        
        // get chapter test details
        $data['test_details'] = $this->student_model->get_test_detail($where);
        $data['defaultChapterSettings'] = $this->student_model->get_test_detail(array('default_settings'=>'1'));
        
        $data['chapter_questions'] = $this->student_model->chapterQuestions_forTest($where);
      }
    }else
    {
      redirect('student/courses');
    }
    $this->load->view('student/chapter_test.view.php',$data);
  }


  /*
  * Function Call - Ajax request for update chapter exam attempts & Result 
  */
  public function updateExam_attempt()
  {
    if ($this->input->is_ajax_request()) {

      $URLData = decryptID($this->input->post('chapterID'));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $chapter_id = $URLData['0'];

        $where_condition = array(
          'student_id' => $this->session->userdata('id'),
          'chapter_id' => $chapter_id
        );

        /* check student chapter exam attempts */
        $check_StudentTest_attempt = $this->student_model->check_StudentTest_attempt($where_condition);

        $chapterTestDetails = $this->student_model->get_test_detail(array('chapter_id'=>$chapter_id));
        $defaultChapterSettings = $this->student_model->get_test_detail(array('default_settings'=>'1'));
        $TotaltestAttempts = (!empty($chapterTestDetails)) ? $chapterTestDetails['test_attempts'] : $defaultChapterSettings['test_attempts'];

        if(!empty($check_StudentTest_attempt)){

          if($check_StudentTest_attempt['total_attempt'] < $TotaltestAttempts){

            /*update exam attempt*/
            $data = array(
              'student_id'     => $this->session->userdata('id'),
              'chapter_id'     => $chapter_id,
              'total_attempt'  => ++$check_StudentTest_attempt['total_attempt']
            );

            $result = $this->student_model->update_chapterExam_attempt($where_condition, $data);
            
            if($result){
              echo $TotaltestAttempts.",".$check_StudentTest_attempt['total_attempt'];
            }

            /*submit result details*/
            $examResult_data = array(
              'user_id'    => $this->session->userdata('id'),
              'chapter_id' => $chapter_id,
              'attempt'    => $check_StudentTest_attempt['total_attempt']
            );

            $res = $this->student_model->submit_examResult_detail($examResult_data);

            $test_id = array('test_id'  => $res);

            // Add test id in session
            $this->session->set_userdata($test_id);
          }else
          {
            echo 0;
          }

        }else
        {
          $examData = array(
            'student_id'     => $this->session->userdata('id'),
            'chapter_id'     => $chapter_id,
            'total_attempt'  => 1 
          );

          $result = $this->student_model->submit_chapterExam_attempt($examData);

          if ($result) {
            echo $TotaltestAttempts.",". 1 ;
          }

          /*submit result details*/
          $examResult_data = array(
            'user_id'       => $this->session->userdata('id'),
            'chapter_id'    => $chapter_id,
            'attempt'      => 1
          );

          $res = $this->student_model->submit_examResult_detail($examResult_data);

          $test_id = array('test_id'  => $res);

          // Add test id in session
          $this->session->set_userdata($test_id);
        }

      }
    }
  }

  /*
  * Function Call - Ajax request for exam questions
  */
  public function exam_questionsDetail()
  {
    if ($this->input->is_ajax_request()) {

      $URLData = decryptID($this->input->post('chapterID'));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $chapter_id = $URLData['0'];

        $data['chapter_questions_no'] = $this->input->post('question_no');

        $where = array('chapter_id' => $chapter_id);

        $data['chapter_questions'] = $this->student_model->chapterQuestions_forTest($where);

        $questionsData = array(
          'student_id'   => $this->session->userdata('id'),
          'chapter_id'   => $chapter_id,
          'question_id'  => $this->input->post('questionID'),
          'selected_ans' => $this->input->post('selected_ans'),
          'test_id'      => $this->session->userdata('test_id')
        );

        $questionsData = array_filter($questionsData);

        $submit_question = $this->student_model->submit_chapterQuestion($questionsData);

        /* Check selected ans is right or wrong*/
        $where_qu_condition = array(
          'id'             => $this->input->post('questionID'),
          'chapter_id'     => $chapter_id,
          'correct_answer' => $this->input->post('selected_ans')
        );

        $check_ans =  $this->student_model->check_ques_details($where_qu_condition);

        /*get result detail for this exam*/
        $where_testID = array('id' => $questionsData['test_id']);

        $get_resultDetails = $this->student_model->get_resultDetails($where_testID);

        if (!empty($check_ans)) {

          $examResult_detail = array('correct_ans' => ++$get_resultDetails['correct_ans']); 
          $updateResult_Detail = $this->student_model->update_examResult_Detail($where_testID, $examResult_detail);
        }else
        {
          $examResult_detail = array('wrong_ans' => ++$get_resultDetails['wrong_ans']); 
          $updateResult_Detail = $this->student_model->update_examResult_Detail($where_testID, $examResult_detail);
        }

        $chapterTest_detail= $this->student_model->get_test_detail(array('chapter_id' => $chapter_id));
        if($data['chapter_questions_no'] <= $chapterTest_detail['no_of_questions'])
        {
          $questions=$this->load->view('student/snippet/chapter_questions.view.php', $data, true);
          echo $questions;
        }else
        {
          echo 0 ;
        }
      } 
    }
  }

  /*
  * Function Call - To fetch all Results
  */
  public function chapterExam_Result()
  {
    $data['title'] = 'Result ! IPB India';

    /* get correct and wrong answer*/
    $where = array('id' => $this->session->userdata('test_id'));
    $data['result'] = $this->student_model->get_exam_result($where);

    /* get total attempted questions*/
    $where_testID = array('test_id' => $this->session->userdata('test_id'));
    $data['resultDetail'] = $this->student_model->get_exam_resultDetails($where_testID);
    $data['chapterTest_detail']= $this->student_model->get_test_detail(array('chapter_id' => $data['resultDetail'][0]['chapter_id']));

    $this->load->view('student/chapter_testResult.view.php',$data);
  }


  /*
  * Function Call - To fetch all Results
  */
  public function GetResultsDetails()
  {
    $data['title'] = 'Results Details';

    $studentID = $this->session->userdata('id');

    $student_result = $this->student_model->get_studentResult_details($studentID);
    
    if(!empty($student_result)){

      foreach ($student_result as $key => $value) {
        
        $chapter_id = $value['chapter_id'];

        $chapterTest_details = $this->student_model->get_test_detail(array('chapter_id' => $chapter_id));

        if(!empty($chapterTest_details)){
          $student_result[$key]['no_of_questions'] = $chapterTest_details['no_of_questions'];
        }else{
          $chapterTestdetails = $this->student_model->get_test_detail(array('default_settings' => '1'));
          $student_result[$key]['no_of_questions'] = $chapterTestdetails['no_of_questions'];
        }
      }
    }

    // $data['final_result'] = $this->student_model->get_finalTest_detail(array('student_id' => $this->session->userdata('id'), 'completed'=>'1'));

    $data['student_result'] = $student_result;

    $this->load->view('student/results.view.php',$data);
  }


  /*
  * Function Call - To fetch all Downloads
  */
  public function GetDownloadsData()
  {
    $data['title'] = 'Exams Details';

    $studentID = $this->session->userdata('id');

    $data['download_Data'] = $this->student_model->get_downloadableContents();

    $this->load->view('student/downloads.view.php',$data);
  }


  /*
  * Function Call - To fetch all FAQs
  */
  public function GetFAQsDetails()
  {
    $data['title'] = 'FAQs Details';

    $data['faqs_details'] = $this->student_model->get_all_faqs();

    $this->load->view('student/faqs.view.php',$data);
  }


  /*
  * Function Call - To fetch all support
  */
  public function GetSupportContent()
  {
    $data['title'] = 'Support Details';

    $studentID = $this->session->userdata('id');

    $data['LoginStudentDetails'] = $this->student_model->get_login_student_details($studentID);
    
    $this->load->view('student/support.view.php',$data);
  }


  /*
  * Function call - To show exam questions.
  */
  public function qa()
  {
    $data['title'] = 'Questions Answers | IPB India';

    $studentID = $this->session->userdata('id');

    $data['LoginStudentDetails'] = $this->student_model->get_login_student_details($studentID);

    $this->load->view('student/qa.view.php',$data);
  }

  /*
  * Function call - To show exam questions.
  */
  public function DiscussionforumDetails()
  {
    $data['title'] = 'Questions Answers | IPB India';

    $this->load->view('student/chat.php',$data);
  }

  /*
  * Function call - To show activites on student panel.
  */
  public function student_activities()
  {
    $studentID = $this->session->userdata('id');

    $profile_activity           = $this->student_model->get_profile_activity($studentID);
    $last_bought_module         = $this->student_model->get_currentDate_boughtModule($studentID);
    $completed_appointment      = $this->student_model->get_completed_appointment($studentID);
    $last_scheduled_appointment = $this->student_model->get_last_booked_appointment($studentID);
    $discussions                = $this->student_model->get_discussions_activity($studentID);
    $discussion_commentActivity = $this->student_model->get_discussionsComment_activity($studentID);

    $data= array();
    if(!empty($profile_activity)){

      array_push($data, array(
      	'title' => 'Profile has been updated.',
      	'time' => timeDifference($profile_activity['updated_at'])
      ));
    }

    if (!empty($last_bought_module)){
      foreach ($last_bought_module as $single_bought_module){

        array_push($data, array(
        	'title' => '"'.$single_bought_module['course_title'].'" Course has been bought.',
        	'time' => timeDifference($single_bought_module['created_at'])
        ));
      }
    }

    if (!empty($discussions)){
      foreach ($discussions as $single_discussion){

        array_push($data, array(
        	'title' => 'Posted a query into '.$single_discussion['chapter_title'].'.',
        	'time' => timeDifference($single_discussion['created_at'])
        ));
      }
    }

    if (!empty($last_scheduled_appointment)){
    	if(!empty($last_scheduled_appointment["fullname"])){
    		$name = $last_scheduled_appointment["fullname"];
    	}
    	if(!empty($last_scheduled_appointment["last_name"])){
    		$last_name = $last_scheduled_appointment["last_name"];
    	}else{
    		$last_name = '';
    	}
      array_push($data, array(
      	'title' => 'Scheduled Skype Interview with '.$name.' '.$last_name.'', 
      	'time' => timeDifference($last_scheduled_appointment['book_datetime'])
      ));
    }

    if (!empty($completed_appointment)) {

      array_push($data, array(
      	'title' => 'Completed Skype Interview with '.$completed_appointment["fullname"].' '.$completed_appointment["last_name"].'',
      	'time' => timeDifference($completed_appointment['end_datetime'])
      ));
    }

    if (!empty($discussion_commentActivity)){
      foreach ($discussion_commentActivity as $single_discussion){
        array_push($data, array(
        	'title' => 'Posted a comment into '.substr($single_discussion['discussion_title'], 0, 50).'.', 
        	'time' => timeDifference($single_discussion['created'])
        ));
      }
    }
    return $data;
  }


  /*
  * Function call - For chapter Discussion forum 
  */
  public function chapterDiscussion()
  {
    if ($this->input->is_ajax_request()) 
    {
      $discussion_data = array(
      	'user_id'          => $this->session->userdata('id'),
				'chapter_id'       => $this->input->post('chapterID'),
				'discussion_title' => $this->input->post('title'),
				'description'      => $this->input->post('description'),
			);

      $result = $this->student_model->submit_discussionDetails($discussion_data);

      if (!empty($result)){

        $data['last_discussion'] = $this->student_model->get_last_discussion($result);  
        $discussion=$this->load->view('student/snippet/discussion_title.view.php', $data, true);
        echo $discussion;
      }
    }
  }

  /*
  * Function call - For comments on chapter Discussion forum 
  */
  public function chapterDiscussion_comments()
  {
    if ($this->input->is_ajax_request()){

      $commentData = array(
      	'user_id'             => $this->session->userdata('id'),
				'discussion_forum_id' => $this->input->post('discussion_formID'),
				'comment'             => $this->input->post('comment')
			);

      $result = $this->student_model->submit_discussionComments($commentData);
    

      if (!empty($result)){

        $data['get_last_comment'] = $this->student_model->get_lastComment($result);  
        $comment=$this->load->view('student/snippet/discussion_comment.php', $data, true);
        echo $comment;
      }
    }
  }


  /*
  * Function call- For open discussions with Title of chapter discussion
  */
  public function ChapterTitle_discussion()
  {
    $data['title'] = 'Discussion Forum ! IPB India';

    if($this->uri->segment(4)){

      $URLData = decryptID($this->uri->segment(4));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $discussionForum_id = $URLData['0'];

        $data['discussionTitle'] = $this->student_model->get_discussionTitle($discussionForum_id);
        
        $data['discussion_Comments'] = $this->student_model->get_discussion_comments($discussionForum_id);

      }else{
        redirect('student/courses');
      }
    }else{
      redirect('student/courses');
    }
    $this->load->view('student/discussion_onTitle.view.php',$data);
  }


  /*
  * Function Call - Ajax call - To check if current password is matching with given one.
  */
  public function MatchCurrentPassword()
  {
    if($this->input->is_ajax_request())
    {
      $password = $this->input->post('password');

      $password = hash_password($password);

      $studentID = $this->session->userdata('id');

      $resultArr = $this->student_model->check_if_password_match($studentID,$password);

      echo $resultArr;
    }
  }


  /*
  * Function Call - To Schedule a skype interview by student.
  */
  public function ScheduleSkypeInterview()
  {
    $data['title'] = 'Schedule Skype Interview | IPB India';

    /*get instructor id from database by module id*/
    $instructor_id = $this->student_model->get_instructor(array('id' => $this->input->post('modules')));
    /*get student details from database by student id*/
    $student = $this->student_model->student_login(array('id' => $this->session->userdata('id')));

    if($this->input->post('save_appointment')) 
    {
      $time = $this->input->post('time_slot');
      $timestamp = strtotime($time) + 60*60;
      $end_time = date('H:i', $timestamp);
      // $data_time = $date.' '.$e_time;
      $appointmentData = array('user_id'        => $this->session->userdata('id'),
                               'module_id'      => $this->input->post('modules'),
                               'instructor_id'  => $instructor_id['instructor_id'],
                               'title'          => $student['fullname'],
                               'start_datetime' => $this->input->post('selected_schedule').' '.$time,
                               'end_datetime'   => $this->input->post('selected_schedule').' '.$end_time
                              );
      $appointmentData= array_filter($appointmentData);
      $result = $this->student_model->submit_appointmentDetail($appointmentData);
      if (!empty($result)) 
      {
        $this->session->set_flashdata('item_appointment', array(
          'message' => 'Skype Interview Scheduled Successfully...!',
          'class' => 'success'
        ));
      }else
      {
        $this->session->set_flashdata('item_appointment', array(
          'message' => 'Unable to Scheduled Skype Interview...!',
          'class' => 'danger'
        ));
      }
    }

    $data["myModules"] = $this->student_model->myModules(array("student_id"=>$this->session->userdata("id"), 'completed' => '1'));
    $data['scheduled_appointments'] = $this->student_model->get_appointmentDetail(array('user_id' => $this->session->userdata("id")));

    $this->load->view('student/skypeInterview.view.php',$data);
  }
 
  public function getAvailableSlots()
  {
    if($this->input->is_ajax_request()){

      $moudle_id = $this->input->post("module_id");
      $selected_date = $this->input->post("date");
      $instructor_id = $this->student_model->getInstructorByModuleId(array("id"=>$moudle_id));
      $this->get_available_hours($instructor_id, $selected_date);
    }
  }

  public function get_available_hours($instructor_id, $selected_date)
  {
      try
      {
          $empty_periods = $this->instructor_available_time_periods($instructor_id, $selected_date);

          $available_hours = $this->_calculate_available_hours($empty_periods, $selected_date);

          if (date('Y-m-d', strtotime($this->input->post('selected_date'))) === date('Y-m-d'))
          {
              $book_advance_timeout = $this->settings_model->get_setting('book_advance_timeout');

              foreach ($available_hours as $index => $value)
              {
                  $available_hour = strtotime($value);
                  $current_hour = strtotime('+' . $book_advance_timeout . ' minutes', strtotime('now'));
                  if ($available_hour <= $current_hour)
                  {
                      unset($available_hours[$index]);
                  }
              }
          }

          $available_hours = array_values($available_hours);
          sort($available_hours, SORT_STRING);
          $available_hours = array_values($available_hours);

          $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($available_hours));
      }
      catch (Exception $exc)
      {
          $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode([
                  'exceptions' => [exceptionToJavaScript($exc)]
              ]));
      }
  }

  public function _calculate_available_hours(array $empty_periods, $selected_date ) {
        
        $available_hours = [];

        foreach ($empty_periods as $period)
        {
            $start_hour = new DateTime($selected_date . ' ' . $period['start']);
            $end_hour = new DateTime($selected_date . ' ' . $period['end']);
            $interval = 60;

            $current_hour = $start_hour;
            $diff = $current_hour->diff($end_hour);

            while (($diff->h * 60 + $diff->i) >= intval(60))
            {
                $available_hours[] = $current_hour->format('H:i');
                $current_hour->add(new DateInterval('PT' . $interval . 'M'));
                $diff = $current_hour->diff($end_hour);
            }
        }

        return $available_hours;
    }

  public function instructor_available_time_periods($instructor_id, $selected_date) {
      
        $working_plan = $this->student_model->get_working_plan(['instructor_id'=> $instructor_id]);
        $working_plan = json_decode($working_plan[0]->setting_value, TRUE);
        if(isset($working_plan['daysoff'])){
          if(in_array($selected_date, $working_plan["daysoff"])){
            return array();
          }          
        }

        $provider_appointments = $this->student_model->get_appointments(['instructor_id'=>$instructor_id,'completed'=>1]);

        $provider_appointments = json_decode(json_encode($provider_appointments), TRUE);

        $selected_date_working_plan = $working_plan[strtolower(date('l', strtotime($selected_date)))];

        $periods = [];

        if (isset($selected_date_working_plan['breaks']))
        {
            $periods[] = [
                'start' => $selected_date_working_plan['start'],
                'end' => $selected_date_working_plan['end']
            ];

            $day_start = new DateTime($selected_date_working_plan['start']);
            $day_end = new DateTime($selected_date_working_plan['end']);

            foreach ($selected_date_working_plan['breaks'] as $index => $break)
            {
                $break_start = new DateTime($break['start']);
                $break_end = new DateTime($break['end']);

                if ($break_start < $day_start)
                {
                    $break_start = $day_start;
                }

                if ($break_end > $day_end)
                {
                    $break_end = $day_end;
                }

                if ($break_start >= $break_end)
                {
                    continue;
                }

                foreach ($periods as $key => $period)
                {
                    $period_start = new DateTime($period['start']);
                    $period_end = new DateTime($period['end']);

                    $remove_current_period = FALSE;

                    if ($break_start > $period_start && $break_start < $period_end && $break_end > $period_start)
                    {
                        $periods[] = [
                            'start' => $period_start->format('H:i'),
                            'end' => $break_start->format('H:i')
                        ];

                        $remove_current_period = TRUE;
                    }

                    if ($break_start < $period_end && $break_end > $period_start && $break_end < $period_end)
                    {
                        $periods[] = [
                            'start' => $break_end->format('H:i'),
                            'end' => $period_end->format('H:i')
                        ];

                        $remove_current_period = TRUE;
                    }

                    if ($break_start == $period_start && $break_end == $period_end)
                    {
                        $remove_current_period = TRUE;
                    }

                    if ($remove_current_period)
                    {
                        unset($periods[$key]);
                    }
                }
            }
        }

        foreach ($provider_appointments as $provider_appointment)
        {
            foreach ($periods as $index => &$period)
            {
                $appointment_start = new DateTime($provider_appointment['start_datetime']);
                $appointment_end = new DateTime($provider_appointment['end_datetime']);
                $period_start = new DateTime($selected_date . ' ' . $period['start']);
                $period_end = new DateTime($selected_date . ' ' . $period['end']);

                if ($appointment_start <= $period_start && $appointment_end <= $period_end && $appointment_end <= $period_start)
                {

                }
                else
                {
                    if ($appointment_start <= $period_start && $appointment_end <= $period_end && $appointment_end >= $period_start)
                    {
                        $period['start'] = $appointment_end->format('H:i');
                    }
                    else
                    {
                        if ($appointment_start >= $period_start && $appointment_end < $period_end)
                        {
                            unset($periods[$index]);

                            $periods[] = [
                                'start' => $period_start->format('H:i'),
                                'end' => $appointment_start->format('H:i')
                            ];

                            $periods[] = [
                                'start' => $appointment_end->format('H:i'),
                                'end' => $period_end->format('H:i')
                            ];
                        }
                        else if ($appointment_start == $period_start && $appointment_end == $period_end)
                        {
                            unset($periods[$index]); 
                        }
                        else
                        {
                            if ($appointment_start >= $period_start && $appointment_end >= $period_start && $appointment_start <= $period_end)
                            {
                                $period['end'] = $appointment_start->format('H:i');
                            }
                            else
                            {
                                if ($appointment_start >= $period_start && $appointment_end >= $period_end && $appointment_start >= $period_end)
                                {

                                }
                                else
                                {
                                    if ($appointment_start <= $period_start && $appointment_end >= $period_end && $appointment_start <= $period_end)
                                    {
                                        unset($periods[$index]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return array_values($periods);
    }


  /*
  * Function Call - Ajax request to insert module review data in database
  */
  public function addModuleReviews()
  {
    if ($this->input->is_ajax_request()) {

    	$rating = $this->input->post('rating');
      $user_id = $this->session->userdata('id');
      $module_id = $this->input->post('module_id');
			
			$dataArr = array(
      	'reviews' => $rating,
      	'user_id' => $user_id,
        'module_id' => $module_id
      );

      $checkIfExists = $this->student_model->checkifReviewExists(array('user_id'=>$user_id, 'module_id'=>$module_id));
      if(!empty($checkIfExists))
      {
      	$where = array('user_id'=>$user_id,'module_id'=>$module_id);

				$result = $this->student_model->update_module_reviews($where, $dataArr);
        
      }else
      {
        $result = $this->student_model->save_module_reviews($dataArr);
      }

      echo $result;
    }
  }

  /*
  * Function Call - For Final Exam
  */
  public function module_finalExam()
  {
    $data['title'] = 'Course Exam! IPB India';

    if ($this->uri->segment(3)) {

      $URLData = decryptID($this->uri->segment(3));

      $LoggedUser = $URLData['1'];

      $module_id = $URLData['0'];

      $where = array('module_id' => $module_id);

      if($LoggedUser===$this->session->userdata('id')){
        
        // get chapter test details
        $data['exam_details'] = $this->student_model->get_finalExam_details($where);
        // get exam question 
        $data['exam_questions'] = $this->student_model->moduleQuestions_forTest($where);
      }
    }else
    {
      redirect('student/courses');
    }
    $this->load->view('student/module_test.view.php',$data);
  }

  /*
  * Function Call - For submit and view exam questions
  */
  public function finalExam_questions()
  {
    if ($this->input->is_ajax_request()) 
    {
      $m_id = decryptID($this->input->post('module_id')); 
      $module_id = $m_id['0'];
      $where = array('module_id' => $module_id);

      $data['exam_questions'] = $this->student_model->moduleQuestions_forTest($where);

      $data['exam_question_no'] = $this->input->post('question_no');

      $exam_details = $this->student_model->get_finalExam_details($where);

      $question_id = $this->input->post('questionID');

      $exam_data = array('test_id'      => $this->session->userdata('exam_id'),
                         'student_id'   => $this->session->userdata('id'),
                         'module_id'    => $module_id,
                         'question_id'  => $question_id,
                         'selected_ans' => $this->input->post('selected_ans')
                        );
      $exam_data = array_filter($exam_data);
      $result = $this->student_model->submit_finalExam($exam_data);

      $where_qDetail = array('id'=>$question_id, 'module_id' => $module_id, 'correct_answer' =>  $exam_data['selected_ans']);
      $question_result = $this->student_model->question_details($where_qDetail);

      /*get result detail for this exam*/
      $where_examID = array('id' => $exam_data['test_id']);

      $final_exam_result = $this->student_model->get_final_exam_result($where_examID);

      if (!empty($question_result)) {
        $result_data = array('correct_ans' => ++$final_exam_result['correct_ans']);
        $res = $this->student_model->update_finalExam_Result($where_examID, $result_data);
      }else
        {
          $result_data = array('wrong_ans' => ++$final_exam_result['wrong_ans']);
          $res = $this->student_model->update_finalExam_Result($where_examID, $result_data);
        }
      
      /* calculate percentage*/
      $finalResult          = $this->student_model->get_final_exam_result($where_examID);
      /*$exam_quesMark        = $exam_details['question_marks'];
      $exam_total_quesMarks = $exam_details['no_of_questions']*$exam_quesMark;
      $gain_marks           = $finalResult['correct_ans']*$exam_quesMark;*/
      $examPercentage       = array('percentage' => $finalResult['correct_ans']/$exam_details['no_of_questions']*100);

      $submit_percentage    = $this->student_model->update_finalExam_Result($where_examID, $examPercentage);

      if($data['exam_question_no'] <= $exam_details['no_of_questions'])
      {
        $questions=$this->load->view('student/snippet/finalExam_ques.view.php', $data, true);
        echo $questions;
      }else
      {
        echo 0 ;
      }
    }
  }

  /*
  * Function call to view final exam result
  */
  public function finalexamResult()
  {
    $data['title'] = 'Result! IPB India';

    if($this->uri->segment(3)){

      $URLData = decryptID($this->uri->segment(3));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $module_id = $URLData['0'];

        $where_cond = array('id' => $this->session->userdata('exam_id'));
        $data['result'] = $this->student_model->get_fExam_result($where_cond);

        $where_ID = array('test_id' => $this->session->userdata('exam_id'));
        $data['result_Detail'] = $this->student_model->get_result_quesSheet($where_ID);

        $data['exam_details'] = $this->student_model->get_finalExam_details(array('module_id' => $module_id));

      }else{
        redirect('student/courses');
      }
    }else{
      redirect('student/courses');
    }

    $this->load->view('student/finalExam_result.view.php',$data);
  }

  /*
  * Function call - Ajax request to update final Exam status in database
  */
  public function update_finalExam_status()
  {
    if ($this->input->is_ajax_request()) {
      $module_id = decryptID($this->input->post('module_id'));
      $module_id = $module_id['0'];

      $condition = array('module_id'=>$module_id, 'student_id' =>$this->session->userdata('id'), 'id' =>$this->session->userdata('exam_id'));
      $data = array('completed' => '1');
      $result =  $this->student_model->update_finalExam_Result($condition, $data);
      echo $result;
    }
  }

  /*
  * Function call- ajax request to submit user id/module id for final exam in database
  */
  public function final_exam_res()
  {
    if ($this->input->is_ajax_request()) {
      $m_id = decryptID($this->input->post('module_id')); 
      $module_id = $m_id['0'];

      /*submit result details*/
      $result_data = array(
        'student_id'   => $this->session->userdata('id'),
        'module_id'    => $module_id
      );

      $res = $this->student_model->submit_finalExam_Result($result_data);

      $exam_id = array('exam_id'  => $res);

      // Add test id in session
      $this->session->set_userdata($exam_id);
    }
  }

  /*
  * Function call- ajax request to check if student scheduled skype apppintment for same module
  */
  public function check_skypeAppointment()
  {
    if ($this->input->is_ajax_request()) {
      $module_id = $this->input->post('module_id');
      $where = array('module_id'  => $module_id,
                     'user_id'    =>$this->session->userdata('id'));
      $result = $this->student_model->skype_scheduledStatus($where);
      if (!empty($result)) {
        echo json_encode($result);
      }
    }
  }

  /*
  * Function call - For chapter video
  */
  public function chapter_video()
  {
    $data['title'] = 'Chapter Content! IPB India';

    if($this->uri->segment(3)){

      $URLData = decryptID($this->uri->segment(3));

      $LoggedUser = $URLData['1'];

      if($LoggedUser===$this->session->userdata('id')){

        $chapterID = $URLData['0'];

        $data['chapter'] = $this->student_model->get_ChapterContent(array('id' => $chapterID));

      }else{
        redirect('student/courses');
      }
    }else{
      redirect('student/courses');
    }

    $this->load->view('student/chapter_video.view.php',$data);
  }
}