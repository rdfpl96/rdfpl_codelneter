  <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Past Orders
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
                                 $p['pageType'] = 'order';
                                 $this->load->view('frontend/component/my_account_side_bar',$p); 
                                ?>
                            </div>
                            <div class="col-md-10">
                                
                                <div class="tab-content account dashboard-content">
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">                        

                                          <div class="row">
                                              <div class="col-md-8">                                              
                                                 <!-- <h3>My Orders</h3> -->
                                              </div>
                                              <div class="col-md-4 text-right">
                                                  <!-- <div class="btn btn-md">Pay Now</div> -->
                                              </div>
                                          </div>
                                          <div class="card">
                                            <div class="card-body accordion padding0" id="accordionExample">


                                <?php
                           
                                  if($getOrders!=0){
                                    $index=0;
                                    foreach ($getOrders as $key => $values) {
                                       $index++;

                                          // echo "<pre>";
                                          // print_r($values->order_total_final_amt);
                                          // echo "</pre>";

                                         
                                           $getArr=array(
                                               'address1' =>$values->order_address,
                                               'country' =>$values->order_country,
                                               'apartment'=>$values->order_alt_address,
                                               'landmark'=>$values->order_landmark,
                                               'area'=>$values->order_area,
                                               'city'   =>$values->order_city,
                                               'state'  =>$values->order_state,
                                               'pincode' =>$values->order_pincode) ;
                                         $importValue=implode(', ', array_filter($getArr));
                                         $getShipAddr=(($values->order_type_of_address !="") ? (($values->order_type_of_address=='Others') ? $values->order_type_of_address_others_value : $values->order_type_of_address).' - ' :'');

                                          $ords['keyid']=$index;
                                          $ords['values']=$values;
                                          $ords['itemData']=$this->sqlQuery_model->sql_select_where('tbl_order_products',array('pro_generated_order_id'=>$values->order_generated_order_id));

                                           $ordProcess=$this->my_libraries->orderProcessSteps($values->order_cust_id,$values->order_generated_order_id);

                                           $ords['ordProcess']=$ordProcess;
                                           $this->load->view('frontend/containerPage/custOrderItems',$ords); 

                                          $ordProcess=$this->my_libraries->orderProcessSteps($values->order_cust_id,$values->order_generated_order_id);

                                        // echo "<pre>";
                                        // print_r( $ords['itemData']);
                                        // echo "</pre>";
                                              
                                      ?>

                          <div class="my_orders1" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index;?>" aria-expanded="true" aria-controls="collapse<?php echo $index;?>">
                        <div class="row">
                          <div class="col-md-1">
                              <div class="shipping_icon">
                                  <span class="material-symbols-outlined">two_wheeler</span>
                              </div>
                          </div>
                          <div class="col-md-9">
                              <div class="order_process_flow">


                                <div class="order-flow">
                                 
                                 <?php
                                    if(!in_array('Canceled',$ordProcess)){
                                  ?> 

                                  <div class="step-container2">
                                    <label for="placed" class="order_step active"></label>
                                    <span class="step-label">Placed</span>
                                  </div>

                                  <div class="step-container2">
                                    <span class="dotted-line"></span>
                                  </div>

                                  <div class="step-container2">
                                    <label for="in-process" class="order_step <?php echo (in_array('Received',$ordProcess)) ? 'active':'';?>"></label>
                                    <span class="step-label">In Process</span>
                                  </div>

                                  <div class="step-container2">
                                    <span class="dotted-line"></span>
                                  </div>

                                  <div class="step-container2">
                                    <label for="packed" class="order_step <?php echo (in_array('Ready to ship',$ordProcess)) ? 'active':'';?>"></label>
                                    <span class="step-label">Ready to ship</span>
                                  </div>

                                  <div class="step-container2">
                                    <span class="dotted-line"></span>
                                  </div>

                                  <div class="step-container2">
                                    <label for="delivered" class="order_step <?php echo (in_array('Shipped',$ordProcess)) ? 'active':'';?>"></label>
                                    <span class="step-label">Shipped</span>
                                  </div>

                                  <div class="step-container2">
                                    <span class="dotted-line"></span>
                                  </div>

                                  <div class="step-container2">
                                    <label for="reached" class="order_step <?php echo (in_array('Delivered',$ordProcess)) ? 'active':'';?>"></label>
                                    <span class="step-label">Delivered</span>
                                  </div>

                                <?php 
                                }else{
                                   ?>
                                  <div class="step-container2">
                                    <div class="row">
                                      <div class="col-md-4">
                                        <div class="cancel_order_sec pb-10">
                                          <p class="d-flex"><span class="material-symbols-outlined info_fill">info</span>&nbsp;&nbsp; Cancelled</p>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="cancel_order_sec pb-10">
                                          <p class="d-flex"> Order Amount: Rs <?php echo $values->order_total_final_amt;?></p>
                                        </div>
                                      </div>
                                    </div>

                                  </div>
                                  <?php
                                }

                                ?>
                                </div>

                              </div>
                          </div>
                          <div class="col-md-2 viw_btn_col">
                                 
                              <div class="view_btn">
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $index;?>"><div class="btn btn_dark float-right">View <?php echo count(($ords['itemData']!=0) ? $ords['itemData']:array());?> Item</div></a>
                                  
                              </div>
                          </div>
                      </div>
                  </div>

                  <div id="collapse<?php echo $index;?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body">

                         <div class="ship_delivery">
                           <div class="row">
                               <div class="col-md-6">
                                   <p>Order Id: <u><?php echo $values->order_generated_order_id;?></u></p>
                               </div>
                               <div class="col-md-6 text-right">
                                   <!-- <p>Order Placed : 18 Dec, Monday 05:30 PM - 07:30 PM</p> -->
                                    
                                    <p>Order Date : <?php echo date("d M, l h:i A", strtotime($values->order_add_date));?></p>

                               </div>
                           </div>
                         </div>

                         <div class="delivery_info">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Delivery Address</strong></p>
                                    <p><?php echo ucfirst($values->order_name);?></p>

                                     <h6><?php echo $getShipAddr; ?></h6>
                                          <p><?php echo $importValue;?><br>
                                           Ph: <?php echo $values->order_mobile_no;?></p>
                                   
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Payment Information</strong></p>
                                    <p>Payment Status: <span class="text-success"><?php echo $values->order_payment;?></span></p>
                                    <p>Mode Of Payment: <?php echo $values->payment_mode;?></p>
                                </div>
                                <div class="col-md-4 " style="background: #f9f9f9;padding: 20px;">
                                    <p><strong>Order Summary</strong></p>
                                    <div class="order_table">
                                        <table>
                                            <tr>
                                                <th>Order Amount</th>
                                                <th><strong>Rs. <?php echo $values->order_total_final_amt;?></strong></th>
                                            </tr>
                                            <tr>
                                                <td>Savings</td>
                                                <td><strong class="text-success">Rs. 0.00</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">

                                <div class="col-md-4">
                                </div>
                                  <div class="col-md-4"></div>                              
                                  <div class="col-md-4 mt-30">                                 
                                    <div class="view_btn">
                                         <?php if(!in_array('Canceled',$ordProcess) && !in_array('Delivered',$ordProcess) && !in_array('Ready to ship',$ordProcess)){ ?> 
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#cancelModal<?php echo $index;?>"><div class="btn btn_dark float-right">Cancel Order</div></a> 
                                        <?php 
                                        $can['orid']=$values->order_generated_order_id;
                                        $can['keyid_']=$index;
                                        $can['reason_list']=$getReasonList;
                                        $this->load->view('frontend/containerPage/cancel_order_reason',$can);
                                        ?>
                                      <?php } ?>

                                    </div>
                                  </div>                              
                                </div>
                            </div>
                         </div>

                      </div>
                  </div>
                 

                        <?php
                              
                      }

                    }else{
                      ?>
                          <div class="delivery_info">
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="nofo" style="text-align: center;margin-left: auto;margin-right: auto;width: 500px;">
                                      <img src="<?php echo base_url().'include/frontend/assets/imgs/no_orders.png';?>">
                                      <p style="text-align: center;"><h3>No Orders</h3></p>
                                  </div>
                                </div>
                            </div>
                         </div>
                      <?php
                    }
                ?>



                </div>
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



    