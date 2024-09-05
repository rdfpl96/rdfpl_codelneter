<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }



public function orderExist($order_no){
  $this->db->select('*');
  $this->db->from('tbl_order');
  $this->db->where('order_no',$order_no);
  $query=$this->db->get() ;
  if($query->num_rows()>0){ 
   return true;
  }else{
    return false;
  }
}
 
public function orderSave($array_order,$produsts){

    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_order', $array_order);
    $last_id= $this->db->insert_id();

    $item_array=array();

    foreach($produsts as $produst){
      $item_array[]=array(
        'order_id'=>$last_id,
        'product_id'=>$produst['product_id'],
        'item_id'=>$produst['variant_id'],
        "price"=>$produst['price'],
        "mrp_price"=>$produst['before_off_price'],
        "qty"=>$produst['cart_qty'],
        "pack_size"=>$produst['pack_size'],
        "units"=>$produst['units'],
        "img"=>$produst['feature_img'],
      );
    }

    $this->db->insert_batch('tbl_order_item',$item_array);
    //
    $this->db->where('user_id', $array_order['customer_id']);
    $this->db->delete('tbl_cartmanager'); 
    //
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return true;
    }

  }

public function insertPaymentResp($array_order){
    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_payment', $array_order);
   
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


  
 

}
?>