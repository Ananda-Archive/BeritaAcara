<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Berkas extends REST_Controller {

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
            $id_mahasiswa = $this->post('id_mahasiswa');
            $toefl_file = $this->post('toefl_file');
            $toefl_file_verified = $this->post('toefl_file_verified');
            $transkrip_file = $this->post('transkrip_file');
            $transkrip_file_verified = $this->post('transkrip_file_verified');
            $skripsi_file = $this->post('skripsi_file');
            $skripsi_file_verified = $this->post('skripsi_file_verified');
            $bimbingan_file = $this->post('bimbingan_file');
            $bimbingan_file_verified = $this->post('bimbingan_file_verified');
            $which_one = $this->post('which_one');
            $file = $this->post('file');
            date_default_timezone_set('Asia/Jakarta');
            $tempfilename = $_FILES['file']['tmp_name'];
            $dir = './assets/berkas/';
            if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'pdf') {
                if($which_one =='toefl') {
                    if($this->M_Berkas->delete($id)) {
                        $filename = $this->session->userdata('nomor') . '-TOEFL-' . date('dmY-His') . '.pdf';
                        if($this->M_Berkas->storeToefl($id,$id_mahasiswa, base_url('assets/berkas/').$filename, $toefl_file_verified, $transkrip_file, $transkrip_file_verified, $skripsi_file, $skripsi_file_verified, $bimbingan_file, $bimbingan_file_verified)) {
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
                    } else {
                        $this->response(
                            array(
                                'status' => FALSE,
                                'message' => $this::UPDATE_FAILED_MESSAGE
                            ),REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                        );
                    }
                } else {
                    if($which_one == 'transkrip') {
                        if($this->M_Berkas->delete($id)) {
                            $filename = $this->session->userdata('nomor') . '-transkrip-' . date('dmY-His') . '.pdf';
                            if($this->M_Berkas->storeTranskripNew($id,$id_mahasiswa, $toefl_file, $toefl_file_verified, base_url('assets/berkas/').$filename, $transkrip_file_verified, $skripsi_file, $skripsi_file_verified, $bimbingan_file, $bimbingan_file_verified)) {
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
                        } else {
                            $this->response(
                                array(
                                    'status' => FALSE,
                                    'message' => $this::UPDATE_FAILED_MESSAGE
                                ),REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                            );
                        }
                    } else {
                        if($which_one == 'skripsi') {
                            if($this->M_Berkas->delete($id)) {
                                $filename = $this->session->userdata('nomor') . '-skripsi-' . date('dmY-His') . '.pdf';
                                if($this->M_Berkas->storeSkripsi($id,$id_mahasiswa, $toefl_file, $toefl_file_verified, $transkrip_file, $transkrip_file_verified, base_url('assets/berkas/').$filename, $skripsi_file_verified, $bimbingan_file, $bimbingan_file_verified)) {
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
                            } else {
                                $this->response(
                                    array(
                                        'status' => FALSE,
                                        'message' => $this::UPDATE_FAILED_MESSAGE
                                    ),REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                                );
                            }
                        } else {
                            if($which_one == 'bimbingan') {
                                if($this->M_Berkas->delete($id)) {
                                    $filename = $this->session->userdata('nomor') . '-kartubimbingan-' . date('dmY-His') . '.pdf';
                                    if($this->M_Berkas->storeBimbingan($id,$id_mahasiswa, $toefl_file, $toefl_file_verified, $transkrip_file, $transkrip_file_verified, $skripsi_file, $skripsi_file_verified, base_url('assets/berkas/').$filename, $bimbingan_file_verified)) {
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
                                } else {
                                    $this->response(
                                        array(
                                            'status' => FALSE,
                                            'message' => $this::UPDATE_FAILED_MESSAGE
                                        ),REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                                    );
                                }
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

    public function index_get() {
        $id_mahasiswa = $this->get('id_mahasiswa');
        if(isset($id_mahasiswa)) {
            $result = $this->M_Berkas->get_berkas_where_mahasiswa($id_mahasiswa);
            $this->response($result,REST_Controller::HTTP_OK);
        } else {
            $idx = 0;
            $result = $this->M_User->get_all_user();
            foreach($result as $row) {
                $berkas = $this->M_Berkas->get_berkas_where_mahasiswa($row['id']);
                $temp = array_merge($result[$idx], array('berkas' => $berkas));
                $result[$idx] = $temp;
                $idx++;
            } $this->response($result,REST_Controller::HTTP_OK);
        }
    }

}