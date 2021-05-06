<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller 
{
	/*
	* constructor function
	*/
	public function __construct()
	{
		parent::__construct();

		// Load model
		$this->load->model('Reports_model', 'reports');

		if(!isset($this->session->adminLogin))
		{
			redirect('login');
		}
	}

/******************************************************************
Sales Report
******************************************************************/
	/*
	* Function call - To get sales data from database.
	*/
	public function SalesReport()
	{
		$data['title'] = 'Sales Report';

		$startdate = $enddate = '';

		// widget's count
		$data['lastyear']  = $this->reports->SalesReportLastYearCount();
		$data['lastmonths'] = $this->reports->SalesReportLastMonthsCount();
		$data['thismonth'] = $this->reports->SalesReportThisMonthCount();
		$data['todaycount'] = $this->reports->SalesReportTodayCount();
		$data['totalselling'] = $this->reports->SalesReportTotalsellingCount();

		//Table listing content
		$data['SalesReport'] = $this->reports->SalesReport($startdate,$enddate);

		// To show all the modules on bar chart
		$getModuleTitles = $this->reports->getModuleTitles(); 	
		$data['getModuleTitles'] = "'".$getModuleTitles['course_title']."'";

		// To get each module monthly sale.
		$data['getModuleSales'] = $this->reports->getEachModuleSalesDateVice();
		
		$this->load->view('admin/reports/sales.view.php',$data);
	}


	/*
	* Function call - To get sales data from database.
	*/
	public function getFilterSales()
	{
		if($this->input->is_ajax_request())
		{
			$selecteddates = explode("-", $this->input->post('selectedDates'));

			$startdate = date("Y-m-d", strtotime($selecteddates[0]));
			$enddate = date("Y-m-d", strtotime($selecteddates[1]));

			$data['filtersales'] = $this->reports->SalesReport($startdate,$enddate);

			$filteredContent = $this->load->view('admin/reports/snippet/filter_sales.php',$data);

			echo json_encode($filteredContent);
		}else
		{
			redirect('404');
		}
	}

/******************************************************************
Transaction Report
******************************************************************/
	/*
	* Function call - To get all the transactions data from database.
	*/
	public function TransactionsReport()
	{
		$data['title'] = 'Transaction Report';

		$startdate = $enddate = '';

		$data['allTransactions'] = $this->reports->getAllTransactions($startdate,$enddate);

		// Transactions Line Chart Content
		$LinechartContent = $this->reports->getTransaction_linechartcontent();

		$result = array();

		foreach($LinechartContent as $key => $value)
		{
			$result[] = "['".date("M, Y",strtotime($value['created_at']))."',".$value['total']."]";
		}

		$resultString = implode(',', $result);

		$data['LinechartContent'] = $resultString;

		// Modules donut chart Content
		$donutchartContent = $this->reports->getTransaction_donutchartcontent();

		$donutresult = array();

		foreach($donutchartContent as $key => $value)
		{
			$donutresult[] = '{ label: "'.$value['course_title'].'", value: '.$value['total'].' }';
		}

		$donutresultString = implode(',', $donutresult);

		$data['donutchartContent'] = $donutresultString;

		$this->load->view('admin/reports/transactions.view.php',$data);
	}


	/*
	* Function Call - To get details of single payment invoice
	*/
	public function GetInvoiceDetails()
	{
		$data['title'] = 'Invoice Details';

		if($this->uri->segment(3)) 
		{
			$URLData = decryptID($this->uri->segment(3));

			$LoggedUser = $URLData['1'];

			if($LoggedUser===$this->session->userdata('id'))
			{
				$invoiceID = $URLData['0'];

				$data['InvoiceDetails'] = $this->reports->get_invoice_details($invoiceID);
			}else
			{
				redirect('reports/transaction');
			}
		}else
		{
			redirect('reports/transaction');
		}

		$this->load->view('admin/reports/invoice_details.view.php',$data);
	}


	/*
	* Function call - To get all the transactions data from database.
	*/
	public function getFilterTransactions()
	{
		if($this->input->is_ajax_request())
		{
			$selecteddates = explode("-", $this->input->post('selectedDates'));

			$startdate = date("Y-m-d", strtotime($selecteddates[0]));
			$enddate = date("Y-m-d", strtotime($selecteddates[1]));

			$data['filterTransactions'] = $this->reports->getAllTransactions($startdate,$enddate);

			$filteredContent = $this->load->view('admin/reports/snippet/filter_transactions.php',$data);

			echo json_encode($filteredContent);
		}else
		{
			redirect('404');
		}
	}

/******************************************************************
Student Report
******************************************************************/
	/*
	* Function call - To get data for Student Reports to show in superadmin
	*/
	public function StudentBadgeReport()
	{
		$data['title'] = 'Badge Reports';

		$data['StudentBadgeReport'] = $this->reports->getStudentBadgeReport();

		$this->load->view('admin/reports/student_badge.view.php',$data);
	}


	/*
	* Function call - To get data for Student Reports to show in superadmin
	*/
	public function StudentModulesReport()
	{
		$data['title'] = 'Module Progress Report';

		$data['ModuleProgressReport'] = $this->reports->getStudentModuleprogressReport();

		$this->load->view('admin/reports/module_progress.view.php',$data);
	}

/******************************************************************
Enquery Report
******************************************************************/
	/*
	* Function call - To show Enquery Report in superadmin
	*/
	public function EnqueryReport()
	{
		$data['title'] = 'Enquery Report';

		$startdate = $enddate = '';

		$data['AllEnqueries'] = $this->reports->getAllEnqueries($startdate,$enddate);

		$EnqueryLinechart = $this->reports->getEnquiry_linechartcontent();

		$result = array();

		foreach($EnqueryLinechart as $key => $value)
		{
			$result[] = "['".date("M, Y",strtotime($value['created_at']))."',".$value['total_enquiries']."]";
		}

		$resultString = implode(',', $result);

		$data['EnqueryLinechart'] = $resultString;

		$this->load->view('admin/reports/enquiry.view.php',$data);
	}


	/*
	* Function call - To filter Enquery Report's content according to selected 
	* dates from date-range picker
	*/
	public function GetFilterEnquiries()
	{
		if($this->input->is_ajax_request())
		{
			$selecteddates = explode("-", $this->input->post('selectedDates'));

			$startdate = date("Y-m-d", strtotime($selecteddates[0]));
			$enddate = date("Y-m-d", strtotime($selecteddates[1]));

			$data['filterEnqueries'] = $this->reports->getAllEnqueries($startdate,$enddate);

			$filteredContent = $this->load->view('admin/reports/snippet/filter_enquiry.php',$data);

			echo json_encode($filteredContent);
		}else
		{
			redirect('404');
		}
	}



}