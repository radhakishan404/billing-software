<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
	
	function change($cpass, $id)
    {
    	$this->db->select('*');
    	$this->db->from(TB_USER);
    	$this->db->where('id',$id);
    	$this->db->where('password',md5($cpass));
    	return $this->db->get('')->result_array();
    }
}