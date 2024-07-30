<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }


public function getAddressList($customer_id){
    $return_data=array();
    $this->db->select('*');
    $this->db->from('tbl_address');
    $this->db->where('customer_id',$customer_id);
    $query=$this->db->get() ;
    if($query->num_rows()>0){ 
     $return_data=$query->result_array();
    }
    return $return_data;
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
 
 public function chkAlreadyAdressExist($pincode,$apart_house,$customerId){
      $this->db->select('*');
      $this->db->from('tbl_address');
      $this->db->where('address1',$apart_house);
      $this->db->where('customer_id',$customerId);
      $this->db->where('pincode',$pincode);
      $this->db->where('status',1);
      $query=$this->db->get() ;
      if($query->num_rows()>0){ 
       return true;
      }else{
          return false;
      }

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

 public function addressSave($array_data){

    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_address', $array_data);
    $last_id= $this->db->insert_id();

    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return $last_id;
    }

  }

public function setDefaultAddressByCust($address_id,$customer_id){

    $this->db->trans_begin(); 

    $this->db->where('customer_id', $customer_id); 
    $this->db->update('tbl_address', array('setAddressDefault'=>0));
    //
    $this->db->where('customer_id', $customer_id); 
    $this->db->where('addr_id', $address_id); 
    $this->db->update('tbl_address', array('setAddressDefault'=>1));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    } 

}

public function updateItemQty($customer_id,$product_id,$item_id,$array_data){

    $this->db->trans_begin(); 

    $this->db->where('product_id', $product_id);
    $this->db->where('user_id', $customer_id); 
    $this->db->where('variant_id', $item_id);      
    $this->db->update('tbl_cartmanager', $array_data);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    } 
  }

  public function updateCustomerGst($nv) {
    $this->db->where('customer_id', $nv['customer_id']);
    return $this->db->update('tbl_gst', $nv);
}

public function getAllSlot(){
  $this->db->select('day_type as day_type_id, start_time,end_time');
    $this->db->from('tbl_delivery_slot');
    $this->db->where('status',1);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    
    return $array_data;
}

public function getStateList(){
  $this->db->select('id,name');
    $this->db->from('states');
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    
    return $array_data;
}

}
?>