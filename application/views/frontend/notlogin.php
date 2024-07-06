<?php $this->load->view('frontend/header'); ?>
<main class="main">
   <!-- Modal -->
   <div class="container mb-80 mt-30">
      
      <div class="cart_head">
         <div class="row">
            <div class="col-lg-10">
               <div class="cart_head_left">
                  <div class="heading_s1"> You are not Login.Please login</div>
                 
               </div>
            </div>
            <div class="col-lg-2 d-flex justify-content-center align-items-center">
               <a href="javascript:void(0);" class="btn head_checkout_btn" data-bs-toggle="modal" data-bs-target="#login-modal-user">Login/Sign Up
         </a>
               <!-- <div class="btn head_checkout_btn">Checkout</div> -->
            </div>
         </div>
      </div>
     
   </div>
</main>



<?php $this->load->view('frontend/footer'); ?>