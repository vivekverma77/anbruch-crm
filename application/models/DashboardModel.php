<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class DashboardModel extends BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_total_modules_count($module_id=null)
	{
		$this->db->select('*');
		if($module_id!=null)
		{
			$this->db->where('module_id',$module_id);
		}
		$res = $this->db->get('anb_crm_record');
		$num_records = count($res->result_array());
		return $num_records;		
	}
	
	public function get_total_appointment_count($record_id=null, $status=null)
	{
		$this->db->select('*');
		if($record_id!=null)
		{
			$this->db->where('record_id',$record_id);
		}
		if($status!=null)
		{
			$this->db->where('status',$status);
		}
		$res = $this->db->get('anb_crm_bookings');
		$num_records = count($res->result_array());
		return $num_records;		
	}
	
	public function get_today_leads_list($arr_filters, $module_name="")
	{
		$ret = array();
		$this->db->select("r.id");
		$this->db->where("r.plural_name", $module_name);
		$res = $this->db->get('anb_crm_modules as r');
		
		foreach ($res->result_array() as $meta) {
			$module_id = $meta['id'];
		}		
		
		foreach($arr_filters as $filter_name)
		{
			$this->db->select("u.id");
			$this->db->where("u.name", $filter_name);
			$this->db->where("u.module_id", $module_id);
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
   function recentRecordForDashboard($recordStatus = null, $owner = null, $search_filter = null, $npage_no = 1, $limit = 25, $sort_column = 'Company Name', $sort_order = 'ASC', $keyword = '', $module_name = '' , $from_date ='', $page_id ='')
	{
		/*print_r($owner);
		die();*/
		$ret = array();
		global $RECORD_STATUS;
		$recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
		$owner = ($owner == null) ? 1 : $owner;
	 
		//$module_name = $this->getPost("cm");	        
		//echo $module_name; die;

		$page = ($this->getPost("page") != '') ? $this->getPost("page") : 1;
		$offsetStart = ( ($page - 1) * RECORD_LIMIT_IN_EACH_PAGE) + 1;
		$displayMetaIds = array();
		$module_id = '';

		$this->db->select("m.id, m.name, m.type, mod.id as module_id");
		$this->db->join('anb_crm_modules mod', 'm.module_id = mod.id', 'left');
		$this->db->where("m.display_in_short_view", "1");
		$this->db->where("mod.plural_name", $module_name);
		$this->db->order_by("m.display_sort_id", "ASC");
		$res = $this->db->get("anb_crm_record_meta m");


		switch($module_name)
		{
			case 'Clients':
				$sort_column = 'Client Name';
				break;
			case 'Leads':
				$sort_column = 'Company Name';
				break;					
			case 'Contracts':
				$sort_column = 'Contract Name';
				break;					
		}

		//echo '<pre>';print_r($res->result_array()); die;
 
		foreach($res->result_array() as $displayMeta)
		{
			$displayMetaIds[$displayMeta["id"]] = $displayMeta["name"];
			if ($module_id == '') $module_id = $displayMeta["module_id"];
			if($displayMeta['name'] == $sort_column)
			{
				$sort_id = $displayMeta['id'];
			}
		}
		
		$extraMetaIds[21] = "Closer";
		$extraMetaIds[22] = "Opener";
		$this->db->reset_query();
		/* $this->db->cache_on();*/

		$additionalFieldName = ($module_name == CONTRACTS_PLURAL_NAME) ? ", vvv.vv_client_name" : "";
	 
		if ($module_name == CONTRACTS_PLURAL_NAME) 
		{
			$this->db->join('(SELECT vv.value as vv_client_name, vv.record_id as vv_record_id FROM anb_crm_record_meta_value vv where vv.record_meta_id = 84) as vvv', 'vvv.vv_record_id = r.id', 'left');
		}
		
		//echo '<pre>';print_r($displayMetaIds); die;
		
		$extraSelect = '';
		foreach($displayMetaIds as $metaId => $meta)
		{
			$extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
			
			//echo '<pre>';print_r($extraSelect); 
			
			$this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');
		}
			
		$arr_rev = array_flip($displayMetaIds);
		//echo '<pre>';print_r($arr_rev); //die;
		//echo '<pre>';print_r($search_filter); //die;
		if(isset($search_filter) && count($search_filter))
		{
			foreach($search_filter as $k => $v)
			{
				if($v && !in_array($k, $arr_rev))
				{
					
					//echo '<pre>search_filter';print_r($search_filter); die;
					
					$extraSelect .= ($extraSelect == '') ? "ad$k.value as value$k" : ", ad$k.value as value$k";
					
					//$dateSelect = '';
					//if($from_date!="" )  $dateSelect = "$v.' >=', strtotime($from_date)";			
					
					$this->db->join("(SELECT sq$k.value, sq$k.record_id FROM anb_crm_record_meta_value sq$k where sq$k.record_meta_id = $k) as ad$k", "ad$k.record_id = r.id", 'left');	
				}
			}
		}   
				 
		//die('here');
		/*$this->db->join('anb_crm_modules mod', 'r.module_id = mod.id', 'left');
		$this->db->where("mod.plural_name", $module_name);*/
		
		//$this->db->join("anb_crm_record_meta_value as rmv", "rmv.record_id=r.id", "left");
		//$this->db->or_where("rmv.value", $owner);
		
		//$this->db->or_where("rmv.value", $owner);
		//$where = '(wrk_dlvrd_sts="open" or wrk_cl_sts = "Success")';
		//$this->db->where($where);
		
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
		
		if($keyword) $this->db->like("`ad$sort_id`.`value`", $keyword);

		//if($from_date!="")  $this->db->where('created_time >= ', strtotime($from_date));			
	
		$this->db->select("r.id");
		//$this->db->order_by("m.display_sort_id", "ASC");
		$this->db->distinct();
		$this->db->order_by("r.id", "DESC");
		//$this->db->limit(RECORD_LIMIT_IN_EACH_PAGE, $offsetStart);

		$res = $this->db->get('anb_crm_record as r');



		//echo '<pre>';print_r($res->result_array()); die;
		$limits_per_page = $limit;
		$num_records = count($res->result_array());

		$total_page = ceil($num_records/$limits_per_page);
		$npage_no = ($npage_no > $total_page)?$total_page:$npage_no;
		if($npage_no == 0)
			$npage_no = 1;
		$start_rec_no = ($npage_no - 1) * $limits_per_page;
		$int_end_row = $start_rec_no + $limits_per_page;
		$int_end_row = ($int_end_row > $num_records)?$num_records:$int_end_row;   
		
		//echo $this->db->last_query(); die;
		//if($module_name == 'Leads')
		//$last_sql = str_replace('DISTINCT `r`.`id`', "r.*, $extraSelect$additionalFieldName", $this->db->last_query())." ORDER BY `ad$sort_id`.`value` $sort_order LIMIT $start_rec_no, ". $limits_per_page;
		//else
		//print_r($sort_id);
		//die();$last_sql = str_replace('DISTINCT `r`.`id`', "r.*, $extraSelect$additionalFieldName", $this->db->last_query())." LIMIT $start_rec_no, ". $limits_per_page;
		/*print_r($page_id);
		die();
	*/	if($page_id == 1){
				$sort_order = 'DESC';
				$sort_id = 'ID';
			$last_sql = str_replace('DISTINCT `r`.`id`', "r.*, $extraSelect$additionalFieldName", $this->db->last_query())." $start_rec_no, ". $limits_per_page;
		}
		else{

		$last_sql = str_replace('DISTINCT `r`.`id`', "r.*, $extraSelect$additionalFieldName", $this->db->last_query())." LIMIT $start_rec_no, ". $limits_per_page;
		}
		//echo $last_sql = $this->db->last_query(); die;
		

		$page_details['start_record'] = $start_rec_no;
		$page_details['end_record'] = $int_end_row;
		$page_details['total_records'] = $num_records;
		$page_details['total_page'] = $total_page;
		$page_details['cur_page'] = $npage_no;
		$res = $this->db->query($last_sql);
		//die();
		
		//echo $last_sql = $this->db->last_query(); die;
		//echo '<pre>';print_r($displayMetaIds); die;
		///echo '<pre>';print_r($res->result_array()); die;
		
		//if($from_date!="")  { echo '<pre>';print_r($res->result_array());die; }
		
		foreach ($res->result_array() as $record) 
		{
			foreach ($displayMetaIds as $metaId => $metaName)
			{
				$value = $this->decryptMetaValue($record["value$metaId"]);
				$ret[$record["id"]]["meta"]["$metaName"] = $value;
			}

			//echo '<pre>';print_r($value); 
			
			//echo date('Y-m-d H:i:s', $record["created_time"]);
			$ret[$record["id"]]["static"]["created_by"] = $record["created_by"];
			$ret[$record["id"]]["static"]["created_time"] = $record["created_time"];
			$ret[$record["id"]]["static"]["modified_by"] = $record["modified_by"];
			$ret[$record["id"]]["static"]["modified_time"] = $record["modified_time"];
			$ret[$record["id"]]["static"]["record_status"] = $record["record_status"];
			if ($module_name == CONTRACTS_PLURAL_NAME && $record["vv_client_name"] != NULL)
			{
				$ret[$record["id"]]["static"]["client_name"] = $record["vv_client_name"];
			}
		}
		//die;
		//echo '<pre>';print_r($ret); die;

		foreach ($ret as $key => $value) 
		{
			//if ($key != 'total_record') ksort($ret[$key]["meta"]);
			if ($module_name == CONTRACTS_PLURAL_NAME && isset($ret[$key]["meta"]["Client Name"])) 
			{
				$ret[$key]["meta"]["Client Name"] = $ret[$key]["static"]["client_name"];
			}
		}

		/*$this->db->cache_off();*/
		/*$this->debug($this->db->last_query());*/
		$arr_res[0] = $ret;
		$arr_res[1] = $page_details;

		//echo '<pre>';print_r($arr_res); die;
		
		return $arr_res;
	}
	function decryptMetaValue($recordFieldMetaValue){
			return (strpos($recordFieldMetaValue, MULTIPLE_OPTION_SEPARATOR) !== false) ? explode(MULTIPLE_OPTION_SEPARATOR, $recordFieldMetaValue) : $recordFieldMetaValue;
	}
}
