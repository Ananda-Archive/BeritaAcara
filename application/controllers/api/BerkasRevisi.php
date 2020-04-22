<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class BerkasRevisi extends REST_Controller {

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
            $skripsi_file_verified_dosen_pembimbing = $this->post('skripsi_file_verified_dosen_pembimbing');
            $skripsi_file_verified_ketua_penguji = $this->post('skripsi_file_verified_ketua_penguji');
            $skripsi_file_verified_dosen_penguji = $this->post('skripsi_file_verified_dosen_penguji');
            $skripsi_file_revisi_dosen_pembimbing = $this->post('skripsi_file_revisi_dosen_pembimbing');
            $skripsi_file_revisi_ketua_penguji = $this->post('skripsi_file_revisi_ketua_penguji');
            $skripsi_file_revisi_dosen_penguji = $this->post('skripsi_file_revisi_dosen_penguji');
            $bimbingan_file = $this->post('bimbingan_file');
            $bimbingan_file_verified = $this->post('bimbingan_file_verified');

            $datas = array();
            if(isset($id_mahasiswa)){
                $datas = array_merge($datas, array('id_mahasiswa' => $id_mahasiswa));
            }
            if(isset($toefl_file)){
                $datas = array_merge($datas, array('toefl_file' => $toefl_file));
            }
            if(isset($toefl_file_verified)){
                $datas = array_merge($datas, array('toefl_file_verified' => $toefl_file_verified));
            }
            if(isset($transkrip_file)){
                $datas = array_merge($datas, array('transkrip_file' => $transkrip_file));
            }
            if(isset($transkrip_file_verified)){
                $datas = array_merge($datas, array('transkrip_file_verified' => $transkrip_file_verified));
            }
            if(isset($skripsi_file)){
                $datas = array_merge($datas, array('skripsi_file' => $skripsi_file));
            }
            if(isset($skripsi_file_verified_dosen_pembimbing)){
                $datas = array_merge($datas, array('skripsi_file_verified_dosen_pembimbing' => $skripsi_file_verified_dosen_pembimbing));
            }
            if(isset($skripsi_file_verified_ketua_penguji)){
                $datas = array_merge($datas, array('skripsi_file_verified_ketua_penguji' => $skripsi_file_verified_ketua_penguji));
            }
            if(isset($skripsi_file_verified_dosen_penguji)){
                $datas = array_merge($datas, array('skripsi_file_verified_dosen_penguji' => $skripsi_file_verified_dosen_penguji));
            }
            if(isset($skripsi_file_revisi_dosen_pembimbing)){
                $datas = array_merge($datas, array('skripsi_file_revisi_dosen_pembimbing' => $skripsi_file_revisi_dosen_pembimbing));
            }
            if(isset($skripsi_file_revisi_ketua_penguji)){
                $datas = array_merge($datas, array('skripsi_file_revisi_ketua_penguji' => $skripsi_file_revisi_ketua_penguji));
            }
            if(isset($skripsi_file_revisi_dosen_penguji)){
                $datas = array_merge($datas, array('skripsi_file_revisi_dosen_penguji' => $skripsi_file_revisi_dosen_penguji));
            }
            if(isset($bimbingan_file)){
                $datas = array_merge($datas, array('bimbingan_file' => $bimbingan_file));
            }
            if(isset($bimbingan_file_verified)){
                $datas = array_merge($datas, array('bimbingan_file_verified' => $bimbingan_file_verified));
            }
            if($this->M_Berkas->revisi($datas)) {
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