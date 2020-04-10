<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dosen extends CI_Model{
    private $id;
    private $nama;
    private $nomor;
    private $email;
    private $password;
    private $file_jadwal;
    const TABLE_NAME = 'dosen';

    public function get_all_dosen_for_regis() {
        $this->db->select('id,nama');
        $this->db->from($this::TABLE_NAME);
        return $this->db->get()->result_array();
    }

    public function get_name($id) {
        $this->db->select('id,nama,file_jadwal');
        return $this->db->get_where($this::TABLE_NAME, "id={$id}")->result_array();
    }

    public function get_email($id) {
        $this->db->select('id,nama,email,file_jadwal');
        return $this->db->get_where($this::TABLE_NAME, "id={$id}")->result_array();
    }

    public function login($nomor,$password) {
        $this->nomor = $nomor;
        $this->password = $password;

        return $this->db->get_where($this::TABLE_NAME, array (
            'nomor' => $this->nomor,
            'password' => $this->password
        ));
    }

    public function user_exist($nomor) {
        $this->nomor = $nomor;
        return $this->db->get_where($this::TABLE_NAME, "nomor={$nomor}");
    }

    public function get_by_nomor($nomor) {
        $this->nomor = $nomor;

        return $this->db->get_where($this::TABLE_NAME, "nomor={$nomor}");
    }

    public function insert($nomor,$nama,$email,$password) {
        $this->db->insert($this::TABLE_NAME, array(
            'nomor' => $nomor,
            'nama' => $nama,
            'email' => $email,
            'password ' => $password,
        ));
        return $this->db->insert_id();
    }

    public function update($id,$datas) {
        $result = $this->db->get_where($this::TABLE_NAME, $datas);
        if($result->num_rows() > 0) return true;

        $this->db->update($this::TABLE_NAME, $datas, "id='{$id}'");
        return $this->db->affected_rows();
    }

    public function updateJadwal($id,$file) {
        $this->db->update($this::TABLE_NAME, array(
            'file_jadwal' => $file,
        ), "id='{$id}'");
        return $this->db->affected_rows();
    }
    
}