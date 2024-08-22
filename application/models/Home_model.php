<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }


public function getSliderbanner(){
        $array_res=array();
        $this->db->select('text1,text2,description,desk_image,mobile_image,button_link');
        $this->db->from('tbl_banner');
        $this->db->where('status',1);
        $this->db->where('type','banner'); 
        $this->db->order_by('position','ASC'); 
        $query=$this->db->get() ; 
        if($query->num_rows()>0){ 
            
          $array_res=$query->result_array();
        }
        return $array_res;
      }


public function getProductType($product_type_id){
    $array_data=array();
    $this->db->select('P.*');
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

  public function getTopSellingProduct(){
    $array_data=array();
    $this->db->select('P.*');
    $this->db->from('tbl_product AS P');
    $this->db->where('P.status',1);
    $this->db->limit(5,10);
    $query=$this->db->get();
    if($query->num_rows()>0){
        $array_data=$query->result_array();
    }
    return $array_data;
  } 

   public function getNewProduct(){
    $array_data=array();
    $this->db->select('P.*');
    $this->db->from('tbl_product AS P');
    $this->db->where('P.status',1);
    $this->db->limit(5,25);
    $query=$this->db->get();
    if($query->num_rows()>0){
        $array_data=$query->result_array();
    }
    return $array_data;
  } 


public function get_max_value_offers(){
// SELECT p.* FROM tbl_product p
// JOIN (SELECT product_id, offer_amount
// FROM offers ORDER BY offer_amount DESC
// LIMIT 5) o ON p.product_id = o.product_id;

$this->db->select('product_id, offer_amount');
$this->db->from('offers');
$this->db->order_by('offer_amount', 'DESC');
$this->db->limit(5);
$subquery = $this->db->get_compiled_select();
$this->db->select('p.*');
$this->db->from('tbl_product AS p');
$this->db->join("($subquery) AS o", 'p.product_id = o.product_id');
$query = $this->db->get();
 if($query->num_rows()>0){
        $array_data=$query->result_array();
    }
    return $array_data;
// $result = $query->result();
// print_r($this->db->last_query());
// die();  // Stop execution to view the query


} 
         
  
}

?>