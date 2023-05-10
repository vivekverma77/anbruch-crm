<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once BASEPATH . "../application/libraries/utilities.php";

class Base extends CI_Controller
{
    protected $data;
    public $mydata;
    public function __construct($checkACL = 1)
    {
        parent::__construct();
        set_time_limit(0);
        ini_set("memory_limit","-1");
        ini_set("max_execution_time", 0);
        $writePermission = $this->getSessionAttr("permission");
        $acl_permission = $this->checkACL();
        
        if ($checkACL && $acl_permission['status'] == 'Denied') {
            $this->redirectAccessViolatedUser();
        }

        $this->load->model("MemberModel");
        $this->data = array(
            "superAdmin" => $this->isSuperAdmin(),
            "modules" => $this->MemberModel->loadModules(),
            "currentUserData" => $this->MemberModel->loadUserData($this->getUserId()),
        );
        $this->mydata["topnotifications"] = $this->MemberModel->loadUserNotifications($this->getUserId());
        
        if ($this->isSuperAdmin()){
            $this->data["writePermission"] = true;
        } else {
            //$this->data["writePermission"] = $this->checkWritePermission($writePermission, $this->data["modules"]);
            $this->data["writePermission"] = true;
        }
    }

    public function index()
    {
        redirect("home", "refresh");
    }

    protected function redirectAccessViolatedUser(){
        redirect("restrictions/accessViolation", "refresh");
    }

    protected function isSuperAdmin(){
        global $SUPER_ADMIN_LIST;
        return (in_array($this->getUserId(), $SUPER_ADMIN_LIST));
    }

    private function checkWritePermission($writePermission, $modules_list){
        $controller = $this->uri->segment(1, 'dashboard');
        $moduleName = $this->getPost("cm", 'na');

        if ($controller == 'modules'){
            $module_id = 0;
            foreach ($modules_list as $key => $module){
                if ($module["name"] == $moduleName) {
                    $module_id = $module["module_id"];
                    break;
                }
            }

            return $this->checkBit($writePermission, ($module_id - 1) );
        } else {
            return false;
        }
    }

    private function checkBit($number, $bit){
        return (bool)($number & (1 << $bit));
    }

    protected function checkACL(){
        $ret = array(
            'status' => 'accepted',
            'admin_prev' => 0,
        );
        $role_id = $this->getSessionAttr("role_id", 0);
        $controller = $this->uri->segment(1, 'dashboard');
        global $ADMIN_PREV;

        if ($role_id <= 1) {
            $ret["admin_prev"] = 1;
            return $ret;
        } else {
            if (in_array(strtolower($controller), $ADMIN_PREV)){
                if($role_id == 7)
                {
                   $ret["status"] = "accepted"; 
                }
                else
                {
                    $ret["status"] = "Denied";
                }
                return $ret;
            } else {
                return $ret;
            }
        }
    }

    protected function fileUpload($uid, $fileName, $type = PROFILE_PICTURE, $record_id = null){
        $ret = array(
            "status" => true,
            "attachment_url" => '',
            "error" => '',
        );
        $config['upload_path']          = BASEPATH . "../static/uploads/$type/";
        if ($type == PROFILE_PICTURE){
            $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
            $config['max_size']             = 2000;
            $new_name = time() . "_" . $uid;
            $config['file_name'] = $new_name;
        } else {
            $config['allowed_types']        = 'pdf|doc|docx|xls|xlsx|ppt|pptx|PDF|DOC|DOCX|XLS|XLSX|PPT|PPTX|gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JPEG|BMP';
            $config['max_size']             = 5000;
            $new_name = time() . "_" . $uid . "_" . $record_id;
            $config['file_name'] = $new_name;
        }
        $attachment_url = null;

        if ($_FILES[$fileName]['name'] != '') {
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload($fileName)) {
                $ret['error'] = $this->upload->display_errors();
                $ret['status'] = false;
            } else {
                $upload_data = $this->upload->data();
                $ret["attachment_url"] = base_url() . "static/uploads/$type/" . $upload_data['file_name'];
            }
        }

        return $ret;
    }

    protected function isLoggedIn()
    {
        return $this->getSessionAttr('login');
    }

    protected function getSessionAttr($attr, $default = false)
    {
        if ($this->session->userdata("$attr")) {
            return $this->session->userdata("$attr");
        }
        return $default;
    }

    protected function setSessionAttr($attr, $value)
    {
        return $this->session->set_userdata("$attr", $value);
    }

    protected function unsetSessionAttr($attr)
    {
        return $this->session->unset_userdata("$attr");
    }

    protected function getUserRole()
    {
        return $this->getSessionAttr('role_id');
    }

    protected function getUserPermissions($uid)
    {
			$ret = array();
			$this->db->select("p.permissions");
			$this->db->where('u.id', $uid);
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = u.id', 'left');
			$this->db->join('anb_crm_roles r', 'r.id = u.role_id', 'left');
			$res = $this->db->get('anb_crm_users u');
			$ret = $res->row_array();
			return $ret["permissions"];
    }

    protected function getUserId()
    {
        return $this->getSessionAttr('user_id');
    }

    protected function debug($debugArray)
    {
        echo "<pre>";
        print_r($debugArray);
        echo "</pre>";
    }

    function getPost($attr, $filter = true)
    {
        $return = trim($this->input->get_post($attr, $filter));
        return $return;
    }

    function postGet($attr, $filter = true)
    {
        $return = trim($this->input->post_get($attr, $filter));
        return $return;
    }

    protected function viewLoad($view)
    {
			$this->data['role_id'] = $this->getUserRole();
			$this->data['role_title'] = $this->getSessionAttr('role_title');
			$this->data['username'] = $this->getSessionAttr('username');
			$this->data['permissions'] = $this->getUserPermissions($this->getUserId());
			$this->load->view('common/header', $this->data);
			if (!$this->isLoggedIn()) {
					$this->load->view("$view", $this->data);
			} else {
					$this->load->view('common/topMenu', $this->data);
					$this->load->view('common/sideMenu', $this->data);

					$this->load->view("$view", $this->data);
			}
			$this->load->view('common/footer', $this->data);
    }

    protected function redirectLoggedInUser()
    {
        if ($this->getSessionAttr("role_id") == 1){ 
            redirect("dashboard");
        } else {
            redirect("dashboard");
        }
    }

    protected function redirectPublicUser()
    {
        if ($this->isLoggedIn() === false) {
            redirect('member');
        }
    }

    function get_time_difference($time1, $time2)
	{
		$time1 = strtotime("1980-01-01 $time1");
		$time2 = strtotime("1980-01-01 $time2");
		
		if ($time2 < $time1)
		{
			$time2 += 86400;
		}	    
		return date("H:i:s", strtotime("1980-01-01 00:00:00") + ($time2 - $time1));
	}
}
