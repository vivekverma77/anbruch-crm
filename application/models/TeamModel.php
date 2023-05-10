<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class TeamModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    function loadTeamsList($status = ACTIVE_TEAMS)
    {
        $ret = array();
        $this->db->select("tm.*");
        $this->db->where('tm.status', $status);        
        $this->db->order_by('tm.id', 'DESC');        
        $res = $this->db->get('anb_crm_teams tm');
        $ret = $res->result_array();  

        return $ret;
    }

    function loadTeam($uid)
    {        
        $ret = array();
        $this->db->select("tm.*");
        $this->db->where('tm.id', $uid);        
        $res = $this->db->get('anb_crm_teams tm');
        $ret = $res->row_array();  

        return $ret;
		}
		
    function loadRolesList()
    {
        $ret = array();
        $this->db->select("*");
        $res = $this->db->get('anb_crm_roles');
        foreach ($res->result_array() as $role) {
            if ($role["id"] == 1) continue;
            $ret[$role["id"]] = $role["title"];
        }

        return $ret;
    }

    function addUser($userID)
    {			 
			
			//echo '<pre>';print_r($_POST);die;			
		
			if ($this->getPost("name") == ''){
					return "Team name is missing.";
			}
            
			if (empty($this->getPost("members")) || count($this->getPost("members"))<2){
					return "Members are missing. Select atleast two members!";
			}
			
			$recordData = array( 
					"name" => $this->getPost("name"),
                    "members" => json_encode($this->getPost("members")),
					"status" => 1,
					"created_by" => $userID,
					"modified_by" => $userID,
					"created_time" => date('Y-m-d H:i:s'),				
					"modified_time" => date('Y-m-d H:i:s'),				
			);

			$recordCreationSuccessful = $this->db->insert("anb_crm_teams", $recordData);
			if ($recordCreationSuccessful === true) {
					$uid = $this->db->insert_id();					
			} else {
					return "Server error! Please try again later.";
			}

			return true; 
    }

    function updateUser($userID) 
    {	
				//echo '<pre>';print_r($_POST);die;
			
				 $uid = $this->getPost("teamId");	
				 
      	if ($this->getPost("name") == ''){
					return "Team name is missing.";
				}
				if (empty($this->getPost("members")) || count($this->getPost("members"))<2){
						return "Members are missing. Select atleast two members!";
				}
                

        $recordData = array(                      
          "name" => $this->getPost("name"),
          			"members" => json_encode($this->getPost("members")),
					"modified_by" => $userID,
					"modified_time" => date('Y-m-d H:i:s'),				
        );
				
				$this->db->where('id', $uid);
        $recordCreationSuccessful = $this->db->update("anb_crm_teams", $recordData);
       
        if ($recordCreationSuccessful == true) {
           
        } else {
            return "Server error! Please try again later.";
        }

        return true;
    }

    function deleteUser($uid)
    {
        $this->db->reset_query();
        $this->db->where("id", $uid);
        $this->db->delete('anb_crm_teams');
       
    }

    function changeStatusOfUser($status, $uid){
        $recordData = array(
            "status" => $status,
            "modified_time" => date('Y-m-d H:i:s'),
        );

        $this->db->where("id", $uid);
        $recordCreationSuccessful = $this->db->update("anb_crm_teams", $recordData);
        return $recordCreationSuccessful;
    }

    function bulkAction($status, $uids){
        $uids = explode(",", $uids);
        foreach ($uids as $key => $uid){
            $this->changeStatusOfUser($status, $uid);
        }

        return true;
    }

    function changePasswordOfUser($uid){
        $password = $this->randomPassword();
        $recordData = array(
            "password" => md5($password),
            "modified_time" => time(),
        );

        $this->db->where("id", $uid);
        $recordCreationSuccessful = $this->db->update("anb_crm_teams", $recordData);

        $data = array(
            'data' => $this->loadUser($uid)
        );
        $data['data']['password'] = $password;
        $this->sendTransactionalEmail($data['data']['email'], "CRM password has been reset", "transaction_emails/user/password_reset", $data);

        return $recordCreationSuccessful;
    }

    function checkPasswordMatching($password, $conf_password){
        if ($password == '') {
            return "Password is missing.";
        } else if ($password != $conf_password){
            return "Password doesn't match.";
        }

        return true;
    }
    
     function loadBookingsList($bid = null, $record_id = null, $email = null, $booking_status=null){
			 
        $ret = array();
        $this->db->select("ac.*, p.first_name, p.last_name");
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = ac.created_by', 'left');
        if ($bid != null)
        {
					$this->db->where("ac.id", $bid);
				}
				else
				{
					$this->db->order_by("ac.id", 'DESC');
				}
        if ($email != null) $this->db->where("ac.email", $email);
        if (!empty($booking_status)) $this->db->where_in("ac.status", $booking_status);
        if ($record_id != null) $this->db->where("ac.record_id", $record_id);
        $qry = $this->db->get('anb_crm_bookings ac');
        if ($bid != null) 
        {
					$ret = $qry->row_array();
				}
				else
				{
					$ret = $qry->result_array();
				}
        return $ret;
    }
    
     function cancelBooking()
    {			
			$recordData = array(				
					"status" => 2,  //2=cancelled			
					"modified_by" => $this->getPost("created_by"),						
					"modified_time" =>date('Y-m-d H:i:s'),				
			);
			
			$this->db->where('id', $this->getPost("bookingId"));	
			$this->db->update("anb_crm_bookings", $recordData);         
			
			if ($this->db->affected_rows() == '1')
			{
				$recordId = $this->db->insert_id();
				return true;
			}
			else
			{
				return false;
			}
		}
    
}
