<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	private $table = 'users';
	public function __construct() {
        $this->load->database();
    }

    public function login($data){
    	$query = $this->db->query('SELECT * FROM users where email = "'.$data['email'].'" AND password = "'.md5($data['password']).'" AND status = "1"');
    	foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
    }

    function update_record($data)
    {
    	$query = $this->db->query("UPDATE user SET ");
    }

}