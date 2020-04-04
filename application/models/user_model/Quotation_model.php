<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation_model extends CI_Model {
	private $table = 'quotation';
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

    public function getQuotation()
    {
        $this->db->select('q.*, c.name');
        $this->db->from(TB_QUOTATION.' q');
        $this->db->join(TB_CUSTOMER.' c','c.id = q.quotation_customer_name');
        $this->db->where('q.is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function getFilterQuotation($filter_data)
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
            $to_date = "AND i.quotation_date <= '".$filter_data['to_date']."' AND";
        }
        $query = $this->db->query('SELECT i.*, c.name FROM quotation as i join customer as c on c.id = i.quotation_customer_name where '.$customers.' i.quotation_date >= "'.$filter_data['from_date'].'" '.$to_date.' i.is_deleted = "0"');
        foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
    }

    public function quotationNo()
    {
        $query = $this->db->query('SELECT MAX(quotation_no) as quotation_no from quotation');
        foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
    }

    public function saveQuotationData($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function saveQuotationItemData($data, $item)
    {
        for ($i=0; $i < count($item); $i++) { 
            $query = $this->db->query('INSERT INTO quotation_item (quotation_id, quotation_item_name, quotation_item_hsn, quotation_item_qty, quotation_item_rate, quotation_item_discount, quotation_item_amount, quotation_tax_name, quotation_tax_amount, quotation_tax_total, quotation_sub_total, quotation_grand_total) VALUES("'.$data['quotation_id'].'","'.$data['quotation_item_name'][$i].'","'.$data['quotation_item_hsn'][$i].'","'.$data['quotation_item_qty'][$i].'","'.$data['quotation_item_rate'][$i].'","'.$data['quotation_item_discount'][$i].'","'.$data['quotation_item_amount'][$i].'","'.$data['quotation_tax_name'][$i].'","'.$data['quotation_tax_amount'][$i].'","'.$data['quotation_tax_total'][$i].'","'.$data['quotation_sub_total'][$i].'","'.$data['quotation_grand_total'][$i].'")');
        }
    }

    public function updateQuotationData($data) {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->table, $data);
    }

    public function updateQuotationItemData($data, $item)
    {
        for ($i=0; $i < count($item); $i++) { 
            $query = $this->db->query('UPDATE quotation_item 
                    SET
                        quotation_item_name = "'.$data['quotation_item_name'][$i].'",
                        quotation_item_hsn = "'.$data['quotation_item_hsn'][$i].'", 
                        quotation_item_qty = "'.$data['quotation_item_qty'][$i].'", 
                        quotation_item_rate = "'.$data['quotation_item_rate'][$i].'", 
                        quotation_item_discount = "'.$data['quotation_item_discount'][$i].'", 
                        quotation_item_amount = "'.$data['quotation_item_amount'][$i].'", 
                        quotation_tax_name = "'.$data['quotation_tax_name'][$i].'", 
                        quotation_tax_amount = "'.$data['quotation_tax_amount'][$i].'", 
                        quotation_tax_total = "'.$data['quotation_tax_total'][$i].'", 
                        quotation_sub_total = "'.$data['quotation_sub_total'][$i].'", 
                        quotation_grand_total = "'.$data['quotation_grand_total'][$i].'"
                    WHERE quotation_id = "'.$data['quotation_id'].'"
                    ');
        }
    }

    public function delete($id) {
        $this->db->query('UPDATE quotation set is_deleted = "1" where id = "'.$id.'"');
    }

    public function getInsertQuotation($id)
    {
        $this->db->select('q.*, qq.quotation_id, qq.quotation_item_name, qq.quotation_item_hsn, qq.quotation_item_qty, qq.quotation_item_rate, qq.quotation_item_discount, qq.quotation_item_amount, qq.quotation_tax_name, qq.quotation_tax_amount, c.name');
        $this->db->from(TB_QUOTATION.' q');
        $this->db->join(TB_QUOTATION_ITEM.' qq','q.id = qq.quotation_id');
        $this->db->join(TB_CUSTOMER.' c','c.id = q.quotation_customer_name');
        $this->db->where('q.id',$id);
        return $this->db->get('')->result_array();
    }
}
