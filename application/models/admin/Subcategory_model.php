<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategory_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
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


  public function get_Sub_Cat_Id($id) {
    $query = $this->db->get_where('tbl_sub_category', array('sub_cat_id' => $id));
    return $query->row(); 
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


  //  public function record_count($name) {

  //   if($name!=''){
  //      $this->db->like('category',$name);
  //   }
  //   return $this->db->from("tbl_category")->count_all_results();    
  // } 

  public function record_count($name) {
        $this->db->select('tbl_sub_category.sub_cat_id');
        $this->db->from('tbl_sub_category');
        if ($name) {
            $this->db->like('tbl_sub_category.subCat_name', $name);
        }
        return $this->db->count_all_results();
    }

            
  // public function getList($start,$records_per_page,$name){
  //   $array_record=array();     
  //   $this->db->select('P.*');
  //   $this->db->from('tbl_category AS P');
  //   if($name!=''){
  //      $this->db->like('P.category',$name);
  //   }
   
  //   $this->db->limit($records_per_page,$start);
  //   $this->db->order_by("add_date", "desc");
  //   $query=$this->db->get() ; 
  //   if($query->num_rows()>0){
    
  //       $array_record=$query->result_array();
      
  //   }
  //   return $array_record;    
  // }

  public function get_subcategories($start, $limit, $name) {
        $this->db->select('tbl_sub_category.*, tbl_category.category');
        $this->db->from('tbl_sub_category');
        $this->db->join('tbl_category', 'tbl_sub_category.cat_id = tbl_category.cat_id');
        if ($name) {
            $this->db->like('tbl_sub_category.subCat_name', $name);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('tbl_sub_category.update_date', 'DESC');
        $query = $this->db->get();
        //die($this->db->last_query());
        return $query->result_array(); // Ensuring the result is returned as an arra
    }


    public function SearchCategory($category){
      $this->db->select('tbl_sub_category.*, tbl_category.category');
      $this->db->from('tbl_sub_category');
      $this->db->join('tbl_category', 'tbl_sub_category.cat_id = tbl_category.cat_id');
      $this->db->like('tbl_sub_category.subCat_name', $category);
      $this->db->or_like('tbl_category.category', $category);
      $this->db->order_by('tbl_sub_category.update_date', 'DESC');
      $this->db->limit(20,0);
      $query = $this->db->get();
      $result_array = $query->result_array(); 
      return  $result_array;
  }
  






    public function insert_subcategory($data) {
        return $this->db->insert('tbl_sub_category', $data);
    }

public function get_category_by_id($id) {
        $query = $this->db->get_where('tbl_category', array('cat_id' => $id));
        return $query->row();
    }

public function get_subcategory($id) {
        $this->db->where('sub_cat_id', $id);
        $query = $this->db->get('tbl_sub_category');
        return $query->row_array();
    }   

  public function update_subcategory($id, $data) {
        $this->db->where('sub_cat_id', $id);
        $this->db->update('tbl_sub_category', $data);
    }     

public function update_category($id, $data) {
        $this->db->where('cat_id', $id);
        if ($this->db->update('tbl_category', $data)) {
            return true; // Return true if data is updated successfully
        } else {
            return false; // Return false if data update fails
        }
    }

   
  public function get_users_category($limit, $start) {
    $this->db->limit($limit, $start);
    $query = $this->db->get("tbl_sub_category");
   
    if ($query->num_rows() > 0) {
        return $query->result();
    }
    return false;
  }

  public function get_user_count_subcategory($name='') {
    $this->db->select('tbl_sub_category.*, tbl_category.category');
    $this->db->from('tbl_sub_category');
    $this->db->join('tbl_category', 'tbl_sub_category.cat_id = tbl_category.cat_id');
    if ($name) {
        $this->db->like('tbl_sub_category.subCat_name', $name);
    }
    //$this->db->limit($limit, $start);
    $query = $this->db->get();
    return count($query->result_array()); // Ensuring the result is returned as an arra
}






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

  public function delete_subcategory($sub_cat_id) {
    $this->db->where('sub_cat_id', $sub_cat_id);
    return $this->db->delete('subcategories');
}


}
?>