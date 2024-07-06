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

                                               <div class="delivery_slots_dates">
                                                    <ul class="sddiv">
                                                    <li class="active" onclick="selectDate('<?php echo date('Y-m-d',strtotime($currentData))?>');" id="sdt1">Today</li>
                                                    <li class="slotdate"  onclick="selectDate('<?php echo date('Y-m-d',strtotime($tomorrow))?>');" id="sdt2">Tomorrow</li>
                                                    <?php for ($i=2; $i < 6 ; $i++) {

                                                        $sdate=date('d-m-Y',strtotime($currentData. '+'.$i.'days')); ?>

                                                         <li class="slotdate"  onclick="selectDate('<?php echo date('Y-m-d',strtotime($sdate ))?>')" id="sdt<?php echo $i;?>"><?php echo $sdate;?></li>
                                                        
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
                                                                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" class="form-check-input" onclick="selectTimeSlot('<?php echo $slot['start_time']?>-<?php echo $slot['end_time']?>');">&nbsp;&nbsp;<label class="form-check-label" for="flexRadioDefault1"><?php echo $slot['start_time']?>-<?php echo $slot['end_time']?></label>
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
                                                                                <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" class="form-check-input" onclick="selectTimeSlot('<?php echo $slot['start_time']?>-<?php echo $slot['end_time']?>');">&nbsp;&nbsp;<label class="form-check-label" for="flexRadioDefault1"><?php echo $slot['start_time']?>-<?php echo $slot['end_time']?></label>
                                                                            </div>
                                                                    </div>
                                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    <?php } ?>
                                                   
                                                <?php } ?>           
                                            </div><!--tab content end-->        
                                                                                    
                                                <div class="mt-30" id="errmsg"></div>
                                                <div class="ptp text-right mt-30">
                                                    
                                                    <button class="btn" onclick="proceedToPayment();">Proceed to payment</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="col-md-4">
                  <div class="border p-md-4 cart-totals ml-30">
                     <div class="table-responsive page-manage">
                        <div id="updPage">
                           
                           <div class="order_summary_div mt-30">
                              <div class="order_summary_header mb-10 mt-10">
                                 <h4>Order Summary</h4>
                              </div>
                              <div class="custom_hr"></div>
                             
                            
                              
                              <div class="custom_hr"></div>
                              <div class="third_sec_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p><b>Total Amount Payable</b></p>
                                    <p><b>₹<?php echo isset($orderSumery['totalSellingPrice']) ? $orderSumery['totalSellingPrice'] : 0;?></b></p>
                                 </div>
                              </div>
                              <div class="fourth_sec_summary total_summary mb-10 mt-10">
                                 <div class="first_div_total">
                                    <p>Total saved on basket value</p>
                                    <p>₹<?php echo isset($orderSumery['totalSave']) ? $orderSumery['totalSave'] : 0 ;?></p>
                                 </div>
                              </div>
                           </div>
                           <!--order_summary_div-->
                           <!-- ---------new order summary end--------- -->
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
                <li class="active" onclick="selectDate('<?php echo date('Y-m-d',strtotime($currentData))?>');" id="sdt1">Today</li>
                <li class="slotdate"  onclick="selectDate('<?php echo date('Y-m-d',strtotime($tomorrow))?>');" id="sdt2">Tomorrow</li>
                <?php for ($i=2; $i < 6 ; $i++) {

                    $sdate=date('d-m-Y',strtotime($currentData. '+'.$i.'days')); ?>

                     <li class="slotdate"  onclick="selectDate('<?php echo date('Y-m-d',strtotime($sdate ))?>')" id="sdt<?php echo $i;?>"><?php echo $sdate;?></li>
                    
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
                                        <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" class="form-check-input" onclick="selectTimeSlot('<?php echo $slot['start_time']?>-<?php echo $slot['end_time']?>');">&nbsp;&nbsp;<label class="form-check-label" for="flexRadioDefault1"><?php echo $slot['start_time']?>-<?php echo $slot['end_time']?></label>
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
                                            <input type="radio" name="flexRadioDefault" id="flexRadioDefault1" class="form-check-input" onclick="selectTimeSlot('<?php echo $slot['start_time']?>-<?php echo $slot['end_time']?>');">&nbsp;&nbsp;<label class="form-check-label" for="flexRadioDefault1"><?php echo $slot['start_time']?>-<?php echo $slot['end_time']?></label>
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

<style type="text/css">
    body {background-color: rgb(244, 244, 244);}
</style>
<?php $this->load->view('frontend/footer'); ?>

<script>
     localStorage.clear();
    $('.sddiv li').on('click', function(){
        $('li.active').removeClass('active');
        $(this).addClass('active');
    });

    localStorage.setItem('address_id','<?php echo isset($address_id) ? $address_id : 0; ?>');

     localStorage.setItem('sdate','<?php echo date('Y-m-d',strtotime($currentData))?>');

    function selectDate(selectDate){
        localStorage.setItem('sdate',selectDate)
    }

    function selectTimeSlot(selectTimeSlot){
        localStorage.setItem('stime',selectTimeSlot)
        
        let sdate=localStorage.getItem('sdate');
        createDateFormate(selectTimeSlot,sdate);
        // console.log(sdate);
    }

    function proceedToPayment(){
        let stime=localStorage.getItem('stime');
        if(stime){
            window.location.href = "<?php echo base_url('payment-option')?>";
        }else{
            $('#errmsg').html(`<div class="alert alert-danger">Please select time slot</div>`);
        }
        
    }
    
    function createDateFormate(selectTimeSlot,sdate){
        // Create a new Date object
        let date = new Date(sdate); // or use new Date() for the current date

        // Arrays for days and months
        let days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        let months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Extract day, date, and month
        let dayName = days[date.getDay()];
        let day = date.getDate();
        let monthName = months[date.getMonth()];

        // Format the date as desired
        let formattedDate = `${day} ${monthName}${','} ${dayName}${','} ${'Between'} ${selectTimeSlot}`;
          console.log(formattedDate);
       $('#selectedslot').text(formattedDate);

       $('#delivery_slots').model('hide');
       
      
    }
</script>