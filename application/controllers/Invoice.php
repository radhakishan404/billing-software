<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Invoice extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Invoice_model');
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

            $data['invoice'] = $this->Invoice_model->getFilterInvoice($filter_data);
            // echo $this->db->last_query();
            // die();
            $data['hideclass'] = 'hideclass';
        }
        else
        {
            $data['invoice'] = $this->Invoice_model->getInvoice();
        }

        // var_dump($data['invoice']);
        // die();

    	$data['customer'] = $this->Invoice_model->getCustomer();


        $data['service'] = $this->Invoice_model->getService();
    	$data['page_title'] = '<i class="fa fa-file-archive-o"> </i> Invoice';
        $data['middle_view'] = "add/invoice_list";
        $this->load->view('template/main_template',$data);
    }

    public function add()
    {
        $data['max_invoice_number'] = $this->Invoice_model->invoiceNo();
        $data['customer'] = $this->Invoice_model->getCustomer();
        $data['service'] = $this->Invoice_model->getService();

        if ($this->input->post()) 
        {
            $this->form_validation->set_rules('invoice_no', 'Invoice Number', 'required');
            $this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required');
            $this->form_validation->set_rules('invoice_payment_method', 'Payment Method', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $date = date('Y-m-d', strtotime($this->input->post('invoice_date')));
                $invoice_data = array(
                    'invoice_no'            =>  $this->input->post('invoice_no'),
                    'invoice_date'          =>  $date,
                    'invoice_payment_method' => $this->input->post('invoice_payment_method'),
                    'invoice_customer_name' =>  $this->input->post('invoice_customer_name'),
                    'invoice_notes'         =>  $this->input->post('comments'),
                    'invoice_sub_total'     =>  $this->input->post('subTotal'),
                    'invoice_tax_total'     =>  $this->input->post('taxTotal'),
                    'invoice_grand_total'   =>  $this->input->post('grandTotal'),
                    'added_on'              =>  date('Y-m-d H:i:s')
                );


                $insert_invoice_data = $this->security->xss_clean($invoice_data);
                $invoice_id = $this->Invoice_model->saveInvoiceData($insert_invoice_data);

                if (count($invoice_id) > 0) 
                {
                    $invoice_item_data = array(
                        'invoice_id'        =>  $invoice_id,
                        'invoice_item_name' =>  $this->input->post('item_name'),
                        'invoice_item_hsn'  =>  $this->input->post('item_hsn'),
                        'invoice_item_qty' =>  $this->input->post('item_qty'),
                        'invoice_item_rate'  =>  $this->input->post('items_rate'),
                        'invoice_item_discount' =>  $this->input->post('items_discount'),
                        'invoice_item_amount'  =>  $this->input->post('items_amount'),
                        'invoice_tax_name' =>  $this->input->post('tax_list'),
                        'invoice_tax_amount'  =>  $this->input->post('taxAmount'),
                        'invoice_tax_total' =>  $this->input->post('taxTotal'),
                        'invoice_sub_total'  =>  $this->input->post('subTotal'),
                        'invoice_grand_total'  =>  $this->input->post('grandTotal')
                    );

                    $insert_invoice_item_data = $this->security->xss_clean($invoice_item_data);
                    $invoice_item = $this->Invoice_model->saveInvoiceItemData($insert_invoice_item_data, $this->input->post('item_name'));

                    $this->session->set_flashdata('success_message', 'Invoice <b><u>'.$this->input->post('invoice_no').'</u></b> created successfully');
                    redirect(base_url('invoice/lists'));
                }
            }
        }

        $data['page_title'] = '<i class="fa fa-file-archive-o"></i>Invoice';
        $data['middle_view'] = "add/invoice_add";
        $this->load->view('template/main_template',$data);
    }

    public function edit($id)
    {
        $data['id'] = $id;
        $data['customer'] = $this->Invoice_model->getCustomer();
        $data['service'] = $this->Invoice_model->getService();
        $data['invoice'] = $this->Invoice_model->getInsertInvoice($id);

        if ($this->input->post()) 
        {
            $this->form_validation->set_rules('invoice_no', 'Invoice Number', 'required');
            $this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required');
            $this->form_validation->set_rules('invoice_payment_method', 'Payment Method', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $date = date('Y-m-d', strtotime($this->input->post('invoice_date')));
                $invoice_update_data = array(
                    'id'                =>  $id,
                    'invoice_no'        =>  $this->input->post('invoice_no'),
                    'invoice_date'      =>  $date,
                    'invoice_payment_method' => $this->input->post('invoice_payment_method'),
                    'invoice_customer_name' =>  $this->input->post('invoice_customer_name'),
                    'invoice_notes'     =>  $this->input->post('comments'),
                    'invoice_sub_total' =>  $this->input->post('subTotal'),
                    'invoice_tax_total' =>  $this->input->post('taxTotal'),
                    'invoice_grand_total'   =>  $this->input->post('grandTotal'),
                    'update_on'          =>  date('Y-m-d H:i:s')
                );

                $update_invoice_data = $this->security->xss_clean($invoice_update_data);
                $invoice_id = $this->Invoice_model->updateInvoiceData($update_invoice_data);

                $invoice_item_data = array(
                    'invoice_id'        =>  $id,
                    'invoice_item_name' =>  $this->input->post('item_name'),
                    'invoice_item_hsn'  =>  $this->input->post('item_hsn'),
                    'invoice_item_qty' =>  $this->input->post('item_qty'),
                    'invoice_item_rate'  =>  $this->input->post('items_rate'),
                    'invoice_item_discount' =>  $this->input->post('items_discount'),
                    'invoice_item_amount'  =>  $this->input->post('items_amount'),
                    'invoice_tax_name' =>  $this->input->post('tax_list'),
                    'invoice_tax_amount'  =>  $this->input->post('taxAmount'),
                    'invoice_tax_total' =>  $this->input->post('taxTotal'),
                    'invoice_sub_total'  =>  $this->input->post('subTotal'),
                    'invoice_grand_total'  =>  $this->input->post('grandTotal')
                );

                $update_invoice_item_data = $this->security->xss_clean($invoice_item_data);
                $invoice_item = $this->Invoice_model->updateInvoiceItemData($update_invoice_item_data, $this->input->post('item_name'));

                $this->session->set_flashdata('success_message', 'Invoice <b><u>'.$this->input->post('invoice_no').'</u></b> updated successfully');
                redirect(base_url('invoice/lists'));
            }
        }

        $data['page_title'] = '<i class="fa fa-file-archive-o"></i>Invoice';
        $data['middle_view'] = "add/invoice_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Invoice_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Invoice deleted successfully');
        redirect(base_url('invoice/lists'));
    }

    public function csv()
    {
        $table_name = 'invoice';

        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where('is_deleted','0');
        $invoice = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('invoice_item');
        $invoice_item = $this->db->get()->result_array();


        foreach ($invoice as $key => $value) {
            foreach ($value as $v => $k) {
                $invoice_columns[] = $v;
            }
            break;
        }

        foreach ($invoice_item as $key2 => $value2) {
            foreach ($value2 as $v2 => $k2) {
                $invoice_item_columns[] = $v2;
            }
            break;
        }

        $invoice_table_columns = $invoice_columns;
        $invoice_item_table_columns = $invoice_item_columns;

        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $column = 0;
        foreach($invoice_table_columns as $itc)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $itc);
            $column++;
        }

        // Rename sheet
        $object->setActiveSheetIndex()->setTitle("Invoice");

        // Add new sheet
        $objWorkSheet = $object->createSheet(1); //Setting index when creating

        $column2 = 0;
        foreach($invoice_item_table_columns as $iitc)
        {
            $objWorkSheet->setCellValueByColumnAndRow($column2, 1, $iitc);
            $column2++;
        }

        // Rename sheet
        $objWorkSheet->setTitle("Invoice Data");


        $this->db->select('i.*, c.name');
        $this->db->from('invoice'.' i');
        $this->db->join('customer'.' c','i.invoice_customer_name = c.id');
        $this->db->where('i.is_deleted','0');
        $invoice_data = $this->db->get()->result_array();

        $excel_row = 2;

        foreach($invoice_data as $row)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['invoice_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['invoice_date']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['invoice_payment_method']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['invoice_notes']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['invoice_sub_total']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['invoice_tax_total']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['invoice_grand_total']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['added_on']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['update_on']);
            $excel_row++;
        }

        $this->db->select('');
        $this->db->from('invoice_item');
        $invoice_data = $this->db->get()->result_array();

        $excel_row = 2;

        foreach($invoice_data as $row)
        {
            $objWorkSheet->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
            $objWorkSheet->setCellValueByColumnAndRow(1, $excel_row, $row['invoice_id']);
            $objWorkSheet->setCellValueByColumnAndRow(2, $excel_row, $row['invoice_item_name']);
            $objWorkSheet->setCellValueByColumnAndRow(3, $excel_row, $row['invoice_item_hsn']);
            $objWorkSheet->setCellValueByColumnAndRow(4, $excel_row, $row['invoice_item_qty']);
            $objWorkSheet->setCellValueByColumnAndRow(5, $excel_row, $row['invoice_item_rate']);
            $objWorkSheet->setCellValueByColumnAndRow(6, $excel_row, $row['invoice_item_discount']);
            $objWorkSheet->setCellValueByColumnAndRow(7, $excel_row, $row['invoice_item_amount']);
            $objWorkSheet->setCellValueByColumnAndRow(8, $excel_row, $row['invoice_tax_name']);
            $objWorkSheet->setCellValueByColumnAndRow(9, $excel_row, $row['invoice_tax_amount']);
            $objWorkSheet->setCellValueByColumnAndRow(10, $excel_row, $row['invoice_tax_total']);
            $objWorkSheet->setCellValueByColumnAndRow(11, $excel_row, $row['invoice_sub_total']);
            $objWorkSheet->setCellValueByColumnAndRow(12, $excel_row, $row['invoice_grand_total']);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Invoice.xls"');
        $object_writer->save('php://output');
    }
}