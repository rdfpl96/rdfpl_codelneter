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

      $post = json_decode($this->input->raw_input_stream, true);

      $records_per_page =25;
      $page = (int)(isset($post['page']) ? $post['page'] : 1);
      $page = ($page == 0 ? 1 : $page);
      $start = ($page-1) * $records_per_page;
      //
      $top_cat_id = isset($post['top_cat_id']) ? $post['top_cat_id'] : "";
      $sub_id = isset($post['sub_id']) ? $post['sub_id'] : "";
      $child_cat_id = isset($post['child_cat_id']) ? $post['child_cat_id'] : 1;

      $search_key = isset($post['search_key']) ? $post['search_key'] : "";
      //filter
      $filterbyPrice=isset($post['price']) ? $post['price'] : "";
      $filterbyRating=isset($post['rating']) ? $post['rating'] : "";
      //
      $shortBy=isset($post['short_by']) ? $post['short_by'] : "";

      $product=$this->product->getAllProduct($start, $records_per_page,$top_cat_id,$sub_id,$child_cat_id,$search_key,$shortBy,$filterbyPrice,$filterbyRating);
     
      $res=array("error"=>0,'msg'=>'success','data'=>array('products'=>$product));
        

        $this->response($res); 
       
  }


  public function categoryList_get(){

    $topCat=$this->customlibrary->getTopCategory();
    $array_data=array();
    if(count($topCat)>0){
      foreach($topCat as $topc){
        $subcategory=$this->customlibrary->getSubCategoryByCatId($topc['cat_id']);
          if(count($subcategory)>0){
            foreach($subcategory as $subCat){
                $childCategory=$this->customlibrary->getChilCategory($topc['cat_id'],$subCat['sub_cat_id']);
                
                $subCat['child']=$childCategory;
              }
             $topc['subcat'][]=$subCat;
          }
         
          $array_data[]= $topc;
      }
    }
    
    $this->response(array('error' =>0,'msg'=>'Success','data'=>array('category'=>$array_data))); 
  
  }

public function detail_get($id="",$top_cat_id="",$sub_id="",$child_cat_id=""){

    $pdetail=$this->product->getProductDetailById($id,$top_cat_id,$sub_id,$child_cat_id);

     $customer_id=$this->authorization_token->userData()->customer_id;

    $simillerProduct=array();

    if(count($pdetail)>0){
      $pdetail['other_info']=unserialize($pdetail['other_info']);
      //
      $pdetail['is_wishlist']=$this->customlibrary->chkProductInWishList($pdetail['product_id'],$customer_id);
      //
      $averageRating=$this->customlibrary->getAvarageRating($id);

      $ratingReview=$this->product->getRatingReviewByProdID($id);
      $simillerProduct=$this->product->getAllProduct(1,10,$top_cat_id,$sub_id,$child_cat_id,$search_key="");
    }

    $this->response(array('error' =>0,'msg'=>'Success','data'=>array('pdetail'=>$pdetail,'simillerProduct'=>$simillerProduct,"ratingReview"=> $ratingReview,"average_rating"=>$averageRating))); 
  
}  


//
//Save Rate and review
//
public function rateAndReview_post(){

  $customer_id=$this->authorization_token->userData()->customer_id;

  $post = json_decode($this->input->raw_input_stream, true);

  $orderId=isset($post['order_id']) ? $post['order_id'] : "";
  $productId=isset($post['product_id']) ? $post['product_id'] : "";
  $rate=isset($post['rate']) ? $post['rate'] : "";
  $comment=isset($post['comment']) ? addslashes($post['comment']) : "";

  if($orderId!="" && $productId!="" && $rate!="" && $comment!=""){

    if(!$this->customlibrary->chkReviewAlreadyExist($customer_id,$productId,$orderId)){

      $this->product->saveReview(array(
        "cust_id"=>$customer_id,
        "product_id"=>$productId,
        "order_id"=>$orderId,
        "cust_rate"=>$rate,
        "comment"=>$comment
      ));

      $this->response(array('error' =>0,'msg'=>'Thank you for your rating'));

    }else{
      $this->response(array('error' =>1,'msg'=>'Already reviewed')); 
    }

  }else{
     $this->response(array('error' =>1,'msg'=>'Some parameter missing')); 
  }
}

 

}

?>