<?php
defined('BASEPATH') or exit('No direct script allowed');
date_default_timezone_set("Asia/Jakarta");

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class line_st extends REST_Controller
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
        $customer = $this->get('customer');
        $lokasi = $this->get('lokasi');

        if ($limit != '') {
            $this->db->limit($limit);
        }
        if ($order != '') {
            $this->db->order_by('id', $order);
        }
        if ($customer != '') {
            $this->db->where('customer', $customer);
        }
        if ($lokasi != '') {
            $this->db->where('lokasi', $lokasi);
        }

        if ($id == '') {
            $line_st = $this->db->get('line_st')->result();
        } else {
            $this->db->where('id', $id);
            $line_st = $this->db->get('line_st')->result();
        }

        $this->response($line_st, 200);
    }

    function index_post()
    {
        $data = array(
            'lokasi'    =>   $this->post('lokasi'),
            'customer' => $this->post('customer'),
            'tegangan' => $this->post('tegangan'),
            'arus' => $this->post('arus'),
            'daya' => $this->post('daya'),
            'frekuensi' => $this->post('frekuensi'),
            'tanggal' => date("Y-m-d"),
            'waktu' => date("h:i:sa"),
        );
        $insert = $this->db->insert('line_st', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'tegangan' => $this->post('tegangan'),
            'arus' => $this->post('arus'),
            'daya' => $this->post('daya'),
            'frekuensi' => $this->post('frekuensi'),
            'tanggal' => date("Y-m-d"),
            'waktu' => date("h:i:sa"),
        );

        $this->db->where('id', $id);
        $update = $this->db->update('line_st', $data);

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
            $delete = $this->db->empty_table('line_st');
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