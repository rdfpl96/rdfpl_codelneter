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
      <form action="" method="post" id="my-form-pinode" enctype="multipart/form-data">
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
                                <h3 class="fw-bold mb-0"><?php echo ($this->uri->segment(3)=="") ? 'Add' :'Edit';?> Pincode</h3>
                                <div class="loaderdiv"></div>
                                <button type="button" name="submit_pincode" class="btn btn-primary hsn-cl btn-set-task w-sm-100 py-2 px-5 text-uppercase save-pincode">Save</button>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
                    
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-lg-12">
                            <div class="sticky-lg-top">
                                <div class="card mb-3">


                                     <input type="hidden" class="form-control" name="pin_code_id" id="pin_code_id" value="<?php echo $this->uri->segment(3);?>">
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                             <div class="col-md-6">
                                                <label  class="form-label">Werehouse code</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                 <?php if($werehouse_list!=0) {

                                                    $wrHosuCode=array_filter(explode(',',$pin_detaials[0]->werehouse));
                                                ?>
                                                 <?php foreach ($werehouse_list as $key => $whvalue) { 
                                                       $exploreV=end(explode('_',$whvalue->werehouse_code));
                                                       $checked = (in_array($exploreV,$wrHosuCode)) ? 'checked':'';
                                                    ?>
                                                      <label class="checkbox-inline checkboocss"><input type="radio" name="werehouse_code[]" value="<?php echo $exploreV;?>" <?php echo $checked;?>> <?php echo $whvalue->werehouse_name;?></label>
                                                       
                                                  <?php } ?>
                                               <?php } ?>
                                                    <br>
                                                  <span id="werehouse-code-error" style="color:red;"></span>

                                                 <!--  <select type="text" class="form-control" name="werehouse_code" id="werehouse-code">
                                                    <option value="">-Select-</option>
                                                    <?php //if($werehouse_list!=0){ ?>
                                                        <?php //foreach ($werehouse_list as $key => $value) { 
                                                               //$exploreV=explode('_',$value->werehouse_code);
                                                               // $selected=($pin_detaials!=0) ? (($pin_detaials[0]->werehouse==$exploreV[1]) ? 'selected':'') :'';
                                                            ?>
                                                                <option value="<?php //echo $exploreV[1];?>" <?php //echo $selected;?>><?php //echo $value->werehouse_name;?></option>
                                                        <?php //} ?>
                                                    <?php //} ?>
                                                  </select> -->
                                            </div>

                                            <div class="col-md-6">
                                                <label  class="form-label">Pincode</label>
                                                <input type="text" class="form-control" name="pin_code" id="pin-code" value="<?php echo ($pin_detaials!=0) ? $pin_detaials[0]->pincode :'';?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label  class="form-label">City Name</label>
                                                <input class="form-control" name="city_name" id="city-name" value="<?php echo ($pin_detaials!=0) ? $pin_detaials[0]->delivery_city :'';?>">
                                            </div>

                                           
                                            <div class="col-md-6">
                                                <label  class="form-label">Courier Type</label>
                                                  <select type="text" class="form-control" name="courier_type" id="courier-type">
                                                    <option value="">-Select-</option>
                                                    <?php if($courier_type!=0){ ?>
                                                        <?php foreach ($courier_type as $key => $value){

                                                            $selected1 = ($value->courier_code=='dtdc')? 'selected':'';

                                                             $selected=($pin_detaials!=0) ? (($pin_detaials[0]->courier_type==$value->courier_code) ? 'selected':'') : $selected1;

                                                           
                                                            
                                                            ?>
                                                            <option value="<?php echo $value->courier_code;?>" <?php echo $selected;?>><?php echo $value->courier_name;?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                  </select>
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
   