  <!-- Body: Body --> 
            <?php

           $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();




           if($order_details!=0){

            foreach($order_details as $value){



                // echo "<pre>";
                // print_r($value);
                // die();
                    // print_r($getMinVa);
                    //                   print_r($value->shiprocket_shipment_id);
                    //                   echo "</pre>";

                        //  $getArr=array(
                        //                'address1' =>$value->order_address,
                        //                'country' =>$value->order_country,
                        //                'apartment'=>$value->order_alt_address,
                        //                'landmark'=>$value->order_landmark,
                        //                'area'=>$value->order_area,
                        //                'city'   =>$value->order_city,
                        //                'state'  =>$value->order_state,
                        //                'pincode' =>$value->order_pincode) ;

                        //  $importValue=implode(', ', array_filter($getArr));
                         
                        //  $getShipAddr=(($value->order_type_of_address !="") ? (($value->order_type_of_address=='Others') ? $value->order_type_of_address_others_value : $value->order_type_of_address).' - ' :'').$importValue;
                     

                        //    $getArr_bill=array(
                        //                'address1' =>$value->bill_order_address,
                        //                'country' =>$value->bill_order_country,
                        //                'apartment'=>$value->bill_order_alt_address,
                        //                'landmark'=>$value->bill_order_landmark,
                        //                'area'=>$value->bill_order_area,
                        //                'city'   =>$value->bill_order_city,
                        //                'state'  =>$value->bill_order_state,
                        //                'pincode' =>$value->bill_order_pincode) ;
                        //         $importValue_bill=implode(', ', array_filter($getArr_bill));

                       
                        //         $getShipAddr_bill=(($value->bill_order_type_of_address !="") ? (($value->bill_order_type_of_address=='Others') ? $value->bill_order_type_of_address_others_value : $value->bill_order_type_of_address).' - ' :'').$importValue_bill;
              
                    


                       // $lable=downloadWareIQShipLabel($value->courier_unique_id);
                       // $wareIq_invoice=downloadWareIQinvoice($value->courier_unique_id);
                       // $wareIq_pickList=downloadWareIQPickList($value->courier_unique_id);
                       // $wareIq_packList=downloadWareIQPackList($value->courier_unique_id);
                       // $wareIq_Manifest=downloadWareIQManifest($value->courier_unique_id);

  

                       // $pickuppoint=pickupPointDetails();
                      

                    //     $order_payment=$value->order_payment;
                    //      if($value->order_payment=='Success payment'){
                    //         $style='style="background-color:#33cc33;color:white;border:white;"';
                    //      }else if($value->order_payment=='Pending payment'){
                    //        $style='style="background-color:#F49832;color:white;border:white;"';
                    //      }else{
                    //        $style='style="background-color:#ff3300;color:white;border:white;"';
                    //      }

                       
                    //   if($value->payment_mode=='Instamojo'){
                    //       $payment_id=$value->instamojo_payment_id;
                    //   }else if($value->payment_mode=='Razorpay'){
                    //      $payment_id=$value->razorpay_payment_id;
                    //   }
                ?>



               <div class="body d-flex py-3">  
                <div class="container-xxl"> 
                    <input type="hidden" name="order_id" id="order-id" value="<?php echo $value->order_id;?>">
                    <div class="row align-items-center"> 
                        <div class="border-0 mb-4"> 
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                              <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                               
                                <h4 class="fw-bold mb-0 custom-order-details">Order Details: #<?php echo $value['order_no'];?>

                                       <span class="badge custom-order-css" <?php echo $style;?>><?php echo $order_payment;?></span> 
                                       <a href="<?php echo base_url('admin/product_order'); ?>"><button type="submit" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase"   style="margin-left: 300px;">Back</button></a>

                                        <!-- <span class="badge custom-order-css" style="background-color:#339933;color:white;border:white;">Payment Id : <?php echo $payment_id;?></span>  -->

                                        <!-- <span class="badge custom-order-css" style="background-color:#0dcaf0;color:white;border:white;"><?php echo $value->payment_mode;?></span>  -->

                                    <?php if($value->order_status=='Delivered'|| $value->order_status=='Ready to ship' || $value->order_status=='Shipped'){?>
                                          <a href="<?php echo base_url('admin/download-invoice-admin?d='.$value->order_generated_order_id);?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">Invoice</span></a>
                                            <?php } ?>  


                               <!--  <?php if($value->order_type=='delivery'){ ?>

                                      <?php if($value->order_status=='Delivered' || $value->order_status=='Ready to ship' || $value->order_status=='Shipped'){?>
                                          <a href="<?php echo base_url('admin/packing_slip?d='.$value->order_generated_order_id);?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">Packing Slip</span></a>
                                            <?php } ?>
                                         
                                       <?php if($value->order_status=='Delivered' || $value->order_status=='Ready to ship' || $value->order_status=='Shipped'){?>
                                          <a href="<?php echo base_url('admin/shipping_label?d='.$value->order_generated_order_id);?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">Shipping Label</span></a>
                                            <?php } ?>
                                             
                                        <?php //if($lable->url!=""){?>
                                        <a href="<?php //echo $lable->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ Shipping Label</span></a>   
                                        <?php //} ?>  

                                         <?php //if($wareIq_invoice->url!=""){?>
                                        <a href="<?php //echo $wareIq_invoice->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ Invoice</span></a>   
                                        <?php //} ?> 

                                        <?php //if($wareIq_pickList->url!=""){?>
                                        <a href="<?php //echo $wareIq_pickList->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ PickList</span></a>   
                                        <?php //} ?>  

                                        <?php //if($wareIq_packList->url!=""){?>
                                        <a href="<?php //echo $wareIq_packList->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ PackList</span></a>   
                                        <?php //} ?> 

                                         <?php //if($wareIq_Manifest->url!=""){?>
                                        <a href="<?php //echo $wareIq_Manifest->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ Manifest</span></a>   
                                        <?php //} ?> 

                                 <?php } ?>
 -->

                                 </h4>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                        <div class="col">
                            
                            <div class="alert-success alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Order Created at</div>
                                        <span class="small"><?php echo date('d M, l h:i a',strtotime($value->order_date));?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-danger alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-user fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Name</div> <?php echo $value['customer_name'];?>
                                        <span class="small"><?php //echo $value?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- <div class="alert-warning alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Email</div>
                                        <span class="small"><?php echo $value->order_email;?></span>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="col">
                            <!-- <div class="alert-info alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Contact No</div>
                                        <span class="small"><?php echo $value->order_mobile_no;?></span>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3 row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3 row-deck"> 
                        <div class="col">
                            <div class="card auth-detailblock">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Delivery Address</h6>
                                 
                                </div>
                                <div class="card-body col6_mob_css">
                                    <div class="row g-3">


                                    <div class="col-12">
                                                <label class="form-label">Name</label><br>
                                                <span>
                                                    <?php echo (!empty($value['customer_name'])) ? htmlspecialchars($value['customer_name']) : '<span style="color:red;">Not Mentioned</span>'; ?>
                                                </span>
                                        </div>
                                        
                                        <div class="col-12">
                                                <label class="form-label">Address1:</label><br>
                                                <span>
                                                    <?php echo (!empty($value['address1'])) ? htmlspecialchars($value['address1']) : '<span style="color:red;">Not Mentioned</span>'; ?>
                                                </span>
                                        </div>


                                     


                                         <div class="col-12">
                                                <label class="form-label">Address2:</label><br>
                                                <span>
                                                    <?php echo (!empty($value['address2'])) ? htmlspecialchars($value['address1']) : '<span style="color:red;">Not Mentioned</span>'; ?>
                                                </span>
                                        </div>

                                         <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Area:</label><br>
                                            <span>
                                                <?php
                                                 if($value['area']!=""){
                                                    echo $value['area'];
                                                  }

                                                  // echo ($value->order_alt_mobile_no!="") ? ' / '.$value->order_alt_mobile_no :'';

                                                  if($value['area']==""){
                                                    echo '<span style="color:red;">Not Mension</span>';
                                                  }
 
                                                ?>
                                                </span>
                                        </div>
                                            <div class="col-12">
                                                <label class="form-label col-6 col-sm-6">Email:</label>
                                                <span><?php echo (!empty($value['email'])) ? $value['email'] : '<span style="color:red;">Not Mentioned</span>'; ?></span>
                                            </div>
                                                                <!--  <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Landmark:</label>
                                              <span><?php //echo ($value->order_landmark!="") ? $value->order_landmark :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div> -->

                                       <!--  <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Company Name:</label>
                                            <span><?php //echo ($value->order_company_name!="") ? $value->order_company_name :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div> -->
                                    
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Billing Address</h6>
                                   
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                         <div class="col-12">
                                            <label class="form-label">Address:</label><br>
                                            <span><?php echo ($getShipAddr_bill!="") ? $getShipAddr_bill. '.' :' <span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                        <!-- <div class="col-12">
                                            <label class="form-label">Address2:</label><br>
                                            <span><?php //echo ($value->bill_order_alt_address!="") ? $value->bill_order_alt_address :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div> -->

                                         <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Phone:</label><br>
                                            <span>
                                                 <?php
                                                  if($value->bill_order_mobile_no!=""){
                                                    echo $value->bill_order_mobile_no;
                                                  }
                                                  // echo ($value->bill_order_alt_mobile_no!="") ? ' / '.$value->bill_order_alt_mobile_no :'';

                                                  if($value->bill_order_mobile_no=="" && $value->bill_order_alt_mobile_no==""){
                                                    echo '<span style="color:red;">Not Mension</span>';
                                                  }
                                                 ?>
                                              
                                                    
                                                </span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Email:</label><br>
                                            <span><?php echo ($value->email!="") ? $value->email :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                       <!--  <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Landmark:</label>
                                            <span><?php //echo ($value->bill_order_landmark!="") ? $value->bill_order_landmark :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div> -->

                                        <!-- <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Company Name:</label>
                                            <span><?php //echo ($value->bill_order_company_name!="") ? $value->bill_order_company_name :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                          <div class="row">
                            <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">GST details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Registration No:</label>
                                            <span><?php echo ($value->registration!="") ? $value->registration :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Reg. Company Name :</label>
                                            <span><?php echo ($value->company_name!="") ? $value->company_name :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Reg. Company Address :</label>
                                            <span><?php echo ($value->company_address!="") ? $value->company_address :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                          </div>

                           <div class="col-sm-12">
                            <p>&nbsp;</p>
                           <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Courier Details</h6>
                                    <?php if($value->order_status!=""){ ?>
                                      <span><span>Status : </span><b <?php echo ($value->order_status=='Canceled') ?'style="color:red"':'';?>><?php echo $value->order_status;?></b></span>
                                     <?php } ?>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <label class="form-label col-5 col-sm-5">Courier:</label>
                                            <span><?php echo ($value->courier_name!="") ? $value->courier_name :'<span style="color:red;">N/A</span>';?></span>
                                            
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-5 col-sm-5">AWB :</label>
                                             <span><?php echo ($value->courier_awb_code!="") ? $value->courier_awb_code :'<span style="color:red;">N/A</span>';?></span>
                                        </div>

                                         <div class="col-12">
                                            <label class="form-label col-5 col-sm-5">Courier Charges :</label>
                                             <span><?php echo ($value->courier_charges!=0) ? '₹'.$value->courier_charges :'<span style="color:red;">N/A</span>';?> </span>
                                        </div>
                                       
                                        <?php //if($value->order_tacking_url!=""){ ?>
                                         <!-- <div class="col-12">
                                            <label class="form-label col-4 col-sm-4">Track Order:</label>
                                             <span><a href="<?php //echo $value->order_tacking_url;?>" target="_black" style="color:#689F39;">TRACK ORDER</a></span> -->
                                        <!-- </div> -->
                                      <?php //} ?>

                                      <div class="col-12">
                                            <label class="form-label col-5 col-sm-5">Pickup Created Date :</label>
                                             <span><?php echo ($value->pickup_generated_date!="") ? date('d-m-Y h:i',strtotime($value->pickup_generated_date)) :'<span style="color:red;">N/A</span>';?> </span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-5 col-sm-5">Pickup date :</label>
                                             <span><?php echo ($value->pickup_scheduled_date!="") ? date('d-m-Y h:i',strtotime($value->pickup_scheduled_date)) :'<span style="color:red;">N/A</span>';?> </span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-5 col-sm-5">Pickup Token No :</label>
                                             <span><?php echo ($value->pickup_token_number!="") ? $value->pickup_token_number :'<span style="color:red;">N/A</span>';?> </span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-2 col-sm-2">Notes :</label><br>
                                             <span><?php echo ($value->pickup_notes!="") ? $value->pickup_notes :'<span style="color:red;">N/A</span>';?> </span>
                                        </div>




                                        
                                    </div>

                                     <!-- <button type="button" class="btn btn-primary download-manifest" data-id="<?php //echo $value->shiprocket_shipment_id;?>"><i class="icofont icofont-download"></i> Manifest </button> -->
                                         <div class="btn-group" role="group" aria-label="Action button" style="margin-bottom: 9px !important;    margin-top: 9px;">
                                          <?php //if(empty($value->pickup_scheduled_date) && $value->pickup_scheduled_status==1){ ?>

                                            <?php if($value->order_status!='Pending'){ ?>

                                                 <?php  if(!empty($value->pickup_scheduled_date)){ ?>
                                                      <button type="button" class="btn btn-primary print-manifest" data-id="<?php echo $value->shiprocket_order_id;?>"><i class="icofont icofont-download"></i> Manifest </button>
                                                      <button type="button" class="btn btn-primary download-label" data-id="<?php echo $value->shiprocket_shipment_id;?>"><i class="icofont icofont-download"></i> Label </button>
                                                      <button type="button" class="btn btn-primary download-invoice" data-id="<?php echo $value->shiprocket_order_id;?>"><i class="icofont icofont-download"></i> Invoice </button>
                                                   <?php  } ?>


                                                    <?php if(!empty($value->courier_awb_code) && $value->pickup_scheduled_date==""){ ?>
                                                         <button type="button" class="btn btn-primary schedule-pickup" data-id="<?php echo $value->shiprocket_shipment_id;?>">Schedule Pickup</button>
                                                       <?php } ?>
                                                       
                                                       <?php if($value->order_status=='Ready to ship') { ?>
                                                        <button type="button" class="btn btn-danger und-ot cancel-shipment" style="color:white;" data-id="<?php echo $value->courier_awb_code;?>" data-value="<?php echo $value->shiprocket_shipment_id;?>">Cancel Shipment</button>
                                                        <?php }  ?>


                                                        <!-- <button type="button" class="btn btn-danger und-ot-c cancel-order" style="color:white;background-color: #dc3545 !important;" data-id="<?php //echo $value->shiprocket_order_id;?>">Cancel Order</button>
                                                -->
                                                <?php } ?>
                                         
                                        </div>
                                       <br>
                                        <div class="alertmess_perr"></div>
                                        <div class="loaderdiv-pickup"></div>
                                </div>
                            </div> 
                            
                          </div>


                          </div>



                              <!-- --- -->
                        </div>






                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-xxl-8">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Order Summary 

                                        <?php if($value->order_payment_status=='Unpaid'){ ?>
                                             <span class="badge" style="background-color:#ff3300;color:white;border:white;"><?php echo $value->order_payment_status;?></span> 
                                        <?php }else{ ?>
                                        <span class="badge" style="background-color:#33cc33;color:white;border:white;"><?php echo $value->order_payment_status;?></span>
                                        <?php } ?>

                                    </p></h6>
                                    <?php //if($value->take_away!=""){ ?>
                                    <!-- <h6 class="mb-0 fw-bold " style="float: right;">Take Away : <?php //echo $value->take_away; ?></h6> -->
                                    <?php //} ?>
                                </div>
                                <div class="card-body">

                              
                         <div class="product-cart" style="overflow-y: scroll; height: 500px;">
                        <div class="checkout-table table-responsive">
                            <table id="myCartTable" class="table display dataTable table-hover align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="">Product Image</th>
                                        <th>Product Name</th>
                                        <th class="">Quantity</th>
                                        <th class="">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalPrice = 0; 
                                    
                                    if ($order_details != 0) {
                                        foreach ($order_details as $pvalue) {
                                            $productPrice = $pvalue['order_amount'];

                                            $quantity = $pvalue['qty'];

                                            $totalPrice += $productPrice * $quantity; 

                                            ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo base_url('uploads/' . $pvalue['feature_img']); ?>" class="avatar rounded lg" alt="Product">
                                                </td>
                                                <td>
                                                    <span style="font-weight: bold;"><?php echo $pvalue->pro_cat_name; ?></span>
                                                    <h5><?php echo $pvalue['product_name']; ?></h5>
                                                </td>
                                                <td>
                                                    <span><?php echo $pvalue['qty']; ?></span>
                                                </td>
                                                <td>
                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $pvalue['order_amount']; ?></p>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap justify-content-end">
                            <div class="checkout-total">
                                <div class="single-total">
                                    <p class="value">Total Price:</p>
                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $totalPrice; ?></p>
                                </div>

                                <?php if ($value->order_coupon_offer_amt > 0) { ?>
                                    <div class="single-total">
                                        <p class="value">Coupon Value:</p>
                                        <p class="price"><i class="fa fa-inr" aria-hidden="true"></i><?php echo $value->order_coupon_offer_amt; ?></p>
                                    </div>
                                <?php } ?>

                                <div class="single-total">
                                    <p class="value">Shipping Charge:</p>
                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value->order_shipping_charges; ?></p>
                                </div>
                                                <div class="single-total total-payable">
                                                    <p class="value">Total Payable:</p>
                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value->order_total_final_amt; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-4">
                            <div class="card mb-3">

                              <?php
                                // echo "<pre>";
                                // print_r($value->order_type);
                                // echo "</pre>";
                              ?>

                              <div class="card-header py-2 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Dimensions</h6>
                                </div>
                                <?php
                                $readOnlyAttr='';
                                    if($value->order_status=='Delivered'|| $value->order_status=='Ready to ship' || $value->order_status=='Shipped' || $value->order_status=='Received'){
                                        $readOnlyAttr="readonly";
                                    }
                                ?>

                                <div class="card-body">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <input type="text" class="form-control" placeholder="Length" id="length" value="<?php echo $value->package_length;?>" <?php echo $readOnlyAttr?>>
                                <input type="text" class="form-control" placeholder="Breadth" id="breadth" value="<?php echo $value->package_breadth;?>" <?php echo $readOnlyAttr?>>
                                <input type="text" class="form-control" placeholder="Height" id="height" value="<?php echo $value->package_height;?>" <?php echo $readOnlyAttr?>>
                                <input type="text" class="form-control" placeholder="Weight" id="weight" value="<?php echo $value->package_weight;?>" <?php echo $readOnlyAttr?>>
                                </div>
                            </div>


                              
                                <div class="card-header py-2 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Status Orders</h6>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row g-2 align-items-center">
                                            <div class="col-md-12">
                                                <label  class="form-label">Order ID</label>
                                                <input type="" class="form-control order-ids" id="order-ids" value="<?php echo $value->order_generated_order_id;?>" readonly>
                                            </div>

                                            <?php if(in_array('order-status',$actAcx) || $session['admin_type']=='A'){ ?>
                                            <div class="col-md-12">

                                               <?php 
                                                 $disableValue ="";
                                                 $notes = "";
                                                 if($value->pickup_scheduled_date=="" && $value->courier_awb_code!=""){ 
                                                 // if($value->order_status=='Ready to ship'){ 
                                                    $disableValue = 'disabled';
                                                    $notes = '<b>Note:</b><p style="color:#e91e63;">Schedule your courier pickup.</p>';
                                                     // $notes = "";
                                                 }
                                                ?>
                                               
                                                <label  class="form-label">Order Status</label>
                                                <select class="form-select" name="order_status" id="order-status" <?php echo ($value->order_status=="Canceled" || $value->order_status=="Delivered") ? 'disabled' : $disableValue;?>>
                                                     <?php
                                                        echo $this->my_libraries->updatableOrderStatusProcess($value->order_generated_order_id,array_reverse($order_status),$value->order_status,$value->order_type);
                                                      ?>
                                                </select>

                                                <?php echo $notes;?>

                                            </div>

                                             <!-- <input type="hidden" class="form-control" id="take_away_value" value="<?php //echo $value->take_away;?>"> -->
                                        
                                             <button type="button" class="btn btn-primary und-ot mt-4 text-uppercase update-order-status" <?php echo ($value->order_status=="Canceled" || $value->order_status=="Delivered") ? 'disabled' :'';?>>Submit</button>
                                             <div class="loaderdiv"></div>
                                             

                                              <?php
                                              if($value->order_status=="Canceled"){
                                                echo 'Cancelled By '. $value->order_status_update_by .'<br>';
                                                echo 'Reason : ' .(($value->order_reason_disc!="") ? $value->order_reason_disc : 'N/A') ;
                                              } 
                                               ?>

                                       <?php } ?>

                                        </div>
                                    </form>
                                </div>


                            </div>
                                  <div class="alertmess"></div>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>

            


            <?php 

                if($value->shiprocket_order_id!=""){
                     $checkOrderPayload =array('order_id'=>$value->shiprocket_order_id);     
                     $courierservicablity = checkCourierServiceability($checkOrderPayload);
                     $courier['resp'] = json_decode($courierservicablity);
                     $courier['shipment_id'] = $value->shiprocket_shipment_id;
                     $this->load->view('admin/containerPage/add_courier_details_modal',$courier);
                 }
  
          }
        
        }
  
     ?>


     <!-- add_courier_details_modal.php -->
        
        <style type="text/css">
          .input-group-text{
            background-color:initial !important;
            border-color:initial !important;
            /*color:white !important;*/
            border:initial !important;
          }
          .input-group-prepend .kg{

            background-color:#e9ecef !important;
            /*border-color:1px solid #ced4da !important;*/
            /*color:white !important;*/
            border:1px solid #ced4da !important;

          }
        </style>