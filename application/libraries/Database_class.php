<?php

/*
 * Clas datbase_class
 * Author : Mohammed Umar
 * Created Date : 10-06-2013
 * Purpose : Handle all CRUD functionality of system.
 */

class database_Class 
{
    public $CI = "";
    
    function __construct() 
    {
        $this->CI =& get_instance();
        //$this->CI->load->library('database');
    }
    
    /*
     * select_record function accept 4 parameter .
     * $select= Parameter need to fetech.
     * $table= Name of table .
     * $orderby= Column name on basis of record ordered.
     * $order= Asc or desc order of record.
     */
    public function select_record($select = '*', $table = '', $orderby = '', $order = 'asc',$col='',$status='0') 
    {

        $this->CI->db->select($select);
        
        if($col !='')
        {
            $this->CI->db->where($col,$status);
        }
        
        if ($orderby != '') 
        {
            $this->CI->db->order_by($orderby, $order);
        }
        $query = $this->CI->db->get($table);
        return $query->result_array();
    }

    /*
     * select_single_record function accept 3 parameter .
     * $table= Name of table .
     * $column_id= Column name .
     * $order= Asc or desc order of record.
     */
    public function select_single_record($table,$column,$value,$order_by='',$order='asc',$select='*')
    {
       $this->CI->db->select($select);
       $this->CI->db->where($column,$value);
       if($order_by !='')
       {
       $this->CI->db->order_by($order_by,$order);   
       }
       $query=$this->CI->db->get($table);
       return $query->result_array();
    }  
    
    /*
     * insert record in table 
     * $data=Contain array on which index= name of column.
     * $table_name = Name of table.
     */
    
    public function insert_record($data, $table_name)
    { 
       $output = array();
        $affected_row=0;
        $this->CI->db->insert($table_name, $data);
        $affected_row = $this->CI->db->affected_rows();
        if ($affected_row > 0) {
            $output['last_inserted_id'] = $this->CI->db->insert_id();
        }
        $output['affected_row'] = $affected_row;

        return $output;
    }
    
    /*
     * update record of table.
     * $data=Contain array on which index= name of column.
     * $table_name = Name of table.
     * $id_name = Name of primary key or column name.
     * $id_value = Value of column for unique identification.
     */   
    
    public function update_record($data,$table_name,$id_value,$id_name)
    {
        $output = array();
        $affected_row=0;
        
        $this->CI->db->where($id_name, $id_value);
        $this->CI->db->update($table_name, $data); 
        
        $affected_row = $this->CI->db->affected_rows();
        
        $output['affected_row'] = $affected_row;

        return $output; 
    }
    
    /*
     * delete record in table 
     * $table_name = Name of table.
     * $id_name = Name of primary key or column name.
     * $id_value = Value of column for unique identification.
     */
    
    public function delete_record($id_name,$id_value,$table_name)
    {
        $this->CI->db->delete($table_name, array($id_name => $id_value)); 
    }

    /*
     * delete record in table 
     * $table_name = Name of table.
     * $id_name = Name of primary key or column name.
     * $id_value = Value of column for unique identification.
     */
    
    public function delete_record_arr($table_name,$condition)
    {
        $this->CI->db->delete($table_name, $condition); 
    }
    
    /*
     * Return last id inserted  in table.
     */
    
    public function last_insert_id()
    {
        return $this->CI->db->insert_id();
    }
    
    /*
     * Return count of row.
     */
    
    public function rows_count($table,$column,$value)
    {
        $this->CI->db->where(strtolower($column), strtolower($value));
        $this->CI->db->from($table);
        $count=$this->CI->db->count_all_results();
        return $count;
    }
    
    /*
     * Return email content.
     */
    
    public function email_content($mail_template_id,$language_id)
    {
        $this->CI->db->select('ec.subject,ec.content as body');
        $this->CI->db->where('language_id',$language_id);
        $this->CI->db->where('email_template_id',$mail_template_id);
        $this->CI->db->from(EMAIL_LANGUAGE_CONTENT.' ec');
        $query=$this->CI->db->get();
        return $query->result_array();
    }
      
    
}
