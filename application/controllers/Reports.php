<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';
require_once  APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Reports extends Base {

	public function __construct(){
		parent::__construct();
		$this->redirectPublicUser();
		$this->load->model("ActivitiesModel");
		$this->load->model("ModuleModel");
		$this->load->model("ReportsModel");
		$this->load->model("App_model");
		$this->load->model("EmailtemplatesModel");
		$this->load->model("WebtrackerModel");
		$this->load->model("LogsModel");
		$this->load->library('pagination');
 	  	$this->load->library('email');
		//$smtpconfig = $this->config->item('email');
		//$this->email->initialize($smtpconfig);
	}

	public function index()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
		$this->data["record_data"] = $this->ActivitiesModel->loadActivitiesList($this->data["own"]);
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->viewLoad("reports/reports");
	}

	// public function bookings()
	// {
	// 	global $BOOKING_STATUS;
	// 	$this->data["booking_status"] = $BOOKING_STATUS;

	// 	$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
	// 	$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
	// 	$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

	// 	$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
	// 	$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
	// 	$this->data["users_list"] = $this->ModuleModel->loadUsersList();
	// 	$this->data["bookings"] = $this->ReportsModel->loadBookingsList($this->data["own"], $fromDate, $toDate);
		
	// 	$this->viewLoad("reports/bookings");
	// }

		public function bookings($rowno=0)
	   {
	   	global $BOOKING_STATUS;
		$this->data["booking_status"] = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));

		$own= $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["bookings"] = $this->ReportsModel->loadBookingsList($this->data["own"]);

		$sel= $this->data["sel"] = ($this->getPost("sel") != '') ? $this->getPost("sel") : "";

		if(isset($sel) && !empty($sel)){
			//print_r($sel); die;

                $rowperpage = $sel;
                }
                else{
                  $rowperpage = 10;

               }
	    // Row per page
	  

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	 
	    // All records count
	    $allcount = $this->ReportsModel->getrecordCount($own,$fromDate,$toDate);
       // echo "<pre>"; print_r($allcount); die;
	    $order_by = ($this->getPost("order_by") != '') ? $this->getPost("order_by") : 'ac.created_time';
	    $order = ($this->getPost("order") != '') ? $this->getPost("order") : 'desc';
	    
	    // Get records
	    $users_record = $this->ReportsModel->getData($rowno,$rowperpage,$own,$order,$order_by,$fromDate,$toDate);
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'reports/bookings';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $allcount;
	    $config['per_page'] = $rowperpage;
	    $config['reuse_query_string'] = true;
	    $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

	    // Initialize
	    $this->pagination->initialize($config);
	 
	    $this->data['pagination'] = $this->pagination->create_links();
	    $this->data['result_data'] = $users_record;
	    $this->data['row'] = $rowno;
	    $this->data['total_record'] = $allcount;
	    $this->data['order'] = $order;
	    $this->data['order_by'] = $order_by;
		   // echo "<pre>"; print_r($this->data); die;

		
		 $this->viewLoad("reports/bookings");



	}
	
	public function bookings_print()
	{
		global $BOOKING_STATUS;
		$this->data["booking_status"] = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$order_by = ($this->getPost("order_by") != '') ? $this->getPost("order_by") : 'ac.created_time';
	    $order = ($this->getPost("order") != '') ? $this->getPost("order") : 'desc';

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["bookings"] = $this->ReportsModel->getData('','',$this->data["own"],$order,$order_by,$fromDate,$toDate);
		//$this->ReportsModel->loadBookingsList($this->data["own"], $fromDate, $toDate);
		
		$this->load->view("reports/bookings_print", $this->data);
	}
	
	public function bookings_export()
	{
		global $BOOKING_STATUS;
		$booking_status = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";

		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$order_by = ($this->getPost("order_by") != '') ? $this->getPost("order_by") : 'ac.created_time';
	    $order = ($this->getPost("order") != '') ? $this->getPost("order") : 'desc';

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$bookings = $this->ReportsModel->getData('','',$this->data["own"],$order,$order_by,$fromDate,$toDate);
		//$bookings = $this->ReportsModel->loadBookingsList($this->data["own"], $fromDate, $toDate);
		
		//echo '<pre>';print_r($this->data["bookings"]);die;

		if(!empty($bookings))
		{		
			$delimiter = ",";
			$filename = "bookings_report.csv";
			
			//create a file pointer
			$f = fopen('php://memory', 'w');
			
			//set column headers
			$fields = array('Booking Title', 'Booking Date', 'Booking Time', 'Name', 'Email', 'Status', 'Created By', 'Created Time');
			fputcsv($f, $fields, $delimiter);
			
			//output each row of the data, format line as csv and write to file pointer
			$i=1;
			foreach ($bookings as $key => $bkng)
			{				
				$lineData = array($bkng["booking_title"], date("m/d/Y", strtotime($bkng["booking_date"])), date("h:ia", strtotime($bkng["booking_date"])), $bkng["name"], $bkng["email"], $booking_status[$bkng["status"]], $bkng["first_name"].' '.$bkng["last_name"], date("m/d/Y", strtotime($bkng["created_time"])) );
				fputcsv($f, $lineData, $delimiter);
			}
			
			//move back to beginning of file
			fseek($f, 0);
			
			//set headers to download file rather than displayed
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $filename . '";');
			
			//output all remaining data on a file pointer
			fpassthru($f);

			$i++;
			
		}
		exit;	
	}

	public function contracts()
	{
		global $CONTRACT_STAGE;
		$this->data["contract_stage"] = $CONTRACT_STAGE;
		
		global $BOOKING_STATUS;		
		$this->data["booking_status"] = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["stage"] = ($this->getPost("stage") != '') ? $this->getPost("stage") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["meta_field"] = $this->ReportsModel->loadContractsMetaList($this->data["own"]);
		$this->data["contracts"] = $this->ReportsModel->loadContractsList($this->data["own"], $fromDate, $toDate, $this->data["stage"]);

 
		$this->viewLoad("reports/contracts");
	}



	public function contracts1($rowno=0)
	{

		global $CONTRACT_STAGE;
		$this->data["contract_stage"] = $CONTRACT_STAGE;

		global $BOOKING_STATUS;
		$this->data["booking_status"] = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["stage"] = ($this->getPost("stage") != '') ? $this->getPost("stage") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));

		$own= $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$stage = $this->data["stage"] = ($this->getPost("stage") != '') ? $this->getPost("stage") : "";
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["meta_field"] = $this->ReportsModel->loadContractsMetaList($this->data["own"]);
		$this->data["contracts"] = $this->ReportsModel->loadContractsList($this->data["own"], $fromDate, $toDate, $this->data["stage"]);

		

		$sel= $this->data["sel"] = ($this->getPost("sel") != '') ? $this->getPost("sel") : "";

		if(isset($sel) && !empty($sel)){
			//print_r($sel); die;

                $rowperpage = $sel;
                }
                else{
                  $rowperpage = 7;

               }
	    // Row per page
	  

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }

	    
	 
	    // All records count
	    $allcount = $this->ReportsModel->get_contractCount1($own,$fromDate,$toDate,$stage);
	    $count = count($allcount);
      // echo "<pre>"; print_r($count);  die;


	    // Get records
	    $users_record = $this->ReportsModel->get_contract_Data($rowno,$rowperpage,$own,$fromDate,$toDate,$stage);
	    //echo "<pre>"; print_r($users_record);  die;
	    // Pagination Configuration
	    $config['base_url'] = base_url().'reports/contracts1';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $count;
	    $config['per_page'] = $rowperpage;
	    //echo "<pre>"; print_r($config['per_page']);  die;
	    $config['reuse_query_string'] = true;
	    $config['next_link'] = 'Next';
      $config['prev_link'] = 'Previous';

	    // Initialize
	    $this->pagination->initialize($config);
	 
	    $this->data['pagination'] = $this->pagination->create_links();
	    $this->data['result_data'] = $users_record;
	    $this->data['row'] = $rowno;
	    $this->data['total_record'] = $count;


		// echo "<pre>"; print_r($this->data); die;

		
		 $this->viewLoad("reports/contract");



	}


	public function contracts_print()
	{
		global $CONTRACT_STAGE;
		$this->data["contract_stage"] = $CONTRACT_STAGE;
		
		global $BOOKING_STATUS;		
		$this->data["booking_status"] = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["stage"] = ($this->getPost("stage") != '') ? $this->getPost("stage") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["meta_field"] = $this->ReportsModel->loadContractsMetaList($this->data["own"]);
		$this->data["contracts"] = $this->ReportsModel->loadContractsList($this->data["own"], $fromDate, $toDate, $this->data["stage"]);
		
		$this->load->view("reports/contracts_print", $this->data);
	}
	
	public function contracts_export()
	{
		global $CONTRACT_STAGE;
		$this->data["contract_stage"] = $CONTRACT_STAGE;
		
		global $BOOKING_STATUS;		
		$this->data["booking_status"] = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["stage"] = ($this->getPost("stage") != '') ? $this->getPost("stage") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$meta_field = $this->ReportsModel->loadContractsMetaList($this->data["own"]);
		$contracts = $this->ReportsModel->loadContractsList($this->data["own"], $fromDate, $toDate, $this->data["stage"]);
		
		//echo '<pre>';print_r($this->data["contracts"]);die;

		if(!empty($contracts))
		{		
			$delimiter = ",";
			$filename = "contracts_report.csv";
			
			//create a file pointer
			$f = fopen('php://memory', 'w');
			
			//set column headers
			foreach($meta_field as $field){
				$fields[] = $field["name"];			
			}
			$fields[] = "Created Date";			
			fputcsv($f, $fields, $delimiter);
			
			//output each row of the data, format line as csv and write to file pointer
			$i=1;						
			foreach ($contracts as $key => $contract)
			{
				$lineData = [];
				$record_mv = $contract["record_mv"];
				foreach($record_mv as $mvfield){
					$lineData[] = $mvfield["value"];
				}
				$lineData[] = date("m/d/Y",$contract["created_time"]);
				
				fputcsv($f, $lineData, $delimiter);
				
			}
			
			//move back to beginning of file
			fseek($f, 0);
			
			//set headers to download file rather than displayed
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $filename . '";');
			
			//output all remaining data on a file pointer
			fpassthru($f);

			$i++;
			
		}
		exit;	
	}

	// public function emails()
	// {
	// 	$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
	// 	$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
	// 	$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

	// 	$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
	// 	$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
	// 	$this->data["users_list"] = $this->ModuleModel->loadUsersList();
	// 	$this->data["emails"] = $this->ReportsModel->loadEmailsList($this->data["own"], $fromDate, $toDate);
		
	// 	$this->viewLoad("reports/emails");
	// }

	public function emails($rowno=0)
	   {

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));

		$own= $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["emails"] = $this->ReportsModel->loadEmailsList($this->data["own"], $fromDate, $toDate);

		$sel= $this->data["sel"] = ($this->getPost("sel") != '') ? $this->getPost("sel") : "";

		if(isset($sel) && !empty($sel)){
			//print_r($sel); die;

                $rowperpage = $sel;
                }
                else{
                  $rowperpage = 10;

               }
	    // Row per page
	  

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	 
	    // All records count
	    $allcount = $this->ReportsModel->get_emailCount($own,$fromDate,$toDate);
       // echo "<pre>"; print_r($this->data["emails"]); die;


	    // Get records
	    $users_record = $this->ReportsModel->get_emailData($rowno,$rowperpage,$own,$fromDate,$toDate);
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'reports/emails';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $allcount;
	    $config['per_page'] = $rowperpage;
	    $config['reuse_query_string'] = true;
	    $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

	    // Initialize
	    $this->pagination->initialize($config);
	 
	    $this->data['pagination'] = $this->pagination->create_links();
	    $this->data['result_data'] = $users_record;
	    $this->data['row'] = $rowno;
	    $this->data['total_record'] = $allcount;


		   // echo "<pre>"; print_r($this->data); die;

		
		 $this->viewLoad("reports/emails");



	}

	public function emails_print()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["emails"] = $this->ReportsModel->loadEmailsList($this->data["own"], $fromDate, $toDate);
		
		$this->load->view("reports/emails_print", $this->data);
	}

	public function emails_export()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$emails = $this->ReportsModel->loadEmailsList($this->data["own"], $fromDate, $toDate);

		if(!empty($emails))
		{		
			$delimiter = ",";
			$filename = "emails_report.csv";
			
			//create a file pointer
			$f = fopen('php://memory', 'w');
			
			//set column headers
			$fields = array('From', 'To', 'Subject', 'Content', 'Created By', 'Created Time');
			fputcsv($f, $fields, $delimiter);
			
			//output each row of the data, format line as csv and write to file pointer
			$i=1;						
			foreach ($emails as $key => $val)
			{
				$content = strip_tags($val["content"]);
				$content = str_replace('\'', '', $content);
				
				$lineData = array($val["from"], $val["to"], $val["subject"], $content, $val["first_name"].' '.$val["last_name"], date("m/d/Y", strtotime($val["created_time"])) );
				
				fputcsv($f, $lineData, $delimiter);
			}
			
			//move back to beginning of file
			fseek($f, 0);
			
			//set headers to download file rather than displayed
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $filename . '";');
			
			//output all remaining data on a file pointer
			fpassthru($f);

			$i++;
			
		}
		exit;	
		
		
	}

	public function deleteEmail()
	{
		$this->db->where("id", $_GET["id"]);
		$this->db->delete('anb_crm_emails');

		$this->session->set_flashdata('success','The record has been deleted successfully.');
	
		redirect(base_url().'reports/emails');	
	}

	function sendMail()
	{


		if($_POST)
		{
		// die("cool");
			/*$content = $_POST['message'];
			preg_match_all("/\[[^\]]*\]/", $content, $matches);
			print_r($matches); die("okk");
			if(!empty($content))
			{
				$admin = "Test Admin";
				$opener = "Test Opener";
				$company_name = "Test Compnay name";
				$signing_rate = 25;
				$closer = "Test Closer";
				$rishi = "Rishi cool";
				$beforeArray = array(
					"[Admin]",
					"[Opener]",
					"[Company Name]",
					"[Signing Rate]",
					"[Closer]",
				);
				$replaceArray = array(
					$admin,
					$opener,
					$rishi,
					$company_name,
					$signing_rate,

					$closer,
				);
				$final_content = str_replace($beforeArray, $replaceArray, $content);
			}*/

			$record_id = $_POST['record_id'];
			$module_name = $_POST['module_name'];
			$fromEmail = $_POST["from"]; 					
			$fromName = COMPANY_NAME;

			$toEmail = $_POST["to"];
			$ccEmail = $_POST["cc"];
			$bccEmail = $_POST["bcc"];
			$subject = $_POST["subject"];
			$message = $_POST["message"];
			$firstName = '';
			$lastName = '';
			$recordData = $this->App_model->getData('anb_crm_record_meta_value','record_meta_id,value',array('record_id' => $record_id));
		 //for short_code hit join   
            foreach ($recordData as $value) {
                $record_meta_id = $value['record_meta_id'];
            }
          //  echo "<pre>";print_r();

                $this->db->select('*')->from('anb_crm_record_meta_value');
                $this->db->where('record_id',$record_id);
                $this->db->join('anb_crm_record_meta','anb_crm_record_meta_value.record_meta_id=anb_crm_record_meta.id');
                 $res = $this->db->get();
                $result = $res->result_array();
         //for short_code hit join end   
		      preg_match_all("/\[[^\]]*\]/", $message, $matches);
		      $shortcodes = $matches[0];
		      		$admin = $this->getSessionAttr('username');
		            $final_content = $message;
		       foreach ($shortcodes as  $key => $value) {
		               $s_code = $value;
		        foreach ($result as $show_value) {	   
		        	   $find =  "[".$show_value['name']."]";
			           $value = $show_value['value'];
			        
						
				          
			          	 if($s_code == $find)
			          	   {
			          	   	if($value !== "")
						    { $final_content = str_replace($find, $value, $final_content); }
							else
							{ $final_content = str_replace($find, "NA", $final_content);}
				           }

				         if($s_code == "[company]")
			          	   { 
			          	   	  if($find == "[Company Name]")
			          	   	  {		
						        $final_content = str_replace($s_code, $value, $final_content);
						      }
						      else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
				           }  

				         if($s_code == "[Start date]" || $s_code == "[Start Date]")
			          	   { 
			          	   	  if($find == "[Expected Technical Start Date]")
			          	   	  {		
			          	   	  	if($value !== "")
			          	   	  	{ $final_content = str_replace($s_code, $value, $final_content); }
						        else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
						      }
				           } 

				           if($s_code == "[Parent Company Name]")
			          	   { 
			          	   	  if($find == "[Parent/Affiliate Company Name]")
			          	   	  {		
			          	   	  	if($value !== "")
			          	   	  	{ $final_content = str_replace($s_code, $value, $final_content); }
						        else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
						      }
				           } 

				            if($s_code == "[Lead Name]")
			          	   { 
			          	   	  if($find == "[Lead Category]")
			          	   	  {		
			          	   	  	if($value !== "")
			          	   	  	{ $final_content = str_replace($s_code, $value, $final_content); }
						        else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
						      }
				           } 

				            if($s_code == "[Telephone]")
			          	   { 
			          	   	  if($find == "[Direct Number]")
			          	   	  {		
			          	   	  	if($value !== "")
			          	   	  	{ $final_content = str_replace($s_code, $value, $final_content); }
						        else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
						      }
				           } 
				            if($s_code == "[Admin]" || $s_code == "[userSignature]" || $s_code == "[User Signature]" || $s_code == "[Users.Last Name]")
			          	   { 
			          	   	 		
			          	   	  	if($admin !== "")
			          	   	  	{ $final_content = str_replace($s_code, $admin, $final_content); }
						        else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
						    
				           } 

				           if($s_code == "[Leads.First Name]" || $s_code == "[client]")
			          	   { 
			          	   	  if($find == "[First Name]")
			          	   	  {		
			          	   	  	if($value !== "")
			          	   	  	{ $final_content = str_replace($s_code, $value, $final_content); }
						        else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
						      }
				           } 
				           if($s_code == "[Leads.Last Name]")
			          	   { 
			          	   	  if($find == "[Last Name]")
			          	   	  {		
			          	   	  	if($value !== "")
			          	   	  	{ $final_content = str_replace($s_code, $value, $final_content); }
						        else
						        { $final_content = str_replace($s_code, "NA", $final_content); }
						      }
				           } 

				           if($s_code == "[Participant Names]")
			          	   { 
						         $final_content = str_replace($s_code, "NA", $final_content); 
				           } 

			          // echo "<pre>";
		        		//print_r($find);
		        		 // print_r($show_value['name']);
			           }
		        		
		          }
	       	  //  print_r($final_content);  

		         // die;


			/*echo $record_id;
			echo $module_name;
			die;*/
			//$fromEmail = 'harpreetclerisy@gmail.com';
			
			// $headers  = 'MIME-Version: 1.0' . "\r\n";
			// $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
			// $headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
			// $headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";

			// if($ccEmail!="")
			// {
			// 	//Multiple CC can be added, if we need (comma separated);
			// 	$headers .= "Cc: ".$ccEmail."\r\n";
			// }
			// if($bccEmail!="")
			// {
			// 	//Multiple BCC, same as CC above;
			// 	$headers .= "Bcc: ".$bccEmail."\r\n";
			// }

			// $headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
			// $headers .= 'X-Mailer: PHP/' . phpversion();
			   $config['upload_path'] = 'upload/emails';
       			$config['allowed_types'] = '*';
		        $config['max_size'] = 0;
		        $config['max_width'] = 0;
		        $config['max_height'] = 0;
        		$attachment = '';
		        if( !empty($_FILES) ){ 
		        	$this->load->library('upload', $config);
			        if (!$this->upload->do_upload('file')) {
			        } else {
			            $upload_data = $this->upload->data(); 
			        }
			       $attachment = isset($upload_data) && !empty($upload_data) && isset($upload_data['file_name']) ? $upload_data['file_name'] : '';
			    }
			$insert_id = $this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail,$bccEmail,$subject,$message,$attachment,$record_id);

			//$smtpconfig = $this->config->item('email2');

			//$this->email->initialize($smtpconfig);
			$this->email->set_mailtype("html");
			$this->email->from($fromEmail);
			$this->email->to($toEmail);
			$this->email->cc($ccEmail);
			$this->email->bcc($bccEmail);
			$this->email->subject($subject);
			$this->email->message($final_content);

			if(!empty($attachment)){
			  $this->email->attach(FCPATH."upload/emails/$attachment");
		    }
			if($this->email->send())
		  	{
			 $LeadCategory = array('value' => 'Warm',);
			  $leadUpdate = $this->db->where('record_id', $record_id)
									       ->where('record_meta_id', 14)
								  	       ->update("anb_crm_record_meta_value", $LeadCategory);
								  	       
				if($leadUpdate){
						$time = array('modified_time' => time());
						$timeupdate = $this->db->where('id', $record_id)
								  	   ->update("anb_crm_record", $time); 	
					}					  	       
			 
			 $this->LogsModel->addLogs('Email Sent', 'Email is sent to '.$toEmail.'', $record_id, $module_name,$_SESSION['user_id'],'Develop');
			 echo 'sent';
			 

		  }
		  else
		  {
		  	 
			 echo 'not_sent';	
		  }
			exit;	

			$gmail_sync = false;	
			if($gmail_sync)
			{
				$user_to_impersonate = $_POST['to'];
				

				//putenv("GOOGLE_APPLICATION_CREDENTIALS=$_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json' ");
				$client = new Google_Client();
				$client->useApplicationDefaultCredentials();
				$client->setSubject($user_to_impersonate);
				$client->setApplicationName("Send Email");
				$client->setScopes(["https://www.googleapis.com/auth/gmail.compose"]);
				$service = new Google_Service_Gmail($client);
				// Process data
				try
				{
					$strSubject = $_POST['subject'];
					$strRawMessage = "From: <".$_POST['from'].">\r\n";
					$strRawMessage .= "To: <".$_POST['to'].">\r\n";
					if(!empty($_POST['cc']))
					{
						$strRawMessage .= "CC: <".$_POST['cc'].">\r\n";
					}
					if(!empty($_POST['bcc']))
					{
						$strRawMessage .= "BCC: <".$_POST['bcc'].">\r\n";
					}
					$strRawMessage .= "Subject: =?utf-8?B?" . base64_encode($strSubject) . "?=\r\n";
					$strRawMessage .= "MIME-Version: 1.0\r\n";
					$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
					$strRawMessage .= "Content-Transfer-Encoding: base64" . "\r\n\r\n";
					$strRawMessage .= "Hello World!" . "\r\n";
					// The message needs to be encoded in Base64URL
					$mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
					$msg = new Google_Service_Gmail_Message();
					$msg->setRaw($mime);
					//The special value **me** can be used to indicate the authenticated user.
					$rs = $service->users_messages->send("me", $msg);
					//echo '<pre>';print_r($rs);die('one');
				}
				catch (Exception $e)
				{
					echo "An error occurred: " . $e->getMessage();
				}
			}			
			exit;
		}

		$this->data["user_data"] = $user_data = $this->MemberModel->loadUserData($this->getUserId());			
		$this->data["fromemail"] = $user_data['email'];
		$this->data["fromemail"] = COMPANY_NOREPLY_EMAIL;
		$this->data["action"] = $this->getPost("action");
		$this->data["toemail"] = $this->getPost("email");
		$this->data["title"] = "Send Email";

		//echo '<pre>';print_r($this->data);die;
		$this->data["templates"] = $this->EmailtemplatesModel->loadEmailtemplatesList();
		$this->data['record_id'] = $this->getPost('record_id');
		$this->data['module_name'] = $this->getPost('module_name');
		$this->load->view("modules/send_mail", $this->data);			
	}


function sendMail1()
	{
		if($_POST)
		{
			//echo '<pre>';print_r($_POST); die;

			$fromEmail = $_POST["from"]; 					
			$fromName = COMPANY_NAME;

			$toEmail = $_POST["to"];
			$ccEmail = $_POST["cc"];
			$bccEmail = $_POST["bcc"];
			$subject = $_POST["subject"];
			$message = $_POST["message"];


	  $filename = 'SampleDOCFile_100kb.doc';
    $file= $_SERVER["DOCUMENT_ROOT"]."/assets/images/".$filename;


    //echo "<pre>"; print_r($file); die;

	  $content = file_get_contents($file);
	 // echo "<pre>"; print_r($content); die;
    $content = chunk_split(base64_encode($content));
		

		 $eol = "\r\n";
		 $separator = md5(time());

			//$fromEmail = 'harpreetclerisy@gmail.com';
			
			// $headers  = 'MIME-Version: 1.0' . "\r\n";
			// $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
			// $headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
			// $headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";


			    // main header (multipart mandatory)
		$headers = "";
    $headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

  if(file_exists($file)){

        // message
    $body = "--" . $separator . $eol;
    $body .= "Content-type:text/html;charset=UTF-8" . $eol;
    $body .= "Content-Transfer-Encoding:base64" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

  }else{
        // message
    $body = "--" . $separator . $eol;
    $body .= "Content-type:text/html;charset=UTF-8" . $eol;
    $body .= "Content-Transfer-Encoding:base64" . $eol;
    $body .= $message . $eol;

  }


			if($ccEmail!="")
			{
				//Multiple CC can be added, if we need (comma separated);
				$headers .= "Cc: ".$ccEmail."\r\n";
			}
			if($bccEmail!="")
			{
				//Multiple BCC, same as CC above;
				$headers .= "Bcc: ".$bccEmail."\r\n";
			}

			$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
			$headers .= 'X-Mailer: PHP/' . phpversion();

			
			$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail,$bccEmail,$subject,$message);
			
			if(mail($toEmail,$subject,$body,$headers))
			{
				echo 'sent';
			}
			else
			{
				echo 'not_sent';	
			}

			exit;	

			$gmail_sync = false;	
			if($gmail_sync)
			{
				$user_to_impersonate = $_POST['to'];
				//putenv("GOOGLE_APPLICATION_CREDENTIALS=$_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json' ");
				$client = new Google_Client();
				$client->useApplicationDefaultCredentials();
				$client->setSubject($user_to_impersonate);
				$client->setApplicationName("Send Email");
				$client->setScopes(["https://www.googleapis.com/auth/gmail.compose"]);
				$service = new Google_Service_Gmail($client);
				// Process data
				try
				{
					$strSubject = $_POST['subject'];
					$strRawMessage = "From: <".$_POST['from'].">\r\n";
					$strRawMessage .= "To: <".$_POST['to'].">\r\n";
					if(!empty($_POST['cc']))
					{
						$strRawMessage .= "CC: <".$_POST['cc'].">\r\n";
					}
					if(!empty($_POST['bcc']))
					{
						$strRawMessage .= "BCC: <".$_POST['bcc'].">\r\n";
					}
					$strRawMessage .= "Subject: =?utf-8?B?" . base64_encode($strSubject) . "?=\r\n";
					$strRawMessage .= "MIME-Version: 1.0\r\n";
					$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
					$strRawMessage .= "Content-Transfer-Encoding: base64" . "\r\n\r\n";
					$strRawMessage .= "Hello World!" . "\r\n";
					// The message needs to be encoded in Base64URL
					$mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
					$msg = new Google_Service_Gmail_Message();
					$msg->setRaw($mime);
					//The special value **me** can be used to indicate the authenticated user.
					$rs = $service->users_messages->send("me", $msg);
					echo '<pre>';print_r($rs);
				}
				catch (Exception $e)
				{
					echo "An error occurred: " . $e->getMessage();
				}
			}			
			exit;
		}

		$this->data["user_data"] = $user_data = $this->MemberModel->loadUserData($this->getUserId());			
		$this->data["fromemail"] = $user_data['email'];
		$this->data["action"] = $this->getPost("action");
		$this->data["toemail"] = $this->getPost("email");
		$this->data["title"] = "Send Email";

		//echo '<pre>';print_r($this->data);die;

		$this->data["templates"] = $this->EmailtemplatesModel->loadEmailtemplatesList();
		
		$this->load->view("modules/send_mail", $this->data);			
	}


  	function recoveries()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["meta_field"] = $this->ReportsModel->loadRecoveriesMetaList($this->data["own"]);
		$this->data["recoveries"] = $this->ReportsModel->loadRecoveriesList($this->data["own"], $fromDate, $toDate);

		//echo '<pre>';print_r($this->data["meta_field"]);die;
		
		$this->viewLoad("reports/recoveries");		
	}







	function recoveries1($rowno=0)
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["meta_field"] = $this->ReportsModel->loadRecoveriesMetaList($this->data["own"]);
		$this->data["recoveries"] = $this->ReportsModel->loadRecoveriesList($this->data["own"], $fromDate, $toDate);

		//echo '<pre>';print_r($this->data["meta_field"]);die;
		$own= $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";

   $sel= $this->data["sel"] = ($this->getPost("sel") != '') ? $this->getPost("sel") : "";

		if(isset($sel) && !empty($sel)){
			//print_r($sel); die;

                $rowperpage = $sel;
                }
                else{
                  $rowperpage = 10;

               }
	    // Row per page
	  

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	 
	    // All records count
	    $allcount = $this->ReportsModel->get_recover_count($own,$fromDate,$toDate);
       // echo "<pre>"; print_r($allcount); die;


	    // Get records
	    $users_record = $this->ReportsModel->get_recoveries($rowno,$rowperpage,$own,$fromDate,$toDate);

	    //echo "<pre>"; print_r($users_record); die;
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'reports/recoveries1';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $allcount;
	    $config['per_page'] = $rowperpage;
	    $config['reuse_query_string'] = true;
	    $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

	    // Initialize
	    $this->pagination->initialize($config);
	 
	    $this->data['pagination'] = $this->pagination->create_links();
	    $this->data['result_data'] = $users_record;
	    $this->data['row'] = $rowno;
	    $this->data['total_record'] = $allcount;


		   // echo "<pre>"; print_r($this->data); die;

		
		$this->viewLoad("reports/recoveries");		
	}


	function recoveries_print()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["meta_field"] = $this->ReportsModel->loadRecoveriesMetaList($this->data["own"]);
		$this->data["recoveries"] = $this->ReportsModel->loadRecoveriesList($this->data["own"], $fromDate, $toDate);

		//echo '<pre>';print_r($this->data["meta_field"]);die;
		
		$this->load->view("reports/recoveries_print", $this->data);	
	}

	function recoveries_export()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$meta_field = $this->ReportsModel->loadRecoveriesMetaList($this->data["own"]);
		$recoveries = $this->ReportsModel->loadRecoveriesList($this->data["own"], $fromDate, $toDate);

		//echo '<pre>';print_r($this->data["meta_field"]);die;

		if(!empty($recoveries))
		{		
			$delimiter = ",";
			$filename = "recoveries_report.csv";
			
			//create a file pointer
			$f = fopen('php://memory', 'w');
			
			//set column headers
			foreach($meta_field as $field){
				$fields[] = $field["name"];			
			}
			$fields[] = "Assigned To";			
			$fields[] = "Created By";			
			$fields[] = "Created Date";			
			fputcsv($f, $fields, $delimiter);
			
			//output each row of the data, format line as csv and write to file pointer
			$i=1;						
			foreach ($recoveries as $key => $contract)
			{
				$lineData = [];
				$record_mv = $contract["record_mv"];
				foreach($meta_field as $key=>$field){
					if($field['id']=='169')
					{
						if(isset($record_mv[$key]["value"]) && $record_mv[$key]["value"]!="")
						{
							$lineData[] = $this->ReportsModel->get_user_full_name($record_mv[$key]["value"]);											
						}
						else
						{
							$lineData[] = "";	
						}
						
						
					}
					else if($field['id']=='179')
					{
						if(isset($record_mv[$key]["value"]) && $record_mv[$key]["value"]!="")
						{
							$lineData[] = date("m/d/Y", strtotime($record_mv[$key]["value"]));
						}
						else
						{
							$lineData[] = "";
						}
					}
					else
					{
						$lineData[] = @$record_mv[$key]["value"];
					}	
					
				}
				$lineData[] = $contract["ofirst_name"]." ".$contract["olast_name"];
				$lineData[] = $contract["first_name"]." ".$contract["last_name"];
				$lineData[] = date("m/d/Y",$contract["created_time"]);
				
				fputcsv($f, $lineData, $delimiter);
				
			}
			
			//move back to beginning of file
			fseek($f, 0);
			
			//set headers to download file rather than displayed
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $filename . '";');
			
			//output all remaining data on a file pointer
			fpassthru($f);

			$i++;
			
		}
		exit;	
		
	}

	// function invoices()
	// {
	// 	$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
	// 	$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
	// 	$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

	// 	$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
	// 	$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
	// 	$this->data["users_list"] = $this->ModuleModel->loadUsersList();
	// 	$this->data["invoices"] = $this->ReportsModel->loadinvoicesList($this->data["own"], $fromDate, $toDate);

	// 	$this->data["client_data"] = "";
	// 	if(!empty($this->data["invoices"]))
	// 	{
	// 		foreach($this->data["invoices"] as $key=>$inv)
	// 		{
	// 			$client_id = $inv["record_id"];
	// 			$this->data["invoices"][$key]["client_data"] = $this->ModuleModel->loadRecord(3, $client_id);
	// 		}
	// 	}
		
	// 	//echo '<pre>';print_r($this->data["invoices"]);die;
		
	// 	$this->viewLoad("reports/invoices");		
	// }


	public function invoices($rowno=0)
	   {

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));

		$own= $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["invoices"] = $this->ReportsModel->loadinvoicesList($this->data["own"], $fromDate, $toDate);

		$sel= $this->data["sel"] = ($this->getPost("sel") != '') ? $this->getPost("sel") : "";

		if(isset($sel) && !empty($sel)){
			//print_r($sel); die;

                $rowperpage = $sel;
                }
                else{
                  $rowperpage = 10;

               }
	    // Row per page
	  

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	 
	    // All records count
	    $allcount = $this->ReportsModel->invoice_count($own,$fromDate,$toDate);
       // echo "<pre>"; print_r($allcount); die;


	    // Get records
	    $users_record = $this->ReportsModel->get_invoice($rowno,$rowperpage,$own,$fromDate,$toDate);
	   // echo "<pre>"; print_r($users_record); die;


	  $this->data["client_data"] = "";
		if(!empty($users_record))
		{
			foreach($users_record as $key=>$inv)
			{
				$client_id = $inv["record_id"];
				$users_record[$key]["client_data"] = $this->ModuleModel->loadRecord(3, $client_id);
			}
		}
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'reports/invoices1';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $allcount;
	    $config['per_page'] = $rowperpage;
	    $config['reuse_query_string'] = true;
	    $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

	    // Initialize
	    $this->pagination->initialize($config);
	 
	    $this->data['pagination'] = $this->pagination->create_links();
	    $this->data['result_data'] = $users_record;
	    $this->data['row'] = $rowno;
	    $this->data['total_record'] = $allcount;
		  //echo "<pre>"; print_r($this->data); die;
		$this->viewLoad("reports/invoices");		

	}


	
	function invoices_print()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["invoices"] = $this->ReportsModel->loadinvoicesList($this->data["own"], $fromDate, $toDate);

		$this->data["client_data"] = "";
		if(!empty($this->data["invoices"]))
		{
			foreach($this->data["invoices"] as $key=>$inv)
			{
				$client_id = $inv["record_id"];
				$this->data["invoices"][$key]["client_data"] = $this->ModuleModel->loadRecord(3, $client_id);
			}
		}
		
		//echo '<pre>';print_r($this->data["invoices"]);die;
		
		$this->load->view("reports/invoices_print", $this->data);	
	}
	
	function invoices_export()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["invoices"] = $this->ReportsModel->loadinvoicesList($this->data["own"], $fromDate, $toDate);

		$this->data["client_data"] = "";
		if(!empty($this->data["invoices"]))
		{
			foreach($this->data["invoices"] as $key=>$inv)
			{
				$client_id = $inv["record_id"];
				$this->data["invoices"][$key]["client_data"] = $this->ModuleModel->loadRecord(3, $client_id);
			}
		}

		$invoices = $this->data["invoices"];
		
		
		//echo '<pre>';print_r($this->data["invoices"]);die;
		
		if(!empty($invoices))
		{		
			$delimiter = ",";
			$filename = "invoices_report.csv";
			
			//create a file pointer
			$f = fopen('php://memory', 'w');
			
			//set column headers		
			$fields = array('Invoice no.', 'Invocie Date', 'Total Invoice Amount (CAD)', 'Attention', 'RE', 'Description', 'Note', 'Created By', 'Created Time');
			fputcsv($f, $fields, $delimiter);
			
			//output each row of the data, format line as csv and write to file pointer
			$i=1;						
			foreach ($invoices as $key => $val)
			{
				$lineData = [];
				$client_data = $val["client_data"];

				$lineData[] = $val["invoice_number"];
				$lineData[] = date("m/d/Y", strtotime($val["invoice_date"]));
				$lineData[] = "$".$val["total_amount"];
				$lineData[] = $client_data["__160"];
				if(isset($client_data["__163"]))
				{
					if( is_array($client_data["__163"]))
					{
						$lineData[] = implode(", ",$client_data['__163']);
					}
					else
					{
						$lineData[] = $client_data["__163"];
					}
				}
				else
				{
					$lineData[] = "";
				}
				$lineData[] = $val["description"];
				$lineData[] = $val["note"];
				$lineData[] = $val["first_name"]." ".$val["last_name"];
				$lineData[] = date("m/d/Y",strtotime($val["created_time"]));
				
				fputcsv($f, $lineData, $delimiter);
				
			}
			
			//move back to beginning of file
			fseek($f, 0);
			
			//set headers to download file rather than displayed
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $filename . '";');
			
			//output all remaining data on a file pointer
			fpassthru($f);

			$i++;
			
		}
		exit;		
	}

   public function getInboxEmails($subjectCode = "", $to = ""){ 
   	ini_set('max_execution_time', 0);
   	error_reporting(0);
   //	echo get_cfg_var('cfg_file_path');
  // 	phpinfo();
    $yourEmail = "softgetix.test@gmail.com";
    $yourEmailPassword = "softgetix@test";
    $hostname2 = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
    //Read Inbox
    $inbox = imap_open($hostname2, $yourEmail, $yourEmailPassword) or print_r(imap_errors());;
   // echo $inbox;die();
    $to = urldecode($to);
    $subjectCode = urldecode($subjectCode);
    $subjectCode = str_replace(' ', '&', $subjectCode);

    $inbox_search = "FROM $to SUBJECT $subjectCode";

    $receive_emails = imap_search($inbox, $inbox_search);
     // print_r($receive_emails);die();
   // $mail_headers = imap_headerinfo($mailbox, $mail[0]);
  //  $subject = $mail_headers->subject;
   // $data =  imap_setflag_full($mailbox, $mail[0], "\\Seen \\Flagged");
    $received_messages = array();

     if (!empty($receive_emails)) {       
        foreach ($receive_emails as $key => $Email1) {
           if( $Email1 > 0 ) {     

                $header = imap_header($inbox, $Email1);
               // print_r($header);
                $date = date("Y-m-d H:i:s", $header->udate);
                $from =  $header->fromaddress;
                $maitto =  $header->toaddress;
                $subject = $header->subject;
                $sender = $header->senderaddress;
                $structure = imap_fetchstructure($inbox, $Email1);
                //print_r($structure);
                 $attachments = array();
                 $filenames = array();

                if (!empty($structure->parts)) 
                {
                    for($j = 0; $j < count($structure->parts); $j++) 
                    {
                        $part = $structure->parts[$j];

                        if ($part->subtype == 'PLAIN') { 
                            $body = imap_fetchbody($inbox, $Email1, 2);
                        }elseif ($part->subtype == 'ALTERNATIVE') {
                            $body = imap_fetchbody($inbox, $Email1, 1.2);
                           
                        }
                          /* if any attachments found... */
                        if($structure->parts[$j]->ifdparameters) 
                        {
                            foreach($structure->parts[$j]->dparameters as $object) 
                            {
                                if(strtolower($object->attribute) == 'filename') 
                                {
                                    $attachments[$j]['is_attachment'] = true;
                                    $attachments[$j]['filename'] = $object->value;
                                    $filenames[$j]['filename'] = $Email1 . "-" .$object->value;
                                }
                            }
                        }
                        
                       /* if($attachments[$j]['is_attachment']) 
                        {
                            $attachments[$j]['attachment'] = imap_fetchbody($inbox, $Email1, $j+1);
                          
                            if($structure->parts[$j]->encoding == 3) 
                            { 
                                $attachments[$j]['attachment'] = base64_decode($attachments[$j]['attachment']);
                            }
                            elseif($structure->parts[$j]->encoding == 4) 
                            { 
                                $attachments[$j]['attachment'] = quoted_printable_decode($attachments[$j]['attachment']);
                            }
                        }*/

                    }
                   //print_r($attachments);
                    /* iterate through each attachment and save it */
                    foreach($attachments as $k  => $attachment)
                    {
                        if($attachment['is_attachment'] == 1)
                        {
                            $filename = $attachment['name'];
                            if(empty($filename)) $filename = $attachment['filename'];
             
                            if(empty($filename)) $filename = time() . ".dat";
             
                      /* prefix the email number to the filename in case two mails
                             * have the attachment with the same file name.*/
                             
                         //   $fp = fopen('./upload/RFI/' . $Email1 . "-" . $filename, "w+");
                          //  fwrite($fp, $attachment['attachment']);
                          //  fclose($fp);
                        }
             
                    }
                } 
                else 
                {
                    $body = imap_body($inbox, $Email1);
                }
                $body = str_replace('\r\n', '<br/>', $body);
                $body = stripslashes($body);
              //  $body = htmlentities($body);
                $body = quoted_printable_decode($body);
               // $body = imap_qprint($body);
              //   print_r($body);
               $received_messages['receiverMessage'][] =  array('msg_no' => $Email1, 'date' => $date, 'mailfrom' =>$to, 'mailto' => $maitto, 'subject' => $subject, 'body' => $body,'sender'=>$sender,'attachment'=>$filenames);

           
                
          }
        }
    
     //print_r($messages);
    }

     imap_close($inbox);

    echo json_encode($received_messages);die();
   }
   public function webBookings()
   {
   		if(isset($_GET['test']))
   		{
   			$test = $_GET['test'];
   			switch ($test) {
   				case 1:
   					$test_name = 'Canadian Customs Duties';
   					break;
   				case 2:
   					$test_name = 'Canadian Sales Tax';
   					break;
   				case 3:
   					$test_name = 'Canadian Govt Incentives (Workforce Development)';
   					break;
   				default:
   					$test_name = 'Canadian Sales Tax (GST/HST)';
   					break;
   			}
   		}
   		else
   		{
   			$test = 2;
   			$test_name = 'Canadian Sales Tax';
   		}

   		$time_period = '';
   		$time = '';
   		if(isset($_GET['t']))
   		{
   			$time_period = $_GET['t'];
   			if($time_period == 'week')
   			{
   				$time = date('Y-m-d H:i:s', strtotime("last Monday"));
   			}
   			else if($time_period == 'month')
   			{
   				$time = date('Y-m-01 H:i:s');
   			}
   			else if($time_period == 'year')
   			{
   				$time = date('Y-01-01 H:i:s');
   			}
   			else
   			{
   				$time = '';
   			}
   		}
   		$loggedUserId = $this->getUserId();
   		//var_dump($test_name);
   		/*Question 01*/
   		/*$this->data['question01_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('score' => 'Poor', 'created_at >=' => $time));
   		$this->data['question01_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('score' => 'Fair', 'created_at >=' => $time));
   		$this->data['question01_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('score' => 'Average', 'created_at >=' => $time));
   		$this->data['question01_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('score' => 'Good', 'created_at >=' => $time));
   		$this->data['question01_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('score' => 'Excellent', 'created_at >=' => $time));*/
   		/*Question 01*/
   		
   		$this->data['total_bookings'] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('created_at >=' => $time, 'form_name' => $test_name));

   		if($test == 2)
   		{
   		$this->data['questionnaire'] = $this->App_model->getData('anb_crm_web_questionnaire_map', '*', array('test_name' => 'Canadian Sales Tax'));
		
		/*Question 1*/
   		$this->data['question1_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question1_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 1*/
   		/*Question 1 fb*/
		/*$this->data['question1_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1_fb' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question1_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1_fb' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));*/
		/*Question 1 fb*/
		
   		/*Question 2*/
   		$this->data['question2_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 2*/
   		
   		/*Question 3*/
   		$this->data['question3_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Less than $100K', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => '$100K - $1.99M', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => '$2M - $5M', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Greater than $5M', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 3*/

   		/*Question 4*/
   		$this->data['question4_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Higher', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question4_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Lower', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question4_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Consistent', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 4*/

   		/*Question 5*/
   		$this->data['question5_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question5_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 5*/

   		/*Question 6*/
   		$this->data['question6_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'USA', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question6_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Canada', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question6_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Another Country', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 6*/

   		/*Question 7*/
   		$this->data['question7_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question7_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 7*/

   		/*Question 8*/
   		$this->data['question8_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question8_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 8*/

   		/*Question 9*/
   		$this->data['question9_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question9_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'NO', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 9*/
   		/*Question 9 fb*/
		/*$this->data['question9_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9_fb' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question9_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9_fb' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));*/
		/*Question 9 fb*/
		
   		/*Question 10*/
   		$this->data['question10_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Less than 2 years ago', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'More than 4 years ago', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'A very long time ago', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'NEVER had a reverse audit', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 10*/
   		$this->data['test'] = 2;
   		}

   		/*Test 2 start*/
   		if($test == 1)
   		{
   		$this->data['questionnaire'] = $this->App_model->getData('anb_crm_web_questionnaire_map', '*', array('test_name' => 'Canadian Customs Duties'));
   			
   		/*Question 1*/
   		$this->data['question1_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question1_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 1*/
   		
   		/*Question 2*/
   		$this->data['question2_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'More than $500K', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => '$101K - $500K', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => '$25K - $100K', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Less than $25K', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 2*/
   		/*Question 2 fb*/
		/*$this->data['question2_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2_fb' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question2_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2_fb' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));*/
		/*Question 2 fb*/
   		/*Question 3*/
   		$this->data['question3_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Unsure', 'created_at >=' => $time, 'form_name' => $test_name));
   		
   		/*Question 3*/

   		/*Question 4*/
   		$this->data['question4_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Self-clear', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question4_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Customs Broker', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question4_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Multiple customs brokers', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 4*/
   		/*Question 4 fb*/
		/*$this->data['question4_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4_fb' => 'Less than 1 year', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question4_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4_fb' => '1 - 5 years', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question4_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4_fb' => 'Greater than 5 years', 'created_at >=' => $time, 'form_name' => $test_name));*/
		/*Question 4 fb*/
   		/*Question 5*/
   		$this->data['question5_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question5_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 5*/

   		/*Question 6*/
   		$this->data['question6_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Less than 10%', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question6_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Between 10% - 25%', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question6_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Greater than 25%', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question6_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'N/A', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 6*/

   		/*Question 7*/
   		$this->data['question7_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question7_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 7*/

   		/*Question 8*/
   		$this->data['question8_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Less than 5 advanced rulings', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question8_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => '5 - 10 advanced rulings', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question8_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Greater than 10 rulings', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question8_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'None', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 8*/

   		/*Question 9*/
   		$this->data['question9_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question9_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'NO', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 9*/
   		/*Question 9 fb*/
		/*$this->data['question9_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9_fb' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question9_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9_fb' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));*/
		/*Question 9 fb*/

   		/*Question 10*/
   		$this->data['question10_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'NO', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 10*/
   		/*$this->data['question1_fb_details'] = array();*/
   		$this->data['test'] = 1;
   		}

   		if($test == 3)
   		{
   			$this->data['questionnaire'] = $this->App_model->getData('anb_crm_web_questionnaire_map', '*', array('test_name' => 'Canadian Govt Incentives (Workforce Development)'));

   		/*Question 1*/
   		$this->data['question1_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question1_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   		
   		/*Question 1*/
   		
   		/*Question 2*/
   		$this->data['question2_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Manufacturer Private sector', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Non-manufacturer', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Not-for-profit', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Crown corporation', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Union organizations', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'public sector', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'publicly funded', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question2_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Federal or municipal', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 2*/
   		
   		/*Question 3*/
   		$this->data['question3_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'New company hires', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Existing employees', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'All employees', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question3_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'No training is provided, but planning to provide FREE training in the future', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 3*/
   		/*Question 3 fb*/
		/*$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Career or development', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Maintenance and refresher skills', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Essential skills', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Occupational Health and Safety', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'All of the above', 'created_at >=' => $time, 'form_name' => $test_name));*/
		/*Question 3 fb*/
		
   		/*Question 4*/
   		$this->data['question4_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Less than 50 employees', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question4_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => '51 - 100 employees', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question4_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => '101 - 1000 employees', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question4_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Greater than 1,000 employees', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 4*/

   		/*Question 5*/
   		$this->data['question5_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question5_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   	
   		/*Question 5*/

   		/*Question 6*/
   		$this->data['question6_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Short-term (less than 52 weeks)', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question6_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Longterm (greater than 52 weeks)', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question6_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Both short-term and long-term', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 6*/

   		/*Question 7*/
   		$this->data['question7_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Company trainers (NOT including journeymen)', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question7_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Third-party (eg. Private Trainers, Unions, Product Vendors, Colleges, Universities, etc.)', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question7_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Both company trainers and Third-party equally', 'created_at >=' => $time, 'form_name' => $test_name));
   		
   		/*Question 7*/
   		/*Question 7 fb*/
		/*$this->data['question7_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7_fb' => 'Higher', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question7_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7_fb' => 'Lower', 'created_at >=' => $time, 'form_name' => $test_name));
		$this->data['question7_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7_fb' => 'Consistent', 'created_at >=' => $time, 'form_name' => $test_name));*/
		/*Question 7 fb*/
   		/*Question 8*/
   		$this->data['question8_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Less than $100K', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question8_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => '$100K- $500K', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question8_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => '$500K - $1M', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question8_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Greater than $ 1M', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 8*/

   		/*Question 9*/
   		$this->data['question9_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Tax credits', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question9_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Grants', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question9_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'BOTH taxes credits and grants', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question9_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Other government funding or subsidies for training', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question9_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'NEVER applied for any government funding for training', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question9_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Applied but was NOT successful', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 9*/
   		
		
   		/*Question 10*/
   		$this->data['question10_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Prepare for expansion', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Continue on-going training development', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Both to prepare for expansion and continue on-going training', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Prepare for downsizing', 'created_at >=' => $time, 'form_name' => $test_name));
   		$this->data['question10_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'NOT interested in applying for future funding', 'created_at >=' => $time, 'form_name' => $test_name));
   		/*Question 10*/


   			/*$this->data['question1_fb_details'] = array();
   			$this->data['question9_fb_details'] = array();*/
   			$this->data['test'] = 3;
   		}
   		//print_r($this->data); die("ok");
   		$this->viewLoad("reports/webBookings", $this->data);
    }
    public function exportWebBookings()
    {
    	if($this->input->post())
    	{
    		$time_period = $this->input->post('time');
    		$test = $this->input->post('test');
    		switch ($test){
   				case 1:
   					$test_name = 'Canadian Customs Duties';
   					break;
   				case 2:
   					$test_name = 'Canadian Sales Tax';
   					break;
   				case 3:
   					$test_name = 'Canadian Govt Incentives (Workforce Development)';
   					break;
   				default:
   					$test_name = 'Canadian Sales Tax';
   					break;
   			}
   			if($time_period == 'week')
   			{
   				$time = date('Y-m-d H:i:s', strtotime("last Monday"));
   			}
   			else if($time_period == 'month')
   			{
   				$time = date('Y-m-01 H:i:s');
   			}
   			else if($time_period == 'year')
   			{
   				$time = date('Y-01-01 H:i:s');
   			}
   			else
   			{
   				$time = '';
   			}
   			
   			$loggedUserId = $this->getUserId();
   			if($test == 2)
   			{
		   		$total_bookings = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 1*/
		   		$question1_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question1_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 1*/
		   		
		   		/*Question 2*/
		   		$question2_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question2_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 2*/
		   		
		   		/*Question 3*/
		   		$question3_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Less than $100K', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question3_option2= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => '$100K - $1.99M', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question3_option3= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => '$2M - $5M', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question3_option4= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Greater than $5M', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 3*/

		   		/*Question 4*/
		   		$question4_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Higher', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question4_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Lower', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question4_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Consistent', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 4*/

		   		/*Question 5*/
		   		$question5_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question5_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 5*/

		   		/*Question 6*/
		   		$question6_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'USA', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question6_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Canada', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question6_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Another Country', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 6*/

		   		/*Question 7*/
		   		$question7_yes = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question7_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 7*/

		   		/*Question 8*/
		   		$question8_yes = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question8_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 8*/

		   		/*Question 9*/
		   		$question9_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question9_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'NO', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 8*/

		   		/*Question 10*/
		   		$question10_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Less than 2 years ago', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'More than 4 years ago', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'A very long time ago', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'NEVER had a reverse audit', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 10*/
	   		}
	   		if($test == 1)
	   		{
	   			$total_bookings = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('created_at >=' => $time, 'form_name' => $test_name));
	   			/*Question 1*/
		   		$question1_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question1_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 1*/
		   		
		   		/*Question 2*/
		   		$question2_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'More than $500K', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question2_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => '$101K - $500K', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question2_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => '$25K - $100K', 'created_at >=' => $time, 'form_name' => $test_name));
				$question2_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Less than $25K', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 2*/
		   		/*Question 2 fb*/
				/*$this->data['question2_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2_fb' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question2_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2_fb' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));*/
				/*Question 2 fb*/
		   		/*Question 3*/
		   		$question3_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question3_option2= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question3_option3= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Unsure', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 3*/

		   		/*Question 4*/
		   		$question4_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Self-clear', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question4_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Customs Broker', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question4_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Multiple customs brokers', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 4*/
		   		/*Question 4 fb*/
				/*$this->data['question4_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4_fb' => 'Less than 1 year', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question4_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4_fb' => '1 - 5 years', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question4_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4_fb' => 'Greater than 5 years', 'created_at >=' => $time, 'form_name' => $test_name));*/
				/*Question 4 fb*/
		   		/*Question 5*/
		   		$question5_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question5_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 5*/

		   		/*Question 6*/
		   		$question6_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Less than 10%', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question6_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Between 10% - 25%', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question6_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Greater than 25%', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question6_option4= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'N/A', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 6*/

		   		/*Question 7*/
		   		$question7_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question7_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 7*/

		   		/*Question 8*/
		   		$question8_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Less than 5 advanced rulings', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question8_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => '5 - 10 advanced rulings', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question8_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Greater than 10 rulings', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question8_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'None', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 8*/

		   		/*Question 9*/
		   		$question9_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question9_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'NO', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 9*/
		   		/*Question 9 fb*/
				/*$this->data['question9_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9_fb' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question9_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9_fb' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));*/
				/*Question 9 fb*/

		   		/*Question 10*/
		   		$question10_yes= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'YES', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_no = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'NO', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 10*/
	   		}
	   		if($test == 3)
	   		{
	   			$total_bookings = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('created_at >=' => $time, 'form_name' => $test_name));
	   			/*Question 1*/
		   		$question1_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question1_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_1' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		
		   		/*Question 1*/
		   		
		   		/*Question 2*/
		   		

		$question2_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Manufacturer Private sector', 'created_at >=' => $time, 'form_name' => $test_name));
   		$question2_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Non-manufacturer', 'created_at >=' => $time, 'form_name' => $test_name));
   		$question2_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Not-for-profit', 'created_at >=' => $time, 'form_name' => $test_name));
   		$question2_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Crown corporation', 'created_at >=' => $time, 'form_name' => $test_name));
   		$question2_option5 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Union organizations', 'created_at >=' => $time, 'form_name' => $test_name));
   		$question2_option6 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'public sector', 'created_at >=' => $time, 'form_name' => $test_name));
   		$question2_option7 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'publicly funded', 'created_at >=' => $time, 'form_name' => $test_name));
   		$question2_option8 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_2' => 'Federal or municipal', 'created_at >=' => $time, 'form_name' => $test_name));	


		   		/*Question 2*/
		   		
		   		/*Question 3*/
		   		$question3_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'New company hires', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question3_option2= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'Existing employees', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question3_option3= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'All employees', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question3_option4= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3' => 'No training is provided, but planning to provide FREE training in the future', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 3*/
		   		/*Question 3 fb*/
				/*$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Career or development', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Maintenance and refresher skills', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Essential skills', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'Occupational Health and Safety', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question3_fb_details'][]= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_3_fb' => 'All of the above', 'created_at >=' => $time, 'form_name' => $test_name));*/
				/*Question 3 fb*/
				
		   		/*Question 4*/
		   		$question4_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Less than 50 employees', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question4_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => '51 - 100 employees', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question4_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => '101 - 1000 employees', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question4_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_4' => 'Greater than 1,000 employees', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 4*/

		   		/*Question 5*/
		   		$question5_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'Yes', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question5_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_5' => 'No', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 5*/

		   		/*Question 6*/
		   		$question6_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Short-term (less than 52 weeks)', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question6_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Longterm (greater than 52 weeks)', 'created_at >=' => $time, 'form_name' => $test_name));
				$question6_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_6' => 'Both short-term and long-term', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 6*/

		   		/*Question 7*/
		   		$question7_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Company trainers (NOT including journeymen)', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question7_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Third-party (eg. Private Trainers, Unions, Product Vendors, Colleges, Universities, etc.)', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question7_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7' => 'Both company trainers and Third-party equally', 'created_at >=' => $time, 'form_name' => $test_name));
   		
		   		/*Question 7*/
		   		/*Question 7 fb*/
				/*$this->data['question7_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7_fb' => 'Higher', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question7_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7_fb' => 'Lower', 'created_at >=' => $time, 'form_name' => $test_name));
				$this->data['question7_fb_details'][] = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_7_fb' => 'Consistent', 'created_at >=' => $time, 'form_name' => $test_name));*/
				/*Question 7 fb*/
		   		/*Question 8*/
		   		$question8_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Less than $100K', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question8_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => '$100K- $500K', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question8_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => '$500K - $1M', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question8_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_8' => 'Greater than $ 1M', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 8*/

		   		/*Question 9*/
		   		$question9_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Tax credits', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question9_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Grants', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question9_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'BOTH taxes credits and grants', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question9_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Other government funding or subsidies for training', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question9_option5 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'NEVER applied for any government funding for training', 'created_at >=' => $time, 'form_name' => $test_name));
   				$question9_option6 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_9' => 'Applied but was NOT successful', 'created_at >=' => $time, 'form_name' => $test_name));	
		   		/*Question 9*/
		   		
				
		   		/*Question 10*/
		   		$question10_option1= $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Prepare for expansion', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_option2 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Continue on-going training development', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_option3 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Both to prepare for expansion and continue on-going training', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_option4 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'Prepare for downsizing', 'created_at >=' => $time, 'form_name' => $test_name));
		   		$question10_option5 = $this->App_model->getRowCount('anb_crm_web_questionnaire', '*', array('que_10' => 'NOT interested in applying for future funding', 'created_at >=' => $time, 'form_name' => $test_name));
		   		/*Question 10*/

	   		}
	   		$tm = time();
			//echo $tm; die("oko");
    		$html = '<span style="font-size:16px;font-weight:bold;">Date: '.date("m/d/Y H:i",$tm).'</span>';
    		$html .= '<span style="font-size:16px;font-weight: bold;display:block;">Doc Id: '.$tm.'</span>';
    		$html .= '<p style="text-align:center; padding-bottom:40px;margin-top:10px;"> <img src="./assets/images/logo-f2-blue.png"></p>';
			$html .= '<style> table {border:1px solid #ddd; border-collapse:collapse; font-family:arial, sans-serif;}';
			$html .= 'th, td {border:1px solid black;border-collapse:collapse; padding:15px 15px; text-align:left;color:#464646;text-align:center;}';
			$html .= '.head {width:40px; padding:5px 5px 5px 15px;}';
			$html .= 'table{margin:20px; auto;width:100%;}';
			$html .= 'table tr:nth-child(odd) {background:#ddd;}';
			$html .= 'table tr:nth-child(even) {background:#fff;} </style>';
			$html .= '<h1 style="margin-bottom:20px; text-align:center;">'. $test_name .'</h1>';
			$html .= '<h3 style="margin-left:25px;">Total Bookings: '.$total_bookings.'</h3>';
			/*Question 1*/
			if($test == 1)
			{

				$html .= '<table>';
				$html .= '<tr>  <th colspan="2"> Question - 1.  Are you paying customs duties for clearing goods into Canada ?</th> </tr>'; 
				$html .= '<tr> <th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question1_yes.'</th> <th>'.$question1_no.'</th></tr>';
				$html .= '</table>';
				
				$html .= '<table>';
				$html .= '<tr>  <th colspan="4"> Question - 2. In CANADA, how much duty are you paying annually? </th></tr>';
				$html .= '<tr><th>More than $500K</th> <th>$101K - $500K</th> <th>$25K - $100K</th> <th>Less than $25K</th> </tr>';
				$html .= '<tr> <th>'.$question2_option1.'</th> <th>'.$question2_option2.'</th><th>'.$question2_option3.'</th> <th>'.$question2_option4.'</th></tr>';
				$html .= '</table>';
				
				/*Question 2*/
				$html .= '<table style="page-break-after: always;">';
				$html .= '<tr> <th colspan="3"> Question - 3. Is your Canadian imported product RE-EXPORTED ?</th></tr>';
				$html .= '<tr><th>No</th> <th>Yes</th><th>Unsure</th></tr>';
				$html .= '<tr><th>'.$question3_option1.'</th> <th>'.$question3_option2.'</th><th>'.$question3_option3.'</th></tr>';
				$html .= '</table>';
				
				/*Question 4*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="3"> Question - 4. How do your goods get cleared through the border ?</th></tr>'; 
				$html .= '<tr><th>Self-clear</th> <th>Customs Broker</th> <th>Multiple customs brokers</th>  </tr>';
				$html .= '<tr> <th>'.$question4_option1.'</th> <th>'.$question4_option2.'</th> <th>'.$question4_option3.'</th> </tr>';
				$html .= '</table>';
				
				/*Question 5*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 5. Do you have a person dedicated to manage the clearance of your goods through customs ?</th></tr>';
				$html .= '<tr><th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question5_yes.'</th> <th>'.$question5_no.'</th></tr>';
				$html .= '</table>';
				
				/*Question 6*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="4"> Question - 6. How much of your purchasing happens in Canada ?</th></tr>';
				$html .= '<tr><th>Less than 10%</th> <th>Between 10% - 25%</th> <th>Greater than 25%</th> <th>N/A</th> </tr>';
				$html .= '<tr><th>'.$question6_option1.'</th> <th>'.$question6_option2.'</th> <th>'.$question6_option3.'</th> <th>'.$question6_option4.'</th></tr>';
				$html .= '</table>';
				
				/*Question 7*/
				$html .= '<table style="page-break-after: always;">';
				$html .= '<tr> <th colspan="2"> Question - 7. In the past 4 years have you had an organizational change such an acquisition or merger ? </th></tr>';
				$html .= '<tr><th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question7_yes.'</th> <th>'.$question7_no.'</th></tr>';
				$html .= '</table>';

				/*Question 8*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="4"> Question - 8. In the past 4 years your broker has filed the flowing amount of rulings:</th></tr>';
				$html .= '<tr><th>Less than 5 advanced rulings</th> <th>5 - 10 advanced rulings</th> <th>Greater than 10 rulings</th><th>None</th> </tr>';
				$html .= '<tr> <th>'.$question8_option1.'</th> <th>'.$question8_option2.'</th> <th>'.$question8_option3.'</th> <th>'.$question8_option4.'</th></tr>';
				$html .= '</table>';

				/*Question 9*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 9. Have you had a Customs Duty audit from a Third-Party firm ? </th></tr>';
				$html .= '<tr><th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question9_yes.'</th> <th>'.$question9_no.'</th></tr>';
				$html .= '</table>';

				/*Question 10*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 10. Have you ever had a compliance assessment audit from a Third-Party firm ?</th></tr>';
				$html .= '<tr><th>Yes</th> <th>No</th> </tr>';
				$html .= '<tr><th>'.$question10_yes.'</th> <th>'.$question10_no.'</th></tr>';
				$html .= '</table>';
			}
			if($test == 2)
			{
				$html .= '<table>';
				$html .= '<tr> <th colspan ="2"> Question - 1. Are you currently selling goods to Canada ?</th></tr>';
				$html .= '<tr><th>Yes</th> <th>NO</th> </tr>';
				$html .= '<tr><th>'.$question1_yes.'</th> <th>'.$question1_no.'</th></tr>';
				$html .= '</table>';
				
				/*Question 2*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 2. Have you been using a customs broker to CLEAR your goods into Canada ?</th></tr>';
				$html .= '<tr><th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question2_yes.'</th> <th>'.$question2_no.'</th></tr>';
				$html .= '</table>';
				
				/*Question 3*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="4"> Question - 3. In the past 4 years what is your estimated ANNUAL sales volume to Canada ? </th></tr>';
				$html .= '<tr><th>Less than $100K</th> <th>$100K - $1.99M</th> <th>$2M - $5M</th> <th>Greater than $5M</th>  </tr>';
				$html .= '<tr> <th>'.$question3_option1.'</th> <th>'.$question3_option2.'</th> <th>'.$question3_option3.'</th> <th>'.$question3_option4.'</th> </tr>';
				$html .= '</table>';
				
				/*Question 4*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="3"> Question - 4. In the past 4 years your sales to Canada have been ?</th></tr>';
				$html .= '<tr><th>Higher</th> <th>Lower</th> <th>Consistent</th> </tr>';
				$html .= '<tr> <th>'.$question4_option1.'</th> <th>'.$question4_option2.'</th> <th>'.$question4_option3.'</th> </tr>';
				$html .= '</table>';
				
				/*Question 5*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 5. Are you registered for Canadian GST (Sales Tax) and regularly filing GST Returns to Canada ? </th></tr>';
				$html .= '<tr> <th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question5_yes.'</th> <th>'.$question5_no.'</th></tr>';
				$html .= '</table>';
				
				/*Question 6*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="3"> Question - 6. Your accounting records for Canadian sales / Accounts Payable records are processed in ?</th></tr>';
				$html .= '<tr><th>USA</th> <th>Canada</th> <th>Another Country</th>  </tr>';
				$html .= '<tr> <th>'.$question6_option1.'</th> <th>'.$question6_option2.'</th> <th>'.$question6_option3.'</th> </tr>';
				$html .= '</table>';
				
				/*Question 7*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 7. In the past 4 years have you had significant changes in your accounting system and/or staff ?</th></tr>';
				$html .= '<tr><th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question7_yes.'</th> <th>'.$question7_no.'</th></tr>';
				$html .= '</table>';

				/*Question 8*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 8. Do you have production or distribution centers in Canada ? </th></tr>';
				$html .= '<tr> <th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr>  <th>'.$question8_yes.'</th> <th>'.$question8_no.'</th></tr>';
				$html .= '</table>';

				/*Question 9*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 9. The Canadian Tax Authority (CRA) conducts regular audits. Has your company been REASSESSED in the past 6 MONTHS ?</th></tr>';
				$html .= '<tr><th>Yes</th> <th>NO</th>  </tr>';
				$html .= '<tr> <th>'.$question9_yes.'</th> <th>'.$question9_no.'</th></tr>';
				$html .= '</table>';

				/*Question 10*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="4"> Question - 10.  Your company had a REVERSE AUDIT ?</th></tr>';
				$html .= '<tr> <th>Less than 2 years ago</th> <th>More than 4 years ago</th> <th>A very long time ago</th> <th>NEVER had a reverse audit</th>  </tr>';
				$html .= '<tr> <th>'.$question10_option1.'</th> <th>'.$question10_option2.'</th> <th>'.$question10_option3.'</th> <th>'.$question10_option4.'</th></tr>';
				$html .= '</table>';
			}
			if($test == 3)
			{
				$html .= '<table>';
				$html .= '<tr>  <th colspan="2"> Question - 1. Has your company/organization been registered to operate and been an EMPLOYER in Canada for at least three (3) years ? </th></tr>';
				$html .= '<tr> <th>Yes</th> <th>No</th></tr>';
				$html .= '<tr><th>'.$question1_option1.'</th> <th>'.$question1_option2.'</th></tr>';
				$html .= '</table>';
				
				/*Question 2*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="2"> Question - 2.  You are a Canadian employer classified as a: </th></tr>';
				$html .= '<tr>
				  		<th>Manufacturer in the private sector</th>
                    	<td>'.$question2_option1.'</td>
				  </tr>		
                  <tr>
					<th> Non-manufacturer in the private sector</th>
					<td>'.$question2_option2.'</td></tr>
				   <tr> <th>Not-for-profit </th>
			   			<td>'.$question2_option3.'</td>
			   	   </tr>
                   <tr> <th>Crown corporation NOT designated under the Broader Public Sector Accountability Act</th>
                   		<td>'.$question2_option4.'</td>
                   </tr>
                   <tr>  
               			<th>Union or other organizations acting on behalf of employers</th>
               			<td>'.$question2_option5.'</td>
                   </tr>			
                   <tr>
                   		<th>A designated broader public sector organization</th>
                   		<td>'.$question2_option6.'</td>
                   </tr>		
                   <tr>	<th>A publicly funded organization receiving in excess of 10 million dollars</th>
                   		<td>'.$question2_option7.'</td>	
                   </tr>
                   <tr>
                      <th>Federal provincial or municipal government and/or agency</th>
                      <td>'.$question2_option8.'</td>
                   </tr>';
				
				$html .= '</table>';
				
				/*Question 3*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="4"> Question - 3.  Your company provides training to: </th></tr>';
				$html .= '<tr><th>
						New company hires</th><th>Existing employees</th><th> All employees</th><th>No training is provided,but planning to provide FREE training in the future</th></tr>';
				$html .= '<tr> <th>'.$question3_option1.'</th> <th>'.$question3_option2.'</th> <th>'.$question3_option3.'</th><th>'.$question3_option4.'</th></tr>';
				$html .= '</table>';
				
				/*Question 4*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="4"> Question - 4.  In Canada, your company payroll currently has:</th></tr>';
				$html .= '<tr><th>
						Less than 50 employees</th><th> 51-100 employees</th><th> 101 - 1000 	employees</th><th> Greater than 1000 employees</th> </tr>';
				$html .= '<tr> <th>'.$question4_option1.'</th> <th>'.$question4_option2.'</th> <th>'.$question4_option3.'</th> <th>'.$question4_option4.'</th> </tr>';
				$html .= '</table>';
				
				/*Question 5*/
				$html .= '<table style="page-break-after: always;">';
				$html .= '<tr> <th colspan="2"> Question - 5. Your company is unionized ?</th></tr>';
				$html .= '<tr><th>Yes</th> <th>No</th></tr>';
				$html .= '<tr> <th>'.$question5_option1.'</th> <th>'.$question5_option2.'</th></tr>';
				$html .= '</table>';
				
				/*Question 6*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="3"> Question - 6. Currently, the MAJORITY of the training that you provide your employees is: </th></tr>';
				$html .= '<tr><th>
					Short-term (less than 52 weeks) </th><th> Longterm (greater than 52 weeks)</th><th>	Both short-term and long-term</th> </tr>';
				$html .= '<tr> <th>'.$question6_option1.'</th> <th>'.$question6_option2.'</th><th>'.$question6_option3.'</th>  </tr>';
				$html .= '</table>';
				
				/*Question 7*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="3"> Question - 7.  The training that the company / organization provides is delivered by:</th></tr>';
				$html .= '<tr><th>
					Company trainers (NOT including journeymen)</th><th>Third-party (eg. Private Trainers,Unions,Product Vendors, Colleges, Universities etc.)</th><th>Both company trainers and Third-party equally</th></tr>';
				$html .= '<tr> <th>'.$question7_option1.'</th> <th>'.$question7_option2.'</th> <th>'.$question7_option3.'</th></tr>';
				$html .= '</table>';

				/*Question 8*/
				$html .= '<table style="page-break-after: always">';
				$html .= '<tr> <th colspan="4"> Question - 8. Over the past 4 YEARS, your ANNUAL expenditures associated with training FOR ALL EMPLOYEES have been:</th></tr>';
				$html .= '<tr> <th>
						Less than $100K</th><th>$100K- $500K</th><th> $500K - $1M</th><th> Greater than $ 1M</th> </tr>';
				$html .= '<tr> <th>'.$question8_option1.'</th> <th>'.$question8_option2.'</th> <th>'.$question8_option3.'</th> <th>'.$question8_option4.'</th></tr>';
				$html .= '</table>';

				/*Question 9*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="6"> Question - 9. In the past four (4) years, which of the following types of government funding / assistance, in RELATION TO TRAINING, has your company/organization sucessfully "received" from the Canadian government ?</th></tr>';
				$html .= '<tr><th>
						Tax credits </th><th> Grants</th><th>BOTH taxes credits and grants</th><th>Other government funding or subsidies for training</th><th>NEVER applied for any government funding for training</th><th>Applied but was NOT successful</th>  </tr>';
				$html .= '<tr> <th>'.$question9_option1.'</th> <th>'.$question9_option2.'</th><th>'.$question9_option3.'</th> <th>'.$question9_option4.'</th><th>'.$question9_option5.'</th> <th>'.$question9_option6.'</th></tr>';
				$html .= '</table>';

				/*Question 10*/
				$html .= '<table>';
				$html .= '<tr> <th colspan="5"> Question - 10. Today, your company/organization is ready to apply for future government funding / assistance, in RELATION TO TRAINING in order to:</th></tr>';
				$html .= '<tr><th>	
						Prepare for expansion</th><th> Continue on-going training development</th><th> Both to prepare for expansion and continue on-going training</th><th>Prepare for downsizing</th><th>NOT interested in applying for future funding</th> </tr>';
				$html .= '<tr> <th>'.$question10_option1.'</th> <th>'.$question10_option2.'</th> <th>'.$question10_option3.'</th><th>'.$question10_option4.'</th> <th>'.$question10_option5.'</th> </tr>';
				$html .= '</table>';
			}
            
			$dompdf = new Dompdf(array('enable_remote' => true));
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'portrait');
			$dompdf->render();
			//$dompdf->stream("Event");
			$output = $dompdf->output();
			file_put_contents("./upload/web_reports/pdf-$tm.pdf", $output);
			$response = array();
			$response['success'] = true;
			$response['file_name'] = "pdf-$tm.pdf";
			echo json_encode($response);die();
    	}
    }
    public function webTracking()
    {
    	$this->data['total'] = $this->WebtrackerModel->getAll();
    	$this->data['canvas_one'][] = $this->WebtrackerModel->countBook();
    	$this->data['canvas_one'][] = $this->WebtrackerModel->countFinished();
    	$this->data['canvas_one'][] = $this->WebtrackerModel->countNotFinished();

    	$this->data['canvas_two'] = $this->WebtrackerModel->getCCDData();
    	$this->data['total_CCD'] = $this->WebtrackerModel->getAll('CCD');
    	$this->data['canvas_three'] = $this->WebtrackerModel->getCSTData();
    	$this->data['total_CST'] = $this->WebtrackerModel->getAll('CST');
    	$this->data['canvas_four'] = $this->WebtrackerModel->getCGIData();
    	$this->data['total_CGI'] = $this->WebtrackerModel->getAll('CGI');
    	//print_r($this->data); die("ok");
    	$this->viewLoad("reports/webTracking");
    }
}
