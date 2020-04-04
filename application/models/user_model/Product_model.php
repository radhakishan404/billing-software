<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
	private $table = 'product';
	public function __construct() {
        $this->load->database();
    }

    public function get() {
        $this->db->select('*');
        $this->db->from(TB_PRODUCT);
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function active()
    {
        $this->db->select('*');
        $this->db->from(TB_PRODUCT);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function quantity()
    {
        $this->db->select('SUM(quantity) as quantity');
        $this->db->from(TB_PRODUCT);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function purchase()
    {
        $this->db->select('sum(purchase) as purchase');
        $this->db->from(TB_PRODUCT);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function sale()
    {
        $this->db->select('sum(sale) as sale');
        $this->db->from(TB_PRODUCT);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
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

    public function getProduct($id) {
        $this->db->select('*');
        $this->db->from(TB_PRODUCT);
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
        $this->db->query('UPDATE product set is_deleted = "1" where id = "'.$id.'"');
    }

}

?>
