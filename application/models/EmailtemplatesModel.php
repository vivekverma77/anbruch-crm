<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class EmailtemplatesModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("App_model");
    }

    function loadEmailtemplatesList($uid = null, $record_id = null, $status = 1){ 

        $module_name = $this->getPost('module_name');
        if($module_name == 'Leads')
        {
            $where = 'module_id = 1 OR module_id = 4';
            $this->db->where($where);
        }
        if($module_name == 'Clients')
        {
            $where = 'module_id = 2 OR module_id = 4';
            $this->db->where($where);
        }
        if($module_name == 'Contracts')
        {
            $where = 'module_id = 3 OR module_id = 4';
            $this->db->where($where);
        }
        $ret = array();
        $this->db->select("ac.*, p.first_name, p.last_name");
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
        $this->db->order_by("modified_time", "desc");
        $this->db->where('active', $status);
        //if ($uid != null) $this->db->where("assigned_officer_id", $uid);
        //if ($record_id != null) $this->db->where("record_id", $record_id);
        $res = $this->db->get('anb_crm_emailtemplates ac');
        $ret = $res->result_array();
        //foreach ($res->result_array() as $ac) {
            //$ret[$ac['id']] = array(
                //"id" => $ac['id'],
                //"record_id" => $ac['record_id'],
                //"name" => $ac['name'],
                //"type" => $ac['type'],
                //"due_date" => $ac['due_date'],
                //"first_name" => $ac['first_name'],
                //"last_name" => $ac['last_name'],
                //"status" => $ac['status'],
                //"priority" => $ac['priority'],
                //"closed_time" => $ac['closed_time'],
                //"created_time" => $ac['created_time'],
                //"created_by" => $ac['created_by'],
                //"modified_time" => $ac['modified_time'],
            //);
        //}
        //echo '<pre>';print_r($ret);die;
        return $ret;
    }
    
    function loadEmailtemplatesSavedModes($uid = null, $record_id = null){
        $ret = array();
        $this->db->select("ac.slug");
        //$this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
        //if ($uid != null) $this->db->where("assigned_officer_id", $uid);
        //if ($record_id != null) $this->db->where("record_id", $record_id);
        $res = $this->db->get('anb_crm_emailtemplates ac');
        //$ret = $res->result_array();
			 foreach ($res->result_array() as $ac) {
							$ret[] = 	$ac['slug'];								
					}

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
        $slug = str_replace(' ','_',$this->getPost('mode')); 
        $data = array(
            "type" => 'email',
            "slug" => $slug,
            "slug_name" => $this->getPost("mode"),
            "title" => $this->getPost("title"),
            "template" => $this->getPost("template"),
            "module_id" => $this->getPost("module_id"),
            "pipeline_stage" => $this->getPost('pipeline_stage'),
            "status" => 1,  
            "direction" => $this->getPost("direction"),         
            "created_by" => $userId,
            "created_time" => date('Y-m-d H:i:s'),
            "modified_time" => date('Y-m-d H:i:s'),
        );

        if ($data["slug"] == '' || $data["title"] == '' || $data["template"] == '' || $data["status"] == '') {
            $ret["status"] = false;
            $ret["message"] = "Error! Required field is missing.";
        } else {
            $recordCreationSuccessful = $this->db->insert("anb_crm_emailtemplates", $data);
            $recordId = $this->db->insert_id();
            $ret["id"] = $recordId;
        }
					//print_r($ret);die;
        return $ret;
    }

    function updateRecord($userId){
        $ret = array(
            "status" => true,
            "message" => '',
            "id" => 1,
        );

         $slug = str_replace(' ','_',$this->getPost('mode')); 
         	$id = $this->getPost("id");
			$data = array(
            "slug" => $slug,
            "slug_name" => $this->getPost("mode"),
            "title" => $this->getPost("title"),
            "direction" => $this->getPost("direction"),         
            "template" => $this->getPost("template"),
            "module_id" => $this->getPost("module_id"),
            "pipeline_stage" => $this->getPost('pipeline_stage'),         
            "modified_time" => date('Y-m-d H:i:s'),          
		);
        if ($data["title"] == '' || $data["template"] == '' || $data["modified_time"] == '') {
            $ret["status"] = false;
            $ret["message"] = "Error! Required field is missing.";
            $ret["id"] = $id;
        } else {
            $this->db->where("id", $id);
            $recordCreationSuccessful = $this->db->update("anb_crm_emailtemplates", $data);
            $ret["id"] = $id;
        }

        return $ret;
    }

    function viewRecord(){
        $ret = array();
        $id = $this->getPost("id");

        $this->db->select("a.*, p.first_name, p.last_name");
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = a.created_by', 'left');
        $this->db->where("a.id", $id);        
        $res = $this->db->get("anb_crm_emailtemplates a");
        $ret = $res->row_array();
        
        return $ret;
    }
    
    function deleteRecord(){
			
		$ids = $_POST['ids'];
        $this->db->set('active', 0);		
		$this->db->where_in("id", $ids);		
		$this->db->update('anb_crm_emailtemplates');
	}
    function deleteRecordById(){
        $id = $_GET['id'];
        $this->db->set('active', 0);
        $this->db->where("id", $id);        
        $this->db->update('anb_crm_emailtemplates');
    }

    function restoreRecord(){
            
        $ids = $_POST['ids'];
        $this->db->set('active', 1);        
        $this->db->where_in("id", $ids);        
        $this->db->update('anb_crm_emailtemplates');
    }
    function restoreRecordById(){
        $id = $_GET['id'];
        $this->db->set('active', 1);
        $this->db->where("id", $id);        
        $this->db->update('anb_crm_emailtemplates');
    }
		
		function get_template_by_slug($type, $slug)
		{
			$this->db->select("a.*, p.first_name, p.last_name");
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = a.created_by', 'left');
			$this->db->where("a.type", $type);        
			$this->db->where("a.slug", $slug);        
			$res = $this->db->get("anb_crm_emailtemplates a");
			$ret = $res->row_array();
			
			return $ret;
		}
        function addSlug($mode, $mode_title)
        {

            $status = $this->App_model->rowInsert('anb_crm_email_notification_processes', array('email_notification_process_key' => $mode, 'email_notification_process_value' => $mode_title));
            return $status;
        }
}
