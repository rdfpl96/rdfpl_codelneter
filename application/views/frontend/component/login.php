    
<?php 
//print_r($data);
//exit();
//$google_client=$this->my_libraries->googleLoginConfig();  
    //$fblogin=$this->my_libraries->fblogin();
?>
<style type="text/css">
  .modal1 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.7); /* Black w/ opacity */
}

.modal-content1 {
    background-color: #fff; /* White background */
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 500px; /* Could be more or less, depending on screen size */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

h4 {
    margin: 0 0 10px 0; /* Adjust margin */
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff; /* Bootstrap primary color */
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3; /* Darker blue */
}

</style>
    <!-- Modal -->
    <div class="modal login-modal-divs fade" id="login-modal-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-headers">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p0">
            <!-- ============login form code========== -->

            <div class="row">
              <div class="col-md-4 pr0">
                <div class="login_info_royal">
                  <h4>Why Choose Royal Dryfruits</h4>
                    <div class="row">
                        <div class="col">
                        <img alt="Login" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icon1.svg" />
                        </div>
                        <div class="col">
                        <img alt="Login" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icon2.svg" />
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                        <img alt="Login" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icon3.svg" />
                        </div>
                        <div class="col"> 
                        <img alt="Login" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/icon4.svg" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                        <p class="find_text">Find us on</p>
                        </div>
                        <div class="col">
                        <img alt="Login" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/android.svg" />
                        </div>
                        <div class="col">
                        <img alt="Login" src="<?php echo base_url();?>include/frontend/assets/imgs/theme/apple.svg" />
                        </div>
                    </div>
                </div>
              </div>
               <div class="col-md-8 pl0">

                <form class="login_right_div" id="login" method="post" onsubmit="Login();return false;">
                  <div class="login_heading">
                    <h4>Login/ Sign up</h4>
                    <p>Using OTP</p>
                  </div>
                   <div id="alertMess"></div>
                    <div class="form-group">
                      <div class="errmobile" style="color:red;"></div>
                      <input type="text" id="email_mobi" name="email_mobi" placeholder="Enter Mobile No or Email" required  onkeypress="eraseError()"/>
                    </div>
                    <div id="editfield"></div>

                  
                    <!--<div class="login_footer form-group">
                      <div class="chek-form">
                        <div class="custome-checkbox"></div>
                      </div>
                     <a class="text-muted" href="<?php //echo base_url('forgot');?>">Forgot password?</a>
                    </div>-->

                    <div class="verify-btn login-otp-input" style="display: none;">
                      <div class="errOtp" style="color:red;"></div>
                      <div class="otp_div">
                        <p class="text-white">Enter OTP</p>
                        <div id="otp" class="otp-field">
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1" />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                        </div>
                      </div>
                      <!-- <p class="mb-4 mt-2">
                        <a href="javascript:void(0);" class="text-primary send_otp" >Resend</a>
                        <div class="loaderdiv-otp"></div>
                      </p> -->
                    </div>
                    
                    <div class="form-group mb-10" id="otpbtn">
                      <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold oi confinue-login popup_login_btn">Continue</button>
                    </div>
                    <div id="error_msg"></div>

                    <div class="form-group login_in_social_login text-center pb-3">
                        <a href="<?php //echo $google_client->createAuthUrl();?>" target="_blank" class="soc_login_btn google social-login google-login">
                        <img src="<?php  echo base_url();?>include/frontend/assets/imgs/theme/icons/logo-google.svg" alt="" />&nbsp;&nbsp;</a>
                        <a href="<?php //echo $fblogin['loginurl']; ?>" class="social-login facebook-login">
                        <img src="<?php // echo base_url();?>include/frontend/assets/imgs/theme/icons/logo-facebook.svg" alt="" />&nbsp;&nbsp;
                        </a>
                         <div class="loaderdiv_login__"></div>
                    </div>
                    <div class="login_footer form-group mt-4">
                      <div class="chek-form text-center">

                        <label class="form-check-label" style="font-size: 15px;">By continuing, I accept Royal Dryfruit’s <a href="<?php echo base_url('terms-and-conditions');?>">Terms and Conditions</a> and <a href="<?php echo base_url('privacy-policy');?>">Privacy Policy</a>.</label>
                      </div>
                    </div>
                </form>
                <!-- Mobile Verification Modal -->
                <div id="mobileVerificationModal" class="modal1">
                  <div class="modal-content1">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h4>Mobile Verification</h4>
                    <p>Please enter your mobile number for verification:</p>
                    <!-- <input type="text" id="mobile_number" placeholder="Enter Mobile Number" required /> -->
                    <input type="text" id="email_mobi" name="email_mobi" placeholder="Enter Mobile No or Email" required  onkeypress="eraseError()"/>
                    <div class="verify-btn login-otp-input" style="">
                      <div class="errOtp" style="color:red;"></div>
                      <div class="otp_div">
                        <p class="text-white">Enter OTP</p>
                        <div id="otp" class="otp-field">
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1" />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                          <input class="m-2 text-center form-control rounded" type="number"  name="otp[]"   maxlength="1"  />
                        </div>
                      </div>
                      <!-- <p class="mb-4 mt-2">
                        <a href="javascript:void(0);" class="text-primary send_otp" >Resend</a>
                        <div class="loaderdiv-otp"></div>
                      </p> -->
                    </div>
                    <div class="form-group mb-10" id="otpbtn">
                      <button type="submit" onsubmit="Login();return false;" class="btn btn-fill-out btn-block hover-up font-weight-bold oi confinue-login popup_login_btn">Verify Mobile</button>
                    </div>
                  </div>
                </div>  
               </div>
            </div>
           

            <!-- ===============login form code end========== -->
          </div>
        </div>
      </div>
    </div>
<script type="text/javascript">
  function openModal() {
    $('#mobileVerificationModal').fadeIn();
}
function closeModal() {
    $('#mobileVerificationModal').fadeOut();
}
if (isEmail) {
    openModal();
}

</script>    