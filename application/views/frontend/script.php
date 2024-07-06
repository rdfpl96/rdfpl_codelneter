<?php //$this->load->view('frontend/containerPage/mobile_number_update_modal');?>
<?php //$this->load->view('frontend/containerPage/email_alert_mess_modal');?>


<script type="text/javascript" id="zsiqchat">var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || {widgetcode: "siq514e714aa666fb6a2cb411eacf19c78b82a28e07e80aebb3a97b8f09d8731470", values:{},ready:function(){}};var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;s.src="https://salesiq.zohopublic.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);</script>

  



 <!-- =============location ================ -->
 <script type="text/javascript">
  const toggleButton = document.getElementById('drop_location');
  const myDiv = document.getElementById('location_details');
  const searchInput = document.querySelector('.location_search_box input');
  const locationList = document.querySelector('.location_list');
 
  toggleButton.addEventListener('click', function (event) {
    myDiv.classList.toggle('open');
    event.stopPropagation();
  });
 
  // Function to show the location list when non-zero keywords are found
  function showMatchingLocations() {
    const searchTerm = searchInput.value.trim().toLowerCase();
 
    // Check if the search term is empty or contains only "0" and hide the list in those cases
    if (searchTerm === "" || searchTerm === "0") {
      locationList.style.display = 'none';
      return;
    }
 
    const locations = locationList.querySelectorAll('li');
 
    let found = false;
 
    locations.forEach((location) => {
      const locationName = location.textContent.toLowerCase();
      if (locationName.includes(searchTerm)) {
        location.style.display = 'block';
        found = true;
      } else {
        location.style.display = 'none';
      }
    });
 
    // Show or hide the location list container based on whether non-zero keywords are found
    if (found) {
      locationList.style.display = 'block';
    } else {
      locationList.style.display = 'none';
    }
  }
  // Add an input event listener to the search box
  searchInput.addEventListener('input', showMatchingLocations);
 
  document.body.addEventListener('click', function (event) {
    if (!myDiv.contains(event.target)) {
      myDiv.classList.remove('open');
    }
  });
</script>


 <!-- =================star rating start=========== -->
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
  const stars = document.querySelectorAll('.star');
  const ratingContainer = document.querySelector('.star-rating');

  stars.forEach((star) => {
    star.addEventListener('click', () => {
      const index = star.dataset.index;
      ratingContainer.setAttribute('data-rating', index);
      updateRating();
    });

    star.addEventListener('mouseover', () => {
      const index = star.dataset.index;
      highlightStars(index);
    });

    star.addEventListener('mouseout', () => {
      resetStars();
    });
  });

  function highlightStars(index) {
    stars.forEach((star) => {
      if (star.dataset.index <= index) {
        star.classList.add('active');
      } else {
        star.classList.remove('active');
      }
    });
  }

  function resetStars() {
    stars.forEach((star) => {
      star.classList.remove('active');
    });

    const currentRating = ratingContainer.dataset.rating;
    highlightStars(currentRating);
  }

  function updateRating() {
    const currentRating = ratingContainer.dataset.rating;
    // console.log('Selected rating:', currentRating);
    // You can perform additional actions here, such as submitting the rating to a server.
  }
});

</script>
 <!-- =====================star rating end================ -->

   <!-- Vendor JS-->
     <script type="text/javascript">
     
    // // JavaScript to handle the "Add to Cart" button click
    // var addToCartButtons = document.querySelectorAll(".add-to-cart-button");
    // addToCartButtons.forEach(function (button) {

    //     button.addEventListener("click", function () {
    //         button.style.display = "none";
    //         button.nextElementSibling.style.display = "inline-flex";
    //     });
    // });

    // // JavaScript to handle quantity increase
    // var quantityIncreaseButtons = document.querySelectorAll(".quantity-increase");
    // quantityIncreaseButtons.forEach(function (button) {
    //     button.addEventListener("click", function () {
    //         var quantityInput = button.parentElement.querySelector(".quantity-input");
    //         var currentQuantity = parseInt(quantityInput.value);
    //         if (!isNaN(currentQuantity)) {
    //             quantityInput.value = currentQuantity + 1;
    //         }
    //     });
    // });

    // // JavaScript to handle quantity decrease
    // var quantityDecreaseButtons = document.querySelectorAll(".quantity-decrease");
    // quantityDecreaseButtons.forEach(function (button) {
    //     button.addEventListener("click", function () {
    //         var quantityInput = button.parentElement.querySelector(".quantity-input");
    //         var currentQuantity = parseInt(quantityInput.value);
    //         if (!isNaN(currentQuantity) && currentQuantity > 1) {
    //             quantityInput.value = currentQuantity - 1;
    //         } else if (currentQuantity <= 1) {
    //             button.parentElement.previousElementSibling.style.display = "block";
    //             button.parentElement.style.display = "none";
    //         }
    //     });
    // });
</script>


 <script type="text/javascript">
        const inputs = document.querySelectorAll(".otp-field > input");
        const button = document.querySelector(".btn");

        window.addEventListener("load", () => inputs[0].focus());
        // button.setAttribute("disabled", "disabled");

        inputs[0].addEventListener("paste", function (event) {
          event.preventDefault();

          const pastedValue = (event.clipboardData || window.clipboardData).getData(
            "text"
          );
          const otpLength = inputs.length;

          for (let i = 0; i < otpLength; i++) {
            if (i < pastedValue.length) {
              inputs[i].value = pastedValue[i];
              inputs[i].removeAttribute("disabled");
              inputs[i].focus;
            } else {
              inputs[i].value = ""; // Clear any remaining inputs
              inputs[i].focus;
            }
          }
        });

        inputs.forEach((input, index1) => {
          input.addEventListener("keyup", (e) => {
            const currentInput = input;
            const nextInput = input.nextElementSibling;
            const prevInput = input.previousElementSibling;

            if (currentInput.value.length > 1) {
              currentInput.value = "";
              return;
            }

            if (
              nextInput &&
              nextInput.hasAttribute("disabled") &&
              currentInput.value !== ""
            ) {
              nextInput.removeAttribute("disabled");
              nextInput.focus();
            }

            if (e.key === "Backspace") {
              inputs.forEach((input, index2) => {
                if (index1 <= index2 && prevInput) {
                  input.setAttribute("disabled", true);
                  input.value = "";
                  prevInput.focus();
                }
              });
            }

            button.classList.remove("active");
            // button.setAttribute("disabled", "disabled");

            const inputsNo = inputs.length;
            if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
              button.classList.add("active");
              button.removeAttribute("disabled");

              return;
            }
          });
        });
    </script>




    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="<?php echo base_url();?>include/frontend/assets/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/slick.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.syotimer.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/waypoints.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/wow.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/perfect-scrollbar.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/magnific-popup.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/select2.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/counterup.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.countdown.min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/images-loaded.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/isotope.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/scrollup.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.vticker-min.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.theia.sticky.js"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/plugins/jquery.elevatezoom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Template  JS -->
<script src="<?php echo base_url();?>include/frontend/assets/js/main2cc5.js?v=5.6"></script>
<script src="<?php echo base_url();?>include/frontend/assets/js/shop2cc5.js?v=5.6"></script>
 
    <script src="<?php echo base_url();?>include/frontend/assets/frontend_ajax.js"></script>
 
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>


       

 <script type="text/javascript">


  </script>

  <?php

if($customer!="" && $customer!=array()){ 
   $mobilenumber = $this->my_libraries->getCustomer_mobile($customer[0]->customer_id);

 if(empty($mobilenumber) && $mobilenumber==""){
  ?>
   <script type="text/javascript">
    $(document).ready(function () {
      $('#varify-mobile').modal('show');
    });
  </script>
     <?php }  ?>





<?php } ?>


  <?php 
     $defaultShipping_=$this->sqlQuery_model->sql_select_where('tbl_address',array('status'=>1,'customer_id'=>$customer[0]->customer_id,'setAddressDefault'=>1)); 
      $pincodeCheck_ = $this->my_libraries->checkCartShippingPincode($defaultShipping_[0]->pincode);

     if($customer!="" && $customer!=array()){ 
       if($pincodeCheck_==array()){
      ?>
         <script type="text/javascript">
          $(document).ready(function(){
             $('#cart-modal-show').modal('show');
          // $('.paym-css').remove();
          })
        </script>
 <?php } }  ?>



   
<?php if($activeScroll=='yes'){ ?>
    <script type="text/javascript">
      $(document).ready(function(){

        $(window).on('scroll',function(){
            var lastId = $('.loader_id').attr('id');
           // console.log($(window).scrollTop());
           // console.log('--------------------------');
           // console.log($(document).height() - $(window).height());
         // $(document).height() - $(window).height()
            if(($(window).scrollTop() >= 900) || (lastId != 0)){
               load_more_data(lastId);
            }
        });
        function load_more_data(lastId){
     
            $.ajax({
                    type:'POST',
                    url:base_url+'ajax_frontend/recently_view_product',
                    dataType:'JSON',
                    data:{last_id:lastId},
                    success:function(data){
                        // console.log(data);  
                    }
                });
        }
    });

    </script>

    <?php } ?>

   <script>
      function checkDileveryaddrActive(){

          $.ajax({
              url:base_url+'ajax_frontend/checkActiveAddress',
              type:'POST',
              dataType:'JSON',
              success:function(data){
                 if(data.status==0){
                   $('.paym-css').html('<a href="javascript:void(0);" class="btn mb-20 w-100 disabled">Payment</a>');
                 }else{
                   $('.paym-css').html('<a href="javascript:void(0);" class="btn mb-20 w-100 payment-mode">Payment</a>');
                 }
              }
            });

      }



      $(document).on('click','.change-addrs',function(){
      
          sessionStorage.setItem("stepActive", 2);
          $('#step2').addClass('active');
          $('#formStep2').addClass('active');
          $('#formStep2').removeClass('inactive');
          
          $('#step1').removeClass('active');
          $('#formStep1').removeClass('active');
          $('#formStep1').removeClass('inactive');

          $('#step3').removeClass('active');
          $('#formStep3').removeClass('active');
          $('#formStep3').removeClass('inactive');
          checkDileveryaddrActive();
          // location.reload();
      })

       $(document).on('click','.go-to-preview',function(){

          sessionStorage.setItem("stepActive", 1);
          $('#step1').addClass('active');
          $('#formStep1').addClass('active');
          $('#formStep1').removeClass('inactive');
          
          $('#step2').removeClass('active');
          $('#formStep2').removeClass('active');
          $('#formStep2').removeClass('inactive');

          $('#step3').removeClass('active');
          $('#formStep3').removeClass('active');
          $('#formStep3').removeClass('inactive');
          $('.paym-css').html('<a href="javascript:void(0);" class="btn mb-20 w-100 change-addrs">Select Your delivery Address</a>');
           // location.reload();
          // $('.paym-css').text('Select Your delivery Address');
      })


   $(document).on('click','.payment-mode',function(){

          <?php
           
           if($customer!="" && $customer!=array()){ 
           $getEmailId= $this->my_libraries->getCustomer_email($customer[0]->customer_id);
        
            if($getEmailId==""){ ?>
                $('#emailAlertModal').modal('show');
           <?php }else{
          ?>
              sessionStorage.setItem("stepActive", 3);
              $('#step1').removeClass('active');
              $('#formStep1').removeClass('active');
              $('#formStep1').removeClass('inactive');
              
              $('#step2').removeClass('active');
              $('#formStep2').removeClass('active');
              $('#formStep2').removeClass('inactive');

              $('#step3').addClass('active');
              $('#formStep3').addClass('active');
              $('#formStep3').removeClass('inactive');
             
              $('.paym-css').remove();
              location.reload();

         <?php } ?>

     <?php } ?>

   })
     
    </script>


   <script>
    // JavaScript to toggle the backdrop and dropdown
    var toggleCategories = document.getElementById('toggle-categories');
    var backdrop = document.getElementById('backdrop2');
    var dropdown = document.querySelector('.categories-dropdown-wrap');
    var body = document.body;
 
    function showDropdown() {
        backdrop.style.display = 'block';
        dropdown.style.display = 'block';
        body.style.overflow = 'hidden'; // Disable scrolling in the entire body
    }
 
    function hideDropdown() {
        backdrop.style.display = 'none';
        dropdown.style.display = 'none';
        body.style.overflow = ''; // Enable scrolling in the entire body
    }
 
    toggleCategories.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevents the click event from propagating to document
        showDropdown();
    });
 
    document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target) && !toggleCategories.contains(e.target)) {
            hideDropdown();
        }
    });
 
    dropdown.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevents the click event from propagating to document
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
      // Hide all subcategories and sub-subcategories initially
      var nestedLists = document.querySelectorAll('.subcategory-list, .sub-subcategory-list');
      nestedLists.forEach(function(list) {
        list.style.display = 'none';
      });
 
      function toggleList(element) {
        var nestedList = element.nextElementSibling;
        if (nestedList) {
          nestedList.style.display = nestedList.style.display === 'none' ? 'block' : 'none';
          element.parentElement.classList.toggle('expanded');
        }
      }
 
      // Add click event listeners to categories and subcategories
      var links = document.querySelectorAll('.category-list a, .subcategory-list a, .sub-subcategory-list a');
      links.forEach(function(link) {
        link.addEventListener('click', function() {
          toggleList(this);
        });
      });
    });
</script>




 


<script>
    // function showResults() {
    //     const resultsContainer = document.getElementById('searchResults');
    //     const searchInput = document.getElementById('searchInput');
    //     const categoriesDropdown = document.querySelector('.categories-dropdown-wrap');
    //     const backdrop = document.getElementById('backdrop2');
 
    //     // Filter matching keywords
    //     const keyword = searchInput.value.toLowerCase();
 
    //     // Show/hide results container based on input
    //     resultsContainer.style.display = keyword ? 'block' : 'none';
 
    //     // Show/hide categories dropdown based on input
    //     categoriesDropdown.style.display = keyword ? 'none' : 'block';
 
    //     // Show/hide backdrop based on input
    //     backdrop.style.display = keyword ? 'block' : 'none';
    // }
 
    // Add an event listener to the body to hide results and categories when clicked outside
    document.body.addEventListener('click', function (event) {
        const resultsContainer = document.getElementById('searchResults');
        const searchInput = document.getElementById('searchInput');
        const categoriesDropdown = document.querySelector('.categories-dropdown-wrap');
 
        // Check if the clicked element is outside the search input, results, and categories dropdown
        if (
            event.target !== searchInput &&
            !resultsContainer.contains(event.target) &&
            event.target !== categoriesDropdown
        ) {
            resultsContainer.style.display = 'none';
            categoriesDropdown.style.display = 'block'; // Adjust as needed
        }
    });
 
    // Add an event listener to the categories toggle button to hide results when clicked
    const categoriesToggle = document.getElementById('toggle-categories');
    categoriesToggle.addEventListener('click', function () {
        const resultsContainer = document.getElementById('searchResults');
        const categoriesDropdown = document.querySelector('.categories-dropdown-wrap');
        resultsContainer.style.display = 'none';
        categoriesDropdown.style.display = 'block'; // Adjust as needed
    });
</script>

<script type="text/javascript">
   function togglePasswordVisibility(inputFieldId) {
    var passwordField = document.getElementById(inputFieldId);
    var eyeIcon;
 
    if (inputFieldId === "currentPasswordField") {
        eyeIcon = document.getElementById("currentEyeIcon");
    } else if (inputFieldId === "newPasswordField") {
        eyeIcon = document.getElementById("newEyeIcon");
    } else if (inputFieldId === "confirmNewPasswordField") {
        eyeIcon = document.getElementById("confirmNewEyeIcon");
    }
 
    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    }
}
</script>
