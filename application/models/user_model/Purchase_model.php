<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends CI_Model {
	private $table = 'purchase';
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

    public function getSupplier()
    {
    	$this->db->select('*');
        $this->db->from(TB_SUPPLIER);
        $this->db->where('status','1');
        $this->db->where('is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function getPurchase()
    {
        $this->db->select('i.*, c.name');
        $this->db->from(TB_PURCHASE.' i');
        $this->db->join(TB_SUPPLIER.' c','c.id = i.purchase_supplier_name');
        $this->db->where('i.is_deleted','0');
        return $this->db->get('')->result_array();
    }

    public function getFilterPurchase($filter_data)
    {
        if($filter_data['supplier'] == '')
        {
            $suppliers = "";
        }
        else
        {
            $suppliers = "c.id = '".$filter_data['supplier']."' AND";
        }
        if($filter_data['to_date'] == '1970-01-01')
        {
            $to_date = "AND";
        }
        else
        {
            $to_date = "AND i.purchase_date <= '".$filter_data['to_date']."' AND";
        }
        $query = $this->db->query('SELECT i.*, c.name FROM purchase as i join supplier as c on c.id = i.purchase_supplier_name where '.$suppliers.' i.purchase_date >= "'.$filter_data['from_date'].'" '.$to_date.' i.is_deleted = "0"');
        foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
    }

    public function purchaseNo()
    {
        $query = $this->db->query('SELECT MAX(purchase_no) as purchase_no from purchase');
        foreach ($query->result_array() as $row) {
            $datas[] = $row;
        }
        return $datas;
    }

    public function savePurchaseData($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function savePurchaseItemData($data, $item)
    {
        for ($i=0; $i < count($item); $i++) { 
            $query = $this->db->query('INSERT INTO purchase_item (purchase_id, purchase_item_name, purchase_item_hsn, purchase_item_qty, purchase_item_rate, purchase_item_discount, purchase_item_amount, purchase_tax_name, purchase_tax_amount, purchase_tax_total, purchase_sub_total, purchase_grand_total) VALUES("'.$data['purchase_id'].'","'.$data['purchase_item_name'][$i].'","'.$data['purchase_item_hsn'][$i].'","'.$data['purchase_item_qty'][$i].'","'.$data['purchase_item_rate'][$i].'","'.$data['purchase_item_discount'][$i].'","'.$data['purchase_item_amount'][$i].'","'.$data['purchase_tax_name'][$i].'","'.$data['purchase_tax_amount'][$i].'","'.$data['purchase_tax_total'][$i].'","'.$data['purchase_sub_total'][$i].'","'.$data['purchase_grand_total'][$i].'")');
        }
    }

    public function updatePurchaseData($data) {
        $this->db->where('id', $data['id']);
        unset($data['id']);
        $this->db->update($this->table, $data);
    }

    public function updatePurchaseItemData($data, $item)
    {
        for ($i=0; $i < count($item); $i++) { 
            $query = $this->db->query('UPDATE purchase_item 
                    SET
                        purchase_item_name = "'.$data['purchase_item_name'][$i].'",
                        purchase_item_hsn = "'.$data['purchase_item_hsn'][$i].'", 
                        purchase_item_qty = "'.$data['purchase_item_qty'][$i].'", 
                        purchase_item_rate = "'.$data['purchase_item_rate'][$i].'", 
                        purchase_item_discount = "'.$data['purchase_item_discount'][$i].'", 
                        purchase_item_amount = "'.$data['purchase_item_amount'][$i].'", 
                        purchase_tax_name = "'.$data['purchase_tax_name'][$i].'", 
                        purchase_tax_amount = "'.$data['purchase_tax_amount'][$i].'", 
                        purchase_tax_total = "'.$data['purchase_tax_total'][$i].'", 
                        purchase_sub_total = "'.$data['purchase_sub_total'][$i].'", 
                        purchase_grand_total = "'.$data['purchase_grand_total'][$i].'"
                    WHERE purchase_id = "'.$data['purchase_id'].'"
                    ');
        }
    }

    public function delete($id) {
        $this->db->query('UPDATE purchase_id set is_deleted = "1" where id = "'.$id.'"');
    }

    public function getInsertPurchase($id)
    {
        $this->db->select('i.*, ii.purchase_id, ii.purchase_item_name, ii.purchase_item_hsn, ii.purchase_item_qty, ii.purchase_item_rate, ii.purchase_item_discount, ii.purchase_item_amount, ii.purchase_tax_name, ii.purchase_tax_amount, c.name');
        $this->db->from(TB_PURCHASE.' i');
        $this->db->join(TB_PURCHASE_ITEM.' ii','i.id = ii.purchase_id');
        $this->db->join(TB_SUPPLIER.' c','c.id = i.purchase_supplier_name');
        $this->db->where('i.id',$id);
        return $this->db->get('')->result_array();
    }
}
