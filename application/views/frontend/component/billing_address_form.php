
<?php
$this->load->view('frontend/header',$data);
$mapFlag = (empty($getAddr)) ? 0 : 1;

// echo '<pre>';
// print_r($billingAddress);
// die();
?>
<style type="text/css">
   .gray-background {
    background-color: #f0f0f0; /* Light gray background */
}
</style>
<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Billing Address
                </div>
            </div>
        </div>
        <div class="page-content pt-20 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my_account_main m-auto">

                        <div class="row">
                            <div class="col-md-2">
                               <?php $this->load->view('frontend/component/my_account_side_bar'); ?>
                            </div>
                            
                                <div class="col-md-10">
                                <!-- Select location --->
                                <div class="section" id="selectLocation">
                                    <div class="card">
                                        <div class="card-body">
                                            <input id="search-box" type="text" placeholder="Search for places...">
                                            <div id="map" style="height: 500px; width: 100%;"></div>

                                            <div class="add_new_header" id="useLocationSection" style="">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="new_add_heading">
                                                            <h5 class="areaName"></h5>
                                                            <p class="fullAdress"></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a href="javascript:void(0);" class="change-location" id="useLocationBtn">
                                                            <div class="chag_loc">
                                                                <p>Use Location</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Select location --->

                                <div class="tab-content account dashboard-content" id="billingAddressSection" style="display:none;">
                                    <div class="tab-pane fade active show">
                                        <div class="check_addres_second">
                                            <?php if (!empty($getAddr) && $getAddr != "") { ?>
                                            <br>
                                            <div class="add_new_header">
                                                <div class="row">
                                                    <div class="col-md-1 text-white">
                                                        <h4 class="text-white"><span><i class="fas fa-map-marker-alt"></i></span></h4>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="new_add_heading">
                                                            <h5><?php echo $delnames; ?></h5>
                                                            <p><?php echo $getAddr; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                    <form id="addressForm" action="<?php echo base_url('common/add_or_update_address'); ?>" method="post">
                                    <div class="card">
                                        <div class="card-body"><br>
                                            <h6>Personal Details</h6> <br>
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label for="" class="form-label">First Name</label>
                                                    <input type="text" name="fname" id="fname" placeholder="Enter First Name" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->fname) : ''; ?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label for="" class="form-label">Last Name</label>
                                                    <input type="text" name="lname" id="lname" placeholder="Enter Last Name" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->lname) : ''; ?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label for="" class="form-label">Mobile No</label>
                                                    <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->mobile) : ''; ?>">
                                                </div>
                                            </div><br>
                                            <h6>Address Details</h6> <br>
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label for="" class="form-label">House No</label>
                                                    <input type="text" name="apart_house" id="apart_house" placeholder="Enter House No" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->address1) : ''; ?>">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="" class="form-label">Apartment Name</label>
                                                    <input type="text" name="apart_name" id="apart_name" placeholder="Enter Apartment Name" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->address2) : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label for="" class="form-label">Landmark for easy reach out</label>
                                                    <input type="text" name="area" id="area" placeholder="Enter Landmark for easy reach out" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->area) : ''; ?>">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label for="" class="form-label">Street Details/Landmark</label>
                                                    <input type="text" name="street_landmark" id="street_landmark" placeholder="Enter Street Details/Landmark" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->landmark) : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="row shipping_calculator">
                                                <div class="form-group col-lg-4">
                                                    <label for="" class="form-label">State</label>
                                                    <input type="text" name="state" id="state" placeholder="Enter Landmark for easy reach out" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->state) : ''; ?>">
                                
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <!-- <label for="" class="form-label">Select City</label>
                                                    <div class="custom_select w-100 select2-selection-city">
                                                        <select class="form-control select-active class-city" name="city" id="city">
                                                            <option value="">Select</option>
                                                            <?php 
                                                            /*if (!empty($cities)) {
                                                                foreach ($cities as $city) {
                                                                    $selected = (isset($billingAddress) && $billingAddress[0]->city_id == $city->id) ? 'selected' : '';
                                                                    echo "<option value='{$city->id}' {$selected}>".htmlspecialchars($city->name)."</option>";
                                                                }
                                                            }*/
                                                            ?>
                                                        </select>
                                                    </div> -->
                                
                                                    <label for="" class="form-label">City</label>
                                                    <input type="text" name="city" id="city" placeholder="Enter Landmark for easy reach out" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->city) : ''; ?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label for="" class="form-label">Pincode</label>
                                                    <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode" oninput="validatePincode(this)" value="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->pincode) : ''; ?>">
                                                </div>
                                            </div><br>

                                            <h6>*Address Type</h6> <br>
                                            <?php
                                            $home = '';
                                            $office = '';
                                            $other = '';
                                            $style = 'style="display:none;"';
                                            $other_loc = '';
                                            if (isset($billingAddress)) {
                                                $home = ($billingAddress[0]->nick_name == 'Home') ? 'checked' : '';
                                                $office = ($billingAddress[0]->nick_name == 'Office') ? 'checked' : '';
                                                $other = ($billingAddress[0]->nick_name == 'Other') ? 'checked' : '';
                                                $other_loc = htmlspecialchars($billingAddress[0]->others);
                                            }
                                            ?>
                                            <ul class="ad_type">
                                                <li>
                                                    <input type="radio" name="type" id="home" value="Home" class="actinput" <?php echo $home; ?> onclick="toggleOtherLocation()">
                                                    <label for="home"><span class="material-symbols-outlined">home</span>&nbsp;&nbsp; Home</label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="type" id="office" value="Office" class="actinput" <?php echo $office; ?> onclick="toggleOtherLocation()">
                                                    <label for="office"><span class="material-symbols-outlined">work</span>&nbsp;&nbsp; Office</label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="type" id="other" value="Other" class="actinput" <?php echo $other; ?> onclick="toggleOtherLocation()">
                                                    <label for="other"><span class="material-symbols-outlined">location_on</span>&nbsp;&nbsp; Other</label>
                                                </li>
                                                <li>
                                                    <input type="text" class="form-control" name="other_loc" id="other_loc" value="<?php echo $other_loc; ?>" placeholder="Type Here" <?php echo $style; ?> >
                                                </li>
                                            </ul>
                                            <div id="errf"></div>
                                        </div>

                                        <hr>
                                        <div class="row p-20 float-right">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-md w-100" id="submitAddressBtn" data-id="<?php echo isset($billingAddress) ? htmlspecialchars($billingAddress[0]->addr_id) : ''; ?>">
                                                    <?php if (empty($billingAddress)) { ?>
                                                        Add Billing Address
                                                    <?php } else { ?>
                                                        Update Billing Address
                                                    <?php } ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    </form>
                                        </div>        
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
$this->load->view('frontend/footer',$data);
?>

<script>
$(document).ready(function() {
    $('#submitAddressBtn').on('click', function() {
        var formData = new FormData($('#addressForm')[0]);
        var addressId = $(this).data('id');
        if (addressId) {
            formData.append('addr_id', addressId);
        }
        $.ajax({
            type: 'POST',
            url: $('#addressForm').attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.error === 0) {
                    alert('Address added/updated successfully!'); 
                    $('#addressForm')[0].reset(); 
                    location.reload();
                } else {
                    alert(response.err_msg);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('An error occurred while processing your request.');
            }
        });
    });
});
</script>

<script>
function toggleOtherLocation() {
    const otherInput = document.getElementById('other_loc');
    const otherRadio = document.getElementById('other');

    if (otherRadio.checked) {
        otherInput.style.display = 'block';
        otherInput.classList.add('gray-background');
    } else {
        otherInput.style.display = 'none';
        otherInput.classList.remove('gray-background');
    }
}

var flag = <?php echo $mapFlag;?>;
if(flag == 0){
// Add map location
// alert('if');
document.getElementById('selectLocation').style.display = 'block';
document.getElementById('billingAddressSection').style.display = 'none';
// $('#selectLocation').show();
}else{
// update
// alert('else');
document.getElementById('selectLocation').style.display = 'none';
document.getElementById('billingAddressSection').style.display = 'block';
// $('#selectLocation').hide();
}

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
                    // console.log(results[0]);
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
    document.getElementById('useLocationBtn').addEventListener('click', function() {
        document.getElementById('selectLocation').style.display = 'none';
        document.getElementById('billingAddressSection').style.display = 'block';
    });
</script>
