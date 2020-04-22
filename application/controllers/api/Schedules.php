<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Schedules extends REST_Controller {

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
        $id_dosen = $this->get('id_dosen');
        // $temp = $this->M_Schedules->get($id_dosen);
        // $result = array();
        // $idx = 1;
        // foreach($temp as $rows) {
        //     $time = $this->M_Schedules->get_gorup_days($idx);
        //     $result = array_merge($result, array($idx => $time));
        //     $idx++;
        // };
        // $this->response($result,REST_Controller::HTTP_OK);
        $result = array();
        for($i=1; $i<=5; $i++) {
            $time = $this->M_Schedules->get_gorup_days($i,$id_dosen);
            $result = array_merge($result, array($time));
        };
        $this->response($result,REST_Controller::HTTP_OK);
    }

    public function index_put() {
        if($this->session->userdata('id')) {
            $id = $this->put('id');
            $availability = $this->put('availability');
            $datas = array();
            if(!isset($id)) {
                $this->response(
                    array(
                        'status' => FALSE,
                        'message' => $this::REQUIRED_PARAMETER_MESSAGE." id"
                    ),
                    REST_Controller::HTTP_BAD_REQUEST
                );
                return;
            }
            $datas = array_merge($datas, array('id' => $id));
            if(isset($availability)){
                $datas = array_merge($datas, array('availability' => $availability));
            }
            if($this->M_Schedules->update($datas,$id)) {
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

}
