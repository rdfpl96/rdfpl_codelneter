
<?php $this->load->view('frontend/header'); ?>
   <main class="main">
   <!-- Modal -->
  
   <div class="container mb-80 mt-30">
      <div class="row">
         <div class="col-lg-9 mb-10">
            <h3 class="heading-2 mb-10">Your Basket</h3>
         </div>
      </div>

      <?php 
      if(isset($products) && count($products) > 0){
         $saveTotalAmt=0;
         $totalItem=0;
         $totalPrice=0;
         foreach ($products as $iproduct) {  

            if($iproduct['before_off_price'] > $iproduct['price']){
               $saveTotalAmt=$saveTotalAmt+(($iproduct['cart_qty']*$iproduct['before_off_price'])-($iproduct['cart_qty']*$iproduct['price']));
            }

            $totalItem=$totalItem+$iproduct['cart_qty'];

            $totalPrice=$totalPrice+$iproduct['price'];

         }

      ?>
      <div class="cart_head">
         <div class="row">
            <div class="col-lg-10">
               <div class="cart_head_left">
                  <div class="heading_s1"> Subtotal (<span class="total-items"><?php echo count($products);?></span> items) <span> ₹ <span class="final-amount" id="tot_amount"><?php echo $totalPrice;?></span></span></div>
                  <div class="subheading">Savings: <b>₹ <?php echo $saveTotalAmt;?></b></div>
               </div>
            </div>
            <div class="col-lg-2 d-flex justify-content-center align-items-center">
               <a href="<?php echo base_url('checkout');?>" class="btn head_checkout_btn">CheckOut</a>
               <!-- <div class="btn head_checkout_btn">Checkout</div> -->
            </div>
         </div>
      </div>
      <div class="row mt-30">
         <div class="col-lg-12">
           
            <div class="main_basket_sec">
               <div class="main_basket_header">
                  <div class="row">
                     <div class="col-md-7">
                        <h3>Items  (<?php echo count($products);?> items)</h3>
                     </div>
                     <div class="col-md-3 text-center">
                        <h3>Quantity</h3>
                     </div>
                     <div class="col-md-2 text-right">
                        <h3>Sub-total</h3>
                     </div>
                  </div>
               </div>
               
                 
                  <?php  foreach ($products as $product) {  

                        if($product['before_off_price'] > $product['price']){
                           $saveAmt=($product['cart_qty']*$product['before_off_price'])-($product['cart_qty']*$product['price']);
                        }else{
                           $saveAmt=0;
                        }
                        
                     ?>
                     <div class="main_basket_product_sec mt-3">
                     <a href="" data-bs-toggle="modal" data-bs-target="#offer_modal">
                     <div class="main_basket_product_sec_offer_header">
                        <h3>Get it for ₹85.50! &nbsp;<span class="material-symbols-outlined fw-bold">expand_more</span></h3>
                     </div>
                     </a> 
                     <div class="main_basket_product_inner_sec">
                           <div class="row">
                              <div class="col-md-7">
                                 <div class="basket_offer_product_img_name">
                                    <img src="<?php echo base_url('uploads/'.$product['feature_img']);?>">
                                    <div class="basket_offer_product_name">
                                       <p class="text-muted"><?php echo stripslashes($product['product_name'])?></p>
                                       <h4>₹<?php echo stripslashes($product['price'])?> <span><strike> ₹<?php echo stripslashes($product['before_off_price'])?></strike></span></h4>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3 text-center d-flex align-items-end">
                                 <div class="main_basket_product_quantity_btn">
                                    <div class="detail-extralink">
                                       <div class="quantity-controls w-100 hover-up width100 common-button">
                                          <button class="quantity-decrease"><span class="material-symbols-outlined">remove</span></button>
                                          <input type="text" class="quantity-input" value="<?php echo $product['cart_qty']?>">
                                          <button class="quantity-increase"><span class="material-symbols-outlined">add</span></button>
                                       </div>
                                       <div class="basket_offer_product_delete mt-20">
                                          <p><a href="javascript:void();" onclick="deleteItem(<?php echo $product['cart_id']?>);">Delete</a> | <a href="javascript:void(0);" onclick="saveToLater(<?php echo $product['cart_id']?>);">Save for later</a></p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-2 text-right d-flex justify-content-end align-items-end">
                                 <div class="main_basket_product_price">
                                    <h3>₹<?php echo ($product['cart_qty']*$product['price']);?></h3>
                                    <p class="text-success">Saved: ₹ <?php echo $saveAmt;?></p>
                                 </div>
                              </div>
                           </div>
                     </div>
                   </div>   
                  <?php  }?>
              
            </div>
         </div>
      </div>  

   <?php } else{ ?>
      <div class="alert alert-warning">
       <strong>Warning!</strong> You should <a href="#" class="alert-link">Cart is empty</a>.
     </div>
   <?php } ?>   

     
      <div class="row mt-60 cart_products">
          <?php if(count($saveProducts)>0) { ?>
            <div class="col-12">
               <h3 class="mb-30 pt-30">Save For Later</h3>
            </div>
            <div class="co-12">
               <div class="row related-products">
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <?php echo  $this->load->view("frontend/component/productItem",array('productItems'=>$saveProducts),true);?>
               </div>
            </div>
            <div class="custom_hr"></div>
            <?php  } ?>

            <div class="col-12">
               <h3 class="mb-30 pt-30">Before you checkout</h3>
            </div>
            <div class="co-12">
               <div class="row related-products">
                  <!-- <div class="col-lg-3 col-md-4 col-12 col-sm-6"> -->
                  <?php echo  $this->load->view("frontend/component/productItem",array('productItems'=>$beforeCheckProducts),true);?>
               </div>
            </div>

      </div>
   </div>
</main>

<?php $this->load->view('frontend/footer'); ?>
