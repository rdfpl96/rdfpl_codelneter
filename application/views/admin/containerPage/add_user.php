
<?php
//  $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
// if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
//     echo "No direct page access allowed";
//     exit;
//    }
?>
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
 
<?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>
   
      <form action="<?php echo base_url('admin/add_user'); ?>" method="post" enctype="multipart/form-data">
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
                               
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> User</h3>
 
                               
                                <button onclick="window.location.href='<?= base_url('admin/user_list') ?>'" class="btn btn-primary" style="margin-left: 600px;">Back</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                                
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
                                                <label  class="form-label">First Name</label>
                                                <input type="text" class="form-control" name="c_fname" id="c_fname" value="<?php echo ($user_details!=0) ? $user_details[0]->admin_name :'';?>" oninput="validateCharactersonly(this)" required>
                                            </div>
                                           
                                             <div class="col-md-3">
                                                <label  class="form-label">Username</label>
                                                <input type="hidden" class="form-control" name="oldusername" id="oldusername" value="<?php echo ($user_details!=0) ? $user_details[0]->admin_username :'';?>">
 
                                                <input type="text" class="form-control" name="username" id="username" value="<?php echo ($user_details!=0) ? $user_details[0]->admin_username :'';?>" oninput="validateCharactersonly(this)" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label  class="form-label">Mobile</label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo ($user_details!=0) ? $user_details[0]->admin_mobile :'';?>" oninput="validateMobile(this)" required>
                                            </div>
 
                                             <div class="col-md-3">
                                                <label  class="form-label">Email</label>
                                                 <input type="hidden" class="form-control" name="oldemail" id="oldemail" value="<?php echo ($user_details!=0) ? $user_details[0]->admin_email :'';?>">
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo ($user_details!=0) ? $user_details[0]->admin_email :'';?>" required>
                                            </div>
 
                                              <div class="col-md-3">
                                                <label  class="form-label">Designation (Optional)</label>
                                                <input type="text" class="form-control" name="designation" id="designation" value="<?php echo ($user_details!=0) ? $user_details[0]->admin_designation :'';?>" oninput="validateCharactersonly(this)" required>
                                            </div>
 
                                            <div class="col-md-3">
                                                <label  class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" id="password" value="<?php echo ($user_details != 0) ? base64_decode($user_details[0]->admin_password) : ''; ?>" required >
                                            </div>
 
                                            <div class="col-md-3">
                                                <label  class="form-label">Conf-Password</label>
                                                <input type="password" class="form-control" name="conf_password" id="conf_password" value="<?php echo ($user_details != 0) ? base64_decode($user_details[0]->admin_password) : ''; ?>" required>
                                            </div>
 
                                             <div class="col-md-4">
                                                <label  class="form-label">Profile Image</label>
 
                                                <div class="input-group">
                                                <input type="file" class="form-control" name="image" id="image" required>
                                                </div>
 
                                                <span style="color:red;font-size: 13px;">Image dimension should be 300 X 300 Px.</span>
                                       
                                               
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
   