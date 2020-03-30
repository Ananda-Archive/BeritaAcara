<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model{
    private $id;
    private $nama;
    private $nomor;
    private $password;
    private $verified;
    const TABLE_NAME = 'user';

    public function login($nomor,$password) {
        $this->nomor = $nomor;
        $this->password = $password;

        return $this->db->get_where($this::TABLE_NAME, array (
            'nomor' => $this->nomor,
            'password' => $this->password
        ));
    }

    public function is_verified($nomor,$password) {
        $this->nomor = $nomor;
        $this->password = $password;

        return $this->db->get_where($this::TABLE_NAME, array (
            'nomor' => $this->nomor,
            'password' => $this->password,
            'verified' => 1
        ));
    }

    public function register($nama, $nomor, $password) {
        $this->db->insert($this::TABLE_NAME, array(
            'nama' => $nama,
            'nomor' => $nomor,
            'password' => $password
        ));
        return $this->db->insert_id();
    }

    // ------
    public function user_exist($nomor) {
        $this->nomor = $nomor;
        return $this->db->get_where($this::TABLE_NAME, "nomor={$nomor}");
    }
}