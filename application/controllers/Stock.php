<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stock extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Stock_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists() {

        $data['service'] = $this->Stock_model->getService();
        $data['page_title'] = 'Stock';
        $data['middle_view'] = "user_master/stock_list";
        $this->load->view('template/main_template',$data); 
    }
}