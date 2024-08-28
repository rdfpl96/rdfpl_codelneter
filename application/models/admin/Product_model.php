<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

  public function getProductIdByName($name){
    $this->db->select('product_id');
    $this->db->from('tbl_product');
    $this->db->where('product_name',$name);
    $query=$this->db->get() ; 
    if($query->num_rows()>0){ 
       $return=$query->row()->product_id;
    }else{
      $return= false; 
    }
    return $return;
  }

  public function checkItemCodeExist($item_code){
    $this->db->select('*');
    $this->db->from('tbl_product_variants');
    $this->db->where('item_code',$item_code);
    $query=$this->db->get() ; 
    if($query->num_rows()>0){ 
       return true;
    }else{
      return false; 
    }
  }

  public function getProductList($per_page,$limit_per_page,$sub_cat_id){
      $array_data=array();
      $this->db->select('P.*,C.cat_id,C.sub_cat_id,C.child_cat_id');
      $this->db->from('tbl_product AS P');
      $this->db->join('tbl_mapping_category_with_product AS C', 'C.mapping_product_id = P.product_id');
      $query=$this->db->get();
      if($query->num_rows()>0){

        $array_data=$query->result_array();
      }
    
    return $array_data;

  }
  
  public function chkUniqueProductName($name,$id=""){
    
    $this->db->select('*');
    $this->db->from('tbl_product');
    $this->db->where('product_name',$name);
    if($id!=""){
      $this->db->where('product_id !=',$id); 
    }
    $query=$this->db->get() ; 

    if($query->num_rows()>0){ 
      return true;
    }else{
      return false; 
    }
      
  }

  public function chkUniqueProductURL($slug,$id=""){
      $this->db->select('*');
      $this->db->from('tbl_product');
      $this->db->where('slug',$slug);
      if($id!=""){
        $this->db->where('product_id !=',$id); 
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
       $this->db->like('product_name',$name);
    }
    return $this->db->from("tbl_product")->count_all_results();    
  } 

            
  public function getList($start,$records_per_page,$name){
    $array_record=array();     
    $this->db->select('P.*');
    $this->db->from('tbl_product AS P');
    if($name!=''){
       $this->db->like('P.product_name',$name);
    }
   
    $this->db->limit($records_per_page,$start);
    $this->db->order_by("add_date", "desc");
    $query=$this->db->get() ; 
    if($query->num_rows()>0){
    
        $array_record=$query->result_array();
      
    }
    return $array_record;    
  }

  public function add($array_data){

    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_product', $array_data);
    $last_id= $this->db->insert_id();

    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return $last_id;
    }
  }
  
  public function updateItemDetailByItecode($array_data,$item_code){
    $this->db->trans_begin(); 
      $this->db->where('item_code', $item_code);     
      $this->db->update('tbl_product_variants', $array_data);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return false;
      }else{
        $this->db->trans_commit();
        return true;
      } 
    
  }


  public function insertItemDetail($array_data){

    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_product_variants', $array_data);
    $last_id= $this->db->insert_id();
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return $last_id;
    }
  }


  public function Edit($id,$array_data){
    $this->db->trans_begin(); 
    $this->db->where('product_id', $id);     
    $this->db->update('tbl_product', $array_data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      return true;
    } 
  } 


   public function getViewByID($id){
    $array_record=array();      
    $this->db->select('*');
    $this->db->from('tbl_product');
    $this->db->where('product_id',$id);
    $query=$this->db->get() ; 
    if($query->num_rows()>0){ 
      $array_record=$query->row_array();
    }
    return $array_record;   
  }

  public function getProductWithVariants($start, $records_per_page, $name) {
    $this->db->select('p.product_name, p.feature_img, v.pack_size, v.price, v.units');
    $this->db->from('tbl_product p');
    $this->db->join('tbl_product_variants v', 'p.product_id = v.variants_product_id');

  
    if (!empty($name)) {
        $this->db->like('p.product_name', $name);
    }

    
    $this->db->limit($records_per_page, $start);

    $query = $this->db->get();
    return $query->result_array();
}



  public function searchProducts($start, $records_per_page, $search_term) {
    // Clean the search term to prevent SQL injection
    $search_term = $this->db->escape_like_str($search_term);

    // Build the query
    $this->db->select('p.product_name, p.feature_img, v.pack_size, v.price, v.units');
    $this->db->from('tbl_product p');
    $this->db->join('tbl_product_variants v', 'p.product_id = v.variants_product_id');
    $this->db->like('p.product_name', $search_term);
    $this->db->limit($records_per_page, $start);
    $query = $this->db->get();

    // Return the result as an array
    return $query->result_array();
}

  


}
?>