<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

  public function getTopCategory(){
    $array_data=array();
    $this->db->select('C.category as name,C.cat_id,CONCAT("'.base_url("uploads/").'",C.cat_image) as imagepath');
    $this->db->from('tbl_category AS C');
    $this->db->where('C.status',1);
    $this->db->order_by('C.position','DESC');
    $query=$this->db->get();
    if($query->num_rows()>0){
        $array_data=$query->result_array();
    }
    return $array_data;

  }

  public function getItemDetailByProductAndItemId($productId,$itemId){
    $array_data=array();
    $this->db->select('*');
    $this->db->from('tbl_product_variants');
    // $this->db->where('status',1);
    $this->db->where('variants_product_id',$productId);
    $this->db->where('variant_id',$itemId);
    $query=$this->db->get();
    if($query->num_rows()>0){
      $array_data=$query->row_array();
    }
    
    return $array_data;
  } 


            
 public function getOtherProductById($product_type_id){
   $array_data=array();
    $this->db->select('P.product_id,P.product_name,P.slug,P.feature_img, CONCAT("'.base_url("uploads/").'",P.feature_img) as imagepath');
    $this->db->from('tbl_other_product AS OP');
    $this->db->where('P.status',1);
    $this->db->where('OP.product_type_id',$product_type_id);
    $this->db->join('tbl_product AS P', 'P.product_id = OP.product_id');
    $query=$this->db->get();
    if($query->num_rows()>0){
        $array_data=$query->result_array();
    }
    return $array_data;
  }

  public function getProdcutListBySubcategory($per_page,$limit_per_page,$sub_cat_id){
    $array_data=array();
    $this->db->select('P.*,C.cat_id,C.sub_cat_id,C.child_cat_id');
    $this->db->from('tbl_product AS P');
    $this->db->where('P.status',1);
    $this->db->where('C.sub_cat_id',$sub_cat_id);
    $this->db->join('tbl_mapping_category_with_product AS C', 'C.mapping_product_id = P.product_id');
    $query=$this->db->get();
    if($query->num_rows()>0){

      $array_data=$query->result_array();
    }
    
    return $array_data;

  }

  
}
?>