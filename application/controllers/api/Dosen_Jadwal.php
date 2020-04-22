<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Dosen_Jadwal extends REST_Controller {

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
        if($this->session->userdata('id')) {
            $id = $this->post('id');
            $file = $this->post('file');

            date_default_timezone_set('Asia/Jakarta');
            $tempfilename = $_FILES['file']['tmp_name'];
            $dir = './assets/jadwal/';
            if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'doc') {
                $filename = $this->session->userdata('nomor') . '-jadwal-' . date('dmY-His') . '.doc';
            } else {
                if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'docx') {
                    $filename = $this->session->userdata('nomor') . '-jadwal-' . date('dmY-His') . '.docx';
                } else {
                    if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'pdf') {
                        $filename = $this->session->userdata('nomor') . '-jadwal-' . date('dmY-His') . '.pdf';
                    }
                }
            }
            if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'pdf' || pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'doc' || pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'docx') {
                if($this->M_Dosen->updateJadwal($id,base_url('assets/jadwal/').$filename)) {
                    $moveToDir = move_uploaded_file($tempfilename, $dir.$filename);
                    $this->response(
                        array(
                            'status' => TRUE,
                            'message' => $this::UPDATE_SUCCESS_MESSSAGE
                        ), REST_Controller::HTTP_OK
                    );
                } else {
                    $this->response(
                        array(
                            'status' => FALSE,
                            'message' => $this::UPDATE_FAILED_MESSAGE
                        ),REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            }
        }
    }

}