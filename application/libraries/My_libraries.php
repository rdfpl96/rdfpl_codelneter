<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_libraries extends CI_Model {

   function replaceAll($text) { 
    $text = strtolower(htmlentities($text)); 
    $text = str_replace(get_html_translation_table(), "-", $text);
    $text = str_replace(" ", "-", $text);
    $text = preg_replace("/[-]+/i", "-", $text);
    $text=preg_replace('/[^A-Za-z0-9\-]/', '', $text); // Removes special chars.
    return $text;
}


public function googleLoginConfig(){
   $google_client = new Google_Client();


   // echo $this->config->item('googleLogin_RedirectUri');
   // exit;
   $google_client->setClientId($this->config->item('googleLogin_ClientId')); //Define your ClientID
   $google_client->setClientSecret($this->config->item('googleLogin_ClientSecret')); //Define your Client Secret Key
   // $google_client->setRedirectUri('http://localhost:81/ecoms/google-details'); //Define your Redirect Uri
   $google_client->setRedirectUri($this->config->item('googleLogin_RedirectUri')); //Define your Redirect Uri
  
  $google_client->addScope('email');
  $google_client->addScope('profile');

  return $google_client;
}
   

public function fblogin(){

  $fb = new Facebook\Facebook([
  'app_id' => $this->config->item('facebook_app_id'),
  'app_secret' => $this->config->item('facebook_app_secret'),
  'default_graph_version' => $this->config->item('facebook_graph_version'),
  ]);
  $helper = $fb->getRedirectLoginHelper();
  // $permissions = ['email']; // optional

  $permissions = ['email','user_location','user_photos','user_gender']; 
  $data['loginurl'] = $helper->getLoginUrl(base_url().'fbcallback',$permissions);

  return $data;

}




  public function ciUniqName($tblname,$ci_Colname,$value){

    $ci_cate_name=trim($this->replaceAll($value));
    $checkexits=$this->sqlQuery_model->sql_select_where($tblname,array($ci_Colname=>$ci_cate_name));
    if($checkexits==0){
      $uniq_name=$ci_cate_name;
    }else{
      $data['status']=0;
      $data['message']='Already exits data.';
      echo json_encode($data);
      exit;
    }

    return $uniq_name;

}

  public function check_is_active($valus)
   {
        foreach($valus as $val)
        {
          if($val->status==1){
            $return=true;
          }else{
          $return=false;
          }
        }
        return $return;
   }

 public function is_set_sesssion($value)
  {
      if(isset($value) || $value!=array())
      {
              foreach($value as $val)
              {
                  $get_arr=array(
                          'admin_name'        =>    $val->admin_name,
                          'admin_username'    =>    $val->admin_username,
                          'admin_id'          =>    $val->admin_id,
                          'status'            =>    $val->status,
                          'admin_email'       =>    $val->admin_email,
                          'admin_mobile'      =>    $val->admin_mobile,
                          'admin_image'       =>    $val->admin_image,
                          'admin_designation' =>    $val->admin_designation,
                          'manu_access_ids'   =>    $val->manu_access_ids,
                          'admin_pincode'     =>    $val->admin_pincode,
                          'admin_type'        =>    $val->admin_type,
                          'is_login'          =>    TRUE,
                          'admin_company_name'=>    $val->admin_company_name,
                          'admin_pincode'     =>    $val->admin_pincode
                        );
              }

              $session=$this->session->set_userdata('admin',$get_arr);
              $has_admin=$this->session->has_userdata('admin');
             if($has_admin){
                   // $get_val=$this->session->userdata('admin');
                   return 1;
             }else{
               return 0;
             }

      }

  }

    public function getOrderCancelReason_name($reasons_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_cancel_reasons',array('reasons_id'=>$reasons_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->reasons;
      }
       return $name;
   }


  public function getCate_name($cat_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_category',array('cat_id'=>$cat_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->category;
      }
       return $name;
}

// public function getsubCate_name($cat_id){
//       $sql=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('cat_id'=>$cat_id));
//       $name="";
//       if($sql!=0){
//           $name=$sql[0]->category;
//       }
//        return $name;
// }

public function getChildCate_name($child_cat_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_child_category',array('child_cat_id'=>$child_cat_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->childCat_name;
      }
       return $name;
}

public function getGalleryTag_name($gallery_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_gallery_type',array('gallery_id'=>$gallery_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->header_name;
      }
       return $name;
}

public function getContactDetails($type){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_contact_details',array('status'=>1));
      $name="";
      if($sql!=0){
         if($type=='address'){
          $name=$sql[0]->address;
         }else if($type=='email'){
          $name=$sql[0]->email;
         }else if($type=='contact'){
          $name=$sql[0]->contact;
         }else if($type=='short_info'){
          $name=$sql[0]->short_information;
         }else if($type=='video'){
          $name=$sql[0]->youtube_video;
         }else if($type=='heading'){
           $name=$sql[0]->heading;
         }else if($type=='historyDetails'){
           $name=$sql[0]->historyDetails;
         }else if($type=='fileimage'){
           $name=$sql[0]->fileimage;
         }else if($type=='fassai_no'){
           $name=$sql[0]->fassai_no;
         }else if($type=='cin_no'){
           $name=$sql[0]->cin_no;
         }else if($type=='gst_no'){
           $name=$sql[0]->gst_no;
         }else if($type=='state'){
           $name=$sql[0]->state;
         }else if($type=='state_code'){
           $name=$sql[0]->state_code;
         }else if($type=='pincode'){
           $name=$sql[0]->pincode;
         }else if($type=='location'){
           $name=$sql[0]->location;
         }
         else{
          $name='';
         }

      }
       return $name;
        
}



// $data['contact']=$this->sqlQuery_model->sql_select_where('tbl_contact_details',array('status'=>1));


  public function getSubCate_name($sub_cat_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('sub_cat_id'=>$sub_cat_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->subCat_name;
      }
       return $name;
   }


  public function getCate_name_by_ci($cat_ci){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_category',array('ci_cat_name'=>$cat_ci));
      $name="";
      if($sql!=0){
          $name=$sql[0]->category;
      }
       return $name;
}


  public function getCate_id_by_ci($cat_ci){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_category',array('ci_cat_name'=>$cat_ci));
      $name="";
      if($sql!=0){
          $name=$sql[0]->cat_id;
      }
       return $name;
}

public function getSubCate_name_by_ci($sub_cat_ci){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('ci_sub_cat_name'=>$sub_cat_ci));
      $name="";
      if($sql!=0){
          $name=$sql[0]->subCat_name;
      }
       return $name;
}


public function getSubCate_id_by_ci($sub_cat_ci){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('ci_sub_cat_name'=>$sub_cat_ci));
      $name="";
      if($sql!=0){
          $name=$sql[0]->sub_cat_id;
      }
       return $name;
}


public function getChild_name_by_ci($child_ci){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_child_category',array('ci_child_cat_name'=>$child_ci));
      $name="";
      if($sql!=0){
          $name=$sql[0]->childCat_name;
      }
       return $name;
}

public function getChild_id_by_ci($child_ci){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_child_category',array('ci_child_cat_name'=>$child_ci));
      $name="";
      if($sql!=0){
          $name=$sql[0]->child_cat_id;
      }
       return $name;
}



  public function getCate_name_ci($cat_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_category',array('cat_id'=>$cat_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->ci_cat_name;
      }
       return $name;
   }


public function ads_ActiveStaus($status){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_ads_active_manage',array('status'=>$status));
      $name="";
      if($sql!=0){
          $name=$sql[0]->ads_active_status;
      }
       return $name;
   }


   public function ads_bannerActiveStaus($status){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_ads_banner',array('banner_status'=>$status));
      $name="";
      if($sql!=0){
          $name=$sql[0]->banner_status;
      }
       return $name;
   }



  public function getSubCate_name_ci($sub_cat_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('sub_cat_id'=>$sub_cat_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->ci_sub_cat_name;
      }
       return $name;
   }

     public function getChildCate_name_ci($child_cat_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_child_category',array('child_cat_id'=>$child_cat_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->ci_child_cat_name;
      }
       return $name;
   }


   public function getGalleryImageCount($tag_id,$gtypename){
         
        $productimage_list=$this->getProductImage($gtypename);
         $sql=$this->sqlQuery_model->sql_select_where('tbl_gallery_images',array('gallery_id'=>$tag_id));

        $imageGallery=($sql!=0) ? $sql :array();
        $arrayMerge=array_merge($productimage_list,$imageGallery);

     
      $counts=0;
      if($arrayMerge!=array()){
          $counts=count($arrayMerge);
      }
       return $counts;
   }


public function getProductUnique_id($variant_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variant_id'=>$variant_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->variants_unique_number;
      }
       return $name;
}

public function getProductNameUnique_id($unique_number='',$type=''){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_product',array('unique_number'=>$unique_number));
      $name="";
      if($sql!=0){
          if($type=='pName'){
            $name=$sql[0]->product_name;
          }else if($type=='image'){
            $name=$sql[0]->image1;
          }else{
            $name='';
          }
      }
       return $name;
}

public function getProductNameProduct_id($product_id=''){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_product',array('product_id'=>$product_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->product_name;
        }
    return $name;
}



public function getProductVariantPachSizeUnique_id($variant_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variant_id'=>$variant_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->pack_size;
      }
       return $name;
}

public function getProductVariantUnitsUnique_id($variant_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variant_id'=>$variant_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->units;
      }
       return $name;
}


public function getProductVariantConversionFactor($variant_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variant_id'=>$variant_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->conversion_factor;
      }
       return $name;
}


public function getProductVariantSKU_id($variant_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variant_id'=>$variant_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->sku_id;
      }
       return $name;
}


public function getProductCategoryUnique_id($mapping_id=''){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_mapping_category_with_product',array('mapping_id'=>$mapping_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->category;
      }
       return $name;
}

public function getProductSubCategoryUnique_id($mapping_id=''){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_mapping_category_with_product',array('mapping_id'=>$mapping_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->sub_category;
      }
       return $name;
}


public function getProductCategory_idUnique_id($mapping_id=''){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_mapping_category_with_product',array('mapping_id'=>$mapping_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->cat_id;
      }
       return $name;
}

public function getProductSubCategory_idUnique_id($mapping_id=''){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_mapping_category_with_product',array('mapping_id'=>$mapping_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->sub_cat_id;
      }
       return $name;
}

 
 public function getAddedOfferBtn($product_unique="",$variants_id=""){
   $name='<p style="color:#689F39;">Add Offer</p>';
  $sql=$this->sqlQuery_model->sql_select_where('tbl_product_apply_offer',array('offer_product_unique_id'=>$product_unique,'offer_variant_id'=>$variants_id));

       $currentDate=date('Y-m-d');
       $startDate=date($sql[0]->offer_start_date);
       $endDate=date($sql[0]->offer_end_date);

       $numberCurrent=strtotime($currentDate);
       $numberstart=strtotime($startDate);
       $numberend=strtotime($endDate);

    if($numberstart <= $numberCurrent && $numberend >= $numberCurrent){ 
       $expire='';
    }else{
      $expire='<span style="color: red;border: 1px solid red;padding: 1px 10px 1px;border-radius: 10px;">Expired</span>';
    }
      if($sql!=0){

          $name='<p style="color:green;font-weight:bold;">Added Offer</p>'.$expire;
      }
       return $name;
 }


  public function getAddedOffer($product_unique="",$variants_id=""){
   $offerData=0;
  $sql=$this->sqlQuery_model->sql_select_where('tbl_product_apply_offer',array('offer_product_unique_id'=>$product_unique,'offer_variant_id'=>$variants_id));
      if($sql!=0){
        $offerData=$sql;
      }
       return $offerData;
 }

  public function checkedOfferAdded($product_unique=""){
  $name='';
  $sql=$this->sqlQuery_model->sql_select_where('tbl_product_apply_offer',array('offer_product_unique_id'=>$product_unique));
      if($sql!=0){
       $name='<span style="font-size:12px;color:green;">(Offer added)</span>';
      }
    return $name;
 }



public function getLastRowId($tablename,$colname){
 
   $get_product=$this->sqlQuery_model->sql_query("SELECT MAX($colname) as rowid FROM $tablename");
   $rowValue=$get_product[0]->rowid;
    $getv=1;
   if($rowValue!=""){
     $getv=$rowValue+$getv;
   }
   return $getv;
   
}


public function getCountry_name($country_id){
      $sql=$this->sqlQuery_model->sql_select_where('countries',array('id'=>$country_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->name;
      }
       return $name;
}


public function getState_name($states_id){
      $sql=$this->sqlQuery_model->sql_select_where('states',array('id'=>$states_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->name;
      }
       return $name;
}


public function getCity_name($city_id){
      $sql=$this->sqlQuery_model->sql_select_where('cities',array('id'=>$city_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->name;
      }
       return $name;
}

public function getFoodhebitat_name($fh_unique_name){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_food_habitats',array('fh_unique_name'=>$fh_unique_name));
      $name="";
      if($sql!=0){
          $name=$sql[0]->fh_food_habitats;
      }
       return $name;
}


public function getCustomer_name($customer_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_customer',array('customer_id'=>$customer_id));
      $name="";
      if($sql!=0){
          $name=ucfirst($sql[0]->c_fname).' '.ucfirst($sql[0]->c_lname);
      }
       return $name;
}


public function getCustomer_mobile($customer_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_customer',array('customer_id'=>$customer_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->mobile;
      }
       return $name;
}

public function getCustomer_email($customer_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_customer',array('customer_id'=>$customer_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->email;
      }
       return $name;
}


// public function countVarients($pro_id){
//   $sql=$this->sqlQuery_model->sql_select_where('tbl_product',array('variants_product_id'=>$pro_id,'variant'=>1));
//       $count=0;
//       if($sql!=0){
//           $count=count($sql);
//       }
//        return $count;

// }





public function getMenus(){
  $sql=$this->sqlQuery_model->sql_select_where_desc('tbl_category','position',array('status'=>1));
  $arrCat=array();
  if($sql!=0){

      foreach($sql as $value){
            
            $sql_sub=$this->sqlQuery_model->sql_select_where_desc('tbl_sub_category','position',array('cat_id'=>$value->cat_id,'status'=>1));
          $arrCat[]=array(
                    'cat_id'=>$value->cat_id,
                    'category'=>$value->category,
                    'ci_cat_name'=>$value->ci_cat_name,
                    'status'=>$value->status,
                    'sub_cat'=>$sql_sub
                    );
      }
    
  }

 return $arrCat;

}


public function childCategoryListInMenu($cat_id,$subcat_id){
 
        $sql_sub=$this->sqlQuery_model->sql_select_where_desc('tbl_child_category','position',array('cat_id'=>$cat_id,'sub_cat_id'=>$subcat_id,'status'=>1));
    
        return $sql_sub;

}


public function getAllCategoryWithChile(){

    $listCate=$this->getMenus();
     $finalCate=array();
     if($listCate!=array()){
         
         foreach ($listCate as $key => $value) {


                  
                    $subCategory=array();
                    if($value['sub_cat']!=0){

                        foreach ($value['sub_cat'] as $key => $catvalue) {

              //              echo "<pre>";
              // print_r($catvalue->cat_id);
              // echo "</pre>";

                              $childCat=$this->childCategoryListInMenu($catvalue->cat_id,$catvalue->sub_cat_id);
                            
                               $arrSCat=array(
                                    'sub_cat_id'=>$catvalue->sub_cat_id,
                                    'cat_id'=>$catvalue->cat_id,
                                    'subCat_name'=>$catvalue->subCat_name,
                                    'ci_sub_cat_name'=>$catvalue->ci_sub_cat_name,
                                    'image'=>base_url("uploads/category/".$catvalue->subcat_image),
                                    'in_stock_status'=>$catvalue->in_stock_status,
                                    'status'=>$catvalue->status,
                                    'update_date'=>$catvalue->update_date,
                                    'childCat'=>($childCat!=0) ? $childCat :array()
                                    );

                            $subCategory[]=$arrSCat;

                        }
                  }

                   $arrCat=array(
                    'cat_id'=>$value['cat_id'],
                    'category'=>$value['category'],
                    'ci_cat_name'=>$value['ci_cat_name'],
                    'status'=>$value['status'],
                    'sub_cat'=>$subCategory
                    );

              $finalCate[]=  $arrCat;   
           }


     }


      return $finalCate;
}



// public function categoryMappingWithProduct($postData=array(),$_itemsCode,$lastInsertIn=''){
//         $final=array();
//           foreach ($postData['collectArr'] as $key => $cats_value) {

//                $finArr=array();

//                  foreach ($cats_value->subCate_id as $key => $subCat_value) {

//                        $getChild=array();
//                        foreach($postData['childCategory'] as $childValue){

//                               $explodeVchild=explode(':::',$childValue);
                               
//                               if($cats_value->cat_id==$explodeVchild[0] && $subCat_value==$explodeVchild[1]){
//                                  $arrSC=array('childCat'=>$explodeVchild[2]);
//                                   array_push($getChild,$explodeVchild[2]);

//                                }
//                          }

//                 array_push($finArr,array('cat_id'=>$cats_value->cat_id,'subCat'=>$subCat_value,'chilC'=>$getChild));
                               
//              }

//                   $final[] =  $finArr;            
//      }


      
//            $array1=array();
//            foreach ($final as $key => $value) {
                
//                      foreach ($value as $key => $sub_value) {
                          
//                            if($sub_value['chilC']!=array()){  
//                            foreach ($sub_value['chilC'] as $ckey => $child_value) {

//                                  $arrColl=array(
//                                      'cat_id'=>$sub_value['cat_id'],
//                                      'subCat'=>$sub_value['subCat'],
//                                      'childVa'=>$child_value
//                                  );

//                                  array_push($array1,$arrColl);     
//                            }

//                          }else{

//                              $arrColl=array(
//                                      'cat_id'=>$sub_value['cat_id'],
//                                      'subCat'=>$sub_value['subCat'],
//                                      'childVa'=>''
//                                  );

//                             array_push($array1,$arrColl);
//                      }
//                }
//          }

//      $mappingCate=array();
//      foreach ($array1 as $key => $value) {
//         $mappingCate['mapping_product_id']=$lastInsertIn;
//         $mappingCate['unique_number']= $_itemsCode;
//         $mappingCate['cat_id']= $value['cat_id'];
//         $mappingCate['pro_ci_cat_name']=$this->my_libraries->getCate_name_ci($value['cat_id']);
//         $mappingCate['category']=$this->my_libraries->getCate_name($value['cat_id']);
//         $mappingCate['sub_cat_id']= $value['subCat'];
//         $mappingCate['pro_ci_sub_cat_name']=$this->my_libraries->getSubCate_name_ci($value['subCat']);
//         $mappingCate['sub_category']=$this->my_libraries->getSubCate_name($value['subCat']);

//         $mappingCate['child_cat_id']= $value['childVa'];
//         $mappingCate['ci_child_cat_name']=$this->my_libraries->getChildCate_name_ci($value['childVa']);
//         $mappingCate['childCat_name']=$this->my_libraries->getChildCate_name($value['childVa']);
//          $main_array[]=$mappingCate;
//       }



//            //  echo "<pre>";
//            //  print_r($main_array);
//            //  echo "</pre>";
//            // exit;

//            // $mappingCate=array();
//            // foreach ($postData['collectArr'] as $key => $cats_value) {
             
//            //    $arrc=array();
//            //     foreach ($cats_value->subCate_id as $key => $subCat_value) {
//            //        // $mappingCate['mapping_product_id']=$lastInsertIn;
//            //        $mappingCate['unique_number']= $_itemsCode;
//            //        $mappingCate['cat_id']= $cats_value->cat_id;
//            //        $mappingCate['pro_ci_cat_name']=$this->my_libraries->getCate_name_ci($cats_value->cat_id);
//            //        $mappingCate['category']=$this->my_libraries->getCate_name($cats_value->cat_id);
//            //        $mappingCate['sub_cat_id']= $subCat_value;
//            //        $mappingCate['pro_ci_sub_cat_name']=$this->my_libraries->getSubCate_name_ci($subCat_value);
//            //        $mappingCate['sub_category']=$this->my_libraries->getSubCate_name($subCat_value);

//            //        $mappingCate['child_cat_id']= 0;
//            //        $mappingCate['ci_child_cat_name']='';
//            //        $mappingCate['childCat_name']='';

//            //        $arrc[]=$mappingCate;
//            //     }
//            //    $main_array[]=$arrc;
//            // }
//             // $result=[];
//             // foreach($main_array as $array){
//             // $result = array_merge($result, $array);
//             // }
//             // echo "<pre>";
//             // print_r($result);
//             // echo "</pre>";


//             $where_arr=array(
//               // 'mapping_product_id'=>$lastInsertIn,
//               'unique_number'=>$_itemsCode,
//               'status'=>1
//             );

//             $sql_checkExit=$this->sqlQuery_model->sql_select_where('tbl_mapping_category_with_product',$where_arr);
//             if($sql_checkExit!=0){
//             $this->sqlQuery_model->sql_delete('tbl_mapping_category_with_product',$where_arr);
//             }

//             $this->sqlQuery_model->sql_insert_batch('tbl_mapping_category_with_product',$main_array);

//        return   $main_array;   
// }

public function categoryMappingWithProduct($postData=array(),$_itemsCode,$lastInsertIn=''){

        
     
    

        $final=array();
          foreach ($postData['collectArr'] as $key => $cats_value) {

               $finArr=array();

                 foreach ($cats_value->subCate_id as $key => $subCat_value) {

                       $getChild=array();
                       foreach($postData['childCategory'] as $childValue){

                              $explodeVchild=explode(':::',$childValue);
                               
                              if($cats_value->cat_id==$explodeVchild[0] && $subCat_value==$explodeVchild[1]){
                                 $arrSC=array('childCat'=>$explodeVchild[2]);
                                  array_push($getChild,$explodeVchild[2]);

                               }
                         }

                array_push($finArr,array('cat_id'=>$cats_value->cat_id,'subCat'=>$subCat_value,'chilC'=>$getChild));
                               
             }

                  $final[] =  $finArr;            
     }


      
           $array1=array();
           foreach ($final as $key => $value) {
                
                     foreach ($value as $key => $sub_value) {
                          
                           if($sub_value['chilC']!=array()){  
                           foreach ($sub_value['chilC'] as $ckey => $child_value) {

                                 $arrColl=array(
                                     'cat_id'=>$sub_value['cat_id'],
                                     'subCat'=>$sub_value['subCat'],
                                     'childVa'=>$child_value
                                 );

                                 array_push($array1,$arrColl);     
                           }

                         }else{

                             $arrColl=array(
                                     'cat_id'=>$sub_value['cat_id'],
                                     'subCat'=>$sub_value['subCat'],
                                     'childVa'=>''
                                 );

                            array_push($array1,$arrColl);
                     }
               }
         }


     // echo "<pre>";
     // print_r($value);
     // echo "</pre>";

     $main_array=array();
     foreach ($array1 as $key => $value) {
        $mappingCate['mapping_product_id']=$lastInsertIn;
        $mappingCate['unique_number']= $_itemsCode;
        $mappingCate['cat_id']= $value['cat_id'];
        $mappingCate['pro_ci_cat_name']=$this->my_libraries->getCate_name_ci($value['cat_id']);
        $mappingCate['category']=$this->my_libraries->getCate_name($value['cat_id']);
        $mappingCate['sub_cat_id']= $value['subCat'];
        $mappingCate['pro_ci_sub_cat_name']=$this->my_libraries->getSubCate_name_ci($value['subCat']);
        $mappingCate['sub_category']=$this->my_libraries->getSubCate_name($value['subCat']);

        $mappingCate['child_cat_id']= $value['childVa'];
        $mappingCate['ci_child_cat_name']=$this->my_libraries->getChildCate_name_ci($value['childVa']);
        $mappingCate['childCat_name']=$this->my_libraries->getChildCate_name($value['childVa']);
         $main_array[]=$mappingCate;
      }




            $where_arr=array(
              'unique_number'=>$_itemsCode,
              'status'=>1
            );

            $sql_checkExit=$this->sqlQuery_model->sql_select_where('tbl_mapping_category_with_product',$where_arr);
            if($sql_checkExit!=0){
            $this->sqlQuery_model->sql_delete('tbl_mapping_category_with_product',$where_arr);
            }

            $this->sqlQuery_model->sql_insert_batch('tbl_mapping_category_with_product',$main_array);

       return   $main_array;   
}


public function mappingWerehouseWithProduct($postData=array(),$_itemsCode='',$lastInsertIn='',$session=''){
     $main_array=array();
    if($postData!=array()){
      foreach ($postData as $key => $value) {
          $mappingWh['wh_product_id']=$lastInsertIn;
          $mappingWh['wh_unique_number']= $_itemsCode;
          $mappingWh['werehouse_code']= $value;
          $mappingWh['updated_by']= $session['admin_name'];
         $main_array[]=$mappingWh;
      }

       $where_arr=array('wh_unique_number'=>$_itemsCode,'status'=>1);
       $sql_checkExit=$this->sqlQuery_model->sql_select_where('tbl_mapping_werehouse_with_product',$where_arr);
        if($sql_checkExit!=0){
        $this->sqlQuery_model->sql_delete('tbl_mapping_werehouse_with_product',$where_arr);
        }

        $this->sqlQuery_model->sql_insert_batch('tbl_mapping_werehouse_with_product',$main_array);
    }

    return $main_array;  

}


public function getdWerehosueInput($_itemsCode='',$product_id='',$codes_w=''){
   $where = array('wh_unique_number'=>$_itemsCode,'wh_product_id'=>$product_id,'werehouse_code'=>$codes_w);
   $sql_checkExit=$this->sqlQuery_model->sql_select_where('tbl_mapping_werehouse_with_product',$where);
   $checked = ($sql_checkExit!=0)? 'checked':'';
  return $checked;
}

public function getWerehouseCode($_itemsCode=''){
  $sql=$this->sqlQuery_model->sql_select_where('tbl_mapping_werehouse_with_product',array('wh_unique_number'=>$_itemsCode));
  $explodeV='';
  if($sql!=0){
   $whcod=array_column($sql,'werehouse_code');
   $explodeV=implode(',',$whcod);
  }

  return $explodeV;
 
}

public function checkWhcode($array1=array(),$array2=array()){

}


public function getTopMessage(){
  $sql=$this->sqlQuery_model->sql_select_where_desc('tbl_ads_message','position',array('status'=>1));
  return $sql;
}




public function getVariantUnits($product_id){
 
  // $sql=$this->sqlQuery_model->sql_select_where('tbl_product',array('variants_product_id'=>$product_id,'variant'=>1,'status'=>1));
   $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product WHERE variants_product_id=".$product_id." AND variant=1 AND status=1 ORDER BY weight DESC");

   // echo "<pre>";
   // print_r($sql);
   // echo "</pre>";
   // exit;
   $arr=array();

  if($sql!=0){
  ksort($sql);
    foreach($sql as $value){
      
                $arr[]=array(
                  'product_id'=>$value->product_id,
                  'weight' =>$value->weight,
                  'units' =>$value->units,
                  'price' =>$value->price
                );
            }
       }

   return array_reverse($arr);

}

public function stockManage($qty="",$variant_id=""){
 $return=false;
     if($qty!="" && $variant_id!=""){
        $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variant_id=".$variant_id."");
        if($sql!=0){
          $stock_qty=$sql[0]->stock;

          if($stock_qty >= $qty){
           
              if($stock_qty >= 1){

                  $stockmange=$stock_qty - $qty;
                  $update_variant=$this->sqlQuery_model->sql_update('tbl_product_variants',array('stock'=>$stockmange),array('variant_id'=>$variant_id));
                  $return=true;

                }

            }

         }
       
     }
  return $return;
}

function checkUndeliveryStatus($contents){
   if($contents!="" || $contents!=array()){
   $arrPush=array();
    foreach($contents as $value){
       $deliveryStatus = $this->getDeliverableAndNotDeliverableStatus($value['id']);
       array_push($arrPush,$deliveryStatus);
    }
    
    $result=true;
    if(in_array(0,$arrPush)){
      $result=false;
    }
     return $result;
   }

}

public function getStockvalidate($contents){
 $arrayErr=array();
 
   if($contents!="" || $contents!=array()){

     foreach($contents as $value){

               $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variant_id=".$value['options']['variant_id']." AND variants_in_stock_status=1 AND variants_status=1");

                if($sql!=0){

                  $stock_qty=$sql[0]->stock;

                   if($stock_qty!=0){

                       if($stock_qty >= $value['qty']){
                            array_push($arrayErr,1);
                        }else{
                            array_push($arrayErr,0);
                         }

                     }else{
                          array_push($arrayErr,0);
                         }

                  }else{
                    array_push($arrayErr,0);
                  }

         }  //end foreach

  }

  return $arrayErr;

}


public function getStockvalidate_api($contents){
 $arrayErr=array();
 
   if($contents!="" || $contents!=array()){

     foreach($contents as $value){

               $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variant_id=".$value['variant']['variant_id']." AND variants_in_stock_status=1 AND variants_status=1");

                if($sql!=0){

                  $stock_qty=$sql[0]->stock;

                   if($stock_qty!=0){

                       if($stock_qty >= $value['qty']){
                            array_push($arrayErr,1);
                        }else{
                            array_push($arrayErr,0);
                         }

                     }else{
                          array_push($arrayErr,0);
                         }

                  }else{
                    array_push($arrayErr,0);
                  }

         }  //end foreach

  }

  return $arrayErr;

}




public function getWishActive($pro_id){
   
   $customer_session=$this->my_libraries->mh_getCookies('customer');
   if($customer_session!=""){

   $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_wishlist WHERE cust_id=".$customer_session[0]->customer_id." AND product_id='".$pro_id."'");
   
   if($sql!=0){
      $getname=$sql[0]->status;
      if($getname==1){
        $icons='<span class="material-symbols-outlined idss'.$pro_id.' hovercdd wishlistactive">bookmark</span>';
        
      }else{
        $icons='<span class="material-symbols-outlined idss'.$pro_id.' hovercdd">bookmark</span>';
      }

   }else{
    $icons='<span class="material-symbols-outlined idss'.$pro_id.' hovercdd">bookmark</span>';
   }

 }else{
  $icons='<span class="material-symbols-outlined idss'.$pro_id.' hovercdd">bookmark</span>';
 }

return $icons;
}


public function generateNumeric($n) { 
    $generator = "1357902468ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
    $result = ""; 
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
  
    // Return result 
    return $result; 
} 


public function getCartDetails($cart_details){
  $c=array();
  if($cart_details!=array()){

       $categorys=$this->sqlQuery_model->sql_select_where('tbl_category',array('status'=>1));
       if($categorys!=0){

          $cart=array();
          $getFinalWeightKg=0;
          $finalQty=0;
        foreach($categorys as $value){
                $cart['category']=$value->cat_id;
                if($cart_details!=""){

                    $total_items=0;
                    $conversionFactorGetKg=0;
                    $arrayCart=array();

                    $wheightQty=0;

                     
                    foreach($cart_details as $value_cart){

                      if($value_cart['options']['units']=='g'){

                             $getWeight_gram=$value_cart['options']['packsize'] * $value_cart['qty'];

                        }else if($value_cart['options']['units']=='Kg'){
                           
                             $getWeight_gram=($value_cart['options']['packsize'] * 1000) * $value_cart['qty'];
                            
                        }
 

                      if($value->cat_id==$value_cart['options']['cat_id']){

                          array_push($arrayCart, $value_cart);
                          $total_items +=$value_cart['qty'];
                           $conversionFactorGetKg +=$getWeight_gram;
                        
                          // $conversionFactorGetKg +=$value_cart['options']['conversion_factor'] * $value_cart['qty'];
                       }

                        
                       $cart['cart']=$arrayCart;
                       $cart['total_items']=$total_items;
                       $cart['ItemsWeightKg']=sprintf('%.3f', $conversionFactorGetKg);
                     }


                     $getFinalWeightKg +=$conversionFactorGetKg;
                     $finalQty +=$total_items;

                    if($cart!=array()){
                       $c[]=$cart;
                     }
                }
            }

            
            $getInGramToKg = $getFinalWeightKg / 1000;
            $f['finalWieght']=sprintf('%.3f',$getInGramToKg);
            $f['finalQty']=$finalQty;
            // echo "<pre>";print_r($f);echo "</pre>";

       }
    }


  // $f['finalWieght']=$getFinalWeightKg;
  // $f['finalQty']=$finalQty;
  // $ff=array($c,$f);
  // echo "<pre>";print_r($c);echo "</pre>";
return array($c,$f);

}





// public function getCartDetails($cart_details){
//   $c=array();
//   if($cart_details!=array()){

//        $categorys=$this->sqlQuery_model->sql_select_where('tbl_category',array('status'=>1));
//        if($categorys!=0){

//           $cart=array();
//           $getFinalWeightKg=0;
//           $finalQty=0;
//         foreach($categorys as $value){
//                 $cart['category']=$value->cat_id;
//                 if($cart_details!=""){

//                     $total_items=0;
//                     $conversionFactorGetKg=0;
//                     $arrayCart=array();
//                     foreach($cart_details as $value_cart){

//                       if($value->cat_id==$value_cart['options']['cat_id']){
//                           array_push($arrayCart, $value_cart);
//                           $total_items +=$value_cart['qty'];
                        
//                           $conversionFactorGetKg +=$value_cart['options']['conversion_factor'] * $value_cart['qty'];
//                        }

//                        $cart['cart']=$arrayCart;
//                        $cart['total_items']=$total_items;
//                        $cart['ItemsWeightKg']=sprintf('%.3f', $conversionFactorGetKg);
//                      }

//                      $getFinalWeightKg +=$conversionFactorGetKg;
//                      $finalQty +=$total_items;

//                     if($cart!=array()){
//                        $c[]=$cart;
//                      }
//                 }
//             }


//             $f['finalWieght']=sprintf('%.3f',$getFinalWeightKg);
//             $f['finalQty']=$finalQty;
           

//        }
//     }


// return array($c,$f);

// }



public function place_final_order_razorpay($postData=array(),$order_process_step="",$order_payment='',$order_payment_status='',$customer_session='',$contents='',$total_amount=0,$sessionType='',$columsName='',$couponDetails='',$order_mode_type='',$api_id=''){
             // echo "hiii";
             // $customer_session=$this->my_libraries->mh_getCookies('customer');
             // echo "<pre>";
             // print_r($customer_session);
             // $contents= $this->cart->contents();
             $dlivetype=$this->session->userdata('dlivetype');
             $lastRowId=$this->getLastRowId('tbl_order_manager','order_id');
             $generated_order_id=$postData['shopping_order_id'];

             // $customer_remark=$postData['customer_remark'];
             // $customer_greeting=$postData['customer_greeting'];

             // echo "<pre>";
             // print_r($customer_remark);

             // echo "<pre>";
             // print_r($customer_greeting);
             $getShippingAddress=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_session[0]->customer_id,'setAddressDefault'=>1));

            

             // echo "<pre>";
             // print_r($customer_session[0]->email);
             // echo "</pre>";

             // exit;

           
             // $sessionType=$this->session->userdata('valueType');
             // echo "<pre>";
             // print_r($sessionType);

             // echo "<pre>";
             // print_r($customer_session);
           
             // $where='';
             // $columsName=$this->my_libraries->setPRoductCondition($customer_session,$where,$sessionType);

             // echo "<pre>";
             // echo "hiii";
             // print_r($customer_session);

              // echo "<pre>";
             // print_r($columsName);


             $itemsWieght=$this->getCartDetails($contents);
             // $shippingCharg=$this->catculateShippingCharges($itemsWieght[1]['finalQty'],$itemsWieght[1]['finalWieght'],$columsName,$contents,$total_amount);

             $shippingCharg=$this->my_libraries->getShippingChargesOnAddressPincode($customer_session,$contents,$itemsWieght,$dlivetype);

             // echo "<pre>";
             // print_r($shippingCharg['shippCharges']);
             // exit;

               
               // if($shippingCharg['shippingCharges']=='FREE') {
               //    $shippChargesFree=$shippingCharg['shippingCharges'];
               //    $shippCharges=0;
               // }else{
               //    $shippCharges=$shippingCharg['shippingCharges'];
               //    $shippChargesFree='';
               //  }
                // $couponDetails=$this->session->userdata('coupon');

                if($couponDetails!=""){
                      $finalAmount=$couponDetails['purchaseOrderAmountWithDisc']+$shippingCharg['shippCharges'];
                      $couponAmount=$couponDetails['couponValue'];
                  }else{
                      $finalAmount=$total_amount+$shippingCharg['shippCharges'];
                      $couponAmount=0;
                  }

                 
                  $getWhType=$this->sqlQuery_model->sql_select_where('tbl_delivery_pincode',array('pincode'=>$getShippingAddress[0]->pincode,'status'=>1,'courier_type'=>'dtdc'));

                  // echo "<pre>";
                  // print_r($getShippingAddress);
                  // echo "</pre>";
                  // exit;
                 
                 $order_manager=array(
                              'order_generated_order_id'=>$generated_order_id,
                              'order_cust_id'=>$customer_session[0]->customer_id,
                              'order_shipping_charges'=>0,//$shippingCharg['shippCharges'],//$shippCharges,
                              'order_total_purchase_amount'=>$total_amount,
                              'order_total_final_amt'=>$finalAmount,
                              'total_qty'=>$itemsWieght[1]['finalQty'],
                              'total_weight'=>$itemsWieght[1]['finalWieght'],
                              'order_coupon_offer_amt'=>$couponAmount,
                              'order_name'=>ucfirst($getShippingAddress[0]->fname).' '.ucfirst($getShippingAddress[0]->lname),
                              'order_mobile_no'=>$getShippingAddress[0]->mobile1,
                              'order_alt_mobile_no'=>$getShippingAddress[0]->mobile2,
                              'order_country'=>$getShippingAddress[0]->country,
                              'order_pincode'=>$getShippingAddress[0]->pincode,
                              'order_state'=>$getShippingAddress[0]->state,
                              'order_address'=>$getShippingAddress[0]->address1,
                              'order_alt_address'=>$getShippingAddress[0]->address2,
                              'order_area'=>$getShippingAddress[0]->area,
                              'order_landmark'=>$getShippingAddress[0]->landmark,
                              'order_company_name'=>$getShippingAddress[0]->company_name,
                              'order_city'=>$getShippingAddress[0]->city,
                              'order_email'=>($getShippingAddress[0]->email!="") ? $getShippingAddress[0]->email : $customer_session[0]->email,
                              'registration'=>$postData['registration'],
                              'company_name'=>$postData['company_name'],
                              'company_address'=>$postData['company_address'],
                              'order_type_of_address'=>$getShippingAddress[0]->nick_name,
                              'order_type_of_address_others_value'=>$getShippingAddress[0]->others,
                              'razorpay_payment_id'=>null,//$postData['razorpay_payment_id'],
                              'razorpay_order_id'=>null,//$postData['razorpay_order_id'],
                              'razorpay_signature'=>null,//$postData['razorpay_signature'],
                              'order_customer_remark'=>null, //$customer_remark,
                              'order_customer_greating'=>null, //$customer_greeting,
                              'order_payment'=>$order_payment,
                              'instamojo_longurl'=>null, // $api_id->longurl,
                              'order_payment_status'=>$order_payment_status,
                              'order_instamojo_id'=>$api_id->id,
                              'payment_mode'=>$order_mode_type,
                              'take_away'=>null,//$postData['timeSlot'],
                              'order_type'=>'delivery', //(($postData['timeSlot']=="") ? 'delivery' :'take_away'),
                              'order_status'=>$order_process_step,
                              'order_werehouse'=>$getWhType[0]->werehouse,
                              'order_date'=>date('Y-m-d H:i:s')
                             );

                 // echo "<pre>";
                 // print_r($order_manager);
                 // exit;
           
              $getBillingAddress=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_session[0]->customer_id,'setAddressDefault'=>1,'address_type'=>'billingAddress'));
              

              if($getBillingAddress!=0){
                  $order_manager['bill_order_name']=ucfirst($getBillingAddress[0]->fname).' '.ucfirst($getBillingAddress[0]->lname);
                  $order_manager['bill_order_mobile_no']=$getShippingAddress[0]->mobile1;
                  $order_manager['bill_order_alt_mobile_no']=$getShippingAddress[0]->mobile2;
                  $order_manager['bill_order_country']=$getShippingAddress[0]->country;
                  $order_manager['bill_order_pincode']=$getShippingAddress[0]->pincode;
                  $order_manager['bill_order_state']=$getShippingAddress[0]->state;
                  $order_manager['bill_order_address']=$getShippingAddress[0]->address1;
                  $order_manager['bill_order_alt_address']=$getShippingAddress[0]->address2;
                  $order_manager['bill_order_landmark']=$getShippingAddress[0]->landmark;
                  $order_manager['bill_order_area']=$getShippingAddress[0]->area;
                  
                  $order_manager['bill_order_company_name']=$getShippingAddress[0]->company_name;
                  $order_manager['bill_order_email']=($getShippingAddress[0]->email!="") ? $getShippingAddress[0]->email : $customer_session[0]->email;
                  $order_manager['bill_order_city']=$getShippingAddress[0]->city;
                  $order_manager['bill_order_type_of_address']=$getShippingAddress[0]->nick_name;
                  $order_manager['bill_order_type_of_address_others_value']=$getShippingAddress[0]->others;
                  $order_manager['same_address_delivery']=1;
                  
              }else{
                 $getBillingAdd=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_session[0]->customer_id,'address_type'=>'billingAddress'));

                 $name=($getBillingAdd!=0) ? ucfirst($getBillingAdd[0]->fname).' '.ucfirst($getBillingAdd[0]->lname) : null;
                  $order_manager['bill_order_name']=$name;
                  $order_manager['bill_order_mobile_no']=($getBillingAdd!=0) ? $getBillingAdd[0]->mobile1 : null;
                  $order_manager['bill_order_alt_mobile_no']=($getBillingAdd!=0) ? $getBillingAdd[0]->mobile2 : null;
                  $order_manager['bill_order_country']=($getBillingAdd!=0) ? $getBillingAdd[0]->country : null;
                  $order_manager['bill_order_pincode']=($getBillingAdd!=0) ? $getBillingAdd[0]->pincode : null;
                  $order_manager['bill_order_state']=($getBillingAdd!=0) ? $getBillingAdd[0]->state : null;
                  $order_manager['bill_order_address']=($getBillingAdd!=0) ? $getBillingAdd[0]->address1 : null;
                  $order_manager['bill_order_alt_address']=($getBillingAdd!=0) ? $getBillingAdd[0]->address2 : null;
                  $order_manager['bill_order_landmark']=($getBillingAdd!=0) ? $getBillingAdd[0]->landmark : null;
                  $order_manager['bill_order_area']=($getBillingAdd!=0) ? $getBillingAdd[0]->area : null;
                  $order_manager['bill_order_company_name']=($getBillingAdd!=0) ? $getBillingAdd[0]->company_name : null;
                  $order_manager['bill_order_email']=($getBillingAdd!=0) ? (($getBillingAdd[0]->email!="") ? $getBillingAdd[0]->email : $customer_session[0]->email) : null;
                  $order_manager['bill_order_city']=($getBillingAdd!=0) ? $getBillingAdd[0]->city : null;
                  $order_manager['bill_order_type_of_address']=($getBillingAdd!=0) ? $getBillingAdd[0]->nick_name : null;
                  $order_manager['bill_order_type_of_address_others_value']=($getBillingAdd!=0) ? $getBillingAdd[0]->others : null;
                  $order_manager['same_address_delivery']=0;
              }


              $add_order=$this->sqlQuery_model->sql_insert('tbl_order_manager',$order_manager);
            // $add_order=1;
              if($add_order){
                
                       // $process_step='Pending';
                        $process_step=$order_process_step;
                        foreach($contents as $key=>$value){

                          // echo "<pre>";
                          //       print_r($value['options']['sku_id']);
                          //       echo "</pre>";
                          //       exit;

                         $getPRoduct=$this->sqlQuery_model->sql_select_where('tbl_product',array('product_id'=>$value['id']));
                         $gstManage=$this->getGSTCalculation($value['subtotal'],$value['qty'],$getShippingAddress,$value,$getPRoduct,$getWhType[0]->werehouse);

                         // echo "<pre>";
                         // print_r($getWhType);
                         // echo "</pre>";
                         // exit;

                         // $productOffer= $this->getCustomerProductOffer($value['options']['product_gen_id'],$value['options']['variant_id'],$value['qty']);
                         // if($productOffer!=array() && $order_payment_status!='Unpaid'){
                         //   $this->stockManage($productOffer['pQty'],$productOffer['veriant_id']);
                         //  }

                         // echo "<pre>";
                         // print_r($value);
                         // echo "</pre>";
                         // echo "<pre>";
                         // print_r($value);
                         // echo "</pre>";
                         
                         // if($value['options']['units']=='g'){
                         //     $getWeight_gram=$value['options']['packsize'] * $value['qty'];
                         // }else if($value['options']['units']=='Kg'){
                         //     $getWeight_gram=($value['options']['packsize'] * 1000) * $value['qty'];
                         // }
                         // $getInGramToKg = $getWeight_gram / 1000;

                           $offerPersRate = productOfferPercantage($value['price'],$value['options']['before_off_price']);
                           if($offerPersRate!=0){
                             $discountAmount = $value['options']['before_off_price'] - $value['price'];
                           }else{
                             $discountAmount =0;
                           }

                          $order_products=array(
                                    'pro_generated_order_id'=>$generated_order_id,
                                    'pro_sys_product_id'=>$value['options']['product_id'],
                                    'pro_cust_id'=>$customer_session[0]->customer_id,
                                    'pro_product_qty'=>$value['qty'],
                                    'pro_conversion_factor_kg'=>0, //$getInGramToKg, //$value['options']['conversion_factor'],
                                    'pro_before_disc_mrp'=>$value['options']['before_off_price'],
                                    'pro_discount_rate'=>$offerPersRate,
                                    'pro_discount_amount'=>$discountAmount,
                                    'pro_product_selling_price'=>$value['price'],
                                    'pro_product_name'=>$value['name'],
                                    'pro_own_product_id'=>$value['options']['product_gen_id'],
                                    'pro_subtotal'=>$value['subtotal'],
                                    'pro_product_img'=>$value['options']['image'],
                                    'pro_igst_rate'=>$gstManage[0]['iGstRate'],
                                    'pro_igst_amount'=>$gstManage[0]['iGstAmount'],
                                    'pro_cgst_rate'=>$gstManage[2]['cGstRate'],
                                    'pro_cgst_amount'=>$gstManage[2]['cGstAmount'],
                                    'pro_sgst_rate'=>$gstManage[1]['sGstRate'],
                                    'pro_sgst_amount'=>$gstManage[1]['sGstAmount'],
                                    'pro_taxable_amount'=>$gstManage[4],
                                    'pro_type_of_tax'=>$gstManage[3]['type'],
                                    'pro_sku_id'=>$value['options']['sku_id'],
                                    'pro_hsn_code'=>$value['options']['hsn_code'],
                                    'pro_order_place_state'=>$getShippingAddress[0]->state,
                                    'pro_updated_by'=>'Buyer',
                                    'pro_cat_id'=>$value['options']['cat_id'],
                                    'pro_sub_cat_id'=>$value['options']['sub_cat_id'],
                                    'pro_cat_name'=>$value['options']['category'],
                                    'packsize'=>$value['options']['packsize'],
                                    'units_id'=>$value['options']['units_id'],
                                    'units'=>$value['options']['units'],
                                    'pro_sub_cat_name'=>$value['options']['sub_category'],
                                    // 'pro_offer_productName'=>null,
                                    // 'pro_offer_category'=>null,
                                    // 'pro_offer_image'=>null
                                    // 'pro_offer_packSize'=>null,
                                    // 'pro_offer_units'=>null,
                                    // 'pro_offer_pQty'=>null,
                                    // 'pro_offer_status'=>null,
                                    'pro_product_order_date'=>date('Y-m-d H:i:s'),
                                    'pro_werehouse'=>$getWhType[0]->werehouse,
                                    'pro_order_status'=>$order_process_step
                                  );

                         
                          $add_order_products=$this->sqlQuery_model->sql_insert('tbl_order_products',$order_products);
                         $insertp_id=$this->sqlQuery_model->get_last_inset_id('tbl_order_products');

                            // // $this->insertOfferProduct($productOffer,$generated_order_id,$customer_session[0]->customer_id,$order_process_step);

                             if($add_order_products && $order_payment_status!='Unpaid'){
                               $this->stockManage($value['qty'],$value['options']['variant_id']);
                              }

                             $items[]=(object)$order_products;
                        }

                        // exit;
                        // echo "<pre>";
                        // print_r($items);
                        // echo "</pre>";
                        // exit;

                             $orders['order_manager']=$order_manager;
                             $orders['orderItems']=$items;

                            if($add_order_products){
                               $this->cart->destroy();
                               $this->session->unset_userdata('coupon');
                               $this->session->unset_userdata('dlivetype');
                               // $this->session->unset_userdata('slotSet');
                               // $this->session->unset_userdata('customer_remark');
                               // $this->session->unset_userdata('customer_greating');

                                   $data['status']=1;
                                   $data['message']="Your order has been placed.";
                                   $data['url']=base_url('success');
                                   // $data['flag']=1;
                                   // $data['cart']=$contents;
                                   // $data['page']=$this->load->view('frontend/containerPage/order-place',$data);
                                   $data['productOrder']=$orders;
                                   return $data;
                              
                             }else{
                                   $data['status']=0;
                                   $data['message']="Order failed to place.";
                                   $data['url']=base_url('failed');
                                   // $data['flag']=1;
                                   // $data['cart']=$contents;
                                   // $data['page']=$this->load->view('frontend/containerPage/order-place',$data);
                                   $data['productOrder']=$orders;
                                   return $data;
                                }

                    }else{

                      $data['status']=0;
                      $data['message']="Someting went wrong.";
                      $data['url']=base_url('failed');
                      // $data['flag']=1;
                      // $data['cart']=$contents;
                      // $data['page']=$this->load->view('frontend/containerPage/order-place',$data);
                      $data['productOrder']=array();
                      return $data;
                     }
 
      
     }


public function displayProductAccourdingToDeliveryType($get_pincode="",$takeWay="",$actionType=0){

    // if(isset($get_pincode) && !empty($get_pincode) && $get_pincode!='take_away'){
    //       $getDeliType=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_state_pincode WHERE pincode=$get_pincode");
    //            if($getDeliType!=0){
    //             $columsName=$getDeliType[0]->delivery_type;
    //             $locationData=$getDeliType;
    //             }
    //   }else{
    //     // echo "hiii";
    //         $columsName='pick_up_store';
    //         $locationData='';
    //        }
    //  return array($columsName,$locationData);
}




public function deliveryTypeDisplayProduct($get_pincode="",$takeWay="",$actionType=0){

    $sesionValue=$this->session->userdata('valueType');


// echo $actionType;
   $user=$this->my_libraries->mh_getCookies('customer');

   // echo "<pre>";
   // print_r($user);

   $columsName='';
   $locationData='';
  
  if(($sesionValue==""|| $sesionValue!="")  && $actionType==1){
     // echo "hiiiieeettt";
        $response=$this->displayProductAccourdingToDeliveryType($get_pincode,$takeWay,$actionType);

         $columsName=$response[0];
         $locationData=$response[1];



        

   }else{

 
           
        
           if($user!=""){
              $sqlPincode=$this->sqlQuery_model->sql_select_where('tbl_userlocationmanage',array('user_id'=>$user[0]->customer_id)); 
            }else{
              $sqlPincode=0;
            }



          if($sqlPincode==0){
                if($sesionValue['value']=='take_away'){
                    $columsName='pick_up_store';
                    $locationData='';
                }else{
                   $columsName=$sesionValue['location'][0]->delivery_type;
                   $locationData=$sesionValue['location'];
                }

            }else{

    //           echo "hiihh";
    // echo "<pre>";
    //  print_r($get_pincode);
    //  echo "</pre>";

    //   echo "<pre>";
    //  print_r($takeWay);
    //  echo "</pre>";
    //   echo "<pre>";
    //  print_r($actionType);
    //  echo "</pre>";

     // exit;
                

                  
                   if($sqlPincode[0]->pincode=="take_away"){
                        $columsName='pick_up_store';
                        $locationData='';
                    }else{
           
                       
                         if($sesionValue==""){
                             $get_pincode_=$sqlPincode[0]->pincode;
                             $takeWay='';
                             $response=$this->displayProductAccourdingToDeliveryType($get_pincode_,$takeWay,$actionType);
                             $session = array('value' =>$get_pincode,'location'=>$response[1]);
                             $this->session->set_userdata('valueType',$session); 

                             $columsName=$response[0];
                             $locationData=$response[1];
                         }else{

                          $columsName=$sesionValue['location'][0]->delivery_type;
                          $locationData=$sesionValue['location'];

                         }

                    }
            }

   }

         
       // echo "hiii5555i";
         // $array=array($columsName,$locationData);
         // echo "<pre>";
         // print_r($array);
         // echo "</pre>";
        
        // $this->session->set_userdata('valueType',$session); 
         return array($columsName,$locationData);
}



// public function deliveryTypeDisplayProduct($get_pincode="",$takeWay=""){
// // echo "SELECT * FROM tbl_product WHERE ".$columsName."=1 AND status=1";


//    $columsName='';
//    $locationData='';
//     if(isset($get_pincode) && $get_pincode!=""){
         
//            // $getDeliType=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_delivery_place WHERE status=1");
//               $getDeliType_nd=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_without_maharashtra_national_delivery WHERE pincode=$get_pincode");

//               if($getDeliType_nd!=0){
//                   $columsName='national_delivery';
//                   $locationData=$getDeliType_nd;
//               }else{
//                   $getDeliType_mp=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_within_maharashtra_pincode WHERE pincode=$get_pincode"); 

//                   if($getDeliType_mp!=0){
//                      $columsName='excluding_local_hyperlocal';
//                      $locationData=$getDeliType_mp;
//                   }else{
                      
//                        $getDeliType_hp=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_hyperlocal_pincode WHERE pincode=$get_pincode"); 
//                        if($getDeliType_hp!=0){
//                              $columsName='hyperlocal_delivery';
//                              $locationData=$getDeliType_hp;
//                        }else{
                           
//                              $getDeliType_local=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_local_pincode WHERE pincode=$get_pincode"); 
//                              if($getDeliType_local!=0){
//                                 $columsName='local_delivery';
//                                 $locationData=$getDeliType_local;
//                              } // tbl_local_pincode

//                        } //tbl_hyperlocal_pincode

//                   }  //excluding_local_hyperlocal

//               }   //tbl_within_maharashtra_pincode
          
//       }else{
//           $columsName='pick_up_store';
//           $locationData='';
//          }
//         // $this->session->set_userdata('valueType',$session); 
//          return array($columsName,$locationData);
// }

public function setLocationPinforUser($userLocPin,$sql){

      if($sql!=""){

             if($userLocPin!=""){
                $sqlPin=$this->sqlQuery_model->sql_select_where('tbl_userlocationmanage',array('user_id'=>$sql[0]->customer_id)); 
                  if($sqlPin==0){
                    $arrPost['user_id']=$sql[0]->customer_id;
                    $arrPost['pincode']=$userLocPin['value'];
                    $postSql=$this->sqlQuery_model->sql_insert('tbl_userlocationmanage',$arrPost);

                  }else{
                     $arrPost['pincode']=$userLocPin['value'];
                     $postSql=$this->sqlQuery_model->sql_update('tbl_userlocationmanage',$arrPost,array(' userLocMan_id'=>$sqlPin[0]->userLocMan_id));
                     }
              }
         }

   return true;
}


public function getCountCustomerUse($coupon_code=""){
    
      $sql="SELECT * FROM tbl_coupon WHERE coupon_code='".$coupon_code."'";
      $sqlCountCouponUse=$this->sqlQuery_model->sql_query($sql);
      if($sqlCountCouponUse!=0){
         $count=count($sqlCountCouponUse);
      }else{
         $count=0;
      }
    return $count;
}



public function getCountItems_all(){
     // $sqlCountProduct=$this->sqlQuery_model->sql_select_where('tbl_product',array('image1!='=>'','status'=>1)); 
     
     $sql_join="SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE pro.image1!='' AND pro.status=1 GROUP BY mapp.unique_number";
      $sqlCountProduct=$this->sqlQuery_model->sql_query($sql_join);

      if($sqlCountProduct!=0){
         $count=count($sqlCountProduct);
      }else{
         $count=0;
      }
    return $count;
}

public function getCountItems_byCat($catName=""){
     // $sqlCountProduct=$this->sqlQuery_model->sql_select_where('tbl_product',array('image1!='=>'','pro_ci_cat_name'=>$catName,'status'=>1)); 

     $sql_join="SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE pro.image1!='' AND mapp.pro_ci_cat_name='".$catName."' AND pro.status=1";
        $sqlCountProduct=$this->sqlQuery_model->sql_query($sql_join);

      if($sqlCountProduct!=0){
         $count=count($sqlCountProduct);
      }else{
         $count=0;
      }
    return $count;
}

public function getCountItems_bysubCat($subCatName=""){
     // $sqlCountProduct=$this->sqlQuery_model->sql_select_where('tbl_product',array('image1!='=>'','pro_ci_sub_cat_name'=>$subCatName,'status'=>1)); 

      $sql_join="SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE pro.image1!='' AND mapp.pro_ci_sub_cat_name='".$subCatName."' AND pro.status=1 GROUP BY mapp.unique_number";
      $sqlCountProduct=$this->sqlQuery_model->sql_query($sql_join);

      if($sqlCountProduct!=0){
         $count=count($sqlCountProduct);
      }else{
         $count=0;
      }
    return $count;
}


public function checkOrderExits($order_id=""){
     $sqlExitsOrder=$this->sqlQuery_model->sql_select_where('tbl_order_manager',array('order_generated_order_id'=>$order_id)); 
      $result=false;
      if($sqlExitsOrder==0){
        $result=true;
      }
    return $result;
}


public function checkUserExits($username=""){
     $sqlExitsUser=$this->sqlQuery_model->sql_select_where('tbl_admin',array('admin_username'=>$username)); 
      $result=false;
      if($sqlExitsUser==0){
        $result=true;
      }
    return $result;
}

public function checkUserExitsById($admin_id=""){
     $sqlExitsUser=$this->sqlQuery_model->sql_select_where('tbl_admin',array('admin_id'=>$admin_id,'admin_type'=>'U')); 
      $result=false;
      if($sqlExitsUser==0){
        $result=true;
      }
    return $result;
}

public function checkUserExitsByemailId($email_id=""){
     $sqlExitsUser=$this->sqlQuery_model->sql_select_where('tbl_admin',array('admin_email'=>$email_id,'admin_type'=>'U')); 
      $result=false;
      if($sqlExitsUser!=0){
        $result=true;
      }
    return $result;
}


public function checkCustomerExitsByEmailId($email_id=""){
     $sqlExitsUser=$this->sqlQuery_model->sql_select_where('tbl_customer',array('email'=>$email_id)); 
      $result=false;
      if($sqlExitsUser!=0){
        $result=true;
      }
    return $result;
}

public function checkCustomerExitsByMobilelId($mobile_id=""){
     $sqlExitsUser=$this->sqlQuery_model->sql_select_where('tbl_customer',array('mobile'=>$mobile_id)); 
      $result=false;
      if($sqlExitsUser!=0){
        $result=true;
      }
    return $result;
}

public function checkGTypeExitsById($header_name=""){
     $sqlExitsUser=$this->sqlQuery_model->sql_select_where('tbl_gallery_type',array('header_name'=>$header_name)); 
      $result=false;
      if($sqlExitsUser==0){
        $result=true;
      }
    return $result;
}

// $data['period_list']=$this->sqlQuery_model->sql_select('period_type','position');

public function getProductShiftLife(){
 
      $getPeriodtype=$this->sqlQuery_model->sql_query("SELECT `period_type` FROM period_type WHERE status=1 ORDER BY position DESC");
      $array_collect=array();
      if($getPeriodtype!=0){

          foreach(array_reverse($getPeriodtype) as $pType){

                     $sqlProduct=$this->sqlQuery_model->sql_query("SELECT DISTINCT `shelf_life_period`,`shelf_life_period_type` FROM tbl_product WHERE status=1 AND (shelf_life_period_type='".ucfirst($pType->period_type)."' OR shelf_life_period_type='".$pType->period_type."') ORDER BY shelf_life_period ASC");
                       if($sqlProduct!=0){
                           array_push($array_collect, $sqlProduct);
                         }
               }
           }

          $getArrv=array();
           if($array_collect!=array()){
              foreach($array_collect as $values){
                       foreach($values as $vlas){
                        $getArrv[]=$vlas;
                       }
                 }
             }

     return $getArrv; 
}


public function getProductShiftLife_inputValue($shelf_life_period,$period_type){
 
      $getPeriodtype=$this->sqlQuery_model->sql_query("SELECT `period_type` FROM period_type WHERE status=1 ORDER BY position DESC");
      $array_collect=array();
      if($getPeriodtype!=0){

          foreach(array_reverse($getPeriodtype) as $pType){

                     $sqlProduct=$this->sqlQuery_model->sql_query("SELECT DISTINCT `shelf_life_period`,`shelf_life_period_type` FROM tbl_product WHERE status=1 AND (shelf_life_period_type='".ucfirst($pType->period_type)."' OR shelf_life_period_type='".$pType->period_type."') ORDER BY shelf_life_period ASC");
                       if($sqlProduct!=0){
                           array_push($array_collect, $sqlProduct);
                         }
               }
           }

           $hour=$this->getStatusPeriod_inputvalue('hour');
           $hours=$this->getStatusPeriod_inputvalue('hours');

           $day=$this->getStatusPeriod_inputvalue('day');
           $days=$this->getStatusPeriod_inputvalue('days');

           $week=$this->getStatusPeriod_inputvalue('week');
           $weeks=$this->getStatusPeriod_inputvalue('weeks');

           $month=$this->getStatusPeriod_inputvalue('month');
           $months=$this->getStatusPeriod_inputvalue('months');

           $year=$this->getStatusPeriod_inputvalue('year');
           $years=$this->getStatusPeriod_inputvalue('years');

             

            if($period_type=='hour'){
               $getPeriodType=array_filter(array($hour,$hours,$day,$days,$week,$weeks,$month,$months,$year,$years));
            }else if($period_type=='hours'){
              $getPeriodType=array_filter(array($hours,$day,$days,$week,$weeks,$month,$months,$year,$years));

            }else if($period_type=='day'){
              $getPeriodType=array_filter(array($day,$days,$week,$weeks,$month,$months,$year,$years));

            }else if($period_type=='days'){
              $getPeriodType=array_filter(array($days,$week,$weeks,$month,$months,$year,$years));

            }else if($period_type=='week'){
              $getPeriodType=array_filter(array($week,$weeks,$month,$months,$year,$years));

            }else if($period_type=='weeks'){
              $getPeriodType=array_filter(array($weeks,$month,$months,$year,$years));

            }else if($period_type=='month'){
              $getPeriodType=array_filter(array($month,$months,$year,$years));

            }else if($period_type=='months'){
              $getPeriodType=array_filter(array($months,$year,$years));

            }else if($period_type=='year'){
              $getPeriodType=array_filter(array($year,$years));

            }else if($period_type=='years'){
              $getPeriodType=array_filter(array($years));
            }else{
              $getPeriodType=array('');
            }
             // echo "<pre>";
             // print_r($getPeriodType) ;
             // echo "</pre>";

           $getArrv=array();
            if($array_collect!=array()){

               foreach($array_collect as $values){

                       foreach($values as $keys=>$vlas){

                            if(in_array($vlas->shelf_life_period_type, $getPeriodType)){
                                   $getArrv[]=$vlas->shelf_life_period.'-'.$vlas->shelf_life_period_type;
                            }
                         }
                     }
                }
               
              $array = array_flip($getArrv);
              $keyValue=$shelf_life_period.'-'.$period_type;
              // echo "<pre>";
              // print_r($array) ;
              // echo "</pre>";
              for($i=$array[$keyValue]-1; $i>=0; $i--){
                  unset($getArrv[$i]);
              }
              // echo "<pre>";
              // print_r($getArrv) ;
              // echo "</pre>";

     return implode(',', $getArrv);
}

public function getStatusPeriod_inputvalue($period){
   $sql_period=$this->sqlQuery_model->sql_select_where('period_type',array('ci_period_name'=>$period,'status'=>1));
   return ($sql_period!=0) ? $period : '';
}

public function getStatusPeriod($period){
   $sql_period=$this->sqlQuery_model->sql_select_where('period_type',array('ci_period_name'=>$period,'status'=>1));
   return ($sql_period!=0) ? '\''.$period.'\'' : '';
}


public function shiftlifeAbove($shelf_life_period=null,$shelf_life_period_type=null){
   $result='';
    
     $hour=$this->getStatusPeriod('hour');
     $hours=$this->getStatusPeriod('hours');

     $day=$this->getStatusPeriod('day');
     $days=$this->getStatusPeriod('days');

     $week=$this->getStatusPeriod('week');
     $weeks=$this->getStatusPeriod('weeks');

     $month=$this->getStatusPeriod('month');
     $months=$this->getStatusPeriod('months');

     $year=$this->getStatusPeriod('year');
     $years=$this->getStatusPeriod('years');

 // echo "<pre>";
 // print_r($hours);
 // echo "</pre>";
 // $getType=array($hour,$hours,$day,$days,$week,$weeks,$month,$months,$year,$years);

  
   if($shelf_life_period_type=='hour' || $shelf_life_period_type=='hours'){

      // $getPeriodType=array('\'hour\'','\'hours\'','\'day\'','\'days\'','\'week\'','\'weeks\'','\'month\'','\'months\'','\'year\'','\'years\'');
       $getPeriodType=array_filter(array($hour,$hours,$day,$days,$week,$weeks,$month,$months,$year,$years));

         
   }else if($shelf_life_period_type=='day' || $shelf_life_period_type=='days'){

      // $getPeriodType=array('\'day\'','\'days\'','\'week\'','\'weeks\'','\'month\'','\'months\'','\'year\'','\'years\'');
      $getPeriodType=array_filter(array($day,$days,$week,$weeks,$month,$months,$year,$years));

   }else if($shelf_life_period_type=='week' || $shelf_life_period_type=='weeks'){

      // $getPeriodType=array('\'week\'','\'weeks\'','\'month\'','\'months\'','\'year\'','\'years\'');
      $getPeriodType=array_filter(array($week,$weeks,$month,$months,$year,$years));

    }else if($shelf_life_period_type=='month' || $shelf_life_period_type=='months'){

      // $getPeriodType=array('\'month\'','\'months\'','\'year\'','\'years\'');
        $getPeriodType=array_filter(array($month,$months,$year,$years));
    }else if($shelf_life_period_type=='year' || $shelf_life_period_type=='years'){

      // $getPeriodType=array('\'year\'','\'years\'');
      $getPeriodType=array_filter(array($year,$years));
    }else{

      $getPeriodType=array('');
    }

  $implode=($getPeriodType!=array())? 'AND shelf_life_period_type IN ('.implode(',', $getPeriodType).')' :'' ;
// echo "SELECT `shelf_life_period`,`shelf_life_period_type` FROM tbl_product WHERE status=1 AND shelf_life_period > $shelf_life_period $implode";

    $sqlProduct=$this->sqlQuery_model->sql_query("SELECT `shelf_life_period`,`shelf_life_period_type` FROM tbl_product WHERE status=1 AND shelf_life_period > $shelf_life_period $implode");

    if($sqlProduct==0){
       
           if($shelf_life_period_type=='hour' || $shelf_life_period_type=='hours'){
                // $getPeriodType_aa=array('\'day\'','\'days\'','\'week\'','\'weeks\'','\'month\'','\'months\'','\'year\'','\'years\'');
                  $getPeriodType_aa=array_filter(array($day,$days,$week,$weeks,$month,$months,$year,$years));
                  if($getPeriodType_aa==array()){
                    $getPeriodType_aa=array('\'no-period-type\'');
                  }

           }else if($shelf_life_period_type=='day' || $shelf_life_period_type=='days'){
                // $getPeriodType_aa=array('\'week\'','\'weeks\'','\'month\'','\'months\'','\'year\'','\'years\'');
                $getPeriodType_aa=array_filter(array($week,$weeks,$month,$months,$year,$years));
           }else if($shelf_life_period_type=='week' || $shelf_life_period_type=='weeks'){

                // $getPeriodType_aa=array('\'month\'','\'months\'','\'year\'','\'years\'');
                 $getPeriodType_aa=array_filter(array($month,$months,$year,$years));
                 if($getPeriodType_aa==array()){
                    $getPeriodType_aa=array('\'no-period-type\'');
                  }
           }else if($shelf_life_period_type=='month' || $shelf_life_period_type=='months'){

                 // $getPeriodType_aa=array('\'year\'','\'years\'');
                  $getPeriodType_aa=array_filter(array($year,$years));
                  if($getPeriodType_aa==array()){
                    $getPeriodType_aa=array('\'no-period-type\'');
                  }

            }else{
                 $getPeriodType_aa=array('\'no-period-type\'');
              }

               $implode_again=($getPeriodType_aa!=array())? 'AND shelf_life_period_type IN ('.implode(',', $getPeriodType_aa).')' :'' ;
               $sqlProduct_aa=$this->sqlQuery_model->sql_query("SELECT `shelf_life_period`,`shelf_life_period_type` FROM tbl_product WHERE status=1 $implode_again");

               if($sqlProduct_aa!=0){
                  $result='above';
                } 
       }

     if($sqlProduct!=0){
      $result='above';
     } 

     return $result;         
}







public function getCountItems_byShiftLife($shelf_life_period="",$shelf_life_period_type=""){
     $sqlCountProduct=$this->sqlQuery_model->sql_select_where('tbl_product',array('shelf_life_period'=>$shelf_life_period,'shelf_life_period_type'=>$shelf_life_period_type,'status'=>1)); 
      if($sqlCountProduct!=0){
         $count=count($sqlCountProduct);
      }else{
         $count=0;
      }
    return $count;
  }


public function getProductlistCount($where_and_chain="",$foodhab_name="",$shifLife_name="",$columsName="",$sortPrice="",$search_like="",$priceRange="",$ratingProductId=""){

   // $product_list=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product WHERE $where_and_chain $foodhab_name $shifLife_name $sortPrice $search_like");

   $sql_join="SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE $where_and_chain $foodhab_name $shifLife_name $search_like $priceRange $ratingProductId GROUP BY mapp.unique_number $sortPrice";

   $product_list=$this->sqlQuery_model->sql_query($sql_join);

   // echo "<pre>";
   // print_r($product_list);
   // echo "</pre>";

   // exit;

     
// SELECT column_name(s)
// FROM table1
// INNER JOIN table2
// ON table1.column_name = table2.column_name;


       $pArr=array();
       if($product_list!=0){
          
          foreach($product_list as $key=>$value){

               $pVariants_stock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock!=0 AND variants_status=1 ORDER BY pack_size DESC");
                $pvStock = ($pVariants_stock!=0) ? $pVariants_stock : array();

               $pVariants_notStock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock=0 AND variants_status=1 ORDER BY pack_size DESC");
               $pvnotStock = ($pVariants_notStock!=0) ? $pVariants_notStock : array();
                
                $arrMArge=array_merge($pvStock,$pvnotStock);
               // ksort($pVariants);
              $pArr[]=$value;
              $value->deliveryStatus=$value->$columsName;
              $value->deliveryTypes=$columsName;
              
                $value->variants=$arrMArge;
                 if($value->variants!=array()){
                   $prices[$key]=$value->variants[0]->price;
                  }

          }
       }
 
       return $pArr;

}


public function getProductlist_royal($where_and_chain="",$columsName="",$sortPrice="",$sortTypes="",$sql_limit="",$search_like="",$variant_id="",$fistUserAdd_qty="",$order_by="",$priceRange="",$ratingProductId=""){
// echo $columsName;
  // echo $priceRange;
  // exit;
  
  if($sortTypes !=''){
      if($sortTypes=='low_to_high'){
         $SORT_SC=SORT_ASC;
      }else if($sortTypes=='high_to_low'){
         $SORT_SC=SORT_DESC;
      }
  }

  if($fistUserAdd_qty=='fist_user'){
    $variable_id="AND variant_id=".$variant_id."";
  }else{ $variable_id=''; }

  


   $sql_join="SELECT DISTINCT *,mapp1.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE $where_and_chain $search_like $priceRange $ratingProductId GROUP BY mapp.unique_number $sortPrice $sql_limit $order_by";



   $product_list=$this->sqlQuery_model->sql_query($sql_join);

   // echo "<pre>";
   // print_r($sql_join);
   // echo "</pre>";
   // exit;

       $pArr=array();
       if($product_list!=0){
          
          foreach($product_list as $key=>$value){

               $pVariants_stock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock!=0 AND variants_status=1 $variable_id ORDER BY pack_size DESC");
                $pvStock = ($pVariants_stock!=0) ? $pVariants_stock : array();

               $pVariants_notStock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock=0 AND variants_status=1 $variable_id ORDER BY pack_size DESC");
               $pvnotStock = ($pVariants_notStock!=0) ? $pVariants_notStock : array();
                
                $arrMArge=array_merge($pvStock,$pvnotStock);
               // ksort($pVariants);
              $pArr[]=$value;
              $value->deliveryStatus=$value->$columsName;
              $value->deliveryTypes=$columsName;
              $value->imageUrl=base_url().'uploads/';
              
                $value->variants=$arrMArge;
                 if($value->variants!=array()){
                   $prices[$key]=$value->variants[0]->price;
                  }
             $disc=$this->sqlQuery_model->sql_select_where('tbl_product_description',array('desc_product_id'=>$value->product_id));
              $value->description=($disc!=0) ? $disc : array();
          }
       }
 
        // echo "<pre>";
        //   print_r($pArr);
        // echo "</pre>"; 
        // exit;

    if($pArr!=array()){

      if($sortTypes !=''){
         array_multisort($prices, $SORT_SC, $pArr);
        }

     }
      
  return $pArr;

}




public function getProductlist_royalCatSequence($where_and_chain="",$columsName="",$sortPrice="",$sortTypes="",$sql_limit="",$search_like="",$variant_id="",$fistUserAdd_qty="",$order_by="",$priceRange="",$ratingProductId="",$getFilterCatName=array()){

  if($sortTypes !=''){
      if($sortTypes=='low_to_high'){
         $SORT_SC=SORT_ASC;
      }else if($sortTypes=='high_to_low'){
         $SORT_SC=SORT_DESC;
      }
  }

  if($fistUserAdd_qty=='fist_user'){
    $variable_id="AND variant_id=".$variant_id."";
  }else{ $variable_id=''; }
   


  $getFilterV['cattype']=$getFilterCatName[0]['type'];
  $getFilterV['cat_name'] = array();
   foreach (array_reverse($getFilterCatName) as $key => $scat_value) {
        $getFilterV['cat_name'][]= '\''.$scat_value['ci_cat'].'\'';
   }
  
  $subCtsOrderBy="";
if($sortPrice==""){
     if($getFilterV['cattype']=='sub_category'){
       // $subCts= "AND mapp.pro_ci_sub_cat_name IN (".implode(', ', $getFilterV['cat_name']).")";
        $subCtsOrderBy= " ORDER BY FIELD(mapp.pro_ci_sub_cat_name,".implode(', ', $getFilterV['cat_name']).") DESC";
     }else if($getFilterV['cattype']=='category'){
       $subCtsOrderBy= " ORDER BY FIELD(mapp.pro_ci_cat_name,".implode(', ', $getFilterV['cat_name']).") DESC";
     }else if($getFilterV['cattype']=='child_category'){
      $subCtsOrderBy= " ORDER BY FIELD(mapp.ci_child_cat_name,".implode(', ', $getFilterV['cat_name']).") DESC";
     }else{
      $subCtsOrderBy="";
     }
 }
 
   $sql_join="SELECT DISTINCT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE $where_and_chain $search_like $priceRange $ratingProductId  GROUP BY mapp.unique_number $sortPrice $subCtsOrderBy $sql_limit $order_by ";

   $product_list=$this->sqlQuery_model->sql_query($sql_join);

   // echo "<pre>";
   // print_r($sql_join);
   // echo "</pre>";
   // exit;

       $pArr=array();
       if($product_list!=0){
          
          foreach($product_list as $key=>$value){

               $pVariants_stock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock!=0 AND variants_status=1 $variable_id ORDER BY pack_size DESC");
                $pvStock = ($pVariants_stock!=0) ? $pVariants_stock : array();

               $pVariants_notStock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock=0 AND variants_status=1 $variable_id ORDER BY pack_size DESC");
               $pvnotStock = ($pVariants_notStock!=0) ? $pVariants_notStock : array();
                
                $arrMArge=array_merge($pvStock,$pvnotStock);
               // ksort($pVariants);
              $pArr[]=$value;
              $value->deliveryStatus=$value->$columsName;
              $value->deliveryTypes=$columsName;
              $value->imageUrl=base_url().'uploads/';
              
                $value->variants=$arrMArge;
                 if($value->variants!=array()){
                   $prices[$key]=$value->variants[0]->price;
                  }
             $disc=$this->sqlQuery_model->sql_select_where('tbl_product_description',array('desc_product_id'=>$value->product_id));
              $value->description=($disc!=0) ? $disc : array();
          }
       }
 
        // echo "<pre>";
        //   print_r($pArr);
        // echo "</pre>"; 
        // exit;

    if($pArr!=array()){

      if($sortTypes !=''){
         array_multisort($prices, $SORT_SC, $pArr);
        }

     }
      
  return $pArr;

}










public function getProductlist($where_and_chain="",$foodhab_name="",$shifLife_name="",$columsName="",$sortPrice="",$sortTypes="",$sql_limit="",$search_like="",$variant_id="",$fistUserAdd_qty="",$order_by=""){
// echo $columsName;

  // echo $sortPrice;
  
  if($sortTypes !=''){
      if($sortTypes=='low_to_high'){
         $SORT_SC=SORT_ASC;
      }else if($sortTypes=='high_to_low'){
         $SORT_SC=SORT_DESC;
      }
  }

  if($fistUserAdd_qty=='fist_user'){
    $variable_id="AND variant_id=".$variant_id."";
  }else{ $variable_id=''; }

// echo $sortTypes;
 // echo "SELECT * FROM tbl_product WHERE $where_and_chain $foodhab_name $shifLife_name $sortPrice $search_like $sql_limit";
// exit;
// echo "<pre>";
// print_r($columsName);
// echo "</pre>";
   // $product_list=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product WHERE $where_and_chain $foodhab_name $shifLife_name $sortPrice $search_like $sql_limit");
   
   $sql_join="SELECT DISTINCT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE $where_and_chain $foodhab_name $shifLife_name $search_like GROUP BY mapp.unique_number $sortPrice $sql_limit $order_by";

   $product_list=$this->sqlQuery_model->sql_query($sql_join);

   // echo "<pre>";
   // print_r($sql_join);
   // echo "</pre>";
   // exit;

       $pArr=array();
       if($product_list!=0){
          
          foreach($product_list as $key=>$value){

               $pVariants_stock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock!=0 AND variants_status=1 $variable_id ORDER BY pack_size DESC");
                $pvStock = ($pVariants_stock!=0) ? $pVariants_stock : array();

               $pVariants_notStock=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variants_unique_number='".$value->unique_number."' AND stock=0 AND variants_status=1 $variable_id ORDER BY pack_size DESC");
               $pvnotStock = ($pVariants_notStock!=0) ? $pVariants_notStock : array();
                
                $arrMArge=array_merge($pvStock,$pvnotStock);
               // ksort($pVariants);
              $pArr[]=$value;
              $value->deliveryStatus=$value->$columsName;
              $value->deliveryTypes=$columsName;
              
                $value->variants=$arrMArge;
                 if($value->variants!=array()){
                   $prices[$key]=$value->variants[0]->price;
                  }

          }
       }
 
        // echo "<pre>";
        //   print_r($pArr);
        // echo "</pre>"; 
        // exit;

    if($pArr!=array()){

      if($sortTypes !=''){
         array_multisort($prices, $SORT_SC, $pArr);
        }

     }
      
  return $pArr;

}


public function getProductWithVariantSearchList($getKeywords=''){

  // if($getKeywords!=""){
  //      $searchKeyword="AND (tbl_product.product_name LIKE '%".$getKeywords."%' OR tbl_product.category LIKE'%".$getKeywords."%' OR tbl_product.sub_category LIKE'%".$getKeywords."%')";
  //    }else{
  //      $searchKeyword="";
  //    }
  
  // $query="SELECT * FROM tbl_product INNER JOIN tbl_product_variants ON tbl_product.unique_number = tbl_product_variants.variants_unique_number WHERE tbl_product.status=1 AND tbl_product_variants.variants_status=1 $searchKeyword LIMIT 10";
  // $product_list=$this->sqlQuery_model->sql_query($query);


   // echo "<pre>";
   // print_r($getKeywords);
   // echo "</pre>";
   // exit;

  if($getKeywords!=""){
      
      $keywords_search=" OR pro.keywords1 LIKE'%".$getKeywords."%' OR pro.keywords2 LIKE '%".$getKeywords."%' OR pro.keywords3 LIKE '%".$getKeywords."%' OR pro.keywords4 LIKE '%".$getKeywords."%' OR pro.keywords5 LIKE '%".$getKeywords."%' OR pro.keywords6 LIKE '%".$getKeywords."%' OR pro.keywords7 LIKE '%".$getKeywords."%' OR pro.keywords8 LIKE '%".$getKeywords."%'";

       $searchKeyword="AND (pro.product_name LIKE '%".$getKeywords."%' OR mapp.category LIKE'%".$getKeywords."%' OR mapp.sub_category LIKE'%".$getKeywords."%'".$keywords_search.")";
     }else{
       $searchKeyword="";
     }
  
  $sql_join="SELECT DISTINCT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number
     LEFT JOIN tbl_product_variants AS pro_var ON mapp.unique_number = pro_var.variants_unique_number WHERE pro.status=1 AND pro_var.variants_status=1 AND pro.image1!='' $searchKeyword LIMIT 10
    ";

   $product_list=$this->sqlQuery_model->sql_query($sql_join);

    // WHERE $where_and_chain $foodhab_name $shifLife_name $search_like
    // GROUP BY mapp.unique_number $sortPrice $sql_limit
    // echo "<pre>";
   // print_r($product_list);
   // exit;
  return $product_list;

}

public function getCategoryByItemsCodeChecked($unique_number="",$cat_id="",$subCate_id="",$childCat_id=""){
     $result='';

     $where_cate_id=($cat_id!="") ? 'cat_id='.$cat_id :'';
     $where_sub_cate_id=($subCate_id!="") ? 'sub_cat_id='.$subCate_id :'';
     $where_child_cate_id=($childCat_id!="") ? 'child_cat_id='.$childCat_id :'';
  
      $query="SELECT * FROM tbl_mapping_category_with_product WHERE unique_number=$unique_number AND $where_cate_id $where_sub_cate_id $where_child_cate_id AND status=1";
      $product_list=$this->sqlQuery_model->sql_query($query);
      if($product_list!=0){
        $result='checked';
      }

  return $result;
}





public function getCategoryByItemsCode($unique_number="",$type=""){
     // $result='';
     // $where_cate_id=($cat_id!="") ? 'cat_id='.$cat_id :'';
     // $where_sub_cate_id=($subCate_id!="") ? 'sub_cat_id='.$subCate_id :'';
      $query="SELECT * FROM tbl_mapping_category_with_product WHERE unique_number=$unique_number AND status=1";
      $product_list=$this->sqlQuery_model->sql_query($query);
     $getA=array();
     // $background_colors = array('#ff0080', '#ff5050', '#ff3300', '#cc6600', '#e68a00');
     // $rand_background = $background_colors[array_rand($background_colors)];
      if($product_list!=0){
         
        foreach ($product_list as $key => $value) {
            if($type=='category'){
            $getArrCate[]=$value->category;
            }else{
              $getArrCate[]=$value->sub_category;
            }
         }
         foreach (array_unique($getArrCate) as $key => $bvalue) {
           $getA[]='<span class="badge bg-success" style="background-color: #689F39 !important">'.$bvalue.'</span>';
         }

  }

  return $getA;
}


public function getCategoryIDForExport($unique_number=""){

  $query="SELECT * FROM tbl_mapping_category_with_product WHERE unique_number=$unique_number AND status=1";
  $product_list=$this->sqlQuery_model->sql_query($query);
  $getCatId=array();
   $getCatName=array();
  if($product_list!=0){
    foreach ($product_list as $key => $value) {
      $getCatId[]=$value->cat_id;
      $getCatName[]=$value->category;
    }
  }

  $getStringValue=array(implode('::', array_unique($getCatId)),implode('::', array_unique($getCatName)));
  return $getStringValue;
}

public function getSubCategoryIDForExport($unique_number=""){

  $query="SELECT * FROM tbl_mapping_category_with_product WHERE unique_number=$unique_number AND status=1";
  $product_list=$this->sqlQuery_model->sql_query($query);
  $getValue=array();
   $getSCatName=array();


  if($product_list!=0){
    foreach ($product_list as $key => $value) {
         $getValue[]=$value->cat_id.'::'.$value->sub_cat_id;
         $getSCatName[]=$value->category.'::'.$value->sub_category;
      
    }
  }

   
$getStringValue=array(implode('___', array_unique($getValue)),implode('___', array_unique($getSCatName)));
return $getStringValue;

}


public function getSubChildCategoryIDForExport($unique_number=""){

  $query="SELECT * FROM tbl_mapping_category_with_product WHERE unique_number=$unique_number AND status=1";
  $product_list=$this->sqlQuery_model->sql_query($query);
  $getchildValue=array();
   $getSChildCatName=array();
  if($product_list!=0){
    foreach ($product_list as $key => $value) {
         $getchildValue[]=$value->cat_id.':::'.$value->sub_cat_id.':::'.$value->child_cat_id;
         $getSChildCatName[]=$value->category.':::'.$value->sub_category.':::'.$value->childCat_name;
      
    }
  }


$getStringValue=array(implode('___', array_unique($getchildValue)),implode('___',array_unique($getSChildCatName)));
return $getStringValue;

}


public function getProductWithVariantSearchList_mobile($getKeywords=''){
// OR tbl_product.category LIKE'%".$getKeywords."%' OR tbl_product.sub_category LIKE'%".$getKeywords."%'

 $keywords_search=" OR pro.keywords1 LIKE'%".$getKeywords."%' OR pro.keywords2 LIKE '%".$getKeywords."%' OR pro.keywords3 LIKE '%".$getKeywords."%' OR pro.keywords4 LIKE '%".$getKeywords."%' OR pro.keywords5 LIKE '%".$getKeywords."%' OR pro.keywords6 LIKE '%".$getKeywords."%' OR pro.keywords7 LIKE '%".$getKeywords."%' OR pro.keywords8 LIKE '%".$getKeywords."%'";

  
  if($getKeywords!=""){
       $searchKeyword="AND (pro.product_name LIKE '%".$getKeywords."%' $keywords_search AND pro.image1!='')";
     }else{
       $searchKeyword="AND (pro.product_name='notfound')";
     }
  


 $query="SELECT DISTINCT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE pro.status=1 $searchKeyword GROUP BY mapp.unique_number LIMIT 10";

   $product_list=$this->sqlQuery_model->sql_query($query);

  $productArr=array();
  $categoryArr=array();
  $subCategory=array();

  foreach ($product_list as $key => $value) {

    array_push($productArr, array('product_name'=>$value->product_name,'product_id'=>$value->product_id));
    array_push($categoryArr,array('cat_id'=>$value->cat_id,'category'=>$value->category,'pro_ci_cat_name'=>$value->pro_ci_cat_name.'/?d='.base64_encode($value->cat_id)));
    array_push($subCategory,array('sub_cat_id'=>$value->sub_cat_id,'sub_category'=>$value->sub_category,'pro_ci_sub_cat_name'=>$value->pro_ci_cat_name.'/'.$value->pro_ci_sub_cat_name.'/?d='.base64_encode($value->sub_cat_id)));
  }


  $categoryArr = array_column($categoryArr,'category' ,'pro_ci_cat_name');
  $categoryArr = array_unique($categoryArr);

  $subCategory = array_column($subCategory,'sub_category' ,'pro_ci_sub_cat_name');
  $subCategory = array_unique($subCategory);
  
   $product_list=array('product'=>$productArr,'category'=>$categoryArr,'subCategory'=>$subCategory);

   // echo "<pre>";
   // print_r($product_list);
   // echo "</pre>";

   // exit;

   return $product_list;

}


public function setPRoductCondition($user="",$where="",$sessionType=""){

     $columsName[0]='status';
      
      if($user!=""){
          $sqlPincode=$this->sqlQuery_model->sql_select_where('tbl_userlocationmanage',array('user_id'=>$user[0]->customer_id)); 
        }else{
          $sqlPincode=0;
        }
     
       if($sqlPincode!=0){
            if($sqlPincode[0]->pincode=="take_away"){
               $get_pincode="";
               $takeWay=$sqlPincode[0]->pincode;
            }else{
              $get_pincode=$sqlPincode[0]->pincode;
              $takeWay="";
            }
           $columsName=$this->deliveryTypeDisplayProduct($get_pincode,$takeWay);
            
       }else{
               if($sessionType!=""){
                  if($sessionType['value']!='take_away'){
                    $get_pincode=$sessionType['value'];
                    $takeWay="";
                    }else{
                    $get_pincode="";
                    $takeWay=$sessionType['value'];
                    }
                $columsName=$this->deliveryTypeDisplayProduct($get_pincode,$takeWay);
               }
           }


    return   $columsName;
}

public function setDefaultAddressOnupdate($customer_id,$addre_id){
   $user=$this->my_libraries->mh_getCookies('customer');

  $default_set=array('setAddressDefault'=>0);
      $sql_update=$this->sqlQuery_model->sql_update('tbl_address',$default_set,array('customer_id'=>$customer_id));

  if($sql_update){
      $row_default_set=array('setAddressDefault'=>1);
      $row_sql_update=$this->sqlQuery_model->sql_update('tbl_address',$row_default_set,array('customer_id'=>$customer_id,'addr_id'=>$addre_id));
       
       // $shippingAddress_selectAddress=$this->sqlQuery_model->sql_select_where('tbl_address',array('addr_id'=>$addre_id,'customer_id'=>$user[0]->customer_id,'setAddressDefault'=>1));

               // $pincode=$shippingAddress_selectAddress[0]->pincode;
               // $takeWay='';
               // $actionType=1;
               // $columsName=$this->my_libraries->deliveryTypeDisplayProduct($pincode,$takeWay,$actionType);
               // $session = array('value' =>$pincode,'location'=>$columsName[1]);
               // $this->session->set_userdata('valueType',$session);         
    }

  if($row_sql_update){
     $result=true;
  }else{
    $result=false;
  }

  return $result;
}



public function StockStatusCategory($uiCate){
     $result=1;
     $sqlCate=$this->sqlQuery_model->sql_select_where('tbl_category',array('ci_cat_name'=>$uiCate)); 
       if($sqlCate!=0){
          if($sqlCate[0]->in_stock_status==0){  // 0 is out of stock
             $result=0;
          }
       }
  
  return $result;
}


public function StockStatusSubCategory($uisubCate){
     $result=1;
     $sqlsCate=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('ci_sub_cat_name'=>$uisubCate)); 
       if($sqlsCate!=0){
          if($sqlsCate[0]->in_stock_status==0){  // 0 is out of stock
             $result=0;
          }
       }
  
  return $result;
}




// 'tbl_product',array('status'=>1)


// 8208852595

// public function setDefaultVariantValue($variants=array()){
// $options="";
//   if($variants!=0){
    
//       foreach($variants as $packsize){

//           if($packsize->stock >=1){
//              $options= '<option value="'.$packsize->variant_id.'">'.$packsize->pack_size.' '.$packsize->units.'</option>';
//              }
//           }

//         }

// return $options;
// }


public function getGSTCalculation($total_price,$qty,$shipping_address,$product,$getPRoduct,$werehouse){

 
  // if($product['added_by']==0){
  //     $get_seller=$this->sqlQuery_model->sql_select_where('tbl_seller_account',array('seller_id'=>$product['vendor_id']));
  // }else{
      // $get_seller=$this->sqlQuery_model->sql_select_where('tbl_admin',array('status'=>1));
  // }
      $get_seller=$this->sqlQuery_model->sql_select_where('tbl_werehouse_details',array('werehouse_code'=>$werehouse,'status'=>1));
      
      //  echo "<pre>";
      // print_r($getPRoduct);
      // echo "</pre>";

      //  echo "<pre>";
      // print_r($product['subtotal']);
      // echo "</pre>";

      // echo "<pre>";
      // print_r($get_seller);
      // echo "</pre>";

      // echo "<pre>";
      // print_r($shipping_address);
      // echo "</pre>";
      // exit;

   if($get_seller!=0){
      
         if($this->replaceAll($get_seller[0]->state)==$this->replaceAll($shipping_address[0]->state)){
              $rate_sGst=array('sGstRate'=>sprintf("%0.2f",$getPRoduct[0]->sgst));
              $rate_cGst=array('cGstRate'=>sprintf("%0.2f",$getPRoduct[0]->cgst));
               // $rateDivid=$product['tax_code']/2;

              $gstAmount_sgst=($product['subtotal']*$getPRoduct[0]->sgst)/100;
              $gstAmount_cgst=($product['subtotal']*$getPRoduct[0]->cgst)/100;

              $sGst=array('sGstRate'=>sprintf("%0.2f",$getPRoduct[0]->sgst),'sGstAmount'=>sprintf("%0.2f",$gstAmount_sgst));
              $cGst=array('cGstRate'=>sprintf("%0.2f",$getPRoduct[0]->cgst),'cGstAmount'=>sprintf("%0.2f",$gstAmount_cgst));
              $iGst=array('iGstRate'=>0,'iGstAmount'=>0);

              $gstType=array('type'=>'In_state_GST');
              $getamount=($total_price*($getPRoduct[0]->sgst + $getPRoduct[0]->cgst))/100;
              $taxableAmount=$total_price-$getamount;

         }else{

             // $gstAmount=($product['subtotal']*$product['tax_code'])/100;
              $gstAmount_igst=($product['subtotal']*$getPRoduct[0]->igst)/100;
              $iGst=array('iGstRate'=>sprintf("%0.2f",$getPRoduct[0]->igst),'iGstAmount'=>sprintf("%0.2f",$gstAmount_igst));
              $sGst=array('sGstRate'=>0,'sGstAmount'=>0);
              $cGst=array('cGstRate'=>0,'cGstAmount'=>0);
              $gstType=array('type'=>'Out_state_GST');
              $getamount=($total_price*$getPRoduct[0]->igst)/100;
              $taxableAmount=$total_price-$getamount;
         }
   }
   
   // $getamount=($total_price*$product['tax_code'])/100;
   // $taxableAmount=$total_price-$getamount;
   // $seller=array('admin_state'=>$get_seller[0]->admin_state,'state'=>$get_seller[0]->seller_tin_number);
   return array($iGst,$sGst,$cGst,$gstType,$taxableAmount);
   
}

public function calculateShippingChanges($delvType,$itemsWeight){
   
         if($delvType[0]->ship_qty > $itemsWeight){

                         $totalShippingAmount= $delvType[0]->ship_amount ;
                   }else{
                       
                        $halfWeight= ($delvType[0]->ship_qty / 2);       // Get Half weight of KG or GRAM
                        $halfShipAmount=  $delvType[0]->ship_amount / 2 ;  // Get Half Amount of shipping charges

                        $beforeDecimal = intval($itemsWeight);        
                        $afterDecimal = $itemsWeight - $beforeDecimal;    // This is saparating between decimal point
                        
                        $calcAmount= $beforeDecimal * $delvType[0]->ship_amount;   // Taking total amount on weight

                         if($afterDecimal!=0){
                                  if($afterDecimal <= $halfWeight){
                                       $addAmout= $calcAmount + $halfShipAmount;   // Calculating amount if decimal point less then half weight
                                  }else if($afterDecimal >= $halfWeight){  // Calculating amount if decimal point Greater then half weight
                                    $addAmout= $calcAmount + $delvType[0]->ship_amount;
                                  }  
                         }else{
                          $addAmout=$calcAmount;  // if weight does not have decimal value. 
                         }

                         $totalShippingAmount  =$addAmout;
                   }
         
         return $totalShippingAmount;
      }


public function catculateShippingCharges($itmesQyt=0,$itemsWeight=0,$delvType="",$cartDetails="",$totalAmount=0){

      $delvType=$this->sqlQuery_model->sql_select_where('tbl_shipping_charges_manage',array('ship_delivery_type'=>$delvType[0]));
      // echo "<pre>";
      // print_r($delvType);
      // echo "</pre>";
      //  echo "<pre>";
      // print_r($itemsWeight);
      // echo "</pre>";

      // exit;
     if($delvType!=0){

      switch ($delvType[0]->ship_delivery_type) {
          case 'hyperlocal_delivery':   // hyperlocal
// echo "<pre>";
//       print_r($delvType);
//       echo "</pre>";
          if($delvType[0]->status==1){

               $getVal=json_decode($delvType[0]->ship_range_data);
               $getFinalCharges=array();
               $lastArr=end($getVal);

                if($itemsWeight < $lastArr->range_qty2){

                   foreach($getVal as $value){
                        
                        if(($itemsWeight >  $value->range_qty1) && ($itemsWeight <= $value->range_qty2)){
                          array_push($getFinalCharges, $value);
                         }
                    
                    }

                }else{
                  
                  $array_value=(object)array(
                                'range_qty1' => '',
                                'range_qty2' => '',
                                'range_unit' => '',
                                'range_amount' => 'FREE'
                              );
                 array_push($getFinalCharges, $array_value);

                }

          $array_final= array('shippingCharges'=>$getFinalCharges[0]->range_amount);

        }else{

           $array_final= array('shippingCharges'=>sprintf("%0.2f",0));
        }

            

          return  $array_final;

          break;

           case 'excluding_local_hyperlocal':  // within MAHARASTRA

                if($delvType[0]->status==1){
                 // $getTotalUint= $delvType[0]->ship_qty * $itemsWeight;
                  // $totalShippingAmount= $delvType[0]->ship_amount * $getTotalUint;

                  $totalShippingAmount = $this->calculateShippingChanges($delvType,$itemsWeight);

                  $array_final= array('shippingCharges'=>$totalShippingAmount);

                 }else{

                   $array_final= array('shippingCharges'=>sprintf("%0.2f",0));
                 }

                 return  $array_final;
                  
          break;

           case 'national_delivery':  // Without MAHARASTRA

                 if($delvType[0]->status==1){
             
                  // $getTotalUint= $delvType[0]->ship_qty * $itemsWeight;
                  // $totalShippingAmount= $delvType[0]->ship_amount * $getTotalUint;
                 
                 $totalShippingAmount = $this->calculateShippingChanges($delvType,$itemsWeight);

                  $array_final= array('shippingCharges'=>$totalShippingAmount);
                }else{
                  $array_final= array('shippingCharges'=>sprintf("%0.2f",0));

                }
                 return  $array_final;
                  // echo "<pre>";
                  // print_r($array_final);
                  // echo "</pre>";
          break;

           case 'local_delivery':   //local delvery

                 if($delvType[0]->status==1){

                     $totalShippingAmount='FREE';
                    // if($totalAmount >= $delvType[0]->ship_max_amount){
                    //   $totalShippingAmount=$delvType[0]->ship_max_amount_charges;
                    // }
 
                       if($totalAmount < $delvType[0]->ship_min_amount){
                        $totalShippingAmount=$delvType[0]->ship_min_amount_charges;
                        }

                        $array_final= array('shippingCharges'=>$totalShippingAmount);

                    }else{
                       $array_final= array('shippingCharges'=>sprintf("%0.2f",0));
                    }

                 return  $array_final;
                  // echo "<pre>";
                  // print_r($totalShippingAmount);
                  // echo "</pre>";

                  // echo "<pre>";
                  // print_r($delvType[0]->ship_max_amount);
                  // echo "</pre>";
                  // echo "<pre>";
                  // print_r($delvType);
                  // echo "</pre>";

                  // echo "<pre>";
                  // print_r($array_final);
                  // echo "</pre>";
                 
          break;
        
         default:  // pickup shop

              if($delvType[0]->status==1){
                 $totalShippingAmount='0.00';
                 $array_final= array('shippingCharges'=>$totalShippingAmount);

               }else{

                 $array_final= array('shippingCharges'=>sprintf("%0.2f",0));
               }
                  return  $array_final;
                  // echo "<pre>";
                  // print_r($delvType);
                  // echo "</pre>";
          # code...
          break;
      }

    }else{
       $totalShippingAmount='0.00';
       $array_final= array('shippingCharges'=>$totalShippingAmount);
       return  $array_final;
    }
      
      // if($delvType[0]->ship_delivery_type=='hyperlocal_delivery'){  // hyperlocal
          

      // }else if($delvType[0]->ship_delivery_type=='excluding_local_hyperlocal'){  // within MAHARASTRA

        

      // }else if($delvType[0]->ship_delivery_type=='national_delivery'){  // Without MAHARASTRA


      // }else if($delvType[0]->ship_delivery_type=='local_delivery'){  //local delvery


      // }else{  // pickup shop

      // }
 
      


      // echo "<pre>";
      // print_r($itmesQyt);
      // echo "</pre>";

      // echo "<pre>";
      // print_r($itemsWeight);
      // echo "</pre>";

       // echo "<pre>";
      // print_r($totalAmount);
      // echo "</pre>";

      // echo "<pre>";
      // print_r($delvType[0]);
      // echo "</pre>";

      // echo "<pre>";
      // print_r($cartDetails);
      // echo "</pre>";


}


public function setDiscountCouponOnPurchaseAmount($purchaseType=array(),$purchaseAmount=0,$coupon_codes_disk="",$user="",$usertype=""){
        
      if($purchaseAmount < $purchaseType[0]->min_purch_amt){
           $data['status']=0;
           $data['message']="Your purchase amount should be ".$purchaseType[0]->min_purch_amt;
           echo json_encode($data);
           exit;
       }
        
         // echo "<pre>";
         // print_r($purchaseType['purchase_type']);
         //  echo "</pre>";
         // echo $purchaseAmount;
         // echo '<br>';
         // echo $purchaseType[0]->disc_amt;
       if($purchaseType[0]->disc_type=='fixed_amt'){
            $purchaseOrderAmountWithDisc=$purchaseAmount-$purchaseType[0]->disc_amt;
            $couponValue=$purchaseType[0]->disc_amt;
            // $finalAmount=
            // echo 'ok';
        }else if($purchaseType[0]->disc_type=='percentage'){
            $discountAmount=($purchaseAmount * $purchaseType[0]->disc_per)/100;
            $purchaseOrderAmountWithDisc=$purchaseAmount-$discountAmount;
            $couponValue=$discountAmount;
            // echo 'ok2';
        }else{
            $purchaseOrderAmountWithDisc=0;
            $couponValue=0;
          // echo 'ok3';
        }

     $arrayDiscount=array(
      'purchase_type'=>$purchaseType[0]->purchase_type,
      'min_purch_amt'=>$purchaseType[0]->min_purch_amt,
      'min_purch_qty'=>$purchaseType[0]->min_purch_qty,
      'min_purch_product'=>$purchaseType[0]->min_purch_product,
      'coupon_codes'=>$coupon_codes_disk,
      'purchaseOrderAmountWithDisc'=>sprintf('%.2f',$purchaseOrderAmountWithDisc),
      'couponValue'=>sprintf('%.2f',$couponValue),
      'originalPurchaseAmount'=>sprintf('%.2f', $this->cart->total()),
      'usertype'=>$usertype,
      'cust_id'=>$user[0]->customer_id,
      'cust_email'=>$user[0]->email

    );

   return  $arrayDiscount;  
}


public function setDiscountCouponOnPurchaseQty($purchaseType=array(),$purchaseWeightQty=0,$purchaseAmount=0,$coupon_codes_disk="",$user="",$usertype=""){
    
//     echo "<pre>";
//     print_r($purchaseType);
//     echo "<pre>";
//     echo "<pre>";
//     print_r($purchaseWeightQty);
//     echo "<pre>";
//     echo "<pre>";
//     print_r($purchaseAmount);
//     echo "<pre>";

//      echo "<pre>";
//     print_r($coupon_codes_disk);
//     echo "<pre>";
// exit;
   
       if($purchaseWeightQty < $purchaseType[0]->min_purch_qty){
           $data['status']=0;
           $data['message']="Your purchase weight qty should be more than ".$purchaseType[0]->min_purch_qty.' Kg';
           echo json_encode($data);
           exit;
       }

        if($purchaseAmount < $purchaseType[0]->disc_amt){
           $data['status']=0;
           $data['message']="Your purchase amount should be greater than".$purchaseType[0]->disc_amt;
           echo json_encode($data);
           exit;
         }


       if($purchaseType[0]->disc_type=='fixed_amt'){
            $purchaseOrderAmountWithDisc=$purchaseAmount-$purchaseType[0]->disc_amt;
            $couponValue=$purchaseType[0]->disc_amt;
           // echo 'ok';
        }else if($purchaseType[0]->disc_type=='percentage'){
            $discountAmount=($purchaseAmount * $purchaseType[0]->disc_per)/100;
            $purchaseOrderAmountWithDisc=$purchaseAmount-$discountAmount;
            $couponValue=$discountAmount;
            // echo 'ok2';
        }else{
          $purchaseOrderAmountWithDisc=0;
          $couponValue=0;
          // echo 'ok3';
        }

     $arrayDiscount=array(
      'purchase_type'=>$purchaseType[0]->purchase_type,
      'min_purch_amt'=>$purchaseType[0]->min_purch_amt,
      'min_purch_qty'=>$purchaseType[0]->min_purch_qty,
      'min_purch_product'=>$purchaseType[0]->min_purch_product,
      'coupon_codes'=>$coupon_codes_disk,
      'purchaseOrderAmountWithDisc'=>$purchaseOrderAmountWithDisc,
      'couponValue'=>$couponValue,
      'originalPurchaseAmount'=>sprintf('%.2f', $this->cart->total()),
      'usertype'=>$usertype,
      'cust_id'=>$user[0]->customer_id,
      'cust_email'=>$user[0]->email
    );

   return  $arrayDiscount; 

  }

  public function couponDestroy($couponDetails="",$cart_details="",$cart_item_id="",$type=""){
      $purchaseAmount=$this->cart->total();
      // $purchaseQty=$this->cart->total_items();

      $getQtyWeightKg=$this->my_libraries->getQtyWeightKg();
       $purchaseWeightQty=$getQtyWeightKg['finalWieght'];


       if($couponDetails!=""){
        $result=false;

         if($couponDetails['purchase_type']=='amount_purchase'){
              $min_purch_coupon_amt=$couponDetails['min_purch_amt'];

                   if($type=='plus'){
                     $minusvalue=$purchaseAmount+$cart_details[$cart_item_id]['price'];
                   }else{
                     $minusvalue=$purchaseAmount-$cart_details[$cart_item_id]['price'];
                   }

                     if($minusvalue < $min_purch_coupon_amt){
                        $result= true;
                      }

              }else if($couponDetails['purchase_type']=='qty_purchase'){
                        $min_purch_coupon_qty=$couponDetails['min_purch_qty'];
                        if($purchaseWeightQty < $min_purch_coupon_qty){
                          $result= true;
                        }
             }

      }else{
          $result= false;
      }
   return $result;
  }


function getQtyWeightKg(){
    $cart_details=$this->cart->contents();
    $itemsWieght=$this->my_libraries->getCartDetails($cart_details);

               // echo "<pre>";
               // print_r($itemsWieght);
               // echo "</pre>";
               // exit;
   return $itemsWieght[1];
}




 
public function sendEmailDetails($temp){
  // pre($temp['tempate']);
  $mail = $this->phpmailer_lib->load();
  $config['mailUsername']=$this->config->item('mailUsername');
  $config['mailPassword']=$this->config->item('mailPassword');
  $config['setFrom']=$this->config->item('setFrom');
  // Add a recipient
  $config['addAddress']=trim($temp['customerEmail']);
  // if($temp['send_type']=='orderPlace'){
  if($temp['adminEmail_CC']!=''){
    $config['addCC']=trim($temp['adminEmail_CC']);
  }
  
  if($temp['adminEmail_BCC']!=''){
    $config['addBCC']=trim($temp['adminEmail_BCC']);
  }
  
   // }else{
    // $config['addCC']='';
   // }

  $config['title']=$this->config->item('rdfpl');
  $config['subject']=$temp['subject'];
  $config['mailContent']=$temp['tempate'];
  // pre($mail);
 return(smtpSend($mail,$config));
}


function sendTemplateContent($order_status=null){

   if($order_status=='Received'){
      $subject=$this->config->item('orderReceived_email_subject');
      $messages=$this->config->item('orderReceived_email_body_message');
      
   }else if($order_status=='Confirmed'){
      $subject=$this->config->item('orderConfirm_email_subject');
      $messages=$this->config->item('orderConfirm_email_body_message');
      
   }else if($order_status=='Ready to ship'){
      $subject=$this->config->item('orderReadytoship_email_subject');
      $messages=$this->config->item('orderReadytoship_email_body_message');
      
   }else if($order_status=='Shipped'){
       $subject=$this->config->item('ordershipped_email_subject');
       $messages=$this->config->item('ordershipped_email_subject');

   }else if($order_status=='Processing'){
      $subject=$this->config->item('orderProcess_email_subject');
      $messages=$this->config->item('orderProcess_email_body_message');
      
   }else if($order_status=='Delivered'){
      $subject=$this->config->item('orderDelivered_email_subject');
      $messages=$this->config->item('orderDelivered_email_body_message');

   }else if($order_status=='On Hold'){
    $subject=$this->config->item('orderOnHold_email_subject');
    $messages=$this->config->item('orderOnHold_email_body_message');

   }else if($order_status=='Canceled'){
    $subject=$this->config->item('orderCanceled_email_subject');
    $messages=$this->config->item('orderCanceled_email_body_message');

  }else if($order_status=='Failed payment'){
    $subject=$this->config->item('orderFailedpayment_email_subject');
    $messages=$this->config->item('orderFailedpayment_email_body_message');

  }else{
    $subject=$this->config->item('orderPending_email_subject');
    $messages=$this->config->item('orderPending_email_body_message');
  }

   return array('subject'=>$subject,'messages'=>$messages);
}


public function bottonDivDisplayAll($headingName="",$category="",$subCategory="",$baseUrlFindAll="",$baseUrlFindNo=""){
    


  $html='';

  $html .='<div class="below-actions" style="text-align: center; background: burlywood; padding: 15px;color: black;border-radius:10px;">';
     if($headingName!=""){
        $html .='<p style="color:black;font-size:16px;"><span style="font-weight: 600;">'.$headingName.'</span> products<span style="font-weight: 600;">'.(($category!="") ? ' in '.$category :'').(($subCategory!="") ? '/'.$subCategory :'').'</span> are not available.</p>';
        }
       
         $html .='<p style="color:black;font-size:16px;">Do you wish to find in All ?</p>
        <a href="'.$baseUrlFindAll.'"><button type="button" class="btn btn-secondary">Yes</button></a>
        <a href="'.$baseUrlFindNo.'"><button type="button" class="btn btn-secondary"> No</button></a>';

    $html .='</div>';

   return $html;
}


 public function getCustomerProductOffer($product_unique="",$variants_id="",$pQty=0){
  
     $sql=$this->sqlQuery_model->sql_select_where('tbl_product_apply_offer',array('offer_product_unique_id'=>$product_unique,'offer_variant_id'=>$variants_id,'status'=>1));
        // echo "<pre>";
        // print_r($sql);
         $getArr=array();
        if($sql!=0){
           $currentDate=date('Y-m-d');
        // $currentDate="2022-11-1";
           $startDate=date($sql[0]->offer_start_date);
           $endDate=date($sql[0]->offer_end_date);

           $numberCurrent=strtotime($currentDate);
           $numberstart=strtotime($startDate);
           $numberend=strtotime($endDate);

            if($numberstart <= $numberCurrent && $numberend >= $numberCurrent){     // <: Less than >: Greater Than
                   
                   if($pQty >= $sql[0]->offer_min_qty){

                       $getActualOfferQty= $pQty / $sql[0]->offer_min_qty;
                       // echo $getActualOfferQty;
                         $getArr=array(
                                'mapping_id'=>$sql[0]->offer_category,
                                'category'=>$this->getProductCategoryUnique_id($sql[0]->offer_category),
                                'sub_category'=>$this->getProductSubCategoryUnique_id($sql[0]->offer_category),
                                'cat_id'=>$this->getProductCategory_idUnique_id($sql[0]->offer_category),
                                'sub_cat_id'=>$this->getProductSubCategory_idUnique_id($sql[0]->offer_category),
                                'unique_number'=>$sql[0]->offer_product_name,
                                'pName'=>$this->getProductNameUnique_id($sql[0]->offer_product_name,'pName'), 
                                'veriant_id'=> $sql[0]->offer_packsize,
                                'conversion_factor'=>$this->getProductVariantConversionFactor($sql[0]->offer_packsize),
                                'sku_id'=>$this->getProductVariantSKU_id($sql[0]->offer_packsize),
                                'packSize'=>$this->getProductVariantPachSizeUnique_id($sql[0]->offer_packsize),
                                'units'=>$this->getProductVariantUnitsUnique_id($sql[0]->offer_packsize),
                                'image'=>$this->getProductNameUnique_id($sql[0]->offer_product_name,'image'),
                                'pQty'=>(int)$getActualOfferQty,
                                'OfferStatus'=>'Offer Applicable');
                       }
               }
        }

return $getArr;
 }


public function insertOfferProduct($productOffer,$generated_order_id,$customer_id,$order_process_step){

if($productOffer!=array()){

   $getPRoduct=$this->sqlQuery_model->sql_select_where('tbl_product',array('unique_number'=>$productOffer['unique_number']));

   $order_products=array(
                'pro_generated_order_id'=>$generated_order_id,
                'pro_sys_product_id'=>$getPRoduct[0]->product_id,
                'pro_cust_id'=>$customer_id,
                'pro_product_qty'=>$productOffer['pQty'],

                'pro_conversion_factor_kg'=>$productOffer['conversion_factor'],
                'pro_product_selling_price'=>0,
                'pro_product_name'=>$getPRoduct[0]->product_name,

                'pro_own_product_id'=>$getPRoduct[0]->unique_number,
                'pro_subtotal'=>0,
                'pro_product_img'=>$getPRoduct[0]->image1,
                'pro_igst_rate'=>0,
                'pro_igst_amount'=>0,
                'pro_cgst_rate'=>0,
                'pro_cgst_amount'=>0,
                'pro_sgst_rate'=>0,
                'pro_sgst_amount'=>0,
                'pro_taxable_amount'=>0,
                'pro_type_of_tax'=>null,
                'pro_sku_id'=>$productOffer['sku_id'],
                'pro_hsn_code'=>$getPRoduct[0]->hsn_code,
                'pro_order_place_state'=>null,
                'pro_updated_by'=>'Buyer',

                'pro_cat_id'=>$productOffer['cat_id'],
                'pro_sub_cat_id'=>$productOffer['sub_cat_id'],
                'pro_cat_name'=>$productOffer['category'],

                'packsize'=>$productOffer['packSize'],
                'units_id'=>0,
                'units'=>$productOffer['units'],
                'pro_sub_cat_name'=>$productOffer['sub_category'],

                // 'pro_offer_productName'=>null,
                // 'pro_offer_category'=>null,
                // 'pro_offer_image'=>null,
                // 'pro_offer_packSize'=>null,
                // 'pro_offer_units'=>null,
                // 'pro_offer_pQty'=>0,
                'pro_offer_status'=>'offer-product',
                'pro_product_order_date'=>date('Y-m-d H:i:s'),
                'pro_order_status'=>$order_process_step,
              );

     $offerProduct=$this->sqlQuery_model->sql_insert('tbl_order_products',$order_products);
     return  $offerProduct;
   }

  
}


 public function mh_setCookies($name="",$sql=""){


  $result=false;
   if($sql!="" || $sql!=0){
   $cookie= array(
           'name'   => $name,
           'value'  => serialize($sql),
           'expire' => time() + 24 * 3600
         );

    $this->input->set_cookie($cookie);

     $result=true;
  }

  return $result;
 }

 public function mh_getCookies($name=""){
  $cookies= $this->input->cookie($name,true); 
  $getArr="";
  if($cookies!=""){
    $getArr=unserialize($cookies);
  }
  return  $getArr;
 }


 public function orderPalceFlag_setCookies($value){
    $cookie= array('name' => 'placeOrderFlag','value'  => $value);
    $this->input->set_cookie($cookie);
    $result=true;
   return $result;
 }

  public function orderPalceFlag_getCookies(){
  $cookies= $this->input->cookie('placeOrderFlag',true); 
  return  $cookies;
 }



public function getSidebarMenus(){

   $session=$this->session->userdata('admin');

   if($session!=""){
          $menus_list=$this->sqlQuery_model->sql_select_where_desc('tbl_sidebar_menus','position',array('sub_menu_id'=>0,'status'=>1));
          if($menus_list!=0){

               foreach(array_reverse($menus_list) as $value){

                      $sub_menus_list=$this->sqlQuery_model->sql_select_where_desc('tbl_sidebar_menus','position',array('sub_menu_id'=>$value->menus_id,'status'=>1));
                          $userAccess=$this->getSelectedUserAccess($session['admin_id'],$value->menus_id);
                          $getData=array();

                          $submenuArr=array();
                          if($sub_menus_list!=0){
                             foreach ($sub_menus_list as $sub_key => $sub_value) {

                                $sub_userAccess=$this->getSelectedUserAccess($session['admin_id'],$sub_value->menus_id);
                                   $sub=array();
                                   if($session['admin_type']=='A'){
                                       $sub=(array)$sub_value;
                                    }else{
                                       if($sub_userAccess['menu_id']==$sub_value->menus_id){  
                                          $sub=(array)$sub_value;
                                       }
                                   }

                                  $submenuArr[]=$sub;
                              }

                          }
               
                          if($session['admin_type']=='A'){
                             $getData=(array)$value;
                             $getData['submenu']=$submenuArr;
                         }else{
                            
                             if($userAccess['menu_id']==$value->menus_id){  
                                $getData=(array)$value;
                                $getData['submenu']=$submenuArr;
                             }
                        }


                         $finlArr[]=$getData;
                  }
 
            }
  
       }else{
          $finlArr=array();
       }
   
   return $finlArr;
}


public function getSelectedUserAccess($getuserId='',$menuIdAsKey=""){

      $user_details=$this->sqlQuery_model->sql_select_where('tbl_admin',array('admin_id'=>$getuserId));
      $unserializeValue=unserialize($user_details[0]->manu_access_ids);
      $arrCollect=array();
      foreach ($unserializeValue as $key => $value) {
            array_push($arrCollect, array($value['menu_id']=>$value));
      }

      $finlArr=array();
      foreach($arrCollect as $key1=>$filterVa){

           foreach ($filterVa as $key_2 => $fvalue) {
              $finlArr[$key_2]=$fvalue;
           }
      }




 // krishna    
      // $result=$finlArr[$menuIdAsKey];

       $result=($finlArr[$menuIdAsKey]!="") ? $finlArr[$menuIdAsKey] : array();


      return $result;
}

public function getUser_name($user_id){
      $sql=$this->sqlQuery_model->sql_select_where('tbl_admin',array('admin_id'=>$user_id));
      $name="";
      if($sql!=0){
          $name=$sql[0]->admin_name;
      }
       return $name;
}


public function userAthorizetion($menuIdAsKey=''){
   $session=$this->session->userdata('admin');

   if($session['admin_type']=='U'){
        $accessMunes=$this->getSelectedUserAccess($session['admin_id'],$menuIdAsKey);

        if($accessMunes==""){
          echo "No direct page access allowed.";
          exit;
        }
        // return ($accessMunes=="" && $accessMunes==null) ? array()  : $accessMunes;
        return $accessMunes;
      }else{
        return array('inputAction'=>array());
      }
}


public function getProductImage($type=''){
   $arr=array();
 if($type=='Products'){
    $sql=$this->sqlQuery_model->sql_select_where('tbl_product',array('status'=>1));
        
        if($sql!=0){
          foreach ($sql as $key => $value) {
            $name['gallimg_id']=0;
            $name['gallery_id']=0;
            $name['gallery_images']=$value->image1;
            $name['image_name']=$value->product_name;
            $name['updated_by']='';
            $name['status']=1;
            $name['add_date']=$value->add_date;
            $name['image_type']='product_image';
            $arr[]=(object)$name;

           
          }
            
        }
    }

       return $arr;
}


public function getproductImageGallery($type='',$value=''){
 
 if($type=='gallery_image'){

  $filePath=(($value->gallery_images!="") ? './uploads/gallery_image/'.$value->gallery_images :'');
    if(file_exists($filePath)){
       $imgFile=base_url().'uploads/gallery_image/'.$value->gallery_images;
    }else{
      $imgFile=base_url().'include/assets/default_product_image.png';
    }

 }else{

  $filePath=(($value->gallery_images!="") ? './uploads/'.$value->gallery_images :'');
    if(file_exists($filePath)){
       $imgFile=base_url().'uploads/'.$value->gallery_images;
    }else{
      $imgFile=base_url().'include/assets/default_product_image.png';
    }

 }

 return $imgFile;

}


public function getproductImageFrontedGallery($type='',$value=''){
 
 if($type=='gallery_image'){

  $filePath=(($value->gallery_images!="") ? './uploads/gallery_image/'.$value->gallery_images :'');
    if(file_exists($filePath)){
       $imgFile=base_url().'uploads/gallery_image/'.$value->gallery_images;
    }else{
      $imgFile='';
    }

 }else{

  $filePath=(($value->gallery_images!="") ? './uploads/'.$value->gallery_images :'');
    if(file_exists($filePath)){
       $imgFile=base_url().'uploads/'.$value->gallery_images;
    }else{
      $imgFile='';
    }

 }

 return $imgFile;

}


public function duplicationFind($withduplicateValue=array(),$withoutDouplicationValue=array()){
      $duplicates = array_diff_key($withduplicateValue, $withoutDouplicationValue);
      return $duplicates;
}


public function summernoteLibraryJS($filename='',$staticName=''){
    
     // $pageName=end($filename);

  // echo $filename .'__ '.$staticName;

     $lirLink ='';
    if(isset($filename) && isset($staticName) && $filename==$staticName){

      $lirLink ="<script src='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>
                 <script src='" . base_url() . "include/assets/summernote.min.js'></script> 
                <script>
   $(document).ready(function() {
     $('#summernote,#blog_description,#historyDetails,#short_details').summernote({
        height: 300,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline','clear'] ],
            [ 'fontname', [] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', ['link'] ],
            [ 'view', [ 'undo', 'redo','codeview' ] ]
        ]
    });

   });
    </script>";
    }else{
      $lirLink ='<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
    }

    return $lirLink;
}



// toolbar: [
//             [ 'style', [ 'style' ] ],
//             [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
//             [ 'fontname', [ 'fontname' ] ],
//             [ 'fontsize', [ 'fontsize' ] ],
//             [ 'color', [ 'color' ] ],
//             [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
//             [ 'table', [ 'table' ] ],
//             [ 'insert', [ 'link'] ],
//             [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
//         ]

public function summernoteLibraryCss($filename='',$staticName=''){
    
     // $pageName=end($filename);
     $lirLink ='';
     if(isset($filename) && isset($staticName) && $filename==$staticName){
      $lirLink ="<link href='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css' rel='stylesheet'>
      <link href='https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css' rel='stylesheet'>";
    }

    return $lirLink;
}


public function getTotalOrder($type=""){
   
  if($type=='today'){
    $where='date(order_add_date) = CURDATE();';
  }else if($type=='week'){
    $where='YEARWEEK(order_add_date) = YEARWEEK(NOW());';
  }else if($type=='month'){
    $where='MONTH(order_add_date) =MONTH(CURDATE());';
  }else if($type=='year'){
    $where='YEAR(order_add_date) =YEAR(CURDATE());';
  }else{
    $where='ord_status=1';
  }

   $sqlQuery="SELECT * FROM tbl_order_manager WHERE $where" ;
   $order_list=$this->sqlQuery_model->sql_query($sqlQuery);

   if($order_list!=0){
    $result=$order_list;
   }else{
     $result=array();
   }

    return $result;
 }


 public function mostSoldProducts($type=""){
   
   if($type=='today'){
    $where='date(pro_product_order_date) = CURDATE()';
  }else if($type=='week'){
    $where='YEARWEEK(pro_product_order_date) = YEARWEEK(NOW())';
  }else if($type=='month'){
    $where='MONTH(pro_product_order_date) =MONTH(CURDATE())';
  }else if($type=='year'){
    $where='YEAR(pro_product_order_date) =YEAR(CURDATE())';
  }else{
    $where='pro_status=1';
  }

 $sqlQuery="SELECT pro_sys_product_id,pro_product_name, SUM(pro_product_qty) as total_sold
FROM tbl_order_products 
WHERE $where
GROUP BY pro_sys_product_id ORDER BY total_sold DESC LIMIT 6" ;
  $order_list=$this->sqlQuery_model->sql_query($sqlQuery);

  return $order_list;

 }


public function getTotalCustomer($type){

  if($type=='today'){
    $where='date(add_date) = CURDATE();';
  }else if($type=='week'){
    $where='YEARWEEK(add_date) = YEARWEEK(NOW());';
  }else if($type=='month'){
    $where='MONTH(add_date) = MONTH(CURDATE());';
  }else if($type=='year'){
    $where='YEAR(add_date) = YEAR(CURDATE());';
  }else{
    $where='status=1';
  }

   $sqlQuery="SELECT * FROM tbl_customer WHERE $where" ;
   $customer_list=$this->sqlQuery_model->sql_query($sqlQuery);

   if($customer_list!=0){
    $result=$customer_list;
   }else{
     $result=array();
   }

    return $result;

}


public function getTotalSale($type){

  if($type=='today'){
    $where='date(order_add_date) = CURDATE();';
  }else if($type=='week'){
    $where='YEARWEEK(order_add_date) = YEARWEEK(NOW());';
  }else if($type=='month'){
    $where='MONTH(order_add_date) = MONTH(CURDATE());';
  }else if($type=='year'){
    $where='YEAR(order_add_date) = YEAR(CURDATE());';
  }else{
    $where='ord_status=1';
  }

   $sqlQuery="SELECT SUM(order_total_final_amt) as totalSale FROM tbl_order_manager WHERE $where" ;
   $customer_list=$this->sqlQuery_model->sql_query($sqlQuery);

   if($customer_list!=0){
    $result=$customer_list;
   }else{
     $result=array();
   }

    return $result;
}


public function totalProduct(){
$sql=$this->sqlQuery_model->sql_select_where('tbl_product',array('status'=>1));
if($sql!=0){
    $result=$sql;
   }else{
     $result=array();
   }

    return $result;

}



public function sellingProductGraphBar(){
 
 $category_list=$this->sqlQuery_model->sql_select('tbl_category','position');
$order_list=array();
 if($category_list!=0){

  foreach (array_reverse($category_list) as $key => $cat_value) {

     $query="SELECT YEAR(pro_add_date) AS year, MONTH(pro_add_date) AS month, COUNT(order_products_id) AS count, pro_cat_name,pro_cat_id FROM tbl_order_products WHERE pro_cat_id=$cat_value->cat_id AND pro_order_status='Delivered' AND YEAR(pro_add_date) = YEAR(CURDATE()) GROUP BY MONTH(pro_add_date), YEAR(pro_add_date);";
     // $order_list['category']=$cat_value->category;
     $order_list=$this->sqlQuery_model->sql_query($query);
      $data['name']=$cat_value->category;
        if($order_list!=0){
          $countOrder=array();
          foreach ($order_list as $key => $ord_value) {
            $countOrder[]=$ord_value->count;
          }

          $data['data']=$countOrder;
        }else{
          $data['data']=array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        }

        $list[]=$data;

     }
 } 
  
 return json_encode($list);

}


public function getEarningGgraphBar(){

  // $months=array("Jan", "Feb", "Mar", "Apr","May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
    $months=array(1,2,3,4,5,6,7,8,9,10,11,12);

    foreach ($months as $key => $mon_value) {
       $querycheck="SELECT order_add_date FROM tbl_order_manager WHERE order_status='Delivered' AND YEAR(order_add_date) = YEAR(CURDATE()) AND MONTH(order_add_date)=$mon_value";
       $checked_list=$this->sqlQuery_model->sql_query($querycheck);

       if($checked_list!=0){

            $query="SELECT SUM(order_total_final_amt) AS amount ,MONTH(order_add_date) as month,YEAR(order_add_date) as year FROM tbl_order_manager WHERE order_status='Delivered' AND YEAR(order_add_date) = YEAR(CURDATE()) AND MONTH(order_add_date)=$mon_value";
             $amount_list=$this->sqlQuery_model->sql_query($query);

             $finalVal=$amount_list[0]->amount;

       }else{
          $finalVal=0;
       }

       $list[]=$finalVal;
  
    }
   
   return json_encode($list);

}


 
 public function orderUpdateUniqueNumber($order_id="",$courier_unique_id=""){

     $chekExits=$this->sqlQuery_model->sql_select_where('tbl_order_manager',array('order_generated_order_id'=>$order_id));
       if($chekExits!=0){
           $post_arr=array('courier_unique_id'=>$courier_unique_id);
           $this->sqlQuery_model->sql_update('tbl_order_manager',$post_arr,array('order_generated_order_id'=>$order_id));

           $post_arr_pro=array('pro_courier_unique_id'=>$courier_unique_id);
           $this->sqlQuery_model->sql_update('tbl_order_products',$post_arr_pro,array('pro_generated_order_id'=>$order_id));
        }
   return true;
 }


public function getPacksizeDropdownHtml($get_data_id='',$getProduct_id='',$select_param=''){

  if($getProduct_id!=""){
 $query="SELECT * FROM tbl_product_variants WHERE variants_status=1 AND variants_unique_number=$getProduct_id";
   $dropdownPackSize_list=$this->sqlQuery_model->sql_query($query);
 
  $html .='<select class="form-control" id="offer-packsize'.$get_data_id.'">';
       if($dropdownPackSize_list!=0){
            foreach($dropdownPackSize_list as $value){
             
                $selected= ($value->variant_id==$select_param) ? 'selected':'';       
                $html .='<option value="'.$value->variant_id.'" '.$selected.'>'.$value->pack_size.''.$value->units.'</option>';
            }
          }
                              
     $html .='</select>';
   }else{
     $html .='<select class="form-control" id="offer-packsize'.$get_data_id.'"><option value="">-Select-</option>';
     $html .='</select>';
   }


   return $html;
}

public function getCategoryDropdownHtml($get_data_id='',$getProduct_id='',$select_param=''){

  if($getProduct_id!=""){
 $query="SELECT * FROM tbl_mapping_category_with_product WHERE status=1 AND unique_number=$getProduct_id";
   $dropdownCate_list=$this->sqlQuery_model->sql_query($query);

  $html .='<select class="form-control" id="offer-cate'.$get_data_id.'">';
       if($dropdownCate_list!=0){
            foreach($dropdownCate_list as $value){
             
                $selected= ($value->mapping_id==$select_param) ? 'selected':'';       
                $html .='<option value="'.$value->mapping_id.'" '.$selected.'>'.$value->category.'</option>';
            }
          }
                              
     $html .='</select>';
   }else{
     $html .='<select class="form-control" id="offer-cate'.$get_data_id.'"><option value="">-Select-</option>';
     $html .='</select>';
   }


   return $html;
}

public function updateWareIQ_updation_order_list($courier_unique_id=0){
  $orderWareIQ_Details=array();
  $result=false;
  if($courier_unique_id!=0){
   $orderWareIQ_Details=getOrderDetails($courier_unique_id);
  
   if($orderWareIQ_Details!=""){

      $courier=$orderWareIQ_Details->data->shipping_details->courier;
      $awb=$orderWareIQ_Details->data->shipping_details->awb;
      $status=$orderWareIQ_Details->data->status;

        $chekExits=$this->sqlQuery_model->sql_select_where('tbl_order_manager',array('courier_unique_id'=>$courier_unique_id));
        // echo "<pre>";
        // print_r($chekExits[0]->order_status);
        // echo "</pre>";
        // echo "<pre>";
        // print_r(ucfirst(strtolower($status)));
        // echo "</pre>";
        if($chekExits[0]->order_status!=ucfirst(strtolower($status))){
       
             $post_arr=array(
                           'order_awb_code'=>$awb,
                           'order_courier'=>$courier,
                           'order_status'=>($status=='NEW') ? 'Received':ucfirst(strtolower($status))
                        );
               $this->sqlQuery_model->sql_update('tbl_order_manager',$post_arr,array('courier_unique_id'=>$courier_unique_id));

               $post_arr_pro=array(
                           'awb_code'=>$awb,
                           'courier_name'=>$courier,
                           'pro_order_status'=>($status=='NEW') ? 'Received':ucfirst(strtolower($status))
                      );

              $this->sqlQuery_model->sql_update('tbl_order_products',$post_arr_pro,array('pro_courier_unique_id'=>$courier_unique_id));
           }
        }

    $result=true;
    }

 return $result;
}



public function varifyEmail($email){
  $result=false;
  if(checkemail($email)){
     $sqlQuery=$this->sqlQuery_model->sql_update('tbl_customer',array('verify_email'=>1),array('email'=>$email));
     $result=true;
  }
 return $result;
}


public function varifyMobile($mobile){
   $result=false;
   if(checkMobile($mobile)){
     $sqlQuery=$this->sqlQuery_model->sql_update('tbl_customer',array('verify_mobile'=>1),array('mobile'=>$mobile));
     $result=true;
   }
   return $result;
}

public function checkCustomerBlockOrNot($email_mobi=''){

    $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE (mobile='".trim($email_mobi)."' OR email='".trim($email_mobi)."')");
       $name="not-found-customer";
      if($sql!=0){
          $name=$sql[0]->status;
      }

      // echo "<pre>";
      // print_r($name);
      // echo "<pre>";
      // exit;
       return $name;

   
}


public function showOfficeOnProduct($product_id){
  
  $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_apply_offer WHERE  offer_product_unique_id='".$product_id."' AND status=1");
 

  $apply_offer=array();
  if($sql!=0){

         $apply_offer['purchase_product_id']=$product_id;
         $apply_offer['purchase_product_name']=$sql[0]->offer_purchase_product_name;

          $currentDate=date('Y-m-d');
     
     foreach ($sql as $key => $value) {

           $startDate=date($value->offer_start_date);
           $endDate=date($value->offer_end_date);

           $numberCurrent=strtotime($currentDate);
           $numberstart=strtotime($startDate);
           $numberend=strtotime($endDate);

    if($numberstart <= $numberCurrent && $numberend >= $numberCurrent){  

         $office['purchase_min_qty']=$value->offer_min_qty;
      
         $office_variant=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE  variant_id='".$value->offer_variant_id."' AND variants_status=1");
          $office['purchase_packsize']=$office_variant[0]->pack_size .' '.$office_variant[0]->units;

         $sql_office=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product WHERE  unique_number='".$value->offer_product_name."' AND status=1");
         $office['offer_product_name'] = $sql_office[0]->product_name;

         $sql_variant=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE  variant_id='".$value->offer_packsize."' AND variants_status=1");

         $office['offer_qty']=$value->offer_qty;
         $office['offer_pack_size'] = $sql_variant[0]->pack_size.' '.$sql_variant[0]->units;

             $apply_offer['office'][]=$office;

            }else{
              $apply_offer['office']=array();
            } 

     }

  }


 return $apply_offer;
}


public function displyOffer($product_id='',$offerset=''){
  
  $offerProduct=$this->showOfficeOnProduct($product_id);
   $html='';
  if($offerProduct!=array()){
    // echo "<pre>";
    // print_r($offerProduct['office']);
    // echo "</pre>";

    if($offerProduct['office']!=array()){

    $html .='<script type="text/javascript">
                  $(document).ready(function() {
                      var options = {
                          html: true,
                          title: "'.$offerProduct['purchase_product_name'].'",
                          content: $(\'[data-name="popover-content'.$offerProduct['purchase_product_id'].$offerset.'"]\')
                       }
                      var exampleEl = document.getElementById("example'.$offerProduct['purchase_product_id'].$offerset.'")
                      var popover = new bootstrap.Popover(exampleEl, options)
                  })';
      $html .='</script>';
    
    $html .= '<span class="custom_badge" data-bs-trigger="focus" id="example'.$offerProduct['purchase_product_id'].$offerset.'" tabindex="0" role="button" data-bs-toggle="popover'.$offerProduct['purchase_product_id'].$offerset.'" title="'.$offerProduct['purchase_product_name'].'" >Offer</span>';
    $html .='<section class="center">
              <div hidden>
              <div data-name="popover-content'.$offerProduct['purchase_product_id'].$offerset.'">
                  <div class="input-group">
                    <table class="table">
                             <tr>
                              <th>Purchase Packsize</th>
                              <th>Purchase Qty</th>
                              <th>Product name</th>
                              <th>Offer Packsize</th>
                              <th>Offer Qty</th>
                             </tr>
                    ';
                    foreach ($offerProduct['office'] as $key => $value) {
                     $html .='<tr>
                              <td>'.$value['purchase_packsize'].'</td>
                              <td>'.$value['purchase_min_qty'].'</td>
                              <td>'.$value['offer_product_name'].'</td>
                              <td>'.$value['offer_pack_size'].'</td>
                              <td>'.$value['offer_qty'].'</td>
                             </tr>'; 
                         }
                    $html .='</table>
                  </div>
              </div>
          </div>
      </section>';
    }

   }

 
 return  $html;

}



public function orderStatusManagement($cust_id=0,$order_id='',$order_status='',$reason=null,$order_pid=0,$order_vid=0,$updated_by=''){

      $chekExits=$this->sqlQuery_model->sql_select_where('tbl_delivery_process_status_manager',array('cust_id'=>$cust_id,'generated_order_id'=>$order_id,'delivery_status'=>$order_status));
       if($chekExits==0){

           $post_arr=array(
              'generated_order_id'=>$order_id,
              'order_products_id'=>$order_pid,
              'vendor_id'=>$order_vid,
              'cust_id'=>$cust_id,
              'delivery_status'=>$order_status,
              'description'=>$reason,
              'updated_by'=>$updated_by,
              'status_date'=>date('y-m-d H:i:s')
           );
          $inser_cancel=$this->sqlQuery_model->sql_insert('tbl_delivery_process_status_manager',$post_arr);

        }else{

           $post_arr=array(
              'delivery_status'=>$order_status,
              'description'=>$reason,
              'updated_by'=>$updated_by,
              'status_date'=>date('y-m-d H:i:s')
           );
          $inser_cancel=$this->sqlQuery_model->sql_update('tbl_delivery_process_status_manager',$post_arr,array('cust_id'=>$cust_id,'generated_order_id'=>$order_id,'delivery_status'=>$order_status));
        }

          return $inser_cancel;    
 }


public function updatableOrderStatusProcess($order_id,$order_status_array,$added_order_status,$order_type){
 // take_away, delivery
     $chekExits=$this->sqlQuery_model->sql_select_where('tbl_delivery_process_status_manager',array('generated_order_id'=>$order_id));
      $status_collect=array();
     if($chekExits!=0){
      foreach ($chekExits as $key => $val) {
            array_push($status_collect, $val->delivery_status);
         }
     }
                     
         $html='<option value="">-Select-</option>';
          if($order_status_array!=0){

             foreach($order_status_array as $v){

           //    echo "<pre>";
           // print_r($v->order_status);
           // echo "</pre>";
                   $selected=($added_order_status==$v->order_status) ? 'Selected' :'';

                       if($status_collect==array()){
                          if($v->order_status=='Pending' || $v->order_status=='Received' || $v->order_status=='Canceled' || $v->order_status=='On Hold'){
                            $html .='<option  value="'.$v->order_status.'" '.$selected.'>'.$v->order_status.'</option>';
                          }

                      }else{

                       if(end($status_collect)=='Received'){
                          if($v->order_status=='Received' || $v->order_status=='Ready to ship' || $v->order_status=='On Hold'){
                               // if($shiprocket_order_id!=""){
                                  $html .='<option  value="'.$v->order_status.'" '.$selected.'>'.$v->order_status.'</option>';
                                // }
                           }
                       }else if(end($status_collect)=='Ready to ship'){
                         
                          if($v->order_status=='Ready to ship' || $v->order_status=='Shipped' || $v->order_status=='On Hold'){
                            $html .='<option  value="'.$v->order_status.'" '.$selected.'>'.$v->order_status.'</option>';
                           }

                       }else if(end($status_collect)=='Shipped'){
                            if($v->order_status=='Shipped' || $v->order_status=='Delivered' || $v->order_status=='Canceled' || $v->order_status=='On Hold'){
                              $html .='<option  value="'.$v->order_status.'" '.$selected.'>'.$v->order_status.'</option>';
                            }
                       }else if(end($status_collect)=='Delivered'){
                            if($v->order_status=='Delivered'){
                                $html .='<option  value="'.$v->order_status.'" '.$selected.'>'.$v->order_status.'</option>';
                            }
                       }else if(end($status_collect)=='On Hold'){

                        if($v->order_status=='Shipped' || $v->order_status=='Delivered' || $v->order_status=='Canceled' || $v->order_status=='On Hold'){
                              $html .='<option  value="'.$v->order_status.'" '.$selected.'>'.$v->order_status.'</option>';
                            }
                       }else if(end($status_collect)=='Canceled'){
                           if($v->order_status=='Canceled'){
                                $html .='<option  value="'.$v->order_status.'" '.$selected.'>'.$v->order_status.'</option>';
                            }

                       }
                        
                   } 
              }
       

                       // echo "<pre>";
                       // print_r($html);
                       // echo "</pre>"; 
 }
echo $html;
}



public function getDeliveryStatusDropdownOption($order_status_array,$order_type){


}

public function getTakeAwayStatusDropdownOption(){


}


// public function setPincode_DeliverySelect($get_pincode='',$takeWay='',$actionType=1){
//    $columsName=$this->deliveryTypeDisplayProduct($get_pincode,$takeWay,$actionType);
//    $session = array('value' =>$get_pincode,'location'=>$columsName[1]);
//    return $session;
// }


public function getProductDeliveryOrNotStatus($product_id=''){
//   $user=$this->my_libraries->mh_getCookies('customer');
//   $sessionType=$this->session->userdata('valueType');
  

//   $where['pro.status']=1;
//   $where['pro.unique_number']=$product_id;

//   $where_and_chain=queryChain($where);
//   $foodhab_name='';
//   $shifLife_name='';
//   $sortPrice='';
//   $sortTypes='';
//   $sql_limit='';
//   $search_like='';
  

//  // echo "hiee";
//  //   echo "<pre>";
//  //  print_r($sessionType);
//  //  echo "<pre>";

// $columsName=$this->setPRoductCondition($user,$where,$sessionType); 
// // echo "ftttt";
// // echo "<pre>";
// // print_r($columsName);
// // echo "<pre>";

// // echo "<pre>";
// // echo "Hiiii";
// //   print_r($columsName);
// //   echo "<pre>";
// //   exit; 
// $pArr=$this->getProductlist($where_and_chain,$foodhab_name,$shifLife_name,$columsName[0],$sortPrice,$sortTypes,$sql_limit,$search_like);

//   $product_list=$pArr;



//   return $product_list[0]->deliveryStatus;

// //   echo "<pre>";
// //   print_r($product_list[0]->deliveryStatus);
// //   echo "<pre>";
// // exit;
 
}

public function checkProductDeliveryPincode($product_id='',$sessionType=''){
      $user=$this->my_libraries->mh_getCookies('customer');
      $where['pro.status']=1;
      $where['pro.unique_number']=$product_id;

      $where_and_chain=queryChain($where);
      $foodhab_name='';
      $shifLife_name='';
      $sortPrice='';
      $sortTypes='';
      $sql_limit='';
      $search_like='';

    

    $columsName=$this->setProductCondition_checkoutpage($user,$where,$sessionType); 

     
    $pArr=$this->getProductlist($where_and_chain,$foodhab_name,$shifLife_name,$columsName[0],$sortPrice,$sortTypes,$sql_limit,$search_like);
      $product_list=$pArr;

    //   echo "fiii";
    // echo "<pre>";
    // print_r($sessionType);
    // echo "</pre>";
      return $product_list[0]->deliveryStatus;

}


public function setProductCondition_checkoutpage($user="",$where="",$sessionType=""){

      $columsName[0]='status';
      $actionType=0;
      if($user!=""){
          $sqlPincode=$this->sqlQuery_model->sql_select_where('tbl_userlocationmanage',array('user_id'=>$user[0]->customer_id)); 
        }else{
          $sqlPincode=0;
        }
     
       if($sqlPincode!=0){
            if($sqlPincode[0]->pincode=="take_away"){
               $get_pincode="";
               $takeWay=$sqlPincode[0]->pincode;
            }else{
              $get_pincode=$sqlPincode[0]->pincode;
              $takeWay="";
            }
           $columsName=$this->deliveryTypeDisplayProduct_checkoutPage($get_pincode,$takeWay,$actionType,$sessionType);
            
       }else{
               if($sessionType!=""){
                  if($sessionType['value']!='take_away'){
                    $get_pincode=$sessionType['value'];
                    $takeWay="";
                    }else{
                    $get_pincode="";
                    $takeWay=$sessionType['value'];
                    }
                $columsName=$this->deliveryTypeDisplayProduct_checkoutPage($get_pincode,$takeWay,$actionType,$sessionType);
               }
           }


    return   $columsName;
}



public function getColumnsNameShippingCharges($pincode=0,$where="",$sessionType=""){

      $columsName[0]='status';
      $actionType=0;
      $sqlPincode=$pincode;
      // if($user!=""){
      //     $sqlPincode=$this->sqlQuery_model->sql_select_where('tbl_userlocationmanage',array('user_id'=>$user[0]->customer_id)); 
      //   }else{
      //     $sqlPincode=0;
      //   }
     
       if($sqlPincode!=0){
            if($sqlPincode[0]->pincode=="take_away"){
               $get_pincode="";
               $takeWay=$sqlPincode[0]->pincode;
            }else{
              $get_pincode=$sqlPincode[0]->pincode;
              $takeWay="";
            }
           $columsName=$this->deliveryTypeDisplayProduct_checkoutPage($get_pincode,$takeWay,$actionType,$sessionType);
            
       }else{
               if($sessionType!=""){
                  if($sessionType['value']!='take_away'){
                    $get_pincode=$sessionType['value'];
                    $takeWay="";
                    }else{
                    $get_pincode="";
                    $takeWay=$sessionType['value'];
                    }
                $columsName=$this->deliveryTypeDisplayProduct_checkoutPage($get_pincode,$takeWay,$actionType,$sessionType);
               }
           }


    return   $columsName;

}



public function checkProductDeliveryStatusOnSelectType($user='',$cart_details='',$dlivetype=0){

  if($dlivetype==1 || $dlivetype==''){   // Delivery Selection
    
      $shippingAddress_selectAddress=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$user[0]->customer_id,'setAddressDefault'=>1));

      if($shippingAddress_selectAddress!=0){

            $get_pincode__=$shippingAddress_selectAddress[0]->pincode;
            $takeWay='';
            $actionType=1;
            $response=$this->displayProductAccourdingToDeliveryType($get_pincode__,$takeWay,$actionType);
             $sessionType_ = array('value' =>$get_pincode__,'location'=>$response[1]);


                  $_arrayCall_notDelivry=array();
                    foreach ($cart_details as $key => $_cart) {
                             $_deliveryStatus_in_shippingAddress= $this->checkProductDeliveryPincode($_cart['options']['product_gen_id'],$sessionType_);

                        array_push($_arrayCall_notDelivry, $_deliveryStatus_in_shippingAddress);
                        
                    }



        }else{

          

            $actionType=1;

            
               // $columsName=$this->my_libraries->deliveryTypeDisplayProduct($pincode,$takeWay,$actionType);
               // $session = array('value' =>$pincode,'location'=>$columsName[1]);
               $sessionType_=$this->session->userdata('valueType');
               // echo "<pre>";
               // print_r($sessionType_['value']);
               // echo "</pre>";

               $get_pincode__=$sessionType_['value'];

                $_arrayCall_notDelivry=array();
                    foreach ($cart_details as $key => $_cart) {
                             $_deliveryStatus_in_shippingAddress= $this->checkProductDeliveryPincode($_cart['options']['product_gen_id'],$sessionType_);

                        array_push($_arrayCall_notDelivry, $_deliveryStatus_in_shippingAddress);
                        
                    }

               // echo "<pre>";
               // print_r($_arrayCall_notDelivry);
               // echo "</pre>";
        }  

               // echo "<pre>";
               // print_r($_arrayCall_notDelivry);
               // echo "</pre>";
               $result=array('dlivetype'=>$dlivetype,'typeValue'=>$get_pincode__,'result'=>false);
               if(!in_array(0, $_arrayCall_notDelivry)){
                $result=array('dlivetype'=>$dlivetype,'typeValue'=>$get_pincode__,'result'=>true);
               }

               //  echo "<pre>";
               // print_r($result);
               // echo "</pre>";
     
           
  }else{


      
      $get_pincode__='';
      $takeWay='take_away';
      $actionType=0;
      $response=$this->displayProductAccourdingToDeliveryType($get_pincode__,$takeWay,$actionType);
      $sessionType_ = array('value' =>$response[0],'location'=>$response[1]);
      
     
       $_arrayCall_notDelivry=array();
       foreach ($cart_details as $key => $_cart) {
                   $_deliveryStatus_in_shippingAddress= $this->checkProductDeliveryPincode($_cart['options']['product_gen_id'],$sessionType_);

              array_push($_arrayCall_notDelivry, $_deliveryStatus_in_shippingAddress);
              
          }


           $result=array('dlivetype'=>$dlivetype,'typeValue'=>$takeWay,'result'=>false);
           if(!in_array(0, $_arrayCall_notDelivry)){
            $result=array('dlivetype'=>$dlivetype,'typeValue'=>$takeWay,'result'=>true);
           }

  }

  // echo "hiiee1";
  //     echo "<pre>";
  //     print_r($result);
  //     echo "</pre>";
  //     exit;


   return $result;
  

}



public function getShippingChargesOnAddressPincode($user='',$cart_details='',$itemsWieght='',$dlivetype=0){

  $checkResutl=$this->checkProductDeliveryStatusOnSelectType($user,$cart_details,$dlivetype);

      if($checkResutl['dlivetype']==1 ||$checkResutl['dlivetype']==''){

          $shippingAddress_selectAddress=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$user[0]->customer_id,'setAddressDefault'=>1));

            $where='';
            $actionType=1;
            $takeWay="";
           if($shippingAddress_selectAddress!=0){
          
                 $columsName= $this->displayProductAccourdingToDeliveryType($shippingAddress_selectAddress[0]->pincode,$takeWay,$actionType);


                 $shippingCharg=$this->catculateShippingCharges($itemsWieght[1]['finalQty'],$itemsWieght[1]['finalWieght'],$columsName,$cart_details,$this->cart->total());
                  
            
           }else{

             $sessionType=$this->session->userdata('valueType');
             $columsName=$this->setPRoductCondition($user,$where,$sessionType);

             $shippingCharg=$this->catculateShippingCharges($itemsWieght[1]['finalQty'],$itemsWieght[1]['finalWieght'],$columsName,$cart_details,$this->cart->total());

           }

         }else{

             $sessionType=$this->session->userdata('valueType');
             $columsName=$this->setPRoductCondition($user,$where,$sessionType);

             $shippingCharg=$this->catculateShippingCharges($itemsWieght[1]['finalQty'],$itemsWieght[1]['finalWieght'],$columsName,$cart_details,$this->cart->total());

         }


      if ($shippingCharg['shippingCharges']=='FREE') {
          $shippChargesFree=$shippingCharg['shippingCharges'];
          $shippCharges=0;
       }else{
          $shippCharges=$shippingCharg['shippingCharges'];
          $shippChargesFree='';
        }


       return array('shippChargesFree'=>$shippChargesFree,'shippCharges'=>$shippCharges);
 
}




public function deliveryTypeDisplayProduct_checkoutPage($get_pincode="",$takeWay="",$actionType=0,$sessionType=''){
    $user=$this->my_libraries->mh_getCookies('customer');
    // $sesionValue=$this->session->userdata('valueType');
    $sesionValue=$sessionType;
    // echo "<pre>";
    //  print_r($sesionValue);
    //  echo "</pre>";
   $columsName='';
   $locationData='';
  
  if(($sesionValue==""|| $sesionValue!="")  && $actionType==1){
     // echo "hiiiieeettt";
        $response=$this->displayProductAccourdingToDeliveryType($get_pincode,$takeWay,$actionType);

         $columsName=$response[0];
         $locationData=$response[1];

        

   }else{


           
        
           if($user!=""){
              $sqlPincode=$this->sqlQuery_model->sql_select_where('tbl_userlocationmanage',array('user_id'=>$user[0]->customer_id)); 
            }else{
              $sqlPincode=0;
            }



          if($sqlPincode==0){
                if($sesionValue['value']=='take_away'){
                    $columsName='pick_up_store';
                    $locationData='';
                }else{
                   $columsName=$sesionValue['location'][0]->delivery_type;
                   $locationData=$sesionValue['location'];
                }

            }else{
                

                  
                   if($sqlPincode[0]->pincode=="take_away"){
                        $columsName='pick_up_store';
                        $locationData='';
                    }else{
           
                       
                         if($sesionValue==""){
                             $get_pincode_=$sqlPincode[0]->pincode;
                             $takeWay='';
                             $response=$this->displayProductAccourdingToDeliveryType($get_pincode_,$takeWay,$actionType);
                             $session = array('value' =>$get_pincode,'location'=>$response[1]);
                             // $this->session->set_userdata('valueType',$session); 

                             $columsName=$response[0];
                             $locationData=$response[1];
                         }else{

                          $columsName=$sesionValue['location'][0]->delivery_type;
                          $locationData=$sesionValue['location'];

                         }

                    }
            }

   }

        // $this->session->set_userdata('valueType',$session); 
         return array($columsName,$locationData);
}


public function getOrderProduct($order_generated_order_id=''){

   $getOrder=$this->sqlQuery_model->sql_select_where('tbl_order_manager',array('order_generated_order_id'=>$order_generated_order_id));

   $data['status']=1;
   $data['message']='';
   $data['url']='';
   $data['productOrder']=array(
    'order_manager'=>(array) $getOrder[0],
    'orderItems'=>$this->sqlQuery_model->sql_select_where('tbl_order_products',array('pro_generated_order_id'=>$order_generated_order_id)),
   );

 
 return $data;

}



public function calenderShow(){
   
   $prefs['template'] = '
                   {table_open}<table border="0" cellpadding="0" cellspacing="0" class="table">{/table_open}

                   {heading_row_start}<tr>{/heading_row_start}

                   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
                   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
                   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

                   {heading_row_end}</tr>{/heading_row_end}

                   {week_row_start}<tr>{/week_row_start}
                   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
                   {week_row_end}</tr>{/week_row_end}

                   {cal_row_start}<tr>{/cal_row_start}
                   {cal_cell_start}<td>{/cal_cell_start}

                   {cal_cell_content}<a href="{content}" data-id="'.date("Y").'-'.date("m").'-{day}" class="day-time">{day}</a>{/cal_cell_content}
                   {cal_cell_content_today}<div class="highlight"><a href="{content}" data-id="'.date("Y").'-'.date("m").'-{day}" class="day-time">{day}</a></div>{/cal_cell_content_today}

                   {cal_cell_no_content}<span class="previous-day-css">{day}</span>{/cal_cell_no_content}
                   {cal_cell_no_content_today}<div class="highlight"><span class="previous-day-css">{day}</span></div>{/cal_cell_no_content_today}

                   {cal_cell_blank}&nbsp;{/cal_cell_blank}

                   {cal_cell_end}</td>{/cal_cell_end}
                   {cal_row_end}</tr>{/cal_row_end}

                   {table_close}</table>{/table_close}';

                
  
   $this->load->library('calendar',$prefs);

      $data = getAddDateOfMonth();
      $year=date("Y",strtotime("-1 year"));


   echo $this->calendar->generate('','',$data);
}


public function checkstockActivationStatus($unique_number="",$ci_cat_id="",$ci_sub_cat_id=""){

    $sql=$this->sqlQuery_model->sql_select_where('tbl_mapping_category_with_product',array('unique_number'=>$unique_number,'pro_ci_cat_name'=>$ci_cat_id,'pro_ci_sub_cat_name'=>$ci_sub_cat_id));
    // echo "<pre>";
    // print_r($sql);
    // echo "</pre>";
    if($sql!=0){

       foreach($sql as $value){
            
             $sql_category=$this->sqlQuery_model->sql_select_where('tbl_category',array('ci_cat_name'=>$value->pro_ci_cat_name));
             
             if($sql_category[0]->in_stock_status==1){

                   $sql_sub_category=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('cat_id'=>$value->cat_id,'ci_sub_cat_name'=>$value->pro_ci_sub_cat_name));

                    if($sql_sub_category[0]->in_stock_status==1){
                         $status='active_stock';
                    }else{
                       $status='in_active_stock';
                    }

             }else{
              $status='in_active_stock';
             }


             return $status;

       }
    }

   

}


// public function cartUpdateOnCustomerLogin($cart_details=array(),$customer=array()){

//   echo "<pre>";
//   print_r($cart_details);
//   echo "</pre>";

//   exit;

//    $return=false;
//     if($cart_details!=array() || $cart_details!=""){
//      $sql_category=$this->sqlQuery_model->sql_update('tbl_customer',array('cart_items'=>serialize($cart_details)),array('customer_id'=>$customer[0]->customer_id));
//      $return=true;
//     }
//   return $return;
// }

public function cartInsertManager($cart_details=array(),$customer=array()){
    
   $postArr=array();

    if($cart_details!=array()){
      // $this->sqlQuery_model->sql_delete('tbl_cartmanager',array('user_id'=>$customer[0]->customer_id));
      $this->getPreviousCart($customer[0]->customer_id);
      foreach ($cart_details as $key => $value) {
       
         $postArr[]=array(
          'user_id'=>$customer[0]->customer_id,
          'product_id'=>$value['id'],
          'variant_id'=>$value['options']['variant_id'],
          'qty'=>$value['qty'],
          'price'=>$value['price'],
          'name'=>$value['name'],
          'options'=>serialize($value['options'])
         ); 
    }

  $this->sqlQuery_model->sql_insert_batch('tbl_cartmanager',$postArr); 

 
  }else{

   // $sql_cart=$this->sqlQuery_model->sql_select('tbl_cartmanager',array('user_id'=>$customer[0]->customer_id));
     $this->getPreviousCart($customer[0]->customer_id);

  }



return true;


}

public function getPreviousCart($customer_id){

   $_sql_cart=$this->sqlQuery_model->sql_select_where('tbl_cartmanager',array('user_id'=>$customer_id));
 
     if($_sql_cart!=0){


           foreach ($_sql_cart as $key => $val) {

            $cartProduct = array(
                         'id'=>     $val->product_id,
                         'qty'     => $val->qty,
                         'price'   => $val->price,
                         'name'    => $val->name,
                         'options' => unserialize($val->options)
                       );

                   $this->cart->product_name_rules = '[:print:]';  // using for special character also accepted in cart
                   $resopnse = $this->cart->insert($cartProduct);
           }
     }
  return true;
}



public function getFilterCatName($get_cate='',$get_sub_cate='',$get_chile_cate=''){
 
 if(empty($get_cate) && empty($get_sub_cate) && empty($get_chile_cate)){
     $catMenuList=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_category WHERE  status=1 ORDER BY position DESC");
     $arrVa=array();
      if($catMenuList!=0){
          foreach (array_reverse($catMenuList) as $key => $value) {
             $arrVa[]=array(
                   'id'=>$value->cat_id,
                   'url'=>base_url('shop/'.$value->ci_cat_name).'/?d='.base64_encode($value->cat_id),
                   'name'=>$value->category,
                   'ci_cat'=>$value->ci_cat_name,
                   'type'=>'category'
                );
            }
        }

  }else{

      if(!empty($get_cate) && empty($get_sub_cate) && empty($get_chile_cate)){
           $catId = $this->getCate_id_by_ci($get_cate);
           $catMenuList=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('cat_id'=>$catId,'status'=>1));
             $arrVa=array();
            if($catMenuList!=0){
                foreach ($catMenuList as $key => $value) {
                  $catid_ = $this->getCate_name_ci($value->cat_id);
                   $arrVa[]=array(
                         'id'=>$value->sub_cat_id,
                         'url'=>base_url('shop/'.$catid_.'/'.$value->ci_sub_cat_name).'/?d='.base64_encode($value->sub_cat_id),
                         'name'=>$value->subCat_name,
                         'ci_cat'=>$value->ci_sub_cat_name,
                         'type'=>'sub_category'
                      );
                  }

            }

             

       }else if(!empty($get_cate) && !empty($get_sub_cate) && empty($get_chile_cate)){

           $subCatId = $this->getSubCate_id_by_ci($get_sub_cate);
            $arrVa = $this->getSubChildcatListArr($subCatId,$get_cate);


      }else if(!empty($get_cate) && !empty($get_sub_cate) && !empty($get_chile_cate)){
           $subCatId = $this->getSubCate_id_by_ci($get_sub_cate);
           $arrVa=$this->getSubChildcatListArr($subCatId,$get_cate);
       }

   }

   return $arrVa;

}


public function getSubChildcatListArr($subCatId,$get_cate){


           $catMenuList=$this->sqlQuery_model->sql_select_where('tbl_child_category',array('sub_cat_id'=>$subCatId,'status'=>1)); 
             $arrVa=array();
            if($catMenuList!=0){
                foreach ($catMenuList as $key => $value) {
                  $catid_ = $this->getCate_name_ci($value->cat_id);
                  $subcatid_ = $this->getSubCate_name_ci($value->sub_cat_id);
                   $arrVa[]=array(
                         'id'=>$value->child_cat_id,
                         'url'=>base_url('shop/'.$catid_.'/'.$subcatid_.'/'.$value->ci_child_cat_name).'/?d='.base64_encode($value->child_cat_id),
                         'name'=>$value->childCat_name,
                         'ci_cat'=>$value->ci_child_cat_name,
                         'type'=>'child_category'
                      );
                  }

             }else{

                 $catId = $this->getCate_id_by_ci($get_cate);
                   $catMenuList=$this->sqlQuery_model->sql_select_where('tbl_sub_category',array('cat_id'=>$catId,'status'=>1));
                     $arrVa=array();
                    if($catMenuList!=0){
                        foreach ($catMenuList as $key => $value) {
                          $catid_ = $this->getCate_name_ci($value->cat_id);
                           $arrVa[]=array(
                                 'id'=>$value->sub_cat_id,
                                 'url'=>base_url('shop/'.$catid_.'/'.$value->ci_sub_cat_name).'/?d='.base64_encode($value->sub_cat_id),
                                 'name'=>$value->subCat_name,
                                 'ci_cat'=>$value->ci_sub_cat_name,
                                 'type'=>'sub_category'
                              );
                          }
                    }

             }

 return $arrVa;

}


public function priceRangeDiv($get_cate='',$get_sub_cate='',$get_chile_cate=''){
    
     if(empty($get_cate) && empty($get_sub_cate) && empty($get_chile_cate)){
          $sqlQuery = "SELECT * FROM tbl_mapping_category_with_product WHERE status=1";
          $proPric=$this->sqlQuery_model->sql_query($sqlQuery);
           $arrVa=array();
            if($proPric!=0){
              $arrVa=$proPric;
            }

      }else{
          
          if(!empty($get_cate) && empty($get_sub_cate) && empty($get_chile_cate)){
               $sqlQuery = "SELECT * FROM tbl_mapping_category_with_product WHERE `pro_ci_cat_name`='".$get_cate."' AND status=1";
              $proPric=$this->sqlQuery_model->sql_query($sqlQuery);
              $arrVa=array();
              if($proPric!=0){
                $arrVa=$proPric;
              }

          }else if(!empty($get_cate) && !empty($get_sub_cate) && empty($get_chile_cate)){
                $sqlQuery = "SELECT * FROM tbl_mapping_category_with_product WHERE `pro_ci_sub_cat_name`='".$get_sub_cate."' AND status=1";
                $proPric=$this->sqlQuery_model->sql_query($sqlQuery);
                $arrVa=array();
                if($proPric!=0){
                  $arrVa=$proPric;
                }
           }else if(!empty($get_cate) && !empty($get_sub_cate) && !empty($get_chile_cate)){

                $sqlQuery = "SELECT * FROM tbl_mapping_category_with_product WHERE `pro_ci_sub_cat_name`='".$get_sub_cate."' AND status=1";
                $proPric=$this->sqlQuery_model->sql_query($sqlQuery);
                $arrVa=array();
                if($proPric!=0){
                  $arrVa=$proPric;
                }
          }

      }

     $productIds = array_column($arrVa, 'mapping_product_id');
     $implode=($arrVa!=array())? ' AND `variants_product_id` IN ('.implode(',', $productIds).')' :'' ;

     // $sqlQuery ="SELECT MIN(`price`) as lowPrice,MAX(`price`) as highPrice FROM `tbl_product_variants` WHERE `variants_status`=1 $implode";

     $sqlQuery ="SELECT `price` FROM `tbl_product_variants` WHERE `variants_status`=1 $implode ORDER BY `price` ASC";

    $sqlVariant=$this->sqlQuery_model->sql_query($sqlQuery);
    $rangePrice=array();

    if($sqlVariant!=0){
        $categorizedProducts = [];
        foreach ($sqlVariant as $product) {
            $price = $product->price;
            $range = $this->getPriceRange($price);
            $categorizedProducts[$range['lable']] = $range;
        }

        foreach ($categorizedProducts as $range => $productsInRange) {
              $rangePrice[] = $productsInRange;
        } 
    }

      return $rangePrice;

}


function getPriceRange($price)
{
    if ($price < 20) {
         $result=array( 'lable'=>'Less than Rs 20', 'less'=>'LessThan', 'high'=>20);
      
    } elseif ($price <= 50) {
       $result=array('lable'=>'Rs 21 to Rs 50','less'=>21,'high'=>50);
       
    } elseif ($price <= 100) {
      $result=array('lable'=>'Rs 51 to Rs 100','less'=>51,'high'=>100);
       
    } elseif ($price <= 200) {
       $result=array('lable'=>'Rs 101 to Rs 200','less'=>101,'high'=>200);
       
    } elseif ($price <= 500) {
       $result=array( 'lable'=>'Rs 201 to Rs 500', 'less'=>201, 'high'=>500 );

    } elseif ($price <= 600) {
      $result=array('lable'=>'Rs 501 to Rs 600','less'=>501,'high'=>600 );

    }else if($price <= 700){
       $result=array( 'lable'=>'Rs 601 to Rs 700', 'less'=>601, 'high'=>700);
     
    }else if($price <= 800){
      $result=array('lable'=>'Rs 701 to Rs 800','less'=>701,'high'=>800 );

    }else if($price <= 900){
      $result=array('lable'=>'Rs 801 to Rs 900','less'=>801,'high'=>900);

    }else if($price <= 1000){
       $result=array('lable'=>'Rs 901 to Rs 1000','less'=>901,'high'=>1000 );
     
    } else {
       $result=array('lable'=>'More than Rs 1000',  'less'=>'MoreThan',  'high'=>1000);
    }

    return $result;
}



public function orderProcessSteps($cust_id='',$order_id=''){

   $ordrProcess=$this->sqlQuery_model->sql_select_where('tbl_delivery_process_status_manager',array('cust_id'=>$cust_id,'generated_order_id'=>$order_id));

   if($ordrProcess!=0){
    $getproccess=array_column($ordrProcess,'delivery_status');
   }else{
    $getproccess=array('Pending');
   }

 return $getproccess;
}





public function calculateProductRating($product_id=''){

  $customer=$this->sqlQuery_model->sql_select_where('tbl_customer',array('status'=>1));
  $totalCustomers = ($customer!=0) ? count($customer) : 0;

  $ratingArr = array(1,2,3,4,5);
  $finalarr=array();

  foreach ($ratingArr as $key => $value) {
    $getReview=$this->sqlQuery_model->sql_select_where('tbl_rate_and_review',array('product_id'=>$product_id,'cust_rate'=>$value));
     
     $numberOf5StarRatings = ($getReview!=0) ? count($getReview) : count(array());
     $perc= ($numberOf5StarRatings / $totalCustomers) * 100;

     $finalarr[] = array(
      'star'=>$value,
      'percantage' => round($perc)
      );
  }

  $result['rate_bar'] =array_reverse($finalarr);


   $total_review=$this->sqlQuery_model->sql_select_where('tbl_rate_and_review',array('product_id'=>$product_id));
   $total_user_rating=0;
   $average_rating=0;
   if($total_review!=0){
     foreach ($total_review as $key => $gvalue) {
        $total_user_rating = $total_user_rating + $gvalue->cust_rate;
     }

     $countReview = ($total_review!=0) ? count($total_review) : 0 ;
     $average_rating = $total_user_rating / $countReview;
   }

           
   $result['average_rating'] = $average_rating;
 
 
return $result;

}


public function checkCustomer($customer_id=''){
   $chekExits=$this->sqlQuery_model->sql_select_where('tbl_user_keys',array('user_id'=>$customer_id));
   $resutl=true;
   if($chekExits==0){
    $resutl=false;
   }
  return $resutl;
}



public function shopBarLinkUrl($get_shop='',$get_cate='',$get_sub_cate='',$get_chile_cate=''){
   

   $categoryUrl=base_url('shop/'.$get_cate).'/?d='.base64_encode($this->getCate_id_by_ci($get_cate));

   $subcategoryUrl=base_url('shop/'.$get_cate.'/'.$get_sub_cate).'/?d='.base64_encode($this->getSubCate_id_by_ci($get_sub_cate));

   $childcategoryUrl=base_url('shop/'.$get_cate.'/'.$get_sub_cate.'/'.$get_chile_cate).'/?d='.base64_encode($this->getChild_id_by_ci($get_chile_cate));

    $shop=($get_cate!="") ? '<a href="javascript:void(0);" data-href="'.base_url('shop').'" class="filterCategory">'.$get_shop.'</a>':$get_shop;

    $cateName=($get_cate!="") ? '<span></span><a href="javascript:void(0);" data-href="'.$categoryUrl.'" class="filterCategory">'.$this->getCate_name_by_ci($get_cate).'</a>':'';

    $subCate =($get_sub_cate!="") ? '<span></span><a href="javascript:void(0);" data-href="'.$subcategoryUrl.'" class="filterCategory">'.$this->getSubCate_name_by_ci($get_sub_cate).'</a>' :'';

    $childName=($get_chile_cate!="") ? '<span></span><a href="javascript:void(0);" data-href="'.$childcategoryUrl.'" class="filterCategory">'.$this->getChild_name_by_ci($get_chile_cate).'</a>' :'';

    return $shop.$cateName.$subCate.$childName;

}


public function getDeliverableAndNotDeliverableStatus($product_id){
  $location_pin=$this->session->userdata('pincode_loc');

  $result = 1;
  if($location_pin!="" && $location_pin!=array()){

     $whcodes=$location_pin['werehouse'];
     if($whcodes!="" || $whcodes!=array()){
      foreach ($whcodes as $key => $value) {
         $or = (($key+1) <count($whcodes)) ? 'OR' : '';
         $whereOr .= " werehouse_code = '" .$value. "' $or " ;
      }

     $sqlQuery ="SELECT * FROM `tbl_mapping_werehouse_with_product` WHERE `wh_product_id`= $product_id AND ($whereOr)";
     $sqlStatus=$this->sqlQuery_model->sql_query($sqlQuery);
     $getprodId=($sqlStatus!=0) ? array_unique(array_column($sqlStatus,'wh_product_id')) : array();
         $result = 0;
        if($getprodId!=array()){
          $result = 1;
        }

    }  //whcodes
   
  } //location_pin

  return $result;

}







public function productDetailPageBarlink($product=array()){
   $result='';
  if($product!=array()){

       $categoryUrl=base_url('shop/'.$product[0]->pro_ci_cat_name).'/?d='.base64_encode($product[0]->cat_id);
       $subcategoryUrl=base_url('shop/'.$product[0]->pro_ci_cat_name.'/'.$product[0]->pro_ci_sub_cat_name).'/?d='.base64_encode($product[0]->sub_cat_id);

       $shop ='<span></span><a href="'.base_url('shop').'">Shop</a>';
       $cateName='<span></span><a href="'.$categoryUrl.'">'.$product[0]->category.'</a>';

       $subCate ='<span></span><a href="'.$subcategoryUrl.'">'.$product[0]->sub_category.'</a>';

       $productName ='<span></span>'.$product[0]->product_name;

       $result= $shop.$cateName.$subCate.$productName;
  }

   return $result;
}




public function checkCartShippingPincode($pincode){
   $getArr=array();
    if($pincode!=""){
     
      $getPincode=$this->sqlQuery_model->sql_select_where('tbl_delivery_pincode',array('pincode'=>$pincode,'courier_type'=>'dtdc'));

      if($getPincode!=0){
        $getArr=array(
            'pincode_id'=>$getPincode[0]->pincode_id,
            'pincode'=>$getPincode[0]->pincode,
            'delivery_city'=>$getPincode[0]->delivery_city,
            'werehouse'=>(($getPincode[0]->werehouse!="") ? explode(',',$getPincode[0]->werehouse) :array()),
           );
        }

    }

  return $getArr;

}


// else{

//         $data['status']=0;
//         $data['message']='Product not deliverable on your selected shipping address.';
//         echo json_encode($data);
//         // exit;
//       }


// public function getDeliverableAndNotDeliverableStatus($product_id){
//   $location_pin=$this->session->userdata('pincode_loc');

//   $result = 1;
//   if($location_pin!="" && $location_pin!=array()){

//      $whcodes=$location_pin['werehouse'];
//      if($whcodes!="" || $whcodes!=array()){
//       foreach ($whcodes as $key => $value) {
//          $or = (($key+1) <count($whcodes)) ? 'OR' : '';
//          $whereOr .= " werehouse_code = '" .$value. "' $or " ;
//       }

//      $sqlQuery ="SELECT * FROM `tbl_mapping_werehouse_with_product` WHERE `wh_product_id`= $product_id AND ($whereOr)";
//      $sqlStatus=$this->sqlQuery_model->sql_query($sqlQuery);
//      $getprodId=($sqlStatus!=0) ? array_unique(array_column($sqlStatus,'wh_product_id')) : array();
//          $result = 0;
//         if($getprodId!=array()){
//           $result = 1;
//         }

//     }  
   
//   }

//   return $result;
// }


public function checkProduct_Deliverable_on_ShippingPincode($product_id=""){
  
  $user=$this->my_libraries->mh_getCookies('customer');

 $result = 1;
  $shippingAddress_selectAddress=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$user[0]->customer_id,'setAddressDefault'=>1));

   if($shippingAddress_selectAddress!=0){
      $location_pin = $this->checkCartShippingPincode($shippingAddress_selectAddress[0]->pincode);
      
      if($location_pin!="" && $location_pin!=array()){

          $whcodes=$location_pin['werehouse'];
           if($whcodes!="" || $whcodes!=array()){

              foreach ($whcodes as $key => $value) {
                 $or = (($key+1) <count($whcodes)) ? 'OR' : '';
                 $whereOr .= " werehouse_code = '" .$value. "' $or " ;
              }

               $sqlQuery ="SELECT * FROM `tbl_mapping_werehouse_with_product` WHERE `wh_product_id`= $product_id AND ($whereOr)";
               $sqlStatus=$this->sqlQuery_model->sql_query($sqlQuery);
                $getprodId=($sqlStatus!=0) ? array_unique(array_column($sqlStatus,'wh_product_id')) : array();
                 $result = 0;
                  if($getprodId!=array()){
                    $result = 1;
                  }

           }
       }

   }

   return $result;
 
}


public function checkVariantsExitsORNot($product_id="",$variant_id=""){
    
    $checkVariant=$this->sqlQuery_model->sql_select_where('tbl_product_variants',array('variants_product_id'=>$product_id,'variant_id'=>$variant_id));
    $result=true;
    if($checkVariant==0){
      $result=false;
    }
  return $result;
}


// '.base_url('checkout').'/

public function getTopSoldProduct(){
 $where['pro.status']=1;
 // $where['ordp.pro_order_status']='Delivered';

$where_and_chain=queryChain($where);

// $sql_join="SELECT DISTINCT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE $where_and_chain GROUP BY mapp.unique_number $sortPrice ";

   // $product_list=$this->sqlQuery_model->sql_query($sql_join);


 // echo $sql_join="SELECT DISTINCT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,ordp.pro_own_product_id,COUNT(ordp.pro_own_product_id),SUM(ordp.pro_product_qty) AS sold_product_qty
 // FROM tbl_mapping_category_with_product AS mapp 
 // LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number 
 // WHERE $where_and_chain";

$sql_join1="SELECT DISTINCT pro.*,mapp.mapping_id,mapp.mapping_product_id,mapp.cat_id,mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.status,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name,SUM(ordp.pro_product_qty) AS sold_product_qty,ordp.pro_own_product_id,COUNT(ordp.pro_own_product_id) AS sold_product,ordp.pro_order_status FROM tbl_mapping_category_with_product AS mapp 
LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number 
LEFT JOIN tbl_order_products AS ordp ON ordp.pro_own_product_id = mapp.unique_number
WHERE $where_and_chain AND ordp.pro_order_status='Delivered' GROUP BY mapp.unique_number ORDER BY sold_product_qty DESC LIMIT 1";
 $query1=$this->sqlQuery_model->sql_query($sql_join1);

 echo "<pre>";
 print_r($query1);
 echo "</pre>";

$sql_join="SELECT DISTINCT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE $where_and_chain GROUP BY mapp.unique_number LIMIT 1";

 $query=$this->sqlQuery_model->sql_query($sql_join);

echo "<pre>";
 print_r($query);
 echo "</pre>";

  // $sql="SELECT pro_own_product_id AS item_code,SUM(pro_product_qty) AS sold_product_qty, COUNT(pro_own_product_id) AS sold_product FROM tbl_order_products WHERE pro_order_status='Delivered' GROUP BY pro_own_product_id ORDER BY sold_product_qty DESC";

 // $sql="SELECT `pro_own_product_id`, COUNT(pro_own_product_id),SUM(pro_product_qty) AS sold_product_qty FROM tbl_order_products WHERE pro_order_status='Delivered' GROUP BY pro_own_product_id HAVING COUNT(pro_product_qty) > 0 ORDER BY sold_product_qty DESC";

 // $sql="SELECT `pro_own_product_id`,SUM(pro_product_qty) AS sold_product_qty FROM tbl_order_products WHERE pro_order_status='Delivered' GROUP BY pro_own_product_id ORDER BY sold_product_qty DESC";
  // $query=$this->sqlQuery_model->sql_query($sql);


  return $query;
}




// where date(column_name) = CURDATE();


 // public function checkCouponCondition($couponDetails='',$cart_details="",$cart_item_id="",$type=""){

 //    $purchaseAmount=$this->cart->total();
 //    $purchaseQty=$this->cart->total_items();

 //          if($couponDetails!=""){
 //           $result=false;

 //               if($couponDetails['purchase_type']=='amount_purchase'){
 //                     $min_purch_coupon_amt=$couponDetails['min_purch_amt'];
 //                     if($type=='plus'){
 //                       $minusvalue=$purchaseAmount+$cart_details[$cart_item_id]['price'];
 //                     }else{
 //                       $minusvalue=$purchaseAmount-$cart_details[$cart_item_id]['price'];
 //                     }

 //                    if($minusvalue > $min_purch_coupon_amt){
 //                       $result= true;
 //                    }

 //               }else if($couponDetails['purchase_type']=='qty_purchase'){
 //                   $min_purch_coupon_qty=$couponDetails['min_purch_qty'];

                  
 //                        if($purchaseQty >=$min_purch_coupon_qty){
 //                          $result= true;
 //                         }else{
 //                          $result= false;
 //                         }
                     
 //                 }

 //         }else{
 //            $result= true;
 //         }

 //     return $result;

 // }

   // public function getAll_Cart_order($customer_session=array(),$contents=array(),$page_id)
   // {
   //        $data['page_id']=$page_id;
   //        $total_itmes_mrp=0;
   //        $total_discount_mrp=0;
   //        // $total_customizing_fee=0;

   //        $customTye=array();
   //        foreach($contents as $value){
            
   //        }


   // }



//  public function getAll_Cart_order($customer_session=array(),$contents=array(),$page_id)
// {
//           $data['page_id']=$page_id;
//           $total_itmes_mrp=0;
//           $total_discount_mrp=0;
//           $total_customizing_fee=0;

//           $customTye=array();
//           foreach($contents as $value){

//                       $get_product=$this->sqlQuery_model->sql_select_where('tbl_product',array('product_id'=>$value['options']['product_id']));
//                  // if($get_product[0]->added_by==0){
//                  // $sellerName=($get_product!=0) ? $this->getVendor_storename($get_product[0]->vendor_id) : '';
//                  // }else{
//                  //   $sellerName=($get_product!=0) ? $this->getCompanyName($get_product[0]->vendor_id) : '';
//                  // }


//                 // $exArr=explode(':::',encrypt_decrypt($value['options']['Size'],'decrypt'));
//                 // $explodeVal=end($exArr);
//                 // $measurement=$value['options']['measurement_details'];

//                 // $size_val=($explodeVal=='custom_size') ? NULL : $get_product[0]->size;
//                 // $customizing_fee=($explodeVal=='custom_size') ? $get_product[0]->customizing_fee : 0.00;

//                 // array_push($customTye, $explodeVal);

//                  // pre($explodeVal,1);
//                  // pre($value['options'],1);
//                  // pre($measurement);
//                  // $get_product_img=$this->sqlQuery_model->sql_select_where('tbl_product_images',array('p_sys_product_id'=>$value['id']));
//                  // pre($get_product['hsn_no']);
//                  // pre($value);
//                  // echo "<pre>";print_r($get_product[0]->size);echo "</pre>";
//                  // $getCat_id=$this->getcateIdByCatType($get_product[0]->cat_type_id);
//                     echo "<pre>";
//                     print_r($get_product);
//                     echo "</pre>";

//                     echo "<pre>";
//                     print_r($value);
//                     echo "</pre>";

//                     exit;

//                 $collect_arr[]=array(
//                              'id'                =>$value['id'],
//                              'qty'               =>$value['qty'],

//                              'sell_price'        =>sprintf("%0.2f",$value['price']),
//                              'original_price'    =>($get_product!=0) ? sprintf("%0.2f",$get_product[0]->original_price) : 0.00,
//                              'customizing_fee'=>$customizing_fee,

//                              'name'              =>($get_product!=0) ? ucfirst($get_product[0]->product_title) :'',
//                              'size'              =>$size_val,

//                              'own_product_id'    =>$value['options']['own_product_id'],
//                              'rowid'             =>$value['rowid'],
//                              'subtotal'          =>$value['subtotal'],

//                              'product_img'       =>($get_product!=0) ? $get_product[0]->front_img :'',
//                              'off_percentage'    =>($get_product!=0) ? $get_product[0]->off_percentage : 0,
//                              'vendor_store_name' =>$sellerName,
//                              'vendor_id'         =>$value['options']['vendor_id'],
//                              'own_product_id'    =>($get_product!=0) ? $get_product[0]->own_product_id : '',
//                              'cat_id'            =>$getCat_id,

//                              'cat_type_id'       =>$get_product[0]->cat_type_id,
//                              'sub_cat_id'        =>$get_product[0]->sub_cat_id,
//                              'sub2_cat_id'       =>$get_product[0]->sub2_cat_id,
//                              'cat_name'          =>($get_product!=0) ? $this->getCate_name($getCat_id) : '',
//                              'catType_name'      =>($get_product!=0) ? $this->getCatetype_name($get_product[0]->cat_type_id) : '',
//                              'sub_cat_name'      =>($get_product!=0) ? $this->getSub_name($get_product[0]->sub_cat_id) : '',

//                              'package_weight'    =>($get_product!=0) ? $get_product[0]->package_weight : '',
//                              'package_length'    =>($get_product!=0) ? $get_product[0]->package_length : '', 
//                              'package_breadth'   =>($get_product!=0) ? $get_product[0]->package_breadth : '', 
//                              'package_height'    =>($get_product!=0) ? $get_product[0]->package_height : '',

//                              'tax_code'          =>($get_product!=0) ? $get_product[0]->tax_code :'',
//                              'hsn_no'            =>($get_product!=0) ? $get_product[0]->hsn_no :'',
//                              'sku_id'            =>($get_product!=0) ? $get_product[0]->sku_id :'',
//                              'added_by'          =>($get_product!=0) ? $get_product[0]->added_by :'',
//                              'measurement_size'  =>json_encode($measurement),
//                              'measurement_type'  =>$explodeVal
//                             );

//                // Total items amount
//                $get_old_amount=($get_product!=0) ? sprintf("%0.2f",$get_product[0]->original_price) : 0.00;
//                $total_itmes_mrp=totalMRP_amount($get_old_amount,$value['qty'],$total_itmes_mrp);
//                // Total discount amount
//                $total_discount_mrp=totalDiscount_mep($get_old_amount,$get_product[0]->off_percentage,$value['qty'],$total_discount_mrp);
               
//                $total_customizing_fee=totalCustomizingAmount($explodeVal,$value['qty'],$customizing_fee,$total_customizing_fee);

//                  // pre($get_product,1);
//                  // echo "hiii";
//              }

//             // pre($total_discount_mrp,1);
//             $coupon_offer_amount=$this->sessionStatus('coupon_offer');
//             if($coupon_offer_amount!=""){
//                  $coupon_amt=$coupon_offer_amount->discount_coupon_amount;
//                  $total_items_amount=$this->cart->total();
//                  $total_amt=$total_items_amount-$coupon_amt;
//              }else{
//                $coupon_amt=sprintf("%0.2f",0);
//                $total_amt=$this->cart->total();
//              }


//             // $finalTotal=$total_amt+$total_customizing_fee;
//            // $total_amt=$this->cart->total();   
//            // pre($total_customizing_fee,1);
           
//         // $ctype_status=(in_array('custom_size', array_unique($customTye))) ? 1 : 0;
 
//         $cart=$collect_arr;
//         $data['total_mrp']=sprintf("%0.2f",$total_itmes_mrp);
//         $data['total_discount_mrp']=sprintf("%0.2f",$total_discount_mrp);
//         $data['coupon_amt']=$coupon_amt;
//         $data['ctype_status']=$ctype_status;
//         // $data['customizing_amount']=sprintf("%0.2f",$total_customizing_fee);
//         $data['total_amount']=sprintf("%0.2f",$finalTotal);
//         $data['cart']=$cart;

        
//         $data['coupon_offer_amount']=$coupon_offer_amount;
//            // Get Shipping Address
//            $customer_session=$this->sessionStatus('customer');
//            if($customer_session!=""){
//             $data['getShipping_details']=$this->getShippingListByCustomerId($customer_session[0]->cust_id);
//            }

//             $customer_shipping_address=$this->sessionStatus('customer_shipping_address');
//             $data['getDefaultAddress']=$this->setDefaultShippingAddress($customer_shipping_address,$customer_session);


//      return $data;

// }









}
