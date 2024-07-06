<style>
    .error {
        border: 1px solid red;
    }
    .error-message {
        color: red;
        font-size: 0.875em;
        display: none;
    }
</style>
<?php
$this->load->view('frontend/header',$data);
?>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo base_url();?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Contact
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 m-auto">
                    <section class="row mb-50">
                        <div class="col-lg-12 mb-lg-0 mb-md-5 mb-sm-5">
                            <h4 class="mb-20 text-brand">How can i help you ?</h4>
                            <h1 class="mb-30">Let us know how we can help you</h1>
                                
                            <div class="container">
                                <form class="contact-form-style mt-30" id="contact-form" action="#" method="post" onsubmit="return validateForm(event)">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="input-style mb-20">
                                                <input name="fname" id="fname" placeholder="First Name" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="input-style mb-20">
                                                <input name="lname" id="lname" placeholder="Last Name" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="input-style mb-20">
                                                <input name="email" id="email" placeholder="Email" type="text" onchange="validateEmail()" />
                                                <span id="email-error" class="error-message">Invalid email address.</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="input-style mb-20">
                                                <input name="mobile" id="mobile" placeholder="Mobile No" type="tel" onchange="validateMobile()" />
                                                <span id="mobile-error" class="error-message">Mobile number must be exactly 10 digits.</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="input-style mb-20">
                                                <input name="subject" id="subject" placeholder="Subject" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="textarea-style mb-30">
                                                <textarea name="message" id="message" placeholder="Message" style="min-height:64px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="submit submit-auto-width" type="submit">Send message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p class="form-messege"></p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <section class="container mb-50 d-none d-md-block">
            <div class="border-radius-15 overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d28459.802821338933!2d75.77417387431643!3d26.920140900000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRoyal%20Tower%20Girnar%20Colony!5e0!3m2!1sen!2sin!4v1705400151357!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    </div>
</main>
<?php
$this->load->view('frontend/footer',$data);
?>
<script>
    function validateForm(event) {
        event.preventDefault(); // Prevent form submission

        var isValid = true;
        var fields = ['fname', 'lname', 'subject', 'message'];

        // Validate all fields except mobile and email, and highlight errors
        fields.forEach(function(field) {
            var input = document.getElementById(field);
            if (input.value.trim() === '') {
                input.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
            }
        });

        var emailValid = validateEmail();
        var mobileValid = validateMobile();
        if (!emailValid || !mobileValid) {
            isValid = false;
        }

        if (isValid) {
            submitForm();
        }
    }

    function validateMobile() {
        var mobile = document.getElementById('mobile');
        var mobileError = document.getElementById('mobile-error');
        var mobileVal = mobile.value.trim();
        if (!/^\d{10}$/.test(mobileVal)) {
            mobile.classList.add('error');
            mobileError.style.display = 'block';
            return false;
        } else {
            mobile.classList.remove('error');
            mobileError.style.display = 'none';
            return true;
        }
    }

    function validateEmail() {
        var email = document.getElementById('email');
        var emailError = document.getElementById('email-error');
        var emailVal = email.value.trim();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailVal)) {
            email.classList.add('error');
            emailError.style.display = 'block';
            return false;
        } else {
            email.classList.remove('error');
            emailError.style.display = 'none';
            return true;
        }
    }

    function submitForm() {
        var formData = $('#contact-form').serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('company_pages/contact_form_submit'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.status === 'success') {
                    $('#contact-form')[0].reset(); // Reset the form
                }
                window.location.reload(); // Reload the page after alert
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    }
</script>
