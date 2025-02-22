<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

   function __construct(){
        parent::__construct();

          $this->load->model('home_model','home');
          $this->load->model('admin/user_model');
          $this->load->model('product_model', 'productObj');
   }
      



  public function index(){

   
     $userCookies=getCookies('customer');

      //$cartItems= $this->cart->contents();

     // $this->customlibrary->upDateCartAfterLogin($cartItems,120);

      //$data['category_list']=$this->sqlQuery_model->sql_query("SELECT * FROM tbl_category WHERE  status=1 ORDER BY position DESC");

      $smartBasketProdct=$this->home->getProductType(1);
      $data['smartBasketProdctHtml']= $this->load->view('frontend/component/productItem', array("productItems"=>$smartBasketProdct), TRUE);
      $data['featureProdct']=$this->home->getProductType(2);
      $data['Newproduct']=$this->home->getProductType(3);
      $data['topsellingProduct']=$this->home->getTopSellingProduct();
      $data['dailyStaples']=$this->home->getProductType(4);
      $data['Beverage']=$this->home->getProductType(5);
      $data['SnacksStore']=$this->home->getProductType(6);
      // $data['newProduct']=$this->home->getNewProduct();

      $data['getmaxvalueoffers']=$this->home->getTopSellingProduct();
      $data['sliders']=$this->home->getSliderbanner();

     

   $this->load->view("frontend/index",$data);
  }
}