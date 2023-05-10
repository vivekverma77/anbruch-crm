<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Emailtemplates extends Base {
	public function __construct(){
			parent::__construct();
			$this->redirectPublicUser();
			$this->load->model("ActivitiesModel");
			$this->load->model("EmailtemplatesModel");
			$this->load->model("ModuleModel");
			$this->load->model("App_model");
	}

	public function index($status = 1)
	{	
			$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
			$this->data["record_data"] = $this->EmailtemplatesModel->loadEmailtemplatesList($this->data["own"],'', $status);
			$this->data["templateStatus"] =$status;
			$this->data["users_list"] = $this->ModuleModel->loadUsersList();
			$this->viewLoad("emailtemplates/emailtemplates");
	}

	function add()
	{
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
		
			global $MAJOR_META_IDS_LIST;
			if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
					$message = $this->EmailtemplatesModel->addRecord($this->getUserId());
					if ($message["status"] === true){
							//$result = $this->EmailtemplatesModel->addSlug($_POST['mode'],$mode_title);
							//$this->data["message"]["success"] = 'A template has been added successfully. <a href="'. base_url() .'index.php/emailtemplates/viewRecord/?&id='. $message["id"] .'">View The Template?</a>';
							
							$this->session->set_flashdata('success','A template has been added successfully. <a href="'. base_url() .'index.php/emailtemplates/viewRecord/?&id='. $message["id"] .'">View The Template?</a>');
							
							redirect(base_url().'emailtemplates');
					} else {
						
							//$this->data["message"]["danger"] = $message["message"];
							$this->session->set_flashdata('error',$message["message"]);
							redirect(base_url().'emailtemplates/add');
					}
			}

		$this->data["saved_modes"] = $this->EmailtemplatesModel->loadEmailtemplatesSavedModes($this->data["own"]);
		 
		/*global $EMAIL_NOTIFICATION_PROCESS;

		$this->data['modes'] = $EMAIL_NOTIFICATION_PROCESS;*/

		/*global $email_notification;
		$this->data['modes'] = $email_notification;*/
	
		$this->viewLoad("emailtemplates/new");
	}

	function editRecord(){
			
			global $MAJOR_META_IDS_LIST;
			if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
					//echo '<pre>';print_r($_POST);die;
					/*$mode = $this->input->post('mode');
					$status = $this->App_model->getData('anb_crm_email_notification_processes','*', array('email_notification_process_value' => $mode));
					if(empty($status))
					{
						$slug_name = str_replace(' ', '_', $mode);
						$result = $this->App_model->rowInsert('anb_crm_email_notification_processes',array('email_notification_process_key' => $slug_name, 'email_notification_process_value' => $mode))
						die("Nixe");
					}*/
					
					$message = $this->EmailtemplatesModel->updateRecord($this->getUserId());
					if ($message["status"] === true){
							//$this->data["message"]["success"] = 'The record data has been updated successfully.';
							$this->session->set_flashdata('success', 'The record data has been updated successfully.');
							redirect(base_url().'emailtemplates');
					} else {
							//$this->data["message"]["danger"] = $message["message"];
							$this->session->set_flashdata('error',$message["message"]);
							 redirect(base_url().'emailtemplates/editrecord/?&id='.$message["id"]);
							
					}
			}

			$this->data["id"] = $this->getPost("id");
			$this->data["record_data"] = $this->EmailtemplatesModel->viewRecord();
			$this->data["users_list"] = $this->ModuleModel->loadUsersList();
			$this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
			$this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
			$this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);
			$this->data["module_ids"] = array('1' => 'Leads', '2' => 'Clients', '3' => 'Contracts','4' => 'Others');
			/*global $EMAIL_NOTIFICATION_PROCESS;       
			$this->data['modes'] = $EMAIL_NOTIFICATION_PROCESS;*/
			
			/*global $email_notification;
			$this->data['modes'] = $email_notification;*/

			$this->viewLoad("emailtemplates/update");
	}

	function viewRecord(){
			/*global $EMAIL_NOTIFICATION_PROCESS;       
			$this->data['modes'] = $EMAIL_NOTIFICATION_PROCESS;*/
			/*global $email_notification;
			$this->data['modes'] = $email_notification;*/

			global $MAJOR_META_IDS_LIST;
			$this->data["id"] = $this->getPost("id");
			$this->data["record_data"] = $this->EmailtemplatesModel->viewRecord();
			$this->data["users_list"] = $this->ModuleModel->loadUsersList();
			$this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
			$this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
			$this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);

			$this->viewLoad("emailtemplates/view");
	}
	/* mass delete */
	function deleteRecord(){
		
		$res = $this->EmailtemplatesModel->deleteRecord();
		
		 $this->session->set_flashdata('success','Template has been deleted successfully.');
							
			redirect(base_url().'emailtemplates');
	}
	/* delete by record id */
	function deleteRecordById(){

		$res = $this->EmailtemplatesModel->deleteRecordById();
		
		$this->session->set_flashdata('success','Template has been deleted successfully.');
							
		redirect(base_url().'emailtemplates');
	}
	/* mass restore */
	function restoreRecord(){
		
		$res = $this->EmailtemplatesModel->restoreRecord();
		
		 $this->session->set_flashdata('success','Template has been restored successfully.');
							
			redirect(base_url().'emailtemplates');
	}
	function restoreRecordById(){

		$res = $this->EmailtemplatesModel->restoreRecordById();
		
		$this->session->set_flashdata('success','Template has been restored successfully.');
							
		redirect(base_url().'emailtemplates');
	}
	function getTemplateBySlug()
	{
		$type = "email";
		$slug = $this->getPost("slug");
		$this->data["record_data"] = $this->EmailtemplatesModel->get_template_by_slug($type, $slug);

		echo json_encode($this->data["record_data"]);
		exit;
		
	}

	function cloneRecord(){
		   if ( $this->input->get()){
			   	$this->data["id"] = $this->input->get("id");
			   	$templateStatus = $this->input->get("status");
			   	$templateData = $this->EmailtemplatesModel->viewRecord();
				$this->data["users_list"] = $this->ModuleModel->loadUsersList();
				$emailtemplates = array(
								'type' => isset($templateData['type']) ? $templateData['type'] : '',
								'slug' => isset($templateData['slug']) ? $templateData['slug'] : '',
								'slug_name' => isset($templateData['slug_name']) ? $templateData['slug_name'] : '',
								'title' => isset($templateData['title']) ? $templateData['title'] : '',
								'pipeline_stage' => isset($templateData['pipeline_stage']) ? $templateData['pipeline_stage'] : '',
								'template' => isset($templateData['template']) ? $templateData['template'] : '',
								'module_id' => isset($templateData['module_id']) ? $templateData['module_id'] : '',
								'status' => 1,
								'created_by' => $this->getUserId(),
								'created_time' => date('Y-m-d H:i:s'),
								'active' => $templateStatus
							);
			$id = $this->App_model->rowInsert('anb_crm_emailtemplates',$emailtemplates);
			if($id > 1){
				$this->session->set_flashdata('success','A template has been cloned successfully. <a href="'. base_url() .'index.php/emailtemplates/viewRecord/?&id='. $id .'">View The Template?</a>');	
					redirect(base_url().'emailtemplates/'.$templateStatus);
			}else{
				$this->session->set_flashdata('error','There are some problem to perform this action');
			}
						
		}
	}
}
