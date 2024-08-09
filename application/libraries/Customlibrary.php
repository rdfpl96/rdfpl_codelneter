<?php
class Customlibrary 
   {
   var $CI;
    public function __construct($params = array()){

       $this->CI =& get_instance();

       $custDetail=getCookies('customer');

       $this->customerId=isset($custDetail['customer_id']) ? $custDetail['customer_id'] : '' ;

       $this->CI->load->model('cart_model','cartObj');
       $this->CI->load->model('common_model');
    }

    public function getDefaultAddressId(){
       $return=0;
       $this->CI->db->select('addr_id');
       $this->CI->db->from('tbl_address');
       $this->CI->db->where('status',1);
       $this->CI->db->where('customer_id',$this->customerId);
       $this->CI->db->where('setAddressDefault',1);
       $query=$this->CI->db->get() ; 
       if($query->num_rows()>0){
         $return=$query->row()->addr_id;
       }
       return $return;

    }
    public function getCustomerGstDetailId(){
        $return=array();
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_gst');
        //$this->CI->db->where('status',1);
        $this->CI->db->where('customer_id',$this->customerId);
        $query=$this->CI->db->get() ; 
        if($query->num_rows()>0){
          $return=$query->row_array();
        }
       return $return;

      }
    
    public function getDefaultAddressPincode(){
       $return="";
       $this->CI->db->select('pincode');
       $this->CI->db->from('tbl_address');
       $this->CI->db->where('status',1);
       $this->CI->db->where('customer_id',$this->customerId);
       $this->CI->db->where('setAddressDefault',1);
       $query=$this->CI->db->get() ; 
       if($query->num_rows()>0){
         $return=$query->row()->pincode;
       }
       return $return;
    }

    public function getAllCustomerList($customer_id){
        $return=array();
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_address');
        $this->CI->db->where('status',1);
        $this->CI->db->where('customer_id',$customer_id);
        $this->CI->db->order_by('setAddressDefault','DESC');
        $query=$this->CI->db->get() ; 
        if($query->num_rows()>0){
          $return=$query->result_array();
        }
       return $return;
    }


    public function getCustomerCurrentAddress($customer_id){
       $return="";
       $this->CI->db->select('*');
       $this->CI->db->from('tbl_address');
       $this->CI->db->where('status',1);
       $this->CI->db->where('setAddressDefault',1);
       $this->CI->db->where('customer_id',$customer_id);
       $query=$this->CI->db->get() ; 
       if($query->num_rows()>0){
        $details=$query->row_array();
         $return=$details['address1']." ".$details['address2']." ".$details['area']." ".$details['city']." ".$details['state']." ".$details['pincode'];

       }
       return $return;
    }

    public function chkProductInWishlist($product_id){

        $this->CI->db->select('*');
        $this->CI->db->from('tbl_wishlist');
        $this->CI->db->where('cust_id',$this->customerId);
        $this->CI->db->where('product_id',$product_id);
        $this->CI->db->where('status',1);
        $query=$this->CI->db->get() ;
        if($query->num_rows()>0){ 
         return true;
        }else{
            return false;
        }
    }

    public function chkReviewAlreadyExist($customerId,$product_id,$order_id){

        $this->CI->db->select('*');
        $this->CI->db->from('tbl_rate_and_review');
        $this->CI->db->where('cust_id',$customerId);
        $this->CI->db->where('product_id',$product_id);
        $this->CI->db->where('order_id',$order_id);
        $this->CI->db->where('status',1);
        $query=$this->CI->db->get() ;
        if($query->num_rows()>0){ 
         return true;
        }else{
            return false;
        }
    }

    


     public function chkDeliveryLocation($pincode){
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_werehouse_with_pincode');
        $this->CI->db->where('pincode',$pincode);
        $this->CI->db->where('status',1);
        $query=$this->CI->db->get() ; 
        if($query->num_rows()>0){ 
         return true;
        }else{
            return false;
        }
   }

  
   public function getWishListCount($customer_id){
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_wishlist');
        $this->CI->db->where('cust_id',$customer_id);
        $this->CI->db->where('status',1);
        $query=$this->CI->db->get() ; 
        return $query->num_rows();
   }


   public function total_items($customer_id){
        $this->CI->db->select_sum('qty');
        $this->CI->db->from('tbl_cartmanager');
        $this->CI->db->where('user_id',$customer_id);
        
        $query=$this->CI->db->get(); 
        if($query->num_rows()>0){ 
         return $query->row()->qty;
         }
     return 0;  
   }

   public function productTypeName($id){
    $name='';     
    $this->CI->db->select('name');
    $this->CI->db->from('tbl_product_type');
    $this->CI->db->where('id',$id);
    $query=$this->CI->db->get() ; 
    if($query->num_rows()>0)
         { 
         $name= $query->row()->name;
         }
     return $name;   
   } 

 
  public function getProductItemByproductId($id,$min_price="",$max_price=""){
    $return=array();     
    $this->CI->db->select('*');
    $this->CI->db->from('tbl_product_variants');
    $this->CI->db->where('variants_product_id',$id);
    $this->CI->db->where('variants_status',1);
    $this->CI->db->where('is_new_item',0);
    if($min_price!="" && $max_price!=""){
      $this->CI->db->where('price >=', $min_price);
      $this->CI->db->where('price <=', $max_price);
    }
    $this->CI->db->order_by('price','ASC');
    $query=$this->CI->db->get() ; 
    if($query->num_rows()>0) { 
       $return=$query->result_array();
    }
    return $return;   
   }  

   public function TopCatName($id){
    $name='';     
    $this->CI->db->select('category');
    $this->CI->db->from('tbl_category');
    $this->CI->db->where('cat_id',$id);
    $query=$this->CI->db->get() ; 
    if($query->num_rows()>0)
         { 
         $name= $query->row()->category;
         }
     return $name;   
   } 
   
   public function SubCatName($id){
    $name='';     
    $this->CI->db->select('subCat_name');
    $this->CI->db->from('tbl_sub_category');
    $this->CI->db->where('sub_cat_id',$id);
    $query=$this->CI->db->get() ; 
    if($query->num_rows()>0)
         { 
         $name= $query->row()->subCat_name;
         }
     return $name;   
   } 

   public function ChildCatName($id){
    $name='';     
    $this->CI->db->select('childCat_name');
    $this->CI->db->from('tbl_child_category');
    $this->CI->db->where('child_cat_id',$id);
    $query=$this->CI->db->get() ; 
    if($query->num_rows()>0)
         { 
         $name= $query->row()->childCat_name;
         }
     return $name;   
   } 

   public function getTopCatDetailId($cat_id){
        $return=array();
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_category');
        $this->CI->db->where('status',1);
        $this->CI->db->where('cat_id',$cat_id);
        $query=$this->CI->db->get() ; 
        if($query->num_rows()>0){
          $return=$query->row_array();
        }
       return $return;

    }

    public function getSubCatDetailId($sub_cat_id){
        $return=array();
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_sub_category');
        $this->CI->db->where('status',1);
        $this->CI->db->where('sub_cat_id',$sub_cat_id);
        $query=$this->CI->db->get() ; 
        if($query->num_rows()>0){
          $return=$query->row_array();
        }
       return $return;

    }

    public function getChildCatDetailId($child_cat_id){
        $return=array();
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_child_category');
        $this->CI->db->where('status',1);
        $this->CI->db->where('child_cat_id',$child_cat_id);
        $query=$this->CI->db->get() ; 
        if($query->num_rows()>0){
          $return=$query->row_array();
        }
       return $return;

    }


   public function getTopCategory($id=''){
      $return=array();
      $this->CI->db->select('cat_id,category,slug,cat_image');
      $this->CI->db->from('tbl_category');
      $this->CI->db->where('status',1);
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        $return=$query->result_array();
      }
      return $return;
    }

    public function getAllSubCategory(){
      $return=array();
      $this->CI->db->select('sub_cat_id,cat_id,subCat_name,slug');
      $this->CI->db->from('tbl_sub_category');
      $this->CI->db->where('status',1);
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        $return=$query->result_array();
      }
      return $return;
    }

    public function getSubCategoryByCatId($top_cat_id,$id=''){
      $return=array();
      $this->CI->db->select('SC.sub_cat_id,SC.cat_id,SC.subCat_name,SC.slug,SC.subcat_image,TC.category as top_cat_name, TC.slug as top_cat_slug');
      $this->CI->db->from('tbl_sub_category AS SC');
      $this->CI->db->where('SC.cat_id',$top_cat_id);
      $this->CI->db->where('SC.status',1);
      $this->CI->db->join('tbl_category AS TC', 'SC.cat_id = TC.cat_id');
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        $return=$query->result_array();
      }
      return $return;
    }

   
    public function getChilCategory($top_cat_id,$sub_cat_id,$id=''){
      $return=array();
      $this->CI->db->select('CC.child_cat_id,CC.cat_id,CC.sub_cat_id,CC.childCat_name,CC.slug,
      TC.category AS top_cat_name, TC.slug AS top_cat_slug, SC.subCat_name AS sub_cat_name,SC.slug AS sub_cat_slug');
      $this->CI->db->from('tbl_category AS TC');
      $this->CI->db->where('CC.cat_id',$top_cat_id);
      $this->CI->db->where('CC.sub_cat_id',$sub_cat_id);
      $this->CI->db->where('TC.status',1);
      $this->CI->db->join('tbl_sub_category AS SC', 'SC.cat_id = TC.cat_id');
      $this->CI->db->join('tbl_child_category AS CC', 'CC.sub_cat_id = SC.sub_cat_id');
      
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        $return=$query->result_array();
      }
      return $return;
    }

   public function getTopCatInOption($id=''){
      $this->CI->db->select('*');
      $this->CI->db->from('tbl_category');
      $this->CI->db->where('status',1);
      $return='<option value="">Select Top Category</option>';
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        foreach($query->result_array() as $record){
          if($record['cat_id']==$id){
            $return.='<option value="'.$record['cat_id'].'" selected>'.$record['category'].'</oprion>';
          }else{
            $return.='<option value="'.$record['cat_id'].'">'.$record['category'].'</oprion>';
          }
        } 
      }
      return $return;
    }


   public function getSubCatInOption($top_cat_id,$id=''){
      $this->CI->db->select('*');
      $this->CI->db->from('tbl_sub_category AS SC');
      $this->CI->db->where('cat_id',$top_cat_id);
      $this->CI->db->where('status',1);
     
      $return='<option value="">Select Sub Category</option>';
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        foreach($query->result_array() as $record){
          if($record['sub_cat_id']==$id){
            $return.='<option value="'.$record['sub_cat_id'].'" selected>'.$record['subCat_name'].'</oprion>';
          }else{
            $return.='<option value="'.$record['sub_cat_id'].'">'.$record['subCat_name'].'</oprion>';
          }
        } 
      }
      return $return;
   }


   public function getChilCategoryInOption($top_cat_id,$sub_cat_id,$id=''){
      $this->CI->db->select('*');
      $this->CI->db->from('tbl_child_category AS SC');
      $this->CI->db->where('cat_id',$top_cat_id);
      $this->CI->db->where('sub_cat_id',$sub_cat_id);
      $this->CI->db->where('status',1);
     
      $return='<option value="">Select Child Category</option>';
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        foreach($query->result_array() as $record){
          if($record['child_cat_id']==$id){
            $return.='<option value="'.$record['child_cat_id'].'" selected>'.$record['childCat_name'].'</oprion>';
          }else{
            $return.='<option value="'.$record['child_cat_id'].'">'.$record['childCat_name'].'</oprion>';
          }
        } 
      }
      return $return;
   }


    public function getStateOptionInOption($state_id=''){
      $this->CI->db->select('*');
      $this->CI->db->from('states');
      $return='<option value="">Select State</option>';
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        foreach($query->result_array() as $record){
          if($record['id']==$id){
            $return.='<option value="'.$record['id'].'" selected>'.$record['name'].'</oprion>';
          }else{
            $return.='<option value="'.$record['id'].'">'.$record['name'].'</oprion>';
          }
        } 
      }
      return $return;
    }
    
    //
    //updateCart
    //
  public function upDateCartAfterLogin($cartItems,$customer_id){

     foreach($cartItems as $item){
        $cartItem=$this->CI->cartObj->getCartItem($customer_id,$item['id'],$item['variant_id']);
        if(count($cartItem)){
          $qty=$cartItem['qty']+$item['qty'];
          $this->CI->cartObj->updateItemQty($customer_id,$item['id'],$item['variant_id'],array('qty'=>$qty));
        }
        else{
           $cartProduct = array(
                      'user_id'       =>$customer_id,
                      'product_id'    =>$item['id'],
                      'variant_id'    =>$item['variant_id'],
                       'qty'          =>$item['qty']
                      );
          $this->CI->cartObj->itemSave($cartProduct);
        }  
     }
  }
  public function getTotalCartAmount($customerId){
        $return_data=array("totalPrice"=>0,"totalSellPrice"=>0);
        $this->CI->db->select('SUM(PV.price * C.qty) as totalPrice,SUM(PV.before_off_price * C.qty) as totalSellPrice');
        $this->CI->db->from('tbl_cartmanager AS C');
        $this->CI->db->where('user_id',$customerId);
        $this->CI->db->join('tbl_product_variants AS PV', 'PV.variant_id = C.variant_id');
         $query=$this->CI->db->get() ;
        if($query->num_rows()>0){ 
           $return_data=$query->row_array();
        }
        return $return_data;
    }


    public function getCouponDiscount($total,$coupon_code) {
        $return_amt=0;
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_coupon');
        $this->CI->db->where('coupon_code',$coupon_code);
        $this->CI->db->where('status',1);
        $query=$this->CI->db->get();
        if($query->num_rows()>0){ 
           $return_data=$query->row_array();
            if($return_data['disc_type']=='fixed_amt'){
                $return_amt=$return_data['disc_amt'];
            }
           else  if($return_data['disc_type']=='percentage'){
            $return_amt=($total *$return_data['disc_amt'])/100;
           }
        }
        return $return_amt;
    }

    public function getCheckoutSummery($customerId){
        $totalSellingPrice=0;
        $totalMrpPrice=0;
        $totalSave=0;
        $couponAmt=0;

        $cartAmount=$this->getTotalCartAmount($customerId);
        print_r($cartAmount);

    }
 
    public function getCartSummery($customerId){
        $array_data=array();
        $totalSellingPrice=0;
        $totalMrpPrice=0;
        $totalSave=0;
        $couponAmt=0;
        $this->CI->db->select('P.product_id,PV.price,PV.before_off_price,C.qty as cart_qty,C.cart_id,C.variant_id');
        $this->CI->db->from('tbl_cartmanager AS C');
        $this->CI->db->where('user_id',$customerId);
        $this->CI->db->order_by('C.cart_id','ASC');
        $this->CI->db->join('tbl_product AS P', 'P.product_id = C.product_id');
        $this->CI->db->join('tbl_product_variants AS PV', 'PV.variant_id = C.variant_id');
        $query=$this->CI->db->get();
        if($query->num_rows()>0){
           
            foreach($query->result_array() as $record){
                // echo'<pre>';
                // print_r($record);
                // echo'</pre>';

                if($record['before_off_price']>$record['price']){

                   $totalSellingPrice=$totalSellingPrice+($record['price']*$record['cart_qty']);
                   
                    $totalMrpPrice=$totalMrpPrice+($record['before_off_price']*$record['cart_qty']);

                }else{
                  $totalSellingPrice=$totalSellingPrice+$record['price']*$record['cart_qty'];  
                }

               
            }

            $totalSave=$totalMrpPrice-$totalSellingPrice;


        }
        
        return array('totalSellingPrice'=>$totalSellingPrice,'totalMrpPrice'=>$totalMrpPrice,'totalSave'=>$totalSave,'couponAmt'=>$couponAmt);

    }

   
   public function getChildCatInOption($opt_cat_id,$sub_cat_id,$id=''){
      $this->CI->db->select('*');
      $this->CI->db->from('tbl_child_category');
      $this->CI->db->where('cat_id',$top_cat_id);
      $this->CI->db->where('sub_cat_id',$sub_cat_id);
      $this->CI->db->where('status',1);
      $return='<option value="">Select Top Category</option>';
      $query=$this->CI->db->get() ; 
      if($query->num_rows()>0){
        foreach($query->result_array() as $record){
          if($record['child_cat_id']==$id){
            $return.='<option value="'.$record['child_cat_id'].'" selected>'.$record['childCat_name'].'</oprion>';
          }else{
            $return.='<option value="'.$record['child_cat_id'].'">'.$record['childCat_name'].'</oprion>';
          }
        } 
      }
      return $return;
   }
   

  public function menubar(){

      $topcategories=$this->getTopCategory();
      $subcategories=array();
      $childCategories=array();
      $html.='<div class="main-categori-wrap d-none d-lg-block">
                <a id="toggle-categories" class="categories-button-active" href="#"><span class="fi-rs-apps"></span> <span class="et">Shop</span> All Categories<i class="fi-rs-angle-down"></i></a>
                <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                    <div class="categori-dropdown-inner">
                       <div class="row no-gutters">
                           <div class="col-md-4 padding-0">
                               <div class="cat_menu_first">
                                   <ul>';
                        
                           if(isset($topcategories) && count($topcategories)>0) {
                              
                              $subcategories=$this->getSubCategoryByCatId($topcategories[0]['cat_id']);
                             
                              $subCate=json_encode($this->getAllSubCategory());

                             // print_r($subcategories);

                              foreach ($topcategories as $topcategory) {

                                $active = ($key==0) ? 'active':'';
                                
                                $html.='<li class="ct"><a href="'.base_url('shop/'.$topcategory['slug']).'" id="cat-i" class="link-filter  '.$active.'" style="color:white;" onmouseover="onHoverTopCat(this,'.$topcategory['cat_id'].')">'.$topcategory['category'].'</a></li>'; 
                            
                                }
                             }
                           
                           
                       $html.='</ul>
                   </div>
               </div>
               <div class="col-md-4 padding-0">
                   <div class="cat_menu_second">
                       <ul id="sub-cat">';
                             
                             if(isset($subcategories) && count($subcategories)>0){
                                $sn=0;

                                foreach($subcategories as $subcategory) {
                                    $childCategories[]=$this->getChilCategory($subcategory['cat_id'],$subcategory['sub_cat_id']);
                                     $actve= $sn==0 ? 'active':'';
                                     $html.='<li><a href="'.base_url('shop/'.$subcategory['top_cat_slug'].'/'.$subcategory['slug']).'"class="link-filter-sub '.$actve.'" onmouseover="onHoverSubCat(this,'.$subcategory['cat_id'].','.$subcategory['sub_cat_id'].')">'.$subcategory['subCat_name'].'</a></li>';
                                  $sn++;
                                  }
                              }
                           
                      $html.='</ul>
                   </div>
               </div>
               <div class="col-md-4">
                   <div class="cat_menu_third">
                       <ul id="child-cat">';
                          if(isset($childCategories) && count($childCategories)>0 ){
                               foreach ($childCategories[0] as $childCategory) {
                                  $html.='<li><a href="'.base_url('shop/'.$childCategory['top_cat_slug'].'/'.$childCategory['sub_cat_slug']).'/'.$childCategory['slug'].'" id="chi-sub-i" class="link-filter-child">'.$childCategory['childCat_name'].'</a></li>';
                              }
                           }
                        
                       $html.='</ul>
                   </div>
               </div>
           </div>
        </div>
    </div>
    </div>';
return $html;  

  }
  
public function getProductRatingSummary($product_id) {
        $ratings = $this->CI->common_model->getRatingsByProduct($product_id);
        $total_ratings = count($ratings);
        $total_reviews = 0;
        $average_rating = 0;

        if ($total_ratings > 0) {
            foreach ($ratings as $rating) {
                $average_rating += $rating->cust_rate;
                if (!empty($rating->comment)) {
                    $total_reviews++;
                }
            }
            $average_rating = $average_rating / $total_ratings;
        }

        return [
            'average_rating' => $average_rating,
            'total_ratings' => $total_ratings,
            'total_reviews' => $total_reviews
        ];
    }
  

 }

?>