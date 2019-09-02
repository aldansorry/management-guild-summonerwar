<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    var $tb_user = 'tb_user';
    var $tb_role = 'tb_role';
    var $_user_role = '_user_role';
    var $_user_ci = '_user_ci';

    public function get_user_data($username, $password)
    {
        $query = $this->db
            ->where('username', $username)
            ->where('password', md5($password))
            ->get($this->tb_user);

        return $query->row(0);
    }
    public function check_username($username)
    {
        $query = $this->db
            ->where('username', $username)
            ->get($this->tb_user);

        return ($query->num_rows() == 1 ? true : false);
    }

    public function authentication($username, $password)
    {
        $query = $this->db
            ->where('username', $username)
            ->where('password', md5($password))
            ->get($this->tb_user);

        return ($query->num_rows() == 1 ? true : false);
    }

    public function set_session_id()
    {
        $lg_id = $this->session->userdata('lg_id');
        $this->db
            ->where('fk_user', $lg_id)
            ->update($this->_user_ci, ['ci_session_id' => session_id(), 'ci_session_ts' => date('Y-m-d H:i:s')]);
    }

    public function refresh_login()
    {
        $lg_id = $this->session->userdata('lg_id');

        $data = $this->db
            ->where('fk_user', $lg_id)
            ->get($this->_user_ci)
            ->row(0);

        $session_id = $data->ci_session_id;

        if ($session_id == session_id()) {
            $this->db
                ->where('fk_user', $lg_id)
                ->update($this->_user_ci, ['ci_session_ts' => date('Y-m-d H:i:s')]);
            return true;
        } else {
            return false;
        }
    }

    public function is_active_user_exist()
    {
        $lg_id = $this->session->userdata('lg_id');
        $data = $this->db
            ->where('fk_user', $lg_id)
            ->get($this->_user_ci)
            ->row(0);

        $ci_session_ts = $data->ci_session_ts;

        $date1 = strtotime(date('Y-m-d H:i:s'));
        $date2 = strtotime($ci_session_ts);
        $diff_in_sec = $date1 - $date2;

        if ($data->ci_session_id == null || $diff_in_sec >= 30) {
            return true;
        } else {
            return false;
        }
    }

    public function get_acl($id)
    {
        return $this->db
        ->select('crud_user')
        ->join('tb_role','_user_role.fk_role=tb_role.id')
        ->where('fk_user',$id)
        ->get('_user_role')
        ->row_array(0);
    }
    public function ci_logout()
    {
        $lg_id = $this->session->userdata('lg_id');
        $this->db
            ->where('fk_user', $lg_id)
            ->update($this->_user_ci, ['ci_session_id' => null]);
    }
}
