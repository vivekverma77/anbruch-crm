<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Modules extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("ActivitiesModel");
        $this->load->model("ModuleModel");
    }

    public function index()
	{
        global $FIELD_TYPE;
        global $RECORD_STATUS;
        $this->data["recordStatus"] = ($this->getPost("rStat") != '') ? $this->getPost("rStat") : $RECORD_STATUS["CYCLE_RUNNING"];
        if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
            $this->data["writePermission"] = false;
        }
        $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
        $this->data["page"] = ($this->getPost("page") != '') ? $this->getPost("page") : 1;
        $this->data["current_module"] = $this->getPost("cm");

        if ( $this->getPost('bulk') == 'on' ){
            if ($this->getPost('ac') == 'mOwner'){
                $message = $this->ModuleModel->changeOwner($this->getUserId(), true, $this->getPost("uid"), $this->getPost("new"));
            }

            if ($message["status"] === true){
                $this->data["message"]["success"] = 'Records have been updated successfully.';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["total_record"] = $this->ModuleModel->getTotalRecord($this->data["recordStatus"], $this->data["own"]);
        $this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
        $this->data["FIELD_TYPE"] = $FIELD_TYPE;
        $this->data["record_data"] = $this->ModuleModel->loadRecordList($this->data["recordStatus"], $this->data["own"]);
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
/*        $this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();*/
        $this->viewLoad("modules/list");
	}

    public function advanceSearch()
	{
        global $FIELD_TYPE;
        global $RECORD_STATUS;
        $this->data["recordStatus"] = ($this->getPost("rStat") != '') ? $this->getPost("rStat") : $RECORD_STATUS["CYCLE_RUNNING"];
        if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
            $this->data["writePermission"] = false;
        }
        $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
        $this->data["page"] = ($this->getPost("page") != '') ? $this->getPost("page") : 1;
        $this->data["current_module"] = $this->getPost("cm");

        if ( $this->getPost('bulk') == 'on' ){
            if ($this->getPost('ac') == 'mOwner'){
                $message = $this->ModuleModel->changeOwner($this->getUserId(), true, $this->getPost("uid"), $this->getPost("new"));
            }

            if ($message["status"] === true){
                $this->data["message"]["success"] = 'Records have been updated successfully.';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["search_result"] = false;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            if ($this->getPost("s") != ''){
                $this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
                $this->data["FIELD_TYPE"] = $FIELD_TYPE;
                $this->data["record_data"] = $this->ModuleModel->loadSearchRecordList($this->data["recordStatus"], $this->data["own"]);
                $this->data["users_list"] = $this->ModuleModel->loadUsersList();
                $this->data["search_result"] = true;
            } else {
                $this->data["message"]["info"] = "Please enter any text to search in " . $this->getPost("cm") . ".";
            }
        } else {
            $this->data["message"]["info"] = "Please enter any text to search in " . $this->getPost("cm") . ".";
        }

        $this->viewLoad("modules/advance_search");
	}

    public function addRecord(){
        if ($this->data["writePermission"] == false){
            $this->redirectAccessViolatedUser();
        }
        global $FIELD_TYPE;
        $this->data["current_module"] = $this->getPost("cm");
        $this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
        $this->data["FIELD_TYPE"] = $FIELD_TYPE;

        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            $message = $this->ModuleModel->addRecord($this->data["meta_fields"], $this->getUserId());
            if ($message["status"] === true){
                $this->data["message"]["success"] = 'Record has been added successfully. <a href="'. base_url() .'index.php/modules/viewRecord/?cm='. $this->data["current_module"] .'&id='. $message["id"] .'">View The Record?</a>';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        if ($this->data["current_module"] == CONTRACTS_PLURAL_NAME){
            $this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
        }
        $this->viewLoad("modules/new");
    }

    public function editRecord(){
        if ($this->ModuleModel->checkWritable($this->getPost("id")) == false){
            $this->data["writePermission"] = false;
        }
        if ($this->data["writePermission"] == false){
            $this->redirectAccessViolatedUser();
        }
        global $FIELD_TYPE;
        $this->data["current_module"] = $this->getPost("cm");
        $this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
        $this->data["FIELD_TYPE"] = $FIELD_TYPE;
        $this->data["record_id"] = $this->getPost("id");

        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            $message = $this->ModuleModel->updateRecord($this->data["meta_fields"], $this->getUserId());
            if ($message["status"] === true){
                $this->data["message"]["success"] = 'Record has been updated successfully.';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["record_data"] = $this->ModuleModel->loadRecord();
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        if ($this->data["current_module"] == CONTRACTS_PLURAL_NAME) {
            $this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
        }
        $this->viewLoad("modules/edit");
    }

    public function viewRecord(){
        global $FIELD_TYPE;
        global $RECORD_STATUS;
        $loadViewWithData = true;
        $this->data["recordStatus"] = ($this->getPost("record_status") != '') ? $this->getPost("record_status") : $RECORD_STATUS['CYCLE_RUNNING'];
        $this->data["current_module"] = $this->getPost("cm");
        $this->data["current_record_id"] = $this->getPost("id");
        if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
            $this->data["writePermission"] = false;
        }
        if ( $this->getPost("ac") == 'del' ){
            if ($this->data["writePermission"] == false){
                $this->redirectAccessViolatedUser();
            }
            $message = $this->ModuleModel->delRecord();
            if ($message["status"] === true){
                $this->data["action"] = ( $this->getPost("mtd") == 1 ) ? "archive" : "delete";
                $this->data["message"]["success"] = "Record has been " . $this->data["action"] . "d successfully";
                $this->data["deletedRecord"] = true;
                $loadViewWithData = false;
                $this->viewLoad("modules/view");
            } else {
                $this->data["message"]["danger"] = 'Error! Record cannot be deleted now. Please try again later.';
            }
        } else if ( $this->getPost("ac") == 'attachment' ) {
            $record_id = $this->postGet('record_id');
            $record_attachment_url = null;
            if (isset($_FILES["record_attachment"]) && $_FILES["record_attachment"]['name'] != '') {
                $fileUpload = $this->fileUpload($this->getUserId(), "record_attachment", RECORD_ATTACHMENT, $record_id);
                if ($fileUpload["status"] === true){
                    $record_attachment_url = $fileUpload["attachment_url"];
                } else {
                    $this->data["message"]["danger"] = $fileUpload["error"];
                }
            }

            if (!isset($this->data["message"]["danger"])){
                $updateIssue = $this->ModuleModel->addAttachment($this->getUserId(), $record_id, $record_attachment_url, RECORD_ATTACHMENT);
                if ($updateIssue === true ) {
                    $this->data["message"]["success"] = "The attachment has been uploaded successfully";
                } else {
                    $this->data["message"]["danger"] = $updateIssue;
                }
            }
        } else if ( $this->getPost("ac") == 'note' ) {
            $record_id = $this->postGet('record_id');
            $updateIssue = $this->ModuleModel->addNote($this->getUserId(), $record_id, RECORD_ATTACHMENT);
            if ($updateIssue === true ) {
                $this->data["message"]["success"] = "The note has been added successfully";
            } else {
                $this->data["message"]["danger"] = $updateIssue;
            }
        } else if ( $this->getPost("ac") == 'convert' ) {
            if ($this->data["writePermission"] == false){
                $this->redirectAccessViolatedUser();
            }
            $convertIssue = $this->ModuleModel->convertRecord($this->getUserId());
            if ($convertIssue === true ) {
                $this->data["message"]["success"] = "The record has been converted successfully";
                $this->data["deletedRecord"] = true;
                $loadViewWithData = false;
                $this->viewLoad("modules/view");
            } else {
                $this->data["message"]["danger"] = $convertIssue;
            }
        }

        if ($loadViewWithData){
            $this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
            $this->data["FIELD_TYPE"] = $FIELD_TYPE;
            $this->data["record_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"]);
            $this->data["users_list"] = $this->ModuleModel->loadUsersList();
            $this->data["notes"] = $this->ModuleModel->loadNotes();
            $this->data["attachments"] = $this->ModuleModel->loadAttachments();
            $this->data["activities"] = $this->ActivitiesModel->loadActivitiesList(null, $this->data["current_record_id"]);
            if ($this->data["current_module"] == 'Clients'){
                $this->data["contracts"] = $this->ModuleModel->loadContracts();
            }
            if ($this->data["current_module"] == CONTRACTS_PLURAL_NAME) {
                $this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
            }
            $this->viewLoad("modules/view");
        }
    }
}
