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


         
  
}

?>