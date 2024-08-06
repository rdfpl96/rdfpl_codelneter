
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
                                <h3 class="fw-bold mb-0">Customer List</h3>
                                  <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                                <div class=" ">
                                    <a href="<?php echo base_url('admin/add_customer');?>"><button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Customer</button></a>
                                </div>
                               <?php } ?>



                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row customer_list_css clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                   <?php if(in_array('export',$actAcx) || $session['admin_type']=='A'){ ?>
                                          <label class="form-label btn btn-sm btn-secondary btn-upload" style="margin-left: 95%;">
                                              <a href="<?php echo base_url('export_CustomerList');?>" style="color:white;"><span class="docs-tooltip" data-toggle="tooltip" title="" data-bs-original-title="Import image with Blob URLs">Export</span></a>
                                          </label>
                               <?php } ?>

                                    <div class="table-responsive">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SerNo</th>
                                                <th>Customers Name</th> 
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Register type</th>
                                                <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                  <th>Status</th>
                                                 <?php } ?>

                                                 <th>Order</th>
                                                 
                                                 <?php if((in_array('edit',$actAcx) || in_array('delete',$actAcx)) || $session['admin_type']=='A'){ ?>
                                                <th>Actions</th> 
                                                <?php } ?> 
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- customer_list -->

                                            <?php 
                                           if($customer_list!=0){
                                            $index=0;
                                            foreach($customer_list as $value){
                                                // echo "<pre>";
                                                // print_r($value->verify_mobile);
                                                // echo "</pre>";
                                                $index++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index;?></td>
                                                        <td><?php echo $value->c_fname.' '.$value->c_lname;?></td>
                                                        <td>
                                                            <?php echo $value->email;?>
                                                            <?php if($value->email!="") { ?>
                                                            <?php if($value->verify_email==1){ ?>
                                                              <!-- <span class="badge" style="background-color:#33cc33;color:white;border:white;">Verified</span> -->
                                                              <br>
                                                            <?php }else{ ?>
                                                              <!-- <span class="badge" style="background-color:#ff0066;color:white;border:white;">Unverified</span> -->
                                                             
                                                            <?php } ?>
                                                        <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $value->mobile;?>

                                                            <?php if($value->mobile!="") { ?>
                                                            <?php if($value->verify_mobile==1){ ?>
                                                               <!-- <span class="badge" style="background-color:#33cc33;color:white;border:white;">Verified</span> -->
                                                           
                                                            <?php }else{ ?>
                                                              <!-- <span class="badge" style="background-color:#ff0066;color:white;border:white;">Unverified</span> -->
                                                              
                                                            <?php } ?>
                                                        <?php } ?>
                                                        </td>
                                                        <td><?php echo $value->registered_type;?></td>
                                                        <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                        <td>
                                                            <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->customer_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                    <?php } ?>
                                                       <td> <a href="<?php echo base_url('admin/product_order?custo='.$value->customer_id);?>" class="btn btn-outline-secondary"><i class="icofont-eye-alt text-success"></i></a></td>
                                                        <td>

                                                           <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                             <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                            <a href="<?php echo base_url('admin/add_customer/'.$value->customer_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                        <?php } ?>
                                                        
                                                           <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>

                                                             <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->customer_id;?>" data-id="<?php echo base64_encode($value->customer_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                              
                                                          <?php } ?>
                                                        </div>


                                                            
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                           }
                                            ?>
                                         <tr>
                                          <td colspan="12">
                                           <div id="pagint-div" style="float: right;">
                                            <?php echo $links;?>
                                           </div>
                                           </td>
                                        </tr>
                                           <!--  <tr>
                                                <td>JoanDyer@gmail.com</td>
                                                <td>202-555-0983</td>
                                                <td>South Africa</td> -->
                                                <!-- <td>18</td> -->
                                               <!--  <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <button type="button" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                        <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                    </div>
                                                </td> -->
                                            <!-- </tr> -->
                                            
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>