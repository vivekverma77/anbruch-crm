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
        $this->load->helper('common_helper');
    }

  public function index()
	{		
	    //die;
		$loggedUserId = $this->getUserId();
		
		$this->data['own_data'] = $own_data = $this->UserModel->loadUser($loggedUserId);
		
		$this->data['total_leads'] =  $this->DashboardModel->get_total_modules_count (1);
		$this->data['cancelled_leads'] =  0;
		$this->data['won_leads'] =  0;
		$this->data['total_clients'] =  $this->DashboardModel->get_total_modules_count(2);
		
    	global $FIELD_TYPE;
		global $RECORD_STATUS;
		global $BOOKING_STATUS;
		
		$this->data["booking_status"] = $BOOKING_STATUS;
		
		$this->data["recordStatus"] = ($this->getPost("rStat") != '') ? $this->getPost("rStat") : $RECORD_STATUS["CYCLE_RUNNING"];
		
		if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
				$this->data["writePermission"] = false;
		}
 
    
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

    $this->data["bookingsInWeek"] = $this->App_model->getRowCount('anb_crm_bookings', array('id'), array('booking_date >=' => $week_start,'booking_date <=' => $week_end));

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

    // New dashboard code

    //------------------------------------------------//
    		/* Leads code start */
    		$t = array(
    			array(
    				'table' => 'anb_crm_users_personal_info',
    				'on' => 'anb_crm_users_personal_info.user_id = anb_crm_users.id',
    			),
    		);

    		$opener_data = $this->App_model->getData('anb_crm_users','anb_crm_users_personal_info.first_name,anb_crm_users_personal_info.last_name,anb_crm_users.*',array('anb_crm_users.role_id'=>3),$t);

    		$this->data['team']=$this->App_model->getData('anb_crm_teams','*',['status'=>1]);

    		if(isset($opener_data) && !empty($opener_data))
    		{
    			$this->data['opener_data'] = $opener_data;
    			$join = array(
		    			array(
		    				'table' => 'anb_crm_record b',
		    				'on' => 'a.record_id = b.id',
		    			),
		    		);

	    		for($i=0; $i<Count($opener_data); $i++)
	    		{
	    			$openers = $this->App_model->getData('anb_crm_record_meta_value a','count(a.value)as leads, a.record_id ',array('a.record_meta_id'=>22, 'a.value' => $opener_data[$i]['id'], 'b.module_id'=>1 ), $join, false, false, false, false, false,array('a.value', 'a.record_id'));
						/*
	    			getData($tablename, $select = '*', $where = false, $join = false, $order_by = false, $order = 'DESC', $limit = false, $offset = false, $or_like = false,$group_by = false)*/
	    			if(isset($openers) && !empty($openers))
	    			{
		    			$data['openers'][] = $opener_data[$i]['first_name'].' '.$opener_data[$i]['last_name'];
		    			$data['lead_counts'][] = $openers[0]['leads'];
		    			$data['total_leads'][]  = $openers[0]['leads']; 
	    			}
	    			//print_r($openers);
	    		}
	    			
	    		//print_r($opener_data);
	    		$total_leads =0;	
	    		foreach ($data['total_leads'] as $key => $value) {
	    			$total_leads+=$value;
	    		}

	    		$this->data['total_leads'] = $total_leads;
	    		$this->data['lead_details'] = $data;
	    		$this->data['lead_details_count'] = Count($opener_data);
			}    		
    		/*Leads code end*/

    	// lead/opener chart start
    		$loggedUserId = $this->getUserId();
     		$role_id = $this->getUserRole();
     		$send = array("loggedUserId"=>$loggedUserId,"role_id"=>$role_id);
    		$opener_chart = $this->App_model->opener_chart($send);
    		$this->data['opener_chart'] = $opener_chart['result'];
    		$this->data['unassign_lead'] = $opener_chart['unassign'];

    	// lead/opener chart end	
    	// lead/opener chart start

    		$closer_chart = $this->App_model->closer_chart($send);
    		$this->data['closer_chart'] = $closer_chart;
    		
    	// lead/opener chart end		

    		/*Clients code start*/

    		$closer_data =  $this->App_model->getData('anb_crm_users','anb_crm_users_personal_info.first_name,anb_crm_users_personal_info.last_name,anb_crm_users.*',array('anb_crm_users.role_id'=>4),$t);
    		if(!empty($closer_data) && isset($closer_data)){
    			$this->data['closer_data'] = $closer_data;
    			$join = array(
		    			array(
		    				'table' => 'anb_crm_record b',
		    				'on' => 'a.record_id = b.id',
		    			),
		    		);

	    		for($i=0; $i<Count($closer_data); $i++)
	    		{
	    			$closer = $this->App_model->getData('anb_crm_record_meta_value a','count(a.value)as client, a.record_id ',array('a.record_meta_id'=>104, 'a.value' => $closer_data[$i]['id'], 'b.module_id'=> 2 ), $join, false, false, false, false, false,array('a.value', 'a.record_id'));

	    			if(isset($closer) && !empty($closer))
	    			{
		    			$data['closer'][] = $closer_data[$i]['first_name'].' '.$closer_data[$i]['last_name'];
		    			$data['client_counts'][] = $closer[0]['client'];
		    			$data['total_clients'][]  = $closer[0]['client']; 
	    			}
	    			//print_r($closer);
	    			//print_r($this->db->last_query());
	    			//die;
	    		}
	    		$total_clients =0;	
	    		foreach ($data['total_clients'] as $key => $value) {
	    			$total_clients+=$value;
	    		}
	    		$this->data['total_clients'] = $total_clients;
	    		$this->data['client_details'] = $data;
	    		$this->data['client_details_count'] = Count($closer_data);	

    		}

    		/*Clients code End*/
    $role_id = $this->getUserRole();
    
    if($role_id==1 || $role_id==7)     // super admin
    {
			
    		/*print_r($closer_data);
    		die;*/

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
			
			
			//----------------------------------------------------//
			$fin_arr= [];
			$year = date('Y');
			//echo $year;die();
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraphByIds($opener_ids, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}
		
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
		else if($role_id==3 || $role_id == 8)    // opener or researcher
		{
			//codefor leads - opener
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
	
			$fin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraph($loggedUserId, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}
			

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
		
						//----------------------------------------------------//

				$fin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraph($loggedUserId, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}
	
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

			//----------------------------------------------------//

			$this->viewLoad("dashboard/dashboard_opener");
		}
		else if($role_id==4)   // closer
		{

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


			//codefor leads - closer
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		

		
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

			$fin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraph($loggedUserId, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}

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

			//----------------------------------------------------//
			$fin_arr= [];
			$year = date('Y');
			//echo $year;die();
			for($month=1; $month<=12; $month++)
			{		
				$monthlybookings = $this->BookingModel->loadBookingsForDashboardGraphByIds($opener_ids, $month, $year);		
				
				$fin_arr[] = $monthlybookings;
			}

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
			$this->viewLoad("dashboard/dashboard_closer");
		}
		else if($role_id==5)  // technical
		{
			//codefor contracts
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;

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
            $arr_temp = $this->ModuleModel->loadRecordListForDashboard(
				$this->data["recordStatus"], 
				null, 
				$arr_search_filters, 
				$this->data["page"], 
				$limit_per_page, 
				$this->data['sort_column'], 
				$this->data['sort_order'], 
				$this->data['keyword'],
				$this->data["current_module"], 
				$from_date
			);		
			//echo '<pre>';print_r($arr_temp[0]); die;		
			$this->data["record_data_contract"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];
			

			$this->data["current_module"] = $this->getPost('cm') !="" ? $this->getPost('cm') : 'Contracts';
			
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;		
					
			$this->data["record_data_contract"] = $arr_temp[0];
			$this->data['page_details'] = $arr_temp[1];
			
			$confin_arr= [];
			$year = date('Y');
			for($month=1; $month<=12; $month++)
			{		
				$monthlycontracts = $this->ModuleModel->loadContractsForDashboardGraph($loggedUserId, $month, $year);		
				
				$confin_arr[] = $monthlycontracts;
			}
		
			
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

			$this->viewLoad("dashboard/dashboard_technical");
		}
		else if($role_id==6)   // accounting
		{
			
			$arr_temp = $this->DashboardModel->recentRecordForDashboard($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, 'id', $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date,  $this->getPost('id'));
			$this->data["record_data"] = $arr_temp[0];
		
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
	if($user_role_id == 3 || $user_role_id == 4 || $user_role_id == 8){
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
/*Function to get data for opener and closer*/	
public function getbookings(){
	$user_id = $_POST['user_id'];
	$module_id = $_POST['module_id'];
		$join = array(
	    			array(
	    				'table' => 'anb_crm_record_meta_value b',
	    				'on' => 'a.id = b.record_id',
	    			),
	    			array(
	    				'table' => 'anb_crm_bookings c',
	    				'on' => 'c.record_id = b.record_id' ,
	    			),
		    	);
		$join1 = array(
	    			array(
	    				'table' => 'anb_crm_record_meta_value b',
	    				'on' => 'a.id = b.record_id',
	    			),
		    	);
		if(isset($_POST['monthYear']) && !empty($_POST['monthYear'])){ /*If user select and month and year then execute this*/
			$date =  $_POST['monthYear'].'/01';
			$final = date("Y/m/d", strtotime("+1 month", strtotime($date)));
			if($module_id == 1){ // for leads module
				$totalbooking['confirmbooking'] = $this->App_model->getData('anb_crm_record a','count(a.id) as confirmbooking',array('b.value'=>$user_id, 'c.status' =>1, 'a.module_id'=>1, "c.created_time>="=>$date, "c.created_time<"=>$final), $join);
				//print_r($this->db->last_query());die;
			}
			else{ // for client module
				$totalbooking['confirmbooking'] = $this->App_model->getData('anb_crm_record a','count(b.record_id) as confirmbooking',array('b.value'=>$user_id,  'a.module_id'=>2, "a.created_time>="=>strtotime($date), "a.created_time<"=>strtotime($final), "b.record_meta_id"=>104), $join1);
				//echo $user_id;
				//print_r($this->db->last_query());die;
			}

			$totalbooking['totalbooking'] = $this->App_model->getData('anb_crm_record a','count(a.id) as totalbooking',array('b.value'=>$user_id, 'a.module_id'=>$module_id, "c.created_time>="=>$date, "c.created_time<"=>$final ), $join);
		}
		else{/*If not select then execute this*/
			if($module_id == 1){
				$totalbooking['confirmbooking'] = $this->App_model->getData('anb_crm_record a','count(a.id) as confirmbooking',array('b.value'=>$user_id, 'c.status' =>1, 'a.module_id'=>1), $join);	
			}
			else{
				$totalbooking['confirmbooking'] = $this->App_model->getData('anb_crm_record a','count(b.record_id) as confirmbooking',array('b.value'=>$user_id,'a.module_id'=>2, "b.record_meta_id"=>104), $join1);
				//print_r($this->db->last_query());die;
			}
			$totalbooking['totalbooking'] = $this->App_model->getData('anb_crm_record a','count(a.id) as totalbooking',array('b.value'=>$user_id, 'a.module_id'=>$module_id ), $join);
		}
	/*target of every opener and closer*/
	$totalbooking['target'] = $this->App_model->getData('anb_crm_users_personal_info',' monthly_target as target',array('user_id'=>$user_id));	
	
	echo json_encode($totalbooking);
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
	public function checkDeadleads(){
		 $newdate = date("Y-m-d", strtotime("-1 months"));
		$join = array(
	    			array(
	    				'table' => 'anb_crm_bookings b',
	    				'on' => 'a.record_id = b.record_id' ,
	    			),
		    	);
		$deadLeads = $this->App_model->getData('anb_crm_record_meta_value a',array('a.record_id', 'b.created_time', 'a.value', 'a.record_meta_id'),array('b.module_id'=>1, 'DATE_FORMAT(b.created_time, "%Y-%m-%d") <'=>$newdate, 'a.record_meta_id'=>14, 'a.value !='=>'Cold'), $join);	
			
		if(isset($deadLeads) && !empty($deadLeads)){
			foreach ($deadLeads as $key){
				$this->db->set('value', 'Cold');
				$this->db->where('a.record_id', $key['record_id']);
				$this->db->where('a.record_meta_id', $key['record_meta_id']);
				$this->db->update('anb_crm_record_meta_value a');
				//print_r($this->db->last_query());die;
			}
		}			
	}

	function getTeamUser(){
		
		$team_id=$this->input->post('team_id');

		$data=[];
		
		if(!empty($team_id)){

			foreach ($team_id as $key => $team) {
				
				$result=$this->App_model->getData('anb_crm_teams','*',['id'=>$team]);

				if(!empty($result)){
					$res=json_decode($result[0]['members'],true);
					
					foreach ($res as $key => $value) {

						 $join = array(
						 	 	array(
						 	 		"table" => "anb_crm_users as user",
						 	 		"on" => "up.user_id = user.id"
						 	 	)
						 	 );

						$user=$this->App_model->getData('anb_crm_users_personal_info as up','up.*,user.role_id',['user_id'=>$value],$join);
						
						if(!empty($user))
							$data[]=['id'=>$user[0]['user_id'].','.$user[0]['role_id'],'value'=>$user[0]['first_name'].' '.$user[0]['last_name'],'name'=>$result[0]['name']];
					}
					

				}
				
			}
		}

		echo json_encode($data);die();
	}

	function getAllUser(){
		
		$result=$this->App_model->getData('anb_crm_users','*');

				if(!empty($result)){
					
					foreach ($result as $key => $value) {

						$user=$this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$value['id']]);
						
						if(!empty($user))
							$data[]=['id'=>$user[0]['user_id'].','.$result[$key]['role_id'],'value'=>$user[0]['first_name'].' '.$user[0]['last_name']];
					}
					

		}
		echo json_encode($data);die();
	}

	function chart_comparison(){

		$post=$this->input->post();
        
		$total_data=[];

        $user_data=[];
        $team_data=[];

		foreach ($post['user'] as $key => $value) {
			$user=explode(',',$value);
			$user_data[]=$this->getUserCompareChartData($user[0],$user[1],$post['start_date'],$post['end_date']);
		}
		
		if(!empty($post['team'])){
			
			foreach ($post['team'] as $key => $value) {
				
				$result=$this->App_model->getData('anb_crm_teams','*',['id'=>$value]);

				$target=0;

				if(!empty($result)){
					$res=json_decode($result[0]['members'],true);
					
					foreach ($res as $key => $value) {

						$user=$this->App_model->getData('anb_crm_users_personal_info as up','up.*',['user_id'=>$value]);
						
						$target+=$user[0]['monthly_target'];		
						
					}
				}		
				
				$team_data[]=array('target'=>$target,'name'=>$result[0]['name']);
			}
		}

		$total_data['user']=$user_data;
		$total_data['team']=$team_data;
		echo json_encode($total_data);
		die();
	}

	function getUserCompareChartData($user_id,$user_role_id,$start_date,$end_date){

			$data = array();
			
			$user1ChartLabel=[];
			$user1ChartData=[];
			
			$user_info = $own_data = $this->UserModel->loadUser($user_id);
			//print_r($this->data['selected_user_data']);die();
			$data['charYaxis'] = 'Bookings';

			$period=$this->getAllMonth($start_date,$end_date);

			if($user_role_id == 3 || $user_role_id == 4 || $user_role_id == 8 || $user_role_id == 7 || $user_role_id == 1){
		
				foreach ($period as $dt) {
				    
					$month=$dt->format("m");
					$year=$dt->format("Y");

				    $monthlybookings = $this->BookingModel->loadBookingsForComparison($user_id, $month, $year);
						
					$monthlybookings['target']=$this->BookingModel->loadTarget($user_id, $month, $year);

					$user1_arr[] = $monthlybookings;
					
					$data['charYaxis'] = 'Bookings';
				}

			}elseif ($user_role_id == 5 || $user_role_id == 6) {

				foreach ($period as $dt){

					$month=$dt->format("m");
					$year=$dt->format("Y");

					$monthlycontracts = $this->ModuleModel->loadContractsForDashboardGraph($user_id, $month, $year);

					$monthlycontracts['target']=$this->BookingModel->loadTarget($user_id, $month, $year);

					$user1_arr[] = $monthlycontracts;
				}
				$data['charYaxis'] = 'Contracts';
			}

			if(!empty($user1_arr))
			{
				foreach ($user1_arr as $key => $fin) {
					$user1ChartLabel[] = $fin['label'];
					$user1ChartData[] = $fin['y'];
					$user1ChartTarget[] = $fin['target'];
				}
			}

			$final_array=['label'=>$user1ChartLabel,'data'=>$user1ChartData,'user_info'=>$user_info,'target'=>$user1ChartTarget];

			return $final_array;
	}

	function getMonthDiff($date1,$date2){
		
		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);

		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

		return $diff;
	}

	function getMonth(){
		return array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	}

	function getAllMonth($date1,$date2){
	    $start    = (new DateTime($date1))->modify('first day of this month');
		$end      = (new DateTime($date2))->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		return $period;
	}

	function addtarget(){

		$post=$this->input->post();

		echo '<pre>';
		print_r($post);
		die();

		echo count($post['user_id']);die();

		foreach ($post['user_id'] as $key => $value) {
		
		     $user=explode(',',$value);
			
		     $period=$this->getAllMonth($post['start_date'],$post['end_date']);
		     
		     foreach ($period as $dt){

		     		$date=$dt->format('Y-m-01');

		     		$res=$this->App_model->getData('user_target','*',['month'=>$date]);

		     		$data=array('user_id'=>$user[0],
		     			         'role_id'=>$user[1],
		     			         'month'=>$date,
		     			         'target'=>$post['target'],
		     			         'created_time'=>time(),
		     			     );

		     	  if(empty($res)){
					   $this->App_model->rowInsert('user_target',$data);
				  }else{

				  		unset($data['created_time']);
				  		$data['modified_time']=time();	
				  	   $this->App_model->rowUpdate('user_target',$data,['month'=>$date,'user_id'=>$user[0]]);
				  	   
				  }

		     }
		}

		echo json_encode(array('status'=>'success','msg'=>'successfully added'));die();
	}

	function mass_booking_delete(){
		$ids=$this->input->get('id');
		$ids=str_replace("on,","",$ids);
		$array=explode(',',$ids);
		foreach ($array as $key => $value) {
			$this->App_model->rowsDelete('anb_crm_bookings',['id'=>$value]);
		}
		echo 'success';
	}
	function mass_web_booking_delete(){
		$ids=$this->input->get('id');
		$ids=str_replace("on,","",$ids);
		$array=explode(',',$ids);
		foreach ($array as $key => $value) {
			$this->App_model->rowsDelete('anb_crm_bookings',['id'=>$value]);
			$this->App_model->rowsDelete('anb_crm_web_booking',['booking_id'=>$value]);
		}
		echo 'success';
	}


	 function tests(){

       $loggedUserId = $this->getUserId();
       $role_id = $this->getUserRole();

	    $sLimit = "";
        $lenght = 10;
        $str_point = 0;

        $col_sort = array("r.modified_time","mv.value");

        $where = '';
        $select = array('mv.*,r.id,r.record_status');
        $order_by = "r.id";
        $temp = 'desc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];

        }

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            $where = '( ';
            for ($i = 0; $i < count($col_sort); $i++) {

                $where .= "$col_sort[$i] REGEXP '$words'";

                if ($i + 1 != count($col_sort)) {
                    $where .= " OR ";
                }

            }
            $where .= ') ';
        }
        if ($where != "") {
            $where .= " AND ";
        }
       
        $where .= "(r.module_id = 1 AND r.record_status = 3 and r.modified_by is not null AND mv.record_meta_id = 31 )";
       
        if($role_id==4 or $role_id==3){
        	$where.="and r.modified_by=$loggedUserId";
        }

        $this->db->order_by($order_by, $temp);
        //$this->db->group_by('id');
        $this->db->where($where);
       	$this->db->join('anb_crm_record_meta_value mv','mv.record_id = r.id');

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->db->from('anb_crm_record r')
            		->select('mv.*,r.id,r.record_status')
                    ->limit($lenght, $str_point)
                    ->get();
        } else {
            $records = $this->db->from('anb_crm_record r')
            				->select('mv.*,r.id,r.record_status')
                    ->get();
        }

        $total_record = $this->db->select('mv.*,r.id,r.record_status')
                ->from('anb_crm_record r')
                ->where($where)
                ->join('anb_crm_record_meta_value mv','mv.record_id = r.id')
                ->count_all_results();

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );

        $result = $records->result_array();

        foreach($result as $lead){
            
          $leads_data=$this->ModuleModel->get_modules_data($lead['record_id'],1,true);
                 
          foreach ($leads_data as $key => $value) {
            	$lead["$value->name"]=$value->value;
            	$lead['record_status']=$value->record_status;
            	$lead['modified_time']=$value->modified_time;
            	$lead['activity_user']=ucfirst($value->first_name).' '.ucfirst($value->last_name);
            	$lead['date']=date('m/d/Y H:i', $value->modified_time);
          } 
           
          $res[]=$lead;
        }  
        //echo "<pre>";print_r($res);die;
       if(!empty($res)){
        	
            foreach ($res as $key => $value) {
            	
            $value['Company Website']=isset($value['Company Website'])?$value['Company Website']:''; 

             $value['First Name']=isset($value['First Name'])?$value['First Name']:'';
             $value['Last Name']=isset($value['Last Name'])?$value['Last Name']:''; 
			 $value['Phone']=isset($value['Phone'])?$value['Phone']:''; 
			  $value['City']=isset($value['City'])?$value['City']:'';  
			  $value['Province']=isset($value['Province'])?$value['Province']:'';  
			  $value['Country']=isset($value['Country'])?$value['Country']:'';  
			  $value['Lead Category']=isset($value['Lead Category'])?$value['Lead Category']:'';  
			  $value['Lead Status']=isset($value['Lead Status'])?$value['Lead Status']:'';  
			  $value["Opener's Call Status"]=isset($value["Opener's Call Status"])?$value["Opener's Call Status"]:'';  
			  $value['Opener']=getOpener($value['record_id']); 
			  $value['Closer']=getCloser($value['record_id']);  
			  
			  $output['aaData'][] = array('','<a style="font-weight: bold;" href="'. base_url() .'/modules/viewRecord/?cm=Leads&id='. $value["record_id"] .'&record_status='. $value["record_status"].'">'. $value["Company Name"] .'</a>'
					,$value['First Name']
					,$value['Last Name']
					,$value['Phone']
					,$value['City']
					,$value['Province']
					,$value['Country']
					,$value['Lead Category']
					,$value['Lead Status']
					,$value["Opener's Call Status"]
 					,$value['Opener']
					,$value['Closer']
					,$value["activity_user"]
					,$value["date"]
					);	
	        	
	        }
        }

        echo json_encode($output);die();
	}
	
	public function recentWebBookings()
	{	
				 $this->db->from('anb_crm_web_booking wb');
		 		 $this->db->join('anb_crm_bookings b','b.id=wb.booking_id');
		 		 $this->db->order_by("b.id", "desc");
		 $query = $this->db->get();
		 $data = $query->result_array();

		$new_data=array();
		foreach ($data as $value) {

                                    

			$value['checkbox'] = '<label style="cursor:pointer;"><input type="checkbox" value="'.$value['booking_id'].'" id="'.$value['booking_id'].'" style="position:absolute; opacity:0;" />
                 <span class="input-checkbox-icon" style="left:20px; margin:0 6px 6px 0;"></span></label>';

            $class='no-reminder';
            $classCount='no-reminder-count';
            if( getRemBookingCount($value['booking_id']) > 0){
                  $class='';
                  $classCount='';  
            }
            $value['remainder'] ='<a class="reminder-btn rem-booking '.$class.'" company_name="'.$value['name'].'" record_id='. $value['booking_id'] .' id="reminders" href="javascript:void(0);" title="Reminders" ><i class="fa fa-clock-o"></i><span class="reminder-count '.$classCount .'" id="reminder-count-'.$value['booking_id'].'">'.getRemBookingCount($value['booking_id']).'</span></a>';    

			if($value['lead_status'] == 1)
			{
			  $value['status'] ='<span style="padding:6px" class="alert-success">Converted</span>';
			}else{
			  $value['status'] ='<span style="padding:6px" class="alert-danger">Research</span>';
			}
		    $title = !empty($value['booking_title']) ? $value['booking_title'] : '-' ;

		    if(!empty($value['record_id'])){
		    	
		    	$value['title'] = '<a href="#" class="book-href booking_details" data-toggle="modal" data-value='.$value['id'].'  data-target="#fullCalModal">'.$title.'</a>';
		    }else{

				$value['title'] = "<a class='book-href rec-web-book' href='javascript:void' lead-status=".$value['lead_status']." data-id=".$value['booking_id'].">".$title."</a>";
		    }

			$value['start_time'] =  !empty($value['start_time']) ? date("m/d/Y H:i", strtotime($value['start_time'])) : '-';
			$value['company_name'] = !empty($value['company_name']) ? $value['company_name'] : '-';
			$value['name'] = !empty($value['name']) ? $value['name'] : '-';
			$value['phone'] = !empty($value['phone']) ? $value['phone'] : '-';
			$value['email'] = !empty($value['email']) ? $value['email'] : '-';
			$value['city'] = !empty($value['city']) ? $value['city'] : '-';
			$value['state'] = !empty($value['state']) ? $value['state'] : '-';
			$value['country'] = !empty($value['country']) ? $value['country'] : '-';
			$value['opener'] = !empty(getOpener($value['record_id'])) ? getOpener($value['record_id']) : '-';
			$value['closer'] = !empty(getCloser($value['record_id'])) ? getCloser($value['record_id']) : '-';  
			$value['last_modified'] = !empty($value['modified_time']) ? date("m/d/Y H:i", strtotime($value['modified_time'])) : '-';

			 $u_id = !empty($value['modified_by']) ? $value['modified_by'] : '-';
			 $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			 $value['last_modified_by'] = $user[0]['first_name']." ".$user[0]['last_name'];

			   $this->db->where('record_id',$value['record_id']);	
	        $query = $this->db->get("anb_crm_note");
	        $note_result = $query->result_array();
	        $notes = [];	
        	foreach ($note_result as $x) {

        		 $u_id = !empty($x['created_by']) ? $x['created_by'] : '-';
			     $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			     $name = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

        		 $notes[] = "<div class='dtnotes'>".$x['note']." <strong>".date("m/d/Y H:i", strtotime($x['created_time']))." by ".$name."</strong></div><br>";
        	}
 			 $value['notes'] = $notes;

			$new_data[]=$value;
		}

	  $result = ["sEcho" => 1,
          "iTotalRecords" => count($new_data),
          "iTotalDisplayRecords" => count($new_data),
          "aaData" => $new_data ];

		echo json_encode($result);
		die();
	}
	public function recentBookings()
	{	
	   $loggedUserId = $this->getUserId();
       $role_id = $this->getUserRole();
        if($role_id==4 or $role_id==3){
        	$select = 'c.assigned_officer_id,';
		   $this->db->where('c.assigned_officer_id',$loggedUserId);	
		   $this->db->join('anb_crm_record c','b.record_id=c.id');
        }else{
        	$select = '';
        }

		$this->db->where('record_meta_id',31);
		$this->db->where('web_booking',0);	
		$this->db->select(''.$select.'b.all_day,b.praposed_date,b.id,b.record_id,mv.record_meta_id,b.booking_title,b.status,mv.value,b.email,b.name,b.modified_by,b.modified_time,b.booking_date');
        $this->db->join('anb_crm_record_meta_value mv','b.record_id=mv.record_id','left');
        $this->db->order_by("b.id", "desc");
        $query = $this->db->get("anb_crm_bookings b");
        $data = $query->result_array();

        // echo $this->db->last_query();
        // echo "<pre>";print_r($data);die("test");

      
		$new_data=array();
		foreach ($data as $value) {

					     $this->db->where('record_id',$value['record_id']);	
					     $this->db->where('record_meta_id',32);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $phone = $data[0]['value']; 

                $this->db->where('record_id',$value['record_id']);	
					     $this->db->where('record_meta_id',35);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $city = $data[0]['value']; 

                $this->db->where('record_id',$value['record_id']);	
					     $this->db->where('record_meta_id',37);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $country = $data[0]['value']; 

                $this->db->where('record_id',$value['record_id']);	
					     $this->db->where('record_meta_id',40);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $state = $data[0]['value'];         

			$value['checkbox'] = '<label style="cursor:pointer;"><input type="checkbox" value="'.$value['id'].'" id="'.$value['id'].'" style="position:absolute; opacity:0;" />
                 <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span></label>';

            $class='no-reminder';
            $classCount='no-reminder-count';
            if( getRemBookingCount($value['id']) > 0){
                  $class='';
                  $classCount='';  
            }
            $value['remainder'] ='<a class="reminder-btn rem-booking '.$class.'" company_name="'.$value['value'].'" record_id='. $value['id'] .' id="reminders" href="javascript:void(0);" title="Reminders" ><i class="fa fa-clock-o"></i><span class="reminder-count '.$classCount .'" id="reminder-count-'.$value['id'].'">'.getRemBookingCount($value['id']).'</span></a>';    


			       if($value['status'] == 1){
                        $value['status'] ='<span class="alert-success">Confirmed</span>';
                    }else if($value['status'] == 2 && $value['praposed_date'] == '0000-00-00 00:00:00'){
                        $value['status'] ='<span class="alert-danger">Cancelled</span>';
                    }else if($value['status'] == 2 && $value['praposed_date'] != '0000-00-00 00:00:00'){
                        $value['status'] ='<span class="alert-warning" title="Suggested Time: '.$value['praposed_date'].'">Time Suggested</span>';
                    }else{
                        $value['status'] ='<span class="alert-info">Awaiting</span>';
                    }

		    $title = !empty($value['booking_title']) ? $value['booking_title'] : '-' ;
		    $value['title'] = '<a href="#" class="book-href booking_details" data-toggle="modal" data-value='.$value['id'].'  data-target="#fullCalModal">'.$title.'</a>';

		     if($value['all_day'] == 1)
                    { 
                         $value['start_time'] = !empty($value['booking_date']) && $value['booking_date'] > 0 ? date("m/d/Y", strtotime($value['booking_date'])) : '-';
                     }else
                     {
                         $value['start_time'] = !empty($value['booking_date']) && $value['booking_date'] > 0 ? date("m/d/Y H:i ", strtotime($value['booking_date'])) : '-';
                     }

			$value['company_name'] = !empty($value['value']) ? $value['value'] : '-';
			$value['name'] = !empty($value['name']) ? $value['name'] : '-';
			$value['phone'] = !empty($phone) ? $phone : '-';
			$value['email'] = !empty($value['email']) ? $value['email'] : '-';
			$value['city'] = !empty($city) ? $city : '-';
			$value['state'] = !empty($state) ? $state : '-';
			$value['country'] = !empty($country) ? $country : '-';
			$value['opener'] = !empty(getOpener($value['record_id'])) ? getOpener($value['record_id']) : '-';
			$value['closer'] = !empty(getCloser($value['record_id'])) ? getCloser($value['record_id']) : '-';  
			$value['last_modified'] = !empty($value['modified_time']) ? date("m/d/Y H:i", strtotime($value['modified_time'])) : '-';

			 $u_id = !empty($value['modified_by']) ? $value['modified_by'] : '-';
			 $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			 $value['last_modified_by'] = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

			    $this->db->where('record_id',$value['record_id']);	
	        $query = $this->db->get("anb_crm_note");
	        $note_result = $query->result_array();
	        $notes = [];	
        	foreach ($note_result as $x) {

        		 $u_id = !empty($x['created_by']) ? $x['created_by'] : '-';
			     $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			     $name = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

        		 $notes[] = "<div class='dtnotes'>".$x['note']." <strong>".date("m/d/Y H:i", strtotime($x['created_time']))." by ".$name."</strong></div><br>";
        	}
 			 $value['notes'] = $notes;


			$new_data[]=$value;
		}

	  $result = ["sEcho" => 1,
          "iTotalRecords" => count($new_data),
          "iTotalDisplayRecords" => count($new_data),
          "aaData" => $new_data ];

		echo json_encode($result);
		die();
	}

	public function hot_and_dead_leads($con,$status)
	{	
	   $loggedUserId = $this->getUserId();
       $role_id = $this->getUserRole();
        if($role_id==4 or $role_id==3){
		   $this->db->where('assigned_officer_id',$loggedUserId);	
        }

		$this->db->where('b.record_meta_id',14);	
		$this->db->where('module_id',1);	
		$this->db->where('record_status',$status);	
		$this->db->where('b.value',$con);
		$this->db->where('c.record_meta_id',31);    
	    $this->db->where('d.record_meta_id',1); 
        $this->db->where('e.record_meta_id',2); 
        $this->db->where('f.record_meta_id',32); 
        $this->db->where('g.record_meta_id',35); 
        $this->db->where('h.record_meta_id',40); 
        $this->db->where('i.record_meta_id',37); 
        $this->db->where('j.record_meta_id',6); 
        $this->db->where('k.record_meta_id',27); 

		$this->db->select('a.record_status,a.id,b.value,a.module_id,a.modified_by,a.modified_time,c.value as c_name,d.value as f_name,e.value as l_name,f.value as phone,g.value as city,h.value as state,i.value as country,j.value as lead_status,k.value as call_status');
        $this->db->join('anb_crm_record_meta_value b','a.id=b.record_id');
		$this->db->join("anb_crm_record_meta_value c","a.id=c.record_id","left");
		$this->db->join("anb_crm_record_meta_value d","a.id=d.record_id","left");
		$this->db->join("anb_crm_record_meta_value e","a.id=e.record_id","left");
		$this->db->join("anb_crm_record_meta_value f","a.id=f.record_id","left");
		$this->db->join("anb_crm_record_meta_value g","a.id=g.record_id","left");
		$this->db->join("anb_crm_record_meta_value h","a.id=h.record_id","left");
		$this->db->join("anb_crm_record_meta_value i","a.id=i.record_id","left");
		$this->db->join("anb_crm_record_meta_value j","a.id=j.record_id","left");
		$this->db->join("anb_crm_record_meta_value k","a.id=k.record_id","left");
        $this->db->order_by("a.id", "desc");
        $query = $this->db->get("anb_crm_record a");
        $data = $query->result_array();

        // echo $this->db->last_query();
        // echo "<pre>";print_r($data);
        // die("ok");

		$new_data=array();
		foreach ($data as $value) {

			$value['checkbox'] = '<label style="cursor:pointer;"><input type="checkbox" value="'.$value['id'].'" id="'.$value['id'].'" style="position:absolute; opacity:0;" />
                 <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span></label>';

            $company_name = !empty($value['c_name']) ? $value['c_name'] : '-';
            $value['company_name'] = '<a style="color: grey;font-weight: bold;" href="'. base_url().'modules/viewRecord/?cm=Leads&id='.$value['id'].'&record_status='.$value['record_status'].'" class="company-name">'.$company_name.'</a>';    

            $class='no-reminder';
            $classCount='no-reminder-count';
            if( getRemBookingCount($value['id']) > 0){
                  $class='';
                  $classCount='';  
            }


            $value['remainder'] ='<a class="reminder-btn rem-booking '.$class.'" company_name="'.$company_name.'" record_id='. $value['id'] .' id="reminders" href="javascript:void(0);" title="Reminders" ><i class="fa fa-clock-o"></i><span class="reminder-count '.$classCount .'" id="reminder-count-'.$value['id'].'">'.getRemBookingCount($value['id']).'</span></a>';    

		  
			$value['first_name'] = !empty($value['f_name']) ? $value['f_name'] : '-';
			$value['last_name'] = !empty($value['l_name']) ? $value['l_name'] : '-';

			$value['phone'] = !empty($value['phone']) ? $value['phone'] : '-';
			$value['city'] = !empty($value['city']) ? $value['city'] : '-';
			$value['state'] = !empty($value['state']) ? $value['state'] : '-';
			$value['country'] = !empty($value['country']) ? $value['country'] : '-';
			
			$value['category'] = !empty($value['value']) ? "<span>".$value['value']."</span>" : '-';

			$value['lead_status'] = !empty($value['lead_status']) ? $value['lead_status'] : '-';
			$value['call_satus'] = !empty($value['call_status']) ? $value['call_status'] : '-';


			$value['opener'] = !empty(getOpener($value['id'])) ? getOpener($value['id']) : '-';
			$value['closer'] = !empty(getCloser($value['id'])) ? getCloser($value['id']) : '-';  

			$value['last_modified'] = !empty($value['modified_time']) ? date("m/d/Y H:i", strtotime($value['modified_time'])) : '-';

			 $u_id = !empty($value['modified_by']) ? $value['modified_by'] : '-';
			 $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			 $value['last_modified_by'] = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

             $this->db->where('record_id',$value['id']);	
	        $query = $this->db->get("anb_crm_note");
	        $note_result = $query->result_array();
	        $notes = [];	
        	foreach ($note_result as $x) {

        		 $u_id = !empty($x['created_by']) ? $x['created_by'] : '-';
			     $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			     $name = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

        		 $notes[] = "<div class='dtnotes'>".$x['note']." <strong>".date("m/d/Y H:i", strtotime($x['created_time']))." by ".$name."</strong></div><br>";
        	}
 			 $value['notes'] = $notes;

			 $value['action'] = "action";

			if($value['value']=='Hot'){
                           
               $value['action']= '<a style="color:white;" href="#modalFollow" id="unfollow_id" class="btn btn-round btn-fill-theme" data-record ='.$value['id'].'><i class="icon-crm-user-plus"></i> Unfollow </a>';
                } else{    
               $value['action'] = '<a  href="#modalFollow" id="follow_id" class="btn btn-round btn-fill-theme" data-record ='.$value['id'].' ><i class="icon-crm-user-plus"></i> Follow </a>';  
                  }


			$new_data[]=$value;
		}

	  $result = ["sEcho" => 1,
          "iTotalRecords" => count($new_data),
          "iTotalDisplayRecords" => count($new_data),
          "aaData" => $new_data ];

       return $result;  
		// echo json_encode($result);
		// die();
	}

	public function xhot_and_dead_leads($con,$status)
	{	
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if(!empty($order))
        {
             foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

       
        $valid_columns = array(
            2=>'d.value',
            3=>'b.value', 
            4=>'c.value',
            5=>'f.value',
            6=>'g.value',
            7=>'h.value',
            8=>'i.value',
            9=>'aa.value',
            10=>'j.value',
            11=>'k.value',
            12=>'m1.first_name',
            13=>'l1.first_name',
            14=>'a.modified_time',
            15=>'n.first_name',
            16=>'l1.last_name',
            17=>'m1.last_name',
            18=>'n.last_name'

        );
        
        if(!isset($valid_columns[$col]))
        {   $order = null; }
        else
        {  $order = $valid_columns[$col]; }

        if($order !=null)
        { $this->db->order_by($order, $dir); }

       $loggedUserId = $this->getUserId();
       $role_id = $this->getUserRole();
        if($role_id==4 or $role_id==3){
		   $this->db->where('a.assigned_officer_id',$loggedUserId);	
        }
        
        if(!empty($search))
        {
            //$x=0;
            $where = '( ';
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                 $where .=" $sterm LIKE '%$search%'";
                }
                else
                {
                 $where .=" OR  $sterm LIKE '%$search%'";
               }
                $x++;
            }      

            $where .= ') ';
         $this->db->where($where); 
        }

        $this->db->limit($length,$start);

		$m_where = array('aa.record_meta_id'=>14,'a.module_id'=>1,'a.record_status'=>$status,'aa.value'=>$con,'b.record_meta_id'=>1,'c.record_meta_id'=>2,'d.record_meta_id'=>31,'f.record_meta_id'=>32,'g.record_meta_id'=>35,'h.record_meta_id'=>40,'i.record_meta_id'=>37,'j.record_meta_id'=>6,'k.record_meta_id'=>27,'l.record_meta_id'=>21,'m.record_meta_id'=>22);	 
		 $this->db->where($m_where);	

        $select = "a.id,a.assigned_officer_id,a.module_id,a.record_status,a.modified_by,a.modified_time,aa.value as category,b.value as fname,c.value as lname,d.value as c_name, f.value as phone,g.value as city,h.value as state,i.value as country,j.value as lead_status,k.value as call_status,l.value as closerId,m.value as openerId,l1.first_name as closer_fname,l1.last_name as closer_lname,m1.first_name as opener_fname,m1.last_name as opener_lname,n.first_name as modify_fname,n.last_name as modify_lname";

 		$this->db->select($select);

 $this->db->join("anb_crm_record_meta_value aa","a.id=aa.record_id","left");
   $this->db->join("anb_crm_record_meta_value b","a.id=b.record_id","left");
   $this->db->join("anb_crm_record_meta_value c","a.id=c.record_id","left");
   $this->db->join("anb_crm_record_meta_value d","a.id=d.record_id","left");
   $this->db->join("anb_crm_record_meta_value f","a.id=f.record_id","left");
   $this->db->join("anb_crm_record_meta_value g","a.id=g.record_id","left");
   $this->db->join("anb_crm_record_meta_value h","a.id=h.record_id","left");
   $this->db->join("anb_crm_record_meta_value i","a.id=i.record_id","left");
   $this->db->join("anb_crm_record_meta_value j","a.id=j.record_id","left");
   $this->db->join("anb_crm_record_meta_value k","a.id=k.record_id","left");
   $this->db->join("anb_crm_record_meta_value l","a.id=l.record_id","left");
   $this->db->join("anb_crm_record_meta_value m","a.id=m.record_id","left");
   $this->db->join("anb_crm_users_personal_info l1","l.value=l1.user_id","left");
   $this->db->join("anb_crm_users_personal_info m1","m.value=m1.user_id","left");
   $this->db->join("anb_crm_users_personal_info n","a.modified_by=n.user_id","left");


        $employees = $this->db->get("anb_crm_record a");
        $total_employees = $employees->num_rows();
        $result = $employees->result();

// echo $this->db->last_query();
// //echo "<pre>";print_r($rows);
// 	die("ok");

        $data = array();
        foreach($employees->result() as $rows)
        {

            $company_name = !empty($rows->c_name) ? $rows->c_name : '-';

            $class='no-reminder';
            $classCount='no-reminder-count';
            if( getRemBookingCount($rows->id) > 0){
                  $class='';
                  $classCount='';  
            }
			$first_name = !empty($rows->fname) ? $rows->fname : '-';
			$last_name = !empty($rows->lname) ? $rows->lname : '-';
			$phone = !empty($rows->phone) ? $rows->phone : '-';
			$city = !empty($rows->city) ? $rows->city : '-';
			$state = !empty($rows->state) ? $rows->state : '-';
			$country = !empty($rows->country) ? $rows->country : '-';
			$lead_status = !empty($rows->lead_status) ? $rows->lead_status : '-';
			$call_satus = !empty($rows->call_status) ? $rows->call_status : '-';
			$oname = $rows->opener_fname .' '. $rows->opener_lname;
			$opener = !empty($oname) ? $oname : '-';
			$cname = $rows->closer_fname .' '. $rows->closer_lname;
			$closer = !empty($cname) ? $cname : '-';  
			$last_modified = !empty($rows->modified_time) ? date("m/d/Y H:i", strtotime($rows->modified_time)) : '-';
			$mname = $rows->modify_fname .' '. $rows->modify_lname;
			$last_modified_by = !empty($mname) ? $mname : '-' ;

            $this->db->where('record_id',$rows->id);	
	        $query = $this->db->get("anb_crm_note");
	        $note_result = $query->result_array();
	        $notes = [];	
        	foreach ($note_result as $x) {

        		 $u_id = !empty($x['created_by']) ? $x['created_by'] : '-';
			     $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			     $name = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

        		 $notes[] = "<div class='dtnotes'>".$x['note']." <strong>".date("m/d/Y H:i", strtotime($x['created_time']))." by ".$name."</strong></div><br>";
        	}
 			 $note = $notes;

			if($rows->category=='Hot'){
                           
               $action= '<a style="color:white;" href="#modalFollow" id="unfollow_id" class="btn btn-round btn-fill-theme" data-record ='.$rows->id.'><i class="icon-crm-user-plus"></i> Unfollow </a>';
                } else{    
               $action = '<a  href="#modalFollow" id="follow_id" class="btn btn-round btn-fill-theme" data-record ='.$rows->id.' ><i class="icon-crm-user-plus"></i> Follow </a>';  
                  }

            
        $data[]= array(

             '<label style="cursor:pointer;"><input type="checkbox" value="'.$rows->id.'" id="'.$rows->id.'" style="position:absolute; opacity:0;" />
                 <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span></label>',

            '<a class="reminder-btn rem-booking '.$class.'" company_name="'.$company_name.'" record_id='. $rows->id .' id="reminders" href="javascript:void(0);" title="Reminders" ><i class="fa fa-clock-o"></i><span class="reminder-count '.$classCount .'" id="reminder-count-'.$rows->id.'">'.getRemBookingCount($rows->id).'</span></a>',   

            '<a style="color: grey;font-weight: bold;" href="'. base_url().'modules/viewRecord/?cm=Leads&id='.$rows->id.'&record_status='.$rows->record_status.'" class="company-name">'.$company_name.'</a>',   
            $first_name,
            $last_name,
		 	$phone,
			$city,
			$state,
			$country,
			$rows->category,
			$lead_status,
			$call_satus,
			$opener,
			$closer,
			$last_modified,
			$last_modified_by,
			$note,
			$action
		);     
     }

// for filter 
        if($role_id==4 or $role_id==3){
		   $this->db->where('a.assigned_officer_id',$loggedUserId);	
        }   
        if(!empty($search))
        { $x=0; $where = '( '; foreach($valid_columns as $sterm){ if($x==0)
        { $where .=" $sterm LIKE '%$search%'"; }else{ $where .=" OR  $sterm LIKE '%$search%'"; } $x++; } $where .= ') '; $this->db->where($where); }
		$this->db->where($m_where);	      
		$this->db->select($select);

 $this->db->join("anb_crm_record_meta_value aa","a.id=aa.record_id","left");
   $this->db->join("anb_crm_record_meta_value b","a.id=b.record_id","left");
   $this->db->join("anb_crm_record_meta_value c","a.id=c.record_id","left");
   $this->db->join("anb_crm_record_meta_value d","a.id=d.record_id","left");
   $this->db->join("anb_crm_record_meta_value f","a.id=f.record_id","left");
   $this->db->join("anb_crm_record_meta_value g","a.id=g.record_id","left");
   $this->db->join("anb_crm_record_meta_value h","a.id=h.record_id","left");
   $this->db->join("anb_crm_record_meta_value i","a.id=i.record_id","left");
   $this->db->join("anb_crm_record_meta_value j","a.id=j.record_id","left");
   $this->db->join("anb_crm_record_meta_value k","a.id=k.record_id","left");
   $this->db->join("anb_crm_record_meta_value l","a.id=l.record_id","left");
   $this->db->join("anb_crm_record_meta_value m","a.id=m.record_id","left");
   $this->db->join("anb_crm_users_personal_info l1","l.value=l1.user_id","left");
   $this->db->join("anb_crm_users_personal_info m1","m.value=m1.user_id","left");
   $this->db->join("anb_crm_users_personal_info n","a.modified_by=n.user_id","left");
        $x = $this->db->get("anb_crm_record a");
        $total_employeesx = $x->num_rows();
   
//for filter end    

        $result = array(
            "draw" => $draw,
            "recordsTotal" => $total_employees,
            "recordsFiltered" => $total_employeesx,
            "data" => $data
        );
       
       return $result;  
		// echo json_encode($result);
		// die();
	}

	public function hot_leads()
	{	
		$con = "hot";
		$status = 3;

		$result = $this->xhot_and_dead_leads($con,$status);
		echo json_encode($result);
		die();
	}

	public function hot_leads_archived()
	{	
		$con = "hot";
		$status = 1;
		$result = $this->xhot_and_dead_leads($con,$status);
		echo json_encode($result);
		die();
	}
	
	public function dead_leads()
	{	
		$con = "dead";
		$status = 3;
		$result = $this->xhot_and_dead_leads($con,$status);
		echo json_encode($result);
		die();
	}
	
	public function dead_leads_archived()
	{	
		$con = "dead";
		$status = 1;
		$result = $this->xhot_and_dead_leads($con,$status);
		echo json_encode($result);
		die();
	}


	public function hot_clients_and_archived($status)
	{	
	  
	   $loggedUserId = $this->getUserId();
       $role_id = $this->getUserRole();
        if($role_id==4 or $role_id==3){
		   $this->db->where('assigned_officer_id',$loggedUserId);	
        }

		$this->db->where('record_meta_id',95);	
		$this->db->where('module_id',2);	
		$this->db->where('record_status',$status);	
		$this->db->where('value','hot');	
		$this->db->select('a.record_status,a.id,b.value,a.module_id,a.modified_by,a.modified_time');
        $this->db->join('anb_crm_record_meta_value b','a.id=b.record_id');
        $this->db->order_by("a.id", "desc");
        $query = $this->db->get("anb_crm_record a");
        $data = $query->result_array();

        // echo $this->db->last_query();
        // echo "<pre>";print_r($data);
        // die;

		$new_data=array();
		foreach ($data as $value) {

					     $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',109);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $phone = $data[0]['value']; 

                		 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',112);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $city = $data[0]['value'];

               			 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',117);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $state = $data[0]['value'];         

               			 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',114);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $country = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',108);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $company_name = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',184);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $f_name = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',183);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $l_name = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',87);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $client_status = $data[0]['value']; 

     //             $this->db->where('record_id',$value['id']);	
					//      $this->db->where('record_meta_id',27);			
 				// $query = $this->db->get("anb_crm_record_meta_value");
     //   		 	$data = $query->result_array();
     //            $call_status = $data[0]['value']; 


			$value['checkbox'] = '<label style="cursor:pointer;"><input type="checkbox" value="'.$value['id'].'" id="'.$value['id'].'" style="position:absolute; opacity:0;" />
                 <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span></label>';

            $class='no-reminder';
            $classCount='no-reminder-count';
            if( getRemBookingCount($value['id']) > 0){
                  $class='';
                  $classCount='';  
            }

			$company_name = !empty($company_name) ? $company_name : '-';
            $value['company_name'] =  '<a style="color: grey;font-weight: bold;" href="'. base_url().'modules/viewRecord/?cm=Clients&id='.$value['id'].'&record_status='.$value['record_status'].'" class="company-name">'.$company_name.'</a>';


            $value['remainder'] ='<a class="reminder-btn rem-booking '.$class.'" company_name="'.$company_name.'" record_id='. $value['id'] .' id="reminders" href="javascript:void(0);" title="Reminders" ><i class="fa fa-clock-o"></i><span class="reminder-count '.$classCount .'" id="reminder-count-'.$value['id'].'">'.getRemBookingCount($value['id']).'</span></a>';    

		  
			$value['first_name'] = !empty($f_name) ? $f_name : '-';
			$value['last_name'] = !empty($l_name) ? $l_name : '-';

			$value['phone'] = !empty($phone) ? $phone : '-';
			$value['city'] = !empty($city) ? $city : '-';
			$value['state'] = !empty($state) ? $state : '-';
			$value['country'] = !empty($country) ? $country : '-';
			
			$value['category'] = !empty($value['value']) ? "<span>".$value['value']."</span>" : '-';

			$value['client_status'] = !empty($client_status) ? $client_status : '-';
			//$value['call_satus'] = !empty($call_status) ? $call_status : '-';


			$value['opener'] = !empty(getOpener($value['id'])) ? getOpener($value['id']) : '-';
			$value['closer'] = !empty(getCloser($value['id'])) ? getCloser($value['id']) : '-';  

			$value['last_modified'] = !empty($value['modified_time']) ? date("m/d/Y H:i", strtotime($value['modified_time'])) : '-';

			 $u_id = !empty($value['modified_by']) ? $value['modified_by'] : '-';
			 $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			 $value['last_modified_by'] = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

             $this->db->where('record_id',$value['id']);	
	        $query = $this->db->get("anb_crm_note");
	        $note_result = $query->result_array();
	        $notes = [];	
        	foreach ($note_result as $x) {

        		 $u_id = !empty($x['created_by']) ? $x['created_by'] : '-';
			     $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			     $name = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

        		 $notes[] = "<div class='dtnotes'>".$x['note']." <strong>".date("m/d/Y H:i", strtotime($x['created_time']))." by ".$name."</strong></div><br>";
        	}
 			 $value['notes'] = $notes;
			 $value['action'] = "action";

			if($value['value']=='Hot'){
                           
               $value['action']= '<a style="color:white;" href="#modalFollow" id="unfollow_id" class="btn btn-round btn-fill-theme" data-record ='.$value['id'].'><i class="icon-crm-user-plus"></i> Unfollow </a>';
                } else{    
               $value['action'] = '<a  href="#modalFollow" id="follow_id" class="btn btn-round btn-fill-theme" data-record ='.$value['id'].' ><i class="icon-crm-user-plus"></i> Follow </a>';  
                  }


			$new_data[]=$value;
		}

	  $result = ["sEcho" => 1,
          "iTotalRecords" => count($new_data),
          "iTotalDisplayRecords" => count($new_data),
          "aaData" => $new_data ];

       return $result;  
		 
	}
	public function hot_clients()
	{	
		$status = 3;
		$result = $this->hot_clients_and_archived($status);
		echo json_encode($result);
		die();
	}
	public function hot_clients_archived()
	{	
		$status = 1;
		$result = $this->hot_clients_and_archived($status);
		echo json_encode($result);
		die();
	}


	public function hot_contracts_and_archived($status)
	{	

	   $loggedUserId = $this->getUserId();
       $role_id = $this->getUserRole();
        if($role_id==4 or $role_id==3){
		   $this->db->where('assigned_officer_id',$loggedUserId);	
        }

	  	$this->db->where('b.record_meta_id',161);
		$this->db->where('c.record_meta_id',95);		
		$this->db->where('module_id',3);	
		$this->db->where('record_status',$status);	
		$this->db->where('c.value','hot');	
		$this->db->select('a.record_status,a.id, b.value as client_id,modified_by, a.modified_time,b.record_meta_id as f1,c.record_meta_id as f2,c.value as datas ');
        $this->db->join('anb_crm_record_meta_value b','a.id=b.record_id');
        $this->db->join('anb_crm_record_meta_value c','b.value=c.record_id');

        $this->db->order_by("a.id", "desc");
        $query = $this->db->get("anb_crm_record a");
        $data = $query->result_array();

        // echo $this->db->last_query();
        // echo "<pre>";print_r($data);
        //  die;

		$new_data=array();
		foreach ($data as $value) {

					     $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',164);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $sign_rate = $data[0]['value']; 

                		 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',163);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $service_type = $data[0]['value'];

               			 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',165);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $contract_number = $data[0]['value'];         

               			 $this->db->where('record_id',$value['client_id']);	
					     $this->db->where('record_meta_id',185);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $master_contract_number = $data[0]['value']; 

                 $this->db->where('record_id',$value['client_id']);	
					     $this->db->where('record_meta_id',108);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $company_name = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',168);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $close_date = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',0);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $assign_date = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',0);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $contract_status = $data[0]['value']; 

                 $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',0);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $call_status = $data[0]['value']; 

                  $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',169);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $technical_consultant = $data[0]['value']; 

                  $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',177);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $technical_start_date = $data[0]['value']; 

                       $this->db->where('record_id',$value['id']);	
					     $this->db->where('record_meta_id',0);			
 				$query = $this->db->get("anb_crm_record_meta_value");
       		 	$data = $query->result_array();
                $completed_date = $data[0]['value']; 


			$value['checkbox'] = '<label style="cursor:pointer;"><input type="checkbox" value="'.$value['id'].'" id="'.$value['id'].'" style="position:absolute; opacity:0;" />
                 <span class="input-checkbox-icon" style="left:4px; margin:0 6px 6px 0;"></span></label>';

            $class='no-reminder';
            $classCount='no-reminder-count';
            if( getRemBookingCount($value['id']) > 0){
                  $class='';
                  $classCount='';  
            }

			$company_name = !empty($company_name) ? $company_name : '-';
            $value['company_name'] = '<a style="color: grey;font-weight: bold;" href="'. base_url().'modules/viewRecord/?cm=Contracts&id='.$value['id'].'&record_status='.$value['record_status'].'" class="company-name">'.$company_name.'</a>';

            

            $value['remainder'] ='<a class="reminder-btn rem-booking '.$class.'" company_name="'.$company_name.'" record_id='. $value['id'] .' id="reminders" href="javascript:void(0);" title="Reminders" ><i class="fa fa-clock-o"></i><span class="reminder-count '.$classCount .'" id="reminder-count-'.$value['id'].'">'.getRemBookingCount($value['id']).'</span></a>';    

		  
			$value['master_contract_number'] = !empty($master_contract_number) ? $master_contract_number : '-';
			$value['contract_number'] = !empty($contract_number) ? $contract_number : '-';

			$value['service_type'] = !empty($service_type) ? $service_type : '-';
			$value['signing_rate'] = !empty($sign_rate) ? $sign_rate : '-';
			$value['closing_date'] = !empty($close_date) ? $close_date : '-';
			$value['assigning_date'] = !empty($assign_date) ? $assign_date : '-';
			
			$value['category'] = !empty($value['datas']) ? "<span>".$value['datas']."</span>" : '-';

			$value['contract_status'] = !empty($contract_status) ? $contract_status : '-';
			$value['call_status'] = !empty($call_status) ? $call_status : '-';
			$value['closer'] = !empty(getCloser($value['client_id'])) ? getCloser($value['client_id']) : '-'; 

			$value['technical_consultant'] = !empty($call_status) ? $call_status : '-';
			$value['technical_start_date'] = !empty($technical_start_date) ? date("m/d/Y H:i", strtotime($technical_start_date)) : '-';
			$value['complete_date'] = !empty($completed_date) ? date("m/d/Y H:i", strtotime($completed_date)) : '-';

			$value['last_modified'] = !empty($value['modified_time']) ? date("m/d/Y H:i", strtotime($value['modified_time'])) : '-';

			 $u_id = !empty($value['modified_by']) ? $value['modified_by'] : '-';
			 $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			 $value['last_modified_by'] = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

             $this->db->where('record_id',$value['id']);	
	        $query = $this->db->get("anb_crm_note");
	        $note_result = $query->result_array();
	        $notes = [];	
        	foreach ($note_result as $x) {

        		 $u_id = !empty($x['created_by']) ? $x['created_by'] : '-';
			     $user = $this->App_model->getData('anb_crm_users_personal_info','*',['user_id'=>$u_id]);
			     $name = !empty($user) ? $user[0]['first_name']." ".$user[0]['last_name'] : '-' ;

        		 $notes[] = "<div class='dtnotes'>".$x['note']." <strong>".date("m/d/Y H:i", strtotime($x['created_time']))." by ".$name."</strong></div><br>";
        	}
 			 $value['notes'] = $notes;
			 // $value['action'] = "action";

			// if($value['value']=='Hot'){
                           
   //             $value['action']= '<a style="color:white;" href="#modalFollow" id="unfollow_id" class="btn btn-round btn-fill-theme" data-record ='.$value['id'].'><i class="icon-crm-user-plus"></i> Unfollow </a>';
   //              } else{    
   //             $value['action'] = '<a  href="#modalFollow" id="follow_id" class="btn btn-round btn-fill-theme" data-record ='.$value['id'].' ><i class="icon-crm-user-plus"></i> Follow </a>';  
   //                }


			$new_data[]=$value;
		}

	  $result = ["sEcho" => 1,
          "iTotalRecords" => count($new_data),
          "iTotalDisplayRecords" => count($new_data),
          "aaData" => $new_data ];

       return $result;  
	}

	public function hot_contracts()
	{	
		$status = 3;

		$result = $this->hot_contracts_and_archived($status);
		echo json_encode($result);
		die();
	}
	public function hot_contracts_archived()
	{	
		$status = 1;

		$result = $this->hot_contracts_and_archived($status);
		echo json_encode($result);
		die();
	}
	


}
