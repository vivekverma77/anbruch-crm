<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class TeamManagement extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("UserModel");
        $this->load->model("TeamModel");
    }

    public function index()   
		{
        $this->data["page"] = "team_management";
        
        $this->data["teamStatus"] = ($this->getPost("us") != '') ? $this->getPost("us") : ACTIVE_TEAMS;
        
        if ( $this->getPost("bulk") == 'on' )
        {
            $this->TeamModel->bulkAction($this->getPost("ac"), $this->getPost("uid"));
            $this->data["message"]["success"] = "The items status has been updated";
        } 
        else if ( $this->getPost("ac") == '1' || $this->getPost("ac") == '0' )
        {
            $this->TeamModel->changeStatusOfUser($this->getPost("ac"), $this->getPost("uid"));
            $this->data["message"]["success"] = "The user status has been updated";
        } 
        else if ( $this->getPost("ac") == '-1' )
        {
            $this->TeamModel->changePasswordOfUser($this->getPost("uid"));
            $this->data["message"]["success"] = "The password of the user has been reset and emailed to the registered email of the user.";
        }
        $this->data["teams_list"] = $this->TeamModel->loadTeamsList($this->data["teamStatus"]);
        
        $this->data["users_list"] = $this->UserModel->loadUsersList();
        
        $this->viewLoad("team_management/team_management");
		}

    public function addNew()  
    {
			$this->data["page"] = "add_new";
			
			if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
					if ( ($message = $this->TeamModel->addUser($this->getUserId())) === true){
						$this->session->set_flashdata('success','The record has been created successfully.');
						
						 redirect(base_url().'TeamManagement');
					} else {
						$this->session->set_flashdata('error',$message);
						redirect(base_url().'TeamManagement/addNew');
					}					
			}

			$this->data["users_list"] = $this->UserModel->loadUsersList();
			$this->viewLoad("team_management/new");
    }
     
    public function edit()
    {  
        $this->data["page"] = "editr";
        $uid = $this->getPost("id");	
        
        if ( ($requestMethod = strtolower($this->input->method())) == 'post')
        {
            if ( ($message = $this->TeamModel->updateUser($this->getUserId())) === true){ 
             
                 $this->session->set_flashdata('success',"The record has been updated successfully.");
                redirect(base_url()."index.php/TeamManagement");
            } else {
               
                $this->session->set_flashdata('error',"$message");
                redirect(base_url()."index.php/TeamManagement/edit?id=$uid");
            }
        }
        
				
				if(is_numeric($uid))
				{
					$this->data["team"] = $this->TeamModel->loadTeam($uid);
					//echo '<pre>';print_r($this->data["user"]);die;
				}
				else
				{
					redirect(base_url()."index.php/TeamManagement/edit?id=$uid");
				}
        
        $this->data["users_list"] = $this->UserModel->loadUsersList();
        $this->viewLoad("team_management/update");
    }
    
    public function delete()
    {  
        $this->data["page"] = "delete";
        $uid = $this->getPost("id");	
      		
				if(is_numeric($uid))
				{
					 if ( ($message = $this->TeamModel->deleteUser($uid))){ 
							
							$this->session->set_flashdata('success',"The record has been deleted successfully.");
							redirect(base_url()."index.php/TeamManagement");
					} else {
						
							$this->session->set_flashdata('error',"$messagae");
							redirect(base_url()."index.php/TeamManagement");
					}
				}
				else
				{
					redirect(base_url()."index.php/TeamManagement");
				}       
    }
}
