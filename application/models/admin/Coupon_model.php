<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

  public function getProductList(){
      $array_data=array();
      $this->db->select('*');
      $this->db->from('tbl_product AS P');
      $this->db->where('status',1);
      $query=$this->db->get();
      if($query->num_rows()>0){

        $array_data=$query->result_array();
      }
    
    return $array_data;

  }
  
  public function chkUniqueCategoryName($name,$id=""){
    
    $this->db->select('*');
    $this->db->from('tbl_category');
    $this->db->where('category',$name);
    if($id!=""){
      $this->db->where('cat_id !=',$id); 
    }
    $query=$this->db->get() ; 

    if($query->num_rows()>0){ 
      return true;
    }else{
      return false; 
    }
      
  }

  public function chkUniqueCategoryURL($slug,$id=""){
      $this->db->select('*');
      $this->db->from('tbl_category');
      $this->db->where('slug',$slug);
      if($id!=""){
        $this->db->where('cat_id !=',$id); 
      }
      $query=$this->db->get() ; 

      if($query->num_rows()>0){ 
        return true;
      }else{
        return false; 
      }
  }

    public function record_count() {

    //  if($name!=''){
    //    $this->db->like('coupon_code',$name);
    //  }
     return $this->db->from("tbl_coupon")->count_all_results();    
   }
   





            
  

    // public function get_subcategories($start, $limit, $name) {
    //     $this->db->select('tbl_sub_category.*, tbl_category.category');
    //     $this->db->from('tbl_sub_category');
    //     $this->db->join('tbl_category', 'tbl_sub_category.sub_cat_id = tbl_category.cat_id');
    //     if ($name) {
    //         $this->db->like('tbl_sub_category.subCat_name', $name);
    //     }
    //     $this->db->limit($limit, $start);
    //     $query = $this->db->get();
    //     return $query->result_array(); // Ensuring the result is returned as an array
    // }



    public function get_all_coupons($limit, $start) {
      $this->db->limit($limit, $start);
      $this->db->order_by('add_date', 'DESC'); 
      $query = $this->db->get('tbl_coupon');
      return $query->result();
  }
  

    public function CheckCouponsPresentInOrderTable($coupon_id) {
      $this->db->where('coupon_id', $coupon_id);
      $query = $this->db->get('tbl_order');

      if($query->num_rows()>0){ 
        $flag=1;
      }else{
        $flag=0;
      }
      return $flag; 
    }


    public function store($data) {
        return $this->db->insert('tbl_coupon', $data);
    }


    // public function get_category_by_id($id) {
    //     $query = $this->db->get_where('tbl_category', array('cat_id' => $id));
    //     return $query->row();
    // }

    public function get_subcategory($id) {
        $this->db->where('sub_cat_id', $id);
        $query = $this->db->get('tbl_sub_category');
        return $query->row_array();
    }   

    // public function update_subcategory($id, $data) {
    //     $this->db->where('sub_cat_id', $id);
    //     $this->db->update('tbl_sub_category', $data);
    // }     

    // public function update_category($id, $data) {
    //     $this->db->where('cat_id', $id);
    //     if ($this->db->update('tbl_category', $data)) {
    //         return true; // Return true if data is updated successfully
    //     } else {
    //         return false; // Return false if data update fails
    //     }
    // }
 


   public function getViewByID($id){
    $array_record=array();      
    $this->db->select('*');
    $this->db->from('tbl_category');
    $this->db->where('cat_id',$id);
    $query=$this->db->get() ; 
    if($query->num_rows()>0){ 
      $array_record=$query->row_array();
    }
    return $array_record;   
  }




public function edit($id){
  $this->db->where('coupon_id',$id);
  $query=$this->db->get('tbl_coupon');
  return $query->row_array();

}


public function update_coupon($id, $data) {
  $this->db->where('coupon_id', $id);
  return $this->db->update('tbl_coupon', $data); 
}


public function deletecoupon($id){
  $this->db->where('coupon_id',$id);
  $this->db->delete('tbl_coupon',array('coupon_id' => $id));
  if ($this->db->affected_rows() > 0) {
    return true;
  } else {
    return false;
  }

}
  
public function getCouponSearchDetails($keywords  = '',)
{
    $this->db->select('*');
    $this->db->from('tbl_coupon');
    if (!empty($keywords)) {
        $this->db->like('coupon_code', $keywords);
        $this->db->or_like('disc_type', $keywords);
    }

    $this->db->limit(10, 0);
    $this->db->order_by('add_date', 'DESC');
    $query = $this->db->get();
    return $query->result();
}










  
}
?>