<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Holidays extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("HolidaysModel");
        $this->load->model("ModuleModel");
    }

    public function index() {
			
			$this->data["record_data"] = $this->HolidaysModel->loadHolidaysList();

			$this->viewLoad("holidays/index");
			
		}

    function addRecord(){
        
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
					
            $message = $this->HolidaysModel->addRecord($this->getUserId());
            
            if ($message["status"] === true){
                //$this->data["message"]["success"] = 'A holiday has been added successfully.';
                $this->session->set_flashdata('success','A holiday has been added successfully.');
                redirect(base_url().'index.php/holidays');
            } else {
                //$this->data["message"]["danger"] = $message["message"];
                $this->session->set_flashdata('error',$message["message"]);
                
                redirect(base_url().'index.php/holidays/addRecord');
            }
         
        }
    
        $this->viewLoad("holidays/new");
    }

    function editRecord($id){
		
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){ 
            $message = $this->HolidaysModel->updateRecord($this->getUserId());
            if ($message["status"] === true){
                //$this->data["message"]["success"] = 'The holiday has been updated successfully.';
                 $this->session->set_flashdata('success','A holiday has been updated successfully.');
                redirect(base_url().'index.php/holidays');
            } else {
                //$this->data["message"]["danger"] = $message["message"];
                $this->session->set_flashdata('error',$message["message"]);
                redirect(base_url().'index.php/holidays/editRecord/'.$id);
                
            }
        }

        $this->data["record_data"] = $this->HolidaysModel->viewRecord($id);

        $this->viewLoad("holidays/update");
    }
	
		function deleteRecord($id){
			
       $message = $this->HolidaysModel->deleteRecord($id);
            
				if ($message["status"] === true){
						//$this->data["message"]["success"] = 'A holiday has been deleted successfully.';
						 $this->session->set_flashdata('success','A holiday has been deleted successfully.');
						 redirect(base_url().'index.php/holidays');
				} else {
						//$this->data["message"]["danger"] = $message["message"];
						$this->session->set_flashdata('error',$message["message"]);
						redirect(base_url().'index.php/holidays');
				}
    
    }
    
    	function deleteMassRecord($ids){
			
       $message = $this->HolidaysModel->deleteMassRecord($ids);
       
       $this->session->set_flashdata('success','Holidays has been deleted successfully.');
                
       redirect(base_url().'index.php/holidays');
       
		 }

}
