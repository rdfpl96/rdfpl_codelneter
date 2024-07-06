<?php
 require APPPATH . 'libraries/RestController.php';
 use chriskacerguis\RestServer\RestController;
 
class Product extends RestController{   
  protected $heade_user_id;

  public function __construct() {
    parent::__construct();


    $this->load->library('my_libraries');
    $this->load->model('api/product_model','product');
    $this->load->model('common_model','common');
   // //
   //  $headerDetail=$this->input->request_headers();
   // //  
   //  $this->heade_user_id=isset($headerDetail['Userid']) ? $headerDetail['Userid'] : 0 ;
    
  }  
  public function index_get(){

      $getList=$this->my_libraries->getAllCategoryWithChile();
     
      $this->response([
                'status' => RestController::HTTP_OK,
                'message' => 'Success.',
                'response'=>$getList
              ], RestController::HTTP_OK);
  }

  public function productListBySubCatId_post(){
    
    $per_page=$this->input->get('per_page');
    $limit_per_page=$this->input->get('limit_per_page');

    $post = json_decode($this->input->raw_input_stream, true);

    $sub_cat_id = trim($post['sub_cat_id']);

    if (!preg_match('/^[0-9]*$/', $per_page)) {
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Per Page should be integer'
        ], RestController::HTTP_BAD_REQUEST);
    } 
    else if(!preg_match('/^[0-9]*$/', $limit_per_page)) {
       $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Limit per page should be integer'
        ], RestController::HTTP_BAD_REQUEST);
    }

    else if($sub_cat_id=='') {
        $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Pass sub cat id'
        ], RestController::HTTP_BAD_REQUEST);
    }
    else if(!preg_match('/^[0-9]*$/', $sub_cat_id)) {
       $this->response([
            'status' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Sub category id should be integer'
        ], RestController::HTTP_BAD_REQUEST);
    }else{

      $products=$this->product->getProdcutListBySubcategory($per_page,$limit_per_page,$sub_cat_id);
      
      $this->response([
        'status' => RestController::HTTP_OK,
        'message' => 'Success',
        'response'=>$products
      ], RestController::HTTP_OK);
    }

  }

}

?>