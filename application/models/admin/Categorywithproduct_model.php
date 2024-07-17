<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorywithproduct_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

   
  public function chkUniqueMapping($mapping_product_id,$cat_id,$sub_cat_id,$child_cat_id,$mapping_id=""){
    
    $this->db->select('*');
    $this->db->from('tbl_mapping_category_with_product');
    $this->db->where('mapping_product_id',$mapping_product_id);
    $this->db->where('cat_id',$cat_id);
    $this->db->where('sub_cat_id',$sub_cat_id);
    $this->db->where('child_cat_id',$child_cat_id);
    if($mapping_id!=""){
      $this->db->where('mapping_id !=',$mapping_id); 
    }
    $query=$this->db->get() ; 

    if($query->num_rows()>0){ 
      return true;
    }else{
      return false; 
    }
      
  }



   public function record_count($top_cat_id,$sub_id, $child_cat_id) {

    if($top_cat_id!=""){
        $this->db->where('PWM.cat_id',$top_cat_id);
      }
      if($sub_id!=""){
        $this->db->where('PWM.sub_cat_id',$sub_id);
      }
      if($child_cat_id!=""){
        $this->db->where('PWM.child_cat_id',$child_cat_id);
      }
    return $this->db->from("tbl_mapping_category_with_product AS PWM")->count_all_results();    
  } 

            
   public function getAllProduct($start,$records_per_page,$top_cat_id,$sub_id,$child_cat_id){
      $array_data=array();
      $this->db->select(
      'PWM.mapping_id,
      P.product_name,
      P.product_id,
      P.feature_img,
      CONCAT("'.base_url("uploads/").'",P.feature_img) as imagepath,
      TC.cat_id AS top_cat_id,
      TC.category AS top_cat_name,
      SC.sub_cat_id AS sub_cat_id,
      SC.subCat_name AS sub_cat_name,
      CC.child_cat_id AS child_cat_id,
      CC.childCat_name AS child_cat_name
      ');

      $this->db->from('tbl_product AS P');
      $this->db->where('P.status',1);
      $this->db->where('TC.status',1);
      $this->db->where('SC.status',1);
      $this->db->where('CC.status',1);
      if($top_cat_id!=""){
        $this->db->where('TC.cat_id',$top_cat_id);
      }
      if($sub_id!=""){
        $this->db->where('SC.sub_cat_id',$sub_id);
      }
      if($child_cat_id!=""){
        $this->db->where('CC.child_cat_id',$child_cat_id);
      }
      $this->db->join('tbl_mapping_category_with_product AS PWM', 'P.product_id = PWM.mapping_product_id');
      $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
      $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
      $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
      $this->db->limit($records_per_page,$start);
      $query=$this->db->get();
      if($query->num_rows()>0){
          $array_data=$query->result_array();
      }
      return $array_data;
    }
  

  public function add($array_data){

    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_mapping_category_with_product', $array_data);
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


  public function deleteMapingRecord($id){
    $this->db->where('mapping_id', $id);
    $this->db->delete('tbl_mapping_category_with_product');
    return true;
  }

  
}
?>