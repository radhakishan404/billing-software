<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Purchase extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model/Purchase_model');
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
                'supplier' => $this->input->post('supplier')
            );
            $data['from_date'] = $this->input->post('fromdate');
            $data['to_date'] = $this->input->post('todate');
            $data['supplier_name'] = $this->input->post('supplier');

            $data['purchase'] = $this->Purchase_model->getFilterPurchase($filter_data);

            $data['found'] = count($data['purchase']);
            // var_dump($data['found']);
            // die();
            $data['hideclass'] = 'hideclass';
        }
        else
        {
            $data['purchase'] = $this->Purchase_model->getPurchase();
        }

    	$data['supplier'] = $this->Purchase_model->getSupplier();


        $data['service'] = $this->Purchase_model->getService();
    	$data['page_title'] = 'Purchase';
        $data['middle_view'] = "add/purchase_list";
        $this->load->view('template/main_template',$data);
    }

    public function add()
    {
        $data['max_purchase_number'] = $this->Purchase_model->purchaseNo();
        $data['supplier'] = $this->Purchase_model->getSupplier();
        $data['service'] = $this->Purchase_model->getService();

        if ($this->input->post()) 
        {
            $this->form_validation->set_rules('purchase_no', 'Purchase Number', 'required');
            $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
            $this->form_validation->set_rules('purchase_payment_method', 'Payment Method', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $date = date('Y-m-d', strtotime($this->input->post('purchase_date')));
                $purchase_data = array(
                    'purchase_no'        =>  $this->input->post('purchase_no'),
                    'purchase_date'      =>  $date,
                    'purchase_payment_method' => $this->input->post('purchase_payment_method'),
                    'purchase_supplier_name' =>  $this->input->post('purchase_supplier_name'),
                    'purchase_notes'     =>  $this->input->post('comments'),
                    'purchase_sub_total' =>  $this->input->post('subTotal'),
                    'purchase_tax_total' =>  $this->input->post('taxTotal'),
                    'purchase_grand_total'   =>  $this->input->post('grandTotal'),
                    'added_on'          =>  date('Y-m-d H:i:s')
                );


                $insert_purchase_data = $this->security->xss_clean($purchase_data);
                $purchase_id = $this->Purchase_model->savePurchaseData($insert_purchase_data);

                if (count($purchase_id) > 0) 
                {
                    $purchase_item_data = array(
                        'purchase_id'        =>  $purchase_id,
                        'purchase_item_name' =>  $this->input->post('item_name'),
                        'purchase_item_hsn'  =>  $this->input->post('item_hsn'),
                        'purchase_item_qty' =>  $this->input->post('item_qty'),
                        'purchase_item_rate'  =>  $this->input->post('items_rate'),
                        'purchase_item_discount' =>  $this->input->post('items_discount'),
                        'purchase_item_amount'  =>  $this->input->post('items_amount'),
                        'purchase_tax_name' =>  $this->input->post('tax_list'),
                        'purchase_tax_amount'  =>  $this->input->post('taxAmount'),
                        'purchase_tax_total' =>  $this->input->post('taxTotal'),
                        'purchase_sub_total'  =>  $this->input->post('subTotal'),
                        'purchase_grand_total'  =>  $this->input->post('grandTotal')
                    );

                    $insert_purchase_item_data = $this->security->xss_clean($purchase_item_data);
                    $purchase_item = $this->Purchase_model->savePurchaseItemData($insert_purchase_item_data, $this->input->post('item_name'));

                    $this->session->set_flashdata('success_message', 'Purchase <b><u>'.$this->input->post('purchase_no').'</u></b> created successfully');
                    redirect(base_url('purchase/lists'));
                }
            }
        }

        $data['page_title'] = 'Purchase';
        $data['middle_view'] = "add/purchase_add";
        $this->load->view('template/main_template',$data);
    }

    public function edit($id)
    {
        $data['id'] = $id;
        $data['supplier'] = $this->Purchase_model->getSupplier();
        $data['service'] = $this->Purchase_model->getService();
        $data['purchase'] = $this->Purchase_model->getInsertPurchase($id);

        if ($this->input->post()) 
        {
            $this->form_validation->set_rules('purchase_no', 'Purchase Number', 'required');
            $this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
            $this->form_validation->set_rules('purchase_payment_method', 'Payment Method', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            if ($this->form_validation->run() === TRUE) 
            {
                $date = date('Y-m-d', strtotime($this->input->post('purchase_date')));
                $purchase_update_data = array(
                    'id'                =>  $id,
                    'purchase_no'        =>  $this->input->post('purchase_no'),
                    'purchase_date'      =>  $date,
                    'purchase_payment_method' => $this->input->post('purchase_payment_method'),
                    'purchase_supplier_name' =>  $this->input->post('purchase_supplier_name'),
                    'purchase_notes'     =>  $this->input->post('comments'),
                    'purchase_sub_total' =>  $this->input->post('subTotal'),
                    'purchase_tax_total' =>  $this->input->post('taxTotal'),
                    'purchase_grand_total'   =>  $this->input->post('grandTotal'),
                    'update_on'          =>  date('Y-m-d H:i:s')
                );

                $update_purchase_data = $this->security->xss_clean($purchase_update_data);
                $purchase_id = $this->Purchase_model->updatePurchaseData($update_purchase_data);

                $purchase_item_data = array(
                    'purchase_id'        =>  $id,
                    'purchase_item_name' =>  $this->input->post('item_name'),
                    'purchase_item_hsn'  =>  $this->input->post('item_hsn'),
                    'purchase_item_qty' =>  $this->input->post('item_qty'),
                    'purchase_item_rate'  =>  $this->input->post('items_rate'),
                    'purchase_item_discount' =>  $this->input->post('items_discount'),
                    'purchase_item_amount'  =>  $this->input->post('items_amount'),
                    'purchase_tax_name' =>  $this->input->post('tax_list'),
                    'purchase_tax_amount'  =>  $this->input->post('taxAmount'),
                    'purchase_tax_total' =>  $this->input->post('taxTotal'),
                    'purchase_sub_total'  =>  $this->input->post('subTotal'),
                    'purchase_grand_total'  =>  $this->input->post('grandTotal')
                );

                $update_purchase_item_data = $this->security->xss_clean($purchase_item_data);
                $purchase_item = $this->Purchase_model->updatePurchaseItemData($update_purchase_item_data, $this->input->post('item_name'));

                $this->session->set_flashdata('success_message', 'Purchase <b><u>'.$this->input->post('purchase_no').'</u></b> updated successfully');
                redirect(base_url('purchase/lists'));
            }
        }

        $data['page_title'] = 'Purchase';
        $data['middle_view'] = "add/purchase_edit";
        $this->load->view('template/main_template',$data);
    }

    public function delete($id)
    {
        $this->Purchase_model->delete($id);
        $this->session->set_flashdata('delete_message', 'Purchase deleted successfully');
        redirect(base_url('purchase/lists'));
    }
}