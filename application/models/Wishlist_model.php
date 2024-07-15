<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

 
// public function itemSave($array_data){
//     $this->db->trans_begin(); 
//     // product Insert
//     $this->db->insert('tbl_wishlist', $array_data);
//     $last_id= $this->db->insert_id();

//     if($this->db->trans_status() === FALSE){
//       $this->db->trans_rollback();
//       return false;
//     }else{
//       $this->db->trans_commit();  
//       return $last_id;
//     }
// }

  // public function chkItemAlreaddyPresent($product_id,$customer_id){
  //   $array_record=false;      
  //   $this->db->select('*');
  //   $this->db->from('tbl_wishlist');
  //   $this->db->where('cust_id',$customer_id);
  //   $this->db->where('product_id',$product_id);
  //   $query=$this->db->get() ; 
  //   if($query->num_rows()>0){ 
  //     $array_record=true;
  //   }
  //   return $array_record;   

  // }

   public function getWishList($customer_id){
    $array_data=array();
    $this->db->select('P.product_name,P.product_id,P.slug,P.feature_img,C.wishlist_id');
    $this->db->from('tbl_wishlist AS C');
    $this->db->where('cust_id',$customer_id);
    $this->db->join('tbl_product AS P', 'P.product_id = C.product_id');
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    
    return $array_data;

  }

public function deleteItemByWushlistId($customer_id,$wish_id){
    $this->db->where('cust_id', $customer_id);
     $this->db->where('wishlist_id', $wish_id);
    $this->db->delete('tbl_wishlist');
    return true;
}

public function chkItemAlreaddyPresent($product_id, $cust_id) {
    $query = $this->db->get_where('tbl_wishlist', ['product_id' => $product_id, 'cust_id' => $cust_id]);
    return $query->num_rows() > 0;
}

public function itemSave($data) {
    return $this->db->insert('tbl_wishlist', $data);
}

public function removeItem($data) {
    return $this->db->delete('tbl_wishlist', $data);
}


}
?>