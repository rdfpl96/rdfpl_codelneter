<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

public function insert_address($data) {
    $insert = $this->db->insert('tbl_address', $data);
    if (!$insert) {
        log_message('error', 'Database error: ' . $this->db->_error_message());
    }
    return $insert;
}
public function getSliderbanner(){
    $array_res=array();
    $this->db->select('mobile_image,text1');
    $this->db->from('tbl_banner');
    $this->db->where('status',1);
    // $this->db->order_by('order_no','ASC');   
    $query=$this->db->get() ; 
    if($query->num_rows()>0){ 
        
        foreach ($query->result_array() as $record){
           $array_data['mobile_image']=base_url('uploads/banner/'.$record['mobile_image']);
           $array_data['title']=$record['text1'];
           $array_res[]=$array_data;
        }
    }
    return $array_res;
}

public function insert_contact($data) {
        return $this->db->insert('contact_us', $data);
    }
public function insert_user_details($data) {
    return $this->db->insert('tbl_cust_email', $data);
}

public function get_email_addresses($customer_id) {
    $this->db->where('customer_id', $customer_id);
    $query = $this->db->get('tbl_cust_email');
    return $query->result();
}

public function delete_user_details($id) {
    $this->db->where('id', $id);
    return $this->db->delete('tbl_cust_email');
} 

public function check_existing_email($customer_id, $email) {
    $this->db->where('customer_id', $customer_id);
    $this->db->where('email', $email);
    $query = $this->db->get('tbl_cust_email'); // Adjust the table name if necessary
    return $query->num_rows() > 0;
}

 public function getCustomerOrders($customer_id) {
        $query = "
            SELECT o.*, i.*, a.* 
            FROM tbl_order o
            LEFT JOIN tbl_order_item i ON o.id = i.order_id
            LEFT JOIN tbl_address a ON o.address_id = a.addr_id
            WHERE o.customer_id = $customer_id
            ORDER BY o.id DESC
        ";

        $result = $this->db->query($query);
        
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return array();
        }
    }
    
    public function isGstNumberUnigue($gst_no){
        $this->db->select('*');
        $this->db->from('tbl_gst');
        $this->db->where('registration_no',$gst_no);
        $query=$this->db->get() ;
        if($query->num_rows()>0){ 
         return true;
        }else{
          return false;
        }
      }   
      
    public function chkGSTPresent($customer_id){
        $this->db->select('*');
        $this->db->from('tbl_gst');
        $this->db->where('customer_id',$customer_id);
        $query=$this->db->get() ;
        if($query->num_rows()>0){ 
         return true;
        }else{
          return false;
        }
    } 
    
    public function updateCustomerGst($nv) {
        $this->db->where('customer_id', $nv['customer_id']);
        return $this->db->update('tbl_gst', $nv);
    }

    public function saveCustomerGst($array_data){
        $this->db->trans_begin(); 
        // product Insert
        $this->db->insert('tbl_gst', $array_data);
        $last_id= $this->db->insert_id();
    
        
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return false;
        }else{
          $this->db->trans_commit();
          
          return $last_id;
        }
    
    }

    public function getOrderDetailsFun($order_no) {
        $this->db->select('o.id, o.order_id, o.product_id, o.price, o.mrp_price, o.qty, p.product_name, p.feature_img, ord.order_no, ord.customer_id, ord.delivery_date');
        $this->db->from('tbl_order_item o');
        $this->db->join('tbl_product p', 'o.product_id = p.product_id');
        $this->db->join('tbl_order ord', 'o.order_id = ord.id');
        $this->db->where('ord.order_no', $order_no);
        $query = $this->db->get();
        return $query->result_array();
    }
  
}
?>