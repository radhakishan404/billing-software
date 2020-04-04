<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Product_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists() 
    {
    	$data['total'] = $this->Product_model->get();
        $data['active'] = $this->Product_model->active();
        $data['quantity'] = $this->Product_model->quantity();
        $data['sale'] = $this->Product_model->sale();
        $data['purchase'] = $this->Product_model->purchase();
        $data['service'] = $this->Product_model->getService();
        $data['page_title'] = '<i class="fa fa-cubes"></i> Product';
        $data['middle_view'] = "user_master/product_list";
        $this->load->view('template/main_template',$data); 
    }

    public function add()
    {
        if($this->input->post())
        {   
            $this->form_validation->set_rules('name', 'Product Name', 'required');
            $this->form_validation->set_rules('hsn', 'HSN/SAC', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');
            $this->form_validation->set_rules('tax', 'Tax', 'required');
            $this->form_validation->set_rules('purchase', 'Purchase Price', 'required');
            $this->form_validation->set_rules('sale', 'Sale Price', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $data = array(
                    'name'          =>  $this->input->post('name'),
                    'quantity'      =>  $this->input->post('quantity'),
                    'purchase'      =>  $this->input->post('purchase'),
                    'sale'          =>  $this->input->post('sale'),
                    'description'   =>  $this->input->post('description'),
                    'hsn'           =>  $this->input->post('hsn'),
                    'tax'           =>  $this->input->post('tax'),
                    'status'        =>  $this->input->post('status'),
                    'added_on'      =>  date('Y-m-d H:i:s')
                );
                $insert = $this->security->xss_clean($data);
                $result = $this->Product_model->save($insert);
                $this->session->set_flashdata('success_message', 'Product <b><u>'.$this->input->post('name').'</u></b> added successfully');
                redirect(base_url('product/lists'));
            }
        }
        $data['service'] = $this->Product_model->getService();
        $data['page_title'] = '<i class="fa fa-cubes"></i> Product';
        $data['middle_view'] = "user_master/product_add";
        $this->load->view('template/main_template',$data); 
    }

    public function edit($id)
    {
        $data['id']=$id;
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Product Name', 'required');
            $this->form_validation->set_rules('hsn', 'HSN/SAC', 'required');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');
            $this->form_validation->set_rules('tax', 'Tax', 'required');
            $this->form_validation->set_rules('purchase', 'Purchase Price', 'required');
            $this->form_validation->set_rules('sale', 'Sale Price', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ($this->form_validation->run() === TRUE) 
            {
                $data = array(
                    'id'                =>  $id,
                    'name'              =>  $this->input->post('name'),
                    'quantity'          =>  $this->input->post('quantity'),
                    'purchase'          =>  $this->input->post('purchase'),
                    'sale'              =>  $this->input->post('sale'),
                    'description'       =>  $this->input->post('description'),
                    'hsn'               =>  $this->input->post('hsn'),
                    'tax'               =>  $this->input->post('tax'),
                    'status'            =>  $this->input->post('status'),
                    'update_on'         =>  date('Y-m-d H:i:s')
                    );

                $f_data_xss = $this->security->xss_clean($data);

                $this->Product_model->update($f_data_xss);
                $this->session->set_flashdata('success_message', 'Product <b><u>'.$this->input->post('name').'</u></b> update successfully');
                redirect(base_url() . "product/lists");
            }
        }

        $data['detail']=$this->Product_model->getProduct($id);
        $data['service'] = $this->Product_model->getService();
        $data['page_title'] = '<i class="fa fa-cubes"></i> Product';
        $data['middle_view'] = "user_master/product_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Product_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Product deleted successfully');
        redirect(base_url('product/lists'));
    }

    public function csv()
    {
        $table_name = 'product';

        $this->db->select('id, name, quantity, purchase, sale, description, added_on, update_on');
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

        $table_name = 'product';

        $this->db->select('');
        $this->db->from($table_name);
        $this->db->where('is_deleted','0');
        $this->db->where('status','1');
        $customer_data = $this->db->get()->result_array();

        $excel_row = 2;

        foreach($customer_data as $row)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['quantity']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['purchase']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['sale']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['description']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['added_on']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['update_on']);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Product.xls"');
        $object_writer->save('php://output');
    }
}