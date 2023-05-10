<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class UserManagement extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("UserModel");
    }

    public function index()
	{
        $this->data["page"] = "user_management";
        $this->data["userStatus"] = ($this->getPost("us") != '') ? $this->getPost("us") : ACTIVE_USERS;
        if ( $this->getPost("bulk") == 'on' ){
            $this->UserModel->bulkAction($this->getPost("ac"), $this->getPost("uid"));
            $this->data["message"]["success"] = "The user status has been updated";
        } else if ( $this->getPost("ac") == '1' || $this->getPost("ac") == '0' ){
            $this->UserModel->changeStatusOfUser($this->getPost("ac"), $this->getPost("uid"));
            $this->data["message"]["success"] = "The user status has been updated";
        } else if ( $this->getPost("ac") == '-1' ){
            $getPassword = $this->UserModel->changePasswordOfUser($this->getPost("uid"));
            if($getPassword){
                $this->sendMail($this->getPost("uid"), $getPassword);
            }
            $this->data["message"]["success"] = "The password of the user has been reset and emailed to the registered email of the user.";
        }
        $this->data["users_list"] = $this->UserModel->loadUsersList($this->data["userStatus"]);
        $this->viewLoad("user_management/user_management");
	}

    public function addUser(){
        $this->data["page"] = "add_user";
        $this->load->library('form_validation');

        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
             $email = $this->input->post('email');
             $data = $this->UserModel->get_users();

             $result = "";
          foreach ($data as $value) {
            if($value['email'] == $email)
             {
                $result = "error";
             }
           }
           if($result !== "error")
           {        
                if ( ($message = $this->UserModel->addUser($this->getUserId())) === true){
                    $this->data["message"]["success"] = 'Congratulations! The user has been created and activated successfully. An email has been sent to the registered email address with password. Please tell the user to reset the password after login. Thanks';
                } else {
                    $this->data["message"]["danger"] = $message;
                }

           }else
           {
                 $this->data["email_error"] = "Email already exists";
            }
         

        }

        $this->data["users_role"] = $this->UserModel->loadRolesList();
        $this->viewLoad("user_management/new");
    }
     
    public function editUser(){  
        $this->data["page"] = "edit_user";
        $uid = $this->getPost("id");	
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            //print_r($_POST);
            $password = $_POST['password']; 
            //die;
            if ( ($message = $this->UserModel->updateUser($uid)) === true){ 
                //$this->data["message"]["success"] = 'The user has been updated successfully.';
                 $status = $this->sendMail($uid, $password);
                 if($message){
                    $this->session->set_flashdata('success',"The user has been updated successfully.");
                    redirect(base_url()."UserManagement/editUser?id=$uid");   
                 }else{
                    $this->session->set_flashdata('error',"Something went wrong");
                redirect(base_url()."UserManagement/editUser?id=$uid");
    
                 }
            } else {
                //$this->data["message"]["danger"] = $message;
                $this->session->set_flashdata('error',"$message");
                redirect(base_url()."UserManagement/editUser?id=$uid");
            }
        }		
		if(is_numeric($uid))
		{

			$this->data["user"] = $this->UserModel->loadUser($uid);
            //echo '<pre>';print_r($this->data["user"]);die;
		}
		else
		{
			redirect(base_url()."UserManagement/editUser?id=$uid");
		}
        $this->data["users_role"] = $this->UserModel->loadRolesList();
        $this->viewLoad("user_management/update");
    }
    
    public function deleteUser(){  
        $this->data["page"] = "delete_user";
        $uid = $this->getPost("id");	
      		
				if(is_numeric($uid))
				{
					 if ( ($message = $this->UserModel->deleteUser($uid))){ 
							
							 $this->session->set_flashdata('success',"The user has been deleted successfully.");
							redirect(base_url()."index.php/UserManagement");
					} else {
							//$this->data["message"]["danger"] = $message;
							$this->session->set_flashdata('error',"$messagae");
							redirect(base_url()."index.php/UserManagement");
					}
				}
				else
				{
					redirect(base_url()."index.php/UserManagement");
				}       
    }


    public function get_users(){

        $this->db->select('*');
        $this->db->from('anb_crm_users');
        $query = $this->db->get();
        $res = $query->result_array();
        echo "<pre>"; print_r($res); die;
    }
    public function sendMail($uid, $password){
        $user['data'] = $this->UserModel->loadUser($uid);
        $email = array(
            'username' => $user['data']['username'],
            'password'=> $password,
            'email'=>$user['data']['email']
            );
        if(!empty($email) && isset($email)){
            $email['mainheading'] = 'Password Updated';
            $toEmail = $user['data']['email'];
            $subject = 'Password Reset';
            $emailTemplate = $this->load->view('emails/resetpassword',$email,true);   
            $fromEmail = COMPANY_NOREPLY_EMAIL;
           
            //$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
            $data = json_encode($email);
            $this->load->model("ModuleModel");
            $this->ModuleModel->saveEmail($uid,$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data);
           $config['email'] = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => '587',
            'smtp_timeout' => '30',
            'smtp_user' => 'softgetix.test@gmail.com',
            'smtp_pass' => 'softgetix@test',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'mailtype' => 'html',
            'newline' => "\r\n",
            'validation' => TRUE,
            'smtp_debug' => 4,
            'smtp_auto_tls' => false,
            '_smtp_auth'=>TRUE,
            'smtp_crypto' =>'tls' 
            );
            $this->email->initialize($config['email']);
            $this->email->from(COMPANY_NOREPLY_EMAIL);
            $this->email->to($user['data']['email']);
            $this->email->subject('Password Reset');
            //$this->email->message($final_content);
            $this->email->message($emailTemplate);
             $rs = $this->email->send();
/*           var_dump( $this->email);
            die;
*/
            if($rs)
            {
               // die('IF');
                return true;
            }
            else
            {
                //die('else');
                return false;
            }
        }
       // die;
    }
}
