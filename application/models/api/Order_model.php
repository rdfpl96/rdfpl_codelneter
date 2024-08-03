<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }
   public function getProductItemByproductId($order_id){
    $array_data=array();
    $this->db->select('OI.*,CONCAT("'.base_url("uploads/").'",OI.cat_image) as imagepath');
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
        foreach($query->result_array() as $record){
          $record['order_items']=$this->getProductItemByproductId($record['id']);
          $array_data[]=$record;
        }
       
    }
    return $array_data;
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