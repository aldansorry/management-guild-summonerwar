<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('is_login'))
{
	function is_login()
	{
		$CI =& get_instance();
		$is_login = $CI->session->userdata('is_login');

		if ($is_login) {
			return true;
		}else{
			return false;
		}
	}   
}

if ( ! function_exists('must_login'))
{
	function must_login()
	{
		$CI =& get_instance();
		$CI->load->model("Login_model");
		$is_login = $CI->session->userdata('is_login');

		if (!$is_login) {
            $CI->session->set_flashdata('login_message',"Harus login terlebih dahulu");
			redirect('Login/');
        }
        
        $refresh = $CI->Login_model->refresh_login();

		if (!$refresh) {
            $CI->session->set_flashdata('login_message',"Username dan password telah digunakan oleh orang lain");
			redirect('Logout');
		}
	}   
}

if ( ! function_exists('is_allow'))
{
	function is_allow($array_access)
	{
		$CI =& get_instance();
		$acl = $CI->session->userdata('lg_acl');

		$list_bool = array();
		foreach ($array_access as $key => $value) {
			if(array_key_exists($value,$acl)){
				array_push($list_bool, ($acl[$value] == '1' ? true : false));
			}
		}
		if(in_array(true, $list_bool)){
			return true;
		}else{
			redirect('error403');
		}	
	}   
}


if ( ! function_exists('is_display'))
{
	function is_display($array_access)
	{
		$CI =& get_instance();
		$acl = $CI->session->userdata('lg_acl');

		$list_bool = array();
		foreach ($array_access as $key => $value) {
			if(array_key_exists($value,$acl)){
				array_push($list_bool, ($acl[$value] == '1' ? true : false));
			}
		}
		if(in_array(true, $list_bool)){
			return true;
		}
		return false;	
	}   
}

?>