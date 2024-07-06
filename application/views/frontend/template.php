<?php 
$data['menus']=$this->my_libraries->getMenus();   
 
$data['location_pin']=$this->session->userdata('pincode_loc');


$exportUrl=array();
   $arrBurl=explode('/', $_SERVER['REQUEST_URI']);
   if(in_array('checkout',$arrBurl)){
       array_push($exportUrl,'checkout');
   }

    // $exportUrl=explode('/', $_SERVER['REQUEST_URI']);
    $pageName=end($arrBurl);
    $data['urlcnd']=$pageName;

    $data['google_client']=$this->my_libraries->googleLoginConfig();  
    $data['fblogin']=$this->my_libraries->fblogin();

  $this->load->view('frontend/head',$data);
   
   $catMenuList=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_category WHERE  status=1 ORDER BY position DESC");
   $data['catMenuList']=$catMenuList;
   if($catMenuList!=0){
          $getSubCategory=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('cat_id'=>$catMenuList[0]->cat_id,'status'=>1));
          $data['subCatMenuList']=$getSubCategory;
          if($getSubCategory!=0){

             $getChildCategory=$this->sqlQuery_model->sql_select_where('tbl_child_category',array('sub_cat_id'=>$getSubCategory[0]->sub_cat_id,'status'=>1)); 

             if($getChildCategory!=0){
                $data['getChildCategoryList']=$getChildCategory;
              }else{
                 $data['getChildCategoryList']=array();
              }

           }else{
             $data['subCatMenuList']=array();
           }


   }else{
    $data['subCatMenuList']=array();
   }

   

    $user=$this->my_libraries->mh_getCookies('customer');
    if($user!=""){
     $wish_list=$this->sqlQuery_model->sql_select_where('tbl_wishlist',array('cust_id'=>$user[0]->customer_id,'status'=>1));

      $data['countWishlist']=($wish_list!=0) ? count($wish_list):0;
    }else{
       $data['countWishlist']=0;
    }
        


  if(!isset($pageName) ||  $pageName!='checkout'){ 
    //$this->load->view('frontend/header',$data);
  }

  $this->load->view($content);

$sql_limit_footer=3;
$querys="SELECT * FROM tbl_blog WHERE blog_status=1 $searchKeyword ORDER BY blog_id DESC LIMIT $sql_limit_footer";
$data['blogs_footer']=$this->sqlQuery_model->sql_query($querys);




   if(!isset($pageName) ||  $pageName!='checkout'){ 
    //$this->load->view('frontend/footer',$data);
   }

   $d['customer']=$user;

   //$this->load->view('frontend/script',$d);
?>