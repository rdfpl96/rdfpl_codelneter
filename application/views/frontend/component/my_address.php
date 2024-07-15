
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
                                             <a href="<?php echo base_url('add-address').'/?adr='.$value->addr_id;?>" class="btn add_icon_style"><span class="material-symbols-outlined">edit</span></a>
                                               <a href="javascript:void(0);" style="display:<?php echo ($value->setAddressDefault==1) ? 'none':'block';?>" class="btn add_icon_style del<?php echo $value->addr_id;?> shipp-delete" data-id="<?php echo $value->addr_id;?>"><span class="material-symbols-outlined">delete</span></a>
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
<?php
$this->load->view('frontend/footer',$data);
?>