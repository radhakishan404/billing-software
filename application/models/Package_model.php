<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_model extends CI_Model {
	private $table = 'package';
	public function __construct() {
        $this->load->database();
    }
    public function get() {
        $data = FALSE;
        $sql = 'SELECT p.id, p.start_date, p.end_date, p.status, u.name from package as p join users as u on u.id = p.user_id where p.is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotal() {
        return $this->db->count_all($this->table);
    }

    public function getUser()
    {
        $data = FALSE;
        $sql = 'SELECT * from users where status = "1" AND is_deleted = "0" AND role != "admin"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getPackage($id) {
        $data = FALSE;
        $sql = 'SELECT * from package where id = "'.$id.'" AND is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function save($data)
    {
    	$this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($data) {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->query('UPDATE package set is_deleted = "1" where id = "'.$id.'"');
    }
}

?>