<?php

class MY_Controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); //need this!!

		if(!$this->session->userdata('user_data'))
		{
	        header('Location: '.base_url('login'));
		 	exit;
	 	}
	}
} 