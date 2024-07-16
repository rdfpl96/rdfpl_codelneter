<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');
 
class Product extends REST_Controller{ 
  
    public function __construct() {
    parent::__construct();


 
    $this->load->model('api/product_model','product');
    $this->load->model('common_model','common');
    
      $validation=$this->authorization_token->validateToken();
    
        if($validation['status']!=0){

        $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        echo json_encode($res);
        exit();
        }    
    
  }  
  public function index_post(){

      $records_per_page =25;
      $page = (int)(isset($_POST['page']) ? $_POST['page'] : 1);
      $page = ($page == 0 ? 1 : $page);
      $start = ($page-1) * $records_per_page;

      $top_cat_id = isset($_POST['top_cat_id']) ? $_POST['top_cat_id'] : "";
      $sub_id = isset($_POST['sub_id']) ? $_POST['sub_id'] : "";
      $child_cat_id = isset($_POST['child_cat_id']) ? $_POST['child_cat_id'] : 1;

      $product=$this->product->getAllProduct($start, $records_per_page,$top_cat_id,$sub_id,$child_cat_id);
     
      $res=array("error"=>0,'msg'=>'success','data'=>array('products'=>$product));
        
        echo json_encode($res);
        exit();
  }

 

}

?>