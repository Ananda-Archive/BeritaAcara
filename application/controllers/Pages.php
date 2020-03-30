<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    // Halaman Utama, untuk login
    public function login() {
		if($this->session->userdata('id')) {
			redirect('home');
		} else {
			$this->load->view('login');
		}
    }
    

}
