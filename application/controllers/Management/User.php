<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	var $cname = 'Management/User';

	public function __construct()
	{
		parent::__construct();
		must_login();
		is_allow(['crud_user']);
		$this->load->model(['User_model']);
	}
	public function index()
	{
		$data = [
			'cname' => $this->cname,
			'header' => 'Management User',
			'description' => null,
			'breadcrumb' => [
				[
					'text' => 'Management',
					'icon' => 'fa fa-gears',
					'target' => null,
					'is_active' => true
				],
				[
					'text' => 'User',
					'icon' => 'fa fa-user',
					'target' => base_url('Management/User'),
					'is_active' => false
				]
			],
			'pages' => 'management/user/index',
			'script' => 'pages/management/user/script'
		];
		$this->load->view('layouts/default', $data);
	}
	public function create()
	{
		$data = [
			'cname' => $this->cname
		];
		$this->load->view('pages/management/user/create', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$data = [
			'cname' => $this->cname,
			'user' => $this->User_model->get_by_id($id)
		];
		$this->load->view('pages/management/user/update', $data);
	}

	public function get_data()
	{
		$data['data'] = $this->User_model->get();
		echo json_encode($data);
	}

	public function action_create()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('matches', '{field} tidak sama');
		$this->form_validation->set_message('max_length', '%s tidak boleh melebihi %s karakter');
		$this->form_validation->set_message('is_unique', '%s sudah ada');

		$this->form_validation->set_rules($field = "name", 'Nama', "trim|required|max_length[32]");
		$this->form_validation->set_rules($field = "address", 'Alamat', "trim|required|max_length[64]");
		$this->form_validation->set_rules($field = "phone", 'Telepon', "trim|required|max_length[16]");
		$this->form_validation->set_rules($field = "email", 'Email', "trim|required|max_length[64]|is_unique[tb_user.email]");
		$this->form_validation->set_rules($field = "username", 'Username', "trim|required|max_length[16]|is_unique[tb_user.username]");
		$this->form_validation->set_rules($field = "password", 'Kata Sandi', "trim|required|max_length[32]|matches[repassword]");
		$this->form_validation->set_rules($field = "repassword", 'Kata Sandi ulang', "trim|required|max_length[32]");


		if ($this->form_validation->run() == true) {
			$set_data = [
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			];
			$this->User_model->create($set_data);
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
		$user = $this->User_model->get_by_id($id);

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('matches', '{field} tidak sama');
		$this->form_validation->set_message('max_length', '%s tidak boleh melebihi %s karakter');
		$this->form_validation->set_message('is_unique', '%s sudah ada');

		$this->form_validation->set_rules($field = "name", 'Nama', "trim|required|max_length[32]");
		$this->form_validation->set_rules($field = "address", 'Alamat', "trim|required|max_length[64]");
		$this->form_validation->set_rules($field = "phone", 'Telepon', "trim|required|max_length[16]");
		$this->form_validation->set_rules($field = "email", 'Email', "trim|required|max_length[64]".($this->input->post('email') != $user->email ? '|is_unique[tb_user.email]' : ''));
		$this->form_validation->set_rules($field = "username", 'Username', "trim|required|max_length[16]".($this->input->post('username') != $user->username ? '|is_unique[tb_user.username]' : ''));
		

		if ($this->form_validation->run() == true) {
			$set_data = [
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username')
			];
			$this->User_model->update($id,$set_data);
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
		$delete = $this->User_model->delete($id);
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
