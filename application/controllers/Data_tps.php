<?php
defined('BASEPATH') or exit('No direct script allowed');
date_default_timezone_set("Asia/Jakarta");

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class data_tps extends REST_Controller
{
    /*----------------------------------------CONSTRUCTOR----------------------------------------*/
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    /*----------------------------------------GET KONTAK----------------------------------------*/
    function index_get()
    {
        $id = $this->get('id');
        $limit = $this->get('limit');
        $order = $this->get('order');
        $nomor_tps = $this->get('nomor_tps');
        

        if ($limit != '') {
            $this->db->limit($limit);
        }
        if ($order != '') {
            $this->db->order_by('id', $order);
        }
        if ($nomor_tps != '') {
            $this->db->where('nomor_tps', $nomor_tps);
        }
  

        if ($id == '') {
            $monitoring = $this->db->get('monitoring')->result();
        } else {
            $this->db->where('id', $id);
            $monitoring = $this->db->get('monitoring')->result();
        }

        $this->response($monitoring, 200);
    }

    function index_post()
    {
        $data = array(
            'nomor_tps' => $this->post('nomor_tps'),
            'lokasi'    =>   $this->post('lokasi'),
            'status' => $this->post('status'),
            'value' => $this->post('value'),
            'jam' => date("h:i:sa"),
            'tanggal' => date("Y-m-d"),
        );
        $insert = $this->db->insert('monitoring', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id');
        $nomor_tps = $this->put('nomor_tps');
        $lokasi = $this->put('lokasi');
        $status = $this->put('status');
        $value = $this->put('value');

        if ($suhu != null){
            $data['suhu'] = $suhu;
        }
        if ($arus != null){
            $data['arus'] = $arus;
        }
        if ($tegangan != null){
            $data['tegangan'] = $tegangan;
        }
        if ($daya != null){
            $data['daya'] = $daya;
        }
        // $data = array(
        //     'suhu' => $this->post('suhu'),
        //     'arus' => $this->post('arus'),
        //     'tegangan' => $this->post('tegangan'),
        //     'daya' => $this->post('daya'),
        //     'frekuensi' => $this->post('frekuensi'),
        //     'tanggal' => date("Y-m-d"),
        //     'waktu' => date("h:i:sa"),
        // );

        $this->db->where('id', $id);
        $update = $this->db->update('monitoring', $data);

        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail'), 502);
        }
    }

    function index_delete()
    {
        $id = $this->delete('id');
        $auth = $this->delete('auth');

        
        if ($auth == "batman") {
            $delete = $this->db->empty_table('monitoring');
        }else{
            $this->db->where('id', $id);
            $delete = $this->db->delete('arus_pompa_1');
        }
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail'), 502);
        }
    }
}