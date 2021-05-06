<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();
		// Load model
		$this->load->model('Announcement_model');

		$this->load->library('upload');

		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}


	/*
	* Function call - To show landing page of website.
	*/
	public function index()
	{
		$data['title'] = 'Dashboard';

		$this->load->view('admin/dashboard.view.php',$data);
	}

	/*
	* Function call - To Create headline.
	*/

	public function headline()
	{
		$data['title'] = 'Headline';


		if ($this->input->post('create_headline')) 
		{
			$switchStatus = $this->input->post('switchStatus');

			if (!empty($switchStatus)) 
			{
				$headlineData = array(
					'text' 		=> $this->input->post('headlineText'),
					'start_date'=> dateFormat($this->input->post('StartDate')),
					'end_date' 	=> dateFormat($this->input->post('endDate')),
					'user_type' => $this->input->post('select_userType'),
					'display' 	=> '1',
					'category' 	=> '1'
				);
			}else
				{
					$headlineData = array(
					'text' 		=> $this->input->post('headlineText'),
					'start_date'=> dateFormat($this->input->post('StartDate')),
					'end_date' 	=> dateFormat($this->input->post('endDate')),
					'user_type'	=> $this->input->post('select_userType'),
					'display' 	=> '0',
					'category' 	=> '1'
					);
				}
			
			$headlineData = array_filter($headlineData);

			$result = $this->Announcement_model->createHeadline($headlineData);

			if (!empty($result)) 
			{
				$this->session->set_flashdata('item_headline', array(
						'message' 	=> 'Headline created Successfully...!',
						'class' 	=> 'success'
					));
			}else
				{
					$this->session->set_flashdata('item_headline', array(
						'message' 	=> 'Enable to create Headline. Try Again...!',
						'class' 	=> 'danger'
					));
				}
		}

		$data['allHeadlines'] = $this->Announcement_model->get_Headlines();
		
		$this->load->view('admin/announcement/healines.view.php',$data);
	}

	/*
	* Function call - To create news.
	*/

	public function createNews()
	{
		$data['title'] = 'News';

		if ($this->input->post('create_news')) 
		{

			$switchStatus = $this->input->post('switchStatus');

			if (!empty($switchStatus)) 
			{
				$newsData = array(
					'text' 		=> $this->input->post('newsText'),
					'start_date'=> dateFormat($this->input->post('StartDate')),
					'end_date' 	=> dateFormat($this->input->post('endDate')),
					'user_type' => $this->input->post('select_userType'),
					'display' 	=> '1',
					'category' 	=> '2'
				);
			}else
				{
					$newsData = array(
						'text' 		=> $this->input->post('newsText'),
						'start_date'=> dateFormat($this->input->post('StartDate')),
						'end_date' 	=> dateFormat($this->input->post('endDate')),
						'user_type' => $this->input->post('select_userType'),
						'display' 	=> '0',
						'category' 	=> '2'
					);
				}

			$newsData = array_filter($newsData);

			$result = $this->Announcement_model->createNews($newsData);

			if (!empty($result)) 
			{
				$this->session->set_flashdata('item_news', array(
						'message' 	=> 'News created Successfully...!',
						'class'	 	=> 'success'
					));
			}else
				{
					$this->session->set_flashdata('item_news', array(
						'message' 	=> 'Enable to create News. Try Again...!',
						'class' 	=> 'danger'
					));
				}
		}

		$data['allNews'] = $this->Announcement_model->get_News();
		
		$this->load->view('admin/announcement/news.view.php',$data);
	}

	/*
	* Function call - To create banner.
	*/

	public function createBanner()
	{
		$data['title'] = 'Banner';

		if ($this->input->post('create_Banner')) 
		{
			$filename 		= $_FILES['banner_image']['name'];

			/*print_r($filename);
			die();*/
			$allowed_types = 'jpg|jpeg|png|gif';

			$columnName 	= "banner_image";

			$bannerImage = uploadFile($filename, $allowed_types, $columnName);

			/*print_r($bannerImage);
			die();*/
			
			$switchStatus = $this->input->post('switchStatus');

			if (!empty($switchStatus)) 
			{
				$bannerData = array(
					'banner_image' => $bannerImage,
					'alt_text' 	=> $this->input->post('AltText'),
					'start_date'=> dateFormat($this->input->post('StartDate')),
					'end_date'	=> dateFormat($this->input->post('endDate')),
					'user_type' => $this->input->post('select_userType'),
					'display' 	=> '1',
					'category' 	=> '3'
				);
			}else
				{
					$bannerData = array(
						'banner_image' => $bannerImage,
						'alt_text' 	=> $this->input->post('AltText'),
						'start_date'=> dateFormat($this->input->post('StartDate')),
						'end_date' 	=> dateFormat($this->input->post('endDate')),
						'user_type' => $this->input->post('select_userType'),
						'display' 	=> '0',
						'category' 	=> '3'
					);
				}
			/*print_r($bannerData);
			die();*/
			/*$bannerData = array_filter($bannerData);*/

			$result = $this->Announcement_model->createBanner($bannerData);

			if (!empty($result)) 
			{
				$this->session->set_flashdata('item_banner', array(
						'message' 	=> 'Banner created Successfully...!',
						'class' 	=> 'success'
					));
			}else
				{
					$this->session->set_flashdata('item_banner', array(
						'message' 	=> 'Enable to create Banner. Try Again...!',
						'class' 	=> 'danger'
					));
				}
		}

		$data['allBanner'] = $this->Announcement_model->get_Banners();

		$this->load->view('admin/announcement/banner.view.php',$data);
	}

	/*
	* Function call - To Update headline.
	*/

	public function headlineUpdate()
	{
		$data['title'] = 'Headline';

		if($this->uri->segment(3)) 
		{
			$URLData 	= decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$headline_ID = $URLData['0'];

				$data['SingleHeadlineDetail'] = $this->Announcement_model->get_headline_details_ByID($headline_ID);

				if ($this->input->post('update_headline')) 
				{
					$switchStatus = $this->input->post('switchStatus');


					if (!empty($switchStatus)) 
					{
						$update_headlineData = array(
							'text' 		=> $this->input->post('headlineText'),
							'start_date'=> dateFormat($this->input->post('StartDate')),
							'end_date' 	=> dateFormat($this->input->post('endDate')),
							'user_type' => $this->input->post('select_userType'),
							'display' 	=> '1',
							'category' 	=> '1'
						);
					}else
						{
							$update_headlineData = array(
							'text' 		=> $this->input->post('headlineText'),
							'start_date'=> dateFormat($this->input->post('StartDate')),
							'end_date' 	=> dateFormat($this->input->post('endDate')),
							'user_type' => $this->input->post('select_userType'),
							'display' 	=> '0',
							'category' 	=> '1'
							);
						}
					
					/*$update_headlineData = array_filter($update_headlineData);*/

					$result = $this->Announcement_model->update_Headline($headline_ID, $update_headlineData);

					if (!empty($result)) 
					{
						$this->session->set_flashdata('item_headline_update', array(
								'message' => 'Headline update Successfully...!',
								'class' => 'success'
							));
					}else
						{
							$this->session->set_flashdata('item_headline_update', array(
								'message' => 'Enable to update Headline. Try Again...!',
								'class' => 'danger'
							));
						}

					redirect('/announcement/headline');
				}
			}
		}
		$data['allHeadlines'] = $this->Announcement_model->get_Headlines();
		
		$this->load->view('admin/announcement/update_headline.view.php',$data);
	}

	/*
	* Function call - To Update news.
	*/

	public function newsUpdate()
	{
		$data['title'] = 'News';

		if($this->uri->segment(3)) 
		{
			$URLData 	= decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{

				$newsID = $URLData['0'];

				$data['SingleNewsDetail'] = $this->Announcement_model->get_news_details_ByID($newsID);

				if ($this->input->post('update_news')) 
				{
					$switchStatus = $this->input->post('switchStatus');

					if (!empty($switchStatus)) 
					{
						$update_newsData = array(
							'text' 		=> $this->input->post('newsText'),
							'start_date'=> dateFormat($this->input->post('StartDate')),
							'end_date' 	=> dateFormat($this->input->post('endDate')),
							'user_type' => $this->input->post('select_userType'),
							'display' 	=> '1',
							'category' 	=> '2'
						);
					}else
						{
							$update_newsData = array(
							'text' 		=> $this->input->post('newsText'),
							'start_date'=> dateFormat($this->input->post('StartDate')),
							'end_date' 	=> dateFormat($this->input->post('endDate')),
							'user_type' => $this->input->post('select_userType'),
							'display' 	=> '0',
							'category' 	=> '2'
							);
						}

					// $update_newsData = array_filter($update_newsData);

					$result = $this->Announcement_model->update_News($newsID, $update_newsData);

					if (!empty($result)) 
					{
						$this->session->set_flashdata('item_news_update', array(
								'message' 	=> 'News update Successfully...!',
								'class'	 	=> 'success'
							));
					}else
						{
							$this->session->set_flashdata('item_news_update', array(
								'message' 	=> 'Enable to create News. Try Again...!',
								'class' 	=> 'danger'
							));
						}
					redirect('/announcement/news');
				}
			}
		}
		$data['allNews'] = $this->Announcement_model->get_News();
		
		$this->load->view('admin/announcement/update_news.view.php',$data);
	}

	/*
	* Function call - To update banner.
	*/

	public function bannerUpdate()
	{
		$data['title'] = 'Banner';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{

				$bannerID = $URLData['0'];

				$data['SingleBannerDetail'] = $this->Announcement_model->get_banner_details_ByID($bannerID);

				if ($this->input->post('update_Banner')) 
				{

					$switchStatus = $this->input->post('switchStatus');

					$filename 		= $_FILES['updatedBanner_image']['name'];

					$allowed_types = 'jpg|jpeg|png|gif';

					$columnName 	= "updatedBanner_image";

					$bannerImage = uploadFile($filename, $allowed_types, $columnName);

					if (!empty($filename)) 
					{

						if (!empty($switchStatus)) 
						{
							$update_bannerData = array(
								'banner_image' => $bannerImage,
								'alt_text' 	=> $this->input->post('AltText'),
								'start_date'=> dateFormat($this->input->post('StartDate')),
								'end_date'	=> dateFormat($this->input->post('endDate')),
								'user_type' => $this->input->post('select_userType'),
								'display' 	=> '1',
								'category' 	=> '3'
							);
						}else
							{
								$update_bannerData = array(
									'banner_image' => $bannerImage,
									'alt_text' 	=> $this->input->post('AltText'),
									'start_date'=> dateFormat($this->input->post('StartDate')),
									'end_date' 	=> dateFormat($this->input->post('endDate')),
									'user_type' => $this->input->post('select_userType'),
									'display' 	=> '0',
									'category' 	=> '3'
								);
							}
					}else
						{

							if (!empty($switchStatus)) 
							{
								$update_bannerData = array(
									'alt_text' 	=> $this->input->post('AltText'),
									'start_date'=> dateFormat($this->input->post('StartDate')),
									'end_date'	=> dateFormat($this->input->post('endDate')),
									'user_type' => $this->input->post('select_userType'),
									'display' 	=> '1',
									'category' 	=> '3'
								);
							}else
								{
									$update_bannerData = array(
										'alt_text' 	=> $this->input->post('AltText'),
										'start_date'=> dateFormat($this->input->post('StartDate')),
										'end_date' 	=> dateFormat($this->input->post('endDate')),
										'user_type' => $this->input->post('select_userType'),
										'display' 	=> '0',
										'category' 	=> '3'
									);
								}
						}

					// $update_bannerData = array_filter($update_bannerData);

					$result = $this->Announcement_model->updateBanner($bannerID, $update_bannerData);

					if (!empty($result)) 
					{
						$this->session->set_flashdata('item_banner_update', array(
								'message' 	=> 'Banner update Successfully...!',
								'class' 	=> 'success'
							));
					}else
						{
							$this->session->set_flashdata('item_banner_update', array(
								'message' 	=> 'Enable to update Banner. Try Again...!',
								'class' 	=> 'danger'
							));
						}
					redirect('/announcement/banner');
				}
			}
		}

		$data['allBanner'] = $this->Announcement_model->get_Banners();

		$this->load->view('admin/announcement/update_banner.view.php',$data);
	}


	/*
	* Function call - To Delete headline.
	*/

	public function headlineDelete()
	{
		if ($this->input->is_ajax_request()) {

			if ($this->input->post('headlineID')) 
			{
				
				$headlineID = $this->input->post('headlineID');

				$Result = $this->Announcement_model->delete_Headline($headlineID);
			}
    	}else
		{
			redirect('/announcement/headline');
		}
	}

	/*
	* Function call - To Delete news.
	*/

	public function newsDelete()
	{
		if ($this->input->is_ajax_request()) {

			if ($this->input->post('newsID')) 
			{
				$newsID = $this->input->post('newsID');

				$Result = $this->Announcement_model->delete_News($newsID);
			}
    	}else
		{
			redirect('/announcement/news');
		}
	}

	/*
	* Function call - To Delete Banner.
	*/

	public function bannerDelete()
	{
		if ($this->input->is_ajax_request()) {

			if ($this->input->post('bannerID')) 
			{
				$bannerID = $this->input->post('bannerID');

				$Result = $this->Announcement_model->delete_Banner($bannerID);
			}
    	}else
		{
			redirect('/announcement/banner');
		}
	}

	/*
	* Function call - To change the display value of announcement from database.
	*/

	public function updateDisplay_Value()
	{
		if ($this->input->is_ajax_request())
		{
			$announcementID = $this->input->post('announcementID');

			/*get announcements*/
			$announcement = $this->Announcement_model->get_announcementDetails($announcementID);

			// $switchStatus = $this->input->post('switchStatus');

			if ($announcement['display'] == 1) 
			{
				$display_value = array('display'=>0);
			}else
				{
					$display_value = array('display'=>1);
				}

			$Result = $this->Announcement_model->Update_display_value($announcementID, $display_value);	

			if (!empty($Result)) 
			{
				echo "Display value has been changed Successfully....!";
			}else
				{
					echo "Can't update";
				}
    	}
	}

}