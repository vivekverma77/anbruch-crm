<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Reports1 extends Base {

	public function __construct(){
		parent::__construct();
		$this->redirectPublicUser();
		$this->load->model("ActivitiesModel");
		$this->load->model("ModuleModel");
		$this->load->model("ReportsModel");
		$this->load->model("Report1Model");
		$this->load->library('pagination');
	}

	public function getcurl(){
		
		 // create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://www.localdiaries.in/Chandigarh/Restaurants"); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
				
        // close curl resource to free up system resources 
        curl_close($ch);

        echo '<pre>';print_r($output);die;
	}
	public function create_call(){

  require_once(APPPATH.'libraries/ringcentral.phar');

  $rcsdk = new RingCentral\SDK\SDK('GWV06-c2RfGrG48vhP9VCw', 'M94tpswNS3SYSJkvNpa55AvvEN8tEYRrm9wxS-mVX2Tw', RingCentral\SDK\SDK::SERVER_SANDBOX, 'test', '1.0.0');

   $rcsdk->platform()->loggedIn();

  // $response =  $rcsdk->platform()->login('+12048184079', '', '@admin@123');

  $file = APPPATH.'libraries/ring.txt';


  file_put_contents($file, json_encode($rcsdk->platform()->auth()->data(), JSON_PRETTY_PRINT));

	// and then next time during application bootstrap before any authentication checks:
	$rcsdk->platform()->auth()->setData(json_decode(file_get_contents($file), true));

 // die;
  
  $response = $rcsdk->platform()->post('grant_type/password/account/~/extension/~/password/@admin@123/sms', array(
            'from' => array('phoneNumber' => '16502301234'),
            'to'   => array(
                array('phoneNumber' => '16502305678'),
            ),
            'text' => 'Hello, World!',
        ));

    echo "<pre>";  print_r($response); die;
		
	}
	
	
  public function get_call()
	{		   
    //echo 'here';die;
    
    if($_GET)
    {
			echo '<pre>$rcsdk=';print_r($_GET);    
			die('in get');
		}
    
    //require('path-to-sdk/ringcentral.phar');
    
    require BASEPATH . "../application/libraries/ringcentral.phar";

    //harpreet sandbox details
    //$clientId= '7TsJIoKFTgy1G6f77wgJyw';
    //$clientSecret = 'oqK6KmSrRpKj6cOFjWY85AZTNMJCbOSj-WIWvsba-0Vw';
    //$username = '+17474443073';
    //$extension = '101';
    //$password = 'test@123';

    //andrew sandbox details
    $clientId= 'ChwcOC9FQUq3tHSAYiuZbw';
    $clientSecret = '313G3efbTeKt1otTpO5yKwqi4bRyJSSw66DfztdV9V1A';
    $username = '+12048184079';
    $extension = '101';
    $password = '@admin@123';
    
    $rcsdk = new RingCentral\SDK\SDK($clientId, $clientSecret, RingCentral\SDK\SDK::SERVER_SANDBOX, 'test', '1.0.0');    
    //echo '<pre>$rcsdk=';print_r($rcsdk);    
    
    //$isLoggedIn = $rcsdk->platform()->loggedIn();
    //echo '<pre>$isLoggedIn=';print_r($isLoggedIn);
    
    //$loggedIn = $rcsdk->platform()->login($username, $extension, $password);
    //echo '<pre>$loggedIn=';print_r($loggedIn);
    
    //$apiResponse = $rcsdk->platform()->post('/restapi/oauth/token');    
    //echo '<pre>$auth=';print_r($apiResponse); die;
    
    // when application is going to be stopped
    
    $file = BASEPATH . "../application/libraries/ringcentral_token.php";

    echo '<pre>';print_r($rcsdk->platform()->auth()->data());
    //die;
    
		file_put_contents($file, json_encode($rcsdk->platform()->auth()->data(), JSON_PRETTY_PRINT));

		// and then next time during application bootstrap before any authentication checks:
		
		$rcsdk->platform()->auth()->setData(json_decode(file_get_contents($file), true));

    //echo '<pre>$rcsdk=';print_r($rcsdk); die;
    
    $apiResponse = $rcsdk->platform()->post('/account/12048184079/extension/101/ring-out', array(
			'from' => array('phoneNumber' => '+12053320032'),
			'to'   => array('phoneNumber' => '+16052160005'),
			'playPrompt' => true,			
    ));
    
    //$apiResponse = $rcsdk->platform()->post('/account/17474443073/extension/101/sms', array(
				//'from' => array('phoneNumber' => '+17474443073'),
				//'to'   => array(
						//array('phoneNumber' => '+16052160005'),
				//),
				//'text' => 'Test from PHP',
		//));
		
		echo '<pre>$loggedIn=';print_r($apiResponse);
		die;
		
		print_r($apiResponse->json()); // stdClass will be returned or exception if Content-Type is not JSON
		print_r($apiResponse->request()); // PSR-7's RequestInterface compatible instance used to perform HTTP request
		print_r($apiResponse->response()); // PSR-7's ResponseInterface compatible instance used as HTTP response
		
	
    
    //$url = "https://platform.ringcentral.com/restapi/v1.0/account/17474443073/extension/101/ring-out";
    
    //$ch = curl_init();
		//curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
		//curl_setopt($ch, CURLOPT_POSTFIELDS,
            //"from=+12053320032&to=+16052160005&playPrompt=true");

		//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		//curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		//$data = curl_exec($ch);
		//$ress = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//curl_close($ch);
		//echo '<pre>';print_r($data);
    
    die("get call");
	}	

	
	public function index()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
		$this->data["record_data"] = $this->ActivitiesModel->loadActivitiesList($this->data["own"]);
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->viewLoad("reports/reports");
	}

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
	    $allcount = $this->Report1Model->getrecordCount($own,$fromDate,$toDate);
       // echo "<pre>"; print_r($allcount); die;


	    // Get records
	    $users_record = $this->Report1Model->getData($rowno,$rowperpage,$own,$fromDate,$toDate);
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'reports1/bookings';
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

		
		 $this->viewLoad("reports1/bookings");



	}
	
	public function bookings_print()
	{
		global $BOOKING_STATUS;
		$this->data["booking_status"] = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["bookings"] = $this->ReportsModel->loadBookingsList($this->data["own"], $fromDate, $toDate);
		
		$this->load->view("reports/bookings_print", $this->data);
	}
	
	public function bookings_export()
	{
		global $BOOKING_STATUS;
		$booking_status = $BOOKING_STATUS;

		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : "";
		$this->data["fromDate"] = ($this->getPost("fromDate") != '') ? $this->getPost("fromDate") : date("01-m-Y");
		$this->data["toDate"] = ($this->getPost("toDate") != '') ? $this->getPost("toDate") : date("d-m-Y");

		$fromDate = date("Y-m-d", strtotime($this->data["fromDate"]));
		$toDate = date("Y-m-d", strtotime($this->data["toDate"]));
		
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$bookings = $this->ReportsModel->loadBookingsList($this->data["own"], $fromDate, $toDate);
		
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

		//echo '<pre>';print_r($this->data["meta_field"]);die;
		
		$this->viewLoad("reports/contracts");
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
				$lineData[] = date("d M Y",$contract["created_time"]);
				
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
	

	public function get_data(){

		  require_once(APPPATH.'third_party/ringcentral/ringcentral.phar');

		  $rcsdk = new RingCentral\SDK\SDK('ChwcOC9FQUq3tHSAYiuZbw', '313G3efbTeKt1otTpO5yKwqi4bRyJSSw66DfztdV9V1A', RingCentral\SDK\SDK::SERVER_SANDBOX, 'testing', '1.0.0');


	}

}
