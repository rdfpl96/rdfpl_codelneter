
<?php
//print_r($cusotmer_details);
$this->load->view('frontend/header',$data);
?>
<main class="main pages">
<div class="page-header breadcrumb-wrap">
<div class="container">
<div class="breadcrumb">
<a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
<span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Delivery Addresses
</div>
</div>
</div>
<div class="page-content">
<div class="container">
<div class="row">
<div class="col-lg-12 my_account_main m-auto">
<div class="row">
<div class="col-md-2">
<?php 
$p['pageType'] = 'address';
$this->load->view('frontend/component/my_account_side_bar',$p);
?>
</div>
<div class="col-md-10">

<div class="tab-content account dashboard-content">
<div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    
     <div class="check_addres_first">
      <div class="row">
          <div class="col-md-12">

                <!-- ==============collapse==============-->
                <!-- <h3>My Addresses</h3> <br> -->
                <div class="errmess_sle" style="margin-top: 10px;font-size: 19px;"></div>
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class="row">
                            <div class="col-md-4 location_first_icon">
                                <h3><span class="material-symbols-outlined">location_on</span> Billing Address</h3>
                            </div>
                            <div class="col-md-6 collapse_header_address text_align_center">
                                <h3><?php echo $getAddr;?></h3>
                            </div>
                            <div class="col-md-2 collapse_edit_icon text-right">
                                <a href="<?php echo base_url('billing-address');?>"><h3><span class="material-symbols-outlined">edit_location_alt</span></h3></a>
                            </div>
                        </div>
                      </button>
                    </h2>

                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed closeopen-eve" data-id="1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="row">
                            <div class="col-md-4 location_first_icon">
                                <h3><span class="material-symbols-outlined">location_on</span> Shipping Addresses</h3>
                            </div>
                            <div class="col-md-6 collapse_header_address text_align_center">
                                <h3><?php echo $getshippAddr;?></h3>
                            </div>
                            <div class="col-md-2 collapse_edit_icon text-right">
                                <a href="<?php echo base_url('add-address');?>"><div class="btn btn_dark float-right text-right">Add</div></a>
                            </div>
                        </div>
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse <?php echo ($this->session->userdata('tabse')==1) ? 'show':'';?>" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <div class="row">

                            <?php

                           if($address!=0){
                              foreach ($address as $key => $value) {
                               ?>
                                <div class="col-md-4 mt-20 dl<?php echo $value->addr_id;?>">
                                  <div class="check_default_ad2 divuni<?php echo $value->addr_id;?> <?php echo ($value->setAddressDefault==1)? 'backcolor' :'';?>">
                                      <h4>
                                        <span class="text-success defs<?php echo $value->addr_id;?>">
                                        <span><?php echo ($value->setAddressDefault==1)? 'Default Address:' :'';?></span>
                                       </span>
                                        <?php echo ($value->nick_name=="Other") ? ucfirst($value->others) : $value->nick_name; ?></h4>
                                      <p><?php echo $value->address1.', ';?>
                                            <?php echo $value->address2.', ';?>
                                            <?php echo $value->area.' ,';?>
                                            <?php echo $value->landmark.',';?><br>
                                            <?php echo $value->state,', '.$value->city.', ';?>
                                            <?php echo $value->pincode;?><br>
                                            Ph: <?php echo $value->mobile1;?></p>

                                        <div class="bot_footer check_footer2">
                                             <div class="input-group">
                                               <div class="input-group-text">
                                                <input class="form-check-input shipdress add_radio_style" value="<?php echo $value->addr_id;?>" type="radio" name="flexRadioDefault" id="radioDefault<?php echo $value->addr_id;?>" <?php echo ($value->setAddressDefault==1) ? 'checked':'';?>>&nbsp;&nbsp;
                                                <label class="form-check-label mb-0" for="radioDefault<?php echo $value->addr_id;?>"> Deliver Here</label>
                                              </div>
                                              <!-- <a href="<?php //echo base_url('add-address').'/?adr='.$value->addr_id;?>" class="btn add_icon_style"><span class="material-symbols-outlined">edit</span></a> -->

                                              <span class="material-symbols-outlined" style="cursor:pointer;" onclick="editAddress('<?php echo $value->addr_id; ?>'); return false;" data-bs-toggle="modal" data-bs-target="#editAddressModal">edit</span>

                                              <!-- <a href="javascript:void(0);" style="display:<?php //echo ($value->setAddressDefault==1) ? 'none':'block';?>" class="btn add_icon_style del<?php //echo $value->addr_id;?> shipp-delete" data-id="<?php //echo $value->addr_id;?>"><span class="material-symbols-outlined">delete</span>
                                              </a> -->
                                              <span class="material-symbols-outlined" style="cursor:pointer;" onclick="deleteAddress(<?php echo $value->addr_id; ?>); return false;">delete</span>&nbsp;&nbsp;&nbsp;
                                            </div>
                                            <div style="position: absolute;" class="loaderdiv_addrs<?php echo $value->addr_id;?>" ></div>
                                        </div>
                                  </div>
                              </div>

                               <?php
                              }
                           }else{

                              echo "Data Not found.";
                           }

                            ?>
                       
                      </div>

                      <!--  <div class="pagination-area mt-20 mb-20">
                          <nav aria-label="Page navigation example">
                          <?php //echo $links;?>
                          </nav>
                        </div> -->
                      </div>
                         
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed closeopen-eve" data-id="2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         <div class="row">
                            <div class="col-md-4 location_first_icon">
                                <h3><span class="material-symbols-outlined">receipt_long</span> Enter GST Details</h3>
                            </div>
                        </div>
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse <?php echo ($this->session->userdata('tabse')==2) ? 'show':'';?>" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                     <?php  
                       $gst['cusotmer_details']=$cusotmer_details;
                       $this->load->view('frontend/component/enterGstNumber',$gst);
                     ?>
                    </div>
                  </div>
                </div>

                <!-- ===================collap================ -->
            
          </div>
          
      </div>
      
    </div><!--chek address first end-->

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</main>
<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true" >
   <?php
   //echo '<pre>';
   //print_r($addressDetails);
   //exit();
   ?>
    <div class="modal-dialog" style="">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('update-address'); ?>" method="post" id="editAddressForm">

                  <input type="hidden" name="edit_addr_id" id="edit_addr_id">

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="edit_fname" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="fname" id="edit_fname" placeholder="Enter First Name" value="" required>
                            <span id="er_edit_fname" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="edit_lname" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="lname" id="edit_lname" placeholder="Enter Last Name" value="" required>
                            <span id="er_edit_lname" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="edit_email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="edit_email" placeholder="Enter email id" value="" required>
                            <span id="er_edit_email" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="edit_mobile" class="form-label">Mobile No <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" id="edit_mobile" placeholder="Enter Mobile Number" value="" required>
                            <span id="er_edit_mobile" class="form-text" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="edit_address1" class="form-label">House No <span class="text-danger">*</span></label>
                            <input type="text" name="address1" id="edit_address1" placeholder="Enter House No" value="" required>
                            <span id="er_edit_address1" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="edit_address2" class="form-label">Apartment name <span class="text-danger">*</span> </label>
                            <input type="text" name="address2" id="edit_address2" placeholder="Enter Apartment name" value="" required>
                            <span id="er_edit_address2" class="form-text" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="edit_area" class="form-label">Area<span class="text-danger">*</span></label>
                            <input type="text" name="area" id="edit_area" placeholder="Enter Landmark for easy reach out" value="" required>
                            <span id="er_edit_area" class="form-text" style="color: red;"></span>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="edit_landmark" class="form-label">Street Details/Landmark </label>
                            <input type="text" name="landmark" id="edit_landmark" placeholder="Enter Street Details/Landmark" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="edit_state_id" class="form-label">Select State <span class="text-danger">*</span> </label>
                            <div class="custom_select w-100 select2-selection-state">
                                <input type="text" name="state" id="edit_state" placeholder="Enter state name" value="" required>
                            </div>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="edit_city" class="form-label">Select City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="edit_city" placeholder="Enter city name" value="" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="edit_pincode" class="form-label">Pincode <span class="text-danger">*</span></label>
                            <input type="text" name="pincode" id="edit_pincode" placeholder="Enter Pincode" maxlength="6" value="" required>
                            <span id="er_edit_pincode" class="form-text" style="color: red;"></span>
                        </div>
                    </div>
                    <h6>*Address Type</h6>
                    <ul class="ad_type">
                      <li>
                          <div class="address-type-container">
                              <input type="radio" name="location_type" id="edit_home" value="Home" class="actinput" required>
                              <label for="edit_home"><span class="material-symbols-outlined">home</span>&nbsp;&nbsp; Home</label>
                          </div>
                      </li>
                      <li>
                          <div class="address-type-container">
                              <input type="radio" name="location_type" id="edit_office" value="Office" class="actinput" required>
                              <label for="edit_office"><span class="material-symbols-outlined">work</span>&nbsp;&nbsp; Office</label>
                          </div>
                      </li>
                      <li>
                          <div class="address-type-container">
                              <input type="radio" name="location_type" id="edit_other" value="Other" class="actinput" required>
                              <label for="edit_other"><span class="material-symbols-outlined">location_on</span>&nbsp;&nbsp; Other</label>
                          </div>
                      </li>
                      <li>
                          <input type="text" class="form-control" name="address_type" id="edit_other_loc" value="" placeholder="Type Here" style="display:none;">
                      </li>
                     </ul>

                    <div class="delivery_check d-flex align-items-center pt-10">
                        <input class="form-check-input class-price-desk0" type="checkbox" value="1" name="setAddressDefault">&nbsp;&nbsp;
                        <label class="form-check-label mb-0">
                            <span>
                                <p class="text-muted">Make this as my default delivery address</p>
                            </span>
                        </label>
                    </div>
                    <hr>
                    <div class="row p-20 float-right">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-md w-100 add-shi-sa">
                                Update Address
                            </button>
                            <div class="loaderdiv_addrs"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('frontend/footer',$data);
?>

<script type="text/javascript">
  function deleteAddress(addr_id) {
    if (confirm('Are you sure you want to delete this address?')) {
        $.ajax({
            url: '<?php echo base_url('delete-address'); ?>',
            type: 'POST',
            data: { addr_id: addr_id },
            success: function(response) {
                if(response.success) {
                    alert('Address deleted successfully');
                } else {
                    alert('Address deleted successfully');
                }
            },
            error: function() {
                alert('Error deleting address');
            }
        });
    }
}

function editAddress(addr_id) {
   //alert('addr_id=> '+addr_id);
    $.ajax({
        url: "<?php echo base_url('get_address_details'); ?>",
        type: 'POST',
        data: { addr_id: addr_id },
        dataType: 'json',
        success: function(response) {
         console.log(response);
            if (response.status) {
                $('#edit_addr_id').val(response.data.addr_id);
                $('#edit_fname').val(response.data.fname);
                $('#edit_lname').val(response.data.lname);
                $('#edit_email').val(response.data.email);
                $('#edit_mobile').val(response.data.mobile);
                $('#edit_address1').val(response.data.address1);
                $('#edit_address2').val(response.data.address2);
                $('#edit_area').val(response.data.area);
                $('#edit_landmark').val(response.data.landmark);
                $('#edit_state').val(response.data.state);
                $('#edit_city').val(response.data.city);
                $('#edit_pincode').val(response.data.pincode);
                $('input[name="address_type"][value="' + response.data.address_type + '"]').prop('checked', true);
                $('input[name="address_type"]').trigger('change');
                $('#editAddressModal').modal('show');
                //console.log(response);
            } else {
                alert('Failed to fetch address details.');
            }
        }
    });
}
</script>