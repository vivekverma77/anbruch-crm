<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Base.php';

class ZoomMentor extends Base
{
	public function __construct()
	{
		parent::__construct();
		$this->redirectPublicUser();
	}
	public function index()
	{
		$this->load->view("zoom_mentor/zoom_mentor");
	}
	public function view()
	{
		$this->load->view("zoom_mentor/zoom_mentor_view");

	}
}
