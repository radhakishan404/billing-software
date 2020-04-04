<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Service extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        if($this->session->userdata['user_data']['role'] != 'admin')
		{
	        header('Location: '.base_url('login'));
		 	exit;
	 	}
    }

    public function lists() {
        
        $data['page_title'] = 'Service List';
        $data['middle_view'] = "master/service_list";
        $this->load->view('template/main_template',$data); 
    }

    public function ajaxlist()
    {
        $data_list = $this->Service_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('service/edit/'.$r['id']) .'" class="btn paddd btn-xs btn-success"><i class="icon-pencil"></i></a>';
        $delete = anchor("service/delete/".$r['id'],"<i class='icon-trash'>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger"));

        $data[] = array(
            $edit .' '. $delete,
            $r['name'],
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
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'name'      =>  $this->input->post('name'),
                    'status'    =>  $this->input->post('status'),
                    'added_on'  =>  date('Y-m-d H:i:s')
                    );
                $data = $this->security->xss_clean($data);
                $result = $this->Service_model->save($data);
                $this->session->set_flashdata('success_message', 'Service <b><u>'.$this->input->post('name').'</u></b> added successfully');
                redirect(base_url('service/lists'));
            }
        }
        $data['page_title'] = 'Service Add';
        $data['middle_view'] = "master/service_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'                =>  $id,
                    'name'              =>  $this->input->post('name'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Service_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Service <b><u>'.$this->input->post('name').'</u></b> update successfully');
                redirect(base_url() . "service/lists");
            }
        }

        $data['detail']=$this->Service_model->getService($id);

        $data['id']=$id;

        $data['page_title'] = 'Service Edit';
        $data['middle_view'] = "master/service_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Service_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Service deleted successfully');
        redirect(base_url('service/lists'));
    }
}