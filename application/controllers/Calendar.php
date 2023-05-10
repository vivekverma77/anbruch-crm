<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once 'Base.php';
require_once  APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Calendar extends Base
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
      $this->load->model("app_model");
      $this->load->library('email');
      // $smtpconfig = $this->config->item('email');
      // $this->email->initialize($smtpconfig);
      $this->email->set_mailtype('html');
  }


    public function index() {
        $this->data['calendars'] = $this->app_model->getData('anb_crm_calendars',array('name','timezone','owner','id','color'),false,false,'name','ASC');
        $this->viewLoad('calendar/index');
    }
   /*

   Action: add
   Purpose: Create new calendar job 
   */ 
   public function add() 
   {
     if($this->input->post())
    {
    $jobData = $this->input->post();
    $notification = array();
        $jobDataArray = array(
              'title' => $jobData['booking_title'],
              'start_date' => date("Y-m-d",strtotime($jobData['start_date'])),
              'start_time' => date("H:i:s",strtotime($jobData['start_time'])),
              'end_date' => date("Y-m-d",strtotime($jobData['end_date'])),
              'end_time' => date("H:i:s",strtotime($jobData['end_time'])),
              'notes' => $jobData['notes'],
              'location' => isset($jobData['event_location']) ? $jobData['event_location'] :'',
              //'visibility' => $jobData['visibility'],
              'calendar_id' => $jobData['calendar_type'],
              'all_day' => isset($jobData['all_day']) ? $jobData['all_day']: 0,
              'created_at' => date("Y-m-d H:i:s"), 
              'conference'=> isset($jobData['conference']) ? $jobData['conference'] :''
            ); 
      /*Send Notification Start*/
    if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via'])){
              $notification_interval = $jobData['notification_interval'];
                   
              switch ($jobDataArray['all_day']) { 
                case 0:
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
                         case 3:
                                $notification = array(
                                        
                                        'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])-60*$notification_interval),
                                        'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
                        break;
                      }
                break; 
                case 1:
                      switch ($jobData['notification_type']){
                        case 1:
                            $notification = array(
                                    
                                    'notification_time'=> date("H:i:s",strtotime("11:00:00")),
                                    'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
                        break;
                        case 2:   
                              $date = date_create($jobData['start_date']);
                              date_sub($date, date_interval_create_from_date_string($notification_interval.' days'));
                              $notification = array(
                                   
                                    'notification_time'=> date("H:i:s",strtotime("11:00:00")),
                                    'notification_date'=> date_format($date, 'Y-m-d'),);                                       
                        break;
                       case 3:
                            $notification = array(
                                    
                                    'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])-60*$notification_interval),
                                    'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
                         break;
                      }
                break;
              }     
          }
            /*Send Notification end*/  
          
    /*
            if(!empty($jobData['repeat']) && !empty($jobData['repeat']))
                  {
                    switch ($jobData['repeat']) {
                          case 1:
                              $jobDataArray['repeat_type'] = 1;
                              $jobDataArray['repeat_event'] = json_encode(array(0,1,2,3,4,5,6));
                              break;
                          case 2:
                              $jobDataArray['repeat_type'] = 2;
                              $jobDataArray['repeat_event'] = date("w",strtotime($jobData['start_date'])); 
                              break;
                          case 0:
                              $jobDataArray['repeat_type'] = 0;
                              break;
                          default:
                      }
                  }*/
                  

        /* add reminder */
         if(!empty($jobData['notify_by']) && !empty($jobData['notify_before']))
         {
           $jobDataArray['notify_by'] = $jobData['notify_by'];
           $jobDataArray['notify_before'] = $jobData['notify_before'];
           $jobDataArray['notify_on'] = isset($jobData['notify_on']) ? $jobData['notify_on'] : '';
         }

        
        /* attachment */
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
        $jobDataArray['attachment'] = (isset($upload_data) && !empty($upload_data) && isset($upload_data['file_name']))? $upload_data['file_name'] : '';
      }
        
      $job_id = $this->app_model->rowInsert('events',$jobDataArray);      
      

      /*Send Notification*/
    if(!empty($jobData['invite'])){
       if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via'])){
                    $notification['event_id'] = $job_id;
                    $notification['created_by'] = $_SESSION['user_id'];
                    $notification['status'] = 1;
                    $notification['notification_via'] = $jobData['notification_via'];
                    $notification['notification_interval'] = $jobData['notification_interval'];
                    $notification['notification_type'] = $jobData['notification_type'];
                    $notification_id = $this->app_model->rowInsert('event_notification',$notification);
               }
      }

     /*Send Notification End*/                           
      $result = array();

      if($job_id>0)
      {
       
        $result['message'] = 'Job added successfully';
        $result['success'] = true;
      }        
    
    }
   /*Invitess */

    if(!empty($jobData['invite']))
    {
      $sent_email = $this->invite($job_id, $jobData['invite']);
      //echo"<pre>"; print_r($sent_email);die('test');
      $result['sent_email'] = $sent_email;
    }
     echo json_encode($result); die();
   }


   public function getReminderEvent(){
       
       $reminder=[];

       $user_id = $this->session->userdata['user_id'];
       $role_id = $this->session->userdata['role_id'];
       if($user_id){
         
         $join = array(
          array(
            "table" => "anb_crm_record_meta_value as mv",
            "on" => "mv.record_id = rem.record_id"
          ),
          array(
            "table" => "anb_crm_users_personal_info as upi",
            "on" => "upi.user_id = rem.user_id"
          ),
          array(
            "table" => "anb_crm_record as r",
            "on" => "r.id = rem.record_id"
          )
         );

         $join_booking=array(
          array(
            "table" => "anb_crm_bookings as mv",
            "on" => "mv.id = rem.record_id",
            "join"=>"inner join",
          ),
          array(
            "table" => "anb_crm_users_personal_info as upi",
            "on" => "upi.user_id = rem.user_id"
          )
         );

         $or_where=array(
              array('or_where'=>"mv.record_meta_id",'value'=>31),
              array('or_where'=>"mv.record_meta_id",'value'=>84),
              array('or_where'=>"mv.record_meta_id",'value'=>197)
              );

         if($role_id == 1 || $role_id == 7)
         {
            $res = $this->app_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.value','r.module_id','upi.first_name', 'upi.last_name'),false,$or_where,$join,'rem.remind_date','ASC');
            $book_rem = $this->app_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.booking_title as value','upi.first_name', 'upi.last_name'),false,false,$join_booking,'rem.remind_date','ASC');

            $reminder = array_merge($res,$book_rem);

         }
         else
         {
            $res = $this->app_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.value','r.module_id','upi.first_name', 'upi.last_name'),array('rem.user_id'=>$user_id),$or_where,$join,'rem.remind_date','ASC');

            $book_rem = $this->app_model->getAllData('anb_crm_reminder as rem',array('rem.*', 'mv.booking_title as value','upi.first_name', 'upi.last_name'),array('rem.user_id'=>$user_id),false,$join_booking,'rem.remind_date','ASC');

            $reminder = array_merge($res,$book_rem);
          
         }

      } 
       
      if(!empty($reminder)){

        foreach ($reminder as $key => $value) {
              $reminder[$key]['id']=$value['id'];
              $reminder[$key]['start']=$value['remind_date'];
              $reminder[$key]['end']=$value['remind_date'];
              $reminder[$key]['title']=$value['task'];
              $reminder[$key]['color']='#f47e2a';
              $reminder[$key]['className']='reminder-event';
              $reminder[$key]['class']='reminder_event';
              $reminder[$key]['remind_date']=date('m/d/Y H:i',strtotime($value['remind_date']));
        }

       }
       echo json_encode($reminder);die(); 
   }

   public function getJobsEvent()
   {
      if($this->input->post())
      {
        $post = $this->input->post();
        $estIds  = $post['est_Ids'];
      }else
      {
        $estIds = null;
      }
     // print_r($estIds);die();
       $join = array(
                array(
                    "table" => 'anb_crm_calendars',
                    "on" => 'anb_crm_calendars.id = events.calendar_id'
                )

            );
      if(isset($estIds))
      { 
        
       $calendarJobs = $this->app_model->getWhereInData('events', array('events.id', 'title','location','start_date','end_date','notes','all_day','anb_crm_calendars.color','attachment','calendar_id','start_time','end_time','anb_crm_calendars.name as calendar_name'),$estIds,'calendar_id',$join);
       }else
       {

         $user_calendar_ids = $this->app_model->getData('calendar_shared',array('calendar_id','access'),array('user_id'=> $this->session->userdata('user_id')));
         $userCals[] = 1;
         if(!empty($user_calendar_ids)){
          foreach ($user_calendar_ids as $key => $value) {
            $userCals[] = $value['calendar_id'];
          }
         }
         $calendarJobs = $this->app_model->getWhereInData('events', array('events.id', 'title','location','start_date','end_date','notes','all_day','repeat_type','repeat_event','anb_crm_calendars.color','attachment','calendar_id','start_time','end_time','anb_crm_calendars.name as calendar_name', 'conference'),$userCals,'calendar_id',$join);
       }
      
        $data_events = array();
       /* print_r($calendarJobs);*/

        if (!empty($calendarJobs)) {
        
            foreach ($calendarJobs as $value) {
                ini_set('memory_limit', '-1');
                $data_events[] = array(
                    "id" => $value['id'],
                    "title" => (isset($value['title']) && !empty($value['title']) ? $value['title'] : ''),
                    "start" => $value['all_day'] == 1 ? $value['start_date'] : $value['start_date'].' '.$value['start_time'] ,
                    "end" =>  $value['all_day'] == 1 ? $value['end_date'] : $value['end_date'].' '.$value['end_time'],
                    "dow" => !empty($value['repeat_event']) ? $value['repeat_event']:'',
                     //"startRecur"=> $value['start_date'],
                    //"endRecur" => '2019-05-05',
                    //"ranges" => json_encode(array('end'=> '2018-02-1')),
                    "description" =>  (isset($value['notes']) && !empty($value['notes']) ? $value['notes'] : ''),
                    "endDay" => $value['end_date'],
                    "end_date" => !empty($value['end_date']) ? date('m/d/Y',strtotime($value['end_date'])):'',
                    "color" => 'black', //'#d2691e',
                    "allDay" => $value['all_day'] == 1 ? true : false,
                    "startTime" =>  !empty($value['start_date']) ? date('h:i a',strtotime($value['start_date'])):'',
                    "endTime" =>  !empty($value['end_time']) ? date('h:i a',strtotime($value['end_time'])):'', 
                    "allDayEvent" => $value['all_day'],
                    "invitations" =>  $this->app_model->getData('calendar_invitations', array('*'),array('event_id' => $value['id'])),
                     "repeat_type" => !empty($value['repeat_type']) ? $value['repeat_type']:'', 
                     "attachment" => !empty($value['attachment']) ? $value['attachment']:'', 
                     "notes" => !empty($value['notes']) ? $value['notes']:'', 
                     "calendar_id" => !empty($value['calendar_id']) ? $value['calendar_id'] : '', 
                     "class" => "calendar_event",
                     "access" => isset($user_calendar_ids) ? $user_calendar_ids : '',
                     "calendar_name" => isset($value['calendar_name']) ? $value['calendar_name'] : '', 
                     "location" => isset($value['location']) ? $value['location'] : '',
                     /*"timezoneParam" =>  "America/Chicago",*/
                     "conference" => isset($value['conference']) ? $value['conference'] : '',
                     "notification" => $this->app_model->getData('event_notification', array('notification_via','notification_interval','notification_type'), array('event_id'=> $value['id'])),
                );
            }
        }      
        echo json_encode(array("events" => $data_events));
        exit();
   } 
   /*
   Action: update
   Purpose: Update calendar job 
   */ 
  public function update() 
   {
      
    
    if($this->input->post())
    {
      $jobData = $this->input->post();
     if(isset($jobData['dragEvent']))
     {
        if(!empty($jobData['start']))
        {
          $updated_time = date('Y-m-d H:i:s',strtotime($jobData['start']));
          $current_time = date('Y-m-d H:i:s');
          if($current_time > $updated_time)
          {
            $result = array("message" => "Event can not be updated in past.",
                    "success" => false);
            echo json_encode($result); die();
          }
        }
        $event_id = $jobData['id'];
        $start_date = explode('T', $jobData['start']);
        $start_time = $start_date[1];
        $start_date = $start_date[0];
        $end_date = explode('T', $jobData['end']);
        $end_time = $end_date[1];
        $end_date = $end_date[0];
        $status = $this->app_model->rowUpdate('events',array('start_date' => $start_date,'start_time' => $start_time, 'end_date' => $end_date, 'end_time' => $end_time), array('id' => $event_id));
        if($status)
        {
          $invite = $this->app_model->getData('calendar_invitations','*',array('event_id' => $event_id));
          $this->app_model->rowsDelete('calendar_invitations',array('event_id' => $event_id));
          if(!empty($invite))
          {
            $emails = array();
            foreach ($invite as $key => $value) {
              $emails[] = $value['sent_email'];
            }
            if(!empty($emails))
            {
              $sent_email = $this->invite($event_id, $emails);
              $result['sent_email'] = $sent_email;
            }
          }
          $result['message'] = 'Job updated successfully';
          $result['success'] = true;
          echo json_encode($result);die();
        }
        else
        {
          $result['message'] = 'something went wrong';
          $result['success'] = false;
          echo json_encode($result);die();
        }
     }
     if(!empty($jobData['start_date']) && !empty($jobData['event_id']))
     {
        if($this->array_has_dupes($jobData['invite'])){
          $result['message'] = 'Email Can not be same';
          $result['success'] = false;
          echo json_encode($result);die();
        }

        $jobDataArray = array(
                        //'job_name' => $jobData['jobName'],
                        ///'job_address' => $jobData['jobAddress'],
                        //'arrival_time' => $jobData['arrivalTime'],
                        //'estimator_id' => $jobData['estimator'],
                        'title' => $jobData['booking_title'],
                        'start_date' => date("Y-m-d",strtotime($jobData['start_date'])),
                        'start_time' => date("H:i:s",strtotime($jobData['start_time'])),
                        'end_date' => date("Y-m-d",strtotime($jobData['end_date'])),
                        'end_time' => date("H:i:s",strtotime($jobData['end_time'])),
                        'location' => isset($jobData['event_location']) ? $jobData['event_location'] :'',
                        'notes' => $jobData['notes'],
                       // 'visibility' => $jobData['visibility'],
                        'calendar_id' => $jobData['calendar_type'],
                        'all_day' => isset($jobData['all_day']) ? 1: 0,
                        'updated_at' => date("Y-m-d H:i:s"),
                         'conference'=> isset($jobData['conference']) ? $jobData['conference'] :''
                        //'repeat_event' =>  isset($jobData['repeat']) ? $jobData['repeat']: '' 
                         );
     /* Repeat function to adding and editing events */
    // if(!empty($jobData['repeat']) && !empty($jobData['repeat']))
    // {
    //   switch ($jobData['repeat']) {
    //         case 1:
    //             $jobDataArray['repeat_type'] = 1;
    //             $jobDataArray['repeat_event'] = json_encode(array(0,1,2,3,4,5,6));
    //             break;
    //         case 2:
    //             $jobDataArray['repeat_type'] = 2;
    //             $jobDataArray['repeat_event'] = date("w",strtotime($jobData['startDay'])); 
    //             break;
    //         case 3:
    //             $jobDataArray['repeat_type'] = 3;
    //             break;
    //         default:
    //     }
    // }


             /*Send Notification Start*/
     
    if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via'])){
            $notification_interval = $jobData['notification_interval'];
              switch ($jobDataArray['all_day']) { 
                case 0:
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
                        case 3:
                                $notification = array(
                                        
                                        'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])-60*$notification_interval),
                                        'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
                        break;
                      }
                break; 
                case 1:
                      switch ($jobData['notification_type']){
                        case 1:
                            $notification = array(
                                    
                                    'notification_time'=> date("H:i:s",strtotime("11:00:00")),
                                    'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
                        break;
                        case 2:   
                              $date = date_create($jobData['start_date']);
                              date_sub($date, date_interval_create_from_date_string($notification_interval.' days'));
                              $notification = array(
                                   
                                    'notification_time'=> date("H:i:s",strtotime("11:00:00")),
                                    'notification_date'=> date_format($date, 'Y-m-d'),);                                       
                        break;
                        case 3:
                                $notification = array(
                                        
                                        'notification_time'=> date("H:i:s",strtotime($jobData['start_time'])-60*$notification_interval),
                                        'notification_date'=> date("Y-m-d",strtotime($jobData['start_date'])),);
                        break;
                      }
                break;
              }
          }
            /*Send Notification end*/    

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
        $jobDataArray['attachment'] = (isset($upload_data) && !empty($upload_data) && isset($upload_data['file_name']))? $upload_data['file_name'] : '';
      }

    $job_id = $this->app_model->rowUpdate('events',$jobDataArray,array('id' => $jobData['event_id'])); 
      
      if(!empty($jobData['notification_type']) && !empty($jobData['notification_interval']) && !empty($jobData['notification_via'])){
                $notification['event_id'] = $jobData['event_id'];
                $notification['created_by'] = $_SESSION['user_id'];
                $notification['status'] = 1;
                $notification['notification_via'] = $jobData['notification_via'];
                $notification['notification_interval'] = $jobData['notification_interval'];
                $notification['notification_type'] = $jobData['notification_type'];
           }
    
            
            
    $result =  array();
      if($job_id > 0)
      {
       // $this->session->set_flashdata('success', 'Job update successfully');
       $result['message'] = 'Job updated successfully';
       $result['success'] = true;
      }        
    }else
    {
        $result['message'] = 'Job name and Start date can not be empty.';
        $result['success'] = false;
        echo json_encode($result);die();
    }  
    /*Invitess */
    if(!empty($jobData['invite']))
    {
      $sent_email = $this->invite($jobData['event_id'], $jobData['invite']);
      $result['sent_email'] = $sent_email;
    }

    /*Count Invities and events*/
         $checkId = $this->app_model->getRowCount('event_notification', 'event_id', array('event_id'=> $jobData['event_id']));           
    $findInvities = $this->app_model->getRowCount('calendar_invitations', 'event_id', array('event_id'=> $jobData['event_id']));           
    if($checkId>0 && isset($notification)){
                $this->db->where('event_id', $jobData['event_id']);
                $recordUpdateSuccessful = $this->db->update("event_notification", $notification);
              }
    else if($findInvities>0 && isset($notification)){
                $notification_id = $this->app_model->rowInsert('event_notification',$notification);
          }
   }
    echo json_encode($result);die();
 }     

  public function dropEvent()
  {
     if($this->input->post())
    {
    $jobData = $this->input->post();

    $jobDataArray = array(
                          'start_date' => date("Y-m-d",strtotime($jobData['drop_on_date'])).' '.date("H:i:s",strtotime($jobData['drop_on_time']))
                         );
    $job_id = $this->app_model->rowUpdate('calendar_jobs',$jobDataArray,array('id' => $jobData['job_event_id']));
    $result =  array();
      if($job_id > 0)
      {
       // $this->session->set_flashdata('success', 'Job update successfully');
       $result['message'] = 'Job updated successfully';
       $result['success'] = true;
      }        
    }else
    {
        die("Invalid");
    }
     echo json_encode($result);die();
   }
   
   public function dateToCal($time) {
    return date('Ymd\This', strtotime($time)) . 'Z';
  }

   public function exportEvents()
   {   
      $join = array(
                array(
                    "table" => 'user_login',
                    "on" => 'calendar_jobs.estimator_id = user_login.id'
                )
            );        
     $calendarJobs = $this->app_model->getData('calendar_jobs', array('calendar_jobs.id', 'job_name','job_address', 'arrival_time', 'estimator_id','start_date','end_date','notes','color','background_color','all_day','created_at'),false,$join);

     //print_r($calendarJobs);
     if(!empty($calendarJobs))
     {
     $ics = 'BEGIN:VCALENDAR
PRODID:-//Google Inc//Google Calendar 70.9054//EN
VERSION:2.0
CALSCALE:GREGORIAN
X-WR-TIMEZONE:'.date_default_timezone_get().'
';   
      foreach ($calendarJobs as $key => $value) {
       // echo $value["start_date"]."<br>";
       $allDay = $value["all_day"] == 1 ? "true" : "false";
$ics .= 
'BEGIN:VEVENT
DTEND;VALUE=DATE:' . $this->dateToCal(date("Ymd",strtotime($value["end_date"]))) . '
DTSTAMP:' . time() . '
SUMMARY:'.$value['job_name'].'
DESCRIPTION:'. addslashes($value['notes']) .'
DTSTART;VALUE=DATE:' .$this->dateToCal(date("Ymd",strtotime($value["start_date"]))).'
AFFC-ALLDAY:'.$allDay.'
AFFC-COLOR:'.$value["color"].'
LOCATION:'.$value["job_address"].'
ARRIVALTIME:'.$value["arrival_time"].'
ESTIMATORID:'.$value["estimator_id"].'
CREATED:'.$this->dateToCal(date("Ymd",strtotime($value["created_at"]))).'
AFFC-UID:0
END:VEVENT
';       
   }
$ics .= 
'END:VCALENDAR';
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=jobs-event.ics');
echo $ics;     
 }else
 {
  $this->session->set_flashdata('error', 'There are no event available to export');
  redirect(base_url('calendar'));
 }
} 
 public function importEvent($filename = '')
 {
  if(!empty($filename))
  {
    /* Replace the URL / file path with the .ics url */
    $file = base_url("uploads/events/$filename");
    /* Getting events from isc file */
    $obj = new ics();
    $icsEvents = $obj->getIcsEventsAsArray( $file );
    //print_r($icsEvents);die();
    $timeZone = trim ( $icsEvents [1] ['X-WR-TIMEZONE'] );
    unset( $icsEvents [1] );
    $rowCount = 0;
    $response = array();
    foreach( $icsEvents as $icsEvent)
    { 
        //print_r($icsEvent);
            /* Getting start date and time */
          $start = null; 
          if(isset($icsEvent ['DTSTART;VALUE=DATE'])){
            $start = $icsEvent ['DTSTART;VALUE=DATE'];
          }elseif (isset($icsEvent ['DTSTART'])) {
           $start = $icsEvent ['DTSTART'];
          }elseif (isset($icsEvent ["DTSTART;TZID=$timeZone"])) {
            $start = $icsEvent ["DTSTART;TZID=$timeZone"];
          }
         
         /* Getting the name of event */
          $eventName = isset($icsEvent['SUMMARY']) ? $icsEvent['SUMMARY']:'';
       // echo $start;  
      if(!empty($start) && !empty($eventName)){   
        
            $startDt = new DateTime ( $start );
            $startDt->setTimeZone ( new DateTimezone ( $timeZone ) );
            $startDate = $startDt->format ( 'Y-m-d h:i:s' );
            /* Getting end date with time */
            $end = null;
           if(isset($icsEvent ['DTEND;VALUE=DATE'])){
             $end = $icsEvent ['DTEND;VALUE=DATE'];
           }elseif(isset($icsEvent ['DTEND'])) {
            $end = $icsEvent ['DTEND'];
           }elseif (isset($icsEvent ["DTEND;TZID=$timeZone"])) {
            $end = $icsEvent ["DTEND;TZID=$timeZone"];
           } 
            // echo $startDate.'<br/>';
            $endDt = new DateTime ( $end );
            $endDate = $endDt->format ( 'Y-m-d h:i:s' );

            $allDay =  isset($icsEvent['AFFC-ALLDAY']) ? $icsEvent['AFFC-ALLDAY'] : '';
            $notes =  isset($icsEvent['DESCRIPTION']) ? $icsEvent['DESCRIPTION']:'';
            $location =  isset($icsEvent['LOCATION']) ? $icsEvent['LOCATION'] : '';
            $arrival_time =  isset($icsEvent['ARRIVALTIME']) ? $icsEvent['ARRIVALTIME'] : '';
            $estimator_id =  isset($icsEvent['ESTIMATORID']) ? $icsEvent['ESTIMATORID'] : '';

            $created_at =  isset($icsEvent['CREATED']) ? $icsEvent['CREATED'] : '';
            $created = new DateTime ( $created_at );
            $created_date = $created->format ( 'Y-m-d h:i:s' );
            
           
       $jobDataArray = array(
                        'job_name' => $eventName,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'notes' => $notes,
                        'all_day' => $allDay == "true" ? 1 : 0,
                        'job_address' => $location,
                        'arrival_time' => $arrival_time,
                        'estimator_id' => $estimator_id,
                        'created_at' => $created_date
                         );

          $job_id = $this->app_model->rowInsert('calendar_jobs',$jobDataArray);
          if($job_id > 0)
           {
            $rowCount = intval($rowCount) + 1;
           }
        }        
    }
    //die();
    $response['message'] = "<b>$rowCount Events Imported. </b>";

   if (file_exists(FCPATH."uploads/events/$filename")) 
      {
          unlink(FCPATH."uploads/events/$filename");
      }
    echo json_encode($response);die();           
  }
    
 }
 public function fileUpload1()
 {
  //die("sadsa");
 
  if (isset($_FILES) && !empty($_FILES)) 
  {
     if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){           
                $config['upload_path'] = 'uploads/events';
                $config['allowed_types'] = '*';
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')) 
                {
                    $data_error = array('msg' => $this->upload->display_errors());
                  // var_dump($data_error);
                } else 
                {
                    $data = $this->upload->data();
                    $file_name = $data['file_name'];
                    chmod(FCPATH."uploads/events/$file_name",0777);
                    $this->importEvent($file_name);
                }
     }
   }
  }
  /*function for delete the event */
  public function delete($eventId = 0)
  {
    $data = array();
    if(!empty($eventId))
    {
      $status = $this->app_model->rowsDelete('events',array('id' => $eventId));
      if($status == true)
      {
        $data['success'] = $status;
        $data['message'] = "Event deleted successfully";
      }
    }
    echo json_encode($data);die();
  }
  /* Invitess */
  public function invite($eventId = 0,$emails = '')
  {
    
    //$eventId = 1;
   // $emails = array("vivekverma896@gmail.com","softgetix.test@gmail.com");
    error_reporting(0);
    if(!empty($eventId) && !empty($emails))
    {

       //$token = "n0L0yoeMLQSttAzOCfdd82tUVBk";
       $this->load->helper('rand_helper');
       $token = generateRandomString();

       $data['jobData'] = $this->app_model->getData('events', array('id', 'title','location','start_date','end_date','start_time','end_time','notes','all_day','attachment','conference'),array('id'=> $eventId));

       $attachment = !empty($data['jobData']) && !empty($data['jobData'][0]) && !empty($data['jobData'][0]['attachment']) ? $data['jobData'][0]['attachment'] : '';
       $resultArray = array();
       /*print_r($data);
       die;*/
       foreach ($emails as $key => $email) {
       if($email!="" && filter_var($email, FILTER_VALIDATE_EMAIL))
       { 
        $mailSend = $this->app_model->getRowCount('calendar_invitations', array('id'), array('event_id' => $eventId, 'sent_email' => $email ));
        //if(empty($mailSend))
        //{
        $invitationId = $this->app_model->rowInsert('calendar_invitations',array('sent_email'=> $email,'status' => 1, 'event_id' => $eventId,'access_token' => $token));
        //}
        $timeZone = date_default_timezone_get();
        $subject = "Invitation";
        $data['acceptUrl'] = base_url("invitation/job/job?action=View&eid=$eventId&token=$token&email=$email&status=2&invitationId=$invitationId");
        $data['declineUrl'] = base_url("invitation/job/job?action=View&eid=$eventId&token=$token&email=$email&status=3&invitationId=$invitationId");

        $msg = $this->load->view('email-template/invitation', $data, TRUE);
        // print_r($msg);
        // die('test');
         $this->email->set_mailtype("html");
         $this->email->from(COMPANY_NOREPLY_EMAIL);
         $this->email->to($email);
         $this->email->subject($subject); 
         $this->email->message($msg);
         if(!empty($attachment)){ 
          $this->email->attach(FCPATH."upload/event/$attachment");
         }
         $result =  $this->email->send();
        if (!$result){
          // $data['success'] = $this->email->print_debugger();
          // print_r($this->email->print_debugger());die();
          }
          else{
            
                $resultArray['success'] = $result;
                //$resultArray[] = $email;
          }
         } 
       }
        return $resultArray;die();
    }
  }

  public function createcalendar()
  {
    $this->viewLoad("calendar/createcalendar");
    if($this->input->post())
    {
      
      $calendarData = $this->input->post();
     if(!empty($calendarData['name']))
     {
      $calendarDataArray = array(
                         'name' => isset($calendarData['name']) ? $calendarData['name']:'',
                         'timezone' => isset($calendarData['timezones']) ? $calendarData['timezones']:'',
                         'owner' => isset($calendarData['owner']) ? $calendarData['owner']:'',
                         'color' => isset($calendarData['color']) ? $calendarData['color']:'',
                         'created_at' => date("Y-m-d H:i:s"),
                         'created_by' => $this->session->userdata('user_id'), 
                          );
      $cId = $this->app_model->rowInsert('anb_crm_calendars',$calendarDataArray);
      $this->app_model->rowInsert('calendar_shared',array('  calendar_id' => $cId ,'user_id' => $this->session->userdata('user_id') ,'user_email' => $this->session->userdata('email'),'access' => 1));

      if($cId > 0){
        $this->session->set_flashdata('success', 'Calendar added successfully');
        redirect('booking');
      }
      die();
      
     }else
     {
      die();
     } 
      
    }
  }

  public function eventadd()
  {
    $this->data['eventData'] = $this->input->post();
    $this->data['calendars'] = $this->app_model->getData('anb_crm_calendars',array('name','timezone','owner','id','color'),false,false,'name','ASC');
    $this->viewLoad('calendar/add',$this->data);
  }
   public function print($eventId = 1)
   {  
       $join = array(
          array(
              "table" => 'anb_crm_calendars',
              "on" => 'anb_crm_calendars.id = events.calendar_id'
          )
      );        
      $data['calendarJobs'] = $this->app_model->getData('events', array('events.id', 'title','location','start_date','end_date','notes','all_day','anb_crm_calendars.color','attachment','calendar_id','start_time','end_time','anb_crm_calendars.name as calendar_name'),array('events.id'=> $eventId ),$join);
        if (!empty($data)) {
            foreach ($data['calendarJobs'] as $key => $value) {
                    $data["invitations"][$key] =  $this->app_model->getData('calendar_invitations', array('*'),array('event_id' => $value['id']));
            }
        }

      $title =  !empty($data['calendarJobs'][0]) && !empty($data['calendarJobs'][0]['start_date']) ? $data['calendarJobs'][0]['start_date'] : ''; 
    // print_r($data);die("end");
      $html=$this->load->view('pdf/event',$data,true);
      //echo $html;die();
      $dompdf = new Dompdf(array('enable_remote' => true));
      $dompdf->loadHtml($html);
      $dompdf->setPaper('A4', 'portrait');
      $dompdf->render();
      //$dompdf->stream("Event");
      $output = $dompdf->output();
      file_put_contents(FCPATH."upload/pdf/Event-$title.pdf", $output);
      $response = array();
      $response['success'] = true;
      $response['file'] = "Event-$title.pdf";
      echo json_encode($response);die();
  }
   public function duplicate($eventId = 1)
   {  
       $join = array(
          array(
              "table" => 'anb_crm_calendars',
              "on" => 'anb_crm_calendars.id = events.calendar_id'
          )
      );        
      $data['calendarJobs'] = $this->app_model->getData('events', array('events.id', 'title','location','start_date','end_date','notes','all_day','anb_crm_calendars.color','attachment','calendar_id','start_time','end_time'),array('events.id'=> $eventId ),$join);
        if (!empty($data)) {
            foreach ($data['calendarJobs'] as $key => $value) {
                    $data["invitations"][$key] =  $this->app_model->getData('calendar_invitations', array('*'),array('event_id' => $value['id']));
            }
        }

      $title =  !empty($data['calendarJobs'][0]) && !empty($data['calendarJobs'][0]['start_date']) ? $data['calendarJobs'][0]['start_date'] : ''; 
    // print_r($data);die("end");
      
      echo json_encode($data);die();
  }
  public function share()
  {
    if($this->input->post())
    {
      //print_r($this->input->post());die();
      $calendarData = $this->input->post();
     if(!empty($calendarData['calendar_id']) && !empty($calendarData['user']))
     {
      $user_ids = $calendarData['user'];
      $calendarDataArray['calendar_id'] = isset($calendarData['calendar_id']) ? $calendarData['calendar_id'] : '';
      $calData = $this->app_model->getData('anb_crm_calendars',array('name'),array('id'=> $calendarData['calendar_id'] ));
      $calName = $calData[0]['name'];

      $sent_emails = '';
      foreach ($user_ids as $key => $value) {
        $userData = $this->app_model->getData('anb_crm_users',array('email'),array('id'=> $value ));
        $userEmail =   $userData[0]['email'];
        $calendarDataArray['user_email'] = $userEmail;
        $calendarDataArray['user_id'] = $value;
        $calendarDataArray['access'] = 2;

        $emailDataArray = array();
        $emailDataArray['user_email'] = $userEmail;
        $emailDataArray['calName'] = $calName;

        $cId = $this->app_model->rowInsert('calendar_shared',$calendarDataArray);

        
          $emailTemplate = $this->load->view('email-template/shared_calendar',$emailDataArray,true);
            $title = $this->session->userdata('email').' has shared a calendar with you';
            $this->email->from($this->session->userdata('email'));
            $this->email->to($userEmail);
            $this->email->subject($title);
            $this->email->message($emailTemplate);
            if($this->email->send())
            {
             //~ echo 'Email sent.';
              $sent_emails .= $userEmail.'  ';
              $notify_msg = "Notification sent to <b>$sent_emails.</b>"; 
            }
            else
            {
             //~ echo 'Email not sent.';
            }
          
          }
          if($cId > 0){
            if(!empty($notify_msg)){
              $this->session->set_flashdata('success', "Calendar shared successfully & $notify_msg");
            }else{
              $this->session->set_flashdata('success', "Calendar shared successfully.");
            }
          redirect('booking');
         } 
      }
      
     }else
     {
      die("Invalid Request.");
     } 
    
  }
  public function test(){
      $data_events = array('googleCalendarApiKey' => 'AIzaSyDzUvSPXi93saIWTnMO70RG0-w4e54ipQo','googleCalendarId' => 'en.indian#holiday@group.v.calendar.google.com');

     echo json_encode(array("events" => $data_events));
     die();
  }
  
  public function getEventNotification(){
       $notificationData = $this->ModuleModel->getEventEmailReminder(); //get all data
       $todayDate = strtotime(date("Y-m-d H:i")); //find today date and time
       $fromEmail = COMPANY_NOREPLY_EMAIL;
       foreach ($notificationData as $data => $value){
          $notificationTime = $value['notification_date'].' '.$value['notification_time']; //itrate time for each value pair
          $notificationTime = strtotime(date("Y-m-d H:i", strtotime($notificationTime))); //convert date and time
          if($notificationTime == $todayDate){ //if date and time match with today time then
              $emails = $this->app_model->getWhereInData('calendar_invitations', '*', array('1', '2'),'status', $join = false ,array('event_id' =>  $value['event_id']));              
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

  public function cronTest(){
      $this->App_model->rowInsert('cron',array('time'=>date("Y-m-d H:i:s")));
    }

    public function sendmail()
    {
         $this->email->from('softgetix.test@gmail.com');
         $this->email->to('softgetix.test@gmail.com');
         $this->email->subject('mail testing'); 
         $this->email->message('testing');
         $result =  $this->email->send();
        if (!$result){
          //$data['success'] = $this->email->print_debugger();
          print_r($this->email->print_debugger());die();
          }
          else{
                $resultArray['success'] = $result;
                echo 'success';
                die;
                //$resultArray[] = $email;
          }
      }

     function array_has_dupes($array) {
         return count($array) !== count(array_unique($array));
     }   

  }
?>
