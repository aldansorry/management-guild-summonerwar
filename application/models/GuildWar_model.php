<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuildWar_model extends CI_Model
{
    var $tb_guildwar = 'tb_guildwar';
    var $_guildwar_member = '_guildwar_member';
    var $tb_member = 'tb_member';

    public function create($member)
    {
        $ts = date('Y-m-d H:i:s');
        $set_data = [
            'code' => "WAR",
            'start_ts' => $ts,
            'status' => '1'
        ];
        $insert = $this->db
        ->insert($this->tb_guildwar,$set_data);
        
        if($insert){
            $guildwar_id = $this->db->insert_id();
            foreach($member as $key => $value){
                $set_guildwar_member = [
                    'fk_guildwar' => $guildwar_id,
                    'fk_member' => $value
                ];
                $this->db->insert($this->_guildwar_member,$set_guildwar_member);

                $this->db
                ->where('id',$value)
                ->update($this->tb_member,['last_war' => $ts]);

            }
        }
        
        return $insert;
    }

    public function get()
    {
        return $this->db
        ->select('*,(select count(fk_member) from _guildwar_member where fk_guildwar = tb_guildwar.id) as member_count')
        ->order_by('start_ts','desc')
        ->get($this->tb_guildwar)
        ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
        ->where('id',$id)
        ->get($this->tb_guildwar)
        ->row(0);
    }
    

    public function get_member_list($id_guildwar)
    {
        return $this->db
        ->select('fk_guildwar,fk_member,ign')
        ->join('tb_member','_guildwar_member.fk_member=tb_member.id')
        ->where('fk_guildwar',$id_guildwar)
        ->get($this->_guildwar_member)
        ->result();
    }

    public function set_war_end($fk_guildwar,$state,$member)
    {
        $set_data = [
            'end_ts' => date('Y-m-d H:i:s'),
            'state' => $state,
            'status' => '2'
        ];
        $update = $this->db
        ->where('id',$fk_guildwar)
        ->update($this->tb_guildwar,$set_data);
        
        if($update){
            foreach($member as $key => $value){
                $point = ($value['sword_used'] == 0 ? -1 : $value['sword_used']);
                $set_guildwar_member = [
                    'point' => $point
                ];
                $this->db
                ->where('fk_guildwar',$fk_guildwar)
                ->where('fk_member',$value['fk_member'])
                ->update($this->_guildwar_member,$set_guildwar_member);
            }
        }
        
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
        $this->db->delete($this->tb_guildwar);
        $error = $this->db->error();

        $this->db->db_debug = $db_debug;

        return $error;
    }
    
    public function get_suggestion()
    {
        return $this->db
        ->select('tb_member.id,ign,point')
        ->join('(select * from _guildwar_member _gm where fk_guildwar=(select max(id) from tb_guildwar)) as __guildwar_member','tb_member.id=__guildwar_member.fk_member')
        ->order_by('point','desc')
        ->group_by('tb_member.id')
        ->get($this->tb_member)
        ->result();
    }
}
