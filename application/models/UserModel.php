<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    function loadUsersList($status = ACTIVE_USERS)
    {
        $ret = array();
        $this->db->select("u.id, u.email, u.created_time, u.last_logged_in, r.title as role, p.first_name, p.last_name, p.salary");
        $this->db->where('status', $status);
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
        $this->db->join('anb_crm_roles r', 'r.id = u.role_id', 'left');
        $res = $this->db->get('anb_crm_users u');
        foreach ($res->result_array() as $user) {
            if ($user["id"] == 1) continue;
            $ret[] = array(
                "id" => $user["id"],
                "email" => $user["email"],
                "created_time" => $user["created_time"],
                "last_logged_in" => $user["last_logged_in"],
                "role" => $user["role"],
                "first_name" => $user["first_name"],
                "last_name" => $user["last_name"],
                "salary" => $user["salary"],
            );
        }

        return $ret;
    }

    function loadUser($uid)
    {
        $ret = array();
        $this->db->select("u.id, u.email, u.created_time, u.last_logged_in, u.role_id, r.title as role, p.first_name, p.last_name, p.permissions, p.monthly_target, p.salary, p.hourly_rate ,p.id as pid");
        $this->db->where('u.id', $uid);
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
        $this->db->join('anb_crm_roles r', 'r.id = u.role_id', 'left');
        $res = $this->db->get('anb_crm_users u');
        foreach ($res->result_array() as $user) {
            
            $ret = array(
                "id" => $user["id"],
                "email" => $user["email"],
                "created_time" => $user["created_time"],
                "last_logged_in" => $user["last_logged_in"],
                "role" => $user["role"],
                "first_name" => $user["first_name"],
                "last_name" => $user["last_name"],
                "username" => $user["first_name"] . " " . $user["last_name"],
                "permissions" => $user["permissions"],
                "monthly_target" => $user["monthly_target"],
                "role_id" => $user["role_id"],
                "salary" => $user["salary"],
                "hourly_rate" => $user["hourly_rate"],
                "pid" => $user["pid"],
            );
        }

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
			$permissions = [];			
			if(!empty($_POST['p']))
			{
				$permissions = $_POST['p'];				
			}
			$permissions = json_encode($permissions);
			
			//echo '<pre>';print_r(json_encode($permissions));//die;
			//echo '<pre>';print_r($permissions);die;
		
			$passwordCheck = $this->checkPasswordMatching($this->getPost("password"), $this->getPost("conf_password"));

			if ($passwordCheck !== true){
					return $passwordCheck;
			}
			if ($this->getPost("email") == ''){
					return "Email address is missing.";
			}
			if ($this->getPost("first_name") == ''){
					return "First Name is missing.";
			}
			if ($this->getPost("last_name") == ''){
					return "Last Name is missing.";
			}

			if ($this->getPost("monthly_target") == ''){
					return "Monthly target is missing.";
			}

			$recordData = array(
					"email" => $this->getPost("email"),
					"password" => md5($this->getPost("password")),
					"role_id" => $this->getPost("role"),
					"created_time" => time(),				
			);

			$recordCreationSuccessful = $this->db->insert("anb_crm_users", $recordData);
			if ($recordCreationSuccessful === true) {
					$uid = $this->db->insert_id();

					$personal_info = array(
						"user_id" => $uid,
						"first_name" => $this->getPost("first_name"),
						"last_name" => $this->getPost("last_name"),
						"created_time" => time(),
						"permissions" => $permissions,
						"monthly_target" => $this->getPost("monthly_target"),
						"salary" => $this->getPost("salary"),
            "hourly_rate" => $this->getPost("hourly_rate"),
					);

					$userCreationSuccessful = $this->db->insert("anb_crm_users_personal_info", $personal_info);

					if ($userCreationSuccessful){
							$data = array(
									'data' => $this->loadUser($uid)
							);
							$data['data']['password'] = $this->getPost("password");
							$this->sendTransactionalEmail($data['data']['email'], "CRM password has been reset", "transaction_emails/user/account_creation", $data);
					} else {
							$this->deleteUser($uid);
					}

			} else {
					return "Server error! Please try again later.";
			}

			return true;
    }

    function updateUser($uid) 
    {	
				//echo '<pre>';print_r($_POST);die;
				$permissions = [];			
				if(!empty($_POST['p']))
				{
					$permissions = $_POST['p'];					
				}
				$permissions = json_encode($permissions);
				if($this->getPost("password")!="")
				{
					$passwordCheck = $this->checkPasswordMatching($this->getPost("password"), $this->getPost("conf_password"));

					if ($passwordCheck !== true){
						return $passwordCheck;
					}
					
					$recordData['password'] = md5($this->getPost("password"));
				}
				
        //if ($this->getPost("email") == ''){
            //return "Email address is missing.";
        //}
        
        if ($this->getPost("first_name") == ''){
            return "First Name is missing.";
        }
        if ($this->getPost("last_name") == ''){
            return "Last Name is missing.";
        }
        if ($this->getPost("monthly_target") == ''){
					return "Monthly target is missing.";
				}

        /*$recordData = array(                      
            "role_id" => $this->getPost("role"),
            "modified_time" => time(),
        );*/
        $recordData['role_id'] =  $this->getPost("role");                     
        $recordData['modified_time'] = time();
				//echo '<pre>';print_r($recordData);die;
				$this->db->where('id', $uid);
        $recordCreationSuccessful = $this->db->update("anb_crm_users", $recordData);
       
        if ($recordCreationSuccessful == true) {
            
            $personal_info = array(             
                "first_name" => $this->getPost("first_name"),
                "last_name" => $this->getPost("last_name"),
                "modified_time" => time(), 
                "permissions" => $permissions, 
                "monthly_target" => $this->getPost("monthly_target"),
                "salary" => $this->getPost("salary"),
                "hourly_rate" => $this->getPost("hourly_rate"),
            );
						
						$this->db->where('user_id', $uid);
            $userCreationSuccessful = $this->db->update("anb_crm_users_personal_info", $personal_info);
					
						if($this->getPost("password")!="")
						{
							if ($userCreationSuccessful){
									$data = array(
										 'data' => $this->loadUser($uid)
									);
									$data['data']['password'] = $this->getPost("password");
									$this->sendTransactionalEmail($data['data']['email'], "CRM password has been reset", "transaction_emails/user/account_updation", $data);
							} else {
									$this->deleteUser($uid);
							}
						}
            

        } else {
            return "Server error! Please try again later.";
        }

        return true;
    }

    function deleteUser($uid){
        $this->db->reset_query();
        $this->db->where("id", $uid);
        $this->db->update('anb_crm_users',['status'=>3]);

       /* $this->db->reset_query();
        $this->db->where("user_id", $uid);
        $this->db->delete('anb_crm_users_personal_info');*/
    }

    function changeStatusOfUser($status, $uid){
        $recordData = array(
            "status" => $status,
            "modified_time" => time(),
        );

        $this->db->where("id", $uid);
        $recordCreationSuccessful = $this->db->update("anb_crm_users", $recordData);
        return $recordCreationSuccessful;
    }

    function bulkAction($status, $uids){
        $uids = explode(",", $uids);
        foreach ($uids as $key => $uid){
            $this->changeStatusOfUser($status, $uid);
        }

        return true;
    }

    /*function changePasswordOfUser($uid){
        $password = $this->randomPassword();
        $recordData = array(
            "password" => md5($password),
            "modified_time" => time(),
        );

        $this->db->where("id", $uid);
        $recordCreationSuccessful = $this->db->update("anb_crm_users", $recordData);

        $data = array(
            'data' => $this->loadUser($uid)
        );
        $data['data']['password'] = $password;
        $this->sendTransactionalEmail($data['data']['email'], "CRM password has been reset", "transaction_emails/user/password_reset", $data);

        return $recordCreationSuccessful;
    }*/
    function changePasswordOfUser($uid){
        $password = $this->randomPassword();
        $recordData = array(
            "password" => md5($password),
            "modified_time" => time(),
        );

        $this->db->where("id", $uid);
        $recordCreationSuccessful = $this->db->update("anb_crm_users", $recordData);

        $data = array(
            'data' => $this->loadUser($uid)
        );
        $data['data']['password'] = $password;
        $this->sendTransactionalEmail($data['data']['email'], "CRM password has been reset", "transaction_emails/user/password_reset", $data);

        return $password;
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
                    "praposed_date" => "",
                    "praposed_end_time" => "",
                    "praposed_notes" => "",
					"modified_by" => $this->getPost("created_by"),						
                    "modified_time" =>date('Y-m-d H:i:s'),              
					"status_change_date" =>date('Y-m-d H:i:s')			
			);
			 $this->db->where('id', $this->input->get('bid'));
			//$this->db->where('id', $this->getPost("bookingId"));	
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
    function confirmBooking()
    {           
            $recordData = array(                
                    "status" => 1,  //1=confirmed           
                    "modified_by" => $this->getPost("created_by"),                      
                    "modified_time" =>date('Y-m-d H:i:s'),
                    "status_change_date" =>date('Y-m-d H:i:s')              
            );
            $this->db->where('id', $this->input->get('bid'));
           // $this->db->where('id', $this->getPost("bookingId"));    
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


        public function get_users() 
        {
            $res = $this->db->get('anb_crm_users');
            $result = $res->result_array();
            return $result;
        }
}
