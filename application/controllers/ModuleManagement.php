<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class ModuleManagement extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("ModuleModel");
    }

    public function index()
	{
	}

    public function leadConversionMapping(){
        global $FIELD_TYPE;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post' ){
            if ($this->ModuleModel->updateMetaMapping() == true){
                $this->data["message"]["success"] = "The meta conversion recorded successfully";
            } else {
                $this->data["message"]["danger"] = "Error! Please try again later.";
            }
        }

        $this->data["leads_meta_fields"] = $this->ModuleModel->loadModulesMeta(LEADS_PLURAL_NAME);
        $this->data["clients_meta_fields"] = $this->ModuleModel->loadModulesMeta(CLIENTS_PLURAL_NAME);
        $this->data["contracts_meta_fields"] = $this->ModuleModel->loadModulesMeta(CONTRACTS_PLURAL_NAME);
        $this->data["meta_fields_mapping"] = $this->ModuleModel->loadMetaMapping();
        $this->data["FIELD_TYPE"] = $FIELD_TYPE;
        $this->viewLoad("module_management/convert");
    }

    public function modifyPrimaryView(){
        global $FIELD_TYPE;
        $this->data["current_module"] = ($this->getPost("cm") != '') ? $this->getPost("cm") : LEADS_PLURAL_NAME;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post' ){
            if ($this->ModuleModel->updatePrimaryView($this->data["current_module"]) == true){
                $this->data["message"]["success"] = "The view has been recorded successfully";
            } else {
                $this->data["message"]["danger"] = "Error! Please try again later.";
            }
        }
        $this->data["meta_fields"] = $this->ModuleModel->loadModulesViewData($this->data["current_module"]);
        $this->data["FIELD_TYPE"] = $FIELD_TYPE;
        $this->viewLoad("module_management/primary_view");
    }
	public function modifySortingView(){
        global $FIELD_TYPE;
        $action = $this->getPost("order");
        $id = $this->getPost("id");
        $idx = $this->getPost("idx");
        $this->data["current_module"] = ($this->getPost("cm") != '') ? $this->getPost("cm") : LEADS_PLURAL_NAME;
        if($action == 'up' || $action == 'down')
        {
			//$this->ModuleModel->updatePrimaryView
			$this->ModuleModel->updateSortingOrder($action, $id, $this->data["current_module"], $idx);
			redirect('/ModuleManagement/modifySortingView?cm='.$this->data["current_module"]);
		}
		else
		{
			$this->ModuleModel->updateMissingOrders($this->data["current_module"]);
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesSortingData($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;
			$this->viewLoad("module_management/sorting_view");
		}
    }     
}
