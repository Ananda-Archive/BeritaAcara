<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Berita_Acara extends REST_Controller {

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

    function index_post() {
        if($this->session->userdata('id')) {
            $id_mahasiswa = $this->post('id_mahasiswa');
            $file = $this->post('file');
            $date = $this->post('date');
            $time = $this->post('time');
            $id_dosen_pembimbing = $this->post('id_dosen_pembimbing');
            $id_ketua_penguji = $this->post('id_ketua_penguji');
            $id_dosen_penguji = $this->post('id_dosen_penguji');
            $max_revisi = $this->post('max_revisi');

            date_default_timezone_set('Asia/Jakarta');
            $tempfilename = $_FILES['file']['tmp_name'];
            $dir = './assets/beritaacara/';
            if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'doc') {
                $filename = $this->session->userdata('nomor') . '-BeritaAcara-' . date('dmY-His') . '.doc';
            } else {
                if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'docx') {
                    $filename = $this->session->userdata('nomor') . '-BeritaAcara-' . date('dmY-His') . '.docx';
                }
            }
            if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'doc' || pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'docx') {
                if($this->M_Berita_Acara->insert($id_mahasiswa, base_url('assets/beritaacara/').$filename, $date, $time, $id_dosen_pembimbing, $id_ketua_penguji, $id_dosen_penguji, $max_revisi)) {
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
                        'message' => 'ONLY ACCEPT DOC /DOCX FILE TYPE'
                    ),
                    REST_Controller::HTTP_UNAUTHORIZED
                );
            }
        }
    }

    public function index_get() {
        $id = $this->get('id');
        if(isset($id)) {
            $idx = 0;
            $result = $this->M_Berita_Acara->get_berita_acara_active_where_dosen($id);
            foreach($result as $row) {
                $user = $this->M_User->get_user_where($row['id_mahasiswa']);
                $berkas = $this->M_Berkas->get_berkas_where_mahasiswa($row['id_mahasiswa']);
                $temp = array_merge($result[$idx], array('user' => $user), array('berkas' => $berkas));
                $result[$idx] = $temp;
                $idx++;
            } $this->response($result,REST_Controller::HTTP_OK);
        }
    }

    public function index_put() {
        if($this->session->userdata('id')) {
            $id = $this->put('id');
            $nilai = $this->put('nilai');
            $nilai_final = $this->put('nilai_final');
            $status = $this->put('status');
            $max_revisi = $this->put('max_revisi');
            $comment_dosen_pembimbing = $this->put('comment_dosen_pembimbing');
            $comment_ketua_penguji = $this->put('comment_ketua_penguji');
            $comment_dosen_penguji = $this->put('comment_dosen_penguji');
            $ttd_dosen_pembimbing = $this->put('ttd_dosen_pembimbing');
            $ttd_ketua_penguji = $this->put('ttd_ketua_penguji');
            $ttd_dosen_penguji = $this->put('ttd_dosen_penguji');
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
            if(isset($nilai)){
                $datas = array_merge($datas, array('nilai' => $nilai));
            }
            if(isset($nilai_final)){
                $datas = array_merge($datas, array('nilai_final' => $nilai_final));
            }
            if(isset($status)){
                $datas = array_merge($datas, array('status' => $status));
            }
            if(isset($max_revisi)){
                $datas = array_merge($datas, array('max_revisi' => $max_revisi));
            }
            if(isset($comment_dosen_pembimbing)){
                $datas = array_merge($datas, array('comment_dosen_pembimbing' => $comment_dosen_pembimbing));
            }
            if(isset($comment_ketua_penguji)){
                $datas = array_merge($datas, array('comment_ketua_penguji' => $comment_ketua_penguji));
            }
            if(isset($comment_dosen_penguji)){
                $datas = array_merge($datas, array('comment_dosen_penguji' => $comment_dosen_penguji));
            }
            if(isset($ttd_dosen_pembimbing)){
                $datas = array_merge($datas, array('ttd_dosen_pembimbing' => $ttd_dosen_pembimbing));
            }
            if(isset($ttd_ketua_penguji)){
                $datas = array_merge($datas, array('ttd_ketua_penguji' => $ttd_ketua_penguji));
            }
            if(isset($ttd_dosen_penguji)){
                $datas = array_merge($datas, array('ttd_dosen_penguji' => $ttd_dosen_penguji));
            }
            if($this->M_Berita_Acara->update($id,$datas)) {
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