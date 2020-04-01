<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Berita_Acara extends CI_Model{
    private $id;
    private $id_mahasiswa;
    private $file;
    private $ttd_dosen_pembimbing;
    private $ttd_ketua_penguji;
    private $ttd_dosen_penguji;
    private $date;
    private $time;
    private $id_dosen_pembimbing;
    private $id_ketua_penguji;
    private $id_dosen_penguji;
    private $nilai;
    private $nilai_final;
    private $max_revisi;
    private $status;
    private $comment_dosen_pembimbing;
    private $comment_ketua_penguji;
    private $comment_dosen_penguji;
    const TABLE_NAME = 'berita_acara';

    public function insert($id_mahasiswa, $file, $date, $time, $id_dosen_pembimbing, $id_ketua_penguji, $id_dosen_penguji, $max_revisi) {
        $this->db->insert($this::TABLE_NAME, array(
            'id_mahasiswa' => $id_mahasiswa,
            'file' => $file,
            'date' => $date,
            'time' => $time,
            'id_dosen_pembimbing' => $id_dosen_pembimbing,
            'id_ketua_penguji' => $id_ketua_penguji,
            'id_dosen_penguji' => $id_dosen_penguji,
            'max_revisi' => $max_revisi
        ));
        return $this->db->insert_id();
    }

    public function get_berita_acara_active_where_dosen($id) {
        return $this->db->query("SELECT * FROM berita_acara WHERE id IN (SELECT MAX(id) FROM berita_acara GROUP BY id_mahasiswa) AND (id_dosen_pembimbing = '$id' OR id_ketua_penguji = '$id' OR id_dosen_penguji = '$id')")->result_array();
    }

    public function update($id,$datas) {
        $result = $this->db->get_where($this::TABLE_NAME, $datas);
        if($result->num_rows() > 0) return true;

        $this->db->update($this::TABLE_NAME, $datas, "id='{$id}'");
        
        return $this->db->affected_rows();
    }
}