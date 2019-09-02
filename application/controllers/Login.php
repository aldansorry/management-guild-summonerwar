<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
    }
	public function index()
	{
		$data = [
			
        ];
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username',"Username",'trim|required|callback_checkusername');
        $this->form_validation->set_rules('password',"Password",'trim|required|callback_authentication');

        $this->form_validation->set_message('required', '{field} harus diisi');
        $this->form_validation->set_error_delimiters('','');

		if($this->form_validation->run() == false){
            $this->load->view('layouts/login',$data);
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user_data = $this->Login_model->get_user_data($username,$password);
            $acl = $this->Login_model->get_acl($user_data->id);
            $sess_data = [
                'is_login' => true,
                'lg_id' => $user_data->id,
                'lg_username' => $user_data->username,
                'lg_acl' => $acl
            ];
            $this->session->set_userdata($sess_data);
            
            $is_active = $this->Login_model->is_active_user_exist();
            if($is_active){
                $this->Login_model->set_session_id();
                redirect('Dashboard');
            }else{
                $this->session->set_flashdata('login_message','Userdata sedang digunakan');
                redirect('Login');  
            }
        }
    }
    
    public function checkusername($username)
    {
        $checkusername = $this->Login_model->check_username($username);
        if($checkusername){
            return true;
        }else{
            $this->form_validation->set_message('checkusername','Username belum terdaftar');
            return false;
        }
    }

    public function authentication($password)
    {
        $username = $this->input->post('username');

        if(form_error('username') != null){
            return true;
        }

        $authentication = $this->Login_model->authentication($username,$password);
        if($authentication){
            return true;
        }else{
            $this->form_validation->set_message('authentication','Password salah');
            return false;
        }
    }


    public function logout()
    {
        $this->Login_model->ci_logout();
        $this->session->unset_userdata([
            'is_login',
            'lg_id',
            'lg_username'
        ]);
        $this->session->set_flashdata('login_message',$this->session->flashdata('login_message'));
        redirect('Login');
    }
}
