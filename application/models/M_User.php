<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_User extends CI_Model{
    private $id;
    private $nama;
    private $nomor;
    private $password;
    private $judul;
    private $id_dosen_pembimbing;
    private $id_ketua_penguji;
    private $id_dosen_penguji;
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

    public function update($id,$datas) {
        $result = $this->db->get_where($this::TABLE_NAME, $datas);
        if($result->num_rows() > 0) return true;

        $this->db->update($this::TABLE_NAME, $datas, "id='{$id}'");
        return $this->db->affected_rows();
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

    public function register($nama, $nomor, $password, $judul, $id_dosen_pembimbing) {
        $this->db->insert($this::TABLE_NAME, array(
            'nama' => $nama,
            'nomor' => $nomor,
            'password' => $password,
            'judul' => $judul,
            'id_dosen_pembimbing' => $id_dosen_pembimbing
        ));
        return $this->db->insert_id();
    }

    public function get_user_where($id) {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        $this->db->where("id='{$id}'");
        return $this->db->get()->result_array();
    }

    public function get_all_user() {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        return $this->db->get()->result_array();
    }
    
    public function get_all_unverified_user() {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        $this->db->where("verified != 1");
        return $this->db->get()->result_array();
    }

    public function verify_user($id_mahasiswa) {
        $this->db->update($this::TABLE_NAME, array(
            'verified' => 1
        ), "id='{$id_mahasiswa}'");
        return $this->db->affected_rows();
    }

    public function get_user_where_dosen($id) {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        $this->db->where("id_dosen_pembimbing='{$id}' OR id_ketua_penguji='{$id}' OR id_dosen_penguji='{$id}'");
        return $this->db->get()->result_array();
    }

    // ------
    public function user_exist($nomor) {
        $this->nomor = $nomor;
        return $this->db->get_where($this::TABLE_NAME, "nomor={$nomor}");
    }
}