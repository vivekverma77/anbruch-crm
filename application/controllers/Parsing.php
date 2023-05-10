<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Parsing extends Base {

    public function __construct(){
        parent::__construct();
        $this->redirectPublicUser();
        $this->load->model("ParsingModel");
    }

    public function index()
	{
        if ($this->data["writePermission"] == false){
            $this->redirectAccessViolatedUser();
        }

        $this->ParsingModel->parse($this->getUserId());
	}
	public function insertNote()
	{
        if ($this->data["writePermission"] == false){
            $this->redirectAccessViolatedUser();
        }

        $this->ParsingModel->insertNotes($this->getUserId());
	}	
}
