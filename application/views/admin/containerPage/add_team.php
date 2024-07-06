
<?php
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }
?>

      <form action="" method="post" id="my-form-team" enctype="multipart/form-data">
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
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Team</h3>
                                <div class="loaderdiv"></div>
                                <button type="button" class="btn btn-primary tm-cl custom_top_btn_css btn-set-task w-sm-100 py-2 px-5 text-uppercase save-teams">Save</button>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">
                                  <input type="hidden" class="form-control" name="editv" id="editv" value="<?php echo $this->uri->segment(3);?>">

                                  <?php
                                   // echo "<pre>";
                                   // print_r($user_details);
                                   // echo "</pre>";
                                  ?>
                                  
                                    
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-3">
                                                <label class="form-label">Name<span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo ($team_details!=0) ? $team_details[0]->name :'';?>" onkeyup="validateName()">
                                                <span id="name-error" style="color: red;"></span>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <label  class="form-label">Designation<!-- <span style="color:red;">*</span> --></label>
                                                <input type="text" class="form-control" name="designation" id="designation" value="<?php echo ($team_details!=0) ? $team_details[0]->designation :'';?>" onkeyup="validateDesignation()">
                                                <span id="designation-error" style="color: red;"></span>
                                            </div>
                                            

                                            <div class="col-md-6" style="margin-top: 33px;">
                                                <label  class="form-label">Description<span style="color:red;">*</span></label>
                                                <textarea type="text" maxlength="150" class="form-control" name="short_details" id="short_details" rows="1" cols="50"><?php echo ($team_details!=0) ? $team_details[0]->short_details :'';?></textarea> 
                                                <span style="color:red;">Limit Character 150 Only</span>
                                            </div>

                                            <div class="col-md-3">
                                                <label  class="form-label">Twitter Link</label>
                                                <input type="text" class="form-control" name="twitter_link" id="twitter_link" value="<?php echo ($team_details!=0) ? $team_details[0]->twitter_link :'';?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label  class="form-label">Instagram Link</label>
                                                <input type="text" class="form-control" name="insta_link" id="insta_link" value="<?php echo ($team_details!=0) ? $team_details[0]->insta_link :'';?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label  class="form-label">Linkedin Link</label>
                                                <input type="text" class="form-control" name="linkedin_link" id="linkedin_link" value="<?php echo ($team_details!=0) ? $team_details[0]->linkedin_link :'';?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label  class="form-label">Facebook Link</label>
                                                <input type="text" class="form-control" name="fb_link" id="fb_link" value="<?php echo ($team_details!=0) ? $team_details[0]->fb_link :'';?>">
                                            </div>


                                             <div class="col-md-4">
                                                <label  class="form-label">Profile Image<span style="color:red;">*</span></label>

                                                <div class="input-group">
                                                <input type="file" class="form-control" name="image" id="image">
                                                <input type="hidden" class="form-control" name="imgPath" id="imgPath" value="<?php echo ($team_details!=0) ? $team_details[0]->image :'';?>" >

                                                    

                                                    <?php
                                                    if($team_details!=0){
                                                    $filePath=(($team_details[0]->image!="") ? './uploads/user/'.$team_details[0]->image :'');
                                                  if(file_exists($filePath)){
                                                     $imgFile=base_url().'uploads/user/'.$team_details[0]->image;
                                                  }else{
                                                    $imgFile=base_url().'include/assets/default_product_image.png';
                                                  }

                                                  ?>
                                                  <img src="<?php echo $imgFile;?>" style="width:40px; height:40px;border:1px solid grey; ">
                                                    
                                                   <?php
                                                     }
                                                    ?>

                                                </div>
                                                   <br>
                                                    <span style="color:red;font-size: 13px;">Profile image dimensions should be 500 x 500 px.</span>
                                                
                                            </div>


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
   