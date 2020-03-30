<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class BerkasTranskrip extends REST_Controller {

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
        $id_mahasiswa = $this->session->userdata('id');
        // $id_mahasiswa = $this->post('id_mahasiswa');
        if(!isset($_FILES)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."FILE"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        date_default_timezone_set('Asia/Jakarta');
        $filename = $this->session->userdata('nomor') . '-transkrip-' . date('dmY-His') . '.pdf';
        $tempfilename = $_FILES['file']['tmp_name'];
        $dir = './assets/berkas/';
        if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'pdf') {
            if($this->M_Berkas->storeTranskrip($id_mahasiswa, base_url('assets/berkas/').$filename)) {
                $moveToDir = move_uploaded_file($tempfilename, $dir.$filename);
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
                    'message' => 'ONLY ACCEPT PDF FILE TYPE'
                ),
                REST_Controller::HTTP_UNAUTHORIZED
            );
        }
    }

}
