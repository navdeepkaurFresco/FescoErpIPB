<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load model
		$this->load->model('Modules_model','modules');

		$this->load->library('csvreader');

		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}


	/*
	* Function call - To List all the existing Modules in database
	*/
	public function listAllModules()
	{
		$data['title'] = 'All Modules';

		$data['AllModules'] = $this->modules->getAllModules();
		
		$this->load->view('admin/modules/all_modules.view.php',$data);
	}


	/*
	* Function Call - To create New Module
	*/
	public function createNewModule()
	{
		$data['title'] = 'Create New Module';

		$data['instructors'] = $this->modules->getAllInstructors();

		// To create New Module
		if($this->input->post('create_Module')) 
		{
			$filename = $_FILES['course_image']['name'];

			$columnName = "course_image";

			$allowed_types = 'jpg|jpeg|png|gif';

			$columnName 	= "course_image";

			$course_image = uploadFile($filename, $allowed_types, $columnName);

			$new_module_data = array(
				'instructor_id'	=> $this->input->post('instructor_id'),
				'course_title'	=> $this->input->post('course_title'),
				'fee' 			=> $this->input->post('fee'),
				'brief_detail' 	=> $this->input->post('brief_detail'),
				'time_duration' => $this->input->post('time_duration'),
				'course_image'	=> $course_image
			);

			$Result = $this->modules->create_new_Module($new_module_data);

			if(!empty($Result)) 
			{
				$data = array(
					'alertmsgClass'	=> 'alert-success',
					'alert_msg'		=> 'New Module Created Successfully..!'
				);
			}else
			{
				$data = array(
					'alertmsgClass'	=> 'alert-danger',
					'alert_msg'		=> 'Unable to Create Module..!'
				);
			}
			redirect('/module/list');
		}
		$this->load->view('admin/modules/create_module.view.php',$data);
	}



	/*
	* Function Call - To Update Module Details by ID
	*/
	public function UpdateModuleDetails()
	{
		$data['title'] = 'Update Module Details';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$ModuleID = $URLData['0'];

				$data['ModuleDetails'] = $this->modules->get_Module_details_ByID($ModuleID);

				$data['instructors'] = $this->modules->getAllInstructors();

				// To Update Module from listing by ID
				if($this->input->post('update_Module')) 
				{
					$filename = $_FILES['course_image']['name'];

					$allowed_types = 'jpg|jpeg|png|gif';

					$columnName 	= "course_image";

					$course_image = uploadFile($filename, $allowed_types, $columnName);

					if (empty($filename)) 
					{
						$update_module_data = array(
						'instructor_id'	=> $this->input->post('instructor_id'),
						'course_title'	=> $this->input->post('course_title'),
						'fee' 			=> $this->input->post('fee'),
						'brief_detail' 	=> $this->input->post('brief_detail'),
						'time_duration' => $this->input->post('time_duration')
						);

						$update_module_data = array_filter($update_module_data);

						$Result = $this->modules->update_Module_details($ModuleID, $update_module_data);

						if(!empty($Result)) 
						{
							$data = array(
								'alertmsgClass'	=> 'alert-success',
								'alert_msg'		=> 'Module Updated Successfully..!'
							);
						}else
						{
							$data = array(
								'alertmsgClass'	=> 'alert-danger',
								'alert_msg'		=> 'Unable to Update Module..!'
							);
						}
					}else
						{
							$update_module_data = array(
								'instructor_id'	=> $this->input->post('instructor_id'),
								'course_title'	=> $this->input->post('course_title'),
								'fee' 			=> $this->input->post('fee'),
								'brief_detail' 	=> $this->input->post('brief_detail'),
								'time_duration' => $this->input->post('time_duration'),
								'course_image'	=> $course_image
							);

							$update_module_data = array_filter($update_module_data);

							$Result = $this->modules->update_Module_details($ModuleID, $update_module_data);

							if(!empty($Result)) 
							{
								$data = array(
									'alertmsgClass'	=> 'alert-success',
									'alert_msg'		=> 'Module Updated Successfully..!'
								);
							}else
								{
									$data = array(
										'alertmsgClass'	=> 'alert-danger',
										'alert_msg'		=> 'Unable to Update Module..!'
									);
								}
						}
					redirect('/module/list');
				}

			}else
			{
				redirect('/module/list');
			}
		}else
		{
			redirect('/module/list');
		}
		
		$this->load->view('admin/modules/update_module.view.php',$data);
	}


	/*
	* Function Call - To Update Single Question Details by ID
	*/
	public function UpdateModuleQuestions()
	{
		$data['title'] = 'Update Question';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$QuestionID = $URLData['0'];

				$QuestionDetails = $this->modules->get_Question_details_ByID($QuestionID);
				
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

					$Result = $this->modules->update_Question_details($QuestionID, $update_data);

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
					redirect('/module/detail/'.encryptID($this->session->userdata('id'),$QuestionDetails['module_id']));
				}

			}else
			{
				redirect('/module/detail/'.encryptID($this->session->userdata('id'),$data['QuestionDetails']['module_id']));
			}

		}else
		{
			redirect('/module/list');
		}
		
		$this->load->view('admin/modules/update_question.view.php',$data);
	}


	/*
	* Function call - To delete Module from listing by ID
	*/
	public function deleteModule()
	{
		if ($this->input->is_ajax_request()) 
		{
			if ($this->input->post('module_id')) 
			{
				$moduleID = $this->input->post('module_id');

				$Result = $this->modules->delete_module($moduleID);
			}
    	}else
		{
			redirect('/module/list');
		}
	}


	/*
	* Function Call - To get Single Module Details by ID
	*/
	public function single_moduleDetail()
	{
		$data['title'] = 'Module Details';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$moduleId = $URLData['0'];
				$where = array('module_id' => $moduleId);

				$data['singleModuleDetail'] = $this->modules->single_module_detail($moduleId);
				$data['moduleQuestions']    = $this->modules->get_module_questions($moduleId);
				$data['finalExamSettings']  = $this->modules->get_final_exam_settings($where);
				
				if($this->input->post('submit_test_Details')) 
				{
					$test_data = array(
						'module_id'          => $moduleId,
						'default_settings'   => '0',
						'no_of_questions'    => $this->input->post('no_of_questions'),
						'test_time'          => $this->input->post('test_time'),
						'question_marks'     => $this->input->post('per_question_marks'),
						'no_of_attempts'     => $this->input->post('test_attempts')
					);

					if(!empty($data['finalExamSettings']))
					{
						$updatewhere = array('module_id' => $moduleId);
						$Result = $this->modules->Update_finalExamSettings($updatewhere ,$test_data);
					}else
					{
						$Result = $this->modules->create_finalExamSettings($test_data);
					}
				}
				$data['finalExamSettings'] = $this->modules->get_final_exam_settings($where);

			}else
			{
				redirect('module/list');
			}

		}else
		{
			redirect('module/list');
		}

		$this->load->view('admin/modules/single_moduleDetail.view.php', $data);
	}

	/*-------------------------------------------------------------------
						FINAL EXAM DATA HERE
	-------------------------------------------------------------------*/
	/*
	* Function call - To List all the existing FinalExams in database
	*/
	public function FinalexamDefaultSettings()
	{
		$data['title'] = 'Final Exam Default Settings';

		$getwhere = array('default_settings' => '1');

		$data['default_settings'] = $this->modules->get_final_exam_settings($getwhere);

		if($this->input->post('submit_test_Details')) 
		{
			$test_data = array(
				'no_of_questions'    => $this->input->post('no_of_questions'),
				'test_time'          => $this->input->post('test_time'),
				'module_id'          => '0',
				'question_marks'     => $this->input->post('per_question_marks'),
				'no_of_attempts'     => $this->input->post('test_attempts')
			);

			if(!empty($data['default_settings']))
			{
				$updatewhere = array('default_settings' => '1');
				$Result = $this->modules->Update_finalExamSettings($updatewhere,$test_data);

				if(!empty($Result))
				{
					$data = $this->session->set_flashdata('defaultsettingmsg', array(
						'alertmsgClass' => 'success',
						'alert_msg'     => 'Final Exam Default Settings updated Successfully..!'
					));
				}
			}
		}
		$data['default_settings'] = $this->modules->get_final_exam_settings($getwhere);

		$this->load->view('admin/final_exams/default_finalexam_details.view.php',$data);
	}

	/*-------------------------------------------------------------------
					CHAPTER Questions DATA
	-------------------------------------------------------------------*/
	/*
	* Function Call - To create New Module Questions
	*/
	public function CreateModulesQuestions()
	{
		$data['title'] = 'Create New Module Questions';		

		if($this->input->post('create_question')) 
		{
			$question_data = array(
				'module_id'		 => $this->input->post('module_id'),
				// 'chapter_id'	 => $this->input->post('chapter_id'),
				'question_title' => $this->input->post('question_title'),
				'option1'		 => $this->input->post('option1'),
				'option2'		 => $this->input->post('option2'),
				'option3'		 => $this->input->post('option3'),
				'option4'		 => $this->input->post('option4'),
				'correct_answer' => $this->input->post('Correct_option')
			);

			$Result = $this->modules->create_new_question($question_data);

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
			redirect('/module/detail/'.encryptID($this->session->userdata('id'),$this->input->post('module_id')));
		}

		if ($this->input->post('import_question')) 
		{
			
			$filename = $_FILES['Question_file']['name'];
			$allowed_types = 'csv';
			$columnName = "Question_file";

			$filepath = uploadFile($filename, $allowed_types, $columnName);

			if ($filepath) 
	        {
	            $csv_arrayData = $this->csvreader->parse_file($filepath);

	            foreach ($csv_arrayData as $row) 
	            {
	            	$question_data = array(
						'module_id'		 => $row['module_id'],
						'question_title' => $row['question_title'],
						'option1'		 => $row['option1'],
						'option2'		 => $row['option2'],
						'option3'		 => $row['option3'],
						'option4'		 => $row['option4'],
						'correct_answer' => $row['correct_answer']
					);

	            	$Result = $this->modules->create_new_question($question_data);

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

			redirect('/module/detail/'.encryptID($this->session->userdata('id'),$this->input->post('module_id')));
		}

		$this->load->view('admin/modules/single_moduleDetail.view.php', $data);
	}
}