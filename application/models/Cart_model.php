<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

 
 public function itemSave($array_data){

    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_cartmanager', $array_data);
    $last_id= $this->db->insert_id();

    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return $last_id;
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

  public function saveTolaterItem($array_data){
    $this->db->trans_begin(); 
    $this->db->insert('tbl_save_to_later', $array_data);
    $last_id= $this->db->insert_id();
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return $last_id;
    }
  } 

  public function getCartDetailByCartId($customer_id,$cart_id){
    $array_data=array();
    $this->db->select('*');
    $this->db->from('tbl_cartmanager');
    $this->db->where('user_id',$customer_id);
    $this->db->where('cart_id',$cart_id);
    $query=$this->db->get();
      if($query->num_rows()>0){
        $array_data=$query->row_array();
      }
    
    return $array_data;
  }

  public function getSaveDetailBySaveId($customer_id,$save_id){
    $array_data=array();
    $this->db->select('*');
    $this->db->from('tbl_save_to_later');
    $this->db->where('user_id',$customer_id);
    $this->db->where('id',$save_id);
    $query=$this->db->get();
      if($query->num_rows()>0){
        $array_data=$query->row_array();
      }
    
    return $array_data;
  }

 public function getCartItem($customer_id,$product_id,$item_id){
    $array_data=array();
    $this->db->select('*');
    $this->db->from('tbl_cartmanager');
    $this->db->where('user_id',$customer_id);
    $this->db->where('product_id',$product_id);
    $this->db->where('variant_id',$item_id);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->row_array();
    }
    
    return $array_data;
  }

  public function getProductBy($customer_id,$product_id,$variant_id,$qty){
      $array_data=array();
      $this->db->select('P.product_id,P.product_name,P.feature_img,PV.pack_size,PV.units,PV.price,PV.before_off_price,stock,PV.variant_id');
      $this->db->from('tbl_product AS P');
      $this->db->where('PV.variants_product_id',$product_id);
      $this->db->where('PV.variant_id',$variant_id);
      $this->db->join('tbl_product_variants AS PV', 'PV.variants_product_id = P.product_id');
      $query=$this->db->get();
      if($query->num_rows()>0){
        $array_data=$query->row_array();
        $array_data['cart_qty']=$qty;
        return array($array_data);
      }
    
    return $array_data;
  }

  public function getCartList($customer_id){
    
    $array_data=array();
    $this->db->select('P.product_id,P.product_name,P.feature_img,PV.pack_size,PV.units,PV.price,PV.before_off_price,stock,C.qty as cart_qty,C.cart_id,C.variant_id');
    $this->db->from('tbl_cartmanager AS C');
    $this->db->where('user_id',$customer_id);
    $this->db->join('tbl_product AS P', 'P.product_id = C.product_id');
    $this->db->join('tbl_product_variants AS PV', 'PV.variant_id = C.variant_id');
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    
    return $array_data;

  }

  public function getTotalAmountWithSaving($customer_id){
    $array_data=array('totalPrice'=>0,'saveTotalAmt'=>0);
    $this->db->select('P.product_id,P.product_name,P.feature_img,PV.pack_size,PV.units,PV.price,PV.before_off_price,stock,C.qty as cart_qty,C.cart_id,C.variant_id');
    $this->db->from('tbl_cartmanager AS C');
    $this->db->where('user_id',$customer_id);
    $this->db->join('tbl_product AS P', 'P.product_id = C.product_id');
    $this->db->join('tbl_product_variants AS PV', 'PV.variant_id = C.variant_id');
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
      foreach ($array_data as $iproduct) {  
        
        if($iproduct['before_off_price'] > $iproduct['price']){
          $saveTotalAmt=$saveTotalAmt+(($iproduct['cart_qty']*$iproduct['before_off_price'])-($iproduct['cart_qty']*$iproduct['price']));
        }
          $totalPrice=$totalPrice+($iproduct['cart_qty']*$iproduct['price']);
        }

        $array_data=array('totalPrice'=>$totalPrice,'saveTotalAmt'=>$saveTotalAmt);
    }
    
    return $array_data;

  }

  public function getSaveLaterProducts($customer_id){
    $array_data=array();
    $this->db->select('C.*,P.product_name,P.feature_img,PV.pack_size,PV.units,PV.price,PV.before_off_price');
    //$this->db->select('P.product_name,P.feature_img,P.product_id,P.slug');
    $this->db->from('tbl_save_to_later AS C');
    $this->db->where('user_id',$customer_id);
    $this->db->join('tbl_product AS P', 'P.product_id = C.product_id');
    $this->db->join('tbl_product_variants AS PV', 'PV.variant_id = C.variant_id');
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    
    return $array_data;

  }
  

public function getBeforeCheckout(){

    $array_data=array();
    $this->db->select('P.product_id,P.product_name,P.slug,P.feature_img,PWM.cat_id,PWM.sub_cat_id,PWM.child_cat_id');
    $this->db->from('tbl_mapping_category_with_product AS PWM');
    $this->db->join('tbl_product AS P', 'PWM.mapping_product_id = P.product_id');
    $this->db->where('P.status',1);
    $this->db->limit(5,0);
    $query=$this->db->get();
    if($query->num_rows()>0){

      $array_data=$query->result_array();
    }
    
    return $array_data;

  }

  

  public function deleteItemByCartId($customer_id,$cart_id){
    $this->db->where('user_id', $customer_id);
     $this->db->where('cart_id', $cart_id);
    $this->db->delete('tbl_cartmanager');
    return true;
  }

  public function deleteItemBySaveId($customer_id,$save_id){
    $this->db->where('user_id', $customer_id);
     $this->db->where('id', $save_id);
    $this->db->delete('tbl_save_to_later');
    return true;
  }


  
 
  public function getTimeSlot(){
    $this->db->select('*');
    $this->db->from('tbl_delivery_slot');
    $this->db->where('status',1);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    
    return $array_data;

  }

  public function getCouponList(){
    $array_data=array();
    $this->db->select('*');
    $this->db->from('tbl_coupon');
    $this->db->where('status',1);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->result_array();
    }
    
    return $array_data;

  }

  public function getCouponCodeDetail($code){
    $array_data=array();
    $this->db->select('*');
    $this->db->from('tbl_coupon');
    $this->db->where('status',1);
    $this->db->where('coupon_code',$code);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->row_array();
    }
    return $array_data;
  }
 
public function delete_address($addr_id) {
    $this->db->where('addr_id', $addr_id);
    return $this->db->delete('tbl_address');
}

public function cancelOrder($order_id) {
    $this->db->where('order_id ', $order_id);
    $update_data = array('order_status' => 'cancelled');

    if ($this->db->update('tbl_order_manager', $update_data)) {
        return true;
    } else {
        return false;
    }
}

public function get_address_by_id($addr_id) {
    $this->db->where('addr_id', $addr_id);
    $query = $this->db->get('tbl_address');
    return $query->row_array();
}

public function update_deliveryaddress($addr_id, $data) {
    $this->db->where('addr_id', $addr_id);
    return $this->db->update('tbl_address', $data);
}
 

}
?>