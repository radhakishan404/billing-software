<?php

class Package extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Package_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
        if($this->session->userdata['user_data']['role'] != 'admin')
        {
            header('Location: '.base_url('login'));
            exit;
        }
    }

    public function lists() {
        $data['detail'] = $this->Package_model->get();
        $data['page_title'] = 'User Package List';
        $data['middle_view'] = "master/user_package_list";
        $this->load->view('template/main_template',$data); 
    }

    public function ajaxlist()
    {
        $data_list = $this->Package_model->get();

        foreach($data_list as $r) {
            
        $edit = '<a href="'. base_url('package/edit/'.$r['id']) .'" class="btn paddd btn-xs btn-success"><i class="icon-pencil"></i></a>';
        $delete = anchor("package/delete/".$r['id'],"<i class='icon-trash'>",array("onclick" => "return confirm('Do you want delete this record')", "class" => "btn paddd btn-xs btn-danger"));

        $now = strtotime(date('Y-m-d')); // or your date as well
        $your_date = strtotime($r['end_date']);
        $datediff = $your_date - $now;

        $remain = round($datediff / (60 * 60 * 24));

        $data[] = array(
            $edit .' '. $delete,
            $r['name'],
            date('d-m-Y', strtotime($r['start_date'])),
            date('d-m-Y', strtotime($r['end_date'])),
            max($remain,0),
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
            $this->form_validation->set_rules('s_date', 'Start Date', 'required');
            $this->form_validation->set_rules('e_date', 'End Date', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) { 

                $data = array(
                    'user_id'   =>  $this->input->post('name'),
                    'start_date'=>  date("Y-m-d", strtotime($this->input->post('s_date'))),
                    'end_date'  =>  date("Y-m-d", strtotime($this->input->post('e_date'))),
                    'status'    =>  $this->input->post('status'),
                    'added_on'  =>  date('Y-m-d H:i:s')
                    );

                $data = $this->security->xss_clean($data);
                $result = $this->Package_model->save($data);

                $this->session->set_flashdata('success_message', ' User Package added successfully');
                redirect(base_url('package/lists'));
            }
        }
        $data['users'] = $this->Package_model->getUser();

        $data['page_title'] = 'User Package Add';
        $data['middle_view'] = "master/user_package_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('s_date', 'Start Date', 'required');
            $this->form_validation->set_rules('e_date', 'End Date', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            // echo date("Y-m-d", strtotime($this->input->post('s_date')));
            // echo date("Y-m-d", strtotime($this->input->post('e_date')));
            // die();
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'id'        =>  $id,
                    'user_id'   =>  $this->input->post('name'),
                    'start_date'=>  date("Y-m-d", strtotime($this->input->post('s_date'))),
                    'end_date'  =>  date("Y-m-d", strtotime($this->input->post('e_date'))),
                    'status'    =>  $this->input->post('status'),
                    'update_on'  =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $update = $this->Package_model->update($f_data_xss);
                
                $this->session->set_flashdata('success_message', ' User Package update successfully');
                redirect(base_url() . "package/lists");
            }
        }

        $data['users']=$this->Package_model->getUser();
        $data['detail']=$this->Package_model->getPackage($id);

        $data['id']=$id;

        $data['page_title'] = 'User Package Edit';
        $data['middle_view'] = "master/user_package_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Package_model->delete($id);
        $this->session->set_flashdata('delete_message', 'User deleted successfully');
        redirect(base_url('user/lists'));
    }
}