<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';
require_once 'Base.php';

class Activities extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("ActivitiesModel");
        $this->load->model("ModuleModel");
    }

    public function index()
	{
        $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
        $this->data["record_data"] = $this->ActivitiesModel->loadActivitiesList($this->data["own"]);
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->viewLoad("activities/activities");
	}

    function addActivity(){
        global $MAJOR_META_IDS_LIST;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            $message = $this->ActivitiesModel->addRecord($this->getUserId());
            $this->addActivityToGoogleCalendar($message["id"]);
            if ($message["status"] === true){
                $this->data["message"]["success"] = 'An activity has been added successfully. <a href="'. base_url() .'index.php/activities/viewRecord/?&id='. $message["id"] .'">View The Activity?</a>';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
        $this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
        $this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);

        $this->viewLoad("activities/new");
    }

    function editRecord(){
        global $MAJOR_META_IDS_LIST;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            $message = $this->ActivitiesModel->updateRecord($this->getUserId());
            $this->updateActivityToGoogleCalendar($this->getPost("id"));
            if ($message["status"] === true){
                $this->data["message"]["success"] = 'The activity has been updated successfully.';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["id"] = $this->getPost("id");
        $this->data["record_data"] = $this->ActivitiesModel->viewRecord();
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
        $this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
        $this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);

        $this->viewLoad("activities/update");
    }

    function viewRecord(){
        global $MAJOR_META_IDS_LIST;
        $this->data["id"] = $this->getPost("id");
        $this->data["record_data"] = $this->ActivitiesModel->viewRecord();
        $this->data["users_list"] = $this->ModuleModel->loadUsersList();
        $this->data["active_leads_list"] = $this->ModuleModel->loadCommonRecordListByType(LEADS, $MAJOR_META_IDS_LIST[LEADS]);
        $this->data["active_clients_list"] = $this->ModuleModel->loadCommonRecordListByType(CLIENTS, $MAJOR_META_IDS_LIST[CLIENTS]);
        $this->data["active_contracts_list"] = $this->ModuleModel->loadCommonRecordListByType(CONTRACTS, $MAJOR_META_IDS_LIST[CONTRACTS]);
      
        //echo "<pre>"; print_r($this->data); die;
        $this->viewLoad("activities/view");
    }

    function addActivityToGoogleCalendar($activityId = 20)
    {
        $record_data = $this->ActivitiesModel->viewRecord($activityId);
        //print_r($record_data);  
        $summary = $record_data['name'];
        //$start = $record_data['due_date'].'T00:00:00';
        //$end = $record_data['closed_time'] ? $record_data['closed_time'].'T12:00:00' : $record_data['due_date'].'T00:00:00';

        $start = $record_data['due_date'];
        $end = $record_data['closed_time'] ? $record_data['closed_time'] : $record_data['due_date'];
        $description = '<br/><br/><b>Activity Title</b>: '. $record_data['name'];
        $description .= '<br/><br/><b>Status</b>: '.$record_data['status'];
        $description .= '<br/><br/><b>Activity Type</b>: '.$record_data['type'];
        $description .= '<br/><br/><b>Due Date</b>: '. date( 'j-F-Y',strtotime($start) );
        if($end){
         $description .= '<br/><br/><b>Closed Date</b>: '. date( 'h:i A',strtotime($end) );
        }
        $description .= '<br/><br/><b>'.$record_data['module_name'].'</b>: '. $record_data['record_title'];
        $description .='<br/><br/>Powered by: anbruch.com';
        $timezone = date_default_timezone_get();
        $service_account_name = 'anbruch@anbruch.iam.gserviceaccount.com'; 
        $key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-65bc39b56937.json';
       // echo $description;
        $client = new Google_Client(); //AUTHORIZE OBJECTS
        $client->setApplicationName("Anbruch");

        $client->setAuthConfig($key_file_location);

        $client->addScope(Google_Service_Calendar::CALENDAR);
        
        $client->setSubject($service_account_name);

        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'description' => $description,
            'sendNotifications' => TRUE,
            'ColorId' => 5,
            'start' => array(
                'date' => $start,
                'timeZone' => $timezone,
            ),
            'end' => array(
                'date' => $end,
                'timeZone' => $timezone,
            ),
            'reminders' => array(
                'useDefault' => FALSE,
                'overrides' => array(
                    array('method' => 'email', 'minutes' => 24 * 60),
                    array('method' => 'popup', 'minutes' => 10),
                ),
            ),
        ));
        $google_calendar_id = 'inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com';
        //print_r($service->events);die();
        $event = $service->events->insert($google_calendar_id, $event);
        //print_r($event);
        //echo $event->htmlLink;die();
        //echo "<br />";
        $event_id= $event->getId();
        //print_r($event_id);
         $recordData = array(
                "google_event_id" => $event_id,
        );
        $this->db->where('id', $activityId);
        $this->db->update("anb_crm_activities", $recordData);     
    }
    function updateActivityToGoogleCalendar($activityId = 20)
    {
        $record_data = $this->ActivitiesModel->viewRecord($activityId);
        //print_r($record_data);
       if(!empty($record_data['google_event_id'])){ 
        $summary = $record_data['name'];
        $start = $record_data['due_date'];
        $end = $record_data['closed_time'] ? $record_data['closed_time'] : $record_data['due_date'];
        $description = '<br/><br/><b>Activity Title</b>: '. $record_data['name'];
        $description .= '<br/><br/><b>Status</b>: '.$record_data['status'];
        $description .= '<br/><br/><b>Activity Type</b>: '.$record_data['type'];
        $description .= '<br/><br/><b>Due Date</b>: '. date( 'j-F-Y',strtotime($start) );
        if($end){
         $description .= '<br/><br/><b>Closed Date</b>: '. date( 'j-F-Y',strtotime($end) );
        }
        $description .= '<br/><br/><b>'.$record_data['module_name'].'</b>: '. $record_data['record_title'];
        $description .='<br/><br/>Powered by: anbruch.com';
        $timezone = date_default_timezone_get();
        $service_account_name = 'anbruch@anbruch.iam.gserviceaccount.com'; 
        $key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-65bc39b56937.json';
       // echo $description;
           $client = new Google_Client(); //AUTHORIZE OBJECTS
            $client->setApplicationName("Anbruch");

            $client->setAuthConfig($key_file_location);

            $client->addScope(Google_Service_Calendar::CALENDAR);

            $client->setSubject($service_account_name);

            $service = new Google_Service_Calendar($client);
            
            // First retrieve the event from the API.
            $event = $service->events->get('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $record_data['google_event_id']);


            $event->setSummary($summary);
            $event->setDescription($description);
            //$event->setStatus("confirmed");
            $event->setColorId(5);
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDate($record_data['due_date']);  
            $event->setStart($start);
            if($record_data['closed_time'] != '0000-00-00'){
             $end = new Google_Service_Calendar_EventDateTime();
             $end->setDate($record_data['closed_time']);
             $event->setEnd($end);
            //die($record_data['closed_time']);
            }else{
            $event->setEnd($start);    
            }
            //echo '<pre>';
            //print_r($event);die();
            //echo '</pre>';
           
            $updatedEvent = $service->events->update('inljueuddt5ldfdsmg8udsfutc@group.calendar.google.com', $event->getId() , $event);

            // Print the updated date.
            $updated =  $updatedEvent->getUpdated();        
            //echo '<pre>';print_r($updated); 
        }       
    }
}
