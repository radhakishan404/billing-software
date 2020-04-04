<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Dashboard_model');
    }

    public function index()
    {
        $data['service'] = $this->Dashboard_model->getService();
    	$data['page_title'] = 'Dashboard';
		$data['middle_view'] = "user_master/dashboard";
		$this->load->view('template/main_template',$data);
    }
}