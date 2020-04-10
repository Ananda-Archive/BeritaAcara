<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    // Halaman Utama, untuk login
    public function login() {
		if($this->session->userdata('id')) {
			redirect('Pages/home');
		} else {
			$this->load->view('login');
		}
    }

    // Home Mahasiswa
    public function home() {
        date_default_timezone_set('Asia/Jakarta');
        $curr = date('Y-m-d');
        if($this->session->userdata('id')) {
            if($this->session->userdata('role') == 0) {
                $data['id'] = $this->session->userdata('id');
                $data['nama'] = $this->session->userdata('nama');
                $data['nomor'] = $this->session->userdata('nomor');
                $data['role'] = $this->session->userdata('role');
                if($curr >= $this->session->userdata('start') && $curr <= $this->session->userdata('end')) {
                    $this->load->view('home_mahasiswa',$data);
                } else {
                    $this->load->view('event',$data);
                }
            } else {
                if($this->session->userdata('role') == 1) {
                    $data['id'] = $this->session->userdata('id');
                    $data['nama'] = $this->session->userdata('nama');
                    $data['nomor'] = $this->session->userdata('nomor');
                    $data['role'] = $this->session->userdata('role');
                    $this->load->view('home_dosen',$data);
                } else {
                    if($this->session->userdata('role') == 2) {
                        $data['id'] = $this->session->userdata('id');
                        $data['nama'] = $this->session->userdata('nama');
                        $data['nomor'] = $this->session->userdata('nomor');
                        $data['role'] = $this->session->userdata('role');
                        $this->load->view('home_admin',$data);
                    } else {
                        if($this->session->userdata('role') == 3) {
                            $data['id'] = $this->session->userdata('id');
                            $data['nama'] = $this->session->userdata('nama');
                            $data['role'] = $this->session->userdata('role');
                            $this->load->view('home_departemen',$data);
                        }
                    }
                }
            }
        } else {
            redirect('Pages/login');
        }
    }

    // LogOut
    public function logOut() {
        $this->session->sess_destroy();
        redirect('Pages/login');
    }
    

}
