
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

<style>
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
</style>
      <form action="" method="post" id="my-form-customer" enctype="multipart/form-data">
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
                               
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Customer</h3>
                                <?php if(in_array('add',$actAcx) || $session['admin_type']=='A'){ ?>
                            <div class="row"> 
                                <div class="col-md-6">  
                                    <a href="<?php echo base_url('customer_list'); ?>"><button type="button" name="" class="btn btn-primary ust-fd btn-set-task w-sm-100 py-2 px-5 text-uppercase">Back</button></a> 
                                </div> 
                                <div class="col-md-6">   
                                    <button type="button" name="submit_customer" class="btn btn-primary ust-fd btn-set-task w-sm-100 py-2 px-5 text-uppercase save-customer">Save</button>
                                </div>
                            </div>
                                <div class="loaderdiv" style="position: absolute;z-index: 99999999;float: right;margin-left: 20%;"></div>
                            <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">

                                    <?php
                                     // echo "<pre>";
                                     // print_r($customer_detaials);
                                     // echo "</pre>";
                                    ?>

                                  
                                    <input type="hidden" class="form-control" name="cust_id" id="cust_id" value="<?php echo $this->uri->segment(3);?>">
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-6">

                                                <label  class="form-label">Customer First Name<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="c_fname" id="c_fname" value="<?php echo ($customer_detaials!=0) ? $customer_detaials[0]->c_fname :'';?>" oninput="validateCharactersonly(this)" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Customer Last Name<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="c_lname" id="c_lname" value="<?php echo ($customer_detaials!=0) ? $customer_detaials[0]->c_lname :'';?>" oninput="validateCharactersonly(this)" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">Mobile<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="hidden" class="form-control" name="oldmobile" id="oldmobile" value="<?php echo ($customer_detaials!=0) ? $customer_detaials[0]->mobile :'';?>">
                                                <input type="number" class="form-control" name="mobile" id="mobile" value="<?php echo ($customer_detaials!=0) ? $customer_detaials[0]->mobile :'';?>" oninput="validateMobile(this)" required>
                                            </div>

                                             <div class="col-md-6">
                                                 <input type="hidden" class="form-control" name="oldemail" id="oldemail" value="<?php echo ($customer_detaials!=0) ? $customer_detaials[0]->email :'';?>">

                                                <label  class="form-label">Email<span class="mandatory-field" style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="email" id="email" value="<?php echo ($customer_detaials!=0) ? $customer_detaials[0]->email :'';?>" required>
                                            </div>

                                            <!-- <div class="col-md-6">
                                                <label  class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password" id="password">
                                            </div> -->

                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Password<span class="mandatory-field" style="color: red;">*</span></label>
                                                <div class="password-container">
                                                    <input type="password" class="form-control" name="password" id="password" required>
                                                    <span class="toggle-password" onclick="togglePassword()">
                                                        <i class="fa fa-eye" id="toggleIcon"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-6">
                                                <label  class="form-label">Conf-Password</label>
                                                <input type="password" class="form-control" name="conf_password" id="conf_password">
                                            </div> -->
                                            <div class="col-md-6">
                                                <label for="password" class="form-label">Conf-Password<span class="mandatory-field" style="color: red;">*</span></label>
                                                <div class="password-container">
                                                    <input type="password" class="form-control" name="conf_password" id="conf_password" required>
                                                    <span class="toggle-password" onclick="toggleconPassword()">
                                                        <i class="fa fa-eye" id="toggleconPassword"></i>
                                                    </span>
                                                </div>
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
   