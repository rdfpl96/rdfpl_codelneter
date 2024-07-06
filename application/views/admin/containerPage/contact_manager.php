
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
                                <h3 class="fw-bold mb-0">Basic Details</h3>
                                 <?php if(in_array('update',$actAcx) || $session['admin_type']=='A'){ ?>
                                 <div class="loaderdiv"></div>
                                <button type="button" name="submit_contact" class="btn btn-primary rotf btn-set-task w-sm-100 py-2 px-5 text-uppercase save-contact">Save</button>
                            <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">

                                   <input type="hidden" class="form-control" name="get_id" id="get_id" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->contact_id:'';?>">
                                    
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-6">
                                                <label  class="form-label">Address<span class="mandatory-field" style="color: red;">*</span></label>
                                                <textarea type="text" class="form-control" name="address" id="address" required><?php echo ($contactdetaials!=0) ? $contactdetaials[0]->address:'';?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Email<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->email:'';?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Mobile<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->contact:'';?>" required>
                                            </div>


                                            <!--  <div class="col-md-6">
                                                <label  class="form-label">Short information(Optional)</label>
                                                <textarea type="text" class="form-control" name="short_information" id="short_information"><?php //echo ($contactdetaials!=0) ? $contactdetaials[0]->short_information:'';?></textarea>
                                            </div> -->

                                             <!-- <div class="col-md-6">
                                                <label  class="form-label">Youtube Video</label>
                                                 <input type="text" class="form-control" name="youtube_video" id="youtube_video" value="<?php //echo ($contactdetaials!=0) ? $contactdetaials[0]->youtube_video:'';?>">
                                            </div> -->

                                           <!--  <div class="col-md-6">
                                                <label  class="form-label">FASSAI No</label>
                                                 <input type="text" class="form-control" name="fassai_no" id="fassai_no" value="<?php //echo ($contactdetaials!=0) ? $contactdetaials[0]->fassai_no:'';?>">
                                            </div> -->

                                            <!--  <div class="col-md-6">
                                                <label  class="form-label">CIN No</label>
                                                 <input type="text" class="form-control" name="cin_no" id="cin_no" value="<?php //echo ($contactdetaials!=0) ? $contactdetaials[0]->cin_no:'';?>">
                                            </div> -->

                                             <div class="col-md-6">
                                                <label  class="form-label">GST No<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="gst_no" id="gst_no" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->gst_no:'';?>" required>
                                             </div>

                                             <div class="col-md-3">
                                                <label  class="form-label">State<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="state" id="state" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->state:'';?>" oninput="validateCharactersonly(this)" required>
                                             </div>

                                             <div class="col-md-3">
                                                <label  class="form-label">State Code<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="state_code" id="state_code" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->state_code:'';?>" oninput="validateNonNegativeNumber(this)" required>
                                             </div>

                                              <div class="col-md-3">
                                                <label  class="form-label">Pincode<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->pincode:'';?>" required>
                                             </div>

                                             <div class="col-md-3">
                                                <label  class="form-label">Location<span class="mandatory-field" style="color: red;">*</span></label>
                                                 <input type="text" class="form-control" name="location" id="location" value="<?php echo ($contactdetaials!=0) ? $contactdetaials[0]->location:'';?>" required>
                                             </div>



                                        </div>
                                    </div>

                                </div>




                                <!-- <div class="card mb-3">
                                    <div class="card-body">
                                        <h4>Our History</h4>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label  class="form-label">Heading name</label>
                                                <input type="text" class="form-control" name="heading" id="heading" value="<?php //echo ($contactdetaials!=0) ? $contactdetaials[0]->heading:'';?>">
                                               
                                            </div>
                                            <div class="col-md-12">
                                                 <label  class="form-label">History Details</label>
                                           

                                                 <textarea class="form-control"name="historyDetails" id="historyDetails"><?php //echo ($contactdetaials!=0) ? $contactdetaials[0]->historyDetails:'';?></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label  class="form-label">Image</label>
                                                 <input type="file" name="galleryImg" id="galleryImg" class="form-control" accept="image/*">

                                                  <input type="hidden" name="imagePath"  id="imagePath" class="form-control" value="<?php //echo ($contactdetaials!=0) ? $contactdetaials[0]->fileimage:'';?>"> -->
                                                  <?php
                                                  // if($contactdetaials!=0) {
                                                  //      $filePath=(($contactdetaials[0]->fileimage!="") ? './uploads/user/'.$contactdetaials[0]->fileimage :'');
                                                  //         if(file_exists($filePath)){
                                                  //            $imgFile=base_url().'uploads/user/'.$contactdetaials[0]->fileimage;
                                                  //         }else{
                                                  //           $imgFile=base_url().'include/assets/default_product_image.png';
                                                  //         }
                                                   ?>
                                                <!-- <img src="<?php //echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; "> -->

                                                <?php //} ?>
                                      <!--            <br>
                                                <span style="color:red;font-size: 13px;">(Image dimension should be 720 X 720 Px.)</span>
                                            </div>
                                           

                                        </div>
                                    </div>

                                </div> -->
                            
                            </div>
                        </div>
                       
                    </div><!-- Row end  --> 
                    
                </div>
            </div>    
    
        </div>      

    </div>
</form>
   