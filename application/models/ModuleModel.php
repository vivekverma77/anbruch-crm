<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class ModuleModel extends BaseModel
{
	public function __construct()
	{
			parent::__construct();
	}

	function saveEmail($created_by,$from,$to,$cc="",$bcc="",$subject,$content,$attachment="",$record_id=null)
	{
		$data["created_by"] = $created_by;
		$data["from"] = $from;
		$data["to"] = $to;
		$data["cc"] = $cc;
		$data["bcc"] = $bcc;
		$data["subject"] = $subject;
		$data["content"] = $content;				
		$data["attachment"] = isset($attachment) ? $attachment :'';				
		$data['record_id'] = isset($record_id) && !empty($record_id)?$record_id:''; 
		$data["created_time"] = date('Y-m-d H:i:s');
			
		$this->db->insert("anb_crm_emails", $data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;		
	}

	public function get_email(){
 
 $this->db->select('*');
 $this->db->from('anb_crm_emails');
 $data = $this->db->get();

 $ret = $data->result_array();
 return $ret;


	}
	
	function loadQualified($user_id, $record_id)    
	{
		 $this->db->select("ql.*");
		//$this->db->where("qn.user_id", $user_id);
		$this->db->where("ql.record_id", $record_id);
		//$this->db->where("ql.qualify_status",1);
		$res = $this->db->get('qualify_lead ql');
		$ret = $res->row();
		return $ret;
	}
	
	/*function loadQualified($user_id, $record_id)    
	{
		$this->db->select("qn.*");
		$this->db->where("qn.user_id", $user_id);
		$this->db->where("qn.record_id", $record_id);
		
		$res = $this->db->get('anb_crm_qualify_now qn');
		$ret = $res->row_array();

		return $ret;
	}*/
	function addQualifyNow()
	{	
		/*print_r($this->getPost("selling_goods_to_canada"));
		exit;*/
		if($this->getPost("selling_goods_to_canada")=="yes")
		{
			$recordData = array(
				"user_id" => $this->getPost("user_id"),
				"record_id" => $this->getPost("record_id"),
				"selling_goods_to_canada" => $this->getPost("selling_goods_to_canada"),
				"annual_sales_to_canada" => $this->getPost("annual_sales_to_canada"),
				
				"custom_broker_to_import_goods" => $this->getPost("custom_broker_to_import_goods"),
				"sales_tax_gst" => $this->getPost("sales_tax_gst"),
				"sales_tax_pst" => $this->getPost("sales_tax_pst"),
				"sales_tax_qst" => $this->getPost("sales_tax_qst"),
				"sales_tax_all" => $this->getPost("sales_tax_all"),
				"sales_tax_returns" => $this->getPost("sales_tax_returns"),
				"sales_stored_in_usa" => $this->getPost("sales_stored_in_usa"),
				"sales_tax_return_filed_from" => $this->getPost("sales_tax_return_filed_from"),
				
				"tax_consultant_conduct" => $this->getPost("tax_consultant_conduct"),
				
				"government_audit" => $this->getPost("government_audit"),
				
				"operation_in_canada" => $this->getPost("operation_in_canada"),
				
				"created_time" => date('Y-m-d H:i:s'),
			);
		
			if($this->getPost("annual_sales_to_canada")=='other')
			{
				$recordData['annual_sales_to_canada_other_amount'] = $this->getPost("annual_sales_to_canada_other_amount");
			}

			if($this->getPost("sales_tax_return_filed_from")=='other')
			{
				$recordData['sales_tax_return_filed_from_other'] = $this->getPost("sales_tax_return_filed_from_other");
			}

			if($this->getPost("tax_consultant_conduct")=='yes')
			{
				$recordData['tax_consultant_conduct_recoveries'] = $this->getPost("tax_consultant_conduct_recoveries");
			}

			if($this->getPost("government_audit")=='yes')
			{
				$recordData['government_audit_areas'] = $this->getPost("government_audit_areas");
			}

			if($this->getPost("operation_in_canada")=='yes')
			{
				$recordData['operation_in_canada_type'] = $this->getPost("operation_in_canada_type");
			}
		}
		else
		{
			$recordData = array(
				"user_id" => $this->getPost("user_id"),
				"record_id" => $this->getPost("record_id"),
				"selling_goods_to_canada" => $this->getPost("selling_goods_to_canada"),
				"created_time" => date('Y-m-d H:i:s'),
			);
		}

		$recordCreationSuccessful = $this->db->insert("anb_crm_qualify_now", $recordData);
		
		return true;
		
	}

	function loadModulesMeta($module)
	{
			/*$this->db->cache_delete_all();*/
		$ret = array();
			$this->db->select("rm.id, rm.name, rm.type, rm.option_value, rm.validation_rule, rm.is_unique, rm.is_required, rm.is_readonly, rm.permission, rm.lookup_module_id, m.id as module_id, m.plural_name, s.name as section_name");
			$this->db->where("m.plural_name", $module);
			if($module == 'Contracts'){
				$columnNames = array('Invoiced Amount (CAD)', 'Invoice Paid (CAD)', 'Invoice Date', 'Final Invoice Number');
				$this->db->where_not_in('rm.name', $columnNames);
			}
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


	/*function loadModulesMeta($module)
	{

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
*/

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
	
	function loadModulesSortingData($module){
			$ret = array();
			$this->db->select("rm.id, rm.name, rm.display_sort_id, rm.display_in_short_view, rm.type, rm.option_value, rm.validation_rule, rm.is_unique, rm.is_required, rm.is_readonly, rm.permission, rm.lookup_module_id, m.id as module_id, m.plural_name, s.name as section_name");
			$this->db->where("m.plural_name", $module);
			$this->db->where("rm.display_in_short_view", 1);
			$this->db->join('anb_crm_modules m', 'm.id = rm.module_id', 'left');
			$this->db->join('anb_crm_section s', 's.serial = rm.section_id  AND s.module_id = m.id', 'left');
			$this->db->order_by('rm.display_sort_id', 'asc');
			$res = $this->db->get('anb_crm_record_meta as rm');
			foreach ($res->result_array() as $modules_meta) {
					$modules_meta['name'] = $this->textOnly($modules_meta['name']);
					$ret[] = $modules_meta;
			}

			return $ret;
	}
    
	function updateSortingOrder($action, $id, $module_name, $idx)
	{
		//Get the module id
		$this->db->select('m.id as module_id');
		$this->db->where("m.plural_name", $module_name);
		$res = $this->db->get("anb_crm_modules m");
		foreach ($res->result_array() as $modules_meta) {
			 $module_id = $modules_meta['module_id'];
		}
		$this->db->reset_query();
		if($action == 'up')
		{		
			$this->db->select('rm.id');
			$this->db->where("rm.module_id", $module_id);
			$this->db->where("rm.display_in_short_view", 1);
			$this->db->where("rm.display_sort_id", ($idx-1));
			$res = $this->db->get('anb_crm_record_meta as rm');
			$previous_id = 0;
			foreach ($res->result_array() as $modules_meta) {
			     $previous_id = $modules_meta['id'];
        	}

        	$this->db->reset_query();
			$recordData = array(
                "display_sort_id" => ($idx-1)
            );

            $this->db->where('id', $id);
            $this->db->where('module_id', $module_id);
            $this->db->update("anb_crm_record_meta", $recordData);
            $this->db->reset_query();
            
			$recordData = array(
                "display_sort_id" => ($idx)
            );

            $this->db->where('id', $previous_id);
            $this->db->where('module_id', $module_id);
            $this->db->update("anb_crm_record_meta", $recordData);            
		}
		if($action == 'down')
		{

			$this->db->select('rm.id');
			$this->db->where("rm.module_id", $module_id);
			$this->db->where("rm.display_in_short_view", 1);
			$this->db->where("rm.display_sort_id", ($idx+1));
			$res = $this->db->get('anb_crm_record_meta as rm');
			$previous_id = 0;
			foreach ($res->result_array() as $modules_meta) {
			     $next_id = $modules_meta['id'];
        	}

        	$this->db->reset_query();
			$recordData = array(
                "display_sort_id" => ($idx+1)
            );

            $this->db->where('id', $id);
            $this->db->where('module_id', $module_id);
            $this->db->update("anb_crm_record_meta", $recordData);
            $this->db->reset_query();
            
			$recordData = array(
                "display_sort_id" => ($idx)
            );

            $this->db->where('id', $next_id);
            $this->db->where('module_id', $module_id);
            $this->db->update("anb_crm_record_meta", $recordData);            
		}		
	}
	
	function updateMissingOrders($module_name)
	{
		//Get the module id
		$this->db->select('m.id as module_id');
		$this->db->where("m.plural_name", $module_name);
		$res = $this->db->get("anb_crm_modules m");
		foreach ($res->result_array() as $modules_meta) {
			 $module_id = $modules_meta['module_id'];
		}
		$this->db->reset_query();
		
		//Get the max sorting id
		$row = $this->db->query('SELECT IFNULL(COUNT(*), 0) AS `num_missing` FROM `anb_crm_record_meta` WHERE display_in_short_view = 1 AND display_sort_id = 0 AND module_id = '.$module_id)->row();
		if ($row) {
			$num_missing = $row->num_missing; 
		}
		if($num_missing > 0)
		{
			$maxid = 0;
			$row = $this->db->query('SELECT MAX(display_sort_id) AS `maxid` FROM `anb_crm_record_meta` WHERE display_in_short_view = 1 AND module_id = '.$module_id)->row();
			if ($row) {
				$maxid = $row->maxid; 
			}
			$this->db->reset_query();
			$query = "UPDATE anb_crm_record_meta, (SELECT @a:= $maxid) AS a SET display_sort_id = (@a:=@a+1) WHERE module_id = $module_id AND display_in_short_view = 1 AND display_sort_id = 0";
			$this->db->query($query);
		}
	}
	
	function loadRecord($recordStatus = null, $record_id = null)
	{
		$ret = array();
		$id = ($record_id == null) ? $this->getPost("id") : $record_id;
		global $RECORD_STATUS;
		$recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
		$officer = ''; $created_by = ''; $created_time = ''; $modified_by = ''; $modified_time = '';$lead_id = ''; $primary_contact = '';$zoom_id='';
		$this->db->select("r.*, v.record_meta_id, v.value");
		$this->db->where("r.record_status", $recordStatus);
		$this->db->where("r.id", $id);
		$this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id', 'left');
		$res = $this->db->get('anb_crm_record as r');
		foreach ($res->result_array() as $record)
		{
			$role_id = $this->App_model->getData('anb_crm_users','role_id', array('id' => $record['created_by']));

			$record["value"] = $this->decryptMetaValue($record["value"]);
			$id = "__" . $record["record_meta_id"];
			$ret[$id] = $record["value"];
			if ($officer == '') $officer = $record["assigned_officer_id"];
			if ($created_by == '') $created_by = $record["created_by"];
			if ($created_time == '') $created_time = $record["created_time"];
			if ($modified_by == '') $modified_by = $record["modified_by"];
			if ($modified_time == '') $modified_time = $record["modified_time"];
			if ($lead_id == '') $lead_id = $record["lead_id"];
			if ($primary_contact == '' ) $primary_contact = $record["primary_contact"];
			if ($zoom_id == '') $zoom_id = $record["zoom_id"];
		}
		$ret["__0"] = $officer;
		$ret["created_by"] = $created_by;
		$ret["created_time"] = $created_time;
		$ret["modified_by"] = $modified_by;
		$ret["modified_time"] = $modified_time;
		$ret["lead_id"] = $lead_id;
		$ret["zoom_id"] = $zoom_id;
		$ret["primary_contact"] = $primary_contact;
		$ret["lead_role_id"] = !empty($role_id) ? $role_id[0]['role_id'] : '';

		return $ret;
	}
	function loadRecord1($recordStatus = null, $record_id = null)
	{
		$ret = array();
		$id = ($record_id == null) ? $this->getPost("id") : $record_id;
		global $RECORD_STATUS;
		$recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
		$officer = ''; $created_by = ''; $created_time = ''; $modified_by = ''; $modified_time = '';$lead_id = '';
		$this->db->select("r.*, v.record_meta_id, v.value");
		$this->db->where("r.id", $id);
		$this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id', 'left');
		$res = $this->db->get('anb_crm_record as r');
		foreach ($res->result_array() as $record)
		{
			$record["value"] = $this->decryptMetaValue($record["value"]);
			$id = "__" . $record["record_meta_id"];
			$ret[$id] = $record["value"];
			if ($officer == '') $officer = $record["assigned_officer_id"];
			if ($created_by == '') $created_by = $record["created_by"];
			if ($created_time == '') $created_time = $record["created_time"];
			if ($modified_by == '') $modified_by = $record["modified_by"];
			if ($modified_time == '') $modified_time = $record["modified_time"];
			if ($lead_id == '') $lead_id = $record["lead_id"];
		}
		$ret["__0"] = $officer;
		$ret["created_by"] = $created_by;
		$ret["created_time"] = $created_time;
		$ret["modified_by"] = $modified_by;
		$ret["modified_time"] = $modified_time;
		$ret["lead_id"] = $lead_id;	

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
			$this->db->order_by('a.id','desc');
			$res = $this->db->get('anb_crm_attachment a');
			foreach ($res->result_array() as $attachment) {
					$ret[] = array(
							"link" => $attachment["link"],
							"name" => $attachment["name"],
							"uploaded_by" => ($attachment["first_name"] . " " . $attachment["last_name"]),
							"uploaded_time" => $attachment["uploaded_time"],
							'status'=>$attachment['status'],
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
							"id" => $note["id"],
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
			/*$this->db->where("a.record_status", 2);*/
			$this->db->join('anb_crm_record_meta_value v', 'v.record_meta_id = m.id', 'left');
			/*$this->db->join("anb_crm_record a",'a.id = v.record_Id','left');*/
			$res = $this->db->get('anb_crm_record_meta as m');
			foreach ($res->result_array() as $contractMetaData) {
					$contractIds[] = $contractMetaData["record_id"];
			}
/*			print_r($contractIds);
			print_r($this->db->last_query());
			echo '<br>';
			*/
			foreach ($contractIds as $key => $contractId){
					$this->db->select("r.*, v.record_meta_id, v.value, p.first_name, p.last_name, m.name");
					$this->db->where("r.id", $contractId);
					$this->db->where_in('r.record_status', array(1,3));
					//$this->db->where_in("v.record_meta_id", array(160, 162, 163,169,164,175,165,161 ));
					$this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id', 'left');
					$this->db->join('anb_crm_record_meta m', 'm.id = v.record_meta_id', 'left');
					$this->db->join('anb_crm_users_personal_info p', 'r.assigned_officer_id = p.user_id', 'left');
					$res = $this->db->get('anb_crm_record as r');
					//print_r($this->db->last_query());
					/*print_r($this->db->last_query());
					print_r($res->result_array());*/
					
					foreach ($res->result_array() as $record) {
							$assignedOfficer = $record["first_name"] . " " . $record["last_name"];
							$ret[$contractId]["assigned_officer"] = $assignedOfficer;
							$ret[$contractId]["created_time"] = $record["created_time"];
							$ret[$contractId]["modified_time"] = $record["modified_time"];
							if ($record["record_meta_id"] == 160) $ret[$contractId]["contract_name"] = $record["value"];
							if ($record["record_meta_id"] == 162) $ret[$contractId]["stage"] = $record["value"];
							if ($record["record_meta_id"] == 163) $ret[$contractId]["service_type"] = $record["value"];
							if($record["module_id"] == 3){
								if($record["record_meta_id"] == 169){
						 			 $this->db->select('first_name, last_name');
									 $this->db->where('user_id', $record["value"]);
									 $techical_name = $this->db->get('anb_crm_users_personal_info');
									 $techicalname =$techical_name->result_array(); 		 		 	
										if(empty($techicalname)){
												$ret[$contractId]["technical_consultant"] = 'Technical consultant not available';
											}else{
											foreach ($techicalname as $name) {
												//die;
												$full_name = $name['first_name'] .' '. $name['last_name'];	
												$ret[$contractId]["technical_consultant"] = $full_name;
												}
											}	
									}
							if($record["record_meta_id"] == 164){
									$ret[$contractId]["signing_rate"] = $record["value"];
								}
							if($record['record_meta_id']==175){
								$ret[$contractId]["technical_expected_start_date"] = $record["value"];
							}
							if($record['record_meta_id']==165){
								$ret[$contractId]["contact_number"] = $record["value"];
							}	
							if($record["record_meta_id"] == 161){
									$this->db->select('value');
									$this->db->where('record_id', $record['value']);	
									$this->db->where('record_meta_id', 84);
									$client_name = $this->db->get('anb_crm_record_meta_value');
									$clientname = $client_name->result_array();
									if(empty($clientname)){
										$ret[$contractId]["contract_client"] = 'Client name not available';
									}
									else{
									foreach ($clientname as $value) {
										$cname = $value['value'];	
										$ret[$contractId]["contract_client"] = $cname;
									}
									}

					 				$this->db->select('value');
									$this->db->where('record_id', $record['value'])	;
									$this->db->where('record_meta_id', 101);
								 	$completed_on = $this->db->get('anb_crm_record_meta_value');	
									$complete_date = $completed_on->result_array();
									if(empty($complete_date) || empty($complete_date[0]['value'])){
										$ret[$contractId]["completed_on"] = 'Not Completed yet';
									}
									else{
										$ret[$contractId]["completed_on"] = $complete_date[0]['value'];	
									}

									$this->db->select('value');
									$this->db->where('record_id', $record['value'])	;
									$this->db->where('record_meta_id', 104);
									$closer_name = $this->db->get('anb_crm_record_meta_value');
									$closername = $closer_name->result_array();
									if(empty($closername) || empty($closername[0]['value'])){
										$ret[$contractId]["closer_name"] = 'Closer Name not available';
									}
									else{
									 	$this->db->select('first_name, last_name');
										$this->db->where('user_id',$closername[0]['value']);
										$cname=$this->db ->get('anb_crm_users_personal_info');
										$name = $cname->result_array();	
									if(empty($name)){
									$ret[$contractId]["closer_name"] = 'Not available';	
									}else{			 
										foreach ($name as $mvalue) {
										$ret[$contractId]["closer_name"] = $mvalue['first_name'].' '. $mvalue['last_name'];
									}
									}
									}
									$this->db->select('value');
									$this->db->where('record_id', $record['value']);	
									$this->db->where('record_meta_id', 103);
									$client_number = $this->db->get('anb_crm_record_meta_value');
									$clientnumber = $client_number->result_array();
									if(empty($clientnumber) || empty($clientnumber[0]['value'])){
										$ret[$contractId]["client_number"] = 'Client Number not available';
									}
									else{
									foreach ($clientnumber as $value) {
										$number = $value['value'];	
										$ret[$contractId]["client_number"] = $number;
										}
									}
									$this->db->select('value');
									$this->db->where('record_id', $record['value'])	;
									$this->db->where('record_meta_id', 101);
									$completed_on =$this->db->get('anb_crm_record_meta_value');	
									$complete_date = $completed_on->result_array();
									if(empty($complete_date) || empty($complete_date[0]['value'])){
										$ret[$contractId]["completed_on"] = 'Not Completed yet';
									}
									else{
										$ret[$contractId]["completed_on"] = $complete_date[0]['value'];	
									}
						}	
					}
				}
			}
			/*print_r($ret);
			die;loadModulesMeta*/
			return $ret;
		}

/*	function loadContracts(){
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
*/

	function loadRecordList($recordStatus = null, $owner = null, $search_filter = null, $npage_no = 1, $limit = 25, $sort_column = '', $sort_order = '', $keyword = '', $module_name = '' , $from_date ='', $page_id ='')
	{
		//print_r($owner);
		//die();
		$ret = array();
		global $RECORD_STATUS;
		$recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
		//$owner = ($owner == null) ? 1 : $owner;
	 
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

		if(isset($sort_column) && !empty($sort_column)){
			$sort_column = $sort_column;
		}
		else{
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
		}
		/*print_r($this->db->last_query());
		echo '<pre>';print_r($res->result_array()); die;
 */


		foreach($res->result_array() as $displayMeta)
		{
			$displayMetaIds[$displayMeta["id"]] = $displayMeta["name"];
			if ($module_id == '') $module_id = $displayMeta["module_id"];
			if($displayMeta['name'] == $sort_column)
			{
				$sort_id = $displayMeta['id'];
			}
		}
		
		if ($module_name == CONTRACTS_PLURAL_NAME && $keyword) {
				$this->db->select('record_meta_id');
				$this->db->like('value', $keyword);
				$result = $this->db->get("anb_crm_record_meta_value");
				foreach ($result->result_array() as $key => $fieldname) {
						$this->db->select('id');
						$this->db->where('id', $fieldname['record_meta_id']);
						$this->db->where('module_id', 3);
						$this->db->where('display_in_short_view', 1);
						$column_name = $this->db->get("anb_crm_record_meta");
						$result1 = $column_name->result_array();
						if(!empty($result1)){
							$sort_id = $result1[0]['id'];
						}
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
		if($keyword)
			$this->db->group_start();
		foreach($displayMetaIds as $metaId => $meta)
		{
			$extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
			
			//echo '<pre>';print_r($extraSelect); 
			
			$this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');

			if($keyword){
			    $this->db->or_like("`ad$metaId`.`value`", $keyword);
			}
		}
		if($keyword)
	    	$this->db->group_end();			
		$arr_rev = array_flip($displayMetaIds);
		//echo '<pre>';print_r($arr_rev); //die;
		//echo '<pre>';print_r($search_filter); //die;
		if(isset($search_filter) && count($search_filter))
		{
			foreach($search_filter as $k => $v)
			{
				if($v && !in_array($k, $arr_rev))
				{
					
		  // echo '<pre>search_filter';print_r($search_filter); die("one");
					
					$extraSelect .= ($extraSelect == '') ? "ad$k.value as value$k" : ", ad$k.value as value$k";
					
					//$dateSelect = '';
					//if($from_date!="" )  $dateSelect = "$v.' >=', strtotime($from_date)";			
					
					$this->db->join("(SELECT sq$k.value, sq$k.record_id FROM anb_crm_record_meta_value sq$k where sq$k.record_meta_id = $k) as ad$k", "ad$k.record_id = r.id", 'left');	
				}
			}
		} 

		$this->db->join("(SELECT uo.first_name, uo.last_name,acrmv1.record_id FROM anb_crm_record_meta_value acrmv1 join anb_crm_users_personal_info uo on uo.user_id=acrmv1.value where acrmv1.record_meta_id=22) as adopener", "adopener.record_id = r.id", 'left');

		$this->db->join("(SELECT uc.first_name, uc.last_name,acrmv2.record_id FROM anb_crm_record_meta_value acrmv2 join anb_crm_users_personal_info uc on uc.user_id=acrmv2.value where acrmv2.record_meta_id=21) as adcloser", "adcloser.record_id = r.id", 'left')
		;  
				 
		if($sort_column=='Modified By'){
			$this->db->join('anb_crm_users_personal_info u2','r.modified_by=u2.user_id','left');
		}

		
		$this->db->where("r.record_status", $recordStatus);
		$this->db->where("r.module_id", $module_id);
		if($owner){
			if($module_name == 'Leads'){
				$this->db->group_start();
					$this->db->where("r.assigned_officer_id", $owner);
					$this->db->or_where("ad22.value", $owner);
					$this->db->or_where("ad21.value", $owner);
				$this->db->group_end();	
			}
			else if($module_name == 'Clients')
			{
				$this->db->join('anb_crm_record_meta_value as rmv', 'rmv.record_id = r.id');
				$this->db->where('rmv.record_meta_id', 104);
				$this->db->group_start();
				$this->db->where("r.assigned_officer_id", $owner);
				$this->db->or_where('rmv.value',$owner);
				$this->db->group_end();	

			}
			else
			{	
				$this->db->join('anb_crm_record_meta_value as rmv', 'rmv.record_id = r.id');
				$this->db->where('rmv.record_meta_id', 169);
				$this->db->group_start();
				$this->db->where("r.assigned_officer_id", $owner);
				$this->db->or_where('rmv.value',$owner);
				$this->db->group_end();
			}
		}
		if(isset($search_filter) && count($search_filter))
		{
			foreach($search_filter as $k => $v)
			{  

				if($v){
					$vo = explode(" ",$v);
					$v1 = $vo[0];
					$v2 = $vo[1];
					// if((isset($v1) && !empty($v1)) && (isset($v2) && !empty($v2)))
					// 	{  $v = $v1 ; }

					if($k==22){
						$this->db->group_start();
						$this->db->where("`adopener`.`first_name`", $v1);
						$this->db->where("`adopener`.`last_name`", $v2);
						$this->db->group_end();
					}	
					elseif($k==21){
						$this->db->group_start();
						$this->db->where("`adcloser`.`first_name`", $v1);
						$this->db->where("`adcloser`.`last_name`", $v2);
						$this->db->group_end();
					}	
				 	else
						$this->db->where("`ad$k`.`value`", $v);
				}
			}
			
		}
		
		

		//if($from_date!="")  $this->db->where('created_time >= ', strtotime($from_date));			
	
		$this->db->select("r.id");
		//$this->db->order_by("m.display_sort_id", "ASC");
		$this->db->distinct();
		//$this->db->order_by("r.id", "DESC");
		//$this->db->limit(RECORD_LIMIT_IN_EACH_PAGE, $offsetStart);
		$res = $this->db->get('anb_crm_record as r');



		//echo '<pre>';print_r($res->result_array()); 
		//die;

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
			  $sort_order = 'ASC';
			  if ($module_name=='Leads') 
			  	$sort_id = 'value31';
			  if ($module_name=='Clients') 
			  	$sort_id = 'value84';
			  if ($module_name=='Contracts') 
			  	$sort_id = 'value197';

			$last_sql = str_replace('DISTINCT `r`.`id`', "DISTINCT r.*,adcloser.*,adopener.*, $extraSelect$additionalFieldName", $this->db->last_query())." ORDER BY `$sort_id` $sort_order LIMIT $start_rec_no, ". $limits_per_page;
		}
		else{

		if($sort_column=='Modified Time'){
				
			$last_sql = str_replace('DISTINCT `r`.`id`', "DISTINCT r.*,adcloser.*,adopener.*, $extraSelect$additionalFieldName", $this->db->last_query())." ORDER BY r.modified_time $sort_order LIMIT $start_rec_no, ". $limits_per_page;	

		}elseif($sort_column=='Modified By'){
				
			$last_sql = str_replace('DISTINCT `r`.`id`', "DISTINCT r.*,u2.first_name,adcloser.*,adopener.*, $extraSelect$additionalFieldName", $this->db->last_query())." ORDER BY u2.first_name $sort_order LIMIT $start_rec_no, ". $limits_per_page;	

		}else{

			$last_sql = str_replace('DISTINCT `r`.`id`', "DISTINCT r.*,adcloser.*,adopener.*, $extraSelect$additionalFieldName", $this->db->last_query())." ORDER BY `ad$sort_id`.`value` $sort_order LIMIT $start_rec_no, ". $limits_per_page;
		}

		}
		//echo $last_sql = $this->db->last_query(); die;
		

		$page_details['start_record'] = $start_rec_no;
		$page_details['end_record'] = $int_end_row;
		$page_details['total_records'] = $num_records;
		$page_details['total_page'] = $total_page;
		$page_details['cur_page'] = $npage_no;
		$res = $this->db->query($last_sql);
		//die();
		
		// echo $this->db->last_query();
		// die("test");
		//echo $last_sql = $this->db->last_query(); die;
		//echo '<pre>';print_r($displayMetaIds); die;
		///echo '<pre>';print_r($res->result_array()); die;
		
		//if($from_date!="")  { echo '<pre>';print_r($res->result_array());die; }
		function sortByOrder($a, $b) {
		    return $a['order'] - $b['order'];
	    }

		foreach ($res->result_array() as $record) 
		{
			foreach ($displayMetaIds as $metaId => $metaName)
			{
				$value = $this->decryptMetaValue($record["value$metaId"]);
				$ret[$record["id"]]["meta"]["$metaName"] = $value;
			}

			if($module_name=='Leads'){

				 $lead_array=array();
                foreach ($ret[$record["id"]]["meta"] as $key => $value) {
			    	
			    	if($key=='Company Name'){
                         $lead_array[]=[$key => $value,'order'=>0];
			    	}
			    	if($key=='First Name'){
                         $lead_array[]=[$key => $value,'order'=>1];
			    	}
			    	if($key=='Last Name'){
                         $lead_array[]=[$key => $value,'order'=>2];
			    	}
			    	if($key=='Email'){
                         $lead_array[]=[$key => $value,'order'=>2];
			    	}
			    	if($key=='Phone'){
                         $lead_array[]=[$key => $value,'order'=>3];
			    	}
			    	if($key=='Province'){
                         $lead_array[]=[$key => $value,'order'=>5];
			    	}
			    	if($key=='Country'){
                         $lead_array[]=[$key => $value,'order'=>6];
			    	}
			    	if($key=='City'){
                         $lead_array[]=[$key => $value,'order'=>4];
			    	}
			    	/*if($key=='Estimated Sales'){
                         $lead_array[]=[$key => $value,'order'=>7];
			    	}*/
			    	/*if($key=='Reported Sales'){
                         $lead_array[]=[$key => $value,'order'=>7];
			    	}*/
			    	
			    	$lead_array[]=['Modified By' =>'','order'=>8];
                    $lead_array[]=['Modified Time' =>'','order'=>9];
			    	
                    if($key=='Lead Status'){
                           
                        $lead_array[]=[$key => $value,'order'=>10];
			    	}
			    	if($key=='Opener'){
			    		$value=getOpener($record["id"]);
			    		$lead_array[]=[$key => $value,'order'=>11];
			    	}
			    	if($key=='Closer'){
			    		
			    		$value=getCloser($record["id"]);
                        $lead_array[]=[$key => $value,'order'=>12];
			    	}


			    }
                
                usort($lead_array, 'sortByOrder');
			    
                $ret[$record["id"]]["meta"] =[];
                foreach ($lead_array as $key => $value) {
                	$key=key($value);
                    $ret[$record["id"]]["meta"][$key]=$value[$key]; 
                }    
	        }
			
			    $this->db->select('acn.*,upi.first_name,upi.last_name');
	            $this->db->join('anb_crm_users_personal_info upi','upi.user_id=acn.created_by');
	            $this->db->where('acn.record_id',$record['id']);
	            $this->db->order_by('acn.id','DESC');    	
	            $query=$this->db->get('anb_crm_note acn');
	           
	            $notes=$query->result_array();
	          	$note_data = '';
	            if(empty($notes)){
	                 
	                  $note_data='Notes not available';

	            }else{
	                
	                foreach ($notes as $note) {
	                  
		                if(empty($note['note'])){
			                  
			                  $note_data='Notes not available';
	                          break;

			            }else{
	                      	
	                      	  $note_data.= '<span class="dtnotes">'.$note['note'].'<strong>    '.date('m/d/Y H:i', $note["created_time"]).' by '.ucfirst($note["first_name"]).' '.ucfirst($note["last_name"]).'</strong></span><br>' ;
			            }    

	                
	                }     
	            }

	          $ret[$record["id"]]['meta']["note"]=$note_data; 

	          $note_data='';

			//echo '<pre>';print_r($value); 
			
			//echo date('Y-m-d H:i:s', $record["created_time"]);

	        $ret[$record["id"]]['static']["reminder_count"]=$this->db->where('record_id',$record["id"])->count_all_results('anb_crm_reminder');  

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

		/*foreach ($ret as $key => $value) 
		{
			//if ($key != 'total_record') ksort($ret[$key]["meta"]);
			if ($module_name == CONTRACTS_PLURAL_NAME && isset($ret[$key]["meta"]["Client Name"])) 
			{
				$ret[$key]["meta"]["Client Name"] = $ret[$key]["static"]["client_name"];
			}
		}
*///		print_r($ret);

		if($module_name == "Leads"){
			foreach ($ret as $key => $value) {	
				
				/*$cname = $this->db->select('first_name, last_name')
							  ->where('user_id',$ret[$key]['meta']['Closer'])	
							  ->get('anb_crm_users_personal_info');
				$name = $cname->result_array();	
					if(empty($name)){
					$ret[$key]["meta"]["Closer"] = 'Not available';	
					}else{			 
						foreach ($name as $mvalue) {
						$ret[$key]["meta"]["Closer"] = $mvalue['first_name'].' '. $mvalue['last_name'];
					}
				}

				$oname = $this->db->select('first_name, last_name')
							  ->where('user_id',$ret[$key]['meta']['Opener'])	
							  ->get('anb_crm_users_personal_info');
				$name1 = $oname->result_array();	
					if(empty($name1)){
					$ret[$key]["meta"]["Opener"] = 'Not available';	
					}else{			 
						foreach ($name1 as $ovalue) {
						$ret[$key]["meta"]["Opener"] = $ovalue['first_name'].' '. $ovalue['last_name'];
					}
				}*/
				$modifiedtime = $this->db->select('modified_time')
							  ->where('id',$key)	
							  ->get('anb_crm_record');
				$time = $modifiedtime->result_array();
					if(empty($time)){
					$ret[$key]["meta"]["Modified Time"] = '';	
					}else{
						foreach ($time as $mtime) {
							//print_r($mtime);
						$ret[$key]["meta"]["Modified Time"] = !empty($mtime['modified_time']) ? date('m/d/Y H:i',$mtime['modified_time']) : '';
					}
				}
				if(!empty($ret[$key]["static"]["modified_by"])){

				 $query = $this->db->get_where('anb_crm_users_personal_info',['user_id'=>$ret[$key]["static"]["modified_by"]]);
                                     
                  $ret[$key]["meta"]["Modified By"]=ucfirst($query->row()->first_name).' '.ucfirst($query->row()->last_name);
                  
                }
			}
		}

		if($module_name == CONTRACTS_PLURAL_NAME){	
				foreach ($ret as $key => $value) {		
						$techical_name = $this->db->select('first_name, last_name')
								 		 ->where('user_id', $ret[$key]['meta']['Technical Consultant'])
								 		 ->get('anb_crm_users_personal_info');
						$techicalname = $techical_name->result_array(); 		 		 	
							if(empty($techicalname)){
								$ret[$key]["meta"]["Technical Consultant"] = 'Technical consultant not available';
							}
							else{
							foreach ($techicalname as $name) {
								//die;
								$full_name = $name['first_name'] .' '. $name['last_name'];	
								$ret[$key]["meta"]["Technical Consultant"] = $full_name;
								}
							}
							

						/*$client_number = $this->db->select('value')
												->where('record_id', $ret[$key]['meta']['Client Name'])	
												->where('record_meta_id', 103)
												->get('anb_crm_record_meta_value');
						$clientnumber = $client_number->result_array();
							if(empty($clientnumber) || empty($clientnumber[0]['value'])){
								$ret[$key]["meta"]["Client Number1"] = 'Client Number not available';
							}
							else{
							foreach ($clientnumber as $value) {
								$number = $value['value'];	
								$ret[$key]["meta"]["Client Number"] = $number;
								}
							}*/
					
						$closer_name = $this->db->select('value')
												->where('record_id', $ret[$key]['meta']['Client Name'])	
												->where('record_meta_id', 104)
												->get('anb_crm_record_meta_value');
						$closername = $closer_name->result_array();
							if(empty($closername) || empty($closername[0]['value'])){
								$ret[$key]["meta"]["Closer Name"] = 'Closer Name not available';
							}
							else{
								$cname = $this->db->select('first_name, last_name')
											  ->where('user_id',$closername[0]['value'])	
											  ->get('anb_crm_users_personal_info');
								$name = $cname->result_array();	
									if(empty($name)){
									$ret[$key]["meta"]["Closer Name"] = 'Not available';	
									}else{			 
										foreach ($name as $mvalue) {
										$ret[$key]["meta"]["Closer Name"] = $mvalue['first_name'].' '. $mvalue['last_name'];
									}
								}
							}

						$completed_on = $this->db->select('value')
												 ->where('record_id', $ret[$key]['meta']['Client Name'])	
												 ->where('record_meta_id', 101)
												 ->get('anb_crm_record_meta_value');	
						$complete_date = $completed_on->result_array();
							if(empty($complete_date) || empty($complete_date[0]['value'])){
								$ret[$key]["meta"]["Completed On"] = 'Not Completed yet';
							}
							else{
								//print_r($complete_date[0]['value']);
								$ret[$key]["meta"]["Completed On"] = $complete_date[0]['value'];	
							}

						$client_name = $this->db->select('value')
													  ->where('record_id', $ret[$key]['meta']['Client Name'])	
													  ->where('record_meta_id', 84)
													  //->order_by('a.value', 'asc')	
													  ->get('anb_crm_record_meta_value');
													  
						/*$clientname = $client_name->result_array();
							if(empty($clientname)){
								$ret[$key]["meta"]["Contract Client"] = 'Client name not available';
							}
							else{
							foreach ($clientname as $value) {
								$cname = $value['value'];	
								$ret[$key]["meta"]["Contract Client"] = $cname;
							}
						} */
						$assigned_officer_id = $this->db->select('assigned_officer_id')
												 ->where('id', $key)
												 ->get('anb_crm_record');
						$assignedofficerid = $assigned_officer_id->result_array();	
						$assigned_officer_name = $this->db->select('first_name, last_name')
										 		 ->where('user_id', $assignedofficerid[0]['assigned_officer_id'])
										 		 ->get('anb_crm_users_personal_info');
							$assignedofficername = $assigned_officer_name->result_array(); 		 		 	
							if(empty($assignedofficername)){
							$ret[$key]["meta"]["Assigned Officer"] = 'Not Assigned yet';
							}
							else{
							foreach ($assignedofficername as $aname) {
								$ret[$key]["meta"]["Assigned Officer"] = $aname['first_name'] .' '. $aname['last_name'];
								}
							}
						
						$ret[$key]["meta"]["Assigned Date"] = date("m/d/Y h:i a", $ret[$key]['static']['created_time']);
						unset($ret[$key]["meta"]["Client Name"]);
					}	
			}
		if($module_name == CONTRACTS_PLURAL_NAME){	
		    $keys = ["Contract Client", "Client Number", "Contract Name","Contract Number","Signing Rate", "Closer Name", "Closing Date", "Technical Consultant", "Assigned Officer", "Assigned Date", "Completed On", "Stage"];
				foreach ($ret as $key => &$value) { // & defines changes will be reflected at its address in memory
					    $value['meta'] = array_replace(array_flip($keys), $value["meta"]);
					 $ret[$key]["meta"] = $value['meta'];
					}
		}	
			
		/*print_r($ret);
		die;*/
		/*$this->db->cache_off();*/
		/*$this->debug($this->db->last_query());*/
		$arr_res[0] = $ret;
		$arr_res[1] = $page_details;

		//echo '<pre>';print_r($arr_res); die;
		
		return $arr_res;
	}
	
	

	function loadRecordListForDashboard($recordStatus = null, $owner = null, $search_filter = null, $npage_no = 1, $limit = 25, $sort_column = 'Company Name', $sort_order = 'ASC', $keyword = '', $module_name = '' , $from_date =''){
				$ret = array();
				global $RECORD_STATUS;
				$recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
				
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

				foreach($res->result_array() as $displayMeta)
				{
						$displayMetaIds[$displayMeta["id"]] = $displayMeta["name"];
						if ($module_id == '') $module_id = $displayMeta["module_id"];
						if($displayMeta['name'] == $sort_column)
						{
							$sort_id = $displayMeta['id'];
						}
				}
				$this->db->reset_query();
/*        $this->db->cache_on();*/

				$additionalFieldName = ($module_name == CONTRACTS_PLURAL_NAME) ? ", vvv.vv_client_name" : "";
			 
				if ($module_name == CONTRACTS_PLURAL_NAME) 
				{
						$this->db->join('(SELECT vv.value as vv_client_name, vv.record_id as vv_record_id FROM anb_crm_record_meta_value vv where vv.record_meta_id = 84) as vvv', 'vvv.vv_record_id = r.id', 'left');
				}

				$extraSelect = '';
				$Hot = '';
				foreach($displayMetaIds as $metaId => $meta)
				{
						$extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
						$this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');
				}
				if($module_name=='Leads'){

				$this->db->join("(SELECT value,record_id FROM anb_crm_record_meta_value where record_meta_id = 14) as rr","rr.record_id = r.id",'left');
				}
				if($module_name=='Clients'){

				$this->db->join("(SELECT value,record_id FROM anb_crm_record_meta_value where record_meta_id = 95) as rr","rr.record_id = r.id",'left');	
				}
				if($module_name=='Contracts'){

				$this->db->join("(SELECT value,record_id FROM anb_crm_record_meta_value where record_meta_id = 223) as rr","rr.record_id = r.id",'left');	
				}

				$arr_rev = array_flip($displayMetaIds);
				if(isset($search_filter) && count($search_filter))
				{
					foreach($search_filter as $k => $v)
					{
						if($v && !in_array($k, $arr_rev))
						{
							$extraSelect .= ($extraSelect == '') ? "ad$k.value as value$k" : ", ad$k.value as value$k";
							
							//$dateSelect = '';
							//if($from_date!="" )  $dateSelect = "$v.' >=', strtotime($from_date)";			
							
							$this->db->join("(SELECT sq$k.value, sq$k.record_id FROM anb_crm_record_meta_value sq$k where sq$k.record_meta_id = $k) as ad$k", "ad$k.record_id = r.id", 'left');	
							
							
						}
					}
				}

/*        $this->db->join('anb_crm_modules mod', 'r.module_id = mod.id', 'left');
				$this->db->where("mod.plural_name", $module_name);*/
				
				$this->db->where("r.record_status", $recordStatus);
				$this->db->where("r.module_id", $module_id);
				$this->db->where("rr.value", 'Hot');
				$this->db->where_in("r.assigned_officer_id", $owner);
				//$this->db->where("sq78.value", "Hot");
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
			
				$this->db->select("r.id , rr.value,r.modified_time");
				$this->db->distinct();
				$this->db->order_by('r.modified_time', 'DESC');
				$this->db->limit(100);

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
		$last_sql = str_replace('DISTINCT `r`.`id`', "r.*, $extraSelect$additionalFieldName", $this->db->last_query())."";
				//else
				//echo $last_sql = $this->db->last_query();  die;
				$page_details['start_record'] = $start_rec_no;
				$page_details['end_record'] = $int_end_row;
				$page_details['total_records'] = $num_records;
				$page_details['total_page'] = $total_page;
				$page_details['cur_page'] = $npage_no;
				$res = $this->db->query($last_sql);

				//echo $this->db->last_query();die();
				 //echo '<pre>';print_r($displayMetaIds); //die;
				 //echo '<pre>';print_r($res->result_array()); die;
					//if($from_date!="")  { echo '<pre>';print_r($res->result_array());die; }

				foreach ($res->result_array() as $record) 
				{
						foreach ($displayMetaIds as $metaId => $metaName)
						{
								$value = $this->decryptMetaValue($record["value$metaId"]);
								$ret[$record["id"]]["meta"]["$metaName"] = $value;
						}

						$this->db->select('acn.*,upi.first_name,upi.last_name');
			            $this->db->join('anb_crm_users_personal_info upi','upi.user_id=acn.created_by');
			            $this->db->where('acn.record_id',$record['id']);
			            $this->db->order_by('acn.id','DESC');    	
			            $query=$this->db->get('anb_crm_note acn');
			           
			            $notes=$query->result_array();
			          	$note_data = '';
			            if(empty($notes)){
			                 
			                  $note_data='Notes not available';

			            }else{
			                
			                foreach ($notes as $note) {
			                  
				                if(empty($note['note'])){
					                  
					                  $note_data='Notes not available';
			                          break;

					            }else{
			                      	
			                      	  $note_data.= '<div class="dtnotes">'.$note['note'].'<strong>    '.date('m/d/Y H:i', $note["created_time"]).' by '.ucfirst($note["first_name"]).' '.ucfirst($note["last_name"]).'</strong></div><br>' ;
					            }    

			                
			                }     
			            }

			          $ret[$record["id"]]['meta']["note"]=$note_data; 

			          $note_data='';

			          $opener_call_status=$this->db->get_where('anb_crm_record_meta_value',['record_id'=>$record['id'],'record_meta_id'=>27])->row()->value;

			          $ret[$record["id"]]['meta']["opener_call_status"]=$opener_call_status;

			          $ret[$record["id"]]['meta']["reminder_count"]=$this->db->where('record_id',$record["id"])->count_all_results('anb_crm_reminder');

						//echo date('Y-m-d H:i:s', $record["created_time"]);
						$ret[$record["id"]]["static"]["created_by"] = $record["created_by"];
						$ret[$record["id"]]["static"]["created_time"] = $record["created_time"];
						$ret[$record["id"]]["static"]["modified_by"] = $record["modified_by"];
						$ret[$record["id"]]["static"]["modified_time"] = $record["modified_time"];
						$ret[$record["id"]]["static"]["record_status"] = $record["record_status"];
						$ret[$record["id"]]["static"]["value"] = $record["value"];
						if ($module_name == CONTRACTS_PLURAL_NAME && $record["vv_client_name"] != NULL)
						{
								$ret[$record["id"]]["static"]["client_name"] = $record["vv_client_name"];
						}						

						if(!empty($ret[$record["id"]]["static"]["modified_by"]))
						{
							$this->db->where('user_id',$ret[$record["id"]]["static"]["modified_by"]);
							$q = $this->db->get('anb_crm_users_personal_info');
							$dx = $q->result_array();
							$ret[$record["id"]]["static"]["modified_by_name"] = $dx[0]['first_name']." ".$dx[0]['last_name'];
						}else{
							$ret[$record["id"]]["static"]["modified_by_name"] = " ";
						}
				}
		//additional for contract 
		 //        $company_name = $this->db->where('record_id', $ret[$key]['meta']['Client Name'])	
			// 		->get('anb_crm_record_meta_value');
			// 	$companyname = $company_name->result_array();
			// 	$P = $ret[$key]['meta']['Client Name'];
			// 	foreach ($companyname as $key => $value) {
			// 		if($value['record_meta_id'] == 185)
			// 		 {  $mcn = $value['value']; }
			// 		if($value['record_meta_id'] == 108)
			// 		 {  $cn = $value['value']; }
			// 		if($value['record_meta_id'] == 95)
			// 		 {  $c = $value['value']; }
			// 		if($value['record_meta_id'] == 87)
			// 		 { $cs = $value['value'];}
			// 		$result = array("Company name"=>$cn,"Master Contract Number"=>$mcn,"Category"=>$c,"Call Status"=>$cs);
			// 	}
			// $ret[$key]["meta"]["Company name"] = $result;
			//additional for contract 		

		if($module_name == CONTRACTS_PLURAL_NAME){	
				foreach ($ret as $key => $value) {		
						$techical_name = $this->db->select('first_name, last_name')
								 		 ->where('user_id', $ret[$key]['meta']['Technical Consultant'])
								 		 ->get('anb_crm_users_personal_info');
						$techicalname = $techical_name->result_array(); 		 		 	
							if(empty($techicalname)){
								$ret[$key]["meta"]["Technical Consultant"] = 'Technical consultant not available';
							}
							else{
							foreach ($techicalname as $name) {
								//die;
								$full_name = $name['first_name'] .' '. $name['last_name'];	
								$ret[$key]["meta"]["Technical Consultant"] = $full_name;
								}
							}
							

						/*$client_number = $this->db->select('value')
												->where('record_id', $ret[$key]['meta']['Client Name'])	
												->where('record_meta_id', 103)
												->get('anb_crm_record_meta_value');
						$clientnumber = $client_number->result_array();
							if(empty($clientnumber) || empty($clientnumber[0]['value'])){
								$ret[$key]["meta"]["Client Number1"] = 'Client Number not available';
							}
							else{
							foreach ($clientnumber as $value) {
								$number = $value['value'];	
								$ret[$key]["meta"]["Client Number"] = $number;
								}
							}*/
							
			

						$closer_name = $this->db->select('value')
												->where('record_id', $ret[$key]['meta']['Client Name'])	
												->where('record_meta_id', 104)
												->get('anb_crm_record_meta_value');
						$closername = $closer_name->result_array();
							if(empty($closername) || empty($closername[0]['value'])){
								$ret[$key]["meta"]["Closer Name"] = 'Closer Name not available';
							}
							else{
								$cname = $this->db->select('first_name, last_name')
											  ->where('user_id',$closername[0]['value'])	
											  ->get('anb_crm_users_personal_info');
								$name = $cname->result_array();	
									if(empty($name)){
									$ret[$key]["meta"]["Closer Name"] = 'Not available';	
									}else{			 
										foreach ($name as $mvalue) {
										$ret[$key]["meta"]["Closer Name"] = $mvalue['first_name'].' '. $mvalue['last_name'];
									}
								}
							}

						$completed_on = $this->db->select('value')
												 ->where('record_id', $ret[$key]['meta']['Client Name'])	
												 ->where('record_meta_id', 101)
												 ->get('anb_crm_record_meta_value');	
						$complete_date = $completed_on->result_array();
							if(empty($complete_date) || empty($complete_date[0]['value'])){
								$ret[$key]["meta"]["Completed On"] = 'Not Completed yet';
							}
							else{
								//print_r($complete_date[0]['value']);
								$ret[$key]["meta"]["Completed On"] = $complete_date[0]['value'];	
							}

						$client_name = $this->db->select('value')
								  ->where('record_id', $ret[$key]['meta']['Client Name'])	
								  ->where('record_meta_id', 84)
								  //->order_by('a.value', 'asc')	
								  ->get('anb_crm_record_meta_value');
													  
						/*$clientname = $client_name->result_array();
							if(empty($clientname)){
								$ret[$key]["meta"]["Contract Client"] = 'Client name not available';
							}
							else{
							foreach ($clientname as $value) {
								$cname = $value['value'];	
								$ret[$key]["meta"]["Contract Client"] = $cname;
							}
						} */
						$assigned_officer_id = $this->db->select('assigned_officer_id')
												 ->where('id', $key)
												 ->get('anb_crm_record');
						$assignedofficerid = $assigned_officer_id->result_array();	
						$assigned_officer_name = $this->db->select('first_name, last_name')
										 		 ->where('user_id', $assignedofficerid[0]['assigned_officer_id'])
										 		 ->get('anb_crm_users_personal_info');
							$assignedofficername = $assigned_officer_name->result_array(); 		 		 	
							if(empty($assignedofficername)){
							$ret[$key]["meta"]["Assigned Officer"] = 'Not Assigned yet';
							}
							else{
							foreach ($assignedofficername as $aname) {
								$ret[$key]["meta"]["Assigned Officer"] = $aname['first_name'] .' '. $aname['last_name'];
								}
							}
						
						$ret[$key]["meta"]["Assigned Date"] = date("m/d/Y h:i a", $ret[$key]['static']['created_time']);
						unset($ret[$key]["meta"]["Client Name"]);
					}	
			}
			//echo "<pre>";print_r($ret[$key]['meta']['Client Name']);die;
		if($module_name == CONTRACTS_PLURAL_NAME){	
		    $keys = ["Contract Client", "Client Number", "Contract Name","Contract Number","Signing Rate", "Closer Name", "Closing Date", "Technical Consultant", "Assigned Officer", "Assigned Date", "Completed On", "Stage"];
				foreach ($ret as $key => &$value) { // & defines changes will be reflected at its address in memory
					    $value['meta'] = array_replace(array_flip($keys), $value["meta"]);
					 $ret[$key]["meta"] = $value['meta'];
					}
		}	


				/*foreach ($ret as $key => $value) 
				{
						//if ($key != 'total_record') ksort($ret[$key]["meta"]);
						if ($module_name == CONTRACTS_PLURAL_NAME && isset($ret[$key]["meta"]["Client Name"])) 
						{
								$ret[$key]["meta"]["Client Name"] = $ret[$key]["static"]["client_name"];
						}
				}*/

/*        $this->db->cache_off();*/
				/*$this->debug($this->db->last_query());*/
				$arr_res[0] = $ret;
				$arr_res[1] = $page_details;
				return $arr_res;
	}

		function loadRecordListForDashboardDeadLead($recordStatus = null, $owner = null, $search_filter = null, $npage_no = 1, $limit = 25, $sort_column = 'Company Name', $sort_order = 'ASC', $keyword = '', $module_name = '' , $from_date =''){
				$ret = array();
				global $RECORD_STATUS;
				$recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
				
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
				$this->db->reset_query();
/*        $this->db->cache_on();*/

				$additionalFieldName = ($module_name == CONTRACTS_PLURAL_NAME) ? ", vvv.vv_client_name" : "";
			 
				if ($module_name == CONTRACTS_PLURAL_NAME) 
				{
						$this->db->join('(SELECT vv.value as vv_client_name, vv.record_id as vv_record_id FROM anb_crm_record_meta_value vv where vv.record_meta_id = 84) as vvv', 'vvv.vv_record_id = r.id', 'left');
				}
				
				$extraSelect = '';
				$Hot = '';
				foreach($displayMetaIds as $metaId => $meta)
				{
						$extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
						$this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');
				}
				$this->db->join("(SELECT value,record_id FROM anb_crm_record_meta_value where record_meta_id = 14) as rr","rr.record_id = r.id",'left');

				$arr_rev = array_flip($displayMetaIds);
				if(isset($search_filter) && count($search_filter))
				{
					foreach($search_filter as $k => $v)
					{
						if($v && !in_array($k, $arr_rev))
						{
							$extraSelect .= ($extraSelect == '') ? "ad$k.value as value$k" : ", ad$k.value as value$k";
							
							//$dateSelect = '';
							//if($from_date!="" )  $dateSelect = "$v.' >=', strtotime($from_date)";			
							
							$this->db->join("(SELECT sq$k.value, sq$k.record_id FROM anb_crm_record_meta_value sq$k where sq$k.record_meta_id = $k) as ad$k", "ad$k.record_id = r.id", 'left');	
							
							
						}
					}
				}

/*        $this->db->join('anb_crm_modules mod', 'r.module_id = mod.id', 'left');
				$this->db->where("mod.plural_name", $module_name);*/
				
				$this->db->where("r.record_status", $recordStatus);
				$this->db->where("r.module_id", $module_id);
				$this->db->where("rr.value", 'Dead');
				$this->db->where_in("r.assigned_officer_id", $owner);
				//$this->db->where("sq78.value", "Hot");
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
			
				$this->db->select("r.id , rr.value,r.modified_time");
				$this->db->distinct();
				$this->db->order_by('r.modified_time', 'DESC');
				$this->db->limit(100);

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
		$last_sql = str_replace('DISTINCT `r`.`id`', "r.*, $extraSelect$additionalFieldName", $this->db->last_query())."";
				//else
				//echo $last_sql = $this->db->last_query();  die;
				$page_details['start_record'] = $start_rec_no;
				$page_details['end_record'] = $int_end_row;
				$page_details['total_records'] = $num_records;
				$page_details['total_page'] = $total_page;
				$page_details['cur_page'] = $npage_no;
				$res = $this->db->query($last_sql);
				 //echo '<pre>';print_r($displayMetaIds); //die;
				 //echo '<pre>';print_r($res->result_array()); die;
					//if($from_date!="")  { echo '<pre>';print_r($res->result_array());die; }
				foreach ($res->result_array() as $record) 
				{
						foreach ($displayMetaIds as $metaId => $metaName)
						{
								$value = $this->decryptMetaValue($record["value$metaId"]);
								$ret[$record["id"]]["meta"]["$metaName"] = $value;
						}
						$this->db->select('acn.*,upi.first_name,upi.last_name');
			            $this->db->join('anb_crm_users_personal_info upi','upi.user_id=acn.created_by');
			            $this->db->where('acn.record_id',$record['id']);
			            $this->db->order_by('acn.id','DESC');    	
			            $query=$this->db->get('anb_crm_note acn');
			           
			            $notes=$query->result_array();
			          	$note_data = '';
			            if(empty($notes)){
			                 
			                  $note_data='Notes not available';

			            }else{
			                
			                foreach ($notes as $note) {
			                  
				                if(empty($note['note'])){
					                  
					                  $note_data='Notes not available';
			                          break;

					            }else{
			                      	
			                      	  $note_data.= '<div class="dtnotes">'.$note['note'].'<strong>    '.date('m/d/Y H:i', $note["created_time"]).' by '.ucfirst($note["first_name"]).' '.ucfirst($note["last_name"]).'</strong></div><br>' ;
					            }    

			                
			                }     
			            }

			          $ret[$record["id"]]['meta']["note"]=$note_data; 

			          $note_data='';

			          $opener_call_status=$this->db->get_where('anb_crm_record_meta_value',['record_id'=>$record['id'],'record_meta_id'=>27])->row()->value;
			          
			          $ret[$record["id"]]['meta']["reminder_count"]=$this->db->where('record_id',$record["id"])->count_all_results('anb_crm_reminder');
						//echo date('Y-m-d H:i:s', $record["created_time"]);
						$ret[$record["id"]]["static"]["created_by"] = $record["created_by"];
						$ret[$record["id"]]["static"]["created_time"] = $record["created_time"];
						$ret[$record["id"]]["static"]["modified_by"] = $record["modified_by"];
						$ret[$record["id"]]["static"]["modified_time"] = $record["modified_time"];
						$ret[$record["id"]]["static"]["record_status"] = $record["record_status"];
						$ret[$record["id"]]["static"]["value"] = $record["value"];
						if ($module_name == CONTRACTS_PLURAL_NAME && $record["vv_client_name"] != NULL)
						{
								$ret[$record["id"]]["static"]["client_name"] = $record["vv_client_name"];
						}
				}
				
				foreach ($ret as $key => $value) 
				{
						//if ($key != 'total_record') ksort($ret[$key]["meta"]);
						if ($module_name == CONTRACTS_PLURAL_NAME && isset($ret[$key]["meta"]["Client Name"])) 
						{
								$ret[$key]["meta"]["Client Name"] = $ret[$key]["static"]["client_name"];
						}
				}

/*        $this->db->cache_off();*/
				/*$this->debug($this->db->last_query());*/
				$arr_res[0] = $ret;
				$arr_res[1] = $page_details;
				return $arr_res;
	}


	function loadContractsForDashboardGraph($owner=null, $month=null, $year=null)
	{
		//$this->db->select("r.*");
		$this->db->select("COUNT(r.id) as y");
		$this->db->where("r.assigned_officer_id", $owner);
		$this->db->where("r.module_id", 3);
		$this->db->where("MONTH(FROM_UNIXTIME(r.created_time))", $month);
		$this->db->where("YEAR(FROM_UNIXTIME(r.created_time))", $year);
		$res = $this->db->get("anb_crm_record r");
		$ret = $res->row_array();			
		$final = [
			'label'=>date('M Y', mktime(0, 0, 0, $month, 10,$year)),
			'y'=>(int)$ret['y']
		];
		return $final;	
		
	}

	function loadContractsForDashboardGraphByIds($owner=null, $month=null, $year=null)
	{
		//$this->db->select("r.*");
		$this->db->select("COUNT(r.id) as y");
		$this->db->where_in("r.assigned_officer_id", $owner);
		$this->db->where("r.module_id", 3);
		$this->db->where("MONTH(FROM_UNIXTIME(r.created_time))", $month);
		$this->db->where("YEAR(FROM_UNIXTIME(r.created_time))", $year);
		$res = $this->db->get("anb_crm_record r");
		$ret = $res->row_array();			
		$final = [
			'label'=>date('M', mktime(0, 0, 0, $month, 10)),
			'y'=>(int)$ret['y']
		];
		return $final;	
		
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
			//$this->db->select("u.id, u.email, p.first_name, p.last_name");
			$this->db->select("u.id, u.email,u.role_id, p.first_name, p.last_name");
			$this->db->where("u.status", $status);
			$this->db->order_by('p.first_name');
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
			$res = $this->db->get('anb_crm_users as u');
			foreach ($res->result_array() as $user) {
					$name = ($user["first_name"] == '') ? $user["last_name"] : ($user["first_name"] . " " . $user["last_name"]);
					$ret[] = array(
							'id' => $user["id"],
							'role_id' => $user['role_id'],
							'title' => $name . " <" . $user["email"] . ">",
					);
			}
			return $ret;
	}

	function loadUsersByRole($role_id=null,$status = null){
			$ret = array();
			$this->db->select("u.id, u.email, p.first_name, p.last_name, p.monthly_target");
			if($role_id!="")
			{
				$this->db->where("u.role_id", $role_id);
			}
			if($status!="")
			{
				$this->db->where("u.status", $status);
			}
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
			$res = $this->db->get('anb_crm_users as u');
			$ret = $res->result_array();
	 
			return $ret;
	}

	function loadOptionalUsersList($status = 1,$loggedUserId){
		
			$ret = array();
			$this->db->select("u.id, u.email, p.first_name, p.last_name, p.share_calendar");
			$this->db->where("u.status", $status);
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
			$res = $this->db->get('anb_crm_users as u');
			foreach ($res->result_array() as $user) {
					
				$share_c = json_decode($user['share_calendar']);
				if( ( is_array($share_c) && in_array($loggedUserId,$share_c) ) || $user["id"]==$loggedUserId)
				{
					$name = ($user["first_name"] == '') ? $user["last_name"] : ($user["first_name"] . " " . $user["last_name"]);
					$ret[] = array(
							'id' => $user["id"],
							'title' => $name . " <" . $user["email"] . ">",
					);
				}
				
			}
	
			return $ret;
	}

	function getSearchFilterList($arr_filters, $module_name="")
	{
        $ret = array();
		$this->db->select("r.id");
		$this->db->where("r.plural_name", $module_name);
		$res = $this->db->get('anb_crm_modules as r');
		//echo '<pre>';print_r($res->result_array());die;
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
	
	function loadClientsList()
	{
		global $RECORD_STATUS;
		$ret = array();
		$this->db->select("mv.value as name, r.id");
		$this->db->join("anb_crm_record_meta_value mv", 'mv.record_id = r.id AND mv.record_meta_id = ' . CLIENTS_CLIENT_NAME_META_ID, 'left');
		$this->db->where("r.module_id", CLIENTS);
		$this->db->where("r.record_status", $RECORD_STATUS['CYCLE_RUNNING']);
		$res = $this->db->get('anb_crm_record r');
		//echo "<pre>";print_r($res->result_array());die;
		foreach ($res->result_array() as $client) {
				$ret[] = array(
						'id' => $client["id"],
						'title' => $client["name"]." (" .$client["id"].")",
				);
		}

		return $ret;
	}

	function get_client_by_id($client_id)
	{
		global $RECORD_STATUS;
		$ret = array();
		$this->db->select("mv.*, r.id");
		$this->db->join("anb_crm_record_meta_value mv", 'mv.record_id = r.id' );
		$this->db->where_in("mv.record_meta_id", array('94','185','90','103', '84'));		
		$this->db->where("r.module_id", CLIENTS);
		$this->db->where("r.id", $client_id);
		$this->db->where("r.record_status", $RECORD_STATUS['CYCLE_RUNNING']);
		$this->db->order_by('mv.record_meta_id');
		$res = $this->db->get('anb_crm_record r');
		$ret = $res->result_array();
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

	function addRecord($meta_fields, $userId)
	{

		$ret = array(
			"status" => true,
			"message" => '',
			"id" => 1,           
		);
		$rawData = $this->getFormFieldData();
		$filteredDataArray = $this->filterRawData($rawData, $meta_fields);
		
		//echo '<pre>';print_r($rawData);
		//echo '<pre>';print_r($filteredDataArray);  //die;
		
		if ($filteredDataArray["status"] === true)
		{
				$module_id = $filteredDataArray["module_id"];
				$dataToInsert = $filteredDataArray["data"];
				if(!empty($filteredDataArray["data"]["161"])){
					$client_id = $filteredDataArray["data"]["161"];
					$this->db->select('lead_id');
					$this->db->from('anb_crm_record');
					$this->db->where('id',$client_id);
					$queryResult = $this->db->get();
					$lead_id = $queryResult->result_array();
					$lead_id = !empty($lead_id) && !empty($lead_id[0]) && !empty($lead_id[0]['lead_id']) ? $lead_id[0]['lead_id'] : '';
				}
				$recordData = array(
						"assigned_officer_id" => $filteredDataArray["assigned_officer_id"],
						"module_id" => $module_id,
						"created_by" => $userId,
						"created_time" => time(),
						'lead_id' => isset($lead_id) ? $lead_id : ''
				);

				$recordCreationSuccessful = $this->db->insert("anb_crm_record", $recordData);
				//$recordCreationSuccessful = true;
				if ($recordCreationSuccessful === true)
				{
						//die('here');
						$recordId = $this->db->insert_id();
						//$recordId = 1;
						$ret["id"] = $recordId;

						$recordMetaData = array();

						foreach ($dataToInsert as $recordFieldMetaId => $recordFieldMetaValue)
						{
								$value = $this->encryptMetaValue($recordFieldMetaValue);
								$recordMetaData[] = array(
										"record_id" => $recordId,
										"record_meta_id" => $recordFieldMetaId,
										"value" => $value,
								);
						}
						//echo 'recordMetaData<pre>';print_r($recordMetaData); die;

						$metaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $recordMetaData);

					    if($this->getPost('cm')=='Contracts' || ($this->getPost('cm') == 'Clients' && $this->getPost('add') == 'addContract')){
							$this->updateContractNumber($recordId,$client_id);
						}

						if (!$metaInserted)
						{
								$ret["message"] = "Server error! Please try again later.";
								$ret["status"] = false;
						}
						else 
						{
								//Call Automation
								$currentData = array(
										"record" => $recordData,
										"meta" => $recordMetaData,
								);

								$this->automation($currentData, $recordId);
						}
				}
		}
		else 
		{
				$ret["message"] = $filteredDataArray["message"];
				$ret["status"] = false;
		}

		return $ret;
	}
	
	function updateContractNumber($record_id,$client_id){

		$client_contract_no=$this->db->get_where('anb_crm_record',['id'=>$client_id])->row()->client_contract_no;

		$client_contract_no=$client_contract_no+1;

		$serviceType=$this->db->get_where('anb_crm_record_meta_value',['record_id'=>$record_id,'record_meta_id'=>163])->row()->value;
		
		$decryptData=$this->decryptMetaValue($serviceType);

       if(is_array($decryptData)){
			
			foreach ($decryptData as $key => $value) {
				$stype.= end(explode(' ', $value));
			}

       }else{

       		$stype = end(explode(' ', $decryptData));
       }
		
		$contractNo =$client_id.$stype.$client_contract_no;

		$this->db->update('anb_crm_record',['client_contract_no'=>$client_contract_no],['id'=>$client_id]);

		return $this->db->update('anb_crm_record_meta_value',['value'=>$contractNo],['record_id'=>$record_id,'record_meta_id'=>165]);
	}

	function check_lead_exist($value,$title,$module_name,$record_id){
          
        $query=$this->db->get_where('anb_crm_modules',['plural_name'=>$module_name]);
        $module=$query->row();   

    	$this->db->select('mv.*');
    	$this->db->from('anb_crm_record_meta_value mv');
    	$this->db->join("(select * from anb_crm_record_meta where name = $title and module_id = $module->id ) as rm",'rm.id=mv.record_meta_id');
    	$this->db->where('mv.value',trim($value));
    	if(!empty($record_id)){
    		$this->db->where_not_in('mv.record_id',$record_id);
    	}
        $query=$this->db->get();
        return $query->num_rows()>=1?true:false;
           	
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

	function updateRecord($meta_fields, $userId)
	{
		$ret = array(
			"status" => true,
			"message" => '',
			"id" => 1,
		);

		$recordId = $this->getPost("record_id");
		$oldRecord = $this->loadRecord(3, $recordId);
		$rawData = $this->getFormFieldData();
		$filteredDataArray = $this->filterRawData($rawData, $meta_fields);
		//echo '<pre>';print_r($rawData); //die;
		//echo '<pre>';print_r($meta_fields); //die;
		//echo '<pre>';print_r($filteredDataArray); die;
		if ($filteredDataArray["status"] === true)
		{
			$dataToInsert = $filteredDataArray["data"];

			$recordData = array(
				"assigned_officer_id" => $filteredDataArray["assigned_officer_id"],
				"modified_by" => $userId,
				"modified_time" => time(),
			);

			$this->db->where('id', $recordId);
			$recordUpdateSuccessful = $this->db->update("anb_crm_record", $recordData);
			if ($recordUpdateSuccessful === true)
			{
				$existingMetaIds = array_keys($oldRecord);
				$recordMetaData = array();
				$recordMetaDataInsertList = array();
				$recordMetaDataUpdateList = array();


				foreach ($dataToInsert as $recordFieldMetaId => $recordFieldMetaValue)
				{
					$value = $this->encryptMetaValue($recordFieldMetaValue);

					$recordMetaData[] = array(
						"record_id" => $recordId,
						"record_meta_id" => $recordFieldMetaId,
						"value" => $value,
					);

					if (in_array("__$recordFieldMetaId", $existingMetaIds))
					{
						$recordMetaDataUpdateList[] = array(
							"record_id" => $recordId,
							"record_meta_id" => $recordFieldMetaId,
							"value" => $value,
						);
					} 
					else 
					{
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

				if (count($recordMetaDataInsertList) > 0)
				{
					$metaInserted = $this->db->insert_batch('anb_crm_record_meta_value',$recordMetaDataInsertList);
				}

				if (!$metaInserted)
				{
					$ret["message"] = "Server error! Please try again later.";
					$ret["status"] = false;
				} 
				else 
				{
					$currentData = array(
						"record" => $recordData,
						"meta" => $recordMetaData,
					);

					$this->automation($currentData, $recordId, "Old", $oldRecord);
				}
		
			}
	
		} 
		else 
		{
			$ret["message"] = $filteredDataArray["message"];
			$ret["status"] = false;
		}

		return $ret;
	}

	function delRecord(){
			$ret = array(
					"status" => false,
					"id" => 0
			);
			$record_id = $this->getPost("id");
			$action = $this->getPost("mtd");
			if ($action == 1 || $action == 2) { // Archive or delete according to global $RECORD_STATUS
				$data = array(
						"record_status" => $this->getPost("mtd"),
				);
				$this->db->where('id', $record_id);
				$recordUpdateSuccessful = $this->db->update("anb_crm_record", $data);
				if($recordUpdateSuccessful)
				{
					$ret = array(
						"status" => true,
						"id" => 1
					);
				}
			}

			return $ret;
	}

	function convertRecord($userId, $record_Id=null, $expected_technical_start_date)
	{
		if($record_Id!="")
		{
			$lead_id = $record_Id;
		}
		else
		{
			$lead_id = $this->getPost('id');	
		}
		
		$clientMetaMapping = $this->loadMetaMapping(CLIENTS);
		$contractMetaMapping = $this->loadMetaMapping(CONTRACTS);
		$leadData = $this->loadRecord();
		
		$primary_contact = $leadData['primary_contact'];
		switch ($primary_contact) {
			case 51:
				$primary_contact = 128;
				break;
			case 60:
				$primary_contact = 137;
				break;
			case 64:
				$primary_contact = 141;
				break;
			case 71:
				$primary_contact = 148;
				break;
			default:
				$primary_contact = '';
				break;
		}

		//echo '<pre>';print_r($clientMetaMapping); //die;
		//echo '<pre>';print_r($contractMetaMapping); //die;
		//echo '<pre>';print_r($leadData); die;
		$assigned_officer_id = !empty($leadData) && !empty($leadData['__0']) ? $leadData['__0'] : 1;
		/////Client Creation
		$recordData = array(
			"assigned_officer_id" => $assigned_officer_id,
			"module_id" => CLIENTS,
			"created_by" => $userId,
			"created_time" => time(),
			'lead_id' => $lead_id,
			"primary_contact" => $primary_contact,
		);

		$recordCreationSuccessful = $this->db->insert("anb_crm_record", $recordData);
		if ($recordCreationSuccessful === true)
		{
		    $client_id = $this->db->insert_id();
			$contract_ids = array();
			$clientMetaData = array();


				// $q = $this->db->get_where('anb_crm_record', array('id' => $client_id));

					// $this->db->select("r.*, v.*");
					// $this->db->where("r.id", $client_id);
					// $this->db->join('anb_crm_record_meta_value v', 'v.record_id = r.id', 'left');
					// $ress = $this->db->get('anb_crm_record as r');
				 //  $dd= $ress->row();


          	
          	// print_r($leadData['__9']);

				if (isset($leadData['__9']) && !empty($leadData['__9'])) {
					if (is_array($leadData['__9'])) {
					    $arr =  $leadData['__9'][0]; 
					}	else {
					   $arr =  $leadData['__9'];
					}	
					$ar = explode(" - ", $arr);
					$st = $ar[1];
				} else {
				   $st =  "NST";
				}
				// echo $st;

    //       	echo "<pre>";	print_r($leadData); die;
        // $module_id=  $data->module_id;



     //      	echo "<pre>";	print_r($module_id); die;


			/////Generate Contract Number
			// $tempKey = "__" . LEAD_COUNTRY_META_ID;
			// if(isset($leadData[$tempKey]))
			// {
			// 	$country = strtoupper($leadData[$tempKey]);
			// }
			// else
			// {
			// 	$country = "";
			// }

			// $time = dechex( time() - mktime(0, 0, 0, 0, 0, 2017) );
			
			// $contractNumber = '';
			
			// if (strpos($country, "CANADA") !== false){
			// 		$contractNumber .= "1";
			// } else if (strpos($country, "USA") !== false){
			// 		$contractNumber .= "2";
			// } else {
			// 		$contractNumber .= "0";
			// }
			
			$contractNumber = $client_id.''.$st.''.date('y');
			
			/////Generation of Contract Number

			foreach ($clientMetaMapping as $leadMeta => $clientMeta)
			{	
				if(isset($leadData["__$leadMeta"]))
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
				"value" => "$contractNumber",
			);

			$clientMetaData[] = array(
				"record_id" => $client_id,
				"record_meta_id" => 102, // Expected Technical Start Date Number
				"value" => "$expected_technical_start_date",		
			);
			//echo '<pre>';print_r($clientMetaData); //die;
			
			$this->db->reset_query();
			$metaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $clientMetaData);
			
			//die('in m');
			
			/*
			////////Contract Creation
			$tempKey = "__" . LEAD_SERVICE_TYPE_META_ID;
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
					$client_name = $leadData[$tempKey];

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
						$value = $this->encryptMetaValue($leadData["__$leadMeta"]);
						$clientMetaData[] = array(
							"record_id" => $contract_id,
							"record_meta_id" => $clientMeta,
							"value" => $value,
						);
					}

					$this->db->reset_query();
					$contractMetaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $clientMetaData);
				} 
				else 
				{
					$this->clearRecord($client_id);
					foreach ($contract_ids as $index => $id)
					{
							$this->clearRecord($id);
					}

					return "Error! Contract creation failed. Please try again later";
				}
			
			} 
			*/
		
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

		return $client_id;
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

	function changeOwner($userId, $massOwner = false, $ids = null, $newOwner = null)
	{
		$module = $this->getPost('cm');
		$ret = array(
				"status" => true,
				"message" => '',
		);
		$idList = (!$massOwner) ? array($this->getPost("id")) : explode(",", $ids);
		$owner = (!$massOwner) ? $this->getPost("newOwner") : $newOwner;
		$newCloser = $this->getPost("newCloser");

		$recordData = array();

		foreach ($idList as $key => $id){
				$recordData[] = array(
						"id" => $id,
						"assigned_officer_id" => $owner,
						"modified_by" => $userId,
						"modified_time" => time(),
				);
			$recordUpdateSuccessful = 0;
			if($module == 'Leads'){
				$recordUpdateSuccessful = $this->db->update('anb_crm_record_meta_value', array('value'=>$owner), array('record_meta_id' => 22, 'record_id'=>$id));
				$recordUpdateSuccessful = $this->db->update('anb_crm_record_meta_value', array('value'=>$newCloser), array('record_meta_id' => 21, 'record_id'=>$id));
				$recordUpdateSuccessful = $this->db->update('anb_crm_record_meta_value', array('value'=>'ASSIGNED TO OPENER'), array('record_meta_id' => 6, 'record_id'=>$id));	
			}else{
				$recordUpdateSuccessful = $this->db->update('anb_crm_record_meta_value', array('value'=>$owner), array('record_meta_id' => 104, 'record_id'=>$id));
			}
		}

		$recordUpdateSuccessful = $this->db->update_batch("anb_crm_record", $recordData, "id");
		
		if ($recordUpdateSuccessful == 0) {
				$ret['status'] = false;
				$ret['message'] = "Server error! Please try again later.";
		}
		return $ret;
	}
	function changeContractOwner($userId, $massOwner = false, $ids = null, $newOwner = null)
	{
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

				$recordUpdateSuccessful = $this->db->update('anb_crm_record_meta_value', array('value'=>$owner), array('record_meta_id' => 169, 'record_id'=>$id));
		}
		/* Email function start */
		$user_data = $this->App_model->getData('anb_crm_users',array('email'),array('id'=> $newOwner));
		$contract_data = $this->ModuleModel->loadRecord(null,$ids);

		//echo '<pre>';
		//print_r($contract_data);die();

		$client_name = $this->App_model->getData('anb_crm_record_meta_value','value',array('record_id' => $contract_data['__161'], 'record_meta_id' => 84));
		$client_number = $this->App_model->getData('anb_crm_record_meta_value','value',array('record_id' => $contract_data['__161'], 'record_meta_id' => 103));
		$serviceType ='';
		if(is_array($contract_data['__163'])){
			
			for($i=0; $i<count($contract_data['__163']); $i++)
			{
				$serviceType .= $contract_data['__163'][$i].", ";	
			}

		}else{
			$serviceType = $contract_data['__163'];
		}
		$openerCloserName = $this->App_model->getData('anb_crm_users_personal_info', array('first_name', 'last_name'), array('user_id'=>$newOwner));
		$assigned_officer_id = $newOwner;
		$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
		$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
		$subject = "A Contract assigned to you.";
		$contract_id = $ids;
		$modified_time = time();
		$toEmail = $user_data[0]['email'];
		$assignedData = array(
				'assignedOfficer' => $openerCloserName[0]['first_name'] .' '.$openerCloserName[0]['last_name'],
				//'leadassignedofficer' => $this->input->get("ac"),
				'assignedDate' => date('Y-m-d'),
				'clientName' => isset($client_name) ? $client_name[0]['value'] : "",
				'clientNumber' => isset($client_number) ? $client_number[0]['value'] : "",
				'contractName' => isset($contract_data['__160']) ? $contract_data['__160'] : '',
				'contractNumber' => isset($contract_data['__165']) ? $contract_data['__165'] : '',
				'stage' => isset($contract_data['__162']) ? $contract_data['__162'] : '',
				'serviceType' => isset($serviceType) ? $serviceType : '',
				);
		$assignedData['mainheading'] = 'Contract  Assigned';
		$assignedData['heading'] = 'A contract is Assigned to you.';		
		$emailTemplate = $this->load->view('emails/assignedContract',$assignedData,true);
					//$emailTemplate = $this->load->view('emails/common',$edata,true);
		$fromEmail = COMPANY_NOREPLY_EMAIL;
		$fromName = COMPANY_NAME;
		//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
		$data = json_encode($assignedData);
		$this->ModuleModel->saveEmail($this->session->userdata('user_id'),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data);
		$this->email->from($fromEmail);
		$this->email->to($toEmail);
		$this->email->subject($subject);
		$this->email->message($emailTemplate);
				//$this->email->message($final_content);
		if($this->email->send()){
		/* Email Function end*/
			//$recordUpdateSuccessful = $this->db->update_batch("anb_crm_record", $recordData, "id");
			if ($recordUpdateSuccessful == 0) {
					$ret['status'] = false;
					$ret['message'] = "Server error! Please try again later.";
			}
		}
		return $ret;
	}
	function mass_delete($ids = null)
	{
		$ret = array(
				"status" => true,
				"message" => '',
		);
		
		$idList = explode(",", $ids);	
		
		foreach ($idList as $key => $id)
		{
			$res = $this->massDelete($id);
		}
		//echo "<pre>";print_r($ret);print_r($res);die;
		return $ret;
	}

	function massDelete($recordId)
	{
			$this->db->reset_query();
			$this->db->where("id", $recordId);
			$this->db->update('anb_crm_record',['record_status'=>1]);

		    return true;
	}

	function restore($record_id){

		$record_id=str_replace("on,","",$record_id);
		$idList=explode(',',$record_id);
		foreach ($idList as $key => $id)
		{
			$this->db->reset_query();
			$this->db->where("id", $id);
			$this->db->update('anb_crm_record',['record_status'=>3]);
		}
		return true;
	}

	function clearRecord($recordId)
	{
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

	function automation($currentData, $record_id, $type = 'New', $old_data = null)
	{
			global $AUTOMATION_META_IDS;

			foreach ($currentData['meta'] as $key => $metaValue)
			{
					if ($metaValue["record_meta_id"] == '26' && $metaValue['value'] != 'None')
					{ //"Company Information Video Validity"
							$runAutomation = true;
							if (isset($old_data["__26"]))
							{
									if ($metaValue['value'] == $old_data["__26"]) $runAutomation = false;
							}
							if ($runAutomation) $this->automationUpdateVideoUrl($record_id, $metaValue["value"], $AUTOMATION_META_IDS["26"]);
					} 
					else if ($metaValue["record_meta_id"] == '28' && $metaValue['value'] != 'None')
					{ ////"COMPANY INFORMATION VIDEO VALIDITY (USA)"
							$runAutomation = true;
							if (isset($old_data["__28"])) 
							{
									if ($metaValue['value'] == $old_data["__28"]) $runAutomation = false;
							}
							if ($runAutomation) $this->automationUpdateVideoUrl($record_id, $metaValue["value"], $AUTOMATION_META_IDS["28"], 'USA');
					}
			}
	}

	function automationUpdateVideoUrl($recordId, $no_of_days, $updateFieldMetaId, $country = 'Canada')
	{
			if ($country == 'Canada')
			{
					$url = "https://anbruch.com/anbruch-the-ultimate-recovery-firm/?";
			} 
			else if ($country == 'USA')
			{
					$url = "https://anbruch.com/anbruch-the-ultimate-recovery-firm-usa/?";
			}
			else 
			{
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

	function encryptMetaValue($recordFieldMetaValue)
	{
		$value = '';
		if (is_array($recordFieldMetaValue))
		{
			foreach ($recordFieldMetaValue as $key => $string)
			{
				$value .= ($value == '') ? $string : (MULTIPLE_OPTION_SEPARATOR."$string");
			}
		} 
		else 
		{
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

	function checkWritable($id)
	{
			global $RECORD_STATUS;
			$this->db->select("*");
			$this->db->where("r.record_status", $RECORD_STATUS['CYCLE_RUNNING']);
			$this->db->where("r.id", $id);
			$res = $this->db->get('anb_crm_record as r');
			return ($res->num_rows() > 0) ? true : false;
	}

	function filterRawData($rawData, $meta_fields)
	{
		$ret = array(
			"status" => true,
			"message" => '',
			"module_id" => '',
			"assigned_officer_id" => '',
			"data" => array(),
		);

		foreach ($meta_fields as $key => $meta)
		{
			$valueToCheck = (isset($rawData[$meta['id']])) ? $rawData[$meta['id']] : '';
			//Is Required check
			if ($meta['is_required'] == 1 && $valueToCheck == '')
			{
				$ret["status"] = false;
				$ret["message"] = $meta["name"] . " is required.";
				break;
			}
			else
			{
				$ret["data"][$meta['id']] = $valueToCheck;
			}

			if ($ret['module_id'] == '') 
			$ret['module_id'] = $meta['module_id'];
			if ($ret['assigned_officer_id'] == '') 
			$ret['assigned_officer_id'] = $rawData["0"];
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


	public function getEmailReminder()
	{
		$status = array('1', '0');	
		$query = $this->db->select("e.*, n.*")
				 ->from('anb_crm_bookings e')
				 ->join('event_notification n', 'n.event_id = e.id')
				 ->where_in('e.status', $status)			
				 ->where("n.status",1)
				 ->order_by('n.id', 'desc')
				 ->get();
		return $query->result_array();
				 	
	}
	public function updateReminderTable($event_id)
	{

		$data = array(  
			'status' => 0,  
			'modified_date' => date("Y-m-d H:i:s"),  
		);  
			$this->db->where('event_id', $event_id)
					 ->update('event_notification', $data);
	}

	public function getEventEmailReminder()
	{
			$query = $this->db->select("e.*, n.* ")
							  ->from("events e")
							  ->join('event_notification n', 'n.event_id = e.id' )
							  ->where("n.status",1)
							  ->get();
			return $query->result_array();				  	
		# code...
	}


	 public function get_modules_data($record_id,$module_id){
       
	       $this->db->select('mv.value,m.name,r.record_status,r.modified_time,upi.first_name,upi.last_name');
	       $this->db->from('anb_crm_record_meta_value mv');
	       $this->db->join('anb_crm_record r','r.id=mv.record_id');
	       $this->db->join('anb_crm_users_personal_info upi','r.modified_by=upi.user_id','left');
	       $this->db->join('anb_crm_record_meta m','m.id=mv.record_meta_id');
        
    	 $this->db->where('mv.record_id',$record_id);
    	 $this->db->where('m.module_id',$module_id);
    	 $query=$this->db->get();
    	return  $query->result();
    	 
    }
	
	function loadRecordList_beta($recordStatus = null, $owner = null, $search_filter = null, $npage_no = 1, $limit = 25, $sort_column = '', $sort_order = '', $keyword = '', $module_name = '' , $from_date ='', $page_id ='',$alphabet='',$fav_list_id='')
	{
		
		
		/*print_r($owner);
		die("cool");
		*/
		$ret = array();
		global $RECORD_STATUS;
		$recordStatus = ($recordStatus == null) ? $RECORD_STATUS["CYCLE_RUNNING"] : $recordStatus;
		//$owner = ($owner == null) ? 1 : $owner;
	 
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

		if(isset($sort_column) && !empty($sort_column)){
			$sort_column = $sort_column;
		}
		else{
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
		}
		/*print_r($this->db->last_query());
		echo '<pre>';print_r($res->result_array()); die;
 */


		foreach($res->result_array() as $displayMeta)
		{
			$displayMetaIds[$displayMeta["id"]] = $displayMeta["name"];
			if ($module_id == '') $module_id = $displayMeta["module_id"];
			if($displayMeta['name'] == $sort_column)
			{
				$sort_id = $displayMeta['id'];
			}
		}
		
		if ($module_name == CONTRACTS_PLURAL_NAME && $keyword) {
				$this->db->select('record_meta_id');
				$this->db->like('value', $keyword);
				$result = $this->db->get("anb_crm_record_meta_value");
				foreach ($result->result_array() as $key => $fieldname) {
						$this->db->select('id');
						$this->db->where('id', $fieldname['record_meta_id']);
						$this->db->where('module_id', 3);
						$this->db->where('display_in_short_view', 1);
						$column_name = $this->db->get("anb_crm_record_meta");
						$result1 = $column_name->result_array();
						if(!empty($result1)){
							$sort_id = $result1[0]['id'];
						}
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
		if($keyword)
			$this->db->group_start();
		foreach($displayMetaIds as $metaId => $meta)
		{
			$extraSelect .= ($extraSelect == '') ? "ad$metaId.value as value$metaId" : ", ad$metaId.value as value$metaId";
			
			//echo '<pre>';print_r($extraSelect); 
			
			$this->db->join("(SELECT sq$metaId.value, sq$metaId.record_id FROM anb_crm_record_meta_value sq$metaId where sq$metaId.record_meta_id = $metaId) as ad$metaId", "ad$metaId.record_id = r.id", 'left');

			if($keyword){
				
			    $this->db->or_like("`ad$metaId`.`value`", $keyword);
			    
			}
		
		}
		if($keyword)
			$this->db->group_end();	
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

		if($owner){ 
			$this->db->group_start();
				$this->db->where("r.assigned_officer_id", $owner);
				$this->db->or_where("ad22.value", $owner);
				$this->db->or_where("ad21.value", $owner);
			$this->db->group_end();
		}
		if(isset($search_filter) && count($search_filter))
		{
			foreach($search_filter as $k => $v)
			{
				if($v)
				$this->db->like("`ad$k`.`value`", $v);
			}
		}
		
		

		//if($from_date!="")  $this->db->where('created_time >= ', strtotime($from_date));			
	
		if(!empty($alphabet))
		{
			$this->db->select("r.id");
			if($module_name == 'Leads')
			{
				$this->db->like('ad31.value', $alphabet, 'after');	
			}
			elseif ($module_name == 'Clients') {
				$this->db->like('ad84.value', $alphabet, 'after');
			}
			elseif ($module_name == 'Contracts') {
				$this->db->like('ad197.value', $alphabet, 'after');
			}
		}
		else
		{
			$this->db->select("r.id");	
		}
		if(!empty($fav_list_id))
		{
			$this->db->where('find_in_set("'.$fav_list_id.'", r.favourite_list_id)');
		}
		
		//$this->db->order_by("m.display_sort_id", "ASC");
		$this->db->distinct();
		//$this->db->order_by("r.id", "DESC");
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
			$last_sql = str_replace('DISTINCT `r`.`id`', "DISTINCT r.*, $extraSelect$additionalFieldName", $this->db->last_query())."ORDER BY `$sort_id` $sort_order LIMIT $start_rec_no, ". $limits_per_page;
		}
		else
		{
			$last_sql = str_replace('DISTINCT `r`.`id`', "DISTINCT r.*, $extraSelect$additionalFieldName", $this->db->last_query())." ORDER BY `ad$sort_id`.`value` $sort_order LIMIT $start_rec_no, ". $limits_per_page;
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
		function sortByOrder($a, $b) {
		    return $a['order'] - $b['order'];
	    }

		foreach ($res->result_array() as $key => $record) 
		{	
			/*if(!empty($alphabet))
			{
				var_dump(strtoupper(substr($record['value31'], 0,1))); 
				var_dump(!strtoupper(substr($record['value31'], 0,1)) == $alphabet);
				var_dump("######");
				if(!strtoupper(substr($record['value31'], 0, 1)) == "$alphabet")
				{
					
					array_splice($record, $key);
					continue;
				}
			}*/
			foreach ($displayMetaIds as $metaId => $metaName)
			{
				$value = $this->decryptMetaValue($record["value$metaId"]);
				$ret[$record["id"]]["meta"]["$metaName"] = $value;
			}

			if($module_name=='Leads'){

				 $lead_array=array();
                foreach ($ret[$record["id"]]["meta"] as $key => $value) {
			    	
			    	if($key=='Company Name'){
                         $lead_array[]=[$key => $value,'order'=>0];
			    	}
			    	if($key=='First Name'){
                         $lead_array[]=[$key => $value,'order'=>1];
			    	}
			    	if($key=='Last Name'){
                         $lead_array[]=[$key => $value,'order'=>2];
			    	}
			    	if($key=='Email'){
                         $lead_array[]=[$key => $value,'order'=>2];
			    	}
			    	if($key=='Phone'){
                         $lead_array[]=[$key => $value,'order'=>3];
			    	}
			    	if($key=='Province'){
                         $lead_array[]=[$key => $value,'order'=>5];
			    	}
			    	if($key=='Country'){
                         $lead_array[]=[$key => $value,'order'=>6];
			    	}
			    	if($key=='City'){
                         $lead_array[]=[$key => $value,'order'=>4];
			    	}
			    	/*if($key=='Estimated Sales'){
                         $lead_array[]=[$key => $value,'order'=>7];
			    	}*/
			    	/*if($key=='Reported Sales'){
                         $lead_array[]=[$key => $value,'order'=>7];
			    	}*/
			    	
			    	$lead_array[]=['Modified By' =>'','order'=>8];
                    $lead_array[]=['Modified Time' =>'','order'=>9];
			    	
                    if($key=='Lead Status'){
                           
                        $lead_array[]=[$key => $value,'order'=>10];
			    	}
			    	if($key=='Opener'){
			    		$value=getOpener($record["id"]);
			    		$lead_array[]=[$key => $value,'order'=>11];
			    	}
			    	if($key=='Closer'){
			    		
			    		$value=getCloser($record["id"]);
                        $lead_array[]=[$key => $value,'order'=>12];
			    	}


			    }
                
                usort($lead_array, 'sortByOrder');
			    
                $ret[$record["id"]]["meta"] =[];
                foreach ($lead_array as $key => $value) {
                	$key=key($value);
                    $ret[$record["id"]]["meta"][$key]=$value[$key]; 
                }

	        }

	            $this->db->select('acn.*,upi.first_name,upi.last_name');
	            $this->db->join('anb_crm_users_personal_info upi','upi.user_id=acn.created_by');
	            $this->db->where('acn.record_id',$record['id']);
	            $this->db->order_by('acn.id','DESC');    	
	            $query=$this->db->get('anb_crm_note acn');
	           
	            $notes=$query->result_array();
	          	$note_data = '';
	            if(empty($notes)){
	                 
	                  $note_data='Notes not available';

	            }else{
	                
	                foreach ($notes as $note) {
	                  
		                if(empty($note['note'])){
			                  
			                  $note_data='Notes not available';
	                          break;

			            }else{
	                      	
	                      	  $note_data.= '<span class="dtnotes">'.$note['note'].'<strong>    '.date('m/d/Y H:i', $note["created_time"]).' by '.ucfirst($note["first_name"]).' '.ucfirst($note["last_name"]).'</strong></span><br>' ;
			            }    

	                
	                }     
	            }

	          $ret[$record["id"]]['meta']["note"]=$note_data; 

	          $note_data='';
			
			//echo date('Y-m-d H:i:s', $record["created_time"]);

	        $ret[$record["id"]]['static']["reminder_count"]=$this->db->where('record_id',$record["id"])->count_all_results('anb_crm_reminder');    
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

		/*foreach ($ret as $key => $value) 
		{
			//if ($key != 'total_record') ksort($ret[$key]["meta"]);
			if ($module_name == CONTRACTS_PLURAL_NAME && isset($ret[$key]["meta"]["Client Name"])) 
			{
				$ret[$key]["meta"]["Client Name"] = $ret[$key]["static"]["client_name"];
			}
		}
*///		print_r($ret);

		if($module_name == "Leads"){
			foreach ($ret as $key => $value) {	
				
				/*$cname = $this->db->select('first_name, last_name')
							  ->where('user_id',$ret[$key]['meta']['Closer'])	
							  ->get('anb_crm_users_personal_info');
				$name = $cname->result_array();	
					if(empty($name)){
					$ret[$key]["meta"]["Closer"] = 'Not available';	
					}else{			 
						foreach ($name as $mvalue) {
						$ret[$key]["meta"]["Closer"] = $mvalue['first_name'].' '. $mvalue['last_name'];
					}
				}

				$oname = $this->db->select('first_name, last_name')
							  ->where('user_id',$ret[$key]['meta']['Opener'])	
							  ->get('anb_crm_users_personal_info');
				$name1 = $oname->result_array();	
					if(empty($name1)){
					$ret[$key]["meta"]["Opener"] = 'Not available';	
					}else{			 
						foreach ($name1 as $ovalue) {
						$ret[$key]["meta"]["Opener"] = $ovalue['first_name'].' '. $ovalue['last_name'];
					}
				}*/
				$modifiedtime = $this->db->select('modified_time')
							  ->where('id',$key)	
							  ->get('anb_crm_record');
				$time = $modifiedtime->result_array();
					if(empty($time)){
					$ret[$key]["meta"]["Modified Time"] = '';	
					}else{
						foreach ($time as $mtime) {
							//print_r($mtime);
						$ret[$key]["meta"]["Modified Time"] = !empty($mtime['modified_time']) ? date('m/d/Y H:i',$mtime['modified_time']) : '';
					}
				}
				if(!empty($ret[$key]["static"]["modified_by"])){

				 $query = $this->db->get_where('anb_crm_users_personal_info',['user_id'=>$ret[$key]["static"]["modified_by"]]);
                                     
                  $ret[$key]["meta"]["Modified By"]=ucfirst($query->row()->first_name).' '.ucfirst($query->row()->last_name);
                  
                }
			}
		}

		if($module_name == CONTRACTS_PLURAL_NAME){	
				foreach ($ret as $key => $value) {		
						$techical_name = $this->db->select('first_name, last_name')
								 		 ->where('user_id', $ret[$key]['meta']['Technical Consultant'])
								 		 ->get('anb_crm_users_personal_info');
						$techicalname = $techical_name->result_array(); 		 		 	
							if(empty($techicalname)){
								$ret[$key]["meta"]["Technical Consultant"] = 'Technical consultant not available';
							}
							else{
							foreach ($techicalname as $name) {
								//die;
								$full_name = $name['first_name'] .' '. $name['last_name'];	
								$ret[$key]["meta"]["Technical Consultant"] = $full_name;
								}
							}
							

						/*$client_number = $this->db->select('value')
												->where('record_id', $ret[$key]['meta']['Client Name'])	
												->where('record_meta_id', 103)
												->get('anb_crm_record_meta_value');
						$clientnumber = $client_number->result_array();
							if(empty($clientnumber) || empty($clientnumber[0]['value'])){
								$ret[$key]["meta"]["Client Number1"] = 'Client Number not available';
							}
							else{
							foreach ($clientnumber as $value) {
								$number = $value['value'];	
								$ret[$key]["meta"]["Client Number"] = $number;
								}
							}*/
					
						$closer_name = $this->db->select('value')
												->where('record_id', $ret[$key]['meta']['Client Name'])	
												->where('record_meta_id', 104)
												->get('anb_crm_record_meta_value');
						$closername = $closer_name->result_array();
							if(empty($closername) || empty($closername[0]['value'])){
								$ret[$key]["meta"]["Closer Name"] = 'Closer Name not available';
							}
							else{
								$cname = $this->db->select('first_name, last_name')
											  ->where('user_id',$closername[0]['value'])	
											  ->get('anb_crm_users_personal_info');
								$name = $cname->result_array();	
									if(empty($name)){
									$ret[$key]["meta"]["Closer Name"] = 'Not available';	
									}else{			 
										foreach ($name as $mvalue) {
										$ret[$key]["meta"]["Closer Name"] = $mvalue['first_name'].' '. $mvalue['last_name'];
									}
								}
							}

						$completed_on = $this->db->select('value')
												 ->where('record_id', $ret[$key]['meta']['Client Name'])	
												 ->where('record_meta_id', 101)
												 ->get('anb_crm_record_meta_value');	
						$complete_date = $completed_on->result_array();
							if(empty($complete_date) || empty($complete_date[0]['value'])){
								$ret[$key]["meta"]["Completed On"] = 'Not Completed yet';
							}
							else{
								//print_r($complete_date[0]['value']);
								$ret[$key]["meta"]["Completed On"] = $complete_date[0]['value'];	
							}

						$client_name = $this->db->select('value')
													  ->where('record_id', $ret[$key]['meta']['Client Name'])	
													  ->where('record_meta_id', 84)
													  //->order_by('a.value', 'asc')	
													  ->get('anb_crm_record_meta_value');
													  
						/*$clientname = $client_name->result_array();
							if(empty($clientname)){
								$ret[$key]["meta"]["Contract Client"] = 'Client name not available';
							}
							else{
							foreach ($clientname as $value) {
								$cname = $value['value'];	
								$ret[$key]["meta"]["Contract Client"] = $cname;
							}
						} */
						$assigned_officer_id = $this->db->select('assigned_officer_id')
												 ->where('id', $key)
												 ->get('anb_crm_record');
						$assignedofficerid = $assigned_officer_id->result_array();	
						$assigned_officer_name = $this->db->select('first_name, last_name')
										 		 ->where('user_id', $assignedofficerid[0]['assigned_officer_id'])
										 		 ->get('anb_crm_users_personal_info');
							$assignedofficername = $assigned_officer_name->result_array(); 		 		 	
							if(empty($assignedofficername)){
							$ret[$key]["meta"]["Assigned Officer"] = 'Not Assigned yet';
							}
							else{
							foreach ($assignedofficername as $aname) {
								$ret[$key]["meta"]["Assigned Officer"] = $aname['first_name'] .' '. $aname['last_name'];
								}
							}
						
						$ret[$key]["meta"]["Assigned Date"] = date("m/d/Y h:i a", $ret[$key]['static']['created_time']);
						unset($ret[$key]["meta"]["Client Name"]);
					}	
			}
		if($module_name == CONTRACTS_PLURAL_NAME){	
		    $keys = ["Contract Client", "Client Number", "Contract Name","Contract Number","Signing Rate", "Closer Name", "Closing Date", "Technical Consultant", "Assigned Officer", "Assigned Date", "Completed On", "Stage"];
				foreach ($ret as $key => &$value) { // & defines changes will be reflected at its address in memory
					    $value['meta'] = array_replace(array_flip($keys), $value["meta"]);
					 $ret[$key]["meta"] = $value['meta'];
					}
		}	
			
		/*print_r($ret);
		die;*/
		/*$this->db->cache_off();*/
		/*$this->debug($this->db->last_query());*/
		$arr_res[0] = $ret;
		$arr_res[1] = $page_details;

		//echo '<pre>';print_r($arr_res); die;
		
        return $arr_res;
	}
     
    function getImportData($offset = "__",$import_data){
			$ret = array();
			foreach ($import_data as $key => $value){
					if (strpos($key, $offset) !== false){
							$id = str_replace($offset, "", $key);
							$ret[$id] = $import_data["$key"];
					}
			}

			return $ret;
	} 
	function filterImportData($rawData, $meta_fields)
	{
		$ret = array(
			"status" => true,
			"message" => '',
			"module_id" => '',
			"assigned_officer_id" => '',
			"data" => array(),
		);

		foreach ($meta_fields as $key => $meta)
		{
			
			$valueToCheck = (isset($rawData[$meta['id']])) ? $rawData[$meta['id']] : '';
			//Is Required check
			if ($meta['is_required'] == 1 && $valueToCheck == '')
			{
				
				$ret["data"][$meta['id']] = $valueToCheck;
				/*$ret["status"] = false;
				$ret["message"] = $meta["name"] . " is required.";
				break;*/
			}
			else
			{
				$ret["data"][$meta['id']] = $valueToCheck;
			}

			if ($ret['module_id'] == '') 
			$ret['module_id'] = $meta['module_id'];
			if ($ret['assigned_officer_id'] == '') 
			$ret['assigned_officer_id'] = $rawData["0"];
		}

		return $ret;
	}
	function import_data($meta_fields, $userId,$import_data,$info)
	{
		$ret = array(
			"status" => true,
			"message" => '',
			"id" => 1,           
		);
		$rawData = $this->getImportData('__',$import_data);
		$filteredDataArray = $this->filterImportData($rawData, $meta_fields);
		
		//echo '<pre>';print_r($rawData);
		//echo '<pre>';print_r($filteredDataArray);  die('cool model');
		
		if ($filteredDataArray["status"] === true)
		{
				$module_id = $filteredDataArray["module_id"];
				$dataToInsert = $filteredDataArray["data"];
				if(!empty($filteredDataArray["data"]["161"])){
					$client_id = $filteredDataArray["data"]["161"];
					$this->db->select('lead_id');
					$this->db->from('anb_crm_record');
					$this->db->where('id',$client_id);
					$queryResult = $this->db->get();
					$lead_id = $queryResult->result_array();
					$lead_id = !empty($lead_id) && !empty($lead_id[0]) && !empty($lead_id[0]['lead_id']) ? $lead_id[0]['lead_id'] : '';
				}
				$recordData = array(
						"assigned_officer_id" => $filteredDataArray["assigned_officer_id"],
						"module_id" => $module_id,
						"created_by" => $userId,
						"created_time" => time(),
						'modified_time'=>$info['modified_time'],
						'zoom_id'=>$info['zoom_id'],
						'modified_by'=>1,
						'is_imported'=>1,
						'lead_id' => isset($lead_id) ? $lead_id : ''
				);

				$recordCreationSuccessful = $this->db->insert("anb_crm_record", $recordData);
				//$recordCreationSuccessful = true;
				if ($recordCreationSuccessful === true)
				{
						//die('here');
						$recordId = $this->db->insert_id();
						//$recordId = 1;
						$ret["id"] = $recordId;

						$recordMetaData = array();

						foreach ($dataToInsert as $recordFieldMetaId => $recordFieldMetaValue)
						{
								$value = $this->encryptMetaValue($recordFieldMetaValue);
								$recordMetaData[] = array(
										"record_id" => $recordId,
										"record_meta_id" => $recordFieldMetaId,
										"value" => $value,
								);
						}
						//echo 'recordMetaData<pre>';print_r($recordMetaData); die;

						$metaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $recordMetaData);

						if (!$metaInserted)
						{
								$ret["message"] = "Server error! Please try again later.";
								$ret["status"] = false;
						}
						else 
						{
								//Call Automation
								$currentData = array(
										"record" => $recordData,
										"meta" => $recordMetaData,
								);

								$this->automation($currentData, $recordId);
						}
				}
		}
		else 
		{
				$ret["message"] = $filteredDataArray["message"];
				$ret["status"] = false;
		}

		return $ret;
	}
	public function edit_by_individual_tab($id,$data)
	{	
		$time = time();
		$logid = $id['login_userid'];
		$id = $id['id'];
		// for time update
		$time_data = array('modified_time'=>$time);
		$this->db->where('id', $id);	
	    $result = $this->db->update('anb_crm_record', $time_data);

		     

	    //data update
		foreach ($data as $key => $value) { 
				$data = array("value"=>$value);
			    $this->db->where('record_id',$id);
		    	$this->db->where('record_meta_id', $key);			
		        $q = $this->db->get('anb_crm_record_meta_value');
           if ( $q->num_rows() > 0 ) 
			 {
			 	$this->db->where('record_id', $id);	
			 	$this->db->where('record_meta_id', $key);				
		    	$result = $this->db->update('anb_crm_record_meta_value', $data);
		    }else{
		    	$this->db->set('record_id', $id);	
			 	$this->db->set('record_meta_id', $key);	
				$this->db->insert('anb_crm_record_meta_value', $data);
		   }
		}

		//print_r($this->db->last_query());    
		return $result;
	}

	
}
