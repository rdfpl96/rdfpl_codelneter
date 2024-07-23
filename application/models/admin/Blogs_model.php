<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
  
    return $this->db->count_all("tbl_blog");
  }



  public function get_users_blogs($limit, $start) {
    $this->db->limit($limit, $start);
    $query = $this->db->get("tbl_blog");
   
    if ($query->num_rows() > 0) {
        return $query->result();
    }
    return false;
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
        $this->db->select('tbl_blog.blog_id');
        $this->db->from('tbl_blog');
        if ($name) {
            $this->db->like('tbl_blog.blog_cat_name', $name);
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

  public function get_blogs($start, $limit, $name) {
    $this->db->select('tbl_blog.*, tbl_category.category');
    $this->db->from('tbl_blog');
    $this->db->join('tbl_category', 'tbl_blog.blog_category = tbl_category.cat_id');
    if ($name) {
        $this->db->like('tbl_blog.blog_cat_name', $name);
    }
    $this->db->order_by('tbl_blog.blog_id', 'DESC'); // Adding order by clause
    $this->db->limit($limit, $start);
    $query = $this->db->get();

    // echo '<pre>';
    // print_r($query);
    // die();
    
    return $query->result_array(); // Ensuring the result is returned as an array

}









    public function blog_get_categories() {
      $this->db->select('tbl_category.*'); // Select only the 'category' column
      $query = $this->db->get('tbl_category'); // Fetch all records from tbl_category
      return $query->result(); // Return the result as an array of objects
  }
  
    




    public function getBlogSearchDetails($search) {

      $this->db->select('tbl_blog.*, tbl_category.category');
      $this->db->from('tbl_blog');
      $this->db->join('tbl_category', 'tbl_blog.blog_category = tbl_category.cat_id');
      $this->db->like('tbl_blog.blog_header', $search);
      $this->db->or_like('tbl_category.category', $search);
      $query = $this->db->get();
      return $query->result_array(); 
    
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





  // public function Edit($id,$array_data){

  //   $this->db->trans_begin(); 

  //   $this->db->where('cat_id', $id);     
  //   $this->db->update('tbl_category', $array_data);

  //   if($this->db->trans_status() === FALSE){
  //     $this->db->trans_rollback();
  //     return false;
  //   }else{
  //     $this->db->trans_commit();
  //     return true;
  //   } 
  // } 


  public function updateBlogStatus() {
    $blog_id = $this->input->post('blog_id');
    $current_status = $this->input->post('status');
  
    $new_status = ($current_status == 1) ? 0 : 1;
  
    $data = array(
        'blog_status' => $new_status
    );
  
    $this->db->where('blog_id', $blog_id);
    if ($this->db->update('tbl_blog', $data)) {
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