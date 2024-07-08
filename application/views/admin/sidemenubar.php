
<?php defined('BASEPATH') OR exit('No direct script access allowed');



?>
            
        <div class="sidebar px-4 py-4 py-md-4 me-0">
            <div class="d-flex flex-column h-100">
                <a href="<?php echo base_url('admin/dashboard');?>" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <i class="bi bi-bag-check-fill fs-4"></i>
                    </span>
                  

                    <div class="logo">
                       <a href=""><img src="<?php echo base_url()?>include/frontend/assets/imgs/footer-logo.png" alt="img" style="width: 60%;margin-left: auto; margin-right: auto; display: grid;"></a>
                    </div>
                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3" id="sidebar_nav">
                   <li>
                      <a class="m-link active" href="<?php echo base_url('admin/dashboard');?>"><i class="icofont-home"></i> <span>Dashboard</span> </a>
                   </li>
                   <li class="collapsed1">
                      <a class="m-link " data-bs-toggle="collapse" data-bs-target="#menu-Componentsone-32" href="#"><i class="icofont-chart-flow"></i> <span>Categories</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                      <ul class="sub-menu collapse" id="menu-Componentsone-32">
                        <li><a class="ms-link" href="<?php echo base_url('admin/category');?>">Category</a></li>
                        <li><a class="ms-link" href="<?php echo base_url('admin/subcategory');?>">Category With subcategory</a></li>
                        <li><a class="ms-link" href="<?php echo base_url('admin/childcategory');?>">childcategory</a></li>
                      </ul>
                   </li>
                   
                  <li class="collapsed">
                      <a class="m-link " data-bs-toggle="collapse" data-bs-target="#menu-Componentsone-33" href="#"><i class="icofont-chart-flow"></i> <span>Products</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                      <ul class="sub-menu collapse" id="menu-Componentsone-33">
                        <li><a class="ms-link" href="<?php echo base_url('admin/product');?>">Product</a></li>
                        <li><a class="ms-link" href="<?php echo base_url('admin/category-with-prodct');?>">Category With Product</a></li>
                        <li><a class="ms-link" href="<?php echo base_url('admin/productItem');?>">Product Item</a></li>
                      </ul>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/product_order');?>"><i class="icofont-chart-flow"></i> <span>Orders</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/offers');?>"><i class="icofont-chart-flow"></i> <span>Offers</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/coupon');?>"><i class="icofont-chart-flow"></i> <span>Coupons</span> </a>
                   </li>
                    <li>
                      <!-- <a class="m-link " href="./user"><i class="icofont-chart-flow"></i> <span>User</span> </a> -->
                      <li><a class="m-link" href="<?php echo base_url('admin/user_list');?>"'> <i class="icofont-chart-flow"></i> <span>User list</span></a></li>
                   </li>
                   
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/customer_list');?>"><i class="icofont-chart-flow"></i> <span>Customers</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/contact_manager');?>"><i class="icofont-chart-flow"></i> <span>Basic Details</span> </a>
                   </li>
                   <!-- <li>
                      <a class="m-link " href="https://uat.rdfpl.com/admin/hsn_code"><i class="icofont-chart-flow"></i> <span>HSN Code List</span> </a>
                   </li> -->
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/blogs');?>"><i class="icofont-chart-flow"></i> <span>Blog List</span> </a>
                   </li>
                   <li>
                   

                      <a class="m-link " href="<?php echo base_url('admin/terms_conditions');?>"><i class="icofont-chart-flow"></i> <span>Terms and Condition</span> </a>
                   </li>
                   <li>
                      <!-- <a class="m-link " href="https://uat.rdfpl.com/admin/ads_banner"><i class="icofont-chart-flow"></i> <span>Ads Banner List</span> </a> -->

                      <a class="m-link" href="<?php echo base_url('admin/ads_banner'); ?>"><i class="icofont-chart-flow"></i> <span>Ads Banner List</span></a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/shipping-policy')?>"><i class="icofont-chart-flow"></i> <span>Shipping Policy</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/banner')?>"><i class="icofont-chart-flow"></i> <span>Add Banner</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/privacy-policy')?>"><i class="icofont-chart-flow"></i> <span>Privacy Policy</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/refund-and-cancelation-policy')?>"><i class="icofont-chart-flow"></i> <span>Refund &amp; Cancelation Policy</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="https://uat.rdfpl.com/admin/newsletter"><i class="icofont-chart-flow"></i> <span>Newsletter</span> </a>
                   </li>
                   <!-- <li>
                      <a class="m-link " href="https://uat.rdfpl.com/admin/team_manager"><i class="icofont-chart-flow"></i> <span>Teams Manager</span> </a>
                   </li> -->
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/faq')?>"><i class="icofont-chart-flow"></i> <span>FAQ</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/disclaimer')?>"><i class="icofont-chart-flow"></i> <span>Disclaimer</span> </a>
                   </li>
                   <li>
                      <a class="m-link " href="<?php echo base_url('admin/report')?>"><i class="icofont-chart-flow"></i> <span>Reports</span> </a>
                   </li>
                   <!--<li class="collapsed">
                      <a class="m-link " data-bs-toggle="collapse" data-bs-target="#menu-Componentsone-32" href="#"><i class="icofont-chart-flow"></i> <span>Werehouse</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                      <ul class="sub-menu collapse" id="menu-Componentsone-32">
                         <li><a class="ms-link" href="https://uat.rdfpl.com/admin/werehouse_details">Werehouse Details </a></li>
                         <li><a class="ms-link" href="https://uat.rdfpl.com/admin/werehouse">Add Werehouse </a></li>
                         <li><a class="ms-link" href="https://uat.rdfpl.com/admin/pincode">Pincode </a></li>
                      </ul>
                   </li>-->
                   <li>
                      <a class="m-link " href="https://uat.rdfpl.com/admin/other-product"><i class="icofont-chart-flow"></i> <span>Other Product</span> </a>
                   </li>
                </ul>
              
            </div>
        </div>
    <div class="main px-lg-4 px-md-4">


<script>

    var header = document.getElementById("sidebar_nav");  
// console.log('header=>', header);

    var btns = header.getElementsByClassName("m-link"); 
// console.log('btns=>', btns);

// console.log('btns length=>', btns.length);

    for (var i = 0; i < btns.length; i++) {  
// console.log('for loop');

      btns[i].addEventListener("click", function() {  
// console.log('click=>');
          var current = document.getElementsByClassName("active");  
// console.log('current=>', current);

// console.log('current length=>', current.length);


          if (current.length > 0) {   
            console.log('if');
            current[0].className = current[0].className.replace(" active", "");  
          }  
          this.className += " active";  
      });  
    }  

// document.querySelectorAll(".m-link").forEach((ele) =>
//   ele.addEventListener("click", function (event) {
//     event.preventDefault();
//     document
//       .querySelectorAll(".m-link")
//       .forEach((ele) => ele.classList.remove("active"));
//     this.classList.add("active")
//   })
// );
</script>
