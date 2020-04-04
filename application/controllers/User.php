<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        if($this->session->userdata['user_data']['role'] != 'admin')
		{
	        header('Location: '.base_url('login'));
		 	exit;
	 	}
    }

    public function lists() {
        $data['detail'] = $this->User_model->get();
        $data['page_title'] = 'User';
        $data['middle_view'] = "master/user_list";
        $this->load->view('template/main_template',$data); 
    }

    public function ajaxlist() {
        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('user/edit/'.$r['id']) .'" class="btn paddd btn-xs btn-success"><i class="icon-pencil"></i></a>';
        $delete = anchor("user/delete/".$r['id'],"<i class='icon-trash'>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger"));

        $data[] = array(
            $edit .' '. $delete,
            $r['u_name'],
            $r['email'],
            $r['s_name'],
            $r['status']==1?'Active':'Inactive',
            );
        }

        $output = array(
            "data" => $data
        );
        
        echo json_encode($output);
        exit();
    }

    public function add()
    {
        if($this->input->post())
        {   
            $service = implode(',', $this->input->post('service'));

                $data = array(
                    'name'          =>  $this->input->post('name'),
                    'email'         =>  $this->input->post('email'),
                    'number'        =>  $this->input->post('number'),
                    'gstin'         =>  $this->input->post('gstin'),
                    'country'       =>  $this->input->post('country'),
                    'state'         =>  $this->input->post('state'),
                    'city'          =>  $this->input->post('city'),
                    'street'        =>  $this->input->post('street'),
                    'zipcode'       =>  $this->input->post('zipcode'),
                    'password'      =>  md5($this->input->post('password')),
                    'status'        =>  $this->input->post('status'),
                    'service_id'    =>  $service,
                    'role'          =>  'sub-admin',
                    'added_on'      =>  date('Y-m-d H:i:s')
                    );
                $data = $this->security->xss_clean($data);
                $result = $this->User_model->save($data);
                $this->session->set_flashdata('success_message', 'User <b><u>'.$this->input->post('name').'</u></b> added successfully');
                redirect(base_url('user/lists'));
            
        }
        $data['service'] = $this->User_model->getService();
        $data['page_title'] = 'User Add';
        $data['middle_view'] = "master/user_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $password = md5($this->input->post('password'));
                $service = implode(',', $this->input->post('service'));
                $data = array(
                    'id'            =>  $id,
                    'name'          =>  $this->input->post('name'),
                    'email'         =>  $this->input->post('email'),
                    'number'        =>  $this->input->post('number'),
                    'gstin'         =>  $this->input->post('gstin'),
                    'country'       =>  $this->input->post('country'),
                    'state'         =>  $this->input->post('state'),
                    'city'          =>  $this->input->post('city'),
                    'street'        =>  $this->input->post('street'),
                    'zipcode'       =>  $this->input->post('zipcode'),
                    'password'      =>  md5($this->input->post('password')),
                    'status'        =>  $this->input->post('status'),
                    'service_id'    =>  $service,
                    'status'        =>  $this->input->post('status'),
                    'update_on'     =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->User_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'User <b><u>'.$this->input->post('name').'</u></b> update successfully');
                redirect(base_url() . "user/lists");
            
        }

        $data['detail']=$this->User_model->getUser($id);

        if(!empty($data['detail'][0]['service_id']))
        {
            $data['selected_service'] = $this->User_model->selected_service($data['detail'][0]['service_id']);
        }

        $data['service'] = $this->User_model->getService();
        
        // echo "<pre>";print_r($data['service']);die();

        $data['id']=$id;

        $data['page_title'] = 'User Edit';
        $data['middle_view'] = "master/user_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->User_model->delete($id);
        $this->session->set_flashdata('delete_message', 'User deleted successfully');
        redirect(base_url('user/lists'));
    }
}