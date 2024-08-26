<?php


class Child_category_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function Child_category_count_all(){

    $this->db->select('*');
    $this->db->from('tbl_child_category');
    return $this->db->count_all_results();

  }

  public function category_search1($searchText = '') {
    $this->db->select('*');
    $this->db->from('tbl_child_category');
    $this->db->where('status', 1);
    if (!empty($searchText)) {
        $this->db->like('childCat_name', $searchText);
    }
    $this->db->order_by('child_cat_id', 'DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return [];
   }
}

public function category_search($searchText = '') {

  $this->db->select('tbl_child_category.*, tbl_category.category, tbl_sub_category.subCat_name');
  $this->db->from('tbl_child_category');
  $this->db->join('tbl_category', 'tbl_child_category.cat_id = tbl_category.cat_id');
  $this->db->join('tbl_sub_category', 'tbl_child_category.sub_cat_id = tbl_sub_category.sub_cat_id');

  if (!empty($searchText)) {
      $this->db->group_start();
      $this->db->like('tbl_child_category.childCat_name', $searchText);
      $this->db->or_like('tbl_category.category', $searchText);
      $this->db->or_like('tbl_sub_category.subCat_name', $searchText);
      $this->db->group_end();
  }
  $this->db->limit(20);
  $this->db->order_by('tbl_child_category.update_date', 'DESC');
  $query = $this->db->get();
  return $query->result_array();
}






  public function getCategories()

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

  
    $this->db->order_by("add_date", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {

      $array_record = $query->result_array();
    }
    return $array_record;


  }

  public  function insertChildCategory($data){
  
      return $this->db->insert('tbl_child_category', $data);

  }
  


      public function getSubcategoriesByCategory($cat_id) {
        $this->db->select('subCat_name, sub_cat_id');
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get('tbl_sub_category');
        return $query->result_array();
    }



    public function deleteChildcategory($cat_id) {
      $this->db->where('child_cat_id', $cat_id);
      $this->db->delete('tbl_child_category', array('child_cat_id' => $cat_id));
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    
    }




    public function get_Childcategory_data($limit,$start) {
      $this->db->limit($limit, $start);
      $this->db->select('tbl_child_category.*, tbl_category.category,tbl_sub_category.subCat_name');
      $this->db->from('tbl_child_category');
      // $this->db->join('tbl_category', 'tbl_category.cat_id = tbl_child_category.cat_id');
      // $this->db->join('tbl_sub_category', 'tbl_sub_category.sub_cat_id = tbl_sub_category.sub_cat_id');
      $this->db->join('tbl_category', 'tbl_child_category.cat_id = tbl_category.cat_id');
      $this->db->join('tbl_sub_category', 'tbl_child_category.sub_cat_id = tbl_sub_category.sub_cat_id');
     $this->db->order_by('tbl_child_category.update_date', 'DESC');
      $this->db->limit(20);
      $query = $this->db->get();
      return $query->result_array();
  }
  












}


















?>