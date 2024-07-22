<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
 
class Product extends REST_Controller{ 
  
    public function __construct() {
    parent::__construct();


 
    $this->load->model('api/product_model','product');
    $this->load->model('common_model','common');
    
      // $validation=$this->authorization_token->validateToken();
    
      //   if($validation['status']!=0){

      //   $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
      //   echo json_encode($res);
      //   exit();
      //   }    
    
  }  
  public function index_post(){

      $records_per_page =25;
      $page = (int)(isset($_POST['page']) ? $_POST['page'] : 1);
      $page = ($page == 0 ? 1 : $page);
      $start = ($page-1) * $records_per_page;

      $post = json_decode($this->input->raw_input_stream, true);

      $top_cat_id = isset($post['top_cat_id']) ? $post['top_cat_id'] : "";
      $sub_id = isset($post['sub_id']) ? $post['sub_id'] : "";
      $child_cat_id = isset($post['child_cat_id']) ? $post['child_cat_id'] : 1;

      $product=$this->product->getAllProduct($start, $records_per_page,$top_cat_id,$sub_id,$child_cat_id);
     
      $res=array("error"=>0,'msg'=>'success','data'=>array('products'=>$product));
        
        echo json_encode($res);
        exit();
  }


  public function categoryList_get(){

    $topCat=$this->customlibrary->getTopCategory();
    $array_data=array();
    if(count($topCat)>0){
      foreach($topCat as $topc){
        $subcategory=$this->customlibrary->getSubCategoryByCatId($topc['cat_id']);
          if(count($subcategory)>0){
            foreach($subcategory as $subCat){
                $childCategory=$this->customlibrary->getSubCategoryByCatId($topc['cat_id'],$subCat['sub_cat_id']);
                
                $subCat['child']=$childCategory;
              }
             $topc['subcat'][]=$subCat;
          }
         
          $array_data[]= $topc;
      }
    }
    
    $this->response(array('error' =>0,'msg'=>'Success','data'=>array('category'=>$array_data))); 
  
  }

 

}

?>