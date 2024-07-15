 <?php
 // print_r($customer_details);
 // exit;
 ?>
<?php
$this->load->view('frontend/header',$data);
?>
 <style>
   /* #loaderdiv {
        display: none;
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        z-index: 9999; /* Make sure it covers other elements */
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }*/
.error-message {
    color: red;
    font-size: 0.875em;
    margin-top: 5px;
}

#snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

</style>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="<?php echo base_url('account');?>">My Account</a><span></span>Profile
            </div>
        </div>
    </div>
    <div class="page-content pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my_account_main m-auto">
                    <div class="row">
                        <div class="col-md-2">
                           <?php 
                             $p['pageType'] = 'account';
                             $this->load->view('frontend/component/my_account_side_bar',$p); 
                           ?>
                        </div>
                        <div class="col-md-10">
                            <div class="tab-content account dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="loaderdiv"></div>
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label for="firstname" class="form-label">First Name</label>
                                                    <input class="form-control" name="firstname" id="firstname" type="text" value="<?php echo (!empty($customer_details) && isset($customer_details[0]->c_fname)) ? $customer_details[0]->c_fname : ''; ?>" placeholder="First Name" required>
                                                </div>
                                                <div class="form-group col-lg-6"></div>
                                                <div class="form-group col-lg-6">
                                                    <label for="lastname" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo (!empty($customer_details) && isset($customer_details[0]->c_lname)) ? $customer_details[0]->c_lname : ''; ?>" placeholder="Last Name" required>
                                                </div>
                                                <div class="form-group col-lg-6"></div>
                                                <div class="form-group col-lg-6">
                                                    <label for="mobilename" class="form-label">Mobile Number</label>
                                                    <input class="form-control" name="oldmobilename" id="oldmobilename" type="hidden" value="<?php echo (!empty($customer_details) && isset($customer_details[0]->mobile)) ? $customer_details[0]->mobile : ''; ?>" required>
                                                    <input class="form-control" name="mobilename" id="mobilename" type="text" value="<?php echo (!empty($customer_details) && isset($customer_details[0]->mobile)) ? $customer_details[0]->mobile : ''; ?>" placeholder="Mobile Number">
                                                    <span id="mobilename-error" class="error-message"></span>
                                                </div>
                                                <div class="form-group col-lg-6"></div>
                                                <div class="form-group col-lg-6">
                                                    <label for="emailAddress" class="form-label">Email</label>
                                                    <input class="form-control" name="oldemailaddress" id="oldemailAddress" type="hidden" value="<?php echo (!empty($customer_details) && isset($customer_details[0]->email)) ? $customer_details[0]->email : ''; ?>" required>
                                                    <input class="form-control" name="emailaddress" id="emailAddress" type="email" value="<?php echo (!empty($customer_details) && isset($customer_details[0]->email)) ? $customer_details[0]->email : ''; ?>" placeholder="Email Id">
                                                    <span id="emailAddress-error" class="error-message"></span>
                                                </div>
                                                <div class="delivery_check d-flex align-items-center pt-10">
                                                    <input class="form-check-input class-price-desk0" type="checkbox">&nbsp;&nbsp;
                                                    <label class="form-check-label mb-0">
                                                        <span><p class="text-muted">Send Me Mail Promotion Connecting The Subscribe</p></span>
                                                    </label>
                                                </div>
                                                <div class="form-group col-lg-6 mt-20">
                                                    <button type="button" class="width_auto sav-cha btn btn-fill-out btn-base account-details">Save Changes</button>
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
        </div>
    </div>
</main>

<?php
$this->load->view('frontend/footer',$data);
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- HTML part -->
<?php $this->load->view('frontend/footer',$data); ?>
<div id="snackbar"></div>
<div class="loaderdiv"></div>
<script type="text/javascript">
function loading(elementId, displayState) {
    document.getElementById(elementId).style.display = displayState;
}

$(document).ready(function() {
    // Mobile number validation
    document.getElementById('mobilename').addEventListener('change', function() {
        var mobilename = this.value;
        var pattern = /^[6-9]\d{9}$/;
        var errorMessageElement = document.getElementById('mobilename-error');

        if (mobilename === "" || !pattern.test(mobilename)) {
            this.style.border = '1px solid red';
            errorMessageElement.textContent = 'Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.';
        } else {
            this.style.border = '1px solid #CCCCCC';
            errorMessageElement.textContent = '';
        }
    });

    // Email validation
    document.getElementById('emailAddress').addEventListener('change', function() {
        var emailAddress = this.value;
        var regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var errorMessageElement = document.getElementById('emailAddress-error');

        if (emailAddress === "" || !regexEmail.test(emailAddress)) {
            this.style.border = '1px solid red';
            errorMessageElement.textContent = 'Please enter a valid email address.';
        } else {
            this.style.border = '1px solid #CCCCCC';
            errorMessageElement.textContent = '';
        }
    });

    // Form submission
    $(document).on('click', '.account-details', function() {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var mobilename = $('#mobilename').val();
        var emailAddress = $('#emailAddress').val();
        var oldmobilename = $('#oldmobilename').val();
        var oldemailAddress = $('#oldemailAddress').val();

        var regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var pattern = /^[6-9]\d{9}$/;
        var status = 1;

        if (firstname === "" || firstname === null) {
            $('#firstname').css('border', '1px solid red');
            status = 0;
        } else {
            $('#firstname').css('border', '1px solid #CCCCCC');
        }

        if (lastname === "" || lastname === null) {
            $('#lastname').css('border', '1px solid red');
            status = 0;
        } else {
            $('#lastname').css('border', '1px solid #CCCCCC');
        }

        if (mobilename === "" || mobilename === null || !pattern.test(mobilename)) {
            $('#mobilename').css('border', '1px solid red');
            status = 0;
        } else {
            $('#mobilename').css('border', '1px solid #CCCCCC');
        }

        if (emailAddress === "" || emailAddress === null || !regexEmail.test(emailAddress)) {
            $('#emailAddress').css('border', '1px solid red');
            status = 0;
        } else {
            $('#emailAddress').css('border', '1px solid #CCCCCC');
        }

        if (status === 1) {
            // Show loader
            loading('loaderdiv', 'block');
            $('.sav-cha').removeClass('account-details');

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: base_url + 'common/add_user_details',
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    mobilename: mobilename,
                    emailAddress: emailAddress,
                    oldmobilename: oldmobilename,
                    oldemailAddress: oldemailAddress
                },
                success: function(result) {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    var message = result.message;
                    document.getElementById('snackbar').innerText = message;
                    setTimeout(function() {
                        x.className = x.className.replace("show", "");
                    }, 3000);

                    if (result.status === 1) {
                        $('#snackbar').removeClass('errrol');
                    } else {
                        $('#snackbar').addClass('errrol');
                    }

                    $('.sav-cha').addClass('account-details');
                    // Hide loader
                    loading('loaderdiv', 'none');
                },
                error: function(xhr, status, error) {
                    console.log("AJAX call error", xhr, status, error);
                    $('.sav-cha').addClass('account-details');
                    // Hide loader
                    loading('loaderdiv', 'none');
                }
            });
        }
    });
});


</script>





