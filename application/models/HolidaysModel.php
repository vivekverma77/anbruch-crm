<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */ 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class HolidaysModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    function loadHolidaysList($uid = null, $record_id = null){
			
        $ret = array();
        $this->db->select("ac.*, p.first_name, p.last_name");
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
        //if ($uid != null) $this->db->where("assigned_officer_id", $uid);
        //if ($record_id != null) $this->db->where("record_id", $record_id);
        $this->db->order_by("date", 'asc');
        $res = $this->db->get('anb_crm_holidays ac');
				$ret = $res->result_array();
        
        return $ret;
    }

    function loadActivities($id){
        $ret = array();
        $sub_query1 = "(select acmv1.value from anb_crm_record_meta_value acmv1 where acmv1.record_id = ac.record_id AND acmv1.record_meta_id = 2) as lead_name";
        $sub_query2 = "(select acmv2.value from anb_crm_record_meta_value acmv2 where acmv2.record_id = ac.record_id AND acmv2.record_meta_id = 84) as company_name";
        $sub_query3 = "(select acmv3.value from anb_crm_record_meta_value acmv3 where acmv3.record_id = ac.record_id AND acmv3.record_meta_id = 160) as contract_name";
        $this->db->select("ac.*, p.first_name, p.last_name, r.record_status, r.module_id, $sub_query1, $sub_query2, $sub_query3");
        $this->db->join('anb_crm_record r', 'r.id = ac.record_id', 'left');
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.assigned_officer_id', 'left');
        $this->db->where("ac.id", $id);
        $res = $this->db->get('anb_crm_activities ac');
        foreach ($res->result_array() as $ac) {
            $ret = array(
                "record_id" => $ac['record_id'],
                "record_status" => $ac['record_status'],
                "module_id" => $ac['module_id'],
                "lead_name" => $ac['lead_name'],
                "company_name" => $ac['company_name'],
                "contract_name" => $ac['contract_name'],
                "name" => $ac['name'],
                "type" => $ac['type'],
                "due_date" => $ac['due_date'],
                "assigned_officer_id" => $ac['assigned_officer_id'],
                "first_name" => $ac['first_name'],
                "last_name" => $ac['last_name'],
                "status" => $ac['status'],
                "priority" => $ac['priority'],
                "closed_time" => $ac['closed_time'],
                "created_time" => $ac['created_time'],
                "created_by" => $ac['created_by'],
                "modified_time" => $ac['modified_time'],
                "modified_by" => $ac['modified_by'],
            );
        }
        return $ret;
    }

    function addRecord($userId){
        $ret = array(
            "status" => true,
            "message" => '',
            "id" => 1,
        );

        $data = array(          
            "holiday" => $this->getPost("name"),            
            "date" => date('Y-m-d', strtotime($this->getPost("date"))),
            "status" => 1,
            "created_by" => $userId,
            "created_time" => date('Y-m-d H:i:s'),            
        );
        

        $this->db->select("ac.*");      
				$this->db->where("date", date('Y-m-d', strtotime($this->getPost("date"))));        
        $res = $this->db->get('anb_crm_holidays ac');
				$check = $res->row_array();        
				//echo '<pre>';print_r($ret);die;
        if (!empty($check)){
            $ret["status"] = false;
            $ret["message"] = "Holiday with this date already exists!";
        }
        else if ($data["holiday"] == '' || $data["date"] == '' ) {
            $ret["status"] = false;
            $ret["message"] = "Error! Required field is missing.";
        } else {
            $recordCreationSuccessful = $this->db->insert("anb_crm_holidays", $data);
            $recordId = $this->db->insert_id();
            $ret["id"] = $recordId;
        }

        return $ret;
    }

    function deleteRecord($id){
			$ret = array(
            "status" => true,
            "message" => '',
            "id" => 1,
        );
       
      $this->db->where("id", $id);        
      $res = $this->db->delete('anb_crm_holidays');      
      
      return $ret;
		}
		
		
    function updateRecord($userId){
        $ret = array(
            "status" => true,
            "message" => '',
            "id" => 1,
        );

        $id = $this->getPost("id");
        $data = array(
            "holiday" => $this->getPost("name"),
            "date" => date('Y-m-d', strtotime($this->getPost("date"))),          
            "modified_by" => $userId,
            "modified_time" => date('Y-m-d H:i:s'), 
        );
        //echo '<pre>';print_r($_POST);
        $this->db->select("ac.*");      
				$this->db->where("id !=", $id);        
				$this->db->where("date", date('Y-m-d', strtotime($this->getPost("date"))));        
        $res = $this->db->get('anb_crm_holidays ac');
				$check = $res->row_array();        
				//echo '<pre>';print_r($ret); //die;
				 if (!empty($check)){
            $ret["status"] = false;
            $ret["message"] = "Holiday with this date already exists!";
        }
        else if ($_POST["id"] == '' || $data["holiday"] == '' || $data["date"] =='') {
            $ret["status"] = false;
            $ret["message"] = "Error! Required field is missing.";
        } else {
            $this->db->where("id", $id);
            $recordCreationSuccessful = $this->db->update("anb_crm_holidays", $data);
            $ret["id"] = $id;
        }
				
        return $ret;
    }

    function viewRecord($id){
			
				$ret = array();
        $this->db->select("ac.*, p.first_name, p.last_name");
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
        //if ($uid != null) $this->db->where("assigned_officer_id", $uid);
        if ($id != null) $this->db->where("ac.id", $id);
        $this->db->order_by("date", 'asc');
        $res = $this->db->get('anb_crm_holidays ac');
				$ret = $res->row_array();
			 
        return $ret;
        
    }
    
    function deleteMassRecord(){
			
			$ids = $_POST['ids'];		
			
			$this->db->where_in("id", $ids);		
			$this->db->delete('anb_crm_holidays');
			
						
		}
}
