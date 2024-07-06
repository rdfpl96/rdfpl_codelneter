  <!-- Body: Body --> 
            <?php
   //         echo "<pre>";
   // print_r($getAccess['inputAction']);
   // print_r($session['admin_type']);
   // echo "</pre>";

           if($order_details!=0){

            foreach($order_details as $value){
//               echo "<pre>";
// print_r($value->courier_unique_id);
// echo "</pre>";

                      $getArr=array(
                               'address1' =>$value->order_address,
                               'country' =>$value->order_country,
                               'city'   =>$value->order_city,
                               'state'  =>$value->order_state,
                               'pincode' =>$value->order_pincode
                          ) ;
                         $importValue=implode(', ', $getArr);
                         // $getShipAddr=(($value->order_type_of_address !="") ? $value->order_type_of_address.' - ' :'').$importValue;
                         $getShipAddr=(($value->order_type_of_address !="") ? (($value->order_type_of_address=='Others') ? $value->order_type_of_address_others_value : $value->order_type_of_address).' - ' :'').$importValue;
                     

                     // if($value->same_address_delivery==1){

                        if($value->bill_order_address!="" && $value->bill_order_country!="" && $value->bill_order_city!="" && $value->order_state!="" && $value->order_pincode!=""){

                          $getArr_bill=array(
                               'address1' =>$value->bill_order_address,
                               'country' =>$value->bill_order_country,
                               'city'   =>$value->bill_order_city,
                               'state'  =>$value->bill_order_state,
                               'pincode' =>$value->bill_order_pincode
                          ) ;
                         $importValue_bill=implode(', ', $getArr_bill);


                         // $getShipAddr_bill=(($value->order_type_of_address !="") ? $value->order_type_of_address.' - ' :'').$importValue_bill;

                          $getShipAddr_bill=(($value->bill_order_type_of_address !="") ? (($value->bill_order_type_of_address=='Others') ? $value->bill_order_type_of_address_others_value : $value->bill_order_type_of_address).' - ' :'').$importValue_bill;
                     }else{
                        $getShipAddr_bill="";
                     }

                     // }else{
                     //    $getShipAddr_bill="";
                     // }
                      
                       // $orderWareIQ_Details=getOrderDetails($value->courier_unique_id);
                       // $courier=$orderWareIQ_Details->data->shipping_details->courier;
                       // $awb=$orderWareIQ_Details->data->shipping_details->awb;
                       // $length=$orderWareIQ_Details->data->dimensions->length;
                       // $breadth=$orderWareIQ_Details->data->dimensions->breadth;
                       // $height=$orderWareIQ_Details->data->dimensions->height;
                       // $weight=$orderWareIQ_Details->data->weight;
                       // $volumetric=$orderWareIQ_Details->data->volumetric;
                       // $status=$orderWareIQ_Details->data->status;
                       $lable=downloadWareIQShipLabel($value->courier_unique_id);
                       $wareIq_invoice=downloadWareIQinvoice($value->courier_unique_id);
                       $wareIq_pickList=downloadWareIQPickList($value->courier_unique_id);
                       $wareIq_packList=downloadWareIQPackList($value->courier_unique_id);
                       $wareIq_Manifest=downloadWareIQManifest($value->courier_unique_id);

                       
                       // $track=trackOrder($awb);


                       // $wareIq_shipOrder=orderShip($value->courier_unique_id);

                       // $wareIq_shipOrder=shipmentOrder($value->courier_unique_id);
                       // echo "<pre>";
                       // print_r($wareIq_shipOrder);
                       // echo "</pre>";

                       $pickuppoint=pickupPointDetails();
                       // echo "<pre>";
                       // print_r($pickuppoint);
                       // echo "</pre>";

                ?>

<!-- ff3300     font-size: 11px;-->

            <div class="body d-flex py-3">  
                <div class="container-xxl"> 
                    <input type="hidden" name="order_id" id="order-id" value="<?php echo $value->order_id;?>">
                    <div class="row align-items-center"> 
                        <div class="border-0 mb-4"> 
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                              <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h4 class="fw-bold mb-0 custom-order-details">Order Details: #<?php echo $value->order_generated_order_id;?> 
 
                                        <?php if($value->order_payment=='Failed payment'){ ?>
                                             <span class="badge custom-order-css" style="background-color:#ff3300;color:white;border:white;"><?php echo $value->order_payment;?></span> 
                                        <?php }else{ ?>
                                        <span class="badge custom-order-css" style="background-color:#33cc33;color:white;border:white;"><?php echo $value->order_payment;?></span>
                                        <?php } ?>

                                        <span class="badge custom-order-css" style="background-color:#339933;color:white;border:white;">Payment Id : <?php echo $value->razorpay_payment_id;?></span> 

                                        <?php if($value->order_status=='Delivered'){?>
                                          <a href="<?php echo base_url('admin/download-invoice-admin?d='.$value->order_generated_order_id);?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">Invoice</span></a>
                                            <?php } ?>

                                        <?php if($value->order_status=='Delivered'){?>
                                          <a href="<?php echo base_url('admin/packing_slip?d='.$value->order_generated_order_id);?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">Packing Slip</span></a>
                                            <?php } ?>
                                         
                                         <?php if($value->order_status=='Delivered'){?>
                                          <a href="<?php echo base_url('admin/shipping_label?d='.$value->order_generated_order_id);?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">Shipping Label</span></a>
                                            <?php } ?>
                                             
                                       <?php if($lable->url!=""){?>
                                        <a href="<?php echo $lable->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ Shipping Label</span></a>   
                                        <?php } ?>  

                                         <?php if($wareIq_invoice->url!=""){?>
                                        <a href="<?php echo $wareIq_invoice->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ Invoice</span></a>   
                                        <?php } ?> 

                                        <?php if($wareIq_pickList->url!=""){?>
                                        <a href="<?php echo $wareIq_pickList->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ PickList</span></a>   
                                        <?php } ?>  

                                        <?php if($wareIq_packList->url!=""){?>
                                        <a href="<?php echo $wareIq_packList->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ PackList</span></a>   
                                        <?php } ?> 

                                         <?php if($wareIq_Manifest->url!=""){?>
                                        <a href="<?php echo $wareIq_Manifest->url;?>"><span class="badge" style="background-color:#689F39;color:white;border:white;font-size: 15px;">WareIQ Manifest</span></a>   
                                        <?php } ?> 


                                        


                                          
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
                                        <div class="h6 mb-0">Name</div>
                                        <span class="small"><?php echo $value->order_name;?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-warning alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Email</div>
                                        <span class="small"><?php echo $value->order_email;?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-info alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Contact No</div>
                                        <span class="small"><?php echo $value->order_mobile_no. ' / ' .$value->order_alt_mobile_no;?></span>
                                    </div>
                                </div>
                            </div>
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
                                            <label class="form-label">Address1:</label><br>
                                            <span><?php echo $getShipAddr;?>.</span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Address2:</label><br>
                                            <span><?php echo ($value->order_alt_address!="") ? $value->order_alt_address :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                         <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Phone:</label>
                                            <span>
                                                <?php
                                                 if($value->order_mobile_no!=""){
                                                    echo $value->order_mobile_no;
                                                  }

                                                  echo ($value->order_alt_mobile_no!="") ? ' / '.$value->order_alt_mobile_no :'';

                                                  if($value->order_mobile_no=="" && $value->order_alt_mobile_no==""){
                                                    echo '<span style="color:red;">Not Mension</span>';
                                                  }
 
                                                ?>
                                                </span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Email:</label>
                                              <span><?php echo ($value->order_email!="") ? $value->order_email :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Landmark:</label>
                                              <span><?php echo ($value->order_landmark!="") ? $value->order_landmark :'<span style="color:red;">Not Mension</span>';?></span>
                                          
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Company Name:</label>
                                            <span><?php echo ($value->order_company_name!="") ? $value->order_company_name :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>
                                    
                                      
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
                                            <label class="form-label">Address1:</label><br>
                                            <span><?php echo ($getShipAddr_bill!="") ? $getShipAddr_bill. '.' :' <span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Address2:</label><br>
                                            <span><?php echo ($value->bill_order_alt_address!="") ? $value->bill_order_alt_address :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                         <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Phone:</label>
                                            <span>
                                                 <?php
                                                  if($value->bill_order_mobile_no!=""){
                                                    echo $value->bill_order_mobile_no;
                                                  }
                                                  echo ($value->bill_order_alt_mobile_no!="") ? ' / '.$value->bill_order_alt_mobile_no :'';

                                                  if($value->bill_order_mobile_no=="" && $value->bill_order_alt_mobile_no==""){
                                                    echo '<span style="color:red;">Not Mension</span>';
                                                  }
                                                 ?>
                                              
                                                    
                                                </span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Email:</label>
                                            <span><?php echo ($value->bill_order_email!="") ? $value->bill_order_email :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Landmark:</label>
                                            <span><?php echo ($value->bill_order_landmark!="") ? $value->bill_order_landmark :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Company Name:</label>
                                            <span><?php echo ($value->bill_order_company_name!="") ? $value->bill_order_company_name :'<span style="color:red;">Not Mension</span>';?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                          <div class="row">
                            <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">GST Deatil</h6>
                                   
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
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Courier Details</h6>
                                    <?php if($value->order_status!=""){ ?>
                                      <!-- <span><span>Status : </span><b><?php //echo ($status=='NEW') ? 'RECEIVED' :$value->order_status;?></b></span> -->

                                      <span><span>Status : </span><b><?php echo $value->order_status;?></b></span>
                                     <?php } ?>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Courier:</label>
                                            <span><?php echo ($value->order_courier!="") ? $value->order_courier :'<span style="color:red;">N/A</span>';?></span>
                                            
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">AWB :</label>
                                             <span><?php echo ($value->order_awb_code!="") ? $value->order_awb_code :'<span style="color:red;">N/A</span>';?></span>
                                        </div>
                                        <!-- <div class="col-12">
                                            <label class="form-label col-6 col-sm-6">Tracking :</label>
                                             <span><?php //echo ($tracking_link!="") ? $tracking_link :'<span style="color:red;">N/A</span>';?></span>
                                        </div> -->
                                    </div>
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
                                    <?php if($value->take_away!=""){ ?>
                                    <h6 class="mb-0 fw-bold " style="float: right;">Take Away : <?php echo $value->take_away; ?></h6>
                                    <?php } ?>
                                </div>
                                <div class="card-body">

                              
                                    <div class="product-cart">
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
                                                    if($order_product_details!=0){

                                                        foreach($order_product_details as $pvalue){
                                                            // echo "<pre>";
                                                            // print_r($pvalue);
                                                            // echo "</pre>";
                                                            ?>

                                                            <tr>
                                                                <td>
                                                                    <img src="<?php echo base_url('uploads/'.$pvalue->pro_product_img);?>" class="avatar rounded lg" alt="Product">
                                                                </td>
                                                                <td>
                                                                    <span style="font-weight: bold;"><?php echo $pvalue->pro_cat_name;?></span>
                                                                    <h5 class=""><?php echo $pvalue->pro_product_name;?></h5>
                                                                    <span><?php echo $pvalue->packsize;?> <?php echo $pvalue->units;?></span>
                                                                </td>
                                                                <td>
                                                                    <?php echo $pvalue->pro_product_qty;?>
                                                                </td>
                                                                <td>
                                                                  <?php $offerValue=($pvalue->pro_offer_status=='offer-product') ?' <span class="offer-idv">Free Offer</span>' :'';?>
                                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $pvalue->pro_subtotal;?>  <?php echo $offerValue;?></p>

                                                                </td>
                                                            </tr>


                                                              <?php  
                                                                 // if($pvalue->pro_offer_status=='Offer Applicable'){
                                                                    ?>
                                                            <!--  <tr>
                                                                <td>


                                                                  <?php
                                                                    //   $filePath=(($pvalue->pro_offer_image!="") ? './uploads/'.$pvalue->pro_offer_image :'');
                                                                    // if(file_exists($filePath)){
                                                                    //    $imgFile=base_url().'uploads/'.$pvalue->pro_offer_image;
                                                                    // }else{
                                                                    //   $imgFile=base_url().'include/assets/default_product_image.png';
                                                                    // }
                                                                    ?>

                                                                  <img src="<?php //echo $imgFile;?>" class="avatar rounded lg" alt="Product">

                                                                </td>
                                                                <td>
                                                                  <span style="font-weight: bold;"><?php //echo $pvalue->pro_offer_category;?></span>
                                                                    <h5 class=""><?php //echo $pvalue->pro_offer_productName;?></h5>
                                                                    <span><?php //echo $pvalue->pro_offer_packSize;?> <?php //echo $pvalue->pro_offer_units;?></span>
                                                                </td>
                                                                <td>
                                                                    <?php //echo $pvalue->pro_offer_pQty;?>
                                                                </td>
                                                                <td>
                                                                    <p class="price">OFFER FREE</p>
                                                                </td>
                                                            </tr> -->
                                                             <?php //} ?>

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
                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value->order_total_purchase_amount;?></p>
                                                </div>

                                                <?php if($value->order_coupon_offer_amt > 0){?>

                                                        <div class="single-total">
                                                            <p class="value">Coupon Value:</p>
                                                            <p class="price"><i class="fa fa-inr" aria-hidden="true"></i><?php echo $value->order_coupon_offer_amt;?></p>
                                                        </div>
                                                <?php } ?> 

                                                <div class="single-total">
                                                    <p class="value">Shipping Charge:</p>
                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value->order_shipping_charges;?></p>
                                                </div>
                                                <!-- <div class="single-total">
                                                    <p class="value">Discount (-):</p>
                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> 10.00</p>
                                                </div> -->
                                               <!--  <div class="single-total">
                                                    <p class="value">Tax(18%):</p>
                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> 198.00</p>
                                                </div> -->
                                                <div class="single-total total-payable">
                                                    <p class="value">Total Payable: 

                                                    <p class="price"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value->order_total_final_amt;?></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-4">
                            <div class="card mb-3">
                                <div class="card-header py-2 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Dimensions (cm)</h6>
                                </div>
                                  <div class="card-body">
                                   <div class="row">
                                     <div class="col-sm-12">
                                      <div class="input-group">
                                       <input type="text" name="length" id="length" class="form-control" placeholder="Length" value="<?php echo $length;?>"/>
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-times" aria-hidden="true" style="font-size: 23px;"></i></span>
                                        </div>
                                        <input type="text" name="breadth" id="breadth" class="form-control" placeholder="Breadth" value="<?php echo $breadth;?>"/>
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-times" aria-hidden="true" style="font-size: 23px;"></i></span>
                                        </div>
                                         <input type="text" name="height" id="height" class="form-control" placeholder="Height" value="<?php echo $height;?>"/>
                                      </div>
                                     </div>
                                    
                                   </div>
                                </div>

                                 <div class="card-header py-2 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Weight</h6>
                                </div>
                                  <div class="card-body">
                                   <div class="row">
                                     <div class="col-sm-5">
                                      <div class="input-group">
                                       <input type="text" name="weight" id="weight" class="form-control" placeholder="Weight" value="<?php echo ($weight=='')  ? $value->total_weight  : $weight ;?>"/>
                                        <div class="input-group-prepend">
                                          <span class="input-group-text kg">Kg</span>
                                        </div>
                                        
                                      </div>
                                     </div>
                                    
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

                                            <?php if(in_array('order-status',$getAccess['inputAction']) || $session['admin_type']=='A'){ ?>
                                            <div class="col-md-12">
                                               
                                               <?php //if ($status==""){ ?>

                                                <label  class="form-label">Order Status</label>
                                                <select class="form-select" name="order_status" id="order-status" <?php echo ($value->order_status=="Canceled" || $value->order_status=="Delivered") ? 'disabled' :'';?>>
                                                    <option value="">-Select-</option>
                                                    <?php
                                                    if($order_status!=0){
                                                       $arrStatus=array('Canceled');
                                                       // $arrAllStatus=array('Pending','Received','Canceled');
                                                       
                                                       $arrAllStatus['Pending']='Pending';
                                                       $arrAllStatus['Received']='Received';
                                                       if($value->take_away!=""){
                                                         $arrAllStatus['Delivered']='Delivered';
                                                        }
                                                       $arrAllStatus['Canceled']='Canceled';


                                                       
                                                        foreach(array_reverse($order_status) as $v){
                                                            $selected=($value->order_status==$v->order_status) ? 'Selected' :'';
                                                            if($status==""){
                                                              if(in_array($v->order_status, $arrAllStatus)){
                                                            ?>
                                                            <option  value="<?php echo $v->order_status;?>" <?php echo $selected;?>><?php echo $v->order_status;?></option>
                                                            <?php
                                                              }
                                                            }else{
                                                             
                                                               if(in_array($v->order_status, $arrStatus)){
                                                               ?>
                                                                <option  value="<?php echo $v->order_status;?>" <?php echo $selected;?>><?php echo $v->order_status;?></option>
                                                               <?php
                                                               }

                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                             <input type="hidden" class="form-control" id="take_away_value" value="<?php echo $value->take_away;?>">
                                        
                                             <button type="button" class="btn btn-primary und-ot mt-4 text-uppercase update-order-status" <?php echo ($value->order_status=="Canceled" || $value->order_status=="Delivered") ? 'disabled' :'';?>>Submit</button>
                                             <div class="loaderdiv"></div>
                                              <?php //} ?>


                                       <?php } ?>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>

             <!-- "SHORTAGE", 'DELIVERED", "LOST", "NEW", "READY TO SHIP", "PICKUP REQUESTED", "OPEN", "DTO", "NOT SHIPPED", "DESTROYED", "PENDING", "RTO", "CLOSED", "DISPATCHED", "CANCELED", "IN TRANSIT", "DAMAGED", "DELETED", "SCHEDULED", "SHIPPED" -->


            <?php 


          }
        
        }
  
     ?>
        
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