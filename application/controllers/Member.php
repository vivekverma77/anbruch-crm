<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Member extends Base {

    public function __construct(){
        parent::__construct();
        
       $this->load->model("UserModel");
       $this->load->model("ModuleModel");
       $this->load->model("App_model");
    }

    public function index()
	{
		redirect("member/login", "refresh");
	}

    public function login(){
        if ($this->isLoggedIn()){
          $this->redirectLoggedInUser();
        }
        $this->data["page"] = "login";
        $this->data["body_class"] = "login-body";

        if ( ($requestMethod = strtolower($this->input->method())) == 'post' &&
            $this->MemberModel->login() ){
            $this->redirectLoggedInUser();
        } else {
            if ($requestMethod == 'post'){
                $this->data["login_error"] = "Username or password is incorrect.";
            }
            $this->viewLoad("common/login");
        }
    }

    public function personalProfile()
    {
        if (!$this->isLoggedIn()){
            $this->redirectPublicUser();
        }

        if ( ($requestMethod = strtolower($this->input->method())) == 'post' ) {
            $current_password = $this->postGet('current_password');
            if ( ($password_error = $this->MemberModel->passwordCheck($this->getUserId(), $current_password)) === true){
                $profile_picture = null;
                if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]['name'] != '') {
                    $fileUpload = $this->fileUpload($this->getUserId(), "profile_picture", PROFILE_PICTURE);
                    //echo '<pre>';print_r($fileUpload);die;
                    if ($fileUpload["status"] === true){
                        $profile_picture = $fileUpload["attachment_url"];
                    } else {
                        $this->data["message"]["danger"] = $fileUpload["error"];
                    }
                }

                if (!isset($this->data["message"]["danger"])){
                    $updateIssue = $this->MemberModel->profileUpdate($this->getUserId(), $profile_picture);
                    if ($updateIssue === true ) {
                        //$this->data["message"]["success"] = "Your profile has been updated successfully";
                        $this->session->set_flashdata('success','Your profile has been updated successfully');
                    } else {
                        //$this->data["message"]["danger"] = $updateIssue;
                         $this->session->set_flashdata('error',$updateIssue);
                    }
                }
            } else {
                //$this->data["message"]["danger"] = $password_error;
                 $this->session->set_flashdata('error',$password_error);
            }
            redirect(base_url().'index.php/member/personalProfile');
						exit;	
        }

				
				$this->data["users_list"] = $this->UserModel->loadUsersList(ACTIVE_USERS);
				$this->data["current_userid"] = $this->getUserId();
				
        $this->data["page"] = "personal_profile";
        $this->data["user_data"] = $this->MemberModel->loadUserData($this->getUserId());
        $this->viewLoad("member/personal_profile");
    }

    public function updatesetting()
    {
        if (!$this->isLoggedIn()){
           $this->redirectPublicUser();
        }

        if ( ($requestMethod = strtolower($this->input->method())) == 'post' ) {
					
					$updateIssue = $this->MemberModel->settingUpdate($this->getUserId());
						if ($updateIssue === true ) {
								//$this->data["message"]["success"] = "Your setting has been updated successfully";
								$this->session->set_flashdata('success','Your setting has been updated successfully');
						} else {
								//$this->data["message"]["danger"] = $updateIssue;
								 $this->session->set_flashdata('error',"Error in update!");
						}
				}            
        
			redirect(base_url().'index.php/member/personalProfile');
			exit;	
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('member/login', "refresh");
    }
    
    
  public function going()
	{
		$booking_id = $_GET['booking_id'];
		$email = $_GET['email'];
		$status = $_GET['status'];
		
		if($booking_id!= '' && $email !="" && $status!="")
		{
			$guestdata = array(		
				'status' => $status,  //0=just invited, 1= going, 2=maybe, 3 = not going
				'modified_time' => date('Y-m-d H:i:s'),									
			);
			
			$this->db->where('booking_id', $booking_id);
			$this->db->where('guest', $email);
			$this->db->update("anb_crm_bookings_guests", $guestdata);			
			
			$this->db->select('bg.*,b.*,bg.status as bgstatus');	
			$this->db->where('bg.booking_id', $booking_id);
			$this->db->where('bg.guest', $email);
			$this->db->join('anb_crm_bookings b', 'b.id = bg.booking_id');
			$res = $this->db->get("anb_crm_bookings_guests bg");			
			$ret = $res->row_array();
			//echo '<pre>';print_r($ret);die;
			$this->session->set_flashdata('invitation_data', $ret);			
		
      redirect(base_url().'member/invitation');
		}
		else
		{			
			$this->session->set_flashdata('invitation_data', '');				
      redirect(base_url().'member/invitation');
		}
		
	}
	
	public function invitation()
	{
		$this->data['invitation_data'] = $this->session->flashdata('invitation_data');			
		if(!empty($this->data['invitation_data']))
		{
			//$this->session->set_userdata('invitation_data','');			
			//echo '<pre>';print_r($this->data['invitation_data']);die;
			$this->data["page"] = "Invitation";	
			$this->load->view("booking/invitation", $this->data);	
		}
		else
		{
			redirect(base_url().'/member');
		}
	}
		
	public function attendance()
	{
		if(!$this->isLoggedIn()){
			redirect("member/login");
			exit;
		}

		if($this->isSuperAdmin() == true) 
		{  
			$this->data["own"] = ($this->getPost("own") != '' && $this->getPost("own") !="undefined") ? $this->getPost("own") : $this->getUserId();
		}
		else
		{
			$this->data["own"] = $this->getUserId();
		}
		
		$this->data["startDate"] = $startDate = ($this->getPost("date") != "") ? $this->getPost("date") : date("F Y");
		
		$month = date("m", strtotime($startDate));
		$year = date("Y", strtotime($startDate));
		$this->data["month"] = ($month != '') ? $month : date("m");
		$this->data["year"] = ($year != '') ? $year : date("Y");
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["current_userid"] = $this->getUserId();
		
		$this->data["page"] = "personal_profile";
		$this->data["user_data"] = $this->MemberModel->loadUserData($this->getUserId());
		$this->data["attendance"] = $this->MemberModel->loadUserAttendance($this->data["own"], $this->data["month"], $this->data["year"]);
		//echo "<pre>";print_r($this->data["attendance"]);die;
		$this->viewLoad("member/attendance");
	}
	
	public function payroll()
	{
		if(!$this->isLoggedIn()){
			redirect("member/login");
			exit;
		}

		if($this->isSuperAdmin() == true) 
		{  
			$this->data["own"] = ($this->getPost("own") != '' && $this->getPost("own") !="undefined") ? $this->getPost("own") : $this->getUserId();
		}
		else
		{
			$this->data["own"] = $this->getUserId();
		}
		
		$this->data["startDate"] = $startDate = ($this->getPost("date") != "") ? $this->getPost("date") : date("F Y");
		
		$month = date("m", strtotime($startDate));
		$year = date("Y", strtotime($startDate));
		
		$this->data["month"] = ($month != '') ? $month : date("m");
		$this->data["year"] = ($year != '') ? $year : date("Y");
		$this->data["days_in_month"] = cal_days_in_month(CAL_GREGORIAN,$this->data["month"],$this->data["year"]);
		$this->data["working_days"] = 28;
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["current_userid"] = $this->getUserId();
		
		$this->data["page"] = "personal_profile";
		$this->data["user_data"] = $this->MemberModel->loadUserData($this->getUserId());
		$this->data["attendance"] = $this->MemberModel->loadUserAttendance($this->data["own"], $this->data["month"], $this->data["year"]);
		//echo "<pre>";print_r($this->data["attendance"]);die;

		$this->data["userStatus"] = ($this->getPost("us") != '') ? $this->getPost("us") : ACTIVE_USERS;
		$this->data["users_list"] = $this->UserModel->loadUsersList($this->data["userStatus"]);
		
		$this->viewLoad("member/payroll");
	}	

	public function checkIn()
	{
		if(!$this->isLoggedIn()){
			echo "login_required";
			exit;
		}
		
		$user_id = $this->getUserId();
		$date = date('Y-m-d');
		
		$this->db->select('*');
		$this->db->from('anb_crm_attendance');
		$this->db->where('date',$date);	
		$this->db->where('user_id',$user_id);	
		$query = $this->db->get();
		$result = $query->row();
		//print_r($result);die;
		if(empty($result))
		{
			$time = date('H:i:s', gmdate('U'));
			//echo $time;die;
			$data = array(
				'user_id'=>$user_id,	
				'check_in'=>$time,
				'check_out'=>'',
				'total_time'=>'',	
				'over_time'=>'',	
				'status'=>'',
				'date'=>date('Y-m-d')					
			);
			//echo "<pre>";
			//print_r($data);die;
			$this->db->insert('anb_crm_attendance',$data);
			echo "Check In for the day successfully.";
			exit;
		}
		else
		{
			echo "You have already Checked In for the day!";
			exit;
		}		
	}

	public function checkOut()
	{
		if(!$this->isLoggedIn()){
			echo "login_required";
			exit;
		}
		
		$user_id = $this->getUserId();
		$date = date('Y-m-d');
		
		$this->db->select('*');
		$this->db->from('anb_crm_attendance');
		$this->db->where('date',$date);	
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		$result = $query->row();
		//echo print_r($result);die;
		if(empty($result))
		{
			echo "Please check In first! Not Checked In for the day.";
			exit;
		}
		else if($result->check_out!="00:00:00")
		{
			echo "You have already Checked Out for the day!";
			exit;
		}
		else
		{			
			 $check_in = $result->check_in;
			
			//echo $check_in;die;
			$check_out = date('H:i:s', gmdate('U'));
			
			$total_time = $this->get_time_difference($check_in,$check_out);
			//$total_time =$check_out - $check_in;
			
			$udata = array(	
					'check_out'=>$check_out,
					'total_time'=>$total_time,
					//'over_time'=>$over_time,
					//'status'=>$status					
				);	
			$this->db->where('date',$date);	
			$this->db->where('user_id',$user_id);			
			$this->db->update('anb_crm_attendance',$udata);
			echo "Check Out for the day successfully.";
			exit;
		}
	}
	
	public function updateAttendance()
	{
		if(!$this->isLoggedIn()){
			echo "login_required";
			exit;
		}

	
		$ids = $_POST['attendance_id'];
		$idsArr = explode (",", $ids);  
		
		$check_in = trim($_POST['checkin']);		
		$check_out = trim($_POST['checkout']);		

		if($check_in!="" && $check_out!="")
		$total_time = $this->get_time_difference($check_in,$check_out);
		else
		$total_time = "";
		
		$udata = array(	
			'check_in'=>$check_in,
			'check_out'=>$check_out,
			'total_time'=>$total_time,
			//'over_time'=>$over_time,
			//'status'=>$status					
		);	
		
		$this->db->where_in("id", $idsArr);	
		$this->db->update('anb_crm_attendance',$udata);
		echo "Attendance updated successfully.";
		exit;
	
	}

	public function deleteAttendance()
	{
		if(!$this->isLoggedIn()){
			echo "login_required";
			exit;
		}

		$ids = $_POST['attendance_id'];
		$idsArr = explode (",", $ids);  
		
		$this->db->where_in('id',$idsArr);			
		$this->db->delete('anb_crm_attendance');
		echo "Attendance deleted successfully.";
		exit;
	
	}

	public function usersDeactivate()
	{
		if($this->input->post()){
			$data = $this->input->post();
			$user_ids = !empty($data) && !empty($data["user_ids"]) ? $data["user_ids"] :'';
			$user_value = !empty($data) && !empty($data["action"]) ? $data["action"] :'';
			$actionText = !empty($data) && !empty($data["actionText"]) ? $data["actionText"] :'';
			//print_r($actionText);
		  $r = array();	
		  if(!empty($user_ids) && is_array($user_ids))
		  {
		  	foreach ($user_ids as $value) {
		  	 $r['res'] = $this->App_model->rowUpdate("anb_crm_users",array('status' => $user_value),array('id'=> $value));
		  	}	
 		  }else{
 		  	$r['res'] = $this->App_model->rowUpdate("anb_crm_users",array('status' => $user_value),array('id'=> $user_ids));
 		 }
 		 $this->session->set_flashdata('success', 'Account '.$actionText.' successfully');
 		 echo json_encode($r);die();
	  }
	}

}
