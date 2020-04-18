<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {

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
        $id = $this->get('id');
        $verif = $this->get('verif');
        if(isset($id)) {
            $result = $this->M_User->get_user_where($id);
            $nama_dosen_pembimbing = $this->M_Dosen->get_name($result[0]['id_dosen_pembimbing']);
            $dosen_pembimbing = array();
            for($i=1; $i<=5; $i++) {
                $time = $this->M_Schedules->get_gorup_days($i,$result[0]['id_dosen_pembimbing']);
                $dosen_pembimbing = array_merge($dosen_pembimbing, array($time));
            };
            $result = array_merge($result[0],array('nama_dosen_pembimbing' => $nama_dosen_pembimbing[0]['nama']), array('jadwal_dosen_pembimbing' => $dosen_pembimbing));
            if($result['id_ketua_penguji'] != null) {
                $nama_ketua_penguji = $this->M_Dosen->get_name($result['id_ketua_penguji']);
                $ketua_penguji = array();
                for($i=1; $i<=5; $i++) {
                    $time = $this->M_Schedules->get_gorup_days($i,$result['id_ketua_penguji']);
                    $ketua_penguji = array_merge($ketua_penguji, array($time));
                };
                $result = array_merge($result,array('nama_ketua_penguji' => $nama_ketua_penguji[0]['nama']), array('jadwal_ketua_penguji' => $ketua_penguji));
            }
            if($result['id_dosen_penguji'] != null) {
                $nama_dosen_penguji = $this->M_Dosen->get_name($result['id_dosen_penguji']);
                $dosen_penguji = array();
                for($i=1; $i<=5; $i++) {
                    $time = $this->M_Schedules->get_gorup_days($i,$result['id_dosen_penguji']);
                    $dosen_penguji = array_merge($dosen_penguji, array($time));
                };
                $result = array_merge($result,array('nama_dosen_penguji' => $nama_dosen_penguji[0]['nama']), array('jadwal_dosen_penguji' => $dosen_penguji));
            }
            if($undangan = $this->M_Undangan->get_by_id_mahasiswa($id)) {
                $result = array_merge($result,array('undangan' => $undangan));
            }
            $this->response($result,REST_Controller::HTTP_OK);
        } else {
            if(isset($verif)) {
                $result = $this->M_User->get_all_unverified_user();
                $this->response($result,REST_Controller::HTTP_OK);
            } else{
                $result = $this->M_User->get_all_user();
                $this->response($result,REST_Controller::HTTP_OK);
            }
        }
    }

    public function index_put() {
        $id = $this->put('id');
        $nama = $this->put('nama');
        $nomor = $this->put('nomor');
        $password = $this->put('password');
        $judul = $this->put('judul');
        $id_dosen_pembimbing = $this->put('id_dosen_pembimbing');
        $id_ketua_penguji = $this->put('id_ketua_penguji');
        $id_dosen_penguji = $this->put('id_dosen_penguji');
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
        if(isset($nama)){
            $datas = array_merge($datas, array('nama' => $nama));
        }
        if(isset($nomor)){
            $datas = array_merge($datas, array('nomor' => $nomor));
        }
        if(isset($password)){
            $password = hash('sha512', $password . config_item('encryption_key'));
            $datas = array_merge($datas, array('password' => $password));
        }
        if(isset($judul)){
            $datas = array_merge($datas, array('judul' => $judul));
        }
        if(isset($id_dosen_pembimbing)){
            $datas = array_merge($datas, array('id_dosen_pembimbing' => $id_dosen_pembimbing));
        }
        if(isset($id_ketua_penguji)){
            $datas = array_merge($datas, array('id_ketua_penguji' => $id_ketua_penguji));
        }
        if(isset($id_dosen_penguji)){
            $datas = array_merge($datas, array('id_dosen_penguji' => $id_dosen_penguji));
        }
        if($this->M_User->update($id,$datas)) {
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
