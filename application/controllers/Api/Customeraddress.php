<?php
require(APPPATH.'/libraries/REST_Controller.php');
 
 
class CustomerAddress extends REST_Controller{

    public function __construct() {
    parent::__construct();
    
    $this->load->model('api/Address_model','addObj');
    
    
    $validation=$this->authorization_token->validateToken();
    
    if($validation['status']!=0){

        $res=array("error"=>$validation['status'],'msg'=>$validation['message']);
        
        echo json_encode($res);
        exit();
        }

    }

    public function index_get(){
       
        $customer_id=$this->authorization_token->userData()->customer_id;
        
        $address = $this->addObj->getAddressList($customer_id);
        
        $this->response(array('error' =>0,'msg'=>'Success',"data"=>array('addresses'=>$address)));
    }  
  
    public function save_post(){

        $customer_id=$this->authorization_token->userData()->customer_id;

        $post = json_decode($this->input->raw_input_stream, true);

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
        $loc_type=isset($post['loc_type']) ? $post['loc_type'] : "" ;
        $other_loc=isset($post['other_loc']) ? $post['other_loc'] : "" ;                      
        
        if($fname!="" && $mobile!="" && $apart_house!="" && $apart_name!="" && $state!="" && $city!="" && $pincode!="" && $loc_type!=""){
            
            $array_data=array(
                "fname"=>$fname,
                "lname"=>$lname,
                "mobile"=>$mobile,
                "apart_house"=>$apart_house,
                "apart_name"=>$apart_name,
                "area"=>$area,
                "state"=>$state,
                "city"=>$city,
                "pincode"=>$pincode,
                "loc_type"=>$loc_type,
                "other_loc"=>$other_loc,
            );  
            if($this->addObj->chkAlreadyAdressExist($customer_id,$apart_house,$pincode)){

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

}

?>