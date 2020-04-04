<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
	private $table = 'customer';
	public function __construct() {
        $this->load->database();
    }

    public function get() {
        $this->db->select('*');
        $this->db->from(TB_CUSTOMER);
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function active() {
        $this->db->select('*');
        $this->db->from(TB_CUSTOMER);
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        return $this->db->get('')->result_array();
    }

    public function inactive() {
        $this->db->select('*');
        $this->db->from(TB_CUSTOMER);
        $this->db->where('is_deleted','0');
        $this->db->where('status','0');
        return $this->db->get('')->result_array();
    }

    public function getTotal() {
        return $this->db->count_all($this->table);
    }

    public function getService()
    {
        $this->db->select('*');
        $this->db->from(TB_SERVICE);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        $this->db->order_by('filter');
        return $this->db->get('')->result_array();
    }

    public function getCustomer($id) {
        $this->db->select('*');
        $this->db->from(TB_CUSTOMER);
        $this->db->where('status','1');
        $this->db->where('id',$id);
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
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
        $this->db->query('UPDATE customer set is_deleted = "1" where id = "'.$id.'"');
    }

}

?>