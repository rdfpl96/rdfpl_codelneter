<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    //$this->load->database();
  }

  public function getProductList($per_page, $limit_per_page, $sub_cat_id)
  {
    $array_data = array();
    $this->db->select('P.*,C.cat_id,C.sub_cat_id,C.child_cat_id');
    $this->db->from('tbl_product AS P');
    $this->db->join('tbl_mapping_category_with_product AS C', 'C.mapping_product_id = P.product_id');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_data = $query->result_array();
    }

    return $array_data;
  }

  public function chkUniqueCategoryName($name, $id = "")
  {

    $this->db->select('*');
    $this->db->from('tbl_category');
    $this->db->where('category', $name);
    if ($id != "") {
      $this->db->where('cat_id !=', $id);
    }
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function chkUniqueCategoryURL($slug, $id = "")
  {
    $this->db->select('*');
    $this->db->from('tbl_category');
    $this->db->where('slug', $slug);
    if ($id != "") {
      $this->db->where('cat_id !=', $id);
    }
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }


  public function record_count($name)
  {

    if ($name != '') {
      $this->db->like('category', $name);
    }
    return $this->db->from("tbl_category")->count_all_results();
  }


  public function getList($start, $records_per_page, $name, $searchText = '')
  {
    $array_record = array();
    $this->db->select('P.*');
    $this->db->from('tbl_category AS P');
    if ($name != '') {
      $this->db->like('P.category', $name);
    }


    // Check if the search term is not empty
    if (!empty($searchText)) {
      $this->db->like('P.category', $searchText);
    }



    $this->db->limit($records_per_page, $start);
    $this->db->order_by("add_date", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_record = $query->result_array();
    }
    return $array_record;
  }



  public function get_categories()
  {
    $query = $this->db->get('tbl_category'); // Fetch all records from tbl_category
    return $query->result(); // Return the result as an array of objects
  }



  public function get_user_count_category()
  {

    return $this->db->count_all("tbl_category");
  }

  public function get_users_category($limit, $start)
  {
    $this->db->limit($limit, $start);
    $query = $this->db->get("tbl_category");

    if ($query->num_rows() > 0) {
      return $query->result();
    }
    return false;
  }

  // public function add($array_data){
  //   // print_r($array_data);
  //   // exit;
  //   $this->db->trans_begin(); 
  //   // product Insert
  //   $this->db->insert('tbl_category', $array_data);
  //   $last_id= $this->db->insert_id();


  //   if($this->db->trans_status() === FALSE){
  //     $this->db->trans_rollback();
  //     return false;
  //   }else{
  //     $this->db->trans_commit();

  //     return $last_id;
  //   }
  // }
  public function insert_category($category_name, $category_slug)
  {

    $data = array(
      'category' => $category_name,
      'slug' => $category_slug
    );
    //print_r($data);
    if ($this->db->insert('tbl_category', $data)) {
      return true; // Return true if data is inserted successfully
    } else {
      return false; // Return false if data insertion fails
    }
  }

  public function get_category_by_id($id)
  {
    $query = $this->db->get_where('tbl_category', array('cat_id' => $id));
    return $query->row();
  }

  public function update_category($id, $data)
  {
    $this->db->where('cat_id', $id);
    if ($this->db->update('tbl_category', $data)) {
      return true;
    } else {
      return false; // Return false if data update fails
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


  public function getViewByID($id)
  {
    $array_record = array();
    $this->db->select('*');
    $this->db->from('tbl_category');
    $this->db->where('cat_id', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $array_record = $query->row_array();
    }
    return $array_record;
  }




  public function category_search($searchText = '')
  {
    // print_r($searchText);
    // die();
    $this->db->select('T1.*');
    $this->db->from('tbl_category AS T1');

    // Check if the search term is not empty
    if (!empty($searchText)) {
      $this->db->like('T1.category', $searchText);
    }
    $query = $this->db->get();
    return $query->result_array();
  }
}
