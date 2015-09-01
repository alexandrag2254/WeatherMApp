<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$this->nav();
		
		$this->load->view('main/inc/header_view');
		$this->load->view('main/main_view');
		$this->load->view('main/inc/footer_view');
	}
	public function nav()
	{
		$this->load->view('dashboard/inc/header_view');
		$this->load->view('dashboard/dashboard_view');
		$this->load->view('dashboard/inc/footer_view');
	}
}

//end of main controller