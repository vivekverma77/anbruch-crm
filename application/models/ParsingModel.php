<?php
/**
 * Created by PhpStorm.
 * User: DBA
 * Date: 20-Nov-17
 * Time: 5:47 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'BaseModel.php';

class ParsingModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
    }

    function parse($userId){
        error_reporting(E_ALL);
        set_time_limit(0);
        ini_set("memory_limit","-1");
        ini_set("max_execution_time", 0);
        ini_set('auto_detect_line_endings', true);

        $CSV_Data = array();
        $newCSV = array();

        $count = 0;

        $filename = base_url() . 'parsing/Leads_002.csv';
        $header = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle)) !== FALSE) {
                $count++;
                if($count == 1){
                    $header = $row;
                } else {
                    $data = array_combine($header, $row);
                    $recordData = array(
                        "assigned_officer_id" => 1,
                        "module_id" => LEADS,
                        "created_by" => $userId,
                        "created_time" => time(),
                    );
					$lead_id = $data['Lead ID'];
					$isInserted = $this->checkDuplicate($data['Lead ID']);
					if($isInserted)
					{
						$recordCreationSuccessful = false;
					}
					else
					{
						$recordCreationSuccessful = $this->db->insert("anb_crm_record", $recordData);
					}
                    
                    if ($recordCreationSuccessful === true){
                        $recordId = $this->db->insert_id();

                        $recordMetaData = array();

                        foreach ($data as $recordFieldMetaId => $recordFieldMetaValue){
                            $value = $this->encryptMetaValue($recordFieldMetaValue);
                            $record_meta_id = $this->getRecordMetaId($recordFieldMetaId);
                            if($record_meta_id)
                            {
								$recordMetaData[] = array(
									"record_id" => $recordId,
									"record_meta_id" => $record_meta_id,
									"value" => $value,
								);
							}
                        }

                        $recordMetaData[] = array(
                            "record_id" => $recordId,
                            "record_meta_id" => 22, // Opener
                            "value" => 2,
                        );

                        $recordMetaData[] = array(
                            "record_id" => $recordId,
                            "record_meta_id" => 21, // Closer
                            "value" => 4,
                        );

                        $recordMetaData[] = array(
                            "record_id" => $recordId,
                            "record_meta_id" => 6, // Lead Status
                            "value" => "ASSIGNED TO OPENER",
                        );
                        unset($recordMetaData[37]);
						//Update lead_id
						$this->updateLeadID($lead_id, $recordId);
                        $metaInserted = $this->db->insert_batch('anb_crm_record_meta_value', $recordMetaData);
						//$this->insertNotes($recordMetaData[0]['value'], $recordId, $userId);
                        $CSV_Data[] = $recordMetaData;
                        $row[] = $recordId;
                        $newCSV[] = $row;
                    }
                }
            }

            fclose($handle);
        }

        /*$fp = fopen("newLeadsInserted.csv", 'w');
        fputcsv($fp, $header);

        foreach ($newCSV as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);*/

        echo "Success";
        return $CSV_Data;
    }

    function encryptMetaValue($recordFieldMetaValue){
        $value = '';
        if (is_array($recordFieldMetaValue)){
            foreach ($recordFieldMetaValue as $key => $string){
                $value .= ($value == '') ? $string : (MULTIPLE_OPTION_SEPARATOR."$string");
            }
        } else {
            $value = $recordFieldMetaValue;
        }

        return $value;
    }
    function getRecordMetaId($colName)
    {
		$ret = array();
		if($colName == 'Company')
			$colName = 'Company Name';
		if($colName == 'Lead ID')
			$colName = 'Source ID';			
		$this->db->select("r.id");
		$this->db->where("`name`", $colName);
		$this->db->where("`module_id`", 1);
		$res = $this->db->get('anb_crm_record_meta as r');
		$meta_id = '';
		foreach ($res->result_array() as $meta) {
			$meta_id = $meta['id'];
		}

        return $meta_id;

	}
	function checkDuplicate($leadID)
	{
		$this->db->select("r.id");
		$this->db->where("`lead_id`", $leadID);
		$res = $this->db->get('anb_crm_record as r');
		$meta_id = false;
		foreach ($res->result_array() as $meta) {
			$meta_id = true;
		}
		
        return $meta_id;		
	}
	function insertNotes($user_id)
	{
		$this->db->where("r.module_id", 1);
		$this->db->where("r.has_note", 'N');
		$this->db->select("r.lead_id, r.id");
		$res = $this->db->get('anb_crm_record as r');
		foreach ($res->result_array() as $record) {
			$record_id = $record['id'];
			$unique_id = $record['lead_id'];
			if (($handle = fopen("parsing/Notes_001.csv", "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
					if($data[4] == $unique_id)
					{
						$created_time = strtotime($data[7]);
						$noteData = array(
							"note" => $data[3],
							"note_title" => $data[2],
							"created_by" => $user_id,
							"created_time" => $created_time,
							"record_id" => $record_id
						);					
						$this->db->insert("anb_crm_note", $noteData);
						
					}
				}
			}
			$this->updateNoteStatus($record_id);
		}

	}
	function updateLeadID($lead_id, $record_id)
	{
		$recordData = array(
			"lead_id" => $lead_id
		);
		$this->db->where("id", $record_id);
		$this->db->update("anb_crm_record", $recordData);
	}
	function updateNoteStatus($record_id)
	{
		$recordData = array(
			"has_note" => "Y"
		);
		$this->db->where("id", $record_id);
		$this->db->update("anb_crm_record", $recordData);
	}	
}