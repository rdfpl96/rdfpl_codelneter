<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

            
 public function getOtherProductById($product_type_id){
    $array_data=array();
    $this->db->select('P.product_id,P.product_name,P.cat_id,P.');
    $this->db->from('tbl_product AS P');
    $this->db->where('P.status',1);
    $this->db->where('OP.product_type_id',$product_type_id);
    $this->db->join('tbl_other_product AS OP', 'OP.product_id = P.product_id');
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