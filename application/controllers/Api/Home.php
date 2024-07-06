<?php
 require APPPATH . 'libraries/RestController.php';
 use chriskacerguis\RestServer\RestController;

class Home extends RestController{   
  protected $heade_user_id;

	public function __construct() {
    parent::__construct();


    $this->load->model('api/product_model','product');
    $this->load->model('common_model','common');
   // //
   //  $headerDetail=$this->input->request_headers();
   // //  
   //  $this->heade_user_id=isset($headerDetail['Userid']) ? $headerDetail['Userid'] : 0 ;
    
  }  
  public function index_get(){

      $data['banes']=$this->common->getSliderbanner();
      $data['mySmartProduct']=$this->product->getOtherProductById(1);
      $data['myFeatureProduct']=$this->product->getOtherProductById(2);
      $data['myNewroduct']=$this->product->getOtherProductById(3);
 
      $this->response([
                'status' => RestController::HTTP_OK,
                'message' => 'Success.',
                'response'=>$data
              ], RestController::HTTP_OK);
     
  }

 
}
?>