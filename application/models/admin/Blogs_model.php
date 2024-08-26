<?php

use PhpParser\Node\Expr\Print_;

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs_model extends CI_Model{
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




  public function get_blog_count_category() {
    $this->db->select('COUNT(*) as blog_count');
    $this->db->from('tbl_blog');
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        return $query->row()->blog_count;
    } else {
        return 0; // Return 0 if there are no rows found
    }
}






public function get_users_blogs($limit, $start, $keywords = '') {
  $this->db->select('tbl_blog.*,tbl_category.category');
  $this->db->from('tbl_blog');
  $this->db->join('tbl_category', 'tbl_blog.blog_category = tbl_category.cat_id');

  if (!empty($keywords)) {
      $this->db->like('tbl_blog.blog_header', $keywords);
      //$this->db->or_like('tbl_blog.category', $keywords);
      $this->db->or_like('tbl_category.category', $keywords);
  }
  $this->db->order_by('tbl_blog.blog_id', 'DESC');
  $this->db->limit($limit, $start);
  $query = $this->db->get();
  return $query->result();
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
        $this->db->select('tbl_blog.blog_id');
        $this->db->from('tbl_blog');
        if ($name) {
            $this->db->like('tbl_blog.blog_cat_name', $name);
        }
        return $this->db->count_all_results();
    }




public function get_blogs()
{
    $this->db->select('tbl_blog.*, tbl_category.category');
    $this->db->from('tbl_blog');
    $this->db->join('tbl_category', 'tbl_blog.blog_category = tbl_category.cat_id');

    if ($name) {
        $this->db->like('tbl_blog.blog_header', $name); // Assuming you want to search by blog header
    }

    $this->db->order_by('tbl_blog.blog_add_date', 'DESC'); 
    //$this->db->limit($limit, $start);
    $query = $this->db->get();

    return $query->result_array();
}


    public function blog_get_categories() {
      $this->db->select('tbl_category.*'); // Select only the 'category' column
      $query = $this->db->get('tbl_category'); // Fetch all records from tbl_category
      return $query->result(); // Return the result as an array of objects
  }
  
    


    
    public function insert_blog($blog_data) {
        return $this->db->insert('tbl_blog', $blog_data);
    }




public function get_category_by_id($id) {
        $query = $this->db->get_where('tbl_category', array('cat_id' => $id));
        return $query->row();
    }

public function edit($id) {
        $this->db->where('blog_id', $id);
        $query = $this->db->get('tbl_blog');
        return $query->row_array();
    }   

public function update_subcategory($id, $data) {
        $this->db->where('sub_cat_id', $id);
        $this->db->update('tbl_sub_category', $data);
    }     




   

public function update_blogs($id, $data) {
    $this->db->where('blog_id', $id);
    if ($this->db->update('tbl_blog', $data)) {
        return true;
    } else {
        return false; 
    }
}




public function deleteblog($id ) {

  $this->db->where('blog_id', $id);
  $this->db->delete('tbl_blog', array('blog_id' => $id));

  if ($this->db->affected_rows() > 0) {
    return true;
  } else {
    return false;
  }

}



  public function updateBlogStatus($blog_id, $current_status) {
    $new_status = ($current_status == 0) ? 0 : 1;
  
    $data = array(
        'blog_status' => $new_status
    );
  
    $this->db->where('blog_id', $blog_id);
    $this->db->update('tbl_blog', $data);
    // if ($this->db->update('tbl_blog', $data)) {
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false; 
    }
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

  
}
?>