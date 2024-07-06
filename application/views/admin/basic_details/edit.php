
<?php
   // echo "<pre>";
   // print_r($basic_Details);
   // echo "</pre>";
//$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>

    <form action="<?php echo base_url('admin/basic_details/update/' . ($basic_Details != 0 ? $basic_Details[0]->contact_id : '')); ?>" method="post" id="" enctype="multipart/form-data">
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4"> 
            <div class="body d-flex py-3">
                <div class="container-xxl">

                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <div class="mob_back_btn">
                                   <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                                </div>
                                <h3 class="fw-bold mb-0">Basic Details</h3>
                                 <?php //if(in_array('update',$actAcx) || $session['admin_type']=='A'){ ?>
                                <div class="loaderdiv"></div>
                                <button type="submit" name="" class="btn btn-primary rotf btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
                            <?php //} ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">

                                   <input type="hidden" class="form-control" name="contact_id" id="contact_id" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->contact_id:'';?>">
                                    
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-6">
                                                <label  class="form-label">Address<span class="mandatory-field" style="color: red;">*</span></label>
                                                <textarea type="text" class="form-control" name="address" id="address" required><?php echo ($basic_Details!=0) ? $basic_Details[0]->address:'';?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Email<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->email:'';?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Mobile<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->contact:'';?>" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label  class="form-label">GST No<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="gst_no" id="gst_no" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->gst_no:'';?>" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label  class="form-label">State<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="state" id="state" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->state:'';?>" oninput="validateCharactersonly(this)" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label  class="form-label">State Code<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="state_code" id="state_code" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->state_code:'';?>" oninput="validateNonNegativeNumber(this)" required>
                                            </div>

                                              <div class="col-md-3">
                                                <label  class="form-label">Pincode<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->pincode:'';?>" required>
                                             </div>

                                             <div class="col-md-3">
                                                <label  class="form-label">Location<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="location" id="location" value="<?php echo ($basic_Details!=0) ? $basic_Details[0]->location:'';?>" required>
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
    </form>
   