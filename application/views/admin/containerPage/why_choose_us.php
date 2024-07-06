
<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
 
?>

      <form action="" method="post" id="my-form-choose" enctype="multipart/form-data">
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
                                <h3 class="fw-bold mb-0">Why Choose Us</h3>

                                <div class="loaderdiv"></div>
                                 <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                 <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){ ?>
                                  
                                <button type="button" class="btn btn-light custom_flip_btn_css py-2 px-5 text-uppercase w-sm-100">
                                     <label class="switch">
                                       <input type="checkbox" data-id="<?php echo base64_encode($whyChoose[0]->choose_id.':::'.implode(',',$ActiveInactive_ActionArr));?>" class="cate-status" <?php echo ($whyChoose[0]->status==1) ?'checked' :'';?>>
                                       <span class="slider round"></span>
                                    </label>
                                 </button>
                             <?php } ?>

                                   <?php if(in_array('update',$actAcx) || $session['admin_type']=='A'){ ?>

                                    <div class="btn-group" role="group">
                                      
                                       <button type="button" name="submit_contact" class="btn btn-primary codeee btn-set-task w-sm-100 py-2 px-5 text-uppercase save-choose">Save</button>
                                    </div>

                                <?php } ?>
                            </div>



                                

                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                              <input type="hidden" class="form-control" name="get_id" id="get_id" value="<?php echo ($whyChoose!=0) ? $whyChoose[0]->choose_id:'';?>">
                              
                            

                                <div class="card mb-3">
                                    <div class="card-body">
                                        
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label  class="form-label">Heading name</label>
                                                <input type="text" class="form-control" name="heading" id="heading" value="<?php echo ($whyChoose!=0) ? $whyChoose[0]->heading:'';?>">
                                               
                                            </div>
                                            <div class="col-md-12">
                                                 <label  class="form-label">Description</label>
                                                 <textarea type="text" class="form-control" rows="7" name="historyDetails" id="historyDetails"><?php echo ($whyChoose!=0) ? $whyChoose[0]->description:'';?></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label  class="form-label">Image</label>
                                                 <input type="file" name="galleryImg" id="galleryImg" class="form-control" accept="image/*">

                                                  <input type="hidden" name="imagePath"  id="imagePath" class="form-control" value="<?php echo ($whyChoose!=0) ? $whyChoose[0]->fileimage:'';?>">
                                                  <?php
                                                  if($whyChoose!=0) {
                                                       $filePath=(($whyChoose[0]->fileimage!="") ? './uploads/user/'.$whyChoose[0]->fileimage :'');
                                                          if(file_exists($filePath)){
                                                             $imgFile=base_url().'uploads/user/'.$whyChoose[0]->fileimage;
                                                          }else{
                                                            $imgFile=base_url().'include/assets/default_product_image.png';
                                                          }
                                                   ?>
                                                <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">

                                                <?php } ?>
                                            </div>

                                            <br>
                                              <span style="color:red;font-size: 13px;">Image dimension should be 760 X 520 Px.</span>
                                           

                                        </div>
                                    </div>

                                </div>
                            
                            </div>
                        </div>
                       
                    </div><!-- Row end  --> 
                    
                </div>
            </div>    
    
        </div>      

    </div>
</form>
   