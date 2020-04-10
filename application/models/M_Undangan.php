<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Undangan extends CI_Model{
    private $id;
    private $id_mahasiswa;
    private $id_dosen_pembimbing;
    private $id_ketua_penguji;
    private $id_dosen_penguji;
    private $file;
    private $status;
    const TABLE_NAME = 'undangan';

    public function insert($id_mahasiswa,$id_dosen_pembimbing,$id_ketua_penguji,$id_dosen_penguji,$file) {
        $this->db->insert($this::TABLE_NAME, array(
            'id_mahasiswa' => $id_mahasiswa,
            'id_dosen_pembimbing' => $id_dosen_pembimbing,
            'id_ketua_penguji' => $id_ketua_penguji,
            'id_dosen_penguji ' => $id_dosen_penguji,
            'file ' => $file,
        ));
        return $this->db->insert_id();
    }

    public function get_by_id_mahasiswa($id_mahasiswa) {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        $this->db->where("id_mahasiswa='{$id_mahasiswa}'");
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_all_user() {
        return $this->db->query("SELECT * FROM undangan WHERE id IN (SELECT MAX(id) FROM undangan GROUP BY id_mahasiswa) AND status is NULL")->result_array();
    }

    public function update($id,$datas) {
        $result = $this->db->get_where($this::TABLE_NAME, $datas);
        if($result->num_rows() > 0) return true;

        $this->db->update($this::TABLE_NAME, $datas, "id='{$id}'");
        return $this->db->affected_rows();
    }

}