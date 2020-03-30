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
        if(isset($id)) {
            $result = $this->M_User->get_user_where($id);
            $berkas = $this->M_Berkas->get_berkas_where_mahasiswa($id);
            $result = array_merge($result[0], array('berkas' => $berkas));
            $this->response($result,REST_Controller::HTTP_OK);
        } else {
            $idx = 0;
            $result = $this->M_User->get_all_user();
            foreach($result as $row) {
                $berkas = $this->M_Berkas->get_berkas_where_mahasiswa($row['id']);
                $temp = array_merge($result[$idx], array('berkas' => $berkas));
                $result[$idx] = $temp;
                $idx++;
            }
            $this->response($result,REST_Controller::HTTP_OK);
        }
    }

}
