 
 <?php
 
//  echo "<pre>";
//  print_r($cusotmer_details);
//  echo "</pre>";
// echo "hiii";

 ?>



 <div class="accordion-body">
     <div class="row">
            <div class="form-group col-lg-6">
            <input class="form-control" name="registration" id="registration" placeholder="GST No" type="text" value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->registration_no :'';?>">
            </div>
            <div class="form-group col-lg-6">
                <input class="form-control" name="company_name"  id="company_name" type="text" placeholder="Registered Company Name " value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->company_name :'';?>">
            </div>
            <div class="form-group col-lg-6">
                <input class="form-control" name="company_address" id="company_address" type="text" placeholder="Registered Company Address " value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->company_address :'';?>">
            </div>
             <div class="form-group col-lg-6">
                <input class="form-control" name="gstpincode" id="gstpincode" type="text" placeholder="Pincode " value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->cust_pincode :'';?>">
            </div>

            <div class="form-group col-lg-6">
                <input type="text" class="form-control" name="fssai_no" id="fssai_no" value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->fssai_no :'';?>" placeholder="FSSAI NO">
            </div>
           
            <div class="form-group col-lg-6">
                <input type="text" class="input-disabled" name="gst_contact" id="gst_contact" value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->mobile :'';?>" placeholder="Contact Number (Optional)" readonly>
            </div>
            
            <div class="form-group col-lg-6">
                <input type="text" class="input-disabled" name="gstemail" id="gstemail" value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->email :'';?>" placeholder="Email ID (Optional)" readonly>
            </div>

            

            <div class="form-group col-lg-6"></div>
            <div class="form-group col-lg-6">
                <button type="button" class="width_auto btn sub-regi btn-fill-out btn-base submit-registration">Submit</button>
        </div>

        </div>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
$(document).ready(function() {
    $(document).on('click', '.submit-registration', function(e) {
        e.preventDefault();

        // Function to validate each field
        function validateField(selector) {
            var value = $(selector).val().trim();
            if (value === "") {
                $(selector).css('border', '1px solid red');
                return false;
            } else {
                $(selector).css('border', '');
                return true;
            }
        }

        // Validate each required field
        var isValid = true;
        isValid &= validateField('#registration');
        isValid &= validateField('#company_name');
        isValid &= validateField('#company_address');
        isValid &= validateField('#gstpincode');

        // If all fields are valid, submit the form
        if (isValid) {
            // You can submit the form here or make an AJAX call
            // For demonstration purposes, we'll just alert a success message
            alert('Form submitted successfully!');
        } else {
            alert('Please fill all required fields.');
        }
    });

    // Optional: Remove the red border when the user starts typing
    $('input').on('input', function() {
        $(this).css('border', '');
    });
});
</script>
