<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Base.php';

class Invitation extends Base {

    function __construct() {
        parent::__construct();
        $this->load->model('app_model');
        $this->load->library('notifications');
    }

    public function index() {
      /*$this->load->library('notifications');
                $config['default_token'] = "sfdsf";
                $config['default_comment'] = "sfdsf";;
                $config['default_type'] = 'invitation';
                $config['notification_from'] = "@gfdsg";
                $config['event_id'] = 56;
                $config['default_sender'] = '3';
                $config['default_target'] = '5';
                $this->notifications->config($config);
                 $notifications =$this->notifications->add();*/
    }
    public function job() {


    	if($this->input->get())
    	{
    	  $data = $this->input->get();
    	  $eventId = isset($data['eid']) ? $data['eid'] : ''; 	
    	  $email = isset($data['email']) ? $data['email'] : '';
    	  $token = isset($data['token']) ? $data['token'] : '';
    	  $invitationId = isset($data['invitationId']) ? $data['invitationId'] : '';

    	   /*check status */
           $join = array(array(
                    "table" => 'events',
                    "on" => 'events.id = calendar_invitations.event_id'
                )
            );
    	  $checkStatus = $this->app_model->getData('calendar_invitations', array('status','access_token','title'), array('event_id' => $eventId, 'sent_email' => $email, 'calendar_invitations.id' => $invitationId  ),$join);
    	  $currentStatus =  isset($checkStatus[0]) && isset($checkStatus[0]['status']) ? $checkStatus[0]['status'] : '';
          $access_token =  isset($checkStatus[0]) && isset($checkStatus[0]['access_token']) ? $checkStatus[0]['access_token'] : '';
    	  $job_name =  isset($checkStatus[0]) && isset($checkStatus[0]['job_name']) ? $checkStatus[0]['job_name'] : '';
    	  //print_r($access_token);die();
    	  if($currentStatus == 1 && $access_token == $token)
    	  {
    	  	$status = isset($data['status']) ? $data['status'] : '';
    	  //print_r($status);
    	  $update = array('status' => $status,'updated_date' => date('Y-m-d H:i:s'));
		  $updateCheck = $this->app_model->rowUpdate('calendar_invitations',$update,array('event_id' => $eventId,'id' => $invitationId, 'sent_email' => $email ));
          
			  if($updateCheck == 1)
			  {
					switch ($status) {
					    case 2:
					        $message = "accepted";
                            $comment = "has accepted invitation Job: $job_name";
					        break;
					    case 3:
					        $message = "declined";
                            $comment = "has declined invitation Job: $job_name";
					        break;
					    default:
					        $comment = '';
                            $message = '';
					}
			echo '<link rel="stylesheet" href="'.base_url("static/bs3/css/bootstrap.min.css").'">';	
			echo '<div class="jumbotron text-xs-center text-center"><h1 class="display-3">Thank You!</h1>';
	  	    echo '<p class="lead"><strong>You have successfully '.$message.' a invitation for this job.</p></div>';	

                $this->load->library('notifications');
                $config['default_token'] = $token;
                $config['default_comment'] = $comment;
                $config['default_type'] = 'Calendar Invitation';
                $config['notification_from'] = $email;
                $config['event_id'] = $eventId;
                $config['default_sender'] = '';
                $config['default_target'] = '';
                $this->notifications->config($config);
               // $notifications =$this->notifications->add();
               // $insert_id = $this->db->insert_id();
                //$this->app_model->rowInsert('user_notification',array(' notification_id' => $insert_id));
			  }
    	  }else
    	  {
    	  	echo '<link rel="stylesheet" href="'.base_url("static/bs3/css/bootstrap.min.css").'">';
    	  	echo '<div class="jumbotron text-xs-center text-center"><h1 class="display-3">Thank You!</h1>';
    	  	echo '<p class="lead"><strong>You have already submitted a response for this invitation mail.</p></div>';
    	  	die();
    	  }
    	}
    } 
}