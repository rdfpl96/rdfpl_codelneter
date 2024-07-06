<?php
defined('BASEPATH') OR exit('No direct script access allowed');

   require APPPATH . 'libraries/RestController.php';

   use chriskacerguis\RestServer\RestController;

   class ApiController extends RestController {

    public function __construct(){
        parent::__construct();
        $this->load->library('my_libraries');
        // $this->load->library('api_auth');
    }


   

  public  function update_customer_details_post(){

         $post = json_decode($this->input->raw_input_stream, true);
         
         $customer_id = trim($post['customer_id']);
         $name = trim($post['name']);
         $email_mobi = trim($post['email_or_mobile']);
         $input_type = trim($post['input_type']);


         $arrType=array('email','number');
         if(!in_array($input_type,$arrType)){
           $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Invalid input type.'
            ], RestController::HTTP_BAD_REQUEST);
         }

         if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
           }


          if(empty($name) || $name==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your name'
            ], RestController::HTTP_BAD_REQUEST);
           }

            if(empty($email_mobi) || $email_mobi==""){
              $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Enter your'.(($input_type=='email') ? ' email.' :' mobile number.')
              ], RestController::HTTP_BAD_REQUEST);
           }

           if($input_type=='email'){

             if(!checkemail($email_mobi)){
               $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Invalid email Id.'
                ], RestController::HTTP_BAD_REQUEST);
             
              }
           }
          

          if($input_type=='number'){

              if(!preg_match('/^[0-9]{10}+$/', $email_mobi)){
                $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Invalid mobile number.'
                ], RestController::HTTP_BAD_REQUEST);
                
             }
          }

           $sql=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE customer_id=".$customer_id." AND status=1");

           $updateArr['c_fname']=$name;
           if($sql!=0){

              if($input_type=='email'){
                $updateArr['email']=$email_mobi;
               }

              if($input_type=='number'){
               $updateArr['mobile']=$email_mobi;
              }

             $sql_update = $this->sqlQuery_model->sql_update('tbl_customer',$updateArr,array('customer_id'=>$customer_id));

             if($sql_update){
                $squery=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE customer_id=".$customer_id." AND status=1");
                $getResponse=array(
                     'customer_id'=>$squery[0]->customer_id,
                     'fname'=>$squery[0]->c_fname,
                     'lname'=>$squery[0]->c_lname,
                     'email'=>$squery[0]->email,
                     'mobile'=>$squery[0]->mobile,
                     'status'=>$squery[0]->status,
                     'add_date'=>$squery[0]->add_date
                    );


                    $this->response([
                    'status' => RestController::HTTP_OK,
                    'message' => 'Updated successfully.',
                    'response'=>$getResponse
                  ], RestController::HTTP_OK);

             }else{
                
                 $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Failed to updated details.'
                 ], RestController::HTTP_BAD_REQUEST);
               }

      }else{

               $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Customer not found.'
                ], RestController::HTTP_BAD_REQUEST);
            }

        }


 
 public function get_customer_details_get(){
  
       $post = json_decode($this->input->raw_input_stream, true);
         
         $customer_id = trim($post['customer_id']);
        
         if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
           }

   
       $squery=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE customer_id=".$customer_id." AND status=1");
         if($squery!=0){
           
            
                    $this->response([
                    'status' => RestController::HTTP_OK,
                    'message' => 'Success.',
                    'response'=>$squery[0]
                  ], RestController::HTTP_OK);


          }else{

               $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Customer not found.'
                ], RestController::HTTP_BAD_REQUEST);
            }
       
   }


   public function category_list_get(){
      
      $getList=$this->my_libraries->getAllCategoryWithChile();

      $this->response([
                'status' => RestController::HTTP_OK,
                'message' => 'Success.',
                'response'=>$getList
              ], RestController::HTTP_OK);
    
     }


     public function product_list_get(){

       // $post = json_decode($this->input->raw_input_stream, true);

    
      $category_id = $this->input->get();


      // $get_cate=$this->uri->segment(2);
      // $get_sub_cate=$this->uri->segment(3);
      // $get_chile_cate=$this->uri->segment(4);

       $get_cate_id=$this->input->get('category_id');
       $get_sub_cate_id=$this->input->get('sub_category_id');
      $get_chile_cate_id=$this->input->get('child_category_id');

      $get_cate=$this->my_libraries->getCate_name_ci($get_cate_id);
      $get_sub_cate=$this->my_libraries->getSubCate_name_ci($get_sub_cate_id);
      $get_chile_cate=$this->my_libraries->getChildCate_name_ci($get_chile_cate_id);



      // ===================Shorting=======================
       $sortby=$this->input->get('sort');
        if($sortby=='latest' || $sortby=='best_selling' || $sortby=='A_Z' || $sortby=='Z_A'){
           $sortPrice=switchSortBy($sortby);
           $sortTypes='';
        }else{
           $sortTypes=$sortby;
           $sortPrice='';
        }
        $data['sort']=$sortby;





       // =============Rating=======================
     $product_rating=$this->input->get('rating');

       $ratingValue=ratingFilter($product_rating);
       if($ratingValue!=""){
         $rating_list=$this->sqlQuery_model->sql_query("SELECT * FROM `tbl_rate_and_review` WHERE $ratingValue ");
         $getRatingProductID=array();
         if($rating_list!=0){
           $getRatingProductID=array_unique(array_column($rating_list, 'product_id')); 
         }
       }else{
        $getRatingProductID=array();
       }

      $ratingProductId=($getRatingProductID!=array())? 'AND pro.product_id IN ('.implode(',', $getRatingProductID).')' :'' ;


    // ===============PRICE RANGE=======================
      $rangePrice=$this->input->get('range');
      $productPriceRangeId='';
      if($rangePrice!=""){
        $priceRangeValue=priceRangeFilter($rangePrice);
         $variant_list_=$this->sqlQuery_model->sql_query("SELECT * FROM `tbl_product_variants` WHERE $priceRangeValue  `variants_status`=1");
         
         if($variant_list_!=0){
           $variant_list = $variant_list_;
         }else{
          $variant_list =array();
         }

         $getProductID=array_column($variant_list, 'variants_product_id');
        $productPriceRangeId=($getProductID!=array())? 'AND pro.product_id IN ('.implode(',', $getProductID).')':'' ;
      }
      
          $where['pro.status']=1;
    
           if($get_cate!=""){
              $where['mapp.pro_ci_cat_name']=$get_cate;
            }

            if($get_sub_cate!=""){
                $where['mapp.pro_ci_sub_cat_name']=$get_sub_cate;
            }

             if($get_chile_cate!=""){
                $where['mapp.ci_child_cat_name']=$get_chile_cate;
            }

         $where_and_chain=queryChain($where);

         $pr_list_count=$this->my_libraries->getProductlistCount($where_and_chain,'','','','','',$productPriceRangeId,$ratingProductId);
     
         $data['product_count']=($pr_list_count!=0) ? count($pr_list_count):0;

         $limit_per_page = $this->input->get('limit_per_page');

         $getVariable=$this->input->get('per_page');

         $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0 ) : 0;

         $total_records = ($pr_list_count!=0) ? count($pr_list_count) : 0;

         $sql_limit='LIMIT '.$page*$limit_per_page.','.$limit_per_page;


        $pArr =$this->my_libraries->getProductlist_royal($where_and_chain,'',$sortPrice,$sortTypes,$sql_limit,'','','','',$productPriceRangeId,$ratingProductId);
        $shopList=$pArr;


        
         $this->response([
                'status' => RestController::HTTP_OK,
                'message' => 'Success.',
                'response'=>$shopList
              ], RestController::HTTP_OK);
       
   
     }


     public function product_details_get(){
         
         
           $product_id = $this->input->get('product_id');
           if(empty($product_id) || $product_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Product Id missing.'
            ], RestController::HTTP_BAD_REQUEST);
           }

           $where['pro.status']=1;
           $where['pro.product_id']=$product_id;
      
           $where_and_chain=queryChain($where);
           $getProduct =$this->my_libraries->getProductlist_royal($where_and_chain);

           $this->response([
                'status' => RestController::HTTP_OK,
                'message' => 'Success.',
                'response'=>$getProduct
              ], RestController::HTTP_OK);

     }


     public function add_wishlist_post(){
     

         $post = json_decode($this->input->raw_input_stream, true);
         
          $customer_id = trim($post['customer_id']);
          $product_id = trim($post['product_id']);


        
         if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
           }


           if(!$this->my_libraries->checkCustomer($customer_id)){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Customer not found.'
              ], RestController::HTTP_BAD_REQUEST);
           }

          if(empty($product_id) || $product_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your product Id.'
            ], RestController::HTTP_BAD_REQUEST);
           }


 
            $sql_join="SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.unique_number = pro.unique_number WHERE pro.product_id=$product_id GROUP BY mapp.unique_number";
              $getProCategory=$this->sqlQuery_model->sql_query($sql_join);

              if($getProCategory==0){
                   $this->response([
                      'status' => RestController::HTTP_BAD_REQUEST,
                      'message' => 'Product not found.'
                  ], RestController::HTTP_BAD_REQUEST);
               }

            $chekExits=$this->sqlQuery_model->sql_select_where('tbl_wishlist',array('cust_id'=>$customer_id,'product_id'=>$product_id));

          if($chekExits==0){

                
                   $post_arr=array(
                     'cust_id'=>$customer_id,
                     'product_id'=>$product_id,
                     'category_id' =>$getProCategory[0]->cat_id,
                     'status'=>1
                    );

                     $add_wish=$this->sqlQuery_model->sql_insert('tbl_wishlist',$post_arr);

                     if($add_wish){

                       $arrQery=$this->sqlQuery_model->sql_select_where('tbl_wishlist',array('cust_id'=>$customer_id,'product_id'=>$product_id));

                          $this->response([
                            'status' => RestController::HTTP_OK,
                            'message' => 'Product added successfully',
                            'response'=>$arrQery[0]
                          ], RestController::HTTP_OK);

                    }else{
                       $this->response([
                            'status' => RestController::HTTP_BAD_REQUEST,
                            'message' => 'Failed to add wishlist.'
                        ], RestController::HTTP_BAD_REQUEST);
                     }



             }else{

                      if($chekExits[0]->status==1){
                         $wish=0;
                         $msg='removed';
                       }else{
                         $wish=1;
                         $msg='added';
                       }

                     $update_wish=$this->sqlQuery_model->sql_update('tbl_wishlist',array('status'=>$wish),array('cust_id'=>$customer_id,'product_id'=>$product_id));

                      if($update_wish){
                         $arrQery=$this->sqlQuery_model->sql_select_where('tbl_wishlist',array('cust_id'=>$customer_id,'product_id'=>$product_id));
                          $this->response([
                            'status' => RestController::HTTP_OK,
                            'message' => 'Product '.$msg.' successfully',
                            'response'=>$arrQery[0]
                          ], RestController::HTTP_OK);

                      }else{
                            $this->response([
                            'status' => RestController::HTTP_BAD_REQUEST,
                            'message' => 'Failed to add wishlist.'
                           ], RestController::HTTP_BAD_REQUEST);
                        }


             }

     }

public function wishlist_get(){

         $post = json_decode($this->input->raw_input_stream, true);
         
          $customer_id = trim($post['customer_id']);

         if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
           }


           if(!$this->my_libraries->checkCustomer($customer_id)){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Customer not found.'
              ], RestController::HTTP_BAD_REQUEST);
           }

     
       $arrQery=$this->sqlQuery_model->sql_select_where('tbl_wishlist',array('cust_id'=>$customer_id));

          $this->response([
            'status' => RestController::HTTP_OK,
            'message' => 'Success.',
            'response'=>($arrQery!=0) ? $arrQery :array()
          ], RestController::HTTP_OK);
   }


public function search_product_post(){
    
    $post = json_decode($this->input->raw_input_stream, true);

      $getKeywords=$post['getKeywords'];
      $searchProductItems=$this->my_libraries->getProductWithVariantSearchList($getKeywords);

        $this->response([
            'status' => RestController::HTTP_OK,
            'message' => 'Success.',
            'response'=>($searchProductItems!=0) ? $searchProductItems :array()
          ], RestController::HTTP_OK);

}


public function address_post(){

    $post = json_decode($this->input->raw_input_stream, true); 
    $customer_id = trim($post['customer_id']);

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'All fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
      }

      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }


       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
       }
     
     
      $apart_house=trim($post['apartment_House_No']);
      $apart_name=trim($post['apartment_name']);
      $area=trim($post['area']);
      $street_landmark=trim($post['streetDetails_Landmark']);
      $state=trim($post['state']);
      $city=trim($post['city']);
      $pincode=trim($post['pincode']);
      $fname=trim($post['fname']);
      $lname=trim($post['lname']);
      $mobile=trim($post['mobile']);
      
      $location_type=trim($post['location_type']);
      $other_name=trim($post['other_name']);
      $address_type=trim($post['address_type']);
      
      $address_id=trim($post['address_id']);

       
     if(empty($apart_house) || $apart_house==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Apartment or house number is required.'
        ], RestController::HTTP_BAD_REQUEST);
       } 

      if(empty($apart_name) || $apart_name==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Apartment name is required.'
        ], RestController::HTTP_BAD_REQUEST);
       } 

        if(empty($area) || $area==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Area name is required.'
         ], RestController::HTTP_BAD_REQUEST);
       } 

      if(empty($street_landmark) || $street_landmark==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Street Details or Landmark is required.'
         ], RestController::HTTP_BAD_REQUEST);
       } 

     if(empty($state) || $state==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'State is required.'
         ], RestController::HTTP_BAD_REQUEST);
       } 

       if(empty($city) || $city==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'City is required.'
         ], RestController::HTTP_BAD_REQUEST);
       } 

       if(empty($pincode) || $pincode==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Pincode is required.'
         ], RestController::HTTP_BAD_REQUEST);
       } 


        if(empty($fname) || $fname==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'First name is required.'
         ], RestController::HTTP_BAD_REQUEST);
       } 

      if(empty($lname) || $lname==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Last name is required.'
         ], RestController::HTTP_BAD_REQUEST);
       } 


        if(empty($mobile) || $mobile==""){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Mobile is required.'
         ], RestController::HTTP_BAD_REQUEST);
        } 

        if(empty($location_type) || $location_type==""){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Select your address type.'
         ], RestController::HTTP_BAD_REQUEST);
        } 


        if($location_type=="Other"){
           if(empty($other_name) || $other_name==""){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Other name is required.'
             ], RestController::HTTP_BAD_REQUEST);
            } 
        }
   

        if(empty($address_type) || $address_type==""){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your address type.'
         ], RestController::HTTP_BAD_REQUEST);
        } 


        $arrayType=array('Home','Office','Other');
        if(!in_array($location_type,$arrayType)){
           $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Invalid location type.'
             ], RestController::HTTP_BAD_REQUEST);
        }


      
        $other_name_ = ($location_type=="Other") ? $other_name :"";
        $conutry=101;
          $postArr=array(
                       'country_id'=>$conutry,
                       'country' =>$this->my_libraries->getCountry_name($conutry),
                       'state_id' =>$state,
                       'state' =>$this->my_libraries->getState_name($state),
                       'city_id' =>$city,
                       'city' =>$this->my_libraries->getCity_name($city),
                       'address1' =>$apart_house,
                       'address2' =>$apart_name,
                       'area'=>$area,
                       'pincode' =>$pincode,
                       'landmark' =>$street_landmark,
                       // 'company_name' =>$company,
                       'fname' =>$fname,
                       'lname' =>$lname,
                       'mobile1' =>$mobile,
                       // 'mobile2' =>$mobile2,
                       // 'email'  =>$email,
                       'nick_name'  =>$location_type,
                       'others'=>$other_name_
                      );


                     $addresssType=array('shippingAddress','billingAddress');
                        if(!in_array($address_type,$addresssType)){
                           $this->response([
                                'status' => RestController::HTTP_BAD_REQUEST,
                                'message' => 'Invalid address type.'
                             ], RestController::HTTP_BAD_REQUEST);
                        }

 
                    if($address_id==""){
                       
                         if($address_type=='billingAddress'){
                            $getBill=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'address_type'=>'billingAddress'));
                            if($getBill!=0){
                               $this->response([
                                'status' => RestController::HTTP_BAD_REQUEST,
                                'message' => 'Already billing address added.'
                               ], RestController::HTTP_BAD_REQUEST);
                             }
                          }


                         $postArr['customer_id']=$customer_id;
                         $postArr['address_type']=$address_type;

                         $postSql=$this->sqlQuery_model->sql_insert('tbl_address',$postArr);

                          $getinsertId=$this->sqlQuery_model->get_last_inset_id('tbl_address');
                           $row_sql_update=$this->my_libraries->setDefaultAddressOnupdate($customer_id,$getinsertId);

                               if($postSql){

                                   $getQuery=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'addr_id'=>$getinsertId));

                                     $this->response([
                                        'status' => RestController::HTTP_OK,
                                        'message' => 'Address added successfully.',
                                        'response'=>$getQuery[0]
                                      ], RestController::HTTP_OK);

                                }else{

                                     $this->response([
                                        'status' => RestController::HTTP_BAD_REQUEST,
                                        'message' => 'Failed to added.'
                                     ], RestController::HTTP_BAD_REQUEST);
                                  
                                }
                        
                      }else{

                         
                         $checkexits=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'addr_id'=>$address_id));
                         if($checkexits!=0){
                            $updateSql=$this->sqlQuery_model->sql_update('tbl_address',$postArr,array('addr_id'=>$address_id));
                          }else{
                            
                             $this->response([
                                'status' => RestController::HTTP_BAD_REQUEST,
                                'message' => 'Address not found.'
                              ], RestController::HTTP_BAD_REQUEST);
                          }

                          if($updateSql){
                            $getQuery=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'addr_id'=>$address_id));
                           


                             $this->response([
                                'status' => RestController::HTTP_OK,
                                'message' => 'Address updated successfully.',
                                'response'=>$getQuery[0]
                              ], RestController::HTTP_OK);
                            
                          }else{
                              $this->response([
                                'status' => RestController::HTTP_BAD_REQUEST,
                                'message' => 'Failed to added.'
                             ], RestController::HTTP_BAD_REQUEST);
                          }

                      }
                    
    }

 public function delete_address_post(){
     
      $post = json_decode($this->input->raw_input_stream, true); 
      $customer_id = trim($post['customer_id']);

      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }


       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
       }
     
      $address_id = trim($post['address_id']);

      $getQuery=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'addr_id'=>$address_id));
        if($getQuery!=0){

            if($getQuery[0]->setAddressDefault==0){
               $sql_delete=$this->sqlQuery_model->sql_delete('tbl_address',array('customer_id'=>$customer_id,'addr_id'=>$address_id));
                $this->response([
                      'status' => RestController::HTTP_OK,
                      'message' => 'Address deleted successfully.',
                      'response'=>array('address_id'=>$address_id)
                    ], RestController::HTTP_OK);

              }else{
                 $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Not allows to delete default set address.'
                  ], RestController::HTTP_BAD_REQUEST);
                }

        }else{

            $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Address not found.'
            ], RestController::HTTP_BAD_REQUEST);

          }
            
   }


   public function get_shipping_address_list_post(){
     
       $post = json_decode($this->input->raw_input_stream, true); 
       $customer_id = trim($post['customer_id']);

       $address_id = trim($post['address_id']);
       $address_type = trim($post['address_type']);
       

       if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }

       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
       }

       $where['customer_id']=$customer_id;
      if($address_id!=""){
       $where['addr_id']=$address_id;
      }

      if($address_type!=""){
       $where['address_type']=$address_type;
      }

      

       $getQuery=$this->sqlQuery_model->sql_select_where('tbl_address',$where);
        if($getQuery!=0){
           $this->response([
              'status' => RestController::HTTP_OK,
              'message' => 'Success.',
              'response'=>$getQuery
            ], RestController::HTTP_OK);

        }else{
            $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Address not found.'
            ], RestController::HTTP_BAD_REQUEST);

          }


   }


   public function state_list_get(){
     
     $conutry=101;
      $state=$this->sqlQuery_model->sql_select_where('states',array('country_id'=>$conutry)); 
      $result =array();
      if($state!=0){
         $result = $state;
      } 
      
      $this->response([
        'status' => RestController::HTTP_OK,
        'message' => 'Success.',
        'response'=>$result
      ], RestController::HTTP_OK);
    
   }

   public function get_city_list_post(){

         $post = json_decode($this->input->raw_input_stream, true); 
         $state_id = trim($post['state_id']);
         $city_id = trim($post['city_id']);
         if(empty($state_id) || $state_id==""){
          $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'State Id is required.'
           ], RestController::HTTP_BAD_REQUEST);
         }


          $where['state_id']=$state_id;
          if($city_id!=""){
           $where['id']=$city_id;
          }

            $city=$this->sqlQuery_model->sql_select_where('cities',$where); 
            $result =array();
            if($city!=0){
               $result = $city;
            } 
          
            $this->response([
                'status' => RestController::HTTP_OK,
                'message' => 'Success.',
                'response'=>$result
              ], RestController::HTTP_OK);
            
      } 


      public function size_list_get(){
             $size=$this->sqlQuery_model->sql_select_where('tbl_units',array('status'=>1)); 
              $result =array();
              if($size!=0){
                foreach ($size as $key => $value) {
                      $arr[]=array(
                          'units_id'=>$value->units_id,
                          'units_name'=>$value->units_name,
                          'status'=>$value->status
                      );
                }
                 $result = $arr;
              } 
          $this->response([
                'status' => RestController::HTTP_OK,
                'message' => 'Success.',
                'response'=>array_reverse($result)
              ], RestController::HTTP_OK);
      }



   public function add_basket_cart_post(){
     
     $post = json_decode($this->input->raw_input_stream, true); 
       
       $customer_id = trim($post['customer_id']);
       $cart = $post['cart'];

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'Cart fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
       }


        if($cart==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'Cart fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
       }


      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }


       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
       }
      

        foreach ($cart as $key => $value) {

                $product_id=$value['product_id'];
                $qty=$value['quantity'];
                $variants=$value['variant_id'];
                $price_value=$value['price'];
                $user=$customer_id;

             $sql_join="SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.mapping_product_id = pro.product_id WHERE pro.product_id=".$product_id." AND pro.status=1 GROUP BY mapp.mapping_product_id";

             $sql_pro=$this->sqlQuery_model->sql_query($sql_join);
             if($sql_pro==0){
                 $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Product not found.'
                  ], RestController::HTTP_BAD_REQUEST);
                }

           $sql_Variants=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variant_id=".$variants." AND variants_product_id=".$product_id." AND variants_in_stock_status=1 AND stock!=0 AND variants_status=1");
         
             if($sql_Variants==0){
                 $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => $this->config->item('out_of_stock'),
                    'response'=>$value
                  ], RestController::HTTP_BAD_REQUEST);
               }

         } // End foreach loop


       foreach ($cart as $key => $value) {
            
            $product_id=$value['product_id'];
                $qty=$value['quantity'];
                $variants=$value['variant_id'];
                $price_value=$value['price'];
                $user=$customer_id;

             $sql_join="SELECT *,mapp.cat_id, mapp.pro_ci_cat_name,mapp.category,mapp.sub_cat_id,mapp.pro_ci_sub_cat_name,mapp.sub_category,mapp.child_cat_id,mapp.ci_child_cat_name,mapp.childCat_name FROM tbl_mapping_category_with_product AS mapp LEFT JOIN tbl_product AS pro ON mapp.mapping_product_id = pro.product_id WHERE pro.product_id=".$product_id." AND pro.status=1 GROUP BY mapp.mapping_product_id";
               $sql_pro=$this->sqlQuery_model->sql_query($sql_join);

             $sql_Variants=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_product_variants WHERE variant_id=".$variants." AND variants_product_id=".$product_id." AND variants_in_stock_status=1 AND stock!=0 AND variants_status=1");


              foreach($sql_Variants as $values){
                     $potionValue=array(
                               'variant_id'=>$values->variant_id,
                               'sku_id' => $values->sku_id,
                               'cat_id'=>$sql_pro[0]->cat_id,
                               'category'=>$sql_pro[0]->category,
                               'sub_cat_id'=>$sql_pro[0]->sub_cat_id,
                               'sub_category'=>$sql_pro[0]->sub_category,
                               'child_cat_id'=>$sql_pro[0]->child_cat_id,
                               'childCat_name'=>$sql_pro[0]->childCat_name,
                               'packsize' => $values->pack_size, 
                               'units_id'=>$values->units_id,
                               'units' => $values->units,
                               'image'=> $sql_pro[0]->image1,
                               'product_id'=>$sql_pro[0]->product_id,
                               'product_gen_id'=>$sql_pro[0]->unique_number,
                               'hsn_code'=>$sql_pro[0]->hsn_code
                             );
                    }  

                     $cartProduct = array(
                         'id'      => $sql_pro[0]->product_id,
                         'qty'     => $qty,
                         'price'   => $price_value,
                         'name'    => $sql_pro[0]->product_name,
                         'options' => $potionValue
                      );

                     if($user!=""){
                        

                    $checkExit=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_cartmanager WHERE user_id=".$user." AND variant_id=".$variants." AND product_id=".$product_id."");

                      if($checkExit==0){

                                $_postArr=array(
                                  'user_id'=>$user,
                                  'product_id'=>$sql_pro[0]->product_id,
                                  'variant_id'=>$variants,
                                  'qty'=>$qty,
                                  'price'=>$price_value,
                                  'name'=>$sql_pro[0]->product_name,
                                  'options'=>serialize($potionValue)
                                 ); 
                           
                             $this->sqlQuery_model->sql_insert('tbl_cartmanager',$_postArr);  

                        }else{

                              $sumQuantity = $checkExit[0]->qty + $qty;
                              $_postArr=array('qty'=>$sumQuantity);
                             $this->sqlQuery_model->sql_update('tbl_cartmanager',$_postArr,array('user_id'=>$user,'variant_id'=>$variants,'product_id'=>$product_id)); 
                         }


                   }

          
            
           $getCartDetails=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_cartmanager WHERE user_id=".$user."");
             $cartProduct=array();
            if($getCartDetails!=0){
               foreach ($getCartDetails as $key => $cart_value) {
                  $cartProduct[] = array(
                         'cart_id'  =>$cart_value->cart_id,
                         'cust_id'  =>$cart_value->user_id,
                         'product_id' =>$cart_value->product_id,
                         'variant_id' =>$cart_value->variant_id,
                         'qty'     => $cart_value->qty,
                         'price'   => $cart_value->price,
                         'name'    => $cart_value->name,
                         'variant' => unserialize($cart_value->options)
                      );
                 }
             } 

      }
      

      $this->response([
        'status' => RestController::HTTP_OK,
        'message' => 'Item added successfully.',
        'response'=>$cartProduct
      ], RestController::HTTP_OK);


   }


  
  public function remove_cart_item_post(){
   
      $post = json_decode($this->input->raw_input_stream, true); 
       
       $customer_id = trim($post['customer_id']);
       $cart_id = trim($post['cart_id']);

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'All fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
       }


      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }


       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
       }


        if(empty($cart_id) || $cart_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Cart id is required.'
        ], RestController::HTTP_BAD_REQUEST);
       }


        $checkExit=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_cartmanager WHERE user_id=".$customer_id." AND cart_id=".$cart_id."");
      
        if($checkExit!=0){
              $this->sqlQuery_model->sql_delete('tbl_cartmanager',array('cart_id'=>$cart_id)); 
               $this->response([
                    'status' => RestController::HTTP_OK,
                    'message' => 'Cart item removed successfully.',
                    'response'=>$post
                  ], RestController::HTTP_OK);

        }else{

           $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Cart item not found.'
              ], RestController::HTTP_BAD_REQUEST);
         }
  

  }
   

public function cart_list_post(){
  
      $post = json_decode($this->input->raw_input_stream, true); 
       
       $customer_id = trim($post['customer_id']);
       $cart_id = trim($post['cart_id']);

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'All fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
       }


      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }


       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
       }


      $where['user_id']=$customer_id;
       if($cart_id!=""){
       $where['cart_id']=$cart_id;
      }

     
       $getCartDetails=$this->sqlQuery_model->sql_select_where('tbl_cartmanager',$where);

         $cartProduct=array();
           $subTotal_amount=0;
           $totalQuantity=0;
            $conversionFactorGetKg=0;
            if($getCartDetails!=0){
               foreach ($getCartDetails as $key => $cart_value) {
                  $variantArr=unserialize($cart_value->options);
                 
                  $cartProduct[] = array(
                         'cart_id'  =>$cart_value->cart_id,
                         'cust_id'  =>$cart_value->user_id,
                         'product_id' =>$cart_value->product_id,
                         'variant_id' =>$cart_value->variant_id,
                         'qty'     => $cart_value->qty,
                         'price'   => $cart_value->price,
                         'name'    => $cart_value->name,
                         'imageUrl'=>base_url().'uploads/',
                         'variant' => $variantArr
                      );
                     
                  
                  $amount  = $cart_value->price*$cart_value->qty;    
                  $subTotal_amount +=$amount;  

                  $totalQuantity += $cart_value->qty;

                       if($variantArr['units']=='g'){

                            $getWeight_gram=$variantArr['packsize'] * $cart_value->qty;
     
                        }else if($variantArr['units']=='Kg'){
                           
                            $getWeight_gram=($variantArr['packsize'] * 1000) * $cart_value->qty;
                        }
                     
                        $conversionFactorGetKg +=$getWeight_gram;
                 }
             } 
        
          $getInGramToKg = $conversionFactorGetKg / 1000;

         $data['cartItems']=$cartProduct;
         $data['totalQty']=$totalQuantity;
         $data['itemsWeight']=sprintf('%.3f', $getInGramToKg);
         $data['weightUnits']='Kg';
         $data['subTotal']=$subTotal_amount;


        if($getCartDetails!=0){
           $this->response([
              'status' => RestController::HTTP_OK,
              'message' => 'Success.',
              'response'=> $data
            ], RestController::HTTP_OK);

        }else{
            $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Cart Data not found.'
            ], RestController::HTTP_BAD_REQUEST);

          }

  }



  public function banner_list_post(){

     $post = json_decode($this->input->raw_input_stream, true); 

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'Field is required.'
          ], RestController::HTTP_BAD_REQUEST);
       }

       $banner_type = trim($post['banner_type']);
       
       $arrPost=array('banner','ads');
       if(!in_array($banner_type,$arrPost)){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'Invalid input.'
          ], RestController::HTTP_BAD_REQUEST);
       }

  
       $getDetails=$this->sqlQuery_model->sql_select_where('tbl_banner',array('type'=>$banner_type,'status'=>1));

        $bannerList=array();
            if($getDetails!=0){
               foreach ($getDetails as $key => $value) {
                  
                   $bannerList[] = array(
                         'banner_id'  =>$value->banner_id,
                         'text1'  =>$value->text1,
                         'description' =>$value->description,
                         'desk_image' =>$value->desk_image,
                         'type'     => $value->type,
                         'button_link'   => $value->button_link,
                         'add_date'    => $value->add_date,
                         'imageUrl'   =>base_url().'uploads/banner/'
                      );


               }
           }
       
            $this->response([
              'status' => RestController::HTTP_OK,
              'message' => 'Success.',
              'response'=>$bannerList
            ], RestController::HTTP_OK);
          
       }



  public function set_default_address_post(){
   
     $post = json_decode($this->input->raw_input_stream, true); 
    
     $customer_id = trim($post['customer_id']);
     $addr_id = trim($post['addr_id']);

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'All fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
       }


      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }

       if(empty($addr_id) || $addr_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your address Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }



       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
        }

        $getDetails=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'addr_id'=>$addr_id));
       if($getDetails==0){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Address not found.'
          ], RestController::HTTP_BAD_REQUEST);
       }

       
        $row_sql_update=$this->my_libraries->setDefaultAddressOnupdate($customer_id,$addr_id);
        if($row_sql_update){
            $getResponse=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'addr_id'=>$addr_id));
             $this->response([
              'status' => RestController::HTTP_OK,
              'message' => 'Address Applied.',
              'response'=>$getResponse
            ], RestController::HTTP_OK);


          }else{
            $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Failed to Apply.'
            ], RestController::HTTP_BAD_REQUEST);
            
          }
       

  }


  public function get_default_address_post(){

     $post = json_decode($this->input->raw_input_stream, true);     
     $customer_id = trim($post['customer_id']);

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'All fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
       }


      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }

      

       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
        }

        $getDetails=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_id,'setAddressDefault'=>1));
       if($getDetails!=0){
         $this->response([
              'status' => RestController::HTTP_OK,
              'message' => 'Success.',
              'response'=>$getDetails[0]
            ], RestController::HTTP_OK);
       }else{
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Default address not set.'
          ], RestController::HTTP_BAD_REQUEST);
       }

  }


  public function apply_coupon_post(){
      
         $post = json_decode($this->input->raw_input_stream, true); 

         $customer_id = trim($post['customer_id']);
         $coupon_code = trim($post['coupon_code']);
         $total_purchaseAmount = trim($post['total_purchaseAmount']);
         $total_itemsWeightKg= trim($post['total_itemsWeightKg']);

          if($post==array()){
             $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'All fields are required.'
              ], RestController::HTTP_BAD_REQUEST);
           }


          if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
           }

           if(empty($coupon_code) || $coupon_code==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your coupon code.'
            ], RestController::HTTP_BAD_REQUEST);
           }

      

           if(!$this->my_libraries->checkCustomer($customer_id)){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Customer not found.'
              ], RestController::HTTP_BAD_REQUEST);
            }


              $user=$customer_id;
              $coupon_codes_disk=$coupon_code;
              $purchaseAmount=$total_purchaseAmount;
              $purchaseWeightQty=$total_itemsWeightKg;
              $flog=1;


         $this->getCodeApplycoupon_api($coupon_codes_disk,$purchaseAmount,$purchaseWeightQty,$flog,$user);

  }

 public function getCodeApplycoupon_api($coupon_codes_disk='',$purchaseAmount=0,$purchaseWeightQty=0,$flog=0,$user_id=""){
          
         $user=$this->sqlQuery_model->sql_select_where('tbl_customer',array('customer_id'=>$user_id));
          
         if($coupon_codes_disk!=""){
             
              $foundCouponDetails=$this->sqlQuery_model->sql_select_where('tbl_coupon',array('coupon_code'=>$coupon_codes_disk));
              if($foundCouponDetails==0){
                  $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => $this->config->item('invalid_coupon')
                  ], RestController::HTTP_BAD_REQUEST);
              }


             if($foundCouponDetails[0]->coupons_status==0){
                  $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Coupon Code is not applicable.'
                   ], RestController::HTTP_BAD_REQUEST);
               }


           if($foundCouponDetails[0]->coupon_person_type=='public' && $foundCouponDetails[0]->coupon_time_uses=='multi_use'){
             $apply=1;
             $usertype='public';

            }else if($foundCouponDetails[0]->coupon_person_type=='individual' && $foundCouponDetails[0]->coupon_time_uses=='multi_use'){
              
                 $explodeEmail = explode(',', $foundCouponDetails[0]->coupon_email_group);
                 if(in_array($user[0]->email, $explodeEmail)){
                   $apply=1;
                   $usertype='individual';
                 }else{

                     $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'This coupon only applicable for special customer.'
                     ], RestController::HTTP_BAD_REQUEST);

                 }

            }else if($foundCouponDetails[0]->coupon_person_type=='public' && $foundCouponDetails[0]->coupon_time_uses=='single_use'){

                 $checkCouponApplied=$this->sqlQuery_model->sql_select_where('tbl_cust_coupon_applied_history',array('cust_id'=>$user[0]->customer_id,'cust_email'=>$user[0]->email,'coupon_code'=>$coupon_codes_disk,'usertype'=>'public'));
                 if($checkCouponApplied==0){
                    $apply=1;
                    $usertype='public';
                 }else{

                    $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Already coupon code has been applied.'
                     ], RestController::HTTP_BAD_REQUEST);
                 }

            }else if($foundCouponDetails[0]->coupon_person_type=='individual' && $foundCouponDetails[0]->coupon_time_uses=='single_use'){

                 $explodeEmail = explode(',', $foundCouponDetails[0]->coupon_email_group);

                 if(in_array($user[0]->email, $explodeEmail)){
                  
                      $checkCouponApplied=$this->sqlQuery_model->sql_select_where('tbl_cust_coupon_applied_history',array('cust_id'=>$user[0]->customer_id,'cust_email'=>$user[0]->email,'coupon_code'=>$coupon_codes_disk,'usertype'=>'individual'));
                      if($checkCouponApplied==0){
                        $apply=1;
                        $usertype='individual';
                       }else{

                             $this->response([
                                'status' => RestController::HTTP_BAD_REQUEST,
                                'message' => 'Already coupon code has been applied.'
                                 ], RestController::HTTP_BAD_REQUEST);
                            }
        
                 }else{

                    $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'This coupon only applicable for special customer.'
                     ], RestController::HTTP_BAD_REQUEST);
                  
                    }

                 
              }else{
                $apply=0;
              }


                   
                 $currentDate=date('Y-m-d');
                 $startDate=date($foundCouponDetails[0]->start_date);
                 $endDate=date($foundCouponDetails[0]->end_date);

                 $numberCurrent=strtotime($currentDate);
                 $numberstart=strtotime($startDate);
                 $numberend=strtotime($endDate);

               if($apply==1){
           
                 if($numberstart <= $numberCurrent && $numberend >= $numberCurrent){

                      if($foundCouponDetails[0]->purchase_type=='amount_purchase'){
                          $couponDisc=$this->setDiscountCouponOnPurchaseAmount_api($foundCouponDetails,$purchaseAmount,$coupon_codes_disk,$user,$usertype);

                      }else if($foundCouponDetails[0]->purchase_type=='qty_purchase'){

                         $couponDisc=$this->setDiscountCouponOnPurchaseQty_api($foundCouponDetails,$purchaseWeightQty,$purchaseAmount,$coupon_codes_disk,$user,$usertype);
                      }else{
                         $couponDisc='';
                      }

                       if($flog==1){

                           $this->response([
                              'status' => RestController::HTTP_OK,
                              'message' => 'Coupon Applied successfully.',
                              'response'=>$couponDisc
                            ], RestController::HTTP_OK);
                          
                      }else{
                        return $couponDisc;
                      }
                   
                 }else{

                     $this->response([
                      'status' => RestController::HTTP_BAD_REQUEST,
                      'message' => 'The coupon has been expired. Not allowed.'
                     ], RestController::HTTP_BAD_REQUEST);
                      
                     }


               }else{

                       $this->response([
                          'status' => RestController::HTTP_BAD_REQUEST,
                          'message' => 'Whoops! Something went wrong.'
                         ], RestController::HTTP_BAD_REQUEST);
                    }  
               

           }else{

                    $this->response([
                      'status' => RestController::HTTP_BAD_REQUEST,
                      'message' => 'Coupon not applied.'
                     ], RestController::HTTP_BAD_REQUEST);          
             }

   }


public function setDiscountCouponOnPurchaseAmount_api($purchaseType=array(),$purchaseAmount=0,$coupon_codes_disk="",$user="",$usertype=""){
        
      if($purchaseAmount < $purchaseType[0]->min_purch_amt){
            $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => "Your purchase amount should be ".$purchaseType[0]->min_purch_amt
             ], RestController::HTTP_BAD_REQUEST);  
       }
        

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
      // 'min_purch_product'=>$purchaseType[0]->min_purch_product,
      'coupon_codes'=>$coupon_codes_disk,
      'purchaseOrderAmountWithDisc'=>sprintf('%.2f',$purchaseOrderAmountWithDisc),
      'couponValue'=>sprintf('%.2f',$couponValue),
      'originalPurchaseAmount'=>sprintf('%.2f', $purchaseAmount),
      'usertype'=>$usertype,
      'coupon_use'=>$purchaseType[0]->coupon_time_uses,
      'cust_id'=>$user[0]->customer_id,
      'cust_email'=>$user[0]->email

    );

   return  $arrayDiscount;  
}



public function setDiscountCouponOnPurchaseQty_api($purchaseType=array(),$purchaseWeightQty=0,$purchaseAmount=0,$coupon_codes_disk="",$user="",$usertype=""){
       
       if($purchaseWeightQty < $purchaseType[0]->min_purch_qty){
          $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => "Your purchase weight qty should be more than ".$purchaseType[0]->min_purch_qty." Kg."
             ], RestController::HTTP_BAD_REQUEST);
          
       }

        if($purchaseAmount < $purchaseType[0]->disc_amt){
             $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => "Your purchase amount should be greater than ".$purchaseType[0]->disc_amt
             ], RestController::HTTP_BAD_REQUEST);
          
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
      // 'min_purch_product'=>$purchaseType[0]->min_purch_product,
      'coupon_codes'=>$coupon_codes_disk,
      'purchaseOrderAmountWithDisc'=>$purchaseOrderAmountWithDisc,
      'couponValue'=>$couponValue,
      'originalPurchaseAmount'=>sprintf('%.2f', $purchaseAmount),
      'usertype'=>$usertype,
      'coupon_use'=>$purchaseType[0]->coupon_time_uses,
      'cust_id'=>$user[0]->customer_id,
      'cust_email'=>$user[0]->email
    );

   return  $arrayDiscount; 

  }


public function add_gst_details_post(){

  $post = json_decode($this->input->raw_input_stream, true); 

     $customer_id = trim($post['customer_id']);
     $gst_no = trim($post['gst_no']);
     $registered_company_name = trim($post['registered_company_name']);
     $registered_company_address= trim($post['registered_company_address']);
     $pincode= trim($post['pincode']);
     $mobile= trim($post['mobile']);
     $email= trim($post['email']);

      if($post==array()){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'All fields are required.'
          ], RestController::HTTP_BAD_REQUEST);
       }


      if(empty($customer_id) || $customer_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Enter your customer Id.'
        ], RestController::HTTP_BAD_REQUEST);
       }

       if(!$this->my_libraries->checkCustomer($customer_id)){
         $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Customer not found.'
          ], RestController::HTTP_BAD_REQUEST);
        }



    $postArr['registration_no']=$gst_no;
    $postArr['company_name'] = $registered_company_name;
    $postArr['company_address'] =$registered_company_address;
    $postArr['cust_pincode'] =$pincode;
    // $postArr['mobile'] =$mobile;
    // $postArr['email'] =$email;

    $post_sql=$this->sqlQuery_model->sql_update('tbl_customer',$postArr,array('customer_id'=>$customer_id));

   if($post_sql){
        $postArr['customer_id']=$customer_id;
        $this->response([
              'status' => RestController::HTTP_OK,
              'message' => 'GST Details added successfully.',
              'response'=>$postArr
            ], RestController::HTTP_OK);

        }else{
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Failed to add GST Details.'
            ], RestController::HTTP_BAD_REQUEST);
          
         }

  }


    public function place_order_post(){

         $post = json_decode($this->input->raw_input_stream, true); 
         
          $customer_id = trim($post['customer_id']);
          $cart = $post['cart'];
          $coupon_details = $post['coupon_details'];
          $gst_details_apply = trim($post['gst_details_apply']);
          $gst_details = $post['gst_details'];
          $total_amount = trim($post['total_amount']);


           if($post==array()){
             $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'All fields are required.'
              ], RestController::HTTP_BAD_REQUEST);
           }


          if(empty($customer_id) || $customer_id==""){
                $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Enter your customer Id.'
                ], RestController::HTTP_BAD_REQUEST);
           }

           if(!$this->my_libraries->checkCustomer($customer_id)){
                 $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Customer not found.'
                  ], RestController::HTTP_BAD_REQUEST);
            }


          if($cart==array() ||$cart==""){
             $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Cart is empty.'
              ], RestController::HTTP_BAD_REQUEST);
           }


           if(empty($total_amount) || $total_amount==""){
                $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Enter your total order amount.'
                ], RestController::HTTP_BAD_REQUEST);
           }

         
        $customer_session=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_customer WHERE customer_id=$customer_id");

         if($gst_details_apply==1){

             if(empty($gst_details['gst_no']) || $gst_details['gst_no']==""){
                $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Enter your GST No.'
                ], RestController::HTTP_BAD_REQUEST);
              }

              if(empty($gst_details['registered_company_name']) || $gst_details['registered_company_name']==""){
                $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Enter your registered company name.'
                ], RestController::HTTP_BAD_REQUEST);
              }

               if(empty($gst_details['registered_company_address']) || $gst_details['registered_company_address']==""){
                $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Enter your registered company address.'
                ], RestController::HTTP_BAD_REQUEST);
              }
            

             $registration=$gst_details['gst_no'];
             $company_name=$gst_details['registered_company_name'];
             $company_address=$gst_details['registered_company_address'];
          }else{
             $registration=null;
             $company_name=null;
             $company_address=null;
          }



         
            $arrayErr=$this->my_libraries->getStockvalidate_api($cart);
            if(in_array(0, $arrayErr)){

              $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Order not allowed to continue.Stock not more than your qty order.'
                ], RestController::HTTP_BAD_REQUEST);
                 // $data['status']=2;
                 // $data['type']="order_not_allowed_to_continue";
                 // $data['message']="Order not allowed to continue.Stock not more than your qty order.";
                 // echo json_encode($data);
                 // exit;
              }


             

              $lastRowId=$this->my_libraries->getLastRowId('tbl_order_manager','order_id');
             $generated_order_id='ORD'.$this->my_libraries->generateNumeric(2).date('y-md').'-'.str_pad($lastRowId,4,0,STR_PAD_LEFT);

             $postData=array('registration'=>$registration,
              'company_name'=>$company_name,
              'company_address'=>$company_address,
              'shopping_order_id'=>$generated_order_id
            );




               $success =true;
              
               // Its Pending for payment getway integration

               if ($success === true){
                    $order_process_step='Pending';
                    $order_payment='Success payment';
                    $order_payment_status='Paid';
                    $order_mode_type='Razorpay';
                }else{
                    $order_process_step='Pending';
                    $order_payment='Failed payment';
                    $order_payment_status='Unpaid';
                    $order_mode_type='Razorpay';
                }


            $result=$this->placeCustomerOrder($postData,$order_process_step,$order_payment,$order_payment_status,$customer_session,$cart,$total_amount,$coupon_details,$order_mode_type);
           

    }


    public function getCartDetails_api($cart_details){
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

                      if($value_cart['variant']['units']=='g'){

                             $getWeight_gram=$value_cart['variant']['packsize'] * $value_cart['qty'];

                               
                        }else if($value_cart['variant']['units']=='Kg'){
                           
                             $getWeight_gram=($value_cart['variant']['packsize'] * 1000) * $value_cart['qty'];
                            
                        }


                      if($value->cat_id==$value_cart['variant']['cat_id']){

                          array_push($arrayCart, $value_cart);
                          $total_items +=$value_cart['qty'];
                           $conversionFactorGetKg +=$getWeight_gram;
                          // $conversionFactorGetKg +=$value_cart['variant']['conversion_factor'] * $value_cart['qty'];
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

return array($c,$f);

}

public function getLastRowId_api($tablename,$colname){
 
   $get_product=$this->sqlQuery_model->sql_query("SELECT MAX($colname) as rowid FROM $tablename");
   $rowValue=$get_product[0]->rowid;
    $getv=1;
   if($rowValue!=""){
     $getv=$rowValue+$getv;
   }
   return $getv;
   
}

  
  public function placeCustomerOrder($postData=array(),$order_process_step="",$order_payment='',$order_payment_status='',$customer_session='',$contents='',$total_amount=0,$couponDetails='',$order_mode_type=''){
             
            
             $lastRowId=$this->getLastRowId_api('tbl_order_manager','order_id');
             $generated_order_id=$postData['shopping_order_id'];

             $getShippingAddress=$this->sqlQuery_model->sql_select_where('tbl_address',array('customer_id'=>$customer_session[0]->customer_id,'setAddressDefault'=>1));

             $itemsWieght=$this->getCartDetails_api($contents);
               
                // $shippingCharg=$this->my_libraries->getShippingChargesOnAddressPincode($customer_session,$contents,$itemsWieght,$dlivetype);
                if($couponDetails!="" && $couponDetails!=array()){
                   
                      $finalAmount=$couponDetails['purchaseOrderAmountWithDisc']; //+$shippingCharg['shippCharges'];
                      $couponAmount=$couponDetails['couponValue'];
                  }else{

                   
                      $finalAmount=$total_amount; //+$shippingCharg['shippCharges'];
                      $couponAmount=0;
                  }
               

            
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
                              'order_date'=>date('Y-m-d H:i:s')
                             );

                 
           
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
                
                        $process_step=$order_process_step;
                        foreach($contents as $key=>$value){

                            $value['subtotal'] = $value['price'] * $value['qty'];

                        
                         $getPRoduct=$this->sqlQuery_model->sql_select_where('tbl_product',array('product_id'=>$value['product_id']));


                         $gstManage=$this->my_libraries->getGSTCalculation($value['subtotal'],$value['qty'],$getShippingAddress,$value,$getPRoduct);

                         

                         // $productOffer= $this->getCustomerProductOffer($value['options']['product_gen_id'],$value['options']['variant_id'],$value['qty']);
                        
                         // if($productOffer!=array() && $order_payment_status!='Unpaid'){
                         //   $this->stockManage($productOffer['pQty'],$productOffer['veriant_id']);
                         //  }


                          if($value['variant']['units']=='g'){
                             $getWeight_gram=$value['variant']['packsize'] * $value['qty'];
                             }else if($value['variant']['units']=='Kg'){
                             $getWeight_gram=($value['variant']['packsize'] * 1000) * $value['qty'];
                            }

                           $getInGramToKg = $getWeight_gram / 1000;
                           $conversion_factor=sprintf('%.3f',$getInGramToKg);
                     
                          $order_products=array(
                                    'pro_generated_order_id'=>$generated_order_id,
                                    'pro_sys_product_id'=>$value['variant']['product_id'],
                                    'pro_cust_id'=>$customer_session[0]->customer_id,
                                    'pro_product_qty'=>$value['qty'],
                                    'pro_conversion_factor_kg'=>$conversion_factor,
                                    'pro_product_selling_price'=>$value['price'],
                                    'pro_product_name'=>$value['name'],
                                    'pro_own_product_id'=>$value['variant']['product_gen_id'],
                                    'pro_subtotal'=>$value['subtotal'],
                                    'pro_product_img'=>$value['variant']['image'],
                                    'pro_igst_rate'=>$gstManage[0]['iGstRate'],
                                    'pro_igst_amount'=>$gstManage[0]['iGstAmount'],
                                    'pro_cgst_rate'=>$gstManage[2]['cGstRate'],
                                    'pro_cgst_amount'=>$gstManage[2]['cGstAmount'],
                                    'pro_sgst_rate'=>$gstManage[1]['sGstRate'],
                                    'pro_sgst_amount'=>$gstManage[1]['sGstAmount'],
                                    'pro_taxable_amount'=>$gstManage[4],
                                    'pro_type_of_tax'=>$gstManage[3]['type'],
                                    'pro_sku_id'=>$value['variant']['sku_id'],
                                    'pro_hsn_code'=>$value['variant']['hsn_code'],
                                    'pro_order_place_state'=>$getShippingAddress[0]->state,
                                    'pro_updated_by'=>'Buyer',
                                    'pro_cat_id'=>$value['variant']['cat_id'],
                                    'pro_sub_cat_id'=>$value['variant']['sub_cat_id'],
                                    'pro_cat_name'=>$value['variant']['category'],
                                    'packsize'=>$value['variant']['packsize'],
                                    'units_id'=>$value['variant']['units_id'],
                                    'units'=>$value['variant']['units'],
                                    'pro_sub_cat_name'=>$value['variant']['sub_category'],
                                    // 'pro_offer_productName'=>null,
                                    // 'pro_offer_category'=>null,
                                    // 'pro_offer_image'=>null
                                    // 'pro_offer_packSize'=>null,
                                    // 'pro_offer_units'=>null,
                                    // 'pro_offer_pQty'=>null,
                                    // 'pro_offer_status'=>null,
                                    'pro_product_order_date'=>date('Y-m-d H:i:s'),
                                    'pro_order_status'=>$order_process_step
                                  );

                           
                         
                            $add_order_products=$this->sqlQuery_model->sql_insert('tbl_order_products',$order_products);
                            $insertp_id=$this->sqlQuery_model->get_last_inset_id('tbl_order_products');

                            // $this->insertOfferProduct($productOffer,$generated_order_id,$customer_session[0]->customer_id,$order_process_step);

                             if($add_order_products && $order_payment_status!='Unpaid'){
                                $this->my_libraries->stockManage($value['qty'],$value['variant']['variant_id']);
                              }

                             $items[]=(object)$order_products;
                        }

                   
                    
                             $orders['order_manager']=$order_manager;
                             $orders['orderItems']=$items;

                            if($add_order_products){

                                 $this->response([
                                      'status' => RestController::HTTP_OK,
                                      'message' => 'Your order has been placed.',
                                      'response'=>$orders
                                    ], RestController::HTTP_OK);
                              
                             }else{
                                 $this->response([
                                    'status' => RestController::HTTP_BAD_REQUEST,
                                    'message' => 'Order failed to place.'
                                    ], RestController::HTTP_BAD_REQUEST);
                                   
                                }

                     }else{

                          $this->response([
                            'status' => RestController::HTTP_BAD_REQUEST,
                            'message' => 'Someting went wrong.'
                            ], RestController::HTTP_BAD_REQUEST);
                        }

        }


   public function order_list_get(){
   
          $customer_id = $this->input->get('cust_id');

          
          if(empty($customer_id) || $customer_id==""){
                $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Enter your customer Id.'
                ], RestController::HTTP_BAD_REQUEST);
           }

           if(!$this->my_libraries->checkCustomer($customer_id)){
                 $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Customer not found.'
                  ], RestController::HTTP_BAD_REQUEST);
            }


           $querys="SELECT * FROM tbl_order_manager WHERE order_cust_id=".$customer_id."";
           $pr_list_count=$this->sqlQuery_model->sql_query($querys);

           $data['order_count']=($pr_list_count!=0) ? count($pr_list_count):0;
        
           $limit_per_page = $this->input->get('limit_per_page');

           $getVariable=$this->input->get('per_page');

           $page = (is_numeric($getVariable)) ? (($getVariable) ? ($getVariable - 1) : 0 ) : 0;

           $total_records = ($pr_list_count!=0) ? count($pr_list_count) : 0;
           

           $sql_limit='LIMIT '.$page*$limit_per_page.','.$limit_per_page;
          
           $querys="SELECT * FROM tbl_order_manager WHERE order_cust_id=".$customer_id." ORDER BY order_id DESC $sql_limit";
           $getOrders=$this->sqlQuery_model->sql_query($querys);
           

           if($getOrders!=0){

            foreach ($getOrders as $key => $value) {
                 $itemData=$this->sqlQuery_model->sql_select_where('tbl_order_products',array('pro_generated_order_id'=>$value->order_generated_order_id));
                 $value->imageUrl=base_url().'uploads/';
                $value->order_items=($itemData!=0) ? $itemData :array();

                 $ordProcess=$this->my_libraries->orderProcessSteps($value->order_cust_id,$value->order_generated_order_id);
                 
                  if(!in_array('Canceled',$ordProcess)){

                     $arrayPlace['step']='Placed';
                     $arrayPlace['status']='active';
                     
                     $arrayReceived['step']='In Process';
                     $arrayReceived['status']=(in_array('Received',$ordProcess)) ? 'active':'';

                     $arrayReadytoship['step']='Ready to ship';
                     $arrayReadytoship['status']=(in_array('Ready to ship',$ordProcess)) ? 'active':'';

                     $arrayShipped['step']='Shipped';
                     $arrayShipped['status']=(in_array('Shipped',$ordProcess)) ? 'active':'';

                     $arrayDelivered['step']='Delivered';
                     $arrayDelivered['status']=(in_array('Delivered',$ordProcess)) ? 'active':'';
                     
                     $deliveryStepArray=array($arrayPlace,$arrayReceived,$arrayReadytoship,$arrayShipped,$arrayDelivered);

                 }else{
                     $arrayCancel['step']='Cancelled';
                     $arrayCancel['status']=(in_array('Canceled',$ordProcess)) ? 'active':'';
                     $deliveryStepArray=array($arrayCancel);
                 }
                  
                  $value->delivery_steps=$deliveryStepArray;

               $response[]=$value;

            }
           }

         
           $this->response([
              'status' => RestController::HTTP_OK,
              'message' => 'Success',
              'response'=>($getOrders!=0) ? $getOrders :array()
            ], RestController::HTTP_OK);

   }


   public function order_cancel_by_customer_post(){
      $post = json_decode($this->input->raw_input_stream, true); 
      $customer_id = $post['customer_id'];

      if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
       }

       if(!$this->my_libraries->checkCustomer($customer_id)){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Customer not found.'
              ], RestController::HTTP_BAD_REQUEST);
        }

         $order_id = $post['order_id'];
         $reason_id = $post['reason_id'];
         
         $sql=$this->sqlQuery_model->sql_select_where('tbl_cancel_reasons',array('reasons_id'=>$reason_id));
         if($sql==0){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Reason not found.'
              ], RestController::HTTP_BAD_REQUEST);
         }

         $order_status='Canceled';

          $reason_value_name=$this->my_libraries->getOrderCancelReason_name($reason_id);

          $orders_manger=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_order_manager WHERE order_generated_order_id='".$order_id."'");

          if($orders_manger==0){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Order not found.'
              ], RestController::HTTP_BAD_REQUEST);
         }
         

         if($orders_manger[0]->order_status!='Canceled' && $orders_manger[0]->order_status!='Delivered'){

        
          $sqlQuery=$this->sqlQuery_model->sql_update('tbl_order_manager',array('order_status'=>$order_status,'order_reason_disc'=>$reason_value_name,'order_status_update_by'=>'Customer'),array('order_generated_order_id'=>$order_id));

           $sqlQuery=$this->sqlQuery_model->sql_update('tbl_order_products',array('pro_order_status'=>$order_status,'pro_reason_disc'=>$reason_value_name,'pro_order_status_update_by'=>'Customer'),array('pro_generated_order_id'=>$order_id));


           $orders=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_order_products WHERE pro_generated_order_id='".$order_id."'");

           $this->my_libraries->orderStatusManagement($customer_id,$order_id,$order_status,$reason_value_name,0,0,'Customer');   // Order cancelled by customer status update

           $content=$this->my_libraries->sendTemplateContent($order_status);

          
           $send['message']=$content['messages'];
           $send['disc']='';
           $send=orderArray($send,$orders,$orders_manger);
           $body['content']=$send;
           $temp['tempate']=$this->load->view('emailTemplate/email_template',$body,true);
           $temp['customerEmail']=$orders_manger[0]->order_email;
           $temp['adminEmail_CC']=$this->config->item('setFrom');

           $temp['subject']=$content['subject'];
           $sent= $this->my_libraries->sendEmailDetails($temp);


           if($sqlQuery){
                 $this->response([
                  'status' => RestController::HTTP_OK,
                  'message' => 'Canceled successfully.',
                  'response'=>$post
                ], RestController::HTTP_OK);

           }else{
                 $this->response([
                    'status' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Failed to Canceled order.'
                  ], RestController::HTTP_BAD_REQUEST);
              }

       }else{

          

              if($orders_manger[0]->order_status=='Canceled'){
                $messs="Already Canceled order.";
              }

              if($orders_manger[0]->order_status=='Delivered'){
                $messs="Order has been delivered.This order not allowed to Canceled.";
              }

             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => $messs,
              ], RestController::HTTP_BAD_REQUEST);
     
       }



    }


public function product_rating_post(){
   
      $post = json_decode($this->input->raw_input_stream, true); 
      $customer_id = $post['customer_id'];

      if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
       }

       if(!$this->my_libraries->checkCustomer($customer_id)){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Customer not found.'
              ], RestController::HTTP_BAD_REQUEST);
        }

     


          $comment = $post['review_comment'];
          $star_rate = $post['rating'];
          $item_id = $post['order_id'];
          $pro_id = $post['product_id'];
          
             if($star_rate==0 && $star_rate==""){
                 $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Please give rating start.'
               ], RestController::HTTP_BAD_REQUEST);
              }


             if($comment==""){
                 $this->response([
                  'status' => RestController::HTTP_BAD_REQUEST,
                  'message' => 'Enter your comments.'
                 ], RestController::HTTP_BAD_REQUEST); 
              }
        
         $startRating = array(1,2,3,4,5);

         if(!in_array($star_rate,$startRating)){
            $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'Invalid rating.'
             ], RestController::HTTP_BAD_REQUEST); 
         }


      $order_status="Delivered";

      $orders=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_order_products WHERE pro_generated_order_id='".$item_id."' AND pro_order_status = '".$order_status."' AND pro_sys_product_id=$pro_id");

      if($orders==0){
         $this->response([
              'status' => RestController::HTTP_BAD_REQUEST,
              'message' => 'Order item not found.'
             ], RestController::HTTP_BAD_REQUEST); 
       }


          $where = array('cust_id'=>trim($customer_id),'product_id'=>$pro_id,'order_id'=>$item_id);
          $checkExit=$this->sqlQuery_model->sql_select_where('tbl_rate_and_review',$where);
          
              if($checkExit==0){
               
                 $postarr = array(
                    'cust_id'=>trim($customer_id),
                    'product_id'=>$pro_id,
                    'order_id'=>$item_id,
                    'cust_rate'=>$star_rate,
                    'comment'=>$comment
                  );

                             $insert=$this->sqlQuery_model->sql_insert('tbl_rate_and_review',$postarr);
                            if($insert){
                                 $this->response([
                                      'status' => RestController::HTTP_OK,
                                      'message' => 'Successfully added.',
                                      'response'=>$post
                                    ], RestController::HTTP_OK);
                             
                            }else{
                                 $this->response([
                                      'status' => RestController::HTTP_BAD_REQUEST,
                                      'message' => 'Failed to add.'
                                     ], RestController::HTTP_BAD_REQUEST); 
                                }

              }else{
                
                     $postarr = array(
                        'cust_rate'=>$star_rate,
                        'comment'=>$comment
                      );

                      $update=$this->sqlQuery_model->sql_update('tbl_rate_and_review',$postarr,$where);
                        if($update){

                                $this->response([
                                      'status' => RestController::HTTP_OK,
                                      'message' => 'Successfully updated.',
                                      'response'=>$post
                                    ], RestController::HTTP_OK);
                         
                        }else{
                            $this->response([
                                      'status' => RestController::HTTP_BAD_REQUEST,
                                      'message' => 'Failed to update.'
                                     ], RestController::HTTP_BAD_REQUEST); 
                           }

              }      
 }


public function get_rating_get(){

      $customer_id = $this->input->get('cust_id');
      $pro_id = $this->input->get('product_id');
      $item_id = $this->input->get('order_id');

      
      if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
       }

       if(!$this->my_libraries->checkCustomer($customer_id)){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Customer not found.'
              ], RestController::HTTP_BAD_REQUEST);
        }



          $where = array('cust_id'=>trim($customer_id),'product_id'=>$pro_id,'order_id'=>$item_id);
          $ratingDetails=$this->sqlQuery_model->sql_select_where('tbl_rate_and_review',$where);

         $this->response([
          'status' => RestController::HTTP_OK,
          'message' => 'Success.',
          'response'=>($ratingDetails!=0) ? $ratingDetails :array(),
        ], RestController::HTTP_OK);
}

public function review_rating_list_get(){
      $pro_id = $this->input->get('product_id');
      if(empty($pro_id) || $pro_id==""){
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Product Id missing.'
        ], RestController::HTTP_BAD_REQUEST);
       }
     
  
          $where = array('product_id'=>$pro_id);
          $ratingDetails=$this->sqlQuery_model->sql_select_where('tbl_rate_and_review',$where);
          $reviewList=array();
          if($ratingDetails!=0){
           
           foreach ($ratingDetails as $key => $value) {
                $where_cust = array('customer_id'=>$value->cust_id);
                $custoDetails=$this->sqlQuery_model->sql_select_where('tbl_customer',$where_cust);
                $value->customer_datails=($custoDetails!=0) ? $custoDetails : array();
                $value->defaultUserImage = base_url().'include/frontend/default-user.png';
                $reviewList[]=$value;
             }
          }


         $this->response([
          'status' => RestController::HTTP_OK,
          'message' => 'Success.',
          'response'=>$reviewList ,
        ], RestController::HTTP_OK);
      
}


public function getCouponList_post(){
    $customer_id = $this->input->post('cust_id');
    
    if(empty($customer_id) || $customer_id==""){
            $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Enter your customer Id.'
            ], RestController::HTTP_BAD_REQUEST);
       }

       if(!$this->my_libraries->checkCustomer($customer_id)){
             $this->response([
                'status' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Customer not found.'
              ], RestController::HTTP_BAD_REQUEST);
        }
        $where = array('status'=>1);
        $couponList=$this->sqlQuery_model->sql_select_where('tbl_coupon',$where);

        $this->response([
          'status' => RestController::HTTP_OK,
          'message' => 'Success.',
          'response'=>($couponList!=0) ? $couponList :array(),
        ], RestController::HTTP_OK);

}




// ==

  }

?>