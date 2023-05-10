<?php
defined('BASEPATH') or die("No direct script access allowed");
require_once 'Base.php';
class Contacts extends Base
{
	public function __construct()
	{
		parent::__construct();
		$this->redirectPublicUser();
		$this->load->model("App_model");
		$this->load->model("LogsModel");
      	$this->load->model("ContactsModel");
      	$this->load->library('pagination');
 	  	$this->load->library('email');
		//$smtpconfig = $this->config->item('email');
		//$this->email->initialize($smtpconfig);
	
	}
	public function index($rowno = 0)
	{
		$sel= $this->data["sel"] = ($this->getPost("sel") != '') ? $this->getPost("sel") : "";
		$rowperpage = isset($sel) && !empty($sel) ? $sel : 5;
		if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	    $allcount = $this->ContactsModel->getRowCount();

	    $order_by = ($this->getPost("order_by") != '') ? $this->getPost("order_by") : 'form_id';
	    $order = ($this->getPost("order") != '') ? $this->getPost("order") : 'desc';
	    
	    $contact_record = $this->ContactsModel->getContactData($rowno,$rowperpage,$order,$order_by);
	    // Pagination Configuration
	    $config['base_url'] = base_url().'contacts/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $allcount;
	    $config['per_page'] = $rowperpage;
	    $config['reuse_query_string'] = true;
	    $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';

        // Initialize
	    $this->pagination->initialize($config);
	 
	    $this->data['pagination'] = $this->pagination->create_links();
	    $this->data['result_data'] = $contact_record;
	    $this->data['row'] = $rowno;
	    $this->data['total_record'] = $allcount;
	    $this->data['order'] = $order;
	    $this->data['order_by'] = $order_by;

	    $join = array(
			array(
				'table' => 'anb_crm_users_personal_info b',
				'on' => 'a.id = b.user_id',
			),
    	);
	    $this->data['closerOpener'] = $this->App_model->getData('anb_crm_users a', array('b.first_name', 'b.user_id', 'a.role_id', 'b.last_name'),false, $join);
	    
	    $this->viewLoad('contacts/index');
	}

	public function delete()
	{
		if($this->input->post())
		{
			$form_ids = $this->input->post('form_ids');
			if(!empty($form_ids))
			{
				$form_ids = explode(',', $form_ids);
				$status = $this->ContactsModel->deleteContacts($form_ids);
				if($status)
				{
					$this->session->set_flashdata('success', 'Contacts deleted successfully.');
					$result['success'] = true;
					$result['message'] = 'Contacts deleted successfully.';
				}
				else
				{
					$this->session->set_flashdata('error', 'Something went wrong to perform this action.');
					$result['success'] = false;
					$result['message'] = 'Something went wrong to perform this action.';
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Something went wrong to perform this action.');
				$result['success'] = false;
				$result['message'] = 'Something went wrong to perform this action.';
			}
			echo json_encode($result); die();
		}
	}
	public function get()
	{
		if($this->input->post())
		{
			$form_id = $this->input->post('form_id');
			$result = array();
			if(!empty($form_id))
			{
				$contactData = $this->ContactsModel->getContact($form_id);
				if($contactData)
				{
					echo json_encode($contactData); die();
				}
				
			}
		}
	}
	public function addBooking()
	{
		if($this->input->post())
		{
			$postData = $this->input->post();
			//print_r($postData); die("ok");
			if(!empty($postData))
			{
				$status = $this->ContactsModel->convertToBooking($postData);
				if($status)
				{
					$this->session->set_flashdata('success', 'Booking saved successfully.');
					$result['success'] = true;
					$result['message'] = 'Your request submitted successfully';
				}
				else
				{
					$this->session->set_flashdata('error', 'Something went wrong to perform this action');
					$result['success'] = false;
					$result['message'] = 'Something went wrong to perform this action.';
				}
			}
			echo json_encode($result); die();
			
		}
	}
}