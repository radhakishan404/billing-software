<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {
	private $table = 'invoice';
	public function __construct() {
        $this->load->database();
    }

    public function getService()
    {
        $this->db->select('*');
        $this->db->from(TB_SERVICE);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        $this->db->order_by('filter');
        return $this->db->get('')->result_array();
    }

    public function getCustomer()
    {
    	$this->db->select('*');
        $this->db->from(TB_CUSTOMER);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function getInvoice()
    {
        $this->db->select('i.*, c.name');
        $this->db->from(TB_INVOICE.' i');
        $this->db->join(TB_CUSTOMER.' c','c.id = i.invoice_customer_name');
        $this->db->where('i.is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function getFilterInvoice($filter_data)
    {
        if($filter_data['customer'] == '')
        {
            $customers = "";
        }
        else
        {
            $customers = "c.id = '".$filter_data['customer']."' AND";
        }
        if($filter_data['to_date'] == '1970-01-01')
        {
            $to_date = "AND";
        }
        else
        {
            $to_date = "AND i.invoice_date <= '".$filter_data['to_date']."' AND";
        }
        $query = $this->db->query('SELECT i.*, c.name FROM invoice as i join customer as c on c.id = i.invoice_customer_name where '.$customers.' i.invoice_date >= "'.$filter_data['from_date'].'" '.$to_date.' i.is_deleted = "0"');
        foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
    }

    public function invoiceNo()
    {
        $query = $this->db->query('SELECT MAX(invoice_no) as invoice_no from invoice');
        foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
    }

    public function saveInvoiceData($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function saveInvoiceItemData($data, $item)
    {
        for ($i=0; $i < count($item); $i++) { 
            $query = $this->db->query('INSERT INTO invoice_item (invoice_id, invoice_item_name, invoice_item_hsn, invoice_item_qty, invoice_item_rate, invoice_item_discount, invoice_item_amount, invoice_tax_name, invoice_tax_amount, invoice_tax_total, invoice_sub_total, invoice_grand_total) VALUES("'.$data['invoice_id'].'","'.$data['invoice_item_name'][$i].'","'.$data['invoice_item_hsn'][$i].'","'.$data['invoice_item_qty'][$i].'","'.$data['invoice_item_rate'][$i].'","'.$data['invoice_item_discount'][$i].'","'.$data['invoice_item_amount'][$i].'","'.$data['invoice_tax_name'][$i].'","'.$data['invoice_tax_amount'][$i].'","'.$data['invoice_tax_total'][$i].'","'.$data['invoice_sub_total'][$i].'","'.$data['invoice_grand_total'][$i].'")');
        }
    }

    public function updateInvoiceData($data) {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->table, $data);
    }

    public function updateInvoiceItemData($data, $item)
    {
        for ($i=0; $i < count($item); $i++) { 
            $query = $this->db->query('UPDATE invoice_item 
                    SET
                        invoice_item_name = "'.$data['invoice_item_name'][$i].'",
                        invoice_item_hsn = "'.$data['invoice_item_hsn'][$i].'", 
                        invoice_item_qty = "'.$data['invoice_item_qty'][$i].'", 
                        invoice_item_rate = "'.$data['invoice_item_rate'][$i].'", 
                        invoice_item_discount = "'.$data['invoice_item_discount'][$i].'", 
                        invoice_item_amount = "'.$data['invoice_item_amount'][$i].'", 
                        invoice_tax_name = "'.$data['invoice_tax_name'][$i].'", 
                        invoice_tax_amount = "'.$data['invoice_tax_amount'][$i].'", 
                        invoice_tax_total = "'.$data['invoice_tax_total'][$i].'", 
                        invoice_sub_total = "'.$data['invoice_sub_total'][$i].'", 
                        invoice_grand_total = "'.$data['invoice_grand_total'][$i].'"
                    WHERE invoice_id = "'.$data['invoice_id'].'"
                    ');
        }
    }

    public function delete($id) {
        $this->db->query('UPDATE invoice set is_deleted = "1" where id = "'.$id.'"');
    }

    public function getInsertInvoice($id)
    {
        $this->db->select('i.*, ii.invoice_id, ii.invoice_item_name, ii.invoice_item_hsn, ii.invoice_item_qty, ii.invoice_item_rate, ii.invoice_item_discount, ii.invoice_item_amount, ii.invoice_tax_name, ii.invoice_tax_amount, c.name');
        $this->db->from(TB_INVOICE.' i');
        $this->db->join(TB_INVOICE_ITEM.' ii','i.id = ii.invoice_id');
        $this->db->join(TB_CUSTOMER.' c','c.id = i.invoice_customer_name');
        $this->db->where('i.id',$id);
        return $this->db->get('')->result_array();
    }
}
