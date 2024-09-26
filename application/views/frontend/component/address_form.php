
<?php 
// echo "<pre>";
// print_r($address);
// echo "</pre>";
// echo "hooo";
?>
<div class="card">
                            <div class="card-body">
                                <br>
                                <h6>Personal Details</h6>
                                <br>
                                <form action="<?php echo base_url('add-neww-address')?>" method="post" id="addressForm" enctype="" onsubmit="createNewAddress();return false;">
                                 <input type="hidden" value="delivery" name="address_type" id="address_type">
                                 <input type="hidden" name="addr_id" id="addr_id" value="">
                                    <div class="row">
                                     <div class="form-group col-lg-6">
                                         <label for="fname" class="form-label">First Name <span class="text-danger">*</span></label>
                                         <input type="text" name="fname" id="fname" placeholder="Enter First Name" value="" required>
                                         <span id="er_fname" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-6">
                                         <label for="lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                         <input type="text" name="lname" id="lname" placeholder="Enter last Name" value="" required>
                                         <span id="er_fname" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-6">
                                         <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                         <input type="email" name="email" id="email" placeholder="Enter email id" value="" required onchange="validateEmail(this)">
                                         <span id="er_email" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-6">
                                         <label for="mobile" class="form-label">Mobile No <span class="text-danger">*</span></label>
                                         <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="" required onchange="validateMobile(this)">
                                         <span id="er_mobile" class="form-text" style="color: red;"></span>
                                     </div>
                                 </div>
                                 <br>
                                 <h6>Address Details</h6>
                                 <br>
                                 <div class="row">
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">House No <span class="text-danger">*</span></label>
                                         <input type="text" name="address1" id="address1" placeholder="Enter House No" value="" required>
                                         <span id="er_address1" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">Apartment name <span class="text-danger">*</span> </label>
                                         <input type="text" name="address2" id="address2" placeholder="Enter Apartment name" value="" required>
                                         <span id="er_address2" class="form-text" style="color: red;"></span>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">Area<span class="text-danger">*</span></label>
                                         <input type="text" name="area" id="area" placeholder="Enter Landmark for easy reach out" value="" required>
                                         <span id="er_area" class="form-text" style="color: red;"></span>
                                     </div>
                                     <div class="form-group col-lg-6">
                                         <label for="inputPassword5" class="form-label">Street Details/Landmark </label>
                                         <input type="text" name="landmark" id="landmark" placeholder="Enter Street Details/Landmark" value="">
                                     </div>
                                 </div>
                                    <div class="row shipping_calculator">
                                        <div class="form-group col-lg-4">
                                            <label for="inputPassword5" class="form-label">Select State <span class="text-danger">*</span> </label>
                                            <!-- <div class="custom_select w-100 select2-selection-state">
                                                <select class="form-control select-active class-state select2-hidden-accessible" name="state_id" id="state_id" data-select2-id="state" tabindex="-1" aria-hidden="true" required>
                                                    <?php //echo $this->customlibrary->getStateOptionInOption(); ?>
                                                </select>
                                            </div> -->
                                            <div class="custom_select w-100 select2-selection-city">
                                                <input type="text" name="state_id" id="state_id" placeholder="Enter city state" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputPassword5" class="form-label">Select City <span class="text-danger">*</span></label>
                                            <div class="custom_select w-100 select2-selection-city">
                                                <input type="text" name="city" id="city" placeholder="Enter city name" value="" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputPassword5" class="form-label">Pincode <span class="text-danger">*</span></label>
                                            <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode" oninput="validatePincode(this)" value="" maxlength="6" required onchange="validatePincode(this)">
                                            <span id="er_pincode" class="form-text" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <h6>*Address Type</h6>
                                    <br>
                                    <ul class="ad_type">
                                        <li><input type="radio" name="location_type" id="home" value="Home" class="actinput" onclick="showOtheField('home');" required><label for="home"><span class="material-symbols-outlined">home</span>&nbsp;&nbsp; Home</label></li>
                                        <li><input type="radio" name="location_type" id="office" value="Office" class="actinput" onclick="showOtheField('office');" required><label for="office"><span class="material-symbols-outlined">work</span>&nbsp;&nbsp; Office</label></li>
                                        <li><input type="radio" name="location_type" id="other" value="Other" class="actinput" onclick="showOtheField('other');" required><label for="other"><span class="material-symbols-outlined">location_on</span>&nbsp;&nbsp; Other</label></li>
                                        <li><input type="text" class="form-control" name="location_type" id="other_loc" value="" placeholder="Type Here" style="display:none;"></li>
                                    </ul>
                                    <div class="delivery_check d-flex align-items-center pt-10">
                                        <input class="form-check-input class-price-desk0" type="checkbox" value="1" name="setAddressDefault">&nbsp;&nbsp;
                                        <label class="form-check-label mb-0">
                                            <span>
                                                <p class="text-muted">Make this as my default delivery address</p>
                                            </span>
                                        </label>
                                    </div>
                                    <div id="errf"></div>
                                    <hr>
                                    <div class="row p-20 float-right">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-md w-100 add-shi-sa" data-id="">
                                                Add Address
                                            </button>
                                            <div class="loaderdiv_addrs"></div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>


<?php //$this->load->view('frontend/footer'); ?>  
                      
<script>
   function validateEmail(input) {
    const email = input.value;
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const errorSpan = document.getElementById('er_email');
    if (!regex.test(email)) {
        errorSpan.textContent = 'Please enter a valid email address.';
        input.style.borderColor = 'red';
    } else {
        errorSpan.textContent = '';
        input.style.borderColor = '';
    }
}

function validateMobile(input) {
    const mobile = input.value;
    const regex = /^\d{10}$/;
    const errorSpan = document.getElementById('er_mobile');
    if (!regex.test(mobile)) {
        errorSpan.textContent = 'Please enter a valid 10-digit mobile number.';
        input.style.borderColor = 'red';
    } else {
        errorSpan.textContent = '';
        input.style.borderColor = '';
    }
}

function validatePincode(input) {
    const pincode = input.value;
    const regex = /^\d{6}$/;
    const errorSpan = document.getElementById('er_pincode');
    if (!regex.test(pincode)) {
        errorSpan.textContent = 'Please enter a valid 6-digit pincode.';
        input.style.borderColor = 'red';
    } else {
        errorSpan.textContent = '';
        input.style.borderColor = '';
    }
}

</script>
<script>
        let map;
        let geocoder;
        let marker;

      function initAutocomplete() {
           map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 19.076090, lng: 72.877426 },
                zoom: 8
            });
            
            const input = document.getElementById('search-box');
            const searchBox = new google.maps.places.SearchBox(input);

            geocoder = new google.maps.Geocoder();

            map.addListener('bounds_changed', function () {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener('places_changed', function () {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                if (marker) {
                    marker.setMap(null);
                }

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    // Create a marker for each place.
                    marker = new google.maps.Marker({
                        map: map,
                        title: place.name,
                        position: place.geometry.location
                    });

                    getAddress(place.geometry.location);

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
      }

   function getAddress(latLng) {
         const geocoder = new google.maps.Geocoder();
         geocoder.geocode({ location: latLng }, function (results, status) {
             if (status === 'OK') {
                 if (results[0]) {
                     console.log(results[0]);
                    console.log(results);

                    let area=results[0].address_components[1].long_name +' '+ results[0].address_components[2].long_name;
                    let city = '';
                    let state = '';
                    let pincode = '';
                    results[0].address_components.forEach(component => {
                    if (component.types.includes('locality')) {
                        city = component.long_name;
                    }
                    if (component.types.includes('administrative_area_level_1')) {
                        state = component.long_name;
                    }
                    if (component.types.includes('postal_code')) {
                        pincode = component.long_name;
                    }
                });
                    // console.log(area);
                    // console.log(city);
                    // console.log(state);

                    $('.areaName').text(results[0].address_components[1].long_name);
                    $('.fullAdress').text(results[0].formatted_address);
                    $('#area').val(area);
                    $('#city').val(city);
                    $('#state_id').val(state);
                    $('#pincode').val(pincode);


                    $('#useLocationSection').show();

                    checkPincodeValidationForDelivery(pincode);
                    //alert('Address: ' + results[0].formatted_address);
                 } else {
                     alert('No results found');
                 }
             } else {
                 alert('Geocoder failed due to: ' + status);
             }
         });
   }

   function showAddForm(){
      $('.section').hide();
      $('#selectLocation').show();
   }   
     
   function changeLocation(){
      $('#add-addr-div').hide();
      $('#selectLocation').show();
   }

   function useLocation(){
      $('.section').hide();
      $('#add-addr-div').show();
   }

   function showOtheField(address_type){
      if(address_type=='other'){
         $('#other_loc').css('display','block');
      }else{
         $('#other_loc').css('display','none');
      }
   }

  

   function createNewAddress(){

      var formData = new FormData($('#addressForm')[0]);
      $.ajax({
         type: 'post',
         url: $('#addressForm').attr('action'),
         data: formData,
         dataType: "json",
         processData: false,
         contentType: false,
         beforeSend: function() {
         },
         success: function(res) {
                  
           if(res.error==0){
               $('#addressForm')[0].reset();
               location.reload();
               // Swal.fire('Success','success'); 

           }
           else if(res.error==1){
               $('#'+res.error_tag).text(res.err_msg);
           }
           else{
              // Swal.fire({
              //    icon: 'error',
              //    title: 'Oops...',
              //    text: 'Something went wrong!',
              //  })
           }
       },
       complete: function() {
            //$.unblockUI();
         // $('#btn1').css('display', 'block');
         // $('#btn2').css('display', 'none');
       },
       error: function(xhr, status, error) {
         console.log(error);
       },
     });
   }

   function selecAddress(address_id){
      $.ajax({
        url:'<?php echo base_url('set-default-address');?>',
        type:'POST',
        dataType:'JSON',
        data:({'address_id':address_id}),
         success:function(res){
           if(res.error==0){
             localStorage.setItem('address_id',address_id)
            location.href = "<?php echo base_url('checkout')?>"; 
           }else{

           }
          
        }
      });

   }

   //Call the initAutocomplete function when the DOM is fully loaded
   document.addEventListener('DOMContentLoaded', function() {
     
     initAutocomplete();
   });
</script>
<script>


$(document).ready(function() {
    $('input[name="address_type"]').on('change', function() {
        $('.address-type-container').removeClass('selected-address-type');
        $(this).closest('.address-type-container').addClass('selected-address-type');
        if ($('#edit_other').is(':checked')) {
            $('#edit_other_loc').show();
        } else {
            $('#edit_other_loc').hide();
        }
    });
    $('input[name="address_type"]:checked').trigger('change');
});



</script>
<script type="text/javascript">

 //   function checkPincodeValidationForDelivery(pincode) {
 //    $.ajax({
 //        url: 'cart/deliveryAddress',
 //        type: 'POST',
 //        data: {
 //            'search-box': pincode
 //        },
 //        success: function(response) {
 //            var data = JSON.parse(response);
            
 //            if (data.isdelivered) {
 //                $('#errorMessage').hide();
 //                $('#useLocationSection').show();
 //                $('.areaName').text(data.areaName);
 //                $('.fullAdress').text(data.fullAdress);
 //            } else {
 //                $('#useLocationSection').hide();
 //                $('#errorMessage').show();
 //            }
 //        },
 //        error: function(xhr, status, error) {
 //            console.error(error);
 //        }
 //    });
 // }
</script>                        
