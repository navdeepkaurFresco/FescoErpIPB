<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapters extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		$this->load->library('csvreader');
		// Load model
		$this->load->model('Chapters_model','chapters');

		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}


	/*
	* Function call - To List all the existing Chapters in database
	*/
	public function listAllChapters()
	{
		$data['title'] = 'All Chapters';

		$data['AllChapters'] = $this->chapters->getAllChapters();

		$this->load->view('admin/chapters/all_chapters.view.php',$data);
	}


	/*
	* Function call - To List all the existing Chapters in database
	*/
	public function ChapterTestDefaultSettings()
	{
		$data['title'] = 'Chapter Test Default Settings';

		$getwhere = array('default_settings' => '1');

		$data['default_settings'] = $this->chapters->get_chapter_test_details($getwhere);

		if($this->input->post('submit_test_Details')) 
		{
			$test_data = array(
				'no_of_questions'    => $this->input->post('no_of_questions'),
				'test_time'          => $this->input->post('test_time'),
				'chapter_id'         => '0',
				'per_question_marks' => $this->input->post('per_question_marks'),
				'test_attempts'      => $this->input->post('test_attempts')
			);

			if(!empty($data['default_settings']))
			{
				$updatewhere = array('default_settings' => '1');
				$Result = $this->chapters->Update_chapterTestDetails($updatewhere,$test_data);

				if(!empty($Result))
				{
					$data = $this->session->set_flashdata('defaultsettingmsg', array(
						'alertmsgClass' => 'success',
						'alert_msg'     => 'Chapter Test Default Settings updated Successfully..!'
					));
				}
			}
		}
		$data['default_settings'] = $this->chapters->get_chapter_test_details($getwhere);

		$this->load->view('admin/chapters/default_test_details.view.php',$data);
	}


	/*
	* Function call - To List all the existing Chapters in database
	*/
	public function singleChapterDetails()
	{
		$data['title'] = 'Single Chapter Details';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$ChapterID = $URLData['0'];
				$where = array('chapter_id' => $ChapterID);
				$data['chapterDetails'] = $this->chapters->get_chapter_details_ByID($ChapterID);
				$data['chapterQuestions'] = $this->chapters->get_chapter_questions($ChapterID);
				$data['chapterTestDetails'] = $this->chapters->get_chapter_test_details($where);
				$data['chapterDiscussionForum'] = $this->chapters->get_chapter_DiscussionForum($where);
				if($this->input->post('submit_test_Details')) 
				{
					
					$test_data = array(
						'chapter_id'         => $ChapterID,
						'default_settings'   => '0',
						'no_of_questions'    => $this->input->post('no_of_questions'),
						'test_time'          => $this->input->post('test_time'),
						'per_question_marks' => $this->input->post('per_question_marks'),
						'test_attempts'      => $this->input->post('test_attempts')
					);
						//echo "button clicked";
						//print_r($data['chapterTestDetails']);
						//die();
					if(!empty($data['chapterTestDetails']))
					{
						
						$updatewhere = array('chapter_id' => $ChapterID);
						$Result = $this->chapters->Update_chapterTestDetails($updatewhere ,$test_data);
					}else
					{
						$Result = $this->chapters->create_chapterTestDetails($test_data);
					}
				}

				

			}else
			{
				redirect('chapter/list');
			}

		}else
		{
			redirect('chapter/list');
		}

		$this->load->view('admin/chapters/chapter_details.view.php',$data);
	}


	/*
	* Function call - To List all the existing Chapters in database
	*/
	public function singleDiscussionforum()
	{
		$data['title'] = 'Single Discussion forum';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$discussionForum_id = $URLData['0'];

				$data['discussionTitle'] = $this->chapters->get_single_discussionforum($discussionForum_id);
				$data['discussion_Comments'] = $this->chapters->get_discussion_comments($discussionForum_id);
			}else
			{
				redirect('chapter/list');
			}

		}else
		{
			redirect('chapter/list');
		}

		$this->load->view('admin/chapters/single_discussionforum.view.php',$data);
	}


	/*
	* Function Call - To create New Chapter
	*/
	public function createNewChapter()
	{
		$data['title'] = 'Create New Chapter';

		$data['AllModules'] = $this->chapters->getAllModules();

		// To create New Chapter
		if($this->input->post('create_Chapter')) 
		{

			$filename = $_FILES['ppt_file']['name'];
			$allowed_types = 'ppts|ppt|pptx';
			$columnName = "ppt_file";
			$filepath = uploadFile($filename, $allowed_types, $columnName);

			$ppts = $this->input->post('ppts');

			if(!empty($ppts)){
				$PPT = 'Yes';
			}else{
				$PPT = 'No';
			}

			 $ppt_file = $this->input->post('ppt_file');
			//echo '<pre/>';
			//print_r($_FILES['ppt_file']);
			//print_r($filepath);
			//die();
			$new_chapter_data = array(
				'module_id'				=> $this->input->post('module_id'),
				'chapter_title'			=> $this->input->post('chapter_title'),
				'chapter_description'	=> $this->input->post('chapter_description'),
				'content'				=> $this->input->post('content'),
				'time_duration'			=> $this->input->post('time_duration'),
				'ppts'					=> $PPT,
				'ppt_file'				=> $filepath,
				'video_url'				=> $this->input->post('video_url'),
				'advertisement_url'		=> $this->input->post('advertisement_url')
			);

			$Result = $this->chapters->create_new_Chapter($new_chapter_data);

			if(!empty($Result))
			{
				$data = array(
					'alertmsgClass'	=> 'alert-success',
					'alert_msg'		=> 'New Chapter Created Successfully..!'
				);
			}else
			{
				$data = array(
					'alertmsgClass'	=> 'alert-danger',
					'alert_msg'		=> 'Unable to Create Chapter..!'
				);
			}
			redirect('/chapter/list');
		}

		$this->load->view('admin/chapters/create_chapter.view.php',$data);
	}



	/*
	* Function Call - To Update Single Chapter Details by ID
	*/
	public function UpdateChapterDetails()
	{
		$data['title'] = 'Update Chapter Details';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$ChapterID = $URLData['0'];

				$data['AllModules'] = $this->chapters->getAllModules();
				
				$data['ChapterDetails'] = $this->chapters->get_Chapter_details_ByID($ChapterID);

				// To Update Chapter from listing by ID
				if($this->input->post('update_Chapter')) 
				{
					$ppts = $this->input->post('ppts');

					if(!empty($ppts)){
						$PPT = 'Yes';
					}else{
						$PPT = 'No';
					}

					$filename = $_FILES['ppt_file']['name'];
					$allowed_types = 'ppts|ppt';
					$columnName = "ppt_file";
					$filepath = uploadFile($filename, $allowed_types, $columnName);

					$update_chapter_data = array(
						'module_id'				=> $this->input->post('module_id'),
						'chapter_title'			=> $this->input->post('chapter_title'),
						'chapter_description' 	=> $this->input->post('chapter_description'),
						'content' 				=> $this->input->post('content'),
						'time_duration'			=> $this->input->post('time_duration'),
						'ppts'					=> $PPT,
						'ppt_file'				=> $filepath,
						'video_url'				=> $this->input->post('video_url'),
						'advertisement_url'		=> $this->input->post('advertisement_url'),
						'updated_at'			=> date('Y-m-d H:i:s')
					);

					$update_chapter_data = array_filter($update_chapter_data);

					$Result = $this->chapters->update_Chapter_details($ChapterID, $update_chapter_data);

					if(!empty($Result))
					{					
						$data = array(
							'alertmsgClass'	=> 'alert-success',
							'alert_msg'		=> 'Chapter Updated Successfully..!'
						);
					}else
						{
							$data = array(
								'alertmsgClass'	=> 'alert-danger',
								'alert_msg'		=> 'Unable to Update Chapter..!'
							);
						}
					redirect('/chapter/list');
				}

			}else
			{
				redirect('/chapter/list');
			}

		}else
		{
			redirect('/chapter/list');
		}
		
		$this->load->view('admin/chapters/update_chapter.view.php',$data);
	}


	/*
	* Function Call - To Update Single Question Details by ID
	*/
	public function updateChapterQuestion()
	{
		$data['title'] = 'Update Question';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$QuestionID = $URLData['0'];

				$QuestionDetails = $this->chapters->get_Question_details_ByID($QuestionID);

				$data['QuestionDetails'] = $QuestionDetails;
				
				// To Update question from listing by ID
				if($this->input->post('update_question')) 
				{
					$update_data = array(
						'correct_answer'	=> $this->input->post('correct_answer'),
						'option4'					=> $this->input->post('option4'),
						'option3' 				=> $this->input->post('option3'),
						'option2' 				=> $this->input->post('option2'),
						'option1'					=> $this->input->post('option1'),
						'question_title'  => $this->input->post('question_title')
					);

					$update_data = array_filter($update_data);

					$Result = $this->chapters->update_Question_details($QuestionID, $update_data);

					if(!empty($Result))
					{					
						$data = array(
							'alertmsgClass'	=> 'alert-success',
							'alert_msg'		=> 'Question Updated Successfully..!'
						);
					}else
						{
							$data = array(
								'alertmsgClass'	=> 'alert-danger',
								'alert_msg'		=> 'Unable to Update Question..!'
							);
						}
					redirect('/chapter/details/'.encryptID($this->session->userdata('id'),$QuestionDetails['chapter_id']));
				}

			}else
			{
				redirect('/chapter/details/'.encryptID($this->session->userdata('id'),$QuestionDetails['chapter_id']));
			}

		}else
		{
			redirect('/chapter/list');
		}
		
		$this->load->view('admin/chapters/update_question.view.php',$data);
	}



	/*
	* Function Call - To Update Chapter Content Details by ID
	*/
	public function UpdateChapterContentDetails()
	{
		if($this->input->is_ajax_request()) 
		{
    		$chapterID = $this->input->post('content_chapter_id');

        	$chapterContent = $this->input->post('markup');

        	$chapter_content_data = array('content'	=> $chapterContent);

			$chapter_content_data = array_filter($chapter_content_data);

			$Result = $this->chapters->update_chapter_content_details($chapterID, $chapter_content_data);

			return $Result;
		}
	}


	/*
	* Function call - To delete Chapter from listing by ID
	*/
	public function deleteChapter()
	{
		if ($this->input->is_ajax_request()) {

			if ($this->input->post('chapterID')) 
			{
				$chapterID = $this->input->post('chapterID');

				$Result = $this->chapters->delete_Chapter($chapterID);
			}
    	}else
		{
			redirect('/chapter/list');
		}
	}


	/*-------------------------------------------------------------------
					CHAPTER Questions DATA
	-------------------------------------------------------------------*/
	/*
	* Function Call - To create New Chapter Questions
	*/
	public function CreateChapterQuestions()
	{
		$data['title'] = 'Create New Chapter Questions';

		//$data['AllModules'] = $this->chapters->getAllModules();

		// To create New Chapter
		if($this->input->post('create_question')) 
		{
			$question_data = array(
				'module_id'		 => $this->input->post('module_id'),
				'chapter_id'	 => $this->input->post('chapter_id'),
				'question_title' => $this->input->post('question_title'),
				'option1'		 => $this->input->post('option1'),
				'option2'		 => $this->input->post('option2'),
				'option3'		 => $this->input->post('option3'),
				'option4'		 => $this->input->post('option4'),
				'correct_answer' => $this->input->post('Correct_option')
			);

			$Result = $this->chapters->create_new_question($question_data);

			if(!empty($Result))
			{
				$this->session->set_flashdata('item', array(
					'message' => 'New Question Created Successfully..!',
					'class' => 'success'
				));
			}else
			{
				$this->session->set_flashdata('item', array(
					'message' => 'Unable to Create Question..!',
					'class' => 'danger'
				));
			}
			redirect('/chapter/details/'.encryptID($this->session->userdata('id'),$this->input->post('chapter_id')));
		}

		if ($this->input->post('import_question')) 
		{
			$filename = $_FILES['Question_file']['name'];

			$allowed_types = 'csv';
			$columnName = "Question_file";
			$filepath = uploadFile($filename, $allowed_types, $columnName);

			//print_r($filepath); die('m here');

			if ($filepath) 
      {
        $csv_arrayData = $this->csvreader->parse_file($filepath);

        foreach ($csv_arrayData as $row) 
        {
        	$question_data = array(
						'module_id'		   => $row['module_id'],
						'chapter_id'	   => $row['chapter_id'],
						'question_title' => $row['question_title'],
						'option1'		     => $row['option1'],
						'option2'		     => $row['option2'],
						'option3'		     => $row['option3'],
						'option4'		     => $row['option4'],
						'correct_answer' => $row['correct_answer']
					);

        	$Result = $this->chapters->create_new_question($question_data);

					if(!empty($Result))
					{
						$this->session->set_flashdata('item', array(
							'message' => 'New Question Created Successfully..!',
							'class' => 'success'
						));
					}else
					{
						$this->session->set_flashdata('item', array(
							'message' => 'Unable to Create Question..!',
							'class' => 'danger'
						));
					}
        } 
      }

			redirect('/chapter/details/'.encryptID($this->session->userdata('id'),$this->input->post('chapter_id')));
		}

		$this->load->view('admin/chapters/chapter_details.view.php',$data);
	}

	/*
	* Function call - To Delete chapter questions from database
	*/

	public function DeleteChapterQuestions()
	{
		if ($this->input->is_ajax_request()) {

			if ($this->input->post('questionID')) 
			{
				$questionID = $this->input->post('questionID');

				$Result = $this->chapters->delete_Question($questionID);
			}
    	}else
		{
			redirect('/chapter/details/'.encryptID($this->session->userdata('id'),$this->input->post('chapter_id')));
		}
	}

	/*-------------------------------------------------------------------
					CHAPTER TEST DATA
	-------------------------------------------------------------------*/
	
	/*
	* Function call - To List all the existing ChapterTests in database
	*/
	public function listAllChapterTests()
	{
		$data['title'] = 'All ChapterTests';
		$data['AllChapterTests'] = $this->chapters->getAllChapterTests();

		// To delete ChapterTest from listing by ID
		if($this->input->post('delete_ChapterTest')) 
		{
				
			$ChapterTestID = $this->input->post('delete_ChapterTest');
			$Result = $this->chapters->delete_ChapterTest($ChapterTestID);

			if(!empty($Result)) 
			{
				$data = array(
					'alertmsgClass'	=> 'alert-success',
					'alert_msg'		=> 'Chapter Test delete Successfully..!'
				);
			}else
			{
				$data = array(
					'alertmsgClass'	=> 'alert-danger',
					'alert_msg'		=> 'Unable to delete Chapter Test..!'
				);
			}
		}
		$this->load->view('admin/chapter_test/all_chapter_tests.view.php',$data);
	}


	/*
	* Function Call - To create New ChapterTest
	*/
	public function createNewChapterTest()
	{
		$data['title'] = 'Create New ChapterTest';

		// To create New ChapterTest
		if($this->input->post('create_ChapterTest')) 
		{
			$newChapter_test_data = array(
				'module_id'			=> $this->input->post('module_id'),
				'chapter_id'		=> $this->input->post('chapter_id'),
				'no_of_questions'	=> $this->input->post('no_of_questions'),
				'question_title'	=> $this->input->post('question_title'),
				'option1'			=> $this->input->post('option1'),
				'option2'			=> $this->input->post('option2'),
				'option3'			=> $this->input->post('option3'),
				'option4'			=> $this->input->post('option4')
			);

			$Result = $this->chapters->create_new_ChapterTest($newChapter_test_data);

			if(!empty($Result)) {
				$data = array(
					'alertmsgClass'	=> 'alert-success',
					'alert_msg'		=> 'New Chapter Test Created Successfully..!'
				);
			}else{
				$data = array(
					'alertmsgClass'	=> 'alert-danger',
					'alert_msg'		=> 'Unable to Create Chapter Test..!'
				);
			}
		}

		$this->load->view('admin/chapter_test/create_chapter_test.view.php',$data);
	}


	/*
	* Function Call - To Update ChapterTest Details by ID
	*/
	public function UpdateChapterTestDetails()
	{
		$data['title'] = 'Update ChapterTest Details';

		if ($this->input->get('id')) 
		{
			$ChapterTestID = $this->input->get('id');

			$data['ChapterTestDetails'] = $this->chapters->get_ChapterTest_details_ByID($ChapterTestID);

			// To Update ChapterTest from listing by ID
			if($this->input->post('update_ChapterTest')) 
			{

				$updateChapter_test_data = array(
					'module_id'			=> $this->input->post('module_id'),
					'chapter_id'		=> $this->input->post('chapter_id'),
					'no_of_questions'	=> $this->input->post('no_of_questions'),
					'question_title'	=> $this->input->post('question_title'),
					'option1'			=> $this->input->post('option1'),
					'option2'			=> $this->input->post('option2'),
					'option3'			=> $this->input->post('option3'),
					'option4'			=> $this->input->post('option4')
				);

				$updateChapter_test_data = array_filter($updateChapter_test_data);

				$ChapterTestID = $this->input->post('ChapterTestID');

				$Result = $this->chapters->update_ChapterTest_details($ChapterTestID, $updateChapter_test_data);

				if(!empty($Result)) 
				{
					$data = array(
						'alertmsgClass'	=> 'alert-success',
						'alert_msg'		=> 'Chapter Test Updated Successfully..!'
					);
				}else
				{
					$data = array(
						'alertmsgClass'	=> 'alert-danger',
						'alert_msg'		=> 'Unable to Update Chapter Test..!'
					);
				}
				redirect('/ChapterTest/list');
			}
		}else
		{
			redirect('/ChapterTest/list');
		}
		
		$this->load->view('admin/chapter_test/update_chapter_test.view.php',$data);
	}
}