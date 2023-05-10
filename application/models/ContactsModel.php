<?php
require_once 'BaseModel.php';
class ContactsModel extends BaseModel
{
	private $conn;
	public function __construct()
	{
		parent::__construct();
		$servername = "166.62.28.110";
		$username = "anbruch_wp4";
		$password = "A[3*7kWm&f~ueYScLb.03@[8";
		$dbname = "anbruch_wp4";

		$this->conn = new mysqli($servername, $username, $password, $dbname);

		if ($this->conn->connect_error) {
		    die("Connection failed: " . $this->conn->connect_error);
		} 

	}
	public function getRowCount()
	{
		$sql="SELECT * FROM wp_db7_forms where form_post_id = 597";

		if ($result=mysqli_query($this->conn,$sql))
		{
		  $rowcount=mysqli_num_rows($result);
		}
		return $rowcount;
	}
	public function getContactData($rowno=0,$rowperpage=10,$order = 'DESC',$order_by = 'form_id') 
    {
    	$sql = "select * from wp_db7_forms where form_post_id = 597 order by $order_by $order limit $rowperpage offset $rowno";
    	$result = $this->conn->query($sql);
    	$contacts = array();
    	if ($result->num_rows > 0) {
			$key = 0;
		    while($row = $result->fetch_assoc()) {
		        $contacts[] = unserialize($row["form_value"]);
		    	$contacts[$key]['form_id'] = $row['form_id'];
		    	$contacts[$key]['form_post_id'] = $row['form_post_id'];
		   		$key++; 
		    }
		}
		return $contacts;
	}
	public function deleteContacts($form_ids)
	{
		if(!empty($form_ids))
		{
			$status = false;
			foreach ($form_ids as $key => $form_id) {
				$sql = "Delete from wp_db7_forms where form_id = $form_id";
				if($this->conn->query($sql) === TRUE)
				{
					$status = true;
				}	
			}
			return $status;
		}		
	}
	public function getContact($form_id)
	{
		$sql = "select * from wp_db7_forms where form_id = $form_id";
    	$result = $this->conn->query($sql);
    	$contacts = array();
    	if ($result->num_rows > 0) {
			$key = 0;
		    while($row = $result->fetch_assoc()) {
		        $data = unserialize($row["form_value"]);
		        $meetingDate = date('m/d/Y', strtotime($data['Selectmeetingdate']));
		        if($meetingDate < date('m/d/Y'))
		        {
		        	$data['Selectmeetingdate'] = date('m/d/Y');
		        }
		        else
		        {
		        	$data['Selectmeetingdate'] = $meetingDate;
		        }
		    	$contacts[] = $data;
		    	$contacts[$key]['form_id'] = $row['form_id'];
		    	$contacts[$key]['form_post_id'] = $row['form_post_id'];
		   		$key++; 
		    }
		}
		return $contacts;
	}
	public function convertToBooking($data)
	{
		$status = false;
		if(!empty($data))
		{
			$webbooking = array(
				'booking_title' => !empty($data['booking_title']) ? $data['booking_title'] : 'NA',
				'booking_date' => !empty($data['start_date']) ? date('Y-m-d', strtotime($data['start_date'])).' '.date('H:i:s', strtotime($data['start_time'])) : '',
				'end_date' => !empty($data['start_date']) ? date('Y-m-d', strtotime($data['start_date'])).' '.date('H:i:s', strtotime($data['end_time'])) : '',
				'booking_address' => $data['location'],
				'name' => !empty($data['contact_name']) ? $data['contact_name'] : 'No name',
				'email' => !empty($data['email']) ? $data['email'] : 'No mail',
				'notes' => !empty($data['note']) ? $data['note'] : '',
				'created_for' => !empty($data['created_for']) ? $data['created_for'] : 1,
				'status' => 5,
			);
			//print_r($webbooking); die("ok");
			$insert_id = $this->App_model->rowInsert('anb_crm_bookings', $webbooking);
			$join = array(
				array(
					'table' => 'anb_crm_users as user',
					'on' => 'user.id = info.user_id',
				),
			);
			$officerData = $this->App_model->getData('anb_crm_users_personal_info as info', 'info.first_name, info.last_name, user.email', array('user_id' => $data['created_for']),$join)[0];
			$officerName = !empty($officerData['first_name']) && !empty($officerData['last_name']) ? $officerData['first_name'].' '.$officerData['last_name'] : 'Andrew Auger';
			$officerEmail = !empty($officerData['email']) ? $officerData['email'] : 'aauger@anbruch.com';
			//print_r($officerData); die("ok");
			if($insert_id)
			{

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
DTSTART:'.$this->dateToCal(date('Y-m-d', strtotime($data['start_date'])).'T'.date('H:i:s', strtotime($data['start_time']))).'
TZOFFSETFROM:-0500
TZOFFSETTO:-0400
TZNAME:EDT
END:DAYLIGHT
END:VTIMEZONE
BEGIN:VEVENT
DTSTAMP:' . $this->dateToCal(date("Y-m-dTH:i:s")) .'
UID:guid-1.example.com
ORGANIZER:mailto:'.$officerEmail.'
DESCRIPTION:'. addslashes($data["note"]) .'
CATEGORIES:MEETING
CLASS:PUBLIC
CREATED:' . $this->dateToCal(date("Y-m-dTH:i:s")) .'
SUMMARY:'.$data["booking_title"].'
DTSTART;TZID=America/New_York:'.$this->dateToCal(date('Y-m-d', strtotime($data['start_date'])).'T'.date('H:i:s', strtotime($data['start_time']))).'
DTEND;TZID=America/New_York:'.$this->dateToCal(date('Y-m-d', strtotime($data['start_date'])).'T'.date('H:i:s', strtotime($data['end_time']))).'
LOCATION:'.$data["location"].'
SEQUENCE:0
STATUS:CONFIRMED
TRANSP:TRANSPARENT
ESTIMATORID:'.$data['created_for'].'
END:VEVENT
END:VCALENDAR';
	
				file_put_contents("assets/uploads/booking.ics",$ics);
				$icsPath = base_url().'assets/uploads/booking.ics';
				$assignedData = array(
					'current_module_id' => 1,
					'leadassignedofficer' => $officerName,
					'name' => !empty($data['contact_name']) ? $data['contact_name'] : '',
					'email' => isset($data['email']) ? $data['email'] : " Email Not Available",
					'phone' => isset($data['phone']) ? $data['phone'] : "",
					'company' => isset($data['company']) && !empty($data['company']) ? $data['company'] : "No Company Name Available",
					'location' => $data['location'],
					'timezone' => isset($data['timezone']) ? $data['timezone'] : "Estern Time : US & Canada",
					'booking_title' => !empty($data['booking_title']) ? $data['booking_title'] : 'NA',
					'booking_date' => date('m/d/Y',strtotime($data['start_date'])),
					'booking_time' => date('h:i a',strtotime($data['start_time'])),
					'end_date' => date('m/d/Y',strtotime($data['start_date'])),
					'end_time' => date('h:i a',strtotime($data['end_time'])),
					'notes' => !empty($data['note']) ? $data['note'] : '',
					'city' => '',
					'country' => !empty($data['location']) ? $data['location'] : '',
				);
				$toName = $officerName;
				$toEmail = trim($data['email']);
				$subject = 'Your Booking is Confirmed! | Discussion: Corporate Savings Opportunities | '.date('F d', strtotime($data["start_date"])).' @'.date("H:i a",strtotime($data["start_time"])).' EST';
				$emailTemplate = $this->load->view('emails/webBookingAssigned',$assignedData,true);	
				$fromEmail = COMPANY_NOREPLY_EMAIL;
				$fromName = COMPANY_NAME;
				//$data1 = json_encode($assignedData);
				//$this->ModuleModel->saveEmail(1,$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data1);	
				$this->email->set_mailtype("html");
				$this->email->from($fromEmail);
				$this->email->to($officerEmail);
				$this->email->subject($subject);
				$this->email->message($emailTemplate);
				$this->email->attach($icsPath);
 				
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
					$status = true;
				}
				else
				{
					$status = false;
				}
				/*Invite guest */
				if(!empty($data['invite']))
				{
					$this->email->clear(TRUE);
					foreach ($data['invite'] as $key => $email) {
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
							$smtpconfig = $this->config->item('email2');
							$this->email->initialize($smtpconfig);
							$invitationData = $assignedData;
							$invitationData['acceptUrl'] = base_url("user/webBookingInvitation/?action=View&bid=$insert_id&email=$email&status=1&invitationId=$flag");

							$invitationData['declineUrl'] = base_url("user/webBookingInvitation/?action=View&bid=$insert_id&&email=$email&status=3&invitationId=$flag");

							$emailTemplate = $this->load->view('emails/webBookingInvitation',$invitationData,true);

							$subject = 'Discussion: Corporate Savings Opportunities | '.date('F d', strtotime($data["start_date"])).' @'.date("H:i a",strtotime($data["start_time"])).' EST';

							$fromEmail = COMPANY_NOREPLY_EMAIL;
							$fromName = COMPANY_NAME;
							$toEmail = trim($email);
							//$toName = "Guest";
							
							//$this->ModuleModel->saveEmail(1,$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$title,$emailTemplate);
							
							$this->email->from($fromEmail, 'Anbruch');
							$this->email->to($toEmail);
							$this->email->subject($subject);
							$this->email->message($emailTemplate);
							//$this->email->attach($icsPath);
							if($this->email->send())
							{
							}
							else{ echo 'Email not sent.';
							}
						}
					}
				}
			}
			return $status;
		}
	}
	public function dateToCal($time) {
        return date('Ymd\THis', strtotime($time)) . 'Z';
    }
}