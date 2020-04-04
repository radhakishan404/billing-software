<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	
	public function getService()
	{
		$query = $this->db->query('SELECT * FROM service WHERE status = "1" AND is_deleted = "0" order by filter');
    	foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
	}

}