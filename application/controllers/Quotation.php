<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Quotation extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Quotation_model');
        $this->load->helper(array('date'));
        $this->load->library('form_validation');
    }

    public function lists()
    {
    	$data = array();
        
        if ($this->input->post()) 
        { 
            $filter_data = array(
                'from_date' => date('Y-m-d', strtotime($this->input->post('fromdate'))),
                'to_date' => date('Y-m-d', strtotime($this->input->post('todate'))),
                'customer' => $this->input->post('customer')
            );
            $data['from_date'] = $this->input->post('fromdate');
            $data['to_date'] = $this->input->post('todate');
            $data['customer_name'] = $this->input->post('customer');

            $data['quotation'] = $this->Quotation_model->getFilterQuotation($filter_data);

            $data['found'] = count($data['quotation']);
            $data['hideclass'] = 'hideclass';
        }
        else
        {
            $data['quotation'] = $this->Quotation_model->getQuotation();
        }

    	$data['customer'] = $this->Quotation_model->getCustomer();


        $data['service'] = $this->Quotation_model->getService();
    	$data['page_title'] = '<i class="fa fa-file-text"> </i> Quotaion';
        $data['middle_view'] = "add/quotation_list";
        $this->load->view('template/main_template',$data);
    }

    public function add()
    {
        $data['max_quotation_number'] = $this->Quotation_model->quotationNo();
        $data['customer'] = $this->Quotation_model->getCustomer();
        $data['service'] = $this->Quotation_model->getService();

        if ($this->input->post())
        {
            $this->form_validation->set_rules('quotation_customer_name', 'Quotation Name', 'required');
            $this->form_validation->set_rules('quotation_no', 'Quotation Number', 'required');
            $this->form_validation->set_rules('quotation_date', 'Quotation Date', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $date = date('Y-m-d', strtotime($this->input->post('quotation_date')));
                $quotation_data = array(
                    'quotation_no'        =>  $this->input->post('quotation_no'),
                    'quotation_date'      =>  $date,
                    'quotation_payment_method' => $this->input->post('quotation_payment_method'),
                    'quotation_customer_name' =>  $this->input->post('quotation_customer_name'),
                    'quotation_notes'     =>  $this->input->post('comments'),
                    'quotation_sub_total' =>  $this->input->post('subTotal'),
                    'quotation_tax_total' =>  $this->input->post('taxTotal'),
                    'quotation_grand_total'   =>  $this->input->post('grandTotal'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                );


                $insert_quotation_data = $this->security->xss_clean($quotation_data);
                $quotation_id = $this->Quotation_model->saveQuotationData($insert_quotation_data);

                if (count($quotation_id) > 0) 
                {
                    $quotation_item_data = array(
                        'quotation_id'        =>  $quotation_id,
                        'quotation_item_name' =>  $this->input->post('item_name'),
                        'quotation_item_hsn'  =>  $this->input->post('item_hsn'),
                        'quotation_item_qty' =>  $this->input->post('item_qty'),
                        'quotation_item_rate'  =>  $this->input->post('items_rate'),
                        'quotation_item_discount' =>  $this->input->post('items_discount'),
                        'quotation_item_amount'  =>  $this->input->post('items_amount'),
                        'quotation_tax_name' =>  $this->input->post('tax_list'),
                        'quotation_tax_amount'  =>  $this->input->post('taxAmount'),
                        'quotation_tax_total' =>  $this->input->post('taxTotal'),
                        'quotation_sub_total'  =>  $this->input->post('subTotal'),
                        'quotation_grand_total'  =>  $this->input->post('grandTotal')
                    );

                    $insert_quotation_item_data = $this->security->xss_clean($quotation_item_data);
                    $quotation_item = $this->Quotation_model->saveQuotationItemData($insert_quotation_item_data, $this->input->post('item_name'));

                    $this->session->set_flashdata('success_message', 'Quotation <b><u>'.$this->input->post('quotation_no').'</u></b> created successfully');
                    redirect(base_url('quotation/lists'));
                }
            }
        }

        $data['page_title'] = 'Quotation Add';
        $data['middle_view'] = "add/quotation_add";
        $this->load->view('template/main_template',$data);
    }

    public function edit($id)
    {
        $data['id'] = $id;
        $data['customer'] = $this->Quotation_model->getCustomer();
        $data['service'] = $this->Quotation_model->getService();
        $data['quotation'] = $this->Quotation_model->getInsertQuotation($id);

        if ($this->input->post()) 
        {
            $this->form_validation->set_rules('quotation_no', 'Quotation Number', 'required');
            $this->form_validation->set_rules('quotation_date', 'Quotation Date', 'required');
            $this->form_validation->set_rules('quotation_payment_method', 'Payment Method', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $date = date('Y-m-d', strtotime($this->input->post('quotation_date')));
                $quotation_update_data = array(
                    'id'                =>  $id,
                    'quotation_no'        =>  $this->input->post('quotation_no'),
                    'quotation_date'      =>  $date,
                    'quotation_payment_method' => $this->input->post('quotation_payment_method'),
                    'quotation_customer_name' =>  $this->input->post('quotation_customer_name'),
                    'quotation_notes'     =>  $this->input->post('comments'),
                    'quotation_sub_total' =>  $this->input->post('subTotal'),
                    'quotation_tax_total' =>  $this->input->post('taxTotal'),
                    'quotation_grand_total'   =>  $this->input->post('grandTotal'),
                    'update_on'          =>  date('Y-m-d H:i:s')
                );

                $update_quotation_data = $this->security->xss_clean($quotation_update_data);
                $quotation_id = $this->Quotation_model->updateQuotationData($update_quotation_data);

                $quotation_item_data = array(
                    'quotation_id'        =>  $id,
                    'quotation_item_name' =>  $this->input->post('item_name'),
                    'quotation_item_hsn'  =>  $this->input->post('item_hsn'),
                    'quotation_item_qty' =>  $this->input->post('item_qty'),
                    'quotation_item_rate'  =>  $this->input->post('items_rate'),
                    'quotation_item_discount' =>  $this->input->post('items_discount'),
                    'quotation_item_amount'  =>  $this->input->post('items_amount'),
                    'quotation_tax_name' =>  $this->input->post('tax_list'),
                    'quotation_tax_amount'  =>  $this->input->post('taxAmount'),
                    'quotation_tax_total' =>  $this->input->post('taxTotal'),
                    'quotation_sub_total'  =>  $this->input->post('subTotal'),
                    'quotation_grand_total'  =>  $this->input->post('grandTotal')
                );

                $update_quotation_item_data = $this->security->xss_clean($quotation_item_data);
                $quotation_item = $this->Quotation_model->updateQuotationItemData($update_quotation_item_data, $this->input->post('item_name'));

                $this->session->set_flashdata('success_message', 'Quotation <b><u>'.$this->input->post('quotation_no').'</u></b> updated successfully');
                redirect(base_url('quotation/lists'));
            }
        }

        $data['page_title'] = 'Quotation Edit';
        $data['middle_view'] = "add/quotation_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Quotation_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Quotation deleted successfully');
        redirect(base_url('quotation/lists'));
    }

    public function csv()
    {
        $table_name = 'quotation';

        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('is_deleted','0');
        $quotation = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('quotation_item');
        $quotation_item = $this->db->get()->result_array();


        foreach ($quotation as $key => $value) {
            foreach ($value as $v => $k) {
                $quotation_columns[] = $v;
            }
            break;
        }

        foreach ($quotation_item as $key2 => $value2) {
            foreach ($value2 as $v2 => $k2) {
                $quotation_item_columns[] = $v2;
            }
            break;
        }

        // echo "<pre>";print_r($quotation_item_columns);
        // die();

        $quotation_table_columns = $quotation_columns;
        $quotation_item_table_columns = $quotation_item_columns;

        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $column = 0;
        foreach($quotation_table_columns as $itc)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $itc);
            $column++;
        }

        // Rename sheet
        $object->setActiveSheetIndex()->setTitle("Quotation");

        // Add new sheet
        $objWorkSheet = $object->createSheet(1); //Setting index when creating

        $column2 = 0;
        foreach($quotation_item_table_columns as $iitc)
        {
            $objWorkSheet->setCellValueByColumnAndRow($column2, 1, $iitc);
            $column2++;
        }

        // Rename sheet
        $objWorkSheet->setTitle("Quotation Data");


        $this->db->select('i.*, c.name');
        $this->db->from('quotation'.' i');
        $this->db->join('customer'.' c','i.quotation_customer_name = c.id');
        $this->db->where('i.is_deleted','0');
        $quotation_data = $this->db->get()->result_array();

        $excel_row = 2;

        foreach($quotation_data as $row)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['quotation_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['quotation_date']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['quotation_payment_method']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['quotation_notes']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['quotation_sub_total']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['quotation_tax_total']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['quotation_grand_total']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['added_on']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['update_on']);
            $excel_row++;
        }

        $this->db->select('');
        $this->db->from('quotation_item');
        $quotation_data = $this->db->get()->result_array();

        $excel_row = 2;

        foreach($quotation_data as $row)
        {
            $objWorkSheet->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
            $objWorkSheet->setCellValueByColumnAndRow(1, $excel_row, $row['quotation_id']);
            $objWorkSheet->setCellValueByColumnAndRow(2, $excel_row, $row['quotation_item_name']);
            $objWorkSheet->setCellValueByColumnAndRow(3, $excel_row, $row['quotation_item_hsn']);
            $objWorkSheet->setCellValueByColumnAndRow(4, $excel_row, $row['quotation_item_qty']);
            $objWorkSheet->setCellValueByColumnAndRow(5, $excel_row, $row['quotation_item_rate']);
            $objWorkSheet->setCellValueByColumnAndRow(6, $excel_row, $row['quotation_item_discount']);
            $objWorkSheet->setCellValueByColumnAndRow(7, $excel_row, $row['quotation_item_amount']);
            $objWorkSheet->setCellValueByColumnAndRow(8, $excel_row, $row['quotation_tax_name']);
            $objWorkSheet->setCellValueByColumnAndRow(9, $excel_row, $row['quotation_tax_amount']);
            $objWorkSheet->setCellValueByColumnAndRow(10, $excel_row, $row['quotation_tax_total']);
            $objWorkSheet->setCellValueByColumnAndRow(11, $excel_row, $row['quotation_sub_total']);
            $objWorkSheet->setCellValueByColumnAndRow(12, $excel_row, $row['quotation_grand_total']);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Quotation.xls"');
        $object_writer->save('php://output');
    }

}