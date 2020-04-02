<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Time extends REST_Controller {

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


    public function index_get() {
        $result = $this->M_Admin->get();
        $this->response($result,REST_Controller::HTTP_OK);
    }

    public function index_put() {
        $tanggal_mulai = $this->put('tanggal_mulai');
        $tanggal_berakhir = $this->put('tanggal_berakhir');
        $date = array();
        if(isset($tanggal_mulai)){
            $date = array_merge($date, array('tanggal_mulai' => $tanggal_mulai));
        }
        if(isset($tanggal_berakhir)){
            $date = array_merge($date, array('tanggal_berakhir' => $tanggal_berakhir));
        }
        if($this->M_Admin->updateDate($date)) {
            $this->response(
                array(
                    'status' => TRUE,
                    'message' => $this::UPDATE_SUCCESS_MESSSAGE

                ),
                REST_Controller::HTTP_OK
            );
        } else {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::UPDATE_FAILED_MESSAGE
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
        }
    }

}
