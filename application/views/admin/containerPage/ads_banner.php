<?php
//$actAcx
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
?>
      <form action="" method="post" id="my-form-ads-banner" enctype="multipart/form-data">
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
                                <h3 class="fw-bold mb-0">Offer Banner</h3>

                                 <div class="loaderdiv"></div>      
                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                     <?php if(in_array('status',$actAcx) || $session['admin_type']=='A'){
                                       
                                       if($ads_Banner!=0){
                                      ?>
                                    <button type="button" class="btn btn-light custom_flip_btn_css py-2 px-5 text-uppercase w-sm-100">
                                         <label class="switch">
                                               <input type="checkbox" class="action-ads-banner" <?php echo ($this->my_libraries->ads_bannerActiveStaus(1)==1) ?'checked' :'';?>>
                                             <span class="slider round"></span>
                                        </label>
                                     </button>
                                 <?php } } ?>

                              <?php
                                    $desabledAtrr=(in_array('update',$actAcx) && $this->uri->segment(3)!="") ?'' :((in_array('update',$actAcx)) ? '': (($session['admin_type']=='A') ?'':'disabled'));

                                  if(in_array('update',$actAcx) || $session['admin_type']=='A'){ 
                                    ?>

                                <div class="btn-group" role="group">

                                   <button type="button" class="btn btn-primary ads-cl custom_message_css py-2 px-5 text-uppercase btn-set-task w-sm-100 save-ads-banner" <?php echo $desabledAtrr;?>>Save</button>
                                </div>

                            <?php } ?>
                        </div>


                                 <?php //if(in_array('update',$actAcx) || $session['admin_type']=='A'){ ?>
                                 <!-- <div class="loaderdiv"></div> -->
                                <!-- <button type="button" name="submit_contact" class="btn btn-primary rotf btn-set-task w-sm-100 py-2 px-5 text-uppercase save-contact">Save</button> -->
                            <?php //} ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                           




                                <div class="card mb-3">
                                    <div class="card-body">
                                       
                                       

                                           <input type="hidden" class="form-control" name="get_id" id="get_id" value="<?php echo ($ads_Banner!=0) ? $ads_Banner[0]->ads_id:'';?>">


                                            <div class="col-md-6">
                                                
                                                 <input type="file" name="galleryImg" id="galleryImg" class="form-control" accept="image/*">

                                                  <input type="hidden" name="imagePath"  id="imagePath" class="form-control" value="<?php echo ($ads_Banner!=0) ? $ads_Banner[0]->ads_banner:'';?>">
                                                  <?php

                                                   if($ads_Banner!=0) {
                                                       $filePath=(($ads_Banner[0]->ads_banner!="") ? './uploads/user/'.$ads_Banner[0]->ads_banner :'');
                                                          if(file_exists($filePath)){
                                                             $imgFile=base_url().'uploads/user/'.$ads_Banner[0]->ads_banner;
                                                          }else{
                                                            $imgFile=base_url().'include/assets/default_product_image.png';
                                                          }
                                                   ?>
                                                <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">
                                                <?php }?>

                                                 <br>

                                                <span style="color:red;font-size: 13px;">Image dimension should be 1290 X 338 Px.</span>
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
   