<?php 
  $currentData=date('Y-m-d');
  $tomorrow=date('d-m-Y',strtotime($currentData. '+ 1 days'));
?>

<?php $this->load->view('frontend/header'); ?>
<main class="main">
    <div class="page-header mb-50">
        <div class="">
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <section class="checkout_top_sec">
                <div class="container mb-10">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="chekcout_royal_logo">
                                <a href="<?php echo base_url();?>"><img src="<?php echo base_url()?>/include/frontend/assets/imgs/theme/logo.png" width="85px" alt="logo" /></a>
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="checkout_tabs">                              
                                  <div class="step-container">
                                    <div class="step">
                                      <div class="step-text">
                                        <span class="step-icon-left"><i class="fas fa-map-marker-alt"></i></span>
                                          Delivery Address
                                      </div>
                                      <div class="top_add_nav">
                                        <p><?php echo $this->customlibrary->getCustomerCurrentAddress($customer_id);?></p>
                                        <br>
                                        <span class="cust_btn active-btn" style="margin-right: 23px;">
                                              <a href="<?php echo base_url('delivery-address');?>" class="change-addrs">Change</a>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="step active" id="step3">
                                      <div class="step-text">
                                        <span class="step-icon-left"><i class="far fa-calendar"></i></span>
                                       Delivery Options
                                      </div>
                                      <p>Choose your convenient date and time for <br> delivery</p> 
                                    </div>

                                    <div class="step">
                                      <div class="step-text">
                                        <span class="step-icon-left"><i class="far fa-credit-card"></i></span>
                                        Payment
                                      </div>
                                      <p>Pay Order amount by selecting any payment <br> mode</p>
                                    </div>
                                  </div>                              
                                </div>                             
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container mb-30">
                    <div class="row">
                        <div class="col-md-8">                        
                            <div class="delivery_options">
                                <div class="card">
                                    <div class="card-body p30">
                                        <div class="delivery_options_inner">
                                            <h5 class="mb-20">Select a delivery option</h5>
                                            <div class="delivery_options_inner_box">

                                                <div class="delivery_options_product_groups">
                                                    <ul>
                                                        <?php

                                                            if(isset($products) && count($products)>0) { 
                                                                foreach ($products as $product) {
                                                                echo'<li><img src="'.base_url('uploads/'.$product['feature_img']).'"></li>';
                                                                } 
                                                            ?>
                                                          
                                                            <!-- <li>
                                                                <div class="view_item_btn" data-bs-toggle="modal" data-bs-target="#delivery_view_items">
                                                                    View <br> 16 Items
                                                                </div>
                                                            </li>       -->
                                                        <?php    
                                                            } 
                                                        ?>
                                                       
                                                    </ul>
                                                </div>

                                                <div class="delivery_slot_btn">
                                                    <div class="delivery_slot_label">
                                                        <p class="text-muted">Delivery Slot</p>
                                                    </div>
                                                    <div class="delivery_slot_time" data-bs-toggle="modal" data-bs-target="#delivery_slots">
                                                        <p class="text-muted d-flex align-items-center icon_fill"><span class="material-symbols-outlined">schedule</span> &nbsp;&nbsp; 23 May, Thu, Between 1:30 PM - 2:30 PM</p>
                                                        <p class="text-muted "><span class="material-symbols-outlined fw-bold">keyboard_arrow_down</span></p>
                                                    </div>
                                                </div>

                                                <div class="ptp text-right mt-30">
                                                    <button class="btn" onclick="proceedToPayment();">Proceed to payment</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    
                    </div>
                </div>                    
            </section>

        </div>
    </div>
</main>

<!-- ===========delivery slot modal============ -->

<!-- Modal -->
<div class="modal fade" id="delivery_slots" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999999 !important;">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delivery slot</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p0">
        <div class="delivery_slots_dates">
            <ul class="sddiv">
                <li class="active" onclick="selectDate('<?php echo $currentData ?>');" id="sdt1">Today</li>
                <li class="slotdate"  onclick="selectDate('<?php echo $tomorrow ?>');" id="sdt2">Tomorrow</li>
                <?php for ($i=2; $i < 6 ; $i++) {

                    $sdate=date('d-m-Y',strtotime($currentData. '+'.$i.'days')); ?>

                     <li class="slotdate"  onclick="selectDate('<?php echo $sdate ?>')" id="sdt<?php echo $i;?>"><?php echo $sdate;?></li>
                    
                <?php } ?>
                
            </ul>
        </div>
        <div class="delivery_slot_tabs">
            <ul class="nav nav-tabs text-uppercase">
                <li class="nav-item">
                    <a class="nav-link active" id="All-slots-tab" data-bs-toggle="tab" href="#AllSlots">All Slots</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="Morning-info-tab" data-bs-toggle="tab" href="#dattype1">Morning</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Afternoon-info-tab" data-bs-toggle="tab" href="#dattype2">Afternoon</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="Evening-info-tab" data-bs-toggle="tab" href="#dattype3">Evening</a>
                </li>
            </ul>
        </div>
        <div class="tab-content entry-main-content">
            <div class="tab-pane fade show active" id="AllSlots">
                <div class="all_slots_dates">
                    <div class="row">
                        <?php if(count($timeSlot)>0){ ?>
                            <?php foreach ($timeSlot as $slot) { ?>
                                <div class="col-md-6">
                                    <div class="all_slots_dates_label">
                                        <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" class="form-check-input" onclick="selectTimeSlot('<?php echo $slot['start_time']?>-<?php echo $slot['end_time']?>');">&nbsp;&nbsp;<label class="form-check-label" for="flexRadioDefault1"><?php echo $slot['start_time']?>-<?php echo $slot['end_time']?></label></input>
                                    </div>
                                </div>
                                
                            <?php } ?>
                           
                        <?php } ?>                
                    </div>
                </div>
            </div><!--tab-pane end-->
            <?php if(count($timeSlot)>0){ ?>
                <?php foreach ($timeSlot as $slot) { ?>
                    <div class="tab-pane fade" id="dattype<?php echo $slot['day_type']; ?>" >
                        <div class="all_slots_dates">
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="all_slots_dates_label">
                                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" class="form-check-input" onclick="selectTimeSlot('<?php echo $slot['start_time']?>-<?php echo $slot['end_time']?>');">&nbsp;&nbsp;<label class="form-check-label" for="flexRadioDefault1"><?php echo $slot['start_time']?>-<?php echo $slot['end_time']?></label></input>
                                        </div>
                                </div>
                                            
                            </div>
                        </div>
                    </div>
                    
                <?php } ?>
               
            <?php } ?>           
            
           
            
        </div><!--tab content end-->        
      </div><!--modal body edn-->
     
    </div>
  </div>
</div>

<!-- ===============delivery slot modal end========= -->

<!-- =================item view modal=============== -->
<!-- Modal -->
<div class="modal fade" id="delivery_view_items" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Shipment 1 <span>| 16 items</span> <br><span>You can delete or save for later</span></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p0">
        <div class="delivery_view_items">
            <ul>
                <?php for ($i=0; $i < 10 ; $i++) { ?>
                <li>
                    <div class="product_view_item">
                        <img src="https://uat.rdfpl.com/uploads/1701585195MASOORSABUT%20_1.jpg">
                        <div class="product_name">
                            <h1>Fresho, Banana - Robusta</h1>
                            <p>1 X 1 kg</p>
                        </div>
                    </div>
                    <div class="peoduct_save_delete">
                        <div class="remove_product">
                            <a href=""><span class="material-symbols-outlined">delete</span></a>
                        </div>
                        <a href=""><div class="save_for_later_btn">
                            Save for later
                        </div></a>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div><!--delivery_view_items-->
      </div><!--modal body end-->
    </div>
  </div>
</div>    
<!-- ===============intem view modal end============= -->

<style type="text/css">
    body {background-color: rgb(244, 244, 244);}
</style>
<?php $this->load->view('frontend/footer'); ?>

<script>
    $('.sddiv li').on('click', function(){
        $('li.active').removeClass('active');
        $(this).addClass('active');
    });

   let userObj = new Set();

    function selectDate(selectDate){
        userObj.add(selectDate);
    }

    function selectTimeSlot(selectTimeSlot){
        userObj.add(selectTimeSlot);
    }

    function proceedToPayment(){
        console.log(userObj);
    }

</script>