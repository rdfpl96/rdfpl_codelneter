<?php
//print_r($gstDetail);
//exit;
?>
<form action="<?php echo base_url('save-gst-details')?>" method="post" id="gstdetailsform" name="gstdetailsform" onsubmit="saveGstDetails();return false;">
        <div class="row" style="padding:18px">
            <div class="form-group col-lg-6">
            <input class="form-control" name="registration_no" id="registration_no" placeholder="GST No*" type="text" value="<?php echo isset($gstDetail['registration_no']) ? $gstDetail['registration_no'] : "" ?>">
            <span id="er_registration_no" class="form-text" style="color: red;"></span>
            </div>
            <div class="form-group col-lg-6">
                <input class="form-control" name="company_name"  id="company_name" type="text" placeholder="Registered Company Name *" value="<?php echo isset($gstDetail['company_name']) ? stripslashes($gstDetail['company_name']) : "" ?>">
                <span id="er_company_name" class="form-text" style="color: red;"></span>
            </div>
            <div class="form-group col-lg-6">
                <input class="form-control" name="company_address" id="company_address" type="text" placeholder="Registered Company Address *" value="<?php echo isset($gstDetail['company_address']) ? stripslashes($gstDetail['company_address']) : "" ?>">
                 <span id="er_company_address" class="form-text" style="color: red;"></span>
            </div>
            <div class="form-group col-lg-6">
                <input class="form-control" name="pincode" id="pincode" type="text" placeholder="Pincode *" maxlength="6" value="<?php echo isset($gstDetail['pincode']) ? stripslashes($gstDetail['pincode']) : "" ?>">
                <span id="er_pincode" class="form-text" style="color: red;"></span>
            </div>

            <div class="form-group col-lg-6">
                <input type="text" class="form-control" name="fssai_no" id="fssai_no" value="<?php echo isset($gstDetail['fssai_no']) ? stripslashes($gstDetail['fssai_no']) : "" ?>" placeholder="FSSAI NO">
                <span id="er_fssai_no" class="form-text" style="color: red;"></span>
            </div>
           
            <div class="form-group col-lg-6">
                <input type="text" class="input-disabled" name="gst_contact" id="gst_contact" value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->mobile :'';?>" placeholder="Contact Number (Optional)" readonly>
                <span id="er_mobile" class="form-text" style="color: red;"></span>
            </div>
            
            <div class="form-group col-lg-6">
                <input type="text" class="input-disabled" name="gstemail" id="gstemail" value="<?php echo ($cusotmer_details!=0) ? $cusotmer_details[0]->email :'';?>" placeholder="Email ID (Optional)" readonly>
                 <span id="er_email" class="form-text" style="color: red;"></span> 
            </div>
            <div class="form-group col-lg-12" id="errmsg"></div>
            <div class="form-group col-lg-6">
                <button type="submit" class="width_auto btn sub-regi btn-fill-out btn-base">Submit</button>
            </div>
        </div>
    </form>    
