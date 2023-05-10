<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class Restrictions extends Base {

    public function __construct(){
        parent::__construct(0);
    }

    public function index()
	{
	}

    public function accessViolation(){
        $this->viewLoad("errors/noaccess/access_violation");
    }
}
