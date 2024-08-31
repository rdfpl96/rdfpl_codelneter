<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{
  function __construct(){
    parent::__construct();
    //$this->load->database();
  }

   public function getRatingReviewByProdID($product_id){
     $array_data=array();
      $this->db->select('R.cust_rate,R.comment,R.add_date,C.c_fname as customer_name');
      $this->db->from('tbl_rate_and_review AS R');
      $this->db->join('tbl_customer AS C', 'C.customer_id = R.cust_id');
      $this->db->where('R.status',1);
      $this->db->where('R.product_id',$product_id);
      $this->db->order_by('C.add_date','DESC');
      $query=$this->db->get();
      if($query->num_rows()>0){
          $array_data=$query->result_array();
      }
      return $array_data;

   }

   public function getAllProduct($start,$records_per_page,$top_cat_id,$sub_id,$child_cat_id,$search_key,$shortBy,$filterbyPrice,$filterbyRating){
    $array_data=array();
    $this->db->select(
    
    'P.product_name,
    P.product_id,
    P.feature_img,
    CONCAT("'.base_url("uploads/").'",P.feature_img) as imagepath,
    TC.cat_id AS top_cat_id,
    TC.category AS top_cat_name,
    SC.sub_cat_id AS sub_cat_id,
    SC.subCat_name AS sub_cat_name,
    CC.child_cat_id AS child_cat_id,
    CC.childCat_name AS child_cat_name,
    (SELECT price FROM tbl_product_variants WHERE tbl_product_variants.variants_product_id = P.product_id LIMIT 1) as price
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
    if($search_key!=""){
      $this->db->like('P.product_name',$search_key);
    }
    if($shortBy!=""){
      $this->db->order_by('price',$shortBy);
    }
    if($filterbyPrice!=""){
      $priceArray=explode(',',$filterbyPrice);
      $this->db->where('price >=', $priceArray[0]);
      $this->db->where('price <=', $priceArray[1]);
      $this->db->order_by('price', 'ASC');
    }

    $this->db->join('tbl_mapping_category_with_product AS PWM', 'P.product_id = PWM.mapping_product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
    $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
    $this->db->limit($records_per_page,$start);
    $query=$this->db->get();
    if($query->num_rows()>0){
        foreach($query->result_array() as $record){
          $record['items']=$this->customlibrary->getProductItemByproductId($record['product_id']);
          $array_data[]=$record;
        }
       
    }
    return $array_data;
   }


  public function getTopCategory(){
    $array_data=array();
    $this->db->select('C.category as name,C.cat_id,C.cat_image,CONCAT("'.base_url("uploads/").'",C.cat_image) as imagepath');
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
    $this->db->select(
    'P.product_name,
    OP.product_type_id,
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

    $this->db->from('tbl_other_product AS OP');
    $this->db->where('P.status',1);
    $this->db->where('TC.status',1);
    $this->db->where('SC.status',1);
    $this->db->where('CC.status',1);
    $this->db->where('OP.product_type_id',$product_type_id);
    $this->db->join('tbl_product AS P', 'P.product_id = OP.product_id');

    $this->db->join('tbl_mapping_category_with_product AS PWM', 'OP.product_id = PWM.mapping_product_id');
    $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
    $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
    $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
    $query=$this->db->get();
    if($query->num_rows()>0){
        foreach($query->result_array() as $record){
          $record['items']=$this->customlibrary->getProductItemByproductId($record['product_id']);
          $array_data[]=$record;
        }
       
    }
    return $array_data;
  }

  public function getProductDetailById($product_id,$top_cat_id,$sub_id,$child_cat_id){
    $array_data=array();
      $this->db->select(
      'P.product_name,
      P.product_id,
      P.feature_img,
      CONCAT("'.base_url("uploads/").'",P.feature_img) as imagepath,
      CONCAT("'.base_url("uploads/").'",P.image1) as image1,
      CONCAT("'.base_url("uploads/").'",P.image2) as image2,
      CONCAT("'.base_url("uploads/").'",P.image3) as image3,
      CONCAT("'.base_url("uploads/").'",P.image4) as image4,
      CONCAT("'.base_url("uploads/").'",P.image4) as image5,
      P.other_info,
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
      $this->db->where('P.product_id',$product_id);
      // $this->db->where('TC.cat_id',$top_cat_id);
      // $this->db->where('SC.sub_cat_id',$sub_id);
      // $this->db->where('CC.child_cat_id',$child_cat_id);
      
      $this->db->join('tbl_mapping_category_with_product AS PWM', 'P.product_id = PWM.mapping_product_id');
      $this->db->join('tbl_category AS TC', 'PWM.cat_id = TC.cat_id');
      $this->db->join('tbl_sub_category AS SC', 'PWM.sub_cat_id = SC.sub_cat_id');
      $this->db->join('tbl_child_category AS CC', 'PWM.child_cat_id = CC.child_cat_id');
      $this->db->limit(1);
      $query=$this->db->get();
      if($query->num_rows()>0){
         
            $record=$query->row_array();
            $record['items']=$this->customlibrary->getProductItemByproductId($record['product_id']);
            $array_data=$record;
          
         
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
  
  public function saveReview($array_data){
   
    $this->db->trans_begin(); 
    // product Insert
    $this->db->insert('tbl_rate_and_review', $array_data);
    $last_id= $this->db->insert_id();

    
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return false;
    }else{
      $this->db->trans_commit();
      
      return $last_id;
    }
  }
  

}
?>