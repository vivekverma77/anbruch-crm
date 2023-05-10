<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class MemberModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    function login()
    {
        $return = false;
        $user_id = '';
        $email = $this->postGet('email');
        $password = $this->postGet('password');
        $this->db->select("anb_crm_users.id as user_id, anb_crm_users.role_id, p.*, r.permission, r.title as role_title,");
        $this->db->where('status', 1);
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $this->db->join('anb_crm_users_personal_info p', 'p.user_id = anb_crm_users.id', 'left');
        $this->db->join('anb_crm_roles r', 'r.id = anb_crm_users.role_id', 'left');
        $res = $this->db->get('anb_crm_users');
        foreach ($res->result() as $user) {
					//echo '<pre>';print_r($user);die;
            $username = $user->first_name . " " . $user->last_name;
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('user_id', $user->user_id);
            $this->session->set_userdata('role_id', $user->role_id);
            $this->session->set_userdata('role_title', $user->role_title);
            $this->session->set_userdata('permission', $user->permission);
            $user_id = $user->user_id;
            $return = true;
        }

        if ($user_id != ''){
            $data = array(
                "last_logged_in" => time()
            );

            $this->db->where("id", $user_id);
            $this->db->update("anb_crm_users", $data);
        }

        return $return;
    }

    function loadModules(){
        $ret = array();
        $this->db->where('visibility', 1);
        $this->db->order_by('serial');
        $res = $this->db->get('anb_crm_modules');
        foreach ($res->result() as $modules) {
            $mod = array();
            $mod["module_id"] = $modules->id;
            $mod["singular_name"] = $modules->singular_name;
            $mod["name"] = $modules->plural_name;
            $ret[] = $mod;
        }
        return $ret;
    }

    function loadUserData($uid)
    {
			$ret = array();
			$this->db->where('u.id', $uid);
			$this->db->select("u.id, u.email, p.first_name, p.last_name, p.date_of_birth, p.profile_picture, p.phone, p.gender, p.share_calendar, p.salary, p.hourly_rate");
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
			$res = $this->db->get('anb_crm_users u');
			foreach ($res->result() as $user) {
					$ret["id"] = $user->id;
					$ret["email"] = $user->email;
					$ret["first_name"] = $user->first_name;
					$ret["last_name"] = $user->last_name;
					$ret["date_of_birth"] = $user->date_of_birth;
					$ret["profile_picture"] = $user->profile_picture;
					$ret["phone"] = $user->phone;
					$ret["gender"] = $user->gender;
					$ret["share_calendar"] = $user->share_calendar;
					$ret["salary"] = $user->salary;
					$ret["hourly_rate"] = $user->hourly_rate;
			}
			return $ret;
    }

    function loadUserAttendance($user_id, $month, $year)
    {
			$ret = array();
			$this->db->select("*");
			$this->db->where('a.user_id', $user_id);
			$this->db->where('MONTH(a.date)', $month);
			$this->db->where('YEAR(a.date)', $year);
			$this->db->order_by('date', "ASC");			
			$res = $this->db->get('anb_crm_attendance a');
			$ret = $res->result_array();
			return $ret;
    }

    function loadUserNotifications($id)
    {
			//echo $id;
			$this->db->select("acn.*,r.module_id,r.record_status");
            $this->db->join('anb_crm_record r','r.id=acn.record_id');  
			$this->db->where('acn.receiver_id', $id);
			$this->db->where('acn.read',0);			
			$this->db->order_by('acn.id','DESC');			
			$res = $this->db->get('anb_crm_notifications acn');
			$ret = $res->result_array();        
			return $ret;
			//echo '<pre>';print_r($ret);         
    }

    function profileUpdate($uid, $profile_picture = null){
        $password = $this->postGet('password');
        $conf_password = $this->postGet('conf_password');

        if ($password != ''){
            if ($password != $conf_password) {
                return "Confirm password doesn't match.";
            }
            $data = array(
                "password" => md5($password),
                "modified_time" => time(),
            );

            $this->db->where("id", $uid);
            $this->db->update("anb_crm_users", $data);
        }

        $data = array();
        if ($this->postGet('first_name') != '') $data["first_name"] = $this->postGet('first_name');
        if ($this->postGet('last_name') != '') $data["last_name"] = $this->postGet('last_name');
        if ($this->postGet('phone') != '') $data["phone"] = $this->postGet('phone');
        if ($this->postGet('gender') != '') $data["gender"] = $this->postGet('gender');
        if ($this->postGet('date_of_birth') != '') $data["date_of_birth"] = $this->postGet('date_of_birth');
        if ($profile_picture != null) $data["profile_picture"] = $profile_picture;

        if (count($data) > 0){
            $this->db->where("user_id", $uid);
            $this->db->update("anb_crm_users_personal_info", $data);
            if (isset($data["first_name"]) || isset($data["last_name"])) {
                $username = '';
                if (isset($data["first_name"])) $username = $data["first_name"];
                if (isset($data["last_name"])) $username .= ($username == '') ? $data["last_name"] : (" " . $data["last_name"]);
                if ($username != '') $this->session->set_userdata('username', $username);
            }
        }

        return true;
    }

    function settingUpdate($uid){
				//print_r($_POST);die();
       $data = array();
        if(!empty($_POST['share_calendar']))
        { 
					$data["share_calendar"] = json_encode($_POST['share_calendar']); 
				}
				else
				{ 
					$data["share_calendar"] = ''; 
				}     
       //print_r($data["share_calendar"]);die();
				$this->db->where("user_id", $uid);
				$this->db->update("anb_crm_users_personal_info", $data);      

        return true;
    }

    function passwordCheck($uid, $password){
        $this->db->select("*");
        $this->db->where('status', 1);
        $this->db->where('id', $uid);
        $this->db->where('password', md5($password));
        $res = $this->db->get('anb_crm_users');

        if ($res->num_rows() > 0){
            return true;
        } else {
            return "Incorrect current password.";
        }

    }
}
