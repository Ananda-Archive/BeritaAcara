<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class User_Login extends REST_Controller {

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
        $nama = $this->post('nama');
        $nomor = $this->post('nomor');
        $password = hash('sha512', $this->post('password') . config_item('encryption_key'));
        $judul = $this->post('judul');
        $id_dosen_pembimbing = $this->post('id_dosen_pembimbing');
        if(!isset($nama)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."nama"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if(!isset($nomor)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."nomor"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if(!isset($password)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."password"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if(!isset($judul)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."judul"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if(!isset($id_dosen_pembimbing)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE."id_dosen_pembimbing"
                ), REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if($this->M_User->user_exist($nomor)->num_rows() > 0) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => 'User is Exists'
                ), REST_Controller::HTTP_UNAUTHORIZED
            );
        } else {
            if($this->M_User->register($nama, $nomor, $password, $judul, $id_dosen_pembimbing)) {
                $this->response(
                    array(
                        'status' => TRUE,
                        'message' => 'Pendaftaran Berhasil, Silahkan menunggu konfirmasi dari Admin'
                    ),
                    REST_Controller::HTTP_CREATED
                );
            } else {
                $this->response(
                    array(
                        'status' => FALSE,
                        'message' => 'Pendaftaran Gagal'
                    ),
                    REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                );
            }
        }
    }

    public function index_get(){
        if(!$this->session->userdata('id')) {
            $nomor = $this->get('nomor');
            $password = hash('sha512', $this->get('password') . config_item('encryption_key'));
            // Kalo Nomor tidak terdaftar
            if(!isset($nomor)) {
                $this->response(
                    array(
                        'status' => FALSE,
                        'message' => $this::REQUIRED_PARAMETER_MESSAGE."nomor"
                    ), REST_Controller::HTTP_BAD_REQUEST
                );
                return;
            }
            // Kalo password salah
            if(!isset($password)) {
                $this->response(
                    array(
                        'status' => FALSE,
                        'message' => $this::REQUIRED_PARAMETER_MESSAGE."password"
                    ), REST_Controller::HTTP_BAD_REQUEST
                );
                return;
            }
            // Kalo berhasil login
            if($this->M_User->login($nomor,$password) ->num_rows() > 0) {
                // Kalo udah di verify sama admin
                if($this->M_User->is_verified($nomor,$password) ->num_rows() > 0) {
                    $date = $this->M_Admin->getDate()->row_array();
                    $data = $this->M_User->login($nomor,$password)->row_array();
                    $data_session = array(
                        'id' => $data['id'],
                        'nama' => $data['nama'],
                        'nomor' => $data['nomor'],
                        'role' => 0,
                        'start' => $date['tanggal_mulai'],
                        'end' => $date['tanggal_berakhir']
                    );
                    $this->session->set_userdata($data_session);
                    $this->response(
                        array(
                            'status' => TRUE,
                            'message' => $this::LOGIN_SUCCESS_MESSAGE
                        ), REST_Controller::HTTP_CREATED
                    );
                } else { // Kalo belum di verify sama admin
                    $this->response(
                        array(
                            'status' => FALSE,
                            'message' => 'User belum diverifikasi oleh admin'
                        ), REST_Controller::HTTP_UNAUTHORIZED
                    );
                }
            } else { //CEK DOSEN
                if($this->M_Dosen->login($nomor,$password) ->num_rows() > 0) {
                    $data = $this->M_Dosen->login($nomor,$password)->row_array();
                    $data_session = array(
                        'id' => $data['id'],
                        'nama' => $data['nama'],
                        'nomor' => $data['nomor'],
                        'role' => 1
                    );
                    $this->session->set_userdata($data_session);
                    $this->response(
                        array(
                            'status' => TRUE,
                            'message' => $this::LOGIN_SUCCESS_MESSAGE
                        ), REST_Controller::HTTP_CREATED
                    );
                } else {
                    if($this->M_Admin->login($nomor,$password) ->num_rows() > 0) {
                        $data = $this->M_Admin->login($nomor,$password)->row_array();
                        $data_session = array(
                            'id' => $data['id'],
                            'nama' => 'Admin',
                            'nomor' => $data['nomor'],
                            'role' => 2
                        );
                        $this->session->set_userdata($data_session);
                        $this->response(
                            array(
                                'status' => TRUE,
                                'message' => $this::LOGIN_SUCCESS_MESSAGE
                            ), REST_Controller::HTTP_CREATED
                        );
                    } else {
                        if($this->M_Departemen->login($nomor,$password) ->num_rows() > 0) {
                            $data = $this->M_Departemen->login($nomor,$password)->row_array();
                            $data_session = array(
                                'id' => $data['id'],
                                'nama' => 'Departemen',
                                'role' => 3
                            );
                            $this->session->set_userdata($data_session);
                            $this->response(
                                array(
                                    'status' => TRUE,
                                    'message' => $this::LOGIN_SUCCESS_MESSAGE
                                ), REST_Controller::HTTP_CREATED
                            );
                        } else {
                            if($this->M_User->user_exist($nomor)->num_rows() > 0 || $this->M_Dosen->user_exist($nomor)->num_rows() > 0) {
                                $this->response(
                                    array(
                                        'status' => FALSE,
                                        'message' => $this::INCORRECT_PASSWORD_MESSAGE
                                    ), REST_Controller::HTTP_UNAUTHORIZED
                                );
                            } else {
                                if($this->M_User->user_exist($nomor)->num_rows() == 0 || $this->M_Dosen->user_exist($nomor)->num_rows() == 0) {
                                    $this->response(
                                        array(
                                            'status' => FALSE,
                                            'message' => $this::USER_NOT_FOUND_MESSAGE
                                        ), REST_Controller::HTTP_UNAUTHORIZED
                                    );
                                } else {
                                    $this->response(
                                        array(
                                            'status' => FALSE,
                                            'message' => $this::LOGIN_FAILED_MESSAGE
                                        ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                                    );
                                }
                            }
                        }
                    }
                }
            }
        } else {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::LOGIN_FAILED_MESSAGE
                ), REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
