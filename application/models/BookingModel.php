<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class BookingModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function get_record_data_by_id($record_id='')
    {			
			$this->db->select("*");
			$this->db->where("r.id", $record_id);	
			$qry = $this->db->get('anb_crm_record r');
			$res = $qry->row_array();
			return $res;
		}
		
    function get_invitees_by_booking_id($booking_id='')
    {			
			$this->db->select("*");
			$this->db->where("r.booking_id", $booking_id);	
			$qry = $this->db->get('anb_crm_bookings_guests r');
			$res = $qry->result_array();
			return $res;
		}
		
    function get_guest_name_by_email_user($email='')
    {			
			 $ret = array();
        $this->db->select("u.*,p.*");
        $this->db->where("u.email", $email);
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
        $res = $this->db->get('anb_crm_users as u');
        $ret = $res->row_array();      		
        return $ret; 
		}
		
    function get_guest_name_by_email_client($email=null)
    {			
			$module_name = 'Clients';
			
			$this->db->select("mv.*");		
			$this->db->where("mv.value", $email);
			$this->db->order_by("mv.id", "DESC");
			$res = $this->db->get("anb_crm_record_meta_value mv");
			
			$ret = $res->row_array();
			//echo '<pre>';print_r($ret);
			$names = array('First Name','Last Name'); 
			$values = '';
			foreach($names as $name)
			{
				$this->db->select("mv.*, m.*");		
				$this->db->where("mv.record_id", $ret['record_id']);
				$this->db->where("m.name", $name);
				$this->db->join("anb_crm_record_meta m", 'm.id = mv.record_meta_id' , 'left');
				$res1 = $this->db->get("anb_crm_record_meta_value mv");
				$ret1 = $res1->row_array();  
				//echo '<pre>';print_r($ret1);
				if(!empty($ret1['value']))
				{
					$values .= $ret1['value'].' ';
				}
			}		
			//echo '<pre>';print_r($values);
		
		  return $values;
          
		}
		
		
		function add_notification($notifyData)
		{			
			$this->db->insert("anb_crm_notifications", $notifyData);	
			return true;		
		}
     
		function update_notification($booking_id, $receiver_id)
		{
			$notifyData = array(						
				"read" => 1, 							
				"modified_time" =>date('Y-m-d H:i:s'),													
			);
			$this->db->where('booking_id',$booking_id);
			$this->db->where('receiver_id',$receiver_id);
			$this->db->update("anb_crm_notifications", $notifyData);	
			return true;		
		}
     
    function addBooking()
    {
    	/*print_r($_POST);
    	die;*/
			if($this->getPost("current_module")=="Leads")
			{
				$current_module = 1;
			}else{
				$current_module = 2;
			}

			if(empty($this->getPost("end_date")) && empty($this->getPost("end_time")))
			{
				$end_date = date('Y-m-d',strtotime($this->getPost("start_date"))).' '.date("H:i:s",strtotime($this->getPost("start_time")) + 60*30);
			}elseif(empty($this->getPost("end_date")) && !empty($this->getPost("end_time")))
			{
				$end_date = date('Y-m-d H:i:s',strtotime($this->getPost("start_date").' '.$this->getPost("end_time")));
			}else
			{
				$end_date = date('Y-m-d H:i:s',strtotime($this->getPost("end_date").' '.$this->getPost("end_time")));
			}

			$recordData = array(
				"record_id" => $this->getPost("record_id"),
				"module_id" => $current_module,
				"booking_date" => date('Y-m-d H:i:s',strtotime($this->getPost("start_date").' '.$this->getPost("start_time"))),
				'end_date' => $end_date,
				"booking_title" => $this->getPost("booking_title"),
				"booking_address" => $this->getPost("event_location"),
				"all_day" => $this->getPost("all_day"),
				"visibility" => $this->getPost("visibility"),
				"color" =>$this->getPost("color"),
				"notes" =>$this->getPost("notes"),
				"name" => $this->getPost("lead_name"),
				"email" => $this->getPost("email"),
				"status" => 0, //0=new booking
				"created_by" => $this->session->userdata('user_id'),
				"created_for" => $this->getPost('created_for'),
				"created_time" =>date('Y-m-d H:i:s'),
				"attachment" => isset($_FILES['file']['name']) && !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : '',
				"conference"=>  $this->getPost('conference'),
			);

			$record_id=$this->getPost("record_id");

			if(!empty($record_id)){
				$recordData['assigned_officer_id']=$this->db->get_where('anb_crm_record',['id'=>$record_id])->row()->assigned_officer_id;
			}
			
			$recordCreationSuccessful = $this->db->insert("anb_crm_bookings", $recordData);
			if ($recordCreationSuccessful === true)
			{
				$recordId = $this->db->insert_id();
				
				return $recordId;
			}
			else
			{
				return false;
			}
		}
		
    function updateBooking()
    {
			$recordData = array(					
					"booking_date" => date('Y-m-d H:i:s',strtotime($this->getPost("selected_date").' '.$this->getPost("selected_time"))),
					"booking_title" => $this->getPost("booking_title"),
					"name" => $this->getPost("full_name"),
					"email" => $this->getPost("email"),							
					"modified_by" => $this->session->userdata('user_id'),
					"modified_time" =>date('Y-m-d H:i:s'),
					"attachment" => isset($_FILES['file']['name']) && !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : ''				
			);
			$this->db->where('record_id',$this->getPost("current_record_id"));
			$this->db->where('id',$this->getPost("bid"));
			$recordCreationSuccessful = $this->db->update("anb_crm_bookings", $recordData);
			if ($recordCreationSuccessful == true)
			{
				$recordId = $this->getPost("bid");
				
				return $recordId;
			}
			else
			{
				return false;
			}
		}
		
    function confirmBooking()
    {			
			$recordData = array(				
					"status" => 1,  //1=confirmed			
					"modified_by" => $this->getPost("created_by"),						
					"modified_time" =>date('Y-m-d H:i:s'),				
			);
			
			$this->db->where('id', $this->getPost("bookingId"));		
			$this->db->update("anb_crm_bookings", $recordData);          
			
			if ($this->db->affected_rows() == '1')
			{
				$recordId = $this->db->insert_id();
				
				return true;
			}
			else
			{
				return false;
			}
		}
		
    function cancelBooking()
    {			
			$recordData = array(				
					"status" => 2,  //2=cancelled			
					"modified_by" => $this->getPost("created_by"),						
					"modified_time" =>date('Y-m-d H:i:s'),				
			);
			
			$this->db->where('id', $this->getPost("bookingId"));		
			$this->db->update("anb_crm_bookings", $recordData);          
			
			if ($this->db->affected_rows() == '1')
			{
				$recordId = $this->db->insert_id();
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function loadBookingsList($bid = null, $record_id = null, $email = null, $booking_date = null, $withoutbid = null)
		{
			$ret = array();
			$this->db->select("ac.*, p.first_name, p.last_name");
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
			if ($bid != null)
			{
				$this->db->where("ac.id", $bid);
			}
			else
			{
				$this->db->order_by("ac.id", 'DESC');
			}
			
			if ($withoutbid != null)
			{
				$this->db->where("ac.id !=", $withoutbid);
			}
			
			if ($email != null) $this->db->where("ac.email", $email);
			if ($record_id != null) $this->db->where("ac.record_id", $record_id);
			if ($booking_date != null){
				//$this->db->where("ac.booking_date", $booking_date);
				$where = "(ac.booking_date= '".$booking_date."' or '".$booking_date."' BETWEEN ac.booking_date AND ac.end_date)" ;
				$this->db->where($where);
				//$this->db->where('ac.booking_date <=',$booking_date);
				//$this->db->where('ac.end_date <=',$booking_end);
/*				$this->db->where('ac.booking_date <=',date("H:i:s",strtotime($booking_date)));
				$this->db->where('ac.end_date >=',date("H:i:s",strtotime($booking_end)));*/
			//$this->db->or_where('"'.$booking_date .'"BETWEEN ac.booking_date AND ac.end_date', null, false);
			} 
			$qry = $this->db->get('anb_crm_bookings ac');
	 
			$ret = $qry->result_array();
/*			print_r($this->db->last_query());
			print_r($ret);
			die;*/
			return $ret;
    }
    

     function check_booking_availability($booking_date = null,$booking_id=null,$created_for,$flag){

     	    $ret = array();
			$this->db->select("*");
			$this->db->where('created_for',$created_for);
			if($flag){
			   $this->db->where_not_in('id',$booking_id);
			}
			if ($booking_date != null){
			    $where = "(booking_date= '".$booking_date."' or '".$booking_date."' BETWEEN booking_date AND end_date)" ;
				$this->db->where($where);
				
			} 
			$qry = $this->db->get('anb_crm_bookings');
	        
            $ret = $qry->result_array();

			return $ret;
     }

//SELECT DATE_FORMAT(colName, '%Y-%m-%d') DATEONLY, DATE_FORMAT(colName,'%H:%i:%s') TIMEONLY
    
		function checkBookingTimeNotAvailable($record_id = null, $booking_date = null)
		{
			$ret = array();
			$this->db->select("DATE_FORMAT(ac.booking_date,'%l:%i %p') as time");
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');			
			
			if ($record_id != null) $this->db->where("ac.record_id", $record_id);
			if ($booking_date != null) $this->db->where("DATE(ac.booking_date)", $booking_date);
			
			$qry = $this->db->get('anb_crm_bookings ac');
	 
			$ret = $qry->result_array();
		
			return $ret;
    }

		function loadBookingsForGuestCalender($owner = null)
		{
			$ret = array();
				
			$this->db->select("u.email");
			$this->db->where_in("u.id", $owner);	
			$qry = $this->db->get('anb_crm_users u');
			$res = $qry->result_array();
			foreach($res as $rs)
			{
				$email = $rs['email'];

				$this->db->select("r.*");
				$this->db->where("r.guest", $email);	
				$qry = $this->db->get('anb_crm_bookings_guests r');
				$bookings = $qry->result_array();
				//return $bookings;
			
				if(!empty($bookings))
				{				
					foreach($bookings as $booking)
					{							
						$this->db->select("ac.*,ac.id as booking_id, ac.module_id as booking_module_id, r.*, v.*");
						$this->db->join('anb_crm_record r', 'r.id = ac.record_id', 'left');
						$this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id', 'left');
						$this->db->where("v.record_meta_id", 31);			
					
						$this->db->where("ac.id", $booking['booking_id']);	 		
						$qry = $this->db->get('anb_crm_bookings ac');							
						$bres = $qry->row_array();							
						if(!empty($bres))
						{
							$ret[] = $bres;
						}
					}				
				}
			}
		
			return $ret;
			
		}
		
		
		function loadBookingsForCalender($owner = null, $booking_id=null)
		{
			  $owner = ($owner == null) ? 1 : $owner;
			  $shared_calendar_user_ids[] = $owner;
			  
			  $unique_ids = array_unique($shared_calendar_user_ids);
			  
			  // $role_id=='';
			  // if(count($owner)==1){
			   	 //$this->db->get_where('anb_crm_users',['id'=>$owner[0]])->row()->role_id;
			  // }

			  //echo '<pre>';print_r($unique_ids);die;
			   
        $ret = array();
        $this->db->select("ac.*,ac.id as booking_id, ac.module_id as booking_module_id, r.*, v.*");
        $this->db->join('anb_crm_record r', 'r.id = ac.record_id', 'left');
        $this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id');
        //$this->db->where('ac.web_booking',0);
        $this->db->group_start();
        $this->db->where("v.record_meta_id", 31);
        $this->db->or_where("v.record_meta_id", 184);
        $this->db->group_end();
        //$this->db->where_in('ac.module_id', array('1', '2'));
        //$this->db->or_where("v.record_meta_id", 1);
        //$this->db->or_where("v.record_meta_id", 2);
        if($booking_id!=null)	{
					$this->db->where("ac.id", $booking_id);	
				}  
				      
   		 if($owner[0] != "all"){
   			$this->db->where_in("r.assigned_officer_id", $owner);
         }		
        
        //$this->db->where_in("r.assigned_officer_id", $unique_ids);

				$this->db->order_by("ac.id", 'DESC');
	
	      $qry = $this->db->get('anb_crm_bookings ac');
        
				if($booking_id!=null)	{
					$ret = $qry->row_array();
				}
				else {
					$ret = $qry->result_array();
				}

				// print_r($this->db->last_query());
				// echo '<pre>';print_r($ret);die;      
				
        return $ret;
    }
    
 		 function loadBookingById($booking_id=null, $module=null)
		 {  
        $ret = array();
        $this->db->select("ac.*,ac.id as booking_id, r.*, v.*");
        $this->db->join('anb_crm_record r', 'r.id = ac.record_id', 'left');
        $this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id');
        if($this->getPost("current_module")=="Leads" || $module=="Leads")
				{
					$this->db->where("v.record_meta_id", 31);
				}else{
					$this->db->where("v.record_meta_id", 84);
				}              
       
				$this->db->where("ac.id", $booking_id);	
				
        $qry = $this->db->get('anb_crm_bookings ac');
        
				$ret = $qry->row_array();
				
				//echo '<pre>';print_r($ret);die;      
				
        return $ret;
    }
    
    
 		 function loadNotAvailableList($own=null)
		 {  
        $ret = array();
        $this->db->select("una.*");    
       
				$this->db->where_in("una.user_id", $own);	
				
        $qry = $this->db->get('anb_crm_users_not_available una');
        
				$ret = $qry->result_array();
				
				//echo '<pre>';print_r($ret);die;      
				
        return $ret;
    }
    
    function loadBookingsListForDashboard($owner=null, $from_date=null, $booking_status=null)
    {
			$ret = array();
			$this->db->select("ac.*, ac.id as booking_id, ac.created_time as booking_created_time, r.*, v.*, p.first_name, p.last_name");
			$this->db->join('anb_crm_record r', 'r.id = ac.record_id');
			$this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id');
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
			$this->db->where("v.record_meta_id", 31);
			//$this->db->or_where("v.record_meta_id", 1);
			//$this->db->or_where("v.record_meta_id", 2);		 
			//$this->db->where("ac.id", $booking_id);	
						
			if($from_date!='')
			{			
				$this->db->where("ac.booking_date >=", $from_date);			
			}
				
			if($booking_status!='')
			{			
				$this->db->where("ac.status", $booking_status);			
			}
				
			$this->db->order_by("ac.booking_date", 'DESC');				
			$this->db->where("r.assigned_officer_id", $owner);
			 $this->db->limit("20");
			$qry = $this->db->get('anb_crm_bookings ac');
			
			$ret = $qry->result_array();
			
			//echo '<pre>';print_r($ret);die;      
			
			return $ret;
			
		}
    
    function loadBookingsForDashboardGraph($owner=null, $month=null, $year=null, $booking_status=null)
    {
			$ret = array();
			$this->db->select("COUNT(ac.id) as y");
			//$this->db->select("ac.*, ac.id as booking_id, ac.created_time as booking_created_time, r.*");
			$this->db->join('anb_crm_record r', 'r.id = ac.record_id');
				
			//$this->db->group_by('ac.booking_date');
			//$this->db->group_by('MONTH(booking_date), YEAR(booking_date)');
			
			if($month!='' && $year!='')
			{			
				$this->db->where("MONTH(ac.booking_date)", $month);			
				$this->db->where("YEAR(ac.booking_date)", $year);			
			}
				
			if($booking_status!='')
			{			
				$this->db->where("ac.status", $booking_status);			
			}
			
			$this->db->where("r.assigned_officer_id", $owner);			 
			$qry = $this->db->get('anb_crm_bookings ac');			
			$ret = $qry->row_array();			
			$final = [
				'label'=>date('M Y', mktime(0, 0, 0, $month, 10,$year)),
				'y'=>(int)$ret['y']
			];
			return $final;
			
	}

	function loadBookingsForComparison($owner=null, $month=null, $year=null, $booking_status=null)
    {
			$ret = array();
			$this->db->select("COUNT(ac.id) as y");
			//$this->db->select("ac.*, ac.id as booking_id, ac.created_time as booking_created_time, r.*");
			//$this->db->join('anb_crm_record r', 'r.id = ac.record_id');
				
			//$this->db->group_by('ac.booking_date');
			//$this->db->group_by('MONTH(booking_date), YEAR(booking_date)');
			
			if($month!='' && $year!='')
			{			
				$this->db->where("MONTH(ac.booking_date)", $month);			
				$this->db->where("YEAR(ac.booking_date)", $year);			
			}
				
			if($booking_status!='')
			{			
				$this->db->where("ac.status", $booking_status);			
			}
			
			$this->db->where("ac.assigned_officer_id", $owner);			 
			$qry = $this->db->get('anb_crm_bookings ac');			
			$ret = $qry->row_array();			
			$final = [
				'label'=>date('M Y', mktime(0, 0, 0, $month, 10,$year)),
				'y'=>(int)$ret['y']
			];
			return $final;
			
	}
	function loadTarget($owner=null, $month=null, $year=null, $booking_status=null)
    {
			$ret = array();
			$this->db->select("ac.*");
			
			if($month!='' && $year!='')
			{			
				$this->db->where("MONTH(ac.month)", $month);			
				$this->db->where("YEAR(ac.month)", $year);			
			}
		 	$this->db->where("ac.user_id", $owner);			 
			$qry = $this->db->get('user_target ac');			
		    	
		   	if(!empty($qry->row()->target)) 	
				return $qry->row()->target;
			else{

				$qry=$this->db->get_where('anb_crm_users_personal_info',['user_id'=>$owner]);
				return $qry->row()->monthly_target;
			}
	}

    
    function loadBookingsForDashboardGraphByIds($owner=null, $month=null, $year=null, $booking_status=null)
    {
			$ret = array();
			$this->db->select("COUNT(ac.id) as y");
			//$this->db->select("ac.*, ac.id as booking_id, ac.created_time as booking_created_time, r.*");
			$this->db->join('anb_crm_record r', 'r.id = ac.record_id');
				
			//$this->db->group_by('ac.booking_date');
			//$this->db->group_by('MONTH(booking_date), YEAR(booking_date)');
			
			if($month!='' && $year!='')
			{			
				$this->db->where("MONTH(ac.booking_date)", $month);			
				$this->db->where("YEAR(ac.booking_date)", $year);			
			}
				
			if($booking_status!='')
			{			
				$this->db->where("ac.status", $booking_status);			
			}
			
			$this->db->where_in("r.assigned_officer_id", $owner);			 
			$qry = $this->db->get('anb_crm_bookings ac');			
			$ret = $qry->row_array();
			//echo $this->db->last_query().'<br/>';			
			//echo '<pre>';print_r($ret).'<br/>'; 
			//die;
			$final = [
				'label'=>date('M', mktime(0, 0, 0, $month, 10)),
				'y'=>(int)$ret['y']
			];
			return $final;
			
		}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //* old code *//

    function loadModulesMeta($module){
/*        $this->db->cache_delete_all();*/
        $ret = array();
        $this->db->select("rm.id, rm.name, rm.type, rm.option_value, rm.validation_rule, rm.is_unique, rm.is_required, rm.is_readonly, rm.permission, rm.lookup_module_id, m.id as module_id, m.plural_name, s.name as section_name");
        $this->db->where("m.plural_name", $module);
        $this->db->join('anb_crm_modules m', 'm.id = rm.module_id', 'left');
        $this->db->join('anb_crm_section s', 's.serial = rm.section_id  AND s.module_id = m.id', 'left');
        $this->db->order_by('s.serial, rm.ui_serial_order');
        $res = $this->db->get('anb_crm_record_meta as rm');
        foreach ($res->result_array() as $modules_meta) {
            $modules_meta['name'] = $this->textOnly($modules_meta['name']);
            $ret[] = $modules_meta;
        }

        return $ret;
    }

    function loadModulesViewData($module){
        $ret = array();
        $this->db->select("rm.id, rm.name, rm.display_in_short_view, rm.type, rm.option_value, rm.validation_rule, rm.is_unique, rm.is_required, rm.is_readonly, rm.permission, rm.lookup_module_id, m.id as module_id, m.plural_name, s.name as section_name");
        $this->db->where("m.plural_name", $module);
        $this->db->join('anb_crm_modules m', 'm.id = rm.module_id', 'left');
        $this->db->join('anb_crm_section s', 's.serial = rm.section_id  AND s.module_id = m.id', 'left');
        $this->db->order_by('s.serial, rm.ui_serial_order');
        $res = $this->db->get('anb_crm_record_meta as rm');
        foreach ($res->result_array() as $modules_meta) {
            $modules_meta['name'] = $this->textOnly($modules_meta['name']);
            $ret[] = $modules_meta;
        }

        return $ret;
    }

    function loadRecord($recordStatus = null, $record_id = null){
        $ret = array();
        $id = ($record_id == null) ? $this->getPost("id") : $record_id;
        global $RECORD_STATUS;
        $recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
        $officer = ''; $created_by = ''; $created_time = ''; $modified_by = ''; $modified_time = '';

        $this->db->select("r.*, v.record_meta_id, v.value");
        $this->db->where("r.record_status", $recordStatus);
        $this->db->where("r.id", $id);
        $this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id', 'left');
        $res = $this->db->get('anb_crm_record as r');
        foreach ($res->result_array() as $record) {
            $record["value"] = $this->decryptMetaValue($record["value"]);
            $id = "__" . $record["record_meta_id"];
            $ret[$id] = $record["value"];
            if ($officer == '') $officer = $record["assigned_officer_id"];
            if ($created_by == '') $created_by = $record["created_by"];
            if ($created_time == '') $created_time = $record["created_time"];
            if ($modified_by == '') $modified_by = $record["modified_by"];
            if ($modified_time == '') $modified_time = $record["modified_time"];
        }
        $ret["__0"] = $officer;
        $ret["created_by"] = $created_by;
        $ret["created_time"] = $created_time;
        $ret["modified_by"] = $modified_by;
        $ret["modified_time"] = $modified_time;

        return $ret;
    }

    function loadAttachments($type="record"){
        $ret = array();
        $id = $this->getPost("id");

        $this->db->select("a.*, p.first_name, p.last_name");
        if ($type == "record"){
            $this->db->where("record_id", $id);
        } else if ($type == "activity"){
            $this->db->where("activity_id", $id);
        }
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = a.uploaded_by', 'left');
        $res = $this->db->get('anb_crm_attachment a');
        foreach ($res->result_array() as $attachment) {
            $ret[] = array(
                "link" => $attachment["link"],
                "name" => $attachment["name"],
                "uploaded_by" => ($attachment["first_name"] . " " . $attachment["last_name"]),
                "uploaded_time" => $attachment["uploaded_time"],
            );
        }

        return $ret;
    }

    function loadNotes($type="record"){
        $ret = array();
        $id = $this->getPost("id");

        $this->db->select("n.*, p.first_name, p.last_name");
        if ($type == "record"){
            $this->db->where("record_id", $id);
        } else if ($type == "activity"){
            $this->db->where("activity_id", $id);
        }
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = n.created_by', 'left');
        $this->db->order_by("id desc");
        $res = $this->db->get('anb_crm_note n');
        foreach ($res->result_array() as $note) {
            $ret[] = array(
                "note" => $note["note"],
                "note_title" => $note["note_title"],
                "created_by" => ($note["first_name"] . " " . $note["last_name"]),
                "created_time" => $note["created_time"],
            );
        }

        return $ret;
    }

    function loadContracts(){
        $ret = array();
        $client_id = $this->getPost("id");
        $contractIds = array();

        $this->db->select("v.record_id");
        $this->db->where("m.lookup_module_id", CLIENTS);
        $this->db->where("v.value", $client_id);
        $this->db->join('anb_crm_record_meta_value v', 'v.record_meta_id = m.id', 'left');
        $res = $this->db->get('anb_crm_record_meta as m');
        foreach ($res->result_array() as $contractMetaData) {
            $contractIds[] = $contractMetaData["record_id"];
        }

        foreach ($contractIds as $key => $contractId){
            $this->db->select("r.*, v.record_meta_id, v.value, p.first_name, p.last_name, m.name");
            $this->db->where("r.id", $contractId);
            $this->db->where_in("v.record_meta_id", array(160, 162, 163));
            $this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id', 'left');
            $this->db->join('anb_crm_record_meta m', 'm.id = v.record_meta_id', 'left');
            $this->db->join('anb_crm_users_personal_info p', 'r.assigned_officer_id = p.user_id', 'left');
            $res = $this->db->get('anb_crm_record as r');
            foreach ($res->result_array() as $record) {
                $assignedOfficer = $record["first_name"] . " " . $record["last_name"];
                $ret[$contractId]["assigned_officer"] = $assignedOfficer;
                $ret[$contractId]["created_time"] = $record["created_time"];
                $ret[$contractId]["modified_time"] = $record["modified_time"];
                if ($record["record_meta_id"] == 160) $ret[$contractId]["contract_name"] = $record["value"];
                if ($record["record_meta_id"] == 162) $ret[$contractId]["stage"] = $record["value"];
                if ($record["record_meta_id"] == 163) $ret[$contractId]["service_type"] = $record["value"];
            }
        }

        return $ret;
    }

    function loadRecordList($recordStatus = null, $owner = null, $search_filter = null, $npage_no = 1, $limit = 25){
        $ret = array();
        global $RECORD_STATUS;
        $recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
        $owner = ($owner == null) ? 1 : $owner;
        $module_name = $this->getPost("cm");
        $displayMetaIds = array();
        $module_id = '';

        $this->db->select("m.id, m.name, m.type, mod.id as module_id");
        $this->db->join('anb_crm_modules mod', 'm.module_id = mod.id', 'left');
        $this->db->where("m.display_in_short_view", "1");
        $this->db->where("mod.plural_name", $module_name);
        $res = $this->db->get("anb_crm_record_meta m");
        foreach($res->result_array() as $displayMeta){
            $displayMetaIds[$displayMeta["id"]] = $displayMeta["name"];
            if ($module_id == '') $module_id = $displayMeta["module_id"];
        }
        $this->db->reset_query();
/*        $this->db->cache_on();*/
        $additionalFieldName = ($module_name == CONTRACTS_PLURAL_NAME) ? ", vvv.vv_client_name" : "";
        if ($module_name == CONTRACTS_PLURAL_NAME) {
            $this->db->join('(SELECT vv.value as vv_client_name, vv.record_id as vv_record_id FROM anb_crm_record_meta_value vv where vv.record_meta_id = 84) as vvv', 'vvv.vv_record_id = r.id', 'left');
        }
        $extraSelect = '';
        foreach($displayMetaIds as $metaId => $meta){
            $extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
            $this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');
        }
        $arr_rev = array_flip($displayMetaIds);
				if(isset($search_filter) && count($search_filter))
		        {
					foreach($search_filter as $k => $v)
					{
						if($v && !in_array($k, $arr_rev))
						{
							$extraSelect .= ($extraSelect == '') ? "ad$k.value as value$k" : ", ad$k.value as value$k";
							$this->db->join("(SELECT sq$k.value, sq$k.record_id FROM anb_crm_record_meta_value sq$k where sq$k.record_meta_id = $k) as ad$k", "ad$k.record_id = r.id", 'left');	
						}
					}
				}        
/*        $this->db->join('anb_crm_modules mod', 'r.module_id = mod.id', 'left');
        $this->db->where("mod.plural_name", $module_name);*/
        $this->db->where("r.record_status", $recordStatus);
        $this->db->where("r.module_id", $module_id);
        $this->db->where("r.assigned_officer_id", $owner);
        if(isset($search_filter) && count($search_filter))
        {
			foreach($search_filter as $k => $v)
			{
				if($v)
					$this->db->like("`ad$k`.`value`", $v);
			}
		}
        $this->db->order_by("r.id desc");
        $this->db->select("r.*, $extraSelect$additionalFieldName");
        //$this->db->limit(RECORD_LIMIT_IN_EACH_PAGE, $offsetStart);
        $res = $this->db->get('anb_crm_record as r');
		$limits_per_page = $limit;
        $num_records = count($res->result_array());
		$total_page = ceil($num_records/$limits_per_page);
		$npage_no = ($npage_no > $total_page)?$npage_no:$total_page;
		$start_rec_no = ($npage_no - 1) * $limits_per_page;
		$int_end_row = $start_rec_no + $limits_per_page;
		$int_end_row = ($int_end_row > $num_records)?$num_records:$int_end_row;        
        $last_sql = $this->db->last_query()." LIMIT $start_rec_no, ". $limits_per_page;
        $page_details['start_record'] = $start_rec_no;
        $page_details['end_record'] = $int_end_row;
        $page_details['total_records'] = $num_records;
        $page_details['total_page'] = $total_page;
        $page_details['cur_page'] = $npage_no;
        
        $res = $this->db->query($last_sql);
        foreach ($res->result_array() as $record) {
            foreach ($displayMetaIds as $metaId => $metaName){
                $value = $this->decryptMetaValue($record["value$metaId"]);
                $ret[$record["id"]]["meta"]["$metaName"] = $value;
            }
            $ret[$record["id"]]["static"]["created_by"] = $record["created_by"];
            $ret[$record["id"]]["static"]["created_time"] = $record["created_time"];
            $ret[$record["id"]]["static"]["modified_by"] = $record["modified_by"];
            $ret[$record["id"]]["static"]["modified_time"] = $record["modified_time"];
            $ret[$record["id"]]["static"]["record_status"] = $record["record_status"];
            if ($module_name == CONTRACTS_PLURAL_NAME && $record["vv_client_name"] != NULL){
                $ret[$record["id"]]["static"]["client_name"] = $record["vv_client_name"];
            }
        }

        foreach ($ret as $key => $value) {
            if ($key != 'total_record') ksort($ret[$key]["meta"]);
            if ($module_name == CONTRACTS_PLURAL_NAME && isset($ret[$key]["meta"]["Client Name"])) {
                $ret[$key]["meta"]["Client Name"] = $ret[$key]["static"]["client_name"];
            }
        }

/*        $this->db->cache_off();*/
        /*$this->debug($this->db->last_query());*/
        $arr_res[0] = $ret;
        $arr_res[1] = $page_details;
        return $arr_res;
    }

    function loadSearchRecordList($recordStatus = null, $owner = null){
        $ret = array();
        global $RECORD_STATUS;
        $recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
        $owner = ($owner == null) ? 1 : $owner;
        $module_name = $this->getPost("cm");
        $page = ($this->getPost("page") != '') ? $this->getPost("page") : 1;
        $offsetStart = ( ($page - 1) * RECORD_LIMIT_IN_EACH_PAGE) + 1;
        $displayMetaIds = array();
        $module_id = '';

        $this->db->select("m.id, m.name, m.type, mod.id as module_id");
        $this->db->join('anb_crm_modules mod', 'm.module_id = mod.id', 'left');
        $this->db->where("m.display_in_short_view", "1");
        $this->db->where("mod.plural_name", $module_name);
        $res = $this->db->get("anb_crm_record_meta m");
        foreach($res->result_array() as $displayMeta){
            $displayMetaIds[$displayMeta["id"]] = $displayMeta["name"];
            if ($module_id == '') $module_id = $displayMeta["module_id"];
        }

        $this->db->reset_query();
        $recordIds = array();
        $search = $this->getPost("s");
        $this->db->select("r.id");
        $this->db->join('anb_crm_record r', 'r.id = v.record_id', 'left');
        $this->db->join('anb_crm_modules mod', 'r.module_id = mod.id', 'left');
        $this->db->like('v.value', $search);
        $this->db->where("mod.plural_name", $module_name);
        $this->db->group_by("r.id");
        $res = $this->db->get("anb_crm_record_meta_value v");
        foreach($res->result_array() as $displayMeta){
            $recordIds[] = $displayMeta["id"];
        }

        if (count($recordIds) != 0) {
            $this->db->reset_query();
            $additionalFieldName = ($module_name == CONTRACTS_PLURAL_NAME) ? ", vvv.vv_client_name" : "";
            if ($module_name == CONTRACTS_PLURAL_NAME) {
                $this->db->join('(SELECT vv.value as vv_client_name, vv.record_id as vv_record_id FROM anb_crm_record_meta_value vv where vv.record_meta_id = 84) as vvv', 'vvv.vv_record_id = r.id', 'left');
            }
            $extraSelect = '';
            foreach ($displayMetaIds as $metaId => $meta) {
                $extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
                $this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');
            }
            $this->db->where("r.record_status", $recordStatus);
            $this->db->where("r.module_id", $module_id);
            $this->db->where("r.assigned_officer_id", $owner);
            $this->db->where_in("r.id", $recordIds);
            $this->db->order_by("r.id desc");
            $this->db->select("r.*, $extraSelect$additionalFieldName");
            /*        $this->db->limit(RECORD_LIMIT_IN_EACH_PAGE, $offsetStart);*/
            $res = $this->db->get('anb_crm_record as r');
            foreach ($res->result_array() as $record) {
                foreach ($displayMetaIds as $metaId => $metaName) {
                    $value = $this->decryptMetaValue($record["value$metaId"]);
                    $ret[$record["id"]]["meta"]["$metaName"] = $value;
                }
                $ret[$record["id"]]["static"]["record_status"] = $record["record_status"];
                if ($module_name == CONTRACTS_PLURAL_NAME && $record["vv_client_name"] != NULL) {
                    $ret[$record["id"]]["static"]["client_name"] = $record["vv_client_name"];
                }
            }

            foreach ($ret as $key => $value) {
                if ($key != 'total_record') ksort($ret[$key]["meta"]);
                if ($module_name == CONTRACTS_PLURAL_NAME && isset($ret[$key]["meta"]["Client Name"])) {
                    $ret[$key]["meta"]["Client Name"] = $ret[$key]["static"]["client_name"];
                }
            }
        }

        /*$this->debug($this->db->last_query());*/
        return $ret;
    }

    function getTotalRecord($recordStatus = null, $owner = null, $search_filter = null){
        /*global $RECORD_STATUS;
        $recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
        $owner = ($owner == null) ? 1 : $owner;
        $module_name = $this->getPost("cm");

        $this->db->select("r.id");
        $this->db->join('anb_crm_modules mod', 'r.module_id = mod.id', 'left');
        $this->db->where("mod.plural_name", $module_name);
        $this->db->where("r.record_status", $recordStatus);
        $this->db->where("r.assigned_officer_id", $owner);
        $this->db->from('anb_crm_record as r');

        return $this->db->count_all_results();*/
        
        
        
        
        
        global $RECORD_STATUS;
		        $recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
		        $owner = ($owner == null) ? 1 : $owner;
		        $module_name = $this->getPost("cm");
		        $page = ($this->getPost("page") != '') ? $this->getPost("page") : 1;
		        $offsetStart = ( ($page - 1) * RECORD_LIMIT_IN_EACH_PAGE) + 1;
		        $displayMetaIds = array();
		        $module_id = '';
		
		        $this->db->select("m.id, m.name, m.type, mod.id as module_id");
		        $this->db->join('anb_crm_modules mod', 'm.module_id = mod.id', 'left');
		        $this->db->where("m.display_in_short_view", "1");
		        $this->db->where("mod.plural_name", $module_name);
		        $res = $this->db->get("anb_crm_record_meta m");
		        foreach($res->result_array() as $displayMeta){
		            $displayMetaIds[$displayMeta["id"]] = $displayMeta["name"];
		            if ($module_id == '') $module_id = $displayMeta["module_id"];
		        }
		        $this->db->reset_query();
		/*        $this->db->cache_on();*/
		        $additionalFieldName = ($module_name == CONTRACTS_PLURAL_NAME) ? ", vvv.vv_client_name" : "";
		        if ($module_name == CONTRACTS_PLURAL_NAME) {
		            $this->db->join('(SELECT vv.value as vv_client_name, vv.record_id as vv_record_id FROM anb_crm_record_meta_value vv where vv.record_meta_id = 84) as vvv', 'vvv.vv_record_id = r.id', 'left');
		        }
		        $extraSelect = '';
		        foreach($displayMetaIds as $metaId => $meta){
		            $extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
		            $this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');
		        }
		        $arr_rev = array_flip($displayMetaIds);
		        if(isset($search_filter) && count($search_filter))
		        {
					foreach($search_filter as $k => $v)
					{
						if($v && !in_array($k, $arr_rev))
						{
							$extraSelect .= ($extraSelect == '') ? "ad$k.value as value$k" : ", ad$k.value as value$k";
							$this->db->join("(SELECT sq$k.value, sq$k.record_id FROM anb_crm_record_meta_value sq$k where sq$k.record_meta_id = $k) as ad$k", "ad$k.record_id = r.id", 'left');	
						}
					}
				}
		/*        $this->db->join('anb_crm_modules mod', 'r.module_id = mod.id', 'left');
		        $this->db->where("mod.plural_name", $module_name);*/
		        $this->db->where("r.record_status", $recordStatus);
		        $this->db->where("r.module_id", $module_id);
		        $this->db->where("r.assigned_officer_id", $owner);
		        if(isset($search_filter) && count($search_filter))
		        {
					foreach($search_filter as $k => $v)
					{
						if($v)
							$this->db->like("`ad$k`.`value`", $v);
					}
				}
				$this->db->from('anb_crm_record as r');
        $cnt = $this->db->count_all_results();
        return $cnt;
        //echo $this->db->last_query(); exit(0);
    }

    function loadUsersList($status = 1){
        $ret = array();
        $this->db->select("u.id, u.email, p.first_name, p.last_name");
        $this->db->where("u.status", $status);
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
        $res = $this->db->get('anb_crm_users as u');
        foreach ($res->result_array() as $user) {
            $name = ($user["first_name"] == '') ? $user["last_name"] : ($user["first_name"] . " " . $user["last_name"]);
            $ret[] = array(
                'id' => $user["id"],
                'title' => $name . " <" . $user["email"] . ">",
            );
        }
		
        return $ret;
    }
	
	function getSearchFilterList($arr_filters)
	{
        $ret = array();
        
        foreach($arr_filters as $filter_name)
        {
        	$this->db->select("u.id");
        	$this->db->where("u.name", $filter_name);
        	$this->db->join('anb_crm_record_meta_value v', 'v.record_meta_id = u.id', 'inner');
        	$this->db->limit("1");
        	$res = $this->db->get('anb_crm_record_meta as u');
        	$last_sql = $this->db->last_query();
        	foreach ($res->result_array() as $meta) {
				$ret[$meta['id']] = $filter_name;
			}
			$this->db->reset_query();
        }
        return $ret;
	}
	
    function loadClientsList(){
        global $RECORD_STATUS;
        $ret = array();
        $this->db->select("mv.value as name, r.id");
        $this->db->join("anb_crm_record_meta_value mv", 'mv.record_id = r.id AND mv.record_meta_id = ' . LEAD_COMPANY_NAME_META_ID, 'left');
        $this->db->where("r.module_id", CLIENTS);
        $this->db->where("r.record_status", $RECORD_STATUS['CYCLE_RUNNING']);
        $res = $this->db->get('anb_crm_record r');
        foreach ($res->result_array() as $client) {
            $ret[] = array(
                'id' => $client["id"],
                'title' => $client["name"] . " &lt;id=" . $client["id"] . "&gt;",
            );
        }

        return $ret;
    }

    function loadCommonRecordListByType($type = LEADS, $metaIDsList = null){
        global $MAJOR_META_IDS_LIST;
/*        global $RECORD_STATUS;*/
        $ret = array();
        if ($metaIDsList == null) {
            $type = LEADS;
            $metaIDsList = $MAJOR_META_IDS_LIST[LEADS];
        }

        $this->db->select("mv.value, r.id, m.name");
        $this->db->join("anb_crm_record_meta_value mv", 'mv.record_id = r.id', 'left');
        $this->db->join("anb_crm_record_meta m", 'm.id = mv.record_meta_id', 'left');
        $this->db->where("r.module_id", $type);
        $this->db->where_in("m.id", $metaIDsList);
/*        $this->db->where("r.record_status", $RECORD_STATUS['CYCLE_RUNNING']);*/
        $res = $this->db->get('anb_crm_record r');
        foreach ($res->result_array() as $record) {
            $metaName = strtolower(str_replace(" ", "_", $record["name"]));
            $ret[$record["id"]][$metaName] = $record["value"];
        }

        return $ret;
    }

    function loadMetaMapping($where = null){
        $ret = array();
        $this->db->select("*");
        if ($where != null) $this->db->where("to_module_id", $where);
        $res = $this->db->get('anb_crm_conversion_mapping');
        foreach ($res->result_array() as $mapping) {
            if ($where != null) {
                $ret[$mapping['from_meta_id']] = $mapping['to_meta_id'];
            }
            else $ret[] = "{$mapping['from_module_id']}_{$mapping['from_meta_id']}_{$mapping['to_meta_id']}_{$mapping['to_module_id']}";
        }
        return $ret;
    }

    function addRecord($meta_fields, $userId){
        $ret = array(
            "status" => true,
            "message" => '',
            "id" => 1,
        );
        $rawData = $this->getFormFieldData();
        $filteredDataArray = $this->filterRawData($rawData, $meta_fields);

        if ($filteredDataArray["status"] === true){
            $module_id = $filteredDataArray["module_id"];
            $dataToInsert = $filteredDataArray["data"];

            $recordData = array(
                "assigned_officer_id" => $filteredDataArray["assigned_officer_id"],
                "module_id" => $module_id,
                "created_by" => $userId,
                "created_time" => time(),
            );

            $recordCreationSuccessful = $this->db->insert("anb_crm_record", $recordData);
            if ($recordCreationSuccessful === true){
                $recordId = $this->db->insert_id();
                $ret["id"] = $recordId;

                $recordMetaData = array();

                foreach ($dataToInsert as $recordFieldMetaId => $recordFieldMetaValue){
                    $value = $this->encryptMetaValue($recordFieldMetaValue);
                    $recordMetaData[] = array(
                        "record_id" => $recordId,
                        "record_meta_id" => $recordFieldMetaId,
                        "value" => $value,
                    );
                }

                $metaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $recordMetaData);

                if (!$metaInserted){
                    $ret["message"] = "Server error! Please try again later.";
                    $ret["status"] = false;
                } else {
                    //Call Automation
                    $currentData = array(
                        "record" => $recordData,
                        "meta" => $recordMetaData,
                    );

                    $this->automation($currentData, $recordId);
                }
            }
        } else {
            $ret["message"] = $filteredDataArray["message"];
            $ret["status"] = false;
        }

        return $ret;
    }

    function addAttachment($uid, $record_id, $record_attachment_url, $attachment_type = RECORD_ATTACHMENT){
        $file_name = $this->getPost("file_name");

        $recordData = array(
            "link" => $record_attachment_url,
            "name" => $file_name,
            "uploaded_by" => $uid,
            "uploaded_time" => time(),
        );

        if ($attachment_type == RECORD_ATTACHMENT){
            $recordData["record_id"] = $record_id;
        } else if ($attachment_type == ACTIVITY_ATTACHMENT){
            $recordData["activity_id"] = $record_id;
        }

        $recordCreationSuccessful = $this->db->insert("anb_crm_attachment", $recordData);
        return ($recordCreationSuccessful === true) ? true : "Error: Please try again!";
    }

    function addNote($uid, $record_id, $attachment_type = RECORD_ATTACHMENT){
        $note = $this->getPost("note");
        $note_title = $this->getPost("note_title");

        $recordData = array(
            "note" => $note,
            "note_title" => $note_title ,
            "created_by" => $uid,
            "created_time" => time(),
        );

        if ($attachment_type == RECORD_ATTACHMENT){
            $recordData["record_id"] = $record_id;
        } else if ($attachment_type == ACTIVITY_ATTACHMENT){
            $recordData["activity_id"] = $record_id;
        }

        $recordCreationSuccessful = $this->db->insert("anb_crm_note", $recordData);
        return ($recordCreationSuccessful === true) ? true : "Error: Please try again!";
    }

    function updateRecord($meta_fields, $userId){
        $ret = array(
            "status" => true,
            "message" => '',
            "id" => 1,
        );

        $recordId = $this->getPost("record_id");
        $oldRecord = $this->loadRecord(3, $recordId);
        $rawData = $this->getFormFieldData();
        $filteredDataArray = $this->filterRawData($rawData, $meta_fields);

        if ($filteredDataArray["status"] === true){
            $dataToInsert = $filteredDataArray["data"];

            $recordData = array(
                "assigned_officer_id" => $filteredDataArray["assigned_officer_id"],
                "modified_by" => $userId,
                "modified_time" => time(),
            );

            $this->db->where('id', $recordId);
            $recordUpdateSuccessful = $this->db->update("anb_crm_record", $recordData);
            if ($recordUpdateSuccessful === true){
                $existingMetaIds = array_keys($oldRecord);
                $recordMetaData = array();
                $recordMetaDataInsertList = array();
                $recordMetaDataUpdateList = array();


                foreach ($dataToInsert as $recordFieldMetaId => $recordFieldMetaValue){
                    $value = $this->encryptMetaValue($recordFieldMetaValue);

                    $recordMetaData[] = array(
                        "record_id" => $recordId,
                        "record_meta_id" => $recordFieldMetaId,
                        "value" => $value,
                    );

                    if (in_array("__$recordFieldMetaId", $existingMetaIds)){
                        $recordMetaDataUpdateList[] = array(
                            "record_id" => $recordId,
                            "record_meta_id" => $recordFieldMetaId,
                            "value" => $value,
                        );
                    } else {
                        $recordMetaDataInsertList[] = array(
                            "record_id" => $recordId,
                            "record_meta_id" => $recordFieldMetaId,
                            "value" => $value,
                        );
                    }
                }

                $this->db->where('record_id', $recordId);
                $metaUpdated = $this->db->update_batch('anb_crm_record_meta_value', $recordMetaDataUpdateList, "record_meta_id");
                $metaInserted = 1;

                if (count($recordMetaDataInsertList) > 0){
                    $metaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $recordMetaDataInsertList);
                }

                if (!$metaUpdated || !$metaInserted){
                    $ret["message"] = "Server error! Please try again later.";
                    $ret["status"] = false;
                } else {
                    $currentData = array(
                        "record" => $recordData,
                        "meta" => $recordMetaData,
                    );

                    $this->automation($currentData, $recordId, "Old", $oldRecord);
                }
            }
        } else {
            $ret["message"] = $filteredDataArray["message"];
            $ret["status"] = false;
        }

        return $ret;
    }

    function delRecord(){
        $ret = array(
            "status" => true,
            "id" => 1
        );
        $record_id = $this->getPost("id");
        $action = $this->getPost("mtd");

        if ($action == 1 || $action == 2) { // Archive or delete according to global $RECORD_STATUS
            $data = array(
                "record_status" => $this->getPost("mtd"),
            );
            $this->db->where('id', $record_id);
            $recordUpdateSuccessful = $this->db->update("anb_crm_record", $data);
        }

        return $ret;
    }

    function convertRecord($userId)    
    {			
        $lead_id = $this->getPost('id');
        $clientMetaMapping = $this->loadMetaMapping(CLIENTS);
        $contractMetaMapping = $this->loadMetaMapping(CONTRACTS);
        $leadData = $this->loadRecord();
        //echo '<pre>';print_r($leadData); //die;
        //echo '<pre>';print_r($clientMetaMapping); //die;
        //echo '<pre>';print_r($contractMetaMapping); die;

        /////Client Creation
        $recordData = array(
            "assigned_officer_id" => 1,
            "module_id" => CLIENTS,
            "created_by" => $userId,
            "created_time" => time(),
        );

        $recordCreationSuccessful = $this->db->insert("anb_crm_record", $recordData);
        
        if ($recordCreationSuccessful === true)
        {
            $client_id = $this->db->insert_id();
            $contract_ids = array();
            $clientMetaData = array();

            /////Generate Contract Number
            $tempKey = "__" . LEAD_COUNTRY_META_ID;
            $time = dechex( time() - mktime(0, 0, 0, 0, 0, 2017) );
						$contractNumber = '';
						
            if(isset($leadData[$tempKey]) && !empty($leadData[$tempKey]))
            {
							$country = strtoupper($leadData[$tempKey]);						
							
							if (strpos($country, "CANADA") !== false){
									$contractNumber .= "1";
							} else if (strpos($country, "USA") !== false){
									$contractNumber .= "2";
							} else {
									$contractNumber .= "0";
							}
						}
						else
						{
							$contractNumber .= "0";
						}
						$contractNumber .= $time;
						/////Generation of Contract Number
						

            foreach ($clientMetaMapping as $leadMeta => $clientMeta)
            {
								if(isset($leadData["__$leadMeta"]) && !empty($leadData["__$leadMeta"]))
								{
									$value = $this->encryptMetaValue($leadData["__$leadMeta"]);
									$clientMetaData[] = array(
											"record_id" => $client_id,
											"record_meta_id" => $clientMeta,
											"value" => $value,
									);
								}
            }

            $clientMetaData[] = array(
                "record_id" => $client_id,
                "record_meta_id" => 185, // Master Contract Number
                "value" => "$contractNumber-00",
            );

            $this->db->reset_query();
            $metaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $clientMetaData);

            ////////Contract Creation
            $tempKey = "__" . LEAD_SERVICE_TYPE_META_ID;
            if(isset($leadData[$tempKey]) && !empty($leadData[$tempKey]))
            {							
							$serviceType = $leadData[$tempKey];
							foreach ($serviceType as $key => $service)
							{
									$recordData = array(
											"assigned_officer_id" => 1,
											"module_id" => CONTRACTS,
											"created_by" => $userId,
											"created_time" => time(),
									);

									$recordCreationSuccessful = $this->db->insert("anb_crm_record", $recordData);
									
									if ($recordCreationSuccessful === true)
									{
											$contract_id = $this->db->insert_id();
											$contract_ids[] = $contract_id;
											
											list($serviceShortName, $shortCode) = explode(" - ", $service);
											
											$tempKey = "__" . LEAD_COMPANY_NAME_META_ID;
											
											if(isset($leadData[$tempKey]) && !empty($leadData[$tempKey]))
											{										
												$client_name = $leadData[$tempKey];
											}
											else
											{
												$client_name = '';
											}	

											$clientMetaData = array(
													array(
															"record_id" => $contract_id,
															"record_meta_id" => 160, // Contract Name
															"value" => $client_name . " - " . $shortCode,
													),
													array(
															"record_id" => $contract_id,
															"record_meta_id" => 161, // Client Name
															"value" => $client_id,
													),
													array(
															"record_id" => $contract_id,
															"record_meta_id" => 162, // Stage
															"value" => 'Waiting for Technical Assignment',
													),
													array(
															"record_id" => $contract_id,
															"record_meta_id" => 163, // Service Type
															"value" => $service,
													),
													array(
															"record_id" => $contract_id,
															"record_meta_id" => 165, // Contract number
															"value" =>  "$contractNumber-$shortCode",
													),
											);

										
											foreach ($contractMetaMapping as $leadMeta => $clientMeta)
											{
												if(isset($leadData["__$leadMeta"]) && !empty($leadData["__$leadMeta"]))
												{
													$value = $this->encryptMetaValue($leadData["__$leadMeta"]);
													$clientMetaData[] = array(
															"record_id" => $contract_id,
															"record_meta_id" => $clientMeta,
															"value" => $value,
													);
												}
											}

											$this->db->reset_query();
											$contractMetaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $clientMetaData);
									}
									else
									{
											$this->clearRecord($client_id);
											foreach ($contract_ids as $index => $id){
													$this->clearRecord($id);
											}

											return "Error! Contract creation failed. Please try again later";
									}
							}
						}
        }
        else
        {
            return "Error! Client creation failed. Please try again later";
        }

        global $RECORD_STATUS;
        $recordData = array(
            "record_status" => $RECORD_STATUS['CYCLE_COMPLETED'],
            "modified_by" => $userId,
            "modified_time" => time(),
        );

        $this->db->where('id', $lead_id);
        $recordUpdateSuccessful = $this->db->update("anb_crm_record", $recordData);

        return true;
    }

    function updateMetaMapping(){
        $updateLeadClientMetaMapping = array();
        $updateLeadContractMetaMapping = array();
        $leadMeta = $this->loadModulesMeta(LEADS_PLURAL_NAME);

        foreach ($leadMeta as $key => $meta){
            $name = str_replace(" ", "_", $meta["name"]);
            if ($this->getPost("client_$name") != '') {
                $values = explode("_", $this->getPost("client_$name"));
                $updateLeadClientMetaMapping[] = array(
                    "from_module_id" => $values[0],
                    "from_meta_id" => $values[1],
                    "to_meta_id" => $values[2],
                    "to_module_id" => $values[3],
                );
            }
            if ($this->getPost("contract_$name") != '') {
                $values = explode("_", $this->getPost("contract_$name"));
                $updateLeadContractMetaMapping[] = array(
                    "from_module_id" => $values[0],
                    "from_meta_id" => $values[1],
                    "to_meta_id" => $values[2],
                    "to_module_id" => $values[3],
                );;
            }
        }

        $this->db->empty_table('anb_crm_conversion_mapping');
        $this->db->reset_query();
        $clientMapping = $contractMapping = 0;
        if (count($updateLeadClientMetaMapping) > 0) {
            $clientMapping = $this->db->insert_batch('anb_crm_conversion_mapping', $updateLeadClientMetaMapping);
        }
        $this->db->reset_query();
        if (count($updateLeadContractMetaMapping) > 0) {
            $contractMapping = $this->db->insert_batch('anb_crm_conversion_mapping', $updateLeadContractMetaMapping);
        }

        return ($clientMapping && $contractMapping);
    }

    function updatePrimaryView($currentModule){
        $metaFields = $this->loadModulesViewData($currentModule);
        $updateMeta = array();

        foreach ($metaFields as $key => $meta){
            $metaId = $meta['id'];
            if ($this->getPost($metaId) == 'yes'){
                $updateMeta[] = array(
                    "id" => $metaId,
                    "display_in_short_view" => 1,
                );
            } else {
                $updateMeta[] = array(
                    "id" => $metaId,
                    "display_in_short_view" => 0,
                );
            }
        }
        $this->db->reset_query();
        $metaUpdated = $this->db->update_batch('anb_crm_record_meta', $updateMeta, "id");
        return (bool) $metaUpdated;
    }

    function changeOwner($userId, $massOwner = false, $ids = null, $newOwner = null){
        $ret = array(
            "status" => true,
            "message" => '',
        );
        $idList = (!$massOwner) ? array($this->getPost("id")) : explode(",", $ids);
        $owner = (!$massOwner) ? $this->getPost("newOwner") : $newOwner;
        $recordData = array();

        foreach ($idList as $key => $id){
            $recordData[] = array(
                "id" => $id,
                "assigned_officer_id" => $owner,
                "modified_by" => $userId,
                "modified_time" => time(),
            );
        }

        $recordUpdateSuccessful = $this->db->update_batch("anb_crm_record", $recordData, "id");
        if ($recordUpdateSuccessful == 0) {
            $ret['status'] = false;
            $ret['message'] = "Server error! Please try again later.";
        }

        return $ret;
    }

    function clearRecord($recordId){
        $this->db->reset_query();
        $this->db->where("id", $recordId);
        $this->db->delete('anb_crm_record');

        $this->db->reset_query();
        $this->db->where("record_id", $recordId);
        $this->db->delete('anb_crm_record_meta_value');

        $this->db->reset_query();
        $this->db->where("record_id", $recordId);
        $this->db->delete('anb_crm_note');

        $this->db->reset_query();
        $this->db->where("record_id", $recordId);
        $this->db->delete('anb_crm_attachment');

        $this->db->reset_query();
        $this->db->where("record_id", $recordId);
        $this->db->delete('anb_crm_activities');

        return true;
    }

    /*
     *
     *
     *
     * Helper Function Starts
     *
     *
     *
     * */

    function automation($currentData, $record_id, $type = 'New', $old_data = null){
        global $AUTOMATION_META_IDS;

        foreach ($currentData['meta'] as $key => $metaValue){
            if ($metaValue["record_meta_id"] == '26' && $metaValue['value'] != 'None'){ //"Company Information Video Validity"
                $runAutomation = true;
                if (isset($old_data["__26"])) {
                    if ($metaValue['value'] == $old_data["__26"]) $runAutomation = false;
                }
                if ($runAutomation) $this->automationUpdateVideoUrl($record_id, $metaValue["value"], $AUTOMATION_META_IDS["26"]);
            } else if ($metaValue["record_meta_id"] == '28' && $metaValue['value'] != 'None'){ ////"COMPANY INFORMATION VIDEO VALIDITY (USA)"
                $runAutomation = true;
                if (isset($old_data["__28"])) {
                    if ($metaValue['value'] == $old_data["__28"]) $runAutomation = false;
                }
                if ($runAutomation) $this->automationUpdateVideoUrl($record_id, $metaValue["value"], $AUTOMATION_META_IDS["28"], 'USA');
            }
        }
    }

    function automationUpdateVideoUrl($recordId, $no_of_days, $updateFieldMetaId, $country = 'Canada'){
        if ($country == 'Canada'){
            $url = "anbruch.com/anbruch-the-ultimate-recovery-firm/?";
        } else if ($country == 'USA'){
            $url = "anbruch.com/anbruch-the-ultimate-recovery-firm-usa/?";
        } else {
            return true;
        }

        $validityTime = time() + ( (int)$no_of_days * 24 * 60 * 60 );

        $recordMetaData = array(
            "value" => ($url . "token=" . md5($validityTime) . "&ut=" . dechex($validityTime)),
        );

        $this->db->where('record_id', $recordId);
        $this->db->where('record_meta_id', $updateFieldMetaId);
        $recordUpdateSuccessful = $this->db->update("anb_crm_record_meta_value", $recordMetaData);

        return $recordUpdateSuccessful;
    }

    function encryptMetaValue($recordFieldMetaValue){
        $value = '';
        if (is_array($recordFieldMetaValue)){
            foreach ($recordFieldMetaValue as $key => $string){
                $value .= ($value == '') ? $string : (MULTIPLE_OPTION_SEPARATOR."$string");
            }
        } else {
            $value = $recordFieldMetaValue;
        }

        return $value;
    }

    function decryptMetaValue($recordFieldMetaValue){
        return (strpos($recordFieldMetaValue, MULTIPLE_OPTION_SEPARATOR) !== false) ? explode(MULTIPLE_OPTION_SEPARATOR, $recordFieldMetaValue) : $recordFieldMetaValue;
    }

    function getFormFieldData($offset = "__"){
        $ret = array();
        foreach ($_REQUEST as $key => $value){
            if (strpos($key, $offset) !== false){
                $id = str_replace($offset, "", $key);
                $ret[$id] = $this->getPost($key);
            }
        }

        return $ret;
    }

    function checkWritable($id){
        global $RECORD_STATUS;
        $this->db->select("*");
        $this->db->where("r.record_status", $RECORD_STATUS['CYCLE_RUNNING']);
        $this->db->where("r.id", $id);
        $res = $this->db->get('anb_crm_record as r');
        return ($res->num_rows() > 0) ? true : false;
    }

    function filterRawData($rawData, $meta_fields){
        $ret = array(
            "status" => true,
            "message" => '',
            "module_id" => '',
            "assigned_officer_id" => '',
            "data" => array(),
        );

        foreach ($meta_fields as $key => $meta) {
            $valueToCheck = (isset($rawData[$meta['id']])) ? $rawData[$meta['id']] : '';
            //Is Required check
            if ($meta['is_required'] == 1 && $valueToCheck == '') {
                $ret["status"] = false;
                $ret["message"] = $meta["name"] . " is required.";
                break;
            } else {
                $ret["data"][$meta['id']] = $valueToCheck;
            }

            if ($ret['module_id'] == '') $ret['module_id'] = $meta['module_id'];
            if ($ret['assigned_officer_id'] == '') $ret['assigned_officer_id'] = $rawData["0"];
        }

        return $ret;
    }

    function textOnly($value){
        $ret = '';
        $approved_char = "abcdefghijklmnopqrstuvwxyz 0123456789";
        for ($i = 0; $i < strlen($value); $i++) {
            if (strpos($approved_char, strtolower($value[$i])) !== false) $ret .= $value[$i];
        }

        return $ret;
    }


    // Check Booking Guest Exist

    function is_booking_guest_exist($booking_id,$guest){
    	$query= $this->get_where('anb_crm_bookings_guests',['booking_id'=>$booking_id,'guest'=>$guest]);
        return $query->num_rows()<=1?true:false;
    }

    function getWebBookingData($rowno=0,$rowperpage=10,$order = 'DESC',$order_by = 'name') 
    {
    	$this->db->select("*");
		$this->db->order_by($order_by, $order);
		if(!empty($rowperpage))
		{
			$this->db->limit($rowperpage, $rowno);
		}
		$qry = $this->db->get('anb_crm_web_booking');
		return $qry->result_array();
	}

	public function send_notification(){
		   $today = date('Y-m-d');
		   $this->db->select("e.*,b.*");
        $this->db->where("e.notification_date", $today);
        $this->db->join('event_notification e', 'e.event_id = b.id');
        $qry = $this->db->get('anb_crm_bookings as b');
		return $qry->result_array();
	}
	public function booking_details($id){
				$this->db->where('id',$id);
		$qry = $this->db->get('anb_crm_bookings');
        $ret = $qry->result_array();
		return $ret;
	}
}
