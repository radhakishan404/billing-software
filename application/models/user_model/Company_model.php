<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {
	private $table = 'company';
	private $location = 'branches';

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

    public function get_default()
    {
    	$this->db->select('*');
        $this->db->from('branches');
        $this->db->where('is_deleted','0');
        $this->db->where('is_default','1');
        return $this->db->get('')->result_array();
    }

    public function get_branches($id)
    {
    	$this->db->select('*');
    	$this->db->from('branches');
    	$this->db->where('id',$id);
    	return $this->db->get('')->result_array();
    }

    public function update($data) {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->location, $data);
    }

    public function delete($id) {
        $this->db->query('UPDATE branches set is_deleted = "1" where id = "'.$id.'"');
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

    function change($cpass, $id)
    {
        $this->db->select('*');
        $this->db->from(TB_USER);
        $this->db->where('id',$id);
        $this->db->where('password',md5($cpass));
        return $this->db->get('')->result_array();
    }
}