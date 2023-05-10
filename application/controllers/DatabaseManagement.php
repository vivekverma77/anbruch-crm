<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class DatabaseManagement extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("UserModel");
        $this->load->model("DatabaseModel");
    }

    public function index()
		{
        $this->data["page"] = "database_management";
        
        $this->data["database_list"] = $this->DatabaseModel->loadDatabaseList();
        $this->viewLoad("database_management/database_management");
		}

    public function backupnow(){
			
			$userId = $this->getUserId();
			
			$this->load->dbutil();
			$this->load->library('zip');
			$this->load->helper('file');
			
			$file_path = 'static/database_backups/';
			
			$this->load->helper('string');
			$key_name2 = 'backup_';
			$key_name3 = date("Y_m_d_H_i_s");
			$created_time = date("Y-m-d H:i:s");
	
			//strong file name
			$file_name = $key_name2 . $key_name3 . '.zip';
			$prefs = array(					
						//'tables'        => array('anb_crm_activities', 'anb_crm_modules'),   // Array of tables to backup.
						//'ignore'        => array(),                     // List of tables to omit from the backup
						'format' => 'zip', // gzip, zip, txt
						'filename' => $file_name, // File name - NEEDED ONLY WITH ZIP FILES
						//'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
						//'add_insert' => TRUE, // Whether to add INSERT data to backup file
						//'newline' => "\n" // Newline character used in backup file
			);
			//Backup your entire database and assign it to a variable
			$backup = $this->dbutil->backup($prefs);
			$file = $file_path . $file_name;
			if(strlen($backup))
			{
				if (!write_file($file, $backup))
				{
					$message["message"] =  'Error while writing db backup to disk: '.$file_name;
					$message["status"] = false;
				} 
				else
				{				
					$message["message"] =  'DB backup successfully written to disk: '.$file_name ;
					$message["status"] = true;
					
					$dataArr = array(          
            "filename" => $file_name,            
            "filetype" => 'ZIP',
            "filesize" => filesize($file),
            "created_by" => $userId,
            "created_time" => $created_time,            
					);
					$this->db->insert("anb_crm_database_backups", $dataArr);
					$saved_data = $this->db->insert_id();
					if ($saved_data )
					{
						$message["message1"] = 'DB Backup details successfully saved to database.';
						$message["status"] = true;
					}
					else
					{
						if (file_exists($file))
						{
							unlink($file);
						}
						$message["message"] =  'Error while saving db backup to database: '.$file_name;
						$message["status"] = false;
					}
				}
			}
			else
			{
				$message["message"] = 'Error while getting db backup: ' . $file_name;
				$message["status"] = false;
			}
			
			
			if ($message["status"] === true){						
					$this->session->set_flashdata('success',$message["message"]);
					redirect(base_url().'index.php/DatabaseManagement');
			} else {
					$this->session->set_flashdata('error',$message["message"]);						
					redirect(base_url().'index.php/DatabaseManagement');
			}
			
    }
    
    public function downloadRecord($id)
    {
			$res = $this->DatabaseModel->loadDatabaseList($id);
			
			if(!empty($res))
			{
				$file_path = 'static/database_backups/';
				$file_name = $res['filename'];
				$file = $file_path . $file_name;
				if (file_exists($file))
				{
					$this->load->helper('download');			
					force_download($file, NULL);
					
					$message["message"] =  'DB backup downloaded successfully written to local system: '.$file_name ;
					$message["status"] = true;
				}
				else
				{
					$message["message"] = 'Error while getting db file from disk: ' . $file_name;
					$message["status"] = false;
				}			
			}
			else
			{
				$message["message"] = 'Error while getting db record: ' . $file_name;
				$message["status"] = false;
			}
			
			
			if ($message["status"] === true){						
					$this->session->set_flashdata('success',$message["message"]);
					redirect(base_url().'index.php/DatabaseManagement');
			} else {
					$this->session->set_flashdata('error',$message["message"]);						
					redirect(base_url().'index.php/DatabaseManagement');
			}
				
				

		}
    
    public function deleteRecord($id)
    {
			$res = $this->DatabaseModel->loadDatabaseList($id);
			
			if(!empty($res))
			{
				$file_path = 'static/database_backups/';
				$file_name = $res['filename'];
				$file = $file_path . $file_name;
				if (file_exists($file))
				{
					$res = $this->DatabaseModel->deleteRecord($id);
					if($res === true)
					{					
						unlink($file);					
					}
					
					$message["message"] =  'DB backup deleted successfully, file: '.$file_name ;
					$message["status"] = true;
				}
				else
				{
					$message["message"] = 'Error while getting db file from disk: ' . $file_name;
					$message["status"] = false;
				}			
			}
			else
			{
				$message["message"] = 'Error while getting db record: ' . $file_name;
				$message["status"] = false;
			}
			
			
			if ($message["status"] === true){						
					$this->session->set_flashdata('success',$message["message"]);
					redirect(base_url().'index.php/DatabaseManagement');
			} else {
					$this->session->set_flashdata('error',$message["message"]);						
					redirect(base_url().'index.php/DatabaseManagement');
			}
			
		}
		
		
		function deleteMassRecord(){
	
			foreach($_POST['ids'] as $id)
			{     
				$res = $this->DatabaseModel->loadDatabaseList($id);
			
				if(!empty($res))
				{
					$file_path = 'static/database_backups/';
					$file_name = $res['filename'];
					$file = $file_path . $file_name;
					if (file_exists($file))
					{
						$res = $this->DatabaseModel->deleteRecord($id);
						if($res === true)
						{					
							unlink($file);					
						}
						
						$message["message"] =  'DB backup deleted successfully, file: '.$file_name ;
						$message["status"] = true;
					}
					else
					{
						$message["message"] = 'Error while getting db file from disk: ' . $file_name;
						$message["status"] = false;
					}			
				}
				else
				{
					$message["message"] = 'Error while getting db record: ' . $file_name;
					$message["status"] = false;
				}
						
				
			}
       
			if ($message["status"] === true){						
				$this->session->set_flashdata('success',$message["message"]);
				redirect(base_url().'index.php/DatabaseManagement');
			} else {
					$this->session->set_flashdata('error',$message["message"]);						
					redirect(base_url().'index.php/DatabaseManagement');
			}
       
		 }
    
}
