<?php
defined('BASEPATH') or exit('No direct script allowed');
date_default_timezone_set("Asia/Jakarta");

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class relay extends REST_Controller
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
            $relay = $this->db->get('relay')->result();
        } else {
            $this->db->where('id', $id);
            $relay = $this->db->get('relay')->result();
        }

        $this->response($relay, 200);
    }

    function index_post()
    {
        $data = array(
            'lokasi'    =>   $this->post('lokasi'),
            'relay_1' => $this->post('relay_1'),
            'relay_2' => $this->post('relay_2'),
            'relay_3' => $this->post('relay_3'),
            'relay_4' => $this->post('relay_4'),
            'relay_5' => $this->post('relay_5'),
            'relay_6' => $this->post('relay_6'),
            'relay_7' => $this->post('relay_7'),
            'relay_8' => $this->post('relay_8'),
        );
        $insert = $this->db->insert('relay', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id');
        $lokasi = $this->put('lokasi');
        $relay_1 = $this->put('relay_1');
        $relay_2 = $this->put('relay_2');
        $relay_3 = $this->put('relay_3');
        $relay_4 = $this->put('relay_4');
        $relay_5 = $this->put('relay_5');
        $relay_6 = $this->put('relay_6');
        $relay_7 = $this->put('relay_7');
        $relay_8 = $this->put('relay_8');

        if ($lokasi != null){
            $data['lokasi'] = $lokasi;
        }
        if ($relay_1 != null){
            $data['relay_1'] = $relay_1;
        }
        if ($relay_2 != null){
            $data['relay_2'] = $relay_2;
        }
        if ($relay_3 != null){
            $data['relay_3'] = $relay_3;
        }
        if ($relay_4 != null){
            $data['relay_4'] = $relay_4;
        }
        if ($relay_5 != null){
            $data['relay_5'] = $relay_5;
        }
        if ($relay_6 != null){
            $data['relay_6'] = $relay_6;
        }
        if ($relay_7 != null){
            $data['relay_7'] = $relay_7;
        }
        if ($relay_8 != null){
            $data['relay_8'] = $relay_8;
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
        $update = $this->db->update('relay', $data);

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
            $delete = $this->db->empty_table('relay');
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