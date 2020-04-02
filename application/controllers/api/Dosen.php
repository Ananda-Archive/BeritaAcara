<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Dosen extends REST_Controller {

    function __construct(){
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
        die();
        }
    }

    public function index_post() {
        $nomor = $this->post('nomor');
        $nama = $this->post('nama');
        $password = hash('sha512',$this->post('nomor') . config_item('encryption_key'));
        if(!isset($nomor)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."nomor"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if(!isset($nama)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."nama"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if($this->M_Dosen->get_by_nomor($nomor)->num_rows() == 0) {
            if($this->M_Dosen->insert($nomor,$nama,$password)) {
                $this->response(
                    array(
                        'status' => TRUE,
                        'message' => $this::INSERT_SUCCESS_MESSSAGE
                    ),
                    REST_Controller::HTTP_CREATED
                );
            } else {
                $this->response(
                    array(
                        'status' => FALSE,
                        'message' => $this::INSERT_FAILED_MESSAGE
                    ),
                    REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        } else {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::NUM_FAILED_MESSAGE
                ),
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    
    public function index_get() {
        $id_dosen = $this->get('id_dosen');
        if(isset($id_dosen)) {
            $result = $this->M_User->get_user_where_dosen($id_dosen);
            $idx = 0;
            foreach($result as $row) {
                $berkas = $this->M_Berkas->get_berkas_where_mahasiswa($row['id']);
                $temp = array_merge($result[$idx], array('berkas' => $berkas));
                $result[$idx] = $temp;
                $idx++;
            }$this->response($result,REST_Controller::HTTP_OK);
        } else {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."ID_DOSEN"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
    }

}