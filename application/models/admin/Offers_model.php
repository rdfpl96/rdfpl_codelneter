<?php

use Mpdf\Tag\Select;

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offers_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

  public function getProductList(){
      $array_data=array();
      $this->db->select('*');
      $this->db->from('tbl_product AS P');
      // $this->db->join()
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

public function record_count($name) {

    if($name!=''){
       $this->db->like('offer_type',$name);
    }
    return $this->db->from("offers")->count_all_results();    
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

    public function get_all_offers($limit, $start) {
    
      $this->db->select('offers.*, tbl_product.product_name, tbl_product_variants.pack_size, tbl_product_variants.units');
      $this->db->from('offers');
      $this->db->join('tbl_product', 'offers.product_id = tbl_product.product_id', 'left');
      $this->db->join('tbl_product_variants', 'offers.variant_id = tbl_product_variants.variant_id', 'left');
      // Uncomment the following line if you want to use pagination
      $this->db->limit($limit, $start);
      $query = $this->db->get();
      return $query->result_array();

  }



    public function get_variants($category_id) {
      $this->db->select('variant_id, pack_size, units');
      $this->db->from('tbl_product_variants');
      $this->db->where('variants_product_id',$category_id);
      $query=$this->db->get() ; 
      return $query->result_array();
    }





    public function get_coupon_count_category(){
      $this->db->select('COUNT(*) as total');
      $this->db->from('offers');
      $query = $this->db->get();
      $result = $query->row_array(); 
      return $result['total']; 
  }
  




    public function store($data) {
      // print_r($data);
      // die();
        return $this->db->insert('offers', $data);
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









public function get_offers_count(){

   $this->db->select('COUNT(*) as total');
   $this->db->from('offers');
   $query = $this->db->get();
   $result = $query->row_array();
   return $result['total'];


}



 public function delete_offer(){

   $this->db->where('id', $this->input->post('id'));
   if ($this->db->delete('offers')) {
       return true;
   } else {
       return false;
   }

 }




  public function getSearch_offerDetails($search) {
    // Build and execute the query
    $this->db->select('*');
    $this->db->from('offers');
    $this->db->like('description', $search);
    //  $this->db->like('offer_type', $search);
    $this->db->limit(10, 0);
    // $this->db->like('value', $search);
    $query = $this->db->get();

    // Fetch the result as an associative array
    return $query->result_array();
}

public function get_offer_by_id($id){
  $array_data=array();
  $this->db->select('*');
  $this->db->from('offers');
  $this->db->where('id',$id);
  $query=$this->db->get();
  if($query->num_rows()>0){
    $array_data=$query->result_array();
  }
  return $array_data;
}

public function get_variants_by_product_id($product_id) {
  $this->db->select('variant_id');
  $this->db->from('offers');
  $this->db->where('product_id', $product_id);
  $query = $this->db->get();
  return $query->result_array();
}


public function delete_offers($product_id_old) {

  $this->db->where_in('product_id', $product_id_old);

  if ($this->db->delete('offers')) {
      return true;
  } else {
      return false;
  }
}

}








?>