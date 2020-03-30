<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    // Halaman Utama, untuk login
    public function login() {
		if($this->session->userdata('id')) {
			redirect('Pages/home_mahasiswa');
		} else {
			$this->load->view('login');
		}
    }

    // Home Mahasiswa
    public function home_mahasiswa() {
        if($this->session->userdata('role') == 0) {
            $data['id'] = $this->session->userdata('id');
            $data['nama'] = $this->session->userdata('nama');
            $data['nomor'] = $this->session->userdata('nomor');
            $data['role'] = $this->session->userdata('role');
            $this->load->view('home_mahasiswa',$data);
        }
    }

    // LogOut
    public function logOut() {
        $this->session->sess_destroy();
        redirect('Pages/login');
    }
    

}
