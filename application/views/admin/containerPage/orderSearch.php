                                       <?php 

                                          $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
                                           if($order_list!=0){

                                            foreach($order_list as $value){
                                                 // $this->my_libraries->updateWareIQ_updation_order_list($value->courier_unique_id);

                                                ?>
                                                 <tr>
                                                    <td><a href="<?php echo base_url('admin/order_details/'.$value->order_generated_order_id);?>"><strong><?php echo $value->order_generated_order_id;?></strong></a></td>
                                                    <td><?php echo $value->order_name;?></td>
                                                    <td><?php echo $value->order_city;?></td>
                                                    <!-- <td><?php //echo $value->payment_mode;?></td> -->
                                                    <td><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $value->order_total_final_amt;?></td>
                                                    <td>
                                                        <?php $statusSmall= ucfirst(strtolower($value->order_status));?>
                                                        <span class="badge" <?php echo getOrderStatusColor_wareIq($statusSmall);?>><?php echo $statusSmall;?></span>
                                                    </td>
                                                     <!-- <td><?php //echo $value->take_away;?></td> -->
                                                     <td>
                                                          <?php if($value->order_payment_status=='Unpaid'){ ?>
                                                             <span class="badge" style="background-color:#ff3300;color:white;border:white;"><?php echo $value->order_payment_status;?></span> 
                                                        <?php }else{ ?>
                                                        <span class="badge" style="background-color:#33cc33;color:white;border:white;"><?php echo $value->order_payment_status;?></span>
                                                        <?php } ?>
                                        

                                                     </td>
                                                    <td><?php echo date('d M, l h:i a',strtotime($value->order_date));?></td>
                                                    
                                                    <?php if(in_array('view',$actAcx) || $session['admin_type']=='A'){ ?>
                                                    <td>
                                                        <a href="<?php echo base_url('admin/order_details/'.$value->order_generated_order_id);?>" class="btn btn-primary text-uppercase btn-set-task w-sm-100">
                                                            View
                                                        </a>

                                                     <?php if($value->take_away=="" && $value->order_tacking_url!="" && $statusSmall!='Canceled' && $statusSmall!='Pending'){ ?>

                                                        <a href="<?php echo $value->order_tacking_url;?>" class="btn btn-primary text-uppercase btn-set-task w-sm-100" target="_blank">
                                                            Track
                                                         </a>
                                                         
                                                      <?php } ?>

                                                       <!-- <?php //if($value->take_away=="" && $statusSmall!='Canceled' && $statusSmall!='Pending'){?>
                                                          <a href="https://wareiq.wiq.app/tracking/<?php //echo $value->order_awb_code;?>" class="btn btn-primary text-uppercase btn-set-task w-sm-100" target="_blank">
                                                            Track
                                                         </a>
                                                       <?php //} ?> -->
                                                    </td>
                                                <?php } ?>
                                                </tr>
                                                    
                                                <?php
                                            }
                                           }
                                            ?>

                                          