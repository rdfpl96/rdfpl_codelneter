<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

   function __construct(){
        parent::__construct();

          $this->load->model('product_model','productObj');
          $this->load->library('my_libraries');
   }
      



  public function index($slug1="",$slug2="",$slug3=""){

   
    $products=$this->productObj->getProdcutListBySlug($slug1,$slug2,$slug3);


     if(is_array($products) && count($products)>0){

      $sidecategories=array();

      if($slug1!="" && $slug2!=""){
        $categoryLevel=2;
        $categoryName=$this->customlibrary->SubCatName($products[0]['sub_cat_id']);
       $sidecategories=$this->customlibrary->getChilCategory($products[0]['cat_id'],$products[0]['sub_cat_id']);
      }
      else if($slug1!="" && $slug2==""){
        $categoryLevel=1;
        $categoryName=$this->customlibrary->TopCatName($products[0]['cat_id']);
        $sidecategories=$this->customlibrary->getSubCategoryByCatId($products[0]['cat_id']);
        
      }  
       //$sidecategories=$this->customlibrary->getTopCategory();

       $data['productCount']=count($products);
       $data['sidecategories']=$sidecategories;
       $data['categoryName']=$categoryName;
       $data['categoryLevel']=$categoryLevel;
       $data['products']= $this->load->view('frontend/component/productItem', array("productItems"=>$products,'pcol'=>4), TRUE);
     }

  
   $this->load->view("frontend/product/index",$data);
  }

  public function shop(){
     
      $products=$this->productObj->getProdcutListBySlug($slug1="",$slug2="",$slug3="");

      $sidecategories=$this->customlibrary->getTopCategory();

       $data['productCount']=count($products);
       $data['sidecategories']=$sidecategories;
       $data['categoryName']="";
       $data['categoryLevel']="";
       $data['products']= $this->load->view('frontend/component/productItem', array("productItems"=>$products,'pcol'=>4), TRUE);

    $this->load->view("frontend/product/index",$data);
  }

  public function detail($pslug){

    $pdetail=$this->productObj->getProductDetailBySlug($pslug);

    $simillerProduct=array();

    if(count($pdetail)>0){
      $simillerProduct=$this->productObj->getProdcutListBySlug($pdetail['top_cat_slug'],$pdetail['sub_cat_slug'],$pdetail['child_cat_slug']);
    }

   
    
    $this->load->view("frontend/product/detail",array('pdetail'=>$pdetail,'simillerProduct'=>$simillerProduct,'popupar'=>$simillerProduct));

  }
  
   public function search(){

    $min_price=isset($_POST['min_price']) ? trim($_POST['min_price']) : "";

    $max_price=isset($_POST['max_price']) ? trim($_POST['max_price']) : "";

    $rating=isset($_POST['rating']) ? trim($_POST['rating']) : "";

    $searchbyselect=isset($_POST['searchbyselect']) ? trim($_POST['searchbyselect']) : "";

    

  //$productArraId=$this->productObj->getProductIdByPriceRange($min_price,$max_price,$searchbyselect);

   //print_r($productArraId);

    $products=$this->productObj->filterProduct($slug1="",$slug2="",$slug3="",$min_price,$max_price,$searchbyselect,$rating);


    $products=$this->load->view('frontend/component/productItem', array("productItems"=>$products,'pcol'=>4,'min_price'=>$min_price,'max_price'=>$max_price), TRUE);

    echo json_encode(array('status'=>0,'data'=>$products));
    exit();

  }
  
public function review_rating(){
   $user=$this->my_libraries->mh_getCookies('customer');

   if (!empty($user) && isset($user['customer_id'])) {
        $customer_id = $user['customer_id'];
         $item_id = base64_decode($this->input->get('itm'));
         $pro_id = base64_decode($this->input->get('por'));
    
         $where = array('cust_id'=>trim($customer_id),'product_id'=>$pro_id,'order_id'=>$item_id);
         $data['review']=$this->sqlQuery_model->sql_select_where('tbl_rate_and_review',$where);
    
      $data['content']='frontend/product/rating_review_details';
      $this->load->view('frontend/template',$data);

  }else{
    redirect(base_url(), 'refresh');
  }
}  


}