<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load model
		$this->load->model('Settings_model','settings');
		
		
		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}

/*****************************************************************************
Monthly Expenses Tab
******************************************************************************/
	/*
	* Function Call - Monthly Expenses settings
	*/
	public function MonthlyExpenses()
	{
		$data['title'] = 'Monthly Expenses';

		if($this->input->post('submit_expenses'))
		{
			$month_name = '01-'.$this->input->post('month')."-".$this->input->post('year');
			$monthlyExpenses = $this->input->post('monthly_expenses');

			$month 			= array('month_name'=> date($month_name));
			$total_expenses = $this->settings->getCurrentMonthExpenses($month);
			
			$dataArr = array(
				'month_name' => $month_name,
				'expenses'   => $monthlyExpenses
			);

			if(empty($total_expenses))
			{
				$Response = $this->settings->saveMonthyExpenses($dataArr);

				$alertmessage = "Monthly Expenses Added Successfully.....!";

				$alertmessageClass = "success";

			}else
			{
				$Response = $this->settings->update_monthly_expenses($month_name,$dataArr);

				$alertmessage = "Monthly Expenses Updated Successfully.....!";

				$alertmessageClass = "warning";
			}
			
			$this->session->set_flashdata('me_alertmessage', array(
				'message' => $alertmessage,
				'class'	  => $alertmessageClass
			));
		}

		$data['AllMonthlyExpenses'] = $this->settings->getAllMonthlyExpenses();

		$this->load->view('admin/settings/monthly_expenses.view.php',$data);
	}

/*****************************************************************************
Invoice Tab
******************************************************************************/
	/*
	* Function Call - Invoice Details settings
	*/
	public function InvoiceDetails()
	{
		$data['title'] = 'Invoice Details';

		if($this->input->post('update_invoice_details'))
		{			
			$dataArr = array(
				'company_address' => $this->input->post('company_address'),
				'gst_number'      => $this->input->post('gst_number'),
				'GST' 			  => $this->input->post('GST'),
				'IGST' 			  => $this->input->post('IGST')
			);

			$Response = $this->settings->update_invoice_details($dataArr);
			
			$this->session->set_flashdata('me_alertmessage', array(
				'message' => 'Invoice Details Updated Successfully.....!',
				'class'	  => 'warning'
			));
		}

		$data['InvoiceDetails'] = $this->settings->getInvoiceSettings();

		$this->load->view('admin/settings/invoice_settings.view.php',$data);
	}

/*****************************************************************************
FAQ Tab
******************************************************************************/
	/*
	* Function Call - FAQ's content
	*/
	public function FAQ()
	{
		$data['title'] = 'FAQ';

		if($this->input->post('create_faq'))
		{		
			$title = trim($this->input->post('title'));			
			$description = trim($this->input->post('description'));

			if($title == '' || $description == ''){
				$this->session->set_flashdata('alertmessage', array(
				'message' => 'All Fields are required!',
				'class'	  => 'danger'
			));
			}else{
				$dataArr = array(
				'title' 		=> $this->input->post('title'),
				'description'   => $this->input->post('description')
			);

			$Response = $this->settings->CreateNewFAQ($dataArr);
			
			$this->session->set_flashdata('alertmessage', array(
				'message' => 'New FAQ Added Successfully.....!',
				'class'	  => 'success'
			));
			}
			
		}

		$data['faq_content'] = $this->settings->getFAQContent();

		$this->load->view('admin/settings/faq.view.php',$data);
	}

	/*
	* Function Call - To update FAQ's content
	*/
	public function UpdateFAQ()
	{
		$data['title'] = "Update FAQ";
		
		if($this->uri->segment(4)) 
		{
			$URLData = decryptID($this->uri->segment(4));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$faqID = $URLData['0'];

				$data['faqContent'] = $this->settings->getSingleFAQ($faqID);

				if($this->input->post('update_faq'))
				{
					$title = trim($this->input->post('title'));			
					$description = trim($this->input->post('description'));

					if($title == '' || $description == ''){
						$this->session->set_flashdata('alertmessage', array(
						'message' => 'All Fields are required!',
						'class'	  => 'danger'
					));
					}else{
						$dataArr = array(
							'title' 		=> $this->input->post('title'),
							'description'   => $this->input->post('description')
						);

						$Response = $this->settings->update_FAQ($faqID,$dataArr);

						if($Response)
						{
							$this->session->set_flashdata('alertmessage', array(
								'message' => 'FAQ updated Successfully.....!',
								'class'	  => 'warning'
							));
						}else
						{
							$this->session->set_flashdata('alertmessage', array(
								'message' => 'Unable to update FAQ.....!',
								'class'	  => 'danger'
							));
						}
						redirect('settings/faq');
					}
				}
			}else
			{
				redirect('settings/faq');
			}
		}else
		{
			redirect('settings/faq');
		}

		$this->load->view('admin/settings/update_faq.view.php',$data);
	}

/*****************************************************************************
Download Tab
******************************************************************************/
	/*
	* Function Call - To update downloadable content to database
	*/
	public function DownloadableContent()
	{
		$data['title'] = "Downloadable Content";

		$data['DownloadableContent'] = $this->settings->get_downloadable_content();

		$this->load->view('admin/settings/downloadable.view.php',$data);
	}


	/*
	* Function Call - To update downloadable content to database
	*/
	public function SaveDownloadableFile()
	{
		$data['title'] = "Create Downloadable Content";

		if($this->input->post('create_file'))
		{
			if(!empty($_FILES['file_url']))
			{
				$filename = $_FILES['file_url']['name'];

				$allowed_types = 'jpg|jpeg|png|gif|pdf|csv|doc';

				$columnName   = "file_url";

				$profileImage = uploadFile($filename, $allowed_types, $columnName);
			}else
			{
				$profileImage = '';
			}

			$dataArr = array(
				'title'		=> $this->input->post('title'),
				'file_url' 	=> $profileImage
			);

			$result = $this->settings->save_downloadable_content($dataArr);

			if($result)
			{
				$this->session->set_flashdata('alertmessage', array(
					'message' => 'File Added Successfully.....!',
					'class'	  => 'success'
				));
			}

			redirect('settings/downloads');
		}

		$this->load->view('admin/settings/downloadable.view.php',$data);
	}


	/*
	* Function call - To delete Instructor from listing by ID
	*/
	public function DeleteFile()
	{
		if ($this->input->is_ajax_request())
		{
			$fileID = $this->input->post('delete_file');

			$Result = $this->settings->delete_file_by_id($fileID);
    	}else
		{
			redirect('settings/downloads');
		}
	}

}