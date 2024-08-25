<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }
   public function getProductItemByproductId($order_id){
    $array_data=array();
    $this->db->select('OI.*,CONCAT("'.base_url("uploads/").'",OI.img) as imagepath');
    $this->db->from('tbl_order_item As OI');
    $this->db->where('order_id',$order_id);
    $query=$this->db->get();
    if($query->num_rows()>0){
        $array_data=$query->result_array();
    }
    return $array_data;

   }

  public function getAllOrder($start,$records_per_page,$customerId){
    $array_data=array();
    $this->db->select('*');
    $this->db->from('tbl_order AS O');
    $this->db->where('customer_id',$customerId);
    $this->db->limit($records_per_page,$start);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    return $array_data;
   }

   public function getAllOrder($start,$records_per_page,$customerId){
      $array_data=array();
      $this->db->select('*');
      $this->db->from('tbl_order AS O');
      $this->db->where('customer_id',$customerId);
      $this->db->limit($records_per_page,$start);
      $query=$this->db->get();
      if($query->num_rows()>0){
        $array_data=$query->result_array();
      }
      return $array_data;
   }


  public function getOrderItemByOrderId($order_id){
    $return=array();     
    $this->CI->db->select('OI.*,P.product_name');
    $this->CI->db->from('tbl_order_item AS OI');
    $this->CI->db->join('tbl_product AS P','OI.product_id=P.product_id');
    $this->CI->db->where('OI.order_id',$order_id);
    $this->CI->db->order_by('price','ASC');
    $query=$this->CI->db->get() ; 
    if($query->num_rows()>0) { 
      $return=$query->result_array();
    }
    return $return;   
   }  
  }

  public function getCouponList(){

    $currentdata=date('Y-m-d');
  
    $array_data=array();
    $this->db->select('coupon_id,coupon_code,description,end_date as expiry_date');
    $this->db->from('tbl_coupon');
    $this->db->where('status',1);
     $this->db->where('end_date >',$currentdata);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    return $array_data;

  }
 
}
?>