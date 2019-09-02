<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    
    var $tb_user = 'tb_user';
    var $_user_ci = '_user_ci';
    
    public function create($set_data)
    {
        $insert = $this->db
        ->insert($this->tb_user,$set_data);
        if($insert){
            $insert_id = $this->db->insert_id();
            $set_ci = [
                'fk_user' => $insert_id,
            ];
            $this->db
            ->insert($this->_user_ci,$set_ci);
        }
    }

    public function get()
    {
        return $this->db
        ->get($this->tb_user)
        ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
        ->where('id',$id)
        ->get($this->tb_user)
        ->row(0);
    }

    public function update($id,$set_data)
    {
        $update = $this->db
        ->where('id',$id)
        ->update($this->tb_user,$set_data);
        return $update;
    }
    public function delete($id)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        if(is_array($id)){
            $this->db->where_in('id',$id);
        }else{
            $this->db->where('id',$id);
        }
        $this->db->delete($this->tb_user);
        $error = $this->db->error();

        $this->db->db_debug = $db_debug;

        return $error;
    }
}
