<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Schedules extends CI_Model{
    private $id;
    private $id_dosen;
    private $id_days;
    private $id_time;
    private $availability;
    const TABLE_NAME = 'schedules';

    public function insert($id_dosen) {
        for($i=1; $i<=5; $i++) {
            for($j=1; $j<=7; $j++) {
                $this->db->insert($this::TABLE_NAME, array(
                    'id_dosen' => $id_dosen,
                    'id_days' => $i,
                    'id_time' => $j
                ));
            }
        }
        return $this->db->insert_id();
    }

    public function get($id_dosen) {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        $this->db->where("id_dosen='{$id_dosen}'");
        return $this->db->get()->result_array();
    }

    public function get_gorup_days($id,$id_dosen) {
        $this->db->select('*');
        $this->db->from($this::TABLE_NAME);
        $this->db->where("id_days='{$id}'");
        $this->db->where("id_dosen='{$id_dosen}'");
        return $this->db->get()->result_array();
    }

    public function update($datas,$id) {
        $result = $this->db->get_where($this::TABLE_NAME, $datas);
        if($result->num_rows() > 0) return true;

        $this->db->update($this::TABLE_NAME, $datas, "id='{$id}'");
        return $this->db->affected_rows(); 
    }
    
}