


<?php  

  if(isset($products) && count($products)>0){ ?>

    <ul class="search-results" id="searchResults" style="display: block;">

    <?php    

    foreach($products as $product){
        
        $filePath='./uploads/'.$product['feature_img'];

        if(file_exists($filePath)){
           $imgFile=base_url().'uploads/'.$product['feature_img'];
        }else{
          $imgFile=base_url().'include/assets/default_product_image.png';
        }

        $items=$this->customlibrary->getProductItemByproductId($product['product_id']);



        foreach($items as $item){  ?>   
            <li>
               <div class="list_sec">
                  <div class="search_img"><a href="<?php echo base_url('product/'.$product['product_slug'])?>">
                    <img src="<?php echo $imgFile;?>"></a>
                </div>
                  <div class="cat_prod">
                     <p><?php echo $product['top_cat_name']?> <span style="font-weight: bold;color:black;">| </span><?php echo $product['sub_cat_name']?></p>
                     <h4><a href="<?php echo base_url('product/'.$product['product_slug'])?>"><?php echo stripslashes($product['product_name']);?></a></h4>
                  </div>
                  <div class="weight">
                     <p><?php echo isset($items[0]['pack_size']) ? $items[0]['pack_size'].''.$items[0]['units'] : "" ;?></p>
                  </div>
                  <div class="price">
                     <h4>₹<?php echo $item['price'];?></h4>
                  </div>
               </div>
               <div class="add_btn">
                  <?php if(isset($item['stock']) && $item['stock'] > 0){ ?>
                     <button class="btn w-100  hover-up add-to-cart-button" onclick="addToCartFromSearchBar(<?php echo $product['product_id'] ?>,<?php echo $item['variant_id'];?>);">Add</button>
                  <?php } else{  ?>
                         <button class="btn w-100  hover-up add-to-cart-button">Out of stock</button>
                  <?php }?>
                 
               </div>
            </li>


     <?php
        }

    }
   }
?>

</ul>