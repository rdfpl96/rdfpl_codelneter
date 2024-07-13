<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Home extends REST_Controller{   
  protected $heade_user_id;

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
  public function index_get(){

      $data['baners']=$this->common->getSliderbanner();
      $data['mySmartProduct']=$this->product->getOtherProductById(1);
      $data['myFeatureProduct']=$this->product->getOtherProductById(2);
      $data['myNewroduct']=$this->product->getOtherProductById(3);

      $data['shopByCategory']=$this->product->getTopCategory();

      $this->response(array('error' =>0,'msg'=>'Success',"data"=>$data)); 
     
  }

 
}
?>