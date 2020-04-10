<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Departemen extends CI_Model{
    private $id;
    private $username;
    private $password;
    const TABLE_NAME = 'departemen';

    public function login($username,$password) {
        $this->username = $username;
        $this->password = $password;

        return $this->db->get_where($this::TABLE_NAME, array (
            'username' => $this->username,
            'password' => $this->password
        ));
    }
}