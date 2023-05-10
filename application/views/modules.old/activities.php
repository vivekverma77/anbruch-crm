<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Activities extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("ActivitiesModel");
        $this->load->model("ModuleModel");
    }

    public function index()
	{
        $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
        $this->data["record_data"] = $this->ActivitiesModel->loadActivitiesList($this->data["own"]);
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->viewLoad("activities/activities");
	}

    function addActivity(){
        global $MAJOR_META_IDS_LIST;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            $message = $this->ActivitiesModel->addRecord($this->getUserId());
            if ($message["status"] === true){
                $this->data["message"]["success"] = 'An activity has been added successfully. <a href="'. base_url() .'index.php/activities/viewRecord/?&id='. $message["id"] .'">View The Activity?</a>';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
        $this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
        $this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);

        $this->viewLoad("activities/new");
    }

    function editRecord(){
        global $MAJOR_META_IDS_LIST;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            $message = $this->ActivitiesModel->updateRecord($this->getUserId());
            if ($message["status"] === true){
                $this->data["message"]["success"] = 'The activity has been updated successfully.';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["id"] = $this->getPost("id");
        $this->data["record_data"] = $this->ActivitiesModel->viewRecord();
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
        $this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
        $this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);

        $this->viewLoad("activities/update");
    }

    function viewRecord(){
        global $MAJOR_META_IDS_LIST;
        $this->data["id"] = $this->getPost("id");
        $this->data["record_data"] = $this->ActivitiesModel->viewRecord();
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
        $this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
        $this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);

        $this->viewLoad("activities/view");
    }
}
