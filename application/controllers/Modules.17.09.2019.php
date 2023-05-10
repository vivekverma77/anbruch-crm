<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';
class Modules extends Base
{
	public function __construct()
	{
		parent::__construct();
		$this->redirectPublicUser();
		$this->load->model("ActivitiesModel");
		$this->load->model("ModuleModel");
		$this->load->model("BookingModel");
		$this->load->model("UserModel");
		$this->load->model("EmailtemplatesModel");
		$this->load->model("LogsModel");
		$this->load->model("App_model");
		$this->load->library('email');
		$smtpconfig = $this->config->item('email');
		//~ print_r($smtpconfig);die;
		$this->email->initialize($smtpconfig);
	}

	function test()
	{
		$record_data = $this->ModuleModel->loadRecord(null, 36341);
		echo '<pre>';print_r($record_data); die;
	}

  	public function index()
	{	global $FIELD_TYPE;
		global $RECORD_STATUS;

		$this->data["recordStatus"] = ($this->getPost("rStat") != '') ? $this->getPost("rStat") : $RECORD_STATUS["CYCLE_RUNNING"];

		if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
				$this->data["writePermission"] = false;
		}

		//$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
		$this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : NULL;
		$this->data["page"] = ($this->getPost("page") != '') ? $this->getPost("page") : 1;

		$this->data["current_module"] = $this->getPost('cm');

		$this->data['sort_column'] = $this->getPost('sort_column');
		$this->data['sort_order'] = $this->getPost('sort_order');
		$this->data['keyword'] = $this->getPost('keyword');

    /*if(!$this->data['sort_column'])
			$this->data['sort_column'] = 'Company Name';
*/
    if(!$this->data['sort_order'])
			$this->data['sort_order'] = 'ASC';

	$npage_no = $this->getPost("page");
		if(!$npage_no)
			$npage_no = 1;

    $limit_per_page = $this->getPost("num_records_per_page");

		if(!$limit_per_page)
			$limit_per_page = 25;

		$id = $this->getPost('id');


		$this->data['records_per_page'] = $limit_per_page;

		$from_date = '';

		$arr_filters = array('Lead Owner', 'ID Source', 'ID Number', 'Title', 'Lead Source', 'Lead Referred Partner', 'Source ID', 'Service Type', 'Function ', 'Lead Status ', 'Proximity ', 'Lead Category ', 'Sales Tax Status', 'Sales Tax Registration', 'Signing Rate ', 'Opener', 'Opener\'s Call Status ', 'Company Information Video Validity ', 'Closer', 'Closer Call Status ', 'Expected Technical Start Date ', 'Return to Opener ', 'COMPANY INFORMATION VIDEO VALIDITY (USA) ', 'Company ', 'City ', 'Country ', 'Parent/Affiliate Company Name ', 'Parent/Affiliate Company Province ', 'Parent/Affiliate Company Country ', 'Province ', 'Zip Code ', 'Head Office Status ', 'Parent/Affiliate Company City ', 'Parent/Affiliate Company Postal Code ', 'Business Type ', 'Primary NAICS Description ', 'Primary SIC Code ', 'Estimated Sales ', 'Reported Sales ', 'No. of Employees ', 'Export Indicator', 'Export Country');

    $search_filters = $this->ModuleModel->getSearchFilterList($arr_filters, $this->data["current_module"]);

		foreach($search_filters as $mid => $filter_name)
		{
			$id = str_replace(' ', '_', strtolower(preg_replace("/[^A-Za-z0-9 ]/", '_', trim($filter_name))));
			$this->data[$id] = $this->getPost($id);
			$arr_search_filters[$mid] = $this->getPost($id);
		}

    $this->data['search_filters'] = $arr_search_filters;

		
		if ($this->getPost('bulk') == 'on' )
		{
			if ($this->getPost('ac') == 'mOwner')
			{
				$message = $this->ModuleModel->changeOwner($this->getUserId(), true, $this->getPost("uid"), $this->getPost("new"));

				if ($message["status"] === true)
				{
					
					$idList = explode(",", $this->getPost("uid"));
					$action = 'mass_update';
					if($this->getPost('cm') == 'Leads'){
						$heading = 'Lead Assigned';
						$subject = 'Lead is assigned to you';
					}else{
						$heading = 'Client Assigned';
						$subject = 'Client is assigned to you';
					}
					$slug_name = 'admin_to_opener';
					//$slug_name = 'Admin_to_Opener_Test';
					//print_r($idList);
					$i = 0;
					/*for($i=0 ; $i<count($idList); $i++) {
						echo $idList[$i];
						$status = $this->sendMail($action, $subject, $idList[$i] , $heading, $slug_name);
					}*/
					while ($i < count($idList)){
						$status = $this->sendMail($action, $subject, $idList[$i] , $heading, $slug_name);
						if($status){
							//echo $i;
							$i++;	
						}
					}
					//echo $i;
					//die;
					if($i = count($idList)){
						$this->data["message"]["success"] = 'Records have been updated successfully.';
					redirect(base_url().'modules/?cm='.$this->getPost("cm").'&id=1&own='.$this->getpost('new').'&rStat=3&page=1');			
					}
					
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}

			}
		}

		if ( $this->getPost('bulk') == 'on' )
		{
			if ($this->getPost('ac') == 'cOwner')
			{
				$owner_id = $this->getPost("current_record_id");
				$message = $this->ModuleModel->changeContractOwner($this->getUserId(), true, $this->getPost("uid"), $this->getPost("new"));
				if ($message["status"] === true)
				{	
					$this->data["message"]["success"] = 'Records have been updated successfully.';
					redirect(base_url().'modules/viewRecord?cm=Clients&id='.$owner_id.'');
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}

			}
		}

		if ( $this->getPost('bulk') == 'on' )
		{
			if ($this->getPost('ac') == 'mass_delete')
			{

				$message = $this->ModuleModel->mass_delete($this->getPost("uid"));

				if ($message["status"] === true)
				{
					$this->data["message"]["success"] = 'Records have been deleted successfully.';
					//redirect(base_url().'modules/viewRecord?cm='.$this->getPost("cm").'&id='.$this->getPost("own").'');
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}
			}
		}

		//$this->data["total_record"] = $this->ModuleModel->getTotalRecord($this->data["recordStatus"], $this->data["own"], $arr_search_filters);

		$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);

		$this->data["FIELD_TYPE"] = $FIELD_TYPE;
		if(isset($_GET['alphabet']))
		{
			$arr_temp = $this->ModuleModel->loadRecordList_beta($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, $this->data['sort_column'], $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date,  $this->getPost('id'), $_GET['alphabet']);
		}
		else
		{
			$arr_temp = $this->ModuleModel->loadRecordList($this->data["recordStatus"], $this->data["own"], $arr_search_filters, $this->data["page"], $limit_per_page, $this->data['sort_column'], $this->data['sort_order'], $this->data['keyword'],$this->data["current_module"], $from_date,  $this->getPost('id'));	
		}
		$this->data["record_data"] = $arr_temp[0];
		$this->data['page_details'] = $arr_temp[1];
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		$this->data['search_filters'] = $search_filters;
		$this->data['user_role'] = $this->getUserRole();

		//echo '<pre>';print_r($arr_temp[0]);die;

		/*$this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();*/
		//print_r($this->data);die();
		$this->viewLoad("modules/list");
	}

  public function advanceSearch()
	{
        global $FIELD_TYPE;
        global $RECORD_STATUS;
        $this->data["recordStatus"] = ($this->getPost("rStat") != '') ? $this->getPost("rStat") : $RECORD_STATUS["CYCLE_RUNNING"];
        if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
            $this->data["writePermission"] = false;
        }
        $this->data["own"] = ($this->getPost("own") != '') ? $this->getPost("own") : $this->getUserId();
        $this->data["page"] = ($this->getPost("page") != '') ? $this->getPost("page") : 1;
        $this->data["current_module"] = $this->getPost("cm");

        if ( $this->getPost('bulk') == 'on' ){
            if ($this->getPost('ac') == 'mOwner'){
                $message = $this->ModuleModel->changeOwner($this->getUserId(), true, $this->getPost("uid"), $this->getPost("new"));
            }

            if ($message["status"] === true){
                $this->data["message"]["success"] = 'Records have been updated successfully.';
            } else {
                $this->data["message"]["danger"] = $message["message"];
            }
        }

        $this->data["search_result"] = false;
        if ( ($requestMethod = strtolower($this->input->method())) == 'post'){
            if ($this->getPost("s") != ''){
                $this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
                $this->data["FIELD_TYPE"] = $FIELD_TYPE;
                $this->data["record_data"] = $this->ModuleModel->loadSearchRecordList($this->data["recordStatus"], $this->data["own"]);
                $this->data["users_list"] = $this->ModuleModel->loadUsersList();
                $this->data["search_result"] = true;
            } else {
                $this->data["message"]["info"] = "Please enter any text to search in " . $this->getPost("cm") . ".";
            }
        } else {
            $this->data["message"]["info"] = "Please enter any text to search in " . $this->getPost("cm") . ".";
        }

        $this->viewLoad("modules/advance_search");
	}

	public function addRecord()
	{
		if ($this->data["writePermission"] == false)
		{
				$this->redirectAccessViolatedUser();
		}

		global $FIELD_TYPE;
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
		$this->data['action'] = $this->getPost("add");

		if($this->data['action'] == 'addContract'){
			$this->data['clientId'] = $this->getPost('clientId');
			$this->data["meta_fields1"] = $this->ModuleModel->loadModulesMeta('Contracts');
		}
		$this->data["FIELD_TYPE"] = $FIELD_TYPE;
		//echo '<pre>';print_r($this->data["meta_fields"]); //die;
		//echo '<pre>';print_r($this->data["FIELD_TYPE"]); die;

		if(($requestMethod = strtolower($this->input->method())) == 'post')
		{
			
			//print_r($this->input->post()); die("cool");
			if($this->data['current_module'] == 'Clients' && $this->data['action'] == 'addContract')
			{
				$message = $this->ModuleModel->addRecord($this->data["meta_fields1"], $this->getUserId());
				$contract_id = $message['id'];
				$result = $this->sendMail('contractData', null, $contract_id, 'New Contract is Added', 'new_contract_client');
				if($result){
					$record_data = $this->ModuleModel->loadRecord1(null, $contract_id);
                    $owner_id = $record_data['__161'];
					$this->LogsModel->addLogs('Contract', 'New Contract is added', $message["id"], $this->data["current_module"], $_SESSION['user_id']);
					$this->LogsModel->addLogs('Contract', 'New Contract is added', $owner_id, $this->data["current_module"], $_SESSION['user_id']);
                    $this->session->set_flashdata('success', 'New Contract is Added successfully.');
                    redirect(base_url().'modules/viewRecord?cm=Clients&id='.$owner_id.'');	
				}
				
				/*$record_data = $this->ModuleModel->loadRecord1(null, $contract_id);

				$assigned_officer_id = $record_data['__0'];
				$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
				$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
				$admin_email = $user_data0['email'];
				$technical_consultants_data = $this->UserModel->loadUser($record_data['__169']);
				$technical_consultants = $technical_consultants_data['first_name'].' '.$technical_consultants_data['last_name'];
				$accountants_data = $this->UserModel->loadUser($record_data['__170']);
				$accountants = $accountants_data['first_name'].' '.$accountants_data['last_name'];
				$toName = $admin;
				$toEmail = trim($admin_email);
				$subject = 'New Contract is Added';
				$assignedData = array(
					'contractassignedofficer' => $admin,
					'contract_name' => isset($record_data['__160']) ? $record_data['__160'] : 'No Contract Name Available' ,
					'contract_number' => isset($record_data['__165']) ? $record_data['__165'] : '',
					'client_name' => isset($record_data['__197']) ? $record_data['__197'] : "No Client Name Available",
					'signing_rate' => isset($record_data['__164']) ? $record_data['__164'] : "",
					'stage' => isset($record_data['__162']) ? $record_data['__162'] : "",
					'service_type' => isset($record_data['__163']) ? $record_data['__163'] : "",
					'technical_consultants' => isset($technical_consultants) ? $technical_consultants : "",
					'technical_consultants_status' => isset($record_data['__171']) ? $record_data['__171'] : '',
					'accountants' => isset($accountants) ? $accountants : '',
					'accountants_status' => isset($record_data['__172']) ? $record_data['__172'] : "",
					'description' => isset($record_data['__196']) ? $record_data['__196'] : " Description Not Available",
				);
				if($message)
				{
					$assignedData['mainheading'] = 'Contract Created';
					$assignedData['heading'] = 'New Contract is Created.';
					$emailTemplate = $this->load->view('emails/createContract',$assignedData,true);	
					$fromEmail = COMPANY_NOREPLY_EMAIL;
					$fromName = COMPANY_NAME;
					//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
					$data = json_encode($assignedData);
					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data);	
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

				}*/
			}
			else{
                
               /*if ($this->ModuleModel->check_lead_exist($_POST['__1'],"'First Name'",$_POST['module_name'],'Create')) {
               	    $ret["message"] = "First Name you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }else if ($this->ModuleModel->check_lead_exist($_POST['__2'],"'Last Name'",$_POST['module_name'],'Create'))
               {
               	    $ret["message"] = "Last Name you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }
               else if ($this->ModuleModel->check_lead_exist($_POST['__4'],"'Email'",$_POST['module_name'],'Create'))
               {
               	    $ret["message"] = "Email you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }*/
               if ($this->ModuleModel->check_lead_exist($_POST['__31'],"'Company Name'",$_POST['module_name'],''))
               {
               	    $ret["message"] = "Company Name you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }
               else{

                $message = $this->ModuleModel->addRecord($this->data["meta_fields"], $this->getUserId());
              
               	$this->LogsModel->addLogs('Leads', 'Leads Added',$message['id'],$this->data["current_module"],$this->getUserId());
                  
                } 
            }
			if($this->data["current_module"]=='Leads')
			{
				//echo '<pre>';
                //print_r($_POST);die();

				if ($message["status"] === true && $message["id"]!='')
				{
					//$this->sendMail('Lead_assigned','A Lead assigned to you.',$message["id"],'Lead  Assigned','Admin_to_Opener_Test');
					$this->sendMail('Lead_assigned','A Lead assigned to you.',$message["id"],'Lead  Assigned','admin_to_opener');
					$this->data["message"]["success"] = 'Record has been added successfully. <a href="'. base_url() .'modules/viewRecord/?cm='. $this->data["current_module"] .'&id='. $message["id"] .'">View The Record?</a>';
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}
			}

			// by harp
			if($this->data["current_module"]=='Clients' && $this->data['action'] == '')
			{
				if ($message["status"] === true && $message["id"]!='')
				{
					$record_data = $this->ModuleModel->loadRecord(null, $message["id"]);
					//echo '<pre>';print_r($record_data); die;

					$country = $record_data['__114'];
					$contract_num = $record_data['__185'];

					$contractNumber = '';

					if (strpos($country, "Canada") !== false){
							$contractNumber .= "1";
					} else if (strpos($country, "USA") !== false){
							$contractNumber .= "2";
					} else {
							$contractNumber .= "0";
					}

					$contractNumber .= $contract_num;

					//update Master contract number same as required
					$udata = array(
						"value" => "$contractNumber-00",
					);
					$this->db->where('record_id', $message["id"]);
					$this->db->where('record_meta_id', 185);
					$andrew_updated = $this->db->update("anb_crm_record_meta_value", $udata);
					//update Master contract number same as required

					//Update client owner to Andrew
					$udata = array(
						"assigned_officer_id" => !empty($record_data) && !empty($record_data['__0']) ? $record_data['__0'] :1
					);
					$this->db->where('id', $message["id"]);
          			$andrew_updated = $this->db->update("anb_crm_record", $udata);
          			//Update client owner to Andrew ends

					$record_data = $this->ModuleModel->loadRecord(null, $message["id"]);
					//echo '<pre>';print_r($record_data); die;

					$country = $record_data['__114'];
					$client_id = $record_data['__88'];
					$client_name = $record_data['__84'];
					$client_services = json_encode($record_data['__90']);
					$signing_rate = $record_data['__94'];
					$preferred_number = $record_data['__100'];
					$visit_location = $record_data['__115'].' '.$record_data['__116'].' '.$record_data['__112'].' '.$record_data['__117'];
					$expected_technical_start_date =  $record_data['__102'];

					$webhook_url = "http://anbruch.com/zohoAPI/?country=$country&client_id=$client_id&name=$client_name&services=$client_services&signing=$signing_rate&pn=$preferred_number&visit=$visit_location&startDate=$expected_technical_start_date&security_token=createContract";

					//$webhook_result = file_get_contents($webhook_url);

					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $webhook_url);
					curl_setopt($ch, CURLOPT_HEADER, TRUE);
					curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
					//$head = curl_exec($ch);
					//$webhook_result = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					//$webhook_result = curl_getinfo($ch);
					curl_close($ch);

					//echo '<pre>webhook_result ';print_r($webhook_result);die;

					//echo '<pre>';print_r($record_data); die;
					$this->sendMail(null,null,$message["id"],null,'Create_Client');
					$this->data["message"]["success"] = 'Record has been added successfully. <a href="'. base_url() .'modules/viewRecord/?cm='. $this->data["current_module"] .'&id='. $message["id"] .'">View The Record?</a>';

				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}
			}

			// by harp
			if($this->data["current_module"]=='Contracts')
			{
				if($message["status"] === true && $message["id"]!='')
				{
				$contract_id = $message['id'];
				$result = $this->sendMail('contractData', null, $contract_id, 'New Contract is Added', 'new_contract');
				if($result){
					$record_data = $this->ModuleModel->loadRecord1(null, $contract_id);
					$this->LogsModel->addLogs('Contract', 'New Contract is added', $message["id"], $this->data["current_module"],$_SESSION['user_id']);
					$this->LogsModel->addLogs('Contract', 'New Contract is added', $_POST['record_id'], $this->data["current_module"],$_SESSION['user_id']);
					//$this->LogsModel->addLogs('Contract', 'New Contract is added', $contract_id, 'Contracts', $_SESSION['user_id']);
					$owner_id = $record_data['__161'];
					$this->session->set_flashdata('success', 'New Contract is Added successfully.');
	                //$this->data["message"]["success"] = 'New Contract is Added successfully.';
	                redirect(base_url().'modules/viewRecord?cm=Clients&id='.$owner_id.'');	
                }
				/*$assigned_officer_id = $record_data['__0'];
				$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
				$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
				$admin_email = $user_data0['email'];
				$technical_consultants_data = $this->UserModel->loadUser($record_data['__169']);
				$technical_consultants = $technical_consultants_data['first_name'].' '.$technical_consultants_data['last_name'];
				$accountants_data = $this->UserModel->loadUser($record_data['__170']);
				$accountants = $accountants_data['first_name'].' '.$accountants_data['last_name'];
				$toName = $admin;
				$toEmail = trim($admin_email);
				$subject = 'New Contract is Added';
				$assignedData = array(
					'contractassignedofficer' => $admin,
					'contract_name' => isset($record_data['__160']) ? $record_data['__160'] : 'No Contract Name Available' ,
					'contract_number' => isset($record_data['__165']) ? $record_data['__165'] : '',
					'client_name' => isset($record_data['__197']) ? $record_data['__197'] : "No Client Name Available",
					'signing_rate' => isset($record_data['__164']) ? $record_data['__164'] : "",
					'stage' => isset($record_data['__162']) ? $record_data['__162'] : "",
					
					'technical_consultants' => isset($technical_consultants) ? $technical_consultants : "",
					'technical_consultants_status' => isset($record_data['__171']) ? $record_data['__171'] : '',
					'accountants' => isset($accountants) ? $accountants : '',
					'accountants_status' => isset($record_data['__172']) ? $record_data['__172'] : "",
					'description' => isset($record_data['__196']) ? $record_data['__196'] : " Description Not Available",
				);
				if($message)
				{
					$assignedData['mainheading'] = 'Contract Created';
					$assignedData['heading'] = 'New Contract is Created.';
					$emailTemplate = $this->load->view('emails/createContract',$assignedData,true);	
					$fromEmail = COMPANY_NOREPLY_EMAIL;
					$fromName = COMPANY_NAME;
					//$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
					$data = json_encode($assignedData);
					$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$data);	
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
*/
					
					//$this->data["message"]["success"] = 'Record has been added successfully. <a href="'. base_url() .'modules/viewRecord/?cm='. $this->data["current_module"] .'&id='. $message["id"] .'">View The Record?</a>';
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}
			}


			if($this->data["current_module"]=='Clients' && $this->data['action'] == 'addContract')
			{
				if($message["status"] === true && $message["id"]!='')
				{	
					$this->LogsModel->addLogs('Contract', 'New Contract is added', $this->getPost('clientId'), $this->data["current_module"], $_SESSION['user_id']);
					$this->data["message"]["success"] = 'Record has been added successfully. <a href="'. base_url() .'modules/viewRecord/?cm='. $this->data["current_module"] .'&id='.  $this->getPost('clientId') .'">View The Record?</a>';
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}
			}

		}
		$this->data["users_list"] = $this->ModuleModel->loadUsersList();

		if($this->data["current_module"] == CONTRACTS_PLURAL_NAME)
		{

			$this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
			//echo '<pre>';print_r($this->data["active_clients_list"]); die;
		}
		/*print_r($this->data['current_module']);
		die;*/
		if($this->data['current_module'] == 'Clients' && $this->data['action'] == 'addContract'){
			$this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
			$this->viewLoad('modules/new1');
			/*print_r($this->data['meta_fields1']);
			die;*/
		}
		else{
		$this->viewLoad("modules/new");
		}
	}

	public function editRecord()
	{
		$loggedUserId = $this->getUserId();

		$this->data['own_data'] = $own_data = $this->UserModel->loadUser($loggedUserId);
		//echo '<pre>';print_r($this->data['own_data']);die;

		if ($this->ModuleModel->checkWritable($this->getPost("id")) == false)
		{
				$this->data["writePermission"] = false;
		}
		if ($this->data["writePermission"] == false)
		{
				$this->redirectAccessViolatedUser();
		}
		global $FIELD_TYPE;
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
		$this->data["FIELD_TYPE"] = $FIELD_TYPE;
		$this->data["record_id"] = $this->getPost("id");

		if(($requestMethod = strtolower($this->input->method())) == 'post')
		{
			if($this->data["current_module"]=='Leads')
			{
			   /*if ($this->ModuleModel->check_lead_exist($_POST['__1'],"'First Name'",$_POST['module_name'],'Update')) {
               	    $ret["message"] = "First Name you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }else if ($this->ModuleModel->check_lead_exist($_POST['__2'],"'Last Name'",$_POST['module_name'],'Update'))
               {
               	    $ret["message"] = "Last Name you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }
               else if ($this->ModuleModel->check_lead_exist($_POST['__4'],"'Email'",$_POST['module_name'],'Update'))
               {
               	    $ret["message"] = "Email you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }*/
               if ($this->ModuleModel->check_lead_exist($_POST['__31'],"'Company Name'",$_POST['module_name'],$_POST['record_id']))
               {
               	    $ret["message"] = "Company Name you entered is already exists";
				    $ret["status"] = false;
				    $message=$ret;
               }
               else{
                  
                  $this->LogsModel->addLogs('Leads', 'Leads Updated',$_POST['record_id'],$this->data["current_module"],$this->getUserId());

                  $message = $this->ModuleModel->updateRecord($this->data["meta_fields"], $this->getUserId());
               }
				}
			else
			{
				$message = $this->ModuleModel->updateRecord($this->data["meta_fields"], $this->getUserId());
			}
			if($this->data["current_module"]=='Leads')
			{
				if($message["status"] === true && $this->data["record_id"]!='')
				{
					$record_data = $this->ModuleModel->loadRecord(null, $this->data["record_id"]);
					//echo '<pre>';print_r($record_data); die;

					$assigned_officer_id = $record_data['__0'];
					$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
					$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
					$admin_email = $user_data0['email'];

					$closer_id = $record_data['__21'];
					$user_data1 = $this->UserModel->loadUser($closer_id);
					$closer = $user_data1['first_name'].' '.$user_data1['last_name'];
					$closer_email = $user_data1['email'];

					$opener_id = $record_data['__22'];
					$user_data2 = $this->UserModel->loadUser($opener_id);
					$opener = $user_data2['first_name'].' '.$user_data2['last_name'];
					$opener_email = $user_data2['email'];

					$start_date = $record_data['__24'];
					$company = $record_data['__31'];
					$parent_company = $record_data['__41'];
					$business_type = $record_data['__48'];
					$primary_NAICS_description = $record_data['__77'];
					$estimated_sales = $record_data['__80'];
					$lead_name = $record_data['__1'].' '.$record_data['__2'];
					$title = $record_data['__3'];
					$email = $record_data['__4'];
					$telephone = $record_data['__32'];
					$address_line_1 = $record_data['__38'];
					$city = $record_data['__35'];
					$province = $record_data['__40'];
					$country = $record_data['__37'];
					$zip_code = $record_data['__36'];
					$website = $record_data['__34'];

					$lead_status = $record_data['__6'];

					if(isset($record_data['__23']) && $record_data['__23']=='yes')
					{
						$return_to_opener = 1;
					}
					else
					{
						$return_to_opener = 0;
					}

					$send_email = false;

					$logs = $this->LogsModel->loadLogs($this->data["record_id"]);
					if(!empty($logs)){
						//~ print_r($logs);
						//~ echo $logs[0]["text"];
						$ar = json_decode($logs[0]["text"],true);
						//~ print_r($ar);
						if($ar['Opner'] != $opener || $ar['Closer'] != $closer){
							$arr = array('Opner'=>$opener,'Closer'=>$closer);
							$text = json_encode($arr);
							$this->LogsModel->addRecord($this->data["record_id"],$record_data['created_by'],$text);
						}
					} else {
						$arr = array('Opner'=>$opener,'Closer'=>$closer);
				   	$text = json_encode($arr);
					  $this->LogsModel->addRecord($this->data["record_id"],$record_data['created_by'],$text);
					}

					if($lead_status=="NOT QUALIFIED")
					{
						//Update lead owner to Andrew
						$udata = array(
							"assigned_officer_id" => $assigned_officer_id,
						);
						$this->db->where('id', $this->data["record_id"]);
						$andrew_updated = $this->db->update("anb_crm_record", $udata);
						//Update lead owner to Andrew ends
					}

					if($lead_status=="REASSIGNED TO OPENER" && $return_to_opener)
					{
						$send_email = true;
						$toName = $opener;
						$toEmail = trim($opener_email);
						if($lead_status=="ASSIGNED TO OPENER")
						{
							$status = 'ASSIGNED';
						}
						else if($lead_status=="REASSIGNED TO OPENER")
						{
							$status = 'REASSIGNED';
						}

						$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'admin_to_opener');
						if(!empty($template_data))
						{
						$subject = "LEAD $status: ".$template_data['title'];
						$content = $template_data['template'];
						}
						else
						{
						$subject = "LEAD $status: A lead is assigned to you.";
						$content = "<p><B>Dear</B> [Opener],</p><br>

						<p>This is to inform you that a (i.e. web-presentation or face-to-face or conference call) has been scheduled for you with <B>[Company Name]</B> on <B>[Start Date]</B>. </p><br>

						<p>The participants include [Participant Names].</p><br>

						<p>Conference Call / Web Presentation Details</p>
						<p>Ring Central Login Info – Meeting IDs</p>
						<p>---</p><br>

						<p>The Company Highlights are as follows:</p><br>

						<p><B>Company:</B> [Company Name]</p>
						<p><B>Parent Company Name:</B> [Parent Company Name]</p>
						<p><B>Business Type:</B> [Business Type]</p>
						<p><B>Primary NAICS Description:</B> [Primary NAICS Description]</p>
						<p><B>Estimated Sales:</B> [Estimated Sales]</p>
						<p><B>Lead name:</B> [Lead Name]</p>
						<p><B>Title:</B> [Title]</p>
						<p><B>Email:</B> [Email]</p>
						<p><B>Telephone:</B> [Telephone]</p>
						<p><B>Address Line 1:</B> [Address Line 1]</p>
						<p><B>City:</B> [City]</p>
						<p><B>Province:</B> [Province]</p>
						<p><B>Country:</B> [Country]</p>
						<p><B>Zip Code:</B> [Zip Code]</p>
						<p><B>Website:</B> [Website]</p>
						<br>

						<p>Should you have any questions or concerns please let me know.</p><br><br>

						<p><B>-Regards,</B></p>
						<p>[Admin]</p>
						";

						}


						$beforeArray = array(
							"[Opener]",
							"[Start Date]",
							"[Company Name]",
							"[Parent Company Name]",

							"[Business Type]",
							"[Primary NAICS Description]",
							"[Estimated Sales]",
							"[Lead Name]",
							"[Title]",
							"[Email]",
							"[Telephone]",

							"[Address Line 1]",
							"[City]",
							"[Province]",
							"[Country]",
							"[Zip Code]",
							"[Website]",
							"[Admin]",
						);

						$replaceArray = array(
							$opener,
							$start_date,
							$company,
							$parent_company,

							$business_type,
							$primary_NAICS_description,
							$estimated_sales,
							$lead_name,
							$title,
							$email,
							$telephone,

							$address_line_1,
							$city,
							$province,
							$country,
							$zip_code,
							$website,
							$admin,
						);

					}

					if($lead_status=="ASSIGNED TO OPENER")
					{
						$send_email = true;
						$toName = $opener;
						$toEmail = trim($opener_email);
						if($lead_status=="ASSIGNED TO OPENER")
						{
							$status = 'ASSIGNED';
						}
						else if($lead_status=="REASSIGNED TO OPENER")
						{
							$status = 'REASSIGNED';
						}

						$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'admin_to_opener');
						if(!empty($template_data))
						{
						$subject = "LEAD $status: ".$template_data['title'];
						$content = $template_data['template'];
						}
						else
						{
						$subject = "LEAD $status: A lead is assigned to you.";
						$content = "<p><B>Dear</B> [Opener],</p><br>

						<p>This is to inform you that a (i.e. web-presentation or face-to-face or conference call) has been scheduled for you with <B>[Company Name]</B> on <B>[Start Date]</B>. </p><br>

						<p>The participants include [Participant Names].</p><br>

						<p>Conference Call / Web Presentation Details</p>
						<p>Ring Central Login Info – Meeting IDs</p>
						<p>---</p><br>

						<p>The Company Highlights are as follows:</p><br>

						<p><B>Company:</B> [Company Name]</p>
						<p><B>Parent Company Name:</B> [Parent Company Name]</p>
						<p><B>Business Type:</B> [Business Type]</p>
						<p><B>Primary NAICS Description:</B> [Primary NAICS Description]</p>
						<p><B>Estimated Sales:</B> [Estimated Sales]</p>
						<p><B>Lead name:</B> [Lead Name]</p>
						<p><B>Title:</B> [Title]</p>
						<p><B>Email:</B> [Email]</p>
						<p><B>Telephone:</B> [Telephone]</p>
						<p><B>Address Line 1:</B> [Address Line 1]</p>
						<p><B>City:</B> [City]</p>
						<p><B>Province:</B> [Province]</p>
						<p><B>Country:</B> [Country]</p>
						<p><B>Zip Code:</B> [Zip Code]</p>
						<p><B>Website:</B> [Website]</p>
						<br>

						<p>Should you have any questions or concerns please let me know.</p><br><br>

						<p><B>-Regards,</B></p>
						<p>[Admin]</p>
						";

						}
						$beforeArray = array(
							"[Opener]",
							"[Start Date]",
							"[Company Name]",
							"[Parent Company Name]",

							"[Business Type]",
							"[Primary NAICS Description]",
							"[Estimated Sales]",
							"[Lead Name]",
							"[Title]",
							"[Email]",
							"[Telephone]",

							"[Address Line 1]",
							"[City]",
							"[Province]",
							"[Country]",
							"[Zip Code]",
							"[Website]",
							"[Admin]",
						);

						$replaceArray = array(
							$opener,
							$start_date,
							$company,
							$parent_company,

							$business_type,
							$primary_NAICS_description,
							$estimated_sales,
							$lead_name,
							$title,
							$email,
							$telephone,

							$address_line_1,
							$city,
							$province,
							$country,
							$zip_code,
							$website,
							$admin,
						);

					}

					if($lead_status=="ASSIGNED TO CLOSER" || $lead_status=="REASSIGNED TO CLOSER")
					{
						//update “Return to Opener” checkbox
						$udata = array(
							"value" => "false",
						);
						$this->db->where('record_id', $this->data["record_id"]);
						$this->db->where('record_meta_id', 23);
						$andrew_updated = $this->db->update("anb_crm_record_meta_value", $udata);
						//update “Return to Opener” checkbox


						$send_email = true;
						$toName = $closer;
						$toEmail = trim($closer_email);
						if($lead_status=="ASSIGNED TO CLOSER")
						{
							$status = 'ASSIGNED';
						}
						else if($lead_status=="REASSIGNED TO CLOSER")
						{
							$status = 'REASSIGNED';
						}

						$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'opener_to_closer');
						
						if(!empty($template_data))
						{
						$subject = "LEAD $status: ".$template_data['title'];
						$content = $template_data['template'];
						}
						else
						{
						$subject = "LEAD $status: A lead is assigned to you.";
						$content = "<p><B>Dear</B> [Closer],</p><br>

						<p>This is to inform you that a (i.e. web-presentation or face-to-face or conference call) has been scheduled for you with <B>[Company Name]</B> on <B>[Start Date]</B>. </p><br>

						<p>The participants include [Participant Names].</p><br>

						<p>Conference Call / Web Presentation Details</p>
						<p>Ring Central Login Info – Meeting IDs</p>
						<p>---</p><br>

						<p>The Company Highlights are as follows:</p><br>

						<p><B>Company:</B> [Company Name]</p>
						<p><B>Parent Company Name:</B> [Parent Company Name]</p>
						<p><B>Business Type:</B> [Business Type]</p>
						<p><B>Primary NAICS Description:</B> [Primary NAICS Description]</p>
						<p><B>Estimated Sales:</B> [Estimated Sales]</p>
						<p><B>Lead name:</B> [Lead Name]</p>
						<p><B>Title:</B> [Title]</p>
						<p><B>Email:</B> [Email]</p>
						<p><B>Telephone:</B> [Telephone]</p>
						<p><B>Address Line 1:</B> [Address Line 1]</p>
						<p><B>City:</B> [City]</p>
						<p><B>Province:</B> [Province]</p>
						<p><B>Country:</B> [Country]</p>
						<p><B>Zip Code:</B> [Zip Code]</p>
						<p><B>Website:</B> [Website]</p>
						<br>

						<p>Should you have any questions or concerns please let me know.</p><br><br>

						<p><B>-Regards,</B></p>
						<p>[Opener]</p>
						";

						}
						$beforeArray = array(
							"[Closer]",
							"[Start Date]",
							"[Company Name]",
							"[Parent Company Name]",

							"[Business Type]",
							"[Primary NAICS Description]",
							"[Estimated Sales]",
							"[Lead Name]",
							"[Title]",
							"[Email]",
							"[Telephone]",

							"[Address Line 1]",
							"[City]",
							"[Province]",
							"[Country]",
							"[Zip Code]",
							"[Website]",
							"[Opener]",
						);

						$replaceArray = array(
							$closer,
							$start_date,
							$company,
							$parent_company,

							$business_type,
							$primary_NAICS_description,
							$estimated_sales,
							$lead_name,
							$title,
							$email,
							$telephone,

							$address_line_1,
							$city,
							$province,
							$country,
							$zip_code,
							$website,
							$opener,
						);

					}

					if($lead_status=="DEAL CLOSED(WTA)")
					{
						$convertToClient = $this->ModuleModel->convertRecord($this->getUserId(), $this->data["record_id"]);
						if($convertToClient===true)
						{
							$this->session->set_flashdata('success',"Deal Closed. The Lead converted to Client successfully.");
							redirect(base_url().'modules/?cm=Clients');
						}

					}

					if($send_email===true)
					{
						$final_content = str_replace($beforeArray, $replaceArray, $content);
						//echo '<pre>';print_r($final_content);die;

						$edata = array(
							'title'=> $subject,
							'content'=> $final_content,
						);
						$emailTemplate = $this->load->view('emails/common',$edata,true);
						//echo $emailTemplate; die;

						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;

						//$fromEmail = 'harpreetclerisy@gmail.com';

						//~ $headers  = 'MIME-Version: 1.0' . "\r\n";
						//~ $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						//~ $headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
						//~ $headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";
						//~ $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
						//~ $headers .= 'X-Mailer: PHP/' . phpversion();

						$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);
						$this->email->from($fromEmail);
						$this->email->to($toEmail);
						$this->email->subject($subject);
						$this->email->message($final_content);
						if($this->email->send())
					  {
						 //~ echo 'Email sent.';
					  }
					  else
					  {
						 //~ echo 'Email not sent.';
					  }

						//~ if(mail($toEmail,$subject,$final_content,$headers))
						//~ {
							//~ //echo 'sent';	 die;
						//~ }
						//~ else
						//~ {
							//~ //echo 'not_sent';	 die;
						//~ }
					}

					$this->data["message"]["success"] = 'Record has been updated successfully.<a href="'. base_url() .'modules/viewRecord/?cm='. $this->data["current_module"] .'&id='.  $this->getPost('id') .'">View The Record?</a>';
					//$this->data["message"]["success"] = $message["message"];
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}
			}

			// by harp
			if($this->data["current_module"]=='Clients')
			{
				if($message["status"] === true && $this->data["record_id"]!='')
				{
					$record_data = $this->ModuleModel->loadRecord(null, $this->data["record_id"]);
					//echo '<pre>';print_r($record_data); die;

					$client_status = $record_data['__87'];
					$execution_date = $record_data['__102'];
					if($client_status=="Completed")
					{
						//Update
						$udata = array(
							"value" => $execution_date,
						);
						$this->db->where('record_id', $this->data["record_id"]);
						$this->db->where('record_meta_id', 101);
						$updated = $this->db->update("anb_crm_record_meta_value", $udata);

						//Update
					}


					$this->data["message"]["success"] = 'Record has been updated successfully.<a href="'. base_url() .'modules/viewRecord/?cm='. $this->data["current_module"] .'&id='.  $this->getPost('id') .'">View The Record?</a>';
				}
				else
				{
					$this->data["message"]["danger"] = $message["message"];
				}
			}

			// by harp
			if($this->data["current_module"]=='Contracts')
			{
				if($message["status"] === true && $this->data["record_id"]!='')
				{
					$record_data = $this->ModuleModel->loadRecord(null, $this->data["record_id"]);
					//echo '<pre>';print_r($record_data); //die;

					$send_email = false;

					$assigned_officer_id = $record_data['__0'];
					$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
					$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
					$admin_email = $user_data0['email'];

					$closer = "";
					$company = "";

					$client_id = $record_data['__161'];
					$client_record_data = $this->ModuleModel->loadRecord(null, $client_id);
					//echo '<pre>';print_r($client_record_data); die;

					$closer_id = $client_record_data['__104'];
					$user_data1 = $this->UserModel->loadUser($closer_id);
					$closer = $user_data1['first_name'].' '.$user_data1['last_name'];
					$closer_email = $user_data1['email'];

					if(isset($client_record_data['__108']))
					$company = $client_record_data['__108'];
					else
					$company = "";

					$technician_id = $record_data['__169'];
					$user_data1 = $this->UserModel->loadUser($technician_id);
					$technician = $user_data1['first_name'].' '.$user_data1['last_name'];
					$technician_email = $user_data1['email'];

					//echo '<pre>';print_r($user_data1); die;

					$accounting_id = $record_data['__170'];
					$user_data2 = $this->UserModel->loadUser($accounting_id);
					$accounting = $user_data2['first_name'].' '.$user_data2['last_name'];
					$accounting_email = $user_data2['email'];

					//echo '<pre>';print_r($user_data2); die;

					$contract_stage = $record_data['__162'];
					$technical_consultants_status = $record_data['__171'];
					$accountants_status = $record_data['__172'];

					if(is_array($record_data['__163']))
					$services = "<pre>".implode(",\n",$record_data['__163'])."</pre>";
					else
					$services = $record_data['__163'];

					$signing_rate = $record_data['__164'];
					$contract_number = $record_data['__165'];

					if($contract_stage == "Assigned to Technical Consultants")
					{
						$send_email = true;
						$toName = $technician;
						$toEmail = trim($technician_email);

						$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'admin_to_technician');
						if(!empty($template_data))
						{
						$subject = $template_data['title'];
						$content = $template_data['template'];
						}
						else
						{
						$subject = "Great, successfully secured a contract";
						$content = "<p><B>Dear</B> [Technician],</p><br>

						<p>It is with great pleasure to announce to you that closer <B> [Closer] </B> has successfully secured contract number<B> [Contract Number] </B> for Anbruch with company<B> [Company Name] </B> at the signing rate of <B> [Signing Rate] (%) </B> for the following service(s):</p><br>

						<p><B> [Services] </B></p><br>

						<p>Please proceed with contacting the client at your earliest convenience to commence the work at hand.</p><br>

						<p>Should you have any questions or concerns please let me know.</p><br><br>

						<p><B>-Regards,</B></p>
						<p>[Admin]</p>
						";

						}

						$beforeArray = array(
							"[Technician]",
							"[Closer]",
							"[Contract Number]",
							"[Company Name]",
							"[Signing Rate]",
							"[Services]",
							"[Admin]",
						);

						$replaceArray = array(
							$technician,
							$closer,
							$contract_number,
							$company,
							$signing_rate,
							$services,
							$admin,
						);

					}

					if($contract_stage == "Assigned to Accounting Deparment")
					{
						$send_email = true;
						$toName = $accounting;
						$toEmail = trim($accounting_email);

						$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'technician_to_accounting');
						if(!empty($template_data))
						{
						$subject = $template_data['title'];
						$content = $template_data['template'];
						}
						else
						{
						$subject = "Great, a service(s) has been completed.";
						$content = "<p><B>Dear</B> [Accounting],</p><br>

						<p>I would like inform you that the services [Services] secured under contract number<B> [Contract Number] </B> for Anbruch with company<B> [Company Name] </B> has been completed and a draft invoice for the [Company Name] has been prepared and attached for your review and approval. </p><br>

						<p>Once approved, kindly prepare and send the final invoice to the [Company Name] for payment.</p><br>

						<p>Should you have any questions or concerns please let me know.</p><br><br>

						<p><B>-Regards,</B></p>
						<p>[Technical]</p>
						";

						}

						$beforeArray = array(
							"[Accounting]",
							"[Contract Number]",
							"[Company Name]",
							"[Services]",
							"[Technical]",
						);

						$replaceArray = array(
							$accounting,
							$contract_number,
							$company,
							$services,
							$technician,
						);

					}

					if($contract_stage == "Recovery Cycle Completed")
					{
						//Update Contract  owner to Andrew
						$udata = array(
							"assigned_officer_id" => !empty($record_data) && !empty($record_data['__0']) ? $record_data['__0'] :1
						);
						$this->db->where('id', $this->data["record_id"]);
						$andrew_updated = $this->db->update("anb_crm_record", $udata);
						//Update Contract  owner to Andrew ends
					}

					if($technical_consultants_status == "Recovery None")
					{
						//Update
						$udata = array(
							"value" => "Recovery Cycle Completed",
						);
						$this->db->where('record_id', $this->data["record_id"]);
						$this->db->where('record_meta_id',162);
						$updated = $this->db->update("anb_crm_record_meta_value", $udata);
						//Update
						//Update Contract  owner to Andrew
						$udata = array(
							"assigned_officer_id" => !empty($record_data) && !empty($record_data['__0']) ? $record_data['__0'] :1
						);
						$this->db->where('id', $this->data["record_id"]);
						$andrew_updated = $this->db->update("anb_crm_record", $udata);
						//Update Contract  owner to Andrew ends
					}

					if($accountants_status != "Awaiting Draft Invoice")
					{
						//Update
						$udata = array(
							"value" => date("Y-m-d"),
						);
						$this->db->where('record_id', $this->data["record_id"]);
						$this->db->where('record_meta_id',176);
						$updated = $this->db->update("anb_crm_record_meta_value", $udata);
						//Update
					}

					if($send_email===true)
					{
						$final_content = str_replace($beforeArray, $replaceArray, $content);
						//echo '<pre>';print_r($final_content);die;

						$edata = array(
							'title'=> $subject,
							'content'=> $final_content,
						);
						$emailTemplate = $this->load->view('emails/common',$edata,true);
						//echo $emailTemplate; die;

						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;

						//$fromEmail = 'harpreetclerisy@gmail.com';

						//~ $headers  = 'MIME-Version: 1.0' . "\r\n";
						//~ $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
						//~ $headers .= 'Content-Transfer-Encoding:base64' . "\r\n";
						//~ $headers .= "From: ".$fromEmail. "<".$fromName.">" . "\r\n";
						//~ $headers .= 'Reply-To: '. $toEmail . "\r\n" ;
						//~ $headers .= 'X-Mailer: PHP/' . phpversion();

						$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail,$ccEmail="",$bccEmail="",$subject,$final_content);

						$this->email->from($fromEmail);
						$this->email->to($toEmail);
						$this->email->subject($subject);
						$this->email->message($final_content);
						if($this->email->send())
					  {
						 //~ echo 'Email sent.';
					  }
					  else
					  {
						 //~ echo 'Email not sent.';
					  }

						//~ if(mail($toEmail,$subject,$final_content,$headers))
						//~ {
							//~ //echo 'sent';	 die;
						//~ }
						//~ else
						//~ {
							//~ //echo 'not_sent';	 die;
						//~ }
					}

					$this->data["message"]["success"] = 'Record has been updated successfully.<a href="'. base_url() .'modules/viewRecord/?cm='. $this->data["current_module"] .'&id='.  $this->getPost('id') .'">View The Record?</a>';
					//$this->session->set_flashdata('success',"Record has been updated successfully.");
					//redirect(base_url().'modules/?cm=Contracts&id=1');
				}
				else
				{
					$this->session->set_flashdata('success',$message["message"]);
					//redirect(base_url().'modules/?cm=Contracts&id=1');
					$this->data["message"]["danger"] = $message["message"];
				}
			}

		}

		$this->data["record_data"] = $this->ModuleModel->loadRecord();

		//echo '<pre>';print_r($this->data["meta_fields"]);die;
		//echo '<pre>';print_r($this->data["record_data"]);die;

		$this->data["users_list"] = $this->ModuleModel->loadUsersList();
		if ($this->data["current_module"] == CONTRACTS_PLURAL_NAME)
		{
			$this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
		}
		$this->viewLoad("modules/edit");
	}

	public function viewRecord()
	{
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		global $BOOKING_STATUS;
		$loadViewWithData = true;
		$this->data["recordStatus"] = ($this->getPost("record_status") != '') ? $this->getPost("record_status") : $RECORD_STATUS['CYCLE_RUNNING'];
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["current_record_id"] = $this->getPost("id");
		$this->data["booking_status"] = $BOOKING_STATUS;

		if ($this->data["recordStatus"] != $RECORD_STATUS['CYCLE_RUNNING']){
				$this->data["writePermission"] = false;
		}

		if ( $this->getPost("ac") == 'del' )
		{
				if ($this->data["writePermission"] == false){
						$this->redirectAccessViolatedUser();
				}
				$message = $this->ModuleModel->delRecord();
				if ($message["status"] === true){
						$this->data["action"] = ( $this->getPost("mtd") == 1 ) ? "archive" : "delete";
						$this->data["message"]["success"] = "Record has been " . $this->data["action"] . "d successfully";
						$this->data["deletedRecord"] = true;
						$loadViewWithData = false;
						$this->viewLoad("modules/view");
				} else {
						$this->data["message"]["danger"] = 'Error! Record cannot be deleted now. Please try again later.';
				}
		}
		else if ( $this->getPost("ac") == 'attachment' )
		{
			$record_id = $this->postGet('record_id');
			$record_attachment_url = null;
			if (isset($_FILES["record_attachment"]) && $_FILES["record_attachment"]['name'] != '')
			{

				$fileUpload = $this->fileUpload($this->getUserId(), "record_attachment", RECORD_ATTACHMENT, $record_id);

				if($fileUpload["status"] === true)
				{
					$record_attachment_url = $fileUpload["attachment_url"];
				}
				else
				{
					$this->data["message"]["danger"] = $fileUpload["error"];
				}
			}

			if(!isset($this->data["message"]["danger"]))
			{
				$updateIssue = $this->ModuleModel->addAttachment($this->getUserId(), $record_id, $record_attachment_url, RECORD_ATTACHMENT);
				if ($updateIssue === true )
				{
					$this->data["message"]["success"] = "The attachment has been uploaded successfully";
				}
				else
				{
					$this->data["message"]["danger"] = $updateIssue;
				}
			}
		}
		else if ( $this->getPost("ac") == 'note' )
		{
				$record_id = $this->postGet('record_id');
				$module = $this->postGet('cm');
				$updateIssue = $this->ModuleModel->addNote($this->getUserId(), $record_id, RECORD_ATTACHMENT);
				if ($updateIssue === true ) {
						$this->data["message"]["success"] = "The note has been added successfully";
						redirect(base_url().'modules/viewRecord?cm='.$module.'&id='.$record_id.'');

				} else {
						redirect(base_url().'modules/viewRecord?cm='.$module.'&id='.$record_id.'');
						$this->data["message"]["danger"] = $updateIssue;
				}
		}
		else if ( $this->getPost("ac") == 'convert' )
		{
				$service_type = $this->getPost("service_type");
				$signing_rate = $this->getPost("signing_rate");
				$expected_technical_start_date = $this->getPost('expected_technical_start_date');
				if(isset($service_type) && !empty($service_type))
				{
					$service_type = str_replace(',', '____', $service_type);
					$this->App_model->rowUpdate('anb_crm_record_meta_value',array('value' => $service_type), array("record_id" => $this->getPost("id"), "record_meta_id" => '9'));
					
				}
				if(isset($signing_rate) && !empty($signing_rate))
				{
					$this->App_model->rowUpdate('anb_crm_record_meta_value', array('value' => $signing_rate), array("record_id" => $this->getPost("id"), "record_meta_id" => '13'));
				}
				if ($this->data["writePermission"] == false)
				{
					$this->redirectAccessViolatedUser();
				}
				$convertIssue = $this->ModuleModel->convertRecord($this->getUserId(),$this->getPost("id"),$expected_technical_start_date);
				//die('in c');
				if($convertIssue)
				{
					$this->LogsModel->addLogs('Lead Converted to Client', 'A Lead is Converted to Client' ,$convertIssue,$this->getPost("cm"),$this->getUserId());
					$result = $this->sendMail($this->getPost("ac") , 'A Lead convert to Client', $record_id, 'Lead Convertion', 'lead_converted');
					$record_data = $this->ModuleModel->loadRecord1(null, $record_id);
					if($result){
						$this->data["message"]["success"] = "The record has been converted successfully";
						$this->session->set_flashdata('success',"The record has been updated successfully.");
						redirect(base_url().'modules/?cm=Clients&id=1&own='.$record_data['__0']);
					}
					/*$record_id = $this->getPost("id");echo "<br>"; print_r($record_id);
					$record_data = $this->ModuleModel->loadRecord1(null, $record_id);
					
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
					$send_email = false;
					if($lead_status=="ASSIGNED TO OPENER")
					{
						$send_email = true;
						$toName = $opener;
						$toEmail = trim($opener_email);
						$subject = 'A Lead convert to client.';
						//$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', 'admin_to_opener');
						$assignedData = array(
							'current_module_id' => 1,
							'leadassignedofficer' => $opener,
							'start_date' => $record_data['__24'],
							'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
							'parent_company' => isset($record_data['__41']) ? $record_data['__41'] : "No Parent Company Name Available",
							'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
							'primary_NAICS_description' => isset($record_data['__77']) ? $record_data['__77'] : "Primary NAICS description Not Available",
							'estimated_sales' => isset($record_data['__80']) ? $record_data['__80'] : "Estimated Sales Not Available",
							'lead_name' => $lead_name,
							'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
							'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
							'telephone' => isset($record_data['__32']) ? $record_data['__32'] : " Number Not Available",
							'address_line_1' => isset($record_data['__38']) ? $record_data['__38'] : "Address Not Available",
							'city' => isset($record_data['__35']) ? $record_data['__35'] : "City Not Available",
							'province' => isset($record_data['__40']) ? $record_data['__40'] : "Province Not Available",
							'country' => isset($record_data['__37']) ? $record_data['__37'] : "Country Not Available",
							'zip_code' => isset($record_data['__36']) ? $record_data['__36'] : "Zip Code Not Available",
							'website' => isset($record_data['__34']) ? $record_data['__34'] : "Website Not Available",
							'admin' => $user_data0['first_name'].' '.$user_data0['last_name'],
						);
					
					}
					if($lead_status=="ASSIGNED TO CLOSER")
					{
						$send_email = true;
						$toName = $closer;
						$toEmail = trim($closer_email);
						$subject = 'A Lead convert to client.';
						$assignedData = array(
							'current_module_id' => 1,
							'leadassignedofficer' => $closer,
							
							'company' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
							'parent_company' => isset($record_data['__41']) ? $record_data['__41'] : "No Parent Company Name Available",
							'business_type' => isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
							'primary_NAICS_description' => isset($record_data['__77']) ? $record_data['__77'] : "Primary NAICS description Not Available",
							'estimated_sales' => isset($record_data['__80']) ? $record_data['__80'] : "Estimated Sales Not Available",
							'lead_name' => $lead_name,
							'title' => isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
							'email' => isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
							'telephone' => isset($record_data['__32']) ? $record_data['__32'] : " Number Not Available",
							'address_line_1' => isset($record_data['__38']) ? $record_data['__38'] : "Address Not Available",
							'city' => isset($record_data['__35']) ? $record_data['__35'] : "City Not Available",
							'province' => isset($record_data['__40']) ? $record_data['__40'] : "Province Not Available",
							'country' => isset($record_data['__37']) ? $record_data['__37'] : "Country Not Available",
							'zip_code' => isset($record_data['__36']) ? $record_data['__36'] : "Zip Code Not Available",
							'website' => isset($record_data['__34']) ? $record_data['__34'] : "Website Not Available",
							
						);
					}
					if($send_email == true)
					{
						$assignedData['mainheading'] = 'Lead';
						$assignedData['heading'] = 'A Lead convert to Client';
						$emailTemplate = $this->load->view('emails/convertClient',$assignedData,true);	
						$fromEmail = COMPANY_NOREPLY_EMAIL;
						$fromName = COMPANY_NAME;
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
					}*/

					/*$this->data["message"]["success"] = "The record has been converted successfully";
					$this->session->set_flashdata('success',"The record has been updated successfully.");
					redirect(base_url().'modules/?cm=Clients&id=1&own='.$record_data['__0']);*/
				}
				else
				{
					$this->data["message"]["danger"] = $convertIssue;
					$this->session->set_flashdata('success',$convertIssue);
					redirect(base_url().'modules/?cm=Leads&id=1');
				}


		}

		if ($loadViewWithData)
		{

			$this->data['user_role'] = $this->getUserRole();
			$this->data['user_id'] = $this->getUserId();

			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["meta_fields1"] = $this->ModuleModel->loadModulesMeta('Contracts');
			/*print_r($this->data['meta_fields1']);
			die;*/
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;

			$record_data = $this->ModuleModel->loadRecord($this->data["recordStatus"]);
			$lead_data = array();
			if(isset($record_data['lead_id']) && !empty($record_data['lead_id']))
			{
				$lead_data = $this->App_model->getData('anb_crm_record_meta_value','*', array('record_id' => $record_data['lead_id'],'record_meta_id' => 13));
			}
			
			$this->data["record_data"] = $record_data;
			$this->data["lead_data"] = $lead_data;

			if ($this->data["record_data"]["created_by"] == ''){
				redirect(base_url().'modules/?cm=Leads&id=1');
				exit;
			}
			$this->data["users_list"] = $this->ModuleModel->loadUsersList();

			$this->data["notes"] = $this->ModuleModel->loadNotes();
			$this->data["attachments"] = $this->ModuleModel->loadAttachments();
			/*$this->data["activities"] = $this->ActivitiesModel->loadActivitiesList(null, $this->data["current_record_id"]);*/
			$this->data["activities1"] = $this->LogsModel->countActivity($this->data["current_record_id"]);

			
			$this->data["logData"] = $this->LogsModel->viewLogs($this->data["current_record_id"]);
			$this->data["logs"] = $this->LogsModel->loadLogs($this->data["current_record_id"]);
			//~ $this->data["logs"] = '';
			//~ echo '<pre>';print_r($this->data["logs"]);die;

			if ($this->data["current_module"] == CONTRACTS_PLURAL_NAME) {
					$this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
			}

			$this->data["booking_id"] = $this->getPost("booking_id");
			
			$this->data["bookings"] = $this->BookingModel->loadBookingsList($this->data["booking_id"], $this->data["current_record_id"]);
			if($this->data["booking_id"])
			{
				$noti = $this->BookingModel->update_notification($this->data["booking_id"], $this->getUserId());
			}

			
			$this->data['qualified'] = $this->ModuleModel->loadQualified($this->data['user_id'], $this->data["current_record_id"]);
		/*	print_r($this->data['qualified']);
			die('test');
		*/	
			if ($this->data["current_module"] == 'Clients'){

					$this->data["contracts"] = $this->ModuleModel->loadContracts();
					
					if(!empty($record_data) && !empty($record_data['lead_id']))
				    {
				    	/*print_r($record_data);
				    	die;*/
				 	 if(empty($this->data['qualified'])){
				 		$lead_id = !empty($record_data['lead_id']) ? $record_data['lead_id'] : 0;
				 	 $this->data['qualified'] = $this->ModuleModel->loadQualified($this->data['user_id'], $lead_id);

				 	}
/*				 	print_r($this->data['qualified']);
				 	 die;*/
				 	$this->data["bookings"]  = array_merge($this->BookingModel->loadBookingsList($this->data["booking_id"], $record_data['lead_id']),$this->BookingModel->loadBookingsList($this->data["booking_id"], $this->data["current_record_id"]));
				    $this->data['bookingData'] = $this->App_model->getData('anb_crm_bookings', array('created_time', 'record_id'), array('record_id'=>$record_data['lead_id']), false, 'created_time', 'ASC', 1); 	
				    }
			}

			//echo '<pre>';print_r($this->data["qualified"]);die;
			if($this->data["current_module"] == CONTRACTS_PLURAL_NAME)
			{
				$this->data["active_clients_list"] = $this->ModuleModel->loadClientsList();
				//echo '<pre>';print_r($this->data["active_clients_list"]); die;

				$this->db->select("*");
				$this->db->where("r.record_id", $this->data["current_record_id"]);
				$res = $this->db->get('anb_crm_invoices as r');
				$this->data["invoice_data"] = $res->row_array();
				if(!empty($record_data) && !empty($record_data['lead_id']))
			    {
			    $client_id = !empty($record_data['__161']) ? $record_data['__161'] : 0;
			 	$this->data['qualified'] = $this->ModuleModel->loadQualified($this->data['user_id'], $record_data['lead_id']);
			 	$this->data["bookings"]  = array_merge($this->BookingModel->loadBookingsList($this->data["booking_id"], $record_data['lead_id']),$this->BookingModel->loadBookingsList($this->data["booking_id"],$client_id ));
				$this->data['bookingData'] = $this->App_model->getData('anb_crm_bookings', array('created_time', 'record_id'), array('record_id'=>$client_id), false, 'created_time', 'ASC', 1); 	
				 if(empty($this->data['bookingData'])){
				    	$this->data['bookingData'] = $this->App_model->getData('anb_crm_bookings', array('created_time', 'record_id'), array('record_id'=>$record_data['lead_id']), false, 'created_time', 'ASC', 1);
				    }else{
				    	$this->data['bookingData'] = $this->data['bookingData'];
				    }
			    }
			}
			$this->data['surveyQ1'] = $this->App_model->getData('qualify_questions', array('*'), array('cat_id'=>1));
			$this->data['surveyQ2']	= $this->App_model->getData('qualify_questions', array('*'), array('cat_id'=>2));
			$this->data['surveyQ3']	= $this->App_model->getData('qualify_questions', array('*'), array('cat_id'=>3));

			//$this->data['developData'] = $this->App_model->getData('anb_crm_emails', array('created_time', 'record_id'), array('record_id'=>$this->getPost("id")), false, 'created_time', 'ASC', 1);
			$openercloserjoin = array(
	    			array(
	    				'table' => 'anb_crm_users_personal_info b',
	    				'on' => 'a.id = b.user_id',
	    			),
		    	);	
			if($this->data["current_module"] == 'Leads'){
				//$this->data['closerOpener'] = $this->App_model->getData('anb_crm_users a', array('b.first_name', 'b.user_id', 'a.role_id', 'b.last_name'), array('role_id'=>3), $openercloserjoin);
				
				$this->data['closerOpener'] = $this->App_model->getData('anb_crm_users a', array('b.first_name', 'b.user_id', 'a.role_id', 'b.last_name'),false, $openercloserjoin);
				

				$this->data['bookingData'] = $this->App_model->getData('anb_crm_bookings', array('created_time', 'record_id'), array('record_id'=>$this->getPost("id")), false, 'created_time', 'ASC', 1);	
			}else if($this->data["current_module"] == 'Clients'){
				$this->data['closerOpener'] = $this->App_model->getData('anb_crm_users a', array('b.first_name', 'b.user_id', 'a.role_id', 'b.last_name'), array('role_id'=>4), $openercloserjoin);
				/*print_r($this->data['closerOpener']);
				die; */  
			
			}
			$this->viewLoad("modules/view");
		}

	}

	function sendMailDirect()
	{

		require_once APPPATH.'libraries/google-api-php-client-2.2.0/src/Google/autoload.php';

		$service_account_name = 'anbruch-gmail-api@anbruch-221510.iam.gserviceaccount.com'; //Email Address clerisytest1

		$key_file_location = $_SERVER['DOCUMENT_ROOT'] .'/anbruch-221510-5ed31a1933a4.json';

		$user_to_impersonate = 'vandana@stelleninfotech.info';

		putenv("GOOGLE_APPLICATION_CREDENTIALS=$key_file_location");

		$client = new Google_Client(); //AUTHORIZE OBJECTS
		$client->setApplicationName("Anbruch gmal api for send email");

		$client->setAuthConfig($key_file_location);

		$client->useApplicationDefaultCredentials();

		$client->setSubject($user_to_impersonate);
		//$client->setSubject($service_account_name);
		//$client->setConfig('subject', $user_to_impersonate);



		$client->setAccessType('offline');
		$client->setApprovalPrompt('force');

		//$client->setScopes(Google_Service_Gmail::GMAIL_SEND);

		$client->setScopes(["https://mail.google.com","https://www.googleapis.com/auth/gmail.send","https://www.googleapis.com/auth/gmail.compose","https://www.googleapis.com/auth/email.migration","https://www.googleapis.com/auth/gmail.insert","https://www.googleapis.com/auth/gmail.labels"]);


		echo '$client<pre>';print_r($client);    //die;

		$service = new Google_Service_Gmail($client);

		echo '$service<pre>';print_r($service); //die;

		// Process data
		//try {
				$strSubject = "test subject";
				$strRawMessage = "From: <clerisytest1@gmail.com>\r\n";
				$strRawMessage .= "To: <harpreetclerisy@gmail.com>\r\n";

				$strRawMessage .= "Subject: =?utf-8?B?" . base64_encode($strSubject) . "?=\r\n";
				$strRawMessage .= "MIME-Version: 1.0\r\n";
				$strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
				$strRawMessage .= "Content-Transfer-Encoding: base64" . "\r\n\r\n";
				$strRawMessage .= "Hello World!" . "\r\n";

				// The message needs to be encoded in Base64URL
				$mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
				$msg = new Google_Service_Gmail_Message();
				echo '$msg<pre>';print_r($msg);  //die;

				$msg->setRaw($mime);
				echo '$msg2<pre>';print_r($msg);  //die;


				//The special value **me** can be used to indicate the authenticated user.

				$rs = $service->users_messages->send("me", $msg);
				echo '$rs<pre>';print_r($rs);  die;

				// Print the labels in the user's account.

				//$user = 'me';
				//$results = $service->users_labels->listUsersLabels($user);

				//if (count($results->getLabels()) == 0) {
					//print "No labels found.\n";
				//} else {
					//print "Labels:\n";
					//foreach ($results->getLabels() as $label) {
						//printf("- %s\n", $label->getName());
					//}
				//}

		//}
		//catch (Exception $e)
		//{
			//echo "An error occurred: " . $e->getMessage();
		//}



		exit;

	}

	function create_invoice()
	{
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		global $BOOKING_STATUS;

		$this->data["recordStatus"] = ($this->getPost("record_status") != '') ? $this->getPost("record_status") : $RECORD_STATUS['CYCLE_RUNNING'];
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["current_record_id"] = $this->getPost("id");
		$this->data["booking_status"] = $BOOKING_STATUS;

			$this->data['user_role'] = $this->getUserRole();
			$this->data['user_id'] = $this->getUserId();


		if($this->data["current_module"]=="Contracts")
		{
			$this->db->select("*");
			$this->db->where("r.record_id", $this->data["current_record_id"]);
			$res = $this->db->get('anb_crm_invoices as r');
			$this->data["invoice_data"] = $invoice_data = $res->row_array();
			if(!empty($invoice_data))
			{
				$this->session->set_flashdata('success','Invoice already exists!!');
				redirect(base_url().'modules/invoice/?cm=Contracts&id='.$this->data["current_record_id"].'&invoice_id='.$invoice_data["id"]);
			}

			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;
			$this->data["record_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"]);
			if ($this->data["record_data"]["created_by"] == ''){
				redirect(base_url().'modules/?cm=Leads');
				exit;
			}

			$record_data = $this->data["record_data"];

			//echo '<pre>';print_r($this->data["record_data"]); //die;

			$client_id = $this->data["record_data"]["__161"];

			if($client_id!="")
			{
				$this->data["client_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"], $client_id);
			}
			else
			{
				$this->data["client_data"] = "";
			}

			//echo '<pre>';print_r($this->data["client_data"]);die;

			if($_POST)
			{
				//echo "<pre>";print_r($_POST);die;

				$data["record_id"] = $this->data["current_record_id"];
				$data["module_id"] = 3;
				$data["invoice_date"] = date('Y-m-d', strtotime($_POST["invoice_date"]));
				$data["invoice_number"] = $_POST["invoice"];

				$data["description"] = $_POST["description"];
				$data["note"] = $_POST["note"];
				$data["created_time"] = date('Y-m-d H:i:s');
				$data["created_by"] = $this->data['user_id'];

				$data["recovery_amount"] = $_POST["recovery_amount"];
				$data["signing_rate"] = $_POST["signing_rate"];
				$data["gst_rate"] = $_POST["gst_rate"];
				$data["total_amount"] = $_POST["total_invoice_amount"];

				$this->db->insert("anb_crm_invoices", $data);
				$invoice_id = $this->db->insert_id();
				if($invoice_id){
                    $this->LogsModel->addLogs('Invoice', 'Invoice is created', $data["record_id"], 'Contracts',$_SESSION['user_id']);
                }
				$this->session->set_flashdata('success','The invoice created successfully.');

				redirect(base_url().'modules/invoice/?cm='.$this->data["current_module"].'&id='.$this->data["current_record_id"].'&invoice_id='.$invoice_id);
			}


			$this->viewLoad("modules/create_invoice");
		}
		else
		{
			$this->viewLoad("modules/empty_view");
		}
	}

function qualify_now()
	{
		//echo '<pre>';print_r($_POST);exit;

	$this->data["current_module"] = $this->getPost("cm");

	if($this->data["current_module"]=="Leads")
		{

		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			$record_id = $this->getPost("record_id");
			if ( ($message = $this->ModuleModel->addQualifyNow() === true))
			{
				$this->session->set_flashdata('success','The record has been saved successfully.');

				redirect(base_url().'modules/viewRecord/?cm=Leads&id='.$record_id.'&record_status=3');
			}
			else
			{
				$this->session->set_flashdata('error',$message);
				redirect(base_url().'modules/viewRecord/?cm=Leads&id='.$record_id.'&record_status=3');
			}
		}

		exit;
	}elseif($this->data["current_module"]=="Clients"){

  		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			$record_id = $this->getPost("record_id");
			if ( ($message = $this->ModuleModel->addQualifyNow() === true))
			{
				$this->session->set_flashdata('success','The record has been saved successfully.');

				redirect(base_url().'modules/viewRecord/?cm=Clients&id='.$record_id.'&record_status=3');
			}
			else
			{
				$this->session->set_flashdata('error',$message);
				redirect(base_url().'modules/viewRecord/?cm=Clients&id='.$record_id.'&record_status=3');
			}
		}

	exit;
}

}

	function getClientById()
	{
		//echo '<pre>';print_r($_POST);exit;

		if ( ($requestMethod = strtolower($this->input->method())) == 'post')
		{
			$client_id = $this->getPost("client_id");
			$client = $this->ModuleModel->get_client_by_id($client_id);
			echo json_encode($client);
		}
		else
		{
			echo false;
		}

		exit;
	}

	function invoice()
	{
		global $FIELD_TYPE;
		global $RECORD_STATUS;
		global $BOOKING_STATUS;

		if(is_numeric($this->getPost("invoice_id")) && $this->getPost("invoice_id")=="")
		{
			$this->session->set_flashdata('error','No Data Found!.');
			redirect(base_url().'modules/?cm=Contracts');
		}
		$this->data["invoice_id"] = $invoice_id = $this->getPost("invoice_id");

		$this->db->select("*");
		$this->db->where("r.id", $invoice_id);
		$res = $this->db->get('anb_crm_invoices as r');
		$this->data["invoice_data"] = $invoice_data =  $res->row_array();

		if(empty($invoice_data))
		{
			$this->session->set_flashdata('error','No Result Found!.');
			redirect(base_url().'modules/?cm=Contracts');
		}

		if($invoice_data['record_id']!=$this->getPost("id"))
		{
			$this->session->set_flashdata('error','No Result Found!.');
			redirect(base_url().'modules/?cm=Contracts');
		}

		$this->data["recordStatus"] = ($this->getPost("record_status") != '') ? $this->getPost("record_status") : $RECORD_STATUS['CYCLE_RUNNING'];
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["current_record_id"] = $this->getPost("id");
		$this->data["booking_status"] = $BOOKING_STATUS;

			$this->data['user_role'] = $this->getUserRole();
			$this->data['user_id'] = $this->getUserId();

		if($this->data["current_module"]=="Contracts")
		{
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;
			$this->data["record_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"]);
			if ($this->data["record_data"]["created_by"] == ''){
				redirect(base_url().'modules/?cm=Leads');
				exit;
			}

			//echo '<pre>';print_r($this->data["record_data"]); //die;

			$client_id = $this->data["record_data"]["__161"];

			if($client_id!="")
			{
				$this->data["client_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"], $client_id);
			}
			else
			{
				$this->data["client_data"] = "";
			}

			//echo '<pre>';print_r($this->data["client_data"]);die;

			$this->viewLoad("modules/invoice");
		}
		else
		{
			$this->viewLoad("modules/empty_view");
		}

	}

	function invoice_download()
	{

          // Load pdf library
        //$this->load->library('pdf');


		global $FIELD_TYPE;
		global $RECORD_STATUS;
		global $BOOKING_STATUS;

		if(is_numeric($this->getPost("invoice_id")) && $this->getPost("invoice_id")=="")
		{
			$this->session->set_flashdata('error','No Data Found!.');
			redirect(base_url().'modules/?cm=Contracts');
		}
		$this->data["invoice_id"] = $invoice_id = $this->getPost("invoice_id");

		$this->db->select("*");
		$this->db->where("r.id", $invoice_id);
		$res = $this->db->get('anb_crm_invoices as r');
		$this->data["invoice_data"] = $invoice_data =  $res->row_array();

		if(empty($invoice_data))
		{
			$this->session->set_flashdata('error','No Result Found!.');
			redirect(base_url().'modules/?cm=Contracts');
		}

		if($invoice_data['record_id']!=$this->getPost("id"))
		{
			$this->session->set_flashdata('error','No Result Found!.');
			redirect(base_url().'modules/?cm=Contracts');
		}

		$this->data["recordStatus"] = ($this->getPost("record_status") != '') ? $this->getPost("record_status") : $RECORD_STATUS['CYCLE_RUNNING'];
		$this->data["current_module"] = $this->getPost("cm");
		$this->data["current_record_id"] = $this->getPost("id");
		$this->data["booking_status"] = $BOOKING_STATUS;

			$this->data['user_role'] = $this->getUserRole();
			$this->data['user_id'] = $this->getUserId();

		if($this->data["current_module"]=="Contracts")
		{
			$this->data["meta_fields"] = $this->ModuleModel->loadModulesMeta($this->data["current_module"]);
			$this->data["FIELD_TYPE"] = $FIELD_TYPE;
			$this->data["record_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"]);
			if ($this->data["record_data"]["created_by"] == ''){
				redirect(base_url().'modules/?cm=Leads');
				exit;
			}

			//echo '<pre>';print_r($this->data["record_data"]); //die;

			$client_id = $this->data["record_data"]["__161"];

			if($client_id!="")
			{
				$this->data["client_data"] = $this->ModuleModel->loadRecord($this->data["recordStatus"], $client_id);
			}
			else
			{
				$this->data["client_data"] = "";
			}

			//echo '<pre>';print_r($this->data);die;

			//$this->viewLoad("modules/invoice");


		 // $this->load->view("reports/invoice_pdf",$this->data);
		 // //$this->load->view("modules/pdf",$this->data);

			// $html = $this->output->get_output();
   //              // Load HTML content
   //      $this->dompdf->loadHtml($html);


   //              // (Optional) Setup the paper size and orientation
   //      $this->dompdf->setPaper('A4', 'portrait');

   //              // Render the HTML as PDF
   //      $this->dompdf->render();

   //      // Output the generated PDF (1 = download and 0 = preview)
   //      $this->dompdf->stream("invoice.pdf", array("Attachment"=>0));


  //   $req = curl_init("http://stelleninfotech.in/pdfservice1/?API_SECRET=grEcdeHaMXLhZtrjyfcLurz7ibCbeyOg");

		// curl_setopt_array($req, array(
		//     CURLOPT_RETURNTRANSFER => true,
		//     CURLOPT_POST => 1,
		//     CURLOPT_POSTFIELDS => "content=".urlencode( base_url().'modules/invoice_download/?cm=Contracts&id='.$invoice_data["record_id"].'&invoice_id='.$invoice_data["id"])
		// ));

		// $pdf = curl_exec($req);


		// curl_close($req);

		// $pdf_name = "../tmp/".uniqid().".pdf";

		// file_put_contents($pdf_name, $pdf);


		//load mPDF library
		$this->load->library('m_pdf');
		//now pass the data//

		$html=$this->load->view('reports/invoice_pdf',$this->data, true); //load the pdf.php by passing our data and get all data in $html varriable.

		print_r($html); die;
		$pdfFilePath ="webpreparations-".time().".pdf";
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "I");
		exit;

		}
		else
		{
			$this->viewLoad("modules/empty_view");
		}

	}

	public function email_imageUpload(){

		if(isset($_FILES['upload'])){

        $filen = $_FILES['upload']['tmp_name'];

        $file_name = $_FILES['upload']['name'].time();

         // echo "<pre>"; print_r($file_name); die;


        $con_images = "./assets/images/".$file_name;

        // $data = move_uploaded_file($filen, $con_images);

        // echo "<pre>"; print_r($data); die;

        $image = trim($con_images, ".");
        // echo "<pre>"; print_r($url); die;

      move_uploaded_file($filen, $con_images);

       $url = "https://crm.anbruch.com".$image;

		  // echo "<pre>"; print_r($url); die;
   $funcNum = $_GET['CKEditorFuncNum'] ;

   //echo "<pre>"; print_r($funcNum); die;
   // Optional: instance name (might be used to load a specific configuration file or anything else).
   $CKEditor = $_GET['CKEditor'] ;
   // Optional: might be used to provide localized messages.
   $langCode = $_GET['langCode'] ;

   // Usually you will only assign something here if the file could not be uploaded.
   $message = 'Upload success!';
   // echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";

   $output = '<html><body><script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'","'.$message.'");</script></body></html>';

//echo "<pre>"; print_r($output); die;
echo $output;
exit;

}
	}

public function get_email_data(){

	$data = $this->ModuleModel->get_email();

	echo "<pre>"; print_r($data); die;
}

	public function setQualifyData()
	{			
		/*echo '<pre>';
		print_r($_POST);
		echo '</pre>';*/
		$current_module = $this->getPost('cm');
		$record_id = $this->input->post('record_id');
		$data1 = $this->App_model->getData('qualify_answers','id',array('record_id' =>$record_id));
		//print_r($data1);
		/*echo $record_id;
		print_r(($data1));
		die;*/
		 if(!empty($data1)){
		 	$this->App_model->rowsDelete('qualify_answers', array('record_id'=>$record_id));
		 	 //echo $this->db->last_query();
		 }
/*		 print_r($data1);
		 die;*/
		for($i=1; $i <= $_POST['size']; $i++){
			$data = array('questions' => (isset($_POST['ques_'.$i]) && !empty($_POST['ques_'.$i]))? $_POST['ques_'.$i]:'No',
			   'answers'  => (isset($_POST['ques_others_'.$i]) && !empty($_POST['ques_others_'.$i]))? $_POST['ques_others_'.$i]:(isset($_POST['ques_'.$i.'_ans']) && !empty($_POST['ques_'.$i.'_ans'])? $_POST['ques_'.$i.'_ans']:'No'),
			   'user_id'  => $_POST['user_id'],
			   'record_id'=> $_POST['record_id'],
			   'module_name'=> $this->getPost("cm"),
			   'survey_cat_id' => $_POST['cat_id'],
			   'created_time' =>  date('Y-m-d H:i:s'),
				);

			
			if($_POST['cat_id'] == 1){
				$data['survey_name'] = 'APPRENTICESHIP TAX - AT';
			}
			if($_POST['cat_id'] == 2){
				$data['survey_name'] = 'CUSTOMS DUTY - CD';	
			}
			if($_POST['cat_id'] == 3){
				$data['survey_name'] = 'SALES TAX - ST';		
			}

			if(isset($_POST['sub_ques_'.$i]) && !empty($_POST['sub_ques_'.$i])){
				$data['sub_question'] = $_POST['sub_ques_'.$i];
				$data['sub_question_ans'] = (isset($_POST['sub_que_'.$i.'_ans']) && !empty($_POST['sub_que_'.$i.'_ans']))?$_POST['sub_que_'.$i.'_ans']:'No'; 
			}
			if(isset($_POST['cat_G_'.$i]) && !empty($_POST['cat_G_'.$i])){
				$data['cat_1_question'] = $_POST['cat_G_'.$i];
				$data['cat_1_ans'] = $_POST['cat_G_ans'.$i];
			}
			if(isset($_POST['cat_P_'.$i]) && !empty($_POST['cat_P_'.$i])){
				$data['cat_2_question'] = $_POST['cat_P_'.$i];
				$data['cat_2_ans'] = $_POST['cat_P_ans'.$i];
			}
			if(isset($_POST['cat_Q_'.$i]) && !empty($_POST['cat_Q_'.$i])){
				$data['cat_3_question'] = $_POST['cat_Q_'.$i];
				$data['cat_3_ans'] = $_POST['cat_Q_ans'.$i];
			}
			if(isset($_POST['cat_A_'.$i]) && !empty($_POST['cat_A_'.$i])){
				$data['cat_4_question'] = $_POST['cat_A_'.$i];
				$data['cat_4_ans'] = $_POST['cat_A_ans'.$i];
			}	

			if(isset($data) && !empty($data)){
				$message = $this->App_model->rowInsert('qualify_answers', $data);
			}
	}
	$ans = $this->input->post('ques_1_ans');
	if($ans == 'Yes')
	{
		$logid = $this->LogsModel->addLogs('Qualified', $current_module.' is Qualified' ,$record_id, $current_module,$_SESSION['user_id']);
	}
	else
	{
		$logid = $this->LogsModel->addLogs('Qualified', $current_module.' is not Qualified' ,$record_id, $current_module,$_SESSION['user_id']);
	}
	if($message && $ans == 'Yes')
	{
		if($current_module == 'Leads')
		{
			$status = $this->sendMail(null,null,$record_id,'Lead Qualified','Qualified_Lead');
		}
		if($current_module == 'Clients')
		{
			$status = $this->sendMail(null,null,$record_id,'Lead Qualified','Qualified_Client');
		}
		/*$assignedData['mainheading'] = $current_module == 'Leads' ? 'Lead  Qualified' : 'Client  Qualified';
		$assignedData['heading'] = $current_module == 'Leads' ? 'A lead is Qualified.' : 'A client is Qualified.';
		$emailTemplate = $this->load->view('emails/reassignedLead2',$assignedData,true);	
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
		
		}*/
	}
	if($message && $data['module_name']=='Leads'){
			$this->session->set_flashdata('success','The record has been saved successfully.');
			redirect(base_url().'modules/viewRecord/?cm=Leads&id='.$data['record_id'].'&record_status=3');
	}
	elseif($message && $data['module_name']=='Clients'){
		$this->session->set_flashdata('success','The record has been saved successfully.');
		redirect(base_url().'modules/viewRecord/?cm=Clients&id='.$data['record_id'].'&record_status=3');
	}
	die;			
	}

	public function reassignedLead()
	{
		$reassignedData = array();
		$status1;
		$this->data["current_module"] = $this->getPost("cm");
		if($this->data["current_module"]=="Leads")
		{
			if ( ($requestMethod = strtolower($this->input->method())) == 'get')
			{
				if($this->input->get("ac") == 'opener')
				{
				  $record = array('value' => 'REASSIGNED TO OPENER');
				  $user_id = $this->input->get("opener_id");
				  $status1 = 'Reassigned to opener';
		
				}elseif($this->input->get("ac") == 'closer')
				{
				  $record = array('value' => 'REASSIGNED TO CLOSER');
				  $user_id = $this->input->get("closer_id");
				  $status1 = 'Reassigned to closer';

				}
				$record_meta_id = 6;
				$subject = 'Lead Reassigned ';
				$heading =  'A lead is Reassigned to you.';
				$record_id = $this->getPost('id');
				$slug_name = 'lead_reassigned';

				$this->db->where('record_id', $record_id);
				$this->db->where('record_meta_id', $record_meta_id);
				$updateLead =$this->db->update('anb_crm_record_meta_value', $record);

				if($updateLead){
					$this->db->where('id', $record_id);
					$updateUser =$this->db->update('anb_crm_record', array('assigned_officer_id'=>$user_id));			
				}

				if($updateLead && $updateUser){
					$status = $this->sendMail($status1, $subject, $record_id, $heading, $slug_name);
					
				}
				if($status){
					$this->LogsModel->addLogs('Reassigned', $status1, $record_id, 'Leads', $_SESSION['user_id']);;
					$updatetime = $this->db->set('modified_time', $modified_time)
												   ->where('id', $record_id)
												   ->update('anb_crm_record');
					 
					$this->session->set_flashdata('success',"Lead Reassigned successfully and Lead Sent to $status");
					redirect(base_url().'modules/viewRecord/?cm=Leads&id='.$record_id.'&record_status=3');	
				  }
				  else
				  {
					 $this->session->set_flashdata('danger',"Lead Reassigned Error.");
				  }
				  die();
			}
		}
   }
   public function getServiceTypeByClientId()
   {
   		if($this->input->post())
   		{
   			$data = array();
   			$data['status'] = false;
   			$client_id = $this->input->post('client_id');
   			$data['result'] = $this->App_model->getData('anb_crm_record_meta_value','*', array('record_id'=> $client_id, 'record_meta_id' => '90'));
   			if(isset($data['result']) && !empty($data['result']))
   			{
   				$data['status'] = true;
   			}
   			echo json_encode($data); die();
   		}
   }
   public function getServiceType()
   {
   		$data = array();
   		$data['status'] = false;
   		$data['result'] = $this->App_model->getData('anb_crm_record_meta','name, option_value',array('id' => '9'));
   		if(isset($data['result']) && !empty($data['result']))
   		{
   			$data['status'] = true;
   			echo json_encode($data); die();
   		}
   }
   public function getServicesByRecordId()
   {
   		if($this->input->post())
   		{
   			$record_id = $this->input->post('record_id');
   			if(isset($record_id) && !empty($record_id))
   			{
   				$data = array();
   				$data['status'] = false;
   				$data['result'] = $this->App_model->getData('anb_crm_record_meta_value','*',array('record_id' => $record_id, 'record_meta_id' => '9'));
   				if(isset($data['result']) && !empty($data['result']))
   				{
   					$data['status'] = true;
   					echo json_encode($data); die();
   				}
   			}
   		}
   }

   	public function sendMail($action = null, $subject = null, $record_id = null, $heading = null, $slug_name = null){
		$module_name = $this->getPost('cm');
		$send_email = false;
		if($module_name == 'Leads')
		{
			if($action == 'convert')
			{
				$record_data = $this->ModuleModel->loadRecord1(null, $record_id);	
			}
			else{
				$record_data = $this->ModuleModel->loadRecord(null, $record_id);
			}

			if($record_data['__6'] == 'ASSIGNED TO OPENER' || $record_data['__6'] == 'REASSIGNED TO OPENER'){
				$user_id = $record_data['__22'];
			}

			if($record_data['__6'] == 'ASSIGNED TO CLOSER' || $record_data['__6'] == 'REASSIGNED TO CLOSER'){
				$user_id = $record_data['__21'];
			}
			$openerCloserName = $this->App_model->getData('anb_crm_users_personal_info', array('first_name', 'last_name'), array('user_id'=>$user_id));
			$assigned_officer_id = $record_data['__0'];
			$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
			$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
			$toEmail = $this->App_model->getData('anb_crm_users',array('email'),array('id'=> $user_id));
			$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', $slug_name);
			if(!empty($template_data) && !empty($openerCloserName) && isset($openerCloserName))
			{
				$send_email = true;
				$subject = $template_data['title'];
				$content = $template_data['template'];
				preg_match_all("/\[[^\]]*\]/", $content, $matches);
				$shortcodes = $matches[0];
				$replaceArray = array(
					$openerCloserName[0]['first_name'] .' '.$openerCloserName[0]['last_name'],
					isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
					date('Y-m-d'),
					isset($record_data['__31']) ? $record_data['__31'] : "No Company Name Available",
					isset($record_data['__41']) ? $record_data['__41'] : "No Parent Company Name Available",
					isset($record_data['__48']) ? $record_data['__48'] : "No Business Name Available",
					isset($record_data['__77']) ? $record_data['__77'] : "Primary NAICS description Not Available",
					isset($record_data['__80']) ? $record_data['__80'] : "Estimated Sales Not Available",
					isset($record_data['__1']) ? $record_data['__2'] : "Not Available",
					isset($record_data['__3']) ? $record_data['__3'] : "Company Name Not Available",
					isset($record_data['__32']) ? $record_data['__32'] : " Number Not Available",
					isset($record_data['__38']) ? $record_data['__38'] : "Address Not Available",
					isset($record_data['__35']) ? $record_data['__35'] : "City Not Available",
					isset($record_data['__40']) ? $record_data['__40'] : "Province Not Available",
					isset($record_data['__37']) ? $record_data['__37'] : "Country Not Available",
					isset($record_data['__36']) ? $record_data['__36'] : "Zip Code Not Available",
					isset($record_data['__34']) ? $record_data['__34'] : "Website Not Available",
					isset($record_data['__4']) ? $record_data['__4'] : " Email Not Available",
					$admin,											
				);
				$final_content = str_replace($shortcodes, $replaceArray, $content);
				/*print_r($final_content);
				die;*/	
				if(!empty($final_content)){
					$edata = array(
					'title'=> $subject,
					'content'=> $final_content,
					);
				}

			}
		}

		if($module_name == 'Clients')
		{
			if(isset($action)){
				$record_data = $this->ModuleModel->loadRecord1(null, $record_id);
					$user_data0 = $this->UserModel->loadUser($record_data['__0']);
					$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
					$admin_email = $user_data0['email'];
					$technical_consultants_data = $this->UserModel->loadUser($record_data['__169']);
					$technical_consultants = $technical_consultants_data['first_name'].' '.$technical_consultants_data['last_name'];
					$accountants_data = $this->UserModel->loadUser($record_data['__170']);
					$accountants = $accountants_data['first_name'].' '.$accountants_data['last_name'];
					$toName = $admin;
					$toEmail[0]['email'] = trim($admin_email);
					$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', $slug_name);
					if(!empty($template_data)){
							$send_email = true;
							$subject = $template_data['title'];
							$content = $template_data['template'];
							preg_match_all("/\[[^\]]*\]/", $content, $matches);
							$shortcodes = $matches[0];

							$replaceArray = array(
							$admin,
							isset($record_data['__200']) ? $record_data['__200'] : "No Client Name Available",
							date('Y-m-d'),
							$admin,
							isset($record_data['__160']) ? $record_data['__160'] : 'No Contract Name Available' ,
							isset($record_data['__165']) ? $record_data['__165'] : '',
							isset($record_data['__200']) ? $record_data['__200'] : "No Client Name Available",
							isset($record_data['__164']) ? $record_data['__164'] : "",
							isset($record_data['__162']) ? $record_data['__162'] : "",
							isset($technical_consultants) ? $technical_consultants : "",
							isset($record_data['__171']) ? $record_data['__171'] : '',
							isset($accountants) ? $accountants : '',
							isset($record_data['__172']) ? $record_data['__172'] : "",
							isset($record_data['__196']) ? $record_data['__196'] : " Description Not Available",
							$admin,											
					);

					$final_content = str_replace($shortcodes, $replaceArray, $content);	
					
					if(!empty($final_content)){
					$edata = array(
						'title'=> $subject,
						'content'=> $final_content,
						);
						}
					}
			}
			else{
				
				$record_data = $this->ModuleModel->loadRecord(null, $record_id);
				$user_id = $record_data['__104'];

				$openerCloserName = $this->App_model->getData('anb_crm_users_personal_info', array('first_name', 'last_name'), array('user_id'=>$user_id));
				$assigned_officer_id = $record_data['__0'];
				$user_data0 = $this->UserModel->loadUser($assigned_officer_id);
				$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
				$toEmail = $this->App_model->getData('anb_crm_users',array('email'),array('id'=> $user_id));
				$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', $slug_name);
			
			if(!empty($template_data))
			{
				$send_email = true;
				$subject = $template_data['title'];
				$content = $template_data['template'];
				preg_match_all("/\[[^\]]*\]/", $content, $matches);
				$shortcodes = $matches[0];
				$replaceArray = array(
					$openerCloserName[0]['first_name'] .' '.$openerCloserName[0]['last_name'],
					isset($record_data['__108']) ? $record_data['__108'] : "No Company Name Available",
					date('Y-m-d'),
					isset($record_data['__108']) ? $record_data['__108'] : "No Company Name Available",
					isset($record_data['__118']) ? $record_data['__118'] : "No Parent Company Name Available",
					isset($record_data['__154']) ? $record_data['__154'] : "Primary NAICS description Not Available",
					isset($record_data['__157']) ? $record_data['__157'] : "Estimated Sales Not Available",
					isset($record_data['__84']) ? $record_data['__84'] : "Not Available",
					isset($record_data['__83']) ? $record_data['__83'] : "Title Not Available",
					isset($record_data['__109']) ? $record_data['__109'] : "Number Not Available",
					isset($record_data['__115']) ? $record_data['__115'] : "Address Not Available",
					isset($record_data['__112']) ? $record_data['__112'] : "City Not Available",
					isset($record_data['__117']) ? $record_data['__117'] : "Province Not Available",
					isset($record_data['__114']) ? $record_data['__114'] : "Country Not Available",
					isset($record_data['__113']) ? $record_data['__113'] : "Zip Code Not Available",
					isset($record_data['__111']) ? $record_data['__111'] : "Website Not Available",
					isset($record_data['__85']) ? $record_data['__85'] : " Email Not Available",
					$admin,											
				);
				$final_content = str_replace($shortcodes, $replaceArray, $content);
				if(!empty($final_content)){
					$edata = array(
					'title'=> $subject,
					'content'=> $final_content,
					);
				}

			}
			}
			
   		}

		if($module_name == 'Contracts'){

			$record_data = $this->ModuleModel->loadRecord1(null, $record_id);
					$user_data0 = $this->UserModel->loadUser($record_data['__0']);
					$admin = $user_data0['first_name'].' '.$user_data0['last_name'];
					$admin_email = $user_data0['email'];
					$technical_consultants_data = $this->UserModel->loadUser($record_data['__169']);
					$technical_consultants = $technical_consultants_data['first_name'].' '.$technical_consultants_data['last_name'];
					$accountants_data = $this->UserModel->loadUser($record_data['__170']);
					$accountants = $accountants_data['first_name'].' '.$accountants_data['last_name'];
					$toName = $admin;
					$toEmail[0]['email'] = trim($admin_email);
					$template_data = $this->EmailtemplatesModel->get_template_by_slug('email', $slug_name);
					if(!empty($template_data)){
							$send_email = true;
							$subject = $template_data['title'];
							$content = $template_data['template'];
							preg_match_all("/\[[^\]]*\]/", $content, $matches);
							$shortcodes = $matches[0];

							$replaceArray = array(
							$admin,
							isset($record_data['__200']) ? $record_data['__200'] : "No Client Name Available",
							date('Y-m-d'),
							$admin,
							isset($record_data['__160']) ? $record_data['__160'] : 'No Contract Name Available' ,
							isset($record_data['__165']) ? $record_data['__165'] : '',
							isset($record_data['__200']) ? $record_data['__200'] : "No Client Name Available",
							isset($record_data['__164']) ? $record_data['__164'] : "",
							isset($record_data['__162']) ? $record_data['__162'] : "",
							isset($technical_consultants) ? $technical_consultants : "",
							isset($record_data['__171']) ? $record_data['__171'] : '',
							isset($accountants) ? $accountants : '',
							isset($record_data['__172']) ? $record_data['__172'] : "",
							isset($record_data['__196']) ? $record_data['__196'] : " Description Not Available",
							$admin,											
					);

					$final_content = str_replace($shortcodes, $replaceArray, $content);	
					
					if(!empty($final_content)){
					$edata = array(
						'title'=> $subject,
						'content'=> $final_content,
						);
						}
					}
		}

		if($send_email == true)
		{
			$emailTemplate = $this->load->view('emails/common',$edata,true);								
			$fromEmail = COMPANY_NOREPLY_EMAIL; 					
			$fromName = COMPANY_NAME;					
	    	$this->ModuleModel->saveEmail($this->getUserId(),$fromEmail,$toEmail[0]['email'],$ccEmail="",$bccEmail="",$subject,$final_content);
			$this->email->from($fromEmail);
			$this->email->to($toEmail[0]['email']);
			$this->email->subject($subject);
			$this->email->message($final_content);
			if($this->email->send()){
				return $toEmail[0]['email'];
			}
			else{
				//echo $toEmail[0]['email'];	
				//print_r(error_get_last()['message']);
/*				echo $this->email->print_debugger();
				die('else');*/
				return $toEmail[0]['email'];
			}
		}
		return true;
	}

	public function getEvents(){
		$recordId = $_POST['record_id'];
		$module = $_POST['module'];
		$created_for = $_POST['created_for'];

		if($module == 'Leads'){
			$record_meta_id = 21;
			$module_id = 1;
		}else{
			$module_id = 2;
			$record_meta_id = 105;
		}
		$join = array(
	    			array(
	    				'table' => 'anb_crm_record b',
	    				'on' => 'a.record_id = b.id',
	    			),
		    	);
		$booking = array();
		$bookings = array();
		$final = array();
		$closerOpenerData = array();
		/*$closerOpener = $this->App_model->getData('anb_crm_record_meta_value a','value',array('record_id'=>$recordId, 'record_meta_id' =>$record_meta_id));

		$records = $this->App_model->getData('anb_crm_record_meta_value a','a.record_id',array('a.value' =>$closerOpener[0]['value'], 'a.record_meta_id'=>$record_meta_id, 'b.module_id'=>$module_id), $join);
		
		foreach ($records as $value) {
			$booking[$value['record_id']] = $this->App_model->getData('anb_crm_bookings','booking_date, end_date, booking_title, id, record_id',array('record_id' =>$value['record_id'],  'all_day'=>0));
				for ($i=0; $i <count($booking[$value['record_id']]); $i++){ 
					$bookings = array(
						'id'=>	$booking[$value['record_id']][$i]['id'],
						'start' => $booking[$value['record_id']][$i]['booking_date'],
						'end' => $booking[$value['record_id']][$i]['end_date'],
						'title' => $booking[$value['record_id']][$i]['booking_title'],
						'record_id' => $booking[$value['record_id']][$i]['record_id'],
						);
					array_push($final, $bookings);
				}
		}*/

		$bookings= $this->App_model->getData('anb_crm_bookings','booking_date, end_date, booking_title, id, record_id',array('created_for' =>$created_for,  'all_day'=>0));
		//print_r($bookings); die("ok");	
		for ($i=0; $i <count($bookings); $i++){ 
					$booking = array(
						'id'=>	$bookings[$i]['id'],
						'start' => $bookings[$i]['booking_date'],
						'end' => $bookings[$i]['end_date'],
						'title' => $bookings[$i]['booking_title'],
						'record_id' => $bookings[$i]['record_id'],
						);
					array_push($final, $booking);
				}
		// echo $user_id;
		// print_r($final);
		echo json_encode(array('events'=>$final));
		die;
	}

	public function getEvents1(){
		$user_id = $_POST['user_id'];
		$current_user_id = $this->getUserId();

		$module = $_POST['module'];

		if($module == 'Leads'){
			$record_meta_id = 21;
			$module_id = 1;
		}else{
			$module_id = 2;
			$record_meta_id = 104;
		}
		$join = array(
	    			array(
	    				'table' => 'anb_crm_record b',
	    				'on' => 'a.record_id = b.id',
	    			),
		    	);
		$booking = array();
		$bookings = array();
		$final = array();
		$closerOpenerData = array();
		//$closerOpener = $this->App_model->getData('anb_crm_record_meta_value a','value',array('record_id'=>$recordId, 'record_meta_id' =>$record_meta_id));

		/*$records = $this->App_model->getData('anb_crm_record_meta_value a','a.record_id',array('a.value' =>$user_id, 'a.record_meta_id'=>$record_meta_id, 'b.module_id'=>$module_id), $join);*/

		/*foreach ($records as $value) {
			$booking[$value['record_id']] = $this->App_model->getData('anb_crm_bookings','booking_date, end_date, booking_title, id, record_id',array('record_id' =>$value['record_id'],  'all_day'=>0));
				for ($i=0; $i <count($booking[$value['record_id']]); $i++){ 
					$bookings = array(
						'id'=>	$booking[$value['record_id']][$i]['id'],
						'start' => $booking[$value['record_id']][$i]['booking_date'],
						'end' => $booking[$value['record_id']][$i]['end_date'],
						'title' => $booking[$value['record_id']][$i]['booking_title'],
						'record_id' => $booking[$value['record_id']][$i]['record_id'],
						);
					array_push($final, $bookings);
				}
		}*/

		$bookings= $this->App_model->getData('anb_crm_bookings','booking_date, end_date, booking_title, id, record_id',array('created_for' =>$user_id,  'all_day'=>0));
		//print_r($bookings); die("ok");	
		for ($i=0; $i <count($bookings); $i++){ 
					$booking = array(
						'id'=>	$bookings[$i]['id'],
						'start' => $bookings[$i]['booking_date'],
						'end' => $bookings[$i]['end_date'],
						'title' => $bookings[$i]['booking_title'],
						'record_id' => $bookings[$i]['record_id'],
						);
					array_push($final, $booking);
				}
		// echo $user_id;
		// print_r($final);
		echo json_encode(array('events'=>$final));
		die;
	}
	function get_leads_by_user_id($user_id)
	{
		global $RECORD_STATUS;
		//$user_id = $_POST['user_id'];
		/*$join = array(
                array(
                    "table" => 'anb_crm_record_meta_value mv',
                    "on" => 'mv.record_id = r.id'
                )
            );
		$ret = $this->App_model->getData('anb_crm_record r','mv.*,r.id,r.record_status',array('r.module_id' => 1,'r.record_status' => 3, 'r.created_by' => $user_id, 'mv.record_meta_id'=> 31),$join,'r.id','DESC',500);*/

		$sLimit = "";
        $lenght = 10;
        $str_point = 0;

        $col_sort = array("r.id", "mv.value");

        $where = '';
        $select = array('mv.*,r.id,r.record_status');
        $order_by = "r.id";
        $temp = 'desc';

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $temp = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
            $order_by = $col_sort[$index];

        }

        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $words = $_GET['sSearch'];
            $where = '( ';
            for ($i = 0; $i < count($col_sort); $i++) {

                $where .= "$col_sort[$i] REGEXP '$words'";

                if ($i + 1 != count($col_sort)) {
                    $where .= " OR ";
                }

            }
            $where .= ') ';
        }
        if ($where != "") {
            $where .= " AND ";
        }
        if(empty($user_id)){
          $where .= "(r.module_id = 1 AND r.record_status = 3 AND mv.record_meta_id = 31 )";
        }else{
          $where .= "(r.module_id = 1 AND r.record_status = 3 AND r.assigned_officer_id = $user_id AND mv.record_meta_id = 31 )";
        }

        $this->db->order_by($order_by, $temp);
        //$this->db->group_by('id');
        $this->db->where($where);
       	$this->db->join('anb_crm_record_meta_value mv','mv.record_id = r.id');

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $str_point = intval($_GET['iDisplayStart']);
            $lenght = intval($_GET['iDisplayLength']);
            $records = $this->db->from('anb_crm_record r')
            		->select('mv.*,r.id,r.record_status')
                    ->limit($lenght, $str_point)
                    ->get();
        } else {
            $records = $this->db->from('anb_crm_record r')
            				->select('mv.*,r.id,r.record_status')
                    ->get();
        }

        $total_record = $this->db->select('mv.*,r.id,r.record_status')
                ->from('anb_crm_record r')
                ->where($where)
                ->join('anb_crm_record_meta_value mv','mv.record_id = r.id')
                ->count_all_results();

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" => $total_record,
            "iTotalDisplayRecords" => $total_record,
            "aaData" => array()
        );

        $result = $records->result_array();

        /*print_r($result); die("ok");
*/      $i=1;
		foreach ($result as $key => $value) {
			//print_r($value); die("cool");
			$output['aaData'][] = array($i,'<a href="'. base_url() .'/modules/viewRecord/?cm=Leads&id='. $value["record_id"] .'&record_status='. $value["record_status"].'">'. $value["value"] .'</a>');	
          $i++;   
		}
         
        echo json_encode($output);
        die;
		
	}

	function get_last_updated_leads(){

	    $limit=$_GET['iDisplayLength'];
	    $offset=$_GET['iDisplayStart'];
	    
	    $order_by='DESC';

	    if(isset($_GET['sSortDir_0'])){
          $order_by=$_GET['sSortDir_0'];
	    }
	    
	    $search='';

	    if(isset($_GET['sSearch'])){
          $search=$_GET['sSearch'];
	    }
	    

        $records=array();
        $results=array();  

        $records=$this->ModuleModel->get_latest_leads($limit,$offset,$order_by);   
        
        foreach($records as $lead){
            
          $leads_data=$this->ModuleModel->get_leads_data($lead['record_id'],$lead['module_id'],$search);
                 
          foreach ($leads_data as $key => $value) {
            	$lead["$value->name"]=$value->value;
            	$lead['record_status']=$value->record_status;
          } 
          
          $results[]=$lead;
        }

        $total_record=count($results); 

        $index=0;    

        if (isset($_GET['iSortCol_0'])) {
            $index = $_GET['iSortCol_0'];
            $order_by = $_GET['sSortDir_0'] === 'asc' ? 'asc' : 'desc';
        } 
        
        $cols=['Company Name','Company Website','activity_user','date'];

        $row_data=array();  

        if(!empty($results)){

         if($order_by=='asc') 
            $results = $this->array_msort($results, array($cols[$index]=>SORT_ASC));
         else
            $results = $this->array_msort($results, array($cols[$index]=>SORT_DESC));

            foreach ($results as $key => $value) {

	        	if(!isset($value['Company Name'])){

	        	    unset($results[$key]);	

	        	}else{

                
                $row_data[] = array('<a href="'. base_url() .'/modules/viewRecord/?cm=Leads&id='. $value["record_id"] .'&record_status='. $value["record_status"].'">'. $value["Company Name"] .'</a>'
					,
					'<a href="'. base_url() .'/modules/viewRecord/?cm=Leads&id='. $value["record_id"] .'&record_status='. $value["record_status"].'">'. $value["Company Website"] .'</a>',
					'<a href="'. base_url() .'/modules/viewRecord/?cm=Leads&id='. $value["record_id"] .'&record_status='. $value["record_status"].'">'. $value["activity_user"] .'</a>'
					,'<a href="'. base_url() .'/modules/viewRecord/?cm=Leads&id='. $value["record_id"] .'&record_status='. $value["record_status"].'">'. $value["date"] .'</a>');	
	        	}
	        }
        }

          
        $total_record=$this->ModuleModel->total_last_updated_lead_record();

        $output = array(
            "sEcho" => 0,
            "iTotalRecords" =>$total_record,
            "iTotalDisplayRecords" =>$total_record,
            "aaData" => $row_data
        );
        
        echo json_encode($output);die();
	}

	function array_msort($array, $cols)
	{
	    $colarr = array();
	    foreach ($cols as $col => $order) {
	        $colarr[$col] = array();
	        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
	    }
	    $eval = 'array_multisort(';
	    foreach ($cols as $col => $order) {
	        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
	    }
	    $eval = substr($eval,0,-1).');';
	    eval($eval);
	    $ret = array();
	    foreach ($colarr as $col => $arr) {
	        foreach ($arr as $k => $v) {
	            $k = substr($k,1);
	            if (!isset($ret[$k])) $ret[$k] = $array[$k];
	            $ret[$k][$col] = $array[$k][$col];
	        }
	    }
	    return $ret;

	}

}


	