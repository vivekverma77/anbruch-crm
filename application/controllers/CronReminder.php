<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once BASEPATH . "../application/libraries/utilities.php";

class CronReminder extends CI_Controller
{

	public function __construct()
	{
			parent::__construct();
			$this->load->model("BookingModel");
			$this->load->library('email');
 			$this->email->set_mailtype('html');
	}

	public function send_notification(){
			//date_default_timezone_set("Asia/Kolkata");

		$result = $this->BookingModel->send_notification();
				$current_time = date('Y-m-d H:i');
				var_dump($current_time);
			foreach ($result as $value) {
				$updated_time = date('Y-m-d',strtotime($value['notification_date'])).' '.date('H:i', strtotime($value['notification_time']));
				var_dump($updated_time);
				if($current_time == $updated_time)
				{
				   $fromEmail = COMPANY_NOREPLY_EMAIL;
					$data = array(
						'heading_text' => 'Booking Notification',
						'booking_id' => $value['id'],
						'booking_date' => date('m/d/Y',strtotime($value['booking_date'])),
						'booking_time' => date('H:i',strtotime($value['booking_date'])),
						'end_date' => date('m/d/Y',strtotime($value['end_date'])),
						'end_time' => date('H:i',strtotime($value['end_date'])),
						'booking_title' => $value['booking_title'],
						'notes' => $value['notes'],
						'name' => $value['name'],
						'email' => $value['email'],
						'current_module' => '',
						'current_record_id' => !empty($value['record_id']) ? $value['record_id'] : '',
						'record_status' => '',
						'bookingId'	=> 	$value['id'],
						'status' => $value['status'],
						'conference'=>$value['conference'],
						'address'=>$value['booking_address'],
					);
					$emailTemplate = $this->load->view('emails/Booking_notification',$data,true);

					$title = 'Booking Notification';
						$this->email->from($fromEmail);
						$this->email->to($value['email']);
						$this->email->subject($title);
						$this->email->message($emailTemplate);
						if($this->email->send())
					  	{ echo "success"; } else { echo "error"; }

					}
					else{
						echo "time is not in slot";
					}
			 }


		}
}
?>