<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
 
class CustomerAddress extends REST_Controller{

    public function __construct() {
    parent::__construct();
    
    $this->load->model('api/Address_model','addObj');
    
    
    $validation=$this->authorization_token->validateToken();
    
    // if($validation['status']!=0){

    //     $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
    //     echo json_encode($res);
    //     exit();
    //     }

    }

    public function index_get(){
       
        $customer_id=$this->authorization_token->userData()->customer_id;
        
        $address = $this->addObj->getAddressList($customer_id);
        
        $this->response(array('error' =>0,'msg'=>'Success',"data"=>array('addresses'=>$address)));
    }  
  
    public function save_post(){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);

        //print_r($post);

        $fname=isset($post['fname']) ? $post['fname'] : "" ; 
        $lname=isset($post['lname']) ? $post['lname'] : "" ;
        $mobile=isset($post['mobile']) ? $post['mobile'] : "" ;
        $apart_house=isset($post['apart_house']) ? $post['apart_house'] : "" ;
        $apart_name=isset($post['apart_name']) ? $post['apart_name'] : "" ;
        $area=isset($post['area']) ? $post['area'] : "" ;
        $street_landmark=isset($post['street_landmark']) ? $post['street_landmark'] : "" ;
        $state=isset($post['state']) ? $post['state'] : "" ;
        $city=isset($post['city']) ? $post['city'] : "" ;
        $pincode=isset($post['pincode']) ? $post['pincode'] : "" ;
        $loc_type=isset($post['address_type']) ? $post['address_type'] : "" ;
        $other_loc=isset($post['other_loc']) ? $post['other_loc'] : "" ;                      
        
        if($fname!="" && $mobile!="" && $apart_house!="" && $apart_name!="" && $state!="" && $city!="" && $pincode!="" && $loc_type!=""){
            
            $array_data=array(
                "customer_id"=>$customer_id,
                "fname"=>$fname,
                "lname"=>$lname,
                "mobile"=>$mobile,
                "address1"=>$apart_house,
                "address2"=>$apart_name,
                "area"=>$area,
                "state_id"=>$state,
                "city"=>$city,
                "pincode"=>$pincode,
                "address_type"=>$loc_type,
                "other_loc"=>$other_loc,
            );  
            if(!$this->addObj->chkAlreadyAdressExist($customer_id,$apart_house,$pincode)){

                if($this->addObj->addressSave($array_data)){

                    $this->response(array('error' =>0,'msg'=>'Success')); 

                }else{
                    $this->response(array('error' =>1,'msg'=>'Problem to add the address')); 
                }

            }else{
                $this->response(array('error' =>1,'msg'=>'Address already exsit'));     
            }

        }else{

            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));   
        }
    }

    public function update_post(){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);

        //print_r($post);
        $address_id=isset($post['address_id']) ? $post['address_id'] : "" ; 

        $fname=isset($post['fname']) ? $post['fname'] : "" ; 
        $lname=isset($post['lname']) ? $post['lname'] : "" ;
        $mobile=isset($post['mobile']) ? $post['mobile'] : "" ;
        $apart_house=isset($post['apart_house']) ? $post['apart_house'] : "" ;
        $apart_name=isset($post['apart_name']) ? $post['apart_name'] : "" ;
        $area=isset($post['area']) ? $post['area'] : "" ;
        $street_landmark=isset($post['street_landmark']) ? $post['street_landmark'] : "" ;
        $state=isset($post['state']) ? $post['state'] : "" ;
        $city=isset($post['city']) ? $post['city'] : "" ;
        $pincode=isset($post['pincode']) ? $post['pincode'] : "" ;
        $loc_type=isset($post['address_type']) ? $post['address_type'] : "" ;
        $other_loc=isset($post['other_loc']) ? $post['other_loc'] : "" ;                      
        
        if($fname!="" && $mobile!="" && $apart_house!="" && $apart_name!="" && $state!="" && $city!="" && $pincode!="" && $loc_type!=""){
            
            $array_data=array(
                "fname"=>$fname,
                "lname"=>$lname,
                "mobile"=>$mobile,
                "address1"=>$apart_house,
                "address2"=>$apart_name,
                "area"=>$area,
                "state_id"=>$state,
                "city"=>$city,
                "pincode"=>$pincode,
                "address_type"=>$loc_type,
                "other_loc"=>$other_loc,
            );  
            if(!$this->addObj->chkAlreadyAdressExist($customer_id,$apart_house,$pincode,$address_id)){

                if($this->addObj->addressUpdate($address_id,$array_data)){

                    $this->response(array('error' =>0,'msg'=>'Success')); 

                }else{
                    $this->response(array('error' =>1,'msg'=>'Problem to add the address')); 
                }

            }else{
                $this->response(array('error' =>1,'msg'=>'Address already exsit'));     
            }

        }else{

            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));   
        }
    }

    public function setdefault_post(){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);

        $address_id=isset($post['address_id']) ? $post['address_id'] : 0 ; 

        if($address_id!=0){

            $this->addObj->setDefaultAddressByCust($address_id,$customer_id); 
           
           $this->response(array('error'=>0,'msg'=>'Success'));   

        }else{
            $this->response(array('error' =>1,'msg'=>'Some parameter missing'));   
        }
    }

    public function  saveGst_post(){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);
        $error=0;
        $nv = array(
           
            'customer_id'           => $customer_id,
            'registration_no'       => isset($post['registration_no'])       && $post['registration_no'] != ''               ? addslashes($post['registration_no'])            :  "",
            'company_name'          => isset($post['company_name'])          && $post['company_name'] != ''                  ? addslashes($post['company_name'])               :  "",
            'company_address'       => isset($post['company_address'])       && $post['company_address'] != ''               ? addslashes($post['company_address'])            :  "",
            'pincode'              => isset($post['pincode'])                && $post['pincode'] != ''                       ? addslashes($post['pincode'])                    :  "",
            'fssai_no'              => isset($post['fssai_no'])              && $post['fssai_no'] != ''                      ? addslashes($post['fssai_no'])                   :  "",
            'mobile'              => isset($post['mobile'])              && $post['mobile'] != ''                      ? addslashes($post['mobile'])                   :  "",
            'email_id'              => isset($post['email_id'])              && $post['email_id'] != ''                      ? addslashes($post['email_id'])                   :  "",
         );

         if($nv['registration_no'] == ''){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Please enter registration no.')); 
         }
         else if($this->addObj->isGstNumberUnigue($nv['registration_no'])){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Gst number already present')); 
         }
        else if($nv['company_name'] == ''){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Please enter company name')); 
         }
         else if(!preg_match('/^[\p{L} ]+$/u', $nv['company_name'])){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Name must contain letters and spaces only')); 
         }
         else if ($nv['company_address'] == ''){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Name must contain letters and spaces only')); 
         }
         else if($nv['pincode']==''){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Please enter pincode')); 
         }
         else if($nv['pincode']!= '' && strlen($nv['pincode'])!=6){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Pincod must have 6 digits')); 
          }

        else if($nv['fssai_no'] == ''){
            $error=1;
            $this->response(array('error' =>1,'msg'=>'Please enter fssai no')); 
        }else{
             if($this->addObj->chkGSTPresent($customer_id)){

                $this->addObj->updateCustomerGst($nv);
                $error=0;
                $msg="GST detail save";

            }else{

                $this->addObj->saveCustomerGst($nv);
                $msg="GST detail save";
            }

            $this->response(array('error' =>0,'msg'=>$msg)); 
        }
    }
    public function sloteList_get(){

       
        $slots=$this->addObj->getAllSlot();

        $this->response(array('error' =>0,'msg'=>'Success',"data"=>$slots));

    }


    public function getStatelist_get(){

       
        $slots=$this->addObj->getStateList();

        $this->response(array('error' =>0,'msg'=>'Success',"data"=>$slots));

    }

}

?>