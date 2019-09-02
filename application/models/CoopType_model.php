<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CoopType_model extends CI_Model
{
    var $tb_coop_type = 'tb_coop_type';

    public function create($set_data)
    {
        $insert = $this->db
        ->insert($this->tb_coop_type,$set_data);
        return $insert;
    }

    public function get()
    {
        return $this->db
        ->get($this->tb_coop_type)
        ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
        ->where('id',$id)
        ->get($this->tb_coop_type)
        ->row(0);
    }

    public function update($id,$set_data)
    {
        $update = $this->db
        ->where('id',$id)
        ->update($this->tb_coop_type,$set_data);
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
        $this->db->delete($this->tb_coop_type);
        $error = $this->db->error();

        $this->db->db_debug = $db_debug;

        return $error;
    }
    
    
}
