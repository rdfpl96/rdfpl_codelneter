<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="dashboard-menu">
   <div class="dashboard_top_heading_menu mt-0">
      <span>Personal Details</span>
   </div>
    <ul class="nav flex-column" role="tablist">
    <li class="nav-item">
       <a class="nav-link <?php echo ($pageType=='account') ? 'active' :'';?>" href="<?php echo base_url('account');?>">Edit Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($pageType=='address' || $pageType=='billing-address' || $pageType=='add-address') ? 'active' :'';?>" href="<?php echo base_url('my-address');?>">Delivery Addresses</a>
    </li>
    <li class="nav-item">
       <a class="nav-link <?php echo ($pageType=='email-addresses') ? 'active' :'';?>"  href="<?php echo base_url('email-addresses');?>">Email Addresses</a>
    </li>
    
   </ul>
   <div class="dashboard_top_heading_menu">
      <span>Shop for</span>
   </div>
    <ul class="nav flex-column" role="tablist">
       <li class="nav-item">
          <a class="nav-link <?php echo ($pageType=='smart-basket') ? 'active' :'';?>" href="<?php echo base_url('smart-basket');?>">Smart Basket</a>
       </li>
       <li class="nav-item">
         <a class="nav-link <?php echo ($pageType=='wishlist') ? 'active' :'';?>" href="<?php echo base_url('wishlist');?>">Shopping List</a>
       </li>
       <li class="nav-item">
          <a class="nav-link <?php echo ($pageType=='my-past-orders') ? 'active' :'';?>" href="<?php echo base_url('my-past-orders');?>">Past Orders</a>
       </li>
    </ul>


   <div class="dashboard_top_heading_menu">
      <span>My Account</span>
   </div>
    <ul class="nav flex-column" role="tablist">    
       <li class="nav-item">
          <a class="nav-link <?php echo ($pageType=='order' || $pageType=='rating-review') ? 'active' :'';?>" href="<?php echo base_url('my-order');?>">My Orders</a>
       </li>
       <!--<li class="nav-item">
          <a class="nav-link <?php echo ($pageType=='wishlist') ? 'active' :'';?>" href="<?php //echo base_url('wishlist');?>">My Wishlist</a>
       </li>-->
       <li class="nav-item">
         <a class="nav-link <?php echo ($pageType=='customer-service') ? 'active' :'';?>" href="<?php echo base_url('customer-service');?>">Customer Service</a>
       </li>
       <!-- <li class="nav-item">
          <a class="nav-link <?php echo ($pageType=='my-wallet') ? 'active' :'';?>" href="<?php echo base_url('my-wallet');?>">My Wallet</a>
       </li> -->
       <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('my-gift-cards');?>">My Gift Cards</a>
       </li>
       <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('my-payments');?>">My Payments</a>
       </li>
       <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('alert-notification');?>">Alert & Notification</a>
       </li>
    </ul>

</div>
