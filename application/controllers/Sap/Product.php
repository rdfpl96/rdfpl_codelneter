<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

   function __construct(){
        parent::__construct();
        $this->load->model('admin/product_model','productObj');
        $this->load->model('cart_model','cartObj');     
   }
      



public function getAllProductItems(){
   
  
    $products=$this->sapservice->getProductItemList();
     
    //  echo'<pre>';
    //  print_r($products);
    //   echo'<pre>';
    //  exit();
    
    if(is_array($products) && count($products)>0){
        foreach ($products as $product){
           $productId=$this->productObj->getProductIdByName($product['ProductName']);
            if($productId){

            }else{
               $slug=generateSlugByName($product['ProductName']);
               $productsArray=array('product_name'=>trim($product['ProductName']),'slug'=>$slug,'status'=>1);
               //
               $productId=$this->productObj->add($productsArray); 
            }

            $stock=$this->getSingleStock($product['ItemCode']);

            $itemArray=array(
                'variants_product_id'=>$productId,
                'ItemName'=>$product['ItemName'],
                'location_code'=>$product['LocationCode'],
                'before_off_price'=>$product['MRP'],
                'price'=>$product['NetPrice'],
                'pack_size'=>$product['PackageSize'],
                'units'=>$product['Units'],
                'stock'=>$stock,
                'is_new_item'=>0
            );
           
            if($this->productObj->checkItemCodeExist($product['ItemCode'])){
                $productId=$this->productObj->updateItemDetailByItecode($itemArray,$product['ItemCode']);
            }else{
                $itemArray['item_code']=$product['ItemCode'];
                $itemArray['is_new_item']=1;
                $productId=$this->productObj->insertItemDetail($itemArray);
            }
            
        }

    }
}
//
//
//
public function getSingleProductItem(){

    $item_code="FG000018";
    $products=$this->sapservice->getProductItem($item_code);
    //  echo count($products);
    //  echo'<pre>';
    //  print_r($products);
    //   echo'<pre>';
    //  exit();

}

public function getAllStock(){
    
    $products=$this->sapservice->getStockList();
        if(is_array($products) && count($products)>0){
        foreach($products as $product){
            $itemArray=array('stock'=>$product['InStock']);
            if($this->productObj->checkItemCodeExist($product['ItemCode'])){
                $this->productObj->updateItemDetailByItecode($itemArray,$product['ItemCode']);
            }
        }
    }
   

}

public function getSingleStock($item_code){
   
    $itemsStock=$this->sapservice->getSingleStock($item_code);
     
    //  echo'<pre>';
    //  print_r($itemsStock);
    //   echo'<pre>';
    //  exit();
    if(is_array($products) && count($products)>0){
        $return=(int)$itemsStock[0]['InStock'];
    }else{
        $return=0;
    }
    return $return;
    
}



 

}
?>