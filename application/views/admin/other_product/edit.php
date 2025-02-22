<?php
//  $actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
// if((!in_array('add',$actAcx) && !in_array('edit',$actAcx)) && $session['admin_type']!='A'){
//     echo "No direct page access allowed";
//     exit;
//    }

?>
<!-- Body: Body -->
<!-- Body: Body -->
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <div class="mob_back_btn">
                        <h2 style="padding-top: 8px; color: #689F39;" onclick="history.go(-1);"><i class="fa fa-chevron-left"></i></h2>
                    </div>
                    <div class="d-flex justify-content-between w-100"> 
                    <h3 class="fw-bold mb-0">Other Product</h3>
                    <button type="button" class="btn btn-primary pro-ad btn-set-task w-sm-100 py-2 px-5 text-uppercase" style="margin-left: 300px;" onclick="window.location.href='<?php echo base_url('admin/other-product'); ?>'">
                        Back
                    </button>
                    </div>
                    <div class="loaderdiv"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            
        </div>
        <!-- Row end  -->
        <div class="row clearfix g-3">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="post" id="form-other-product" name="form-other-product" action="<?php echo base_url('admin/other-product/add'); ?>">
                            <div class="row g-6 align-items-center">
                                <div class="col-md-3">
                                    <label class="form-label">Product Type<span style="color:red;">*</span></label>
                                    <select class="form-select" name="product_type_id" id="product_type_id" required>
                                        <option value="">Select</option>
                                        <option value="1">My Smart Basket</option>
                                        <option value="2">Feature product</option>
                                        <option value="3">New product</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Product<span style="color:red;">*</span></label>
                                    <select class="form-select" name="product_id[]" id="product_id" data-placeholder="Choose product ..." multiple required>
                                        <option value="">Select</option>
                                       
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="row g-6 align-items-center mt-4 pull-right">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary con-cl py-2 px-5 text-uppercase btn-set-task w-sm-100">Submit</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- Row End -->
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