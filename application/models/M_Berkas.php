<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Berkas extends CI_Model{
    private $id;
    private $id_mahasiswa;
    private $toefl_file;
    private $toefl_file_verified;
    private $transkrip_file;
    private $transkrip_file_verified;
    private $skripsi_file;
    private $skripsi_file_verified;
    private $bimbingan_file;
    private $bimbingan_file_verified;
    const TABLE_NAME = 'berkas';

    public function storeTranskrip($id_mahasiswa, $file) {
        $this->db->insert($this::TABLE_NAME, array(
            'id_mahasiswa' => $id_mahasiswa,
            'transkrip_file' => $file,
        ));
        return $this->db->insert_id();
    }

    public function delete($id) {
        $this->db->delete($this::TABLE_NAME, "id='{$id}'");
        return $this->db->affected_rows();
    }

    public function storeToefl($id,$id_mahasiswa,$file,$toefl_file_verified, $transkrip_file, $transkrip_file_verified, $skripsi_file, $skripsi_file_verified, $bimbingan_file, $bimbingan_file_verified) {
        $this->db->insert($this::TABLE_NAME, array(
            'id' => $id,
            'id_mahasiswa' => $id_mahasiswa,
            'toefl_file' => $file,
            'toefl_file_verified' => $toefl_file_verified,
            'transkrip_file' => $transkrip_file,
            'transkrip_file_verified' => $transkrip_file_verified,
            'skripsi_file' => $skripsi_file,
            'skripsi_file_verified' => $skripsi_file_verified,
            'bimbingan_file' => $bimbingan_file,
            'bimbingan_file_verified' => $bimbingan_file_verified,
        ));
        return $this->db->insert_id();
    }

    public function storeTranskripNew($id,$id_mahasiswa, $toefl_file, $toefl_file_verified, $file, $transkrip_file_verified, $skripsi_file, $skripsi_file_verified, $bimbingan_file, $bimbingan_file_verified) {
        $this->db->insert($this::TABLE_NAME, array(
            'id' => $id,
            'id_mahasiswa' => $id_mahasiswa,
            'toefl_file' => $toefl_file,
            'toefl_file_verified' => $toefl_file_verified,
            'transkrip_file' => $file,
            'transkrip_file_verified' => $transkrip_file_verified,
            'skripsi_file' => $skripsi_file,
            'skripsi_file_verified' => $skripsi_file_verified,
            'bimbingan_file' => $bimbingan_file,
            'bimbingan_file_verified' => $bimbingan_file_verified,
        ));
        return $this->db->insert_id();
    }

    public function storeSkripsi($id,$id_mahasiswa, $toefl_file, $toefl_file_verified, $transkrip_file, $transkrip_file_verified, $file, $skripsi_file_verified, $bimbingan_file, $bimbingan_file_verified) {
        $this->db->insert($this::TABLE_NAME, array(
            'id' => $id,
            'id_mahasiswa' => $id_mahasiswa,
            'toefl_file' => $toefl_file,
            'toefl_file_verified' => $toefl_file_verified,
            'transkrip_file' => $transkrip_file,
            'transkrip_file_verified' => $transkrip_file_verified,
            'skripsi_file' => $file,
            'skripsi_file_verified' => $skripsi_file_verified,
            'bimbingan_file' => $bimbingan_file,
            'bimbingan_file_verified' => $bimbingan_file_verified,
        ));
        return $this->db->insert_id();
    }

    public function storeBimbingan($id,$id_mahasiswa, $toefl_file, $toefl_file_verified, $transkrip_file, $transkrip_file_verified, $skripsi_file, $skripsi_file_verified, $file, $bimbingan_file_verified) {
        $this->db->insert($this::TABLE_NAME, array(
            'id' => $id,
            'id_mahasiswa' => $id_mahasiswa,
            'toefl_file' => $toefl_file,
            'toefl_file_verified' => $toefl_file_verified,
            'transkrip_file' => $transkrip_file,
            'transkrip_file_verified' => $transkrip_file_verified,
            'skripsi_file' => $skripsi_file,
            'skripsi_file_verified' => $skripsi_file_verified,
            'bimbingan_file' => $file,
            'bimbingan_file_verified' => $bimbingan_file_verified,
        ));
        return $this->db->insert_id();
    }
}