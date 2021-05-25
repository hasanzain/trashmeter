<?php
defined('BASEPATH') or exit('No direct script allowed');
date_default_timezone_set("Asia/Jakarta");

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class data_sensor extends REST_Controller
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
        $lokasi = $this->get('lokasi');

        if ($limit != '') {
            $this->db->limit($limit);
        }
        if ($order != '') {
            $this->db->order_by('id', $order);
        }
        if ($lokasi != '') {
            $this->db->where('lokasi', $lokasi);
        }

        if ($id == '') {
            $data_sensor = $this->db->get('data_sensor')->result();
        } else {
            $this->db->where('id', $id);
            $data_sensor = $this->db->get('data_sensor')->result();
        }

        $this->response($data_sensor, 200);
    }

    function index_post()
    {
        $data = array(
            'lokasi'    =>   $this->post('lokasi'),
            'suhu' => $this->post('suhu'),
            'arus' => $this->post('arus'),
            'tegangan' => $this->post('tegangan'),
            'daya' => $this->post('daya'),
            'tanggal' => date("Y-m-d"),
            'jam' => date("h:i:sa"),
        );
        $insert = $this->db->insert('data_sensor', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id');
        $suhu = $this->put('suhu');
        $arus = $this->put('arus');
        $tegangan = $this->put('tegangan');
        $daya = $this->put('daya');

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
        $update = $this->db->update('data_sensor', $data);

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
            $delete = $this->db->empty_table('data_sensor');
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