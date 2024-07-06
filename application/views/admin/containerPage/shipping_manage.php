
<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
 $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

 <!-- Body: Body -->
 
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                              <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Shipping manage</h3>
                                <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                                  <div class="loaderdiv"></div>
                                 <button type="button" class="btn btn-primary custom_top_btn_css py-2 px-5 text-uppercase btn-set-task w-sm-100 shipping-charges-save">Save</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
              <?php
               // echo "<pre>";
               // print_r($shipping_detaials);
               // echo "</pre>"
              ?>


                    <div class="mt-3 mb-3">
                    <form>
                      <input type="hidden" id="get-shp-id" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_charge_id :'';?>">
                        

                        <div class="row">
                            <div class="col-md-4">
                                    
                                 <label  class="form-label">Category</label>
                               <select id="delveryType" name="delveryType" class="form-control change-type-delv" <?php echo ($shipping_detaials!=0) ?'disabled':'';?>>
                                <?php 
                                // && $values->delivery_palce_value!="pick_up_store"
                                 if($delveryType!=0){ 
                                  foreach($delveryType as $values){
                                    if($values->delivery_palce_value!="international_delivery"){
                                         $selected=($shipping_detaials!=0) ? (($shipping_detaials[0]->ship_delivery_type==$values->delivery_palce_value) ? 'selected':'') :'';
                                    ?>
                                    <option value="<?php echo $values->delivery_palce_value;?>" <?php echo $selected ;?> ><?php echo $values->delivery_palce_header;?></option>
                                    <?php
                                      }
                                    }
                                  }
                                ?>
                               </select>

                            </div>
                            <div class="col-md-8">
                                
                                 <?php
                             if($shipping_detaials!=0) {
                                if($shipping_detaials[0]->ship_delivery_type=='national_delivery' || $shipping_detaials[0]->ship_delivery_type=='excluding_local_hyperlocal'){
                                  $display1='block';
                                }else{
                                  $display1='none';
                                }
                             }else{
                              $display1='block';
                             }
                           ?>


                          <div class="row shipping_manage_css g-3 align-items-center natonal-or-within-mh" style="display: <?php echo $display1;?>;">
                               
                               <div class="col-md-12">
                              <table class="table">
                                <tr>
                                   <td>
                                     <label  class="form-label">QTY</label>
                                     <input type="number" class="form-control" name="qty" id="qty" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_qty:'';?>">
                                  </td>
                                   <td>
                                    <label  class="form-label">Unit</label>
                                    <input type="text" class="form-control" name="unit" id="unit" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_unit:'Kg';?>" readonly>
                                  </td>
                                   <td>
                                     <label  class="form-label">Amount</label>
                                     <input type="number" class="form-control" name="amount" id="amount" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_amount:'Kg';?>">
                                  </td>
                                </tr>
                              </table>
                             </div>
                           </div>

                           <?php
                             if($shipping_detaials!=0) {
                                if($shipping_detaials[0]->ship_delivery_type=='hyperlocal_delivery'){
                                   $display='block';
                                   $getValue=json_decode($shipping_detaials[0]->ship_range_data);

                                   //  echo "<pre>";
                                   // print_r('$getValue');
                                   // echo "</pre>";


                                }else{
                                  $display='none';
                                  $getValue=array();
                                }
                             }else{
                              $display='none';
                              $getValue=array();
                             }
                           ?>

                           <div class="row g-3 shipping_manage_css align-items-center hyperlocal-delver" style="display: <?php echo $display;?>;">
                                
                               <div class="col-md-12">
                                  <table class="table">
                                    <tr>
                                      <td>
                                         <label  class="form-label">Range QTY</label>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                <input type="number" class="form-control" name="range_qty1[]" id="range_qty1_1" placeholder="0" value="<?php echo $getValue[0]->range_qty1;?>">
                                                <input type="number" class="form-control" name="range_qty2[]" id="range_qty2_1" placeholder="5" value="<?php echo $getValue[0]->range_qty2;?>">
                                        </div>
                                     </td>
                                     <td>
                                         <label  class="form-label">Unit</label>
                                           <input type="text" class="form-control" name="range_unit[]" id="range_unit_1" value="Kg" value="<?php echo $getValue[0]->range_unit;?>" readonly>
                                     </td>
                                     <td>
                                         <label  class="form-label">Amount</label>
                                           <input type="number" class="form-control" name="range_amount[]" id="range_amount_1" value="<?php echo $getValue[0]->range_amount;?>">
                                     </td>
                                 </tr>

                                  <tr>
                                      <td>
                                       <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                            <input type="number" class="form-control" name="range_qty1[]" id="range_qty1_2" placeholder="0" value="<?php echo $getValue[1]->range_qty1;?>">
                                            <input type="number" class="form-control" name="range_qty2[]" id="range_qty2_2" placeholder="5" value="<?php echo $getValue[1]->range_qty2;?>">
                                        </div>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control" name="range_unit[]" id="range_unit_2" value="Kg" value="<?php echo $getValue[1]->range_unit;?>" readonly>
                                     </td>
                                      <td>
                                         <input type="number" class="form-control" name="range_amount[]" id="range_amount_2" value="<?php echo $getValue[1]->range_amount;?>">
                                     </td> 
                                 </tr>

                               <tr>
                                    <td>
                                     <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                      <input type="number" class="form-control" name="range_qty1[]" id="range_qty1_3" placeholder="0" value="<?php echo $getValue[2]->range_qty1;?>">
                                      <input type="number" class="form-control" name="range_qty2[]" id="range_qty2_3" placeholder="5" value="<?php echo $getValue[2]->range_qty2;?>">
                                    </div>
                                   </td>
                                   <td>
                                     <input type="text" class="form-control" name="range_unit[]" id="range_unit_3" value="Kg" value="<?php echo $getValue[2]->range_unit;?>" readonly>
                                   </td>
                                    <td>
                                     <input type="number" class="form-control" name="range_amount[]" id="range_amount_3" value="<?php echo $getValue[2]->range_amount;?>">
                                   </td> 
                               </tr>
                            </table>
                         </div>
                    </div> 


                       <?php
                             if($shipping_detaials!=0) {
                                if($shipping_detaials[0]->ship_delivery_type=='local_delivery'){
                                  $display2='block';
                                }else{
                                  $display2='none';
                                }
                             }else{
                              $display2='none';
                             }
                           ?>

                       <div class="row shipping_manage_css g-3 align-items-center local-delver" style="display: <?php echo $display2;?>;">
                          
                          <div class="col-md-12">
                            <table class="table">
                                <tr>
                                  <td>
                                     <label  class="form-label">Max Amount</label>
                                     <input type="number" class="form-control" name="maxAmount" id="maxAmount" placeholder="> 1000" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_max_amount:'';?>">
                                 </td>
                                 <td>
                                    <label  class="form-label">Charges Amount</label>
                                    <input type="number" class="form-control" name="max_charges_amount" id="max_charges_amount" placeholder="250 /-" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_max_amount_charges:'';?>" readonly>
                                 </td>

                                 <td>
                                     <label  class="form-label">Min Amount</label>
                                     <input type="number" class="form-control" name="minAmount" id="minAmount" placeholder="< 1000" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_min_amount:'';?>">
                                 </td>
                                 <td>
                                    <label  class="form-label">Charges Amount</label>
                                    <input type="number" class="form-control" name="min_charges_amount" id="min_charges_amount" value="<?php echo ($shipping_detaials!=0) ? $shipping_detaials[0]->ship_min_amount_charges:'0.00';?>">
                                 </td>
                               </tr>
                           </table>
                        </div>
                      </div>

                            </div>
                        </div>

                       
                    </form>
                </div>


                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Delivery Type</th>
                                                <th>Shipping Details</th>
                                                <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                  <th>Status</th>
                                               <?php } ?>
                                               <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th><span style="">Action</span></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                            if($shipping_list!=0){
                                                $index=0;
                                                foreach(array_reverse($shipping_list) as $value){
                                                   $index++;
                                                    ?>

                                                     <tr>
                                                        <td><strong><?php echo $index;?></strong></td>
                                                        <td><?php echo $value->ship_delivery_type;?></td>
                                                        <td>
                                                        <?php 
                                                          if($value->ship_delivery_type=='national_delivery' || $value->ship_delivery_type=='excluding_local_hyperlocal'){ ?>
                                                             <table class="table">
                                                              <tr>
                                                                <td><?php echo $value->ship_qty;?></td>
                                                                <td><?php echo $value->ship_unit;?></td>
                                                                <td><?php echo $value->ship_amount;?></td>
                                                              </tr>
                                                            </table>
                                                           
                                                           <?php }else if($value->ship_delivery_type=='hyperlocal_delivery'){ 
                                                              $ship_range_data= ($value->ship_range_data!="") ? json_decode($value->ship_range_data) :'';
                                                            ?>
                                                                <table class="table">
                                                                    <tr>
                                                                      <td>Range</td>
                                                                      <td>Amount</td>
                                                                    </tr>
                                                                  <?php if($ship_range_data !=""){ 
                                                                     foreach ($ship_range_data as $key_ => $shp_value) {
                                                                    ?>
                                                                  <tr>
                                                                    <td><?php echo $shp_value->range_qty1. '-' .$shp_value->range_qty2.' '.$shp_value->range_unit;?> </td>
                                                                    <td><?php echo $shp_value->range_amount;?></td>
                                                                  </tr>

                                                                 <?php } } ?>
                                                                </table>

                                                            <?php }else if($value->ship_delivery_type=='local_delivery'){  ?>
                                                                 <table class="table">
                                                                  <tr>
                                                                    <td> <b>Greater Amt (>)</b> <?php echo $value->ship_max_amount;?></td>
                                                                    <td><?php echo $value->ship_max_amount_charges;?> (Free)</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <td> <b>Less Amt (<)</b> <?php echo $value->ship_min_amount;?></td>
                                                                    <td><?php echo $value->ship_min_amount_charges;?> </td>
                                                                  </tr>
                                                                </table>

                                                            <?php } ?>

                                                        </td>

                                                      <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                       
                                                        <td>
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->ship_charge_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                      <?php } ?>

                                                       <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">
                                                          <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                           <a href="<?php echo base_url('admin/shipping_manage/'.$value->ship_charge_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                          <?php } ?>
                                                           <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                           <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->ship_charge_id;?>" data-id="<?php echo base64_encode($value->ship_charge_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                           <?php } ?>

                                                        </div>
                                                       </td>

                                                    </tr>

                                                    <?php
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="loader"></div> -->
              <!-- <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                    <p>Some text in the modal.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div> -->
            <!-- </div> -->