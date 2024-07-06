
<?php
 $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }
?>
<!-- Body: Body -->       
<div class="body d-flex py-lg-3 py-md-2">
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                 <div class="mob_back_btn">
                       <h2 style="padding-top: 8px;color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                    </div>
                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Coupons</h3>
                <div class="loaderdiv"></div>
               <button type="button" class="btn btn-primary con-cl py-2 px-5 text-uppercase btn-set-task w-sm-100 save-coupon">Submit</button>
            </div>

             
        </div>
    </div> <!-- Row end  -->
    <div class="row clearfix g-3">

        <?php
        // echo "<pre>";
        // print_r($coupon_detaials);
        // echo "</pre>";
        ?>
        <div class="col-lg-3">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                    <h6 class="m-0 fw-bold">Coupon Status</h6>
                </div>
                <div class="card-body">
                    <div class="form-check" style="padding: 2% 10% 2%;">
                        <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="1" name="coupons_status" id="active" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->coupons_status==1 ? 'checked':''):'checked';?>>
                            Active
                        </label>
                    </div>
                    <div class="form-check" style="padding: 2% 10% 2%;">
                        <label class="form-check-label">
                        <input class="form-check-input" type="radio" value="0" name="coupons_status" id="in_active" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->coupons_status==0 ? 'checked':''):'';?>>
                            Inactive
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                    <h6 class="m-0 fw-bold">Date Schedule</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control w-100 " name="start_date" id="start_date" min="<?php echo date('Y-m-d');?>" value="<?php echo ($coupon_detaials!=0) ? $coupon_detaials[0]->start_date:'';?>">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control w-100" name="end_date" id="end_date" min="<?php echo ($coupon_detaials!=0) ? $coupon_detaials[0]->start_date:date('Y-m-d');?>" value="<?php echo ($coupon_detaials!=0) ? $coupon_detaials[0]->end_date:'';?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <form>
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                    <h6 class="m-0 fw-bold">Coupon Information</h6>
                </div>
                
                    
                        <div class="card-body">
                        <input type="hidden" class="form-control" name="coupon_id" id="coupon_id" value="<?php echo $this->uri->segment(3);?>">
                        <div class="row g-6 align-items-center">
                            <div class="col-md-3">
                                <label class="form-label">Coupons Code</label>
                                <input type="text" class="form-control" name="coupon_code" id="coupon_code" value="<?php echo ($coupon_detaials!=0) ? $coupon_detaials[0]->coupon_code:generateCouponCode(6);?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Purchase Type<span style="color:red;">*</span></label>
                                <select class="form-select purchase_class" name="purchase_type" id="purchase_type">
                                    <option value="amount_purchase"<?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->purchase_type=="amount_purchase" ? 'selected':''):'';?>>Amount Purchase</option>
                                </select>
                            </div>

                         </div>
                    </div>
                </div>
                 <!-- <option value="qty_purchase" <?php //echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->purchase_type=="qty_purchase" ? 'selected':''):'';?>>Qty Purchase</option> -->

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                         <div class="col-md-4">
                               <?php
                                if($coupon_detaials!=0){

                                    if($coupon_detaials[0]->purchase_type=='amount_purchase'){
                                        $name='min_purch_amt'; $id='min_purch_amt'; $label='Min. Purchase Amt';
                                        $values=$coupon_detaials[0]->min_purch_amt;

                                    }else if($coupon_detaials[0]->purchase_type=='qty_purchase'){
                                        $name='min_purch_qty'; $id='min_purch_qty'; $label='Min. Purchase qty';
                                        $values=$coupon_detaials[0]->min_purch_qty;
                                    }else{
                                        $name='min_purch_product'; $id='min_purch_product'; $label='Min. Purchase product';
                                        $values=$coupon_detaials[0]->min_purch_product;
                                    }

                                }else{
                                    $name='min_purch_amt'; $id='min_purch_amt'; $label='Min. Purchase Amt';
                                    $values='';
                                }
                               ?>

                                <label class="form-label purchase_label"><?php echo $label;?>
                                    <span style="color:red;">*</span>
                                </label>
                                <input type="number" class="form-control purchase_input" name="<?php echo $name;?>" id="<?php echo $id;?>" value="<?php echo $values;?>" oninput="validateNonNegativeNumber(this)">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Discount Type <span style="color:red;">*</span></label>
                                <select class="form-select disc_class" name="disc_type" id="disc_type">
                                    <option value="fixed_amt" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->disc_type=="fixed_amt" ? 'selected':''):'';?>>Fixed Amount</option>
                                    <option value="percentage" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->disc_type=="percentage" ? 'selected':''):'';?>>Percentage</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <?php
                                 if($coupon_detaials!=0){
                                      
                                      if($coupon_detaials[0]->disc_type=='fixed_amt'){
                                        $name_disc='disc_amt'; $id_disc='disc_amt'; $lable_dic='Discount Amt';
                                        $values_disc=$coupon_detaials[0]->disc_amt;
                                      }else{
                                        $name_disc='disc_per'; $id_disc='disc_per';$lable_dic='Discount Per (%)';
                                        $values_disc=$coupon_detaials[0]->disc_per;
                                      }

                                 }else{
                                    $name_disc='disc_amt'; $id_disc='disc_amt';  $lable_dic='Discount Amt';
                                    $values_disc='';
                                   }
                                ?>

                                <label class="form-label disc_lable"><?php echo $lable_dic;?>
                                    <span style="color:red;">*</span>
                                </label>
                                <input type="number" class="form-control disc_input" name="<?php echo $name_disc;?>" id="<?php echo $id_disc;?>" value="<?php echo $values_disc;?>" oninput="validateNonNegativeNumber(this)">
                            </div>
                        </div>
                     </div>
               </div>
               <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="radio-inline" style="padding: 0 10px 0;">
                                  <input type="radio" name="checkUses" value="multi_use" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->coupon_time_uses=="multi_use" ? 'checked':''):'checked';?>> Multiple Time Use
                                </label>
                                <label class="radio-inline" style="padding: 0 10px 0;">
                                  <input type="radio" name="checkUses" value="single_use" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->coupon_time_uses=="single_use" ? 'checked':''):'';?>> One Time Use
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="radio-inline" style="padding: 0 10px 0;">
                                  <input type="radio" class="checkTypecsss" name="checkType" value="public" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->coupon_person_type=="public" ? 'checked':''):'checked';?>> Public
                                </label>
                                <label class="radio-inline" style="padding: 0 10px 0;">
                                  <input type="radio" class="checkTypecsss" name="checkType" value="individual" <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->coupon_person_type=="individual" ? 'checked':''):'';?>> Individual
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
       <div class="card mb-3 group-div" style="display: <?php echo ($coupon_detaials!=0) ? ($coupon_detaials[0]->coupon_person_type=="individual" ? 'block':''):'none';?>;">
            <div class="card-body">
                <div class="row">
                   <label for="Tags" class="form-label">Group of Email </label>
                         <a href="javascript:void(0);" class="clean-tab-textarea" style="margin-left: 95%;margin-top: -30px;color:#689F39;">Clean</a>
                         <input type="text" class="form-control" id="tags-email" name="tags_email" data-role="tagsinput" style="min-height: 100%;" placeholder="Enter multiple email comma separated (Ex : text1@domain.com, text2@domain.com)" value="<?php echo ($coupon_detaials!=0) ? $coupon_detaials[0]->coupon_email_group:'';?>">    
                         <p style="color: crimson;font-size: 12px;">After submit coupon code.Customer will receive email about coupon offers. Only send email on individual selected customer.</p>
                </div>

                <input type="hidden" class="form-control" id="email-clone" name="email_clone" value="<?php echo ($coupon_detaials!=0) ? $coupon_detaials[0]->coupon_email_group:'';?>">    
            </div>
        </div>
      </form>

    </div><!-- Row End -->
</div>
</div>

<style type="text/css">
   .bootstrap-tagsinput input {
    border: none;
    box-shadow: none;
    outline: none;
    background-color: transparent;
    padding: 0 6px;
    margin: 0;
    width: 100% !important;
    max-width: inherit;
}
</style>

