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
        if($this->session->userdata('id')) {
            $nomor = $this->post('nomor');
            $nama = $this->post('nama');
            $email = $this->post('email');
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
            if(!isset($email)) {
                $this->response(
                    array(
                        'status' => FALSE,
                        'message' => $this::REQUIRED_PARAMETER_MESSAGE."email"
                    ), REST_Controller::HTTP_BAD_REQUEST
                );
                return;
            }
            if($this->M_Dosen->get_by_nomor($nomor)->num_rows() == 0) {
                if($id_dosen = $this->M_Dosen->insert($nomor,$nama,$email,$password)) {
                    if($this->M_Schedules->insert($id_dosen)) {
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

    public function index_put() {
        if($this->session->userdata('id')) {
            $id = $this->put('id');
            $password = $this->put('password');
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
            if(isset($password)){
                $password = hash('sha512', $password . config_item('encryption_key'));
                $datas = array_merge($datas, array('password' => $password));
            }
            if(isset($email)){
                $datas = array_merge($datas, array('email' => $email));
            }
            if($this->M_Dosen->update($id,$datas)) {
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