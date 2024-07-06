  <?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
  $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>


  <!-- Body: Body -->       
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                 <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Coupons</h3>
                                <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                                <div class="">
                                    <a href="<?php echo base_url('admin/add_coupon');?>" class="btn btn-primary btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i>Add Coupons</a>
                                </div>
                            <?php } ?>

                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row coupon_list_css clearfix g-3">
                    <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Coupons_Code</th>
                                                <th>Apply Time</th>
                                                <th>Coupon Uses Count</th>
                                                <th>Purchase_Type</th>
                                                <th>Coupon Status</th>
                                                <th>Disc_Type</th> 
                                                <th>Purchase_Amt(₹)</th>
                                                <!-- <th>Purchase QTY (Kg)</th> -->
                                                <!-- <th>Purchase Product</th> -->
                                                <th>Disc_Amt</th>
                                                <th>Disc_Per(%)</th>
                                                
                                                <!-- <th>Disc Amt</th> -->
                                                <th>Start_Date</th>
                                                <th>End_Date</th> 
                                                <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <th>Status</th> 
                                            <?php } ?>
                                                 <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th>Actions</th>  
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($coupon_list!=0){

                                            foreach($coupon_list as $values){
                                                // echo "<pre>";
                                                // print_r($values->purchase_type);
                                                // echo "</pre>";
                                                ?>
                                                <tr>
                                                <td>
                                                    <span class="fw-bold ms-1"><?php echo $values->coupon_code;?></span><br>
                                                    <?php
                                                     if($values->coupon_person_type=='public'){
                                                        $style='style="background-color:#009900;color:white;border:white;"';
                                                        $text='Public';
                                                     }else{
                                                        $style='style="background-color:#F49832;color:white;border:white;"';
                                                        $text='Individual';
                                                     }
                                                    ?>
                                                    <span class="badge"<?php echo $style;?>><?php echo $text;?></span>
                                                </td>
                                                <td>
                                                    <?php
                                                     if($values->coupon_time_uses=='multi_use'){
                                                        $style_='style="background-color:#009900;color:white;border:white;"';
                                                        $text_='Multiple Time';
                                                     }else{
                                                        $style_='style="background-color:#F49832;color:white;border:white;"';
                                                        $text_='One Time';
                                                     }
                                                    ?>
                                                    <span class="badge"<?php echo $style_;?>><?php echo $text_;?></span>
                                                        
                                                    </td>
                                               <td><?php echo $this->my_libraries->getCountCustomerUse($values->coupon_code);?></td>
                                                <td><?php echo $values->purchase_type;?></td>
                                                <td><?php echo checkedCouponValidity($values->start_date,$values->end_date);?></td>
                                                <td><?php echo $values->disc_type;?></td>
                                                <td><?php echo $values->min_purch_amt;?></td>
                                                <!-- <td><?php //echo $values->min_purch_qty;?></td> -->
                                                <!-- <td><?php //echo $values->min_purch_product;?></td> -->
                                                <td><?php echo $values->disc_amt;?></td>
                                                <td><?php echo $values->disc_per;?></td>
                                                 
                                                  <!-- <td>$12.6</td> -->
                                                <td><?php echo $values->start_date;?></td>
                                                <td><?php echo $values->end_date;?></td>

                                                <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                <td>

                                                <label class="switch">
                                                   <input type="checkbox" data-id="<?php echo base64_encode($values->coupon_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($values->coupons_status==1) ?'checked' :'';?>>
                                                   <span class="slider round"></span>
                                                </label>

                                                    
                                                </td>
                                            <?php } ?>
                                                <!-- <td>South Africa</td> -->
                                                <!-- <td>Clothes</td> -->
                                                   <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                             <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                            <a href="<?php echo base_url('admin/add_coupon/'.$values->coupon_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                        <?php } ?>
                                                        
                                                           <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                              <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $values->coupon_id;?>" data-id="<?php echo base64_encode($values->coupon_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                          <?php } ?>
                                                        </div>
                                                    </td>
                                            </tr>

                                                <?php
                                            }
                                          }
                                        ?>
                                        <tr>
                                          <td colspan="15">
                                           <div id="pagint-div" style="float: right;">
                                            <?php echo $links;?>
                                           </div>
                                           </td>
                                        </tr>
                

                                           <!--  <tr>
                                                <td><span class="fw-bold ms-1">DTZQT-8547</span></td>
                                                <td>Fixed Amount</td>
                                                <td>$12.6</td>
                                                <td>18/08/2021</td>
                                                <td>06/09/2021</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>South Africa</td>
                                                <td>Clothes</td>
                                                   <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <a href="coupon-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                            </tr> -->
                                           <!--  <tr>
                                                <td><span class="fw-bold ms-1">AXXQT-2547</span></td>
                                                <td>Percentage</td>
                                                <td>20%</td>
                                                <td>08/03/2021</td>
                                                <td>30/03/2021</td>
                                                <td><span class="badge bg-danger">In Active</span></td>
                                                <td>India</td>
                                                <td>Watches</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="coupon-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                        <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="fw-bold ms-1">FiFty-50%</span></td>
                                                <td>Percentage</td>
                                                <td>50%</td>
                                                <td>08/03/2021</td>
                                                <td>30/03/2021</td>
                                                <td><span class="badge bg-warning">Future Plann</span></td>
                                                <td>India</td>
                                                <td>Toy</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="coupon-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                        <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="fw-bold ms-1">BATTT-XA47</span></td>
                                                <td>Fixed Amount</td>
                                                <td>$18.00</td>
                                                <td>06/05/2021</td>
                                                <td>06/09/2021</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>Oman</td>
                                                <td>Shoes</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="coupon-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                        <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="fw-bold ms-1">FALT-40</span></td>
                                                <td>Percentage</td>
                                                <td>18%</td>
                                                <td>16/04/2021</td>
                                                <td>06/09/2021</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>Oman</td>
                                                <td>Shoes</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="coupon-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                        <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="fw-bold ms-1">SHIP-ZERO</span></td>
                                                <td>Free shipping</td>
                                                <td>$0.0</td>
                                                <td>12/05/2021</td>
                                                <td>06/10/2021</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>Denmark</td>
                                                <td>Cream Tube</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="coupon-edit.html" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                        <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                    </div>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div><!-- Row End -->
                </div>
            </div>