<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";
$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
   if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }
?>
      <form action="" method="post" id="my-form-hsn" enctype="multipart/form-data">
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
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> HSN Code</h3>
                                <div class="loaderdiv"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="<?php echo base_url('admin/hsn_code');?>"><button type="button" class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">Back</button></a>
                                    </div>
                                    <div class="col-md-6">
                                          <button type="button" name="submit_customer" class="btn btn-primary hsn-cl btn-set-task w-sm-100 py-2 px-5 text-uppercase save-hsn">Save</button>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">
                                
                                     <input type="hidden" class="form-control" name="hsn_code_id" id="hsn_code_id" value="<?php echo $this->uri->segment(3);?>">
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-6">
                                                <label  class="form-label">HSN Code</label>
                                                <input type="text" class="form-control" name="hsn_code" id="hsn_code" value="<?php echo ($hsn_detaials!=0) ? $hsn_detaials[0]->hsn_code :'';?>" oninput="validateHSNCode()">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="description"><?php echo ($hsn_detaials!=0) ? $hsn_detaials[0]->description :'';?></textarea>
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
   