
      <?php 
      if($dropdownProduct_list!=0){
              foreach($dropdownProduct_list as $key=>$value){

                $checked= ($edit_value==$value->unique_number) ? 'checked' : '';
       ?>
             <li class="form-check" style="padding: 0;"><label class="form-check-label" for="radio<?php echo $key;?>-<?php echo $view_data;?>" style="display: block;padding: 5px 5px 5px 25px;"><input type="radio" class="form-check-input prochecked" id="radio<?php echo $key;?>-<?php echo $view_data;?>" name="products<?php echo $view_data;?>" data-id="<?php echo $view_data;?>" value="<?php echo $value->unique_number;?>" <?php echo $checked;?>> <?php echo $value->product_name;?></label></li> 
      <?php
        }
      }
    ?>
   