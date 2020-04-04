<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	private $stock = 'stock';

	public function __construct() {
        $this->load->database();
    }

    public function get()
    {
    	$this->db->select('*');
        $this->db->from('branches');
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function save($data)
    {
    	$this->db->insert($this->location, $data);
        return $this->db->insert_id();
    }

}