
<?php
if((!in_array('add',$getAccess['inputAction']) && !in_array('edit',$getAccess['inputAction'])) && $session['admin_type']!='A'){
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
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Testinonial</h3>
                                <div class="loaderdiv"></div>
                                <button type="button" class="btn btn-primary tm-cl custom_top_btn_css btn-set-task w-sm-100 py-2 px-5 text-uppercase save-testimonial">Save</button>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">
                                  <input type="hidden" class="form-control" name="editv" id="editv" value="<?php echo $this->uri->segment(3);?>">

                                 
                                  
                                    
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-3">
                                                <label  class="form-label">Name<span style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo ($testi_details!=0) ? $testi_details[0]->name :'';?>">
                                            </div>
                                            
                                             <div class="col-md-3">
                                                <label  class="form-label">Designation<!-- <span style="color:red;">*</span> --></label>
                                                <input type="text" class="form-control" name="designation" id="designation" value="<?php echo ($testi_details!=0) ? $testi_details[0]->designation :'';?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Short Description<span style="color:red;">*</span></label>
                                                <textarea type="text" rows="6" maxlength="250" class="form-control" name="short_details" id="short_details"><?php echo ($testi_details!=0) ? $testi_details[0]->short_details :'';?></textarea> 
                                                <span style="color:red;">Limit Character 250 Only</span>
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
   