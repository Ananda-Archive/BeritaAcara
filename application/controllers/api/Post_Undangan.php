<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Post_Undangan extends REST_Controller {

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
        $id_dosen_pembimbing = $this->post('id_dosen_pembimbing');
        $id_ketua_penguji = $this->post('id_ketua_penguji');
        $id_dosen_penguji = $this->post('id_dosen_penguji');
        $file = $this->post('file');

        date_default_timezone_set('Asia/Jakarta');
        $tempfilename = $_FILES['file']['tmp_name'];
        $dir = './assets/undangan/';
        if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'doc') {
            $filename = $this->session->userdata('nomor') . '-undangan-' . date('dmY-His') . '.doc';
        } else {
            if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'docx') {
                $filename = $this->session->userdata('nomor') . '-undangan-' . date('dmY-His') . '.docx';
            } else {
                if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'pdf') {
                    $filename = $this->session->userdata('nomor') . '-undangan-' . date('dmY-His') . '.pdf';
                }
            }
        }
        if(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'pdf' || pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'doc' || pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) == 'docx') {
            if($this->M_Undangan->insert($id_mahasiswa, $id_dosen_pembimbing, $id_ketua_penguji, $id_dosen_penguji , base_url('assets/undangan/').$filename)) {
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
                    'message' => 'ONLY ACCEPT DOC / DOCX / PDF FILE TYPE'
                ),
                REST_Controller::HTTP_UNAUTHORIZED
            );
        }
    }

    public function index_get() {
        $id = $this->get('id');
        if(!isset($id)) {
            $idx = 0;
            $result = $this->M_Undangan->get_all_user();
            foreach ($result as $row) {
                $user = $this->M_User->get_user_where($row['id_mahasiswa']);
                $dosen_pembimbing = $this->M_Dosen->get_email($user[0]['id_dosen_pembimbing']);
                $ketua_penguji = $this->M_Dosen->get_email($user[0]['id_ketua_penguji']);
                $dosen_penguji = $this->M_Dosen->get_email($user[0]['id_dosen_penguji']);
                $temp = array_merge($result[$idx], array('user' => $user[0]), array('dosen_pembimbing' => $dosen_pembimbing[0]), array('ketua_penguji' => $ketua_penguji[0]), array('dosen_penguji' => $dosen_penguji[0]));
                $result[$idx] = $temp;
                $idx++;
            }
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }

    public function index_put() {
        $id = $this->put('id');
        $email_dosen_pembimbing = $this->put('email_dosen_pembimbing');
        $email_ketua_penguji = $this->put('email_ketua_penguji');
        $email_dosen_penguji = $this->put('email_dosen_penguji');
        $status = $this->put('status');
        $file = $this->put('file');

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
        if(!isset($status)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE." status"
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        $datas = array_merge($datas, array('status' => $status));
        if($status == 1) {
            $sendto = array($email_dosen_pembimbing,$email_ketua_penguji,$email_dosen_penguji);
            // Ini di setting hanya untuk GMAIL
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'shiningassvj@gmail.com',
                'smtp_pass' => 'sodebade',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            
            $this->email->from('shiningassvj@gmail.com', 'Universitas Diponegoro');
            $this->email->to($sendto); 

            $this->email->attach($file);
            $this->email->subject('Surat Undangan');
            $this->email->message('Surat Undangan');
            
            if($this->M_Undangan->update($id,$datas)) {
                if($result = $this->email->send()) {
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
                            'message' => "Gagal Mengirim E-Mail"
                        ),REST_Controller::HTTP_INTERNAL_SERVER_ERROR
                    );
                }
            } else {
                $this->response(
                    array(
                        'status' => FALSE,
                        'message' => $this::UPDATE_FAILED_MESSAGE
                    ),
                    REST_Controller::HTTP_BAD_REQUEST
                );
            }
        } else {
            if($status == 0) {
                if($this->M_Undangan->update($id,$datas)) {
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
                        ),
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                }
            }
        }
    }

}