<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GuildWar extends CI_Controller
{

    var $cname = 'Main/GuildWar';

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model(['GuildWar_model']);
    }
    public function index()
    {
        $data = [
            'cname' => $this->cname,
            'header' => 'GuildWar',
            'description' => null,
            'breadcrumb' => [
                [
                    'text' => 'Main',
                    'icon' => 'fa fa-gears',
                    'target' => null,
                    'is_active' => true
                ],
                [
                    'text' => 'GuildWar',
                    'icon' => 'fa fa-user',
                    'target' => base_url('Main/GuildWar'),
                    'is_active' => false
                ]
            ],
            'pages' => 'main/guildwar/index',
            'script' => 'pages/main/guildwar/script'
        ];
        $this->load->view('layouts/default', $data);
    }
    public function create()
    {
        $data = [
            'cname' => $this->cname
        ];
        $this->load->view('pages/main/guildwar/create', $data);
    }

    public function memberlist()
    {
        $data = [
            'cname' => $this->cname
        ];
        $this->load->view('pages/main/guildwar/memberlist', $data);
    }

    public function war_end()
    {
        $id = $this->input->post('id');

        $data = [
            'cname' => $this->cname,
            'war_end' => $this->GuildWar_model->get_by_id($id)
        ];
        $this->load->view('pages/main/guildwar/war_end', $data);
    }

    public function get_data()
    {
        $data['data'] = $this->GuildWar_model->get();
        echo json_encode($data);
    }

    public function get_suggestion_member()
    {
        $data['data'] = $this->GuildWar_model->get_suggestion();
        echo json_encode($data);
    }

    public function get_member_list($id)
    {
        $data['data'] = $this->GuildWar_model->get_member_list($id);
        echo json_encode($data);
    }

    public function action_create()
    {
        $select = $this->input->post('select');
        if (count($select) >= 8) {
            $this->GuildWar_model->create($select);
            echo json_encode([
                'code' => 0,
                'title' => 'Create',
                'message' => 'Create Success',
                'type' => 'success'
            ]);
        } else {
            echo json_encode([
                'code' => 1,
                'title' => 'Failed',
                'message' => 'Guildwar must start at least 8',
                'type' => 'warning'
            ]);
        }
    }

    public function action_war_end()
    {
        $fk_guildwar = $this->input->post('fk_guildwar');
        $state = $this->input->post('state');
        $member = $this->input->post('member');
        $this->GuildWar_model->set_war_end($fk_guildwar, $state, $member);
        echo json_encode([
            'code' => 0,
            'title' => 'Create',
            'message' => 'Create Success',
            'type' => 'success'
        ]);
    }

    public function action_delete()
    {
        $id = $this->input->post('id');
        $delete = $this->GuildWar_model->delete($id);
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
