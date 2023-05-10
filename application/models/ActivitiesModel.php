<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class ActivitiesModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    function loadActivitiesList($uid = null, $record_id = null){
        $ret = array();
        $this->db->select("ac.*, p.first_name, p.last_name");
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
        if ($uid != null) $this->db->where("assigned_officer_id", $uid);
        if ($record_id != null) $this->db->where("record_id", $record_id);
        $res = $this->db->get('anb_crm_activities ac');
        foreach ($res->result_array() as $ac) {
            $ret[$ac['id']] = array(
                "id" => $ac['id'],
                "record_id" => $ac['record_id'],
                "name" => $ac['name'],
                "type" => $ac['type'],
                "due_date" => $ac['due_date'],
                "first_name" => $ac['first_name'],
                "last_name" => $ac['last_name'],
                "status" => $ac['status'],
                "priority" => $ac['priority'],
                "closed_time" => $ac['closed_time'],
                "created_time" => $ac['created_time'],
                "created_by" => $ac['created_by'],
                "modified_time" => $ac['modified_time'],
            );
        }

         //echo '<pre>';print_r($ret);die;
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
            "assigned_officer_id" => $this->getPost("assigned_officer_id"),
            "name" => $this->getPost("name"),
            "type" => $this->getPost("type"),
            "due_date" => $this->getPost("due_date"),
            "status" => $this->getPost("status"),
            "priority" => $this->getPost("priority"),
            "record_id" => $this->getPost("record_id"),
            "created_by" => $userId,
            "created_time" => time(),
        );

        if ($data["assigned_officer_id"] == '' || $data["name"] == '' || $data["type"] == '' || $data["due_date"] == '' || $data["status"] == '' || $data["priority"] == '') {
            $ret["status"] = false;
            $ret["message"] = "Error! Required field is missing.";
        } else {
            $recordCreationSuccessful = $this->db->insert("anb_crm_activities", $data);
            $recordId = $this->db->insert_id();
            $ret["id"] = $recordId;
        }

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
            "assigned_officer_id" => $this->getPost("assigned_officer_id"),
            "name" => $this->getPost("name"),
            "closed_time" => $this->getPost("closed_time"),
            "type" => $this->getPost("type"),
            "due_date" => $this->getPost("due_date"),
            "status" => $this->getPost("status"),
            "priority" => $this->getPost("priority"),
            "record_id" => $this->getPost("record_id"),
            "modified_by" => $userId,
            "modified_time" => time(),
        );

        if ($data["assigned_officer_id"] == '' || $data["name"] == '' || $data["type"] == '' || $data["due_date"] == '' || $data["status"] == '' || $data["priority"] == '') {
            $ret["status"] = false;
            $ret["message"] = "Error! Required field is missing.";
        } else {
            $this->db->where("id", $id);
            $recordCreationSuccessful = $this->db->update("anb_crm_activities", $data);
            $ret["id"] = $id;
        }

        return $ret;
    }

    function viewRecord($activityId = 0){
        $ret = array();
        $id = $this->getPost("id") ? $this->getPost("id") : $activityId;

        $this->db->select("r.module_id, r.record_status, a.*, as.first_name as_first_name, as.last_name as_last_name, cr.first_name cr_first_name, cr.last_name cr_last_name, mo.first_name mo_first_name, mo.last_name mo_last_name");
        $this->db->join('anb_crm_users_personal_info as', 'as.user_id = a.assigned_officer_id', 'left');
        $this->db->join('anb_crm_users_personal_info cr', 'cr.user_id = a.created_by', 'left');
        $this->db->join('anb_crm_users_personal_info mo', 'mo.user_id = a.modified_by', 'left');
        $this->db->join('anb_crm_record r', 'r.id = a.record_id', 'left');
        $this->db->where("a.id", $id);
        $res = $this->db->get("anb_crm_activities a");
        foreach ($res->result_array() as $record) {
            $ret = array(
                "assigned_officer_id" => $record["assigned_officer_id"],
                "assigned_officer_name" => $record["as_first_name"] . " " . $record["as_last_name"],
                "created_by_name" => $record["cr_first_name"] . " " . $record["cr_last_name"],
                "modified_by_name" => $record["mo_first_name"] . " " . $record["mo_last_name"],
                "name" => $record["name"],
                "closed_time" => $record["closed_time"],
                "type" => $record["type"],
                "due_date" => $record["due_date"],
                "status" => $record["status"],
                "priority" => $record["priority"],
                "record_id" => $record["record_id"],
                "record_status" => $record["record_status"],
                "module_id" => $record["module_id"],
                "created_by" => $record["created_by"],
                "created_time" => $record["created_time"],
                "modified_by" => $record["modified_by"],
                "modified_time" => $record["modified_time"],
                "google_event_id" => $record["google_event_id"]
            );
            break;
        }

        if ($ret['module_id'] == LEADS || $ret['module_id'] == CLIENTS || $ret['module_id'] == CONTRACTS){
            global $MAJOR_META_IDS_LIST;
            $tempData = array();
            $this->db->reset_query();
            $this->db->select("v.value, m.id");
            $this->db->join('anb_crm_record_meta m', 'm.id = v.record_meta_id', 'left');
            $this->db->where_in("v.record_meta_id", $MAJOR_META_IDS_LIST[$ret['module_id']]);
            $this->db->where("v.record_id", $ret["record_id"]);
            $res = $this->db->get("anb_crm_record_meta_value v");
            foreach ($res->result_array() as $record) {
                $tempData[$record["id"]] = $record["value"];
            }

            if ($ret['module_id'] == LEADS){
                $ret["module_name"] = LEADS_PLURAL_NAME;
                $ret["record_title"] = $tempData[$MAJOR_META_IDS_LIST[LEADS][0]] . " " . $tempData[$MAJOR_META_IDS_LIST[LEADS][1]];
            } else if ($ret['module_id'] == CLIENTS){
                $ret["module_name"] = CLIENTS_PLURAL_NAME;
                $ret["record_title"] = $tempData[$MAJOR_META_IDS_LIST[CLIENTS][0]];
            } else if ($ret['module_id'] == CONTRACTS){
                $ret["module_name"] = CONTRACTS_PLURAL_NAME;
                $ret["record_title"] = $tempData[$MAJOR_META_IDS_LIST[CONTRACTS][0]];
            }
        } else {
            $ret["record_title"] = "No record associated";
        }

        return $ret;
    }
}