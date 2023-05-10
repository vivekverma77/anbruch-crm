<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Dashboard extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("ModuleModel");
        $this->load->model("DashboardModel");
        $this->load->model("BookingModel");
        $this->load->model("UserModel");
        $this->load->model("App_model");
    }

  public function index()
	{		
		$loggedUserId = $this->getUserId();
		
		$this->data['own_data'] = $own_data = $this->UserModel->loadUser($loggedUserId);
		
		$this->data['total_leads'] =  $this->DashboardModel->get_total_modules_count(1);
		$this->data['cancelled_leads'] =  0;
		$this->data['won_leads'] =  0;
		$this->data['total_clients'] =  $this->DashboardModel->get_total_modules_count(2);
		
		$this->data['total_appointments'] =  $this->DashboardModel->get_total_appointment_count();
		$this->data['new_appointments'] =  $this->DashboardModel->get_total_appointment_count(null,"0");
		$this->data['confirmed_appointments'] =  $this->DashboardModel->get_total_appointment_count(null,"1");
		$this->data['cancelled_appointments'] =  $this->DashboardModel->get_total_appointment_count(null,"2");
		
	 
    	global $FIELD_TYPE;
		global $RECORD_STATUS;
		global $BOOKING_STATUS;
		
		$this->data["booking_status"] = $BOOKING_STATUS;
		
		$this->data["recordStatus"] = ($this->getPost("rStat") != '') ? $this->getPost("rStat") : $RECORD_STATUS["CYCLE_RUNNING"];
		
		if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
				$this->data["writePermission"] = false;
		}
 
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
		$this->data["page"] = ($this->getPost("page") != '') ? $this->getPost("page") : 1;

		$this->data["current_module"] = $this->getPost('cm') !="" ? $this->getPost('cm') : 'Leads';
		
		$this->data['sort_column'] = $this->getPost('sort_column');
		$this->data['sort_order'] = $this->getPost('sort_order');
		$this->data['keyword'] = $this->getPost('keyword');
        
    if(!$this->data['sort_column'])
			$this->data['sort_column'] = 'Company Name';
			
    if(!$this->data['sort_order'])
			$this->data['sort_order'] = 'DESC';
			
		$npage_no = $this->getPost("page");
		if(!$npage_no)
			$npage_no = 1;
			
    $limit_per_page = $this->getPost("num_records_per_page");
		if(!$limit_per_page) $limit_per_page = 20;			
			
		$this->data['records_per_page'] = $limit_per_page;
						
		$arr_search_filters = [];
    $this->data['search_filters'] = [];
    
    $this->data["users_list"] = $this->ModuleModel->loadUsersList();
    $this->data["page"] = "dashboard";
    
    //common code
    
    $from_date = date('Y-m-d H:i:s');	
    $this->data["bookings"] = $this->BookingModel->loadBookingsListForDashboard($loggedUserId);	
    $this->data["upcoming_bookings"] = $this->BookingModel->loadBookingsListForDashboard($loggedUserId,$from_date, 1);
    
    //common code // New dashboard code
    $day = date('w');
	$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
	$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));

	$week_start_timestamp = date(strtotime('-'.$day.' days'));
	$week_end_timestamp = date(strtotime('+'.(6-$day).' days'));

    $this->data["bookingsInWeek"] = $this->App_model->getRowCount('anb_crm_bookings', array('id'), array('created_time >=' => $week_start,'created_time <=' => $week_end));

    $this->data["leadsInWeek"] = $this->App_model->getRowCount('anb_crm_record', array('id'), array('module_id' => 1,'created_time >=' => $week_start_timestamp,'created_time <=' => $week_end_timestamp  ));

    $this->data["clientsInWeek"] = $this->App_model->getRowCount('anb_crm_record', array('id'), array('module_id' => 2, 'created_time >=' => $week_start_timestamp,'created_time <=' => $week_end_timestamp ));

    $this->data["contractsInWeek"] = $this->App_model->getRowCount('anb_crm_record', array('id'), array('module_id' => 3, 'created_time >=' => $week_start_timestamp,'created_time <=' => $week_end_timestamp));

    $this->data["newBookingInWeek"] = $this->App_model->getRowCount('anb_crm_bookings', array('id'), array('status' => 0, 'created_time >=' => $week_start,'created_time <=' => $week_end));

    $this->data["confirmedBookingInWeek"] = $this->App_model->getRowCount('anb_crm_bookings', array('id'), array('status' => 1, 'status_change_date >=' => $week_start,'status_change_date <=' => $week_end));

    $this->data["cancelledBookingInWeek"] = $this->App_model->getRowCount('anb_crm_bookings', array('id'), array('status' => 2,'praposed_date' => '0000-00-00 00:00:00', 'status_change_date >=' => $week_start,'status_change_date <=' => $week_end));

    $this->data["suggestedBookingInWeek"] = $this->App_model->getRowCount('anb_crm_bookings', array('id'), array('status' => 2,'praposed_date !=' => '0000-00-00 00:00:00', 'status_change_date >=' => $week_start,'status_change_date <=' => $week_end));

    $this->data["qualifiedLeadsInWeek"] = $this->App_model->getRowCount('anb_crm_qualify_now', array('id'), array('selling_goods_to_canada' => 'yes', 'created_time >=' => $week_start,'created_time <=' => $week_end));

    $this->data["invoicesInWeek"] = $this->App_model->getRowCount('anb_crm_invoices', array('id'), array('created_time >=' => $week_start,'created_time <=' => $week_end));

    $this->data["leadsToClientsInWeek"] = $this->App_model->getRowCount('anb_crm_record', array('id'), array('module_id' => 2,'lead_id !=' => null, 'created_time >=' => $week_start_timestamp,'created_time <=' => $week_end_timestamp  ));

    $this->data["recentBookings"] = $this->App_model->getData('anb_crm_bookings', array('id','booking_title','booking_date','record_id','status','name','email','all_day','praposed_date'),false,false,'id','DESC',8 );
	//print_r( $this->data["recentBookings"]);die();
    // New dashboard code
    $role_id = $this->getUserRole();
    
    if($role_id==1)     // super admin
    {
			//------------------------------------------------//
			$this->data["all_opener"] = $this->ModuleModel->loadUsersByRole(
				$role_id = 3,
				$status = 1
			);
			//echo '<pre>';print_r($this->data["all_opener"] ); die;
			$opener_ids = [];
			$monthly_target_all_opener = 0;
			$opener_ids[] = 1;
			if(!empty($this->data["all_opener"]))
			{
				foreach($this->data["all_opener"] as $opener)
				{
					$opener_ids[] = $opener['id'];
					$monthly_target_all_opener += $opener['monthly_target'];
				}
			}
			
			$this->data["opener_ids"] = $opener_ids;
			//echo '<pre>';print_r($opener_ids); die;		
			
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta(
				$this->data["current_module"]
			);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
						
			$arr_temp = $this->ModuleModel->loadRecordListForDashboard(
				$this->data["recordStatus"], 
				//$this->data["opener_ids"] , 
				null , 
				$arr_search_filters, 
				$this->data["page"], 
				$limit_per_page, 
				$this->data['sort_column'], 
				$this->data['sort_order'], 
				$this->data['keyword'],
				$this->data["current_module"], 
				$from_date
			);		
			//echo '<pre>';print_r($arr_temp); die;		
			$this->data["record_data_all_opener"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];

			//--------------------------------------------//
			$this->data["all_closer"] = $this->ModuleModel->loadUsersByRole(
				$role_id = 4,
				$status = 1
			);
			$closer_ids = [];
			$monthly_target_all_closer = 0;
			if(!empty($this->data["all_closer"]))
			{
				foreach($this->data["all_closer"] as $closer)
				{
					$closer_ids[] = $closer['id'];
					$monthly_target_all_closer += $closer['monthly_target'];
				}
			}
			$closer_ids[] = 1; 
			$this->data["closer_ids"] = $closer_ids;
			//echo '<pre>';print_r($closer_ids); die;	
			
			$arr_temp = $this->ModuleModel->loadRecordListForDashboard(
				$this->data["recordStatus"], 
				$this->data["closer_ids"] , 
				$arr_search_filters, 
				$this->data["page"], 
				$limit_per_page,	 
				$this->data['sort_column'], 
				$this->data['sort_order'], 
				$this->data['keyword'],
				$this->data["current_module"], 
				$from_date
			);		
			//echo '<pre>';print_r($arr_temp); die;		
			$this->data["record_data_all_closer"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];	

			//----------------------------------------------------//
			$this->data["all_technical"] = $this->ModuleModel->loadUsersByRole(
			$role_id = 5,
			$status = 1
			);
			$technical_ids = [];
			$monthly_target_all_technical = 0;
			if(!empty($this->data["all_technical"]))
			{
				foreach($this->data["all_technical"] as $technical)
				{
					$technical_ids[] = $technical['id'];
					$monthly_target_all_technical += $technical['monthly_target'];
				}
			}
			$this->data["technical_ids"] = $technical_ids;
			//echo '<pre>';print_r($technical_ids); die;	
			$this->data["current_module1"] = $this->getPost('cm') !="" ? $this->getPost('cm') : 'Contracts';
			
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta(
				$this->data["current_module"]
			);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
			
			$arr_temp = $this->ModuleModel->loadRecordListForDashboard(
				$this->data["recordStatus"], 
				$this->data["technical_ids"], 
				$arr_search_filters, 
				$this->data["page"], 
				$limit_per_page, 
				$this->data['sort_column'], 
				$this->data['sort_order'], 
				$this->data['keyword'],
				$this->data["current_module1"], 
				$from_date
			);		
			//echo '<pre>';print_r($arr_temp[0]); die;		
			$this->data["record_data_contract"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];
			
			
			//----------------------------------------------------//
			$fin_arr= [];
			$year = date('Y');
			//echo $year;die();
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraphByIds($opener_ids, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}
			//echo '<pre>';print_r($fin_arr);
			//echo '<pre>';print_r(json_encode($fin_arr));		
			//die;
			// New chart
			$openerChartLabel = array();
			$openerChartData  = array();
			if(!empty($fin_arr))
			{
				foreach ($fin_arr as $key => $fin) {
					$openerChartLabel[] = $fin['label'];
					$openerChartData[] = $fin['y'];
				
				}
			}else
			{
				$openerChartLabel = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				$openerChartData = array(0,0,0,0,0,0,0,0,0,0,0,0);
			}

			$this->data["opener_chart_label"] = json_encode($openerChartLabel);
			$this->data["opener_chart_data"] = json_encode($openerChartData);

			$this->data["monthly_bookings_all_opener"] = json_encode($fin_arr);			
			$this->data["monthly_target_all_opener"] = $monthly_target_all_opener;
			 
			
			//----------------------------------------------------//
			$fin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraphByIds($closer_ids, $month, $year);
				$fin_arr[] = $monthlybookings;
			}
			//echo '<pre>';print_r($fin_arr);
			//echo '<pre>';print_r(json_encode($fin_arr));
			
			// New chart 
			$closerChartLabel = array();
			$closerChartData  = array();
			if(!empty($fin_arr))
			{
				foreach ($fin_arr as $key => $fin2) {
					$closerChartLabel[] = $fin2['label'];
					$closerChartData[] = $fin2['y'];
				}
			}else
			{
				$closerChartLabel = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				$closerChartData = array(0,0,0,0,0,0,0,0,0,0,0,0);
			}

			$this->data["closer_chart_label"] = json_encode($closerChartLabel);
			$this->data["closer_chart_data"] = json_encode($closerChartData);

			$this->data["monthly_bookings_all_closer"] = json_encode($fin_arr);			
			$this->data["monthly_target_all_closer"] = $monthly_target_all_closer;
			
			
			//------------------------------------------------------//
			$confin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlycontracts = $this->ModuleModel->loadContractsForDashboardGraphByIds($technical_ids, $month, $year);		
				
				$confin_arr[] = $monthlycontracts;
			}
			//echo '<pre>';print_r($confin_arr);
			//echo '<pre>';print_r(json_encode($confin_arr));		
			//die; 
			// New chart 
			$contracts_chart_label = array();
			$contracts_chart_data  = array();
			if(!empty($confin_arr))
			{
				foreach ($confin_arr as $key => $fin3) {
					$contracts_chart_label[] = $fin3['label'];
					$contracts_chart_data[] = $fin3['y'];
				}
			}else
			{
				$contracts_chart_label = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				$contracts_chart_data = array(0,0,0,0,0,0,0,0,0,0,0,0);
			}    
			$this->data["contracts_chart_label"] = json_encode($contracts_chart_label);
			$this->data["contracts_chart_data"] = json_encode($contracts_chart_data);

			$this->data["monthly_contracts"] = json_encode($confin_arr);
			$this->data["monthly_target_all_technical"] = $monthly_target_all_technical;
			//echo '<pre>';print_r($this->data["monthly_contracts"] );		
			//die;
			$join = array(
				array('table' => 'anb_crm_users_personal_info',
					  'on' => 'anb_crm_users.id = anb_crm_users_personal_info.user_id'	
				)
			);      
			$this->data["users"] = $this->App_model->getData('anb_crm_users',array('*','anb_crm_users.id as user_id'),false,$join);
			
			$this->viewLoad("dashboard/dashboard_admin");
			//$this->viewLoad("dashboard/dashboard_admin2");
		}
		else if($role_id==3)    // opener
		{
			//codefor leads - opener
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
			$arr_temp = $this->ModuleModel->loadRecordList($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, $this->data['sort_column'], $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date);		
			//echo '<pre>';print_r($arr_temp); //die;		
			$this->data["record_data"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];
			
			$fin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraph($loggedUserId, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}
			//echo '<pre>';print_r($fin_arr);
			//echo '<pre>';print_r(json_encode($fin_arr));		
			//die;     
			

			$this->data["monthly_bookings"] = json_encode($fin_arr);
			// New chart
			$openerChartLabel = array();
			$openerChartData  = array();
			if(!empty($fin_arr))
			{
				foreach ($fin_arr as $key => $fin2) {
					$openerChartLabel[] = $fin2['label'];
					$openerChartData[] = $fin2['y'];
				}
			}else
			{
				$openerChartLabel = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				$openerChartData = array(0,0,0,0,0,0,0,0,0,0,0,0);
			}

			$this->data["opener_chart_label"] = json_encode($openerChartLabel);
			$this->data["opener_chart_data"] = json_encode($openerChartData);
			//echo '<pre>';print_r($this->data["monthly_bookings"] );		
			//die;     
		
			$this->viewLoad("dashboard/dashboard_opener");
		}
		else if($role_id==4)   // closer
		{
			//codefor leads - closer
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
			$arr_temp = $this->ModuleModel->loadRecordList($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, $this->data['sort_column'], $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date);		
			//echo '<pre>';print_r($arr_temp); //die;		
			$this->data["record_data"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];
		
			$fin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraph($loggedUserId, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}
			//echo '<pre>';print_r($fin_arr);
			//echo '<pre>';print_r(json_encode($fin_arr));		
			//die;     
			
			$this->data["monthly_bookings"] = json_encode($fin_arr);
			
			// New chart 
			$closerChartLabel = array();
			$closerChartData  = array();
			if(!empty($fin_arr))
			{
				foreach ($fin_arr as $key => $fin2) {
					$closerChartLabel[] = $fin2['label'];
					$closerChartData[] = $fin2['y'];
				}
			}else
			{
				$closerChartLabel = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				$closerChartData = array(0,0,0,0,0,0,0,0,0,0,0,0);
			}

			$this->data["closer_chart_label"] = json_encode($closerChartLabel);
			$this->data["closer_chart_data"] = json_encode($closerChartData);

			//echo '<pre>';print_r($this->data["monthly_bookings"] );		
			//die;     
		
			$this->viewLoad("dashboard/dashboard_closer");
		}
		else if($role_id==5)  // technical
		{
			//codefor contracts
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
			$arr_temp = $this->ModuleModel->loadRecordList($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, $this->data['sort_column'], $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date);		
			//echo '<pre>';print_r($arr_temp); //die;		
			$this->data["record_data"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];
			
			$this->data["current_module"] = $this->getPost('cm') !="" ? $this->getPost('cm') : 'Contracts';
			
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
			$arr_temp = $this->ModuleModel->loadRecordList($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, $this->data['sort_column'], $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date);		
			//echo '<pre>';print_r($arr_temp[0]); die;		
			$this->data["record_data_contract"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];
			
			$confin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlycontracts = $this->ModuleModel->loadContractsForDashboardGraph($loggedUserId, $month, $year);		
				
				$confin_arr[] = $monthlycontracts;
			}
			//echo '<pre>';print_r($confin_arr);
			//echo '<pre>';print_r(json_encode($confin_arr));		
			//die;     
			
			$this->data["monthly_contracts"] = json_encode($confin_arr);
			// New chart 
			$contracts_chart_label = array();
			$contracts_chart_data  = array();
			if(!empty($confin_arr))
			{
				foreach ($confin_arr as $key => $fin3) {
					$contracts_chart_label[] = $fin3['label'];
					$contracts_chart_data[] = $fin3['y'];
				}
			}else
			{
				$contracts_chart_label = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
				$contracts_chart_data = array(0,0,0,0,0,0,0,0,0,0,0,0);
			}    
			$this->data["contracts_chart_label"] = json_encode($contracts_chart_label);
			$this->data["contracts_chart_data"] = json_encode($contracts_chart_data);

			//echo '<pre>';print_r($this->data["monthly_contracts"] );		
			//die;      
		
			$this->viewLoad("dashboard/dashboard_technical");
		}
		else if($role_id==6)   // accounting
		{
			
			$arr_temp = $this->DashboardModel->recentRecordForDashboard($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, 'id', $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date,  $this->getPost('id'));
			$this->data["record_data"] = $arr_temp[0];
			$arr_temp2 = $this->DashboardModel->recentRecordForDashboard($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, 'id', $this->data['sort_order'], $this->data['keyword'],'Contracts', $from_date,  $this->getPost('id'));
			$this->data["recentContracts"] = $arr_temp2[0];
			$this->viewLoad("dashboard/dashboard");  
		}
	}	
  public function charComparison()
  {
  	$user_id =  $this->getPost('user_id');
	$user_role_id =  $this->getPost('user_role_id');
	$user_arr= [];
	$year = $this->getPost('year') ? $this->getPost('year') : date('Y');
	$data = array();
	$data['year'] = $year;
	$data['selected_user_data'] = $own_data = $this->UserModel->loadUser($user_id);
	//print_r($this->data['selected_user_data']);die();
	$data['charYaxis'] = 'Bookings';
	if($user_role_id == 3 || $user_role_id == 4){
		for($month=1; $month<=12; $month++)
		{		
			$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraph($user_id, $month, $year);
			$user1_arr[] = $monthlybookings;
		}
		$data['charYaxis'] = 'Bookings';
	}elseif ($user_role_id == 5 || $user_role_id == 6) {
		for($month=1; $month<=12; $month++)
		{
			$monthlycontracts = $this->ModuleModel->loadContractsForDashboardGraph($user_id, $month, $year);
			$user1_arr[] = $monthlycontracts;
		}
		$data['charYaxis'] = 'Contracts';
	}
	if(!empty($user1_arr))
	{
		foreach ($user1_arr as $key => $fin) {
			$user1ChartLabel[] = $fin['label'];
			$user1ChartData[] = $fin['y'];
		}
	}else
	{
		$user1ChartLabel = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		$user1ChartData = array(0,0,0,0,0,0,0,0,0,0,0,0);
	}
	
	$data["user1_chart_label"] = $user1ChartLabel;
	$data["user1_chart_data"] = $user1ChartData;
	//echo"<pre>";
	//print_r($user1ChartLabel);
	//print_r($user1ChartData);
	//print_r($user1_arr);
	//echo"</pre>";
	echo json_encode($data);
	die();
  }	
	
  public function call()
	{		   
    $this->data["page"] = "call";
    $this->viewLoad("dashboard/call");
	}	



	public function create_call(){

  require_once(APPPATH.'libraries/ringcentral.phar');

 //  $rcsdk = new RingCentral\SDK\SDK('GWV06-c2RfGrG48vhP9VCw', 'M94tpswNS3SYSJkvNpa55AvvEN8tEYRrm9wxS-mVX2Tw', RingCentral\SDK\SDK::SERVER_SANDBOX, 'test', '1.0.0');

 //   $rcsdk->platform()->loggedIn();

 //  $response =  $rcsdk->platform()->login('2048184079', '', '@admin@123');

 //  $file = APPPATH.'libraries/ring.txt';


 //  file_put_contents($file, json_encode($rcsdk->platform()->auth()->data(), JSON_PRETTY_PRINT));

	// // and then next time during application bootstrap before any authentication checks:
	// $rcsdk->platform()->auth()->setData(json_decode(file_get_contents($file), true));

 // // die;
  
 //  $response = $rcsdk->platform()->post('grant_type/password/account/~/extension/~/password/@admin@123/sms', array(
 //            'from' => array('phoneNumber' => '16502301234'),
 //            'to'   => array(
 //                array('phoneNumber' => '16502305678'),
 //            ),
 //            'text' => 'Hello, World!',
 //        ));

 //    echo "<pre>";  print_r($response); die;


// curl -i -X POST "https://platform.devtest.ringcentral.com/restapi/oauth/token"; \
// -H "Accept: application/json" \
// -H "Content-Type: application/x-www-form-urlencoded" \
// -u "86TcjNLeT1KUK9m573B1tw:F5cGL1b1SWCg4o2OkI74Qggnp32WTSSvGXDsh0Env0MQ" \
// -d "username=12048184079&password=Reset321$$&extension=&grant_type=password"



// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://platform.devtest.ringcentral.com/restapi/oauth/token");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, "username=+12048184079&password=Reset321$$&extension=101&grant_type=password");
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_USERPWD, "1RjNgM-LTR2REFuE-ggrHA" . ":" . "524fjcIjTbiVR9CPclIZHQwXDDEd8vSayHvx_FdfegzA");

// $headers = array();
// $headers[] = "Accept: application/json";
// $headers[] = "Content-Type: application/x-www-form-urlencoded";
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $result = curl_exec($ch);

// echo '<pre>'; print_r($result); die;

// if (curl_errno($ch)) {
//    echo 'Error:' . curl_error($ch);
// }

// curl_close ($ch);


  // curl --request POST \
  // --url 'https://platform.devtest.ringcentral.com/restapi/v1.0/account/~/extension/~/ring-out' \
  // --header 'accept: application/json' \
  // --header 'authorization: Bearer U0pDMTFQMDFQQVMwMHxBQURCXzZZeWNKNXUzVmZDMnhJazJHQ05ZUEhqcWJtVWtWMGVyLUdWcUlJVTNsdE5UU3laSlhGeDVFTy0zaXhsVGlWNF9QWWRPMEVYNENYQjd4dmJsWHJoZGlhdHd4WXZSUWJIczcycTVONm13N3EwUzludVlvbWtvNEp4VTFpWFR4Qkc1N09MQm4tT2ZuLW40UUR2bDR5a09zQ2NQazBydnFsb0dZR19MVlo5bHNEYWFRZDNadGVoRG9icVRYbUswSm1fTjVtQ0o3ZFRyOVhCdnRCMVFzOFd8amhaMGtnfHdiM2dLc3ZyLXdpWGpGdDdoc0hwSkF8QUE' \
  // --header 'content-type: application/json' \
  // --data '{"from":{"phoneNumber":"+12048184079"},"to":{"phoneNumber":"+917404291112"}}'

		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"https://platform.devtest.ringcentral.com/restapi/v1.0/account/~/extension/~/ring-out");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 
		         http_build_query(array('from' => '+12048184079',
		         	                       'to' => '+17604762222'
                                    )));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$headers = [
			            "Content-Type: application/json",
			            "Accept: application/json",
			            "Authorization: Bearer U0pDMTFQMDFQQVMwMHxBQUFtdWhQcG5lYk4xbUIwc2pyaXpqTVZJZnlxUWhENlEtc2NRcTNxYmZaRXl5Qk9nSWk2RDFiMjVFTy0zaXhsVGlWNF9QWWRPMEVYNENYQjd4dmJsWHJoVTBsTVl2VlA1XzNIczcycTVONm13eDY5d3o3YWkwN3l5Wkt3clFLVDl0Y3FmajJQZ0tRSUtmRnhjNGJua1lHbmxxSElJTzBnOUxab0dZR19MVlo5bGhDU2pMcE1oYm5jRG9icVRYbUswSm14VzI3VmdrNjR2aVZxUGt6bU9aOUN8amhaMGtnfFZFM1ZGamhpaTdKcjc2dkRzSDEzMGd8QUE"
            
               ];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$server_output = curl_exec($ch);

		echo "<pre>"; print_r($server_output); die;

		curl_close ($ch);


	}
	
	
  public function get_call()
	{		   
    echo 'here';die;
    
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
    $password = 'admin@123';
    
    $rcsdk = new RingCentral\SDK\SDK($clientId, $clientSecret, RingCentral\SDK\SDK::SERVER_SANDBOX);    
    //echo '<pre>$rcsdk=';print_r($rcsdk);    
    
    //$isLoggedIn = $rcsdk->platform()->loggedIn();
    //echo '<pre>$isLoggedIn=';print_r($isLoggedIn);
    
    //$loggedIn = $rcsdk->platform()->login($username, $extension, $password);
    //echo '<pre>$loggedIn=';print_r($loggedIn);
    
    //$apiResponse = $rcsdk->platform()->post('/restapi/oauth/token');    
    //echo '<pre>$auth=';print_r($apiResponse); die;
    
    // when application is going to be stopped
    
    $file = BASEPATH . "../application/libraries/ringcentral_token.php";
    
		file_put_contents($file, json_encode($rcsdk->platform()->auth()->data(), JSON_PRETTY_PRINT));

		// and then next time during application bootstrap before any authentication checks:
		$rcsdk->platform()->auth()->setData(json_decode(file_get_contents($file), true));
    
    $apiResponse = $rcsdk->platform()->post('/account/12048184079/extension/101/ring-out', array(
			'from' => array('phoneNumber' => '+12048184079'),
			'to'   => array('phoneNumber' => '+919888405130'),
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
    
    die();
	}	
	
	
	
	
	
	public function alltables()
	{
		$tables = $this->db->list_tables();
		echo '<pre>';print_r($tables); //die;
		foreach ($tables as $key=>$table)
		{		
			 echo '<br>';
			 echo 'Table : '.$table;
			 echo '<br>-----<br>';
			 $fields = $this->db->list_fields($table);
			 $allfields=  [];
				foreach ($fields as $field)
				{					
					 echo $field;
					 $allfields[] = $field;
					 echo '<br>';
				}
				echo '<br>-----<br>';
				if(in_array('id',$allfields))
				{
					$query = "select * from ".$table.' order by id desc limit 5';
					$query = $this->db->query($query);
					$res = $query->result_array();
					echo '<pre>';print_r($res);
				}
				else
				{
					$query = "select * from ".$table.' limit 5';
					$query = $this->db->query($query);
					$res = $query->result_array();
					echo '<pre>';print_r($res);
				}
				
				echo '<br>******************';
 
		}
		die;
	}
	
	public function singletable($table)
	{
		$tables = $this->db->list_tables();
		echo '<pre>';print_r($tables); //die;
		
		if($table!="") 
		{		
			//$table = 'anb_crm_'.$table;
			 echo '<br>';
			 echo 'Table : '.$table;
			 echo '<br>-----<br>'; //die;
			 $fields = $this->db->list_fields($table);
				foreach ($fields as $field)
				{					
					 echo $field;
					 echo '<br>';
				}
				echo '<br>-----<br>';   //die;
				
				echo $query = "select * from ".$table; //die;
				$query1 = $this->db->query($query);
				//echo '<pre>';print_r($query1); //die;
				$res = $query1->result_array(); //die;
				if(isset($res))
				{
					echo '<pre>';print_r($res);
				}
				
				echo '<br>******************';
		}
		die;		
	}
	
	function createtable()
	{		
		$query = '';
		
		//$query = 'CREATE TABLE `anb_crm_bookings` (
			//`id` int(11) NOT NULL,
			//`record_id` int(11) NOT NULL,
			//`booking_date` datetime NOT NULL,
			//`name` varchar(255) NOT NULL,
			//`email` varchar(255) NOT NULL,
			//`status` tinyint(4) NOT NULL,
			//`created_by` int(11) NOT NULL,
			//`modified_by` int(11) NOT NULL,
			//`created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			//`modified_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		//) ENGINE=InnoDB DEFAULT CHARSET=latin1';
		
		//$this->db->query($query);
		
		die;		
	}
	
	function updatetable()
	{		
		$query = '';
		
		//$query = 'ALTER TABLE `anb_crm_emailtemplates` ADD PRIMARY KEY (`id`)';
		//$query = 'ALTER TABLE `anb_crm_emailtemplates` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT';
		
		$this->db->query($query);
		
		die;		
	}
	
	function truncatetable()
	{		
		$query = '';
		
		//$query = 'TRUNCATE TABLE anb_crm_emailtemplates';
		
		$this->db->query($query);
		
		die;		
	}
	
}
