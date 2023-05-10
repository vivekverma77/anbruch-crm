<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class DatabaseModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function loadDatabaseList($record_id='')
    {			
			$this->db->select("*");
			if($record_id!="")
			{
				$this->db->where("dbk.id", $record_id);	
			}
			
			$this->db->order_by("created_time",'desc');	
			$qry = $this->db->get('anb_crm_database_backups dbk');
			if($record_id!="")
			{
				$res = $qry->row_array();
			}
			else
			{
				$res = $qry->result_array();
			}
			return $res;
		}
		
		 function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
		}

		function deleteRecord($id){
			
			$this->db->where("id", $id);		
			$this->db->delete('anb_crm_database_backups');
			
			return true;				
			
			
		}
		
}
