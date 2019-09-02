<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoopType extends CI_Controller
{

	var $cname = 'Management/CoopType';

	public function __construct()
	{
		parent::__construct();
		must_login();
		$this->load->model(['CoopType_model']);
	}
	public function index()
	{
		$data = [
			'cname' => $this->cname,
			'header' => 'Management CoopType',
			'description' => null,
			'breadcrumb' => [
				[
					'text' => 'Management',
					'icon' => 'fa fa-gears',
					'target' => null,
					'is_active' => true
				],
				[
					'text' => 'CoopType',
					'icon' => 'fa fa-user',
					'target' => base_url('Management/CoopType'),
					'is_active' => false
				]
			],
			'pages' => 'management/cooptype/index',
			'script' => 'pages/management/cooptype/script'
		];
		$this->load->view('layouts/default', $data);
	}
	public function create()
	{
		$data = [
			'cname' => $this->cname
		];
		$this->load->view('pages/management/cooptype/create', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$data = [
			'cname' => $this->cname,
			'user' => $this->CoopType_model->get_by_id($id)
		];
		$this->load->view('pages/management/cooptype/update', $data);
	}

	public function get_data()
	{
		$data['data'] = $this->CoopType_model->get();
		echo json_encode($data);
	}

	public function action_create()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('max_length', '%s tidak boleh melebihi %s karakter');

		$this->form_validation->set_rules($field = "name", 'Nama', "trim|required|max_length[32]");


		if ($this->form_validation->run() == true) {
			$set_data = [
				'name' => $this->input->post('name')
			];
			$this->CoopType_model->create($set_data);
			echo json_encode([
				'code' => 0,
				'title' => 'Create',
				'message' => 'Create Success',
				'type' => 'success'
			]);
		} else {
			echo json_encode([
				'code' => 1,
				'array_error' => $this->form_validation->error_array()
			]);
		}
	}

	public function action_update()
	{
		$id = $this->input->post('id');
		$user = $this->CoopType_model->get_by_id($id);

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('max_length', '%s tidak boleh melebihi %s karakter');
		$this->form_validation->set_message('is_unique', '%s sudah ada');

		$this->form_validation->set_rules($field = "name", 'Nama', "trim|required|is_unique[tb_coop_type.name]|max_length[32]");
		

		if ($this->form_validation->run() == true) {
			$set_data = [
				'name' => $this->input->post('name')
			];
			$this->CoopType_model->update($id,$set_data);
			echo json_encode([
				'code' => 0,
				'title' => 'Update',
				'message' => 'Update Success',
				'type' => 'success'
			]);
		} else {
			echo json_encode([
				'code' => 1,
				'array_error' => $this->form_validation->error_array()
			]);
		}
	}

	public function action_delete()
	{
		$id = $this->input->post('id');
		$delete = $this->CoopType_model->delete($id);
		if ($delete['code'] == 0) {
			echo json_encode([
				'type' => 'success',
				'message' => 'Delete success ',
				'title' => 'Delete'
			]);
		} else if ($delete['code'] == 1452) {
			echo json_encode([
				'type' => 'warning',
				'message' => 'Message : ' . $delete['message'],
				'title' => 'Delete'
			]);
		}
	}
}
