<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';
//require_once 'Base.php';

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("ActivitiesModel");
	      $this->load->model("ModuleModel");
	      $this->load->model("BookingModel");
	      $this->load->model("UserModel");
	      $this->load->library('email');
		  //$smtpconfig = $this->config->item('email');
		  //$this->email->initialize($smtpconfig);
		  $this->email->set_mailtype("html");
		  $this->load->model('App_model');
    }

  public function index()
	{
		redirect("member/login", "refresh");
	}
 public function cancelBooking()
	{	

		global $FIELD_TYPE;
		global $RECORD_STATUS;
		$loadViewWithData = true;
		
		if($_GET)
		{
			$booking_id = $_GET['bid'];
			$current_module = $_GET['cm'];
			$current_record_id = $_GET['id'];
			$record_status = $_GET['record_status'];

			//$booking = $this->BookingModel->loadBookingsList($booking_id, $current_record_id);
			$booking = $this->App_model->getData('anb_crm_bookings', array('*'), array('id' => $booking_id));
			$bookingRecord = $this->App_model->getData('anb_crm_bookings', array('*'), array('id' => $booking_id));
			if(!empty($booking) && ($booking[0]['status'] == 0 || $booking[0]['status'] == 1))
			{
				$res = $this->UserModel->cancelBooking();

				if($res)
				{	
					$fromEmail = COMPANY_NOREPLY_EMAIL; 					
					$fromName = COMPANY_NAME; 					
						
					//$toEmail = "harpreetclerisy@gmail.com";
					$toEmail = $booking[0]["email"];
					$toName = $booking[0]["name"];			
					$data = array(
						'booking_date' => date('m/d/Y',strtotime($booking[0]["booking_date"])),
						'booking_time' => date('h:i',strtotime($booking[0]["booking_date"])),
						'end_date' => date('m/d/Y',strtotime($booking[0]["end_date"])),
						'end_time' => date('h:ia',strtotime($booking[0]["end_date"])),
						'booking_title' =>$booking[0]["booking_title"],
						'notes' => $booking[0]["notes"],
						'name' => $booking[0]["name"],
						'email' => $booking[0]["email"],
						'current_module' => !empty($current_module) ? $current_module : '',
						'current_record_id' => !empty($current_record_id) ? $current_record_id : '',
						'record_status' => !empty($record_status) ? $record_status : '',									
						'bookingId' => $booking[0]["id"],								
						'status' => 2,	  //Cancelled
						'status_change_date' => date("Y-m-d H:i:s")
					);
					$booking = $this->BookingModel->loadBookingById($booking_id,$current_module);

					/*get cancel notification  on dashboard*/
					$current_record_data = $this->BookingModel->get_record_data_by_id($data["current_record_id"]);
					$loggedinUserId	= $this->session->userdata("login");						
					$receiver_id = $current_record_data['assigned_officer_id'];
					$notifyData = array(
						"record_id" => $data["current_record_id"],
						"booking_id" => $data["bookingId"],
						"sender_id" => $receiver_id,
						"receiver_id" => $receiver_id,
						"title" => "Booking cancelled",
						"description" =>  $data["booking_title"].' on '.$data['booking_date'].' at '.$data['booking_time'],
						"read" => 0, //0=new booking
						"created_time" =>date('Y-m-d H:i:s'),				
						"modified_time" =>date('Y-m-d H:i:s'),													
					);

					$noti = $this->BookingModel->add_notification($notifyData);	

					/*get cancel notification end*/


					$_SESSION['booking_data'] = $booking;
					$this->confirmEventToGoogleCalendar();
					$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);
					//echo $emailTemplate; die;
					
					// $headers  = 'MIME-Version: 1.0' . "\r\n";
					// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					// $headers .= "From: Anbruch <".$fromEmail.">". "\r\n";
					if($data['status']==1)
					{
						$title = 'Booking Confirmed.'; 				
					}
					else if($data['status']==2)
					{
						$title = 'Booking Cancelled.'; 				
					}
					$send_email = false;
					if($current_module == 'Leads')
					{
						$record_data = $this->ModuleModel->loadRecord(null, $current_record_id);

						$assigned_officer_id = $record_data['__0'];
						$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
						$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
						$admin_email = $user_data0['email'];
						$lead_name = $record_data['__1'].' '.$record_data['__2'];
						$closer_id = $record_data['__21'];
						$user_data = $this->UserModel->loadUser($closer_id);
						$closer = $user_data['first_name'].' '.$user_data['last_name'];
						$closer_email = $user_data['email'];

						$opener_id = $record_data['__22'];
						$user_data2 = $this->UserModel->loadUser($opener_id);
						$opener = $user_data2['first_name'].' '.$user_data2['last_name'];
						$opener_email = $user_data2['email'];

						$lead_status = $record_data['__6'];
						
					
						/*if($lead_status=="ASSIGNED TO OPENER")
						{*/
							$send_email = true;
							$toName = $opener;
							$toEmail = trim($opener_email);
							$subject = $title;
							//$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'admin_to_opener');
							$assignedData = array(
								'current_module_id' => 1, 
								'leadassignedofficer' => $opener,
								'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'lead_name' => $lead_name,
								'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
								'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
								'booking_date' => date('m/d/Y',strtotime($bookingRecord[0]['booking_date'])),
								'booking_time' => date('h:i a',strtotime($bookingRecord[0]['booking_date'])),
								'end_date' => date('m/d/Y',strtotime($bookingRecord[0]['end_date'])),
								'end_time' => date('h:i a',strtotime($bookingRecord[0]['end_date'])),
								'booking_title' => $bookingRecord[0]['booking_title'],
								'notes' => $bookingRecord[0]['notes'],
							);
						
						//}

					    //Opener email 
					    $assignedData['mainheading'] = $title;
						$assignedData['heading'] = '';
						$emailTemplate = $this->load->view('emails/bookingAssigned',$assignedData,true);	
						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;
						//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
						$data1 = json_encode($assignedData);
						$this->ModuleModel->saveEmail('',$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data1);	
						$this->email->from($fromEmail);
						$this->email->to($toEmail);
						$this->email->subject($subject);
						//$this->email->message($final_content);
						$this->email->message($emailTemplate);
						$this->email->send();
								
						/*if($lead_status=="ASSIGNED TO CLOSER")
						{*/
							$send_email = true;
							$toName = $closer;
							$toEmail = trim($closer_email);
							$subject = $title;
							$assignedData = array(
								'current_module_id' => 1,
								'leadassignedofficer' => $closer,
								'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'lead_name' => $lead_name,
								'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
								'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
								'booking_date' => date('m/d/Y',strtotime($bookingRecord[0]['booking_date'])),
								'booking_time' => date('h:i a',strtotime($bookingRecord[0]['booking_date'])),
								'end_date' => date('m/d/Y',strtotime($bookingRecord[0]['end_date'])),
								'end_time' => date('h:i a',strtotime($bookingRecord[0]['end_date'])),
								'booking_title' => $bookingRecord[0]['booking_title'],
								'notes' => $bookingRecord[0]['notes'],
								
							);
						//}
					}
					if($current_module == 'Clients')
					{
						$record_data = $this->ModuleModel->loadRecord(null, $current_record_id);

						$closer_id = $record_data['__104'];
						$user_data = $this->UserModel->loadUser($closer_id);
						$closer = $user_data['first_name'].' '.$user_data['last_name'];
						$closer_email = $user_data['email'];
						$client_name = $record_data['__84'];
						
						$title1 = $record_data['__83'];
						$company_name = isset($record_data['__108']) ? $record_data['__108'] : '';
						$email = isset($record_data['__85']) ? $record_data['__85'] : '';
						$signig_rate = isset($record_data['__94']) ? $record_data['__94'] : '';

						$send_email = true;
						$toName = $closer;
						$toEmail = trim($closer_email);
						$subject = $title;
						$assignedData = array(
							'current_module_id' => 2,
							'leadassignedofficer' => $closer,
							'company' => isset($company_name) && !empty($company_name) ? $company_name : "No Company Name Available",
							'client_name' => isset($client_name) ? $client_name : '',
							'title' => isset($title1) ? $title1 : "title Not Available",
							'email' => isset($email) ? $email : " Email Not Available",
							'signig_rate' => isset($signig_rate) ? $signig_rate :'',
							'booking_date' => date('m/d/Y',strtotime($bookingRecord[0]['booking_date'])),
							'booking_time' => date('h:i a',strtotime($bookingRecord[0]['booking_date'])),
							'end_date' => date('m/d/Y',strtotime($bookingRecord[0]['end_date'])),
							'end_time' => date('h:i a',strtotime($bookingRecord[0]['end_date'])),
							'booking_title' => $bookingRecord[0]['booking_title'],
							'notes' => $bookingRecord[0]['notes'],
						);
						
					}
					if($send_email == true)
					{
						$assignedData['mainheading'] = $title;
						$assignedData['heading'] = '';
						$emailTemplate = $this->load->view('emails/bookingAssigned',$assignedData,true);	
						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;
						//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
						$data1 = json_encode($assignedData);
						$this->ModuleModel->saveEmail('',$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data1);	
						$this->email->from($fromEmail);
						$this->email->to($toEmail);
						$this->email->subject($subject);
						//$this->email->message($final_content);
						$this->email->message($emailTemplate);
						if($this->email->send())
						{
						
						}
						else
						{
						
						}
					}
					//$this->getUserId()
					$this->ModuleModel->saveEmail('',$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

					$this->email->from($fromEmail);
					$this->email->to($toEmail);
					$this->email->subject($title);
					$this->email->message($emailTemplate);
					
					if($this->email->send())
				  {

					 //~ echo 'Email sent.';
				  }
				  else
				  {
					 //~ echo 'Email not sent.';
				  }	
				  	$data =array("message" => "Your booking has been Cancelled.","cancel"=>"yes");
				  	$data['booking_id'] = $this->input->get('bid');
				  	$data['record_id'] = $current_record_id;
				  	$bk_data = $this->App_model->getData('anb_crm_bookings','*',array('id' =>  $this->input->get('bid')));
				  	if(!empty($bk_data))
				  	{
					  	$data['booking_title'] = $bk_data[0]['booking_title'];
					  	$data['booking_address'] = $bk_data[0]['booking_address'];
					}
					echo $this->load->view("user/cancelbooking",$data, true);
					exit;
				}
				else
				{                
						echo 'not_cancelled';
						exit;
				}

			}
			else
			{
				$data =array("message" =>"You already Cancelled this Booking.");
				echo $this->load->view("user/cancelbooking",$data, true);
				exit;
			}

		}	  
		
	}
	public function getBookings()
	{
		global $BOOKING_STATUS;
		$this->data["booking_status"] = $BOOKING_STATUS; 
		if($_POST)
		{			
			//echo print_r($_POST); die;
			$booking_status = ['0','1'];
			$bookings = $this->UserModel->loadBookingsList(null, null, $_POST["email"], $booking_status);
			if(!empty($bookings))
			{				
				//echo print_r($booking);exit;					
				$this->data["bookings"] = $bookings;
				
				$view = $this->load->view('user/cancelbookinglist',$this->data,true);
				
				echo $view;
				exit;				
			}
			else
			{
				echo 'no_booking_found';
				exit;
			}
		}
	}
	public function confirmBooking()
  	{
  		global $FIELD_TYPE;
		global $RECORD_STATUS;
		$loadViewWithData = true;

		if($_GET)
		{
			$booking_id = $_GET['bid'];
			$current_module = $_GET['cm'];
			$current_record_id = $_GET['id'];
			$record_status = $_GET['record_status'];

			//$booking = $this->BookingModel->loadBookingsList($booking_id, $current_record_id);
			$booking = $this->App_model->getData('anb_crm_bookings', array('*'), array('id' => $booking_id));
			$bookingRecord = $this->App_model->getData('anb_crm_bookings', array('*'), array('id' => $booking_id));

			if(!empty($booking) && $booking[0]['status'] ==0)
			{
				$res = $this->UserModel->confirmBooking();

				if($res)
				{	
					$fromEmail = COMPANY_NOREPLY_EMAIL; 					
					$fromName = COMPANY_NAME; 					
						
					//$toEmail = "harpreetclerisy@gmail.com";
					$toEmail = $booking[0]["email"];
					$toName = $booking[0]["name"];			
					$data = array(
						'booking_date' => date('m/d/Y',strtotime($booking[0]["booking_date"])),
						'booking_time' => date('h:i',strtotime($booking[0]["booking_date"])),
						'booking_title' =>$booking[0]["booking_title"],
						'end_date' => date('m/d/Y',strtotime($booking[0]["end_date"])),
						'end_time' => date('h:ia',strtotime($booking[0]["end_date"])),
						'notes' => $booking[0]["notes"],
						'name' => $booking[0]["name"],
						'email' => $booking[0]["email"],
						'current_module' => !empty($current_module) ? $current_module : '',
						'current_record_id' => !empty($current_record_id) ? $current_record_id : '',
						'record_status' => !empty($record_status) ? $record_status : '',									
						'bookingId' => $booking[0]["id"],								
						'status' => 1,	  //confirmed
						'status_change_date' => date("Y-m-d H:i:s")
					);
					$booking = $this->BookingModel->loadBookingById($booking_id,$current_module);

					/*get confirm notification on dashboard */
					$_SESSION['booking_data'] = $booking;
					$current_record_data = $this->BookingModel->get_record_data_by_id($data["current_record_id"]);
					$loggedinUserId	= $this->session->userdata("login");						
					$receiver_id = $current_record_data['assigned_officer_id'];
					$notifyData = array(
						"record_id" => $data["current_record_id"],
						"booking_id" => $data["bookingId"],
						"sender_id" => $receiver_id,
						"receiver_id" => $receiver_id,
						"title" => "Booking confirmed",
						"description" =>  $data["booking_title"].' on '.$data['booking_date'].' at '.$data['booking_time'],
						"read" => 0, //0=new booking
						"created_time" =>date('Y-m-d H:i:s'),				
						"modified_time" =>date('Y-m-d H:i:s'),													
					);

					$noti = $this->BookingModel->add_notification($notifyData);
					
					/*get confirm notification end*/

					$this->confirmEventToGoogleCalendar();
					$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);
						
					if($data['status']==1)
					{
						$title = 'Booking Confirmed.'; 				
					}
					else if($data['status']==2)
					{
						$title = 'Booking Cancelled.'; 				
					}
					$send_email = false;
					if($current_module == 'Leads')
					{
						$record_data = $this->ModuleModel->loadRecord(null, $current_record_id);

						$assigned_officer_id = $record_data['__0'];
						$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
						$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
						$admin_email = $user_data0['email'];
						$lead_name = $record_data['__1'].' '.$record_data['__2'];
						$closer_id = $record_data['__21'];
						$user_data = $this->UserModel->loadUser($closer_id);
						$closer = $user_data['first_name'].' '.$user_data['last_name'];
						$closer_email = $user_data['email'];

						$opener_id = $record_data['__22'];
						$user_data2 = $this->UserModel->loadUser($opener_id);
						$opener = $user_data2['first_name'].' '.$user_data2['last_name'];
						$opener_email = $user_data2['email'];

						$lead_status = $record_data['__6'];
						
					
						/*if($lead_status=="ASSIGNED TO OPENER")
						{*/
							$send_email = true;
							$toName = $opener;
							$toEmail = trim($opener_email);
							$subject = $title;
							//$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'admin_to_opener');
							$assignedData = array(
								'current_module_id' => 1, 
								'leadassignedofficer' => $opener,
								'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'lead_name' => $lead_name,
								'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
								'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
								'booking_date' => date('m/d/Y',strtotime($bookingRecord[0]['booking_date'])),
								'booking_time' => date('h:i a',strtotime($bookingRecord[0]['booking_date'])),
								'end_date' => date('m/d/Y',strtotime($bookingRecord[0]['end_date'])),
								'end_time' => date('h:i a',strtotime($bookingRecord[0]['end_date'])),
								'booking_title' => $bookingRecord[0]['booking_title'],
								'notes' => $bookingRecord[0]['notes'],
							);
						
						$assignedData['mainheading'] = $title;
						$assignedData['heading'] = '';
						$emailTemplate = $this->load->view('emails/bookingAssigned',$assignedData,true);	
						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;
						//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
						$data1 = json_encode($assignedData);
						$this->ModuleModel->saveEmail('',$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data1);	
						$this->email->from($fromEmail);
						$this->email->to($opener_email);
						$this->email->subject($subject);
						//$this->email->message($final_content);
						$this->email->message($emailTemplate);
						$this->email->send();		

						/*}
						if($lead_status=="ASSIGNED TO CLOSER")
						{*/
							$send_email = true;
							$toName = $closer;
							$toEmail = trim($closer_email);
							$subject = $title;
							$assignedData = array(
								'current_module_id' => 1,
								'leadassignedofficer' => $closer,
								'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								'lead_name' => $lead_name,
								'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
								'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
								'booking_date' => date('m/d/Y',strtotime($bookingRecord[0]['booking_date'])),
								'booking_time' => date('h:i a',strtotime($bookingRecord[0]['booking_date'])),
								'end_date' => date('m/d/Y',strtotime($bookingRecord[0]['end_date'])),
								'end_time' => date('h:i a',strtotime($bookingRecord[0]['end_date'])),
								'booking_title' => $bookingRecord[0]['booking_title'],
								'notes' => $bookingRecord[0]['notes'],
								
							);
						//}
					}
					if($current_module == 'Clients')
					{
						$record_data = $this->ModuleModel->loadRecord(null, $current_record_id);

						$closer_id = $record_data['__104'];
						$user_data = $this->UserModel->loadUser($closer_id);
						$closer = $user_data['first_name'].' '.$user_data['last_name'];
						$closer_email = $user_data['email'];
						$client_name = $record_data['__84'];
						
						$title1 = $record_data['__83'];
						$company_name = isset($record_data['__108']) ? $record_data['__108'] : '';
						$email = isset($record_data['__85']) ? $record_data['__85'] : '';
						$signig_rate = isset($record_data['__94']) ? $record_data['__94'] : '';

						$send_email = true;
						$toName = $closer;
						$toEmail = trim($closer_email);
						$subject = $title;
						$assignedData = array(
							'current_module_id' => 2,
							'leadassignedofficer' => $closer,
							'company' => isset($company_name) && !empty($company_name) ? $company_name : "No Company Name Available",
							'client_name' => isset($client_name) ? $client_name : '',
							'title' => isset($title1) ? $title1 : "title Not Available",
							'email' => isset($email) ? $email : " Email Not Available",
							'signig_rate' => isset($signig_rate) ? $signig_rate :'',
							'booking_date' => date('m/d/Y',strtotime($bookingRecord[0]['booking_date'])),
							'booking_time' => date('h:i a',strtotime($bookingRecord[0]['booking_date'])),
							'end_date' => date('m/d/Y',strtotime($bookingRecord[0]['end_date'])),
							'end_time' => date('h:i a',strtotime($bookingRecord[0]['end_date'])),
							'booking_title' => $bookingRecord[0]['booking_title'],
							'notes' => $bookingRecord[0]['notes'],
						);
						
					}
					if($send_email == true)
					{
						$assignedData['mainheading'] = $title;
						$assignedData['heading'] = '';
						$emailTemplate = $this->load->view('emails/bookingAssigned',$assignedData,true);	
						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;
						//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
						$data1 = json_encode($assignedData);
						$this->ModuleModel->saveEmail('',$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data1);	
						$this->email->from($fromEmail);
						$this->email->to($toEmail);
						$this->email->subject($subject);
						//$this->email->message($final_content);
						$this->email->message($emailTemplate);
						if($this->email->send())
						{
						
						}
						else
						{
						
						}
					}
					$this->ModuleModel->saveEmail('',$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

					$this->email->from($fromEmail);
					$this->email->to($toEmail);
					$this->email->subject($title);
					$this->email->message($emailTemplate);
					if(!empty($booking[0]['attachment'])){
					$this->email->attach(FCPATH.'upload/event/'.$booking[0]["attachment"]);
				    }
					if($this->email->send())
				  {

					 //~ echo 'Email sent.';
				  }
				  else
				  {
					 //~ echo 'Email not sent.';
				  }	


				  	$data =array("message" => "Your booking has been Confirmed.");
					echo $this->load->view("user/confirmbooking",$data, true);
					exit;
				}
				else
				{                
						echo 'not_confirmed';
						exit;
				}

			}
			else
			{
				if($booking[0]['status'] ==2)
				{
					$data =array("message" =>"You already Cancelled this booking.","cancel"=>"yes");
					echo $this->load->view("user/confirmbooking",$data, true);
					exit;
				}
				else
				{
					$data =array("message" =>"You already Confirm this booking.");
					echo $this->load->view("user/confirmbooking",$data, true);
					exit;
				}
				
			}

		}
		
  	}
  	public function getConfirmBookings()
	{
		global $BOOKING_STATUS;
		$this->data["booking_status"] = $BOOKING_STATUS; 
		if($_POST)
		{			
			//echo print_r($_POST); die;
			$booking_status = ['0'];
			$bookings = $this->UserModel->loadBookingsList(null, null, $_POST["email"], $booking_status);
			if(!empty($bookings))
			{				
				//echo print_r($booking);exit;					
				$this->data["bookings"] = $bookings;
				
				$view = $this->load->view('user/confirmbookinglist',$this->data,true);
				
				echo $view;
				exit;				
			}
			else
			{
				echo 'no_booking_found';
				exit;
			}
		}
	}
	public function praposalStatus(){
		$data = array("response"=>true);
		$this->load->view('user/praposalstatus',$data);
	}
	function cancelEventToGoogleCalendar()
	{
		$booking_data = $_SESSION['booking_data'];
		
		//echo '<pre>';print_r($booking_data);	
		
		if($booking_data['google_event_id']!='')
		{		
			$summary = $booking_data['booking_title'].' - Booking Cancelled';
			$dateArr = explode(' ',$booking_data['booking_date']);
		
			$date = $dateArr[0].'T'.$dateArr[1];
			$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
			$description = '<br/><b>Guest</b>: '.$booking_data['email'];
			$description ='<br/><br/><b>Status</b>: Booking Cancelled!';
			$description ='<br/><br/><b>Booking Title</b>:'.$booking_data['booking_title'];
			$description .='<br/><br/><b>Booking date</b>: '. date( 'm/d/Y',strtotime($dateArr[0]) );
			$description .='<br/><br/><b>Booking time</b>: '. date( 'h:i A',strtotime($dateArr[1]) );
			$description .='<br/><br/><b>Company</b>: '.$booking_data['value'] ;
			$description .='<br/><br/><b>Name</b>: '.$booking_data['name'];
			$description .='<br/><b>Email</b>: '.$booking_data['email'];
			$description .='<br/><br/>Powered by: anbruch.com';
			$timezone = date_default_timezone_get();
		
			$service_account_name = 'anbruch@anbruch.iam.gserviceaccount.com'; 
			$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-65bc39b56937.json';
			$client = new Google_Client(); //AUTHORIZE OBJECTS
			$client->setApplicationName("Anbruch");

			$client->setAuthConfig($key_file_location);

			$client->addScope(Google_Service_Calendar::CALENDAR);
			$client->setSubject($service_account_name);
			$service = new Google_Service_Calendar($client);		
			// First retrieve the event from the API.
			$event = $service->events->get('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $booking_data['google_event_id']);
			$event->setSummary($summary);
			$event->setDescription($description);
			//$event->setStatus("cancelled");
			$event->setColorId(6);
			$updatedEvent = $service->events->update('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $event->getId() , $event);
			// Print the updated date.
			$updated =  $updatedEvent->getUpdated();		
			//echo '<pre>';print_r($updated);
		}
		
	}
	function confirmEventToGoogleCalendar()
	{
		$booking_data = $_SESSION['booking_data'];
		if($booking_data['google_event_id']!='')
		{		
			$summary = $booking_data['booking_title'].' - Booking Confirmed';
			$dateArr = explode(' ',$booking_data['booking_date']);
		
			$date = $dateArr[0].'T'.$dateArr[1];
			$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
			$description = '<br/><b>Guest</b>: '.$booking_data['email'];
			$description ='<br/><br/><b>Status</b>: Booking Confirmed!';
			$description ='<br/><br/><b>Booking Title</b>:'.$booking_data['booking_title'];
			
			$description .='<br/><br/><b>Booking date</b>: '. date( 'm/d/Y',strtotime($dateArr[0]) );
			$description .='<br/><br/><b>Booking time</b>: '. date( 'h:i A',strtotime($dateArr[1]) );
			$description .='<br/><br/><b>Company</b>: '.$booking_data['value'] ;
			$description .='<br/><br/><b>Name</b>: '.$booking_data['name'];
			$description .='<br/><b>Email</b>: '.$booking_data['email'];
			$description .='<br/><br/>Powered by: anbruch.com';
			$timezone = date_default_timezone_get();
		
			$service_account_name = 'anbruch@anbruch.iam.gserviceaccount.com'; 
			$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-65bc39b56937.json';
			$client = new Google_Client(); //AUTHORIZE OBJECTS
			$client->setApplicationName("Anbruch");

			$client->setAuthConfig($key_file_location);

			$client->addScope(Google_Service_Calendar::CALENDAR);
			$client->setSubject($service_account_name);
			$service = new Google_Service_Calendar($client);		
			// First retrieve the event from the API.
			$event = $service->events->get('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $booking_data['google_event_id']);
			$event->setSummary($summary);
			$event->setDescription($description);
			//$event->setStatus("cancelled");
			$event->setColorId(10);
			$updatedEvent = $service->events->update('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $event->getId() , $event);
			// Print the updated date.
			$updated =  $updatedEvent->getUpdated();		
			//echo '<pre>';print_r($updated);
		}
		
	}
	 /*public function getCurrentTimeZone(){
    	$ip     = $_SERVER['REMOTE_ADDR'];
    		$ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
		$ipInfo = json_decode($ipInfo);
		$timezone = $ipInfo->timezone;
		print_r($ipInfo);
		echo '<br>';
		
		$datetime3 = date('Y-m-d H:i');
		echo $datetime3;echo '<br>';
		echo strtotime($datetime3. ' '. $timezone);
		echo '<br>';
				echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
		date_default_timezone_set($timezone);
		echo 'date_default_timezone_set after: ' . date_default_timezone_get() . '<br />';	
		$datetime1 = date('Y-m-d H:i');
		echo $datetime1;echo "<br />";
		$india = strtotime($datetime1. ' '. $timezone);
		echo date("Y-m-d H:i",$india);
		
		die();
		return $datetime;
    }*/

	public function getEventNotification(){

	
       $notificationData = $this->ModuleModel->getEventEmailReminder(); //get all data
       $todayDate = strtotime(date("Y-m-d H:i"));//$this->getCurrentTimeZone(); //find today date and time
       $fromEmail = COMPANY_NOREPLY_EMAIL;
       foreach ($notificationData as $data => $value){
          $notificationTime = $value['notification_date'].' '.$value['notification_time']; //itrate time for each value pair
          $notificationTime = strtotime(date("Y-m-d H:i", strtotime($notificationTime))); //convert date and time
          if($notificationTime == $todayDate){ //if date and time match with today time then
          	$this->App_model->rowInsert('cron',array('time'=>date("Y-m-d H:i:s")));
              $this->App_model->rowInsert('cron',array('time'=>date("Y-m-d H:i:s")));
               $emails = $this->App_model->getWhereInData('calendar_invitations', '*', array('1', '2'),'status', $join = false ,array('event_id' =>  $value['event_id']));              
              //get all the email of invities from invitation table for that event_id
              
          if(!empty($emails)){
              foreach ($emails as $key => $email){
                 $data = array(
                      'id'  => $value['id'],
                      'title'  => $value['title'],
                      'location' => $value['location'],
                      'start_date' => $value['start_date'],
                      'end_date'  =>  $value['end_date'],
                      'start_time' => $value['start_time'],
                      'end_time' => $value['end_time'],
                      'notes' => $value['notes'],
                      'all_day' => $value['all_day'], 
                      );
            $subject = "Event Reminder";
            $eventId = $email['event_id'];
            $token = $email['access_token'];
            $email1 = $email['sent_email'];
            $invitationId = $email['id'];
            $data['acceptUrl'] = base_url("invitation/job/job?action=View&eid=$eventId&token=$token&email=$email1&status=2&invitationId=$invitationId");
            $data['declineUrl'] = base_url("invitation/job/job?action=View&eid=$eventId&token=$token&email=$email1&status=3&invitationId=$invitationId");
            $msg = $this->load->view('email-template/event_reminder', $data, TRUE);
               
               $this->email->from($fromEmail);
               $this->email->to($email['sent_email']);
               $this->email->subject($subject); 
               $this->email->message($msg);
               $result =  $this->email->send();
               if($result){
                   $this->ModuleModel->updateReminderTable($value['event_id']);
                }        
              }
            }
          }
        } 
       die();
    }

    public function getBookingNotification()
    {
    	 
    	/*print_r(date_default_timezone_get());
    	print_r(date('Y-m-d H:i:s')); die("cool");*/
	   	$notificationData = $this->ModuleModel->getEmailReminder();
    	$todayDate = strtotime(date("Y-m-d H:i")); //$this->getCurrentTimeZone(); 
    	$fromEmail = COMPANY_NOREPLY_EMAIL;
		$fromName = COMPANY_NAME;
		//print_r($notificationData);
		/*echo $todayDate;
		echo '<br>';
		echo date("m/d/Y h:i a");*///die();
    for($i = 0; $i < sizeof($notificationData); $i++){
    	 	$notificationDate =  $notificationData[$i]['notification_date'] .' '. $notificationData[$i]['notification_time'];	
    	 	$notificationVia = $notificationData[$i]['notification_via'];
    	 	$notificationDate = strtotime(date("Y-m-d H:i", strtotime($notificationDate)));
    	 	/*echo $notificationDate;
    	 	echo '<br>';*/
    	 	
    	 	if($notificationDate == $todayDate && $notificationVia == 1):

	    	 	$this->App_model->rowInsert('cron',array('time'=>date("Y-m-d H:i:s")));
    	 		$toEmail = $notificationData[$i]['email'];
    	 		$data = array(
						'booking_date' => date('m/d/Y',strtotime($notificationData[$i]['booking_date'])),
						'booking_time' => date('h:i a',strtotime($notificationData[$i]['booking_date'])),
						'end_date' => date('m/d/Y',strtotime($notificationData[$i]['end_date'])),
						'end_time' => date('h:i a',strtotime($notificationData[$i]['end_date'])),
						'booking_title' => $notificationData[$i]['booking_title'],
						'lead_title' => "test",
						'notes' => $notificationData[$i]['notes'],
						'name' => $notificationData[$i]['name'],
						'email' =>  $notificationData[$i]['email'],
						'current_module' => $notificationData[$i]['module_id'] == 1 ? 'Lead':'Client',
						'current_record_id' => $notificationData[$i]['record_id'],
						'record_status' => $notificationData[$i]['status'],
						'bookingId' =>  $notificationData[$i]['event_id'],
						'status' =>  $notificationData[$i]['status'],	
					);
    	 			$emailTemplate = $this->load->view('emails/booking_reminder',$data,true);
    	 			$title = 'Booking Reminder.';
    	 			$this->email->from($fromEmail);
					$this->email->to($toEmail);
					$this->email->subject($title);
					$this->email->message($emailTemplate);
					if($this->email->send())
					  {
						  $this->ModuleModel->updateReminderTable($notificationData[$i]['event_id']);
					  }
					  //print_r($data);
    	 	endif;

    	 	/*if($notificationDate == $todayDate && $notificationVia == 2):
    	 	endif;*/
    	 } 
    	die();
    }

   
    public function cronTest(){
      $this->App_model->rowInsert('cron',array('time'=>date("Y-m-d H:i:s")));
    }

    public function unsubscribe(){
    	$current_record_id = $_GET['id'];
    	if(!empty($current_record_id)){
    	$LeadCategory = array('value' => 'Dead',);
		$leadUpdate = $this->db->where('record_id', $current_record_id)
							       ->where('record_meta_id', 14)
						  	       ->update("anb_crm_record_meta_value", $LeadCategory);
		if($leadUpdate){
				$time = array('modified_time' => time());
				$timeupdate = $this->db->where('id', $current_record_id)
								  	       ->update("anb_crm_record", $time);
				$this->App_model->rowInsert('anb_crm_note',array('note'=>'Unsubscribe','created_by'=>$this->session->userdata('user_id'),'created_time'=> time(), 'record_id' => $current_record_id));  	
			}
			if($leadUpdate){
				  	$data =array("message" => "Your are unsubscribed.");
					echo $this->load->view("user/confirmbooking",$data, true);
			}
		}
		die();
    }
	public function getBookingTitle()
  	{
		$data = $this->App_model->getData('anb_crm_bookings', array('anb_crm_bookings.*'));
		$data_events = array();
		if (!empty($data))
		{
			foreach ($data as $value)
			{
			    $data_events[] = array(
		            "id" => $value['id'],
		            "title" => 'Not Available',
		            "start" => $value['booking_date'],
		            "end" => $value['end_date'],
		            "description" =>  (isset($value['notes']) && !empty($value['notes']) ? $value['notes'] : ''),
		            "endDay" => $value['end_date'],
		            "end_date" => !empty($value['end_date']) ? date('m/d/Y',strtotime($value['end_date'])):'',
		            "color" =>  '#d8d8d8',                 
		        );
		    }
		}      
		echo json_encode(array("events" => $data_events));
		exit();
	}
	public function dateToCal($time) {
        return date('Ymd\THis', strtotime($time)) . 'Z';
    }
	public function Booking()
	{
		$this->load->view("user/booking");
	}
	public function addWebBooking()
	{
		//print_r($_POST); die("Rishi");
		if($this->input->post('email'))
		{
			$postData = $this->input->post();
			$webData = array(
				'name' => !empty($postData['name']) ? $postData['name'] : 'No name',
				'email' => !empty($postData['email']) ? $postData['email'] : 'No mail',
				'phone' => !empty($postData['phone']) ? $postData['phone'] : '',
				'company_name' => !empty($postData['company_name']) ? $postData['company_name'] : '',
				'country' => !empty($postData['country']) ? $postData['country'] : '',
				'state' => !empty($postData['state']) ? $postData['state'] : '',
				'city' => !empty($postData['city']) ? $postData['city'] : '',
				'location' => 'Andrew Auger Sr. Corporate Savings Specialist will be calling you at '.$postData['phone'],
				'form_name' => !empty($postData['questionnaire']['form_name']) ? $postData['questionnaire']['form_name'] : '',
				'timezone' => !empty($postData['timezones']) ? $postData['timezones'] : '',
				'pdf' => !empty($postData['questionnaire']['file']) ? $postData['questionnaire']['file'] : '',
				'comments' => !empty($postData['comments']) ? $postData['comments'] : '',
				'start_time' => !empty($postData['st_date']) && !empty($postData['st_time']) ? date('Y-m-d', strtotime($postData['st_date'])).' '.date('H:i:s', strtotime($postData['st_time'])) : '',
				'end_time' => !empty($postData['st_date']) && !empty($postData['end_time']) ? date('Y-m-d', strtotime($postData['st_date'])).' '.date('H:i:s', strtotime($postData['end_time'])) : '',
			);
			$webbooking = array(
				'booking_title' => !empty($postData['questionnaire']['form_name']) ? $postData['questionnaire']['form_name'] : 'No Title',
				'booking_date' => !empty($postData['st_date']) && !empty($postData['st_time']) ? date('Y-m-d', strtotime($postData['st_date'])).' '.date('H:i:s', strtotime($postData['st_time'])) : '',
				'end_date' => !empty($postData['st_date']) && !empty($postData['end_time']) ? date('Y-m-d', strtotime($postData['st_date'])).' '.date('H:i:s', strtotime($postData['end_time'])) : '',
				'booking_address' => 'Andrew Auger Sr. Corporate Savings Specialist will be calling you at '.$postData['phone'],
				'name' => !empty($postData['name']) ? $postData['name'] : 'No name',
				'email' => !empty($postData['email']) ? $postData['email'] : 'No mail',
				'notes' => !empty($postData['comments']) ? $postData['comments'] : '',
				'created_for' => 1,
				'status' => 5,
				'module_id' => 1,
				'web_booking' => 1,
				'created_by'=>1,
				'assigned_officer_id'=>1
			);
			$insert_id = $this->App_model->rowInsert('anb_crm_bookings', $webbooking);
			if(!empty($insert_id))
			{
				if(!empty($postData['questionnaire']))
				{
					$postData['questionnaire']['web_book_id'] = $insert_id;
					$questionnaire = $postData['questionnaire'];
					//$questionnaire['score'] = $postData['score'];
					$this->App_model->rowInsert('anb_crm_web_questionnaire', $questionnaire);
				}

                $ics = 'BEGIN:VCALENDAR
PRODID:-//Google Inc//Google Calendar 70.9054//EN
VERSION:2.0
BEGIN:VTIMEZONE
TZID:America/New_York
BEGIN:STANDARD
DTSTART:19981025T020000
TZOFFSETFROM:-0400
TZOFFSETTO:-0500
TZNAME:EST
END:STANDARD
BEGIN:DAYLIGHT
DTSTART:'.$this->dateToCal(date('Y-m-d', strtotime($postData['st_date'])).'T'.date('H:i:s', strtotime($postData['st_time']))).'
TZOFFSETFROM:-0500
TZOFFSETTO:-0400
TZNAME:EDT
END:DAYLIGHT
END:VTIMEZONE
BEGIN:VEVENT
DTSTAMP:' . $this->dateToCal(date("Y-m-dTH:i:s")) .'
UID:guid-1.example.com
ORGANIZER:mailto:aauger@anbruch.com
DESCRIPTION:'. addslashes($postData["comments"]) .'
CATEGORIES:MEETING
CLASS:PUBLIC
CREATED:' . $this->dateToCal(date("Y-m-dTH:i:s")) .'
SUMMARY:'.$postData["name"].'
DTSTART;TZID=America/New_York:'.$this->dateToCal(date('Y-m-d', strtotime($postData['st_date'])).'T'.date('H:i:s', strtotime($postData['st_time']))).'
DTEND;TZID=America/New_York:'.$this->dateToCal(date('Y-m-d', strtotime($postData['st_date'])).'T'.date('H:i:s', strtotime($postData['end_time']))).'
LOCATION:Andrew Auger Sr. Corporate Savings Specialist will be calling you at '.$postData['phone'].'
SEQUENCE:0
STATUS:CONFIRMED
TRANSP:TRANSPARENT
ESTIMATORID:Andrew Auger
END:VEVENT
END:VCALENDAR';
				file_put_contents("assets/uploads/booking.ics",$ics);
				$icsPath = base_url().'assets/uploads/booking.ics';
				$pdfPath = 'http://anbruch.com/wp-content/themes/anbruch/lead-pdf/'.$postData['questionnaire']['file'];
				$assignedData = array(
					'current_module_id' => 1,
					'leadassignedofficer' => 'Andrew Auger',
					'name' => !empty($postData['name']) ? $postData['name'] : '',
					'email' => isset($postData['email']) ? $postData['email'] : " Email Not Available",
					'phone' => isset($postData['phone']) ? $postData['phone'] : "",
					'company' => isset($postData['company_name']) && !empty($postData['company_name']) ? $postData['company_name'] : "No Company Name Available",
					'location' => "Andrew Auger Sr. Corporate Savings Specialist will be calling you at ".$postData['phone'],
					'timezone' => isset($postData['timezones']) ? $postData['timezones'] : "Eastern Time : US & Canada",
					'booking_title' => !empty($postData['name']) ? $postData['name'] : 'NA',
					'booking_date' => date('m/d/Y',strtotime($postData['st_date'])),
					'booking_time' => date('h:i a',strtotime($postData['st_time'])),
					'end_date' => date('m/d/Y',strtotime($postData['st_date'])),
					'end_time' => date('h:i a',strtotime($postData['end_time'])),
					'notes' => !empty($postData['comments']) ? $postData['comments'] : '',
					'city' => !empty($postData['city']) ? $postData['city'] : '',
					'country' => !empty($postData['country']) ? $postData['country'] : '',
					'duration' => !empty($postData['duration']) ? $postData['duration'] : '',
				);
				$toName = 'Andrew Aauger';
				$toEmail = trim($postData['email']);
				$subject = 'Your Booking is Confirmed! | Discussion: Corporate Savings Opportunities | '.date('F d', strtotime($postData["st_date"])).' @'.date("h:i a",strtotime($postData["st_time"])).' EST';
				
				$emailTemplate = $this->load->view('emails/webBookingAssigned',$assignedData,true);
				//echo $emailTemplate;die();	
				$fromEmail = COMPANY_NOREPLY_EMAIL;
				$fromName = COMPANY_NAME;
				$data1 = json_encode($assignedData);
				$this->ModuleModel->saveEmail(1,$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data1);	
				$this->email->from($fromEmail);
				$this->email->to('aauger@anbruch.com');
				$this->email->subject($subject);
				$this->email->message($emailTemplate);
				$this->email->attach($icsPath);
				$this->email->attach($pdfPath);
				if($this->email->send())
				{
					//$smtpconfig = $this->config->item('email2');
					//$this->email->initialize($smtpconfig);
					$this->email->from($fromEmail, 'Anbruch');
					$this->email->to($toEmail);
					$this->email->subject($subject);
					$this->email->message($emailTemplate);
					$this->email->attach($icsPath);
					$this->email->send();
					
				}
				else
				{
				
				}
				if(!empty($postData['guest']))
				{
					$this->email->clear(TRUE);
					foreach ($postData['guest'] as $key => $email) {
						$guestData = array(
							'booking_id' => $insert_id,
							'guest' => trim($email),
							'guest_name' => '',
							'status' => 0,
							'invited_by' => 1,
							'created_by' => 1,
						);
						$flag = $this->App_model->rowInsert('anb_crm_bookings_guests', $guestData);
						if($flag)
						{

							//$smtpconfig = $this->config->item('email2');
							//$this->email->initialize($smtpconfig);
							$invitationData = $assignedData;
							$invitationData['acceptUrl'] = base_url("user/webBookingInvitation/?action=View&bid=$insert_id&email=$email&status=1&invitationId=$flag");

							$invitationData['declineUrl'] = base_url("user/webBookingInvitation/?action=View&bid=$insert_id&&email=$email&status=3&invitationId=$flag");

							$emailTemplate = $this->load->view('emails/webBookingInvitation',$invitationData,true);

							$subject = 'Discussion: Corporate Savings Opportunities | '.date('F d', strtotime($postData["st_date"])).' @'.date("h:i a",strtotime($postData["st_time"])).' EST';

							$fromEmail = COMPANY_NOREPLY_EMAIL;
							$fromName = COMPANY_NAME;
							$toEmail = trim($email);

							$this->ModuleModel->saveEmail(1,$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$emailTemplate);
							
							$this->email->from($fromEmail, 'Anbruch');
							$this->email->to($toEmail);
							$this->email->subject($subject);
							$this->email->message($emailTemplate);
							//$this->email->attach($icsPath);
							//$this->email->attach($pdfPath);
							if($this->email->send())
							{
							}
							else{ echo 'Email not sent.';
							}
						}
					}
				}
				$webData['booking_id']=$insert_id;	
				$this->App_model->rowInsert('anb_crm_web_booking', $webData);
				$result['success'] = true;
				$result['message'] = 'Your request submitted successfully';
			}
			else
			{
				$result['success'] = false;
				$result['message'] = 'Something went wrong to perform this action';
			}
			echo json_encode($result); die();
		}
	}
	public function checkBookingAvailabilityWEB()
	{
		if($this->input->post())
		{
			$postData = $this->input->post();
			$booking_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($postData['date'])).' '.date('H:i:s', strtotime($postData['start_time']))));
			$end_date = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($postData['date'])).' '.date('H:i:s', strtotime($postData['end_time']))));
			if($booking_date >= $end_date)
			{
				$result['success'] = false;
				$result['message'] = 'Invalid Booking Date & Time';
				echo json_encode($result); die();
			}
			$this->db->select('*');
			$this->db->from('anb_crm_bookings');
			$this->db->where("booking_date <=", $booking_date);
			$this->db->where("end_date >=", $end_date);
			$query = $this->db->get();
			$status = $query->num_rows();
			if($status)
			{
				$result['success'] = false;
				$result['message'] = 'Booking already exist for this schedule';
			}
			else
			{
				$result['success'] = true;
				$result['message'] = 'Booking available';
			}
			echo json_encode($result); die();
		}
	}
	public function getWEBPlates()
	{
		if($this->input->post())
		{
			//print_r($_POST); die("ook");
			$date = date('Y-m-d', strtotime($this->input->post('date')));
			$this->db->select('booking_date, end_date');
			$this->db->from('anb_crm_bookings');
			$this->db->like('booking_date',$date, 'after');
			$data = $this->db->get()->result_array();
			$hours = array(
				array("Prev" => 1, "time" => "9", "Next" => 1),
				array("Prev" => 1, "time" => "10", "Next" => 1),
				array("Prev" => 1, "time" => "11", "Next" => 1),
				array("Prev" => 1, "time" => "12", "Next" => 1),
				array("Prev" => 1, "time" => "13", "Next" => 1),
				array("Prev" => 1, "time" => "14", "Next" => 1),
				array("Prev" => 1, "time" => "15", "Next" => 1),
				array("Prev" => 1, "time" => "16", "Next" => 1),
				array("Prev" => 1, "time" => "17", "Next" => 1),
				array("Prev" => 1, "time" => "18", "Next" => 1),

			);
			$arr = array();
			foreach ($data as $key => $value) {
				$start_hr = date('G', strtotime($value['booking_date']));
				$end_hr = date('G', strtotime($value['end_date']));
				$start_min = intval(date('i', strtotime($value['booking_date'])));
				$end_min = intval(date('i', strtotime($value['end_date'])));
				//print_r($value); die("ok");
				$j= $start_hr;
				while($j <= $end_hr)
				{
					if($start_min >= 30)
					{
						$index = array_search($start_hr, array_column($hours, "time"));
						$hours[$index]["Next"] = 0;
					}
					if($j != $start_hr && $j != $end_hr)
					{
						$index = array_search($j, array_column($hours, "time"));
						unset($hours[$index]);
					}
					if($end_min <= 30 && $end_min > 0)
					{
						$index = array_search($end_hr, array_column($hours, "time"));
						$hours[$index]["Prev"] = 0;
					}
					$j++;
				}
			}
			if(!empty($hours))
			{
				foreach ($hours as $key => $value) {
					if(!empty($value["time"]))
					{
						if($value["time"] > 12)
						{
							$v = $value["time"] - 12;
							$hours[$key]["time"] = $v;
						}
					}
				}
			}
			echo json_encode($hours); die();
		}
	}
	public function webBookingInvitation()
    {
        if($this->input->get())
    	{
			$data = $this->input->get();
			$booking_id = isset($data['bid']) ? $data['bid'] : ''; 	
			$email = isset($data['email']) ? $data['email'] : '';
			$invitationId = isset($data['invitationId']) ? $data['invitationId'] : '';

			/*check status */
			$join = array(
				array(
					"table" => 'anb_crm_bookings booking',
					"on" => 'booking.id = booking_guest.booking_id'
				),
			);

			$checkStatus = $this->App_model->getData('anb_crm_bookings_guests as booking_guest', array('booking_guest.status','booking.booking_title'), array('booking_guest.booking_id' => $booking_id, 'booking_guest.guest' => $email, 'booking_guest.id' => $invitationId  ),$join);

			//print_r($checkStatus); die("ok");
			
			$currentStatus =  isset($checkStatus[0]) && isset($checkStatus[0]['status']) ? $checkStatus[0]['status'] : '';
			
			$booking_title =  isset($checkStatus[0]) && isset($checkStatus[0]['booking_title']) ? $checkStatus[0]['booking_title'] : '';
			
			if($currentStatus == 0)
			{
				$status = isset($data['status']) ? $data['status'] : '';
				$update = array('status' => $status,'modified_time' => date('Y-m-d H:i:s'));
				$updateCheck = $this->App_model->rowUpdate('anb_crm_bookings_guests',$update,array('booking_id' => $booking_id,'id' => $invitationId, 'guest' => $email ));

				if($updateCheck == 1)
				{
					switch ($status) {
					case 1:
					$message = "accepted";
					$comment = "has accepted invitation Booking: $booking_title";
					break;
					case 3:
					$message = "declined";
					$comment = "has declined invitation Booking: $booking_title";
					break;
					default:
					$comment = '';
					$message = '';
				}

				$data['message'] = 'You have successfully '.$message.' a invitation for this Booking.';
				$data['status'] = 1;
				$html = $this->load->view('common/mailAlert',$data,TRUE);
				echo $html;
				/*echo '<link rel="stylesheet" href="'.base_url("static/bs3/css/bootstrap.min.css").'">';	
				echo '<div class="jumbotron text-xs-center text-center"><h1 class="display-3">Thank You!</h1>';
				echo '<p class="lead"><strong>You have successfully '.$message.' a invitation for this Booking.</p></div>';	
*/
				$this->load->library('notifications');
				$config['default_token'] = '';
				$config['default_comment'] = $comment;
				$config['default_type'] = 'Booking Invitation';
				$config['notification_from'] = $email;
				$config['event_id'] = $booking_id;
				$config['default_sender'] = '';
				$config['default_target'] = '';
				$this->notifications->config($config);
				die();
				}
			}
			else
			{
				$data['message'] = 'You already submitted response for this booking.';
				$data['status'] = 2;
				$html = $this->load->view('common/mailAlert',$data,TRUE);
				echo $html;
				die();
			}
		}
    }

    function template(){
    	$this->load->view('emails/booking_confirmed');
    }


}
