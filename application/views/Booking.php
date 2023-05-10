<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Booking extends Base
{

	public function __construct()
	{
			parent::__construct();
			$this->redirectPublicUser();
			$this->load->model("ActivitiesModel");
      $this->load->model("ModuleModel");
      $this->load->model("BookingModel");
      $this->load->model("HolidaysModel");
      $this->load->model("UserModel");
	}
	
	function check()
	{
		$email = $_GET['email'];
		//$guest_data = $this->BookingModel->get_guest_name_by_email_user($email); 
		//echo '<pre>';print_r($guest_data);
		
		$guest_data1 = $this->BookingModel->get_guest_name_by_email_client($email); 		
		echo '<pre>';print_r($guest_data1);die;
	}
	
	
	public function bookedit()
	{
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			echo '<pre>'; print_r($_POST); //die;
			//echo print_r($_POST); exit;
			$booking_date = date('Y-m-d H:i',strtotime($_POST['selected_date'].' '.$_POST['selected_time']));
			$booking = $this->BookingModel->loadBookingsList(null, $_POST["current_record_id"], $_POST["email"], $booking_date, $_POST["bid"]);
			if(empty($booking))
			{								
					$bookingId = $this->BookingModel->updateBooking();						
					if($bookingId)
					{					
						$current_record_data = $this->BookingModel->get_record_data_by_id($_POST["current_record_id"]);		
						echo print_r($current_record_data); //exit;	
						if($this->isSuperAdmin())
						{
							$loggedinUserId = $this->getUserId();						
							$receiver_id = $current_record_data['assigned_officer_id'];
						}
						else
						{
							$loggedinUserId = $this->getUserId();			
							$receiver_id = 1;											
						}						
						echo print_r($loggedinUserId); //exit;	
						echo print_r($receiver_id); //exit;										
						$notifyData = array(
							"record_id" => $_POST["current_record_id"],
							"booking_id" => $bookingId,
							"sender_id" => $loggedinUserId,
							"receiver_id" => $receiver_id,
							"title" => "A booking updated",
							"description" =>  $this->getPost("booking_title").' on '.date('m/d/Y',strtotime($this->getPost("selected_date"))).' at '.date('h:ia',strtotime($this->getPost("selected_time"))),
							"read" => 0, //0=new booking
							"created_time" =>date('Y-m-d H:i:s'),				
							"modified_time" =>date('Y-m-d H:i:s'),													
						);
						$noti = $this->BookingModel->add_notification($notifyData);
						
						
						$booking = $this->BookingModel->loadBookingById($bookingId);							
						//echo '<pre>';print_r($booking);
						$_SESSION['booking_data'] = $booking;
						//google calender booking sync start
						//$googleEvent = $this->addEventToGoogleCalendar();				//depricated		
						//google calender booking sync end
		
		
						$fromEmail = COMPANY_NOREPLY_EMAIL; 					
						$fromName = COMPANY_NAME; 					
							
						//$toEmail = "harpreetclerisy@gmail.com";
						$toEmail = trim($this->getPost("email"));
						$toName = $this->getPost("full_name");			
								
						$data = array(
							'booking_date' => date('m/d/Y',strtotime($this->getPost("selected_date"))),
							'booking_time' => date('h:ia',strtotime($this->getPost("selected_time"))),
							'name' => $this->getPost("full_name"),
							'email' => $this->getPost("email"),
							'current_module' =>$this->getPost("current_module"),
							'current_record_id' => $this->getPost("current_record_id"),
							'record_status' => $this->getPost("recordStatus"),									
							'bookingId' => $bookingId,
							//'status' => 0,		//new				 				
						);
						$emailTemplate = $this->load->view('emails/booking_updated',$data,true);
							
						//echo $emailTemplate; die;
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
						$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
						$headers .= 'X-Mailer: PHP/' . phpversion(); 
						$title = 'Booking updated.';

						$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);						
						
						if(mail($toEmail,$title,$emailTemplate,$headers))
						{
							echo 'sent';	
						}
						else
						{
							echo 'not_sent';	
						} 
						
						exit;
					}
					else
					{                
							echo false;
							exit;
					}
					
			}
			else
			{
				echo 'booking_already_exists';	
				exit;
			}		
			
			
		}
		
		$this->data["bid"] = $bid = $this->getPost("bid");
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["current_record_id"] = $this->getPost("id");
		$this->data["recordStatus"] = $this->getPost("record_status");
		
		
		$this->data["booking"] = $this->BookingModel->loadBookingById($bid,$this->data["current_module"]);
		//echo '<pre>';print_r($this->data["booking"]); die;
		$this->data["page"] = "bookedit";
		$this->viewLoad("booking/bookedit");			
		
		
	}
	public function bookupdate()
	{
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			echo print_r($_POST); //exit;
			
			$invited_by = $created_by = $modified_by = $this->getUserId();						
			
			$booking_id = $_POST['booking_id'];
			$google_event_id = $_POST['google_event_id'];
			$booking_title = $_POST['booking_title'];
			$title = $_POST['title'];
			
			if($_POST['all_day']=='on')
			{				
				$all_day = 1;
				$start_time = '00:00:00';
				//$end_time = 00:00:00';				
			}
			else
			{
				$all_day = 0;
				$start_time = $_POST['start_time'];
				//$end_time = $_POST['end_time'];
			}
			
			$start_date = $_POST['start_date'].' '.$start_time;		
			//$end_date = $_POST['end_date'];			
			
			$repeat = $_POST['repeat'];
			$availability = $_POST['availability'];
			$visibility = $_POST['visibility'];
			$color = $_POST['color'];
			$notes = $_POST['notes'];
			
			if(!empty($_POST['notify_by']))
			{		
				$notify_by = json_encode($_POST['notify_by']);
				$notify_before = json_encode($_POST['notify_before']);
				$notify_on = json_encode($_POST['notify_on']);
			}
			else
			{
				$notify_by = '';
				$notify_before = '';
				$notify_on = '';
			}
			
			
			$correct_email = [];
			if(!empty($_POST['invite']))
			{				
				$invites =$_POST['invite'];
				foreach($invites as $email)
				{
					if($email!="" && filter_var($email, FILTER_VALIDATE_EMAIL))
					{
						$correct_email[] = $email;
					}
				}
			}
			
			if(!empty($correct_email))
			{
				$final_invites = json_encode($correct_email);
			}
			else
			{
				$final_invites = '';
			}
			
			$recordData = array(
				'booking_date' => date('Y-m-d H:i:s', strtotime($start_date)),
				'booking_title' => $booking_title,
				'all_day' => $all_day,
				'repeat' => $repeat,
				'availability' => $availability,
				'visibility' => $visibility,
				'color' => $color,
				'notes' => $notes,
				'notify_by' => $notify_by,
				'notify_before' => $notify_before,
				'notify_on' => $notify_on,				
				'guest_can_modify_event' => $_POST['modify_event']=='on' ? 1 :0 ,				
				'guest_can_invite_others' => $_POST['invite_others']=='on' ? 1 :0 ,				
				'guest_can_see_guest_list' => $_POST['see_guest_list']=='on' ? 1 :0,					
				'modified_by' => $modified_by,									
				'modified_time' => date('Y-m-d H:i:s'),									
			);
			
			$this->db->where('id', $booking_id);
      $recordUpdateSuccessful = $this->db->update("anb_crm_bookings", $recordData);
			
			echo print_r($recordData); //exit;
			
			if($booking_id)
			{
				//send invitation			
				if(!empty($invites))
				{
					$all_email = implode(', ',$invites);
					foreach($invites as $email)
					{
						if($email!="" && filter_var($email, FILTER_VALIDATE_EMAIL))
						{
		
		$start_date = date("Y-m-d H:i:s", strtotime('+30 minutes', strtotime($start_date)));		
		$date = date('Y-m-d H:i:s',strtotime($start_date));
				
		$data_array = [];
		$data_array['available'] = 1;
		
		$this->db->select("*");
		$this->db->where("u.email", $email);	
		$qry = $this->db->get('anb_crm_users u');
		$res = $qry->row_array();
		if(!empty($res))
		{
			$this->db->select("*");
			$this->db->where("una.user_id", $res['id']);	
			$this->db->where("una.start_date <=", $date);	
			$this->db->where("una.end_date >=", $date);	
			$qry = $this->db->get('anb_crm_users_not_available una');
			$res1 = $qry->result_array();
			//echo print_r($res1); 
			if(!empty($res1))
			{
				$data_array['available'] = 0;
			}			
		}
		
		if($data_array['available'] ==1)
		{
							
							$guest_data = $this->BookingModel->get_guest_name_by_email_user($email); 							
							if(!empty($guest_data))
							{
								$guest_name = $guest_data['first_name'].' '.$guest_data['last_name'];
							}
							else
							{
								$guest_name = '';
							}						
							
							//$guest_name = $this->BookingModel->get_guest_name_by_email_client($email); 		
							
							$this->db->select('*');
							$this->db->where('booking_id', $booking_id);
							$this->db->where('guest', trim($email));
							$qry = $this->db->get('anb_crm_bookings_guests');     
							$ret = $qry->row_array();
							if(empty($ret))
							{
								$guestdata = array(
									'booking_id' => $booking_id,
									'guest' => trim($email),
									'guest_name' => $guest_name,
									'status' => 0,  //0=just invited, 1= going, 2=maybe, 3 = not going
									'invited_by' => $invited_by,
									'created_by' => $created_by,
									'modified_by' => $modified_by,
									'created_time' => date('Y-m-d H:i:s'),
									'modified_time' => date('Y-m-d H:i:s'),									
								);
								
								$this->db->insert("anb_crm_bookings_guests", $guestdata);								
								
								$fromEmail = COMPANY_NOREPLY_EMAIL; 					
								$fromName = COMPANY_NAME; 					
									
								//$toEmail = "harpreetclerisy@gmail.com";
								$toEmail = trim($email);
								$toName = "Guest";			
										
								$data = array(
									'booking_id' => $booking_id,
									'booking_date' => date('m/d/Y',strtotime($start_date)),						
									'booking_time' => date('H:ia',strtotime($start_date)),						
									'booking_title' => $booking_title,
									'email' => $email,									
									'all_email' => $all_email,									
									'status' => $guestdata['status'],		
								);
								$emailTemplate = $this->load->view('emails/meeting_invitation',$data,true);
									
								//echo $emailTemplate; die;
								
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
								$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
								$headers .= 'X-Mailer: PHP/' . phpversion(); 
								$title = 'Invitation: '.$booking_title.' - '.$data['booking_date'];

								$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);	
								
								if(mail($toEmail,$title,$emailTemplate,$headers))
								{
									echo 'sent';	
								}
								else
								{
									echo 'not_sent';	
								} 
								
							}							
								
		}
						}
					}
				}
				
			}
			
			$this->session->set_flashdata('success',"The meeting has been updated successfully.");
			
			
			//update on google calender start			
			if($google_event_id!='')
			{
				$booking = $this->BookingModel->loadBookingById($booking_id);				
				//echo print_r($recordData); //exit;
				
				if($booking['status']==0)
				{
					$summary = $booking['value'].' - Awaing for confirmation';
					$colorId = 1;
				}
				else if($booking['status']==1)
				{
					$summary = $booking['value'].' - Booking Confirmed';
					$colorId = 2;
				} 
				else if($booking['status']==2)
				{
					$summary = $booking['value'].' - Booking Cancelled';
					$colorId = 6;
				} 

				//$location = $booking_data['collection1_address'].' '.$booking_data['collection_suburb'];
				
				$dateArr = explode(' ',$booking['booking_date']);
			
				$date = $dateArr[0].'T'.$dateArr[1];
				$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
			
				//$description ='<br/><br/>Status: Booking Confirmed!';
				//$description .='<br/><br/>Booking date: '. date( 'j-F-Y',strtotime($dateArr[0]) );
				//$description .='<br/><br/>Booking time: '. date( 'h:i A',strtotime($dateArr[1]) );
				
				//$description .='<br/><br/>Name: '.$booking_data['name'];
				//$description .='<br/>Email: '.$booking_data['email'];

				//$description .='<br/><br/>Powered by: anbruch.com';
				
				//$timezone = date_default_timezone_get();
				//$timezone = 'America/Toronto';
				$timezone = 'Asia/Kolkata';

				require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';

				$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

				$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';
				
				$client = new Google_Client(); //AUTHORIZE OBJECTS
				$client->setApplicationName("Anbruch");

				$client->setAuthConfig($key_file_location);

				$client->addScope(Google_Service_Calendar::CALENDAR);

				$client->setSubject($service_account_name);

				$service = new Google_Service_Calendar($client);
				
				// First retrieve the event from the API.
				$event = $service->events->get('8v7230d98l4odaocl9rtajcr38@group.calendar.google.com', $google_event_id);

				$event->setSummary($summary);
				$event->setDescription($recordData['notes']);
				//$event->setStatus("confirmed");
				$event->setColorId($colorId);
			
				$start = new Google_Service_Calendar_EventDateTime();
				$start->setDateTime($date);
				$start->setTimeZone($timezone);
				$event->setStart($start);
				
				$end = new Google_Service_Calendar_EventDateTime();
				$end->setDateTime($enddate);  
				$end->setTimeZone($timezone);  
				$event->setEnd($end);
			
				//$repeat = strtoupper($booking['repeat']);
				//$event->setRecurrence(array('RRULE:FREQ='.$repeat));				

				$updatedEvent = $service->events->update('8v7230d98l4odaocl9rtajcr38@group.calendar.google.com', $event->getId() , $event);

				// Print the updated date.
				$updated =  $updatedEvent->getUpdated();		
				echo '<pre>';print_r($updated); exit;
			
				//update on google calender end	
			
			}			
		}	
		exit;		
	}
	
	public function bookdelete() 
	{
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			echo print_r($_POST); //exit;
			
			$booking_id = $_POST['booking_id'];
			$google_event_id = $_POST['google_event_id'];
	   
		}
	}

	public function remove_guest() 
	{			
		$booking_guest_id = $_POST['id'];
		$this->db->where('id',$booking_guest_id);
		$this->db->delete('anb_crm_bookings_guests');			
		
		echo true;	   	
		exit;
	}

	public function reassign_guest() 
	{			
		$invited_by = $created_by = $modified_by = $this->getUserId();						
		//echo print_r($_POST); exit;
		$reassign_booking_id = $_POST['reassign_booking_id'];
		$booking_guest_id = $_POST['booking_guest_id'];
		$olduser = $_POST['olduser'];
		$email = $_POST['newuser'];
		
		$guest_data = $this->BookingModel->get_guest_name_by_email_user($email); 							
		if(!empty($guest_data))
		{
			$guest_name = $guest_data['first_name'].' '.$guest_data['last_name'];
		}
		else
		{
			$guest_name = '';
		}		
		
		$this->db->select('*');
		$this->db->where('booking_id', $reassign_booking_id);
		$this->db->where('guest', trim($email));
		$qry = $this->db->get('anb_crm_bookings_guests');     
		$ret = $qry->row_array();
		if(empty($ret))
		{
			$this->db->where('id',$booking_guest_id);
			$this->db->delete('anb_crm_bookings_guests');			
		
			$guestdata = array(
				'booking_id' => $reassign_booking_id,
				'guest' => trim($email),
				'guest_name' => $guest_name,
				'status' => 0,  //0=just invited, 1= going, 2=maybe, 3 = not going
				'invited_by' => $invited_by,
				'created_by' => $created_by,
				'modified_by' => $modified_by,
				'created_time' => date('Y-m-d H:i:s'),
				'modified_time' => date('Y-m-d H:i:s'),									
			);
			
			$this->db->insert("anb_crm_bookings_guests", $guestdata);								
			
			$fromEmail = COMPANY_NOREPLY_EMAIL; 					
			$fromName = COMPANY_NAME; 					
				
			//$toEmail = "harpreetclerisy@gmail.com";
			$toEmail = trim($email);
			$toName = "Guest";			
			
			$this->db->select('*');
			$this->db->where('id', $reassign_booking_id);			
			$qry = $this->db->get('anb_crm_bookings');     
			$bkng = $qry->row_array();
	
			$booking_title = $bkng['booking_title'];
			$booking_date = $bkng['booking_date'];
			
			$data = array(
				'booking_id' => $reassign_booking_id,
				'booking_date' => date('m/d/Y',strtotime($booking_date)),						
				'booking_time' => date('H:ia',strtotime($booking_date)),						
				'booking_title' => $booking_title,
				'email' => $email,									
				'all_email' => '',									
				'status' => $guestdata['status'],		
			);
			$emailTemplate = $this->load->view('emails/meeting_invitation',$data,true);
				
			//echo $emailTemplate; die;
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
			$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
			$headers .= 'X-Mailer: PHP/' . phpversion(); 
			$title = 'Invitation: '.$booking_title.' - '.$booking_date;

			$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);		
			
			if(mail($toEmail,$title,$emailTemplate,$headers))
			{
				echo 'sent';	
			}
			else
			{
				echo 'not_sent';	
			} 
			
			$this->session->set_flashdata('success',"The user re-assigned successfully and meeting removed from your calendar.");
			
		}
		else
		{
			echo 'already_assigned';
		}							
		
		exit;
	}
	
	
	function not_available()
	{
		$loggedUserId = $this->getUserId();
		
		echo print_r($_POST); 
		
		$not_available_id = $_POST['not_available_id'];
		$not_available_user_id = $_POST['not_available_user_id'];
		
		$start_date = $_POST['nstartdate'];
		$start_time = $_POST['nstarttime'];
		$end_date = $_POST['nenddate'];
		$end_time = $_POST['nendtime'];
		$reason = $_POST['nreason'];
			
		if($not_available_id!='')
		{
			$notavaildata = array(
				'start_date' => $start_date.' '.$start_time,
				'end_date' => $end_date.' '.$end_time,
				'reason' => $reason,		
				'visible' => 1,				
				'modified_by' => $loggedUserId,
				'modified_time' => date('Y-m-d H:i:s'),									
			);
			
			$this->db->where("id", $not_available_id);								
			$this->db->where("user_id", $not_available_user_id);								
			$this->db->update("anb_crm_users_not_available", $notavaildata);								
		}
		else
		{
			$notavaildata = array(
				'user_id' => $loggedUserId,
				'start_date' => $start_date.' '.$start_time,
				'end_date' => $end_date.' '.$end_time,
				'reason' => $reason,		
				'visible' => 1,				
				'modified_by' => $loggedUserId,
				'created_time' => date('Y-m-d H:i:s'),
				'modified_time' => date('Y-m-d H:i:s'),									
			);
			
			$this->db->insert("anb_crm_users_not_available", $notavaildata);								
		}
		
		echo true;
		
		exit;
		
	}

	function not_available_delete()
	{
		$id = $_POST['id'];
		$this->db->where("id", $id);										
		$this->db->delete("anb_crm_users_not_available");								
		echo true;
		exit;
	}
	
	function not_available_check()
	{		
		$loggedUserId = $this->getUserId();
		
		//echo print_r($_POST); 
		$booking_id = $_POST['booking_id'];
		$email = $_POST['email'];
		$start_date = $_POST['start_date'];
		$start_time = $_POST['start_time'];
		$start_time = date("H:i:s", strtotime('+30 minutes', strtotime($start_time)));
		
		$date = date('Y-m-d H:i:s',strtotime($start_date.' '.$start_time));
		
		$data_array = [];
		$data_array['available'] = 1;   // available
		
		$this->db->select("*");
		$this->db->where("bg.booking_id", $booking_id);	
		$this->db->where("bg.guest", $email);	
		$qry = $this->db->get('anb_crm_bookings_guests bg');
		$bres = $qry->row_array();
		
		if(empty($bres))
		{
			$this->db->select("*");
			$this->db->where("u.email", $email);	
			$qry = $this->db->get('anb_crm_users u');
			$res = $qry->row_array();
			if(!empty($res))
			{
				$this->db->select("*");
				$this->db->where("una.user_id", $res['id']);	
				$this->db->where("una.start_date <=", $date);	
				$this->db->where("una.end_date >=", $date);	
				$qry = $this->db->get('anb_crm_users_not_available una');
				$res1 = $qry->result_array();
				//echo print_r($res1); 
				if(!empty($res1))
				{
					$data_array['available'] = 0;   //not_available
				}			
			}
		}
		else
		{
			$data_array['available'] = 2;   //already_added
		}
		
		echo json_encode($data_array);
		exit;
	}
	
	function not_available_check_outside()
	{		
		$loggedUserId = $this->getUserId();
		
		//echo print_r($_POST); 
	
		$email = $_POST['email'];
		$start_date = $_POST['start_date'];
		$start_time = $_POST['start_time'];
		$start_time = date("H:i:s", strtotime('+30 minutes', strtotime($start_time)));
		
		$date = date('Y-m-d H:i:s',strtotime($start_date.' '.$start_time));
		
		$data_array = [];
		$data_array['available'] = 1;   // available
		
				
			$this->db->select("*");
			$this->db->where("u.email", $email);	
			$qry = $this->db->get('anb_crm_users u');
			$res = $qry->row_array();
			//echo print_r($res); 
			if(!empty($res))
			{
				$this->db->select("*");
				$this->db->where("una.user_id", $res['id']);	
				$this->db->where("una.start_date <=", $date);	
				$this->db->where("una.end_date >=", $date);	
				$qry = $this->db->get('anb_crm_users_not_available una');
				$res1 = $qry->result_array();
				//echo print_r($res1); 
				if(!empty($res1))
				{
					$data_array['available'] = 0;   //not_available
				}			
			}		
		
		echo json_encode($data_array);
		exit;
	}
	
	function hex2rgba( $color, $opacity = false )
	{
		$default = 'rgb( 0, 0, 0 )';
	 
		/**
		 * Return default if no color provided
		 */
		if( empty( $color ) ) {
	 
					return $default; 
		
		}
	 
		/**
		 * Sanitize $color if "#" is provided
		 */
			if ( $color[0] == '#' ) {
	 
				$color = substr( $color, 1 );
	 
			}
	 
			/**
			 * Check if color has 6 or 3 characters and get values
			 */
			if ( strlen($color) == 6 ) {
	 
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	 
			} elseif ( strlen( $color ) == 3 ) {
	 
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	 
			} else {
	 
					return $default;
	 
			}
	 
			/**
			 * [$rgb description]
			 * @var array
			 */
			$rgb =  array_map( 'hexdec', $hex );
	 
			/**
			 * Check if opacity is set(rgba or rgb)
			 */
			if( $opacity ) {
	 
				if( abs( $opacity ) > 1 )
	 
				$opacity = 1.0;
	 
				$output = 'rgba( ' . implode( "," ,$rgb ) . ',' . $opacity . ' )';
	 
			} else {
	 
				$output = 'rgb( ' . implode( "," , $rgb ) . ' )';
				
			}
	 
			/**
			 * Return rgb(a) color string
			 */
			return $output;
	}

	public function index() 
	{				
		//date_default_timezone_set("Asia/Kolkata");
		//echo date_default_timezone_get(); die;
		
		$loggedUserId = $this->getUserId();
		
		$own_data = $this->UserModel->loadUser($loggedUserId);
		
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
		$this->data["page"] = ($this->getPost("page") != '') ? $this->getPost("page") : 1;
		
		if($this->getPost("user")!='')
		{
			//echo '<pre>';print_r($this->getPost("user")); //die;  	
			$users = $this->getPost("user");
			$user_array = explode(',',$users);
			//echo '<pre>';print_r($user_array); //die;  				
		}
		else
		{
			$user_array = [];
			$user_array[] = $this->data["own"];
		}
		$this->data["user_array"] = $user_array;
			
		$own_check = false;
		$this->data["optional_users_list"] = $this->ModuleModel->loadOptionalUsersList(1, $loggedUserId); 
		//echo '<pre>';print_r($this->data["optional_users_list"]);die;  
		if(!$this->isSuperAdmin())
		{
			foreach($this->data["optional_users_list"] as $oplist)
			{
				if($this->data["own"]==$oplist['id'])
				{
					$own_check = true;
				}	
			}	
		
			if($own_check == false)
			{
				redirect(base_url().'index.php/booking');
				exit;
			}
		}
		
		$events = [];
		
		$this->data["notavailable"] = $this->BookingModel->loadNotAvailableList($user_array);		
		foreach($this->data["notavailable"] as $booking )
		{
			$agenda = array();		
			//$agenda['allDay'] = true;
			$agenda['start'] = $booking['start_date'];
			$agenda['end'] = $booking['end_date'];
			$agenda['title'] = 'Not Available';
			$agenda['type'] = 'not_available';
			
			
			$agenda['loggedUserId'] = $loggedUserId;
			$agenda['id'] = $booking['id'];
			$agenda['user_id'] = $booking['user_id'];
			$agenda['start_date'] = date('Y-m-d',strtotime($booking['start_date']));
			$agenda['start_time'] = date('H:i',strtotime($booking['start_date']));
			$agenda['end_date'] = date('Y-m-d',strtotime($booking['end_date']));
			$agenda['end_time'] = date('H:i',strtotime($booking['end_date']));
			
			$agenda['reason'] = $booking['reason'];
			$agenda['visible'] = $booking['visible'];
			
	
			$agenda['backgroundColor'] = '#039BE5';	 
	
			$events[] = $agenda;
		}
		
		$this->data["holidays"] = $this->HolidaysModel->loadHolidaysList();		
		foreach($this->data["holidays"] as $booking )
		{
			$agenda = array();		
			$agenda['allDay'] = true;
			$agenda['start'] = $booking['date'];
			$agenda['end'] = $booking['date'];
			$agenda['title'] = $booking['holiday'].' (Holiday)';
			$agenda['type'] = 'holiday';
	
			$agenda['backgroundColor'] = '#ec7878';	   // red
	
			$events[] = $agenda;
		}
		
		
		$this->data["guest_booking"] = $this->BookingModel->loadBookingsForGuestCalender($user_array);
		
		//echo '<pre>';print_r($this->data["guest_booking"]); //die;      
		
		$this->data["bookings"] = $this->BookingModel->loadBookingsForCalender($user_array,null);
		
		//echo '<pre>';print_r($this->data["bookings"]);die;     
		
		$bookings_result = array_merge_recursive($this->data["bookings"], $this->data["guest_booking"]);

		//echo '<pre>';print_r($bookings_result);die;     
		
		foreach($bookings_result as $booking)
		{
			$agenda = array();
			$agenda['module_id'] = $booking['booking_module_id'];
			if($agenda['module_id']==1)
			{
				$module = "(L)";
			}
			else
			{
				$module = "(C)";
			}
			
			$agenda['booking_id'] = $booking['booking_id'];
			$agenda['booking_title'] = $booking['booking_title'];
			$agenda['google_event_id'] = $booking['google_event_id'];
			$agenda['allDay'] = false;
			$agenda['start'] = $booking['booking_date'];
			$agenda['end'] = $booking['booking_date'];
			$agenda['title'] = $booking['value']." ".$module;
			$agenda['all_day'] = $booking['all_day'];
			$agenda['repeat'] = $booking['repeat'];
			$agenda['availability'] = $booking['availability'];
			$agenda['visibility'] = $booking['visibility'];
			$agenda['color'] = $booking['color'];
			$agenda['notify_by'] = json_decode($booking['notify_by']);
			$agenda['notify_before'] = json_decode($booking['notify_before']);
			$agenda['notify_on'] = json_decode($booking['notify_on']);
			$agenda['notes'] = $booking['notes'];
			
			$agenda['modify_event'] = $booking['guest_can_modify_event'];
			$agenda['invite_others'] = $booking['guest_can_invite_others'];
			$agenda['see_guest_list'] = $booking['guest_can_see_guest_list'];
			
			$invites = $this->BookingModel->get_invitees_by_booking_id($agenda['booking_id']);
			$agenda['invites'] = $invites;	
			
		
			$day = date("l", strtotime($booking["booking_date"]));
			$date = date("d-m-Y", strtotime($booking["booking_date"]));
			$time = date("h:ia", strtotime($booking["booking_date"]));
			
			//date_default_timezone_set("Asia/Kolkata");
			
			$date1 = date('Y-m-d H:i:s');
			//$date1 = date('Y-m-d H:i:s',strtotime('+5 hour +30 minutes',strtotime($date1)));
			$date2 = date('Y-m-d H:i:s',strtotime($date.' '.$time));
				
			$st = '';
			if($booking['status']==0)
			{			
				if(strtotime($date2) < strtotime($date1))
				{
					$agenda['backgroundColor'] =  '#b8d7e2';    // faded blue 
				}
				else
				{
					$agenda['backgroundColor'] =  $booking['color']!="" ? $booking['color'] : '#57c8f1';    // blue
				}				
				$st = 'Awaiting for confirmation';
			}
			else if($booking['status']==1)
			{
				if(strtotime($date2) < strtotime($date1))
				{
					$agenda['backgroundColor'] =   '#8ae0dc';    // faded green 
				}
				else
				{
					$agenda['backgroundColor'] = $booking['color']!="" ? $booking['color'] : '#1fb5ad';    // green
				}				
				
				$st = 'Confirmed';
			}
			else if($booking['status']==2)
			{
				if(strtotime($date2) < strtotime($date1))
				{
					$agenda['backgroundColor'] =  '#ecc3c3';    // faded red
				}
				else
				{
					$agenda['backgroundColor'] = $booking['color']!="" ? $booking['color'] : '#ec7878';	   // red
				}				
				
				$st = 'Cancelled';
			}
			
			//$agenda['description'] = 'Status: '.$st.' || Booking Date: '.$date.' || Booking Time:  '.$time.' || Name: '.$booking['name'].' || Email: '.$booking['email'];
			//$agenda['description'] = $st.' || '.$date.' || '.$time.' || '.$booking['name'].' - '.$booking['email'];
			
			if($booking['all_day']==1)
			{
				$endtime = date('h:ia',strtotime('+23 hour +59 minutes',strtotime($time)));
				$all_day = '(All Day)';
			}
			else
			{
				$endtime = date('h:ia',strtotime('+30 minutes',strtotime($time)));
				$all_day = '';
			}
			
			$description = '';
						
			$description .= '<div class="row" style="margin-left: 0px;"><label>Booking Title: </label> <span class="sname">'.$booking['booking_title'].'</span></div>';
			
			$description .= '<div class="row" style="margin-left: 0px;"><label>Booking Status: </label> <span class="sname">'.$st.'</span></div>';
			
			$description .='<div class="row"  style="margin-left: 0px;"><label>Booking Date: </label> <span class="stime">'.$day.', '.$date.'</span></div>';
			
			$description .='<div class="row"  style="margin-left: 0px;"><label>Booking Time: </label> <span class="stime">'.$time.' - '.$endtime.' '.$all_day.'</span></div><hr class="hr-4">';
			
			$description .= '<div class="row"  style="margin-left: 0px;"><label>Name: </label> <span class="tname">'.$booking['name'].'</span></div>';
			
			$description .= '<div class="row"  style="margin-left: 0px;"><label>Email: </label> <span class="rmno">'.$booking['email'].'</span></div>';
		
			$agenda['description'] = $description;			
			$agenda['status'] = $st;			
			$agenda['start_date'] = date("Y-m-d", strtotime($booking["booking_date"]));
			$agenda['start_time'] = date("H:i", strtotime($booking["booking_date"]));
			$agenda['end_date'] = $date;			
			$agenda['end_time'] = $endtime;	
		
			$agenda['type'] = 'booking';				
			$agenda['own_email'] = $own_data['email'];
			
		
			$events[] = $agenda;
		}
		
		$this->data["users_list"] = $this->ModuleModel->loadUsersList(); 
		
		$this->data["events"] = json_encode($events);
		//echo '<pre>';print_r($events);die;      

		$this->data["page"] = "booking";
		$this->viewLoad("booking/booking");
	}
	
	public function bookNow()
	{
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		$loadViewWithData = true;
 
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			//echo print_r($_POST); exit;
			$booking_date = date('Y-m-d H:i',strtotime($_POST['selected_date'].' '.$_POST['selected_time']));
			$booking = $this->BookingModel->loadBookingsList(null, $_POST["current_record_id"], $_POST["email"], $booking_date);
			if(empty($booking))
			{								
				$bookingId = $this->BookingModel->addBooking();
				//echo 'bookingId ';print_r($bookingId); //exit;					
				if($bookingId)
				{					
					$current_record_data = $this->BookingModel->get_record_data_by_id($_POST["current_record_id"]);		
					//echo 'current_record_data ';print_r($current_record_data); //exit;	
					if($this->isSuperAdmin())
					{
						$loggedinUserId = $this->getUserId();						
						$receiver_id = $current_record_data['assigned_officer_id'];
					}
					else
					{
						$loggedinUserId = $this->getUserId();			
						$receiver_id = 1;											
					}						
					//echo "loggedinUserId ";print_r($loggedinUserId); //exit;	
					//echo "receiver_id ";print_r($receiver_id); //exit;										
					$notifyData = array(
						"record_id" => $_POST["current_record_id"],
						"booking_id" => $bookingId,
						"sender_id" => $loggedinUserId,
						"receiver_id" => $receiver_id,
						"title" => "New booking received",
						"description" =>  $this->getPost("booking_title").' on '.date('m/d/Y',strtotime($this->getPost("selected_date"))).' at '.date('h:ia',strtotime($this->getPost("selected_time"))),
						"read" => 0, //0=new booking
						"created_time" =>date('Y-m-d H:i:s'),				
						"modified_time" =>date('Y-m-d H:i:s'),													
					);
					$noti = $this->BookingModel->add_notification($notifyData);
					
					
					$booking = $this->BookingModel->loadBookingById($bookingId);							
					//echo 'booking ';print_r($booking); exit;
					$_SESSION['booking_data'] = $booking;
					//google calender booking sync start
					$googleEvent = $this->addEventToGoogleCalendar();						
					//google calender booking sync end
	
	
					$fromEmail = COMPANY_NOREPLY_EMAIL; 					
					$fromName = COMPANY_NAME; 					
						
					//$toEmail = "harpreetclerisy@gmail.com";
					$toEmail = trim($this->getPost("email"));
					$toName = $this->getPost("full_name");			
							
					$data = array(
						'booking_date' => date('m/d/Y',strtotime($this->getPost("selected_date"))),
						'booking_time' => date('h:ia',strtotime($this->getPost("selected_time"))),
						'name' => $this->getPost("full_name"),
						'email' => $this->getPost("email"),
						'current_module' =>$this->getPost("current_module"),
						'current_record_id' => $this->getPost("current_record_id"),
						'record_status' => $this->getPost("recordStatus"),									
						'bookingId' => $bookingId,
						'status' => 0,		//new				 				
					);
					$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);
						
					//echo $emailTemplate; die;
					
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					$headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
					$headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
					$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
					$headers .= 'X-Mailer: PHP/' . phpversion(); 
					$title = 'Booking Done, Awaiting for confirmation.';

					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);	
					
					if(mail($toEmail,$title,$emailTemplate,$headers))
					{
						echo 'sent';	
					}
					else
					{
						echo 'not_sent';	
					} 
					
					$invited_by = $created_by = $modified_by = $this->getUserId();						
					$email = $this->getPost("email");
					$guest_data = $this->BookingModel->get_guest_name_by_email_user($email); 							
					if(!empty($guest_data))
					{
						$guest_name = $guest_data['first_name'].' '.$guest_data['last_name'];
					}
					else
					{
						$guest_name = '';
					}						
					
					//$guest_name = $this->BookingModel->get_guest_name_by_email_client($email); 		
					
					$this->db->select('*');
					$this->db->where('booking_id', $bookingId);
					$this->db->where('guest', trim($email));
					$qry = $this->db->get('anb_crm_bookings_guests');     
					$ret = $qry->row_array();
					if(empty($ret))
					{
						$guestdata = array(
							'booking_id' => $bookingId,
							'guest' => trim($email),
							'guest_name' => $guest_name,
							'status' => 0,  //0=just invited, 1= going, 2=maybe, 3 = not going
							'invited_by' => $invited_by,
							'created_by' => $created_by,
							'modified_by' => $modified_by,
							'created_time' => date('Y-m-d H:i:s'),
							'modified_time' => date('Y-m-d H:i:s'),									
						);
						
						$this->db->insert("anb_crm_bookings_guests", $guestdata);								
						
						$fromEmail = COMPANY_NOREPLY_EMAIL; 					
						$fromName = COMPANY_NAME; 					
							
						//$toEmail = "harpreetclerisy@gmail.com";
						$toEmail = trim($email);
						$toName = "Guest";			
								
						$booking_title = $this->getPost("booking_title");		
						$data = array(
							'booking_id' => $bookingId,
							'booking_date' => date('m/d/Y',strtotime($_POST['selected_date'])),						
							'booking_time' => date('H:ia',strtotime($_POST['selected_time'])),						
							'booking_title' => $booking_title,
							'email' => $email,									
							'all_email' => $email,									
							'status' => $guestdata['status'],		
						);
						$emailTemplate = $this->load->view('emails/meeting_invitation',$data,true);
							
						//echo $emailTemplate; die;
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
						$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
						$headers .= 'X-Mailer: PHP/' . phpversion(); 
						$title = 'Invitation: '.$booking_title.' - '.$data['booking_date'];

						$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);	
						
						if(mail($toEmail,$title,$emailTemplate,$headers))
						{
							echo 'sent';	
						}
						else
						{
							echo 'not_sent';	
						} 
						
					}														
					
					
					exit;
				}
				else
				{                
						echo false;
						exit;
				}
					
			}
			else
			{
				echo 'booking_already_exists';	
				exit;
			}		
		}
		
		$this->data["recordStatus"] = ($this->getPost("record_status") != '') ? $this->getPost("record_status") : $RECORD_STATUS['CYCLE_RUNNING'];
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["current_record_id"] = $this->getPost("id");
		
		//$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
		$this->data["FIELD_TYPE"] = $FIELD_TYPE;
		$this->data["record_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"]);
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data["notes"] = $this->ModuleModel->loadNotes();
		$this->data["attachments"] = $this->ModuleModel->loadAttachments();
		$this->data["activities"] = $this->ActivitiesModel->loadActivitiesList(null, $this->data["current_record_id"]);
		if ($this->data["current_module"] == 'Clients'){
				$this->data["contracts"] = $this->ModuleModel->loadContracts();
		}
		if ($this->data["current_module"] == CONTRACTS_PLURAL_NAME) {
				$this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
		}
            
            
    //echo '<pre>';print_r($this->data);die;        
            
  
		$this->data["page"] = "booknow";
		$this->viewLoad("booking/booknow");			
	}
	
	function getEventFromGoogleCalendar()
	{
		
		//$timezone = date_default_timezone_get();
		//$timezone = 'America/Toronto';
		$timezone = 'Asia/Kolkata';

		require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';

		$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

		$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';

		$client = new Google_Client(); //AUTHORIZE OBJECTS
		$client->setApplicationName("Anbruch");

		$client->setAuthConfig($key_file_location);

		$client->addScope(Google_Service_Calendar::CALENDAR);

		$client->setSubject($service_account_name);

		$service = new Google_Service_Calendar($client);
		
		$calendarList = $service->calendarList->listCalendarList();
		
		echo '<pre>';print_r($calendarList);	
		die;
		while(true)
		{
			foreach ($calendarList->getItems() as $calendarListEntry)
			{
				echo $calendarListEntry->getSummary();
			}
			$pageToken = $calendarList->getNextPageToken();
			echo '<pre>';print_r($pageToken);	
			if ($pageToken)
			{
				$optParams = array('pageToken' => $pageToken);
				$calendarList = $service->calendarList->listCalendarList($optParams);
				
				echo '<pre>';print_r($calendarList);	 
				
				echo 'yes data found';
				
			}
			else
			{
				echo 'no data found';
				break;
			}
		}

		
	}
	
	function addEventToGoogleCalendar()
	{
		$booking_data = $_SESSION['booking_data'];
		
		//echo '<pre>';print_r($booking_data);	
		
		$summary = $booking_data['value'].' - Awaiting for confirmation';

		//$location = $booking_data['collection1_address'].' '.$booking_data['collection_suburb'];
		
		$dateArr = explode(' ',$booking_data['booking_date']);
	
		$date = $dateArr[0].'T'.$dateArr[1];
		$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
	
		$description ='<br/><br/>Status: Awaiting for confirmation!';
		$description .='<br/><br/>Booking date: '. date( 'm/d/Y',strtotime($dateArr[0]) );
		$description .='<br/><br/>Booking time: '. date( 'h:i A',strtotime($dateArr[1]) );
		
		$description .='<br/><br/>Name: '.$booking_data['name'];
		$description .='<br/>Email: '.$booking_data['email'];

		$description .='<br/><br/>Powered by: anbruch.com';
		
		//$timezone = date_default_timezone_get();
		//$timezone = 'America/Toronto';
		$timezone = 'Asia/Kolkata';

		require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';

		$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

		$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';

		$client = new Google_Client(); //AUTHORIZE OBJECTS
		$client->setApplicationName("Anbruch");

		$client->setAuthConfig($key_file_location);

		$client->addScope(Google_Service_Calendar::CALENDAR);

		$client->setSubject($service_account_name);

		$service = new Google_Service_Calendar($client);

		$event = new Google_Service_Calendar_Event(array(
			'summary' => $summary,
			//'location' => $location,
			'description' => $description,
			'sendNotifications' => TRUE,
			'start' => array(
				'dateTime' => $date,
				'timeZone' => $timezone,
			),
			'end' => array(
				'dateTime' => $enddate,
				'timeZone' => $timezone,
			),
			'attendees' => array(
				array('email' => $booking_data['email']),
			),
			'reminders' => array(
				'useDefault' => FALSE,
				'overrides' => array(
					array('method' => 'email', 'minutes' => 24 * 60),
					array('method' => 'popup', 'minutes' => 10),
				),
			),
		));
		
		//clerisytest1- GOOGLE_CALENDAR_ID
    $google_calendar_id = '8v7230d98l4odaocl9rtajcr38@group.calendar.google.com';
    
		$event = $service->events->insert($google_calendar_id, $event);
		$event_id= $event->getId();
		
		 $recordData = array(
				"google_event_id" => $event_id,
		);
		$this->db->where('id', $booking_data['booking_id']);
		$this->db->update("anb_crm_bookings", $recordData);		
	}
	
	function updateEventToGoogleCalendar()
	{
		$booking_data = $_SESSION['booking_data'];
		
		echo '<pre>';print_r($booking_data);	
		if($booking_data['google_event_id']!='')
		{
			$summary = $booking_data['value'].' - Booking Confirmed';

			//$location = $booking_data['collection1_address'].' '.$booking_data['collection_suburb'];
			
			$dateArr = explode(' ',$booking_data['booking_date']);
		
			$date = $dateArr[0].'T'.$dateArr[1];
			$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
		
			$description ='<br/><br/>Status: Booking Confirmed!';
			$description .='<br/><br/>Booking date: '. date( 'm/d/Y',strtotime($dateArr[0]) );
			$description .='<br/><br/>Booking time: '. date( 'h:i A',strtotime($dateArr[1]) );
			
			$description .='<br/><br/>Name: '.$booking_data['name'];
			$description .='<br/>Email: '.$booking_data['email'];

			$description .='<br/><br/>Powered by: anbruch.com';
			
			//$timezone = date_default_timezone_get();
			//$timezone = 'America/Toronto';
			$timezone = 'Asia/Kolkata';

			require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';

			$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

			$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';
			
			$client = new Google_Client(); //AUTHORIZE OBJECTS
			$client->setApplicationName("Anbruch");

			$client->setAuthConfig($key_file_location);

			$client->addScope(Google_Service_Calendar::CALENDAR);

			$client->setSubject($service_account_name);

			$service = new Google_Service_Calendar($client);
			
			// First retrieve the event from the API.
			$event = $service->events->get('8v7230d98l4odaocl9rtajcr38@group.calendar.google.com', $booking_data['google_event_id']);

			$event->setSummary($summary);
			$event->setDescription($description);
			//$event->setStatus("confirmed");
			$event->setColorId(2);

			$updatedEvent = $service->events->update('8v7230d98l4odaocl9rtajcr38@group.calendar.google.com', $event->getId() , $event);

			// Print the updated date.
			$updated =  $updatedEvent->getUpdated();		
			echo '<pre>';print_r($updated);
		}
		
	}
	
	function cancelEventToGoogleCalendar()
	{
		$booking_data = $_SESSION['booking_data'];
		
		echo '<pre>';print_r($booking_data);	
		
		if($booking_data['google_event_id']!='')
		{		
			$summary = $booking_data['value'].' - Booking Cancelled';

			//$location = $booking_data['collection1_address'].' '.$booking_data['collection_suburb'];
			
			$dateArr = explode(' ',$booking_data['booking_date']);
		
			$date = $dateArr[0].'T'.$dateArr[1];
			$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
		
			$description ='<br/><br/>Status: Booking Cancelled!';
			$description .='<br/><br/>Booking date: '. date( 'm/d/Y',strtotime($dateArr[0]) );
			$description .='<br/><br/>Booking time: '. date( 'h:i A',strtotime($dateArr[1]) );
			
			$description .='<br/><br/>Name: '.$booking_data['name'];
			$description .='<br/>Email: '.$booking_data['email'];

			$description .='<br/><br/>Powered by: anbruch.com';
			
			//$timezone = date_default_timezone_get();
			//$timezone = 'America/Toronto';
			$timezone = 'Asia/Kolkata';

			require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';

			$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

			$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';
			
			$client = new Google_Client(); //AUTHORIZE OBJECTS
			$client->setApplicationName("Anbruch");

			$client->setAuthConfig($key_file_location);

			$client->addScope(Google_Service_Calendar::CALENDAR);

			$client->setSubject($service_account_name);

			$service = new Google_Service_Calendar($client);		
	
			// First retrieve the event from the API.
			$event = $service->events->get('8v7230d98l4odaocl9rtajcr38@group.calendar.google.com', $booking_data['google_event_id']);

			$event->setSummary($summary);
			$event->setDescription($description);
			//$event->setStatus("cancelled");
			$event->setColorId(6);

			$updatedEvent = $service->events->update('8v7230d98l4odaocl9rtajcr38@group.calendar.google.com', $event->getId() , $event);

			// Print the updated date.
			$updated =  $updatedEvent->getUpdated();		
			echo '<pre>';print_r($updated);
		}
		
	}
	
	public function bookDays()
	{	
		$datapassed = array(
			'from_date' => $_POST['from_date'],			
			'booking_date' => @$_POST['booking_date'],			
		);
		
		//echo print_r($datapassed);die;
		
		$res = $this->load->view('booking/bookdays',$datapassed, TRUE);
		echo $res;
		exit;
	}
	
	public function bookTimes()
	{
		$from_date = date("Y-m-d",strtotime($_POST['from_date']));		
		$from_date2 = date("Y-m-d H:i",strtotime($_POST['from_date']));		

		$bookingTimeNotAvailable = $this->BookingModel->checkBookingTimeNotAvailable($_POST["current_record_id"], $from_date);

		$ttm = [];
		if(!empty($bookingTimeNotAvailable))
		{
			$ttm = implode(',', array_map(function ($entry) {
				return trim($entry['time']);	
			}, $bookingTimeNotAvailable));

			$ttm = explode(',',trim($ttm));
		}
		
		$datapassed = array(
			'from_date' => $from_date2,			
			'bookingTimeNotAvailable' => $ttm,			
		);

		//echo "<pre>";print_r($ttm); ///die; 
		//echo print_r($datapassed);die;
		
		$res = $this->load->view('booking/booktimes',$datapassed, TRUE);
		echo $res;
		exit;
	}
	
	public function confirmBooking()
	{	
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		$loadViewWithData = true;
   
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			echo print_r($_POST); //exit;
			$bookings = $this->BookingModel->loadBookingsList($this->getPost("bookingId"), null, null);

			//echo '<pre>';print_r($bookings); die;

			if(!empty($bookings))
			{											
				$res = $this->BookingModel->confirmBooking();
				if($res)
				{				
					$bookingId = $this->getPost("bookingId");
					$current_record_data = $this->BookingModel->get_record_data_by_id($_POST["current_record_id"]);		
					echo print_r($current_record_data); //exit;	
					if($this->isSuperAdmin())
					{
						$loggedinUserId = $this->getUserId();						
						$receiver_id = $current_record_data['assigned_officer_id'];
					}
					else
					{
						$loggedinUserId = $this->getUserId();			
						$receiver_id = 1;											
					}						
					echo print_r($loggedinUserId); //exit;	
					echo print_r($receiver_id); //exit;	
					$notifyData = array(
								"record_id" => $_POST["current_record_id"],
								"booking_id" => $bookingId,
								"sender_id" => $loggedinUserId,
								"receiver_id" => $receiver_id,
								"title" => "Booking confirmed",
								"description" =>  $this->getPost("booking_title").' on '.date('m/d/Y',strtotime($this->getPost("selected_date"))).' at '.date('h:ia',strtotime($this->getPost("selected_time"))),
								"read" => 0, //0=new booking
								"created_time" =>date('Y-m-d H:i:s'),				
								"modified_time" =>date('Y-m-d H:i:s'),													
							);
							$noti = $this->BookingModel->add_notification($notifyData);
							
					$booking = $this->BookingModel->loadBookingById($bookingId);							
					//echo '<pre>';print_r($booking);
					$_SESSION['booking_data'] = $booking;
					//google calender booking sync update start
					$googleEvent = $this->updateEventToGoogleCalendar();						
					//google calender booking sync update end
					
					
					$fromEmail = COMPANY_NOREPLY_EMAIL; 					
					$fromName = COMPANY_NAME; 					
						
					//$toEmail = "harpreetclerisy@gmail.com";
					$toEmail = $bookings[0]["email"];
					$toName = $bookings[0]["name"];			
							
					$data = array(
						'booking_date' => date('m/d/Y',strtotime($bookings[0]["booking_date"])),
						'booking_time' => date('h:ia',strtotime($bookings[0]["booking_date"])),
						'name' => $bookings[0]["name"],
						'email' => $bookings[0]["email"],
						'current_module' =>!empty($this->getPost("current_module")) ? $this->getPost("current_module") : '',
						'current_record_id' => !empty($this->getPost("current_record_id")) ? $this->getPost("current_record_id"): '',
						'record_status' => !empty($this->getPost("recordStatus")) ? $this->getPost("recordStatus") : '',									
						'bookingId' => $bookings[0]["id"],								
						'status' => 1,	  //confirmed
					);
					$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);
						
					//echo $emailTemplate; die;
					
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						$headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
						$headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";
						$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
						$headers .= 'X-Mailer: PHP/' . phpversion();
				
					$title = 'Booking Confirmed.';

					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);	
					
					if(mail($toEmail,$title,$emailTemplate,$headers))
					{
						echo 'sent';	
					}
					else
					{
						echo 'not sent';	
					}
					
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
				echo 'no_booking_found';
				exit;
			}
		}

	}
	
	public function cancelBooking()
	{	
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		$loadViewWithData = true;
        
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			//echo print_r($_POST); exit;
			$bookings = $this->BookingModel->loadBookingsList($this->getPost("bookingId"), null, null);
				//echo '<pre>';print_r($bookings); die;

			if(!empty($bookings))
			{							
				$res = $this->BookingModel->cancelBooking();
				if($res)
				{				
					$bookingId = $this->getPost("bookingId");
					
					$current_record_data = $this->BookingModel->get_record_data_by_id($_POST["current_record_id"]);		
				echo print_r($current_record_data); //exit;	
				if($this->isSuperAdmin())
				{
					$loggedinUserId = $this->getUserId();						
					$receiver_id = $current_record_data['assigned_officer_id'];
				}
				else
				{
					$loggedinUserId = $this->getUserId();			
					$receiver_id = 1;											
				}						
				echo print_r($loggedinUserId); //exit;	
				echo print_r($receiver_id); //exit;	
				$booking = $this->BookingModel->loadBookingById($bookingId);		

						$notifyData = array(
								"record_id" => $_POST["current_record_id"],
								"booking_id" => $bookingId,
								"sender_id" => $loggedinUserId,
								"receiver_id" => $receiver_id,
								"title" => "Booking cancelled",
								"description" =>  $booking["booking_title"].' on '.date('m/d/Y',strtotime($booking["booking_date"])).' at '.date('h:ia',strtotime($booking["selected_time"])),
								"read" => 0, //0=new booking
								"created_time" =>date('Y-m-d H:i:s'),				
								"modified_time" =>date('Y-m-d H:i:s'),													
							);
							$noti = $this->BookingModel->add_notification($notifyData);
					
					$booking = $this->BookingModel->loadBookingById($bookingId);							
					//echo '<pre>';print_r($booking);
					$_SESSION['booking_data'] = $booking;
					//google calender booking sync update start
					$googleEvent = $this->cancelEventToGoogleCalendar();						
					//google calender booking sync update end
					
					
					$fromEmail = COMPANY_NOREPLY_EMAIL; 					
					$fromName = COMPANY_NAME; 					
						
					//$toEmail = "harpreetclerisy@gmail.com";
					$toEmail = $bookings[0]["email"];
					$toName = $bookings[0]["name"];			
							
					$data = array(
						'booking_date' => date('m/d/Y',strtotime($bookings[0]["booking_date"])),
						'booking_time' => date('h:ia',strtotime($bookings[0]["booking_date"])),
						'name' => $bookings[0]["name"],
						'email' => $bookings[0]["email"],
						'current_module' =>!empty($this->getPost("current_module")) ? $this->getPost("current_module") : '',
						'current_record_id' => !empty($this->getPost("current_record_id")) ? $this->getPost("current_record_id"): '',
						'record_status' => !empty($this->getPost("recordStatus")) ? $this->getPost("recordStatus") : '',									
						'bookingId' => $bookings[0]["id"],								
						'status' => 2,	  //cancelled
					);
					$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);
						
					//echo $emailTemplate; die;
					
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						$headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
						$headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";
						$headers .= 'Reply-To: '. $toEmail . "\r\n" ; 
						$headers .= 'X-Mailer: PHP/' . phpversion();
				
					$title = 'Booking Cancelled.';

					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);						
					
					if(mail($toEmail,$title,$emailTemplate,$headers))
					{
						echo 'sent';	
					}
					else
					{
						echo 'not sent';	
					}
					
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
				echo 'no_booking_found';
				exit;
			}
		}
		
		$this->data["recordStatus"] = ($this->getPost("record_status") != '') ? $this->getPost("record_status") : $RECORD_STATUS['CYCLE_RUNNING'];
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["current_record_id"] = $this->getPost("id");
		$this->data["bookingId"] = $this->getPost("bookingId");
		$booking = $this->BookingModel->loadBookingsList($this->getPost("bookingId"), $this->getPost("current_record_id"));
		if(!empty($booking) && $booking['status']==2)
		{
			 redirect(base_url().'index.php/modules/viewRecord/?cm='.$this->data["current_module"].'&id='.$this->data["current_record_id"].'&record_status='.$this->data["recordStatus"]);
			 exit;
		}
		
		
						$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
            $this->data["FIELD_TYPE"] = $FIELD_TYPE;
            $this->data["record_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"]);
            $this->data["users_list"] = $this->ModuleModel->loadUsersList();
            $this->data["notes"] = $this->ModuleModel->loadNotes();
            $this->data["attachments"] = $this->ModuleModel->loadAttachments();
            $this->data["activities"] = $this->ActivitiesModel->loadActivitiesList(null, $this->data["current_record_id"]);
            if ($this->data["current_module"] == 'Clients'){
                $this->data["contracts"] = $this->ModuleModel->loadContracts();
            }
            if ($this->data["current_module"] == CONTRACTS_PLURAL_NAME) {
                $this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
            }
            
            
    //echo '<pre>';print_r($this->data);die;        
            
  
		$this->data["page"] = "booknow";
		$this->viewLoad("booking/cancelbooking");			
	}
	
	public function sendemailtest()
	{	
		$fromEmail = "helpcenter@anbruch.com"; 					
		$fromName = 'harp saini'; 					
		
		$toEmail = "harpreetclerisy@gmail.com";
		$toName = "harp cle";
		
		//$emailTemplate = 'Hello <b>'.$toName.'</b><br><br>';
		//$emailTemplate .= 'You received a message on from <b>'.$fromName.'</b>. Message details are below:<br><br>';
		
		//$emailTemplate .= 'Message: Booking confirmed<br><br>';

					
		//$emailTemplate .= 'Regards<br>';
		//$emailTemplate .= 'test.net<br>';
		
		$data = array(
									'booking_date'=>date('d-m-Y'),
									'booking_time'=>date('H:i:s'),
									'name'=>'singga',
									'email'=>'singga@yopmail.com',
									'current_module'=>'Leads',
									'current_record_id'=>'6377',
									'record_status'=>'3',									
								);
		$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);
		
		//echo $emailTemplate; die;
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
		$title = 'Booking Confirmed.';

		$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);		
		
		if(mail($toEmail,$title,$emailTemplate,$headers))
		{
		  echo 'sent';	
		}
		else
		{
			echo 'not sent';	
		}
		
		die('-----end');
		
	}
		
}
