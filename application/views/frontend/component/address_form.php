
<?php 
// echo "<pre>";
// print_r($address);
// echo "</pre>";
// echo "hooo";
?>
<div class="card">
    <div class="card-body"><br>
        <h6>Personal Details</h6> <br>
       <div class="row">
            <div class="form-group col-lg-4">
                <label for="inputPassword5" class="form-label">First Name</label>
                <input type="text" name="fname" id="fname" placeholder="Enter First Name" value="<?php echo ($address!=0) ? $address[0]->fname :'';?>">
            </div>
            <div class="form-group col-lg-4">
                <label for="inputPassword5" class="form-label">Last Name </label>
                <input type="text" name="lname" id="lname" placeholder="Enter Last Name" value="<?php echo ($address!=0) ? $address[0]->lname :'';?>">
            </div>
            <div class="form-group col-lg-4">
                <label for="inputPassword5" class="form-label">Mobile No</label>
                <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="<?php echo ($address!=0) ? $address[0]->mobile1 :'';?>">
            </div>
        </div><br>
        <h6>Address Details</h6> <br>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="inputPassword5" class="form-label">House No</label>
                <input type="text" name="apart_house" id="apart_house" placeholder="Enter House No" value="<?php echo ($address!=0) ? $address[0]->address1 :'';?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="inputPassword5" class="form-label">Apartment name</label>
                 <input type="text" name="apart_name" id="apart_name" placeholder="Enter Apartment name" value="<?php echo ($address!=0) ? $address[0]->address2 :'';?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="inputPassword5" class="form-label">Landmark for easy reach out </label>
               <input type="text"  name="area" id="area" placeholder="Enter Landmark for easy reach out" value="<?php echo ($address!=0) ? $address[0]->area :'';?>">
            </div>
            <div class="form-group col-lg-6">
                <label for="inputPassword5" class="form-label">Street Details/Landmark </label>
                <input type="text" name="street_landmark" id="street_landmark"  placeholder="Enter Street Details/Landmark" value="<?php echo ($address!=0) ? $address[0]->landmark :'';?>">
            </div>
        </div>
        <div class="row shipping_calculator">
           <div class="form-group col-lg-4">
            <label for="inputPassword5" class="form-label">Select State </label>
                <div class="custom_select w-100 select2-selection-state">
                    <select class="form-control select-active class-state" name="state" id="state">
                        <option value="">Select</option>
                        <?php 
                          if($status!=array()){
                            foreach ($status as $key => $value) {
                                $selected = ($address[0]->state_id==$value->id)?'selected':'';
                                ?>
                                <option value="<?php echo $value->id;?>" <?php echo $selected;?>><?php echo $value->name;?></option>
                                <?php
                            }
                          }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label for="inputPassword5" class="form-label">Select City </label>
                 <div class="custom_select w-100 select2-selection-city">
                     <!--<input type="hidden" name="cityid" id="cityid" value="<?php //echo ($address!=0) ? $address[0]->city_id :'';?>">-->
                  <select class="form-control select-active class-city" name="city" id="city">
                        <option value="">Select</option>
                        <?php 
                          if (!empty($cities)) {
                                foreach ($cities as $city) {
                                    $selected = (!empty($address) && $address[0]->city_id == $city->id) ? 'selected' : '';
                                    echo "<option value='{$city->id}' {$selected}>{$city->name}</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label for="inputPassword5" class="form-label">Pincode </label>
                <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode" oninput="validatePincode(this)" value="<?php echo ($address!=0) ? $address[0]->pincode :'';?>">
            </div>
        </div><br>
        
        <h6>*Address Type</h6> <br>

          <?php
          $home='';
          $office='';
          $other='';
          $style = 'style="display:none;"';
          $other_loc='';
           if($address!=0){
               $home = ($address[0]->nick_name=='Home') ?'checked':'';
               $office = ($address[0]->nick_name=='Office') ?'checked':'';
               $other = ($address[0]->nick_name=='Other') ?'checked':'';
               $style = ($other=='checked') ? 'style="display:block;"' :'style="display:none;"';
               $other_loc =$address[0]->others;
           }

          ?>
         <ul class="ad_type">
                <li><input type="radio" name="type" id="home" value="Home" class="actinput" <?php echo $home;?>><label for="home"><span class="material-symbols-outlined">home</span>&nbsp;&nbsp; Home</label></li>

                <li><input type="radio" name="type" id="office" value="Office" class="actinput" <?php echo $office;?>><label for="office"><span class="material-symbols-outlined">work</span>&nbsp;&nbsp; Office</label></li>

                <li><input type="radio" name="type" id="other" value="Other" class="actinput" <?php echo $other;?>><label for="other"><span class="material-symbols-outlined">location_on</span>&nbsp;&nbsp; Other</label></li>

                <li><input type="text" class="form-control" name="other_loc" id="other_loc" value="<?php echo $other_loc;?>" placeholder="Type Here" <?php echo $style;?>></li>
        </ul>
        <div class="delivery_check d-flex align-items-center pt-10">
            <input class="form-check-input class-price-desk0" type="checkbox">&nbsp;&nbsp;
                <label class="form-check-label mb-0">
                    <span> <p class="text-muted">Make this as my default delivery address</p></span>
                </label>                       
        </div>
         <div id="errf"></div>
        </div>

        <hr>
        <div class="row p-20 float-right">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <!-- <a href="<?php //echo base_url('my-address');?>" class="btn btn_dark w-100">Cancel</a> -->
        </div>
        <div class="col-md-4">
             <a href="" class="btn btn-md w-100 add-shi-sa <?php echo $addrs;?>" data-id="<?php echo ($address!=0) ? $address[0]->addr_id :'';?>">
                <?php if($address==0){ ?>
                 Add Address
             <?php }else{ 
               ?>
               Update Address
               <?php
             } ?>
         </a>

        

            <!-- <div class="loaderdiv_addrs"></div> -->
        </div>
        </div>
    </div>
