<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class Report1Model extends BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function loadBookingsList($own, $fromDate="", $toDate="")
	{
		$res = [];
		if($fromDate!="" && $toDate!="")
		{
			$this->db->select("ac.*, p.first_name, p.last_name");
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');			

			if($own!="")
			{
				$this->db->where("ac.created_by", $own);
			}
			
			$this->db->where("ac.booking_date >=", $fromDate);	
			$this->db->where("ac.booking_date <=", $toDate);

			$this->db->order_by("ac.booking_date", "DESC");
			
			$qry = $this->db->get('anb_crm_bookings ac');
			$res = $qry->result_array();
			return $res;
		}
	}
	
	public function loadContractsMetaList($own)
	{
		$module_id = 3;
		
		$retArr = [];
		
		$this->db->select("m.name");

		$this->db->where("m.display_in_short_view", 1);		
		$this->db->where("m.module_id", $module_id);		

		$qry = $this->db->get('anb_crm_record_meta m');
		$retArr = $qry->result_array();		
		
		return $retArr;
	}
	
	public function loadContractsList($own, $fromDate="", $toDate="", $stage="")
	{
		$module_id = 3;
		
		$retArr = [];
		
		$this->db->select("ac.*, p.first_name, p.last_name, o.first_name as ofirst_name, o.last_name as olast_name");
		$this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
		$this->db->join('anb_crm_users_personal_info o', 'o.user_id = ac.assigned_officer_id', 'left');
	
		if($own!="")
		{
			$this->db->where("ac.created_by", $own);
		}

		$this->db->where("ac.created_time >=", strtotime($fromDate));	
		$this->db->where("ac.created_time <=", strtotime($toDate));
			
		$this->db->where("ac.module_id", $module_id);
		
		$qry = $this->db->get('anb_crm_record ac');
		$retArr = $records = $qry->result_array();
		//echo '<pre>';print_r($retArr);
		if(!empty($records))
		{
			foreach($records as $key=>$record)
			{
				$record_id = $record["id"];
				$this->db->select("mv.*, m.name as field_name");
				$this->db->join('anb_crm_record_meta m', 'm.id = mv.record_meta_id', 'left');
			
				$this->db->where("m.display_in_short_view", 1);		
				$this->db->where("mv.record_id", $record_id);		
				$qry = $this->db->get('anb_crm_record_meta_value mv'); 
				$record_mv = $qry->result_array();
				//echo '<pre>';print_r($record_mv);
				//echo $stage;
				if($stage!="")
				{
					if($record_mv[1]['value']==$stage)
					{
						$retArr[$key]["record_mv"] = $record_mv;	
					}
					else
					{
						unset($retArr[$key]);
					}					
				}
				else
				{
					$retArr[$key]["record_mv"] = $record_mv;					
				}				
				
			}
		}		
		//echo '<pre>';print_r($retArr);die;
		return $retArr;
	}


	        // Fetch records
	public function getData($rowno,$rowperpage,$own,$fromDate="", $toDate="") {

  	  $this->db->select("ac.*, p.first_name, p.last_name");
      $this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');	

	   if($own!="")
		{
			$this->db->where("ac.created_by", $own);
		}

		if($fromDate!="" && $toDate!="")
		{

	    	$this->db->where("ac.booking_date >=", $fromDate);	
			$this->db->where("ac.booking_date <=", $toDate);

	     }

	  $this->db->limit($rowperpage, $rowno);
	  $qry = $this->db->get('anb_crm_bookings ac');
	  return $qry->result_array();
    }

	// Select total records
	public function getrecordCount($own, $fromDate="", $toDate="") {

	  $this->db->select('count(*) as allcount');
	  $this->db->from('anb_crm_bookings');

	  if($own!="")
		{
			$this->db->where("anb_crm_bookings.created_by", $own);
		}

	  if($fromDate!="" && $toDate!="")
	    {

		$this->db->where("anb_crm_bookings.booking_date >=", $fromDate);	
		$this->db->where("anb_crm_bookings.booking_date <=", $toDate);

	   }

	  $query = $this->db->get();
	  $result = $query->result_array();

	  return $result[0]['allcount'];
	}
		
	
}
