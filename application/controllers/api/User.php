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
            $this->response($result,REST_Controller::HTTP_OK);
        } else {
            if(isset($verif)) {
                $result = $this->M_User->get_all_unverified_user();
                $this->response($result,REST_Controller::HTTP_OK);
            } 
        }
    }
    

}
