<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		must_login();
	}
	public function index()
	{
		$data = [
			'header' => 'Dashboard',
			'description' => null,
			'breadcrumb' => [
				[
					'text' => 'Dashboard',
					'icon' => 'fa fa-dashboard',
					'target' => base_url('Dashboard'),
					'is_active' => false
				],
				[
					'text' => 'Dashboard1',
					'icon' => 'fa fa-check',
					'target' => null,
					'is_active' => true
				]
			],
			'pages' => 'dashboard/dashboard1'
		];
		$this->load->view('layouts/default',$data);
	}
}
