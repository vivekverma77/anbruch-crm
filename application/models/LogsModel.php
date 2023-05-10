<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 04-Jan-19
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class LogsModel extends BaseModel
{
	public function __construct()
	{
			parent::__construct();

	}
	function addRecord($leadId,$userId,$text){
			
			$data = array(
					"leadId" => $leadId,
					"created_by" => $userId,
					"text" => $text,
					"created_time" => date('Y-m-d H:i:s')
			);

			$recordCreationSuccessful = $this->db->insert("anb_crm_logs", $data);
	}
	function loadLogs($id){
			$this->db->select('log.*,p.first_name,p.last_name');
			$this->db->join('anb_crm_users_personal_info p', 'p.user_id = log.created_by', 'left');
			$this->db->where('log.leadId', $id);
			$this->db->order_by('log.id', 'DESC');
			$res = $this->db->get('anb_crm_logs log');
			$ret = $res->result_array();
			//print_r($ret);
			return $ret;
	}

	function  addLogs($title, $description, $recordId, $modulename, $user_id,$stage=''){
					
			 $this->db->select('first_name, last_name');
			 $this->db->where('user_id', $user_id);
		     $name = $this->db->get('anb_crm_users_personal_info');
		     foreach ($name->result_array() as $key ) {
		     	$user_name = $key['first_name'].' '. $key['last_name'];
		     }
            
            $query=$this->db->get_where('anb_crm_record',['id'=>$recordId]);
            $module_id=$query->row()->module_id;

			$data = array(
				'title' => $title,
				'date' =>  date("Y-m-d H:i:s"),
				'description' => $description,
				'record_id' => $recordId,
				'module_id'=>$module_id,
				'module_name' => $modulename,
				'activity_user' => $user_name,
				'stage'=>$stage,
				);
		$status = $this->db->insert("anb_activities_log", $data);	
	} 	
	function viewLogs($recordId){

			$this->db->select('*');
			$this->db->where('record_id', $recordId);
			$this->db->order_by('id','desc');
			$this->db->limit(10);
			$res = $this->db->get('anb_activities_log');
			$ret = $res->result_array();
		/*	echo $this->db->last_query();
			die;*/
			return $ret;
			/*print_r($ret);
			die();*/
	}
	public function countActivity($recordId)
	{
		$this->db->select('*');
		$this->db->where('record_id', $recordId);
		$res = $this->db->get('anb_activities_log');
		$ret = $res->num_rows();
		return $ret; 
		//print_r($ret);
		//die;	
			
	}

}
?>
