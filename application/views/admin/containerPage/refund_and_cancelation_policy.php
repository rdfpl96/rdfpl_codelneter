
<?php
   // echo "<pre>";
   // print_r($actAcx);
   // print_r($session['admin_type']);
   // echo "</pre>";

$actAcx=($getAccess['inputAction']!="") ? $getAccess['inputAction']:array();
   if(!in_array('update',$actAcx) && $session['admin_type']!='A'){
    echo "No direct page access allowed";
    exit;
   }
?>

<style type="text/css">
    .modal-backdrop.show {
    opacity: .5;
    display: none !important;
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
                               
                                <h3 class="fw-bold mb-0">Refund & Cancelation Policy</h3>
                                <?php if(in_array('update',$actAcx) || $session['admin_type']=='A'){ ?>
                                <button type="button" name="submit_customer" class="btn btn-primary tm-cl btn-set-task w-sm-100 py-2 px-5 text-uppercase save-policy">Save</button>
                                <div class="loaderdiv" style="position: absolute;z-index: 99999999;float: right;margin-left: 20%;"></div>
                            <?php } ?>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">

                            
                                    <input type="hidden" class="form-control" name="field-type" id="field-type" value="refund-cancelation">
                                    <input type="hidden" class="form-control" name="edits_id" id="edits_id" value="<?php echo ($policy_details!=0) ? $policy_details[0]->policy_id :'';?>">
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <textarea id="summernote" name="editordata"> <?php  echo ($policy_details!=0) ? $policy_details[0]->refund_and_cancelation_policy :'';?></textarea>
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
   