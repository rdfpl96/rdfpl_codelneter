
<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

      <form action="" method="post" id="my-form-contact" enctype="multipart/form-data">
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4"> 
            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">

                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Werehouse Basic Details</h3>
                                 <?php if(in_array('update',$actAcx) || $session['admin_type']=='A'){ ?>
                                 <div class="loaderdiv"></div>
                                <button type="button" name="submit_contact" class="btn btn-primary rotf btn-set-task w-sm-100 py-2 px-5 text-uppercase save-werehouse-details">Save</button>
                            <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">

                                   <input type="hidden" class="form-control" name="get_id" id="get_id" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->wh_id:'';?>">
                                    
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">

                                            <div class="col-md-3">
                                                <label  class="form-label">Werehouse<span style="color:red;">*</span></label>
                                                 <input type="hidden" class="form-control" name="wh_old" id="wh_old" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->werehouse_code:'';?>">
                                                 <select type="text" class="form-control" name="werehouse_code" id="werehouse-code">
                                                    <option value="">-Select-</option>
                                                    <?php if($werehouse_list!=0){ ?>
                                                        <?php foreach ($werehouse_list as $key => $value) { 
                                                               $exploreV=explode('_',$value->werehouse_code);
                                                               $selected=($wh_detaials!=0) ? (($wh_detaials[0]->werehouse_code==$exploreV[1]) ? 'selected':'') :'';
                                                            ?>
                                                                <option value="<?php echo $exploreV[1];?>" <?php echo $selected;?>><?php echo $value->werehouse_name;?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                  </select> 
                                            </div>

                                           
                                            <div class="col-md-3">
                                                <label  class="form-label">Email<span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->email:'';?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label  class="form-label">Mobile<span style="color:red;">*</span></label>
                                                <input type="number" class="form-control" name="mobile" id="mobile" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->contact:'';?>">
                                            </div>

                                          <div class="col-md-3">
                                                <label  class="form-label">FASSAI No</label>
                                                 <input type="text" class="form-control" name="fassai_no" id="fassai_no" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->fassai_no:'';?>">
                                            </div> 

                                            <div class="col-md-3">
                                                <label  class="form-label">CIN No</label>
                                                 <input type="text" class="form-control" name="cin_no" id="cin_no" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->cin_no:'';?>">
                                            </div> 

                                             <div class="col-md-3">
                                                <label  class="form-label">GSTIN/UIN</label>
                                                 <input type="text" class="form-control" name="gst_no" id="gst_no" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->gst_no:'';?>">
                                             </div>

                                             <div class="col-md-3">
                                                <label  class="form-label">PAN NO</label>
                                                 <input type="text" class="form-control" name="pan_no" id="pan_no" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->pan_no:'';?>">
                                             </div>


                                            <div class="col-md-3">
                                                <label  class="form-label">State Code<span style="color:red;">*</span></label>
                                                 <input type="text" class="form-control" name="state_code" id="state_code" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->state_code:'';?>" placeholder="MH">
                                             </div>
                                              <div class="col-md-3">
                                                <label  class="form-label">TIN<span style="color:red;">*</span></label>
                                                 <input type="number" class="form-control" name="tin_no" id="tin_no" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->tin_no:'';?>" placeholder="27">
                                             </div>

                                             <div class="col-md-3">
                                                <label  class="form-label">State<span style="color:red;">*</span></label>

                                                <select type="text"class="form-control stateClass" name="state" id="state">
                                                    <option value="">-Select-</option>
                                                     <?php if($statelist!=0){ ?>
                                                        <?php foreach ($statelist as $key => $value) {

                                                             $selected_st=($wh_detaials!=0) ? (($wh_detaials[0]->state==$value->name) ? 'selected':'') :'';
                                                         ?>
                                                               <option value="<?php echo $value->name;?>" <?php echo $selected_st;?>><?php echo $value->name;?></option>
                                                           <?php } ?>
                                                        }?>
                                                   
                                                <?php } ?>
                                                </select>
                                             </div>


                                              <div class="col-md-3">
                                                <label  class="form-label">Pincode<span style="color:red;">*</span></label>
                                                 <input type="number" class="form-control" name="pincode" id="pincode" value="<?php echo ($wh_detaials!=0) ? $wh_detaials[0]->pincode:'';?>">
                                             </div>

                                            
                                              <div class="col-md-6">
                                                <label  class="form-label">Address<span style="color:red;">*</span></label>
                                                <textarea type="text" class="form-control" name="address" id="address"><?php echo ($wh_detaials!=0) ? $wh_detaials[0]->address:'';?></textarea>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <!-- ----- -->

                                 <div class="card mb-3">

                                  
                                    <div class="card-body">

                                         <table class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>W.H Code</th>
                                                <!-- <th>Email</th> -->
                                                <!-- <th>Mobile</th> -->
                                                <th>FASSAI No</th>
                                                <th>CIN No</th>
                                                <th>GSTIN/UIN</th>
                                                <th>PAN NO</th>
                                                <th>State Code</th>
                                                <th>TIN</th>
                                                <th>State</th>
                                                <th>Pincode</th>
                                                <!-- <th>Address</th> -->
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="row_position">
                                            <?php if($wh_list!=0){ ?>
                                                <?php foreach ($wh_list as $key => $value) { 

                                                      // echo "<pre>";
                                                      // print_r($value->werehouse_code);
                                                      // echo "</pre>";

                                                    ?>
                                                     <tr>
                                                        <td><?php echo $value->werehouse_code;?></td>
                                                        <!-- <td><?php //echo $value->email;?></td> -->
                                                        <!-- <td><?php //echo $value->contact;?></td> -->
                                                        <td><?php echo $value->fassai_no;?></td>
                                                        <td><?php echo $value->cin_no;?></td>
                                                        <td><?php echo $value->gst_no;?></td>
                                                        <td><?php echo $value->pan_no;?></td>
                                                        <td><?php echo $value->state_code;?></td>
                                                        <td><?php echo $value->tin_no;?></td>
                                                        <td><?php echo $value->state;?></td>
                                                        <td><?php echo $value->pincode;?></td>
                                                        <!-- <td><?php //echo $value->address;?></td> -->
                                                        <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                                         <td>
                                                             <label class="switch">
                                                               <input type="checkbox" data-id="<?php echo base64_encode($value->wh_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($value->status==1) ?'checked' :'';?>>
                                                               <span class="slider round"></span>
                                                            </label>
                                                        </td>
                                                       <?php } ?>
                                                        <td>

                                                         <div class="btn-group" role="group" aria-label="Basic outlined example" style="float: right;">

                                                            <?php if(in_array('edit',$actAcx) || $session['admin_type']=='A'){ ?>
                                                            <a href="<?php echo base_url('admin/werehouse_details/'.$value->wh_id);?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                          <?php } ?>

                                                            <?php if(in_array('delete',$actAcx) || $session['admin_type']=='A'){ ?>
                                                                <button type="button" class="btn btn-outline-secondary deleteRowClass" id="deleteRow<?php echo $value->wh_id;?>" data-id="<?php echo base64_encode($value->wh_id.':::'.implode(',',$deleteActionArr));?>"><i class="icofont-ui-delete text-danger"></i></button>
                                                             <?php } ?>

                                                           
                                                        </div>
                                                            

                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                              <?php } ?>
                                        </tbody>
                                    </table>
                                        
                                    </div>

                                </div>

                                <!-- ------ -->


                            </div>
                        </div>
                       
                    </div><!-- Row end  --> 
                    
                </div>
            </div>    
    
        </div>      

    </div>
</form>
   