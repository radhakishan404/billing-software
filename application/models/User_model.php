<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	private $table = 'users';
	public function __construct() {
        $this->load->database();
    }
    public function get() {
        $data = FALSE;
        $sql = 'SELECT u.id, u.name as u_name, 
                    GROUP_CONCAT(s.name ORDER BY s.id) as s_name, 
                    u.status, u.email 
                from users as u 
                left join service as s on FIND_IN_SET(s.id, u.service_id) 
                where u.status = "1" 
                AND u.role != "admin" 
                AND u.is_deleted = "0" 
                group by u.id';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotal() {
        return $this->db->count_all($this->table);
    }

    public function getUser($id) {
        $data = FALSE;
        $sql = 'SELECT * from users where id = "'.$id.'" AND status = "1" AND is_deleted = "0"';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function getService()
    {
        $data = FALSE;
        $sql = 'SELECT * from service where status = "1" AND is_deleted = "0"';
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
        $this->db->query('UPDATE users set is_deleted = "1" where id = "'.$id.'"');
    }

    public function selected_service($service_id)
    {
        $sql = 'SELECT * from service where id in ('.$service_id.')';
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $data;
    }
}

?>