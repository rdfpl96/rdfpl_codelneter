<?php
$this->load->view('frontend/header',$data);
?>
<style>
.check_addres_second {
    transition: display 0.3s ease; /* Optional: Add a transition effect */
}
</style>

<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Shipping Address
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
                                
                                <!-- <div class="tab-content account dashboard-content"> -->
                                    <!-- <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab"> -->
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
                                        <div class="check_addres_second" style="display:none;">
                                            <div class="errmess" style="margin-top: 10px;font-size: 19px;"></div>
                                            <?php 
                                            $addr['address']=$shipp_address;
                                            $addr['addrs']='shipping-address-save';
                                            $this->load->view('frontend/component/address_form',$addr);
                                            ?>
                                        </div>


                                    <!-- </div> -->

                                <!-- </div> -->
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
<script>
document.getElementById('useLocationBtn').addEventListener('click', function() {
    const addressSection = document.querySelector('.check_addres_second');
    addressSection.style.display = 'block'; // Show the address section
});
</script>

<style>
.check_addres_second {
    transition: display 0.3s ease; /* Optional: Add a transition effect */
}
</style>