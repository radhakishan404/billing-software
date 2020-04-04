<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Supplier extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Supplier_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists() {
        $data['total'] = $this->Supplier_model->get();
        $data['active'] = $this->Supplier_model->active();
        $data['inactive'] = $this->Supplier_model->inactive();
        $data['service'] = $this->Supplier_model->getService();
        $data['page_title'] = '<i class="fa fa-industry"></i> Supplier';
        $data['middle_view'] = "user_master/supplier_list";
        $this->load->view('template/main_template',$data); 
    }

    public function add()
    {
        if($this->input->post())
        {   
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[15]');  
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $data = array(
                    'name'          =>  $this->input->post('name'),
                    'email'         =>  $this->input->post('email'),
                    'mobile'        =>  $this->input->post('mobile'),
                    'gstin'         =>  $this->input->post('gstin'),
                    'country'       =>  $this->input->post('country'),
                    'state'         =>  $this->input->post('state'),
                    'city'          =>  $this->input->post('city'),
                    'street'        =>  $this->input->post('street'),
                    'zipcode'       =>  $this->input->post('zipcode'),
                    'status'        =>  $this->input->post('status'),
                    'added_on'  =>  date('Y-m-d H:i:s')
                );
                $insert = $this->security->xss_clean($data);
                $result = $this->Supplier_model->save($insert);
                $this->session->set_flashdata('success_message', 'Supplier <b><u>'.$this->input->post('name').'</u></b> added successfully');
                redirect(base_url('supplier/lists'));
            }
        }
        $data['service'] = $this->Supplier_model->getService();
        $data['page_title'] = '<i class="fa fa-industry"></i> Supplier';
        $data['middle_view'] = "user_master/supplier_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        $data['id']=$id;
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[15]');  
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() === TRUE) 
            {
                $data = array(
                    'id'                =>  $id,
                    'name'              =>  $this->input->post('name'),
                    'email'             =>  $this->input->post('email'),
                    'mobile'            =>  $this->input->post('mobile'),
                    'gstin'             =>  $this->input->post('gstin'),
                    'country'           =>  $this->input->post('country'),
                    'state'             =>  $this->input->post('state'),
                    'city'              =>  $this->input->post('city'),
                    'street'            =>  $this->input->post('street'),
                    'zipcode'           =>  $this->input->post('zipcode'),
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Supplier_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Supplier <b><u>'.$this->input->post('name').'</u></b> update successfully');
                redirect(base_url() . "supplier/lists");
            }
        }

        $data['detail']=$this->Supplier_model->getSupplier($id);
        $data['service'] = $this->Supplier_model->getService();
        $data['page_title'] = '<i class="fa fa-industry"></i> Supplier';
        $data['middle_view'] = "user_master/supplier_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Supplier_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Supplier deleted successfully');
        redirect(base_url('supplier/lists'));
    }

    public function csv()
    {
        $table_name = 'supplier';

        $this->db->select('id, name as Name, mobile as Mobile, email as Email, gstin as GSTIN, country as Country, state as State, city as City, street as Street, zipcode as Zipcode');
        $this->db->from($table_name);
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            foreach ($value as $v => $k) {
                $columns[] = $v;
            }
        }

        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = $columns;

        $column = 0;

        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $table_name = 'customer';

        $this->db->select('id, name as Name, mobile as Mobile, email as Email, gstin as GSTIN, country as Country, state as State, city as City, street as Street, zipcode as Zipcode');
        $this->db->from($table_name);
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $supplier_data = $this->db->get()->result_array();

        $excel_row = 2;

        foreach($supplier_data as $row)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['Name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['Mobile']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['Email']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['GSTIN']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['Country']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['State']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['City']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['Street']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['Zipcode']);
            
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Customer.xls"');
        $object_writer->save('php://output');
    }
}