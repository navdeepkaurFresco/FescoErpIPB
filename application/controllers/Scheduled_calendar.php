<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduled_calendar extends CI_Controller {

	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// load helper
		$this->load->helper('ipbtools');

		$this->load->model('scheduledCalendar_model');

		if(!isset($this->session->userdata['instructorLogin']))
		{
			redirect('login');
		}
	}


	/*
	* Function call - To load backend_resources
	*/
	public function backend_resources()
	{
		$data['title'] = 'backend resources';

		$instructorId = $this->session->userdata('id');

		$data['instructorDetail'] = $this->scheduledCalendar_model->instructor_detail($instructorId);
		
		$this->load->view('instructor/include_calendar/backend_resources.php',$data);
	}
}