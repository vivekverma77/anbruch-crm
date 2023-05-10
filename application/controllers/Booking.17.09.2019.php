<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';

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
      $this->load->model("App_model");
      $this->load->model("LogsModel");
      $this->load->library('email');
			$smtpconfig = $this->config->item('email');
			$this->email->initialize($smtpconfig);
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
			//echo '<pre>'; print_r($_POST); //die;
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
						$googleEvent = $this->addEventToGoogleCalendar();				//depricated
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

						//~ $headers  = 'MIME-Version: 1.0' . "\r\n";
						//~ $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						//~ $headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
						//~ $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
						//~ $headers .= 'X-Mailer: PHP/' . phpversion();
						$title = 'Booking updated.';

						$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

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

						//~ if(mail($toEmail,$title,$emailTemplate,$headers))
						//~ {
							//~ echo 'sent';
						//~ }
						//~ else
						//~ {
							//~ echo 'not_sent';
						//~ }

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
		$smtpconfig = $this->config->item('email2');
		$this->email->initialize($smtpconfig);	
		$jobData = $this->input->post();
		if(isset($jobData['dragEvent']))
		{
			if(!empty($jobData['start_date']) &&  !empty($jobData['start_time']))
			{
				$updated_time = date('Y-m-d',strtotime($jobData['start_date'])).' '.date('H:i:s', strtotime($jobData['start_time']));
				$current_time = date('Y-m-d H:i:s');
				if($current_time > $updated_time)
				{
					$result = array("message" => "Booking can not be updated in past.",
									"success" => false);
					echo json_encode($result); die();
				}
				
			}

			$booking_id = $jobData['booking_id'];
			$record_id = $jobData['record_id'];
			$booking_date = $jobData['start_date'].' '.$jobData['start_time'];
			$end_date = $jobData['end_date'].' '.$jobData['end_time'];
			$email = $jobData['email'];
			
			$status = $this->App_model->rowUpdate('anb_crm_bookings',array('booking_date' => $booking_date, 'end_date' => $end_date,'status' => 0,'update_status' => date('Y-m-d H:i:s')), array('id' => $booking_id));
			
			if($status)
			{
				$res = $this->App_model->getData('anb_crm_bookings', array('*'), array('id' => $booking_id));
				
				$this->session->set_flashdata('success',"Booking updated successfully.");
				
				$fromEmail = COMPANY_NOREPLY_EMAIL;
				$fromName = COMPANY_NAME;

				$toEmail = trim($email);
				$toName = "Guest";

				$booking_title = $res[0]['booking_title'];
				$data = array(
					'heading_text' => 'Booking Rescheduled',
					'booking_id' => $booking_id,
					'booking_date' => date('m/d/Y',strtotime($res[0]['booking_date'])),
					'booking_time' => date('h:ia',strtotime($res[0]['booking_date'])),
					'end_date' => date('m/d/Y',strtotime($res[0]['end_date'])),
					'end_time' => date('h:ia',strtotime($res[0]['end_date'])),
					'booking_title' => $booking_title,
					'notes' => isset($res[0]['notes']) ? $res[0]['notes'] : '',
					'name' => $res[0]['name'],
					'email' => $res[0]['email'],
					'current_module' => '',
					'current_record_id' => !empty($res[0]['record_id']) ? $res[0]['record_id'] : '',
					'record_status' => '',
					'bookingId'	=> 	$booking_id,
					'status' => $res[0]['status'],
					'conference'=>$res[0]['conference'],
					'address'=>$res[0]['booking_address'],
				);
				$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);

				if($data['status']==1)
				{
					$heading = 'Booking Confirmed';
				}
				else if($data['status']==2)
				{
					$heading = 'Booking Cancelled';
				}
				else if($data['status'] ==0)
				{
					$heading = 'Awaiting for confirmation';
				}
				$title = $heading.' - Booking Updated';
				$this->ModuleModel->saveEmail('',$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

					$this->email->from($fromEmail);
					$this->email->to($toEmail);
					$this->email->subject($title);
					$this->email->message($emailTemplate);
					if($this->email->send())
				  	{
				 	}
					else
					{
					}
					$result = array("message" => "Booking Updated successfully",
									"success" => true);
			}
			else{
				$result = array("message" => "Something went wrong",
									"success" => false);
			}			
			echo json_encode($result); die();
		}
		$st = date('Y-m-d H:i:s',strtotime($this->getPost('start_date').' '.$this->getPost("start_time")));
		$et = date('Y-m-d H:i:s',strtotime($this->getPost("end_date").' '.$this->getPost("end_time")));
		if($st >= $et)
		{
			$result['message'] = 'Invalid Booking Schedule time';
   			$result['success'] = false;
   			$this->session->set_flashdata('error',"Invalid Booking Schedule time");
   			echo json_encode($result); die(); 
		}
		if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via']) && $jobData['notification_interval']!=null){
            $notification_interval = $jobData['notification_interval'];

	            	switch ($this->getPost("all_day")){
	            		case null:
	            			switch ($jobData['notification_type']){
			                     case 1:
			                          $notification = array(
			                                  
			                                  'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])-60*60*$notification_interval),
			                                  'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
			                      break;
			                      case 2:   
			                            $date = date_create($jobData['start_date']);
			                            date_sub($date, date_interval_create_from_date_string($notification_interval.' days'));
			                            $notification = array(
			                                 
			                                  'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])),
			                                  'notification_date'=> date_format($date, 'Y-m-d'),);                                       
			                      break;
			                    }
	            			break;
	            		
	            		case 1:
	            			switch ($jobData['notification_type']){
			                      case 1:
			                          $notification = array(
			                                  
			                                  'notification_time'=> date("H:i:s",strtotime('11:00:00')),
			                                  'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
			                      break;
			                      case 2:   
			                            $date = date_create($jobData['start_date']);
			                            date_sub($date, date_interval_create_from_date_string($notification_interval.' days'));
			                            $notification = array(
			                                 
			                                  'notification_time'=> date("H:i:s",strtotime('11:00:00')),
			                                  'notification_date'=> date_format($date, 'Y-m-d'),);                                       
			                      break;
			                    }	
			            break;
	            		}
	                }
	          /*Send Notification end*/      
	        $invited_by = $created_by = $modified_by = $this->getUserId();

			$booking_id = $this->getPost('booking_id');
			$current_record_id =$this->getPost('record_id');
			$google_event_id = $this->getPost('google_event_id');
			$booking_title = $this->getPost('booking_title');
			$title = $this->getPost('title');
			$email =$this->getPost('email');
			$status =$this->getPost('status');
			$start_time = $this->getPost('start_time');
			if(isset($_POST['all_day']) && !empty($_POST['all_day']))
			{
				if($_POST['all_day']==1)
				{
					$all_day = 1;
					$start_time = '00:00:00';
					//$end_time = 00:00:00';
				}
				else
				{
					$all_day = 0;
					$start_time = $this->getPost('start_time');
					//$end_time = $_POST['end_time'];
				}
			}
			if(isset($status) && !empty($status))
			{
				if($status == "Awaiting for confirmation")
				{
					$status = 0;
				}
				else if($status == "Cancelled")
				{
					$status = 2;
				}
				else
				{
					$status = 1;
				}
			}
			// $start_date = $_POST['start_date'].' '.$start_time;
			//$end_date = $_POST['end_date'];

			//$repeat = $_POST['repeat'];
			//$availability = $_POST['availability'];
			$visibility = $_POST['visibility'];
			//$color = $_POST['color'];
			$notes = $_POST['notes'];

			// if(!empty($_POST['notify_by']))
			// {
			// 	$notify_by = json_encode($_POST['notify_by']);
			// 	$notify_before = json_encode($_POST['notify_before']);
			// 	$notify_on = json_encode($_POST['notify_on']);
			// }
			// else
			// {
			// 	$notify_by = '';
			// 	$notify_before = '';
			// 	$notify_on = '';
			// }


			// $correct_email = [];
			// if(!empty($_POST['invite']))
			// {
			// 	$invites =$_POST['invite'];
			// 	foreach($invites as $email)
			// 	{
			// 		if($email!="" && filter_var($email, FILTER_VALIDATE_EMAIL))
			// 		{
			// 			$correct_email[] = $email;
			// 		}
			// 	}
			// }

			// if(!empty($correct_email))
			// {
			// 	$final_invites = json_encode($correct_email);
			// }
			// else
			// {
			// 	$final_invites = '';
			// }
			$recordData = array(
				'booking_date' => date('Y-m-d H:i:s',strtotime($this->getPost('start_date').' '. $start_time)),
				'end_date' => date('Y-m-d H:i:s',strtotime($this->getPost("end_date").' '.$this->getPost("end_time"))),
				'booking_title' => $booking_title,
				'all_day' => isset($all_day) && !empty($all_day) ? $all_day : '',
				'booking_address' => $this->getPost('event_location'),
				//'repeat' => $repeat,
				//'availability' => $availability,
				'visibility' => $visibility,
				//'color' => $color,
				'notes' => $notes,
				//'notify_by' => $notify_by,
				//'notify_before' => $notify_before,
				//'notify_on' => $notify_on,
				//'guest_can_modify_event' => $_POST['modify_event']=='on' ? 1 :0 ,
				//'guest_can_invite_others' => $_POST['invite_others']=='on' ? 1 :0 ,
				//'guest_can_see_guest_list' => $_POST['see_guest_list']=='on' ? 1 :0,
				"attachment" => isset($_FILES['file']['name']) && !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : '',
				'modified_by' => $modified_by,
				'modified_time' => date('Y-m-d H:i:s'),
				'conference'=>$this->getPost('conference'),
				'status' => 0,
				'update_status' => date('Y-m-d H:i:s'),
			);



			if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via'])){
		              $notification['event_id'] = $booking_id;
		              $notification['created_by'] = $_SESSION['user_id'];
		              $notification['status'] = 1;
		              $notification['notification_via'] = $jobData['notification_via'];
		              $notification['notification_interval'] = $jobData['notification_interval'];
		              $notification['notification_type'] = $jobData['notification_type'];
 		              
	         	 }

			$this->db->where('id', $booking_id);
      		$recordUpdateSuccessful = $this->db->update("anb_crm_bookings", $recordData);
			//print_r($recordUpdateSuccessful); die("cool"); //exit;    		
      		


      		$checkId = $this->App_model->getRowCount('event_notification', 'id', array('event_id'=> $booking_id));
      		
      		if($checkId>0){
      		$this->db->where('event_id', $booking_id);
      		$recordUpdateSuccessful = $this->db->update("event_notification", $notification);
      		}
      		else{
      			$notification_id = $this->App_model->rowInsert('event_notification',$notification);
      		}
      		
			if($recordUpdateSuccessful === true)
			{
				$res = $this->App_model->getData('anb_crm_bookings', array('status'), array('id' => $booking_id));
				$this->session->set_flashdata('success',"Booking updated successfully.");
				//print_r($res[0]['status']); die("Ok");

				$fromEmail = COMPANY_NOREPLY_EMAIL;
				$fromName = COMPANY_NAME;

				//$toEmail = "harpreetclerisy@gmail.com";
				$toEmail = trim($email);
				$toName = "Guest";

				$booking_title = $this->getPost("booking_title");
				$data = array(
					'heading_text' => 'Booking Rescheduled',
					'booking_id' => $booking_id,
					'booking_date' => date('m/d/Y',strtotime($this->getPost("start_date"))),
					'booking_time' => date('h:ia',strtotime($this->getPost("start_time"))),
					'end_date' => date('m/d/Y',strtotime($this->getPost("end_date"))),
					'end_time' => date('h:ia',strtotime($this->getPost("end_time"))),
					'booking_title' => $booking_title,
					'notes' => $this->getPost("notes"),
					'name' => $this->getPost("name"),
					'email' => $email,
					'current_module' => '',
					'current_record_id' => !empty($current_record_id) ? $current_record_id : '',
					'record_status' => '',
					'bookingId'	=> 	$booking_id,
					'status' => $res[0]['status'],
					'conference'=>$this->getPost("conference"),
					'address'=>$this->getPost("booking_address"),
				);
				$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);

				if($data['status']==1)
				{
					$heading = 'Booking Confirmed';
				}
				else if($data['status']==2)
				{
					$heading = 'Booking Cancelled';
				}
				else if($data['status'] ==0)
				{
					$heading = 'Awaiting for confirmation';
				}
				$title = $heading.' - Updated Booking Information';
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
					$result = array("message" => "Booking Updated successfully",
									"success" => true);
					//echo json_encode($result); die();
			}

			/*if($booking_id)
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

		/*if($data_array['available'] ==1)
		{

							// $guest_data = $this->BookingModel->get_guest_name_by_email_user($email);
							// if(!empty($guest_data))
							// {
							// 	$guest_name = $guest_data['first_name'].' '.$guest_data['last_name'];
							// }
							// else
							// {
							// 	$guest_name = '';
							// }

							//$guest_name = $this->BookingModel->get_guest_name_by_email_client($email);

							// $this->db->select('*');
							// $this->db->where('booking_id', $booking_id);
							// $this->db->where('guest', trim($email));
							// $qry = $this->db->get('anb_crm_bookings_guests');
							// $ret = $qry->row_array();
							// if(empty($ret))
							// {
							// 	$guestdata = array(
							// 		'booking_id' => $booking_id,
							// 		'guest' => trim($email),
							// 		'guest_name' => $guest_name,
							// 		'status' => 0,  //0=just invited, 1= going, 2=maybe, 3 = not going
							// 		'invited_by' => $invited_by,
							// 		'created_by' => $created_by,
							// 		'modified_by' => $modified_by,
							// 		'created_time' => date('Y-m-d H:i:s'),
							// 		'modified_time' => date('Y-m-d H:i:s'),
							// 	);

							// 	$this->db->insert("anb_crm_bookings_guests", $guestdata);

								$fromEmail = COMPANY_NOREPLY_EMAIL;
								$fromName = COMPANY_NAME;

								//$toEmail = "harpreetclerisy@gmail.com";
								$toEmail = trim($email);
								$toName = "Guest";

								$data = array(
									'booking_id' => $booking_id,
									'booking_date' => date('j-F-Y',strtotime($start_date)),
									'booking_time' => date('H:ia',strtotime($start_date)),
									'booking_title' => $booking_title,
									'email' => $email,
									'all_email' => $all_email,
									'status' => $guestdata['status'],
								);
								$emailTemplate = $this->load->view('emails/meeting_invitation',$data,true);

								//echo $emailTemplate; die;

								// $headers  = 'MIME-Version: 1.0' . "\r\n";
								// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								// $headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
								// $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
								// $headers .= 'X-Mailer: PHP/' . phpversion();
								$title = 'Invitation: '.$booking_title.' - '.$data['booking_date'];

								$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

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


		}

		}
						}
					}
				}

			}*/

			//$this->session->set_flashdata('success',"The meeting has been updated successfully.");

			//update on google calender start
			if($google_event_id!='')
			{
				$booking = $this->BookingModel->loadBookingById($booking_id,$this->getPost('current_module'));
				//echo print_r($booking); //exit;

				if($booking['status']==0)
				{
					$summary = 'Awaing for confirmation';
					$colorId = 16;
				}
				else if($booking['status']==1)
				{
					$summary = 'Booking Confirmed';
					$colorId = 10;
				}
				else if($booking['status']==2)
				{
					$summary =  'Booking Cancelled';
					$colorId = 6;
				}

				//$location = $booking_data['collection1_address'].' '.$booking_data['collection_suburb'];
				$dateArr = explode(' ',$booking['booking_date']);
				$date = $dateArr[0].'T'.$dateArr[1];

				if($booking['end_date'] != '0000-00-00 00:00:00')
				{
					$endArr = explode(' ',$booking['end_date']);
					$enddate = $endArr[0].'T'.$endArr[1];
				}
				else
				{
					$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
				}

				$title = $booking['booking_title'];

				$description ='<br/><br/><b>Guest</b>: '.$booking['email'];
				$description ='<br/><br/><b>Status</b>: '.$summary;
				$description .='<br/><br/><b>Booking date</b>: '. date( 'm/d/Y',strtotime($dateArr[0]) );
				$description .='<br/><br/><b>Booking time</b>: '. date( 'h:i A',strtotime($dateArr[1]) );
				$description .='<br/><br/><b>Company</b>: '.$booking['value'] ;

				$description .='<br/><br/><b>Name</b>: '.$booking['name'];
				$description .='<br/><b>Email</b>: '.$booking['email'];

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
				$event = $service->events->get('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $google_event_id);

				$event->setSummary($title);
				//$event->setDescription($recordData['notes']);
				$event->setDescription($description);
				//$event->setStatus("confirmed");
				$event->setColorId($colorId);

				if($booking['all_day'] == 1){
					$start = new Google_Service_Calendar_EventDateTime();
					$start->setDate(date("Y-m-d",strtotime($date)));
					$start->setTimeZone($timezone);
					$event->setStart($start);

					$end = new Google_Service_Calendar_EventDateTime();
					$end->setDate(date("Y-m-d",strtotime($enddate)));
					$end->setTimeZone($timezone);
					$event->setEnd($end);
				}
				else
				{
					$start = new Google_Service_Calendar_EventDateTime();
					$start->setDateTime($date);
					$start->setTimeZone($timezone);
					$event->setStart($start);

					$end = new Google_Service_Calendar_EventDateTime();
					$end->setDateTime($enddate);
					$end->setTimeZone($timezone);
					$event->setEnd($end);
				}

				//$repeat = strtoupper($booking['repeat']);
				//$event->setRecurrence(array('RRULE:FREQ='.$repeat));
				$updatedEvent = $service->events->update('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $event->getId() , $event);
				// Print the updated date.
				$updated =  $updatedEvent->getUpdated();
				//echo '<pre>';print_r($updated);
				exit;
				//update on google calender end
			}

		}
		else
		{
			$result = array("message" => "Booking Not Updated",
							"success" => false);
			echo json_encode($result); die();
		}
		$this->session->set_flashdata('success',"Booking updated successfully");
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

			// $headers  = 'MIME-Version: 1.0' . "\r\n";
			// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// $headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
			// $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
			// $headers .= 'X-Mailer: PHP/' . phpversion();
			$title = 'Invitation: '.$booking_title.' - '.$booking_date;

			$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

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


			// if(mail($toEmail,$title,$emailTemplate,$headers))
			// {
			// 	echo 'sent';
			// }
			// else
			// {
			// 	echo 'not_sent';
			// }

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
		echo json_encode(array('message'=>"not check"));die();
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

		$this->data["permissions"] = $this->getUserPermissions($loggedUserId);

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
		if(!$this->isSuperAdmin() || $_SESSION['role_id'])
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
			$agenda['start_time'] = date('h:i a',strtotime($booking['start_date']));
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
			$agenda['allDay'] = $booking['all_day'] == 1 ? true : false;
			$agenda['start'] = $booking['booking_date'];
			$agenda['end'] = $booking['end_date'];
			$agenda['created_for'] = $booking['created_for'];
			$agenda['conference'] = $booking['conference'];
			//$agenda['title'] = $booking['value']." ".$module;
			$agenda['location'] = $booking['booking_address'];
			$agenda['title'] = $booking['booking_title'];
			$agenda['all_day'] = $booking['all_day'];
			$agenda['repeat'] = $booking['repeat'];
			$agenda['availability'] = $booking['availability'];
			$agenda['visibility'] = $booking['visibility'];
			$agenda['color'] = $booking['color'];
			$agenda['notify_by'] = json_decode($booking['notify_by']);
			$agenda['notify_before'] = json_decode($booking['notify_before']);
			$agenda['notify_on'] = json_decode($booking['notify_on']);
			$agenda['notes'] = $booking['notes'];

			$agenda['attachment'] = $booking['attachment'];
			$agenda['email'] = $booking['email'];
			$agenda['name'] = $booking['name'];
			$agenda['record_id'] = $booking['record_id'];
			$agenda['status'] = $booking['status'];
			$agenda['praposed_date'] = date('m/d/Y H:i a',strtotime($booking['praposed_date']));

			$agenda['modify_event'] = $booking['guest_can_modify_event'];
			$agenda['invite_others'] = $booking['guest_can_invite_others'];
			$agenda['see_guest_list'] = $booking['guest_can_see_guest_list'];
			$agenda['notification'] = $this->App_model->getData('event_notification','*', 'event_id = '.$agenda["booking_id"]);

			$agenda['class'] = 'booking_event';
			if($booking['module_id'] == 1){
				$agenda['module'] = 'Leads';
			}elseif($booking['module_id'] == 2){
				$agenda['module'] = 'Clients';
			}

			$invites = $this->BookingModel->get_invitees_by_booking_id($agenda['booking_id']);
			$agenda['invites'] = $invites;


			$day = date("l", strtotime($booking["booking_date"]));
			$date = date("m/d/Y", strtotime($booking["booking_date"]));
			$time = date("h:i a", strtotime($booking["booking_date"]));


			//date_default_timezone_set("Asia/Kolkata");

			$date1 = date('Y-m-d H:i:s');
			//$date1 = date('Y-m-d H:i:s',strtotime('+5 hour +30 minutes',strtotime($date1)));
			$date2 = date('Y-m-d H:i:s',strtotime($date.' '.$time));

			$st = '';
			if($booking['status']==0)
			{
				if(empty($booking['update_status']))
				{
					if(strtotime($date2) < strtotime($date1))
					{
						$agenda['backgroundColor'] =  '#00bbff';    // faded blue
					}
					else
					{
						$agenda['backgroundColor'] =  $booking['color']!="" ? $booking['color'] : '#00bbff';    // blue
					}
					$st2 = '<span style="display:block;font-size: 12px;top: -4px;position: relative;color:#00bbff;"><i class="fa fa-exclamation-circle"></i> Awaiting for confirmation</span>';
					$st = 'Awaiting for confirmation';
				}
				else
				{
					if(strtotime($date2) < strtotime($date1))
					{
						$agenda['backgroundColor'] =  '#ffbc00';    // faded blue
					}
					else
					{
						$agenda['backgroundColor'] =  $booking['color']!="" ? '#ffbc00' : '#ffbc00';    // blue
					}
					$st2 = '<span style="display:block;font-size: 12px;top: -4px;position: relative;color:#ffbc00;"><i class="fa fa-exclamation-circle"></i> Awaiting for confirmation</span>';
					$st = 'Awaiting for confirmation';	
				}
			}
			else if($booking['status']==1)
			{
				if(strtotime($date2) < strtotime($date1))
				{
					$agenda['backgroundColor'] =   '#33b679';    // faded green
				}
				else
				{
					$agenda['backgroundColor'] = $booking['color']!="" ? $booking['color'] : '#33b679';    // green
				}

				$st2 = '<span style="display: block;font-size: 12px;top: -4px;position: relative;color:#33b679;"><i class="fa fa-check-circle"></i> Confirmed</span>';
				$st = 'Confirmed';
			}
			else if($booking['status']==2 && $booking['praposed_date'] == 0)
			{
				if(strtotime($date2) < strtotime($date1))
				{
					$agenda['backgroundColor'] =  '#c9302c';    // faded red
				}
				else
				{
					$agenda['backgroundColor'] = $booking['color']!="" ? $booking['color'] : '#c9302c';	   // red
				}

				$st = 'Cancelled';
				$st2 = '<span style="display:block;font-size: 12px;top: -4px;position: relative;color:#c9302c;"><i class="fa fa-times-circle"></i> Cancelled</span>';
			}
			else if($booking['status']==2 && $booking['praposed_date'] != 0)
			{
				if(strtotime($date2) < strtotime($date1))
				{
					$agenda['backgroundColor'] =  '#ffbc00';    // faded red
				}
				else
				{
					$agenda['backgroundColor'] = $booking['color']!="" ? $booking['color'] : '#ffbc00';	   // red
				}

				$st2 = '<span style="display: block;font-size: 12px;top: -4px;position: relative;color:#ffbc00;"><i class="fa fa-times-circle"></i> Cancelled</span><div style="font-size: 12px;">Suggested Time by Client: </span><span style="color:#ffbc00;">'.date("m/d/Y h:i a",strtotime($booking['praposed_date'])).'</div> </div> </div> <div class="clearfix" style="border-top:2px dashed #ddd; padding-top:15px;"><span class="rebooking_availability"><a href="javascript:" class="check_rebooking btn-link" style="font-size:12px;">Check Availability</a></span>     <span class="rebooking-status"> </span> <span class="fade re_booking pull-right"><span class="hover-title">Rebook Client</span> </span></div> <div> <div>';
				$st = 'Cancelled';

			}

			//$agenda['description'] = 'Status: '.$st.' || Booking Date: '.$date.' || Booking Time:  '.$time.' || Name: '.$booking['name'].' || Email: '.$booking['email'];
			//$agenda['description'] = $st.' || '.$date.' || '.$time.' || '.$booking['name'].' - '.$booking['email'];

			if($booking['all_day']==1)
			{
				$endtime = date('h:i a',strtotime('+23 hour +59 minutes',strtotime($time)));
				$all_day = '(All Day)';
			}
			else
			{
				$endtime = date('h:i a',strtotime($booking['end_date']));
				$all_day = '';
			}


			/**/
			$description = '';
			//print_r($booking); die|("Ok");
			$description .= '<input type="hidden" id="srecord" value="'.$booking["record_id"].'">';
			$description .= '<input type="hidden" id="sdate" value="'.date("m/d/Y",strtotime($booking['praposed_date'])).'">';
			$description .= '<input type="hidden" id="stime" value="'.date("h:i a",strtotime($booking['praposed_date'])).'">';

			//$description .= '<div class="bookingView-row row"><label>Booking Title: </label> <span class="sname">'.$booking['booking_title'].'</span></div>';

			

			if($booking['all_day'] == 1){
				$description .= '<div class="eventView-row col-xs-12 "><div class="col-xs-2 event-icon"><span class="event-color"></span></div><div class="col-xs-11 event-div"><div class="jobName col-xs-12 edit-title">'.$booking['booking_title'].'</div><div class="startDay col-xs-7">'.$day.', '.$date.'</div><div class="endDate col-xs-4">'.date("h:i a",strtotime($booking["end_date"])).'</div></div></div>';
				
				//$description .='<div class="bookingView-row row"><label>Booking Date: </label> <span class="stime">'.$day.', '.$date.'</span></div>';

				//$description .='<div class="bookingView-row row"  style="background:#f9fafc;"><label>Booking End: </label> <span class="stime">'.date("l, m/d/Y",strtotime($booking["end_date"])).'</span></div>';	
			   /* $description .= ' <div class="eventView-row col-xs-12" ><div class="col-xs-2 address-icon"><i class="far fa-clock"></i></div><div class="allDay col-xs-8 event-address">Yes</div></div>' ; */
			}else{
				$description .= '<div class="eventView-row col-xs-12 "><div class="col-xs-2 event-icon"><span class="event-color"></span></div><div class="col-xs-11 event-div"><div class="jobName col-xs-12 edit-title">'.$booking['booking_title'].'</div><div class="startDay col-xs-7">'.$day.', '.$date.' '.$time.'</div><div class="endDate col-xs-4">'.date("h:i a",strtotime($booking["end_date"])).'</div></div></div>';
				//$description .='<div class="bookingView-row row"><label>Booking Date: </label> <span class="stime">'.$day.', '.$date. ' '.$time.'</span></div>';	
			//$description .='<div class="bookingView-row row"  style="background:#f9fafc;"><label>Booking End: </label> <span class="stime">'.date("l, m/d/Y h:i a",strtotime($booking["end_date"])).'</span></div>';
			 /* $description .= ' <div class="eventView-row col-xs-12" ><div class="col-xs-2 address-icon"><i class="far fa-clock"></i></div><div class="allDay col-xs-8 event-address">No</div></div>' ;*/
			}

			//$description .='<div class="bookingView-row row"><label>All Day: </label> <span><i class="fa fa-check"  style="color:green"></i></span></div>';
			$description .= '<div class="eventView-row col-xs-12"><div class="col-xs-2 address-icon"  style="margin-left: 10px !important;"><i class="material-icons">location_on</i></div><div class="event_location col-xs-10 event-address">'.$booking['booking_address'].'</div></div>';

			$description .= '<div class="eventView-row col-xs-12"> <div class="clearfix"><div class="col-xs-2 address-icon"><i class="fas fa-user"></i></div><div class="field-col col-xs-10 event-address"><span class="semail">'.$booking['email'].'</span>	'.$st2.'</div></div></div>';

			$description .='<div class="eventView-row col-xs-12" ><div class="col-xs-2 address-icon"><i class="fa fa-bars" aria-hidden="true" ></i></div> <div class="col-xs-8 event-address">'.$booking['notes'].'</div></div>';

			if(!empty($agenda['notification'])){

				$via = $agenda['notification'][0]['notification_via'] == 1 ? 'Email':'Notification';

				if($agenda['notification'][0]['notification_type']==1){
					$description .='<div class="eventView-row col-xs-12" ><div class="col-xs-2 address-icon"><i class="fa fa-bell"></i></div>  <div class="col-xs-10 event-address">Before ' . $agenda['notification'][0]['notification_interval'].' Hour Via '.$via.'</div></div>';
				}

				else{
					$description .='<div class="bookingView-row row" ><label>Notification: </label> <span>Before ' . $agenda['notification'][0]['notification_interval'].' Day Via '.$via.'</span></div>';
				}
			}

			
			if(!empty($booking['attachment'])){
			$description .='<div class="eventView-row col-xs-12"  style="background:#f9fafc;"><div class="col-xs-2 address-icon"><i class="fa fa-paperclip" ></i></div>   <div class="col-xs-10 event-address"> <i class="fa fa-download"></i><a class="btn btn-link" download href="'.base_url().'/upload/event/'.$booking["attachment"].'">'.$booking['attachment'].'</a></div></div>';
			}

			$description .= '<div class="tab-title"><span style="margin-left:10px; margin-bottom:0px;">Lead Information</span></div>';

			$description .= '<div class="eventView-row col-xs-12" ><div class="col-xs-2 address-icon"><i class="fas fa-user-circle" ></i></div> <div class="tname col-xs-10 event-address">'.$booking['name'].'</div></div>';

			$description .= '<div class="eventView-row col-xs-12"><div class="col-xs-2 address-icon"><i class="fa fa-envelope" ></i></div> <div class="rmno col-xs-10 event-address">'.$booking['email'].'</div></div>';
			$description .= '<div class="bookingView-row row"><label></label> <span class="rmno"></span></div>';
			
			$agenda['description'] = $description;
			$agenda['status'] = $st;
			$agenda['start_date'] = date("m/d/Y", strtotime($booking["booking_date"]));
			$agenda['start_time'] = date("h:i a", strtotime($booking["booking_date"]));
			$agenda['end_date'] = date("m/d/Y", strtotime($booking["end_date"]));
			//$agenda['end_date'] = $date;
			$agenda['end_time'] = $endtime;

			$agenda['type'] = 'booking';
			$agenda['own_email'] = $own_data['email'];


			$events[] = $agenda;

		}

		$this->data["users_list"] = $this->ModuleModel->loadUsersList();

		$this->data["events"] = json_encode($events);
		//echo '<pre>';print_r($events);die;

		$this->data["page"] = "booking";
		$join = array(
                array(
                    "table" => 'calendar_shared',
                    "on" => 'calendar_shared.calendar_id = anb_crm_calendars.id'
                )
            );
		$this->data['calendars'] = $this->App_model->getData('anb_crm_calendars',array('name','timezone','owner','anb_crm_calendars.id','color','created_by','user_id','access'),array('calendar_shared.user_id' => $this->session->userdata('user_id')),$join,'name','ASC');
		$this->data['users'] = $this->App_model->getData('anb_crm_users',array('*'),array('id !=' => $this->session->userdata('user_id')));
		
		$this->viewLoad("booking/booking");
	}

	public function bookNow()
	{
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		$loadViewWithData = true;
		$notification = array();
		if (($requestMethod = strtolower($this->input->method())) == 'post'){
		$jobData = $this->input->post();
		/*print_r($jobData);
		die;*/
			/*Send Notification Start*/
		if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via'])){
	            $notification_interval = $jobData['notification_interval'];
	                switch ($jobData['notification_type']){
			                     case 1:
			                          $notification = array(
			                                  
			                                  'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])-60*60*$notification_interval),
			                                  'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
			                      break;
			                      case 2:   
			                            $date = date_create($jobData['start_date']);
			                            date_sub($date, date_interval_create_from_date_string($notification_interval.' days'));
			                            $notification = array(
			                                 
			                                  'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])),
			                                  'notification_date'=> date_format($date, 'Y-m-d'),);                                       
			                      break;
			                    }
			                }
	          /*Send Notification end*/
			$booking_date = date('Y-m-d H:i',strtotime($_POST['start_date'].' '.$_POST['start_time']));
			$booking = $this->BookingModel->loadBookingsList(null, $_POST["record_id"], $_POST["email"], $booking_date);
			//print_r($booking);
			if(empty($booking))
			{
				$st = $booking_date;
				$et = date('Y-m-d H:i',strtotime($_POST['start_date'].' '.$_POST['end_time']));
				if($st >= $et)
				{
					$result['message'] = 'Invalid Booking Schedule time';
	       			$result['success'] = false;
	       			$this->session->set_flashdata('success',"Invalid Booking Schedule time");
	       			echo json_encode($result); die(); 
				}

				$config['upload_path'] = 'upload/event';
       			$config['allowed_types'] = '*';
		        $config['max_size'] = 0;
		        $config['max_width'] = 0;
		        $config['max_height'] = 0;
        		//print_r($_FILES);die();
		        if( !empty($_FILES) ){
		        	$this->load->library('upload', $config);
			        if (!$this->upload->do_upload('file')) {

			        } else {
			            $upload_data = $this->upload->data();
			        }
			       $attachment = isset($upload_data) && !empty($upload_data) && isset($upload_data['file_name']) ? $upload_data['file_name'] : '';
			    }

				$bookingId = $this->BookingModel->addBooking();

				if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via'])){
		              $notification['event_id'] = $bookingId;
		              $notification['created_by'] = $_SESSION['user_id'];
		              $notification['status'] = 1;
		              $notification['notification_via'] = $jobData['notification_via'];
		              $notification['notification_interval'] = $jobData['notification_type'];
		              $notification['notification_type'] = $jobData['notification_type'];
 		              $notification_id = $this->App_model->rowInsert('event_notification',$notification);
	         	 }
				//echo 'bookingId ';print_r($bookingId); //exit;

				if($bookingId)
				{
					$current_module = $this->input->post('current_module');
					$record_id = $this->input->post('record_id');
					$record_data = $this->ModuleModel->loadRecord(null, $record_id);
					$logid = $this->LogsModel->addLogs('Booking', 'Booking is Done' ,$record_id, $current_module,$_SESSION['user_id']); 
					$send_email = false;
					if($current_module == 'Leads')
					{
					$LeadCategory = array('value' => 'Hot',);
					$leadUpdate = $this->db->where('record_id', $record_id)
									       ->where('record_meta_id', 14)
								  	       ->update("anb_crm_record_meta_value", $LeadCategory);

					if($leadUpdate){
						$time = array('modified_time' => time());
						$timeupdate = $this->db->where('id', $record_id)
								  	       ->update("anb_crm_record", $time); 	
					}		

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
						
					
						if($lead_status=="ASSIGNED TO OPENER")
						{
							$send_email = true;
							$toName = $opener;
							$toEmail = trim($opener_email);
							$subject = 'A Lead Booking.';
							//$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'admin_to_opener');
							$assignedData = array(
								'current_module_id' => 1, 
								'leadassignedofficer' => $opener,
								'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								/*'parent_company' => isset($record_data['__41']) ? $record_data['__41'] : "No Parent Company Name Available",*/
								'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								/*'primary_NAICS_description' => isset($record_data['__77']) ? $record_data['__77'] : "Primary NAICS description Not Available",*/
								/*'estimated_sales' => isset($record_data['__80']) ? $record_data['__80'] : "Estimated Sales Not Available",*/
								'lead_name' => $lead_name,
								'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
								'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
								'booking_date' => date('m/d/Y',strtotime($this->getPost("start_date"))),
								'booking_time' => date('h:i a',strtotime($this->getPost("start_time"))),
								'end_date' => date('m/d/Y',strtotime($this->getPost("end_date"))),
								'end_time' => date('h:i a',strtotime($this->getPost("end_time"))),
								'booking_title' => $this->getPost("booking_title"),
								'notes' => $this->getPost("notes"),
								/*'telephone' => isset($record_data['__32']) ? $record_data['__32'] : " Number Not Available",
								'address_line_1' => isset($record_data['__38']) ? $record_data['__38'] : "Address Not Available",
								'city' => isset($record_data['__35']) ? $record_data['__35'] : "City Not Available",
								'province' => isset($record_data['__40']) ? $record_data['__40'] : "Province Not Available",
								'country' => isset($record_data['__37']) ? $record_data['__37'] : "Country Not Available",
								'zip_code' => isset($record_data['__36']) ? $record_data['__36'] : "Zip Code Not Available",
								'website' => isset($record_data['__34']) ? $record_data['__34'] : "Website Not Available",*/
								/*'admin' => $user_data0['first_name'].' '.$user_data0['last_name'],*/
							);
						
						}
						if($lead_status=="ASSIGNED TO CLOSER")
						{
							$send_email = true;
							$toName = $closer;
							$toEmail = trim($closer_email);
							$subject = 'A Lead Booking.';
							$assignedData = array(
								'current_module_id' => 1,
								'leadassignedofficer' => $closer,
								/*'start_date' => $record_data['__24'],*/
								'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								/*'parent_company' => isset($record_data['__41']) ? $record_data['__41'] : "No Parent Company Name Available",*/
								'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
								/*'primary_NAICS_description' => isset($record_data['__77']) ? $record_data['__77'] : "Primary NAICS description Not Available",
								'estimated_sales' => isset($record_data['__80']) ? $record_data['__80'] : "Estimated Sales Not Available",*/
								'lead_name' => $lead_name,
								'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
								'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
								'booking_date' => date('m/d/Y',strtotime($this->getPost("start_date"))),
								'booking_time' => date('h:i a',strtotime($this->getPost("start_time"))),
								'end_date' => date('m/d/Y',strtotime($this->getPost("end_date"))),
								'end_time' => date('h:i a',strtotime($this->getPost("end_time"))),
								'booking_title' => $this->getPost("booking_title"),
								'notes' => $this->getPost("notes"),
								/*'telephone' => isset($record_data['__32']) ? $record_data['__32'] : " Number Not Available",
								'address_line_1' => isset($record_data['__38']) ? $record_data['__38'] : "Address Not Available",
								'city' => isset($record_data['__35']) ? $record_data['__35'] : "City Not Available",
								'province' => isset($record_data['__40']) ? $record_data['__40'] : "Province Not Available",
								'country' => isset($record_data['__37']) ? $record_data['__37'] : "Country Not Available",
								'zip_code' => isset($record_data['__36']) ? $record_data['__36'] : "Zip Code Not Available",
								'website' => isset($record_data['__34']) ? $record_data['__34'] : "Website Not Available",*/
								/*'admin' => $user_data0['first_name'].' '.$user_data0['last_name'],*/
							);
						}
					}
					if($current_module == 'Clients')
					{
						$closer_id = $record_data['__104'];
						$user_data = $this->UserModel->loadUser($closer_id);
						$closer = $user_data['first_name'].' '.$user_data['last_name'];
						$closer_email = $user_data['email'];
						$client_name = $record_data['__84'];
						$title = $record_data['__83'];
						$company_name = isset($record_data['__108']) ? $record_data['__108'] : '';
						$email = isset($record_data['__85']) ? $record_data['__85'] : '';
						$signig_rate = isset($record_data['__94']) ? $record_data['__94'] : '';
						/*$service_type = isset($record_data['__90']) ? $record_data['__90'] : '';*/
						
						$send_email = true;
						$toName = $closer;
						$toEmail = trim($closer_email);
						$subject = 'A Client Booking.';
						$assignedData = array(
							'current_module_id' => 2,
							'leadassignedofficer' => $closer,
							/*'start_date' => $record_data['__24'],*/
							'company' => isset($company_name) && !empty($company_name) ? $company_name : "No Company Name Available",
							'client_name' => isset($client_name) ? $client_name : '',
							/*'parent_company' => isset($record_data['__41']) ? $record_data['__41'] : "No Parent Company Name Available",*/
							/*'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",*/
							/*'primary_NAICS_description' => isset($record_data['__77']) ? $record_data['__77'] : "Primary NAICS description Not Available",
							'estimated_sales' => isset($record_data['__80']) ? $record_data['__80'] : "Estimated Sales Not Available",*/
							/*'lead_name' => $lead_name,*/
							'title' => isset($title) ? $title : "title Not Available",
							'email' => isset($email) ? $email : " Email Not Available",
							'signig_rate' => isset($signig_rate) ? $signig_rate :'',
							/*'service_type' => isset($service_type) ? $service_type : '',*/
							'booking_date' => date('m/d/Y',strtotime($this->getPost("start_date"))),
							'booking_time' => date('h:i a',strtotime($this->getPost("start_time"))),
							'end_date' => date('m/d/Y',strtotime($this->getPost("end_date"))),
							'end_time' => date('h:i a',strtotime($this->getPost("end_time"))),
							'booking_title' => $this->getPost("booking_title"),
							'notes' => $this->getPost("notes"),
							/*'telephone' => isset($record_data['__32']) ? $record_data['__32'] : " Number Not Available",
							'address_line_1' => isset($record_data['__38']) ? $record_data['__38'] : "Address Not Available",
							'city' => isset($record_data['__35']) ? $record_data['__35'] : "City Not Available",
							'province' => isset($record_data['__40']) ? $record_data['__40'] : "Province Not Available",
							'country' => isset($record_data['__37']) ? $record_data['__37'] : "Country Not Available",
							'zip_code' => isset($record_data['__36']) ? $record_data['__36'] : "Zip Code Not Available",
							'website' => isset($record_data['__34']) ? $record_data['__34'] : "Website Not Available",*/
							/*'admin' => $user_data0['first_name'].' '.$user_data0['last_name'],*/
						);
						
					}
					if($send_email == true)
					{
						$assignedData['mainheading'] = 'Booking';
						$assignedData['heading'] = 'New Booking.';
						$emailTemplate = $this->load->view('emails/bookingAssigned',$assignedData,true);	
						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;
						//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
						$data1 = json_encode($assignedData);
						$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data1);	
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

					$this->session->set_flashdata('success',"Booking added successfully.");
					$current_record_data = $this->BookingModel->get_record_data_by_id($_POST["record_id"]);
					//print_r($_POST);die('akshay');
					//echo 'current_record_data ';print_r($current_record_data); //exit;
					if($this->isSuperAdmin())
					{
						$loggedinUserId = $this->getUserId();
						$receiver_id = $current_record_data['assigned_officer_id'];
					}
					else
					{
						$loggedinUserId = $this->getUserId();
						//$receiver_id = 1;
						$receiver_id = $current_record_data['assigned_officer_id'];

					}
					//echo "loggedinUserId ";print_r($loggedinUserId); //exit;
					//echo "receiver_id ";print_r($receiver_id); //exit;
					$notifyData = array(
						"record_id" => $_POST["record_id"],
						"booking_id" => $bookingId,
						"sender_id" => $loggedinUserId,
						"receiver_id" => $receiver_id,
						"title" => "New booking received",
						"description" =>  $this->getPost("booking_title").' on '.date('m/d/Y',strtotime($this->getPost("start_date"))).' at '.date('h:i a',strtotime($this->getPost("start_time"))),
						"read" => 0, //0=new booking
						"created_time" =>date('Y-m-d H:i:s'),
						"modified_time" =>date('Y-m-d H:i:s'),
					);
					$noti = $this->BookingModel->add_notification($notifyData);


					$booking = $this->BookingModel->loadBookingById($bookingId,$this->getPost("current_module"));
					$_SESSION['booking_data'] = $booking;
					//google calender booking sync start

					$fromEmail = COMPANY_NOREPLY_EMAIL;
					$fromName = COMPANY_NAME;

					//$toEmail = "harpreetclerisy@gmail.com";
					$toEmail = trim($this->getPost("email"));
					$toName = $this->getPost("lead_name");

					$data = array(
						'booking_date' => date('m/d/Y',strtotime($this->getPost("start_date"))),
						'booking_time' => date('h:i a',strtotime($this->getPost("start_time"))),
						'end_date' => date('m/d/Y',strtotime($this->getPost("end_date"))),
						'end_time' => date('h:i a',strtotime($this->getPost("end_time"))),
						'booking_title' => $this->getPost("booking_title"),
						'lead_title' => $this->getPost("lead_title"),
						'notes' => $this->getPost("notes"),
						'name' => $this->getPost("lead_name"),
						'email' => $this->getPost("email"),
						'current_module' =>$this->getPost("current_module"),
						'current_record_id' => $this->getPost("record_id"),
						'record_status' => $this->getPost("recordStatus"),
						'bookingId' => $bookingId,
						'status' => 0,		//new
						'conference'=>$this->getPost('conference'),
						'address'=>$this->getPost('booking_address')
					);
					$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);

					//echo $emailTemplate; die;

					// $headers  = 'MIME-Version: 1.0' . "\r\n";
					// $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
					// $headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
					// $headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
					// $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
					// $headers .= 'X-Mailer: PHP/' . phpversion();
					$title = 'Booking Done, Awating for confirmation.';
					
					$smtpconfig = $this->config->item('email2');
					$this->email->initialize($smtpconfig);
					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

					$this->email->from($fromEmail);
					$this->email->to($toEmail);
					$this->email->subject($title);
					$this->email->message($emailTemplate);
					if(!empty($attachment)){
						$this->email->attach(FCPATH."upload/event/$attachment");
				    }
					if($this->email->send()){ //~ echo 'Email sent.';
					}
				 	else{//~ echo 'Email not sent.';
				 	}
				 		}
				else
				{
						echo false;
						exit;
				}
				$result['message'] = 'Booking added successfully';
       			$result['success'] = true;
       			$googleEvent = $this->addEventToGoogleCalendar();
					//google calender booking sync end
       			echo json_encode($result); die();
			}
			else
			{
				$result['message'] = 'Booking already exists';
       			$result['success'] = false;
       			$this->session->set_flashdata('success',"Booking already exists");
       			echo json_encode($result); die();
				//echo 'booking_already_exists';
				//exit;
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

		//$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

		$service_account_name = 'anbruch@anbruch.iam.gserviceaccount.com'; //Email abhishek.softgetix@gmail.com

		//$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';

		$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-65bc39b56937.json';

		$client = new Google_Client(); //AUTHORIZE OBJECTS

		$client->setApplicationName("Anbruch");

		$client->setAuthConfig($key_file_location);

		$client->addScope(Google_Service_Calendar::CALENDAR);

		$client->setSubject($service_account_name);

		$service = new Google_Service_Calendar($client);

		$calendarList = $service->calendarList->listCalendarList();

		echo '<pre>';print_r($calendarList);
		//die;
		while(true)
		{
			foreach ($calendarList->getItems() as $calendarListEntry)
			{
				echo $calendarListEntry->getSummary();
			}
			$pageToken = $calendarList->getNextPageToken();
		    echo '<pre>';var_dump($pageToken);
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
		die();

	}

	function addEventToGoogleCalendar()
	{
		$booking_data = $_SESSION['booking_data'];
		//echo '<pre>';print_r($booking_data);die();

		$summary = $booking_data['booking_title'];

		$dateArr = explode(' ',$booking_data['booking_date']);

		$date = $dateArr[0].'T'.$dateArr[1];

		if(!empty($booking_data['end_date']) && $booking_data['end_date'] != '0000-00-00 00:00:00'){
			$endArr = explode(' ',$booking_data['end_date']);
			$enddate = $endArr[0].'T'.$endArr[1];
		}else{
			$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );
		}
		$timezone = date_default_timezone_get();

		if($booking_data['all_day'] == 1)
		{
			$start = array(
					'date' => $dateArr[0],
		            'timeZone' => $timezone,
			);
			$end = array(
				'date' => $booking_data['end_date'] != '0000-00-00' ? date("Y-m-d",strtotime($booking_data['end_date'])) : $dateArr[0],
		        'timeZone' => $timezone,
			);
		}else
		{
			$start = array(
					'dateTime' => $date,
		            'timeZone' => $timezone,
			);
			$end = array(
				'dateTime' => $enddate,
		        'timeZone' => $timezone,
			);
		}


		$description = '<br/><b>Guest</b>: '.$booking_data['email'];
		$description = '<br/><b>Status</b>: Awaiting for confirmation!';
		$description .= '<br/><br/><b>Booking date</b>: '. date( 'm/d/Y',strtotime($dateArr[0]) );
		$description .= '<br/><br/><b>Booking time</b>: '. date( 'h:i A',strtotime($dateArr[1]) );
		$description .= '<br/><br/><b>Company</b>: '.$booking_data['value'];

		$description .='<br/><br/><b>Name</b>: '.$booking_data['name'];
		$description .='<br/><b>Email</b>: '.$booking_data['email'];
		$description .='<br/><br/>Powered by: anbruch.com';

		$service_account_name = 'anbruch@anbruch.iam.gserviceaccount.com';
		$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-65bc39b56937.json';

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
			'start' => $start,
			'end' => $end,
			/*'attendees' => array(
				array('email' => $booking_data['email']),
			),*/
			'reminders' => array(
				'useDefault' => FALSE,
				'overrides' => array(
					array('method' => 'email', 'minutes' => 24 * 60),
					array('method' => 'popup', 'minutes' => 10),
				),
			),
			//'colorId' => 16
		));
        $google_calendar_id = 'inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com';
    	//print_r($service->events);die();
		$event = $service->events->insert($google_calendar_id, $event);
		//print_r($event);
		//echo $event->htmlLink;
		//echo "<br />";
		$event_id= $event->getId();
		//print_r($event_id);
		 $recordData = array(
				"google_event_id" => $event_id,
		);
		$this->db->where('id', $booking_data['booking_id']);
		$this->db->update("anb_crm_bookings", $recordData);
	}

	function updateEventToGoogleCalendar()
	{
		$booking_data = $_SESSION['booking_data'];

		//echo '<pre>';print_r($booking_data);
		if($booking_data['google_event_id']!='')
		{
			$summary = $booking_data['value'].' - Booking Confirmed';

			//$location = $booking_data['collection1_address'].' '.$booking_data['collection_suburb'];
			$dateArr = explode(' ',$booking_data['booking_date']);
			$date = $dateArr[0].'T'.$dateArr[1];
			$description = '<br/><b>Guest</b>: '.$booking_data['email'];
			$description ='<br/><br/>Status: Booking Confirmed!';
			$description .='<br/><br/>Booking date: '. date( 'm/d/Y',strtotime($dateArr[0]) );
			$description .='<br/><br/>Booking time: '. date( 'h:i A',strtotime($dateArr[1]) );
			$description .='<br/><br/>Name: '.$booking_data['name'];
			$description .='<br/>Email: '.$booking_data['email'];
			$description .='<br/><br/>Powered by: anbruch.com';
			$timezone = date_default_timezone_get();


			$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

			$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';

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
			//$event->setStatus("confirmed");
			$event->setColorId(2);

			if($booking_data['all_day'] == 1)
			{
			$start = array(
					'date' => $dateArr[0],
		            'timeZone' => $timezone,
			);
			$end = array(
				'date' => $booking_data['end_date'] != '0000-00-00' ? date("Y-m-d",strtotime($booking_data['end_date'])) : $dateArr[0],
		        'timeZone' => $timezone,
			);
			}else
			{
				$start = array(
						'dateTime' => $date,
			            'timeZone' => $timezone,
				);
				$end = array(
					'dateTime' => $enddate,
			        'timeZone' => $timezone,
				);
			}

            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime($booking_data['booking_date']);
            $event->setStart($start);
            if($booking_data['end_date'] != '0000-00-00'){
             $end = new Google_Service_Calendar_EventDateTime();
             $end->setDateTime($booking_data['end_date']);
             $event->setEnd($end);
            }else{
            $event->setEnd($start);
            }
			$updatedEvent = $service->events->update('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $event->getId() , $event);

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
			$summary = 'Booking Cancelled';
			$dateArr = explode(' ',$booking_data['booking_date']);

			$date = $dateArr[0].'T'.$dateArr[1];
			$enddate = $dateArr[0].'T'.  date('H:i:s',strtotime($dateArr[1])+ 60*30 );

			$description ='<br/><br/>Status: Booking Cancelled!';
			$description .='<br/><br/>Booking date: '. date( 'm/d/Y',strtotime($dateArr[0]) );
			$description .='<br/><br/>Booking time: '. date( 'h:i A',strtotime($dateArr[1]) );
			$description .='<br/><br/>Company: '.$booking_data['value'] ;
			$description .='<br/><br/>Name: '.$booking_data['name'];
			$description .='<br/>Email: '.$booking_data['email'];
			$description .='<br/><br/>Powered by: anbruch.com';
			$timezone = date_default_timezone_get();

			$service_account_name = 'anbruch@anbruch-218513.iam.gserviceaccount.com'; //Email Address clerisytest1

			$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-218513-d62da5600e23.json';

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
			 //exit;
			$bookings = $this->BookingModel->loadBookingsList($this->getPost("bookingId"), null, null);
			echo print_r($bookings);// die("cool");
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
					//echo print_r($loggedinUserId); //exit;
					//echo print_r($receiver_id); //exit;
					$notifyData = array(
								"record_id" => $_POST["current_record_id"],
								"booking_id" => $bookingId,
								"sender_id" => $loggedinUserId,
								"receiver_id" => $receiver_id,
								"title" => "Booking confirmed",
								// "description" =>  $this->getPost("booking_title").' on '.date('j-F-Y',strtotime($this->getPost("selected_date"))).' at '.date('h:ia',strtotime($this->getPost("selected_time"))),
								"description" =>  $bookings[0]["booking_title"].' on '.date('m/d/Y').' at '.date('h:ia'),
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
						'end_date' => date('m/d/Y',strtotime($booking[0]["end_date"])),
						'end_time' => date('h:ia',strtotime($booking[0]["end_date"])),
						'booking_title' => $bookings[0]["booking_title"],
						'lead_title' => '',
						'notes' => $bookings[0]["notes"],
						'name' => $bookings[0]["name"],
						'email' => $bookings[0]["email"],
						'current_module' =>!empty($this->getPost("current_module")) ? $this->getPost("current_module") : '',
						'current_record_id' => !empty($this->getPost("current_record_id")) ? $this->getPost("current_record_id"): '',
						'record_status' => !empty($this->getPost("recordStatus")) ? $this->getPost("recordStatus") : '',
						'bookingId' => $bookings[0]["id"],
						'status' => 1,	  //confirmed
					);
					$emailTemplate = $this->load->view('emails/booking_confirmed',$data,true);

					$title = 'Booking Confirmed.';

					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

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

					// if(mail($toEmail,$title,$emailTemplate,$headers))
					// {
					// 	echo 'sent';
					// }
					// else
					// {
					// 	echo 'not sent';
					// }

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
			//echo '<pre>';print_r($_POST); die;
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

				    $id = $this->getPost("bookingId");
				  	$this->db->select('*');
				  	$this->db->from('anb_crm_bookings');
				  	$this->db->where('id',$id);
				  	$data =  $this->db->get();
				  	$res= $data->result_array();
				 //	echo "<pre>"; print_r($res); die;

						$notifyData = array(
								"record_id" => $_POST["current_record_id"],
								"booking_id" => $bookingId,
								"sender_id" => $loggedinUserId,
								"receiver_id" => $receiver_id,
								"title" => "Booking cancelled",
								// "description" =>  $booking["booking_title"].' on '.date('j-F-Y',strtotime($booking["booking_date"])).' at '.date('h:ia',strtotime($booking["selected_time"])),
								"description" =>  $res[0]["booking_title"].' on '.date('m/d/Y').' at '.date('h:ia'),
								// "description" =>  ' Booking cancelled on '.date('j-F-Y').' at '.date('h:ia'),
								"read" => 0, //0=new booking
								"created_time" =>date('Y-m-d H:i:s'),
								"modified_time" =>date('Y-m-d H:i:s'),
							);
           // echo "<pre>"; print_r($notifyData); die;

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
						'booking_time' => date('h:i a',strtotime($bookings[0]["booking_date"])),
						'end_date' => date('m/d/Y',strtotime($booking[0]["end_date"])),
						'end_time' => date('h:i a',strtotime($booking[0]["end_date"])),
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

						// $headers  = 'MIME-Version: 1.0' . "\r\n";
						// $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						// $headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
						// $headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";
						// $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
						// $headers .= 'X-Mailer: PHP/' . phpversion();

					$title = 'Booking Cancelled.';

					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

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

					// if(mail($toEmail,$title,$emailTemplate,$headers))
					// {
					// 	echo 'sent';
					// }
					// else
					// {
					// 	echo 'not sent';
					// }

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


  public function get_booking(){

    $id = 249;
  	$this->db->select('*');
  	$this->db->from('anb_crm_bookings');
  	$this->db->where('id',$id);
  	$data =  $this->db->get();
  	$res= $data->result_array();
  	echo "<pre>"; print_r($res); die;
  }



	public function sendemailtest()
	{
		$fromEmail = "helpcenter@anbruch.com";
		$fromName = 'harp saini';

		$toEmail = "softgetix.test@gmail.com";
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

		// $headers = "MIME-Version: 1.0" . "\r\n";
		// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// $headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
		$title = 'Booking Confirmed.';

		$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

		$this->email->from($fromEmail);
		$this->email->to($toEmail);
		$this->email->subject($title);
		$this->email->message($emailTemplate);
		if($this->email->send())
	  {
		echo 'Email sent.';
	  }
	  else
	  {
	  	 echo $this->email->print_debugger();

		 echo 'Email not sent.';
	  }

		// if(mail($toEmail,$title,$emailTemplate,$headers))
		// {
		//   echo 'sent';
		// }
		// else
		// {
		// 	echo 'not sent';
		// }

		die('-----end');

	}

	 function getEmails($locationText = 0) {
	    $loctionsData = $this->App_model->getData('anb_crm_users', 'email', false, false, false, '', false, false, array('email' => urldecode($locationText)));
	    $output['customers'] = (isset($loctionsData) && !empty($loctionsData)) ? $loctionsData : array();
	    echo json_encode($output);
	    die;
	}

	/* booking add */
	public function bookadd()
	{
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			echo print_r($_POST); //exit;

			$invited_by = $created_by = $modified_by = $this->getUserId();

			//$booking_id = $_POST['booking_id'];
			$google_event_id = $_POST['google_event_id'];
			$booking_title = $_POST['booking_title'];
			$title = $_POST['title'];

			if(isset($_POST['all_day']) && $_POST['all_day'] =='on')
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

			$repeat = isset($_POST['repeat']) ? $_POST['repeat'] :'';
			$availability = isset($_POST['availability']) ? $_POST['availability'] :'';
			$visibility = isset($_POST['visibility']) ? $_POST['visibility']:'';
			$color = isset($_POST['color']) ? $_POST['color'] : '';
			$notes = isset($_POST['notes']) ? $_POST['notes'] : '';

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
				//'guest_can_modify_event' => $_POST['modify_event']=='on' ? 1 :0 ,
				//'guest_can_invite_others' => $_POST['invite_others']=='on' ? 1 :0 ,
				//'guest_can_see_guest_list' => $_POST['see_guest_list']=='on' ? 1 :0,
				'modified_by' => $modified_by,
				'modified_time' => date('Y-m-d H:i:s'),
				'record_id' => 27123
			);

			//$this->db->where('id', $booking_id);
      $recordUpdateSuccessful = $this->db->insert("anb_crm_bookings", $recordData);
			echo print_r($recordData); //exit;
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
							/*if(!empty($res))
							{
							*/
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
							//$this->db->where('booking_id', $booking_id);
							$this->db->where('guest', trim($email));
							$qry = $this->db->get('anb_crm_bookings_guests');
							$ret = $qry->row_array();
							if(empty($ret))
							{
								$guestdata = array(
									//'booking_id' => $booking_id,
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

								// $headers  = 'MIME-Version: 1.0' . "\r\n";
								// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								// $headers .= "From: ".$fromEmail." <".$fromName.">". "\r\n";
								// $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
								// $headers .= 'X-Mailer: PHP/' . phpversion();
								$title = 'Invitation: '.$booking_title.' - '.$data['booking_date'];

								$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);
								$this->email->from($fromEmail);
								$this->email->to($toEmail);
								$this->email->subject($title);
								$this->email->message($emailTemplate);
									if($this->email->send())
								  {
									  echo 'Email sent.';
								  }
								  else
								  {
									  echo 'Email not sent.';
								  }

							  }
							}
						}
			 }
			//$this->session->set_flashdata('success',"The meeting has been add successfully.");
		}
		exit;
	}

	public function followlead(){
				$recordData = array('value' => 'Hot',);
				$record_id = $this->input->post("record_id");
				$modified_time = time();
				$leadUpdate = $this->db->where('record_id', $record_id)
									   ->where('record_meta_id', 14)
								  	   ->update("anb_crm_record_meta_value", $recordData);
					if($leadUpdate){
						$this->LogsModel->addLogs('Follow Lead', 'Lead is followed', $record_id, 'Leads', $_SESSION['user_id']);
						$updatetime = $this->db->set('modified_time', $modified_time)
																   ->where('id', $record_id)
																   ->update('anb_crm_record');}

					$this->session->set_flashdata('success',"Lead followed successfully");
	}
	public function unfollowlead(){//unfollow lead
				$record = array('value' => 'Cold',); //set value to null for the unfollow
				$record_id = $this->input->post("record_id");
				$modified_time = time();

					$updateLead = $this->db->where('record_id', $record_id)
						 	     							 ->where('record_meta_id', 14)
						       			 				 	->update('anb_crm_record_meta_value', $record);
				if($updateLead){
					$this->LogsModel->addLogs('unfollow Lead', 'Lead is unfollowed', $record_id, 'Leads', $_SESSION['user_id']);
					$updatetime = $this->db->set('modified_time', $modified_time)
																 ->where('id', $record_id)
																 ->update('anb_crm_record');}
		$this->session->set_flashdata('success',"Lead Unfollowed successfully");

	}
   public function checkAvailability()
	{
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		$loadViewWithData = true;
 		$result = array();
		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			//print_r($_POST); die("cool");

			$booking_date = date('Y-m-d H:i',strtotime($_POST['start_date'].' '.$_POST['start_time']));
			//echo $booking_date;die();
			$booking = $this->BookingModel->loadBookingsList(null, $_POST["record_id"], $_POST["email"], $booking_date);

			if(empty($booking))
			{
			$result['status'] = "Booking Available";
			$result['booking'] = true;
			}else
			{
			$result['status'] = "Booking Not Available";
			$result['booking'] = false;
			}

		}
		echo json_encode($result);die();
	}



	public function addPraposedSuggestion()
	{
		if ( ($requestMethod = strtolower($this->input->method())) == 'get')
		{
			$booking_id = $_GET['bid'];
			$record_id =$_GET['record_id'];
			$start_date = $_GET['st_date'];
			$start_time = $_GET['st_time'];
			$end_time = $_GET['en_time'];
			$comment = isset($_GET['cmt']) && !empty($_GET['cmt']) ? $_GET['cmt'] : '';
			$recordData = array(
				'praposed_date' => date('Y-m-d H:i:s',strtotime($start_date.' '. $start_time)),
				'praposed_end_time'=>date('H:i:s',strtotime($end_time)),
				'praposed_notes' => $comment,
			);
			/*print_r($recordData);
			die;*/
			$this->db->where('id', $booking_id);
      		$recordUpdateSuccessful = $this->db->update("anb_crm_bookings", $recordData);

      		if($recordUpdateSuccessful === true)
			{
				$result = $this->App_model->getData('anb_crm_bookings', array('*'), array('id' => $booking_id));
				$fromEmail = COMPANY_NOREPLY_EMAIL;
				$fromName = COMPANY_NAME;
				$toEmail = "aauger@anbruch.com";
				$email_data = array(
						'booking_date' => date('m/d/Y',strtotime($result[0]['booking_date'])),
						'booking_time' => date('h:i a',strtotime($result[0]['booking_date'])),
						'end_date' => date('m/d/Y',strtotime($result[0]['end_date'])),
						'end_time' => date('h:i a',strtotime($result[0]['end_date'])),
						'booking_title' => $result[0]['booking_title'],
						'notes' => $result[0]['notes'],
						'name' => $result[0]['name'],
						'email' => $result[0]['email'],
						'current_module' =>$result[0]['module_id'],
						'current_record_id' => $result[0]['record_id'],
						'bookingId' => $result[0]['id'],
						'status' => $result[0]['status'],
						'suggested_date' => date('m/d/Y', strtotime($result[0]['praposed_date'])),
						'suggested_time' => date('h:i a', strtotime($result[0]['praposed_date'])),
						'praposed_notes' => $result[0]['praposed_notes'],
					);
				$emailTemplate = $this->load->view('emails/booking_suggestion',$email_data,true);

				$title = 'Booking Cancelled, Suggestion Information.';
				$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);

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
				//die;
				$data = array("info" => "Praposal Sent successfully",
							  "res" => "true");
				redirect('user/praposalStatus?action=true');
				//$this->load->view('user/cancelbooking',$data,true);
			}

		}
	}
	public function deleteCalendar()
	{
		$calId = $this->input->post("calendarId");
		
		$deleteCal = $this->App_model->rowsDelete('anb_crm_calendars', array('id'=>$calId));

		if($deleteCal){
			$deleteSharedCal = $this->App_model->rowsDelete('calendar_shared', array('calendar_id'=>$calId));
		}
		if($deleteSharedCal){
				$deletallevent = $this->App_model->rowsDelete('events', array('calendar_id'=>$calId));
		}
		if($deletallevent){
			$this->session->set_flashdata('success',"Calendar deleted successfully");
		}
	}
	public function deleteBooking()
	{
		$data = array();
		$booking_id = $_POST['booking_id'];
		$deletebooking = $this->App_model->rowsDelete('anb_crm_bookings', array('id'=>$booking_id));
		if($deletebooking){
			$data['success'] = true;
		}else{
			$data['success'] = false;
		}
		echo json_encode($data);  
		die;
	}
}
